<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    private $table = 'user';

    // ambil semua user
    public function get_all()
    {
        return $this->db->get('user')->result();
    }

    // tambah user baru
    public function insert($data)
    {
        return $this->db->insert('user', $data);
    }

    // update user
    public function update($id_user, $data)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data);
    }

    // hapus user
    public function delete($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->delete('user');
    }
}
