<?php
session_start();

if (!isset($_SESSION["registrar_id"])) {
    header("location:../../../login.php?error=accessdenied");
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        // Get the student ID and old password input from the POST data
        $admin_id = $_POST["adminid"];
        $oldPasswordInput = trim($_POST["oldpass"]);

        // Establish the database connection
        $mySQLFunction->connection();

        // Fetch the current user details using getAccountStudent
        $userRow = $mySQLFunction->getAccountUser($admin_id);

        if (!$userRow) {
            throw new Exception("User not found.");
        }

        // Encrypt the provided old password to compare
        $oldPasswordEncrypted = $mySQLFunction->encrypt($oldPasswordInput);

        // Verify the old password
        if ($oldPasswordEncrypted !== $userRow['password']) {
            $_SESSION['password_error'] = "Incorrect old password. Please try again.";
            header("location:../../index.php?page=account");
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
                header("location:../../index.php?page=account");
                exit();
            }

            // Check for duplicate username
            $existingUser = $mySQLFunction->getUsers("username", $username);
            if ($existingUser && $existingUser['id'] != $admin_id) {
                $_SESSION['user_taken'] = true;
                $_SESSION["username"] = $username;
                header("location:../../index.php?page=account");
                exit();
            }

            // Update username if changed
            if ($username !== $userRow['username']) {
                $mySQLFunction->updateUser("username", $username, $admin_id);
            }

            // Update the password if provided
            if ($newPassword) {
                $newPasswordEncrypted = $mySQLFunction->encrypt($newPassword);
                $mySQLFunction->updateUser("password", $newPasswordEncrypted, $admin_id);
            }

            // Disconnect and finalize the update
            $mySQLFunction->disconnect();
            $_SESSION['update_user'] = true;
            header("location:../../index.php?page=account");
            exit();
        }
    } catch (Exception $e) {
        error_log("Error updating user details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details: " . $e->getMessage();
        header("location:../../404.php");
        exit();
    }
}
