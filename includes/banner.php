<!-- if the session variable has a user with a username set -->
<?php if (isset($_SESSION['user']['username'])) { ?>
    <div class="banner">
        <div class="welcome-message-container">
            <span class='welcome-message'>
                Welcome, <?php echo $_SESSION['user']['username'] ?>
            </span>
            <span class='btn small-btn logout-btn'><a href="logout.php">Logout</a></span>
        </div>
    </div>
<?php } else { ?>

    <div class="banner">
        <a href="register.php" class="btn">Register an account</a>
        <div class="login-container">
            <form action="index.php" method="post">
                <?php include(ROOT_PATH . '/includes/errors.php') ?>
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button class="btn small-btn" type="submit" name="home_login">Sign in</button>
            </form>
        </div>
    </div>
<?php } ?>