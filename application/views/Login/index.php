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
    </style>
</head>

<body>

    <div class="container">
        <div class="login-box">
            <h1 class="mb-4 fw-bold text-orange text-center">Log in</h1>
            <?php if(isset($error)){?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Error!</strong> <?php echo $error;?>.
                        </div>
            <?php }?>

            <form id="loginForm">
                <div class="mb-3 text-start">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" name="username" required>
                </div>

                <div class="mb-2 text-start">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fa fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3 mt-3 text-start">
                    <a href="<?php echo base_url('password-recovery');?>" class="text-blue">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-purple w-100">Log in</button>

                <div class="mt-3 text-center">
                    <a href="#" class="text-blue">Can't Access Your Account?</a>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // Password toggle
        $('#togglePassword').on('click', function() {
            const pwd = $('#password');
            const type = pwd.attr('type') === 'password' ? 'text' : 'password';
            pwd.attr('type', type);
            const icon = $('#toggleIcon');
            pwd.attr('type', type);
            // Change icon and color
            if (type === 'text') {
                icon.removeClass('fa-eye').addClass('fa-eye-slash text-orange');
            } else {
                icon.removeClass('fa-eye-slash text-orange').addClass('fa-eye');
            }
        });

        // AJAX login
        $('#loginForm').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url('Login/check ');?>',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = '<?php echo base_url('Login/OTP ');?>';
                    } else {
                        alert('Invalid email or password!');
                    }
                },
                error: function() {
                    alert('Error occurred while logging in.');
                }
            });
        });
    </script>

</body>

</html>