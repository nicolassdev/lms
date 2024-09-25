<?php
session_start();
if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the teacher page
    header("Location: index.php?page=schoolyear");
    exit();
} else {
    require_once("../../includes/dbh-inc.php");

    $syear = trim($_POST["schoolyear"]);

    $mySQLFunction->connection();

    // Check if the semester already exists
    $existingSy = $mySQLFunction->checkExistingSY("sy", $syear);


    if ($existingSy) {
        // If the semester already exists, redirect back with an error
        $_SESSION['error_insert'] = "School year has been already taken.";
        header("Location: ../index.php?page=schoolyear");
    } else {
        $mySQLFunction->insertSy("sy", $syear);

        $_SESSION['insert'] = "School year has been inserted successfuly";
        header("Location: ../index.php?page=schoolyear");
    }

    $mySQLFunction->disconnect();
    exit();
}
