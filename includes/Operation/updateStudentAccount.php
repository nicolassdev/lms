<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["stu_lrn"])) {
    header("location:../../login.php?error=accessdenied");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    try {
        // Get the student ID from the POST data
        $studentid = $_POST["studentid"];

        // Establish the database connection
        $mySQLFunction->connection();

        // Fetch the current user details
        $userRow = $mySQLFunction->getUsers("id", $studentid);

        if (!$userRow) {
            throw new Exception("User not found.");
        }

        if (isset($_POST["submit"])) {

            $studentid = $_POST["studentid"];
            $username = trim($_POST["username"]);
            $password = isset($_POST["newpass"]) ? trim($_POST["newpass"]) : null;
            $confirmPassword = isset($_POST["confirmpass"]) ? trim($_POST["confirmpass"]) : null;

            // Password validation
            if ($password !== $confirmPassword) {
                $_SESSION['password_error'] = "Password does not match.";
                header("location:/lms/index.php?page=student_account");
                exit();
            }

            // Check if the new username already exists
            $existingUser = $mySQLFunction->getUsers("username", $username);

            if ($existingUser && $existingUser['id'] != $studentid) {
                $_SESSION['user_taken'] = true;
                $_SESSION["username"] = $username;
                header("location:/lms/index.php?page=student_account");
                exit();
            }


            // Update the username in the database
            if ($username !== $userRow['username']) {
                $mySQLFunction->updateUser("username", $username, $studentid);
            }
            // Update the STUDENT ACCOUNT details
            if ($password) {
                $mySQLFunction->updateUser("password", $mySQLFunction->encrypt($password), $studentid); // Encrypt and update password
            }

            // Disconnect after updating
            $mySQLFunction->disconnect();

            $_SESSION['update_user'] = true;
            header("location:/lms/index.php?page=student_account");
            exit();
        }
    } catch (Exception $e) {
        error_log("Error updating user details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details: " . $e->getMessage();
        header("location:./404.php");
        exit();
    }
}
