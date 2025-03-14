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

// Ensure module_id is properly set and not empty
$module_id = trim($_GET['module_id']);
if (empty($module_id)) {
    $_SESSION['error'] = "Invalid request. Exam ID is empty.";
    header("Location: ../../index.php?page=uploaded_module_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_code) . "&section_code=" . urlencode($section_code));
    exit();
}

// Perform deletion
$success = $mySQLFunction->delete("module", "module_id", $module_id);

// Provide feedback to the user
if ($success) {
    $_SESSION['success'] = "Module has been deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete module. Please try again.";
}

// Redirect back to the list page
header("Location: ../../index.php?page=uploaded_module_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_code) . "&section_code=" . urlencode($section_code));
exit();
$mySQLFunction->disconnect();
