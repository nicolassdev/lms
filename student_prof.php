    <!-- LOGIN Content -->
<?php
if (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'student') {
        header("location:login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>