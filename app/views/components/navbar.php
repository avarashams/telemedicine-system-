<link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/navbar.css">
<header>
    <a href="<?php echo ROOT ?>/home"><img src="<?php echo ROOT ?>/assets/images//logos/T-shaped.png"
                                           alt="Telemedicine++ Logo" width="80"
                                           height="80"></a>
    <nav class="header-nav">
        <ul class="navigation">
            <li><a href="<?php echo ROOT ?>/" class="<?php echo is_nav_active('home')?>">Home</a></li>
            <li><a href="<?php echo ROOT ?>/doctors" class="<?php echo is_nav_active('doctors')?>">Doctors</a></li>
            <li><a href="<?php echo ROOT ?>/medicines" class="<?php echo is_nav_active('medicines')?>">Medicines</a></li>
            <li><a href="<?php echo ROOT ?>/lab_tests" class="<?php echo is_nav_active('lab_tests')?>">Lab Tests</a></li>
        </ul>
    </nav>
    <nav>
        <ul class="auth">
            <?php if (isset($_SESSION['id'])){ ?>
            <li><a href="<?php echo ROOT . "/" . $_SESSION['role'] . "/dashboard"?>">Welcome <?php echo $_SESSION['email']?></a></li>
            <li><a href="<?php echo ROOT ?>/logout">Logout</a></li>
            <?php } else {?>
            <li><a href="<?php echo ROOT ?>/login">Login</a></li>
            <li><a href="<?php echo ROOT ?>/signup">Signup</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>