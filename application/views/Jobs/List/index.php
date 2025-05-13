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
        switch ($section) {
          case "draft":
            $a = "active";
            break;
          case "on_hold":
            $b = 'active';
            break;
          case "completed":
            $c = 'active';
            break;
          case "live_job":
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
                            <a class="nav-link <?php echo $a;?>" id="tabs-draft-tab" >Draft Job</a>
                        </li>
                        
                        <li class="nav-item ">
                            <a class="nav-link <?php echo $d;?>" id="tabs-live-tab"  >Live Job</a>
                        </li>
                      
                        <li class="nav-item"> 
                            <a class="nav-link <?php echo $b;?>" id="tabs-hold-tab"  >On Hold Job</a>
                        </li>
                          
                        <li class="nav-item">
                            <a class="nav-link <?php echo $c;?>" id="tabs-completed-tab"  >Completed Job</a>
                        </li>
                      
                    </ul>
                </div>
                
                <div class="card-block">
                    <?php if($section == 'live_job'){?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="search-box">
                                    <input type="search" class="form-control" name="search" placeholder="Please Enter Searching Keywords">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-12 tab-pane fade1" id="tabs-live" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code1</th>
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
                    
                    <?php if($section == 'on_hold'){?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="search-box">
                                    <input type="search" class="form-control" name="search" placeholder="Please Enter Searching Keywords">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col-md-12 tab-pane fade1" id="tabs-hold" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code2</th>
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
                    
                    <?php if($section == 'completed'){?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="search-box">
                                    <input type="search" class="form-control" name="search" placeholder="Please Enter Searching Keywords">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                          <div class="col-md-12 tab-pane fade1" id="tabs-completed" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code3</th>
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
                    
                    <?php if($section == 'draft'){?>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <div class="search-box">
                                    <input type="search" class="form-control" name="search" placeholder="Please Enter Searching Keywords">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                             <div class="col-md-12 tab-pane fade1" id="tabs-draft" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Job Code4</th>
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
    let currentTab = "draft";
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
                                <td>${job.employee}</td>
                                <td class="actions">
                                    <a href="<?php echo base_url('clientJobHistories');?>/${job.jobcode}" class="btn btn-light btn-search"><i class="fa fa-search"></i></a>
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

</script>
