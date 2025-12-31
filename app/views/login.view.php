<!doctype html>
<html>
<head>
    <title>Telemedicine++ Login</title>
    <link rel="stylesheet" href="<?php echo ROOT ?>/assets/css/login.css">
<body>
<header>
    <div class="logo">
        <img src="<?php echo ROOT ?>/assets/images//logos/T-shaped.png" alt="Telemedicine++ Logo" width="100"
             height="100">
        <div class="tele-name">Telemedicine++</div>
    </div>
</header>

<div class="container">
    <div class="login-box">
        <div class="login-card">
            <div class="login-header">
                <h1>Log In</h1>
                <img src="<?php echo ROOT ?>/assets/images/logos/box-arrow-in-right.svg" alt="User Icon" width="100"
                     height="100">
            </div>

            <form action="" method="POST">
                <?php if (!empty($errors)) { ?>
                    <div class="errors">
                        <?php echo implode("<br>", $errors); ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <input type="submit" value="Log In" class="login-button">
                <div class="form-row">
                    <div>
                        <label for="remember-me">
                            Remember Me
                        </label>
                        <input type="checkbox" name="remember-me" id="remember-me">
                    </div>
                </div>

                <div class="register-link">
                    <a href="<?php echo ROOT ?>/Signup">Not yet Registered?</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</head>
</html>