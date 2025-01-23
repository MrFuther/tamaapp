<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            height: 100vh;
        }
        .login-container {
            display: flex;
            height: 100vh;
        }
        .login-image {
            flex: 1;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .login-image img {
            max-width: 100%;
            height: auto;
        }
        .login-form {
            flex: 1;
            background-color: #8BC34A;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-container img {
            height: 60px;
            margin-bottom: 15px;
        }
        .logo-text {
            color: #333;
            font-size: 14px;
            margin-top: 10px;
        }
        .form-control {
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
        }
        .btn-login {
            background-color: #2196F3;
            border: none;
            padding: 12px;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #1976D2;
        }
        .remember-me {
            margin-bottom: 15px;
        }
        .form-check-label {
            color: #666;
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
            color: #666;
        }
        .bumn-logo {
            position: absolute;
<<<<<<< HEAD
            max-width: 100%;
            height: auto;
            top: 20px;
            left: 700px;
            height: 40px;
=======
            top: 28px;
            left: 800px;
            max-width: 140px; /* Membatasi lebar maksimum */
            height: auto; /* Menjaga proporsi */
>>>>>>> 5ef15d454aaa4a8974e42240bee18e653c81dda3
        }

        .logo-it {
            position: absolute;
            top: 30px;
            right: 35px;
            max-width: 70px;
            height: auto;
        }

        .logo-soekarno {
            position: absolute;
            top: 28px;
            right: 100px;
            max-width: 140px;
            height: auto;
        }
        .injourney-logo{
            position: absolute;
            top: 34px;
            right: 235px;
            max-width: 100px; /* Membatasi lebar maksimum */
            height: auto; /* Menjaga proporsi */
        }

        @media (max-width: 768px) {
            .login-image {
                display: none;
            }
            .login-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left side - Illustration -->
        <div class="login-image">
            <img src="<?php echo base_url('assets/images/login-illustration.png'); ?>" alt="Login Illustration">
        </div>
        
        <!-- Right side - Login Form -->
        <div class="login-form">
            <img src="<?php echo base_url('assets/images/bumn-logo.png'); ?>" alt="BUMN Logo" class="bumn-logo">
            <img src="<?php echo base_url('assets/images/logo-it.png'); ?>" alt="IT Logo" class="logo-it">
            <img src="<?php echo base_url('assets/images/logo-soekarno.png'); ?>" alt="SOEKARNO logo" class="logo-soekarno">
            <img src="<?php echo base_url('assets/images/injourney-logo.png'); ?>" alt="INJOURNEY logo" class="injourney-logo">
            
            
            <div class="login-box">
                <div class="logo-container">
                    <img src="<?php echo base_url('assets/images/tama-logo.png'); ?>" alt="TAMA Logo">
                    <div class="logo-text">
                        Technical Activity<br>
                        Maintenance Assistant
                    </div>
                </div>

                <form id="loginForm" action="<?php echo base_url('auth/login'); ?>" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Username" required>
                    </div>
                    <div class="mb-3 password-toggle">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Password" required>
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
                    <button type="submit" class="btn btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
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
