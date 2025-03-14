<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the teacher page
    header("Location: index.php?page=student");
    exit();
} else {

    // Include database connection and helper functions
    include "../../includes/dbh-inc.php";

    // Set timezone
    date_default_timezone_set('Asia/Manila');

    // Initialize variables with POST data and sanitize them
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
    $lrnID = isset($_POST["lrn"]) ? trim($_POST["lrn"]) : null;
    $fname = isset($_POST["fname"]) ? strtoupper(trim($_POST["fname"])) : null;
    $lname = isset($_POST["lname"]) ? strtoupper(trim($_POST["lname"])) : null;


    $role = isset($_POST["role"]) ? strtoupper(trim($_POST["role"])) : null;
    $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;
    $scontact = isset($_POST["stu_contact"]) ? trim($_POST["stu_contact"]) : null;
    $gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
    $dob = isset($_POST["dob"]) ? trim($_POST["dob"]) : null;
    $pob = isset($_POST["pob"]) ? strtoupper(trim($_POST["pob"])) : null;
    $father = isset($_POST["fathername"]) ? strtoupper(trim($_POST["fathername"])) : null;
    $mother = isset($_POST["mothername"]) ? strtoupper(trim($_POST["mothername"])) : null;
    $pcontact = isset($_POST["p_contact"]) ? trim($_POST["p_contact"]) : null;

    // Generate unique IDs
    $uid = trim($mySQLFunction->generateID("USER-"));
    //GENERATE unique passsword for students
    $userpwd = trim($mySQLFunction->generatePassword($dob));

    // Establish database connection
    $mySQLFunction->connection();

    try {

        // Check if the LRN ID and username are the same
        if ($lrnID !== $username) {
            // throw new Exception("The LRN and Username must be the same. No data will be inserted.");
            $_SESSION['check_id'] = "The LRN and Username must be the same. No data will be inserted.";
            header("Location: ../index.php?page=student");
            exit(0);
        }


        // Check if student lrn was already exist from inserting student lrn 
        $lrnExists = $mySQLFunction->checkUserExist($username);

        if ($lrnExists) {
            // If the same firstname and lastname exist and the ID does not match, prevent update
            $_SESSION['teacherupdate_error'] = "Student LRN was already exist in database.";
            header("location:../index.php?page=student");
            exit();
        }


        // Check if the  firstname and lastname already exist from inserting student info
        $studentExists = $mySQLFunction->checkEntityExist('student', 'stu_fname', 'stu_lname', 'stu_lrn', $fname, $lname, $lrnID);

        if ($studentExists) {
            // If the same firstname and lastname exist and the ID does not match, prevent update
            $_SESSION['teacherupdate_error'] = "Student Information with the same first and last name already exists.";
            header("location:../index.php?page=student");
            exit();
        }


        // Encrypt password if provided
        $encryptedPassword = $userpwd ? $mySQLFunction->encrypt($userpwd) : null;

        // Insert data into USERS table
        $credentialColumns = ['id', 'username', 'password', 'role', 'date_added'];
        $credentialValues = [$uid, $username, $encryptedPassword, $role, date('Y-m-d H:i:s')];
        $mySQLFunction->insert("users", $credentialColumns, $credentialValues);

        // Insert data into TEACHER table
        $studentColumns = ['stu_lrn', 'stu_fname', 'stu_mname', 'stu_lname', 'stu_address', 'stu_contact', 'stu_gender', 'stu_email', 'stu_dob', 'stu_pob', 'father_name', 'mother_name', 'parent_contact', 'image', 'id'];

        $studentValues = [$lrnID, $fname, isset($_POST["mname"]) ? strtoupper(trim($_POST["mname"])) : null, $lname, $address, $scontact, $gender, $email, $dob, $pob, $father, $mother, $pcontact, null, $uid];

        $mySQLFunction->insert("student", $studentColumns, $studentValues);

        // Set success session variable and redirect
        $_SESSION['insert_student'] = true;
        header("Location: ../index.php?page=student");
    } catch (Exception $e) {
        // Set error session variable and redirect
        $_SESSION['error_student'] = $e->getMessage();
        header("Location: ../index.php?page=student");
    } finally {
        // Close the database connection
        $mySQLFunction->disconnect();
    }
    exit(0);
}
