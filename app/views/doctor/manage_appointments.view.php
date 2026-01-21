<!doctype html>
<html>
<head>
    <title>Appointments</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/manage_appointments.css">
    
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/doctorPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/doctorPortal/set_status" class="menu-btn">Set Availability</a>
                <a href="<?php echo ROOT ?>/doctorPortal/manage_appointments" class="menu-btn active">Manage Appointments</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/doctorPortal/profile" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <?php if (!empty($data['patient_data'])): ?>
                <h2>Your Appointments</h2>
                <table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['patient_data'] as $pData): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pData['p_nid_no']); ?></td>
                            <td><?php echo htmlspecialchars($pData['p_first_name'] . " " . $pData['p_last_name']); ?></td>
                            <td><?php echo htmlspecialchars($pData['p_gender']); ?></td>
                            <td><?php echo htmlspecialchars($pData['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($pData['appointment_time']); ?></td>
                            <td>
                                <form action="<?php echo ROOT?>/doctorPortal/generate_report" method="GET" id="reportGenForm">
                                    <input type="hidden" name="p_nid_no" value="<?php echo htmlspecialchars($pData['p_nid_no']); ?>">
                                    <button type="submit" class="btn btn-update">Generate Report</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No appointments found.</p>
            <?php endif; ?>
</div>
</body>
</html>