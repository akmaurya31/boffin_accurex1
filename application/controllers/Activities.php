<?php

class Activities extends CI_Controller
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
        $data['page']    = "Notification";
        $user_ID         = $this->session->userdata('user_ID');
        $data['list']    = $this->user_lib->getAllNotificationDESC($user_ID);
        $data['success'] = $this->session->flashdata('success');
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('index',$data);
    }

    public function read_notification($id) {
        $user_ID = $this->session->userdata('user_ID');

        // Get notification by ID (can return array or single object)
        $notification = $this->user_lib->getNotificationByNotificationID($id);

        // Ensure it's an array (in case you expand it to handle multiple notifications)
        if (is_array($notification)) {
            // Sort: unseen first, then latest first
            usort($notification, function ($a, $b) {
                if ($a->status == 'new' && $b->status != 'new') return 1;
                if ($a->status != 'seen' && $b->status == 'seen') return -1;
                return strtotime($b->created_on) - strtotime($a->created_on);
            });
        }

        // Update this notification as seen
        $this->user_lib->setAsSeen($id);

        // Load view
        $data['page'] = "Notification/Read";
        $data['notification'] = $notification;
        $this->load->view('index', $data);
    }

    public function create_notification(){
        $data['page']   = "Notification/Create";
        $user_ID        = $this->session->userdata('user_ID');
        $data['users']  = $this->user_lib->get_all_users();
        $this->load->view('index',$data);
    }

    public function send_notification(){
        $title   = $this->input->post('title');
        $desc    = $this->input->post('description');
        $user_ID = $this->session->userdata('user_ID');
        $receipent = $this->input->post('recipients');
        
        $array = [
            'title'             => $title,
            'description'       => $desc,
            'forworded_user_ID' => $user_ID,
        ];
        
        $save = $this->user_lib->saveUserData('notifications',$array);
    
        $saveToUserAssigned = 0;
        foreach($receipent as $receiver){
            // save data to database
            $array = [
                'user_ID'           => $receiver,
                'notification_ID'   => $save,
                'status'            => 'new',
            ];
            $save2 = $this->user_lib->saveUserData('users_notification',$array);
           
            $saveToUserAssigned ++;
        }
        
        if(count($receipent) == $saveToUserAssigned){
            $this->session->set_flashdata('success','Notification sent successfully');
        }else{
            $this->session->set_flashdata('error','Failed to sent notification to all users.');
        }
        
        redirect('Activities');
    }
    
    public function sent_notifications(){
        $data['page']   = "Notification/List";
        $user_ID        = $this->session->userdata('user_ID');
        $data['all_notifications']  = $this->user_lib->getAllNotificationWithUserDetails();
        $data['success'] = $this->session->flashdata('success');
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('index',$data);
    }
    
    public function delete_notification(){
        $notification_ID = $this->input->post('notification_ID');
        
        if($this->user_lib->deleteRecordNotifications($notification_ID)){
            $this->session->set_flashdata('success','notification deleted.');
        }else{
            $this->session->set_flashdata('error','notification deleted falied.');
        }
        redirect('sent-notifications');
    }
    
    public function edit_notification($id){
        $data['page']   = "Notification/Create";
        $user_ID        = $this->session->userdata('user_ID');
        $data['users']  = $this->user_lib->get_all_users();
        $data['edit']   = $this->user_lib->getNotifictionByNotificationID($id);
        $this->load->view('index',$data);
    }
    
    public function update_notification(){
        
        
        
        $title              = $this->input->post('title');
        $desc               = $this->input->post('description');
        $user_ID            = $this->session->userdata('user_ID');
        $receipent          = $this->input->post('recipients');
        $notification_ID    = $this->input->post('notification_ID');
        
        $array = [
            'title'             => $title,
            'description'       => $desc,
            'forworded_user_ID' => $user_ID,
        ];
         $where = array(
                    'notification_ID' => $notification_ID
                );
                
               
        
        $update = $this->user_lib->updateUserData('notifications',$array,$where);
        // Deleting all user from user notification table for fresh entry 
        $deleteAllRelatedUserForNotification = $this->user_lib->deleteRecordNotificationsUser($notification_ID);
        
        $saveToUserAssigned = 0;
        foreach($receipent as $receiver){
            // save data to database
            $array2 = [
                'user_ID'           => $receiver,
                'notification_ID'   => $notification_ID,
                'status'            => 'new',
            ];
           
            $update2 = $this->user_lib->saveUserData('users_notification',$array2);
           
            $saveToUserAssigned ++;
        }
        
        if(count($receipent) == $saveToUserAssigned){
            $this->session->set_flashdata('success','Notification updated and sent successfully');
        }else{
            $this->session->set_flashdata('error','Failed to sent notification to all users.');
        }
        
        redirect('Activities');
    }




}