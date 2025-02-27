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
                    <div class="col-md-4">
                        <form id="searchForm" action="<?= base_url('activity/search') ?>" method="GET" class="d-flex">
                        <input type="text" id="searchInput" name="search" class="form-control" placeholder="Cari data..." value="<?= isset($search_term) ? $search_term : '' ?>">
                        <button type="submit" class="btn btn-outline-primary ms-2">
                            <i class="fas fa-search"></i>
                        </button>
                        </form>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="activityTable" id="activityTable">
                      <thead>
                        <tr>
                          <th>#</th>
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
                            <td><?= $start + $index; ?></td>
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
                                        <select class="form-control select2-single" name="area_id" required>
                                            <option value="">Pilih Lokasi</option>
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
                                <input type="time" class="form-control" name="jam_kegiatan" required>
                            </div>
                            
                            <div id="checklistContainer">
                                <!-- Checklist questions will be loaded here -->
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Foto Perangkat <small class="text-muted">(Max 4MB)</small></label>
                                <input type="file" class="form-control" name="foto_perangkat" accept="image/*" required>
                                <div class="form-text">Photo will be automatically compressed if too large</div>
                                <div id="preview-foto_perangkat" class="mt-2 image-preview"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Foto Lokasi <small class="text-muted">(Max 4MB)</small></label>
                                <input type="file" class="form-control" name="foto_lokasi" accept="image/*" required>
                                <div class="form-text">Photo will be automatically compressed if too large</div>
                                <div id="preview-foto_lokasi" class="mt-2 image-preview"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Foto Teknisi <small class="text-muted">(Max 4MB)</small></label>
                                <input type="file" class="form-control" name="foto_teknisi" accept="image/*" required>
                                <div class="form-text">Photo will be automatically compressed if too large</div>
                                <div id="preview-foto_teknisi" class="mt-2 image-preview"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes" rows="3">Normal</textarea>
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
                if (response.data.length > 0) {
                response.data.forEach(item => {
                    // For mobile, use a more compact display
                    const isMobile = window.innerWidth < 768;
                    const row = `
                    <tr>
                        <td>${item.device_hidn_name || '-'}</td>
                        <td>${item.jam_kegiatan || '-'}</td>
                        <td>${item.tindakan1 || '-'}</td>
                        <td>${item.tindakan2 || '-'}</td>
                        <td>${item.tindakan3 || '-'}</td>
                        <td>
                        ${item.foto_perangkat ? 
                            `<img src="<?= base_url('uploads/') ?>${item.foto_perangkat}" 
                                width="${isMobile ? '40' : '50'}" class="img-thumbnail">` : 
                            '-'}
                        </td>
                        <td>
                        ${item.foto_lokasi ? 
                            `<img src="<?= base_url('uploads/') ?>${item.foto_lokasi}" 
                                width="${isMobile ? '40' : '50'}" class="img-thumbnail">` : 
                            '-'}
                        </td>
                        <td>
                        ${item.foto_teknisi ? 
                            `<img src="<?= base_url('uploads/') ?>${item.foto_teknisi}" 
                                width="${isMobile ? '40' : '50'}" class="img-thumbnail">` : 
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
        console.log('Current form ID:', formId);
        
        if (!formId) {
            alert('Invalid form ID');
            return;
        }

        $('#addDataForm input[name="form_id"]').val(formId);
        
        // Hide dataModal but don't remove it from DOM
        $('#dataModal').modal('hide');
        
        // After a short delay, show the add data modal
        setTimeout(() => {
            loadDeviceAndChecklist(formId);
            $('#addDataModal').modal('show');
            
            // Set up the form submission handler
            $('#addDataForm').off('submit').on('submit', submitFormData);
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
        select.trigger('change');
        
        // Load checklist questions after devices are loaded
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
        
        // Show a loading indicator
        const saveButton = $('#addDataModal').find('button[type="button"]').last();
        const originalText = saveButton.html();
        saveButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        saveButton.prop('disabled', true);
        
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
                        // Close only the addDataModal
                        $('#addDataModal').modal('hide');
                        
                        // Reset the form
                        $('#addDataForm')[0].reset();
                        
                        // Show the dataModal again and refresh the data
                        $('#dataModal').modal('show');
                        loadFormDataItems(formId);
                        
                        // Optional: Show a success message
                        showToast('Success', 'Data saved successfully', 'success');
                    } else {
                        alert(result.message || 'Failed to save data');
                    }
                } catch (error) {
                    console.error('Error processing response:', error);
                    alert('Failed to process server response');
                } finally {
                    // Restore the button state regardless of outcome
                    saveButton.html(originalText);
                    saveButton.prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error saving form data:', error);
                alert('Failed to save form data. Error: ' + error);
                
                // Restore the button state
                saveButton.html(originalText);
                saveButton.prop('disabled', false);
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
        // Replace long text with shorter versions for mobile
        $('#formDataItemsTable th').each(function() {
            const text = $(this).text();
            if (text === 'Jam Kegiatan') $(this).text('Jam');
            if (text === 'Tindakan 1') $(this).text('T1');
            if (text === 'Tindakan 2') $(this).text('T2');
            if (text === 'Tindakan 3') $(this).text('T3');
            if (text === 'Photo 1') $(this).text('P1');
            if (text === 'Photo 2') $(this).text('P2');
            if (text === 'Photo 3') $(this).text('P3');
        });
        }
    }

    $('#formModal, #addDataModal, #dataModal').on('hidden.bs.modal', function() {
        // Destroy select2 instances when modal is closed to prevent duplicates
        $(this).find('.select2-single').select2('destroy');
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

