<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminEmpNotify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NotifyClient_model'); // ✅ Load the model once in constructor
    }
    
    public function index(){
        $data['section']        = 'on_hold';
        $data['page']           = 'Adminv/Notify';
        $data['uri2']=$this->uri->segment(2);
        //print_r($data['uri2']); die("ASdf");
        $this->load->view('index',$data);
    }

    public function fetch_paginated_jobs() 
    {
        $limit = $this->input->get('limit') ?? 20;
        $page = $this->input->get('page') ?? 1;
        $offset = ($page - 1) * $limit;
        
        $search_code = $this->input->get('search0') ?? '';
        $search_name = $this->input->get('search1') ?? '';
        $status_label = $this->input->get('status');

        $this->session->set_userdata(
                array(
                    'RecievedClientsJob_tabs'   => $status_label,
                    'RecievedClientsJob_page'   => $page
                )
            );

        $status_map = [
            'live' => 1,
            'hold' => 2,
            'draft' => 3,
            'completed' => 4
        ];

        $status = isset($status_map[$status_label]) ? $status_map[$status_label] : '5';

        $filters = [
            'search_code' => $search_code,
            'search_name' => $search_name,
            'status' => $status
        ];

        $total = 0;
        $jobs = $this->NotifyClient_model->extra_get_filtered_jobs($limit, $offset, $filters, $total);
        
        foreach ($jobs as &$job) {
            $job['job_name'] = generate_job_title_from_code($job['jobcode']);
            $emp_status_details = get_job_status_details($job['n_status']);
            $job['emp_status_name'] = $emp_status_details['status'] ?? '';
            $job['employee'] = get_assigned_employee($job['emp_id'])->full_name; // Store the badge color   
        }
        
        echo json_encode([
            'jobs' => $jobs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }
    
    
    
}