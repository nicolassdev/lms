<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=enrolled");
    exit();
}

include "../../includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');

// Initialize variables with POST data
$student = trim($_POST["stu_lrn"] ?? null);
$sec = trim($_POST["section_code"] ?? null);
$sem = isset($activeSem) && !empty($activeSem) ? $activeSem[0] : null;
$sy = isset($activeSchoolYears) && !empty($activeSchoolYears) ? $activeSchoolYears[0] : null;
$enrolldate = date("Ymd");
$currentschool = strtoupper(trim($_POST["currentchool"] ?? null));
$schoolid = !empty(trim($_POST["schoolid"])) ? trim($_POST["schoolid"]) : null; // Optional
$address = strtoupper(trim($_POST["address"] ?? null));
$type = strtoupper(trim($_POST["schooltype"] ?? null));

// Define the required documents
$requiredDocuments = ["SF9", "SF10", "PSA", "LCR", "GMCC"];

// Check if all required documents are submitted
$submittedDocuments = isset($_POST['requirement']) ? $_POST['requirement'] : [];
$allDocumentsSubmitted = !array_diff($requiredDocuments, $submittedDocuments);

// Set status based on requirements
$status = $allDocumentsSubmitted ? "Enrolled" : "Pending";

// Handle multiple requirements as a comma-separated string
$requirements = !empty($submittedDocuments) ? implode(', ', $submittedDocuments) : null;

try {
    // Check if the student is already enrolled in the current semester and school_year
    $checkEnrollment = "
    SELECT * FROM `enroll` 
    WHERE `stu_lrn` = ? AND `semester` = ? AND `school_year` = ?";

    $checkStmt = $mySQLFunction->con->prepare($checkEnrollment);
    $checkStmt->bind_param("sss", $student, $sem, $sy);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['check_enrolled'] = "The student is already enrolled in this semester.";
        header("location:../../index.php?page=enrolled");
        exit();
    }

    // Start transaction
    $mySQLFunction->con->begin_transaction();

    // Insert new enrollment into `enroll` table
    $insertEnrolled = "
    INSERT INTO `enroll` (`stu_lrn`, `section_code`, `semester`, `school_year`, `date_enroll`, `enroll_status`, `current_school`, `school_id`, `school_address`, `school_type`, `requirements_submit`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mySQLFunction->con->prepare($insertEnrolled);

    $stmt->bind_param(
        "sssssssssss",
        $student,
        $sec,
        $sem,
        $sy,
        $enrolldate,
        $status,
        $currentschool,
        $schoolid,
        $address,
        $type,
        $requirements
    );

    if (!$stmt->execute()) {
        throw new Exception($stmt->error);
    }

    // Commit the transaction
    $mySQLFunction->con->commit();

    $_SESSION['insert_enrolled'] = true;
    header("Location: ../index.php?page=enrolled");
    exit();
} catch (Exception $e) {
    $mySQLFunction->con->rollback();
    // var_dump($e);
    $_SESSION['error_enrolled'] = $e->getMessage();
    header("Location: ../index.php?page=enrolled");
    exit();
} finally {
    $mySQLFunction->disconnect();
}
