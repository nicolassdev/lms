
<?php
session_start();
if (isset($_SESSION['user_role'])) {  //check if the user role variables is exist

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'admin') {
        header("location:../login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:../login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>

<?php
include "./includes/header.php";
// alert modal 
include "./includes/alert-modal.php";
?>
  
    <?php
    // Determine the page from the URL parameter, default to 'home' if not set
    $page = isset($_GET["page"]) ? $_GET["page"] : "home";
    /**
     Route of page
     */
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
        case "enrolled":
            require_once 'enrolled.php';
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
            /**
                 ROUTE FOR STRAND SUBJECT
             */
        case "stem_subjects":
            require_once 'stem_subjects.php';
            break;
        case "abm_subjects":
            require_once 'abm_subjects.php';
            break;
        case "humss_subjects":
            require_once 'humss_subjects.php';
            break;
        case "gas_subjects":
            require_once 'gas_subjects.php';
            break;
        case "css_subjects":
            require_once 'css_subjects.php';
            break;
        case "cp_subjects":
            require_once 'cp_subjects.php';
            break;


        default:
            require_once 'home.php'; // Default page is 'home'
            break;
    }
    ?>
  