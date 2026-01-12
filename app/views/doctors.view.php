<!doctype html>
<html>
<head>
    <title>Telemedicine++ Doctors</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/doctors.css">
</head>
<body>
<?php require_once 'C:\xampp\htdocs\telemedicine-system-\app\views\components\navbar.php'; ?>

<div class="container">
    <div class="grid-container">
        <div class="sidebar">
            <h5>Filter</h5>
            <hr>
            <h6 class="text-info">Select Specialty</h6>
            <ul class="list-group">

                <li class="list-group-item">
                    <div class="form-check">
                        <label for="" class="form-check-label">
                            <?php if (!empty($specialties)): ?>
                                <?php foreach ($specialties as $specialty): ?>
                                    <input type="checkbox" class="form-check-input doctor_check"
                                           value="<?php echo htmlspecialchars($specialty['d_specialty']); ?>"
                                           id="specialty"><?php echo htmlspecialchars($specialty['d_specialty']); ?> <br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                No specialties found.
                            <?php endif; ?>
                        </label>
                    </div>
                </li>
            </ul>

            <h6 class="text-info">Select Gender</h6>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-check">
                        <label for="" class="form-check-label">
                            <?php if (!empty($genders)): ?>
                                <?php foreach ($genders as $gender): ?>
                                    <input type="checkbox" class="form-check-input doctor_check"
                                           value="<?php echo htmlspecialchars($gender['d_gender']); ?>"
                                           id="gender"><?php echo htmlspecialchars($gender['d_gender']); ?>
                                    <br>
                                <?php endforeach; ?>
                            <?php else: ?>
                                No Gender Found
                            <?php endif; ?>
                        </label>
                    </div>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <!--            <h5 class="text-center" id="textChange">All Doctors</h5>-->

            <hr>
            <div class="text-center">
                <p style="display: none;" id="loader">Loading...</p>
            </div>


            <div class="cards-grid" id="result">
                <?php if (!empty($all_doctors)) { ?>
                <?php foreach ($all_doctors

                as $doctor): ?>
                <div class="card-item mb-2">
                    <div class="card-deck">
                        <div class="card border-secondary">
                            <?php if ($doctor['d_avail_status'] == 'Offline') { ?>
                                <p class="card-top offline"><?php echo htmlspecialchars($doctor['d_avail_status']); ?></p>
                            <?php } else { ?>
                                <p class="card-top online"><?php echo htmlspecialchars($doctor['d_avail_status']); ?></p>
                            <?php } ?>
                            <div class="card-img-overlay">
                            </div>
                            <div class="card-body">

                                <h4 class="card-title">

                                    <?php echo htmlspecialchars($doctor['d_first_name'] . " " . $doctor['d_last_name']); ?>

                                </h4>
                                <p><?php echo htmlspecialchars($doctor['d_title']); ?></p>
                                <br>
                                <p>
                                    <?php if ($doctor['d_gender'] == "Female") { ?>
                                <div class="icon-text">
                                    <img src="<?php echo ROOT ?>/assets/images/logos/gender-female.svg">
                                    <p>Female</p>
                                </div>

                                <?php } else { ?>
                                    <div class="icon-text">
                                        <img src="<?php echo ROOT ?>/assets/images/logos/gender-female.svg">
                                        <p>Male</p>
                                    </div>
                                <?php } ?>
                                <!--                                    --><?php //echo htmlspecialchars($doctor->d_gender); ?>

                                <div class="icon-text">
                                    <img src="<?php echo ROOT ?>/assets/images/logos/cash-stack.svg" alt="cash icon">
                                    <p><?php echo htmlspecialchars("Consultation Fee: $" . $doctor['d_fee']); ?></p>

                                </div>
                                <div class="icon-text">
                                    <img src="<?php echo ROOT ?>/assets/images/logos/journal-plus.svg"
                                         alt="journal icon">
                                    <p><?php echo htmlspecialchars("Specialty: " . $doctor['d_specialty']); ?></p>
                                </div>
                                <div class="icon-text">
                                    <!--                                    availabilty-->
                                    <img src="<?php echo ROOT ?>/assets/images/logos/clock-fill.svg" alt="clock icon">
                                    <p><?php echo htmlspecialchars("Available from " . $doctor['d_avail_from'] . " to " . $doctor['d_avail_to']); ?></p>
                                </div>
                                <div class="icon-text">
                                    <img src="<?php echo ROOT ?>/assets/images/logos/envelope-at-fill.svg"
                                         alt="email icon">
                                    <?php echo htmlspecialchars("Email address: " . $doctor['d_email']); ?>
                                </div>


                                <a href="<?php echo ROOT ?>/doctors/<?php echo htmlspecialchars($doctor['id']); ?>"
                                   class="btn btn-primary">Book Appointment</a>

                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!--                            pagination button-->
                    <div class="pagination">
                        <?php if (!isset($_GET['page'])) {
                            $_GET['page'] = 1;
                        } ?>
                        <?php if ($_GET['page'] > 1) { ?>
                            <a href="<?= ROOT ?>/doctors?page=<?= $_GET['page'] - 1 ?>" class="btn btn-secondary">
                                Previous
                            </a>
                        <?php } ?>

                        <?php if ($_GET['page'] < 10) { ?>
                            <a href="<?= ROOT ?>/doctors?page=<?= $_GET['page'] + 1 ?>" class="btn btn-secondary">
                                Next
                            </a>
                        <?php } ?>

                    </div>
                    <?php } else { ?>
                        No Doctors Found
                        <div class="pagination">
                            <?php if ($_GET['page'] > 1) { ?>
                                <a href="<?= ROOT ?>/doctors?page=<?= $_GET['page'] - 1 ?>" class="btn btn-secondary">
                                    Previous
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<?php require_once 'C:\xampp\htdocs\telemedicine-system-\app\views\components\footer.php' ?>
</body>

</html>