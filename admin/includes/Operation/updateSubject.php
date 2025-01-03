<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["registrar_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    try {
        // Establish the database connection
        $mySQLFunction->connection();

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $sub_id = $_POST["subID"];
            $sname = strtoupper(trim($_POST["subject"]));
            $stype = strtoupper(trim($_POST["type"]));
            $stime = strtoupper(trim($_POST["time"]));
            $semester = ucwords(strtolower(trim($_POST["semester"])));

            // Check if the subject already exists excluding the current subject
            if ($mySQLFunction->checkRowCountSubject("subject", "sub_title", $sname, $sub_id) == 1) {
                $_SESSION['subject_error'] = "<small>Subject is already exists. Please input different subject.</small>";
                header("location:../../index.php?page=subject");
                exit();
            }

            $store = [
                'sub_title' => $fname,
                'sub_type' => $mname,
                'sub_time' => $lname,
                'sub_semester' => $semester,
            ];
            // Reconnect to the database for updating the information
            $mySQLFunction->connection();
            // Update the student details
            foreach ($store as $column => $value) {
                if ($value !== null) { // Only update non-null values
                    $mySQLFunction->updateRecord("subject", $column, $value, "sub_code", $sub_id);
                }
            }
            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_subject'] = true;
            header("location:../../index.php?page=subject");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating subject details: " . $e->getMessage());
        $_SESSION['sectionupdate_error'] = "An error occurred while updating the subject details.";
        header("location:../../error.php");
        exit();
    }
}
