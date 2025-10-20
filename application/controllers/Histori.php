<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * Class Histori
 *
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property HistoriModel $HistoriModel
 * @property CI_Input $input
 * @property CI_Upload $upload
 */
class Histori extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("logged_in")) {
			redirect("login");
		}

		// pastikan database dan input aktif
		$this->load->database();
		$this->load->model("HistoriModel");
		$this->load->library("upload");
	}

	public function index()
	{
		$data["title"] = "A.W.A.S. - Riwayat Kerawanan";
		$data["page"] = "front/pages/datakerawanan/histori";

		$user = [
			"id_user" => $this->session->userdata("id_user"),
			"role" => $this->session->userdata("role"), // 'admin', 'kanwil', 'upt'
			"id_upt" => $this->session->userdata("id_upt"),
			"id_kanwil" => $this->session->userdata("id_kanwil"),
		];

		// Daftar UPT sesuai role user
		$data["list_upt"] = $this->HistoriModel->getAllUpt($user);

		// Daftar Kanwil sesuai role user
		$data["list_kanwil"] = $this->HistoriModel->getAllKanwil($user);

		$data["narkotika"] = $this->HistoriModel->get_histori_by_instrument(
			"narkotika",
			$user,
		);
		$data["teroris"] = $this->HistoriModel->get_histori_by_instrument(
			"teroris",
			$user,
		);

		$this->load->view("front/layouts/main", $data);
	}

	public function get_jawaban($id_hasil)
	{
		try {
			$skrining = $this->HistoriModel->getJawabanSkrining($id_hasil);
			$faktor = $this->HistoriModel->getJawabanFaktor($id_hasil);

			$bahaya = [];
			$kerentanan = [];

			foreach ($faktor as $row) {
				// pastikan tidak null, lalu ubah ke lowercase
				$jenis_faktor = strtolower($row->jenis_faktor ?? "");

				if ($jenis_faktor === "bahaya") {
					$bahaya[] = $row;
				} elseif ($jenis_faktor === "kerentanan") {
					$kerentanan[] = $row;
				}
			}

			echo json_encode([
				"status" => "success",
				"skrining" => $skrining,
				"bahaya" => $bahaya,
				"kerentanan" => $kerentanan,
			]);
		} catch (Exception $e) {
			echo json_encode([
				"status" => "error",
				"message" => $e->getMessage(),
			]);
		}
	}

	public function delete($id_hasil)
	{
		if (empty($id_hasil)) {
			$this->session->set_flashdata("error", "ID hasil tidak valid.");
			redirect("histori");
			return;
		}

		// 🔐 Cek role user dari session
		$role = $this->session->userdata("role");
		if ($role !== "admin") {
			$this->session->set_flashdata("error", "Anda tidak memiliki hak untuk menghapus data ini.");
			redirect("histori");
			return;
		}

		// Mulai transaksi
		$this->db->trans_start();

		// Ambil semua data upload terkait sebelum dihapus (untuk hapus file fisik)
		$uploads = $this->db
			->get_where("tbl_upload", ["id_hasil" => $id_hasil])
			->result();

		// Hapus file fisik di folder uploads
		if (!empty($uploads)) {
			foreach ($uploads as $upload) {
				$file_path = FCPATH . "uploads/" . $upload->nama_file;
				if (file_exists($file_path)) {
					@unlink($file_path);
				}
			}
		}

		// Hapus dari tbl_hasil_indikator
		$this->db->where("id_hasil", $id_hasil);
		$this->db->delete("tbl_hasil_indikator");

		// Hapus dari tbl_upload
		$this->db->where("id_hasil", $id_hasil);
		$this->db->delete("tbl_upload");

		// Ambil data dari tbl_hasil sebelum dihapus (untuk hapus di tabel terkait)
		$hasil = $this->db
			->get_where("tbl_hasil", ["id_hasil" => $id_hasil])
			->row();

		if ($hasil) {
			if (!empty($hasil->id_object)) {
				// Hapus dari tbl_pegawai
				$this->db->where("nip", $hasil->id_object);
				$this->db->delete("tbl_pegawai");

				// Hapus dari tbl_narapidana
				$this->db->where("no_register", $hasil->id_object);
				$this->db->delete("tbl_narapidana");
			}
		}

		// Terakhir, hapus dari tbl_hasil
		$this->db->where("id_hasil", $id_hasil);
		$this->db->delete("tbl_hasil");

		// Selesaikan transaksi
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata("error", "Data gagal dihapus.");
		} else {
			$this->session->set_flashdata("success", "Data berhasil dihapus!");
		}

		redirect("histori");
	}

	public function edit($id_hasil)
{
    if (empty($id_hasil)) {
        show_404();
    }

    $data["title"] = "Edit Data Kerawanan";
    $data["page"] = "front/pages/datakerawanan/edit_histori";

    // Ambil data hasil (gunakan alias dan nama tabel eksplisit untuk hindari ambiguitas)
    $data["hasil"] = $this->db
        ->select("tbl_hasil.*, tbl_pegawai.*, tbl_upload.*, tbl_narapidana.*")
        ->from("tbl_hasil")
        ->join("tbl_pegawai", "tbl_pegawai.nip = tbl_hasil.id_object", "left")
        ->join("tbl_upload", "tbl_upload.id_hasil = tbl_hasil.id_hasil", "left")
        ->join("tbl_narapidana", "tbl_narapidana.no_register = tbl_hasil.id_object", "left")
        ->where("tbl_hasil.id_hasil", $id_hasil) // ✅ tambahkan nama tabel di sini
        ->get()
        ->row();

    if (!$data["hasil"]) {
        $this->session->set_flashdata("error", "Data tidak ditemukan.");
        redirect("histori");
        return;
    }

    // Ambil data user dari session
    $id_user = $this->session->userdata("id_user");
    $role = $this->session->userdata("role");

    // 🔒 Cek hak akses: hanya admin atau pemilik data yang boleh edit
    if ($role !== "admin" && $data["hasil"]->id_user != $id_user) {
        $this->session->set_flashdata("error", "Anda tidak memiliki akses untuk mengedit data ini.");
        redirect("histori");
        return;
    }

    // Ambil data tambahan untuk tampilan form
    $data["list_kanwil"] = $this->HistoriModel->getAllKanwil();
    $data["list_upt"] = $this->HistoriModel->getAllUpt();

    $this->load->view("front/layouts/main", $data);
}


	public function update()
	{
		$this->load->database();

		$id_hasil = $this->input->post("id_hasil");
		$tindak_lanjut = $this->input->post("tindak_lanjut");

		if (empty($id_hasil)) {
			$this->session->set_flashdata("error", "ID tidak ditemukan.");
			redirect("histori");
			return;
		}

		// Ambil data hasil untuk validasi akses
		$hasil = $this->db->get_where("tbl_hasil", ["id_hasil" => $id_hasil])->row();
		if (!$hasil) {
			$this->session->set_flashdata("error", "Data tidak ditemukan.");
			redirect("histori");
			return;
		}

		// Ambil data user dari session
		$id_user = $this->session->userdata("id_user");
		$role = $this->session->userdata("role");

		// 🔒 Cek hak akses: hanya admin atau pemilik data yang boleh update
		if ($role !== "admin" && $hasil->id_user != $id_user) {
			$this->session->set_flashdata("error", "Anda tidak memiliki akses untuk memperbarui data ini.");
			redirect("histori");
			return;
		}

		// Konfigurasi upload
		$config["upload_path"] = "./uploads/";
		$config["allowed_types"] = "pdf";
		$config["max_size"] = 2048;
		$config["encrypt_name"] = true;

		if (!is_dir($config["upload_path"])) {
			mkdir($config["upload_path"], 0777, true);
		}

		$this->upload->initialize($config);

		$file_dokumen = null;

		if (!empty($_FILES["file_dokumen"]["name"])) {
			if ($this->upload->do_upload("file_dokumen")) {
				$upload_data = $this->upload->data();
				$file_dokumen = $upload_data["file_name"];
			} else {
				$this->session->set_flashdata("error", $this->upload->display_errors());
				redirect("histori/edit/" . $id_hasil);
				return;
			}
		}

		$data = [
			"tindak_lanjut" => $tindak_lanjut,
		];

		if ($file_dokumen) {
			$data["nama_file"] = $file_dokumen;
		}

		if ($this->HistoriModel->update($id_hasil, $data)) {
			$this->session->set_flashdata("success", "Data berhasil diperbarui.");
		} else {
			$this->session->set_flashdata("error", "Gagal memperbarui data.");
		}

		redirect("histori");
	}
}
