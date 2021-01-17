<?php
// declare vars
$username = "";
$email = "";
// array for errors to be pushed to
// if the array is not empty, it will be rendered on the page
// showing what errors the user committed, eg no username, passwords don't match, etc
$errors = array();

// register user
if (isset($_POST['reg'])) {
    echo "<script>console.log('in post')</script>";
    // recieve input from form, trim whitespace
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);

    // check for user errors in the form
    if (empty($username)) {
        array_push($errors, "No username entered");
    }
    if (empty($email)) {
        array_push($errors, "No email entered");
    }
    if (empty($password1)) {
        array_push($errors, "No password entered");
    }
    if ($password1 != $password2) {
        array_push($errors, "The two passwords do not match");
    }
    // global donnection to db
    global $conn;
    // check if that username is available
    $check_avail_query = "SELECT * FROM users WHERE username='$username'";
    // query the databse: will return false bool if no results
    $result = mysqli_query($conn, $check_avail_query);
    // convert from mysqli_result
    $user = mysqli_fetch_assoc($result);

    // check for errors: if user exists, that name is taken
    if ($user) {
        // username not available
        array_push($errors, "Sorry, that name is not available.");
    }
    // if there are no errors thus far, then we can register the user
    if (count($errors) == 0) {
        $password = md5($password1);
        $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
        // insert into db
        mysqli_query($conn, $query);
        // get id of last created db entry
        $new_user_id = mysqli_insert_id($conn);
        // add logged in user to session variable
        $_SESSION['user'] = getUserById($new_user_id);
        // redirect to home
        header('location: index.php');
    }
}
// if login button is pressed on home page, log user in
if (isset($_POST['home_login'])) {
    echo "<script>console.log('in post')</script>";
    // grab variables from post request
    $username = $_POST['username'];
    $password = md5($_POST['password']); // encrypted
    // check for user errors
    if (empty($username)) {
        array_push($errors, "No username entered");
    }
    if (empty($password)) {
        array_push($errors, "No password entered");
    }

    // global db connection var
    global $conn;
    // if no errors thus far, query to see if the username/password combo exists in the database
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        // query the db
        $result = mysqli_query($conn, $query);
        // if result has more than 0 rows, there is a matching account
        if (mysqli_num_rows($result)) {
            // convert result to array
            $user = mysqli_fetch_assoc($result);
            // place user in session array
            $_SESSION['user'] = $user;
            // redirect to home page
            header('Location: index.php');
            exit(0);
        } else {
            // if $result has no rows, then there is no matching account in the db
            array_push($errors, "Bad credentials");
        }
    }
}
