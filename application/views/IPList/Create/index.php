<style>
    .m-r-2{
        margin:5px;
    }
    .btn-warning,.btn-warning:hover,.btn-warning:focus,.btn-warning:active{
        color: #ffffff !important;
        background-color: #f75c1e;
        font-weight: 200;
    }
    .btn-secondary,.btn-secondary:hover,.btn-secondary:focus,.btn-secondary:active {
        color: #f75c1e !important;
        background-color: #f1f1f1;
        border-color: #e1e1e1;
    }
    span.span-close {
        position: absolute;
        top: -13px;
        right: -8px;
        font-size: 12px;
        padding: 3px 5px;
        border-radius: 50%;
        opacity: 1;
        color: #ff0000;
        font-weight: 200;
    }
</style>
<div class="row">
    <div class="col-sm-4 col-3">
        <h4 class="page-title">Assign IP</h4>
    </div>
</div>

<?php if(isset($success)){?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong><?php echo $success;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php }else if(isset($success)){?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> <?php echo $error;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php }?>


<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th style="min-width:200px;">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Listed IP</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user){
                            if($user->role_ID !== '1' && $user->role_ID !== '5'){?>
                                <tr>
                                    <td>
                                        <img width="28" height="28" src="<?php echo base_url('upload/'.$user->image);?>" class="rounded-circle m-r-2" alt="<?php echo $user->full_name;?>">
                                        <h2>
                                        <?php echo $user->full_name;?>
                                        </h2>
                                    </td>
                                    <td>
                                    <?php echo $user->email;?>
                                    </td>
                                    <td>
                                        <?php
                                            $badgeColor = '';
                                            switch ($user->role_ID) {
                                                case 2:
                                                    $badgeColor = 'green';
                                                  break;
                                                case 3:
                                                    $badgeColor = 'blue';
                                                  break;
                                                case 4:
                                                    $badgeColor = 'orange';
                                                  break;
                                                default:
                                                    $badgeColor = 'blue';
                                                  break;
                                            }?>
                                        <span class="custom-badge status-<?php echo $badgeColor;?>">
                                            <?php
                                                $role = $this->user_lib->getRoleNameByID($user->role_ID);
                                                    echo $role[0]->name;
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php   $allIP = $this->user_lib->getIpListForUser($user->user_ID);
                                                foreach($allIP as $ip){?>
                                                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 10px;">
                                                        <?php echo $ip->ip_address;?>
                                                    </button>
                                        <?php }?>

                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_model<?php echo $user->user_ID;?>">
                                                    <i class="fa fa-pencil m-r-5"></i> Edit
                                                </a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee<?php echo $user->user_ID;?>">
                                                    <i class="fa fa-trash-o m-r-5"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                    <?php $i++;}}?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php foreach($users as $user){
         if($user->role_ID !== '1' && $user->role_ID !== '5'){?>
    <form id="delete_employee<?php echo $user->user_ID;?>" class="modal fade delete-modal" role="dialog" action="<?php echo base_url('delete-ip');?>" method="POST">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this All IP?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <input type="hidden" name="user_ID" value="<?php echo $user->user_ID;?>">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="edit_model<?php echo $user->user_ID;?>" class="modal fade delete-modal" role="dialog" action="<?php echo base_url('assign-ip');?>" method="POST">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header form-group">
                        <h4 class="modal-title">Assign IP To User</h4>
                        <button type="button" class="btn-close" data-dismiss="modal" style="border:none;">&times;</button>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Add IP</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control form-control" name="ip" placeholder="xxx.xxx.xxx.xxx" required>
                        </div>
                    </div>
                    <hr/>
                    <h5 class="text-left m-b-20">List Of Assigned IPs</h5>
                    <?php   $allIP = $this->user_lib->getIpListForUser($user->user_ID);
                            foreach($allIP as $ip){?>
                                <button type="button" id="<?php echo $ip->user_ips_ID;?>" class="btn btn-secondary btn-sm" style="font-size: 10px;position:relative;" onclick="deleteIP('<?php echo $ip->user_ips_ID;?>');">
                                    <?php echo $ip->ip_address;?>
                                    <span class="span-close">
                                        <i class="fa fa-close"></i>
                                    </span>
                                </button>
                    <?php }?>
                    <div class="modal-footer" style="margin-top: 20px;">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-warning">Save</button>
                        <input type="hidden" name="user_ID" value="<?php echo $user->user_ID;?>">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php }}?>

<script>
    function deleteIP(id){
        var formData = new FormData();
        formData.append('id', id);
        
        fetch('<?php echo base_url('User/deleteIP');?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if(data == 1){
                document.getElementById(id).remove();
            }else{
                alert('Failed to delete assigned IP. Try later.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>