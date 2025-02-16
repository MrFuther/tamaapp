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
          <!-- Tambahkan di bagian atas konten -->
          <?php if($this->session->flashdata('message')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?= $this->session->flashdata('message'); ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php endif; ?>
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
                    <table class="table table-striped" id="activityTable">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>ID Aktivitas</th>
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
                              <td>
                                  <?php foreach ($activity->users as $user): ?>
                                      <span class="badge bg-info"><?= $user->username; ?></span>
                                  <?php endforeach; ?>
                              </td>
                              <td><?= $activity->nama_shift; ?></td>
                              <td><?= $activity->jam_mulai; ?> - <?= $activity->jam_selesai; ?></td>
                              <td><?= $activity->tanggal_kegiatan; ?></td>
                              <td>
                                  <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#checklistModal" onclick="loadChecklistForm(<?= $activity->id_activity; ?>)">
                                      Ceklist
                                  </button>
                                  <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#documentationModal" onclick="loadDocumentation(<?= $activity->id_activity; ?>)">Dokumentasi</button>
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
                  <!-- Modal Dokumentasi -->
                  <div class="modal fade" id="documentationModal" tabindex="-1" aria-labelledby="documentationModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="documentationModalLabel">Dokumentasi Aktivitas</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <form action="<?= base_url('activity/save_documentation'); ?>" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="activity_id" value="<?= $activity->id_activity; ?>">

                                      <!-- Data Aktivitas (Tidak berubah) -->
                                      <div class="row">
                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <strong>Data Personel:</strong>
                                                  <p> 
                                                      <?php foreach ($activity->users as $user): ?>
                                                          <span class="badge bg-info"><?= $user->username; ?></span>
                                                      <?php endforeach; ?>
                                                  </p>
                                              </div>
                                              <div class="mb-3">
                                                  <strong>Shift:</strong>
                                                  <p><?= $activity->nama_shift; ?></p>
                                              </div>
                                              <div class="mb-3">
                                                  <strong>Jam Kerja:</strong>
                                                  <p><?= $activity->jam_mulai; ?> - <?= $activity->jam_selesai; ?></p>
                                              </div>
                                              <div class="mb-3">
                                                  <strong>Tanggal Kegiatan:</strong>
                                                  <p><?= $activity->tanggal_kegiatan; ?></p>
                                              </div>
                                          </div>

                                          <div class="col-md-6">
                                              <div class="mb-3">
                                                  <label for="laporan" class="form-label">Kelompok Laporan</label>
                                                  <select class="form-control" id="laporan" name="laporan" required>
                                                      <option value="harian" <?= isset($documentation) && $documentation->laporan == 'harian' ? 'selected' : ''; ?>>Harian</option>
                                                      <option value="mingguan" <?= isset($documentation) && $documentation->laporan == 'mingguan' ? 'selected' : ''; ?>>Mingguan</option>
                                                      <option value="bulanan" <?= isset($documentation) && $documentation->laporan == 'bulanan' ? 'selected' : ''; ?>>Bulanan</option>
                                                  </select>
                                              </div>
                                              <div class="mb-3">
                                                  <label for="area" class="form-label">Area</label>
                                                  <select class="form-control" id="area" name="area" required>
                                                      <?php foreach ($areas as $area): ?>
                                                          <option value="<?= $area->area_id; ?>" <?= isset($documentation) && $documentation->area_id == $area->area_id ? 'selected' : ''; ?>><?= $area->area_name; ?></option>
                                                      <?php endforeach; ?>
                                                  </select>
                                              </div>
                                              <div class="mb-3">
                                                  <label for="group_device" class="form-label">Group Device</label>
                                                  <select class="form-control" id="group_device" name="group_device" required>
                                                      <?php foreach ($group_devices as $group): ?>
                                                          <option value="<?= $group->pek_unit_id; ?>" <?= isset($documentation) && $documentation->group_device_id == $group->pek_unit_id ? 'selected' : ''; ?>><?= $group->pek_unit_name; ?></option>
                                                      <?php endforeach; ?>
                                                  </select>
                                              </div>
                                              <div class="mb-3">
                                                  <label for="sub_device" class="form-label">Sub Device</label>
                                                  <select class="form-control" id="sub_device" name="sub_device" required>
                                                      <?php foreach ($sub_devices as $sub_device): ?>
                                                          <option value="<?= $sub_device->sub_device_id; ?>" <?= isset($documentation) && $documentation->sub_device_id == $sub_device->sub_device_id ? 'selected' : ''; ?>><?= $sub_device->sub_device_name; ?></option>
                                                      <?php endforeach; ?>
                                                  </select>
                                              </div>
                                              <div class="mb-3">
                                                  <label for="device" class="form-label">Nama Device</label>
                                                  <select class="form-control" id="device" name="device" required>
                                                      <?php foreach ($devices as $device): ?>
                                                          <option value="<?= $device->device_hidn_id; ?>" <?= isset($documentation) && $documentation->device_id == $device->device_hidn_id ? 'selected' : ''; ?>><?= $device->device_hidn_name; ?></option>
                                                      <?php endforeach; ?>
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- Tombol Submit Berdasarkan Keberadaan Dokumentasi -->
                                      <button type="submit" class="btn btn-primary"><?= isset($documentation) ? 'Update Dokumentasi' : 'Simpan Dokumentasi'; ?></button>
                                      <!-- Tombol untuk membuka Modal Dokumentasi Foto -->
                                      <!-- Tombol untuk membuka Modal Dokumentasi Foto -->
                                      <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#documentationPhotoModal">
                                          Dokumentasi Foto
                                      </button>                  
                                    </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Modal Dokumentasi Foto -->
                  <div class="modal fade" id="documentationPhotoModal" tabindex="-1" aria-labelledby="documentationPhotoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="documentationPhotoModalLabel">Dokumentasi Foto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('activity/save_documentation_photos'); ?>" method="POST" enctype="multipart/form-data">
                                    <!-- Pastikan id_documentation sudah ada -->
                                    <input type="hidden" name="id_documentation" value="<?= isset($documentation) ? $documentation->id_documentation : ''; ?>">

                                    <!-- Foto Perangkat -->
                                    <div class="mb-3">
                                        <label for="foto_perangkat" class="form-label">Foto Perangkat</label>
                                        <input type="file" class="form-control" id="foto_perangkat" name="foto_perangkat" accept="image/*" required>
                                    </div>

                                    <!-- Foto Lokasi -->
                                    <div class="mb-3">
                                        <label for="foto_lokasi" class="form-label">Foto Lokasi</label>
                                        <input type="file" class="form-control" id="foto_lokasi" name="foto_lokasi" accept="image/*" required>
                                    </div>

                                    <!-- Foto Teknisi -->
                                    <div class="mb-3">
                                        <label for="foto_teknisi" class="form-label">Foto Teknisi</label>
                                        <input type="file" class="form-control" id="foto_teknisi" name="foto_teknisi" accept="image/*" required>
                                    </div>

                                    <!-- Deskripsi Foto -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi Foto</label>
                                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Foto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- Modal Ceklist dengan Form Pengisian -->
                  <div class="modal fade" id="checklistModal" tabindex="-1" aria-labelledby="checklistModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="checklistModalLabel">Form Checklist</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('activity/save_checklist'); ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="activity_id" value="<?= isset($checklist) ? $checklist->activity_id : ''; ?>">

                                    <!-- Pilih Perangkat -->
                                    <select class="form-control" name="device" id="device" required>
                                        <option value="">-- Pilih Perangkat --</option>
                                        <?php foreach ($devices as $device): ?>
                                            <option value="<?= $device->device_hidn_id; ?>"><?= $device->device_hidn_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- Kegiatan yang Dilakukan (Dinamakan Berdasarkan Perangkat yang Dipilih) -->
                                    <div id="kegiatan_section">
                                        <!-- Kegiatan akan di-load di sini berdasarkan perangkat yang dipilih -->
                                    </div>
                                    <!-- Tombol Submit -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
  <script>
      $(document).ready(function() {
          // Ketika perangkat dipilih
          $('#device').change(function() {
              var device_id = $(this).val();  // Mendapatkan nilai device_id yang dipilih

              if (device_id != "") {
                  console.log("Device ID dipilih: ", device_id);  // Debugging: Menampilkan device_id yang dipilih
                  $.ajax({
                      url: '<?= base_url('activity/get_kegiatan_per_device'); ?>', // Pastikan URL ini benar
                      method: 'POST',
                      data: { device_id: device_id }, // Kirimkan device_id ke server
                      success: function(response) {
                          console.log("Respons dari server: ", response);  // Debugging: Menampilkan respons dari server
                          $('#kegiatan_section').html(response);  // Render pertanyaan kegiatan ke dalam form
                      },
                      error: function(xhr, status, error) {
                          console.log("Error AJAX: ", error);  // Debugging: Menampilkan error jika AJAX gagal
                      }
                  });
              } else {
                  $('#kegiatan_section').html('');  // Jika tidak ada perangkat yang dipilih
              }
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

