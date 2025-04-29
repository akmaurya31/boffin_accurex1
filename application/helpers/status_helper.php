<?php 

if (!function_exists('get_job_status_details')) {
    function get_job_status_details($id) {
        // Define status and sub-status mapping

        // Live 1 
        // In Progress  >> In Progress 
        // Under Review  >> TL Review (Sub Status)

        // On Hold  2 
        // On Hold >> On Hold 

        // Compeleted 4 
        // Completed
        // completed 

        // Draft 3 
       // Reviewed
       // sub status: (Can be started) / TL 

        $statuses = [
            1 => [
                'status' => 'In Progress',  //working
                'sub_status' => 'Reviewed (Can be started)',
                'badge_color' => 'badge-success'
            ],
            2 => [
                'status' => 'On Hold',  
                'sub_status' => 'On Hold',
                'badge_color' => 'badge-warning'
            ],
            3 => [
                'status' => 'Reviewed',
                'sub_status' => 'Can be started',  // junior ne completed >> senior in hand >> in Progress part   >> Live 
                'badge_color' => 'badge-info'
            ],
            4 => [
                'status' => 'Completed',
                'sub_status' => 'Completed',
                'badge_color' => 'badge-primary'
            ],
            5 => [
                'status' => ' Under Review',
                'sub_status' => 'TL Review',
                'badge_color' => 'badge-secondary'
            ],
        ];

        // Return the details based on job ID
        if (array_key_exists($id, $statuses)) {
            return $statuses[$id];
        } else {
            return null; // If no matching ID found
        }
    }
}

 

