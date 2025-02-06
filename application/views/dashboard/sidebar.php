<head>
    <link href="<?php echo base_url('assets/css/sidebar.css'); ?>" rel="stylesheet" type="text/css">
</head>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('activity'); ?>">
                    <i class="fas fa-chart-line"></i>
                    <span class="menu-title">Activity</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="fas fa-database"></i>
                    <span class="menu-title">Master Data</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('unitkerja'); ?>"> Master Unit Kerja </a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('subunitkerja'); ?>"> Master Sub Unit </a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('grouparea'); ?>"> Master Group Area </a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('subarea'); ?>"> Master Sub Area </a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('groupdevice'); ?>"> Master Group Device </a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url('subdevice'); ?>"> Master Group Area </a></li>
                    </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('m_user'); ?>">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Manage User</span>
                    </a>
                </li>
            </ul>
        </nav>