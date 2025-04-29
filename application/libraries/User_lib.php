<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_lib
{
    protected $CI;

    public function __construct()
    {
        // Get CI instance
        $this->CI =& get_instance();
    }

    public function getRoleBasedOnUserID($user_ID){
        $query = $this->CI->db->select('role_ID')
                              ->from('users')
                              ->where('user_ID',$user_ID)
                              ->get();
        return $query->result();
    }

    public function get_allowed_ips($user_id){
        $this->CI->db->select('ip_address');
        $this->CI->db->where('user_ID', $user_id);
        $query = $this->CI->db->get('user_ips');

        return array_column($query->result_array(), 'ip_address');
    }

    public function has_permission($segment, $action) {
        $user_id = $this->CI->session->userdata('user_ID');

        $this->CI->db->select('permissions.id')
            ->from('users')
            ->join('roles', 'roles.id = users.role_id')
            ->join('role_permissions', 'role_permissions.role_id = roles.id')
            ->join('permissions', 'permissions.id = role_permissions.permission_id')
            ->where('users.id', $user_id)
            ->where('permissions.segment', $segment)
            ->where('permissions.action', $action);

        $query = $this->CI->db->get();
        return $query->num_rows() > 0;
    }

    public function getUserInfoByAuthID($authID){
        $user = $this->CI->db->select('*')
                             ->from('auth')
                             ->where('auth_ID',$authID)
                             ->join('users','users.user_ID = auth.user_ID')
                             ->join('users_key_db','users_key_db.user_ID = auth.user_ID')
                             ->get();
        return $user->result();
    }

    public function getUserInfoByUserID($userID){
        $user = $this->CI->db->select('*,auth.status as is_blocked')
                             ->from('auth')
                             ->where('auth.user_ID',$userID)
                             ->join('users','users.user_ID = auth.user_ID')
                             ->join('users_key_db','users_key_db.user_ID = auth.user_ID')
                             ->get();
        return $user->result();
    }

    public function read_notification($id){
        $query = $this->CI->db->set('status','seen')
                              ->where('notification_ID',$id)
                              ->update('notifications');
        return $this->CI->db->affected_rows();
    }

    public function getAllNotificationDESC($user_ID){
        $query = $this->CI->db->select("*,users_notification.status as noti_status")
                        ->from("notifications")
                        ->where("users_notification.user_ID",$user_ID)
                        ->order_by("notifications.notification_ID","DESC")
                        ->join('users_notification','users_notification.notification_ID = notifications.notification_ID','left')
                        ->join('users','users.user_ID = notifications.forworded_user_ID')
                        ->get();
        return $query->result();
    }

    public function getNewNotificationCount($id){
        $this->CI->db->from('users_notification');
        $this->CI->db->where('status', 'new');
        if ($id !== null) {
            $this->CI->db->where('user_ID', $id);
        }
        return $this->CI->db->count_all_results();
    }

    public function getInitials($fullName) {
        // Trim and explode by spaces
        $names = explode(' ', trim($fullName));

        $firstInitial = isset($names[0]) ? substr($names[0], 0, 1) : '';
        $lastInitial = count($names) > 1 ? substr($names[count($names) - 1], 0, 1) : '';

        return strtoupper($firstInitial . $lastInitial);
    }

    public function getNotificationByNotificationID($id){
        $query = $this->CI->db->select("*,users_notification.status as noti_status")
                                ->from("notifications")
                                ->where("notifications.notification_ID",$id)
                                ->join('users','users.user_ID = notifications.forworded_user_ID')
                                ->join('users_notification','users_notification.notification_ID = notifications.notification_ID')
                                ->get();
        return $query->result();
    }

    public function timeAgo($datetime, $full = false) {
        $timezone   = new DateTimeZone('Asia/Kolkata');
        $now        = new DateTime('now', $timezone);
        $ago        = new DateTime($datetime, $timezone);
        $diff       = $now->diff($ago);
        // $now        = new DateTime;
        // $ago        = new DateTime($datetime);
        // $diff       = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'y',
            'm' => 'month',
            'w' => 'w',
            'd' => 'd',
            'h' => 'h',
            'i' => 'm',
            's' => 's',
        ];

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 2);
        return $string ? implode(' ', $string) . ' ago' : 'just now';
    }

    public function setAsSeen($id){
        $query = $this->CI->db->set('status','seen')
                              ->where('notification_ID',$id)
                              ->update('users_notification');
        return $this->CI->db->affected_rows();
    }

    public function get_all_roles() {
        return $this->CI->db->get('roles')->result();
    }

    public function getRoleNameByID($roleID){
        $query = $this->CI->db->select('name')->from('roles')->where('id',$roleID)->get();
        return $query->result();
    }

    public function saveUserData($tbl,$array){
        $this->CI->db->insert($tbl,$array);
        return $this->CI->db->insert_id();
    }

    public function get_all_users() {
        return $this->CI->db->get('users')->result();
    }

    public function getRolePermitionForUser($roleID){
        return $this->CI->db->where('role_id',$roleID)->get('role_permissions')->result();
    }

    public function permittions(){
        $query = $this->CI->db->distinct()
                     ->select('segment,id')
                    ->get('permissions');
        return $query->result();
    }

    public function is_has_access($segment){
        $query = $this->CI->db->select('*')
                              ->from('role_permissions')
                              ->where('role_id',$this->CI->session->userdata('role_ID'))
                              ->where('permission_id',$segment)
                              ->get();
        $result = $query->result();

        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getAllNotificationWithUserDetails() {
        $this->CI->db->select('*');
        $this->CI->db->from('notifications');
        $this->CI->db->order_by('notification_ID', 'DESC');
        $query  = $this->CI->db->get();
        $result = $query->result();
        return $result;
    }

    public function getUsersListByNotificationID($notification_ID){
        $query = $this->CI->db->select('users.*')
                              ->from('users_notification')
                              ->where('notification_ID',$notification_ID)
                              ->join('users','users.user_ID = users_notification.user_ID','left')
                              ->get();
        $result = $query->result();

        return $result;
    }

    public function deleteRecordNotifications($id){
        $this->CI->db->trans_start();

        $this->CI->db->where('notification_ID', $id);
        $this->CI->db->delete('notifications');

        $this->CI->db->where('notification_ID', $id);
        $this->CI->db->delete('users_notification');

        $this->CI->db->trans_complete();

        if ($this->CI->db->trans_status() === FALSE) {
            return FALSE;
        }else{
            return TRUE;
        }
    }
    public function getNotifictionByNotificationID($id){
        $this->CI->db->select('*');
        $this->CI->db->from('notifications');
        $this->CI->db->where('notification_ID', $id);
        $query  = $this->CI->db->get();
        $result = $query->result();
        return $result;
    }

    public function updateUserData($tbl,$array,$where){
        $this->CI->db->set($array)
                     ->where($where)
                     ->update($tbl);
        return $this->CI->db->affected_rows();
    }

    public function deleteRecordNotificationsUser($notification_ID){
        $this->CI->db->where('notification_ID', $notification_ID);
        $this->CI->db->delete('users_notification');
        return $this->CI->db->affected_rows();
    }

    public function getIpListForUser($userID){
        $this->CI->db->select('*');
        $this->CI->db->from('user_ips');
        $this->CI->db->where('user_ID', $userID);
        $query  = $this->CI->db->get();
        $result = $query->result();
        return $result;
    }

    public function deleteData($tbl,$where){
        $this->CI->db->where($where);
        $this->CI->db->delete($tbl);
        return $this->CI->db->affected_rows();
    }
    
    
    // Client Area 
    
    public function checkClientLogin($username,$password){
        $check = $this->CI->db->select('users.*,auth.auth_ID')
                              ->from('auth')
                              ->where('auth.username',$username)
                              ->where('auth.password',$password)
                              ->where('users.role_ID','5')
                              ->join('users','users.user_ID = auth.user_ID','left')
                              ->get();
                              
        return $check->result();
    }
    
    public function checkForFrogetPasswordClient($username){
        $check = $this->CI->db->select('users.*,auth.auth_ID')
                              ->from('auth')
                              ->where('auth.username',$username)
                              ->where('users.role_ID','5')
                              ->join('users','users.user_ID = auth.user_ID','left')
                              ->get();
                              
        return $check->result();
    }
    
    public function checkEnteredOTP($otp,$authID){
        $check = $this->CI->db->select('users.*,auth.auth_ID')
                              ->from('auth')
                              ->where('auth.otp',$otp)
                              ->where('auth.auth_ID',$authID)
                              ->where("auth.otp_time >",strtotime('now'))
                              ->join('users','users.user_ID = auth.user_ID','left')
                              ->get();
                              
        return $check->result();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
