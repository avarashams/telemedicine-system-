<?php
?>
<!doctype html>
<html>
<head>
    <title>Update Doctor</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/admin/add_doctor.css">
</head>
<body>
<div class="container">
    <div class="two-columns">
        <div class="menu">
            <div class="top">
                <a href="<?php echo ROOT ?>/doctorPortal" class="menu-btn ">Dashboard</a>
                <a href="<?php echo ROOT ?>/doctorPortal/set_status" class="menu-btn">Set Availability</a>
                <a href="<?php echo ROOT ?>/doctorPortal/manage_appointments" class="menu-btn">Manage Appointments</a>
            </div>
            <div class="bottom">
                <a href="<?php echo ROOT ?>/" class="menu-btn">Website</a>
                <a href="<?php echo ROOT ?>/doctorPortal/profile" class="menu-btn active">Profile</a>
                <a href="<?php echo ROOT ?>/logout" class="menu-btn">Log Out</a>
            </div>
        </div>
        <div class="content">
            <div id="doctor-form" class="form-container">
                <h2>Edit Profile</h2>
                <form method="POST" action="<?php echo ROOT ?>/doctorPortal/profile" id="d_Form">
                    <div class="form-group">
                        <label for="d_reg_no">Registration number (BMDC)
                            <input style="background: #D5D5D5;" type="text" name="d_reg_no" placeholder="16 digit number" value="<?php echo $data['d_reg_no'] ?? '';?>" readonly>
                        </label>
                        <span class="errors" id="d_reg_no_error"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="d_first_name">First Name
                                <input type="text" placeholder="starts with Capital" name="d_first_name" value="<?php echo $data['d_first_name'] ?? '';?>">
                            </label>
                            <span class="errors" id="d_first_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="d_last_name">Last Name
                                <input type="text" placeholder="starts with Capital" name="d_last_name" value="<?php echo $data ['d_last_name'] ?? '';?>">
                            </label>
                            <span class="errors" id="d_last_name_error"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="d_title">Title</label>
                            <input type="text" placeholder="e.g., Dr., Prof., etc." name="d_title" value="<?php echo $data ['d_title'] ?? '';?>">
                            <span class="errors" id="d_title_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="d_birth_date">Birthday</label>
                            <div class="input-wrapper">
                                <input type="date" placeholder="Birthday" name="d_birth_date" value="<?php echo $data ['d_birth_date'] ?? '';?>">
                                <span class="errors" id="d_birth_date_error"></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group">
                            <label for="d_specialty">Specialty/Department</label>
                            <select id="specialty" name="d_specialty" >
                                <option value="Select"  <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Select") echo "selected"; ?> >Select</option>
                                <option value="Cardiology" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Cardiology") echo "selected"; ?> >Cardiology</option>
                                <option value="Dermatology" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Dermatology") echo "selected"; ?> >Dermatology</option>
                                <option value="Neurology" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Neurology") echo "selected"; ?> >Neurology</option>
                                <option value="Pediatrics" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Pediatrics") echo "selected"; ?> >Pediatrics</option>
                                <option value="Psychiatry" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Psychiatry") echo "selected"; ?> >Psychiatry</option>
                                <option value="Radiology" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Radiology") echo "selected"; ?> >Radiology</option>
                                <option value="Surgery" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Surgery") echo "selected"; ?> >Surgery</option>
                                <option value="Other" <?php if(isset($data['d_specialty']) && $data['d_specialty'] === "Other") echo "selected"; ?> >Other</option>
                            </select>
                            <span class="errors" id="d_specialty_error"></span>
                        </div>
                        <div class="form-group">

                            <span>Gender:</span>
                            <div class="radio-group">
                                <label for="male">Male
                                    <input type="radio" id="male" name="d_gender" value="Male" <?php if (isset($data['d_gender']) && $data['d_gender'] === 'Male') echo ' checked'; ;?>>
                                </label>
                            </div>
                            <div class="radio-group">
                                <label for="female">Female
                                    <input type="radio" id="female" name="d_gender" value="Female" <?php if (isset($data['d_gender']) && $data['d_gender'] === 'Female') echo ' checked'; ;?>>
                                </label>
                            </div>

                            <span class="errors" id="d_gender_error"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="d_email">Email</label>
                            <div class="input-wrapper">
                                <input type="email" placeholder="example@gmail.com" name="d_email" value="<?php echo $data ['d_email'] ?? '';?>">
                            </div>
                            <span class="errors" id="d_email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="d_phone_no">Phone number</label>
                            <div class="phone-row">
                                <span class="country-code">+880</span>
                                <input type="text" class="phone-input" placeholder="xxxxxxxxxx" name="d_phone_no" value="<?php echo $data ['d_phone_no'] ?? '';?>">
                            </div>
                            <span class="errors" id="d_phone_no_error"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="d_avail_from">Available from</label>
                            <input type="date" name="d_avail_from" value="<?php echo $data ['d_avail_from'] ?? '';?>">
                            <span class="errors" id="d_avail_from_error"></span>

                            <label for="d_avail_to">Available to</label>
                            <input type="date" name="d_avail_to" value="<?php echo $data ['d_avail_to'] ?? '';?>">
                            <span class="errors" id="d_avail_to_error"></span>
                        </div>
                        <div class="form-group">
                            <span>Availability Status</span>
                            <div class="radio-group">
                                <label for="online">Online
                                    <input type="radio" id="online" name="d_avail_status" value="Online" <?= (isset($data['d_avail_status']) && $data['d_avail_status'] === 'Online') ? ' checked' : '';?>>
                                </label>
                            </div>
                            <div class="radio-group">
                                <label for="offline">Offline
                                    <input type="radio" id="offline" name="d_avail_status" value="Offline" <?= (isset($data['d_avail_status']) && $data['d_avail_status'] === 'Offline') ? ' checked' : '';?>>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="d_fee">Consultation Fee (in BDT)</label>
                            <input type="text" placeholder="" name="d_fee" min="0" value="<?php echo $data ['d_fee'] ?? '';?>">
                            <span class="errors" id="d_fee_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="d_rating">Rating (out of 5)</label>
                            <input type="text" placeholder="Maximum 5" name="d_rating" min="0" max="5" value="<?php echo $data ['d_rating'] ?? '';?>">
                            <span class="errors" id="d_rating_error"></span>
                        </div>
                    </div>


                    <div class="info-text">
                        <div>
                            <img src="<?php echo ROOT ;?>/assets/images/logos/info-circle.svg" alt="info-circle"
                                 width="12"
                                 height="12">
                            <span>The phone number is only visible to you</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="d_password">Password</label>
                        <div class="input-wrapper">
                            <input type="password" placeholder="Create a password" name="d_password" value="<?php echo $data ['d_password'] ?? '';?>">
                            <span class="input-icon eye-icon">👁</span>
                        </div>
                        <span class="errors" id="d_password_error"></span>
                        <div class="password-requirements">
                            <div>8+ characters</div>
                            <div>at least one uppercase letter</div>
                            <div>at least one lowercase letter</div>
                            <div>include a number</div>
                            <div>include special symbols.</div>
                        </div>
                    </div>

                    <button type="submit" class="confirm-button" id="submit-doctor">Confirm</button>
                    <a href="<?php echo ROOT?>/doctorPortal/manage_doctors" class="back-btn">
                        <img src="<?php echo ROOT ?>/assets/images/logos/arrow-left.svg" alt="arrow-left" width="40"
                             height="40">
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var ROOT = "<?= ROOT ?>";
    var d_reg_no_existing = "<?php echo $_GET['d_reg_no'] ?? '';?>";
</script>
<script src="<?php echo ROOT ?>/assets/js/doctor-profile.js"></script>
</body>
</html>

