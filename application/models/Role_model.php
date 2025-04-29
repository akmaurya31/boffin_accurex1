<?php
class Role_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('loggedValue')){
            session_destroy();
            $this->session->set_flashdata('error','Login Error. Please Login again.');
            redirect('Login');
        }
    }

    public function get_all_roles() {
        return $this->db->get('roles')->result();
    }
}
