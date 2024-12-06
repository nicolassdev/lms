<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["teacher_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $lrnID = $_GET["id"];
        // Establish the database connection
        $mySQLFunction->connection();

        // Fetch the current teacher details
        $teacherRow = $mySQLFunction->getStudent("stu_lrn", $lrnID);

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["lrnID"];
            $fname = strtoupper(trim($_POST["firstname"]));
            $mname = strtoupper(trim($_POST["middlename"]));
            $lname = strtoupper(trim($_POST["lastname"]));
            $address = strtoupper(trim($_POST["address"]));
            $contact = trim($_POST["contact"]);
            $gender = strtoupper(trim($_POST["gender"]));
            $email = trim($_POST["email"]);
            $dob = trim($_POST["dob"]);
            $pob = strtoupper(trim($_POST["pob"]));
            $father = strtoupper(trim($_POST["fathername"]));
            $mother =  strtoupper(trim($_POST["mothername"]));
            $pcontact = trim($_POST["pcontact"]);



            // Check if the  firstname and lastname already exist from updating student info
            $studentExists = $mySQLFunction->checkEntityExist('student', 'stu_fname', 'stu_lname', 'stu_lrn', $fname, $lname, $id);
            if ($studentExists) {
                // If the same firstname and lastname exist and the ID does not match, prevent update
                $_SESSION['teacherupdate_error'] = "Student Information with the same first name and last name already exists in database.";
                header("location:../../index.php?page=student");
                exit();
            }


            // Reconnect to the database for updating the information
            $mySQLFunction->connection();

            // Update the student details
            $mySQLFunction->updateRecord("student", "stu_fname", $fname, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_mname", $mname, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_lname", $lname, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_address", $address, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_contact", $contact, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_gender", $gender, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_email", $email, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_dob", $dob, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "stu_pob", $pob, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "father_name", $father, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "mother_name", $mother, "stu_lrn", $id);
            $mySQLFunction->updateRecord("student", "parent_contact", $pcontact, "stu_lrn", $id);




            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['success'] = "Student has been updated successfully.";
            header("location:../../index.php?page=new_student");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating teacher details: " . $e->getMessage());
        $_SESSION['teacherupdate_error'] = "An error occurred while updating the teacher's details.";
        header("location:../../error.php");
        exit();
    }
}
