<!doctype html>
<html lang="en">
<head>
    <title>Lab Test</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/labtest_view.css">
    <script src="<?php echo ROOT ?>/assets/js/LabTest.js" defer></script>
</head>
<body>
    <?php require_once  'C:\xampp\htdocs\telemedicine-system-\app\views\components\navbar.php'; ?>

    <h1>Welcome to Telemedicine++</h1>
    <h1>Bokk your lab tests:</h1>
    <p>Search and Select to take a test:</p>
    

    <div class="labContainer">

        <input type="text"
        id="searchTest"
        class="search-bar"
        placeholder="Search lab test">

        <div id="testList" class="test_list"></div>
    </div>


    <?php require_once  'C:\xampp\htdocs\telemedicine-system-\app\views\components\footer.php'; ?>
</body>
</html>