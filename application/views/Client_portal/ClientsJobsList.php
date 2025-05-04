<?php include('header.php');?>
<style type="text/css">
	.logo{
		width: 100%;
	}
	nav#uk_header {
	    /* border-bottom: 1px solid #ccc; */
	    box-shadow: 0px 0px 5px 0px #ccc;
	    background: #fff;
	}
	.navbar>.container-fluid{
		display: block;
	}

	.nav-link{
		font-weight: 500;
	    color: #14264d;
	    font-family: system-ui;
	    font-size: 16px;
	}
	li.nav-item {
	    padding: 0px 15px;
	}
	.user {
	    border-left: 2px solid #182a50;
	    padding-left: 15px;
	    color: #14264d;
	    font-weight: 500;
	}
	.page-content{
		margin-top: 100px;
	}
	.section-header {
      background-color: #14264d;
      color: white;
      padding: 10px 20px;
      font-weight: bold;
    }
    .box {
      background-color: white;
      padding: 15px;
      border-radius: 4px;
      margin-bottom: 20px;
    }
    .breadcrumb {
      background-color: transparent;
      padding-left: 0;
    }
    body{
    	background: #0002390d;
    }
    .dashboard-tab-wrapper {
	  position: relative;
	  margin-bottom: 15px;
	}

	.dashboard-tab {
	  background-color: #14264d;
	  color: white;
	  font-weight: bold;
	  padding: 10px 25px;
	  display: inline-block;
	  border-top-left-radius:10px;
	  border-top-right-radius: 10px;
	  border-bottom-right-radius: 0;
	  border-bottom-left-radius: 0;
	}

	.dashboard-line {
	  height: 2px;
	  background-color: #14264d;
	  width: 100%;
	  margin-top: -2px;
	}
	.breadcrumb-item a{
		color: #14264d;
	}

	.navbar{
		padding: 1rem 1rem;
	}
	#pills-tab .nav-item{
	    padding: 0px;
	}
	.jobTabs {
        background: #fff;
        padding: 20px 20px;
    }
    
    td.actions a {
        border: 1px solid #ccc;
        padding: 5px 8px;
        font-size: 14px;
        margin: 2px;
        color: #14264d;
        text-decoration: none;
    }
    td, th {
        border: 1px solid #dee2e6;
        font-family: 'Roboto';
        font-size: 14px;
    }
    
    .form-control{
        font-size:14px;
    }
    
    .modal-header{
        border-bottom: 0px;
    }
    .modal-footer{
        border-top: 0px;
    }
    .dismiss {
        border: 1px solid #ccc;
        padding: 5px 30px;
        line-height: 35px;
        font-weight: 600;
    }
    textarea{
            background-color: #f1f5fa!important;
    }
    textarea:focus{
            background-color: #f1f5fa!important;
            border: 1px solid #f1f5fa;
            box-shadow: none!important;
    }
    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
        font-size: 20px;
        color: #14264e;
    }
</style>
<?php include('navigation.php');?>
<div id="toast" class="toast-msg" style="display: none;">Form submitted successfully!</div>
<div class="page-content">
  <!-- Breadcrumb -->
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Jobs<li>
    </ol>
  </div>
   <!-- Dashboard Header -->
    <div class="container">
	    <div class="dashboard-tab-wrapper mb-3">
		  <div class="dashboard-tab">JOBS</div>
		  <div class="dashboard-line"></div>
	   </div>
	    <div class="jobTabs">
            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tabs-live-tab" data-toggle="tab" data-type="live" href="#tabs-live" role="tab" aria-controls="tabs-live" aria-selected="true">Live Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabs-hold-tab" data-toggle="tab" data-type="hold" href="#tabs-hold" role="tab" aria-controls="tabs-hold" aria-selected="false">On Hold Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabs-completed-tab" data-toggle="tab"  data-type="completed" href="#tabs-completed" role="tab" aria-controls="tabs-completed" aria-selected="false">Completed Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tabs-draft-tab" data-toggle="tab" data-type="draft" href="#tabs-draft" role="tab" aria-controls="tabs-draft" aria-selected="false">Draft Job</a>
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

<!-- 🔄 Tab Contents -->
<div class="tab-content" id="tabs-tabContent">

    <!-- ✅ Live Tab -->
    <div class="tab-pane fade show active" id="tabs-live" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job Code</th>
                        <th>Job Name</th>
                        <th>Status</th>
                        <th>Sub Status</th>
                        <th>Recieved On</th>
                        <th>Job Comments</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody id="tabContent-live"></tbody>
            </table>
        </div>
        <nav><ul id="pagination-live" class="pagination"></ul></nav>
    </div>

    <!-- ✅ Hold Tab -->
    <div class="tab-pane fade" id="tabs-hold" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job Code</th>
                        <th>Job Name</th>
                        <th>Status</th>
                        <th>Sub Status</th>
                        <th>Recieved On</th>
                        <th>Job Comments</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody id="tabContent-hold"></tbody>
            </table>
        </div>
        <nav><ul id="pagination-hold" class="pagination"></ul></nav>
    </div>

    <!-- ✅ Completed Tab -->
    <div class="tab-pane fade" id="tabs-completed" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job Code</th>
                        <th>Job Name</th>
                        <th>Status</th>
                        <th>Sub Status</th>
                        <th>Recieved On</th>
                        <th>Job Comments</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody id="tabContent-completed"></tbody>
            </table>
        </div>
        <nav><ul id="pagination-completed" class="pagination"></ul></nav>
    </div>

    <!-- ✅ Draft Tab -->
    <div class="tab-pane fade" id="tabs-draft" role="tabpanel">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job Code</th>
                        <th>Job Name</th>
                        <th>Status</th>
                        <th>Sub Status</th>
                        <th>Recieved On</th>
                        <th>Job Comments</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody id="tabContent-draft"></tbody>
            </table>
        </div>
        <nav>
            <ul id="pagination-draft" class="pagination"></ul>
        </nav>
    </div>

