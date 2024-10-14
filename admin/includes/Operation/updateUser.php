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
            $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;
            $confirmPassword = isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : null;

            // Password validation
            if ($password !== $confirmPassword) {
                $_SESSION['password_error'] = "Password does not match.";
                header("location:../../index.php?page=users");
                exit();
            }

            // Check if the new username already exists and is not the current user's username
            $existingUser = $mySQLFunction->getUsers("username", $username);

            if ($existingUser && $existingUser['id'] != $id) {
                // Username is taken and is not the current user's username
                $_SESSION['user_taken'] = true;
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
                $mySQLFunction->updateUser("password", $mySQLFunction->encrypt($password), $id); // Encrypt and update password
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
?>
