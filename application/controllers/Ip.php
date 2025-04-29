<?php
class Ip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('loggedValue')){
            session_destroy();
            $this->session->set_flashdata('error','Login Error. Please Login again.');
            redirect('Login');
        }else{
            $this->load->model('User_model');
            $this->load->model('Role_model');
            $this->load->model('Permission_model');
            $this->load->library('form_validation');
        }
    }

    public function index() {
        $data['users']          = $this->user_lib->get_all_users();
        $data['page']           = 'IPList/Create';
        $data['success']        = $this->session->flashdata('success');
        $data['error']          = $this->session->flashdata('error');
        $this->load->view('index', $data);
    }

    public function assign_ip(){
        $ip  = $this->input->post('ip');
        $id  = $this->input->post('user_ID');

        $array = [
            'ip_address'  => $ip,
            'user_ID'     => $id
        ];

        $save = $this->user_lib->saveUserData('user_ips',$array);

        if($save){
            $this->session->set_flashdata('success','IP assigned successfully');
        }else{
            $this->session->set_flashdata('error','Failed to assign IP. Try latter.');
        }
        redirect('ip-list');
    }

    public function delete_ip(){
        $user_id = $this->input->post('user_ID');

        $where   = array('user_id'=>$user_id);
        $del = $this->user_lib->deleteData('user_ips',$where);
        if($del){
            $this->session->set_flashdata('success','IP deleted successfully');
        }else{
            $this->session->set_flashdata('error','Failed to delete IP. Try latter.');
        }
        redirect('ip-list');
    }















}