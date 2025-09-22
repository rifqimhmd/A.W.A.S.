<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property CI_Input $input
 * @property CI_Session $session
 * @property LoginModel $LoginModel
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('/');
        }
        $this->load->view('front/pages/akses/login');
    }

    public function login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->LoginModel->check_login($username, $password);

        if ($user) {
            if ($user->status === 'aktif') {
                // simpan session
                $data = [
                    'id_user'   => $user->id_user,
                    'id_upt'    => $user->id_upt,
                    'id_kanwil' => $user->id_kanwil,
                    'username'  => $user->username,
                    'role'      => $user->role,
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($data);
                redirect('/');
            } else {
                // user ada tapi status tidak aktif
                $this->session->set_flashdata('error', 'Akun Anda tidak aktif. Hubungi Admin.');
                redirect('login');
            }
        } else {
            // user / password salah
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