</div>



        </div>
	</div>
	  
<!-- modal for send email-->
<div class="modal fade" id="sendEmail" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
   <?= form_open_multipart('jobCommentForm', ['class' => 'client-comment-form', 'autocomplete' => 'off','id'=>'jobCommentForm']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ktitle">--</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Comments:</label>
                <textarea class="form-control kcomments" name="kcomments"  id="kcomments" rows="8"></textarea>
                <input type="hidden" class="form-control" name="kjobcode" id="kjobcode" />
            </div>
            <div class="form-group">
                    <label>Select Attachments <span></span></label>
                    <!-- <input type="file" class="form-control" name="attachement[]"> -->
                    <input type="file" class="form-control" name="attachments[]" multiple accept=".jpeg,.jpg,.png,.webp,.pdf,.doc,.docx,.xls,.xlsx">
                    <span style="font-size: 13px; color: #f65d1f;">Total attachement size upto 100 MB</span>
                    <br/>
                    <span style="font-size: 13px; color: #f65d1f;">JPG, JPEG, PNG, XSLS, DOC, PDF, WEBP</span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="" class="btn btn-sm btn-purple">Submit</button>
          <button type="button" class="btn btn-sm btn-secondary dismiss" data-dismiss="modal">Close</button>
        </div>
    <?= form_close(); ?>
      </div>
    </div>
</div>

<!--- End Send Email Box ----->
<!-- start view job modfal -->
<!-- Start Preview Modal-->
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
                  <th>Contact person Name:</th>
                  <td class="m_person"></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td class="m_email"></td>
                </tr>
                <tr>
                  <th>Tax Year:</th>
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
                <tr>
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
              <tbody class="previewEmployement">
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
<!--EndPreview Modal-->

	<script>

function formatDate(dateStr) {
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months start from 0
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

$(document).ready(function () {
    let currentTab = "live";
    let currentPage = 1;

    function loadJobs(tabType, page = 1) {
        currentTab = tabType;
        currentPage = page;
        var r1 = '.table-responsive input.form-control';
        let searchInputs = {};
        $(r1).each(function (index) {
            searchInputs['search' + index] = $(this).val(); // Collect all search inputs
        });

        $.ajax({
            url: "<?= base_url('Clients/fetch_paginated_jobs') ?>",
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
                                <td>${job.additional_comment}</td>
                                <td class="actions">
                                    <a href="<?php echo base_url('clientJobHistories');?>/${job.jobcode}" class="btn btn-sm btn-search"><i class="fa fa-search"></i></a>
                                    <a href="javascript:void(0);" 
                                        class="btn btn-sm btn-send" 
                                        data-toggle="modal" 
                                        data-target="#sendEmail" 
                                        data-jobcode="${job.jobcode}"
                                        data-job_name="${job.job_name}"
                                        onclick="fillJobName(this)">
                                        <i class="fa fa-send"></i>
                                        </a>

                                    <a href="javascript:void(0);" 
                                        class="btn btn-sm btn-folder" 
                                        data-toggle="modal" 
                                        data-target="#jobDetailModal" 
                                        data-jobcode="${job.jobcode}"
                                        data-job_name="${job.job_name}"
                                        onclick="getJobDetails(this)">
                                        <i class="fa fa-folder"></i>
                                    </a>
                                </td>
                            </tr>`;
                    });
                }

                $(`#tabContent-${tabType}`).html(rows);
                
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
        if (tabKey) {
            loadJobs(tabKey, page);
        }
    });

    // On Search Input Change
    $(document).on('input', 'input.form-control', function () {
        loadJobs(currentTab, 1);
    });
});


function fillJobName(element) {
    var jobName = $(element).data('job_name');
    var jobCode = $(element).data('jobcode');
    $('#kjobcode').val(jobCode);
    // Modal ke andar kisi element me set karenge
    $('.ktitle').text(jobName);
}

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

    $('.m_assignment').text(assignmentSort[rs.job.assignment_type]);
    $('.m_client').text(rs.job.client_name);
    $('.m_person').text(rs.job.contact_person);
    $('.m_email').text(rs.job.email_address);
    $('.m_taxyear').text(rs.job.year_end);
    $('.m_budget').text(rs.job.budgeted_hours);
    $('.m_fee').text(rs.job.accountancy_fee_net);
    $('.m_comments').text(rs.job.additional_comment);
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
               // console.log(validAttachments); die("ASda");
 
				validAttachments.forEach(file => {
                    const fileName = file.file_path.split('/').pop(); // Extract file name from file path
                    const fileType = file.file_path.split('.').pop() || 'Unknown'; // Extract file extension as type
                    // let FS=file.size || 0
                    // const fileSize = (FS / (1024 * 1024)).toFixed(2) + ' MB'; // Convert size to MB
                    // let filek=calculateSingleFileDetails(file);
                    // console.log(filek);

					$tbodyattachmentView.append(`
						<tr>
							<td>${fileName}</td>
							<td>${fileType}</td>
							<td>-</td>
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


<?php if ($this->session->flashdata('success_message')): ?>
    var toast = document.getElementById('toast');
    toast.style.display = 'block';
    setTimeout(function() {
        toast.style.display = 'none';  // Hide after 3 seconds
    }, 3000);
<?php endif; ?>
</script>
<style>
    .toast-msg {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        font-size: 16px;
    }
</style>


<?php include('footer.php');?>
