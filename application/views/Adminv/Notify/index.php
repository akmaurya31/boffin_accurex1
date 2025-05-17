<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Notify Job Lists</h4>
            </div>
        </div>
        
        <style>
            .hide{
                display: none !important;
            }
            .show{
                display: block;
            }
            .card-block{
                padding: 15px;
                border: 1px solid #dee2e6;
            }
            .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
                color: #ffffff;
                background-color: #f75c1e;
                border-color: #f75c1e #f75c1e #f75c1e;
            }
            .btn-light{
                border-color: #dae0e5;
            }
            .modal-backdrop.show{
                opacity: 0.5 !important;
            }
            .modal-backdrop {
                background-color: #000000;
            }
            .modal-lg, .modal-xl {
                max-width: 95%;
            }
            
            .card-box{
                padding:15px;
            }
            .card-box h4{
                margin: 0px;
            }
            .history-ul li > .fa{
                color:#f75c1e;
                margin-right: 15px;
                font-size: 20px;
            }
            .history-ul{
                padding: 0px;
                list-style: none;
            }
            .history-ul > li{
                display: flex;
                align-items: center;
            }
            
            .history-ul .custom-badge{
                margin-right:15px;
            }
            
            .modal-header{
                background: #f75c1e;
                color: #fff;
                font-weight: 300;
            }
            .modal-title{
                font-weight: 300;
            }
            button.close,button.close:hover{
                opacity: 1;
                color:#fff;
            }
            
            #jobs th, #jobs td{
                text-wrap-mode: nowrap;
            }
            
    </style>
    
    <?php 
        $a = $b = $c = $d = '';
        switch ($uri2) {
          case "Client":
            $a = "active";
            break;
          case "Employee":
            $b = 'active';
            break;
          default:
            $a = "active";
        }
    
    ?>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                
                <div class="car-header">
                    <ul class="nav nav-tabs">

                    
                        
                        <li class="nav-item">
                            <a class="nav-link <?php echo $a;?>" href="<?php echo base_url('AdminEmpNotify/Client');?>" id="tabs-client-notification">
                                Client(s) Notification <span class="badge badge-pill text-dark bg-danger float-right"> 2</span>
                            
                            </a>
                        </li>
                        
                        <li class="nav-item ">
                            <a class="nav-link <?php echo $b;?>"  href="<?php echo base_url('AdminEmpNotify/Employee');?>" id="tabs-employee-notification">Employee (s) Notification <span class="badge badge-pill text-dark bg-danger float-right"> 1</span>
                            </a>
                        </li>
                      
                    </ul>

<!-- 🔍 Common Search Inputs -->
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr colspan="7">
                <th style="width: 140px;"><input type="text" class="form-control" placeholder="Please Enter Searching Keywords"></th>
            </tr>
        </thead>
    </table>
</div>


                </div>
                
                <div class="card-block">
                    <?php if($uri2 == 'Client'){?>
                         
                        <div class="row form-group">
                            <div class="col-md-12 tab-pane fade1" id="tabs-Client-notification" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="jobs">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Client Name</th>
                                                <th>Job Code</th>
                                                <th>Job Name</th>
                                                <th>Emp Job Status</th>
                                                <th>Job Comment</th>
                                                <th>Attachments</th>
                                                <th>Recieved On</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabContent-Client">
                                        </tbody>
                                    </table>
                                    <nav><ul id="pagination-Client" class="pagination"></ul></nav>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    
                    <?php if($uri2 == 'Employee'){?>
                       
                        
                        <div class="row form-group">
                            <div class="col-md-12 tab-pane fade1" id="tabs-Employee-notification" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered"  id="jobs">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee Name</th>
                                                <th>Job Code</th>
                                                <th>Job Name</th>
                                                <th>Emp Job Status</th>
                                                <th>Employee Comment</th>
                                                <th>Recieved On</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabContent-Employee">
                                        </tbody>
                                    </table>
                                    <nav><ul id="pagination-Employee" class="pagination"></ul></nav>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    
                </div>
            </div>
        </div>
    </div>

</div>
</div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script>

$(document).ready(function () {
    // 1. Set jobcode and jid when modal is triggered
    $(document).on('click', '[data-toggle="modal"][data-target="#QassignJobModel"]', function () {
        var jobcode = $(this).data('jjobcode');
        var jid = $(this).data('jjid');
        $('#jjobcode').val(jobcode);
        $('#jjid').val(jid);
    });

    // 2. Handle form submission
    $('#assignJobForm').on('submit', function (e) {
        e.preventDefault(); // Stop default form submission

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('AdminEmpNotify/assignuseronjob'); ?>", // Replace 'YourController' with actual controller
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === true) {
        
                    // alert('Job assigned successfully!');
                    $('#QassignJobModel').modal('hide');
                    $('#assignJobForm')[0].reset();
                    toastr.success(response.message);
                     setTimeout(function() {
                        location.reload();
                    }, 500); 
                } else {
                    // alert('Failed: ' + response.message);
                      toastr.error(response.message);
                }
            },
            error: function (xhr) {
                // alert('An error occurred. Please try again.');
                console.log(xhr.responseText);
            }
        });
    });
});

