<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the teacher page
    header("Location: index.php?page=teacher");
    exit();
}

// Include database connection and helper functions
include "../../includes/dbh-inc.php";

// Set timezone
date_default_timezone_set('Asia/Manila');

// Initialize variables with POST data and sanitize them
$username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
$fname = isset($_POST["firstname"]) ? strtoupper(trim($_POST["firstname"])) : null;
$lname = isset($_POST["lastname"]) ? strtoupper(trim($_POST["lastname"])) : null;
$userpwd = isset($_POST["password"]) ? trim($_POST["password"]) : null;
$role = isset($_POST["role"]) ? strtoupper(trim($_POST["role"])) : null;
$contact = isset($_POST["contact"]) ? trim($_POST["contact"]) : null;
$gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
$dob = isset($_POST["dob"]) ? trim($_POST["dob"]) : null;
$status = isset($_POST["status"]) ? strtoupper(trim($_POST["status"])) : null;
$address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;

// Generate unique IDs
$uid = trim($mySQLFunction->generateUserID());
$teacherID = trim($mySQLFunction->generateTeacherID());

// Establish database connection
$mySQLFunction->connection();

try {
    // Check if username already exists
    $checkUsernameSql = "SELECT * FROM `users` WHERE `username` = ?";
    $stmt = $mySQLFunction->con->prepare($checkUsernameSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $checkUsernameResult = $stmt->get_result();

    if ($checkUsernameResult->num_rows > 0) {
        throw new Exception("Username already taken. No data will be inserted.");
    }

    // Check if teacher with the same name already exists
    $checkTeacherSql = "SELECT * FROM `teacher` WHERE `teacher_fname` = ? AND `teacher_lname` = ?";
    $stmt = $mySQLFunction->con->prepare($checkTeacherSql);
    $stmt->bind_param("ss", $fname, $lname);
    $stmt->execute();
    $checkTeacherResult = $stmt->get_result();

    if ($checkTeacherResult->num_rows > 0) {
        throw new Exception("Teacher with this first name and last name already exists. No data will be inserted.");
    }

    // Encrypt password if provided
    $encryptedPassword = $userpwd ? $mySQLFunction->encrypt($userpwd) : null;

    // Insert data into USERS table
    $credentialColumns = ['id', 'username', 'password', 'role', 'added_date'];
    $credentialValues = [$uid, $username, $encryptedPassword, $role, date('Y-m-d H:i:s')];
    $mySQLFunction->insert("USERS", $credentialColumns, $credentialValues);

    // Insert data into TEACHER table
    $teacherColumns = ['teacher_id', 'teacher_fname', 'teacher_mname', 'teacher_lname', 'teacher_contact', 'teacher_gender', 'teacher_dob', 'status', 'teacher_address', 'id'];
    $teacherValues = [$teacherID, $fname, isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null, $lname, $contact, $gender, $dob, $status, $address, $uid];
    $mySQLFunction->insert("TEACHER", $teacherColumns, $teacherValues);

    // Set success session variable and redirect
    $_SESSION['insert_success'] = true;
    header("Location: ../index.php?page=teacher");
} catch (Exception $e) {
    // Set error session variable and redirect
    $_SESSION['insert_error'] = $e->getMessage();
    header("Location: ../index.php?page=teacher");
} finally {
    // Close the database connection
    $mySQLFunction->disconnect();
}
exit();
