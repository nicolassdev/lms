<?php
session_start();
if (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'teacher') {
        header("location:../login.php?error=accessdenied");
        exit();
    }
} else {
    header("location:../login.php");
    exit();
}
?>
 
 <?php
    include("./includes/teacher-header.php");
    
    require_once("./includes/alert-modal.php");

 ?>
<?php
// Determine the page from the URL parameter, default to 'home' if not set
$page = isset($_GET["page"]) ? $_GET["page"] : "dashboard";

// Use switch case to load the appropriate page
switch ($page) {
    case "teacher_prof":
        require_once 'teacher_prof.php';
        break;


    case "section_handled":
        require_once 'section_handled.php';
        break;

    default:
        require_once 'dashboard.php'; // Default page is 'home'
        break;
}
?>
  