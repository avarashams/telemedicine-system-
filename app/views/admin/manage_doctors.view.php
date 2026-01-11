<!doctype html>
<html>
<head>
    <title>Doctors - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/manage_doctors.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/admin" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/admin/manage_doctors" class="menu-btn active">Manage Doctors</a>
                <a href="<?php echo ROOT ?>/admin/manage_patients" class="menu-btn">Manage Patients</a>
                <a href="#" class="menu-btn">Announcements</a>
            </div>
            <div class="bottom">
                <a href="#" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <?php if (!empty($data['doctors'])): ?>
                <h2>All Doctors</h2>
                <table>
                    <tr>
                        <th>Registration No (BMDC)</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Birth-Date</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Phone Number</th>
                        <th>Availability</th>
                        <th>Consultation Fee</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['doctors'] as $doctor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($doctor['d_reg_no']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_first_name'] . " " . $doctor['d_last_name']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_title']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_birth_date']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_gender']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_email']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_specialty']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_phone_no']); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_avail_from'] . " to " . $doctor['d_avail_to'] . " (" . $doctor['d_avail_status'] . ")"); ?></td>
                            <td><?php echo htmlspecialchars($doctor['d_fee']); ?></td>
                            <td>
                                <!--                    <button class="btn btn-add">Add</button>-->
                                <button class="btn btn-update">Update</button>
                                <button class="btn btn-delete">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No doctors found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>


</body>
</html>