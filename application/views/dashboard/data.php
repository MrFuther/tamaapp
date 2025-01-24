<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Master Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
</head>
<body>
<div class="sidebar d-flex flex-column p-3">
    <!-- Logo Section -->
    <div class="d-flex sidebar-logo">
        <img src="<?php echo base_url('assets/images/tama-logo.png'); ?>" alt="Tama Logo">
        <span class="ms-2 app-name">TAMA App</span>
    </div>
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>" href="<?php echo base_url('dashboard'); ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'activity') ? 'active' : ''; ?>" href="<?php echo base_url('activity'); ?>">
                <i class="fas fa-comments"></i>
                <span>Activity Module</span>
            </a>
        </li>
        <?php if ($user['role'] == 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'report') ? 'active' : ''; ?>" href="<?php echo base_url('report'); ?>">
                <i class="fas fa-file-alt"></i>
                <span>Master Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'data') ? 'active' : ''; ?>" href="<?php echo base_url('data'); ?>">
                <i class="fas fa-database"></i>
                <span>Master Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'm_user') ? 'active' : ''; ?>" href="<?php echo base_url('m_user'); ?>">
                <i class="fas fa-users"></i>
                <span>Manage User</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <button class="btn btn-outline-secondary mt-auto" id="toggle-sidebar">
        <i class="fas fa-chevron-left"></i>
    </button>
</div>

<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <h5 class="navbar-brand mb-0">Hallo, <?php echo $user['username']; ?></h5>
            <span class="badge badge-premium">as <?php echo ucfirst($user['role']); ?></span>

            <!-- Dropdown for Logout -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <?php echo $user['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <!-- Main dashboard content goes here -->
    </div>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        // Fungsi untuk toggle sidebar
        document.getElementById('toggle-sidebar').addEventListener('click', function () {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');

            const content = document.querySelector('.content');
            content.classList.toggle('collapsed'); // Update content margin when sidebar is collapsed

            const icon = this.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');
            }
        });
</script>
<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>
</body>
</html>