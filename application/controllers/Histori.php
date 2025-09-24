<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * Class Histori
 *
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property HistoriModel $HistoriModel
 */
class Histori extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("logged_in")) {
			redirect("login");
		}
		$this->load->model("HistoriModel");
	}

	public function index()
	{
		$data['title'] = "A.W.A.S. - Riwayat Kerawanan";
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

	/**
	 * Ambil jawaban skrining & faktor untuk modal
	 */
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

	/**
	 * Hapus hasil
	 */
	public function delete($id_hasil)
	{
		if (empty($id_hasil)) {
			$this->session->set_flashdata("error", "ID hasil tidak valid.");
			redirect("histori");
		}

		// Mulai transaksi
		$this->db->trans_start();

		// Hapus dari tbl_hasil_indikator
		$this->db->where("id_hasil", $id_hasil);
		$this->db->delete("tbl_hasil_indikator");

		// Ambil data dari tbl_hasil sebelum dihapus
		$hasil = $this->db
			->get_where("tbl_hasil", ["id_hasil" => $id_hasil])
			->row();

		if ($hasil) {
			// Hapus di tbl_pegawai (jika ada NIP)
			if (!empty($hasil->id_object)) {
				$this->db->where("nip", $hasil->id_object);
				$this->db->delete("tbl_pegawai");
			}

			// Hapus di tbl_narapidana (jika ada no_register)
			if (!empty($hasil->id_object)) {
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
}
