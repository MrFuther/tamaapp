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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/vertical-layout-light/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
    <script src="<?php echo base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>x`
</head>
<body>
<?php include 'navbar.php'; ?>
  <!-- Wrapper utama untuk halaman -->
<div class="container-fluid page-body-wrapper">

<!-- Panel Pengaturan Tema -->
<div class="theme-setting-wrapper">
  <div id="theme-settings" class="settings-panel">
    <i class="settings-close ti-close"></i>
    
    <!-- Pengaturan Header -->
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

  <!-- Sidebar Kanan untuk To-Do List dan Chat -->
  <div id="right-sidebar" class="settings-panel">
    <i class="settings-close ti-close"></i>

        
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
             
            </div>
            <div class="list-wrapper px-3">
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
                            <?php 
                            if (!empty($activity->usernames)) {
                                $usernames = explode(',', $activity->usernames);
                                foreach ($usernames as $username): ?>
                                    <span class="badge bg-info"><?= trim($username) ?></span>
                                <?php endforeach;
                            } else {
                                echo '<span class="text-muted">No users assigned</span>';
                            }
                            ?>
                          </td>
                          <td><?= $activity->nama_shift; ?></td>
                          <td><?= $activity->jam_mulai; ?> - <?= $activity->jam_selesai; ?></td>
                          <td><?= $activity->tanggal_kegiatan; ?></td>
                          <td>
                            <button type="button" class="btn btn-primary btn-sm" onclick="openFormModal(<?= $activity->id_activity ?>)">Form</button>
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
                                <select class="form-control select2" name="personel_ids[]" multiple required>
                                    <?php foreach ($users as $user): ?>
                                        <option value="<?= $user->id ?>"><?= $user->username ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pilih Shift</label>
                                <select class="form-control" name="shift_id" required>
                                    <?php foreach ($shifts as $shift): ?>
                                        <option value="<?= $shift->id_shift ?>">
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
                  <div class="modal fade" id="formModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Activity Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="border p-3 mb-4">
                                    <!-- Header Form -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <!-- Form Title -->
                                        </div>
                                        <div class="text-end border border-dark p-2" style="min-width: 200px;">
                                            <strong>PREVENTIVE MAINTENANCE</strong>
                                        </div>
                                    </div>

                                    <!-- Form Content -->
                                    <form id="activityForm">
                                        <input type="hidden" id="activity_id" name="activity_id">
                                        
                                        <!-- Row 1: Hari/Tanggal -->
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-md-2">
                                                <label class="mb-0">Hari / Tanggal</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex">
                                                    <span class="me-2">:</span>
                                                    <div id="modalTanggal"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 2: Shift/Jam Kerja -->
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-md-2">
                                                <label class="mb-0">Shift Kerja / Jam Kerja</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex">
                                                    <span class="me-2">:</span>
                                                    <div id="modalShift"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 3: Team/Regu -->
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-md-2">
                                                <label class="mb-0">Team / Regu</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex">
                                                    <span class="me-2">:</span>
                                                    <div id="modalTeam"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 4: Perangkat -->
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-md-2">
                                                <label class="mb-0">Perangkat</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex">
                                                    <span class="me-2">:</span>
                                                    <select class="form-control" name="sub_device_id" required>
                                                        <option value="">Pilih Perangkat</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 5: Lokasi -->
                                        <div class="row mb-2 align-items-center">
                                            <div class="col-md-2">
                                                <label class="mb-0">Lokasi</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex">
                                                    <span class="me-2">:</span>
                                                    <select class="form-control" name="area_id" required>
                                                        <option value="">Pilih Lokasi</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Jadwal Checklist -->
                                        <div class="row mb-2">
                                            <div class="col-md-2">
                                                <label class="mb-0">Jadwal</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="d-flex align-items-start">
                                                    <span class="me-2">:</span>
                                                    <div class="form-check-inline">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="report_type" value="Harian" class="form_check-input" required>
                                                            <label class="form-check-label">Harian</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="report_type" value="Mingguan" class="form_check-input">
                                                            <label class="form-check-label">Mingguan</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="report_type" value="Bulanan" class="form_check-input">
                                                            <label class="form-check-label">Bulanan</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="mt-4">
                                    <h6>Data Form</h6>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Perangkat</th>
                                                <th>Lokasi</th>
                                                <th>Kelompok Laporan</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="formDataTable">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!-- Modal for viewing data -->
                  <div class="modal fade" id="dataModal" tabindex="-1">
                      <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Form Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                              <button id="addDataButton" class="btn btn-primary mb-3" onclick="openAddDataModal()">
                                Add Data
                              </button>
                                  <div class="table-responsive">
                                    <table class="table table-bordered" id="formDataItemsTable">
                                        <thead>
                                            <tr>
                                                <th>Device</th>
                                                <th>Jam Kegiatan</th>
                                                <th>Tindakan 1</th>
                                                <th>Tindakan 2</th>
                                                <th>Tindakan 3</th>
                                                <th>Photo 1</th>
                                                <th>Photo 2</th>
                                                <th>Photo 3</th>
                                                <th>Notes</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be loaded here -->
                                        </tbody>
                                    </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <!-- Modal for adding data -->
                  <div class="modal fade" id="addDataModal" tabindex="-1">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Add Form Data</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                  <form id="addDataForm" onsubmit="submitFormData(event)">
                                      <input type="hidden" name="form_id">
                                      
                                      <div class="mb-3">
                                          <label class="form-label">Device</label>
                                          <select class="form-control" id="device_hidn_id" name="device_hidn_id" required>
                                          </select>
                                      </div>
                                      
                                      <div class="mb-3">
                                          <label class="form-label">Jam Kegiatan</label>
                                          <input type="time" class="form-control" name="jam_kegiatan" required>
                                      </div>
                                      
                                      <div id="checklistContainer">
                                          <!-- Checklist questions will be loaded here -->
                                      </div>
                                      
                                      <div class="mb-3">
                                          <label class="form-label">Foto Perangkat</label>
                                          <input type="file" class="form-control" name="foto_perangkat" accept="image/*" required>
                                      </div>
                                      
                                      <div class="mb-3">
                                          <label class="form-label">Foto Lokasi</label>
                                          <input type="file" class="form-control" name="foto_lokasi" accept="image/*" required>
                                      </div>
                                      
                                      <div class="mb-3">
                                          <label class="form-label">Foto Teknisi</label>
                                          <input type="file" class="form-control" name="foto_teknisi" accept="image/*" required>
                                      </div>
                                      
                                      <div class="mb-3">
                                          <label class="form-label">Notes</label>
                                          <textarea class="form-control" name="notes" rows="3">Normal</textarea>
                                      </div>
                                      
                                      <button type="submit" class="btn btn-primary">Save</button>
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
  <script src="<?= base_url('js/jquery-3.7.1.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
  
  <!-- container-scroller -->
  <script>
    // Global Variables
    let currentFormId = null;

    // Document Ready Function
    $(document).ready(function() {
        // Event Handlers
        $('#activityForm').on('submit', handleActivityFormSubmit);
        $('#dataModal').on('shown.bs.modal', handleDataModalShown);
        $('#dataModal').on('hidden.bs.modal', handleDataModalHidden);
        $('.select2').select2({
            placeholder: "Pilih Personel",
            allowClear: true,
            width: '100%'
        });
    });

    // Authentication Functions
    function showLogoutConfirmation() {
        var modal = new bootstrap.Modal(document.getElementById('logoutModal'));
        modal.show();
    }

    function logout() {
        alert("Anda telah logout.");
        window.location.href = "<?php echo base_url('auth/logout'); ?>";
    }

    // Form Management Functions
    const openFormModal = (activityId) => {
        $.ajax({
            url: '<?= base_url("activity/get_activity_detail/") ?>' + activityId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    const data = response.data;
                    $('#activity_id').val(activityId);
                    
                    // Format tanggal ke Bahasa Indonesia
                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const date = new Date(data.tanggal_kegiatan);
                    const dayName = days[date.getDay()];
                    const formattedDate = `${dayName} / ${date.getDate()} ${getMonthName(date.getMonth())} ${date.getFullYear()}`;
                    
                    $('#modalTanggal').text(formattedDate);
                    $('#modalShift').text(`${data.nama_shift} / ${data.jam_mulai} s/d ${data.jam_selesai}`);
                    $('#modalTeam').text(data.personel_name);
                    
                    loadSubDevices();
                    loadAreas();
                    loadFormData(activityId);
                    
                    $('#formModal').modal('show');
                } else {
                    alert('Error: ' + (response.message || 'Failed to load activity details'));
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to load activity details. Please try again.');
            }
        });
    };

    // Helper function untuk nama bulan dalam Bahasa Indonesia
    function getMonthName(month) {
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return months[month];
    }

    const loadFormData = (activityId) => {
            $.ajax({
                url: '<?= base_url("activity/get_activity_forms/") ?>' + activityId,
                method: 'GET',
                dataType: 'json',
                success: function(forms) {
                    var tbody = $('#formDataTable');
                    tbody.empty();
                    if (Array.isArray(forms)) {
                        forms.forEach(function(form) {
                            tbody.append(`
                                <tr>
                                    <td>${form.sub_device_name}</td>
                                    <td>${form.area_name}</td>
                                    <td>${form.report_type}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm" onclick="viewData(${form.form_id})">
                                            Data
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteForm(${form.form_id})">
                                            Delete
                                        </button>
                                        <button class="btn btn-success btn-sm" onclick="window.location.href='<?= base_url('activity/printdokumentasi/') ?>${form.form_id}'" target="_blank">
                                            <i class="fas fa-print"></i> Dokumentasi
                                        </button>
                                        <button class="btn btn-primary btn-sm" onclick="window.location.href='<?= base_url('activity/printchecklist/') ?>${form.form_id}'">
                                            <i class="fas fa-print"></i> Checklist
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        tbody.append('<tr><td colspan="4" class="text-center">No forms available</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading form data:', error);
                    $('#formDataTable').html('<tr><td colspan="4" class="text-center">Error loading data</td></tr>');
                }
            });
    };

    // View Data Functions
    const viewData = (formId) => {
        if (!formId) {
            console.error('No form ID provided to viewData');
            return;
        }
        
        console.log('ViewData called with formId:', formId);
        localStorage.setItem('currentFormId', formId);
        $('#current_form_id').val(formId);
        loadFormDataItems(formId);
        $('#dataModal').modal('show');
        $('#formModal').modal('hide');
    };

    const loadFormDataItems = (formId) => {
        if (!formId) {
            console.error('No form ID provided to loadFormDataItems');
            return;
        }

        $.ajax({
            url: '<?= base_url("activity/get_form_data/") ?>' + formId,
            method: 'GET',
            dataType: 'json', // Pastikan response dianggap sebagai JSON
            success: function(response) {
                try {
                    console.log('Response received:', response); // Debug log
                    
                    const dataTable = $('#formDataItemsTable tbody');
                    dataTable.empty();
                    
                    if (response.status === 'success' && Array.isArray(response.data)) {
                        if (response.data.length > 0) {
                            response.data.forEach(item => {
                                const row = `
                                    <tr>
                                        <td>${item.device_hidn_name || '-'}</td>
                                        <td>${item.jam_kegiatan || '-'}</td>
                                        <td>${item.tindakan1 || '-'}</td>
                                        <td>${item.tindakan2 || '-'}</td>
                                        <td>${item.tindakan3 || '-'}</td>
                                        <td>
                                            ${item.foto_perangkat ? 
                                                `<img src="<?= base_url('uploads/') ?>${item.foto_perangkat}" width="50" class="img-thumbnail">` : 
                                                '-'}
                                        </td>
                                        <td>
                                            ${item.foto_lokasi ? 
                                                `<img src="<?= base_url('uploads/') ?>${item.foto_lokasi}" width="50" class="img-thumbnail">` : 
                                                '-'}
                                        </td>
                                        <td>
                                            ${item.foto_teknisi ? 
                                                `<img src="<?= base_url('uploads/') ?>${item.foto_teknisi}" width="50" class="img-thumbnail">` : 
                                                '-'}
                                        </td>
                                        <td>${item.notes || 'Normal'}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="deleteFormData(${item.form_data_id})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `;
                                dataTable.append(row);
                            });
                        } else {
                            dataTable.append(`
                                <tr>
                                    <td colspan="10" class="text-center">No data available</td>
                                </tr>
                            `);
                        }

                        // Update add button state
                        const addButton = $('#addDataButton');
                        if (response.data.length >= 4) {
                            addButton.prop('disabled', true);
                            addButton.attr('title', 'Maximum 4 data entries reached');
                        } else {
                            addButton.prop('disabled', false);
                            addButton.attr('title', '');
                        }
                    } else {
                        throw new Error('Invalid response format');
                    }
                } catch (error) {
                    console.error('Error processing response:', error);
                    $('#formDataItemsTable tbody').html(`
                        <tr>
                            <td colspan="10" class="text-center text-danger">Error loading data: ${error.message}</td>
                        </tr>
                    `);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                
                $('#formDataItemsTable tbody').html(`
                    <tr>
                        <td colspan="10" class="text-center text-danger">Failed to load data. Please try again.</td>
                    </tr>
                `);
            }
        });
    };

    // Device and Area Loading Functions
    const loadSubDevices = () => {
            $.ajax({
                url: '<?= base_url("activity/get_sub_devices") ?>',
                method: 'GET',
                dataType: 'json',
                success: function(devices) {
                    var deviceSelect = $('select[name="sub_device_id"]');
                    deviceSelect.empty().append('<option value="">Pilih Perangkat</option>');
                    if (Array.isArray(devices)) {
                        devices.forEach(function(device) {
                            deviceSelect.append(
                                `<option value="${device.sub_device_id}">${device.sub_device_name}</option>`
                            );
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load devices:', error);
                    alert('Failed to load devices. Please try again.');
                }
            });
    };

    const loadAreas = () => {
            $.ajax({
                url: '<?= base_url("activity/get_areas") ?>',
                method: 'GET',
                dataType: 'json',
                success: function(areas) {
                    var areaSelect = $('select[name="area_id"]');
                    areaSelect.empty().append('<option value="">Pilih Lokasi</option>');
                    if (Array.isArray(areas)) {
                        areas.forEach(function(area) {
                            areaSelect.append(
                                `<option value="${area.area_id}">${area.area_name}</option>`
                            );
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load areas:', error);
                    alert('Failed to load areas. Please try again.');
                }
            });
    };

    const loadAllDeviceHidnOptions = async (subDeviceId) => {
            try {
                const response = await $.ajax({
                    url: '<?= base_url("activity/get_all_device_hidn") ?>',
                    method: 'GET',
                    data: { sub_device_id: subDeviceId }
                });

                if (response.status === 'success' && Array.isArray(response.data)) {
                    const select = $('#device_hidn_id');
                    select.empty();
                    select.append('<option value="">Select Device</option>');
                    
                    response.data.forEach(device => {
                        select.append(
                            $('<option>', {
                                value: device.device_hidn_id,
                                text: device.device_hidn_name
                            })
                        );
                    });
                }
            } catch (error) {
                console.error('Error loading device options:', error);
                alert('Failed to load device options');
            }
    };

    // Add Data Modal Functions
    const openAddDataModal = () => {
        const formId = $('#current_form_id').val() || localStorage.getItem('currentFormId');
        console.log('Current form ID:', formId);
        
        if (!formId) {
            alert('Invalid form ID');
            return;
        }

        $('#addDataForm input[name="form_id"]').val(formId);
        loadDeviceAndChecklist(formId);
        $('#addDataModal').modal('show');
        $('#dataModal').modal('hide');
    };

    const loadDeviceAndChecklist = async (formId) => {
            try {
                console.log('Loading device and checklist for formId:', formId);

                // Load devices dengan error handling yang lebih baik
                const deviceResponse = await $.ajax({
                    url: '<?= base_url("activity/get_all_device_hidn") ?>',
                    method: 'GET',
                    dataType: 'json',
                    error: function(xhr, status, error) {
                        console.error('XHR Status:', status);
                        console.error('Error:', error);
                        console.error('Response:', xhr.responseText);
                        throw new Error('Failed to load devices');
                    }
                });

                console.log('Device response:', deviceResponse);
                
                const select = $('#device_hidn_id');
                select.empty();
                select.append('<option value="">Select Device</option>');
                
                if (deviceResponse.status === 'success' && Array.isArray(deviceResponse.data)) {
                    deviceResponse.data.forEach(device => {
                        select.append(
                            $('<option>', {
                                value: device.device_hidn_id,
                                text: device.device_hidn_name
                            })
                        );
                    });
                }

                // Load checklist questions setelah devices berhasil dimuat
                await loadChecklistQuestions(formId);

            } catch (error) {
                console.error('Error in loadDeviceAndChecklist:', error);
                alert('Failed to load devices. Please try again.');
            }
    };

    const loadChecklistQuestions = async (formId) => {
            try {
                if (!formId) {
                    console.error('Form ID is required');
                    return;
                }

                const response = await $.ajax({
                    url: `<?= base_url("activity/get_checklist_for_form/") ?>${formId}`,
                    method: 'GET',
                    dataType: 'json'
                });

                const container = $('#checklistContainer');
                container.empty();

                if (response.status === 'success' && Array.isArray(response.data)) {
                    response.data.forEach((question, index) => {
                        container.append(`
                            <div class="mb-3">
                                <label class="form-label">${question.question_text}</label>
                                <select name="tindakan${index + 1}" class="form-control" required>
                                    <option value="OK">OK</option>
                                    <option value="NOT OK">NOT OK</option>
                                </select>
                            </div>
                        `);
                    });
                } else {
                    container.append('<div class="alert alert-info">No checklist questions available.</div>');
                }
            } catch (error) {
                console.error('Error loading checklist questions:', error);
                $('#checklistContainer').html(
                    '<div class="alert alert-danger">Failed to load checklist questions. Please try again.</div>'
                );
            }
    };

    // Form Submission Functions
    const submitFormData = (e) => {
            e.preventDefault();
            
            const formId = $('#addDataForm input[name="form_id"]').val();
            if (!formId) {
                alert('Form ID is missing');
                return;
            }
            
            const formData = new FormData($('#addDataForm')[0]);
            
            // Add validation
            if (!formData.get('device_hidn_id')) {
                alert('Please select a device');
                return;
            }
            
            $.ajax({
                url: '<?= base_url("activity/add_form_data") ?>',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    try {
                        const result = typeof response === 'string' ? JSON.parse(response) : response;
                        
                        if(result.status === 'success') {
                            $('#addDataModal').modal('hide');
                            $('#addDataForm')[0].reset();
                            loadFormDataItems(formId);
                            alert('Data saved successfully');
                        } else {
                            alert(result.message || 'Failed to save data');
                        }
                    } catch (error) {
                        console.error('Error processing response:', error);
                        alert('Failed to process server response');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error saving form data:', error);
                    alert('Failed to save form data. Error: ' + error);
                }
            });
    };

    // Delete Functions
    const deleteForm = (formId) => {
            if(confirm('Are you sure you want to delete this form?')) {
                $.ajax({
                    url: '<?= base_url("activity/delete_form/") ?>' + formId,
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 'success') {
                            loadFormData($('#activity_id').val());
                        } else {
                            alert('Failed to delete form');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Delete error:', error);
                        alert('Failed to delete form. Please try again.');
                    }
                });
            }
    };

    const deleteFormData = (formDataId) => {
            if(confirm('Are you sure you want to delete this data?')) {
                $.ajax({
                    url: '<?= base_url("activity/delete_form_data/") ?>' + formDataId,
                    method: 'POST',
                    success: function(response) {
                        if(response.status === 'success') {
                            loadFormDataItems($('#addDataForm input[name="form_id"]').val());
                            alert('Data deleted successfully');
                        } else {
                            alert('Failed to delete data');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting form data:', error);
                        alert('Failed to delete form data');
                    }
                });
            }
    };

    // Utility Functions
    const showErrorAlert = (message) => {
        alert(message);
    };

    // Event Handler Functions
    function handleActivityFormSubmit(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url("activity/save_form") ?>',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success') {
                    loadFormData($('#activity_id').val());
                    $('#activityForm')[0].reset();
                } else {
                    alert('Failed to save form: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('Save error:', error);
                alert('Failed to save form. Please try again.');
            }
        });
    }

    function handleDataModalShown() {
        const formId = $('#current_form_id').val() || localStorage.getItem('currentFormId');
        console.log('Modal shown, current form ID:', formId);
    }

    function handleDataModalHidden() {
        localStorage.removeItem('currentFormId');
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
  <!-- plugins:js -->
  
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo base_url('js/off-canvas.js'); ?>"></script>
  <script src="<?php echo base_url('js/hoverable-collapse.js'); ?>"></script>
  <script src="<?php echo base_url('js/template.js'); ?>"></script>
  <script src="<?php echo base_url('js/settings.js'); ?>"></script>
  <script src="<?php echo base_url('js/todolist.js'); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>

