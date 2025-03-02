<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AMAR Apps - Device HIDN</title>
  <!-- Vendor stylesheets -->
  <link rel="stylesheet" href="<?php echo base_url('vendors/feather/feather.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendors/css/vendor.bundle.base.css'); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('vendors/mdi/css/materialdesignicons.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('js/select.dataTables.min.css'); ?>">
  <!-- Main stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
</head>
<body>
    
<div class="container-scroller">
    <!-- Navbar -->
    <?php include 'navbar.php' ?>
    
    <!-- Page container -->
    <div class="container-fluid page-body-wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>
        
        <!-- Main content -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- Flash Messages -->
                <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <!-- Device HIDN Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Device HIDN Management</h4>
                                    <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeviceHidnModal">
                                        <i class="fas fa-plus-circle"></i> Tambah Device HIDN
                                    </a>
                                </div>
                                
                                <!-- Device HIDN Table -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="deviceHidnTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Device HIDN Name</th>
                                                <th>Jumlah Device</th>
                                                <th>Sub Device</th>
                                                <th>PEK Unit</th>
                                                <th>Sub Area</th>
                                                <th>Area</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($devicehidn)): ?>
                                                <?php foreach ($devicehidn as $device): ?>
                                                    <tr>
                                                        <td><?php echo $device->device_hidn_id; ?></td>
                                                        <td><?php echo $device->device_hidn_name; ?></td>
                                                        <td><?php echo $device->jum_device_hidn; ?></td>
                                                        <td><?php echo $device->sub_device_name; ?></td>
                                                        <td><?php echo $device->pek_unit_name; ?></td>
                                                        <td><?php echo $device->sub_area_name; ?></td>
                                                        <td><?php echo $device->area_name; ?></td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="btn btn-warning btn-sm edit-device" 
                                                               data-id="<?php echo $device->device_hidn_id; ?>">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
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
                                                    <td colspan="8" class="text-center">No devices found</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?> AMAR. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- Add/Edit Device HIDN Modal -->
<div class="modal fade" id="addDeviceHidnModal" tabindex="-1" aria-labelledby="addDeviceHidnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDeviceHidnModalLabel">Tambah Device HIDN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form action="<?= base_url('devicehidn/save'); ?>" method="post" id="deviceHidnForm">
                    <input type="hidden" name="device_hidn_id" id="device_hidn_id">
                    
                    <div class="mb-3">
                        <label for="device_hidn_name" class="form-label">Device HIDN Name</label>
                        <input type="text" class="form-control" id="device_hidn_name" name="device_hidn_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jum_device_hidn" class="form-label">Jumlah Device</label>
                        <input type="number" class="form-control" id="jum_device_hidn" name="jum_device_hidn" required>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area_id" class="form-label">Area</label>
                                <select class="form-select" id="area_id" name="area_id">
                                    <option value="">Pilih Area</option>
                                    <?php if (!empty($areas)) : ?>
                                        <?php foreach ($areas as $area): ?>
                                            <option value="<?= $area->area_id; ?>">
                                                <?= $area->area_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Data tidak ditemukan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sub_area_id" class="form-label">Sub Area</label>
                                <select class="form-select" id="sub_area_id" name="sub_area_id">
                                    <option value="">Pilih Sub Area</option>
                                    <?php if (!empty($sub_areas)) : ?>
                                        <?php foreach ($sub_areas as $sub_area): ?>
                                            <option value="<?= $sub_area->sub_area_id; ?>" data-area="<?= $sub_area->gr_area_name; ?>">
                                                <?= $sub_area->sub_area_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Data tidak ditemukan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pek_unit_id" class="form-label">PEK Unit</label>
                                <select class="form-select" id="pek_unit_id" name="pek_unit_id">
                                    <option value="">Pilih PEK Unit</option>
                                    <?php if (!empty($groupdevices)) : ?>
                                        <?php foreach ($groupdevices as $group): ?>
                                            <option value="<?= $group->pek_unit_id; ?>">
                                                <?= $group->pek_unit_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Data tidak ditemukan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sub_device_id" class="form-label">Sub Device</label>
                                <select class="form-select" id="sub_device_id" name="sub_device_id" required>
                                    <option value="">Pilih Sub Device</option>
                                    <?php if (!empty($sub_devices)) : ?>
                                        <?php foreach ($sub_devices as $sub_device): ?>
                                            <option value="<?= $sub_device->sub_device_id; ?>" data-pek="<?= $sub_device->pek_unit_name; ?>">
                                                <?= $sub_device->sub_device_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="">Data tidak ditemukan</option>
                                    <?php endif; ?>
                                </select>
                            </div>
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
</div>

