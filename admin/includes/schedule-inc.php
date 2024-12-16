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
$from = isset($_POST["time_from"]) ? date("h:i A", strtotime(trim($_POST["time_from"]))) : null;
$to = isset($_POST["time_to"]) ? date("h:i A", strtotime(trim($_POST["time_to"]))) : null;
// Generate unique IDs
$uid = trim($mySQLFunction->generateID("SCHED-"));


// Convert the "From" and "To" times to timestamps
$fromTime = strtotime($from); // Get the Unix timestamp of the start time
$toTime = strtotime($to); // Get the Unix timestamp of the end time

// Check if "From" time is greater than "To" time
if ($fromTime > $toTime) {
    $_SESSION['error'] = "Start time cannot be greater than end time.";
    header("Location: ../index.php?page=schedule");
    exit();
}



try {

    // Check if there are duplicate ID inserted in section code and subject code 
    $duplicateIDExists = $mySQLFunction->checkDuplicateID('schedule', 'section_code', 'sub_code', 'sched_id', $section_id, $subject_id, $uid);

    if ($duplicateIDExists) {
        // If the same firstname and lastname exist and the ID does not match, prevent update
        $_SESSION['error'] = "Schedule was already set in the database. Please select a different schedule.";
        header("location:../index.php?page=schedule");
        exit();
    }


    // VALIDATION 2: Check for time overlap using the reusable function | Check if the subject with the same day and time  was alredy exist in database 
    $sectionTitle = $mySQLFunction->getSectionTitle($section_id);
    $subjectTitle = $mySQLFunction->getSubjectTitle($subject_id);

    $conflict = $mySQLFunction->hasSubjectTimeConflict($section_id, $subject_id, $day, $from, $to);
    if ($conflict) {
        // Set session error message with specific conflict information
        $_SESSION['error'] = "
        <div style='color: red; font-size: 17px; font-weight: bold;'>Conflict detected:<br></div>
        <div style='font-size: 15px;'>
            <small>
                Subject <span style='color: red;'>$subjectTitle</span> already exists in section 
                <span style='color: red;'>$sectionTitle</span> on 
                <span style='color: red;'>$day</span> from 
                <span style='color: red;'>$from</span> to 
                <span style='color: red;'>$to</span>.
            </small>
        </div>";
        header("location: ../index.php?page=schedule");
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
