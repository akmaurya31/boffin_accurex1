<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Clients extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
    
        // coding by uttam patel starting
        public function index()
        {
            $data['success'] = $this->session->flashdata('success');
            $data['error']   = $this->session->flashdata('error');
            $this->load->view('Client_portal/login',$data);
        }
        
        
    
        // public function dashboard()
        // {
        //     if($this->is_logged()){
        //         $limit = 20;
        //         $offset = 0;
            
        //         $data['jobs'] = $this->Client_model->get_filtered_jobs($limit, $offset);
        //         $data['total'] = $this->Client_model->count_filtered_jobs();
        //         $this->load->view('Client_portal/dashboard',$data);
        //     }else{
        //         $this->session->set_flashdata('error','Please login to continue.');
        //         redirect('Clients');
        //     }
        // }
        
        public function dashboard()
        {
            if($this->is_logged()){
                $limit = 20;
                $offset = 0;
            
                $data['jobs'] = $this->Client_model->get_filtered_jobs($limit, $offset);
                $data['total'] = $this->Client_model->count_filtered_jobs();

                // $data['cart'] = $this->Client_model->get_jobs_by_status();
                $data['chart'] = $this->Client_model->get_job_status_counts();
                //  print_r($data); die("ASdfa");
                 $currentYear = date('Y');
                $data['charti'] = $this->FetchBarChart($currentYear, false); 
               //  print_r($data['charti']);

                $this->load->view('Client_portal/dashboard',$data);
            }else{
                $this->session->set_flashdata('error','Please login to continue.');
                redirect('Clients');
            }
        }
        
        // Avinash
        public function ClientsAddNewJobs_POST() {
            // Get POST data
            $userDetails = $this->session->userdata('accurexClientLoginDetails'); 
            //var_dump($userDetails->user_ID); die();
            
            $user_id = $userDetails->user_ID; //$this->input->post('user_id');
            // $jobcode = 2002;//$this->input->post('jobcode');
            $assignment_type = $this->input->post('assignment_type');
            $client_name = $this->input->post('client_name');
            $contact_person = $this->input->post('contact_person');
            $email_address = $this->input->post('email_address');
            // $year_end = $this->input->post('year_end');
            $budgeted_hours = $this->input->post('budgeted_hours');
            $accountancy_fee_net = $this->input->post('accountancy_fee_net');
            $additional_comment = $this->input->post('additional_comment');

            $lastJobId = $this->Client_model->getLastJobId();
            $nextId = $lastJobId + 1;
        
            // Generate jobcode
            $currentYear = date('Y'); // 2025
            $letters=getsortname($userDetails->full_name);
            $jobcode = $letters. $currentYear . str_pad($nextId, 5, '0', STR_PAD_LEFT);

            $year_end = '';
            if ($assignment_type === 'year_end_account') {
                $year_end = $this->input->post('year_end');
            } elseif ($assignment_type === 'bookkeeping') {
                $year_end = $this->input->post('qtr_year_end');
            } elseif ($assignment_type === 'personal_tax_return') {
                $year_end = $this->input->post('tax_year_end');
            } else {
                $year_end = $this->input->post('year_end');
            }

            // Prepare the data array to insert into database
            $data = [
                'user_id' => $user_id,
                'jobcode' => $jobcode,
                'assignment_type' => $assignment_type,
                'client_name' => $client_name,
                'contact_person' => $contact_person,
                'email_address' => $email_address,
                'year_end' => $year_end,
                'budgeted_hours' => $budgeted_hours,
                'accountancy_fee_net' => $accountancy_fee_net,
                'additional_comment' => $additional_comment,
                'status' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
    
            // Insert data into the database using the model function
            $inserted = $this->Client_model->insert_job($data);
    
            // Prepare the JSON response
            if ($inserted) {
                // Success response

                $employment_data = [];

                if ($assignment_type === 'year_end_account') {
                    $employment_data = $this->prepare_employment_data('yea_employment', 17, $jobcode);
                }

                if ($assignment_type === 'bookkeeping') {
                    $employment_data = $this->prepare_employment_data('book_employment', 13, $jobcode);
                }

                if ($assignment_type === 'personal_tax_return') {
                    $employment_data = $this->prepare_employment_data('ptr_employment', 14, $jobcode);
                }
                
                if (!empty($employment_data)) {
                    $this->Client_model->insert_job_checklist_bulk($employment_data);
                }

                // 2. Upload Attachments
                $this->upload_attachments($jobcode); // this saves files to job_attachments table
                 
                $noti_data=array();
                $noti_data['client_id']=$user_id;	
                $noti_data['jobcode']=$jobcode;
                $noti_data['n_status']=3;	
                $noti_data['message']="New Job";
                $noti_data['is_read']=0;
                add_notification($noti_data);

                $response = [
                    'status' => 'success',
                    'message' => 'Thank you! Your form has been successfully submitted.'
                ];
            } else {
                // Failure response
                $response = [
                    'status' => 'error',
                    'message' => 'There was an issue with submitting your form. Please try again.'
                ];
            }
    
            // Send JSON response
            echo json_encode($response);
        }
        
        private function prepare_employment_data($type_prefix, $total, $jobcode) {
            $data = [];
        
            for ($i = 1; $i <= $total; $i++) {
                $checkbox = $this->input->post("{$type_prefix}_$i");
                $comment = $this->input->post("{$type_prefix}_text_$i");
        
                if ($checkbox === "on" || !empty($comment)) {
                    $data[] = [
                        'jobcode' => $jobcode,
                        'checklist_id' => "{$type_prefix}_$i",
                        'checklist_comment' => $comment,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
            }
        
            return $data;
        }
        
        public function upload_attachments($job_code)
        {
            // $job_code = $this->input->post('job_code');
            $files = $_FILES;
            $count = count($_FILES['attachments']['name']);
            $total_size = 0;

            $upload_path = './uploads/job_attachments/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $uploaded_files = [];

            for ($i = 0; $i < $count; $i++) {
                if (!empty($files['attachments']['name'][$i])) {
                    $file_size = $files['attachments']['size'][$i];
                    $total_size += $file_size;

                    if ($file_size > 2 * 1024 * 1024) {
                        // echo "File " . $files['attachments']['name'][$i] . " exceeds 2MB size limit.";
                        return;
                    }

                    $config['upload_path'] = $upload_path;
                    $config['allowed_types'] = 'jpg|jpeg|png|webp|pdf|doc|docx|xls|xlsx';
                    $config['max_size'] = 2048; // KB
                    $config['file_name'] = time() . '_' . $files['attachments']['name'][$i];

                    $this->load->library('upload', $config);
                    $_FILES['attachment']['name'] = $files['attachments']['name'][$i];
                    $_FILES['attachment']['type'] = $files['attachments']['type'][$i];
                    $_FILES['attachment']['tmp_name'] = $files['attachments']['tmp_name'][$i];
                    $_FILES['attachment']['error'] = $files['attachments']['error'][$i];
                    $_FILES['attachment']['size'] = $files['attachments']['size'][$i];

                    if (!$this->upload->do_upload('attachment')) {
                        // echo $this->upload->display_errors();
                        return;
                    } else {
                        $data = $this->upload->data();
                        $uploaded_files[] = [
                            'job_code' => $job_code,
                            'file_path' => 'uploads/job_attachments/' . $data['file_name'],
                            'file_size' =>  $file_size
                        ];
                    }
                }
            }

            if ($total_size > 50 * 1024 * 1024) {
                // echo "Total upload exceeds 50MB.";
                return;
            }

            // Insert to DB
            if (!empty($uploaded_files)) {
                $this->load->model('Client_model');
                $this->Client_model->insert_job_attachments($uploaded_files);
                // echo "Files uploaded successfully.";
            } else {
                // echo "No files uploaded.";
            }
        }
        
        public function fetch_paginated_jobs2() {
            $limit = $this->input->get('limit') ?? 20;
            $page = $this->input->get('page') ?? 1;
            $search = $this->input->get('search') ?? '';

            $offset = ($page - 1) * $limit;

            $jobs = $this->Client_model->get_filtered_jobs($limit, $offset, $search);
            $total = $this->Client_model->count_filtered_jobs($search);

            echo json_encode([
                'jobs' => $jobs,
                'total' => $total
            ]);
        }
        
        public function fetch_paginated_jobs() 
        {
            $limit = $this->input->get('limit') ?? 20;
            $page = $this->input->get('page') ?? 1;
            $offset = ($page - 1) * $limit;
           
            $search_code = $this->input->get('search0') ?? '';
            $search_name = $this->input->get('search1') ?? '';
            $status_label = $this->input->get('status');

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
            $jobs = $this->Client_model->extra_get_filtered_jobs($limit, $offset, $filters, $total);

            // print_r($jobs);
            // die("ASdfa");
        

            // foreach ($jobs as &$job) {
            //     // print_r($job); die("ASdfas");
            //     $job->job_name = $this->generate_job_title(
            //         $job->client_name,
            //         $job->assignment_type,
            //         $job->created_at
            //     );
            // }

            foreach ($jobs as &$job) {
                $job['job_name'] = $this->generate_job_title(
                    $job['client_name'],
                    $job['assignment_type'],
                    $job['year_end'],
                    $job['created_at']
                );
                $status_details = get_job_status_details($job['status']);
                $job['status_name'] = $status_details['status']; // Store the status
                $job['sub_status'] = $status_details['sub_status']; // Store the sub-status
                $job['badge_color'] = $status_details['badge_color']; // Store the badge color        
            }
          
            echo json_encode([
                'jobs' => $jobs,
                'total' => $total,
                'limit' => $limit,
                'page' => $page
            ]);
        }
        
        public function fetch_completed_jobs_today() {
            $limit = $this->input->get('limit') ?? 20;
            $page = $this->input->get('page') ?? 1;
            $job_code = $this->input->get('job_code') ?? '';
            $job_name = $this->input->get('job_name') ?? '';
        
            $offset = ($page - 1) * $limit;
        
            $jobs = $this->Client_model->get_today_completed_jobs($limit, $offset, $job_code, $job_name);
            $total = $this->Client_model->count_today_completed_jobs($job_code, $job_name);


            foreach ($jobs as &$job) {
                // print_r($job); die("ASdfas");
                $job->job_name = $this->generate_job_title(
                    $job->client_name,
                    $job->assignment_type,
                    $job->year_end,
                    $job->created_at
                );

                // $job['job_name'] = $this->generate_job_title(
                //     $job['client_name'],
                //     $job['assignment_type'],
                //     $job['created_at']
                // );

                
            }

        
            echo json_encode([
                'jobs' => $jobs,
                'total' => $total
            ]);
        }
        private function generate_job_title($client_name, $assignment_type,$year_end,$created_date) {
            $short_type = strtoupper(substr($assignment_type, 0, 3));
            if ($short_type === 'BOO') {
                $final_type     = 'VAT';
                // 31-07-<year_end>
                $formatted_date = '31-07-' . $year_end;
            } elseif ($short_type === 'PER') {
                $final_type     = 'PTR';
                // 05-04-<year_end>
                $formatted_date = '05-04-' . $year_end;
            } elseif ($short_type === 'YEA') {
                $final_type     = 'YE';
                // just the year (or you could build a full date if you prefer)
                $formatted_date = $year_end;
            } else {
                $final_type     = 'OTH';
                $formatted_date = date('d-m-Y', strtotime($created_date));
            }
            $FirstNameLastName="RS";
            return "{$client_name}-{$final_type}-{$formatted_date}($FirstNameLastName)";
        }
        
        
        public function ClientForgetPassword()
        {
            $this->load->view('Client_portal/ClientForgetPassword',$data);
        }
    
        public function ClientsSetNewPassword()
        {
            $username = $this->input->post('username');
            // Check for userDetail
            $check = $this->user_lib->checkForFrogetPasswordClient($username);
            if(!empty($check)){
                 if($check[0]->status == '0'){
                     $data = 
                        array(
                            'user_ID'   => $check[0]->user_ID,
                            'auth_ID'   => $check[0]->auth_ID
                        );
                    
                    
                    $this->load->view('Client_portal/ClientsSetNewPassword',$data);
                 }else{
                    $this->session->set_flashdata('error','Your account is suspended by site admin. Please contact to site admin.');
                    redirect('Clients');
                 }
            }else{
                $this->session->set_flashdata('error','Username not matched. Please enter valid Username.');
                redirect('Clients');
            }
        }
        
        public function OTPVerification()
        {
            $data['success'] = $this->session->flashdata('success');
            $data['error']   = $this->session->flashdata('error');
            $this->load->view('Client_portal/ClientsOTPVerification',$data);
        }
        
        public function ClientsAddNewJobs()
        {
            
            if($this->is_logged()){
                $this->load->view('Client_portal/ClientsAddNewJobs',$data);
            }else{
                $this->session->set_flashdata('error','Please login to continue.');
                redirect('Clients');
            }
        }
        public function ClientsJobsList()
        {
            if($this->is_logged()){
                $this->load->view('Client_portal/ClientsJobsList',$data);
            }else{
                $this->session->set_flashdata('error','Please login to continue.');
                redirect('Clients');
            }
        }
        
        public function ClientsNotification()
        {
            if($this->is_logged()){
                $this->load->view('Client_portal/ClientsNotification',$data);
            }else{
                $this->session->set_flashdata('error','Please login to continue.');
                redirect('Clients');
            }
            
        }
        
        public function clientProfileInformation()
        {
            // Step 1: Get session data
            $sessionData = $this->session->userdata('accurexClientLoginDetails');
        
            // Step 2: Check login
            if (!$this->is_logged() || empty($sessionData)) {
                $this->session->set_flashdata('error', 'Please login to continue.');
                redirect('Clients');
                return;
            }
        
            // Step 3: Fetch fresh user details directly from DB
            $userID = $sessionData->user_ID;
        
            $query = $this->db->get_where('users', ['user_ID' => $userID]);

            $data['userDtls'] = $query->row(); // returns object

            // Step 4: Load view
            $this->load->view('Client_portal/clientProfileInformation', $data);
        }
        
        
        
        /* Code Introduced By Rohit Mishra on 26APR2025 AT 09:30 PM */
        
        
        public function ClientsOTPVerification(){
            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));
       
            // Check for client login 
            $check = $this->user_lib->checkClientLogin($username,$password);
            if(!empty($check)){
                
                if($check[0]->status == '0'){
                    // Sent OTP For Two-way Factor Authentication
                    $otp = $this->auth->generateOTP(6);
                    
                    // store otp in database to related user
                    $updateArr  = array('otp' => $otp, 'otp_time' => strtotime('+30 minutes'));
                    $updateAuth = $this->auth->update_row('auth',$updateArr,array('user_ID'=>$check[0]->user_ID));
        
                    if($updateAuth){
                        // sent OTP To Email
                        $data['otp']        = $otp;
                        $data['username']   = $username;
                        $data['subject']    = 'Login ';
                        $subject            = 'Login OTP For '.$username;
                        $message            = $this->load->view('components/login_otp',$data,true);
                        $sentEmail          = $this->sentMailToClient($username,$subject,$message);
                        
                        if($sentEmail){
                            // Setting the session variables
                            $this->session->set_userdata(
                                array(
                                    'user_ID'   => $check[0]->user_ID,
                                    'auth_ID'   => $check[0]->auth_ID
                                )
                            );
                            $this->session->set_flashdata('success','OTP sent to "<b>'.$check[0]->email.'</b>".');
                            redirect('Clients/OTPVerification');
                        }else{
                            $this->session->set_flashdata('error','Failed to sent OTP to "<b>'.$check[0]->email.'</b>". Please try Later.');
                            redirect('Clients');
                        }
                    }else{
                        $this->session->set_flashdata('error','Failed to sent OTP to "<b>'.$check[0]->email.'</b>". Please try Later.');
                        redirect('Clients');
                    }
                }else{
                    $this->session->set_flashdata('error','Dear <b>'.$check[0]->email.'</b>, You dont have permission to login this portal. Please contact to Admin.');
                    redirect('Clients');
                }
            }else{
                $this->session->set_flashdata('error','Username or Password not matched. Please enter valid Username or Password.');
                redirect('Clients');
                
            }
            
        }
        
        
        public function verifyEnterOTP(){
            $otp        = $this->input->post('otp');
            $auth_ID    = $this->input->post('auth_ID');
            // checking fo enter otp is matched or not
            $checkOtp = $this->user_lib->checkEnteredOTP($otp,$auth_ID);
            
            if(!empty($checkOtp)){
                $this->session->set_userdata('accurexClientLoginDetails',$checkOtp[0]);
                $this->session->set_flashdata('error','Username or Password not matched. Please enter valid Username or Password.');
                redirect('Clients/dashboard');
            }else{
                $this->session->set_flashdata('error','Username or Password not matched. Please enter valid Username or Password.');
                redirect('Clients/OTPVerification');
            }
        }
        
        
        
        
        
        
        
    public function sentMailToClient($to,$subject,$message){
        $this->load->library('email');
        $config = array(
            'protocol'      => 'smtp',
            'smtp_host'     => 'smtp.hostinger.com',
            'smtp_port'     => 465,
            'smtp_user'     => 'support@boffinwebproject.site',
            'smtp_pass'     => 'Durga#671$',
            'mailtype'      => 'html',
            'charset'       => 'utf-8',
            'newline'       => "\r\n",
            'smtp_crypto'   => 'ssl',
            'crlf'          => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('support@boffinwebproject.site', 'Accurex Accounting');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            return false;
        }
    }
    
    
    public function clientNewPasswordSave(){
        $auth_ID    = $this->input->post('auth_ID');
        $user_ID    = $this->input->post('user_ID');
        $password   = $this->input->post('password');
        
        // Set Neew Password To auth table and update the user_key_db tbl 
        $authArray = array(
                'password' => sha1($password)
            );
            
        $key_db_array = array(
                'pass_key'  => $password
            );
            
        $this->db->trans_start();
            $this->db->set($authArray)->where(array('auth_ID' => $auth_ID))->update('auth');
            $this->db->set($key_db_array)->where(array('user_ID' => $user_ID))->update('users_key_db');
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Failed to set New Password. Try later');
        }else{
            $this->session->set_flashdata('success','Password is changed. Now Loggin with you changed password.');
        }
        redirect('Clients');
    }
    
    
    public function logout_client(){
        session_destroy();
        $this->session->set_flashdata('success','Logout success.');
        redirect('Clients');
    }
    
    public function is_logged(){
        if(($this->session->userdata('accurexClientLoginDetails'))){
            return true;
        }else{
            return false;
        }
    }
    
    // Avinash
    public function get_job_details()
    {
        $jobcode = $this->input->get('jobcode');

        // Basic validation
        if (empty($jobcode)) {
            echo json_encode(['status' => 'error', 'message' => 'Jobcode missing']);
            return;
        }

        // joblist table -> single record
        $job = $this->db->where('jobcode', $jobcode)->get('joblist')->row_array();

        // job_checklist table -> multiple records
        $checklist = $this->db->where('jobcode', $jobcode)->get('job_checklist')->result_array();

        // job_attachments table -> multiple records
        $attachments = $this->db->where('job_code', $jobcode)->get('job_attachments')->result_array();

        // Fetch all checklists using the helper function
        $checklists = getAllChecklists();

        $filteredChecklists = array_filter($checklists, function($checklist) use ($job) {
            return $checklist['assignment_type'] == $job['assignment_type'];
        });
     
        // Final output
        $response = [
            'job' => $job,
            'checklist' => $checklist,
            'checklists' => $filteredChecklists,
            'attachments' => $attachments
        ];
        echo json_encode($response);
    }
    
    public function jobCommentForm()
    {
        $comments = $this->input->post('kcomments'); // Array of comments
        $job_code = $this->input->post('kjobcode');
        
        if ($comments) {
            // Insert the comment into the database
            $this->db->insert('job_query', [
                'comments' => $comments,
                'jobcode' => $job_code
            ]);
            
            // Set a flash message for success
            $this->session->set_flashdata('success_message', 'Form submitted successfully!');
        }

        // Upload attachments
        $this->upload_attachments($job_code);

        // Load the view
        $this->load->view('Client_portal/ClientsJobsList', $data);
    }
    
        public function FetchBarChart($year = null, $asJson = true)
        {
            $this->load->model('Client_model');
        
            // Default year if not provided
            $year = $year ?? date('Y');
        
            // Get data from model
            $chartData = $this->Client_model->get_monthly_job_summary($year);
        
            // Return JSON if requested via AJAX
            if ($asJson && $this->input->is_ajax_request()) {
                header('Content-Type: application/json');
                echo json_encode($chartData);
                return;
            }
        
            // Else, return data to be used in controller/view
            return $chartData;
        }



        public function FetchBarCharti($year = null)
        {
            $this->load->model('Client_model');
        
            // Use the provided year or default to the current year
            $year = $year ?? date('Y');
        
            // Fetch chart data for the specified year
            
            $chartData = $this->Client_model->get_monthly_job_summary($year);
            
            // Return the data as JSON
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($chartData));
        }
        
        // coding by team 
      public function clientJobHistories($jobcode = null)
     {
        $sessionData = $this->session->userdata('accurexClientLoginDetails'); 
        $user_id = $sessionData->user_ID;
        // Job basic info
        $data['job'] = $this->Client_model->findJobByCode($jobcode);
        // Job Query List
        $data['job_query'] = $this->db->where('jobcode', $jobcode)
                                    ->get('job_query')
                                    ->result();
        // Job Notifications
        $data['job_notifications'] = $this->db->where('jobcode', $jobcode)
                                            ->get('job_notifications')
                                            ->result();
        // Job Attachments
        $data['job_attachments'] = $this->db->where('job_code', $jobcode)
                                            ->get('job_attachments')
                                            ->result();
                                          
        $this->load->view('Client_portal/clientJobHistories', $data);
     }

        
        
    
    }