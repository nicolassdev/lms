<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    try {
        if (isset($_POST["submit"])) {
            $name = isset($_POST["firstname"]) ? strtoupper(trim($_POST["firstname"])) : null;
            $mname = isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null;
            $lname = isset($_POST["lastname"]) ? strtoupper(trim($_POST["lastname"])) : null;
            $contact = isset($_POST["contact"]) ? strtoupper(trim($_POST["contact"])) : null;
            $gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;

            $store = [
                'firstname' => $name,
                'middlename' => $mname,
                'lastname' => $lname,
                'contact' => $contact,
                'gender' => $gender,
                'email' => $email,
                'address' => $address,
            ];

            $mySQLFunction->connection();
            $mySQLFunction->updateAdminInfo($store); // Pass the array directly

            $_SESSION['update_admin'] = true;
            header("location:../../index.php?page=admin");
            exit();
            $mySQLFunction->disconnect();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating admin details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details.";
        header("location:../../error.php");
        exit();
    }
}