function getAllChecklists()
{
    return [
        ['id' => 1,'sn' => 1, 'assignment_type' => 'year_end_account', 'title' => 'Nature of Business'],
        ['id' => 1,'sn' => 2, 'assignment_type' => 'year_end_account', 'title' => 'Previous year Final account and Trial balance'],
        ['id' => 2,'sn' => 3, 'assignment_type' => 'year_end_account', 'title' => 'Previous year working paper'],
        ['id' => 3,'sn' => 4, 'assignment_type' => 'year_end_account', 'title' => 'Sales details'],
        ['id' => 4, 'sn' => 5,'assignment_type' => 'year_end_account', 'title' => 'Purchase / expenses details'],
        ['id' => 5,'sn' => 6, 'assignment_type' => 'year_end_account', 'title' => 'Bank account statements'],
        ['id' => 6, 'sn' => 7,'assignment_type' => 'year_end_account', 'title' => 'Credit card statement'],
        ['id' => 7, 'sn' => 8,'assignment_type' => 'year_end_account', 'title' => 'Loan / HP statements'],
        ['id' => 8, 'sn' => 9,'assignment_type' => 'year_end_account', 'title' => 'Payroll / CIS records'],
        ['id' => 9, 'sn' => 10,'assignment_type' => 'year_end_account', 'title' => 'Expenses re-imbursement details'],
        ['id' => 10,'sn' => 11, 'assignment_type' => 'year_end_account', 'title' => 'Client cashbook'],
        ['id' => 11,'sn' => 12, 'assignment_type' => 'year_end_account', 'title' => 'Others'],
        ['id' => 12, 'sn' => 13,'assignment_type' => 'year_end_account', 'title' => 'Any key events in the year'],
        ['id' => 13,'sn' => 14, 'assignment_type' => 'year_end_account', 'title' => 'Closing stock value'],
        ['id' => 14, 'sn' => 15,'assignment_type' => 'year_end_account', 'title' => 'VAT Scheme'],
        ['id' => 15, 'sn' => 16,'assignment_type' => 'year_end_account', 'title' => 'VAT Computation Method'],
        ['id' => 16, 'sn' => 17,'assignment_type' => 'year_end_account', 'title' => 'VAT Returns and Working'],

        ['id' => 17, 'sn' => 1,'assignment_type' => 'bookkeeping', 'title' => 'Nature of Business'],
        ['id' => 18, 'sn' => 2,'assignment_type' => 'bookkeeping', 'title' => 'VAT Scheme (Cash/Standard/Flat rate/Margin)'],
        ['id' => 19, 'sn' => 3,'assignment_type' => 'bookkeeping', 'title' => 'Previous VAT Returns'],
        ['id' => 20, 'sn' => 4,'assignment_type' => 'bookkeeping', 'title' => 'Bank account statements (all business accounts)'],
        ['id' => 21, 'sn' => 5,'assignment_type' => 'bookkeeping', 'title' => 'Credit card statements (all business credit cards)'],
        ['id' => 22, 'sn' => 6,'assignment_type' => 'bookkeeping', 'title' => 'HP/Loan statements (if applicable)'],
        ['id' => 23, 'sn' => 7,'assignment_type' => 'bookkeeping', 'title' => 'Accounting software (Sage, QuickBooks, Xero)'],
        ['id' => 24, 'sn' => 8,'assignment_type' => 'bookkeeping', 'title' => 'Copies of sales invoices issued'],
        ['id' => 25, 'sn' => 9,'assignment_type' => 'bookkeeping', 'title' => 'Receipts for business expenses'],
        ['id' => 26, 'sn' => 10,'assignment_type' => 'bookkeeping', 'title' => 'Access to POS system reports (if applicable)'],
        ['id' => 27, 'sn' => 11,'assignment_type' => 'bookkeeping', 'title' => 'Expense reimbursement details e.g., mileage logs'],
        ['id' => 28, 'sn' => 12,'assignment_type' => 'bookkeeping', 'title' => 'Payroll Reports (Payroll Summary, P32 report)'],
        ['id' => 29, 'sn' => 13,'assignment_type' => 'bookkeeping', 'title' => 'Cash expenses report'],
        
        ['id' => 30, 'sn' => 1,'assignment_type' => 'personal_tax_return', 'title' => 'Source of Income'],
        ['id' => 31, 'sn' => 2,'assignment_type' => 'personal_tax_return', 'title' => 'Employment'],
        ['id' => 32, 'sn' => 3,'assignment_type' => 'personal_tax_return', 'title' => 'Pension Income'],
        ['id' => 33, 'sn' => 4,'assignment_type' => 'personal_tax_return', 'title' => 'Self Employment'],
        ['id' => 34, 'sn' => 5,'assignment_type' => 'personal_tax_return', 'title' => 'UK Property'],
        ['id' => 35, 'sn' => 6,'assignment_type' => 'personal_tax_return', 'title' => 'Partnership'],
        ['id' => 36, 'sn' => 7,'assignment_type' => 'personal_tax_return', 'title' => 'Interest Income'],
        ['id' => 37, 'sn' => 8,'assignment_type' => 'personal_tax_return', 'title' => 'Dividend Income'],
        ['id' => 38, 'sn' => 9,'assignment_type' => 'personal_tax_return', 'title' => 'Foreign Income'],
        ['id' => 39, 'sn' => 10,'assignment_type' => 'personal_tax_return', 'title' => 'Capital Gain'],
        ['id' => 40, 'sn' => 11,'assignment_type' => 'personal_tax_return', 'title' => 'Any Other Income'],
        ['id' => 41, 'sn' => 12,'assignment_type' => 'personal_tax_return', 'title' => 'Last Year Tax Return'],
        ['id' => 42, 'sn' => 13,'assignment_type' => 'personal_tax_return', 'title' => 'Payment On Account'],
        ['id' => 43, 'sn' => 14,'assignment_type' => 'personal_tax_return', 'title' => 'Any Other Info'],
    ];
}

function getChecklistByAssignmentType($type)
{
    $checklists = getAllChecklists();
    return array_filter($checklists, function ($item) use ($type) {
        return strtolower($item['assignment_type']) === strtolower($type);
    });
}


if (! function_exists('getAssignmentTypeOptions')) {
    function getAssignmentTypeOptions(): array
    {
        return [
            'year_end_account'     => 'year_end_account',
            'bookkeeping'          => 'bookkeeping / VAT',
            'personal_tax_return'  => 'personal_tax_return',
            'other'                => 'Other',
        ];
    }
}
function generate_job_title($client_name, $assignment_type,$year_end,$created_date) {
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



