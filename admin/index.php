<?php
session_start(); // MUST be the very first thing
if (isset($_SESSION['user_role'])) {
    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'registrar') {
        header("Location: /lms/login.php");
        exit();
    }
} else {
    header("Location: /lms/login.php");
    exit();
}

include "./includes/header.php";
include "./includes/alert-modal.php";


// <?php
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

    /**
                ROUTE FOR STUDENTS
         */
    case "student":
        require_once 'student.php';
        break;
    case "student_accounts":
        require_once 'student_accounts.php';
        break;


    /**
                ROUTE FOR FACULTY
         */
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
    case "teacher_accounts":
        require_once 'teacher_accounts.php';
        break;


    /**
                ROUTE FOR PRINCIPAL
         */
    case "principal":
        require_once 'principal.php';
        break;

    /**
                ROUTE FOR STRAND SUBJECTS 
         */

    case "schedule":
        require_once 'schedule.php';
        break;

    /**
                ROUTE FOR STEM SUBJECT
         */

    case "stem_subjects":
        require_once 'stem_subjects.php';
        break;

    case "stem_subject_g11":
        require_once 'stem_subject_g11.php';
        break;

    case "stem_subject_g12":
        require_once 'stem_subject_g12.php';
        break;

    /**
                ROUTE FOR ABM SUBJECT
         */

    case "abm_subjects":
        require_once 'abm_subjects.php';
        break;
    case "abm_subject_g11":
        require_once 'abm_subject_g11.php';
        break;

    case "abm_subject_g12":
        require_once 'abm_subject_g12.php';
        break;


    /**
                ROUTE FOR HUMSS SUBJECT
         */

    case "humss_subjects":
        require_once 'humss_subjects.php';
        break;

    case "humss_subject_g11":
        require_once 'humss_subject_g11.php';
        break;

    case "humss_subject_g12":
        require_once 'humss_subject_g12.php';
        break;



    /**
                ROUTE FOR GAS SUBJECT
         */

    case "gas_subjects":
        require_once 'gas_subjects.php';
        break;

    case "gas_subject_g11":
        require_once 'gas_subject_g11.php';
        break;

    case "gas_subject_g12":
        require_once 'gas_subject_g12.php';
        break;


    /**
                ROUTE FOR CSS SUBJECT
         */

    case "css_subjects":
        require_once 'css_subjects.php';
        break;

    case "css_subject_g11":
        require_once 'css_subject_g11.php';
        break;

    case "css_subject_g12":
        require_once 'css_subject_g12.php';
        break;



    /**
                ROUTE FOR CP SUBJECT
         */

    case "cp_subjects":
        require_once 'cp_subjects.php';
        break;

    case "cp_subject_g11":
        require_once 'cp_subject_g11.php';
        break;

    case "cp_subject_g12":
        require_once 'cp_subject_g12.php';
        break;


    /**
                 ROUTE FOR SETTINGS ADMIN
         */
    case "settings":
        require_once 'settings.php';
        break;
    case "schoolyear":
        require_once 'schoolyear.php';
        break;
    case "semester":
        require_once 'semester.php';
        break;
    case "quarterly":
        require_once 'quarterly.php';
        break;
    case "account":
        require_once 'account.php';
        break;


    default:
        require_once 'home.php'; // Default page is 'home'
        break;
}