$(document).on('click', '[data-toggle="modal"][data-target="#QassignJobModel"]', function () {
    var jjobcode = $(this).data('jjobcode');
    var jjid = $(this).data('jjid');

    $('#jjid').val(jjid);
    $('#jjobcode').val(jjobcode);
});

function formatDate(dateStr) {
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months start from 0
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

$(document).ready(function () {
    let FullcurrentTab = "<?php echo $uri2; ?>";
    let currentTab = FullcurrentTab.replace('-job', '');
    let currentPage = "<?php echo (!empty($RecievedClientsJob_page) && $RecievedClientsJob_page != 0) ? $RecievedClientsJob_page : 1; ?>";

    function loadJobs(tabType, page = 1) {
        currentTab = tabType;
        currentPage = page;
        var r1 = '.table-responsive input.form-control';
        let searchInputs = {};
        $(r1).each(function (index) {
            searchInputs['search' + index] = $(this).val(); // Collect all search inputs
        });

        $.ajax({
            url: "<?= base_url('AdminEmpNotify/fetch_paginated_jobs') ?>",
            method: "GET",
            data: {
                status: tabType,
                page: page,
                limit: 20,
                ...searchInputs // spread search inputs into query
            },
            dataType: 'json',
            success: function (rdata) {
                let rows = '';
                if(rdata.length === 0){
                    rows = `<tr><td colspan="7">No data found</td></tr>`;
                } else {
                    let i=0;
                    rdata.jobs.forEach(job => {
                        const jobDate = formatDate(job.created_at); 
                        i++;
                        rows += `
                            <tr>
                                <td>${i}</td>
                                <td>${job.employee}</td>
                                <td>${job.jobcode} </td>
                                <td>${job.job_name}</td>
                                <td>${job.emp_status_name}</td>
                                <td>${job.message}</td>
                                <td>${formatDateDMY(job.created_at)}</td>
                            </tr>`;
                    });
                }
                $(`#tabContent-${tabType}`).html(rows);
                //$(`#tbdraft`).html(rows);
                
                var totalRecords = rdata.total; // e.g. 157
                var perPage = 20;
                var totalPages = Math.ceil(totalRecords / perPage);

                let paginationHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    paginationHTML += `<li class="page-item"><a class="page-link" href="#">${i}</a></li>`;
                }

                $('.pagination').html(paginationHTML);
            },
            error: function () {
                $(`#tabContent-${tabType}`).html("<tr><td colspan='7'>Error loading data</td></tr>");
            }
        });
    }

    // Initial Load
    loadJobs(currentTab, currentPage);

    // On Tab Click
    $('.nav-link').on('click', function () {
        const tabId = $(this).attr("id");
        const tabType = tabId.split('-')[1];
        loadJobs(tabType, 1);
    });

    // On Pagination Click
    $(document).on('click', '.pagination .page-link', function (e) {
        e.preventDefault();

        const $this = $(this);
        const page = parseInt($this.text());

        if (isNaN(page)) return;

        // Identify current tab by checking parent container
        const parentTab = $this.closest('.tab-pane').attr('id'); // like 'tabs-live', 'tabs-hold'

        // Derive tab key
        let tabKey = '';
        if (parentTab === 'tabs-live') tabKey = 'live';
        else if (parentTab === 'tabs-hold') tabKey = 'hold';
        else if (parentTab === 'tabs-completed') tabKey = 'completed';
        else if (parentTab === 'tabs-draft') tabKey = 'draft';

        // Call your loadJobs function with tab key and page
        // alert(tabKey);
        if (tabKey) {
            loadJobs(tabKey, page);
        }
    });

    // On Search Input Change
    $(document).on('input', 'input.form-control', function () {
        loadJobs(currentTab, 1);
    });
});




