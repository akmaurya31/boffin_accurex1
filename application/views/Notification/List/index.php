<?php //echo "<pre>";var_dump($all_notifications);echo "</pre>";?>

<style>
    .badge{
        margin:5px;
        color:#fff;
        font-weight: 300;
    }
</style>

<?php if(isset($success)){?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Success!</strong> <?php echo $success;?>.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
</div>
<?php } 
if(isset($error)){?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Error!</strong> <?php echo $error;?>.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button>
</div>
<?php }?>


                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Sent Notification Lists</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th style="min-width:200px;">Title</th>
                                        <th>Sent To</th>
                                        <th>Sent Date</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   $i=1;
                                            foreach($all_notifications as $notification){
                                                $userList = $this->user_lib->getUsersListByNotificationID($notification->notification_ID);
                                    ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
    											<h2><?php echo $notification->title;?></h2>
    										</td>
                                            <td>
                                                <?php   
                                                    foreach($userList as $users){
                                                        echo '<span class="badge bg-primary">'.$users->email.'</span>';
                                                    }
                                                        
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $this->user_lib->timeAgo($notification->created_on);?>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(57px, -2px, 0px);">
                                                        <a class="dropdown-item" href="edit-notification/<?php echo $notification->notification_ID;?>">
                                                            <i class="fa fa-pencil m-r-5"></i> 
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee_<?php echo $notification->notification_ID;?>">
                                                            <i class="fa fa-trash-o m-r-5"></i> 
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $i++;}?>
                                </tbody>
                            </table>
						</div>
                    </div>
                </div>
                
                <?php foreach($all_notifications as $del){?>
                        <form id="delete_employee_<?php echo $del->notification_ID;?>" class="modal fade delete-modal" role="dialog" method="POST" action="<?php echo base_url('delete-notification');?>">
                			<div class="modal-dialog modal-dialog-centered">
                				<div class="modal-content">
                					<div class="modal-body text-center">
                						<img src="assets/img/sent.png" alt="" width="50" height="46">
                						<h3>Are you sure want to delete this Notification?</h3>
                						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                						    <input type="hidden" name="notification_ID" value="<?php echo $del->notification_ID;?>">
                							<button type="submit" class="btn btn-primary">Delete</button>
                						</div>
                					</div>
                				</div>
                			</div>
                		</form>
                
                <?php }?>
                
                
                
                
                
               