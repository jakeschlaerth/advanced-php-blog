<?php
// turns error reporting on
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// inits session variable for passing params between files
session_start();

// connection to database, this object can be accessed using the global keyword
$conn = mysqli_connect("127.0.0.1:3307", "root", "1999rog", "complete-blog-php");

// error checking for db connection
if (!$conn) {
    die("Error connecting to db: " . mysqli_connect_error());
}

// helpful constants
define('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost/my-blog/');
