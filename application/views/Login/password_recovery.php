<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link of CSS files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
        rel="stylesheet">
    <title>Accurex Accounting | Our Knowledge Our Solutions Your Achievements</title>
    <link rel="icon" type="image/png" href="https://accurexaccounting.com/assets/img/favicon.png">
    <meta name="google-site-verification" content="O59BDNFa90DPuPYJ1Cb-Y_KL9TOQQrGULh-okq4exA4" />
    <meta name="keywords" content="accounting, outsourcing, UK-based firm, financial solutions, growth support">
    <meta name="description"
        content="Accurex Accounting: A UK-based outsourcing firm offering innovative solutions to help businesses focus on growth and strategic decisions.">
    <meta property="og:title" content="Accurex Accounting - Innovative UK-Based Outsourcing Solutions">
    <meta property="og:description"
        content="Accurex Accounting: A UK-based outsourcing firm offering innovative solutions to help businesses focus on growth and strategic decisions.">
    <meta property="og:image" content="<?php echo base_url('assets/img/logo.png');?>">
    <meta property="og:url" content="https://accurexaccounting.com">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="https://accurexaccounting.com/assets/img/banner_1.png">
    <meta name="twitter:title" content="Accurex Accounting - UK Outsourcing Experts">
    <meta name="twitter:description"
        content="Accurex Accounting: A UK-based outsourcing firm offering innovative solutions to help businesses focus on growth and strategic decisions.">
    <meta name="twitter:image" content="https://accurexaccounting.com/assets/img/logo.png">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://accurexaccounting.com">
    <style>
    body {
        background-color: #f5f7ff;
        font-family: "Poppins", sans-serif;
    }

    .login-box {
        max-width: 450px;
        margin: 80px auto;
        padding: 30px;
        border-radius: 12px;
        background: #fff;
        border: 1px solid lightgray;
    }

    .form-control:focus {
        border-color: #f75c1e;
        box-shadow: 0 0 0 0.2rem rgba(123, 44, 191, 0.25);
    }

    .btn-purple {
        background-color: #14264d;
        color: #fff;
        line-height: 35px;
        font-weight: 600;
    }

    .btn-purple:hover {
        background-color: #14264d;
        color: #fff;
    }

    .text-purple {
        color: #14264d;
    }

    .text-purple:hover {
        text-decoration: underline;
    }

    #togglePassword,#togglePassword2 {
        border-color: lightgray;
        position: absolute;
        right: 0;
        z-index: 9;
        border: transparent;
        line-height: 45px;
    }

    #togglePassword:hover,
    #togglePassword:active,
    #togglePassword:focus,
    #togglePassword2:hover,
    #togglePassword2:active,
    #togglePassword2:focus {
        background-color: transparent !important;
        box-shadow: none !important;
        color: #f75c1e;
    }

    .text-orange {
        color: #f75c1e;
    }

    .form-control:focus,
    .form-control:active {
        box-shadow: none !important;
    }

    .input-group>.custom-file,
    .input-group>.custom-select,
    .input-group>.form-control,
    .input-group>.form-control-plaintext {
        width: 100%;
    }

    .form-control {
        height: 50px;
    }

    #togglePassword .fa,#togglePassword2 .fa {
        font-size: 25px;
    }

    .active>.fa {
        color: #f75c1e;
    }

    .text-blue,
    .text-blue:hover {
        color: #14264d;
        text-decoration: none;
        font-weight: 700;
    }
    .p1{
        font-size: smaller;
        margin-bottom: 30px;
    }
    #err{
        color: red;
        font-size: 12px;
        display: block;
        margin-bottom: 15px;
    }
    .success{
        font-size: xxx-large;
    color: #12b312;
    margin: 0 auto;
    width: 100%;
    display: block;
    text-align: center;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-box">
            <?php if(!isset($reset_password)){?>
                <h1 class="mb-4 fw-bold text-orange text-center">Forget Password </h1>
                <p class="text-center">Forget Your Password ? Don't Worry We Recover your Password. Just follw the steps.</p>
    
                <form id="loginForm" action="<?php echo base_url('verify-email');?>" method="POST">
                    <div class="mb-3 text-start">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
    
                    <?php if(isset($error)){?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Error!</strong> <?php echo $error;?>.
                            </div>
                    <?php }?>
    
                    <button type="submit" class="btn btn-purple w-100 mt-3">Verify Email</button>
    
                    <div class="mt-3 text-center">
                        <p>Remember Your Password ? <a href="<?php echo base_url('Login');?>" class="text-orange" >Go To Login</a></p>
                    </div>
                <?php }else{?>
                        <h1 class="mb-4 fw-bold text-orange text-center">Reset Password</h1>
                        <p class="text-center p1">Forget Your Password ? Don't Worry We Help you to Reset your Password. Just follw the steps.</p>
                        
                        <form id="loginForm" action="<?php echo base_url('update-forget-password');?>" method="POST">
                            
                            <div class="mb-2 text-start">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="new_password" required="">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fa fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mb-2 text-start">
                                <label class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="new_password_conf" id="new_password_conf" required="">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                        <i class="fa fa-eye" id="toggleIcon2"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <?php if(!isset($success)){?>
                                <span id="err"><?php if(isset($error)){echo "Failed to update your new password. Please close the window and click on link again.";}?></span>
                                <input type="hidden" name="update_id" value="<?php echo $reset_password;?>">
                                <button type="submit" class="btn btn-sm btn-purple">Submit</button>
                            <?php }?>
                            
                            <?php if(isset($success)){?>
                                    <span class="success">
                                    <i class="fa fa-check-circle"></i>
                                    </span>
                                    <p>Password changed successfully.Now close this window and login to you panel.</p>
                            <?php }?>
                        </form>
                <?php }?>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('new_password_conf').value;
            
            if (newPassword !== confirmPassword) {
                event.preventDefault();
                $('#err').text('Passwords do not match. Please try again.');
            }else{
                $('#err').text('');
            }
        });
        
        $('#togglePassword').on('click', function() {
            const pwd = $('#new_password');
            const type = pwd.attr('type') === 'password' ? 'text' : 'password';
            pwd.attr('type', type);
    
            const icon = $('#toggleIcon');
            // Change icon based on password visibility
            if (type === 'text') {
                icon.removeClass('fa-eye').addClass('fa-eye-slash text-orange');
            } else {
                icon.removeClass('fa-eye-slash text-orange').addClass('fa-eye');
            }
        });
        
        $('#togglePassword2').on('click', function() {
            const pwd = $('#new_password_conf');
            const type = pwd.attr('type') === 'password' ? 'text' : 'password';
            pwd.attr('type', type);
    
            const icon = $('#toggleIcon2');
            // Change icon based on password visibility
            if (type === 'text') {
                icon.removeClass('fa-eye').addClass('fa-eye-slash text-orange');
            } else {
                icon.removeClass('fa-eye-slash text-orange').addClass('fa-eye');
            }
        });

    </script>



</body>

</html>