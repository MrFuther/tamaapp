<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TAMA Apps</title>
    <link rel="stylesheet" href="<?php echo base_url('vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/css/vendor.bundle.base.css'); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/mdi/css/materialdesignicons.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('js/select.dataTables.min.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/vertical-layout-light/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/tama-logo.png'); ?>" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include 'navbar.php'; ?>
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
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Activity</h6>
                  <p class="card-description">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addActivityModal">
                        <i class="fas fa-plus-circle"></i> Tambah
                    </button>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
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
                                    <!-- Tombol Edit untuk membuka modal -->
                                    <button class="btn btn-warning btn-sm mx-1" onclick="editActivity(<?= $activity['id'] ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="<?= base_url('activity/print_pdf/' . $activity['id']); ?>" class="btn btn-success btn-sm mx-1">
                                        <i class="fas fa-print"></i> Print
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                  </div>
                  <div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="addActivityModalLabel" aria-hidden="true">
                    <div class="modal-dialog custom-modal">
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

                                    <!-- Group Area -->
                                    <div class="mb-3">
                                        <label for="group_area" class="form-label">Group Area</label>
                                        <select class="form-select" id="group_area" name="group_area" required>
                                            <option selected disabled>Pilih Group Area</option>
                                            <?php foreach ($group_areas as $group_area): ?>
                                            <option value="<?= $group_area['id']; ?>"><?= $group_area['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Sub Area -->
                                    <div class="mb-3">
                                        <label for="sub_area" class="form-label">Sub Area</label>
                                        <select class="form-select" id="sub_area" name="sub_area[]" multiple required>
                                            <option selected disabled>Pilih Sub Area</option>
                                            <?php foreach ($sub_areas as $sub_area): ?>
                                            <option value="<?= $sub_area['id']; ?>"><?= $sub_area['name']; ?></option>
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
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- Modal Edit Activity -->
                  <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="editModalLabel">Edit Activity</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <form id="editActivityForm" enctype="multipart/form-data">
                                      <!-- Input fields for activity data -->
                                      <div class="form-group">
                                          <label for="tanggal">Tanggal</label>
                                          <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="lokasi">Lokasi</label>
                                          <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="device">Device</label>
                                          <input type="text" class="form-control" id="device" name="device" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="shift">Shift</label>
                                          <select class="form-control" id="shift" name="shift" required>
                                              <option value="Pagi">Pagi</option>
                                              <option value="Malam">Malam</option>
                                          </select>
                                      </div>

                                      <h5>Dokumentasi</h5>
                                      <table class="table">
                                          <thead>
                                              <tr>
                                                  <th>Foto 1</th>
                                                  <th>Foto 2</th>
                                                  <th>Foto 3</th>
                                              </tr>
                                          </thead>
                                          <tbody id="documentationTable">
                                              <!-- Existing photos will be inserted here dynamically -->
                                          </tbody>
                                      </table>

                                      <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addDocumentationModal">
                                          <i class="fas fa-plus-circle"></i> Tambah Dokumentasi
                                      </button>
                                      
                                      <button type="submit" class="btn btn-success">Simpan</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Modal Tambah Dokumentasi -->
                  <div id="addDocumentationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addDocumentationModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="addDocumentationModalLabel">Tambah Dokumentasi</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form id="addDocumentationForm" enctype="multipart/form-data">
                                      <!-- Input untuk 3 foto -->
                                      <div class="mb-3">
                                          <label for="photo1" class="form-label">Foto 1</label>
                                          <input type="file" class="form-control-file" id="photo1" name="newPhotos[]" required>
                                      </div>
                                      <div class="mb-3">
                                          <label for="photo2" class="form-label">Foto 2</label>
                                          <input type="file" class="form-control-file" id="photo2" name="newPhotos[]" required>
                                      </div>
                                      <div class="mb-3">
                                          <label for="photo3" class="form-label">Foto 3</label>
                                          <input type="file" class="form-control-file" id="photo3" name="newPhotos[]" required>
                                      </div>

                                      <button type="submit" class="btn btn-success">Tambah Dokumentasi</button>
                                  </form>
                              </div>
                              <div class="modal-footer">
                                  <!-- Tombol Kembali ke Modal Edit Activity -->
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editModal">
                                      Kembali
                                  </button>
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
  <script>
  // JavaScript untuk menangani klik tombol Edit dan menampilkan modal
  function editActivity(activityId) {
      $.ajax({
          url: '<?= base_url('activity/get_activity_data') ?>/' + activityId,
          method: 'GET',
          dataType: 'json',
          success: function(data) {
              // Isi modal dengan data aktivitas
              $('#tanggal').val(data.activity.tanggal);
              $('#lokasi').val(data.activity.lokasi);
              $('#device').val(data.activity.device);
              $('#shift').val(data.activity.shift);

              // Hapus baris dokumentasi yang lama
              $('#documentationTable').empty();

              // Masukkan foto-foto ke dalam tabel dokumentasi
              data.documentation.forEach(function(photoRow) {
                  $('#documentationTable').append(`
                      <tr>
                          <td><img src="<?= base_url('uploads/') ?>${photoRow.photo1}" width="100"></td>
                          <td><img src="<?= base_url('uploads/') ?>${photoRow.photo2}" width="100"></td>
                          <td><img src="<?= base_url('uploads/') ?>${photoRow.photo3}" width="100"></td>
                      </tr>
                  `);
              });

              // Tampilkan modal
              $('#editModal').modal('show');
          }
      });
  }
  </script>
  <script>
    // Menangani submit form untuk menambahkan dokumentasi
    $('#addDocumentationForm').submit(function(e) {
        e.preventDefault();  // Menghentikan form submit default

        var formData = new FormData(this);  // Ambil form data termasuk file foto

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '<?= base_url('activity/add_documentation') ?>',  // Endpoint untuk menangani dokumentasi
            method: 'POST',
            data: formData,
            contentType: false,  // Jangan set content-type secara manual, biarkan browser melakukannya
            processData: false,  // Jangan memproses data sebelum dikirim (karena kita mengirim file)
            success: function(response) {
                console.log(response);  // Untuk debugging, lihat respons dari server
                if (response.status === 'success') {
                    alert('Dokumentasi berhasil ditambahkan!');
                    $('#addDocumentationModal').modal('hide');  // Tutup modal jika sukses
                    location.reload();  // Reload halaman untuk melihat data baru
                } else {
                    alert(response.message);  // Tampilkan pesan error jika gagal
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan dokumentasi.');
            }
        });
    });
  </script>
  <script>
    $(document).ready(function() {
        $('#group_area').change(function() {
            var groupId = $(this).val();
            $.ajax({
                url: '<?= base_url('activity/get_sub_areas'); ?>', // Ganti dengan URL yang sesuai
                type: 'POST',
                data: {group_id: groupId},
                success: function(response) {
                    $('#sub_area').empty(); // Kosongkan sub_area
                    $.each(response, function(index, sub_area) {
                        $('#sub_area').append('<option value="' + sub_area.id + '">' + sub_area.name + '</option>');
                    });
                }
            });
        });
    });
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

