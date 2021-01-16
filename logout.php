<?php
// new session
session_start();
// kill session, clearing session variable of any logged in user
session_destroy();
// redirect to home page
header('Location: index.php');
exit;