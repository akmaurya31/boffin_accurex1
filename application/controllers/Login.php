<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['error'] = $this->session->flashdata('error');
        session_destroy();
        $this->load->view('Login/index',$data);
    }

    public function logout()
    {
        $this->auth->logout();
        redirect('login');
    }

    public function check(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // checking user in database
        $check =$this->auth->login($username,$password);

        if($check){

            // Sent OTP For Two-way Factor Authentication
            $otp = $this->auth->generateOTP(6);

            // store otp in database to related user
            $updateArr  = array('otp' => $otp, 'otp_time' => strtotime('+30 minutes'));
            $updateAuth = $this->auth->update_row('auth',$updateArr,array('auth_ID'=>$check->auth_ID));

            if($updateAuth){
                // sent OTP To Email
                $data['otp']        = $otp;
                $data['username']   = $username;
                $data['subject']    = 'Login ';
                $subject            = 'Login OTP For '.$username;
                $message            = $this->load->view('components/login_otp',$data,true);
                $sentEmail          = $this->sentMailToClient($username,$subject,$message);
                
                if($sentEmail){
                    echo "success";
                }else{
                    echo "failed email";
                }

            }else{
                echo "Failed";
            }

        }else{
            echo "Failed login";
        }

    }

    public function otp(){
        $this->load->view('Login/otp');
    }

    public function resent_otp(){
        $user_id = $this->session->userdata('auth_ID');
        $otp = $this->auth->generateOTP(6);

        // store otp in database to related user
        $updateArr  = array('otp' => $otp, 'otp_time' => strtotime('+30 minutes'));
        $updateAuth = $this->auth->update_row('auth',$updateArr,array('auth_ID'=>$user_id));
        
        $userInfo = $this->user_lib->getUserInfoByAuthID($user_id);
        $username = $userInfo[0]->username;

        if($updateAuth){
            $data['otp'] = $otp;
            $data['username'] = $username;
            $data['subject']    = 'Login ';
            $subject = 'Login OTP For '.$username;
            $message = $this->load->view('components/login_otp',$data,true);
            $sentEmail = $this->sentMailToClient($username,$subject,$message);
            if($sentEmail){
                echo "success";
            }else{
                echo "failed";
            }
        }

        if($updateAuth){
            echo "success";
        }else{
            echo "Failed";
        }
    }

    public function verify_otp(){
        $otp     = $this->input->post('otp');
        $user_id = $this->session->userdata('auth_ID');

        // checking otp using respected user ID
        $verifyOTP = $this->auth->verifyOTP($user_id,$otp);

        if($verifyOTP){
            $this->session->set_userdata('loggedValue','success');
            redirect('Dashboard');
        }else{
            $data['error'] = 'Given OTP is expired Please Press Resent OTP to Generate New.';
            $this->load->view('Login/otp',$data);
        }
    }

    public function password_recovery(){
        $this->load->view('Login/password_recovery');
    }

    public function verify_email(){
        $email = $this->input->post('email');
        $user = $this->auth->getUserIDByEmail($email);

        if($user){
            // Sent OTP For Two-way Factor Authentication
            $otp = $this->auth->generateOTP(6);

            // store otp in database to related user
            $updateArr  = array('otp' => $otp, 'otp_time' => strtotime('+30 minutes'));
            $updateAuth = $this->auth->update_row('auth',$updateArr,array('auth_ID' => $user[0]->auth_ID));

            if($updateAuth){
                // sent OTP To Email
                $data['otp']        = $otp;
                $data['username']   = $email;
                $data['subject']    = 'Forget Password Recovery';
                $subject            = 'Forget Password Recovery';
                $message            = $this->load->view('components/login_otp',$data,true);
                $sentEmail          = $this->sentMailToClient($email,$subject,$message);

                $this->session->set_userdata([
                    'auth_ID'  => $user[0]->auth_ID,
                    'user_ID'  => $user[0]->user_ID,
                    'forget_password' => true,
                ]);
                redirect('Login/otp');
            }else{

                $data['error'] = "Failed to get user Info. Try Later.";
                $this->load->view('Login/password_recovery',$data);
            }

        }else{
            $data['error'] = "Enter Email does not exist. Please enter valid email id to continue.";
            $this->load->view('Login/password_recovery',$data);
        }
    }

    public function verify_otp_forget_password(){

        $otp     = $this->input->post('otp');
        $user_id = $this->session->userdata('auth_ID');

        // checking otp using respected user ID
        $verifyOTP = $this->auth->verifyOTP($user_id,$otp);

        if($verifyOTP){

            // Get user info
            $this->load->library('user_lib');
            $userInfo = $this->user_lib->getUserInfoByAuthID($user_id);
            
            $reset_link = base_url('reset-password')."/".md5($userInfo[0]->email)."/".$userInfo[0]->user_ID."/".md5($userInfo[0]->full_name);
            
            // echo $link;
            // die();

            $message ='
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Reset Your Passwod</title>
                </head>
                <body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
                    <table width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border: 1px solid #ddd; border-radius: 8px;">
                        <tr>
                            <td>
                                <h2 style="color: #333;">Password Recovery - Reset Your Password</h2>
                                <p>Dear <strong>'.$userInfo[0]->full_name.'</strong>,</p>
                                <p>We received a request to reset the password associated with your account.</p>
                                <p>Click the link below to reset your password:</p>
                                <p style="margin: 20px 0;">
                                    <a href="'.$reset_link.'" style="background-color: #14264d; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                                        Reset Password
                                    </a>
                                </p>
                                <p>If you did not request this password reset, please ignore this email or contact support if you have concerns.</p>
                                <p>This link will expire in 1 hour for your security.</p>
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

            $subject = 'Forget Password Recovery';

            $sentEmail = $this->sentMailToClient($userInfo[0]->email,$subject,$message);

            $this->session->set_userdata('success','Password successfully sent to your register E-mail ID.');

            redirect('Login');
        }else{
            $data['error'] = 'Given OTP is expired or not matched. Please Press Resent OTP to Generate New.';
            $this->load->view('Login/otp',$data);
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
    
    public function reset_password(){
        $userID = $this->uri->segment(3);
        $data['reset_password'] = $userID;
        $this->load->view('Login/password_recovery',$data);
    }
    
    public function update_forget_password(){
        $user_id = $this->input->post('update_id');
        $key     = $this->input->post('password');
        
        // update paasword in database
        $this->db->trans_start();
            $this->db->set('password', sha1($key))
                     ->where('user_ID',$user_id)
                     ->update('auth');
                     
            $this->db->set('pass_key',$key)
                    ->where('user_ID',$user_id)
                    ->update('users_key_db');
                    
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            // If something failed, return FALSE
            $data['error']   = false;
            $data['reset_password'] = $user_id;
            $this->load->view('Login/password_recovery',$data);
        } else {
            // If everything was successful, return TRUE
            $data['success']   = true;
            $data['reset_password'] = $user_id;
            $this->load->view('Login/password_recovery',$data);
        }
    }
    
    // coding by team A
    public function updateProfile()
    {

        $data = [
            'full_name'         => $this->input->post('full_name'),
            'email'             => $this->input->post('email'), // Read-only, but passed anyway
            'address_line_1'    => $this->input->post('address'),
            'blood_group'       => $this->input->post('blood_group'),
            'emergency_contact' => $this->input->post('EmergencyContactNo'),
            'personal_contact'  => $this->input->post('PersonalContact'),
            'gender'            => $this->input->post('Gender'),
            'dob'               => $this->input->post('dob'),
            'firm_name'         => $this->input->post('firm_name'),
            'firm_address'      => $this->input->post('firm_address'),
        ];

        $user = $this->session->userdata('accurexClientLoginDetails');
        // print_r($user); die("Asdfa");
      

        if ($user && isset($user->user_ID)) {
            // Perform the update
            $this->db->where('user_ID', $user->user_ID);
            $updated = $this->db->update('users', $data);  // <-- This was missing

            if ($updated) {
                echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Update failed. Try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        }
    }
    public function updatePassword()
    {
        $newPass = $this->input->post('new_password');
        $confirmPass = $this->input->post('confirm_password');
    
        // Session check
        $user = $this->session->userdata('accurexClientLoginDetails');
    
        // if (!$this->is_logged() || !$user) {
        //     echo json_encode(['status' => 'error', 'message' => 'Please login again.']);
        //     return;
        // }
    
        // Validate passwords
        if (empty($newPass) || empty($confirmPass)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
            return;
        }
    
        if ($newPass !== $confirmPass) {
            echo json_encode(['status' => 'error', 'message' => 'Passwords do not match.']);
            return;
        }
    
        // Hash password
       // $hashed = password_hash($newPass, PASSWORD_DEFAULT); by aviansh
       //'password' => sha1($this->input->post('password')),  //right
    
         $hashed = sha1($newPass); 
        // Update DB
        $this->db->where('auth_ID', $user->user_ID);
        $update = $this->db->update('auth', ['password' => $hashed]);
    
        if ($update) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Update failed.']);
        }
    }

}