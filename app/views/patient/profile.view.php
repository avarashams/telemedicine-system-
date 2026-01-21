<!doctype html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctor/profile.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/patientPortal" class="menu-btn">Dashboard</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_medicines" class="menu-btn">Manage Medicines</a>
                <a href="<?php echo ROOT ?>/patientPortal/manage_lab_tests" class="menu-btn">Lab Tests</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/patientPortal/profile" class="menu-btn active">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <div id="patient-form" class="form-container">
                <h1>Patient's Information</h1>
                <form method="POST" action="<?php echo ROOT ?>/patientPortal/profile" id="p_Form">
                    <div class="form-group">
                        <label>NID number</label>
                        <input type="text" style="background: #D5D5D5;" placeholder="12 or 16 digit number" name="p_nid_no" value="<?php echo $data['p_nid_no'] ?? '';?>" readonly>
                        <span class="errors" id="p_nid_no_error"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name
                                <input type="text" placeholder="starts with Capital " name="p_first_name">
                            </label>
                            <span class="errors" id="p_first_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name
                                <input type="text" placeholder="starts with Capital" name="p_last_name">
                            </label>
                            <span class="errors" id="p_last_name_error"></span>
                        </div>
                    </div>

                    <div class="birthday-gender-row">
                        <div class="birthday-field">
                            <label for="p_birth_date">Birthday</label>
                            <div class="input-wrapper">
                                <input type="date" placeholder="Birthday" name="p_birth_date">
                                <span class="errors" id="p_birth_date_error"></span>
                            </div>
                        </div>
                        <div class="gender-field">
                            <div class="gender-options">
                                <span class="gender-label">Gender:</span>
                                <div class="radio-group">
                                    <input type="radio" id="male" name="p_gender" value="Male">
                                    <label for="male">Male</label>
                                </div>
                                <div class="radio-group">
                                    <input type="radio" id="female" name="p_gender" value="Female">
                                    <label for="female">Female</label>
                                </div>
                            </div>
                            <span class="errors" id="p_gender_error"></span>
                        </div>
                    </div>

                    <div class="sensory-field">
                        <div class="sensory-options">
                            <span class="sensory-label">Sensory Disabilities?</span>
                            <div class="radio-group">
                                <input type="radio" id="yes" name="is_sensory_disabled" value="Yes">
                                <label for="yes">Yes</label>
                            </div>
                            <div class="radio-group">
                                <input type="radio" id="no" name="is_sensory_disabled" value="No">
                                <label for="no">No</label>
                            </div>
                        </div>
                        <span class="errors" id="is_sensory_disabled_error"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Blood Group</label>
                            <select id="blood-group" name="p_blood_group">
                                <option value="Select">Select</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <span class="errors" id="p_blood_group_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="p_address">Address</label>
                            <input type="text" placeholder="Your address" name="p_address">
                            <span class="errors" id="p_address_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="p_email">Email</label>
                            <div class="input-wrapper">
                                <input type="email" placeholder="example@gmail.com" name="p_email">
                            </div>
                            <span class="errors" id="p_email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="p_phone_no">Phone number</label>
                            <div class="phone-row">
                                <span class="country-code">+880</span>
                                <input type="tel" class="phone-input" placeholder="xxxxxxxxxx" name="p_phone_no">
                            </div>
                            <span class="errors" id="p_phone_no_error"></span>
                        </div>
                    </div>

                    <div class="info-text">
                        <div>
                            <img src="<?php echo ROOT ?>/assets/images/logos/info-circle.svg" alt="info-circle" width="12"
                                 height="12">
                            <span>The phone number is only visible to you</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="p_password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" value="" placeholder="Create a password" name="p_password">
                            <span class="input-icon eye-icon">👁</span>
                        </div>
                        <span class="errors" id="p_password_error"></span>
                        <div class="password-requirements">
                            <div>8+ characters</div>
                            <div>at least one uppercase letter</div>
                            <div>at least one lowercase letter</div>
                            <div>include a number</div>
                            <div>include special symbols.</div>
                        </div>
                    </div>

                    <button type="submit" class="confirm-button">Confirm</button>
                    <a href="<?php echo ROOT?>/" class="back-btn"><img src="<?php echo ROOT ?>/assets/images/logos/arrow-left.svg"
                                                                       alt="arrow-left" width="40" height="40"></a>
                </form>
            </div>
        </div>

        <script src="<?php echo ROOT ?>/assets/js/patient-profile.js"></script>

</body>
</html>