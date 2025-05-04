<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link of CSS files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/client.css');?>">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
        rel="stylesheet">
    <title>Client Portal | Accurex Account</title>
    <link rel="icon" type="image/png" href="https://accurexaccounting.com/assets/img/favicon.png">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        /* Loader CSS */
        #loader {
            display: none;
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            margin-top: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #successMessage {
            color: green;
            font-size: 16px;
            display: none;
        }

        #errorMessage {
            color: red;
            font-size: 16px;
            display: none;
        }
        .form-control{
            font-size: 14px;
        }
        ul.nav.nav-pills.card-header-pills .nav-link {
            font-size: 14px;
        }
        div#notif-list a {
            font-size: 14px;
            font-family: 'Roboto';
            font-weight: 400;
        }

        .breadcrumb {
            display:none !important;
        }
        
    </style>
