<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $teacherID = $_GET["id"];
        // Establish the database connection
        $mySQLFunction->connection();

        // Fetch the current teacher details
        $teacherRow = $mySQLFunction->getTeacher("teacher_id", $teacherID);

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["teacherID"];
            $fname = strtoupper(trim($_POST["firstname"]));
            $mname = strtoupper(trim($_POST["middlename"]));
            $lname = strtoupper(trim($_POST["lastname"]));
            $contact = trim($_POST["contact"]);
            $gender = strtoupper(trim($_POST["gender"]));
            $dob = trim($_POST["dob"]);
            $status = strtoupper(trim($_POST["status"]));
            $address = strtoupper(trim($_POST["address"]));

            // Check if the new firstname and lastname already exist for another teacher
            $existingTeacher = $mySQLFunction->checkFacultyExist($fname, $lname, $id);

            if ($existingTeacher) {
                // If the same firstname and lastname exist and the ID does not match, prevent update
                $_SESSION['teacherupdate_error'] = "Teacher Information with the same first and last name already exists. Please choose different information.";
                header("location:../../index.php?page=teacher");
                exit();
            }

            // Reconnect to the database for updating the information
            $mySQLFunction->connection();

            // Update the teacher details
            $mySQLFunction->updateFaculty("teacher_fname", $fname, $id);
            $mySQLFunction->updateFaculty("teacher_mname", $mname, $id);
            $mySQLFunction->updateFaculty("teacher_lname", $lname, $id);
            $mySQLFunction->updateFaculty("teacher_contact", $contact, $id);
            $mySQLFunction->updateFaculty("teacher_gender", $gender, $id);
            $mySQLFunction->updateFaculty("teacher_dob", $dob, $id);
            $mySQLFunction->updateFaculty("status", $status, $id);
            $mySQLFunction->updateFaculty("teacher_address", $address, $id);

            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_faculty'] = true;
            header("location:../../index.php?page=teacher");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating teacher details: " . $e->getMessage());
        $_SESSION['teacherupdate_error'] = "An error occurred while updating the teacher's details.";
        header("location:../../404.php");
        exit();
    }
}
