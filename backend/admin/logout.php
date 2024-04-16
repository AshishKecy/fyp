<?php
// Start or resume the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or any other page
header("Location: admin_login.php");
exit;
?>
