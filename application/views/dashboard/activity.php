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
    <script src="<?php echo base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>x`
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
                  <div class="modal fade" id="formModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Activity Form</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <strong>Hari/Tanggal:</strong> <span id="modalTanggal"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Shift/Jam Kerja:</strong> <span id="modalShift"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Team/Regu:</strong> <span id="modalTeam"></span>
                                    </div>
                                </div>

                                <form id="activityForm">
                                    <input type="hidden" id="activity_id" name="activity_id">
                                    <div class="form-group">
                                        <label>Perangkat</label>
                                        <select class="form-control" name="sub_device_id" required>
                                            <option value="">Pilih Perangkat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lokasi</label>
                                        <select class="form-control" name="area_id" required>
                                            <option value="">Pilih Lokasi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelompok Laporan</label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type" 
                                                      value="Harian" required>
                                                <label class="form-check-label">Harian</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type" 
                                                      value="Mingguan">
                                                <label class="form-check-label">Mingguan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type" 
                                                      value="Bulanan">
                                                <label class="form-check-label">Bulanan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>

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
                        $('#modalTanggal').text(data.formatted_date);
                        $('#modalShift').text(data.nama_shift + ' (' + data.shift_time + ')');
                        $('#modalTeam').text(data.personel_name);
                        
                        // Load sub devices and areas
                        loadSubDevices();
                        loadAreas();
                        
                        // Load existing form data
                        loadFormData(activityId);
                        
                        // Show modal
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
                                        <button class="btn btn-success btn-sm" onclick="window.location.href='<?= base_url('activity/printdokumentasi/') ?>${form.form_id}'">
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

