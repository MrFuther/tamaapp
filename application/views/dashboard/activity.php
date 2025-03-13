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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css"> 
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/vertical-layout-light/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('css/activitymodal.css'); ?>">
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
                  <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahActivityModal">Tambah Aktivitas</button>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap" id="activityTable" width="100%">
                        <thead>
                                <tr>
                                <th>#</th>
                                <th>Kode Activity</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Shift</th>
                                <th>Jam Kerja</th>
                                <th>Personel</th>
                                <th>Aksi</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activities as $index => $activity): ?>
                                <tr>
                                <td><?= $start + $index; ?></td>
                                <td><?= $activity->kode_activity; ?></td>
                                <td><?= $activity->tanggal_kegiatan; ?></td>
                                <td><?= $activity->nama_shift; ?></td>
                                <td><?= $activity->jam_mulai; ?> - <?= $activity->jam_selesai; ?></td>
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
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="openFormModal(<?= $activity->id_activity ?>)">Form</button>
                                    <a href="<?= base_url('activity/delete/'.$activity->id_activity); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus aktivitas ini?')">Hapus</a>
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted">Showing <?= count($activities) ?> of <?= $this->ActivityModel->count_all_activities() ?> entries</span>
                        </div>
                        <div>
                            <?= $pagination ?>
                        </div>
                    </div>
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
                                        <option value="<?= $user->id ?>"><?= $user->nama_pegawai ?></option>
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
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document"> <!-- Changed from modal-xl to modal-lg and added modal-dialog-scrollable -->
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Activity Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="overflow-auto"> <!-- Changed from fixed min-width to overflow-auto -->
                            <div class="border p-3 mb-4">
                                <!-- Header Form -->
                                <div class="d-flex flex-wrap justify-content-between align-items-start mb-3"> <!-- Added flex-wrap -->
                                <div class="flex-grow-1 mb-2 mb-md-0"> <!-- Added responsive margin -->
                                    <!-- Form Title -->
                                </div>
                                <div class="text-end border border-dark p-2">
                                    <strong>PREVENTIVE MAINTENANCE</strong>
                                </div>
                                </div>

                                <!-- Form Content -->
                                <form id="activityForm">
                                <input type="hidden" id="activity_id" name="activity_id">
                                
                                <!-- Row 1: Hari/Tanggal -->
                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-4 col-lg-2"> <!-- Changed column sizing for mobile -->
                                    <label class="mb-1 mb-md-0">Hari / Tanggal</label> <!-- Added responsive margin -->
                                    </div>
                                    <div class="col-md-8 col-lg-10"> <!-- Changed column sizing for mobile -->
                                    <div class="d-flex">
                                        <span class="me-2">:</span>
                                        <div id="modalTanggal"></div>
                                    </div>
                                    </div>
                                </div>

                                <!-- Similar updates for other rows -->
                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-4 col-lg-2">
                                    <label class="mb-1 mb-md-0">Shift Kerja / Jam Kerja</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                    <div class="d-flex">
                                        <span class="me-2">:</span>
                                        <div id="modalShift"></div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-4 col-lg-2">
                                    <label class="mb-1 mb-md-0">Team / Regu</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                    <div class="d-flex">
                                        <span class="me-2">:</span>
                                        <div id="modalTeam"></div>
                                    </div>
                                    </div>
                                </div>

                                <!-- Row 4: Perangkat -->
                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-4 col-lg-2">
                                        <label class="mb-1 mb-md-0">Perangkat</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <div class="d-flex flex-column flex-md-row"> 
                                        <span class="me-2 mb-1 mb-md-0">:</span>
                                        <select class="form-control select2-single" name="sub_device_id" required>
                                            <option value="">Pilih Perangkat</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 5: Lokasi -->
                                <div class="row mb-2 align-items-center">
                                    <div class="col-md-4 col-lg-2">
                                        <label class="mb-1 mb-md-0">Lokasi</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                        <div class="d-flex flex-column flex-md-row">
                                        <span class="me-2 mb-1 mb-md-0">:</span>
                                        <select class="form-control select2-multiple" name="area_id[]" multiple="multiple" required>
                                            <option value="">Pilih Lokasi</option>
                                            <?php foreach ($areas as $area): ?>
                                            <option value="<?= $area->area_id ?>"><?= $area->area_name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jadwal Checklist -->
                                <div class="row mb-2">
                                    <div class="col-md-4 col-lg-2">
                                    <label class="mb-1 mb-md-0">Jadwal</label>
                                    </div>
                                    <div class="col-md-8 col-lg-10">
                                    <div class="d-flex flex-column flex-md-row align-items-start"> <!-- Fixed for mobile -->
                                        <span class="me-2 mb-1 mb-md-0">:</span>
                                        <div>
                                        <div class="form-check mb-1">
                                            <input type="radio" name="report_type" value="Harian" class="form-check-input" required>
                                            <label class="form-check-label">Harian</label>
                                        </div>
                                        <div class="form-check mb-1">
                                            <input type="radio" name="report_type" value="Mingguan" class="form-check-input">
                                            <label class="form-check-label">Mingguan</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="report_type" value="Bulanan" class="form-check-input">
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
                            </div>
                            <div class="mt-4">
                            <h6>Data Form</h6>
                            <div class="table-responsive">
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
                  </div>
                  <!-- Modal for viewing data -->
                  <div class="modal fade" id="dataModal" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable"> <!-- Changed from modal-xl to modal-lg -->
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Form Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-wrap gap-2 mb-3"> <!-- Made buttons stack nicely on mobile -->
                            <button class="btn btn-primary" onclick="backToActivityForm()">
                                <i class="bi bi-arrow-left"></i> Back
                            </button>
                            <button id="addDataButton" class="btn btn-primary" onclick="openAddDataModal()">
                                Add Data
                            </button>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered" id="formDataItemsTable">
                                <thead>
                                <tr>
                                    <th>Device</th>
                                    <th>Jam</th> <!-- Shortened headers for mobile -->
                                    <th>T1</th>
                                    <th>T2</th>
                                    <th>T3</th>
                                    <th>P1</th>
                                    <th>P2</th>
                                    <th>P3</th>
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
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Form Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addDataForm" enctype="multipart/form-data">
                            <input type="hidden" name="form_id">
                            
                            <div class="mb-3">
                                <label class="form-label">Device</label>
                                <select class="form-control select2-single" id="device_hidn_id" name="device_hidn_id" required>
                                <option value="">Select Device</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Jam Kegiatan</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label small">Mulai</label>
                                        <input type="time" class="form-control" name="jam_kegiatan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small">Selesai</label>
                                        <input type="time" class="form-control" name="jam_selesai" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="checklistContainer">
                                <!-- Checklist questions will be loaded here -->
                            </div>
                            
                            <div id="photoUploadsContainer">
                                <!-- Field upload foto akan ditambahkan secara dinamis di sini -->
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="cancelAddData()">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="submitFormData(event)">Save</button>
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
    <!-- page-body-wrapper ends -->
  </div>
  <script src="<?= base_url('js/jquery-3.7.1.min.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
  
  <!-- container-scroller -->
  <script>
    // Global Variables
    let currentFormId = null;
    $(window).resize(function() {
        formatMobileTable();
    });

    function initializeSelect2Elements() {
        // Initialize single-select elements with search functionality
        $('.select2-single').each(function() {
        $(this).select2({
            placeholder: $(this).attr('placeholder') || $(this).find('option:first').text(),
            allowClear: true,
            width: '100%',
            dropdownParent: $(this).closest('.modal'), // Important: This ensures the dropdown appears inside the modal
            language: {
            noResults: function() {
                return "Tidak ada hasil yang ditemukan";
            },
            searching: function() {
                return "Mencari...";
            }
            }
        });
        });
        
        // Mobile device optimizations for select2
        if (window.innerWidth < 768) {
        // When select2 is opened on mobile, scroll to make sure it's visible
        $('.select2-single').on('select2:open', function() {
            setTimeout(function() {
            $('.select2-search__field').focus();
            }, 100);
        });
        }
    }

    function sortActivityTable() {
        const tbody = $('#activityTable tbody');
        const rows = tbody.find('tr').toArray();
        
        // Sort by date column (assuming index 6 contains the date)
        rows.sort(function(a, b) {
            const dateA = new Date($(a).find('td:eq(6)').text());
            const dateB = new Date($(b).find('td:eq(6)').text());
            return dateB - dateA; // Descending order (newest first)
        });
        
        $.each(rows, function(index, row) {
            tbody.append(row);
        });
    }

    function loadDeviceSpecificQuestions(subDeviceId, reportType) {
        if (!subDeviceId || !reportType) return;
        
        $.ajax({
            url: '<?= base_url("activity/get_checklist_questions") ?>',
            method: 'GET',
            data: {
                sub_device_id: subDeviceId,
                report_type: reportType
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success' && Array.isArray(response.data)) {
                    const container = $('#checklistContainer');
                    container.empty();
                    
                    if (response.data.length > 0) {
                        response.data.forEach((question, index) => {
                            container.append(`
                                <div class="mb-3">
                                    <label class="form-label">${question.question_text}</label>
                                    <select name="tindakan${question.question_number}" class="form-control" required>
                                        <option value="OK">OK</option>
                                        <option value="NOT OK">NOT OK</option>
                                    </select>
                                </div>
                            `);
                        });
                    } else {
                        container.append('<div class="alert alert-info">No checklist questions available for this device and report type.</div>');
                    }
                } else {
                    $('#checklistContainer').html('<div class="alert alert-warning">Failed to load checklist questions.</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading checklist questions:', error);
                $('#checklistContainer').html('<div class="alert alert-danger">Error loading questions. Please try again.</div>');
            }
        });
    }

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

        $('.select2-multiple').select2({
            dropdownParent: $('#formModal'),
            placeholder: "Pilih Lokasi",
            allowClear: true,
            width: '100%'
        });

        initializeSelect2Elements();
        sortActivityTable();
        initializePagination();
        initializeSearch();
        
        if (window.innerWidth < 768) {
        // For modal overflow issues on small screens
        $('.modal-body').css('max-height', (window.innerHeight * 0.7) + 'px');
            formatMobileTable();
        }
        $('#formModal').on('shown.bs.modal', function() {
            setTimeout(function() {
                initializeSelect2Elements();
            }, 100);
        });
        
        $('#addDataModal').on('shown.bs.modal', function() {
            setTimeout(function() {
                initializeSelect2Elements();
            }, 100);
        });

        $('#addDataModal').on('hidden.bs.modal', function (e) {
        // Only show dataModal if we're not showing another modal
        if (!$('#formModal').hasClass('show') && !$('#dataModal').hasClass('show')) {
            const formId = $('#current_form_id').val() || localStorage.getItem('currentFormId');
            if (formId) {
                setTimeout(() => {
                    $('#dataModal').modal('show');
                }, 300);
            }
        }

        $('#searchInput').on('keyup', function() {
            sortActivityTable();
        });

        $('#activityForm').off('submit').on('submit', function(e) {
            e.preventDefault();
            
            const formData = $(this).serialize();
            
            $.ajax({
                url: '<?= base_url("activity/save_form") ?>',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        loadFormData($('#activity_id').val());
                        $('#activityForm')[0].reset();
                        showToast('Success', 'Form saved successfully', 'success');
                    } else {
                        showToast('Error', 'Failed to save form: ' + (response.message || 'Unknown error'), 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Save error:', error);
                    showToast('Error', 'Failed to save form. Please try again.', 'error');
                }
            });
        });

        $(document).on('change', 'select[name="sub_device_id"]', function() {
            const subDeviceId = $(this).val();
            const reportType = $('input[name="report_type"]:checked').val();
            
            if (subDeviceId && reportType) {
                loadDeviceSpecificQuestions(subDeviceId, reportType);
            }
        });
        
        $(document).on('change', 'input[name="report_type"]', function() {
            const reportType = $(this).val();
            const subDeviceId = $('select[name="sub_device_id"]').val();
            
            if (subDeviceId && reportType) {
                loadDeviceSpecificQuestions(subDeviceId, reportType);
            }
        });
    });
    
    // Prevent modals from closing when clicking outside (optional)
    $('.modal').attr('data-bs-backdrop', 'static');
    $('.modal').attr('data-bs-keyboard', 'false');
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

    function initializePagination() {
    // Convert normal pagination links to AJAX
        $('.pagination .page-link').on('click', function(e) {
        e.preventDefault();
        
        const url = $(this).attr('href');
        if (!url) return;
        
        loadPageData(url);
        
        // Update URL for browser history without reloading the page
        window.history.pushState({path: url}, '', url);
        });
    }

    function loadPageData(url) {
        // Show loading indicator
        $('#activityTable tbody').html('<tr><td colspan="8" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>');
        
        $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
            // Extract only the table content from the response
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = response;
            
            // Replace table content
            $('#activityTable tbody').html($(tempDiv).find('#activityTable tbody').html());
            
            // Replace pagination
            $('.pagination').replaceWith($(tempDiv).find('.pagination'));
            
            // Re-initialize pagination events
            initializePagination();
            
            // Re-initialize table functionality
            sortActivityTable();
            
            // Scroll to top of table
            $('html, body').animate({
            scrollTop: $("#activityTable").offset().top - 70
            }, 300);
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            $('#activityTable tbody').html('<tr><td colspan="8" class="text-center text-danger">Failed to load data. Please try again.</td></tr>');
        }
        });
    }

    function initializeSearch() {
        // Submit search form via AJAX
        $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $('#searchInput').val();
        
        // Build the search URL
        const searchUrl = $(this).attr('action') + '?search=' + encodeURIComponent(searchTerm);
        
        // Load search results
        loadSearchResults(searchUrl);
        
        // Update URL for browser history
        window.history.pushState({path: searchUrl}, '', searchUrl);
        });
        
        // Add debounce for typing in search box (optional)
        let searchTimeout;
        $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            $('#searchForm').submit();
        }, 500); // 500ms delay after typing stops
        });
    }

    function loadSearchResults(url) {
        // Show loading indicator
        $('#activityTable tbody').html('<tr><td colspan="8" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>');
        
        $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Clear the table
            $('#activityTable tbody').empty();
            
            if (response.activities && response.activities.length > 0) {
            // Populate table with search results
            $.each(response.activities, function(index, activity) {
                let usernamesHtml = '';
                
                if (activity.usernames) {
                const usernames = activity.usernames.split(',');
                $.each(usernames, function(i, username) {
                    usernamesHtml += '<span class="badge bg-info">' + username.trim() + '</span> ';
                });
                } else {
                usernamesHtml = '<span class="text-muted">No users assigned</span>';
                }
                
                $('#activityTable tbody').append(`
                <tr>
                    <td>${index + 1}</td>
                    <td>${activity.id_activity}</td>
                    <td>${activity.kode_activity}</td>
                    <td>${usernamesHtml}</td>
                    <td>${activity.nama_shift}</td>
                    <td>${activity.jam_mulai} - ${activity.jam_selesai}</td>
                    <td>${activity.tanggal_kegiatan}</td>
                    <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="openFormModal(${activity.id_activity})">Form</button>
                    <a href="<?= base_url('activity/delete/') ?>${activity.id_activity}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus aktivitas ini?')">Hapus</a>
                    </td>
                </tr>
                `);
            });
            
            // Update pagination links
            $('.pagination').html(response.pagination);
            
            // Re-initialize pagination events
            initializePagination();
            } else {
            // Show no results message
            $('#activityTable tbody').html('<tr><td colspan="8" class="text-center">No activities found matching your search.</td></tr>');
            $('.pagination').empty();
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
            $('#activityTable tbody').html('<tr><td colspan="8" class="text-center text-danger">Failed to load data. Please try again.</td></tr>');
        }
        });
    }

    function initializePagination() {
        $('.pagination .page-link').off('click').on('click', function(e) {
        e.preventDefault();
        
        const url = $(this).attr('href');
        if (!url) return;
        
        // Check if this is a search page or regular page
        if (url.includes('search')) {
            loadSearchResults(url);
        } else {
            loadPageData(url);
        }
        
        // Update URL for browser history
        window.history.pushState({path: url}, '', url);
        });
    }

    $(window).on('popstate', function(e) {
        if (e.originalEvent.state !== null) {
        const url = location.href;
        if (url.includes('search')) {
            loadSearchResults(url);
        } else {
            loadPageData(url);
        }
        }
    });

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
                    
                    // Format date to Indonesian
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
                    
                    // Add event handlers for device selection changes
                    $('select[name="sub_device_id"]').off('change').on('change', function() {
                        const selectedDeviceId = $(this).val();
                        
                        // For specialized devices (267 and 269), only enable Harian radio
                        if (selectedDeviceId == '267' || selectedDeviceId == '269') {
                            $('input[name="report_type"][value="Harian"]').prop('checked', true);
                            $('input[name="report_type"][value="Mingguan"]').prop('disabled', true);
                            $('input[name="report_type"][value="Bulanan"]').prop('disabled', true);
                            
                            // Show message to inform user
                            if (!$('#specialized-form-msg').length) {
                                $('input[name="report_type"]').last().after(
                                    '<div id="specialized-form-msg" class="text-info mt-2">' +
                                    'This device only supports Daily reports.</div>'
                                );
                            }
                        } else {
                            // Re-enable all options for other devices
                            $('input[name="report_type"]').prop('disabled', false);
                            $('#specialized-form-msg').remove();
                        }
                    });
                    
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

    const createApproveDropdown = (formId) => {
        return `
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-signature me-1"></i>Approve
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="approveForm(${formId}, 'ap')">
                        <i class="fas fa-signature me-1"></i>Approve as AP
                    </a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="approveForm(${formId}, 'ias')">
                        <i class="fas fa-signature me-1"></i>Approve as IAS
                    </a></li>
                </ul>
            </div>
        `;
    };

    function loadFormData(activityId) {
        const userRole = '<?= $this->session->userdata('role') ?>'; // Ambil role dari session

        $.ajax({
            url: '<?= base_url("activity/get_activity_forms/") ?>' + activityId,
            method: 'GET',
            dataType: 'json',
            success: function(forms) {
                var tbody = $('#formDataTable');
                tbody.empty();
                if (Array.isArray(forms) && forms.length > 0) {
                    forms.forEach(function(form) {
                        // Fungsi untuk menghasilkan tombol approve sesuai role
                        function getApproveButtons(formId) {
                            let approveButtons = '';
                            
                            if (userRole === 'admin') {
                                // Admin bisa melihat semua tombol approve
                                approveButtons = `
                                    <button class="btn btn-warning btn-sm" onclick="approveForm(${formId}, 'ap')">
                                        <i class="fas fa-signature me-1"></i>Approve as AP
                                    </button>
                                    <button class="btn btn-warning btn-sm" onclick="approveForm(${formId}, 'ias')">
                                        <i class="fas fa-signature me-1"></i>Approve as IAS
                                    </button>
                                `;
                            } else if (userRole === 'management') {
                                // Management hanya bisa approve AP
                                approveButtons = `
                                    <button class="btn btn-warning btn-sm" onclick="approveForm(${formId}, 'ap')">
                                        <i class="fas fa-signature me-1"></i>Approve as AP
                                    </button>
                                `;
                            } else if (['teknisi', 'supervisor'].includes(userRole)) {
                                // Teknisi dan Supervisor hanya bisa approve IAS
                                approveButtons = `
                                    <button class="btn btn-warning btn-sm" onclick="approveForm(${formId}, 'ias')">
                                        <i class="fas fa-signature me-1"></i>Approve as IAS
                                    </button>
                                `;
                            }
                            
                            return approveButtons;
                        }
                        tbody.append(`
                            <tr>
                                <td>${form.sub_device_name}</td>
                                <td>${form.area_names}</td>
                                <td>${form.report_type}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="viewData(${form.form_id})">
                                        Data
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteForm(${form.form_id})">
                                        Delete
                                    </button>
                                    ${getApproveButtons(form.form_id)}
                                    <button class="btn btn-success btn-sm" onclick="window.open('<?= base_url('activity/printdokumentasi/') ?>${form.form_id}', '_blank')">
                                        <i class="fas fa-print"></i> Dokumentasi
                                    </button>
                                    <button class="btn btn-primary btn-sm" onclick="window.open('<?= base_url('activity/printchecklist/') ?>${form.form_id}', '_blank')">
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
    }

    // View Data Functions
    const viewData = (formId) => {
        if (!formId) {
            console.error('No form ID provided to viewData');
            return;
        }
        
        console.log('ViewData called with formId:', formId);
        localStorage.setItem('currentFormId', formId);
        $('#current_form_id').val(formId);
        
        // First get form details to check if it's a specialized form
        $.ajax({
            url: '<?= base_url("activity/get_checklist_for_form/") ?>' + formId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                const isSpecialized = response.specialized === true;
                const subDeviceId = response.form ? response.form.sub_device_id : 0;
                
                // Store form info for later use
                localStorage.setItem('isSpecializedForm', isSpecialized);
                localStorage.setItem('formSubDeviceId', subDeviceId);
                
                // Now load the form data
                loadFormDataItems(formId);
                $('#dataModal').modal('show');
                $('#formModal').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Error getting form details:', error);
                // Fallback to regular data loading
                loadFormDataItems(formId);
                $('#dataModal').modal('show');
                $('#formModal').modal('hide');
            }
        });
    };

    function loadFormDataItems(formId) {
        if (!formId) {
            console.error('No form ID provided to loadFormDataItems');
            return;
        }

        $.ajax({
            url: '<?= base_url("activity/get_form_data/") ?>' + formId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                try {
                    console.log('Response received:', response);
                    
                    const dataTable = $('#formDataItemsTable tbody');
                    dataTable.empty();
                    
                    if (response.status === 'success' && Array.isArray(response.data)) {
                        // Get form details
                        const isSpecializedForm = localStorage.getItem('isSpecializedForm') === 'true';
                        const subDeviceId = parseInt(localStorage.getItem('formSubDeviceId') || '0');
                        const isHarianForm = response.form && response.form.report_type === 'Harian';
                        
                        // Update table headers based on form type
                        if (isSpecializedForm) {
                            updateSpecializedTableHeaders(subDeviceId, response.questions);
                        } else {
                            updateFormDataTableHeaders(response.questions, isHarianForm);
                        }
                        
                        if (response.data.length > 0) {
                            response.data.forEach(item => {
                                // Parse tindakan JSON
                                let tindakanObj = {};
                                try {
                                    tindakanObj = JSON.parse(item.tindakan) || {};
                                } catch (e) {
                                    console.error('Error parsing tindakan JSON:', e);
                                }
                                
                                // For specialized forms, render a simplified table
                                if (isSpecializedForm) {
                                    const row = `
                                        <tr>
                                            <td>${item.device_hidn_name || '-'}</td>
                                            <td>${item.jam_kegiatan || '-'} - ${item.jam_selesai || '-'}</td>
                                            <td>${item.notes || 'Normal'}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" onclick="deleteFormData(${item.form_data_id})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    `;
                                    dataTable.append(row);
                                } else {
                                    // Regular form display (original code)
                                    // Create cells for each tindakan
                                    let tindakanCells = '';
                                    if (response.questions && response.questions.length > 0) {
                                        response.questions.forEach(q => {
                                            const tindakanValue = tindakanObj[q.question_number] || 'N/A';
                                            tindakanCells += `<td>${tindakanValue}</td>`;
                                        });
                                    } else {
                                        tindakanCells = '<td colspan="3">No checklist data</td>';
                                    }
                                    
                                    // Create cells for each photo
                                    let photoCells = '';
                                    
                                    // Determine photo fields to use
                                    const photoFields = ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'];
                                    
                                    // For Harian forms, add additional fields
                                    if (isHarianForm) {
                                        for (let i = 4; i <= response.questions.length; i++) {
                                            photoFields.push(`foto_${i}`);
                                        }
                                    }
                                    
                                    // Display available photos
                                    for (let i = 0; i < (isHarianForm ? response.questions.length : 3); i++) {
                                        const fieldName = photoFields[i] || '';
                                        photoCells += `
                                            <td>
                                                ${item[fieldName] ? 
                                                    `<img src="<?= base_url('uploads/') ?>${item[fieldName]}" 
                                                    width="${window.innerWidth < 768 ? '40' : '50'}" class="img-thumbnail">` : 
                                                    '-'}
                                            </td>
                                        `;
                                    }
                                    
                                    // Create table row
                                    const row = `
                                        <tr>
                                            <td>${item.device_hidn_name || '-'}</td>
                                            <td>${item.jam_kegiatan || '-'}</td>
                                            ${tindakanCells}
                                            ${photoCells}
                                            <td>${item.notes || 'Normal'}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" onclick="deleteFormData(${item.form_data_id})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    `;
                                    dataTable.append(row);
                                }
                            });
                        } else {
                            const colCount = isSpecializedForm ? 4 : (8 + (response.questions ? response.questions.length : 0));
                            dataTable.append(`
                                <tr>
                                    <td colspan="${colCount}" class="text-center">
                                        No data available
                                    </td>
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
                        
                        // Format table for mobile if needed
                        formatMobileTable();
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
    }

    function updateSpecializedTableHeaders(subDeviceId, questions) {
    const headerRow = $('#formDataItemsTable thead tr');
    headerRow.empty();
    
    // Simplified header for specialized forms
    headerRow.append('<th>Device</th>');
    headerRow.append('<th>Jam</th>');
    headerRow.append('<th>Notes</th>');
    headerRow.append('<th>Actions</th>');
}

    // Fungsi untuk mengupdate header tabel
    function updateFormDataTableHeaders(questions, isHarianForm) {
        const headerRow = $('#formDataItemsTable thead tr');
        headerRow.empty();
        
        // Tambahkan header dasar
        headerRow.append('<th>Device</th>');
        headerRow.append('<th>Jam</th>');
        
        // Tambahkan header untuk setiap pertanyaan
        if (questions && questions.length > 0) {
            questions.forEach((q, index) => {
                const shortLabel = window.innerWidth < 768 ? 
                    `T${index + 1}` : // Short label for mobile
                    `Tindakan ${index + 1}`; // Full label for desktop
                headerRow.append(`<th title="${q.question_text}">${shortLabel}</th>`);
            });
        } else {
            // Fallback jika tidak ada pertanyaan
            headerRow.append('<th>T1</th><th>T2</th><th>T3</th>');
        }
        
        // Tambahkan header untuk foto
        if (isHarianForm && questions) {
            // Untuk form Harian, tampilkan header foto sesuai jumlah pertanyaan
            for (let i = 0; i < questions.length; i++) {
                const photoLabel = window.innerWidth < 768 ? 
                    `F${i + 1}` : // Short label for mobile
                    `Foto ${i + 1}`; // Full label for desktop
                headerRow.append(`<th title="Foto untuk ${questions[i].question_text}">${photoLabel}</th>`);
            }
        } else {
            // Untuk form non-Harian, tampilkan 3 header foto saja
            headerRow.append('<th>F1</th><th>F2</th><th>F3</th>');
        }
        
        // Tambahkan header untuk notes dan aksi
        headerRow.append('<th>Notes</th>');
        headerRow.append('<th>Actions</th>');
    }

    function approveForm(formId, signatureType = 'ap') {
        // First check if the user has a signature
        $.ajax({
            url: '<?= base_url("settings/check_signature") ?>',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.has_signature) {
                    // If user has a signature, ask for confirmation
                    let sigTitle = signatureType === 'ap' ? 'ANGKASA PURA INDONESIA' : 'IAS SUPPORT';
                    if (confirm('Are you sure you want to approve this form as ' + sigTitle + '? Your digital signature will be attached to the checklist report.')) {
                        window.location.href = '<?= base_url("activity/approve_form/") ?>' + formId + '/' + signatureType;
                    }
                } else {
                    // If user doesn't have a signature, show the modal
                    var signatureModal = new bootstrap.Modal(document.getElementById('signatureRequiredModal'));
                    signatureModal.show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error checking signature:', error);
                alert('Could not verify signature. Please try again.');
            }
        });
    }

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
            // Refresh select2 after loading data
            deviceSelect.trigger('change');
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
            // Refresh select2 after loading data
            areaSelect.trigger('change');
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
        console.log('Opening add data modal for form ID:', formId);
        
        if (!formId) {
            alert('Invalid form ID');
            return;
        }

        // Clear any previous form data
        $('#addDataForm')[0].reset();
        $('#addDataForm input[name="form_id"]').val(formId);
        $('#checklistContainer').empty();
        $('#photoUploadsContainer').empty();
        
        // Hide dataModal but don't remove it from DOM
        $('#dataModal').modal('hide');
        
        // After a short delay, show the add data modal
        setTimeout(() => {
            console.log('Loading devices and checklist for form ID:', formId);
            
            // First load devices
            $.ajax({
                url: '<?= base_url("activity/get_all_device_hidn") ?>',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Device response:', response);
                    
                    const select = $('#device_hidn_id');
                    select.empty();
                    select.append('<option value="">Select Device</option>');
                    
                    if (response.status === 'success' && Array.isArray(response.data)) {
                        response.data.forEach(device => {
                            select.append(
                                $('<option>', {
                                    value: device.device_hidn_id,
                                    text: device.device_hidn_name
                                })
                            );
                        });
                        
                        // Initialize select2 if available
                        if ($.fn.select2) {
                            select.select2({
                                dropdownParent: $('#addDataModal')
                            });
                        }
                    }
                    
                    // Then load checklist questions
                    loadChecklistQuestions(formId);
                    
                    // Show the modal after everything is loaded
                    $('#addDataModal').modal('show');
                    
                    // Initialize photo previews after the modal is shown
                    $('#addDataModal').on('shown.bs.modal', function() {
                        setTimeout(() => {
                            initializePhotoPreview();
                        }, 300);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading devices:', error);
                    console.error('Response:', xhr.responseText);
                    
                    alert('Failed to load devices. Please try again.');
                    
                    // Re-show the data modal
                    $('#dataModal').modal('show');
                }
            });
        }, 300); // Small delay to avoid modal conflicts
    };

    const loadDeviceAndChecklist = async (formId) => {
        try {
            console.log('Loading device and checklist for formId:', formId);

            // Load devices with better error handling
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

            // Refresh select2 after loading data
            if ($.fn.select2) {
                select.trigger('change.select2');
            } else {
                select.trigger('change');
            }
            
            // Now load checklist questions directly
            await loadChecklistQuestions(formId);

        } catch (error) {
            console.error('Error in loadDeviceAndChecklist:', error);
            alert('Failed to load devices. Please try again: ' + error.message);
        }
    };

    // Fungsi yang diperbarui untuk memuat checklist questions dan membuat form upload foto
    const loadChecklistQuestions = async (formId) => {
        try {
            if (!formId) {
                console.error('Form ID is required');
                return;
            }

            console.log('Loading checklist questions for form ID:', formId);
            const response = await $.ajax({
                url: `<?= base_url("activity/get_checklist_for_form/") ?>${formId}`,
                method: 'GET',
                dataType: 'json'
            });

            console.log('Checklist response:', response);
            
            const container = $('#checklistContainer');
            container.empty();

            if (response.status === 'success') {
                // Check if this is a specialized form
                const isSpecialized = response.specialized === true;
                
                // Get form details and questions
                const form = response.form || {};
                const questions = response.data || [];
                const reportType = form.report_type || '';
                const subDeviceId = form.sub_device_id || 0;
                
                if (questions.length > 0) {
                    // Display all checklist questions
                    questions.forEach((question) => {
                        container.append(`
                            <div class="mb-3">
                                <label class="form-label">${question.question_text}</label>
                                <select name="tindakan${question.question_number}" class="form-control" required>
                                    <option value="OK">OK</option>
                                    <option value="NOT OK">NOT OK</option>
                                </select>
                            </div>
                        `);
                    });
                    
                    // Generate photo upload fields based on form type
                    if (isSpecialized) {
                        // For specialized forms (device 267 or 269)
                        generateSpecializedPhotoFields(subDeviceId, questions);
                    } else {
                        // For regular forms
                        generatePhotoUploadFields(questions, reportType);
                    }
                } else {
                    container.append('<div class="alert alert-info">No checklist questions available for this form.</div>');
                }
            } else {
                container.append('<div class="alert alert-warning">Failed to load checklist questions.</div>');
            }
        } catch (error) {
            console.error('Error loading checklist questions:', error);
            $('#checklistContainer').html(
                `<div class="alert alert-danger">Failed to load checklist questions: ${error.message}</div>`
            );
        }
    };

    function generateSpecializedPhotoFields(subDeviceId, questions) {
        const container = $('#photoUploadsContainer');
        container.empty();
        
        // Determine total photos based on device ID
        const totalPhotos = (subDeviceId == 267) ? 18 : 17;
        
        // Documentation labels for each device
        let photoLabels = [];
        
        if (subDeviceId == 267) {
            photoLabels = [
                'Memastikan Screen Motorized / Barco Video Controll',
                'Koneksi Tampilan Screen & Proyektor / Wall Display / Internet Perkantoran',
                'Koneksi HDMI / Dongle / Digibird',
                'Cek perangkat Server Datapath dan Wall Display berfungsi dengan baik',
                'Cek koneksi PC, Server Datapath, Projector dan Wall Display saling terhubung',
                'Pastikan perangkat DigiBird Video Wall Controller dan Wall Panel berfungsi dengan baik',
                'Pastikan perangkat monitor di meja rapat kondisi aktif',
                'Pastikan perangkat PC operator terhubung jaringan internet dengan baik',
                'Pastikan Proyektor, Screen Proyektor, dan kabel HDMI berfungsi dengan baik',
                'Cek perangkat Screen Projector Motorized',
                'Cek kondisi VGA Splitter/Amplifier',
                'Cek HDMI Extender',
                'Pastikan Microphone berfungsi dengan baik',
                'Cek Sound System di ruang rapat',
                'Pastikan terkoneksi ke jaringan wireless',
                'Pastikan webcam berfungsi dengan baik',
                'Cek koneksi audio output ke speaker',
                'Cek koneksi kabel power dan pastikan tersedia steker listrik cadangan'
            ];
        } else if (subDeviceId == 269) {
            photoLabels = [
                'Cek Kondisi Jaringan Jalur FO Antar Gedung Jaringan IT Perkantoran BSH',
                'Cek Kondisi Jaringan IT BSH Gedung 601 T1-T2-T3',
                'Cek Kondisi Jarigan Switch Access Gedung 601',
                'Cek Monitoring jaringan Access Point Perkantoran BSH',
                'Cek Penggunaan Resources Infrastruktur Server Perkantoran svt01-cgk',
                'Cek Penggunaan Resources Infrastruktur Server Perkantoran sct02-cgk',
                'Cek Status Temperature Server Room IT',
                'Cek Update Server Trend Micro Deep Security',
                'Cek Status Server Deep Discovery Inspector',
                'Cek Update Database Kaspersky',
                'Cek Status Server cgk-Infoblox-01',
                'Cek Status Server cgk-Infoblox-02',
                'Cek Monitoring Jaringan Access Point Perkantoran BSH',
                'Cek Status Grid Manager Infoblox',
                'Cek Status license Kaspersky',
                'Cek Update Backup Server Atlantis (172.17.45.11)',
                'Cek Status Local Backup Server'
            ];
        }
        
        // Create upload fields with appropriate labels
        for (let i = 0; i < totalPhotos; i++) {
            const fieldName = i < 3 ? 
                ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'][i] : // Use existing field names for first 3
                `foto_${i+1}`; // Use new field names for the rest
            
            // Get form question text for the checklist
            const questionText = (i < questions.length) ? 
                questions[i].question_text : 
                `Photo ${i+1}`;
                
            // Get documentation label for the photo
            const photoLabel = (i < photoLabels.length) ?
                photoLabels[i] :
                `Photo ${i+1}`;
            
            container.append(`
                <div class="mb-3">
                    <label class="form-label" for="${fieldName}">
                        <strong>Photo ${i+1}:</strong> ${photoLabel} <small class="text-muted">(Max 4MB)</small>
                    </label>
                    <div class="form-text mb-2">
                        <em>Checklist for this photo: ${questionText}</em>
                    </div>
                    <input type="file" class="form-control" id="${fieldName}" name="${fieldName}" accept="image/*" required>
                    <div class="form-text">Photo will be automatically compressed if too large</div>
                    <div id="preview-${fieldName}" class="mt-2 image-preview"></div>
                </div>
            `);
        }
        
        // Add informative message
        container.append(`
            <div class="alert alert-info">
                This form requires ${totalPhotos} photos. Please make sure all photos are clear and relevant.
            </div>
        `);
    }

    // Fungsi untuk membuat field upload foto secara dinamis
    function generatePhotoUploadFields(questions, reportType) {
        const container = $('#photoUploadsContainer');
        container.empty();
        
        // Determine number of photos to display
        // For Harian form, show photos for all questions
        // For other forms, show max 3 photos
        const questionLimit = reportType === 'Harian' ? questions.length : Math.min(3, questions.length);
        
        for (let i = 0; i < questionLimit; i++) {
            const question = questions[i];
            const fieldName = i < 3 ? 
                ['foto_perangkat', 'foto_lokasi', 'foto_teknisi'][i] : // Use existing names for first 3
                `foto_${i+1}`; // Use new names for additional photos
            
            container.append(`
                <div class="mb-3">
                    <label class="form-label" for="${fieldName}">${question.question_text} <small class="text-muted">(Max 4MB)</small></label>
                    <input type="file" class="form-control" id="${fieldName}" name="${fieldName}" accept="image/*" required>
                    <div class="form-text">Photo will be automatically compressed if too large</div>
                    <div id="preview-${fieldName}" class="mt-2 image-preview"></div>
                </div>
            `);
        }
        
        // For non-daily forms, show informative message
        if (reportType !== 'Harian' && questions.length > 3) {
            container.append(`
                <div class="alert alert-info">
                    Form ${reportType} requires only 3 photos. For "Harian" form, you would need to upload ${questions.length} photos.
                </div>
            `);
        }
    }

    function initializePhotoPreview() {
    // Add a section header before the photo section
        if ($('#photoUploadsContainer').length && !$('.photo-section-header').length) {
            const totalPhotos = $('#photoUploadsContainer input[type="file"]').length;
            $('#photoUploadsContainer').prepend(`
                <div class="photo-section-header">
                    <div>Photo Documentation Section</div>
                    <span class="badge">${totalPhotos} Photos Required</span>
                </div>
            `);
        }
        
        // Handle all file inputs for preview
        $('#photoUploadsContainer input[type="file"]').each(function() {
            const input = this;
            const previewId = 'preview-' + $(input).attr('id');
            const previewContainer = $('#' + previewId);
            
            // Clear preview if it's already initialized
            previewContainer.empty();
            
            // Add event listener for file selection
            $(input).off('change').on('change', function(e) {
                previewContainer.empty();
                
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    
                    // Check file size
                    const fileSizeMB = file.size / (1024 * 1024);
                    if (fileSizeMB > 4) {
                        previewContainer.html(`
                            <div class="alert alert-warning mt-2">
                                File size (${fileSizeMB.toFixed(2)} MB) exceeds the 4MB limit.
                                It will be compressed when uploaded.
                            </div>
                        `);
                    }
                    
                    // Create file reader for preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.html(`
                            <div class="mt-2">
                                <img src="${e.target.result}" class="img-thumbnail" alt="Preview">
                                <div class="small text-muted mt-1">
                                    ${file.name} (${(file.size / 1024).toFixed(2)} KB)
                                </div>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }

    // Function to check if all required photos are uploaded
    function validatePhotoUploads() {
        let allPhotosUploaded = true;
        let missingPhotos = [];
        
        $('#photoUploadsContainer input[type="file"][required]').each(function() {
            if (!this.files || !this.files[0]) {
                allPhotosUploaded = false;
                // Get the label text
                const labelText = $(this).closest('.mb-3').find('label').text();
                missingPhotos.push(labelText.split(':')[0].trim()); // Just get the "Photo X" part
            }
        });
        
        if (!allPhotosUploaded) {
            // Show error with missing photos
            showToast('Missing Photos', 'Please upload all required photos: ' + missingPhotos.join(', '), 'error');
            return false;
        }
        
        return true;
    }

    // Function to show progress while uploading multiple photos
    function showUploadProgress() {
        // Count total files
        const totalFiles = $('#photoUploadsContainer input[type="file"]').length;
        
        // Create progress modal if it doesn't exist
        if (!$('#uploadProgressModal').length) {
            $('body').append(`
                <div class="modal fade" id="uploadProgressModal" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Uploading Photos</h5>
                            </div>
                            <div class="modal-body">
                                <p>Uploading and processing photos. Please wait...</p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                        role="progressbar" style="width: 0%"></div>
                                </div>
                                <div class="mt-2 text-center" id="uploadProgressText">
                                    Preparing to upload...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('uploadProgressModal'));
        modal.show();
        
        // Simulate progress (since we can't get actual upload progress easily)
        let progress = 0;
        const progressBar = $('#uploadProgressModal .progress-bar');
        const progressText = $('#uploadProgressText');
        
        const progressInterval = setInterval(() => {
            // Increment progress but slow down as we approach 90%
            if (progress < 90) {
                progress += (90 - progress) / 10;
                progressBar.css('width', progress + '%');
                progressText.text(`Processing ${Math.round(progress)}% complete...`);
            }
        }, 500);
        
        // Store the interval ID so we can clear it later
        $('#uploadProgressModal').data('progressInterval', progressInterval);
        
        return modal;
    }

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
        
        // Check if all required fields are filled
        let allFieldsFilled = true;
        $('#addDataForm input[required], #addDataForm select[required]').each(function() {
            if (!$(this).val()) {
                allFieldsFilled = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!allFieldsFilled) {
            alert('Please fill all required fields');
            return;
        }
        
        // Validate photo uploads
        if (!validatePhotoUploads()) {
            return;
        }
        
        // Show progress modal
        const progressModal = showUploadProgress();
        
        $.ajax({
            url: '<?= base_url("activity/add_form_data") ?>',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                try {
                    // Clear progress interval
                    clearInterval($('#uploadProgressModal').data('progressInterval'));
                    
                    // Update progress to 100%
                    $('#uploadProgressModal .progress-bar').css('width', '100%');
                    $('#uploadProgressText').text('Upload complete! Processing...');
                    
                    const result = typeof response === 'string' ? JSON.parse(response) : response;
                    
                    setTimeout(() => {
                        // Hide progress modal
                        progressModal.hide();
                        
                        if(result.status === 'success') {
                            // Close only the addDataModal
                            $('#addDataModal').modal('hide');
                            
                            // Reset the form
                            $('#addDataForm')[0].reset();
                            
                            // Show the dataModal again and refresh the data
                            setTimeout(() => {
                                $('#dataModal').modal('show');
                                loadFormDataItems(formId);
                            }, 300);
                            
                            // Show success message
                            showToast('Success', 'Data saved successfully', 'success');
                        } else {
                            alert(result.message || 'Failed to save data');
                        }
                    }, 500);
                } catch (error) {
                    // Hide progress modal
                    progressModal.hide();
                    
                    console.error('Error processing response:', error);
                    alert('Failed to process server response');
                }
            },
            error: function(xhr, status, error) {
                // Hide progress modal
                progressModal.hide();
                
                console.error('Error saving form data:', error);
                alert('Failed to save form data. Error: ' + error);
            }
        });
    };

    function showToast(title, message, type = 'info') {
        // Create toast container if it doesn't exist
        if ($('#toast-container').length === 0) {
            $('body').append('<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1080;"></div>');
        }
        
        // Create a unique ID for this toast
        const toastId = 'toast-' + Date.now();
        
        // Set the appropriate background color based on type
        let bgClass = 'bg-info';
        if (type === 'success') bgClass = 'bg-success';
        if (type === 'warning') bgClass = 'bg-warning';
        if (type === 'error') bgClass = 'bg-danger';
        
        // Create the toast HTML
        const toast = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                <div class="toast-header ${bgClass} text-white">
                    <strong class="me-auto">${title}</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        
        // Add the toast to the container
        $('#toast-container').append(toast);
        
        // Initialize and show the toast
        const toastElement = new bootstrap.Toast(document.getElementById(toastId));
        toastElement.show();
        
        // Remove the toast from the DOM after it's hidden
        $(`#${toastId}`).on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }

    function cancelAddData() {
        $('#addDataModal').modal('hide');
        setTimeout(() => {
            $('#dataModal').modal('show');
        }, 300);
    }

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

        if (window.innerWidth < 768) {
            $('.modal-body').scrollTop(0);
        }
    }

    function handleDataModalHidden() {
        localStorage.removeItem('currentFormId');
    }

    function backToActivityForm() {
        // Hide current modal
        if ($('#dataModal').hasClass('show')) {
            $('#dataModal').modal('hide');
        }
        
        if ($('#addDataModal').hasClass('show')) {
            $('#addDataModal').modal('hide');
        }
        
        // Show the activity form modal after a short delay
        setTimeout(() => {
            $('#formModal').modal('show');
        }, 300);
    }

    function formatMobileTable() {
        if (window.innerWidth < 768) {
            // Check if we're dealing with a specialized form
            const isSpecialized = localStorage.getItem('isSpecializedForm') === 'true';
            
            // Replace long text with shorter versions for mobile
            $('#formDataItemsTable th').each(function(index) {
                const text = $(this).text();
                if (index === 0) $(this).text('Device');
                if (index === 1) $(this).text('Time');
                
                // For tindakan columns
                if (text.startsWith('Tindakan')) {
                    const num = text.split(' ')[1];
                    $(this).text('T' + num);
                }
                
                // For foto columns
                if (text.startsWith('Foto')) {
                    const num = text.split(' ')[1];
                    $(this).text('F' + num);
                }
            });
            
            // For specialized forms, we need to adjust the modals
            if (isSpecialized) {
                // Make add data modal larger for more photo fields
                $('#addDataModal .modal-dialog').addClass('modal-lg');
                
                // Add scrollbar to photo container
                $('#photoUploadsContainer').css({
                    'max-height': '400px',
                    'overflow-y': 'auto',
                    'padding-right': '10px'
                });
            }
        } else {
            // Reset modal size for desktop view
            $('#addDataModal .modal-dialog').removeClass('modal-lg');
            $('#photoUploadsContainer').css({
                'max-height': 'none',
                'overflow-y': 'visible',
                'padding-right': '0'
            });
        }
    }

    $('#formModal, #addDataModal, #dataModal').on('hidden.bs.modal', function() {
        // Destroy select2 instances when modal is closed to prevent duplicates
        $(this).find('.select2-single').select2('destroy');
    });
</script>

<script>
    $(document).ready(function() {
        // Cek apakah tabel ada di halaman ini
        if ($('#activityTable').length > 0) {
            $('#activityTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json' // Bahasa Indonesia
                },
                columnDefs: [
                    { responsivePriority: 1, targets: 0 }, // Kolom #
                    { responsivePriority: 2, targets: 1 }, // Kolom Kode Activity
                    { responsivePriority: 3, targets: -1 } // Kolom Aksi
                ],
                paging: false, // Menonaktifkan pagination DataTables
                lengthChange: false, // Menyembunyikan dropdown "Tampilkan X entri"
                info: false, // Menyembunyikan teks informasi
                searching: true // Tetap aktifkan pencarian jika diperlukan
            });
        }
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

    document.addEventListener('DOMContentLoaded', function() {
        // Validasi input jam
        document.querySelector('input[name="jam_selesai"]').addEventListener('change', function() {
            var jamMulai = document.querySelector('input[name="jam_kegiatan"]').value;
            var jamSelesai = this.value;
            
            if (jamMulai && jamSelesai) {
                var mulai = new Date('2000-01-01T' + jamMulai);
                var selesai = new Date('2000-01-01T' + jamSelesai);
                
                if (selesai <= mulai) {
                    alert('Jam selesai harus lebih besar dari jam mulai');
                    this.value = '';
                }
            }
        });
    });
  </script>
  <!-- plugins:js -->
  
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

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

