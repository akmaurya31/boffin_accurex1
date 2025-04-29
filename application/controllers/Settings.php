<?php

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('user_lib','auth','form_validation'));
        if(!$this->session->userdata('loggedValue')){
            session_destroy();
            $this->session->set_flashdata('error','Login Error. Please Login again.');
            redirect('Login');
        }
    }

    public function index()
    {
        $data['page']       = "Settings";
        $data['success']    = $this->session->flashdata('success');
        $this->load->view('index',$data);
    }

    public function change_password()
    {
        $current        = $this->input->post('current');
        $current_conf   = $this->input->post('current_conf');
        $new            = $this->input->post('new');
        $new_conf       = $this->input->post('new_conf');



        $this->form_validation->set_rules('current', 'Password', 'required');
        $this->form_validation->set_rules('current_conf', 'Confirm Password', 'required|matches[current]');

        $this->form_validation->set_rules('new', 'New Password', 'required');
        $this->form_validation->set_rules('new_conf', 'Confirm New Password', 'required|matches[new]');

        if ($this->form_validation->run() == FALSE)
        {
            $data['page'] = "Settings";
            $this->load->view('index',$data);
        }
        else
        {
            $auth_ID = $this->session->userdata('auth_ID');
            $user_ID = $this->session->userdata('user_ID');

            // checking the old password is corect or not
            $getOldPassword = $this->user_lib->getUserInfoByAuthID($auth_ID);
            $pass_key       = $getOldPassword[0]->pass_key;
            if($pass_key == $current){
                // Checking for new Password is matched with current password or not
                if($new == $pass_key){
                    $data['page']  = "Settings";
                    $data['error'] = 'New Password and current password could not be same. Please enter diffrent password to continue change your password.';
                    $this->load->view('index',$data);
                }else{
                    $authArry = array(
                        'password' => sha1($new)
                    );
                    $where1 = array(
                        'auth_ID' => $auth_ID
                    );

                    $users_key_db_arr = array(
                        'pass_key' => $new
                    );
                    $where2 = array(
                        'user_ID' => $auth_ID
                    );


                    $this->db->trans_start();
                        $this->auth->update_row('auth',$authArry,$where1);
                        $this->auth->update_row('users_key_db',$users_key_db_arr,$where2);
                    $this->db->trans_complete();

                    $this->session->set_flashdata('success','Password changed successfully.');
                    redirect('Settings');
                }
            }else{
                $data['page']  = "Settings";
                $data['error'] = 'Current password you enter is not match with profile password. Please enter your profile Password in Current Password.';
                $this->load->view('index',$data);
            }
        }
    }

}