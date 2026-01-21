<!doctype html>
<html>
<head>
    <title>Availability</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/set_status.css">

</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/doctorPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/doctorPortal/set_status" class="menu-btn active">Set Availability</a>
                <a href="<?php echo ROOT ?>/doctorPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/doctorPortal/profile" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <h2>Set Your Availability Status</h2>
            <form method="post" action="<?php echo ROOT ?>/doctorPortal/set_status">
                <div class="form-group">
                    
                <label for="d_avail_status">Availability Status:</label>
                <select id="d_avail_status" name="d_avail_status" required>
                    <option value="Online" <?php echo ($data['d_avail_status'] === 'online') ? 'selected' : ''; ?>>Online</option>
                    <option value="Offline" <?php echo ($data['d_avail_status'] === 'Offline') ? 'selected' : ''; ?>>Offline</option>
                </select>
                </div>
                <div class="form-group">
                    
                <label for="d_avail_from" >Available From:</label>
                <input type="date" id="d_avail_from" name="d_avail_from" value="<?php echo htmlspecialchars($data['d_avail_from']); ?>" required>
                <br><br>
                <label for="d_avail_to" >Available To:</label>
                <input type="date" id="d_avail_to" name="d_avail_to" value="<?php echo htmlspecialchars($data['d_avail_to']); ?>" required>
                </div>
                <br><br>
                <button class="btn btn-update" type="submit">Update Status</button>
            </form>
            <?php if (!empty($data['message'])): ?>
                <p><?php echo htmlspecialchars($data['message']); ?></p>
            <?php endif; ?>
        </div>
</body>
</html>