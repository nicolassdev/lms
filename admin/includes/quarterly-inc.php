<?php
session_start();
if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the semester page
    header("Location: index.php?page=semester");
    exit();
} else {
    require_once("../../includes/dbh-inc.php");

    $quarter = trim($_POST["quarterly"]);

    // Establish a connection to the database
    $mySQLFunction->connection();

    // Check if the semester already exists
    $existingQuarter = $mySQLFunction->checkExistingQuarter("quarterly", $quarter);

    if ($existingQuarter) {
        // If the semester already exists, redirect back with an error
        $_SESSION['error'] = "Quarter has been already taken.";
        header("Location: ../index.php?page=quarterly");
    } else {
        // If the semester does not exist, insert it
        $mySQLFunction->insertQuarter("quarterly", $quarter);
        $_SESSION['success'] = "Quarter has been inserted successfuly";
        header("Location: ../index.php?page=quarterly");
    }

    // Disconnect from the database
    $mySQLFunction->disconnect();
    exit();
}
