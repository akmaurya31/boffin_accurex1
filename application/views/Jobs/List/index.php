<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Recived Client Job Lists</h4>
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
            
    </style>
    
    <?php 
        $a = $b = $c = $d = '';
        switch ($uri2) {
          case "draft-job":
            $a = "active";
            break;
          case "hold-job":
            $b = 'active';
            break;
          case "completed-job":
            $c = 'active';
            break;
          case "live-job":
            $d = 'active';
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
                            <a class="nav-link <?php echo $a;?>" href="<?php echo base_url('RecievedClientsJob/draft-job');?>" id="tabs-draft-tab" >Draft Job</a>
                        </li>
                        
                        <li class="nav-item ">
                            <a class="nav-link <?php echo $d;?>"  href="<?php echo base_url('RecievedClientsJob/live-job');?>" id="tabs-live-tab"  >Live Job</a>
                        </li>
                      
                        <li class="nav-item"> 
                            <a class="nav-link <?php echo $b;?>" href="<?php echo base_url('RecievedClientsJob/hold-job');?>" id="tabs-hold-tab"  >On Hold Job</a>
                        </li>
                          
                        <li class="nav-item">
                            <a class="nav-link <?php echo $c;?>" href="<?php echo base_url('RecievedClientsJob/completed-job');?>" id="tabs-completed-tab"  >Completed Job</a>
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
                    <?php if($uri2 == 'live-job'){?>
                         
                        <div class="row form-group">
                            <div class="col-md-12 tab-pane fade1" id="tabs-live" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code</th>
                                                <th>Job Name</th>
                                                <th>Status</th>
                                                <th>Sub Status</th>
                                                <th>Received On</th>
                                                <!-- <th>Job Comment</th> -->
                                                <th>Assigned to</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabContent-live">
                                        </tbody>
                                    </table>
                                    <nav><ul id="pagination-live" class="pagination"></ul></nav>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    
                    <?php if($uri2 == 'hold-job'){?>
                       
                        
                        <div class="row form-group">
                            <div class="col-md-12 tab-pane fade1" id="tabs-hold" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code</th>
                                                <th>Job Name</th>
                                                <th>Status</th>
                                                <th>Sub Status</th>
                                                <th>Received On</th>
                                                <!-- <th>Job Comment</th> -->
                                                <th>Assigned to</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabContent-hold">
                                        </tbody>
                                    </table>
                                    <nav><ul id="pagination-hold" class="pagination"></ul></nav>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    
                    <?php if($uri2 == 'completed-job'){?>
                      
                        
                        <div class="row form-group">
                          <div class="col-md-12 tab-pane fade1" id="tabs-completed" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code</th>
                                                <th>Job Name</th>
                                                <th>Status</th>
                                                <th>Sub Status</th>
                                                <th>Received On</th>
                                                <!-- <th>Job Comment</th> -->
                                                <th>Assigned to</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabContent-completed">
                                        </tbody>
                                    </table>
                                     <nav><ul id="pagination-completed" class="pagination"></ul></nav>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                    
                    <?php if($uri2 == 'draft-job'){?>
                        
                        
                        <div class="row form-group">
                             <div class="col-md-12 tab-pane fade1" id="tabs-draft" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code</th>
                                                <th>Job Name</th>
                                                <th>Status</th>
                                                <th>Sub Status</th>
                                                <th>Received On</th>
                                                <!-- <th>Job Comment</th> -->
                                                <th>Assigned to</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabContent-draft">
                                        </tbody>
                                    </table>
                                     <nav><ul id="pagination-draft" class="pagination"></ul></nav>
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
 <div class="modal fade up" id="QassignJobModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="assignJobForm">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Assigned to Job To User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Select User</label>
                <input type="hidden" class="form-control" id="jjid" name="jid">
                <input type="hidden" class="form-control" id="jjobcode" name="jobcode">

                <select class="form-control" name="user" required>
                  <option value="">Please Select...</option>
                  <?php foreach ($userlist as $u) { ?>
                    <option value="<?php echo $u->user_ID; ?>">
                      <?php echo $u->full_name; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label>Comments</label>
                <textarea name="comments" rows="5" class="form-control" required></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="jobDetailModal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="jobDetailLabel">Preview Job Detail</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                  <th>Type of assignment:</th>
                  <td class="m_assignment">Tax return</td>
                </tr>
                <tr>
                  <th>Name of client:</th>
                  <td class="m_client"></td>
                </tr>
                <tr>
                  <th>Contact Name:</th>
                  <td class="m_person"></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td class="m_email"></td>
                </tr>

                <tr class="div_qtr_year_end">
                  <th>Quarter/Period:</th>
                  <td class="m_qtr_year_end"></td>
                </tr>

                <tr class="otherTaxyear fldother">
                  <th id="tyear">Tax Year:</th>
                  <td class="m_taxyear"></td>
                </tr>

                <tr>
                  <th>Budgeted hours:</th>
                  <td class="m_budget"></td>
                </tr>
                <tr>
                  <th>Accountancy Fees (Net):</th>
                  <td class="m_fee"></td>
                </tr>
                <tr class="otherAccountancy fldother">
                  <th>Additional Comments:</th>
                  <td class="m_comments"></td>
                </tr>
            </table>

			<table class="table table-bordered">
				<thead>
					<tr>
					<th>File Name</th>
					<th>Type</th>
					<th>Size</th>
					</tr>
				</thead>
				<tbody class="attachmentView">
					<tr>
						<td>My File Name 1</td>
						<td>PDF</td>
						<td>1.2 MB</td>
					</tr>
					<tr>
						<td>My File Name 2</td>
						<td>DOCX</td>
						<td>900 KB</td>
					</tr>
					<tr>
						<td>My File Name 3</td>
						<td>PNG</td>
						<td>2.5 MB</td>
					</tr>
				</tbody>
				</table>

          </div>
          <div class="col-md-6">
            <table class="table table-bordered">
				<tbody class="iAddComm L714">
					<tr class="">
						<th>Additional Comments:</th>
					</tr>
                    <tr>
                        <td class="om_comments"></td>
                    </tr>
				</tbody>
			</table>
            <table class="table table-bordered">
              <tbody class="previewEmployement L399">
			    <tr>
                    <td width="50">1</td>
                    <td>Employment</td>
                    <td>Yes</td>
                    <td width="200"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pension Income</td>
                    <td>No</td>
                    <td></td>
                </tr>
			  </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm dismiss" data-dismiss="modal">Close</button>
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
            url: "<?php echo base_url('RecievedClientsJob/assignuseronjob'); ?>", // Replace 'YourController' with actual controller
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
            url: "<?= base_url('RecievedClientsJob/fetch_paginated_jobs') ?>",
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
                    rdata.jobs.forEach(job => {
                        const jobDate = formatDate(job.created_at); 
                        rows += `
                            <tr>
                                <td>${job.jobcode}</td>
                                <td>${job.job_name}</td>
                                <td><span class='badge ${job.badge_color} '>${job.status_name}</span></td>
                                <td>${job.sub_status}</td>
                                <td>${jobDate}</td>
                                <td>${job.employee ?? ''}</td>
                                <td class="actions">
                                    <a href="<?php echo base_url('RecievedClientsJobHistories');?>/${job.jobcode}" class="btn btn-light btn-search"><i class="fa fa-search"></i></a>
                                    <a href="javascript:void(0);" 
                                        class="btn btn-light btn-folder" 
                                        data-toggle="modal" 
                                        data-target="#jobDetailModal" 
                                        data-jobcode="${job.jobcode}"
                                        data-job_name="${job.job_name}"
                                        onclick="getJobDetails(this)">
                                        <i class="fa fa-folder"></i>
                                    </a>
                                    <button type="button" class="btn btn-light" 
                                        data-toggle="modal"
                                        data-jjobcode="${job.jobcode}"
                                        data-jjid="${job.id}"
                                        data-target="#QassignJobModel" 
                                        data-backdrop="static" 
                                        data-keyboard="false">
                                        <i class="fa fa-user-plus"></i>    
                                    </button>
                                </td>
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
