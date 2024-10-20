<?php
session_start();

// Check if a session exists before destroying
// if (isset($_SESSION['role'])) {
// Destroy all session data and log out user regardless of role

unset($_SESSION['username']);
unset($_SESSION['principal']);
session_destroy();
header("refresh:1; url=login.php"); // Redirect to the single login page
exit();
// } else {
//     If no session exists, redirect to the login page with an error message
//     header("location:login.php?error=notloggedin");
//     exit();
// }
