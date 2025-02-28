<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMAR Apps</title>
    <!-- plugins:css -->
  
    <link rel="stylesheet" href="<?php echo base_url('vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/css/vendor.bundle.base.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- endinject -->
  <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/mdi/css/materialdesignicons.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('js/select.dataTables.min.css'); ?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/amar.png'); ?>" />
  <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include APPPATH . 'views\dashboard\navbar.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include 'sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?php echo $user['nama_pegawai']; ?></h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You've login as <?php echo ucfirst($user['role']); ?></h6>
                </div>
                <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <div class="mb-3 d-flex">
                            <!-- Start Date Input -->
                          <div class ="mr-2">
                            <label for="tanggal_start" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_start" name="tanggal_start" required>
                          </div>
                            <!-- End Date Input -->
                          <div>
                            <label for="tanggal_end" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tanggal_end" name="tanggal_end" required>
                          </div>
                          </div>
                    </div>
                </div>
            </div>
          </div>
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Today’s Bookings</p>
                      <p class="fs-30 mb-2">4006</p>
                      <p>10.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Bookings</p>
                      <p class="fs-30 mb-2">61344</p>
                      <p>22.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Meetings</p>
                      <p class="fs-30 mb-2">34040</p>
                      <p>2.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Number of Clients</p>
                      <p class="fs-30 mb-2">47033</p>
                      <p>0.22% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Order Details</p>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Order value</p>
                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Orders</p>
                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Users</p>
                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Downloads</p>
                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div> 
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <div class="d-flex justify-content-between">
                  <p class="card-title">Sales Report</p>
                 </div>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                            <p class="card-title">Detailed Reports</p>
                              <h1 class="text-primary">$34040</h1>
                              <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                              <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                            </div>  
                            </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
                                    <tr>
                                      <td class="text-muted">Illinois</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Washington</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Mississippi</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">California</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Maryland</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Alaska</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">
                                <canvas id="north-america-chart"></canvas>
                                <div id="north-america-legend"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                            <p class="card-title">Detailed Reports</p>
                              <h1 class="text-primary">$34040</h1>
                              <h3 class="font-weight-500 mb-xl-4 text-primary">North America</h3>
                              <p class="mb-2 mb-xl-0">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                            </div>  
                            </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">
                                    <tr>
                                      <td class="text-muted">Illinois</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">713</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Washington</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">583</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Mississippi</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">924</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">California</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">664</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Maryland</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">560</h5></td>
                                    </tr>
                                    <tr>
                                      <td class="text-muted">Alaska</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td><h5 class="font-weight-bold mb-0">793</h5></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 
  <!-- plugins:js -->
  <script src="<?php echo base_url('vendors/js/vendor.bundle.base.js'); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?php echo base_url('vendors/chart.js/Chart.min.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
  <script src="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
  <script src="<?php echo base_url('js/dataTables.select.min.js'); ?>"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo base_url('js/off-canvas.js'); ?>"></script>
  <script src="<?php echo base_url('js/hoverable-collapse.js'); ?>"></script>
  <script src="<?php echo base_url('js/template.js'); ?>"></script>
  <script src="<?php echo base_url('js/settings.js'); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo base_url('js/dashboard.js'); ?>"></script>
  <script src="<?php echo base_url('js/Chart.roundedBarCharts.js'); ?>"></script>
  <!-- End custom js for this page-->
</body>

</html>
