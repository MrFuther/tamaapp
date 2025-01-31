<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMA Apps</title>
    <!-- plugins:css -->
  
    <link rel="stylesheet" href="<?php echo base_url('vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/css/vendor.bundle.base.css'); ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('js/select.dataTables.min.css'); ?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('css/vertical-layout-light/style.css'); ?>">
  <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>" />
    <style>
        .progress-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            margin-bottom: 20px;
        }

        .progress-box .progress-label {
            font-weight: bold;
        }

        .date-range {
            display: flex;
            justify-content: space-between;
        }

        .date-range input {
            width: 45%;
        }
    </style>
</head>
<body>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?php echo base_url('index.html'); ?>"><img src="assets/images/tama-logo.png" class="mr-2" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>

<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <h5 class="navbar-brand mb-0">Hallo, <?php echo $user['username']; ?></h5>
            <span class="badge badge-premium">as <?php echo ucfirst($user['role']); ?></span>

            <!-- Dropdown for Logout -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <?php echo $user['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Progress Box and Date Range -->
    <div class="container mt-4">
        <div class="progress-box">
            <div class="row">
                <div class="col-md-4">
                    <div class="progress-label">Aktual: 1896</div>
                </div>
                <div class="col-md-4">
                    <div class="progress-label">Target: 2500</div>
                </div>
                <div class="col-md-4">
                    <div class="progress-label">Progress: 75.84%</div>
                </div>
            </div>
        </div>

        <!-- Date Range Selector -->
        <div class="date-range mb-4">
            <input type="date" id="startDate" class="form-control" placeholder="Tanggal Mulai">
            <input type="date" id="endDate" class="form-control" placeholder="Tanggal Akhir">
        </div>

        <div class="row">
            <!-- Total Experiments Chart -->
            <div class="col-lg-6">
                <h4>Total Experiments</h4>
                <canvas id="totalExperimentsChart"></canvas> <!-- Canvas for Bar Chart -->
            </div>
            <!-- Average Experiments per Member Chart -->
            <div class="col-lg-6">
                <h4>Average Experiments per Member</h4>
                <canvas id="avgExperimentsChart"></canvas> <!-- Canvas for Line Chart -->
            </div>
        </div>
    </div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/react@17/umd/react.development.js"></script>
<script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js"></script>
<script src="https://cdn.jsdelivr.net/npm/recharts/umd/Recharts.min.js"></script>
<script src="https://unpkg.com/react-spring@8.0.27/web.js"></script>

<script>
    const { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer } = Recharts;
    const { useSpring, animated } = ReactSpring;

    // Data for Line Chart
    const lineChartData = [
        { name: "Nov", revenue: 1000, expectedRevenue: 1200 },
        { name: "Dec", revenue: 1500, expectedRevenue: 1700 },
        { name: "Jan", revenue: 2000, expectedRevenue: 2100 },
        { name: "Feb", revenue: 1700, expectedRevenue: 1800 },
        { name: "Mar", revenue: 1900, expectedRevenue: 2000 },
        { name: "Apr", revenue: 2500, expectedRevenue: 2400 },
        { name: "May", revenue: 2300, expectedRevenue: 2600 },
        { name: "Jun", revenue: 2600, expectedRevenue: 2700 },
        { name: "Jul", revenue: 2800, expectedRevenue: 2900 },
    ];

    // Data for Segmentation
    const segmentationData = [
        { name: "Not Specified", value: 800, color: "#363636" },
        { name: "Male", value: 441, color: "#818bb1" },
        { name: "Female", value: 233, color: "#2c365d" },
        { name: "Other", value: 126, color: "#334ed8" },
    ];

    // Line Chart Component
    function LineChartComponent() {
        return (
            <div style={{ width: "100%", height: 300 }}>
                <ResponsiveContainer>
                    <LineChart data={lineChartData}>
                        <CartesianGrid strokeDasharray="3 3" />
                        <XAxis dataKey="name" />
                        <YAxis />
                        <Tooltip />
                        <Line type="monotone" dataKey="revenue" stroke="#8884d8" activeDot={{ r: 8 }} />
                        <Line type="monotone" dataKey="expectedRevenue" stroke="#82ca9d" strokeDasharray="5 5" />
                    </LineChart>
                </ResponsiveContainer>
            </div>
        );
    }

    // Segmentation Chart Component
    function SegmentationChartComponent() {
        return (
            <div>
                <h5>Segmentation</h5>
                {segmentationData.map((item) => (
                    <div className="d-flex align-items-center mb-3" key={item.name}>
                        <div
                            style={{
                                width: "20px",
                                height: "20px",
                                borderRadius: "50%",
                                backgroundColor: item.color,
                                marginRight: "10px",
                            }}
                        ></div>
                        <div className="flex-grow-1">{item.name}</div>
                        <div>{item.value}</div>
                    </div>
                ))}
            </div>
        );
    }

    // Satisfaction Gauge Component
    function SatisfactionGaugeComponent() {
        const { dashOffset } = useSpring({
            dashOffset: 78.54,
            from: { dashOffset: 785.4 },
        });
        return (
            <div className="text-center">
                <h5>Satisfaction</h5>
                <svg viewBox="0 0 700 380" width="200">
                    <path
                        d="M100 350C100 283.696 126.339 220.107 173.223 173.223C220.107 126.339 283.696 100 350 100C416.304 100 479.893 126.339 526.777 173.223C573.661 220.107 600 283.696 600 350"
                        stroke="#2d2d2d"
                        strokeWidth="40"
                        strokeLinecap="round"
                    />
                    <animated.path
                        d="M100 350C100 283.696 126.339 220.107 173.223 173.223C220.107 126.339 283.696 100 350 100C416.304 100 479.893 126.339 526.777 173.223C573.661 220.107 600 283.696 600 350"
                        stroke="#2f49d0"
                        strokeWidth="40"
                        strokeLinecap="round"
                        strokeDasharray="785.4"
                        strokeDashoffset={dashOffset}
                    />
                </svg>
                <div className="mt-3">
                    <span className="fs-4 fw-bold text-primary">97.78%</span>
                    <p>Based on Likes</p>
                </div>
            </div>
        );
    }

    

    // Render Components
    ReactDOM.render(<LineChartComponent />, document.getElementById("line-chart-root"));
    ReactDOM.render(<SegmentationChartComponent />, document.getElementById("segmentation-chart-root"));
    ReactDOM.render(<SatisfactionGaugeComponent />, document.getElementById("satisfaction-gauge-root"));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi untuk toggle sidebar
    document.getElementById('toggle-sidebar').addEventListener('click', function () {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('collapsed');

        const content = document.querySelector('.content');
        content.classList.toggle('collapsed'); // Update content margin when sidebar is collapsed

        const icon = this.querySelector('i');
        if (sidebar.classList.contains('collapsed')) {
            icon.classList.remove('fa-chevron-left');
            icon.classList.add('fa-chevron-right');
        } else {
            icon.classList.remove('fa-chevron-right');
            icon.classList.add('fa-chevron-left');
        }
    });
</script>
<script>
// Data for Bar Chart (Total Experiments)
const totalExperimentsData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'Total Experiments',
        data: [1896, 2000, 2100, 2300, 2500, 2200, 2400],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }]
};

// Data for Line Chart (Average Experiments per Member)
const avgExperimentsData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
        label: 'Average Experiments per Member',
        data: [65.4, 70.2, 72.1, 75.3, 68.9, 74.6, 72.8],
        fill: false,
        borderColor: 'rgba(75, 192, 192, 1)',
        tension: 0.1
    }]
};

// Create the Bar Chart for Total Experiments
const ctx1 = document.getElementById('totalExperimentsChart').getContext('2d');
const totalExperimentsChart = new Chart(ctx1, {
    type: 'bar',
    data: totalExperimentsData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Create the Line Chart for Average Experiments per Member
const ctx2 = document.getElementById('avgExperimentsChart').getContext('2d');
const avgExperimentsChart = new Chart(ctx2, {
    type: 'line',
    data: avgExperimentsData,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>
</body>
</html>
