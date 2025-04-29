<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('loggedValue')){
            session_destroy();
            $this->session->set_flashdata('error','Login Error. Please Login again.');
            redirect('Login');
        }
    }

    public function index()
    {
        $data['page'] = "Dashboard";
        $this->load->view('index',$data);
    }

    public function logout()
    {
        $this->auth->logout();
        redirect('login');
    }

}