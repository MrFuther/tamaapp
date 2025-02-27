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
                  <h6 class="card-title">Personel</h6>
                  <p class="card-description">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPersonelModal">
                    <i class="fas fa-plus-circle"></i> Tambah Personel
                  </button>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Users</th>
                        <th>Shift</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                    <?php foreach ($personel as $index => $p): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td>
                                <?php foreach ($p->users as $user): ?>
                                    <span class="badge bg-info"><?= $user->username; ?></span>
                                <?php endforeach; ?>
                            </td>
                            <td><?= $p->nama_shift; ?></td>
                            <td><?= $p->jam_mulai; ?></td>
                            <td><?= $p->jam_selesai; ?></td>
                            <td>
                                <a href="<?= base_url('personel/delete/'.$p->id_personel); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus personel ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </table>
                </div>

                <!-- Modal Tambah Personel -->
                <div class="modal fade" id="tambahPersonelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Personel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('personel/add'); ?>" method="POST">
                            <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Pilih Users</label>
                                <select class="form-control" name="user_id[]" multiple required>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Gunakan Ctrl/Cmd + Klik untuk memilih lebih dari satu user.</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Shift</label>
                                <select class="form-control" name="shift_id" required>
                                <?php foreach ($shifts as $shift): ?>
                                    <option value="<?= $shift->id_shift; ?>"><?= $shift->nama_shift; ?> (<?= $shift->jam_mulai; ?> - <?= $shift->jam_selesai; ?>)</option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

