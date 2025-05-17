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
        $data['rs']=AdminNotify();
        $this->load->view('index',$data);
    }

    public function fetch_paginated_jobs() 
    {
        $limit = $this->input->get('limit') ?? 20;
        $page = $this->input->get('page') ?? 1;
        $offset = ($page - 1) * $limit;

        $tabType = $this->input->get('tabType');
        $filters = [
            'tabType' => $tabType
        ];
        $total = 0;
        $jobs = $this->NotifyClient_model->extra_get_filtered_jobs($limit, $offset, $filters, $total);
        foreach ($jobs as &$job) {
            $job['job_name'] = generate_job_title_from_code($job['jobcode']);
            $emp_status_details = get_job_status_details($job['n_status']);
            $job['emp_status_name'] = $emp_status_details['status'] ?? '';
            $job['clientName'] = get_userName($job['client_id'])->full_name ?? '';
            $job['job_query'] = get_job_query($job['job_query_id'])->comments ?? '';
            $job['job_attachments'] = get_job_attachments($job['job_query_id']);
            $job['employee'] = get_assigned_employee($job['emp_id'])->full_name ?? ''; // Store the badge color   
        }
        echo json_encode([
            'jobs' => $jobs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }
}