<?php
class RecievedClientsJob extends CI_Controller {

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

            $this->load->model('RecievedClient_model');

            $this->load->library('form_validation');
            $this->load->library('pagination');
        }
    }

    // public function index() {
    //     $data['section']        = 'live_job';
    //     $data['page']           = 'Jobs/List';
        
    //     $config['base_url'] = 'http://example.com/index.php/test/page/';
    //     $config['total_rows'] = 200;
    //     $config['per_page'] = 20;
        
    //     $query = $this->db->select("*")
    //                     ->from('joblist')
    //                     ->where('status',1)
    //                     ->get();
    //     $new = $query->result();
        
    //     $this->pagination->initialize($config);
        
        
    //     $this->load->view('index', $data);
    // }
    
    public function index() {
        $data['section'] = 'draft';
        $data['page'] = 'Jobs/List';
    
        $config['base_url'] = base_url('test/page');
        $config['total_rows'] = $this->db->where('status', 1)->count_all_results('joblist');
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $query = $this->db->select("*")
                          ->from('joblist')
                          ->where('status', 1)
                          ->limit($config['per_page'], $page)
                          ->get();
    
        $data['new'] = $query->result();

        $query = $this->db->query("SELECT * FROM users WHERE role_ID = 4");
        $result = $query->result();
        $data['userlist'] = $query->result();
        $data['uri2']=$this->uri->segment(2);

        $sessionData = (object)$this->session->userdata();
        $data['RecievedClientsJob_page']=$sessionData->RecievedClientsJob_page;
        $this->load->view('index', $data);
    }

    
    public function live_job(){
        $data['section'] = 'live_job';
        $data['page'] = 'Jobs/List';
    
        $config['base_url'] = base_url('test/page');
        $config['total_rows'] = $this->db->where('status', 1)->count_all_results('joblist');
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
    
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        $query = $this->db->select("*")
                          ->from('joblist')
                          ->where('status', 1)
                          ->limit($config['per_page'], $page)
                          ->get();
    
        $data['new'] = $query->result();
    
        $this->load->view('index', $data);
    }
    
    public function hold_job(){
         $data['section']        = 'on_hold';
        $data['page']           = 'Jobs/List';
        $this->load->view('index', $data);
    }
    
    public function completed_job(){
         $data['section']        = 'completed';
        $data['page']           = 'Jobs/List';
        $this->load->view('index', $data);
    }
    
    public function draft_job(){
        $data['section']        = 'draft';
        $data['page']           = 'Jobs/List';
        $this->load->view('index', $data);
    }
    
    public function view_history(){
        $data['page']           = 'Jobs/History';
        $this->load->view('index', $data);
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
        $jobs = $this->RecievedClient_model->extra_get_filtered_jobs($limit, $offset, $filters, $total);
        
        foreach ($jobs as &$job) {
            $job['job_name'] = generate_job_title_from_code($job['jobcode']);
            $status_details = get_job_status_details($job['status']);
            $job['status_name'] = $status_details['status']; // Store the status
            $job['sub_status'] = $status_details['sub_status']; // Store the sub-status
            $job['badge_color'] = $status_details['badge_color']; // Store the badge color   
            $job['employee'] = get_assigned_job_by_jobid($job['id'])->full_name; // Store the badge color   
        }
        
        echo json_encode([
            'jobs' => $jobs,
            'total' => $total,
            'limit' => $limit,
            'page' => $page
        ]);
    }


    public function assignuseronjob() {
    $jid = $this->input->post('jid');
    $jobcode = $this->input->post('jobcode');
    $user = $this->input->post('user');
    $comments = $this->input->post('comments');

    // Save logic here — for example:
    $data = [
        'job_id' => $jid,
        'job_code' => $jobcode,
        'assigned_user_id' => $user,
        'comments' => $comments,
        'assigned_date' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('assigned_jobs', $data); // Change table as needed

    echo json_encode(['status' => true, 'message' => 'User assigned successfully']);
}


     public function clientJobHistories($jobcode = null)
     {
        $sessionData = $this->session->userdata('accurexClientLoginDetails'); 
        $user_id = $sessionData->user_ID;

        $data['page'] = 'Jobs/Listhis';
        // Job basic info
        $data['job'] = $this->Client_model->findJobByCode($jobcode);
        // Job Query List
        $data['job_query'] = $this->db->where('jobcode', $jobcode)
                                    ->where('where_from', 'send_query')
                                    ->get('job_query')
                                    ->result();
        // Job Notifications
        $data['job_notifications'] = $this->db->where('jobcode', $jobcode)
                                            ->get('job_notifications')
                                            ->result();
        // Job Attachments
        $data['job_attachments'] = $this->db->where('job_code', $jobcode)
                                            ->where('where_from', 'send_query')
                                            ->get('job_attachments')
                                            ->result();
        // $this->load->view('Client_portal/clientJobHistories', $data);
        $this->load->view('index', $data);
     }
    
}