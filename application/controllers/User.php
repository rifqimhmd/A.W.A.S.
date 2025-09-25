<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class User
 *
 * @property UserModel     $UserModel
 * @property CI_Input      $input
 * @property CI_Session    $session
 * @property CI_Loader     $load
 * @property CI_DB_query_builder $db
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->helper('url');
        $this->load->helper('string');

        // hanya admin & kanwil yang boleh masuk
        if ($this->session->userdata('role') !== 'admin' && $this->session->userdata('role') !== 'kanwil') {
            show_error('Anda tidak memiliki akses ke halaman ini', 403);
        }
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        $id_kanwil_login = $this->session->userdata('id_kanwil');
        $search = $this->input->get('search', true); // ambil parameter pencarian

        if ($role === 'admin') {
            $data['users'] = $this->UserModel->get_all_users($search);
        } elseif ($role === 'kanwil') {
            $data['users'] = $this->UserModel->get_users_by_kanwil($id_kanwil_login, $search);
        }

        $data['kanwil']     = $this->UserModel->get_available_kanwil();
        $data['all_kanwil'] = $this->UserModel->get_kanwil();
        $data['title'] = "A.W.A.S. - Manajemen User";
        $data['page']       = 'front/pages/akses/user';
        $this->load->view('front/layouts/main', $data);
    }

    public function store()
    {
        $role = $this->input->post('role');
        $id_kanwil = NULL;
        $id_upt = NULL;

        if ($role === 'kanwil') {
            $id_kanwil = $this->input->post('id_kanwil');

            $available = $this->UserModel->get_available_kanwil();
            $allowed = array_column($available, 'id_kanwil');
            if (!in_array($id_kanwil, $allowed)) {
                show_error('Kanwil sudah memiliki akun atau tidak valid.', 400);
            }
        } elseif ($role === 'upt') {
            $id_kanwil = $this->input->post('id_kanwil_upt');
            $id_upt    = $this->input->post('id_upt');

            $available = $this->UserModel->get_available_upt($id_kanwil);
            $allowed = array_column($available, 'id_upt');
            if (!in_array($id_upt, $allowed)) {
                show_error('UPT sudah memiliki akun atau tidak valid.', 400);
            }
        }

        $data = [
            'id_user'    => $this->uuid_v4(),
            'username'   => $this->input->post('username'),
            'password'   => md5($this->input->post('password')),
            'role'       => $role,
            'id_kanwil'  => $id_kanwil,
            'id_upt'     => $id_upt,
            'status'     => 'aktif',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->UserModel->insert($data);
        redirect('user');
    }

    public function update()
    {
        $id_user = $this->input->post('id_user');
        $password = $this->input->post('password');
        $status   = $this->input->post('status');

        $data = ['status' => $status];
        if (!empty($password)) {
            $data['password'] = md5($password);
        }

        $this->UserModel->update($id_user, $data);
        redirect('user');
    }

    public function delete($id_user)
    {
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Hanya admin yang bisa menghapus user', 403);
        }
        $this->UserModel->delete($id_user);
        redirect('user');
    }

    public function get_upt_by_kanwil($id_kanwil)
    {
        $upt = $this->UserModel->get_available_upt($id_kanwil);
        echo json_encode($upt);
    }

    private function uuid_v4()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
