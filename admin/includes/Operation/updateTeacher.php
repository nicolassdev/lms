<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["registrar_id"])) {

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


            // Check if the  firstname and lastname already exist from updating faculty info
            $existingTeacher = $mySQLFunction->checkEntityExist('teacher', 'teacher_fname', 'teacher_lname', 'teacher_id', $fname, $lname, $id);
            if ($existingTeacher) {
                // If the same firstname and lastname exist and the ID does not match, prevent update
                $_SESSION['teacherupdate_error'] = "Teacher Information with the same first and last name already exists in database.";
                header("location:../../index.php?page=teacher");
                exit();
            }

            $store = [
                'teacher_fname' => $fname,
                'teacher_mname' => $mname,
                'teacher_lname' => $lname,
                'teacher_contact' => $contact,
                'teacher_gender' => $gender,
                'teacher_dob' => $dob,
                'status' => $status,
                'teacher_address' => $address,
            ];

            // Reconnect to the database for updating the information
            $mySQLFunction->connection();

            // Update the teacher details
            foreach ($store as $column => $value) {
                if ($value !== null) { // Only update non-null values
                    $mySQLFunction->updateRecord("teacher", $column, $value, "teacher_id", $id);
                }
            }

            // $mySQLFunction->updateRecord("teacher", "teacher_fname", $fname, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "teacher_mname", $mname, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "teacher_lname", $lname, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "teacher_contact", $contact, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "teacher_gender", $gender, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "teacher_dob", $dob, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "status", $status, "teacher_id", $id);
            // $mySQLFunction->updateRecord("teacher", "teacher_address", $address, "teacher_id", $id);

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
