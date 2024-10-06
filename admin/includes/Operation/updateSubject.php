
<?php
session_start(); // Ensure session is started

if (!isset($_POST["submit"])) {
    // Redirect if form is not submitted
    header("location:../../../index.php?page=subject");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    // try {
    // $subID = $_GET["id"];

    // Establish the database connection
    $mySQLFunction->connection();

    // Fetch the current subject details
    // $subjectRow = $mySQLFunction->getSubject("sub_code", $subID);

    if (isset($_POST["submit"])) {
        // Sanitize and prepare input
        $sub_id = $_POST["subID"];
        $sname = strtoupper(trim($_POST["subject"]));
        $stype = strtoupper(trim($_POST["type"]));
        $stime = strtoupper(trim($_POST["time"]));


        // Check if the subject and subject type already exist in table
        $existingSubject = $mySQLFunction->checkSubjectExist($sname, $stype, $sub_id);

        if ($existingSubject) {
            // If the section exist and the ID does not match, prevent update
            $_SESSION['subject_exist'] = "Subject is already exists. Please input different subject.";
            header("location:../../index.php?page=subject");
            exit();
        }

        // Reconnect to the database for updating the information
        $mySQLFunction->connection();

        // Update the teacher details
        $mySQLFunction->updateSubject("sub_title", $sname, $sub_id);
        $mySQLFunction->updateSubject("sub_type", $stype, $sub_id);
        $mySQLFunction->updateSubject("sub_time", $stime, $sub_id);


        // Disconnect after updating
        $mySQLFunction->disconnect();

        // Set session variable to indicate successful update
        $_SESSION['update_subject'] = true;
        header("location:../../index.php?page=subject");
        exit();
    }
    // } catch (Exception $e) {
    //     // Handle exceptions and errors
    //     error_log("Error updating subject details: " . $e->getMessage());
    //     $_SESSION['sectionupdate_error'] = "An error occurred while updating the subject details.";
    //     header("location:../../error.php");
    //     exit();
    // }
}
