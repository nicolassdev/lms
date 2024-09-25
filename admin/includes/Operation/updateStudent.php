<?php
session_start(); // Ensure session is started

if (!isset($_POST["submit"])) {
    // Redirect if form is not submitted
    header("location:../../../index.php?page=student");
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



            // Check if the new firstname and lastname already exist for another teacher
            $existingStudent = $mySQLFunction->checkStudentExist($fname, $lname, $id);

            if ($existingStudent) {
                // If the same firstname and lastname exist and the ID does not match, prevent update
                $_SESSION['teacherupdate_error'] = "Student Information with the same first and last name already exists. Please choose different information.";
                header("location:../../index.php?page=student");
                exit();
            }

            // Reconnect to the database for updating the information
            $mySQLFunction->connection();

            // Update the student details
            $mySQLFunction->updateStudent("stu_fname", $fname, $id);
            $mySQLFunction->updateStudent("stu_mname", $mname, $id);
            $mySQLFunction->updateStudent("stu_lname", $lname, $id);
            $mySQLFunction->updateStudent("stu_address", $address, $id);
            $mySQLFunction->updateStudent("stu_contact", $contact, $id);
            $mySQLFunction->updateStudent("stu_gender", $gender, $id);
            $mySQLFunction->updateStudent("stu_email", $email, $id);
            $mySQLFunction->updateStudent("stu_dob", $dob, $id);
            $mySQLFunction->updateStudent("stu_pob", $pob, $id);
            $mySQLFunction->updateStudent("father_name", $father, $id);
            $mySQLFunction->updateStudent("mother_name", $mother, $id);
            $mySQLFunction->updateStudent("parent_contact", $pcontact, $id);


            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_student'] = true;
            header("location:../../index.php?page=student");
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
