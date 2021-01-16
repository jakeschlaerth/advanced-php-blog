<?php require_once('config.php') ?>
<?php require_once(ROOT_PATH . '/includes/public_functions.php') ?>
<?php include('includes/registration_login.php'); ?>
<?php require_once('includes/head.php') ?>

<title>Register | Jake's Blog</title>
</head>
<div class="container">
    <?php include(ROOT_PATH . '/includes/navbar.php'); ?>
</div>
<hr>
<div class="container">
    <h2>Register an account</h2>
    <div class="reg-form">
        <form action="register.php" method="post">
            <?php include(ROOT_PATH . '/includes/errors.php') ?>
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password1" placeholder="Password">
            <input type="password" name="password2" placeholder="Password confirmation">
            <button class="btn small-btn" type="submit" name="reg">Submit</button>
            <p>
                Already registered? <a href="index.php" class="btn small-btn">Sign in</a>
            </p>
        </form>
    </div>

</div>