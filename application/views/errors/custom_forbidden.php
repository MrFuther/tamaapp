<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #8cc63f;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
        }
        h1 {
            font-size: 48px;
            font-weight: bold;
            color: #006cb6;
            margin: 0;
        }
        span {
            color: #006cb6;
        }
        p {
            font-size: 18px;
            color: #006cb6;
            margin: 10px 0 20px;
        }
        a {
            display: inline-block;
            text-decoration: none;
            background-color: #006cb6;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }
        a:hover {
            background-color: #006cb6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><span>40</span>3 - Forbidden</h1>
        <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="<?= base_url('dashboard') ?>">Kembali ke Dashboard</a>
    </div>
</body>
</html>
