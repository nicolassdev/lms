<?php
session_start(); // Ensure session is started

// Redirect to login if registrar is not logged in
if (!isset($_SESSION["registrar_id"])) {
    header("location:../../../login.php?error=accessdenied");
    exit();
}

include "../../../includes/dbh-inc.php";

try {
    $userID = $_GET["id"];

    // Establish the database connection
    $mySQLFunction->connection();

    // Fetch the current user details
    $userRow = $mySQLFunction->getUsers("id", $userID);

    // Check if the user exists
    if (!$userRow) {
        throw new Exception("User not found.");
    }

    if (isset($_POST["submit"])) {
        // Sanitize and prepare input
        $userID = $_POST["userID"];
        $username = trim($_POST["username"]);
        $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;
        $confirmPassword = isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : null;

        // Password validation
        if ($password !== $confirmPassword) {
            $_SESSION['password_error'] = "Password does not match.";
            header("location:../../index.php?page=users");
            exit();
        }

        // Validate and update username if it has changed and is not empty
        if (!empty($username) && $username !== $userRow['username']) {
            // Check for an existing user with the same username
            $existingUser = $mySQLFunction->getUsers("username", $username);

            if ($existingUser && strval($existingUser['id']) !== strval($userID)) {
                // Username is already taken by another user
                $_SESSION['user_taken'] = true;
                $_SESSION["username"] = $username;
                header("location:../../index.php?page=users");
                exit();
            } else {
                // Update the username
                $mySQLFunction->updateRecord("users", "username", $username, "id", $userID);
            }
        }

        // Update the password if provided
        if (!empty($password)) {
            $encryptedPassword = $mySQLFunction->encrypt($password);
            $mySQLFunction->updateRecord("users", "password", $encryptedPassword, "id", $userID);
        }

        // Disconnect from the database
        $mySQLFunction->disconnect();

        // Indicate successful update
        $_SESSION['update_user'] = true;
        header("location:../../index.php?page=users");
        exit();
    }
} catch (Exception $e) {
    // Handle exceptions and log errors
    error_log("Error updating user details: " . $e->getMessage());
    $_SESSION['update_error'] = "An error occurred while updating the user's details.";
    header("location:../../error.php");
    exit();
}
