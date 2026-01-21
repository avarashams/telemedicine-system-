<!doctype html>
<html>
<head>
    <title>Appointments with Doctors</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/manage_appointments.css">

</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/patientPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_appointments" class="menu-btn active">Manage Appointments</a>
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
            <?php if (!empty($data['doctor_data'])): ?>
                <h2>Your Appointments</h2>
                <table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Doctor Name</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Availability Status</th>
                    </tr>
                    <?php foreach ($data['doctor_data'] as $pData): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pData['id']); ?></td>
                            <td><?php echo htmlspecialchars($pData['d_title'] . " ". $pData['d_first_name'] . " " . $pData['d_last_name']); ?></td>
                            <td><?php echo htmlspecialchars($pData['d_gender']); ?></td>
                            <td><?php echo htmlspecialchars($pData['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($pData['appointment_time']); ?></td>
                            <td><?php echo htmlspecialchars($pData['d_avail_status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No appointments found.</p>
            <?php endif; ?>
        </div>
</body>
</html>