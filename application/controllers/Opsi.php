<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Class Opsi
 *
 * @property OpsiModel $OpsiModel
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Pagination $pagination
 * @property CI_Loader $load
 * @property CI_DB_query_builder $db
 */
class Opsi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OpsiModel');
        $this->load->library('pagination');
        $this->load->helper(['url', 'form', 'string']);

        // hanya admin yang boleh akses
        if ($this->session->userdata('role') !== 'admin') {
            show_error('Anda tidak memiliki akses ke halaman ini', 403);
        }
    }

    public function index()
    {
        $limit = $this->input->get('limit') ? (int)$this->input->get('limit') : 25;

        // ================== Skrining ==================
        $page_skrining = max(1, (int)$this->input->get('page_skrining', TRUE));
        $offset_skrining = ($page_skrining - 1) * $limit;

        $config_skrining = [
            'base_url' => site_url('opsi/index'),
            'total_rows' => $this->OpsiModel->count_skrining(),
            'per_page' => $limit,
            'page_query_string' => TRUE,
            'query_string_segment' => 'page_skrining',
            'reuse_query_string' => TRUE,
            'use_page_numbers' => TRUE,
            'cur_page' => $page_skrining,
            'full_tag_open' => '<div class="pagination flex space-x-2 mt-3">',
            'full_tag_close' => '</div>',
            'first_link' => '«',
            'last_link' => '»',
            'next_link' => '›',
            'prev_link' => '‹',
            'num_tag_open' => '<span class="px-3 py-1 bg-gray-200 rounded">',
            'num_tag_close' => '</span>',
            'cur_tag_open' => '<span class="px-3 py-1 bg-red-600 text-white rounded">',
            'cur_tag_close' => '</span>',
        ];

        $this->pagination->initialize($config_skrining);
        $data['skrining'] = $this->OpsiModel->get_skrining_paginated($limit, $offset_skrining);
        $data['pagination_skrining'] = $this->pagination->create_links();

        // ================== Faktor ==================
        $page_faktor = max(1, (int)$this->input->get('page_faktor', TRUE));
        $offset_faktor = ($page_faktor - 1) * $limit;

        $config_faktor = [
            'base_url' => site_url('opsi/index'),
            'total_rows' => $this->OpsiModel->count_faktor(),
            'per_page' => $limit,
            'page_query_string' => TRUE,
            'query_string_segment' => 'page_faktor',
            'reuse_query_string' => TRUE,
            'use_page_numbers' => TRUE,
            'cur_page' => $page_faktor,
            'full_tag_open' => '<div class="pagination flex space-x-2 mt-3">',
            'full_tag_close' => '</div>',
            'first_link' => '«',
            'last_link' => '»',
            'next_link' => '›',
            'prev_link' => '‹',
            'num_tag_open' => '<span class="px-3 py-1 bg-gray-200 rounded">',
            'num_tag_close' => '</span>',
            'cur_tag_open' => '<span class="px-3 py-1 bg-red-600 text-white rounded">',
            'cur_tag_close' => '</span>',
        ];

        // reset pagination sebelum initialize Faktor
        $this->pagination->initialize($config_faktor);
        $data['faktor'] = $this->OpsiModel->get_faktor_paginated($limit, $offset_faktor);
        $data['pagination_faktor'] = $this->pagination->create_links();

        // ================== Instruments ==================
        $data['instrument'] = $this->OpsiModel->get_all_instrument();
        $data['limit'] = $limit;
        $data['page'] = 'front/pages/akses/opsi';
        $this->load->view('front/layouts/main', $data);
    }

    // ================== STORE ==================
    public function store()
    {
        $opsi_type = $this->input->post('opsi_type');
        $created_at = date('Y-m-d H:i:s');

        if ($opsi_type == 'skrining') {
            $jenis = $this->input->post('jenis_skrining');
            $id_instrument = ($jenis == 'Pengguna' || $jenis == 'Pengedar' || $jenis == 'Pengendali')
                ? $this->OpsiModel->get_instrument_id_by_name('Narkotika')
                : $this->OpsiModel->get_instrument_id_by_name('Teroris');

            $data = [
                'id_skrining' => $this->uuid_v4(),
                'indikator_skrining' => $this->input->post('indikator_skrining'),
                'jenis_skrining' => $jenis,
                'id_instrument' => $id_instrument,
                'created_at' => $created_at
            ];
            $this->OpsiModel->insert_skrining($data);
            $this->session->set_flashdata('success', 'Data Skrining berhasil ditambahkan');
        } elseif ($opsi_type == 'faktor') {
            $data = [
                'id_faktor' => $this->uuid_v4(),
                'indikator_faktor' => $this->input->post('indikator_faktor'),
                'jenis_faktor' => $this->input->post('jenis_faktor'),
                'id_instrument' => $this->input->post('id_instrument'),
                'created_at' => $created_at
            ];
            $this->OpsiModel->insert_faktor($data);
            $this->session->set_flashdata('success', 'Data Faktor berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Pilihan opsi tidak valid');
        }
        redirect('opsi');
    }

    // ================== UPDATE & DELETE ==================
    public function update_skrining($id)
    {
        $jenis = $this->input->post('jenis_skrining');
        $id_instrument = ($jenis == 'Pengguna' || $jenis == 'Pengedar' || $jenis == 'Pengendali')
            ? $this->OpsiModel->get_instrument_id_by_name('Narkotika')
            : $this->OpsiModel->get_instrument_id_by_name('Teroris');

        $data = [
            'indikator_skrining' => $this->input->post('indikator_skrining'),
            'jenis_skrining' => $jenis,
            'id_instrument' => $id_instrument,
        ];
        $this->OpsiModel->update_skrining($id, $data);
        $this->session->set_flashdata('success', 'Data Skrining berhasil diperbarui');
        redirect('opsi');
    }

    public function update_faktor($id)
    {
        $data = [
            'indikator_faktor' => $this->input->post('indikator_faktor'),
            'jenis_faktor' => $this->input->post('jenis_faktor'),
            'id_instrument' => $this->input->post('id_instrument'),
        ];
        $this->OpsiModel->update_faktor($id, $data);
        $this->session->set_flashdata('success', 'Data Faktor berhasil diperbarui');
        redirect('opsi');
    }

    public function delete_skrining($id)
    {
        $this->OpsiModel->delete_skrining($id);
        $this->session->set_flashdata('success', 'Data Skrining berhasil dihapus');
        redirect('opsi');
    }

    public function delete_faktor($id)
    {
        $this->OpsiModel->delete_faktor($id);
        $this->session->set_flashdata('success', 'Data Faktor berhasil dihapus');
        redirect('opsi');
    }

    private function uuid_v4()
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
