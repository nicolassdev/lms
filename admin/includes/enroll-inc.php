<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=enrollment");
    exit();
} 

include "../../includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');


// Initialize variables with POST data
$student = trim($_POST["stu_lrn"] ?? null);
$sec = trim($_POST["section_code"] ?? null);

$sem = isset($activeSem) && !empty($activeSem) ? $activeSem[0] : null; // Use active semester directly
$sy = isset($activeSchoolYears) && !empty($activeSchoolYears) ? $activeSchoolYears[0] : null; // Use active school year directly

$enrolldate = trim($_POST["enrolldate"] ?? null);
$status = strtoupper(trim($_POST["status"] ?? null));
$currentschool = strtoupper(trim($_POST["currentchool"] ?? null));
$schoolid = strtoupper(trim($_POST["schoolid"] ?? null));
$address = strtoupper(trim($_POST["address"] ?? null));
$type = strtoupper(trim($_POST["schooltype"] ?? null));

// Handle multiple requirements as a comma-separated string
$requirements = isset($_POST['requirement']) ? implode(', ', $_POST['requirement']) : null;

try {
    // Start transaction
    $mySQLFunction->con->begin_transaction();

    // Insert section data into `enroll` table using prepared statements
    $insertEnrolled = "
    INSERT INTO `enroll` (`stu_lrn`, `section_code`, `semester`, `school_year`, `date_enroll`, `enroll_status`, `current_school`, `school_id`, `school_address`, `school_type`, `requirements`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mySQLFunction->con->prepare($insertEnrolled);

    // Bind the correct number of parameters
    $stmt->bind_param("sssssssssss", $student, $sec, $sem, $sy, $enrolldate, $status, $currentschool, $schoolid, $address, $type, $requirements);

    // Execute the statement and check for errors
    if (!$stmt->execute()) {
        throw new Exception($stmt->error); // Throw an exception with the MySQL error message
    }

    // Commit the transaction
    $mySQLFunction->con->commit();

    // Set session success message
    $_SESSION['insert_enrolled'] = true;
    header("Location: ../index.php?page=enrollment");
    exit();
} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mySQLFunction->con->rollback();

    // Set error session message
    $_SESSION['error_enrolled'] = $e->getMessage();
    header("Location: ../index.php?page=enrollment");
    exit();
} finally {
    // Close the connection
    $mySQLFunction->disconnect();
}
