<!doctype html>
<html>
<head>
    <title>Doctors - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/manage_patients.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/adminPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_doctors" class="menu-btn ">Manage Doctors</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_patients" class="menu-btn active">Manage Patients</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
                <a href="<?php echo ROOT?>/adminPortal/announcements" class="menu-btn">Announcements</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="#" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <?php if (!empty($data['patients'])): ?>
                <h2>All Patients</h2>
                <table>
                    <tr>
                        <th>NID No</th>
                        <th>Name</th>
                        <th>Birth-Date</th>
                        <th>Gender</th>
                        <th>Sensory Disabled</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Blood Group</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['patients'] as $patient): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($patient['p_nid_no']); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_first_name'] . " " . $patient['p_last_name']); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_birth_date']); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_gender']); ?></td>
                            <td><?php echo htmlspecialchars($patient['is_sensory_disabled'] ? 'Yes' : 'No'); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_email']); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_phone_no']); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_address']); ?></td>
                            <td><?php echo htmlspecialchars($patient['p_blood_group']); ?></td>
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