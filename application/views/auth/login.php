<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMAR - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url('assets/images/amar.png'); ?>" >

    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('<?php echo base_url("assets/images/bglogin.jpg"); ?>');
            background-size: cover;
            background-position: center;
        }
        .login-container {
            display: flex;
            background: rgba(0, 0, 0, 0.6);
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 900px;
            color: white;
            position: relative;
        }
        .login-container .login-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container .login-image h2 {
            font-size: 50px;
            text-align: center;
        }
        .logo-group {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .logo-group img {
            height: 50px;
        }
        .login-box {
            flex: 1;
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-container img {
            height: 100px;
            margin-bottom: 15px;
        }
        .logo-text {
            color: white;
            font-size: 18px;
            margin-top: 10px;
        }
        .form-control {
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid #ccc;
            color: white;
        }
        .btn-login {
            background: linear-gradient(to right, #006CB6, #15afbd);
            border: none;
            padding: 12px;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            width: 100%;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: linear-gradient(to left, #006CB6, #15afbd);
        }
        .remember-me {
            margin-bottom: 15px;
        }
        .form-check-label {
            color: white;
            font-size: 14px;
        }
        .password-toggle {
            position: relative;
        }
        .password-toggle i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ccc;
        }
        .social-links {
            text-align: center;
            margin-top: 20px;
        }
        .social-links a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
            transition: color 0.3s;
        }
        .social-links a:hover {
            color: #FEB47B;
        }
        .lorem-text {
            margin-top: 20px;
            font-size: 14px;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logos on the top-left -->
        <div class="logo-group">
            <img src="<?php echo base_url('assets/images/bumn-logo.png'); ?>" alt="BUMN Logo">
            <img src="<?php echo base_url('assets/images/injourneyputih.png'); ?>" alt="INJOURNEY Logo">
            <img src="<?php echo base_url('assets/images/soettaputih.png'); ?>" alt="Soekarno Logo">
            <img src="<?php echo base_url('assets/images/logo-it.png'); ?>" alt="IT Logo">
        </div>

        <!-- Left side - Welcome text -->
        <div class="login-image">
            <h2>Welcome!</h2>
        </div>

        <!-- Right side - Login form -->
        <div class="login-box">
            <div class="logo-container">
                <img src="<?php echo base_url('assets/images/amarloginwhite.png'); ?>" alt="AMAR Logo">
            </div>

            <form id="loginForm" action="<?php echo base_url('auth/login'); ?>" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                </div>
                <div class="mb-3 password-toggle">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye-slash" id="togglePassword"></i>
                </div>
                <div class="remember-me">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                        <label class="form-check-label" for="rememberMe">
                            Remember me
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-login">Submit</button>
            </form>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Handle form submission with AJAX
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location.href = '<?php echo base_url("dashboard"); ?>';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            confirmButtonColor: '#3085d6'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#3085d6'
                    });
                }
            });
        });
    </script>
</body>
</html>
