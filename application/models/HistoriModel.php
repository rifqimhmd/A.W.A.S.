<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoriModel extends CI_Model
{
    public function getAll($sort = 'h.created_at', $order = 'DESC')
    {
        $id_user   = $this->session->userdata('id_user');
        $role      = $this->session->userdata('role');
        $id_upt    = $this->session->userdata('id_upt');
        $id_kanwil = $this->session->userdata('id_kanwil');

        $this->db->select('h.nama_wbp, h.nilai_akhir, h.created_at, 
                       k.nama_kategori, 
                       a.nama_antisipasi, a.warna_antisipasi,
                       u.username, u.role, kl.nama_kanwil, up.nama_upt');
        $this->db->from('hasil h');
        $this->db->join('kategori k', 'h.id_kategori = k.id_kategori', 'left');
        $this->db->join('antisipasi a', 'h.id_antisipasi = a.id_antisipasi', 'left');
        $this->db->join('user u', 'h.id_user = u.id_user', 'left');
        $this->db->join('kanwil kl', 'u.id_kanwil = kl.id_kanwil', 'left');
        $this->db->join('upt up', 'u.id_upt = up.id_upt', 'left');

        if ($role == 'kanwil') {
            $this->db->where('u.id_kanwil', $id_kanwil);
        } elseif ($role == 'upt') {
            $this->db->where('u.id_upt', $id_upt);
        } elseif ($role != 'admin') {
            $this->db->where('h.id_user', $id_user);
        }

        $this->db->order_by($sort, $order);

        return $this->db->get()->result();
    }
}
