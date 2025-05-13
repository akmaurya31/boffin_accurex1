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
	.modal-title {
        margin-bottom: 0;
        line-height: 1.5;
        font-size: 20px;
        color: #14264e;
    }


    /*.isread{  background-color:rgb(214, 238, 227); }*/
    .isunread{  background-color:rgb(243 252 255);font-weight: 600;}
    
    .notification{
        background: #fff;
        padding: 20px 20px;
    }
    
</style>
<?php include('navigation.php');?>
<div class="page-content">
  <!-- Breadcrumb -->
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Notification</li>
    </ol>
  </div>
   <!-- Dashboard Header -->
    <div class="container">
	    <div class="dashboard-tab-wrapper mb-3">
		  <div class="dashboard-tab">NOTIFICATION</div>
		  <div class="dashboard-line"></div>
	    </div>
	    <div class="notification">
	        <div class="table-responsive">
                <table  id="notifications-table"  class="table table-bordered table-hover ">
                    <thead>
                        <tr>
                            <th width="80">Sr. No.</th>
                            <th>Job Heading</th>
                            <th width="180">Status</th>
                            <th width="180">Sub status</th>
                            <th width="200">Date</th>
                            <!-- <th width="80">Read</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01.</td>
                            <td> Meena Kumari-PTR-05-04-2020(RS) </td>
                            <td><span class="success-badge">Job Completed</span></td>
                            <td>12 April 2025, 10:30PM</td>
                            <!-- <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#viewNotification"><i class="fa fa-eye"></i></a>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
                <div id="pagination">
                    <!-- Pagination links will be dynamically added here -->
                </div>
    	    </div>    
	    </div>
        
	</div>
</div>


<script>
let statusMap = {}; // Will hold { id: { name, class }, ... }

// Function to render the status cell, now uses the statusMap
function renderStatusCell(statusId) {
  return `<span class="${statusMap[statusId]?.class || 'badge badge-secondary'}">${statusMap[statusId]?.name || 'Unknown'}</span>`;
}

// Function to load notifications for a given page
function loadNotifications(page) {
  $.ajax({
    url: '<?= base_url("Notifications/load_notifications") ?>', // PHP endpoint
    method: 'GET',
    data: { page: page }, // Send the current page number
    dataType: 'json', // Expect JSON response
    success: function (response) {
      var notifications = response.jobs;
      console.log(typeof notifications); 
      var pagination = response.pagination;

      // Empty table before adding new rows
      $('#notifications-table tbody').empty();

      // Append new notifications to the table
      notifications.forEach(function (notification, index) {
        // Use the status from the notification object.
        const statusHTML = renderStatusCell(notification.status);

        $('#notifications-table tbody').append(`
          <tr class="${notification.notifi_isread}"  data-id="${notification.notif_id}"> 
            <td>${(page - 1) * 20 + (index + 1)}</td>
            <td>${notification.job_name}</td>
            <td><span class="badge ${notification.badge_color}">${notification.status_name}  </span></td>
            <td><span > ${notification.sub_status}</span></td>
            <td>${notification.created_at}</td>
          </tr>
        `);
      });

      // Update pagination links
      $('#pagination').html(pagination);
    },
    error: function () {
      alert('Failed to load notifications.');
    }
  });
}

$(document).ready(function () {
  // Fetch all statuses on page load
  $.getJSON('<?= base_url('Notifications/status_lookupall') ?>')
    .done(function (data) {
      statusMap = data; // Store the status map
      // Now that we have the map, load page 1 of notifications
      loadNotifications(1);
    })
    .fail(function () {
      alert('Could not load status mappings.');
    });

  // On page click (event delegation)
  $(document).on('click', '.pagination-link', function (e) {
    e.preventDefault();
    var page = $(this).data('page');
    loadNotifications(page);
  });
});



</script>
<?php include('footer.php');?>
