<?php
class User extends CI_Controller {

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

    public function create() {
        $data['roles']          = $this->Role_model->get_all_roles();
        $data['permissions']    = $this->Permission_model->get_all_permissions();
        $data['page']           = 'Users/Create';
        $this->load->view('index', $data);
    }

    public function store() {
        $name               = $this->input->post('name');
        $blood_group        = $this->input->post('blood_group');
        $email              = $this->input->post('email');
        $password           = $this->input->post('password');
        $confirm_password   = $this->input->post('confirm_password');
        $address_line_1     = $this->input->post('address_line_1');
        $address_line_2     = $this->input->post('address_line_2');
        $state              = $this->input->post('state');
        $city               = $this->input->post('city');
        $pincode            = $this->input->post('pincode');
        $country            = $this->input->post('country');
        $gender             = $this->input->post('gender');
        $status             = $this->input->post('status');
        $role               = $this->input->post('role');

        // Form Validation
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('blood_group', 'Blood Group', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Repeat Password', 'required|matches[password]');
        $this->form_validation->set_rules('address_line_1', 'Address Line 1', 'required');
        $this->form_validation->set_rules('address_line_2', 'Address Line 2', 'trim');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('pincode', 'Postal Code', 'required|numeric|min_length[4]|max_length[10]');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');


        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return to form with errors
            $data['roles']          = $this->Role_model->get_all_roles();
            $data['permissions']    = $this->Permission_model->get_all_permissions();
            $data['page']           = 'Users/Create';
            $this->load->view('index', $data);
        } else {
            
            // Image upload
            $config['upload_path']      = './upload/images/profile_img/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg|webp';
            $config['file_name']        = strtotime('now');

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_img')) {
                // If upload fails, return upload error
                $data['error']          = $this->upload->display_errors();
                $data['roles']          = $this->Role_model->get_all_roles();
                $data['permissions']    = $this->Permission_model->get_all_permissions();
                $data['page']           = 'Users/Create';
                $this->load->view('index', $data);
            } else {
                // Success
                $data = array('upload_data' => $this->upload->data());
                
                // var_dump($data);
                
                // die();
                // Validation passed, proceed with form data
                $userArray = [
                    'full_name'              => $this->input->post('name'),
                    'blood_group'       => $this->input->post('blood_group'),
                    'email'             => $this->input->post('email'),
                    'address_line_1'    => $this->input->post('address_line_1'),
                    'address_line_2'    => $this->input->post('address_line_2'),
                    'state'             => $this->input->post('state'),
                    'city'              => $this->input->post('city'),
                    'pincode'           => $this->input->post('pincode'),
                    'country'           => $this->input->post('country'),
                    'status'            => $this->input->post('status'),
                    'role_ID'           => $this->input->post('role'),
                    'image'             => "images/profile_img/".$data['upload_data']['file_name'],
                ];
    
                // Insert into DB users,auth and key
                $saveUser  = $this->user_lib->saveUserData('users',$userArray);
                $authArray = [
                    'username' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password')),
                    'status'   => $this->input->post('status'),
                    'user_ID'  => $saveUser
                ];
    
                $saveAuth = $this->user_lib->saveUserData('auth',$authArray);
    
                $keyArray = [
                    'user_ID'   => $saveUser,
                    'pass_key'  => $this->input->post('password')
                ];
                $saveKey  = $this->user_lib->saveUserData('users_key_db',$keyArray);
                $loginUrl  = base_url().'Clients/';
                $message ='
                            <!DOCTYPE html>
                            <html>
                            <head>
                                <meta charset="UTF-8">
                                <title>Login Invitation</title>
                            </head>
                            <body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
                                <table width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border: 1px solid #ddd; border-radius: 8px;">
                                    <tr>
                                        <td>
                                            <h2 style="color: #333;">Client Portal Access Has Been Created!</h2>
                                            <p>Hello <strong>'.$this->input->post('name').'</strong>,</p>
                                            <p>Welcome to Accurex Accounting Client Portal</p>
                                            <p>We’re excited to let you know that your client portal account has been successfully created. You can now login to access your dedicated client portal.</p>
                                            
                                            <p>🔐 Your Login Credentials:<br>
                                                <table with="100%">
                                                    <tr style="text-align:left">
                                                        <th>Portal URL:</th>
                                                        <td>'.$loginUrl.'</td>
                                                    </tr>
                                                    <tr style="text-align:left">
                                                        <th>Username:</th>
                                                        <td>'.$this->input->post('email').'</td>
                                                    </tr>
                                                    <tr style="text-align:left">
                                                        <th>Temporary Password :</th>
                                                        <td>'.$this->input->post('password').'</td>
                                                    </tr>
                                                </table>
                                            </p>
                                            <p>Thank you,</p>
                                            <p><strong>Accurex Accounting</strong><br>
                                            <a href="mailto:contact@accurexaccounting.com">contact@accurexaccounting.com</a><br>
                                            <a href="https://accurexaccounting.com/">https://accurexaccounting.com/</a></p>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                            </html>
                            ';
                $subject = 'Client Portal Access Has Been Created!';

                $sentEmail = $this->sentMailToClient($this->input->post('email'),$subject,$message);

                $this->session->set_userdata('success','Account Created successfully sent to your register E-mail ID.');
                
                redirect('list-user');
            }
        }

    }
    
    public function list_user(){
        $usersQuery             = $this->db->select("users.*,roles.name as role_name")->from('users')->join('roles','roles.id = users.role_ID')->get();
        $data['users']          = $usersQuery->result(); 
        $data['page']           = 'Users/List';
        $this->load->view('index', $data);
    }
    
    public function edit_user($id){
        $data['roles']          = $this->Role_model->get_all_roles();
        $data['permissions']    = $this->Permission_model->get_all_permissions();
        $data['page']           = 'Users/Create';
        $data['edit']           = $this->user_lib->getUserInfoByUserID($id);
        $this->load->view('index', $data);
    }
    
    public function update_user(){
        $name               = $this->input->post('name');
        $blood_group        = $this->input->post('blood_group');
        $email              = $this->input->post('email');
        $password           = $this->input->post('password');
        $confirm_password   = $this->input->post('confirm_password');
        $address_line_1     = $this->input->post('address_line_1');
        $address_line_2     = $this->input->post('address_line_2');
        $state              = $this->input->post('state');
        $city               = $this->input->post('city');
        $pincode            = $this->input->post('pincode');
        $country            = $this->input->post('country');
        $gender             = $this->input->post('gender');
        $status             = $this->input->post('status');
        $role               = $this->input->post('role');
        $userID             = $this->input->post('user_ID');

        // Form Validation
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('blood_group', 'Blood Group', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        $this->form_validation->set_rules('address_line_1', 'Address Line 1', 'required');
        $this->form_validation->set_rules('address_line_2', 'Address Line 2', 'trim');
        $this->form_validation->set_rules('state', 'State', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('pincode', 'Postal Code', 'required|numeric|min_length[4]|max_length[10]');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');


        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return to form with errors
            $data['roles']          = $this->Role_model->get_all_roles();
            $data['permissions']    = $this->Permission_model->get_all_permissions();
            $data['page']           = 'Users/Create';
            $data['edit']           = $this->user_lib->getUserInfoByAuthID($this->session->userdata('auth_ID'));
            $this->load->view('index', $data);
        } else {
                        // Image upload
            $config['upload_path']      = './upload/images/profile_img/';
            $config['allowed_types']    = 'gif|jpg|png|jpeg|webp';
            $config['file_name']        = strtotime('now');

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_img')) {
                // If upload fails, return upload error
                $data['error']          = $this->upload->display_errors();
                $data['roles']          = $this->Role_model->get_all_roles();
                $data['permissions']    = $this->Permission_model->get_all_permissions();
                $data['page']           = 'Users/Create';
                $this->load->view('index', $data);
            } else {
                // Success
                $data = array('upload_data' => $this->upload->data());
                // Validation passed, proceed with form data
                $userArray = [
                    'full_name'         => $this->input->post('name'),
                    'blood_group'       => $this->input->post('blood_group'),
                    'address_line_1'    => $this->input->post('address_line_1'),
                    'address_line_2'    => $this->input->post('address_line_2'),
                    'state'             => $this->input->post('state'),
                    'city'              => $this->input->post('city'),
                    'pincode'           => $this->input->post('pincode'),
                    'country'           => $this->input->post('country'),
                    'status'            => $this->input->post('status'),
                    'role_ID'           => $this->input->post('role'),
                    'image'             => "images/profile_img/".$data['upload_data']['file_name']
                ];
                
                $where = array('user_ID'  => $userID);
    
                // Insert into DB users,auth and key
                $saveUser  = $this->user_lib->updateUserData('users',$userArray,$where);
                $authArray = [
                    'status'   => $this->input->post('status'),
                ];
                
                $where2 = array('user_ID'  => $userID);
    
                $saveAuth = $this->user_lib->updateUserData('auth',$authArray,$where2);
    
                redirect('list-user');
            }
        }
    }
    
    public function delete_user(){
        $user_ID = $this->input->post('user_ID');
        $delThisUser = $this->db->where('user_ID',$user_ID)
                                ->delete(array('auth','users'));
                                
        redirect('list-user');
    }
    
    public function block_user($id){
        $this->db->trans_start(); 

        $this->db->set('status', '1')->where('user_ID', $id)->update('users');
        $this->db->set('status', '1')->where('user_ID', $id)->update('auth');
        
        $this->db->trans_complete();
        
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','User Blocked successfully');
        }else{
            $this->session->set_flashdata('error','Failed to blocked user. Try Later.');
        }
        redirect('list-user');
    }
    
    public function active_user($id){
        $this->db->trans_start(); 

        $this->db->set('status', '0')->where('user_ID', $id)->update('users');
        $this->db->set('status', '0')->where('user_ID', $id)->update('auth');
        
        $this->db->trans_complete();
        
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success','User Activated successfully');
        }else{
            $this->session->set_flashdata('error','Failed to active user. Try Later.');
        }
        redirect('list-user');
    }
    
     public function deleteIP(){
        $id = $this->input->post('id');
        // delete ip from tbl
        $this->db->where('user_ips_ID',$id)
                 ->delete('user_ips');
        if($this->db->affected_rows() > 0){
            echo true;
        }else{
            echo FALSE;
        }
    }  
    
    public function sentMailToClient($to,$subject,$message){
        $this->load->library('email');
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.hostinger.com',
            'smtp_port' => 465,
            'smtp_user' => 'bwt_testing@aa.boffinweb.com',
            'smtp_pass' => '*D1eDYgg',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'smtp_crypto' => 'ssl',
            'crlf'      => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('bwt_testing@aa.boffinweb.com', 'Accurex Accounting');
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
}
