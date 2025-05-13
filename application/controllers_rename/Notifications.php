<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model'); // ✅ Load the model once in constructor
    }

    public function ClientsNotification()
    {
        // Dummy client ID (replace with session or actual client ID logic)
         $sessionData = $this->session->userdata('accurexClientLoginDetails');
         $client_id = $sessionData->user_ID;
        // $client_id = 1;

        // Get page number from query string (default is 1)
        $page = $this->input->get('page') ?? 1;
        $limit = 20;
        $offset = ($page - 1) * $limit;

        // Get total notifications count for pagination
        $total_notifications = $this->Notification_model->count_notifications_by_client($client_id);

        // Get paginated notifications
        $notifications = $this->Notification_model->get_notifications_by_client($client_id, $limit, $offset);

        // Pass data to view
        $data['notifications'] = $notifications;
        $data['total_notifications'] = $total_notifications;
        $data['current_page'] = $page;
        $data['limit'] = $limit;

        $this->load->view('Client_portal/ClientsNotification',$data);
        // $this->load->view('notifications/index', $data); // ✅ Create this view
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
        $job->job_name = generate_job_title(
            $job->client_name,
            $job->assignment_type,
            $job->year_end,
            $job->created_at
        );
        
        $status_details = get_job_status_details($job->n_status);
        $job->status_name = $status_details['status']; // Store the status
        $job->sub_status = $status_details['sub_status']; // Store the sub-status
        $job->badge_color = $status_details['badge_color']; // Store the badge color

        $job->notifi_isread = ($job->is_read == 1) ? 'isread' : 'isunread';

    }


    // foreach ($notifications as &$job) {
    //     $job['job_name'] = generate_job_title(
    //         $job['client_name'],
    //         $job['assignment_type'],
    //         $job['year_end'],
    //         $job['created_at']
    //     );
    //     $status_details = get_job_status_details($job['status']);
    //     $job['status_name'] = $status_details['status']; // Store the status
    //     $job['sub_status'] = $status_details['sub_status']; // Store the sub-status
    //     $job['badge_color'] = $status_details['badge_color']; // Store the badge color        
    // }



        
    // Prepare data to return as JSON
    $data = [
        'jobs'=>(array)$jobs,
        'notifications' => $notifications,  // Array of notifications
        'pagination' => $this->generate_pagination($total_notifications, $page, $limit)  // Pagination links
    ];

    // Return JSON response
    echo json_encode($data);
}

private function generate_pagination($total_notifications, $current_page, $limit)
{
    $total_pages = ceil($total_notifications / $limit);
    $pagination = '';

    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $current_page) ? 'active' : '';
        $pagination .= "<a href='#' class='badge badge-success pagination-link $active' data-page='$i'>$i</a> ";
    }

    return $pagination;
}


public function status_lookup($id)
{
    $this->load->helper('status');
    header('Content-Type: application/json');
    echo json_encode( get_job_status_details((int)$id) );
}

public function status_lookupall()
{
    // If you have a helper that provides this map, you could call it here.
    // Otherwise, define your statuses inline as you’ve done:
    $statuses = [
        1 => [
            'status'      => 'In Progress',
            'sub_status'  => 'Reviewed (Can be started)',
            'badge_color' => 'badge-success'
        ],
        2 => [
            'status'      => 'On Hold',
            'sub_status'  => 'On Hold',
            'badge_color' => 'badge-warning'
        ],
        3 => [
            'status'      => 'Reviewed',
            'sub_status'  => 'Can be started',
            'badge_color' => 'badge-info'
        ],
        4 => [
            'status'      => 'Completed',
            'sub_status'  => 'Completed',
            'badge_color' => 'badge-primary'
        ],
        5 => [
            'status'      => 'Under Review',
            'sub_status'  => 'TL Review',
            'badge_color' => 'badge-secondary'
        ],
    ];

    header('Content-Type: application/json');
    echo json_encode($statuses);
}


public function updateRead()
{
    $id = $this->input->post('id');
    $this->db->where('id', $id)->update('job_notifications', ['is_read' => 1]);
    echo json_encode(['status' => 'success']);
}
    
}
