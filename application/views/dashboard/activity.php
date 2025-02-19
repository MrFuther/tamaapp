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
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
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
                  <h6 class="card-title">Activity Management</h6>
                  <p class="card-description">
                  <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahActivityModal">Tambah Aktivitas</button>
                  </p>
                  <div class="table-responsive">
                  <input type="text" id="searchInput" class="form-control" placeholder="Cari data...">
                    <table class="table table-striped" id="activityTable" id="activityTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>ID</th>
                          <th>Kode Activity</th>
                          <th>Personel</th>
                          <th>Shift</th>
                          <th>Jam Kerja</th>
                          <th>Tanggal Kegiatan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($activities as $index => $activity): ?>
                        <tr>
                          <td><?= $index + 1; ?></td>
                          <td><?= $activity->id_activity; ?></td>
                          <td><?= $activity->kode_activity; ?></td>
                          <td>
                            <?php foreach ($activity->users as $user): ?>
                              <span class="badge bg-info"><?= $user->username; ?></span>
                            <?php endforeach; ?>
                          </td>
                          <td><?= $activity->nama_shift; ?></td>
                          <td><?= $activity->jam_mulai; ?> - <?= $activity->jam_selesai; ?></td>
                          <td><?= $activity->tanggal_kegiatan; ?></td>
                          <td>
                            <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#formModal" data-activity-id="<?= $activity->id_activity ?>">Form</button>
                            <a href="<?= base_url('activity/delete/'.$activity->id_activity); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus aktivitas ini?')">Hapus</a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- Modal Tambah Aktivitas -->
                  <div class="modal fade" id="tambahActivityModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Tambah Aktivitas</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="<?= base_url('activity/add'); ?>" method="POST">
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Pilih Personel</label>
                              <select class="form-control" name="personel_id" required>
                              <option value="">-- Pilih Personel --</option>
                                <?php foreach ($personel as $p): ?>
                                    <option value="<?= $p->id_personel; ?>"><?= $p->usernames; ?></option>
                                <?php endforeach; ?>>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Pilih Shift</label>
                              <select class="form-control" name="shift_id" required>
                                <?php foreach ($shifts as $shift): ?>
                                  <option value="<?= $shift->id_shift; ?>">
                                      <?= $shift->nama_shift; ?> (<?= $shift->jam_mulai; ?> - <?= $shift->jam_selesai; ?>)
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Tanggal Kegiatan</label>
                              <input type="date" class="form-control" name="tanggal_kegiatan" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="formModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Activity Form</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          
                          <div class="modal-body">
                              <!-- Activity Details -->
                              <div class="row mb-3">
                                  <div class="col-md-6">
                                      <h5>Activity Details</h5>
                                      <p>Date: <?= date('d M Y', strtotime($activity->tanggal_kegiatan)) ?></p>
                                      <p>Shift: <?= $activity->nama_shift ?></p>
                                      <p>Time: <?= $activity->jam_mulai ?> - <?= $activity->jam_selesai ?></p>
                                      <p>Team: 
                                          <?php foreach($users as $user): ?>
                                              <?= $user->username ?>, 
                                          <?php endforeach; ?>
                                      </p>
                                  </div>
                                  
                                  <!-- Form Input -->
                                  <div class="col-md-6">
                                      <form id="activityForm" action="<?= base_url('activity/save_form') ?>" method="POST">
                                          <input type="hidden" name="activity_id" value="<?= $activity->id_activity ?>">
                                          
                                          <div class="mb-3">
                                              <label>Perangkat</label>
                                              <select name="sub_device_id" class="form-control" required>
                                                  <option value="">Select Device</option>
                                                  <?php foreach($sub_devices as $device): ?>
                                                      <option value="<?= $device->sub_device_id ?>"><?= $device->sub_device_name ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label>Lokasi</label>
                                              <select name="area_id" class="form-control" required>
                                                  <option value="">Select Location</option>
                                                  <?php foreach($areas as $area): ?>
                                                      <option value="<?= $area->area_id ?>"><?= $area->area_name ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          
                                          <div class="mb-3">
                                              <label>Kelompok Laporan</label>
                                              <div class="form-check">
                                                  <input type="radio" name="report_type" value="Harian" class="form-check-input" required>
                                                  <label class="form-check-label">Harian</label>
                                              </div>
                                              <div class="form-check">
                                                  <input type="radio" name="report_type" value="Mingguan" class="form-check-input">
                                                  <label class="form-check-label">Mingguan</label>
                                              </div>
                                              <div class="form-check">
                                                  <input type="radio" name="report_type" value="Bulanan" class="form-check-input">
                                                  <label class="form-check-label">Bulanan</label>
                                              </div>
                                          </div>
                                          
                                          <button type="submit" class="btn btn-primary">Save</button>
                                      </form>
                                  </div>
                              </div>
                              
                              <!-- Saved Forms Table -->
                              <div class="table-responsive mt-4">
                                  <h6>Saved Forms</h6>
                                  <table id="savedFormsTable" class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th>No</th>
                                              <th>Perangkat</th>
                                              <th>Lokasi</th>
                                              <th>Kelompok Laporan</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>  
                                        <?php foreach($saved_forms as $index => $form): ?>  
                                            <tr>  
                                                <td><?= $index + 1 ?></td>  
                                                <td><?= $form->sub_device_name ?></td>  
                                                <td><?= $form->area_name ?></td>  
                                                <td><?= $form->report_type ?></td>  
                                                <td>  
                                                    <a href="<?= base_url('activity/delete_form/'.$form->form_id.'/'.$activity->id_activity) ?>"   
                                                      class="btn btn-danger btn-sm delete-form"   
                                                      onclick="return confirm('Are you sure?')">Delete</a>  
                                                    <a href="#" class="btn btn-info btn-sm">Print</a>  
                                                </td>  
                                            </tr>  
                                        <?php endforeach; ?>  
                                    </tbody>
                                  </table>
                              </div>
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

    function openUploadPhoto(documentationId) {
        if (!documentationId) {
            alert('Silakan buat dokumentasi terlebih dahulu sebelum upload foto');
            return;
        }
        document.getElementById('documentation_id').value = documentationId;
        var uploadModal = new bootstrap.Modal(document.getElementById('uploadPhotoModal'));
        var documentationModal = new bootstrap.Modal(document.getElementById('documentationModal'));
        uploadModal.show();
        documentationModal.hide();
    }

    function loadDocumentationPhoto(activity_id) {
        // Mengambil data yang relevan dan memanggil modal
        $.ajax({
            url: '<?= base_url("activity/show_documentation_photos/"); ?>' + activity_id,
            type: 'GET',
            success: function(response) {
                // Memasukkan data ke dalam modal jika data ditemukan
                $('#documentationPhotoModal .modal-body').html(response);
            },
            error: function() {
                alert('Error loading documentation photo data');
            }
        });
    }

    const formModal = document.getElementById('formModal');  
      formModal.addEventListener('show.bs.modal', event => {  
          const button = event.relatedTarget; // Tombol yang memicu modal  
          const activityId = button.getAttribute('data-activity-id');  

          // Lakukan permintaan AJAX ke controller  
          fetch('<?= base_url('activity/show_form/') ?>' + activityId, {  
              method: 'GET',  
              headers: {  
                  'X-Requested-With': 'XMLHttpRequest' // Penting untuk CodeIgniter  
              }  
          })  
          .then(response => response.text())  
          .then(html => {  
              formModal.querySelector('.modal-body').innerHTML = html; // Masukkan HTML ke dalam body modal  
          })  
          .catch(error => {  
              console.error('Error:', error);  
              formModal.querySelector('.modal-body').innerHTML = '<p>Error loading form.</p>';  
          });  
      });  

    $(document).ready(function() {  
        // Handler untuk submit form  
        $('#activityForm').on('submit', function(e) {  
            e.preventDefault(); // Mencegah form submit biasa  

            $.ajax({  
                type: 'POST',  
                url: '<?= base_url('activity/save_form') ?>',  
                data: $(this).serialize(),  
                dataType: 'json',  
                success: function(response) {  
                    if (response.status === 'success') {  
                        // Tambahkan baris baru ke tabel  
                        var newRow = `  
                            <tr>  
                                <td>${$('#savedFormsTable tbody tr').length + 1}</td>  
                                <td>${response.form.sub_device_name}</td>  
                                <td>${response.form.area_name}</td>  
                                <td>${response.form.report_type}</td>  
                                <td>  
                                    <a href="<?= base_url('activity/delete_form/') ?>${response.form.form_id}/${response.form.activity_id}"   
                                      class="btn btn-danger btn-sm delete-form"   
                                      onclick="return confirm('Are you sure?')">Delete</a>  
                                    <a href="#" class="btn btn-info btn-sm">Print</a>  
                                </td>  
                            </tr>  
                        `;  
                        $('#savedFormsTable tbody').append(newRow);  

                        // Reset form  
                        $('#activityForm')[0].reset();  

                        // Tampilkan pesan sukses (opsional)  
                        alert(response.message);  
                    } else {  
                        // Tampilkan pesan error  
                        alert(response.message);  
                    }  
                },  
                error: function() {  
                    alert('Terjadi kesalahan saat mengirim data');  
                }  
            });  
        });  

        // Handler untuk delete form (event delegation karena elemen dinamis)  
        $('#savedFormsTable').on('click', '.delete-form', function(e) {  
            e.preventDefault();  
            var url = $(this).attr('href');  
            var row = $(this).closest('tr');  

            $.ajax({  
                type: 'GET',  
                url: url,  
                dataType: 'json',  
                success: function(response) {  
                    if (response.status === 'success') {  
                        // Hapus baris dari tabel  
                        row.remove();  
                        // Renomor ulang baris  
                        $('#savedFormsTable tbody tr').each(function(index) {  
                            $(this).find('td:first').text(index + 1);  
                        });  
                    } else {  
                        alert(response.message);  
                    }  
                },  
                error: function() {  
                    alert('Terjadi kesalahan saat menghapus data');  
                }  
            });  
        });  
    });  
  </script>

  <script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#activityTable tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
  </script>
  <!-- plugins:js -->
  <script src="<?php echo base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?php echo base_url('vendors/chart.js/Chart.min.js'); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="<?php echo base_url('vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
  <script src="<?php echo base_url('js/dataTables.select.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 

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

