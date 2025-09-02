<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property UserModel $userModel
 * @property CI_Input $input
 * @property CI_Session $session
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'userModel');
        $this->load->library('session');

        // cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        $data['role']         = $this->session->userdata('role');

        // Cek role
        if ($role === 'user') {
            redirect(base_url('/')); // kalo user biasa, alihkan
        }

        // kalau admin, lanjutkan
        $data['users'] = $this->userModel->get_all();
        $data['role']  = $role;
        $data['page']  = 'front/pages/akses/user';
        $this->load->view('front/layouts/main', $data);
    }

    public function create()
    {
        $nama_kanwil = $this->input->post('nama_kanwil', true);
        $username    = $this->input->post('username', true);
        $password    = $this->input->post('password', true);

        $data = [
            'nama_kanwil' => $nama_kanwil,
            'username'    => $username,
            'password'    => md5($password),
            'role'        => 'user'
        ];

        if ($this->userModel->insert($data)) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan user');
        }
        redirect('user/index');
    }

    public function update($id_user)
    {
        $nama_kanwil = $this->input->post('nama_kanwil', true);
        $username    = $this->input->post('username', true);
        $password    = $this->input->post('password', true);

        $data = [
            'nama_kanwil' => $nama_kanwil,
            'username'    => $username
        ];

        if (!empty($password)) {
            $data['password'] = md5($password);
        }

        if ($this->userModel->update($id_user, $data)) {
            $this->session->set_flashdata('success', 'User berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal update user');
        }
        redirect('user/index');
    }

    public function delete($id_user)
    {
        if ($this->userModel->delete($id_user)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal hapus user');
        }
        redirect('user/index');
    }
}
