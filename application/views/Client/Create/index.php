<div class="row">
    <div class="col-sm-12">
        <?php if(!isset($edit)){?>
                <h4 class="page-title">Create Client</h4>
        <?php }else{?>
                <h4 class="page-title">Edit Client</h4>
        <?php }?>
    </div>
</div>

<style>
    .form-lbl{
        line-height: 27px;
        margin-bottom: 0;
        margin-right: 15px;
        min-width: 100%;
    }
    .upload{
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        z-index: 99;
        opacity: 0.0001;
        cursor: pointer;
    }
    .img-block{
        position: relative;
        max-width: 150px;
        max-height: 150px;
        overflow: hidden;
    }
    #previewImage{
        display: block;
        width: 150px;
        height: 150px;
        border: 1px solid #f75c1e;
        padding: 5px;
    }
</style>

<?php if(!isset($edit)){
        $name               = '';
        $blood_group        = '';
        $email              = '';
        $password           = '';
        $confirm_password   = '';
        $address_line_1     = '';
        $address_line_2     = '';
        $state              = '';
        $city               = '';
        $pincode            = '';
        $country            = '';
        $gender             = '';
        $status             = '';
        $role_id            = '';
        $disabled           = '';
    }else{
        $name               = $edit[0]->full_name;
        $blood_group        = $edit[0]->blood_group;
        $email              = $edit[0]->email;
        $password           = $edit[0]->password;
        $confirm_password   = $edit[0]->password;
        $address_line_1     = $edit[0]->address_line_1;
        $address_line_2     = $edit[0]->address_line_2;
        $state              = $edit[0]->state;
        $city               = $edit[0]->city;
        $pincode            = $edit[0]->pincode;
        $country            = $edit[0]->country;
        $gender             = $edit[0]->gender;
        $status             = $edit[0]->is_blocked;
        $role_id            = $edit[0]->role_ID;
        $disabled           = 'disabled';
    }
    ?>

<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title">User Information</h4>
            <?php if(!isset($edit)){?>
                <form action="<?php echo base_url('save-client');?>" method="POST" enctype="multipart/form-data">
            <?php }else{?>
                    <form action="<?php echo base_url('update-client');?>" method="POST" enctype="multipart/form-data">
            <?php }?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo set_value('name',$name);?>">
                            <?php echo form_error('name', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Blood Group</label>
                            <select class="select" name="blood_group">
                                <option value="" <?php echo set_select('blood_group', '', False); ?>>Select</option>
                                <option value="A+" <?php echo set_select('blood_group', 'A+', ($edit ? $blood_group == 'A+' : false)); ?>>A+</option>
                                <option value="A-" <?php echo set_select('blood_group', 'A-', ($edit ? $blood_group == 'A-' : false)); ?>>A-</option>
                                <option value="B+" <?php echo set_select('blood_group', 'B+', ($edit ? $blood_group == 'B+' : false)); ?>>B+</option>
                                <option value="B-" <?php echo set_select('blood_group', 'B-', ($edit ? $blood_group == 'B-' : false)); ?>>B-</option>
                                <option value="O+" <?php echo set_select('blood_group', 'O+', ($edit ? $blood_group == 'O+' : false)); ?>>O+</option>
                                <option value="O-" <?php echo set_select('blood_group', 'O-', ($edit ? $blood_group == 'O-' : false)); ?>>O-</option>
                                <option value="AB+" <?php echo set_select('blood_group', 'AB+',($edit ? $blood_group == 'AB+' : false)); ?>>AB+</option>
                                <option value="AB-" <?php echo set_select('blood_group', 'AB-',($edit ? $blood_group == 'AB-' : false)); ?>>AB-</option>
                            </select>
                            <?php echo form_error('blood_group', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block form-lbl">Gender:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                            value="male" <?php echo  set_radio('gender', 'male', ($edit ? $gender == 'male' : TRUE)); ?> >
                                        <label class="form-check-label" for="gender_male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender"
                                            id="gender_female" value="female" <?php echo  set_radio('gender', 'female',($edit ? $gender == 'female' : false)); ?> >
                                        <label class="form-check-label" for="gender_female">Female</label>
                                    </div>
                                    <?php echo form_error('gender', '<div class="text-danger">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="display-block form-lbl">Status:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                            id="active_status" value="0" <?php echo  set_radio('status', '0', ($edit ? $status == '0' : true)); ?> >
                                        <label class="form-check-label" for="active_status">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="block_status"
                                            value="1" <?php echo  set_radio('status', '1', ($edit ? $status == '1' : true)); ?> >
                                        <label class="form-check-label" for="block_status">Block</label>
                                    </div>
                                    <?php echo form_error('status', '<div class="text-danger">', '</div>'); ?>
                                </div>
                                
                                <input type="hidden" name="role" value="5">

                                <?php /*
                                <div class="form-group">
                                    <label>Slect Role</label>
                                    <?php
                                        $roles = $this->user_lib->get_all_roles();
                                    ?>
                                    <select class="select" name="role">
                                        <option value="">Select</option>
                                        <?php if (!empty($roles)) {
                                            foreach ($roles as $role) { ?>
                                                <option value="<?php echo $role->id; ?>" 
                                                    <?php echo set_select('role', $role->id, ($edit ? $role_id == $role->id : false)); ?>>
                                                    <?php echo $role->name; ?>
                                                </option>
                                        <?php } } ?>
                                    </select>

                                    <?php echo form_error('role', '<div class="text-danger">', '</div>'); ?>
                                </div>*/?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="display-block form-lbl">Profile Image:</label>
                                    <div class="img-block">
                                        <?php 
                                            if(!isset($edit)){
                                                $image = "assets/img/user.jpg";
                                            }else{
                                                $image = 'upload/'.$edit[0]->image;
                                            }
                                        ?>
                                        <img src="<?php echo base_url($image);?>" id="previewImage" class="rounded" alt="Profile_image">
                                        <input type="file" id="imageInput" class="upload" accept="image/*" name="profile_img">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="copyTo" disabled value="<?php echo set_value('email',$email);?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="copyFrom" name="email"  value="<?php echo set_value('email',$email);?>" <?php echo $disabled;?>>
                            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"  value="<?php echo set_value('password',$password);?>" <?php echo $disabled;?>>
                            <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="password" class="form-control" name="confirm_password"  value="<?php echo set_value('confirm_password',$confirm_password);?>" <?php echo $disabled;?>>
                            <?php echo form_error('confirm_password', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <h4 class="card-title">Postal Address</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address Line 1</label>
                            <input type="text" class="form-control" name="address_line_1"  value="<?php echo set_value('address_line_1',$address_line_1);?>">
                            <?php echo form_error('address_line_1', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Address Line 2</label>
                            <input type="text" class="form-control" name="address_line_2"  value="<?php echo set_value('address_line_2',$address_line_2);?>">
                            <?php echo form_error('address_line_2', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state"  value="<?php echo set_value('state',$state);?>">
                            <?php echo form_error('state', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" name="city"  value="<?php echo set_value('city',$city);?>">
                            <?php echo form_error('city', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country"  value="<?php echo set_value('country',$country);?>">
                            <?php echo form_error('country', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="pincode"  value="<?php echo set_value('pincode',$pincode);?>">
                            <?php echo form_error('pincode', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <?php echo ($edit ? "<input type='hidden' name='user_ID' value='".$edit[0]->user_ID."'>" : "");?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

