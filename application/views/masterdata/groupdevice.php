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
    <link rel="stylesheet" href="<?php echo base_url('css/vertical-layout-light/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include APPPATH . 'views\dashboard\navbar.php'; ?>
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
            </div>
          </div>
          <!-- To do section tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include APPPATH . 'views\dashboard\sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Group Device</h6>
                        <p class="card-description">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroupDeviceModal">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </button>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pekerjaan Unit</th>
                                        <th>Sub Unit Kerja</th>
                                        <th>Unit Kerja</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($groupdevice as $group): ?>
                                        <tr>
                                            <td><?= $group->pek_unit_name; ?></td>
                                            <td><?= $group->subunit_pek_name; ?></td>
                                            <td><?= $group->inisial_unit_kerja; ?></td>
                                            <td>
                                                <a href="<?= base_url('groupdevice/index/' . $group->pek_unit_id); ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="<?= base_url('groupdevice/delete/' . $group->pek_unit_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus group device ini?')">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal untuk Tambah Group Device -->
                        <div class="modal fade" id="addGroupDeviceModal" tabindex="-1" aria-labelledby="addGroupDeviceModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addGroupDeviceModalLabel">Tambah Group Device</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('groupdevice/save'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="nama_pekerjaanunit" class="form-label">Nama Pekerjaan Unit</label>
                                                <input type="text" class="form-control" id="nama_pekerjaanunit" name="nama_pekerjaanunit" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_subunit" class="form-label">Sub Unit Kerja</label>
                                                <select class="form-control" id="id_subunit" name="id_subunit" required>
                                                    <option value="">-- Select Sub Unit Kerja --</option>
                                                    <?php foreach ($subunitkerja as $subunit): ?>
                                                        <option value="<?= $subunit->subunit_id; ?>"><?= $subunit->subunit_pek_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="id_unitkerja" class="form-label">Unit Kerja</label>
                                                <select class="form-control" id="id_unitkerja" name="id_unitkerja" required>
                                                    <option value="">-- Select Unit Kerja --</option>
                                                    <?php foreach ($unitkerja as $unit): ?>
                                                        <option value="<?= $unit->unit_id; ?>"><?= $unit->unit_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <div id="logoutModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Logout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Apakah Anda yakin ingin logout?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="logout()">Logout</button>
          </div>
        </div>
      </div>
    </div>  
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script>
    function showLogoutConfirmation() {
    // Menampilkan modal
    var modal = new bootstrap.Modal(document.getElementById('logoutModal'));
    modal.show();
    }

    function logout() {
    // Implementasi logika logout di sini
    alert("Anda telah logout.");
    // Redirect ke halaman login atau halaman utama setelah logout
    window.location.href = "<?php echo base_url('auth/logout'); ?>";  // Ganti dengan URL halaman login Anda
    }
  </script>
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

