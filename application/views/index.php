<?php include('components/header.php');?>

  
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
    

<?php include('components/footer.php');?>

