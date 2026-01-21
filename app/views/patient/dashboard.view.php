<!doctype html>
<html>
<head>
    <title>Patient Dashboard - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/dashboard.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/patientPortal" class="menu-btn active">Dashboard</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_medicines" class="menu-btn">Manage Medicines</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_lab_tests" class="menu-btn">Lab Tests</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/patientPortal/profile" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <div class="dashboard-cards">

                <!-- Appointments Card -->
                <div class="dashboard-card">
                    <h3>Appointments Today</h3>
                    <div class="count">
                        <?php echo htmlspecialchars($data['appointments_count'] ?? 0); ?>
                    </div>
                    <a href="<?php echo ROOT ?>/patientPortal/manage_appointments" class="btn btn-primary">View
                        Appointments</a>
                </div>
<!--                Manage Medicine Orders-->
                <div class="dashboard-card">
                    <h3>Manage Medicine Orders</h3>
                    <div class="count">
                        <?php echo htmlspecialchars($data['medicine_orders_count'] ?? 0); ?>
                    </div>
                    <a href="<?php echo ROOT ?>/patientPortal/manage_medicine_orders" class="btn btn-primary">View
                        Orders</a>
                </div>
<!--                Manage Lab tests-->
                <div class="dashboard-card">
                    <h3>Manage Lab Tests</h3>
                    <div class="count">
                        <?php echo htmlspecialchars($data['lab_tests_count'] ?? 0); ?>
                    </div>
                    <a href="<?php echo ROOT ?>/patientPortal/manage_lab_tests" class="btn btn-primary">View
                        Lab Tests</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>