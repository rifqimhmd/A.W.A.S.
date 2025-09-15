<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    // Ambil semua user (kecuali pamintel admin)
    public function get_all_users($search = null)
    {
        $this->db->select('u.*, k.nama_kanwil, up.nama_upt');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_kanwil k', 'k.id_kanwil = u.id_kanwil', 'left');
        $this->db->join('tbl_upt up', 'up.id_upt = u.id_upt', 'left');
        $this->db->where('NOT (u.username = "pamintel" AND u.role = "admin")');

        if (!empty($search)) {
            $this->db->like('u.username', $search);
        }

        return $this->db->get()->result();
    }

    // Ambil user hanya untuk 1 kanwil tertentu
    public function get_users_by_kanwil($id_kanwil, $search = null)
    {
        $this->db->select('u.*, k.nama_kanwil, up.nama_upt');
        $this->db->from('tbl_user u');
        $this->db->join('tbl_kanwil k', 'k.id_kanwil = u.id_kanwil', 'left');
        $this->db->join('tbl_upt up', 'up.id_upt = u.id_upt', 'left');
        $this->db->where('u.id_kanwil', $id_kanwil);
        $this->db->where('NOT (u.username = "pamintel" AND u.role = "admin")');

        if (!empty($search)) {
            $this->db->like('u.username', $search);
        }

        return $this->db->get()->result();
    }

    public function get_kanwil()
    {
        return $this->db->get('tbl_kanwil')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('tbl_user', $data);
    }

    public function update($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('tbl_user', $data);
    }

    public function delete($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->delete('tbl_user');
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
