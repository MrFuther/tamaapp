<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AMAR Apps</title>
    <link rel="stylesheet" href="<?php echo base_url('vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/css/vendor.bundle.base.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/mdi/css/materialdesignicons.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('js/select.dataTables.min.css'); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include 'navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Manage User</h6>
                  <p class="card-description">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-user-plus me-2"></i>Add User
                    </button>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Unit Kerja</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                              <td><?php echo $user['id']; ?></td>
                              <td><?php echo $user['username']; ?></td>
                              <td><span class="badge bg-secondary text-capitalize"><?php echo $user['role']; ?></span></td>
                              <td><?php echo $user['unit_name'] ?? '-'; ?></td>
                              <td>
                                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateRoleModal-<?php echo $user['id']; ?>">
                                      <i class="fas fa-edit"></i> Edit Role
                                  </button>
                                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal-<?php echo $user['id']; ?>">
                                      <i class="fas fa-trash"></i> Delete
                                  </button>
                              </td>
                            </tr>

                                <!-- Update Role Modal -->
                                <div class="modal fade" id="updateRoleModal-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="updateRoleModalLabel-<?php echo $user['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <form action="<?php echo base_url('manageuser/update_role/'.$user['id']); ?>" method="POST">
                                          <div class="modal-body">

                                              <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                                              <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $user['nama_pegawai']; ?>">

                                              <label for="role" class="form-label">Select Role</label>
                                              <select name="role" class="form-select">
                                                  <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                  <option value="management" <?php echo $user['role'] == 'management' ? 'selected' : ''; ?>>Management</option>
                                                  <option value="supervisor" <?php echo $user['role'] == 'supervisor' ? 'selected' : ''; ?>>Supervisor</option>
                                                  <option value="teknisi" <?php echo $user['role'] == 'teknisi' ? 'selected' : ''; ?>>Teknisi</option>
                                              </select>

                                              <label for="unit_id" class="form-label">Unit Kerja</label>
                                              <select name="unit_id" class="form-select">
                                                  <?php foreach ($units as $unit): ?>
                                                      <option value="<?php echo $unit['unit_id']; ?>" <?php echo ($user['unit_id'] == $unit['unit_id']) ? 'selected' : ''; ?>>
                                                          <?php echo $unit['unit_name']; ?>
                                                      </option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="submit" class="btn btn-success">Save Changes</button>
                                          </div>
                                      </form>
                                        </div>
                                    </div>
                                </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteUserModal-<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="deleteUserModalLabel-<?php echo $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the user <strong><?php echo $user['username']; ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="<?php echo base_url('manageuser/delete_user/'.$user['id']); ?>" class="btn btn-danger btn-confirm-delete">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url('manageuser/add_user'); ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="management">Manager</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="teknisi">Technician</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Unit Kerja</label>
                            <select name="unit_id" class="form-control" required>
                                <?php foreach ($units as $unit): ?>
                                    <option value="<?php echo $unit['unit_id']; ?>"><?php echo $unit['unit_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<!-- plugins:js -->
<script src="<?php echo base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?php echo base_url('vendors/chart.js/Chart.min.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
  <script src="<?php echo base_url('js/dataTables.select.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo base_url('js/off-canvas.js'); ?>"></script>
  <script src="<?php echo base_url('js/hoverable-collapse.js'); ?>"></script>
  <script src="<?php echo base_url('js/template.js'); ?>"></script>
  <script src="<?php echo base_url('js/settings.js'); ?>"></script>
  <script src="<?php echo base_url('js/todolist.js'); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url('js/dashboard.js'); ?>"></script>
  <script src="<?php echo base_url('js/Chart.roundedBarCharts.js'); ?>"></script>
  <!-- End custom js for this page-->
</body>

</html>

