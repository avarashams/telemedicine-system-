<!doctype html>
<html>
<head>
    <title>Admin Announcements - Telemedicine++</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/generate_report.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/doctorPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/doctorPortal/set_status" class="menu-btn">Set Availability</a>
                <a href="<?php echo ROOT ?>/doctorPortal/manage_appointments" class="menu-btn active">Manage
                    Appointments</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/doctorPortal/profile" class="menu-btn">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <h2>Generate Patient Report</h2>
            <?php if (!empty($data['patient_data'])): ?>
                <h3>Patient Information</h3>
                <form method="POST" action="<?php echo ROOT ?>/doctorPortal/add_report?p_nid_no=<?php echo urlencode($data['patient_data']['p_nid_no']); ?>">
                    <div class="two-columns-info">
                        <div class="left-col">
                            <div class="form-group">
                                <label>NID</label>
                                <input type="text"
                                       value="<?php echo htmlspecialchars($data['patient_data']['p_nid_no']); ?>"
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       value="<?php echo htmlspecialchars(
                                           $data['patient_data']['p_first_name'] . ' ' . $data['patient_data']['p_last_name']
                                       ); ?>"
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label>Age
                                    <input type="text"
                                           value="<?php echo htmlspecialchars($data['patient_data']['age']); ?>"
                                           readonly>
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Gender
                                    <input type="text"
                                           value="<?php echo htmlspecialchars($data['patient_data']['p_gender']); ?>"
                                           readonly>
                                </label>
                            </div>
                        </div>

                        <div class="right-col">
                            <div class="form-group">
                                <label>Blood Group</label>
                                <input type="text"
                                       value="<?php echo htmlspecialchars($data['patient_data']['p_blood_group']); ?>"
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label>Sensory Disability</label>
                                <input type="text"
                                       value="<?php echo htmlspecialchars($data['patient_data']['is_sensory_disabled']); ?>"
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                       value="<?php echo htmlspecialchars($data['patient_data']['p_email']); ?>"
                                       readonly>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text"
                                       value="<?php echo htmlspecialchars($data['patient_data']['p_phone_no']); ?>"
                                       readonly>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="p_address" readonly><?php
                            echo htmlspecialchars($data['patient_data']['p_address']);
                            ?></textarea>
                    </div>

                    <label for="report_content">Report Content:</label><br>
                    <textarea id="report_content" name="report_content" placeholder="Enter your comments here"
                              required></textarea>
                    <button type="submit" class="btn btn-add">Generate Report</button>
                </form>
            <?php else: ?>
                <p>No patient data found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>