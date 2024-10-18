<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();

    // Pass the ID to updateActiveSy function to update the correct row
    $mySQLFunction->setSchoolYear("sy", "status", $_GET["id"]);
    $_SESSION['setactive'] = "School year has been set successfully.";

    header("location:../../index.php?page=schoolyear");
    exit();
    $mySQLFunction->disconnect();
}
