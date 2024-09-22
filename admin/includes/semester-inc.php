<?php

if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the semester page
    header("Location: index.php?page=semester");
    exit();
} else {
    require_once("../../includes/dbh-inc.php");

    $semester = trim($_POST["semester"]);

    // Establish a connection to the database
    $mySQLFunction->connection();

    // Check if the semester already exists
    $existingSemester = $mySQLFunction->checkExistingSem("semester", $semester);

    if ($existingSemester) {
        // If the semester already exists, redirect back with an error
        $_SESSION['error_semester'] = true;
        header("Location: ../index.php?page=semester");
    } else {
        // If the semester does not exist, insert it
        $mySQLFunction->insertSem("semester", $semester);
        $_SESSION['insert_semester'] = true;
        header("Location: ../index.php?page=semester");
    }

    // Disconnect from the database
    $mySQLFunction->disconnect();
    exit();
}
?>
