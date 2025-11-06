<?php
require('common/auth.php');
$page_title = "Dashboard - School Management System";
require_once 'common/header.php';

?>

<!-- Styles -->
<style>
    body {
        background-color: #fff;
        font-family: 'Arial', sans-serif;
    }

    .hero {
        background: linear-gradient(135deg, #7D53F3, #5c3cd4);
        border-radius: 20px;
        color: #fff;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(125, 83, 243, 0.3);
        text-align: center;
    }

    .hero h3 {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .hero p {
        margin: 0;
    }

    .stat-card {
        background: #fff;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        border-top: 4px solid #7D53F3;
        transition: transform 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-card h3 {
        margin-bottom: 0.5rem;
        font-weight: 700;
        color: #7D53F3;
    }

    .stat-card p {
        font-weight: 500;
        color: #6c757d;
    }

    .table-section {
        background: #fff;
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        border-left: 4px solid #7D53F3;
        margin-bottom: 1.5rem;
    }

    .table-section h5 {
        font-weight: 700;
        color: #7D53F3;
        margin-bottom: 1rem;
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table th {
        color: #7D53F3;
        font-weight: 600;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-outline-primary {
        color: #7D53F3;
        border-color: #7D53F3;
    }

    .btn-outline-primary:hover {
        background-color: #7D53F3;
        color: #fff;
    }

    .avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #7D53F3;
    }

    /* Right Sidebar */
    .right-sidebar {
        padding-left: 1rem;
    }

    .right-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .right-card .avatar {
        width: 80px;
        height: 80px;
        border-width: 3px;
    }

    .right-card .stats-chart {
        height: 120px !important;
        margin-top: 1rem;
    }
</style>

<div class="container-fluid p-4">
    <div class="row">
        <!-- Left Content -->
        <div class="col-lg-8">
            <!-- Hero -->
            <div class="hero">
                <h3><i class="fa-solid fa-school me-2"></i><span data-translate="welcome"> Welcome to School Management Dashboard</span></h3>
                <p class="mb-0" data-translate="subWelcome">Manage students, teachers, and fees efficiently.</p>
            </div>

            <!-- Quick Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fa-solid fa-user-graduate fa-2x mb-2" style="color:#7D53F3;"></i>
                        <h3 id="showStudentCounts">1,250</h3>
                        <p data-translate="students">Students</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fa-solid fa-chalkboard-teacher fa-2x mb-2" style="color:#7D53F3;"></i>
                        <h3 id="showTeachersCounts">85</h3>
                        <p data-translate="teachers">Teachers</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fa-solid fa-money-bill-wave fa-2x mb-2" style="color:#7D53F3;"></i>
                        <h3 id="feesPaid">95%</h3>
                        <p data-translate="paidFees">Fees Paid</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fa-solid fa-calendar-check fa-2x mb-2" style="color:#7D53F3;"></i>
                        <h3 id="classes">32</h3>
                        <p data-translate="ActiveClasses">Active Classes</p>
                    </div>
                </div>
            </div>

            <!-- Recent Students -->
            <div class="table-section">
                <h5><i class="fa-solid fa-users me-2"></i> <span data-translate="ResentStudents">Recent Students</span></h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th><i class="fa-solid fa-id-card-clip me-1"></i> <span data-translate="student-id">Student ID</span></th>
                                <th><i class="fa-solid fa-user me-1"></i> <span data-translate="name">Name</span></th>
                                <th><i class="fa-solid fa-school me-1"></i> <span data-translate="class">Class</span></th>
                                <th><i class="fa-solid fa-map-location-dot me-1"></i> <span data-translate="action">Action</span></th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Teachers -->
            <div class="table-section">
                <h5><i class="fa-solid fa-chalkboard-user me-2"></i> <span data-translate="ResentTeachers">Recent Teachers</span></h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th><i class="fa-solid fa-id-card-clip me-1"></i> <span data-translate="teacher-id">Teacher ID</span></th>
                                <th><i class="fa-solid fa-user me-1"></i> <span data-translate="name">Name</span></th>
                                <th><i class="fa-solid fa-book me-1"></i> <span data-translate="subject">Subject</span></th>
                                <th><i class="fa-solid fa-map-location-dot me-1"></i> <span data-translate="action">Action</span></th>
                            </tr>
                        </thead>
                        <tbody id="teachersTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Fees -->
            <div class="table-section">
                <h5><i class="fa-solid fa-money-bill-1-wave me-2"></i><span data-translate="ResentFees">Recent Fees</span></h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th><i class="fa-solid fa-id-card-clip me-1"></i> <span data-translate="student-id">Student ID</span></th>
                                <th><i class="fa-solid fa-user me-1"></i> <span data-translate="name">Name</span></th>
                                <th><i class="fa-solid fa-money-bill me-1"></i> <span data-translate="amount">Amount</span></th>
                                <th><i class="fa-solid fa-calendar-day me-1"></i> <span data-translate="date">Date</span></th>
                                <th><i class="fa-solid fa-map-location-dot me-1"></i> <span data-translate="action">Action</span></th>
                            </tr>
                        </thead>
                        <tbody id="fees">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4 right-sidebar">
            <!-- Statistic Card -->
            <div class="right-card text-center position-relative">
                <img src="assets/img/user3.png" alt="Admin" class="avatar mb-2">
                <span class="badge bg-warning rounded-pill position-absolute top-0 end-0 mt-2 me-2">50%</span>
                <h6 class="fw-bold mb-1" data-translate="adminGreet">Good Morning, Jason 🔥</h6>
                <small class="text-muted" data-translate="adminWork">Continue your job to achieve your target!</small>
                <div class="stats-chart mt-3">
                    <canvas id="rightChart" height="120"></canvas>
                </div>
            </div>

            <!-- School Leadership Card -->
            <div class="right-card">
                <h6 class="fw-bold mb-3" style="color:#7D53F3;"><i class="fa-solid fa-users-gear me-2"></i> <span data-translate="schoolLeaderShip">School Leadership</span></h6>
                <div class="d-flex align-items-center mb-3">
                    <img src="assets/img/user22.png" alt="Principal" class="avatar me-3">
                    <div class="flex-grow-1">
                        <h6 class="mb-0" data-translate="name1">Padhang Satrio</h6>
                        <small class="text-muted" data-translate="pranciple">Principal</small>
                    </div>
                    <button class="btn btn-outline-primary rounded-pill" data-translate="follow">Follow</button>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <img src="assets/img/user1.png" alt="Headmaster" class="avatar me-3">
                    <div class="flex-grow-1">
                        <h6 class="mb-0" data-translate="name2">Zakir Horizontal</h6>
                        <small class="text-muted" data-translate="headMaster">Headmaster</small>
                    </div>
                    <button class="btn btn-outline-primary rounded-pill" data-translate="follow">Follow</button>
                </div>
                <div class="d-flex align-items-center">
                    <img src="assets/img/user2.png" alt="Vice Principal" class="avatar me-3">
                    <div class="flex-grow-1">
                        <h6 class="mb-0" data-translate="name3">Leonardo Samsul</h6>
                        <small class="text-muted" data-translate="assistance">Vice Principal</small>
                    </div>
                    <button class="btn btn-outline-primary rounded-pill" data-translate="follow">Follow</button>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-purpal rounded-pill px-4 py-2" data-translate="seeAll">See All</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="js/dashboard.js"></script>
<script src="js/chart.umd.min.js"></script>
<script>
    const ctx2 = document.getElementById('rightChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['1-10 Aug', '11-20 Aug', '21-30 Aug'],
            datasets: [{
                label: 'Progress',
                data: [20, 40, 50],
                backgroundColor: '#7D53F3',

                borderRadius: 8
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<?php require_once 'common/footer.php'; ?>