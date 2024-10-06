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
    $teacher = trim($_POST["teacher_id"] ?? ''); // Ensure default is empty string

    $mySQLFunction->connection(); // Establish database connection

    try {
        // Start transaction
        $mySQLFunction->con->begin_transaction();

        // Prepare a statement for checking if the subject already exists
        $checkSubjectSql = "
            SELECT 1 FROM `subject` 
            WHERE `sub_title` = ? AND `sub_type` = ? AND `strand_code` = ? 
            LIMIT 1";
        $stmt = $mySQLFunction->con->prepare($checkSubjectSql);
        $stmt->bind_param("sss", $subtitle, $subtype, $strand);
        $stmt->execute();
        $stmt->store_result();

        // Check if a record exists
        if ($stmt->num_rows > 0) {
            throw new Exception("A subject with this title already exists for the selected strand.");
        }

        // Close the prepared statement
        $stmt->close();

        // Insert subject data into `subject` table using prepared statements
        $insertSubject = "
            INSERT INTO `subject` (`sub_code`, `sub_title`, `sub_type`, `sub_time`, `sub_semester`, `strand_code`, `teacher_id`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mySQLFunction->con->prepare($insertSubject);
        $stmt->bind_param("sssssss", $code, $subtitle, $subtype, $subtime, $sem, $strand, $teacher); // Use $teacher
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
