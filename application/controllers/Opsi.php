<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @property OpsiModel $opsiModel
 * @property CI_Input $input
 * @property CI_Session $session
 */

class Opsi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OpsiModel', 'opsiModel');
        $this->load->library('session');

        // cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    // halaman opsi
    public function index()
    {
        $role = $this->session->userdata('role');
        $data['role']         = $this->session->userdata('role');

        // Cek role
        if ($role === 'user') {
            redirect(base_url('/')); // user biasa diarahkan ke halaman utama
        }

        // Kalau admin, lanjutkan
        $data['opsi'] = $this->opsiModel->get_all();
        $data['role'] = $role;
        $data['page'] = 'front/pages/akses/opsi';
        $this->load->view('front/layouts/main', $data);
    }


    public function create_opsi()
    {
        $nama_opsi   = $this->input->post('nama_opsi', true);
        $id_kategori = $this->input->post('id_kategori', true);

        $data = [
            'nama_opsi'   => $nama_opsi,
            'id_kategori' => $id_kategori
        ];

        if ($this->opsiModel->insert($data)) {
            $this->session->set_flashdata('success', 'Opsi berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan opsi');
        }
        redirect('opsi/index');
    }

    public function update_opsi($id_opsi)
    {
        $nama_opsi   = $this->input->post('nama_opsi', true);
        $id_kategori = $this->input->post('id_kategori', true);

        $data = [
            'nama_opsi'   => $nama_opsi,
            'id_kategori' => $id_kategori
        ];

        if ($this->opsiModel->update($id_opsi, $data)) {
            $this->session->set_flashdata('success', 'Opsi berhasil diperbarui');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui opsi');
        }
        redirect('opsi/index');
    }

    public function delete_opsi($id_opsi)
    {
        if ($this->opsiModel->delete($id_opsi)) {
            $this->session->set_flashdata('success', 'Opsi berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus opsi');
        }
        redirect('opsi/index');
    }
}
