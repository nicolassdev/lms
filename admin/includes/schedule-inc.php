<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=schedule");
    exit();
}

include "../../includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');

// Initialize variables with POST data
$section_id = trim($_POST["sectionID"] ?? null);
$subject_id = trim($_POST["subjectID"] ?? null);
$day = trim($_POST["day"] ?? null);
$from =  strtoupper(trim($_POST["time_from"]) ?? null);
$to =  strtoupper(trim($_POST["time_to"]) ?? null);


// Generate unique IDs
$uid = trim($mySQLFunction->generateID("SCHED-"));

try {

    // Check if there are duplicate ID inserted in section code and subject code 
    $duplicateIDExists = $mySQLFunction->checkDuplicateID('schedule', 'section_code', 'sub_code', 'sched_id', $section_id, $subject_id, $uid);

    if ($duplicateIDExists) {
        // If the same firstname and lastname exist and the ID does not match, prevent update
        $_SESSION['error'] = "Schedule was already set in the database. Please select a different schedule.";
        header("location:../index.php?page=schedule");
        exit();
    }

    $schedColumns = ['sched_id', 'section_code', 'sub_code', 'sched_day', 'sched_from', 'sched_to'];
    $schedValues = [$uid, $section_id, $subject_id, $day, $from, $to];

    $mySQLFunction->insert("SCHEDULE", $schedColumns, $schedValues);

    $_SESSION['success'] = "Schedule was inserted successfully";
    header("Location: ../index.php?page=schedule");
    exit();
} catch (Exception $e) {
    $mySQLFunction->con->rollback();
    $_SESSION['error'] = "Oops! Something went wrong. Please try again later or contact support.";
    header("Location: ../index.php?page=schedule");
    exit();
} finally {
    $mySQLFunction->disconnect();
}
