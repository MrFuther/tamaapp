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
        <!-- Sidebar -->
        <div class="container-fluid page-body-wrapper">
            <?php include APPPATH . 'views/dashboard/sidebar.php'; ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            
    <!-- Tabel Data Device HIDN -->
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Device HIDN</h6>
            <p class="card-description">
                <a href="javascript:void(0);" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addDeviceHidnModal">
                    <i class="fas fa-plus-circle"></i> Tambah Device HIDN
            </a>
        </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Device HIDN ID</th>
                            <th>Device HIDN Name</th>
                            <th>Jumlah Device</th>
                            <th>Sub Device Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Pengambilan Data Device HIDN dari Database -->
                        <?php if (!empty($devicehidn)): ?>
                            <?php foreach ($devicehidn as $device): ?>
                                <tr>
                                    <td><?php echo $device->device_hidn_id; ?></td>
                                    <td><?php echo $device->device_hidn_name; ?></td>
                                    <td><?php echo $device->jum_device_hidn; ?></td>
                                    <td><?php echo $device->sub_device_name; ?></td>
                                    <td>
                                        <a href="<?= base_url('devicehidn/delete/' . $device->device_hidn_id); ?>" 
                                        class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Are you sure you want to delete this device?');">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No devices found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal untuk Tambah Device HIDN -->
    <div class="modal fade" id="addDeviceHidnModal" tabindex="-1" aria-labelledby="addDeviceHidnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeviceHidnModalLabel">Tambah Device HIDN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form action="<?= base_url('devicehidn/save'); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="device_hidn_name" class="form-label">Device HIDN Name</label>
                            <input type="text" class="form-control" id="device_hidn_name" name="device_hidn_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="jum_device_hidn" class="form-label">Jumlah Device</label>
                            <input type="number" class="form-control" id="jum_device_hidn" name="jum_device_hidn" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="sub_device_name" class="form-label">Sub Device Name</label>
                            <select class="form-control" id="sub_device_name" name="sub_device_id" required>
                                <option value="">Pilih Sub Device</option>
                                <?php if (!empty($sub_devices)) : ?>
                                    <?php foreach ($sub_devices as $sub_device): ?>
                                        <option value="<?= $sub_device->sub_device_id; ?>">
                                            <?= $sub_device->sub_device_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option value="">Data tidak ditemukan</option>
                                <?php endif; ?>
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
