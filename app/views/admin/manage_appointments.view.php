<!doctype html>
<html>
<head>
    <title>Appointments - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/manage_doctors.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/adminPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_doctors" class="menu-btn ">Manage Doctors</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_patients" class="menu-btn">Manage Patients</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_appointments" class="menu-btn active">Manage Appointments</a>
                <a href="<?php echo ROOT?>/adminPortal/announcements" class="menu-btn">Announcements</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="#" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <?php if (!empty($data['appointments'])): ?>
                <h2>All Appointments</h2>
                <table>
                    <tr>
                        <th>Patient ID</th>
                        <th>Doctor ID</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Creation Date</th>
                        <th>Action</th>
                    </tr>
                   
                    <?php foreach ($data['appointments'] as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['p_id']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['d_id']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['appointment_time']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['creation_date']); ?></td>
                            <td>
                                <!--                    <button class="btn btn-add">Add</button>-->
                                <button class="btn btn-update">Update</button>
                                <button class="btn btn-delete">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No appointments Found</p>
            <?php endif; ?>
        </div>
    </div>
</div>


</body>
</html>