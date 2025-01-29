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
$teacher_id = trim($_POST["teacherID"] ?? null);
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

    // Get the section name  and grade level of the current section
    $query = "SELECT section_name, grade_lvl FROM section WHERE section_code = ?";
    $sectionInfo = $mySQLFunction->querySingle($query, [$section_id]);
    if (!$sectionInfo) {
        $_SESSION['error'] = "Invalid section selected.";
        header("Location: ../index.php?page=schedule");
        exit();
    }

    $sectionName = $sectionInfo['section_name'];
    $gradeLevel = $sectionInfo['grade_lvl'];

    // Check for duplicate subject with the same section name and grade level
    $duplicateQuery = "
            SELECT COUNT(*) AS count
            FROM schedule
            INNER JOIN section ON schedule.section_code = section.section_code
            WHERE schedule.sub_code = ? AND section.section_name = ? AND section.grade_lvl = ? AND schedule.sched_id != ?";
    $duplicateCount = $mySQLFunction->querySingle($duplicateQuery, [$subject_id, $sectionName, $gradeLevel, $uid]);

    if ($duplicateCount['count'] > 0) {
        $_SESSION['error'] = "<small><b>Duplicate entry detected. </b><br/>The subject is already assigned to the same section and grade level.</small>";
        header("Location: ../index.php?page=schedule");
        exit();
    }



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


    $schedColumns = ['sched_id', 'teacher_id', 'section_code', 'sub_code', 'sched_day', 'sched_from', 'sched_to'];
    $schedValues = [$uid, $teacher_id, $section_id, $subject_id, $day, $from, $to];

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
