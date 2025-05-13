<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">Settings</h4>
    </div>
</div>
<style>
    .error {
        color: red;
        margin-bottom: 15px;
        font-size: 14px;
    }
</style>
<form>
    <div class="card-box">
        <h3 class="card-title">Basic Informations</h3>
        <?php
            if(isset($success)){?>
        <div class="alert alert-success">
            <strong>Success!</strong><?php echo $success;?>
        </div>
        <?php
            }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="profile-img-wrap">
                    <img class="inline-block" src="assets/img/user.jpg" alt="user">
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file">
                    </div>
                </div>
                <div class="profile-basic">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="focus-label">First Name</label>
                                <input type="text" class="form-control floating" value="John">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="focus-label">Last Name</label>
                                <input type="text" class="form-control floating" value="Doe">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <label class="focus-label">Birth Date</label>
                                <div class="cal-icon">
                                    <input class="form-control floating datetimepicker" type="text" value="05/06/1985">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus select-focus">
                                <label class="focus-label">Gendar</label>
                                <select class="select form-control floating">
                                    <option value="male selected">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-box">
        <h3 class="card-title">Contact Informations</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-focus">
                    <label class="focus-label">Address</label>
                    <input type="text" class="form-control floating" value="4487 Snowbird Lane">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">State</label>
                    <input type="text" class="form-control floating" value="New York">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">Country</label>
                    <input type="text" class="form-control floating" value="United States">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">Pin Code</label>
                    <input type="text" class="form-control floating" value="10523">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">Phone Number</label>
                    <input type="text" class="form-control floating" value="631-889-3206">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center m-t-20">
        <button class="btn btn-primary submit-btn mb-5" type="button">Save</button>
    </div>
</form>

<form action="<?php echo base_url('change-password');?>" method="POST">
    <div class="card-box">
        <h3 class="card-title">Change Current Password</h3>
        <?php if(isset($error)){?>
        <div class="alert alert-danger">
            <strong>Error!</strong><?php echo $error;?>
        </div>
        <?php }?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">Current Password</label>
                    <input type="password" class="form-control floating" name="current">
                </div>
                <?php echo form_error('current', '<div class="error">', '</div>'); ?>
            </div>
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">Confirm Current Password</label>
                    <input type="password" class="form-control floating" name="current_conf">
                </div>
                <?php echo form_error('current_conf', '<div class="error">', '</div>'); ?>
            </div>
            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">New Password</label>
                    <input type="password" class="form-control floating" name="new">
                </div>
                <?php echo form_error('new', '<div class="error">', '</div>'); ?>
            </div>

            <div class="col-md-6">
                <div class="form-group form-focus">
                    <label class="focus-label">Confirm New Password</label>
                    <input type="password" class="form-control floating" name="new_conf">
                </div>
                <?php echo form_error('new_conf', '<div class="error">', '</div>'); ?>
            </div>
        </div>
    </div>

    <div class="text-center m-t-20">
        <button class="btn btn-primary submit-btn" type="submit">Change Password</button>
    </div>
</form>