<!doctype html>
<html>
<head>
    <title>Admin Announcements - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/announcements.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/adminPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_doctors" class="menu-btn">Manage Doctors</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_patients" class="menu-btn">Manage Patients</a>
                <a href="<?php echo ROOT ?>/adminPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
                <a href="<?php echo ROOT?>/adminPortal/announcements" class="menu-btn active">Announcements</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="#" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <h2>Manage Announcements</h2>
            <form method="post" action="<?php echo ROOT ?>/adminPortal/add_announcement">
                <textarea name="announcement_text" placeholder="Enter announcement text..." required></textarea>
                <button type="submit" class="btn btn-add">Add Announcement</button>
            </form>

            <?php if (!empty($data['announcements'])): ?>
                <h3>Existing Announcements</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Announcement Text</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($data['announcements'] as $announcement): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($announcement['id']); ?></td>
                            <td><?php echo htmlspecialchars($announcement['text']); ?></td>
                            <td><?php echo htmlspecialchars($announcement['created_at']); ?></td>
                            <td>
                                <form method="GET" action="<?php echo ROOT ?>/adminPortal/delete_announcement" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($announcement['id']); ?>">
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No announcements found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>