<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the teacher page
    header("Location: index.php?page=admin");
    exit();
} else {

    // Include database connection and helper functions
    include "../../includes/dbh-inc.php";

    // Set timezone
    date_default_timezone_set('Asia/Manila');

    // Initialize variables with POST data and sanitize them
    $role = isset($_POST["role"]) ? strtoupper(trim($_POST["role"])) : null;
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
    $userpwd = isset($_POST["password"]) ? trim($_POST["password"]) : null;

    $fname = isset($_POST["firstname"]) ? strtoupper(trim($_POST["firstname"])) : null;
    $lname = isset($_POST["lastname"]) ? strtoupper(trim($_POST["lastname"])) : null;
    $contact = isset($_POST["contact"]) ? trim($_POST["contact"]) : null;
    $gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
    $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;

    // Generate unique IDs
    $uid = trim($mySQLFunction->generateUserID());
    $prin_id = trim($mySQLFunction->generateAdminID());

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
            throw new Exception("user already taken. No data will be inserted.");
        }

        // Encrypt password if provided
        $encryptedPassword = $userpwd ? $mySQLFunction->encrypt($userpwd) : null;

        // Insert data into USERS table
        $credentialColumns = ['id', 'username', 'password', 'role', 'date_added'];
        $credentialValues = [$uid, $username, $encryptedPassword, $role, date('Y-m-d H:i:s')];
        $mySQLFunction->insert("USERS", $credentialColumns, $credentialValues);

        // Insert data into principal table
        $principalColumns = ['principal_id', 'firstname', 'middlename', 'lastname', 'contact', 'gender', 'email', 'address', 'id'];
        $principalValues = [$prin_id, $fname, isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null, $lname, $contact, $gender, $email, $address,  $uid];
        $mySQLFunction->insert("PRINCIPAL", $principalColumns, $principalValues);

        // Set success session variable and redirect
        $_SESSION['insert_admin'] = true;
        header("Location: ../index.php?page=admin");
    } catch (Exception $e) {
        // Set error session variable and redirect
        $_SESSION['error_principal'] = $e->getMessage();
        header("Location: ../index.php?page=admin");
    } finally {
        // Close the database connection
        $mySQLFunction->disconnect();
    }
    exit(0);
}
