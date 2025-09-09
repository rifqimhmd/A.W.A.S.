<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OpsiModel extends CI_Model
{
    // ================= Skrining =================
    public function count_skrining()
    {
        return $this->db->count_all('tbl_skrining');
    }

    public function get_skrining_paginated($limit, $offset)
    {
        $this->db->select('s.*, i.nama_instrument');
        $this->db->from('tbl_skrining s');
        $this->db->join('tbl_instrument i', 'i.id_instrument = s.id_instrument', 'left');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function insert_skrining($data)
    {
        return $this->db->insert('tbl_skrining', $data);
    }

    public function update_skrining($id, $data)
    {
        $this->db->where('id_skrining', $id);
        return $this->db->update('tbl_skrining', $data);
    }

    public function delete_skrining($id)
    {
        $this->db->where('id_skrining', $id);
        return $this->db->delete('tbl_skrining');
    }

    // ================= Faktor =================
    public function count_faktor()
    {
        return $this->db->count_all('tbl_faktor');
    }

    public function get_faktor_paginated($limit, $offset)
    {
        $this->db->select('f.*, i.nama_instrument');
        $this->db->from('tbl_faktor f');
        $this->db->join('tbl_instrument i', 'i.id_instrument = f.id_instrument', 'left');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function insert_faktor($data)
    {
        return $this->db->insert('tbl_faktor', $data);
    }

    public function update_faktor($id, $data)
    {
        $this->db->where('id_faktor', $id);
        return $this->db->update('tbl_faktor', $data);
    }

    public function delete_faktor($id)
    {
        $this->db->where('id_faktor', $id);
        return $this->db->delete('tbl_faktor');
    }

    // ================= Instrument =================
    public function get_all_instrument()
    {
        return $this->db->get('tbl_instrument')->result();
    }

    public function get_instrument_id_by_name($name)
    {
        $this->db->where('nama_instrument', $name);
        $row = $this->db->get('tbl_instrument')->row();
        return $row ? $row->id_instrument : null;
    }
}