function getJobDetails(element) {
    var jobName = $(element).data('job_name');
    var jobCode = $(element).data('jobcode');
    var base_url = "<?= base_url(); ?>";

    $.ajax({
        url: base_url + 'clients/get_job_details', // <-- Controller ka URL
        type: 'GET',
        data: { jobcode: jobCode },
        dataType: 'json',
        success: function(response) {
            console.log(response);

            // yahan apni modal me set karo details
            // Example:
            $('.modal-jobname').text(response.job.job_name);
            $('.modal-jobcode').text(response.job.jobcode);

            // checklist ko loop karke show karo
            var checklistHTML = '';
            if (response.checklist.length > 0) {
                response.checklist.forEach(function(item) {
                    checklistHTML += '<li>' + item.item_name + '</li>';
                });
            }
            $('.modal-checklist').html(checklistHTML);

            // attachments ko loop karke show karo
            var attachmentHTML = '';
            if (response.attachments.length > 0) {
                response.attachments.forEach(function(file) {
                    attachmentHTML += '<a href="' + file.file_path + '" target="_blank">View File</a><br>';
                });
            }
            $('.modal-attachments').html(attachmentHTML);

            // Ab Modal show karo
            CshowPreviewModal(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

function CshowPreviewModal(rs) {

    const assignmentSort = {
        'year_end_account':    'Year End Account',
        'bookkeeping':         'Bookkeeping / VAT',
        'personal_tax_return': 'Personal Tax Return',
        'other':               'Other'
    };

    // $('.iAddComm').show();
    // $('.fldother').hide();
    // if (rs.job.assignment_type === 'other') {
    // } else if (rs.job.assignment_type === 'other') {
    // } else if (rs.job.assignment_type === 'other') {
    // }else{
    // }
    // else{
    //     $('.iAddComm').hide();
    //     $('.fldother').show();
    // }

    $('.m_assignment').text(assignmentSort[rs.job.assignment_type]);
    $('.m_client').text(rs.job.client_name);
    $('.m_person').text(rs.job.contact_person);
    $('.m_email').text(rs.job.email_address);
    $('.m_taxyear').text(rs.job.year_end);


    if(rs.job.assignment_type=='year_end_account'){
        $('.div_qtr_year_end').hide();
        $('.iAddComm').hide();
        $('.otherAccountancy').show();
        $('#tyear').text('Year End:');
    }else if(rs.job.assignment_type=='bookkeeping'){
        $('.div_qtr_year_end').show();
        $('.iAddComm').hide();
        $('.otherAccountancy').show();
        $('#tyear').text('Year:');
    }else if(rs.job.assignment_type=='personal_tax_return'){
        $('.iAddComm').hide();
        $('.otherAccountancy').show();
        $('#tyear').text('Tax Year:');
    }else if(rs.job.assignment_type=='other'){
        $('.iAddComm').show();
        $('.otherAccountancy').hide();
        $('#tyear').text('Year:');
    }

    $('.m_qtr_year_end').text(rs.job.qtr_year_end);
    $('.m_budget').text(rs.job.budgeted_hours);
    $('.m_fee').text(rs.job.accountancy_fee_net);
    $('.m_comments').text(rs.job.additional_comment);
    $('.om_comments').text(rs.job.additional_comment);
    
    DisplayChecklist(rs)
    multipleAttach(rs)
}

        function multipleAttach(rs){
            
			let validAttachments = rs.attachments; // Get all file objects
			const $tbodyattachmentView = $('.attachmentView');
			$tbodyattachmentView.empty();

			// let validAttachments = attachments.filter(file => {
			// 	// Filter out invalid or empty files
			// 	return file instanceof File && file.size > 0 && file.name;
			// });

			if (validAttachments.length === 0) {
				// No valid attachments
				$tbodyattachmentView.append(`
					<tr>
						<td colspan="3" class="text-center text-muted">No valid attachments found</td>
					</tr>
				`);
			} else {
				// Loop through valid files only

 
				validAttachments.forEach(file => {
                    const fileName = file.file_path.split('/').pop(); // Extract file name from file path
                    const fileType = file.file_path.split('.').pop() || 'Unknown'; // Extract file extension as type
                    let FS=convertKBtoMB(file.file_size || 0);
                    // const fileSize = (FS / (1024 * 1024)).toFixed(2) + ' MB'; // Convert size to MB
                    // let filek=calculateSingleFileDetails(file);
                    // console.log(filek);

					$tbodyattachmentView.append(`
						<tr>
							<td>${fileName}</td>
							<td>${fileType}</td>
							<td>${FS}</td>
						</tr>
					`);
				});
			}

		}


        function DisplayChecklist(rs) {
    const items = rs.checklists;
    const dbitems = rs.checklist;
    const $tbody = $('.previewEmployement');
    $tbody.empty();

    const assignment = rs.job.assignment_type;

    const assignmentSort = {
        'year_end_account':    'yea',
        'bookkeeping':         'book',
        'personal_tax_return': 'ptr',
        'other':               'oth'
    };

  
    
    Object.values(items).forEach((item, idx) => {
        // Modify assignment_type if it's 'bookkeeping'

        const assignmentLabelShort = assignmentSort[item.assignment_type] || assignment;

        // item.assignment_type
        let k  =`${assignmentLabelShort}_employment_${item.sn}`;

        // if (item.assignment_type === 'bookkeeping') {
        //     item.assignment_type = 'book_employment_';
        // }

        // Generate the key to search in dbitems
      //  let k = `${item.assignment_type}${item.sn}`;
        
        // Find the corresponding item in dbitems
        let bls = dbitems.find(dbItem => dbItem.checklist_id === k);
        let finalval = 'No'; 
        if (bls !== undefined) {
            finalval = 'Yes';
        }
        // If bls is undefined, set finalval as 'No'
        // const finalval = bls?.status === 'on' ? 'Yes' : 'No';

        // If bls is not found, display a default message in the comment column
        const checklistComment = bls?.checklist_comment || 'No comment';

        // Append the row to the table
        $tbody.append(`
            <tr>
                <td width="50">${idx + 1}</td>
                <td>${item.title}</td>
                <td>${finalval}</td>
                <td width="200">${checklistComment}</td>
            </tr>
        `);
    });
}
 function convertKBtoMB(kb) {
        const mb = (kb / 1024)/100;
        return mb.toFixed(2) + ' MB';
    }
</script>
