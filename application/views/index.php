<?php 
  $sessionData = (object)$this->session->userdata();        
    $nott = new \stdClass(); 
  if($sessionData->role_ID==4){
     $fnoti=EmpNotify();
  }else if($sessionData->role_ID==1){
     $fnoti=AdminNotify();
  }

   $nott->countNotification=$fnoti->total_unread_cln+$fnoti->total_unread_emp;

include('components/header.php');?>

<style>
    .admin_isunread{  background-color:rgb(243 252 255);font-weight: 600;}
    .emp_isunread{  background-color:rgb(243 252 255);font-weight: 600;}
</style>


  
<div class="main-wrapper">

    <?php
        include('components/top_nav.php');
        include('components/sidebar.php');
    ?>
    <div class="page-wrapper">
        <div class="content">
            <?php include($page."/index.php");?>
            <?php include('components/notification_box.php');?>
        </div>
    </div>
    <!-- Main warpper closed -->
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
<script>
$(document).on("click", ".admin_isunread", function () {
  var notifId = $(this).data("id"); // notification ID attribute se
  var tabType = $(this).data("tabtype"); // notification ID attribute se
  $.ajax({
    url: "<?= base_url('AdminEmpNotify/updateRead'); ?>",
    method: "POST",
    data: { id: notifId },
    success: function (response) {
      console.log("Status updated:", response);
      // Optional: UI ko update karo
      // Example: class change + styling
      $(`[data-id="${notifId}"]`)
        .removeClass("admin_isunread")
        .addClass("admin_isread")
        .find(".status-text")
        .text("isread");
 
        if(tabType=='Client'){
        $('.total_unread_cln').html($('.total_unread_cln').text()-1);
        }
        if(tabType=='Employee'){
        $('.total_unread_emp').html($('.total_unread_emp').text()-1);
        }
        $('.countNotification').html($('.countNotification').text()-1);
        $('.countNotificationSidebar').html($('.countNotification').text()-1);
        //myAjaxNotifyAdmin();
    }
  });
});


$(document).on("click", ".emp_isunread", function () {
  var notifId = $(this).data("id"); // notification ID attribute se
  var tabType = $(this).data("tabtype"); // notification ID attribute se
  $.ajax({
    url: "<?= base_url('EmpNotify/updateRead'); ?>",
    method: "POST",
    data: { id: notifId },
    success: function (response) {
      console.log("Status updated:", response);
      // Optional: UI ko update karo
      // Example: class change + styling
      $(`[data-id="${notifId}"]`)
        .removeClass("emp_isunread")
        .addClass("emp_isread")
        .find(".status-text")
        .text("isread");
 
        if(tabType=='Client'){
        $('.total_unread_cln').html($('.total_unread_cln').text()-1);
        }
        if(tabType=='Employee'){
        $('.total_unread_emp').html($('.total_unread_emp').text()-1);
        }
        $('.countNotification').html($('.countNotification').text()-1);
        $('.countNotificationSidebar').html($('.countNotification').text()-1);
    //    myAjaxNotifyEmp();
    }
  });
});

 
 function myAjaxNotifyAdmin(){
    $.ajax({
      url: "<?php echo base_url('AdminEmpNotify/load_notifications'); ?>",
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

</script>



<?php include('components/footer.php');?>

