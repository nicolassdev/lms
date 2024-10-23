<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the teacher page
    header("Location: index.php?page=teacher");
    exit();
}

include "../../includes/dbh-inc.php"; // Include database connection and helper functions

date_default_timezone_set('Asia/Manila'); // Set timezone

// Initialize variables with POST data and sanitize them
$username = trim($_POST["username"] ?? null);
$fname = strtoupper(trim($_POST["firstname"] ?? null));
$lname = strtoupper(trim($_POST["lastname"] ?? null));
$userpwd = trim($_POST["password"] ?? null);
$role = strtoupper(trim($_POST["role"] ?? null));
$contact = trim($_POST["contact"] ?? null);
$gender = strtoupper(trim($_POST["gender"] ?? null));
$dob = trim($_POST["dob"] ?? null);
$status = strtoupper(trim($_POST["status"] ?? null));
$address = strtoupper(trim($_POST["address"] ?? null));
$date_added = date("Ymd");


// Generate unique IDs
$uid = trim($mySQLFunction->generateUserID());
$teacherID = trim($mySQLFunction->generateTeacherID());

$mySQLFunction->connection(); // Establish database connection

try {
    // Start transaction
    $mySQLFunction->con->begin_transaction();

    // Use a single query to check both username and teacher's name
    $checkSql = "
        SELECT 
            (SELECT COUNT(*) FROM `users` WHERE `username` = ?) AS username_exists,
            (SELECT COUNT(*) FROM `teacher` WHERE `teacher_fname` = ? AND `teacher_lname` = ?) AS teacher_exists
    ";
    $stmt = $mySQLFunction->con->prepare($checkSql);
    $stmt->bind_param("sss", $username, $fname, $lname);
    $stmt->execute();
    $stmt->bind_result($username_exists, $teacher_exists);
    $stmt->fetch();
    $stmt->close();

    if ($username_exists > 0) {
        throw new Exception("Username already taken. No data will be inserted.");
    }
    if ($teacher_exists > 0) {
        throw new Exception("Teacher with this first name and last name already exists. No data will be inserted.");
    }

    // Encrypt password if provided
    $encryptedPassword = $userpwd ? $mySQLFunction->encrypt($userpwd) : null;

    // Insert data into USERS table
    $insertUserSql = "INSERT INTO USERS (id, username, password, role, date_added) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mySQLFunction->con->prepare($insertUserSql);
    $stmt->bind_param("sssss", $uid, $username, $encryptedPassword, $role, date('Y-m-d H:i:s'));
    $stmt->execute();
    $stmt->close();

    // Insert data into TEACHER table
    $insertTeacherSql = "
        INSERT INTO TEACHER (teacher_id, teacher_fname, teacher_mname, teacher_lname, teacher_contact, teacher_gender, teacher_dob, status, teacher_address, date_added, id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";
    $stmt = $mySQLFunction->con->prepare($insertTeacherSql);
    $stmt->bind_param(
        "sssssssssss",
        $teacherID,
        $fname,
        strtoupper(trim($_POST["middlename"] ?? null)),
        $lname,
        $contact,
        $gender,
        $dob,
        $status,
        $address,
        $date_added,
        $uid
    );
    $stmt->execute();
    $stmt->close();

    // Commit the transaction
    $mySQLFunction->con->commit();

    // Set success session variable and redirect
    $_SESSION['insert_success'] = true;
    header("Location: ../index.php?page=teacher");
} catch (Exception $e) {
    // Rollback transaction in case of error
    $mySQLFunction->con->rollback();

    // Set error session variable and redirect
    $_SESSION['insert_error'] = $e->getMessage();
    header("Location: ../index.php?page=teacher");
} finally {
    // Close the database connection
    $mySQLFunction->disconnect();
}
exit();
