<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_username($username)
    {
        $query = $this->db->get_where('auth', ['username' => $username], 1);
        return $query->row();
    }
}
