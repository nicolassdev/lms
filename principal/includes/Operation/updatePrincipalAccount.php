<?php
session_start();

if (!isset($_SESSION["principal_id"])) {
    header("location:../../../login.php?error=accessdenied");
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        // Get the student ID and old password input from the POST data
        $principal_id = $_POST["principalid"];
        $oldPasswordInput = trim($_POST["oldpass"]);

        // Establish the database connection
        $mySQLFunction->connection();

        // Fetch the current user details using getAccountStudent
        $userRow = $mySQLFunction->getAccountUser($principal_id);

        if (!$userRow) {
            throw new Exception("User not found.");
        }

        // Encrypt the provided old password to compare
        $oldPasswordEncrypted = $mySQLFunction->encrypt($oldPasswordInput);

        // Verify the old password
        if ($oldPasswordEncrypted !== $userRow['password']) {
            $_SESSION['password_error'] = "Incorrect old password. Please try again.";
            header("location:../../index.php?page=principal_account");
            exit();
        }

        // Proceed to update if passwords match
        if (isset($_POST["submit"])) {
            $username = trim($_POST["username"]);
            $newPassword = isset($_POST["newpass"]) ? trim($_POST["newpass"]) : null;
            $confirmPassword = isset($_POST["confirmpass"]) ? trim($_POST["confirmpass"]) : null;

            // Confirm password validation
            if ($newPassword !== $confirmPassword) {
                $_SESSION['password_error'] = "Passwords do not match. Please try again.";
                header("location:../../index.php?page=principal_account");
                exit();
            }

            // Check if the username has changed
            if ($username !== $userRow['username']) {
                // If a user with the same username exists and it's not the current username, prevent the update
                $existingUser = $mySQLFunction->getUsers("username", $username);
                if ($existingUser && $existingUser['id'] != $principal_id) {
                    $_SESSION['user_taken'] = true;
                    $_SESSION["username"] = $username;
                    header("location:../../index.php?page=principal_account");
                    exit();
                }
                // Update the username in the database for the current user
                $mySQLFunction->updateUser("username", $username, $principal_id);
            }

            // Update the password if provided
            if ($newPassword) {
                $newPasswordEncrypted = $mySQLFunction->encrypt($newPassword);
                $mySQLFunction->updateUser("password", $newPasswordEncrypted, $principal_id);
            }

            // Disconnect and finalize the update
            $mySQLFunction->disconnect();
            $_SESSION['update_user'] = true;
            header("location:../../index.php?page=principal_account");
            exit();
        }
    } catch (Exception $e) {
        error_log("Error updating user details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details: " . $e->getMessage();
        header("location:../../../404.php");
        exit();
    }
}
