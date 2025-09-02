<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property DashboardModel $dashboardModel
 * @property CI_Session $session
 */
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DashboardModel', 'dashboardModel');
        $this->load->library('session');

        // cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    // Halaman dashboard
    public function index()
    {
        $data['id_user']  = $this->session->userdata('id_user');
        $data['role']     = $this->session->userdata('role');
        $data['page']     = 'front/pages/home/dashboard';

        $this->load->view('front/layouts/main', $data);
    }
}
