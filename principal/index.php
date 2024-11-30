
<?php
session_start();
if (isset($_SESSION['user_role'])) {  //check if the user role variables is exist

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'principal') {
        header("location:../login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:../login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>

<?php
include "./includes/principal-header.php";
// alert modal 
include "./includes/alert-modal.php";
?>


    <?php
    // Determine the page from the URL parameter, default to 'home' if not set
    $page = isset($_GET["page"]) ? $_GET["page"] : "dashboard";
    /**
             Route of principal page
     */
    // Use switch case to load the appropriate page
    switch ($page) {
        case "masterlist":
            require_once 'masterlist.php';
            break;

        case "facultymembers":
            require_once 'facultymembers.php';
            break;

        case "section":
            require_once 'section.php';
            break;

            /**
             Route of principal account and profile page
             */

        case "principal_prof":
            require_once 'principal_prof.php';
            break;

        case "principal_account":
            require_once 'principal_account.php';
            break;

        default:
            require_once 'dashboard.php'; // Default page is 'home'
            break;
    }
    ?>