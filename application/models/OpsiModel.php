<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OpsiModel extends CI_Model
{
    private $table = 'opsi';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id_opsi, $data)
    {
        return $this->db->where('id_opsi', $id_opsi)->update($this->table, $data);
    }

    public function delete($id_opsi)
    {
        return $this->db->where('id_opsi', $id_opsi)->delete($this->table);
    }
}
