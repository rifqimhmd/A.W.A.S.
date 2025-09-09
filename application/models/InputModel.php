<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputModel extends CI_Model
{
    // Ambil semua instrument
    public function getInstrument()
    {
        return $this->db->get('tbl_instrument')->result();
    }

    // Ambil kategori berdasarkan instrument
    public function getKategoriByInstrument($id_instrument)
    {
        return $this->db->get_where('tbl_skrining', ['id_instrument' => $id_instrument])->result();
    }

    // Ambil skrining berdasarkan kategori
    public function getSkriningByKategori($id_kategori)
    {
        return $this->db->get_where('tbl_skrining', ['id_kategori' => $id_kategori])->result();
    }

    // Ambil faktor berdasarkan instrument
    public function getFaktorByInstrument($id_instrument)
    {
        return $this->db->get_where('tbl_faktor', ['id_instrument' => $id_instrument])->result();
    }

    // Ambil faktor by id
    public function getFaktorById($id_faktor)
    {
        return $this->db->get_where('tbl_faktor', ['id_faktor' => $id_faktor])->row();
    }

    public function saveHasil($data)
    {
        return $this->db->insert('tbl_hasil', $data);
    }

    public function getHasilWithJoin()
    {
        $this->db->select('h.*, k.nama_kategori, a.nama_antisipasi');
        $this->db->from('tbl_hasil h');
        // $this->db->join('kategori k', 'h.id_kategori = k.id_kategori', 'left');
        $this->db->join('tbl_antisipasi a', 'h.id_antisipasi = a.id_antisipasi', 'left');
        return $this->db->order_by('h.id_hasil', 'DESC')->get()->result();
    }

    // Ambil nama UPT dari id_upt (session)
    public function getNamaUptById($id_upt)
    {
        $this->db->select('nama_upt');
        $this->db->from('tbl_upt');
        $this->db->where('id_upt', $id_upt);
        return $this->db->get()->row();
    }
}
