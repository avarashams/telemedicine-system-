<?php
?>
<!doctype html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/create_appointment.css">
</head>
<body>
<?php require_once 'C:\xampp\htdocs\telemedicine-system-\app\views\components\navbar.php'; ?>

<div class="container">

    <!-- Left side -->
    <div class="left">
        <div class="logo">
            <img src="<?php echo ROOT ?>/assets/images/logos/appointment-banner.png" alt="Appointment Logo" height="350" width="350">
        </div>
    </div>

    <!-- Right side -->
    <div class="right">
        <?php if (isset($doctor_data)) { ?>
            <h2>Book Appointment</h2>

            <form method="POST">

                <label>Doctor Name</label>
                <input type="text"
                       value="Dr. <?php echo htmlspecialchars($doctor_data['d_first_name'] . ' ' . $doctor_data['d_last_name']); ?>"
                       disabled>

                <label>Specialty</label>
                <input type="text"
                       value="<?php echo htmlspecialchars($doctor_data['d_specialty']); ?>"
                       disabled>

                <label>Rating</label>
                <input type="text"
                       value="<?php echo htmlspecialchars($doctor_data['d_rating']); ?> Star"
                       disabled>

                <label>Email</label>
                <input type="text"
                       value="<?php echo htmlspecialchars($doctor_data['d_email']); ?>"
                       disabled>

                <label>Consultation Fee</label>
                <input type="text"
                       value="<?php echo htmlspecialchars($doctor_data['d_fee']); ?> Taka Only"
                       disabled>

                <div class="two-columns">
                    
                <label for="appointment_date">Appointment Date
                <input type="date"
                       name="appointment_date"
                       min="<?php echo htmlspecialchars($doctor_data['d_avail_from']); ?>"
                       max="<?php echo htmlspecialchars($doctor_data['d_avail_to']); ?>"
                       required>
                </label>

                <label for="appointment_time">Available Time
                <input type="time" id="appointment_time" name="appointment_time" value="<?php echo htmlspecialchars("10:00:00");?>" readonly>
                </label>                 
                </div>
                
                <input type="submit" value="Create Appointment">
            </form>

        <?php } else { ?>
            <h2>Something went wrong!</h2>
        <?php } ?>
    </div>

</div>

<?php //require_once 'C:\xampp\htdocs\telemedicine-system-\app\views\components\footer.php' ?>

</body>
</html>