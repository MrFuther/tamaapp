<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Apps</title>
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

    <!-- Button and Search Bar Section -->
    <div class="container mt-4 d-flex justify-content-between align-items-center">
        <!-- Tombol Tambah -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
            <i class="fas fa-plus-circle"></i> Tambah
        </button>

        <!-- Tombol Search -->
        <div class="input-group" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Cari Aktivitas..." aria-label="Cari Aktivitas" id="searchInput">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Tabel Activity -->
    <div class="container mt-4">
        <h3>Employee List</h3>
        <table class="table table-striped" id="activityTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Job Position</th>
                    <th>Since</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Andrew Mike</td>
                    <td>Developer</td>
                    <td>2013</td>
                    <td>€ 99,225</td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>John Doe</td>
                    <td>Designer</td>
                    <td>2012</td>
                    <td>€ 89,241</td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Alex Mike</td>
                    <td>Designer</td>
                    <td>2010</td>
                    <td>€ 92,144</td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Mike Monday</td>
                    <td>Marketing</td>
                    <td>2013</td>
                    <td>€ 49,990</td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Paul Dickens</td>
                    <td>Communication</td>
                    <td>2015</td>
                    <td>€ 69,201</td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal for Add Activity -->
    <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">Tambah Aktivitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Start -->
                    <form>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <select class="form-select" id="location" required>
                                <option selected>Pilih Lokasi</option>
                                <option value="Location 1">Lokasi 1</option>
                                <option value="Location 2">Lokasi 2</option>
                                <option value="Location 3">Lokasi 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="device" class="form-label">Device</label>
                            <select class="form-select" id="device" required>
                                <option selected>Pilih Device</option>
                                <option value="Device 1">Device 1</option>
                                <option value="Device 2">Device 2</option>
                                <option value="Device 3">Device 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shift" class="form-label">Shift</label>
                            <select class="form-select" id="shift" required>
                                <option selected>Pilih Shift</option>
                                <option value="Morning">Pagi</option>
                                <option value="Night">Malam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="personnel" class="form-label">Personil</label>
                            <select class="form-select" id="personnel" required>
                                <option selected>Pilih Personil</option>
                                <option value="Person 1">Personil 1</option>
                                <option value="Person 2">Personil 2</option>
                                <option value="Person 3">Personil 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Ambil Foto</label>
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" type="file" id="devicePhoto" accept="image/*">
                                    <label class="form-label">Perangkat</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="file" id="locationPhoto" accept="image/*">
                                    <label class="form-label">Lokasi Perangkat</label>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="file" id="personnelPhoto" accept="image/*">
                                    <label class="form-label">Teknisi yang Bertugas</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="confirmData">
                            <label class="form-check-label" for="confirmData">Anda menyatakan bahwa data yang Anda isikan adalah benar adanya</label>
                        </div>
                    </form>
                    <!-- Form End -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
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
