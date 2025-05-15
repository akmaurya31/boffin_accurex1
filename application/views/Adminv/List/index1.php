<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Employee Notify</h4>
    </div>
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="<?php echo base_url('create-user');?>" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add Employee</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
		<div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th style="min-width:200px;">Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th style="min-width: 110px;">Join Date</th>
                        <th>Role</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user){?>
                    <tr class="<?php echo $user->status == 1 ? "bg-info" : "";?>">
                        <td>
							<img width="28" height="28" src="<?php echo base_url('upload/'.$user->image);?>" class="rounded-circle" alt="<?php echo $user->full_name;?>"> 
							<h2 style="margin-left:5px;"><?php echo $user->full_name;?></h2>
						</td>
                        
                        <td><?php echo $user->email;?></td>
                        <td><?php echo $user->status == 0 ? "active" : "Block";?></td>
                        <td><?php echo date('d-m-Y',strtotime($user->created_on));?></td>
                        <td>
                           <span class="custom-badge <?php echo 
                                                            $user->role_name == 'Admin' ? 'status-green' :
                                                            ($user->role_name == 'HR' ? 'status-red' :
                                                            ($user->role_name == 'Team Lead' ? 'status-blue' :
                                                            ($user->role_name == 'Employee' ? 'status-orange' :
                                                            ($user->role_name == 'Client' ? 'status-purple' : 'status-default')))); 
                                                        ?>">
                                                            <?php echo $user->role_name; ?>
                            </span>

                        </td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo base_url('edit-user/'.$user->user_ID);?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee_<?php echo $user->user_ID;?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    <a class="dropdown-item" href="<?php echo $user->status == 1 ? 'active-user/'.$user->user_ID : 'block-user/'.$user->user_ID;?>">
                                        <i class="fa fa-<?php echo $user->status == 1 ? "user-circle-o" : "user-times";?> m-r-5"></i> <?php echo $user->status == 1 ? "Active User" : "Block User";?>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
		</div>
    </div>
</div>

<?php foreach($users as $del){?>
        <form id="delete_employee_<?php echo $del->user_ID;?>" class="modal fade delete-modal" role="dialog" action="<?php echo base_url('delete-user');?>" method="POST">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this User?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
						    <input type="hidden" name="user_ID" value="<?php echo $del->user_ID;?>">
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</form>

<?php }?>