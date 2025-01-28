<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Apps</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        <h3 class="text-2xl font-semibold mb-4">Activity List</h3>
        
        <!-- Filter -->
        <form method="get" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="filterDate" class="form-label">Filter Tanggal</label>
                    <input type="date" name="tanggal" id="filterDate" class="form-control" value="<?= $this->input->get('tanggal'); ?>">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Tombol Tambah -->
        <div class="d-flex justify-content-start mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                <i class="fas fa-plus-circle"></i> Tambah
            </button>
        </div>

        <!-- Tabel Full Bootstrap -->
        <div class="table-responsive">
            <table class="table table-hover align-middle shadow-sm rounded">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Lokasi</th>
                        <th class="text-center">Device</th>
                        <th class="text-center">Shift</th>
                        <th class="text-center">Personil</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activities as $index => $activity): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1; ?></td>
                        <td class="text-center"><?= $activity['tanggal']; ?></td>
                        <td class="text-center"><?= $activity['lokasi']; ?></td>
                        <td class="text-center"><?= $activity['device']; ?></td>
                        <td class="text-center"><?= $activity['shift']; ?></td>
                        <td class="text-center"><?= $activity['personil']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('activity/delete/' . $activity['id']); ?>" class="btn btn-danger btn-sm mx-1">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                            <a href="#" class="btn btn-warning btn-sm mx-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="#" class="btn btn-success btn-sm mx-1">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
                    <form action="<?= base_url('activity/add'); ?>" method="post" enctype="multipart/form-data">
                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <select class="form-select" id="lokasi" name="lokasi" required>
                                <option selected disabled>Pilih Lokasi</option>
                                <?php foreach ($locations as $location): ?>
                                <option value="<?= $location['location_name']; ?>"><?= $location['location_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Device Type -->
                        <div class="mb-3">
                            <label for="device_type" class="form-label">Device Type</label>
                            <select class="form-select" id="device_type" name="device_type" required>
                                <option selected disabled>Pilih Device Type</option>
                                <?php foreach ($device_types as $device_type): ?>
                                <option value="<?= $device_type['device_type']; ?>"><?= $device_type['device_type']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Device ID (Dynamic based on Device Type) -->
                        <div class="mb-3">
                            <label for="device_id" class="form-label">Device ID</label>
                            <select class="form-select" id="device_id" name="device" required>
                                <option selected disabled>Pilih Device ID</option>
                                <?php foreach ($devices as $device): ?>
                                <option value="<?= $device['device_id']; ?>"><?= $device['device_id']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Shift -->
                        <div class="mb-3">
                            <label for="shift" class="form-label">Shift</label>
                            <select class="form-select" id="shift" name="shift" required>
                                <option selected disabled>Pilih Shift</option>
                                <?php foreach ($shifts as $shift): ?>
                                <option value="<?= $shift; ?>"><?= $shift; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Personil -->
                        <div class="mb-3">
                            <label for="personnel" class="form-label">Personil</label>
                            <select class="form-select" id="personnel" name="personnel[]" multiple required>
                                <?php foreach ($personnel as $person): ?>
                                <option value="<?= $person['personnel']; ?>"><?= $person['personnel']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="devicePhoto" class="form-label">Foto Perangkat</label>
                            <input type="file" class="form-control" id="devicePhoto" name="devicePhoto" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="locationPhoto" class="form-label">Foto Lokasi</label>
                            <input type="file" class="form-control" id="locationPhoto" name="locationPhoto" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="personnelPhoto" class="form-label">Foto Teknisi</label>
                            <input type="file" class="form-control" id="personnelPhoto" name="personnelPhoto" accept="image/*">
                        </div>

                        <!-- Submit -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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

    <!-- Logout Confirmation Modal -->
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
    $('#device_type').change(function () {
    const deviceType = $(this).val();

        $.getJSON('<?= base_url("activity/getDevicesByType"); ?>', { device_type: deviceType }, function (data) {
            $('#device_id').empty().append('<option selected disabled>Pilih Device ID</option>');
            data.forEach(function (device) {
                $('#device_id').append(`<option value="${device.device_id}">${device.device_id}</option>`);
            });
        });
    });
</script>
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
