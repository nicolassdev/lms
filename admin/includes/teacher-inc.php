<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("location:index.php?page=teacher");
    exit();
} else {
    include "../../includes/dbh-inc.php";
    date_default_timezone_set('Asia/Manila');
    $uid =  trim($mySQLFunction->generateUserID());
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
    $fname = isset($_POST["firstname"]) ? strtoupper(trim($_POST["firstname"])) : null;
    $lname = isset($_POST["lastname"]) ? strtoupper(trim($_POST["lastname"])) : null;

    $mySQLFunction->connection();

    try {
        // Check if the username already exists
        $checkUsernameSql = "SELECT * FROM `users` WHERE `username` = '" . mysqli_real_escape_string($mySQLFunction->con, $username) . "'";
        $checkUsernameResult = $mySQLFunction->con->query($checkUsernameSql);

        if ($checkUsernameResult && $checkUsernameResult->num_rows > 0) {
            throw new Exception("Username already taken. No data will be inserted.");
        }

        // Check if the teacher with the same first and last name already exists
        $checkTeacherSql = "SELECT * FROM `teacher` WHERE `teacher_fname` = '" . mysqli_real_escape_string($mySQLFunction->con, $fname) . "' AND `teacher_lname` = '" . mysqli_real_escape_string($mySQLFunction->con, $lname) . "'";
        $checkTeacherResult = $mySQLFunction->con->query($checkTeacherSql);

        if ($checkTeacherResult && $checkTeacherResult->num_rows > 0) {
            throw new Exception("Teacher with this first name and last name already exists. No data will be inserted.");
        }

        // If all checks pass, proceed with the insertion
        $uid = trim($mySQLFunction->generateUserID());
        $userpwd = isset($_POST["password"]) ? $mySQLFunction->encrypt(trim($_POST["password"])) : null;
        $role = isset($_POST["role"]) ? strtoupper(trim($_POST["role"])) : null;
        $date = date('Y-m-d H:i:s'); // Get the current date and time

        $id = trim($mySQLFunction->generateTeacherID());
        $mname = isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null;
        $contact = trim($_POST["contact"]);
        $gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
        $dob =  trim($_POST["dob"]);
        $status = isset($_POST["status"]) ? strtoupper(trim($_POST["status"])) : null;
        $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;

        $credentialColumns = ['id', 'username', 'password', 'role', 'added_date'];
        $credentialValues = [$uid, $username, $userpwd, $role, $date];

        $teacherColumns = ['teacher_id', 'teacher_fname', 'teacher_mname', 'teacher_lname', 'teacher_contact', 'teacher_gender', 'teacher_dob', 'status', 'teacher_address', 'id'];
        $teacherValues = [$id, $fname, $mname, $lname, $contact, $gender, $dob, $status, $address, $uid];

        $mySQLFunction->insertTeacher("USERS", $credentialColumns, $credentialValues);
        $mySQLFunction->insertTeacher("TEACHER", $teacherColumns, $teacherValues);

        $_SESSION['insert_success'] = true; // Set session variable
        header("location:../index.php?page=teacher");
        exit();
    } catch (Exception $e) {
        $_SESSION['insert_error'] = $e->getMessage(); // Set session error message
        header("location:../index.php?page=teacher"); // Redirect back to the form
        exit();
    }

    $mySQLFunction->disconnect();
}
