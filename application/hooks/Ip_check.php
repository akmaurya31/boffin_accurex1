<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ip_check {

    public function check_user_ip()
    {

        $CI =& get_instance();
        $CI->load->library('session');

        if (!$CI->session->userdata('loggedValue') || !$CI->session->userdata('user_ID')) {
            return;
        }

        if ($CI->session->userdata('loggedValue') && $CI->session->userdata('role_ID') === '1') {
            return;
        }else{

            $user_id = $CI->session->userdata('user_ID');

            $user_ip = $this->get_client_ip();
            

            $CI->load->library('user_lib');
            $user_id = $CI->session->userdata('user_ID');

            $allowed_ips = $CI->user_lib->get_allowed_ips($user_id);
            
            if (!in_array($user_ip, $allowed_ips)) {
                log_message('error', 'Access blocked for IP: ' . $user_ip);
                session_destroy();

                $html = $CI->load->view('ip_block', [], TRUE);

                $CI->output
                    ->set_status_header(403)
                    ->set_content_type('text/html')
                    ->set_output($html);

                $CI->output->_display();
                exit;
            }


        }
    }


    private function get_client_ip() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else return $_SERVER['REMOTE_ADDR'];
    }
    
   

}
