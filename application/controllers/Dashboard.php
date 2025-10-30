<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * Class Dashboard
 *
 * @property DashboardModel $dashboardModel
 * @property CI_Session     $session
 * @property CI_Loader      $load
 * @property CI_Input       $input
 * @property CI_Output       $output
 */
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("DashboardModel", "dashboardModel");
		$this->load->library("session");
	}

	public function index()
	{
		$data['hasil'] = $this->dashboardModel->getRekapHasilByInstrument();
		$data['title'] = "A.W.A.S. - Beranda";
		$data["page"] = "front/pages/home/dashboard";
		$this->load->view("front/layouts/main", $data);
	}

	// API endpoint untuk detail warna
	public function getDetailByWarna()
	{
		$warna = $this->input->get('warna');
		$response = ['success' => false, 'data' => [], 'message' => ''];

		try {
			if (empty($warna)) {
				throw new Exception('Parameter warna kosong.');
			}

			$data = $this->dashboardModel->getDetailByWarna($warna);
			$response['success'] = true;
			$response['data'] = $data;
		} catch (Exception $e) {
			$response['message'] = $e->getMessage();
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}


	// Endpoint JSON untuk AJAX
	public function getDataNarkotika()
	{
		echo json_encode($this->dashboardModel->getRankingNarkotika());
	}

	public function getDataTeroris()
	{
		echo json_encode($this->dashboardModel->getRankingTeroris());
	}

	// API endpoint untuk detail per Kanwil
	public function getDetailByKanwil()
	{
		$kanwil = $this->input->get('kanwil');
		$instrument = $this->input->get('instrument');
		$response = ['success' => false, 'data' => [], 'message' => ''];

		try {
			if (empty($kanwil) || empty($instrument)) {
				throw new Exception('Parameter tidak lengkap.');
			}

			$data = $this->dashboardModel->getDetailByKanwil($kanwil, $instrument);
			$response['success'] = true;
			$response['data'] = $data;
		} catch (Exception $e) {
			$response['message'] = $e->getMessage();
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
}
