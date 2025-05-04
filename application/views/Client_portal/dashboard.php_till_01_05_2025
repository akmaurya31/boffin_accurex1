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
</style>
<?php include('navigation.php');?>
<div class="page-content">
  <!-- Breadcrumb -->
  </div>

   <!-- Dashboard Header -->
    <div class="container">
	<div class="container">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
    </div>
	    <div class="dashboard-tab-wrapper mb-3">
		  <div class="dashboard-tab">DASHBOARD</div>
		  <div class="dashboard-line"></div>
	    </div>
		
	    <div class="row mt-3">
	    <!-- Completed Jobs -->
	    	<div class="col-md-8">
	      <div class="section-header">Today's Completed Jobs (<span id="countCJ">0</span>)</div>
	      <div class="box">
	        <div class="form-row mb-3">
	          <div class="col">
				<input type="text" class="form-control" id="searchJobCode" placeholder="Job Code">
	          </div>
	          <div class="col">
			   <input type="text" class="form-control" id="searchJobName" placeholder="Job Name">
	          </div>
	        </div>
	        <table class="table table-bordered table-sm table-striped table-hover table-bordered">
	          <thead>
	            <tr>
	              <th>Job Code</th>
	              <th>Job Name</th>
	            </tr>
	          </thead>
			  <tbody id="jobListBody">
	            
	          </tbody>
	        </table>
	      </div>
		      <nav><ul id="pagination" class="pagination"></ul></nav>
	    	</div>
		
	     <div class="col-md-4">
	      <div class="section-header">Job Status</div>
	      <div class="box text-center">
	        <canvas id="jobStatusChart"></canvas>
	      </div>
	    </div>
	  </div>
	</div>  
	


	<script>

let currentPage = 1;
let searchTerm = '';

function loadJobs(page = 1, search = '') {
    $.ajax({
        url: "<?= base_url('Clients/fetch_paginated_jobs') ?>",
        method: 'GET',
        data: { page: page, limit: 20, search: search },
        dataType: 'json',
        success: function (res) {
            let html = '';
            res.jobs.forEach(job => {
                html += `<tr><td>${job.job_code}</td><td>${job.job_name}</td></tr>`;
            });
            $('#jobTable tbody').html(html);

            const totalPages = Math.ceil(res.total / 20);
            renderPagination(totalPages, page);
        }
    });
}
 

function renderPagination(totalPages, currentPage) {
    let html = '';
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#">${i}</a>
                 </li>`;
    }
    $('#pagination').html(html);
}

$(document).on('click', '#pagination .page-link', function (e) {
    e.preventDefault();
    currentPage = parseInt($(this).text());
    loadJobs(currentPage, searchTerm);
});

$('#searchInput').on('keyup', function () {
    searchTerm = $(this).val();
    loadJobs(1, searchTerm);
});

$(document).ready(function () {
    loadJobs();
});


	</script>


<script>
// let currentPage = 1;

function loadCompletedJobs(page = 1) {
    const jobCode = $('input[placeholder="Job Code"]').val();
    const jobName = $('input[placeholder="Job Name"]').val();

    $.ajax({
        url: "<?= base_url('Clients/fetch_completed_jobs_today') ?>",
        type: 'GET',
        data: {
            page: page,
            limit: 20,
            job_code: jobCode,
            job_name: jobName
        },
        dataType: 'json',
        success: function(response) {
            let rows = '';
            response.jobs.forEach(job => {
                rows += `<tr><td>${job.jobcode}</td><td>${job.job_name}</td></tr>`;
            });
            $('table tbody').html(rows);
			$('#countCJ').html(response.total)

            let totalPages = Math.ceil(response.total / 20);
            renderPagination(totalPages, page);
        }
    });
}

function renderPagination(totalPages, currentPage) {
    let html = '';
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                   <a class="page-link" href="#">${i}</a>
                 </li>`;
    }
    $('#pagination').html(html);
}

$(document).on('click', '#pagination .page-link', function(e) {
    e.preventDefault();
    currentPage = parseInt($(this).text());
    loadCompletedJobs(currentPage);
});

$('input[placeholder="Job Code"], input[placeholder="Job Name"]').on('keyup', function() {
    loadCompletedJobs(1);
});

$(document).ready(function() {
    loadCompletedJobs();
});
</script>



<script>
//   let currentPage = 1;

  
  // Search on typing (with delay)
  let searchTimer;
  $('#searchJobCode, #searchJobName').on('keyup', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
      loadJobs(1); // Search always loads from page 1
    }, 500);
  });

  // Load first page on ready
  $(document).ready(function() {
    loadJobs(1);
  });
</script>





<?php include('footer.php');?>
