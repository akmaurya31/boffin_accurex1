<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EmpNotify extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NotifyEmpClient_model'); // ✅ Load the model once in constructor
    }
    
    public function index(){
        $data['section']        = 'on_hold';
        $data['page']           = 'Adminv/EmpNotify';
        $data['uri2']=$this->uri->segment(2);
        $data['rs']=EmpNotify();
        $this->load->view('index',$data);
    }

    public function fetch_paginated_jobs() 
    {
        $sessionData = (object)$this->session->userdata();        
        $limit = $this->input->get('limit') ?? 20;
        $page = $this->input->get('page') ?? 1;
        $offset = ($page - 1) * $limit;

        $tabType = $this->input->get('tabType');
        $search_code = $this->input->get('search0') ?? '';
        $filters = [
            'tabType' => $tabType,
            'search_code'=>$search_code
        ];
        $total = 0;
        $jobs = $this->NotifyEmpClient_model->extra_get_filtered_jobs($limit, $offset, $filters, $total);
        foreach ($jobs as &$job) {
            $job['job_name'] = generate_job_title_from_code($job['jobcode']);
            $emp_status_details = get_job_status_details($job['n_status']);
            $job['emp_status_name'] = $emp_status_details['status'] ?? '';
            $job['clientName'] = get_userName($job['client_id'])->full_name ?? '';
            $job['job_query'] = get_job_query($job['job_query_id'])->comments ?? '';
            $job['job_attachments'] = get_job_attachments($job['job_query_id']);
            $job['employee'] = get_assigned_employee($job['emp_id'])->full_name ?? ''; // Store the badge color  
            $job['notifi_isread'] = ($job['is_read'] == 1) ? 'isread' : 'isunread'; 
        }
        echo json_encode([
            'jobs' => $jobs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }

    public function updateRead()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id)->update('emp_job_notifications', ['is_read' => 1]);
        echo json_encode(['status' => 'success']);
    }

    
public function load_notifications()
{
    // Dummy client ID (replace with session or actual client ID logic)
    //$client_id = 1;
    $sessionData = $this->session->userdata('accurexClientLoginDetails');
    $client_id = $sessionData->user_ID;

    // Get page number from query string (default is 1)
    $page = $this->input->get('page') ?? 1;
    $limit = 20;
    $offset = ($page - 1) * $limit;

    // Load the model
    $this->load->model('Notification_model');

    // Get total notifications count
    $total_notifications = $this->Notification_model->count_notifications_by_client($client_id);

    // Get paginated notifications
    $notifications = $this->Notification_model->get_notifications_by_client($client_id, $limit, $offset);

    $jobs=$notifications->notifications;
    // die("Asfa");


    foreach ($jobs as &$job) {
        $job->job_name = generate_job_title_from_code($job->jobcode);
        $status_details = get_job_status_details($job->n_status);
        $job->status_name = $status_details['status']; // Store the status
        $job->sub_status = $status_details['sub_status']; // Store the sub-status
        $job->badge_color = $status_details['badge_color']; // Store the badge color
        $job->notifi_isread = ($job->is_read == 1) ? 'isread' : 'isunread';
    }
    // Prepare data to return as JSON
    $data = [
        'jobs'=>(array)$jobs,
        'notifications' => $notifications,  // Array of notifications
        'pagination' => $this->generate_pagination($total_notifications, $page, $limit)  // Pagination links
    ];

    // Return JSON response
    echo json_encode($data);
}
}