<?php
session_start();
if (isset($_SESSION['user_role'])) {
    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'teacher') {
        echo "User role: " . htmlspecialchars($user_role);
        header("location:/lms/login.php"); // Redirect to login page if user role is not exist 
        exit(); // Debug and ensure it doesn't redirect incorrectly
    }
} else {
    echo "Session role not set.";
    header("location:/lms/login.php"); // Redirect to login page if user role is not exist 
    exit(); // Debug and confirm if the session is not established
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

        /** 
         student route */

    case "student_accounts":
        require_once 'student_accounts.php';
        break;

    case "new_student":
        require_once 'new_student.php';
        break;

    case "register_student":
        require_once 'register_student.php';
        break;

        /** 
         teacher route */

    case "teacher_prof":
        require_once 'teacher_prof.php';
        break;

    case "teacher_account":
        require_once 'teacher_account.php';
        break;

    case "teacher_prof":
        require_once 'teacher_prof.php';
        break;

        /** 
         Section route */

    case "section_handled":
        require_once 'section_handled.php';
        break;

    case "student_list":
        require_once 'student_list.php';
        break;

    case "student_subject_list":
        require_once 'student_subject_list.php';
        break;

        /** 
         Exam route */

    case "teacher_exam":
        require_once 'teacher_exam.php';
        break;

    case "create_exam":
        require_once 'create_exam.php';
        break;

    case "created_exam_list":
        require_once 'created_exam_list.php';
        break;


        /** 
         Quiz route */

    case "teacher_quiz":
        require_once 'teacher_quiz.php';
        break;

    case "create_quiz":
        require_once 'create_quiz.php';
        break;

    case "created_quiz_list":
        require_once 'created_quiz_list.php';
        break;


        /** 
         Subject route */

    case "teacher_subject":
        require_once 'teacher_subject.php';
        break;

    case "teacher_report":
        require_once 'teacher_report.php';
        break;



    default:
        require_once 'dashboard.php'; // Default page is 'home'
        break;
}


?>
 