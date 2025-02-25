<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMAR - Login</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> 
    <link rel="icon" href="<?php echo base_url('assets/images/amar.png'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">


    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(45deg, #04b0c0, #8cc63f, #006cb6);
            overflow: hidden;
            font-family: 'Poppins', sans-serif;

        }

        .shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
        }

        .shape.shape1 { width: 300px; height: 300px; top: -50px; left: -50px; }
        .shape.shape2 { width: 200px; height: 200px; bottom: 50px; right: 100px; }
        .shape.shape3 { width: 150px; height: 150px; top: 200px; right: 50px; }

        .header-logos {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .header-logos img { height: 50px; }

        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            position: relative;
            z-index: 10;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px; /* Pastikan ada batasan lebar */
        }

        .login-container img { width: 180px; margin-bottom: 20px; margin-left: -5px; }

        .form-control {
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
            width: 300px;
            height: 35px;
            font-size: 14px;
        }

        .btn-login {
            background: linear-gradient(to right, #006CB6, #15afbd);
            border: none;
            padding: 12px;
            border-radius: 5px;
            color: white;
            width: 100%;
            text-align: center; /* Memastikan teks ada di tengah */
            display: flex;
            justify-content: center; /* Menengahkan teks secara horizontal */
            align-items: center; /* Menengahkan teks secara vertikal */
            height: 35px; /* Sesuaikan tinggi tombol */
            font-size: 16px; /* Sesuaikan ukuran teks */
        }


        .password-toggle {
            position: relative;
            width: 100%;
        }

        .password-toggle input { padding-right: 40px; }

        .password-toggle i {
            position: absolute;
            right: 10px; /* Atur jarak dari tepi kanan */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
        
        .welcome-text {
            margin-bottom: 15px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }

        .remember-me {
            display: flex;
            align-items: center;
            width: 100%; /* Agar mengikuti lebar parent */
            font-size: 14px;
        }

        .remember-me .form-check-input { margin-right: 8px; width: 16px; height: 16px; }


    </style>
</head>
<body>

    <!-- Background Shapes -->
    <div class="shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>

    <!-- Header Logos -->
    <div class="header-logos">
        <img src="<?php echo base_url('assets/images/bumn-logo.png'); ?>" alt="BUMN Logo">
        <img src="<?php echo base_url('assets/images/injourneyputih.png'); ?>" alt="INJOURNEY Logo">
        <img src="<?php echo base_url('assets/images/soettaputih.png'); ?>" alt="Soekarno Logo">
        <img src="<?php echo base_url('assets/images/logo-it.png'); ?>" alt="IT Logo">
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <img src="<?php echo base_url('assets/images/amarloginitem.png'); ?>" alt="AMAR Logo">
        <p class="welcome-text">Welcome back! Login to access the AMAR Apps.</p>    

        <form id="loginForm" action="<?php echo base_url('auth/login'); ?>" method="post">
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
            <div class="password-toggle">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-eye-slash" id="togglePassword"></i>
            </div>
            <div class="remember-me mt-2">
                <input class="form-check-input" type="checkbox" id="rememberMe" name="remember_me">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <button type="submit" class="btn btn-login mt-3">Continue</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Toggle password visibility
        $('#togglePassword').on('click', function () {
            let passwordInput = $('#password');
            let type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
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
