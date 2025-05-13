<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
    protected $CI;

    public function __construct()
    {
        // Get CI instance
        $this->CI =& get_instance();
        // Load necessary libraries, helpers, and models
        $this->CI->load->library('session');
        $this->CI->load->helper('url');
        $this->CI->load->model('Auth_model');
    }

    public function login($username, $password)
    {
        $user = $this->CI->Auth_model->get_user_by_username($username);
        $role_ID = $this->CI->user_lib->getRoleBasedOnUserID($user->user_ID);

        if (sha1($password) === $user->password) {
            // Set session data
            $this->CI->session->set_userdata([
                'auth_ID'   => $user->auth_ID,
                'username'  => $user->username,
                'user_ID'   => $user->user_ID,
                'logged_in' => true,
                'role_ID'   => $role_ID[0]->role_ID
            ]);

            // Saving Login History
            $historyArr = array(
                'user_ID' => $user->user_ID,
                'ip_address' => $this->getUserIP(),
                'user_agent' => $this->getUserAgent(),
                'login_time' => strtotime('now'),
                'logout_time' => ''
            );
            $loginHistory = $this->CI->db->insert('login_history',$historyArr);
            return $user;
        }
        return false;
    }

    public function logout()
    {
        $historyArr = array(
            'user_ID' => $this->CI->session->userdata('user_ID'),
            'ip_address' => $this->getUserIP(),
            'user_agent' => $this->getUserAgent(),
            'login_time' => '',
            'logout_time' =>strtotime('now')
        );

        $loginHistory = $this->CI->db->insert('login_history',$historyArr);

        session_destroy();
    }

    public function is_logged_in()
    {
        return $this->CI->session->userdata('logged_in') === true;
    }

    public function current_user()
    {
        if ($this->is_logged_in()) {
            return [
                'user_id'  => $this->CI->session->userdata('user_id'),
                'username' => $this->CI->session->userdata('username')
            ];
        }
        return null;
    }

    function generateOTP($length) {
        $chars = '0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $otp;
    }

    public function update_row($tbl,$array,$where){
        $update = $this->CI->db->set($array)
                            ->where($where)
                            ->update($tbl);
        return $this->CI->db->affected_rows();
    }

    public function verifyOTP($userID,$otp){
        $query = $this->CI->db->where('auth_ID',$userID)
                              ->where('otp',$otp)
                              ->where('otp_time >',strtotime('now'))
                              ->limit(1)
                              ->get('auth');
        return $query->row();
    }

    public function getUserIDByEmail($email){
        $query = $this->CI->db->where('username',$email)
                            ->get('auth');
        return $query->result();
    }


    // Get IP address
    function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // For proxies or load balancers
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    // Get User Agent
    function getUserAgent() {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}
