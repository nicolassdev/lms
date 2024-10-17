<?php
session_start();
?>


<?php include "./includes/header.php"; ?>
 
<?php
include "./includes/alert-modal.php";
?>


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
        case "section":
            require_once 'section.php';
            break;
        case "enrollment":
            require_once 'enrollment.php';
            break;
        case "subject":
            require_once 'subject.php';
            break;
        case "settings":
            require_once 'settings.php';
            break;
        case "schoolyear":
            require_once 'schoolyear.php';
            break;
        case "semester":
            require_once 'semester.php';
            break;

        default:
            require_once 'home.php'; // Default page is 'home'
            break;
    }
    ?>
  