<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Adminnotification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model'); // ✅ Load the model once in constructor
    }
    
    public function index(){
        $data['section']        = 'on_hold';
        $data['page']           = 'Adminv/Notify';
        $this->load->view('index',$data);
    }
    
    
    
}