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
    <h2 class="mb-4">Master Data</h2>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="masterDataTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="location-tab" data-bs-toggle="tab" data-bs-target="#location-tab-pane" type="button" role="tab" aria-controls="location-tab-pane" aria-selected="true">
                Location
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="device-tab" data-bs-toggle="tab" data-bs-target="#device-tab-pane" type="button" role="tab" aria-controls="device-tab-pane" aria-selected="false">
                Device Type & ID
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="personil-tab" data-bs-toggle="tab" data-bs-target="#personil-tab-pane" type="button" role="tab" aria-controls="personil-tab-pane" aria-selected="false">
                Personil & Shift
            </button>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content mt-3" id="masterDataTabContent">
    <!-- Tab 1: Location -->
        <div class="tab-pane fade show active" id="location-tab-pane" role="tabpanel" aria-labelledby="location-tab">
            <h5>Location</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($locations as $location): ?>
                    <tr>
                        <td><?= $location['location_name']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="<?= base_url('MasterData/addLocation'); ?>" method="post">
                <div class="mb-3">
                    <label for="location_name" class="form-label">Location Name</label>
                    <input type="text" class="form-control" id="location_name" name="location_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Location</button>
            </form>
        </div>

        <!-- Tab 2: Device Info -->
        <div class="tab-pane fade" id="device-tab-pane" role="tabpanel" aria-labelledby="device-tab">
        <h5>Device Type & Device ID</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Device Type</th>
                    <th>Device ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($devices as $device): ?>
                <tr>
                    <td><?= $device['device_type']; ?></td>
                    <td><?= $device['device_id']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
            <form action="<?= base_url('MasterData/addDevice'); ?>" method="post">
                <div class="mb-3">
                    <label for="location_id" class="form-label">Location</label>
                    <select class="form-select" id="location_id" name="location_id" required>
                        <?php foreach ($locations as $location): ?>
                        <option value="<?= $location['id']; ?>"><?= $location['location_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="device_type" class="form-label">Device Type</label>
                    <select class="form-select" id="device_type" name="device_type" required>
                        <option value="Access Point">Access Point</option>
                        <option value="Switch">Switch</option>
                        <option value="Perangkat IT">Perangkat IT</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="device_id" class="form-label">Device ID</label>
                    <input type="text" class="form-control" id="device_id" name="device_id" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Device</button>
            </form>
        </div>

        <!-- Tab 3: Personil & Shift -->
        <div class="tab-pane fade" id="personil-tab-pane" role="tabpanel" aria-labelledby="personil-tab">
            <h5>Personil & Shift</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Shift</th>
                        <th>Personnel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records['shifts'] as $shift): ?>
                    <tr>
                        <td><?= $shift['shift']; ?></td>
                        <td><?= implode(', ', explode(',', $shift['personnel'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form action="<?= base_url('MasterData/addShiftPersonnel'); ?>" method="post">
                <div class="mb-3">
                    <label for="shift" class="form-label">Shift</label>
                    <select class="form-select" id="shift" name="shift" required>
                        <option value="Pagi">Pagi</option>
                        <option value="Siang">Siang</option>
                        <option value="Malam">Malam</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="personnel" class="form-label">Personnel</label>
                    <select class="form-select" id="personnel" name="personnel[]" multiple required>
                        <?php foreach ($users as $user): ?>
                        <option value="<?= $user['username']; ?>"><?= $user['username']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Shift & Personnel</button>
            </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Filter by Location
        $('#filterLocation').on('keyup', function () {
            const value = $(this).val().toLowerCase();
            $('#dataTable tbody tr').filter(function () {
                $(this).toggle($(this).children('.location').text().toLowerCase().includes(value));
            });
        });

        // Filter by Device Type
        $('#filterDeviceType').on('keyup', function () {
            const value = $(this).val().toLowerCase();
            $('#dataTable tbody tr').filter(function () {
                $(this).toggle($(this).children('.device_type').text().toLowerCase().includes(value));
            });
        });

        // Filter by Data Type (Dropdown)
        $('#dataTypeFilter').on('change', function () {
            const filterValue = $(this).val();

            $('#dataTable tbody tr').each(function () {
                const location = $(this).children('.location').text().toLowerCase();
                const deviceType = $(this).children('.device_type').text().toLowerCase();
                const shift = $(this).children('.shift').text().toLowerCase();

                if (filterValue === 'all') {
                    $(this).show(); // Show all rows
                } else if (filterValue === 'location' && location) {
                    $(this).toggle(location !== ''); // Show if Location has data
                } else if (filterValue === 'device_type' && deviceType) {
                    $(this).toggle(deviceType !== ''); // Show if Device Type has data
                } else if (filterValue === 'shift' && shift) {
                    $(this).toggle(shift !== ''); // Show if Shift has data
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Add Location
        $('#addLocationForm').submit(function (e) {
            e.preventDefault();
            $.post('<?= base_url("MasterData/addRecord"); ?>', $(this).serialize(), function (response) {
                alert('Location added successfully!');
                location.reload();
            });
        });

        // Add Device
        $('#addDeviceForm').submit(function (e) {
            e.preventDefault();
            $.post('<?= base_url("MasterData/addRecord"); ?>', $(this).serialize(), function (response) {
                alert('Device added successfully!');
                location.reload();
            });
        });

        // Add Personil & Shift
        $('#addPersonilForm').submit(function (e) {
            e.preventDefault();
            $.post('<?= base_url("MasterData/addRecord"); ?>', $(this).serialize(), function (response) {
                alert('Personil & Shift added successfully!');
                location.reload();
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Handle form submission
        $('#addForm').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?= base_url("MasterData/addRecord"); ?>',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('Data added successfully!');
                        location.reload();
                    }
                }
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