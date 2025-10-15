<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function check_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $user = $this->db->get('tbl_user')->row();

        if ($user) {
            return $user;
        }
        return false;
    }
}
