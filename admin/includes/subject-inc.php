<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=subject");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    // Initialize variables with POST data
    $code = trim($mySQLFunction->generateSubjectCode());
    $subtitle = strtoupper(trim($_POST["title"] ?? '')); // Ensure default is empty string
    $subtype = strtoupper(trim($_POST["type"] ?? '')); // Ensure default is empty string
    $subtime = trim($_POST["time"] ?? ''); // Handle AM/PM
    $sem = trim($_POST["semester"] ?? ''); // Ensure default is empty string
    $strand = trim($_POST["strand_code"] ?? ''); // Ensure default is empty string
    $gradelvl = strtoupper(trim($_POST["gradelvl"] ?? ''));
    $teacher = trim($_POST["teacher_id"] ?? ''); // Ensure default is empty string

    $mySQLFunction->connection(); // Establish database connection

    try {

        // Check if the  firstname and lastname already exist from inserting student info
        $sectionExistInSameStrandGradelvl = $mySQLFunction->checkEntityExist('subject', 'sub_title', 'strand_code', 'sub_code', $subtitle, $strand, $code);

        if ($sectionExistInSameStrandGradelvl) {
            // If the same firstname and lastname exist and the ID does not match, prevent update
            $_SESSION['teacherupdate_error'] = "Subject was already exist in database...";
            header("location:../index.php?page=subject");
            exit();
        }


        // Insert subject data into `subject` table using prepared statements
        $insertSubject = "
            INSERT INTO `subject` (`sub_code`, `sub_title`, `sub_type`, `sub_time`, `sub_semester`, `strand_code`, `sub_gradelvl`, `teacher_id`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mySQLFunction->con->prepare($insertSubject);
        $stmt->bind_param("ssssssss", $code, $subtitle, $subtype, $subtime, $sem, $strand,  $gradelvl, $teacher); // Use $teacher
        $stmt->execute();

        // Commit the transaction
        $mySQLFunction->con->commit();

        // Set session success message
        $_SESSION['insert_subject'] = true;
        header("Location: ../index.php?page=subject");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $mySQLFunction->con->rollback();

        // Set error session message
        $_SESSION['error_subject'] = $e->getMessage();
        header("Location: ../index.php?page=subject");
        exit();
    } finally {
        // Close the connection
        $mySQLFunction->disconnect();
    }
}
