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
    <link rel="stylesheet" href="<?php echo base_url('vendors/mdi/css/materialdesignicons.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('js/select.dataTables.min.css'); ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
</head>
<body>
<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <?php include APPPATH . 'views/dashboard/navbar.php'; ?>

    <div class="container-fluid page-body-wrapper">
      <!-- Sidebar -->
      <?php include APPPATH . 'views/dashboard/sidebar.php'; ?>
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
                            <div class="modal-dialog">
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

