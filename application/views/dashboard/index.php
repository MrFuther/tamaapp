<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with React Chart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<div class="sidebar d-flex flex-column p-3">
    <!-- Logo Section -->
    <div class="d-flex sidebar-logo">
        <img src="<?php echo base_url('assets/images/tama-logo.png'); ?>" alt="Tama Logo">
        <span class="ms-2 app-name">TAMA App</span>
    </div>
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>" href="<?php echo base_url('dashboard'); ?>">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'activity') ? 'active' : ''; ?>" href="<?php echo base_url('activity'); ?>">
                <i class="fas fa-comments"></i>
                <span>Activity Module</span>
            </a>
        </li>
        <?php if ($user['role'] == 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'report') ? 'active' : ''; ?>" href="<?php echo base_url('report'); ?>">
                <i class="fas fa-file-alt"></i>
                <span>Master Report</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'data') ? 'active' : ''; ?>" href="<?php echo base_url('data'); ?>">
                <i class="fas fa-database"></i>
                <span>Master Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($this->uri->segment(1) == 'm_user') ? 'active' : ''; ?>" href="<?php echo base_url('m_user'); ?>">
                <i class="fas fa-users"></i>
                <span>Manage User</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
    <button class="btn btn-outline-secondary mt-auto" id="toggle-sidebar">
        <i class="fas fa-chevron-left"></i>
    </button>
</div>

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
