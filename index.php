<?php include "./includes/student-sidebar.php"; ?>
 
<?php
if (isset($_GET["page"]) && $_GET["page"] == "student_home") {
    include "student_home.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "student_prof") {
    include "student_prof.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "student_quiz") {
    include "student_quiz.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "student_exam") {
    include "student_exam.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "student_activity") {
    include "student_activity.php";
}
if (isset($_GET["page"]) && $_GET["page"] == "student_grade") {
    include "student_grade.php";
}

?>