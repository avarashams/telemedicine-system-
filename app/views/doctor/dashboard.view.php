<!doctype html>
<html>
<head>
    <title>DoctorPortal Dashboard - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/dashboard.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/doctorPortal" class="menu-btn active">Dashboard</a>
                <a href="<?php echo ROOT ?>/doctorPortal/set_status" class="menu-btn">Set Availability</a>
                <a href="<?php echo ROOT ?>/doctorPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/doctorPortal/profile" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <?php if (isset($data['announcements'])) {?>
            <div class="marquee">
                <span><?php echo htmlspecialchars($data['announcements'])?></span>
            </div>
            <?php } ?>
            <div class="dashboard-cards">
                <!-- Appointments Card -->
                <div class="dashboard-card">
                    <h3>Appointments Today</h3>
                    <div class="count">
                        <?php echo htmlspecialchars($data['appointments_count'] ?? 0); ?>
                    </div>
                    <a href="<?php echo ROOT ?>/doctorPortal/manage_appointments" class="btn btn-primary">View
                        Appointments</a>
                </div>
                <!--                Show availability Status-->
                <div class="dashboard-card">
                    <h3>Your Availability Status</h3>
                    <div class="count">
                        <?php
                        if (isset($data['d_avail_status']) && $data['d_avail_status'] == 'Online') {
                            echo "Online";
                        } else {
                            echo "Offline";
                        }
                        ?>
                    </div>
                    <a href="<?php echo ROOT ?>/doctorPortal/set_status" class="btn btn-primary">Set Availability</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>