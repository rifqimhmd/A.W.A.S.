<?php
defined("BASEPATH") or exit("No direct script access allowed");

/**
 * Class Dashboard
 *
 * @property DashboardModel $dashboardModel
 * @property CI_Session     $session
 * @property CI_Loader      $load
 * @property CI_Input       $input
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
		$data = $this->dashboardModel->getDetailByWarna($warna);
		
		header('Content-Type: application/json');
		echo json_encode($data);
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
}
