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


<?php include('components/footer.php');?>