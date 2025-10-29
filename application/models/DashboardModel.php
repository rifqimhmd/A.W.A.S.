<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{
    public function getRekapHasilByInstrument()
    {
        $this->db->select('i.nama_instrument, a.warna_antisipasi, COUNT(h.id_hasil) AS total_hasil');
        $this->db->from('tbl_hasil h');
        $this->db->join('tbl_antisipasi a', 'a.id_antisipasi = h.id_antisipasi');
        $this->db->join('tbl_instrument i', 'i.id_instrument = a.id_instrument');
        $this->db->group_by(['i.nama_instrument', 'a.warna_antisipasi']);
        $this->db->order_by('i.nama_instrument', 'ASC');
        $this->db->order_by('a.warna_antisipasi', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getDetailByWarna($warna)
    {
        $this->db->select('
            h.id_hasil,
            h.nilai_akhir,
            i.nama_instrument,
            a.nama_antisipasi,
            a.warna_antisipasi,
            k.nama_kanwil,
            up.nama_upt,
            COALESCE(p.nip, n.no_register) AS identitas,
            CASE 
                WHEN p.nip IS NOT NULL THEN \'Pegawai\'
                WHEN n.no_register IS NOT NULL THEN \'Narapidana\'
                ELSE \'Tidak Diketahui\'
            END AS tipe_data
        ');
        $this->db->from('tbl_hasil h');
        $this->db->join('tbl_antisipasi a', 'a.id_antisipasi = h.id_antisipasi');
        $this->db->join('tbl_instrument i', 'i.id_instrument = a.id_instrument');
        $this->db->join('tbl_user u', 'u.id_user = h.id_user');
        $this->db->join('tbl_kanwil k', 'k.id_kanwil = u.id_kanwil');
        $this->db->join('tbl_upt up', 'up.id_upt = u.id_upt');

        // Relasi ke pegawai & narapidana (gunakan LEFT JOIN karena bisa salah satu)
        $this->db->join('tbl_pegawai p', 'p.nip = h.id_object', 'left');
        $this->db->join('tbl_narapidana n', 'n.no_register = h.id_object', 'left');
        $this->db->where('LOWER(a.warna_antisipasi)', strtolower($warna));
        $this->db->order_by('k.nama_kanwil ASC, i.nama_instrument ASC');
        $query = $this->db->get();
        if (!$query) {
            log_message('error', 'DB error: ' . $this->db->_error_message());
            return [];
        }
        return $query->result_array();
    }


    private function getRankingByInstrument($instrumentName)
    {
        $query = $this->db->query("
            SELECT 
                k.nama_kanwil,
                i.nama_instrument,
                SUM(CASE WHEN a.warna_antisipasi = 'merah' THEN 1 ELSE 0 END) AS total_merah,
                SUM(CASE WHEN a.warna_antisipasi = 'kuning' THEN 1 ELSE 0 END) AS total_kuning,
                SUM(CASE WHEN a.warna_antisipasi = 'hijau' THEN 1 ELSE 0 END) AS total_hijau,
                COUNT(h.id_hasil) AS total_data
            FROM tbl_hasil h
            JOIN tbl_antisipasi a ON a.id_antisipasi = h.id_antisipasi
            JOIN tbl_instrument i ON i.id_instrument = a.id_instrument
            JOIN tbl_user u ON u.id_user = h.id_user
            JOIN tbl_kanwil k ON k.id_kanwil = u.id_kanwil
            WHERE i.nama_instrument = ?
            GROUP BY k.id_kanwil, i.id_instrument
            ORDER BY total_merah DESC, total_kuning DESC, total_hijau DESC
        ", [$instrumentName]);

        return $query->result_array();
    }

    public function getRankingNarkotika()
    {
        return $this->getRankingByInstrument('Narkotika');
    }

    public function getRankingTeroris()
    {
        return $this->getRankingByInstrument('Teroris');
    }
}
