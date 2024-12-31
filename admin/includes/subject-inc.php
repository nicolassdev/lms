<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=subject");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    // Initialize variables with POST data
    $code = trim($mySQLFunction->generateID("SUB-"));
    $subtitle = strtoupper(trim($_POST["title"] ?? '')); // Ensure default is empty string
    $subtype = strtoupper(trim($_POST["type"] ?? '')); // Ensure default is empty string
    $subtime = trim($_POST["time"] ?? ''); // Handle AM/PM
    $sem = trim($_POST["semester"] ?? ''); // Ensure default is empty string

    $mySQLFunction->connection(); // Establish database connection
    try {

        // Check if the  firstname and lastname already exist from inserting student info
        $duplicateSubject = $mySQLFunction->checkEntityExist('subject', 'sub_title', 'sub_type', 'sub_code', $subtitle, $subtype, $code);

        if ($duplicateSubject) {
            // If the same firstname and lastname exist and the ID does not match, prevent update
            $_SESSION['teacherupdate_error'] = "Subject was already exist in database...";
            header("location:../index.php?page=subject");
            exit();
        }


        // Check if the subject already exists excluding the current subject
        if ($mySQLFunction->checkRowCountSubject("subject", "sub_title", $subtitle, $code) == 1) {
            $_SESSION['subject_error'] = "<small>Subject title was already exists. Please input different subject.</small>";
            header("location:../index.php?page=subject");
            exit();
        }

        // Insert subject data into `subject` table using prepared statements
        // $subjectColumns = ['sub_code', 'sub_title', 'sub_type', 'sub_time', 'sub_semester'];

        // $studentValues = [$code, $subtitle,  $subtype, $subtime, $sem];

        // $mySQLFunction->insert("SUBJECT", $subjectColumns, $studentValues);





        $insertSubject = "
            INSERT INTO `subject` (`sub_code`, `sub_title`, `sub_type`, `sub_time`, `sub_semester`) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $mySQLFunction->con->prepare($insertSubject);
        $stmt->bind_param("sssss", $code, $subtitle, $subtype, $subtime, $sem); // Use $teacher
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
