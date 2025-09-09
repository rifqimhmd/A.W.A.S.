<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Dashboard
 *
 * @property DashboardModel $dashboardModel
 * @property CI_Session     $session
 * @property CI_Loader      $load
 */

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DashboardModel', 'dashboardModel');
        $this->load->library('session');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        // $role = $this->session->userdata('role');

        // if ($role === 'admin') {
        //     // Data Kanwil
        //     $hasil = $this->dashboardModel->get_pivot_kanwil_warna();

        //     $peringkat = 1;
        //     $prev_merah = $prev_kuning = $prev_hijau = null;
        //     $hasil_ranked = [];

        //     foreach ($hasil as $index => $row) {
        //         if ($index == 0) {
        //             $row->peringkat = $peringkat;
        //         } else {
        //             if ($row->Merah == $prev_merah && $row->Kuning == $prev_kuning && $row->Hijau == $prev_hijau) {
        //                 $row->peringkat = $peringkat;
        //             } else {
        //                 $peringkat = $index + 1;
        //                 $row->peringkat = $peringkat;
        //             }
        //         }

        //         $prev_merah = $row->Merah;
        //         $prev_kuning = $row->Kuning;
        //         $prev_hijau = $row->Hijau;

        //         $hasil_ranked[] = $row;
        //     }

        //     $data['hasil_kanwil'] = $hasil_ranked;
        //     $data['hasil_upt'] = null;
        //     $data['message'] = null;
        // } elseif ($role === 'kanwil') {
        //     // Data UPT berdasarkan kanwil pengguna
        //     $id_kanwil = $this->session->userdata('id_kanwil');
        //     $hasil = $this->dashboardModel->get_pivot_upt_warna($id_kanwil);

        //     $peringkat = 1;
        //     $prev_merah = $prev_kuning = $prev_hijau = null;
        //     $hasil_ranked = [];

        //     foreach ($hasil as $index => $row) {
        //         if ($index == 0) {
        //             $row->peringkat = $peringkat;
        //         } else {
        //             if ($row->Merah == $prev_merah && $row->Kuning == $prev_kuning && $row->Hijau == $prev_hijau) {
        //                 $row->peringkat = $peringkat;
        //             } else {
        //                 $peringkat = $index + 1;
        //                 $row->peringkat = $peringkat;
        //             }
        //         }

        //         $prev_merah = $row->Merah;
        //         $prev_kuning = $row->Kuning;
        //         $prev_hijau = $row->Hijau;

        //         $hasil_ranked[] = $row;
        //     }

        //     $data['hasil_upt'] = $hasil_ranked;
        //     $data['hasil_kanwil'] = null;
        //     $data['message'] = null;
        // } else {
        //     // Non-admin / non-kanwil
        //     $data['hasil_kanwil'] = null;
        //     $data['hasil_upt'] = null;
        //     $data['message'] = "Anda tidak memiliki akses untuk melihat data ini.";
        // }

        $data['page'] = 'front/pages/home/dashboard';
        $this->load->view('front/layouts/main', $data);
    }
}
