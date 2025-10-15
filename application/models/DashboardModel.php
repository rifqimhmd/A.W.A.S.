<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Pivot data per Kanwil
    public function get_pivot_kanwil_warna()
    {
        $this->db->select("k.nama_kanwil,
            SUM(CASE WHEN a.warna_antisipasi = 'Merah' THEN 1 ELSE 0 END) AS Merah,
            SUM(CASE WHEN a.warna_antisipasi = 'Kuning' THEN 1 ELSE 0 END) AS Kuning,
            SUM(CASE WHEN a.warna_antisipasi = 'Hijau' THEN 1 ELSE 0 END) AS Hijau");
        $this->db->from('hasil h');
        $this->db->join('antisipasi a', 'h.id_antisipasi = a.id_antisipasi');
        $this->db->join('user u', 'h.id_user = u.id_user');
        $this->db->join('kanwil k', 'u.id_kanwil = k.id_kanwil');
        $this->db->group_by('k.nama_kanwil');

        $this->db->order_by('Merah', 'DESC');
        $this->db->order_by('Kuning', 'DESC');
        $this->db->order_by('Hijau', 'DESC');

        return $this->db->get()->result();
    }

    // Pivot data per UPT untuk kanwil tertentu
    public function get_pivot_upt_warna($id_kanwil)
    {
        $this->db->select("up.nama_upt,
            SUM(CASE WHEN a.warna_antisipasi = 'Merah' THEN 1 ELSE 0 END) AS Merah,
            SUM(CASE WHEN a.warna_antisipasi = 'Kuning' THEN 1 ELSE 0 END) AS Kuning,
            SUM(CASE WHEN a.warna_antisipasi = 'Hijau' THEN 1 ELSE 0 END) AS Hijau");
        $this->db->from('hasil h');
        $this->db->join('antisipasi a', 'h.id_antisipasi = a.id_antisipasi');
        $this->db->join('user u', 'h.id_user = u.id_user');
        $this->db->join('upt up', 'u.id_upt = up.id_upt');
        $this->db->where('u.id_kanwil', $id_kanwil);
        $this->db->group_by('up.nama_upt');

        $this->db->order_by('Merah', 'DESC');
        $this->db->order_by('Kuning', 'DESC');
        $this->db->order_by('Hijau', 'DESC');

        return $this->db->get()->result();
    }
}
