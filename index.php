<?php
session_start();
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

<?php
include "./includes/student-header.php";

include "./includes/alert-notify.php";
?>

<?php

$page = isset($_GET["page"]) ? $_GET["page"] : "student_home";

// Use switch case to load the appropriate page
/** 
 This is Student Routes 
 */
switch ($page) {
    case "student_module":
        require_once 'student_module.php';
        break;
    case "student_section":
        require_once 'student_section.php';
        break;

    case "student_subject":
        require_once 'student_subject.php';
        break;

    case "subject_list":
        require_once 'subject_list.php';
        break;

    case "student_prof":
        require_once 'student_prof.php';
        break;
    case "student_quiz":
        require_once 'student_quiz.php';
        break;
    case "student_exam":
        require_once 'student_exam.php';
        break;
    case "student_assignment":
        require_once 'student_assignment.php';
        break;
    case "student_grade":
        require_once 'student_grade.php';
        break;
    case "student_account":
        require_once 'student_account.php';
        break;

    default:
        require_once 'student_home.php'; // Default page is 'home'
        break;
}


?>
 