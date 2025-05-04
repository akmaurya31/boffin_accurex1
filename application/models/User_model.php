<?php

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('loggedValue')){
            session_destroy();
            $this->session->set_flashdata('error','Login Error. Please Login again.');
            redirect('Login');
        }
    }

    public function insert_user($data) {
        var_dump($data);
        die();
        $this->db->insert('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => sha1($data['password']),
            'role_id' => $data['role_id']
        ]);
        return $this->db->insert_id();
    }

    public function assign_user_permissions($userId, $permissions) {
        foreach ($permissions as $permissionId) {
            $this->db->insert('user_permissions', [
                'user_id' => $userId,
                'permission_id' => $permissionId
            ]);
        }
    }
}
