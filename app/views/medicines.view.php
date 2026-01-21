<!doctype html>
<html lang="en">
<head>
    <title>Medicine</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/medicine_view.css">
    <script src="<?php echo ROOT ?>/assets/js/medicine.js"></script>
</head>
<body>
    <?php require_once  'C:\xampp\htdocs\telemedicine-system-\app\views\components\navbar.php'; ?>

    <h1>Welcome to Telemedicine++</h1>
    <p>Buy medicines from our online shop</p>

    <section  class="medicine">
        <div class="container">
                <h2>Pick yout medcines:</h2>
                <input type="text"
                        id="searchMedicine"
                        class="search-bar" 
                        placeholder="search with medicine name example: napa">

                <div id="medicineList">

                </div>

                <div class="total">
                        <p>Total = tK <span id="totalPrice">0</span></p>
                </div>
                <button class="add_to_cart">Add to Cart</button>

                <div id="purchasedSummary">

                </div>
        </div>
    </section>
    <?php require_once  'C:\xampp\htdocs\telemedicine-system-\app\views\components\footer.php'; ?>
</body>
</html>