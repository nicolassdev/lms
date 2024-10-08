<?php include "./includes/action-inc.php" ?>
<?php include "./includes/header.php" ?>
<?php include "./includes/sidebar.php" ?>



<?php
// Determine the page from the URL parameter, default to 'home' if not set
$page = isset($_GET["page"]) ? $_GET["page"] : "home";

// Use switch case to load the appropriate page
switch ($page) {
    case "admin":
        require_once 'admin.php';
        break;

    case "users":
        require_once 'users.php';
        break;
    case "student":
        require_once 'student.php';
        break;
    case "teacher":
        require_once 'teacher.php';
        break;
    case "strand":
        require_once 'strand.php';
        break;
    case "subject":
        require_once 'subject.php';
        break;
    case "settings":
        require_once 'settings.php';
        break;
    default:
        require_once 'home.php'; // Default page is 'home'
        break;
}
?>
