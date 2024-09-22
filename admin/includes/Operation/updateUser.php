<?php
session_start(); // Ensure session is started

if (!isset($_POST["submit"])) {
    // Redirect if form is not submitted
    header("location:../../../index.php?page=users");
    exit();
} else {
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
            $id = $_POST["userID"];
            $username = trim($_POST["username"]);
            $password = isset($_POST["password"]) ? $mySQLFunction->encrypt(trim($_POST["password"])) : null;
            $role = strtoupper(trim($_POST["role"]));

            // Check if the new username already exists and is not the current user's username
            $existingUser = $mySQLFunction->getUsers("username", $username);

            if ($existingUser && $existingUser['id'] != $id) {
                // Username is taken and is not the current user's username
                $_SESSION['user_taken'] = true;
                // header("location:../../error.php");
                header("location:../../index.php?page=users");
                exit();
            }

            // Reconnect to the database for updating the information
            $mySQLFunction->connection();

            // Update the user details
            if ($username !== $userRow['username']) {
                $mySQLFunction->updateUser("username", $username, $id);
            }
            if ($password) {
                $mySQLFunction->updateUser("password", $password, $id);
            }
            if ($role !== $userRow['role']) {
                $mySQLFunction->updateUser("role", $role, $id);
            }

            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_user'] = true;
            header("location:../../index.php?page=users");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating user details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details.";
        header("location:../../error.php");
        exit();
    }
}
