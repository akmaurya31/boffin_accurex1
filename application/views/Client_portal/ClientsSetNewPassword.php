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
    <title>Client Portal | Accurex Account</title>
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
        form#loginForm {
            padding-top: 30px;
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
            background-color: #f75c1e;
            color: #fff;
            line-height: 35px;
            font-weight: 600;
        }

        .btn-purple:hover {
            background-color: #14264d;
            color: #fff;
        }

        .text-purple {
            color: #f75c1e;
        }

        .text-purple:hover {
            text-decoration: underline;
        }

        #togglePassword {
            border-color: lightgray;
            position: absolute;
            right: 0;
            z-index: 9;
            border: transparent;
            line-height: 45px;
        }

        #togglePassword:hover,
        #togglePassword:active,
        #togglePassword:focus {
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

        #togglePassword .fa {
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
        .bg-img{
                background: url('<?php echo base_url();?>assets/images/login_background.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                overflow: hidden;
                position: relative;
                    background-position: center;
        }
        .bg-img:before{
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color:rgb(216 226 251 / 75%);/* black overlay with 50% transparency */
            z-index: 1;
        }
        .loginForm{
            position: relative;
            z-index: 2; /* above the overlay */
            text-align: center;
            padding: 2rem;
        }
        form#loginForm h4 {
            font-size: 20px;
            text-align: left;
            background: #14264d;
            padding: 10px 10px;
            color: #fff;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
<section class=" d-flex align-items-center justify-content-center min-vh-100 bg-img">
    <div class="container">
        <div class="row">
            <div class="col-4 d-none d-sm-block"></div>
            <div class="col-md-4 col-12 loginForm">
                <div class="card p-4">
                    <span class="imgLogo">
                        <img src="<?php echo base_url('assets/images/logo_client.png');?>" style="width: 100%;">
                    </span>
                    
                    <form id="loginForm" method="post" action="<?php echo base_url('Clients/clientNewPasswordSave');?>">
                        <!-- <h4>Set New Password</h4> -->
                        <div class="mb-2 text-start">
                            <input type="password" class="form-control" placeholder="Set New Password" name="password" id="password" required>
                        </div>
                        <div class="mb-2 text-start">
                            <input type="password" class="form-control" placeholder="Confrim New Password" name="password" id="password" required>
                        </div>
                        <button type="submit" class="mt-2 btn btn-purple w-100">Submit</button>

                        <div class="mb-3 mt-3 text-start">
                            <input type="hidden" name="auth_ID" value="<?php echo $auth_ID;?>">
                            <input type="hidden" name="user_ID" value="<?php echo $user_ID;?>">
                            <a href="<?php echo base_url('Clients/index');?>" class="text-blue">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

