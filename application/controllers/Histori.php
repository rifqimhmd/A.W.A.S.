<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Hasil
 *
 * @property HistoriModel $HistoriModel
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Pagination $pagination
 * @property CI_Loader $load
 * @property CI_DB_query_builder $db
 */
class Histori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HistoriModel');
    }

    public function index()
    {
        $data['title'] = "Data Hasil";
        $data['hasil'] = $this->HistoriModel->getAll();

        $data['page'] = 'front/pages/datakerawanan/histori';
        $this->load->view('front/layouts/main', $data);
    }
}
