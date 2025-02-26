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
                        <h6 class="card-title">Unit Kerja</h6>
                        <p class="card-description">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUnitKerjaModal">
                                <i class="fas fa-plus-circle"></i> Tambah
                            </button>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Unit Kerja</th>
                                        <th>Inisial Unit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($unitkerja as $kerja): ?>
                                        <tr>
                                            <td><?= $kerja->unit_name; ?></td>
                                            <td><?= $kerja->inisial_unit; ?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning btn-sm edit-unit-btn" 
                                                    data-id="<?= $kerja->unit_id; ?>" 
                                                    data-name="<?= $kerja->unit_name; ?>" 
                                                    data-inisial="<?= $kerja->inisial_unit; ?>"
                                                    data-bs-toggle="modal" data-bs-target="#editUnitKerja">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>

                                                <a href="<?= base_url('unitkerja/delete/' . $kerja->unit_id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus unit kerja ini?')">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="modal fade" id="editUnitKerja" tabindex="-1" aria-labelledby="editUnitKerjaLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="editUnitKerjaLabel">Edit Unit Kerja</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="<?= base_url('unitkerja/update') ?>" method="POST">
              <input type="hidden" id="unit_id" name="unit_id"> <!-- ID Unit Kerja -->
              <div class="modal-body">
                  <div class="form-group">
                      <label for="edit_nama_unitkerja">Nama Unit Kerja</label>
                      <input type="text" class="form-control" id="edit_nama_unitkerja" name="nama_unitkerja" required>
                  </div>
                  <div class="form-group">
                      <label for="edit_inisial_unit">Inisial Unit Kerja</label>
                      <input type="text" class="form-control" id="edit_inisial_unit" name="inisial_unit" required>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
          </form>
        </div>
    </div>
</div>

                        <!-- Modal untuk Tambah Unit Kerja -->
                        <div class="modal fade" id="addUnitKerjaModal" tabindex="-1" aria-labelledby="addUnitKerjaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addUnitKerjaModalLabel">Tambah Unit Kerja</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= base_url('unitkerja/save'); ?>" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="name_unitkerja" class="form-label">Nama Unit Kerja</label>
                                                <input type="text" class="form-control" id="unit_name" name="unit_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="inisial_unitkerja" class="form-label">Inisial Unit Kerja</label>
                                                <input type="text" class="form-control" id="inisial_unit" name="inisial_unit" required>
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

       <script>
$(document).ready(function () {
    $(".edit-unit-btn").on("click", function () {
        let unitId = $(this).data("id");
        let unitName = $(this).data("name");
        let inisialUnit = $(this).data("inisial");

        // Masukkan data ke dalam modal edit
        $("#editUnitKerja #unit_id").val(unitId);
        $("#editUnitKerja #edit_nama_unitkerja").val(unitName);
        $("#editUnitKerja #edit_inisial_unit").val(inisialUnit);
    });
});
</script>

        <!-- partial -->
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

