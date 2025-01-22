<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Technical Activity Maintenance Assistant</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
                    </li>
                    <?php if($user['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manajemen User</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <?php echo $user['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome, <?php echo $user['username']; ?></h5>
                        <p class="card-text">Role: <?php echo ucfirst($user['role']); ?></p>
                        
                        <!-- Content sesuai role -->
                        <?php if($user['role'] == 'admin'): ?>
                            <div class="alert alert-info">
                                Anda login sebagai Administrator
                            </div>
                        <?php elseif($user['role'] == 'management'): ?>
                            <div class="alert alert-info">
                                Anda login sebagai Management
                            </div>
                        <?php elseif($user['role'] == 'spv'): ?>
                            <div class="alert alert-info">
                                Anda login sebagai Supervisor
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">
                                Anda login sebagai Teknisi
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>