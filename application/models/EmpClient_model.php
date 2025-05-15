<?php 
// application/models/Client_model.php

class EmpClient_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // $sessionData = (object)$this->session->userdata();
    }

    // Function to insert job data into the database
    public function insert_job($data) {
        // Insert the data into the 'jobs' table
        $this->db->insert('joblist', $data);
        
        // Check if insert was successful
        if ($this->db->affected_rows() > 0) {
            return true;  // Success
        } else {
            return false; // Failure
        }
    }

    public function getLastJobId()
    {
        $this->db->select('id');
        $this->db->from('joblist');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return 0;
        }
    }

    public function insert_job_checklist_bulk($data) {
        if (!empty($data)) {
            return $this->db->insert_batch('job_checklist', $data);
        }
        return false;
    }

    public function insert_job_attachments($data)
    {
        return $this->db->insert_batch('job_attachments', $data);
    }

    public function get_filtered_jobs($limit, $offset, $search = '') {
         $this->db->select('*')->from('joblist');
    
        if (!empty($search)) {
            $this->db->group_start()
                     ->like('jobcode', $search)
                     ->or_like('client_name', $search)
                     ->group_end();
        }
    
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    
    public function count_filtered_jobs($search = '') {
        $this->db->from('joblist');
    
        if (!empty($search)) {
            $this->db->group_start()
                     ->like('jobcode', $search)
                     ->or_like('client_name', $search)
                     ->group_end();
        }
    
        return $this->db->count_all_results();
    }


    public function get_today_completed_jobs($limit, $offset, $jobcode = '', $job_name = '') {
        $this->db->select('jobcode,assignment_type,year_end,client_name,created_at');
        $this->db->from('joblist');
        $this->db->where('DATE(completed_date)', date('Y-m-d'));
        $this->db->where('status', 4);
    
        if ($jobcode) {
            $this->db->like('jobcode', $jobcode);
        }
    
        if ($job_name) {
            $this->db->like('client_name', $job_name);
        }
    
        $this->db->limit($limit, $offset);
        $this->db->order_by('completed_date', 'DESC');
    
        return $this->db->get()->result();
    }
    
    public function count_today_completed_jobs($jobcode = '', $job_name = '') {
        $this->db->from('joblist');
        $this->db->where('DATE(completed_date)', date('Y-m-d'));
        $this->db->where('status', 4);
    
        // if ($jobcode) {
        //     $this->db->like('jobcode', $jobcode);
        // }
    
        // if ($job_name) {
        //     $this->db->like('client_name', $job_name);
        // }
    
        return $this->db->count_all_results();
    }


    public function get_filtered_jobs222($limit, $offset, $code = '', $name = '') {
        $this->db->select('jobcode, job_name');
        $this->db->from('job_attachments');
        if ($code) {
            $this->db->like('jobcode', $code);
        }
        if ($name) {
            $this->db->like('job_name', $name);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }
    
    public function count_filtered_jobs333($code = '', $name = '') {
        $this->db->from('job_attachments');
        if ($code) {
            $this->db->like('jobcode', $code);
        }
        if ($name) {
            $this->db->like('job_name', $name);
        }
        return $this->db->count_all_results();
    }

     public function extra_get_filtered_jobs($limit, $offset, $filters, &$total = 0) {
        // Total count query (without limit)
        $sessionData = (object)$this->session->userdata();
        $this->db->from('joblist');
        $this->db->where('emp_id', $sessionData->user_ID);
       
        if (!empty($filters['search_code'])) {
            $label=$filters['search_code'];
            if ($label === 'Year End Account' || $label === 'YE' ) {
                $filters['search_code'] = 'year_end_account';
            } elseif ($label === 'Bookkeeping / VAT' || $label === 'Bookkeeping' || $label === 'VAT') {
                $filters['search_code'] = 'bookkeeping';
            } elseif ($label === 'Personal Tax Return' || $label === 'PTR' ) {
                $filters['search_code'] = 'personal_tax_return';
            } elseif ($label === 'Other' || $label === 'OTH') {
                $filters['search_code'] = 'other';
            }
        }
       
        if (!empty($filters['search_code'])) {
            $this->db->group_start();  
            $this->db->or_like('jobcode', $filters['search_code']);
            $this->db->or_like('client_name', $filters['search_code']);
            $this->db->or_like('additional_comment', $filters['search_code']);
            $this->db->or_like('assignment_type', $filters['search_code']);
            $this->db->or_like('status', $filters['search_code']);
            $this->db->group_end();  
        }
        if (!empty($filters['search_name'])) {
            $this->db->like('job_name', $filters['search_name']);
        }
        if ($filters['status'] !== '') {
            // agar status me 1 hai in case to isme 1,5 dono where condition me chekck honge aur sabhi case me same 2 me 2 3 me 3 4 me 4
            if ($filters['status'] == 1) {
                $this->db->where_in('status', [1, 5]);
            } else {
                $this->db->where('status', $filters['status']);
            }

        }
    
        $total = $this->db->count_all_results(); // store total here
    
        // Now run the actual query with limit
        $this->db->select('*');
        $this->db->from('joblist');
        $this->db->where('emp_id', $sessionData->user_ID);
    
        if (!empty($filters['search_code'])) {
            $this->db->group_start();  
            $this->db->or_like('jobcode', $filters['search_code']);
            $this->db->or_like('client_name', $filters['search_code']);
            $this->db->or_like('additional_comment', $filters['search_code']);
            $this->db->or_like('status', $filters['search_code']);
            $this->db->or_like('assignment_type', $filters['search_code']);
            $this->db->group_end();  
        }
        if (!empty($filters['search_name'])) {
            $this->db->like('job_name', $filters['search_name']);
        }
        if ($filters['status'] !== '') {
            if ($filters['status'] == 1) {
                $this->db->where_in('status', [1, 5]);
            } else {
                $this->db->where('status', $filters['status']);
            }
        }
    
    //    select * from assigned_jobs where id='6'


        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_jobs_by_status($status_type, $limit, $offset) {
        $sessionData = $this->session->userdata('accurexClientLoginDetails');
        $this->db->select('*')->from('joblist');
    
        // Define status types
        if ($status_type === 'current') {
            $this->db->where_in('status', [1, 3, 5]);
        } elseif ($status_type === 'on_hold') {
            $this->db->where('status', 2);
        } elseif ($status_type === 'completed') {
            $this->db->where('status', 4);
        }
        $this->db->where("user_id",$sessionData->user_ID);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        
        return $this->db->get()->result();
    }

    public function get_job_status_counts() {
        $sessionData = $this->session->userdata('accurexClientLoginDetails');
        $status_counts = [
            'current'   => 0,
            'on_hold'   => 0,
            'completed' => 0
        ];
    
        // Query all jobs
        $query = $this->db->select('status, COUNT(*) as total')
                          ->from('joblist')
                          ->where("user_id",$sessionData->user_ID)
                          ->group_by('status')
                          ->get();
    
        $results = $query->result();
    
        // Map the status values
        foreach ($results as $row) {
            if (in_array($row->status, [1, 3, 5])) {
                $status_counts['current'] += $row->total;
            } elseif ($row->status == 2) {
                $status_counts['on_hold'] = $row->total;
            } elseif ($row->status == 4) {
                $status_counts['completed'] = $row->total;
            }
        }
    
        return $status_counts;
    }


    public function get_monthly_job_summary($year)
    {
        $sessionData = $this->session->userdata('accurexClientLoginDetails');
        $months = array_fill(1, 12, 0); // 1 to 12 for Jan to Dec

        // Default structure for A, B, C

        $jobData = [
            'bookkeeping' => $months,
            'year_end_account' => $months,
            'personal_tax_return' => $months,
            'other' => $months,
        ];
        $query = $this->db->select("assignment_type, MONTH(created_at) as month, COUNT(*) as total")
            ->from("joblist")
            ->where("user_id",$sessionData->user_ID)
            ->where("YEAR(created_at)", $year)
            ->where_in("assignment_type", ['bookkeeping', 'year_end_account', 'personal_tax_return','other'])
            ->group_by(["assignment_type", "MONTH(created_at)"])
            ->order_by("assignment_type")
            ->get();

        foreach ($query->result() as $row) {
            $jobData[$row->assignment_type][(int)$row->month] = (int)$row->total;
        }

        return $jobData;
    }
    
        public function findJobByCode($jobcode = null)
    {
        $query = $this->db->select("*")
            ->from("joblist")
            ->where("jobcode", $jobcode)
            ->get();

        return $query->row(); // ✅ Return single row instead of query object
    }
        
    
    //06/05/2025
    public function get_job_turnaround_time() {
        $this->db->select("assignment_type, 
                           MONTH(completed_date) as month,
                           YEAR(completed_date) as year,
                           AVG(DATEDIFF(completed_date, recieved_on)) as avg_turnaround_days");
        $this->db->from("joblist");
        $this->db->where("status", 3);
        $this->db->where("completed_date IS NOT NULL", null, false);
        $this->db->where("recieved_on IS NOT NULL", null, false);
        $this->db->where("completed_date >=", date("Y-m-01", strtotime("-11 months"))); // 12 months including current
        $this->db->group_by(["assignment_type", "YEAR(completed_date)", "MONTH(completed_date)"]);
        $this->db->order_by("year ASC, month ASC");
    
        return $this->db->get()->result();
    }
    
 //07/05/2025
    public function get_job_turnaround_time_by_year($year = 2025) {
        $this->db->select("assignment_type,
                           MONTH(completed_date) as month,
                           AVG(DATEDIFF(completed_date, recieved_on)) as avg_days");
        $this->db->from("joblist");
        $this->db->where("status", 3);
        $this->db->where("YEAR(completed_date)", $year);
        $this->db->where("completed_date IS NOT NULL", null, false);
        $this->db->where("recieved_on IS NOT NULL", null, false);
        $this->db->group_by(["assignment_type", "MONTH(completed_date)"]);
        $this->db->order_by("month ASC");
    
        $result = $this->db->get()->result();
    
        if (empty($result)) {
            $sample_data = [];
            $assignment_types = ['Bookkeeping / VAT', 'Year end account', 'Tax return']; // you can add more types if needed
    
            foreach (range(1, 12) as $month) {
                foreach ($assignment_types as $type) {
                    $sample_data[] = (object)[
                        'assignment_type' => $type,
                        'month' => $month,
                        'avg_days' => rand(1, 10) + round(rand(0, 9) / 10, 1) // random avg days e.g., 5.7
                    ];
                }
            }
    
            return $sample_data;
        }
    
        return $result;
    }

 //08/05/2025
    public function get_job_turnaround_time_by_yearbb($year = 2025)
{
    // Step 1: Get jobs that were On Hold
     $on_hold_query = "
        SELECT job_id,
               MAX(CASE WHEN status = 'On Hold' THEN changed_at END) AS last_on_hold,
               MAX(CASE WHEN status = 'Completed' THEN changed_at END) AS completed_at,
               DATEDIFF(
                   MAX(CASE WHEN status = 'Completed' THEN changed_at END),
                   MAX(CASE WHEN status = 'On Hold' THEN changed_at END)
               ) AS turnaround_days
        FROM job_status_log
        WHERE YEAR(changed_at) = '$year'
        GROUP BY job_id
        HAVING last_on_hold IS NOT NULL
    ";
    $on_hold_jobs = $this->db->query($on_hold_query)->result();

    // Step 2: Get jobs that were never On Hold
    $no_hold_query = "
        SELECT job_id,
               MIN(CASE WHEN status = 'In Progress' THEN changed_at END) AS started_at,
               MAX(CASE WHEN status = 'Completed' THEN changed_at END) AS completed_at,
               DATEDIFF(
                   MAX(CASE WHEN status = 'Completed' THEN changed_at END),
                   MIN(CASE WHEN status = 'In Progress' THEN changed_at END)
               ) AS turnaround_days
        FROM job_status_log
        WHERE job_id NOT IN (
            SELECT DISTINCT job_id FROM job_status_log WHERE status = 'On Hold'
        )
        AND YEAR(changed_at) = ?
        GROUP BY job_id
    ";
    $no_hold_jobs = $this->db->query($no_hold_query, [$year])->result();

    // Step 3: Merge both results
    $all_jobs = array_merge($on_hold_jobs, $no_hold_jobs);

    if (empty($all_jobs)) {
        // Fallback to dummy
        $sample_data = [];
        $assignment_types = ['Bookkeeping / VAT', 'Year end account', 'Tax return'];

        foreach (range(1, 12) as $month) {
            foreach ($assignment_types as $type) {
                $sample_data[] = (object)[
                    'assignment_type' => $type,
                    'month' => $month,
                    'avg_days' => rand(1, 10) + round(rand(0, 9) / 10, 1)
                ];
            }
        }

        return $sample_data;
    }

    // Step 4: Get joblist info for these job_ids
    $job_ids = array_map(fn($job) => $job->job_id, $all_jobs);

    if (empty($job_ids)) return [];

    $this->db->select('id, assignment_type, completed_date');
    $this->db->from('joblist');
    $this->db->where_in('id', $job_ids);
    $this->db->where('status', 3);
    $this->db->where('completed_date IS NOT NULL', null, false);
    $joblist_info = $this->db->get()->result();

    $job_meta = [];
    foreach ($joblist_info as $j) {
        $job_meta[$j->id] = $j;
    }

    // Step 5: Group and average
    $grouped = [];

    foreach ($all_jobs as $job) {
        if (!isset($job_meta[$job->job_id])) continue;

        $meta = $job_meta[$job->job_id];
        $assignment_type = $meta->assignment_type;
        $month = (int)date('n', strtotime($meta->completed_date));
        $key = $assignment_type . '-' . $month;

        if (!isset($grouped[$key])) {
            $grouped[$key] = [
                'assignment_type' => $assignment_type,
                'month' => $month,
                'total_days' => 0,
                'count' => 0
            ];
        }

        $grouped[$key]['total_days'] += $job->turnaround_days;
        $grouped[$key]['count'] += 1;
    }

    // Step 6: Format final result
    $final = [];
    foreach ($grouped as $g) {
        $final[] = (object)[
            'assignment_type' => $g['assignment_type'],
            'month' => $g['month'],
            'avg_days' => round($g['total_days'] / $g['count'], 1)
        ];
    }

    return $final;
}

    
    
    
}
