<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["stu_lrn"])) {

    header("location:../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../includes/dbh-inc.php";

    try {

        if (isset($_POST["submit"])) {
            $student_id = $_SESSION["stu_lrn"] ?? null;  // Retrieve from session

            if (empty($student_id)) {
                throw new Exception("Student ID is missing.");
            }

            $name = isset($_POST["firstname"]) ? strtoupper(trim($_POST["firstname"])) : null;
            $mname = isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null;
            $lname = isset($_POST["lastname"]) ? strtoupper(trim($_POST["lastname"])) : null;
            $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;
            $contact = isset($_POST["scontact"]) ? trim($_POST["scontact"]) : null;
            $gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $dob = isset($_POST["dob"]) ? trim($_POST["dob"]) : null;
            $pob = isset($_POST["pob"]) ? strtoupper(trim($_POST["pob"])) : null;
            $father = isset($_POST["fathername"]) ? strtoupper(trim($_POST["fathername"])) : null;
            $mother = isset($_POST["mothername"]) ? strtoupper(trim($_POST["mothername"])) : null;
            $pcontact = isset($_POST["pcontact"]) ? trim($_POST["pcontact"]) : null;


            $store = [
                'stu_fname' => $name,
                'stu_mname' => $mname,
                'stu_lname' => $lname,
                'stu_address' => $address,
                'stu_contact' => $contact,
                'stu_gender' => $gender,
                'stu_email' => $email,
                'stu_dob' => $dob,
                'stu_pob' => $pob,
                'father_name' => $father,
                'mother_name' => $mother,
                'parent_contact' => $pcontact,
            ];

            $mySQLFunction->connection();
            $mySQLFunction->updateStudentInfo($store, $student_id);

            $_SESSION['update_student'] = true;
            header("location:/lms/index.php?page=student_prof");
            exit();
            $mySQLFunction->disconnect();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating admin details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details.";
        header("location:/lms/404.php");
        exit();
    }
}
