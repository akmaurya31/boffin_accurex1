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

	.nav-link {
        font-weight: 600;
        color: #14264d !important;
        font-family: 'Roboto';
        font-size: 15px;
    }
	li.nav-item {
	    padding: 0px 15px;
	}
	
    .user a {
        color: rgb(20 38 77);
        text-decoration: none;
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
	
	.btn-purple {
        background-color: #f75c1e;
        color: #fff;
        line-height: 35px;
        font-weight: 600;
        padding: 5px 30px;
    }

    .btn-purple:hover {
        background-color: #14264d;
        color: #fff;
    }

    .text-purple {
        color: #f75c1e;
    }

    .text-purple:hover {
        text-decoration: underline;
    }
    .dismiss {
        border: 1px solid #ccc;
        padding: 5px 30px;
        line-height: 35px;
        font-weight: 600;
    }
    .dismiss:hover{
        background-color: #14264d;
        color: #fff;
    }
    .user.active a {
        color: #14264d;
    }
    .hover-highlight:hover {
        background: linear-gradient(to right, #f0f9ff, #e0f7fa);
        color: #000;
    }
    .dropdown-menu {
        animation: fadeInDown 0.3s ease-in-out;
    }
    @keyframes fadeInDown {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          trans form: translateY(0);
        }
    }
    .btn-outline-primary {
        color: #14264e;
        border-color: #14264e;
    }
    .btn-outline-primary:hover {
        color: #fff;
        background-color: #f65d1f;
        border-color: #f65d1f;
    }
    .list-group a span {
        font-size: 12px;
        font-weight: 500;
    }
    .user {
        border: 2px solid #e7e7e7;
        font-weight: 500;
        padding: 5px 10px;
        background: #e7e7e7;
        border-radius: 50px;
    }
</style>
<?php 
    $uri =  $this->uri->segment(1);
    $userDetails = $this->session->userdata('accurexClientLoginDetails'); 

?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="uk_header">
	<div class="container">
	  <a class="navbar-brand" href="#">
	    <img src="<?php echo base_url('assets/images/logo_client.png');?>" alt="Logo" height="40">
	  </a>

	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
	    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
	    <ul class="navbar-nav">

	      <li class="nav-item <?php if($uri=='ClientDashboard'){ echo "active";}?>">
	        <a class="nav-link" href="<?php echo base_url('ClientDashboard');?>">
		        <i class="fa fa-dashboard"></i> Dashboard
		    </a>
	      </li>
	      <!-- Notification Dropdown Start -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle position-relative" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell-o fa-lg"></i> Notifications
                <span id="notif-count" class="badge badge-danger badge-pill" style="position: absolute; top: 0px; font-size: 12px; left: 15px;">
                  0
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-0 shadow-lg border-0 rounded-lg" aria-labelledby="notifDropdown" style="width: 350px;left: 0px;">
                
                <div id="notif-list" class="list-group list-group-flush">
                   ---
                </div>
                <div class="text-center p-2">
                  <a href="<?php echo base_url('ClientsNotification');?>" class="btn-outline-primary btn-sm">View All Notifications</a>
                </div>
              </div>
            </li>
            <!-- Notification Dropdown End -->

            <!-- Notification Dropdown End -->
	      <li class="nav-item <?php if($uri=='ClientsAddNewJobs'){ echo "active";}?>">
	        <a class="nav-link" href="<?php echo base_url('ClientsAddNewJobs');?>">
	        	<i class="fa fa-folder-o"></i> New Job
	        </a>
	      </li>

	      <li class="nav-item <?php if($uri=='ClientsJobsList'){ echo "active";}?>">
	        <a class="nav-link" href="<?php echo base_url('ClientsJobsList');?>">
	        	<i class="fa fa-folder-open-o"></i> Jobs
	        </a>
	      </li>
	    </ul>
	    <div class="user <?php if($uri=='clientProfileInformation'){ echo "active";}?>">
	    	<a href="<?php echo base_url('clientProfileInformation');?>">
	    		<i class="fa fa-user-o"></i>
	    		<?php echo $userDetails->full_name;?>
	    	</a>
	    </div>
	  </div>
	</div>
</nav>


<script>

    function timeAgo22(dateStr) {
      const now = new Date();
      const date = new Date(dateStr);
      const diff = Math.floor((now - date) / 60000); // in minutes
      if (diff < 60) return `${diff}m ago`;
      const hr = Math.floor(diff / 60);
      if (hr < 24) return `${hr}h ago`;
      // console.log(date.toLocaleDateString());
      return date.toLocaleDateString();
    }

    function timeAgo(dateStr) {
      const now = new Date();
      const date = new Date(dateStr);
      const seconds = Math.floor((now - date) / 1000);

      if (seconds < 60) return 'Just now';
      const minutes = Math.floor(seconds / 60);
      if (minutes < 60) return `${minutes}m ago`;
      const hours = Math.floor(minutes / 60);
      if (hours < 24) return `${hours}h ago`;
      const days = Math.floor(hours / 24);
      if (days < 30) return `${days} day${days > 1 ? 's' : ''} ago`;
      const months = Math.floor(days / 30);
      if (months < 12) return `${months} month${months > 1 ? 's' : ''} ago`;
      const years = Math.floor(months / 12);
      return `${years} year${years > 1 ? 's' : ''} ago`;
    }

  function myAjaxNotify(){
    $.ajax({
      url: "<?php echo base_url('Notifications/load_notifications'); ?>",
      method: "GET",
      dataType: "json",
      success: function (data) {
        $('#notif-count').text(data.notifications.total_unread);
        var listHtml = '';
        if (data.jobs.length === 0) {
          listHtml = '<span class="list-group-item text-muted">No notifications</span>';
        } else {
          data.jobs
          .filter(notif => notif.notifi_isread === "isunread") // unread only
          .slice(0, 6)
          .forEach(function (notif) {
            listHtml += `
              <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start hover-highlight ${notif.notifi_isread}"  data-id="${notif.notif_id}">
                <div>
                ${notif.job_name} <br>
                  <span class="text- badge ${notif.badge_color}">Job ${notif.status_name} >> ${notif.sub_status}</span>
                </div>
                <small class="text-muted">${timeAgo(notif.created_at)}</small>
              </a>
            `;
          });
        }
        $('#notif-list').html(listHtml);
      }
    });
  }

  $(document).ready(function () {

    myAjaxNotify();

    
  });
</script>
