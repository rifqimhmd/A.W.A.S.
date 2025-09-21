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
		$data["title"] = "Data Hasil";
		$data["subtitle"] = "Histori Penilaian Skrining dan Faktor";
		$data["page"] = "front/pages/datakerawanan/histori";

		$user = [
			"id_user" => $this->session->userdata("id_user"),
			"role" => $this->session->userdata("role"), // 'admin', 'kanwil', 'upt'
			"id_upt" => $this->session->userdata("id_upt"),
			"id_kanwil" => $this->session->userdata("id_kanwil"),
		];

		$data["narkotika"] = $this->HistoriModel->get_histori_by_instrument("narkotika", $user);
		$data["teroris"] = $this->HistoriModel->get_histori_by_instrument("teroris", $user);

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
				if (strtolower($row->jenis_faktor) === "bahaya") {
					$bahaya[] = $row;
				} elseif (strtolower($row->jenis_faktor) === "kerentanan") {
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

		$this->db->where("id_hasil", $id_hasil);
		$deleted = $this->db->delete("tbl_hasil");

		if ($deleted && $this->db->affected_rows() > 0) {
			$this->session->set_flashdata("success", "Data berhasil dihapus!");
		} else {
			$this->session->set_flashdata("error", "Data gagal dihapus atau sudah tidak ada.");
		}

		redirect("histori");
	}
}