<!-- Debug Modal -->
<div class="modal fade" id="debugModal" tabindex="-1" aria-labelledby="debugModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="debugModalLabel">Debug Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="debugContent" style="white-space: pre-wrap; font-family: monospace;"></div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Libraries -->
<script src="<?php echo base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#deviceHidnTable').DataTable({
        responsive: true,
        order: [[0, 'desc']]
    });
    
    // Reset form when modal is closed
    $('#addDeviceHidnModal').on('hidden.bs.modal', function() {
        $('#deviceHidnForm')[0].reset();
        $('#device_hidn_id').val('');
        $('#addDeviceHidnModalLabel').text('Tambah Device HIDN');
    });
    
    // Debug function to display form data
    function debugFormData() {
        var formData = {};
        $('#deviceHidnForm').serializeArray().forEach(function(item) {
            formData[item.name] = item.value;
        });
        
        // Add dropdown text values
        formData['area_text'] = $('#area_id option:selected').text();
        formData['sub_area_text'] = $('#sub_area_id option:selected').text();
        formData['pek_unit_text'] = $('#pek_unit_id option:selected').text();
        formData['sub_device_text'] = $('#sub_device_id option:selected').text();
        
        $('#debugContent').text(JSON.stringify(formData, null, 2));
        $('#debugModal').modal('show');
    }
    
    
    // Filter Sub Area based on selected Area
    $('#area_id').on('change', function() {
        var areaId = $(this).val();
        if(areaId) {
            $.ajax({
                url: '<?= base_url('devicehidn/get_sub_areas_by_area'); ?>',
                type: 'POST',
                data: {area_id: areaId},
                dataType: 'json',
                success: function(data) {
                    $('#sub_area_id').empty();
                    $('#sub_area_id').append('<option value="">Pilih Sub Area</option>');
                    $.each(data, function(key, value) {
                        $('#sub_area_id').append('<option value="' + value.sub_area_id + '">' + value.sub_area_name + '</option>');
                    });
                    console.log('Sub areas loaded:', data);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                    alert('Error fetching sub areas: ' + error);
                }
            });
        } else {
            $('#sub_area_id').empty();
            $('#sub_area_id').append('<option value="">Pilih Sub Area</option>');
        }
    });
    
    // Filter Sub Device based on selected PEK Unit
    $('#pek_unit_id').on('change', function() {
        var pekUnitId = $(this).val();
        if(pekUnitId) {
            $.ajax({
                url: '<?= base_url('devicehidn/get_sub_devices_by_pek_unit'); ?>',
                type: 'POST',
                data: {pek_unit_id: pekUnitId},
                dataType: 'json',
                success: function(data) {
                    $('#sub_device_id').empty();
                    $('#sub_device_id').append('<option value="">Pilih Sub Device</option>');
                    $.each(data, function(key, value) {
                        $('#sub_device_id').append('<option value="' + value.sub_device_id + '">' + value.sub_device_name + '</option>');
                    });
                    console.log('Sub devices loaded:', data);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                    alert('Error fetching sub devices: ' + error);
                }
            });
        } else {
            $('#sub_device_id').empty();
            $('#sub_device_id').append('<option value="">Pilih Sub Device</option>');
        }
    });
    
    // Handle Edit button click
    $('.edit-device').on('click', function() {
        var deviceId = $(this).data('id');
        $('#addDeviceHidnModalLabel').text('Edit Device HIDN');
        
        // Fetch device data
        $.ajax({
            url: '<?= base_url('devicehidn/get_by_id/'); ?>' + deviceId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Fill form with device data
                $('#device_hidn_id').val(response.device_hidn_id);
                $('#device_hidn_name').val(response.device_hidn_name);
                $('#jum_device_hidn').val(response.jum_device_hidn);
                
                // Set dropdown values
                if(response.area_id) {
                    $('#area_id').val(response.area_id).trigger('change');
                    
                    // Wait for sub_area options to load before setting sub_area_id
                    setTimeout(function() {
                        if(response.sub_area_id) {
                            $('#sub_area_id').val(response.sub_area_id);
                        }
                    }, 500);
                }
                
                if(response.pek_unit_id) {
                    $('#pek_unit_id').val(response.pek_unit_id).trigger('change');
                    
                    // Wait for sub_device options to load before setting sub_device_id
                    setTimeout(function() {
                        if(response.sub_device_id) {
                            $('#sub_device_id').val(response.sub_device_id);
                        }
                    }, 500);
                } else {
                    // If no pek_unit_id but sub_device_id exists
                    if(response.sub_device_id) {
                        $('#sub_device_id').val(response.sub_device_id);
                    }
                }
                
                // Show modal
                $('#addDeviceHidnModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                console.log('Status:', status);
                console.log('Response:', xhr.responseText);
                alert('Error fetching device data: ' + error);
            }
        });
    });
    
    // Form validation before submit
    $('#deviceHidnForm').on('submit', function(e) {
        var isValid = true;
        
        // Debug form data before submission
        console.log('Form data before submission:');
        $(this).serializeArray().forEach(function(item) {
            console.log(item.name + ': ' + item.value);
        });
        
        // Basic validation
        if (!$('#device_hidn_name').val()) {
            alert('Device HIDN Name is required');
            isValid = false;
        }
        
        if (!$('#jum_device_hidn').val()) {
            alert('Jumlah Device is required');
            isValid = false;
        }
        
        if (!$('#sub_device_id').val()) {
            alert('Sub Device is required');
            isValid = false;
        }
        
        return isValid;
    });
});
</script>

<!-- Optional Custom Scripts -->
<script src="<?php echo base_url('js/off-canvas.js'); ?>"></script>
<script src="<?php echo base_url('js/hoverable-collapse.js'); ?>"></script>
<script src="<?php echo base_url('js/template.js'); ?>"></script>
<script src="<?php echo base_url('js/settings.js'); ?>"></script>
<script src="<?php echo base_url('js/todolist.js'); ?>"></script>
<script src="<?php echo base_url('js/dashboard.js'); ?>"></script>

</body>
</html>