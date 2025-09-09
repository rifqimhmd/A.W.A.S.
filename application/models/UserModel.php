<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function get_kanwil()
    {
        return $this->db->get('tbl_kanwil')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_user', $data);
    }

    // hanya tampilkan kanwil yg belum punya akun role=kanwil
    public function get_available_kanwil()
    {
        $this->db->select('k.id_kanwil, k.nama_kanwil');
        $this->db->from('tbl_kanwil k');
        $this->db->join('tbl_user u', 'u.id_kanwil = k.id_kanwil AND u.role="kanwil"', 'left');
        $this->db->where('u.id_kanwil IS NULL');
        return $this->db->get()->result();
    }

    // tampilkan UPT sesuai kanwil yg dipilih, tapi exclude yg sudah punya akun role=upt
    public function get_available_upt($id_kanwil)
    {
        $this->db->select('u.id_upt, u.nama_upt');
        $this->db->from('tbl_upt u');
        $this->db->join('tbl_user usr', 'usr.id_upt = u.id_upt AND usr.role="upt"', 'left');
        $this->db->where('u.id_kanwil', $id_kanwil);
        $this->db->where('usr.id_upt IS NULL');
        return $this->db->get()->result();
    }
}
