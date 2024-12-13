<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["registrar_id"])) {
    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        // Ensure 'id' is passed via GET
        if (!isset($_POST["schedID"])) {
            $_SESSION['error'] = "Enrollment ID not provided";
        }

        $schedID = $_POST["schedID"];

        // Establish the database connection
        $mySQLFunction->connection();
        // $activeSem = $mySQLFunction->checkSemStatus('semester');
        // $activeSem = $mySQLFunction->getActiveSemester();




        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["schedID"];  // This should be correctly set in your form, make sure the name attribute is 'schedID'
            $day = trim($_POST["day"] ?? null);
            $from =  strtoupper(trim($_POST["time_from"]) ?? null);
            $to =  strtoupper(trim($_POST["time_to"]) ?? null);




            // Update the 'requirements_submit' field with the submitted documents
            $mySQLFunction->updateRecord("schedule", "sched_day", $day, "sched_id", $id);
            $mySQLFunction->updateRecord("schedule", "sched_from", $from, "sched_id", $id);
            $mySQLFunction->updateRecord("schedule", "sched_to", $to, "sched_id", $id);

            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['success'] = "Schedule has been updated successfully.";
            header("location:../../index.php?page=schedule");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating enrollment: " . $e->getMessage());
        var_dump($e);
        // $_SESSION['sectionupdate_error'] = "An error occurred while updating the schedule.";
        // header("location:../../error.php");
        // exit();
    }
}
