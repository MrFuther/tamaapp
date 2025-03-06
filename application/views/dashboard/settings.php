<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AMAR Apps - Settings</title>
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
                        <!-- Account Settings Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title">Account Settings</h4>
                                </div>
                                
                                <div class="row">
                                    <!-- Password Update Form -->
                                    <div class="col-md-6 grid-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">
                                                    <i class="fas fa-key text-primary me-2"></i>Change Password
                                                </h5>
                                                
                                                <form action="<?php echo base_url('settings/update_password'); ?>" method="POST">
                                                    <div class="mb-3">
                                                        <label for="current_password" class="form-label">Current Password</label>
                                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="new_password" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                                        <small class="text-muted">Minimum 6 characters</small>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                                    </div>
                                                    
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-2"></i>Update Password
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Digital Signature Form -->
                                    <div class="col-md-6 grid-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">
                                                    <i class="fas fa-signature text-success me-2"></i>Digital Signature
                                                </h5>
                                                
                                                <form action="<?php echo base_url('settings/update_signature'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Signature</label>
                                                        <div class="p-3 border rounded text-center mb-3 bg-light">
                                                        <?php if (!empty($users->signature)) : ?>
                                                            <img src="<?php echo base_url('settings/get_signature/' . $users->id); ?>" alt="Digital Signature" class="img-fluid" style="max-height: 100px;">
                                                        <?php else : ?>
                                                            <div class="text-muted py-3">
                                                                <i class="fas fa-signature fa-2x mb-2"></i>
                                                                <p>No signature uploaded yet</p>
                                                            </div>
                                                        <?php endif; ?> 
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label for="signature" class="form-label">Upload New Signature</label>
                                                        <input type="file" class="form-control" id="signature" name="signature" accept="image/png" required>
                                                        <small class="text-muted">
                                                            <i class="fas fa-info-circle me-1"></i>PNG format only, max size 2MB
                                                        </small>
                                                    </div>
                                                    
                                                    <div class="mb-3" id="signature-preview"></div>
                                                    
                                                    <div class="alert alert-info small" role="alert">
                                                        <i class="fas fa-info-circle me-2"></i>Disarankan untuk foto Tanda Tangan tidak ada background, agar lebih mudah dibaca.
                                                    </div>
                                                    
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fas fa-upload me-2"></i>Update Signature
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Account Information -->
                                    <div class="col-md-12 grid-margin">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">
                                                    <i class="fas fa-user-circle text-info me-2"></i>Account Information
                                                </h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>Username</strong></td>
                                                                <td>: <?php echo $users->username; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Name</strong></td>
                                                                <td>: <?php echo $users->nama_pegawai ?? 'Not set'; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Role</strong></td>
                                                                <td>: <span class="badge bg-secondary"><?php echo $users->role; ?></span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="alert alert-light border">
                                                            <p class="mb-1"><i class="fas fa-info-circle me-2 text-primary"></i><strong>Account Tips:</strong></p>
                                                            <ul class="mb-0 ps-4">
                                                                <li>Regularly update your password for security</li>
                                                                <li>Make sure your signature is clear and properly aligned</li>
                                                                <li>Contact admin if you need to change your role or unit</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="signatureRequiredModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title">Signature Required</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center mb-4">
                                                <i class="fas fa-signature fa-4x text-warning mb-3"></i>
                                                <h5>No Signature Found</h5>
                                                <p>You need to upload your digital signature before you can approve forms.</p>
                                                </div>
                                                <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Your signature will be used on PDF reports to indicate your approval.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="<?= base_url('settings') ?>" class="btn btn-primary">
                                                <i class="fas fa-upload me-2"></i>Upload Signature Now
                                                </a>
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
            
            <!-- Footer -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date('Y'); ?> AMAR. All rights reserved.</span>
                </div>
            </footer>
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
    // Image preview before upload
    $('#signature').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#signature-preview').html(
                    '<div class="text-center p-2 border rounded mb-3 bg-light">' +
                    '<p class="mb-1 text-muted small">Preview:</p>' +
                    '<img src="' + e.target.result + '" class="img-fluid" style="max-height: 100px;">' +
                    '</div>'
                );
            }
            reader.readAsDataURL(file);
        } else {
            $('#signature-preview').html('');
        }
    });
    
    // Password strength validation (optional enhancement)
    $('#new_password').on('input', function() {
        var password = $(this).val();
        // Basic strength check
        var strength = 0;
        
        if (password.length >= 6) strength += 1;
        if (password.match(/[a-z]+/)) strength += 1;
        if (password.match(/[A-Z]+/)) strength += 1;
        if (password.match(/[0-9]+/)) strength += 1;
        if (password.match(/[$@#&!]+/)) strength += 1;
        
        var strengthText, strengthClass;
        
        switch(strength) {
            case 0:
            case 1:
                strengthText = "Weak";
                strengthClass = "text-danger";
                break;
            case 2:
            case 3:
                strengthText = "Medium";
                strengthClass = "text-warning";
                break;
            case 4:
            case 5:
                strengthText = "Strong";
                strengthClass = "text-success";
                break;
        }
        
        if (password.length > 0) {
            $(this).next().html('Minimum 6 characters • Strength: <span class="' + strengthClass + '">' + strengthText + '</span>');
        } else {
            $(this).next().html('Minimum 6 characters');
        }
    });
    
    // Confirm password match validation
    $('#confirm_password').on('input', function() {
        if ($(this).val() !== $('#new_password').val()) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
});

function approveForm(formId) {
    // First check if the user has a signature
    $.ajax({
        url: '<?= base_url("settings/check_signature") ?>',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.has_signature) {
                // If user has a signature, ask for confirmation
                if (confirm('Are you sure you want to approve this form? Your digital signature will be attached to the checklist report.')) {
                    window.location.href = '<?= base_url("activity/approve_form/") ?>' + formId;
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
</script>

<!-- Optional Custom Scripts -->
<script src="<?php echo base_url('js/off-canvas.js'); ?>"></script>
<script src="<?php echo base_url('js/hoverable-collapse.js'); ?>"></script>
<script src="<?php echo base_url('js/template.js'); ?>"></script>
<script src="<?php echo base_url('js/settings.js'); ?>"></script>
<script src="<?php echo base_url('js/todolist.js'); ?>"></script>

</body>
</html>