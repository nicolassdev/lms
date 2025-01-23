<?php
session_start(); // Ensure session is started

// Redirect if the teacher is not logged in
if (!isset($_SESSION["teacher_id"])) {
    header("location:../../../login.php?error=accessdenied");
    exit();
}

// Include database connection
include "../../../includes/dbh-inc.php";
$mySQLFunction->connection();



// Optionally, validate other parameters
$sched_id = isset($_GET['sched_id']) ? $_GET['sched_id'] : '';
$sub_code = isset($_GET['sub_code']) ? $_GET['sub_code'] : '';
$section_code = isset($_GET['section_code']) ? $_GET['section_code'] : '';

// Ensure quiz_id is properly set and not empty
$quiz_id = trim($_GET['quiz_id']);
if (empty($quiz_id)) {
    $_SESSION['error'] = "Invalid request. Quiz ID is empty.";
    header("Location: ../../index.php?page=created_quiz_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_code) . "&section_code=" . urlencode($section_code));
    exit();
}

// Perform deletion
$success = $mySQLFunction->delete("quiz", "quiz_id", $quiz_id);

// Provide feedback to the user
if ($success) {
    $_SESSION['success'] = "Quiz has been deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete quiz. Please try again.";
}

// Redirect back to the list page
header("Location: ../../index.php?page=created_quiz_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_code) . "&section_code=" . urlencode($section_code));
exit();
$mySQLFunction->disconnect();
