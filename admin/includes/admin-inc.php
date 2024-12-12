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
    $uid = trim($mySQLFunction->generateID("USER-"));
    // Generate registrar ID
    $reg_id = trim($mySQLFunction->generateID("REG-"));

    // Establish database connection
    $mySQLFunction->connection();
    try {
        // Directory for uploads
        $uploadDir = "../../assets/Upload/";
        $imagePath = null; // Default to null if no file is uploaded

        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageName = uniqid('IMG-', true) . '-' . basename($_FILES['image']['name']); // Unique file name
            $imagePath = $uploadDir . $imageName;

            // Move the uploaded file to the target directory
            if (!move_uploaded_file($imageTmpName, $imagePath)) {
                throw new Exception("Failed to upload image.");
            }

            // Save only the relative path to store in the database
            $imagePath = str_replace('../../assets/', '', $imagePath);
        } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Handle other upload errors
            $_SESSION['teacherupdate_error'] = "Image upload error. Error code: " . $_FILES['image']['error'];
            header("location:../index.php?page=admin");
            exit();
        }

        // Proceed with checking username
        $usernameExists = $mySQLFunction->checkUserExist($username);
        if ($usernameExists) {
            $_SESSION['teacherupdate_error'] = "Username has been already taken.";
            header("location:../index.php?page=admin");
            exit();
        }

        // Encrypt password if provided
        $encryptedPassword = $userpwd ? $mySQLFunction->encrypt($userpwd) : null;

        // Insert data into USERS table
        $credentialColumns = ['id', 'username', 'password', 'role', 'date_added'];
        $credentialValues = [$uid, $username, $encryptedPassword, $role, date('Y-m-d H:i:s')];
        $mySQLFunction->insert("USERS", $credentialColumns, $credentialValues);

        // Insert data into registrar table
        $registrarColumns = ['registrar_id', 'firstname', 'middlename', 'lastname', 'contact', 'gender', 'email', 'address', 'image', 'id'];
        $registrarValues = [$reg_id, $fname, isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null, $lname, $contact, $gender, $email, $address, $imagePath, $uid];
        $mySQLFunction->insert("REGISTRAR", $registrarColumns, $registrarValues);

        // Set success session variable and redirect
        $_SESSION['insert_admin'] = true;
        header("Location: ../index.php?page=admin");
    } catch (Exception $e) {
        // Debugging purposes
        var_dump($e);
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ../index.php?page=admin");
    } finally {
        // Close the database connection
        $mySQLFunction->disconnect();
    }
    exit(0);
}
