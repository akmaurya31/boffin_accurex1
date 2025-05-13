<?php include('header.php');?>
<?php 
      //  $userDtls = $this->session->userdata('accurexClientLoginDetails'); 
    //  print_r($userDtls); 
    //  $emr= $userDtls->emergency_contact;  // die("!!!ASdfa");
?>
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

	/*.nav-link{*/
	/*	font-weight: 500;*/
	/*    color: #14264d;*/
	/*    font-family: system-ui;*/
	/*    font-size: 16px;*/
	/*}*/
	li.nav-item {
	    padding: 0px 15px;
	}
	.user {
        border: 2px solid #e7e7e7;
        font-weight: 500;
        padding: 5px 10px;
        background: #e7e7e7;
        border-radius: 50px;
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
    .nav-link {
        cursor: pointer;
    }
    .card {
        border-radius: 12px;
    }
    .card-header {
        border-bottom: none;
    }
    .list-group-item {
        border: none;
        padding-left: 0;
    }
    .bg-purple{
        background-color: #14264d;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: #fff!important;
        color: #14264d!important;
    }
    .nav-pills .nav-link{
        color: #fff!important;
    }
    .card h5 {
        text-transform: uppercase;
        font-weight: 600;
    }
</style>
<?php include('navigation.php');?>
<?php // print_r($userDtls); die("ASDF"); ?>
<div class="page-content">
  <!-- Breadcrumb -->
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile Information</li>
    </ol>
  </div>
   <!-- Dashboard Header -->
    <div class="container">
	    <div class="dashboard-tab-wrapper mb-3">
		  <div class="dashboard-tab">PROFILE INFORMATION</div>
		  <div class="dashboard-line"></div>
	    </div>
        <div class="row justify-content-center">

            <!-- Right Content Area -->
            <div class="col-md-12">
              <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-purple text-white d-flex justify-content-between align-items-center">
                  <span><i class="fa fa-user mr-2"></i>Profile Details</span>
                  <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#info">General Information</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#security">Security</a>
                    </li>
                    <li class="nav-item">
                      <a href="logout-client" class="nav-link">Logout</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body tab-content">
                  <!-- Info Tab -->
                    <div class="tab-pane fade show active" id="info">
                        <div class="profileForm">
                            <form method="post" id="profileFormm">
                                <div class="p-4 text-center">
                                    <?php if(!empty($userDtls->image)){?>
                                        <img src="<?php echo base_url('upload/'.$userDtls->image);?>" class="rounded-circle mx-auto mb-3" width="100" height="100" alt="Profile">
                                    <?php }else{?>
                                        <img src="https://aa.boffinweb.com/assets/img/user.jpg" class="rounded-circle mx-auto mb-3" width="100" height="100" alt="Profile">
                                    <?php }?>
                                    <h5 class="mb-0"><?php echo 'Hello, ', $userDtls->full_name;?></h5>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Name: </label>
                                        <input type="text" class="form-control" name="full_name" value="<?php echo $userDtls->full_name;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Email: </label>
                                        <input type="email" class="form-control" name="email"  value="<?php echo $userDtls->email;?>" readonly="">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Address: </label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $userDtls->address_line_1;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Blood Group: </label>
                                        <input type="text" class="form-control"  name="blood_group"  value="<?php echo $userDtls->blood_group;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Emergency Contact No: </label>
                                        <input type="text" class="form-control" name="EmergencyContactNo" value="<?php echo $userDtls->emergency_contact;;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Personal Contact: </label>
                                        <input type="text" class="form-control" name="PersonalContact" value="<?php echo $userDtls->personal_contact;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Gender: </label>
                                        <input type="text" class="form-control" name="Gender" value="<?php echo $userDtls->gender;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Date Of Birth: </label>
                                        <input type="text" class="form-control"  name="dob" value="<?php echo $userDtls->dob;?>">
                                    </div>
                                </div>
                                <button type="submit" name="" class="btn btn-sm btn-purple">Save Changes</button>
                            </form>
                        </div>
                    </div>
                  <!-- Security Tab -->
                  <div class="tab-pane fade" id="security">
                    <p><strong>Change Password:</strong></p>
                    <form method="post" action="" id="passwordChangeForm">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>New Password: </label>
                                <input type="password" class="form-control" name="new_password"  value="" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Confirm Password: </label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" name="btn" class="btn btn-sm btn-purple">Save Changes</button>
                        
                    </form>
                    <hr>
                    
                  </div>
                </div>
              </div>
            </div>
  </div>

	</div>



<script>
$('#profileFormm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '<?= base_url("updateProfile") ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
          console.log("gggg",res)
            if (res.status === 'success') {
                Swal.fire('Updated!', res.message, 'success');
            } else {
                Swal.fire('Failed!', res.message, 'error');
            }
        },
        error: function() {
            Swal.fire('Oops!', 'Server error occurred.', 'error');
        }
    });
});
</script>



<?php include('footer.php');?>
<script>
$('#passwordChangeForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: "<?= base_url('updatePassword') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(response) {
            if (response.status === 'success') {
                alert('Password updated successfully.');
            } else {
                alert(response.message || 'Something went wrong.');
            }
        },
        error: function() {
            alert('Server error.');
        }
    });
});
</script>