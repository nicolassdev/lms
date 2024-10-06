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
$schoolid = !empty(trim($_POST["schoolid"])) ? trim($_POST["schoolid"]) : null; // Make school ID optional
$address = strtoupper(trim($_POST["address"] ?? null));
$type = strtoupper(trim($_POST["schooltype"] ?? null));

// Handle multiple requirements as a comma-separated string
$requirements = isset($_POST['requirement']) ? implode(', ', $_POST['requirement']) : null;

try {
    // Check if the student is already enrolled in the current semester and section
    $checkEnrollment = "
    SELECT * FROM `enroll` 
    WHERE `stu_lrn` = ? AND `semester` = ? AND `school_year` = ?";

    $checkStmt = $mySQLFunction->con->prepare($checkEnrollment);
    $checkStmt->bind_param("sss", $student, $sem, $sy);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Student is already enrolled in this semester for this school year
        $_SESSION['check_enrolled'] = "The student is already enrolled in this semester.";
        header("location:../../index.php?page=enrollment");
        exit();
    }

    // Start transaction
    $mySQLFunction->con->begin_transaction();

    // Insert new enrollment into `enroll` table
    $insertEnrolled = "
    INSERT INTO `enroll` (`stu_lrn`, `section_code`, `semester`, `school_year`, `date_enroll`, `enroll_status`, `current_school`, `school_id`, `school_address`, `school_type`, `requirements_submit`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mySQLFunction->con->prepare($insertEnrolled);

    // Bind parameters, ensuring that schoolid can be NULL if not provided
    $stmt->bind_param(
        "sssssssssss",
        $student,
        $sec,
        $sem,
        $sy,
        $enrolldate,
        $status,
        $currentschool,
        $schoolid, // This can now be NULL
        $address,
        $type,
        $requirements
    );

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
