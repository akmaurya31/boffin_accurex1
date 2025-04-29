<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get paginated notifications for a specific client_id
     *
     * @param int $client_id
     * @param int $limit      // how many records per page
     * @param int $offset     // from where to start (for pagination)
     * @return array
     */

    public function get_notifications_by_client($client_id, $limit = 20, $offset = 0)
    {
        // Main query to get notifications with job details
        $this->db->select('job_notifications.id as notif_id, joblist.id as job_id,job_notifications.*, joblist.*');
        $this->db->from('job_notifications');
        $this->db->join('joblist', 'joblist.jobcode = job_notifications.jobcode', 'inner');
        $this->db->where('job_notifications.client_id', $client_id);
        $this->db->order_by('job_notifications.is_read', 'ASC');
        $this->db->order_by('job_notifications.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $notifications = $query->result();
    
        // Get total read notifications
        $this->db->where('client_id', $client_id);
        $this->db->where('is_read', 1); // Assuming 1 represents "read"
        $read_count_query = $this->db->get('job_notifications');
        $total_read = $read_count_query->num_rows();
    
        // Get total unread notifications
        $this->db->where('client_id', $client_id);
        $this->db->where('is_read', 0); // Assuming 0 represents "unread"
        $unread_count_query = $this->db->get('job_notifications');
        $total_unread = $unread_count_query->num_rows();
        
        // Get the overall total notifications
        $this->db->where('client_id', $client_id);
        $total_count_query = $this->db->get('job_notifications');
        $total = $total_count_query->num_rows();
    
        // Add the totals to the result array.  Important to return ONE array.
        $result = new stdClass();
        $result->notifications = (object)$notifications;
        $result->total_read = $total_read;
        $result->total_unread = $total_unread;
        $result->total = $total;
        return $result;
    }
    

    /**
     * Get total notification count for a specific client_id
     */
    public function count_notifications_by_client($client_id)
    {
        $this->db->where('client_id', $client_id);
        return $this->db->count_all_results('job_notifications');
    }
}
