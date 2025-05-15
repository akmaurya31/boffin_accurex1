<style>
    .notification-message{
        position:relative;
    }
    .notification-message > .online{
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .activeNoti a{
        background-color: rgb(221 87 37);
    }
</style>
<?php $list   = $this->user_lib->getAllNotificationDESC($this->session->userdata('user_ID'));
        $countNotification = $this->user_lib->getNewNotificationCount($this->session->userdata('user_ID'));?>
?>
<div class="header">
        <div class="header-left">
            <a href="index.html" class="logo">
                <img src="<?php echo base_url('assets/images/favicon.png');?>" width="35" height="35" alt=""> <span>Accurex</span>
            </a>
        </div>
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <ul class="nav user-menu float-right">
            <?php 
                if(($page == "Notification") && ($this->session->userdata('auth_ID') !=='1')){
                    $activeNoti = "activeNoti";
                }else{
                    $activeNoti = '';
                }
            ?>

            <li class="nav-item dropdown d-none d-sm-block <?php echo $activeNoti;?>">  
                 <a href="<?php echo base_url('AdminEmpNotify');?>" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class=" fa fa-bell-o"></i> 
                    <span class="badge badge-pill bg-danger float-right"><?php echo $countNotification;?></span>
                </a>
            </li>



            <li class="nav-item dropdown d-none d-sm-block <?php echo $activeNoti;?>">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="vvv fa fa-bell-o"></i> <span
                        class="badge badge-pill bg-danger float-right"><?php echo $countNotification;?></span></a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span>Notifications</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="notification-list">
                            <?php

                                if(!empty($list)){
                                    foreach($list as $key => $value){?>
                                         <li class="notification-message">
                                            <a href="<?php echo base_url('read-notification/'.$value->notification_ID);?>">
                                                <div class="media">
                                                    <span class="avatar">
                                                        <img alt="<?php echo $value->full_name;?>" src="<?php echo base_url('upload/'.$value->image);?>" class="img-fluid">
                                                    </span>
                                                    <div class="media-body">
                                                        <p class="noti-details"><span class="noti-title"><?php echo $value->full_name;?></span> added new
                                                            task <span class="noti-title"><?php echo $value->title;?></span></p>
                                                        <p class="noti-time"><span class="notification-time">
                                                            <?php echo $this->user_lib->timeAgo($value->created_on);?>
                                                        </span></p>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php if($value->noti_status != "seen"){?>
                                                <span class="status online"></span>
                                            <?php } ?>
                                        </li>
                                <?php
                                    }
                                }?>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="<?php echo base_url('Activities');?>">View all Notifications</a>
                    </div>
                </div>
            </li>
            <!-- <li class="nav-item dropdown d-none d-sm-block">
                <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                        class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
            </li> -->

            <?php
                $user =$this->user_lib->getUserInfoByAuthID($this->session->userdata('auth_ID'));
                $fullName = $user[0]->full_name;
                $image    = $user[0]->image;
                $displayName = $this->user_lib->getInitials($fullName);
                if(!empty($image)){
                    $urlImg = base_url('upload/'.$image);
                }else{
                    $urlImg = base_url('assets/img/user.jpg');
                }
            ?>
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="<?php echo $urlImg;?>" width="24" alt="<?php echo $displayName;?>">
                        <span class="status online"></span>
                    </span>
                    <span><?php echo $displayName;?></span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="settings">Settings</a>
                    <a class="dropdown-item" href="<?php echo base_url('Login/logout');?>">Logout</a>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                    class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="settings">Settings</a>
                <a class="dropdown-item" href="<?php echo base_url('Login/logout');?>">Logout</a>
            </div>
        </div>
        <!-- Header cloased -->
    </div>