<!doctype html>
<html>
<head>
    <title>Admin Dashboard - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/dashboard.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/admin" class="menu-btn active">Dashboard</a>
                <a href="<?php echo ROOT ?>/admin/manage_doctors" class="menu-btn">Manage Doctors</a>
                <a href="<?php echo ROOT ?>/admin/manage_patients" class="menu-btn">Manage Patients</a>
                <a href="#" class="menu-btn">Announcements</a>
            </div>
            <div class="bottom">
                <a href="#" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <div class="dashboard-cards">
                <!-- Doctors Card -->
                <div class="dashboard-card">
                    <h3>Total Doctors</h3>
                    <div class="count">
                        <?php echo htmlspecialchars($data['doctors_count'] ?? 0); ?>
                    </div>
                    <a href="<?php echo ROOT ?>/admin/manage_doctors" class="btn btn-primary">View All Doctors</a>
                </div>

                <!-- Patients Card -->
                <div class="dashboard-card">
                    <h3>Total Patients</h3>
                    <div class="count"><?php echo htmlspecialchars($data['patients_count'] ?? 0); ?>
                    </div>
                    <a href="<?php echo ROOT ?>/admin/manage_patients" class="btn btn-primary">View All Patients</a>
                </div>

                <!-- Appointments Card -->
                <div class="dashboard-card">
                    <h3>Appointments Today</h3>
                    <div class="count">0</div>
                    <a href="<?php echo ROOT ?>/admin/appointments" class="btn btn-primary">View Appointments</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>