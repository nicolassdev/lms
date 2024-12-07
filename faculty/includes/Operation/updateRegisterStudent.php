<!-- UPDATE ENROLLLMENT  -->
<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["teacher_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $enrollID = $_GET["id"];
        // Establish the database connection
        $mySQLFunction->connection();
        $activeSem = $mySQLFunction->getActiveSemester();
        // Fetch the current teacher details
        // todo $enrollRow = $mySQLFunction->getEnroll("stu_lrn", $enrollID);

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["enrollID"];
            $status = strtoupper(trim($_POST["status"]));

            // Define the conditions for the WHERE clause
            $whereConditions = [
                "stu_lrn" => $id,           // Student learner's number
                "semester" => $activeSem    // Active semester
            ];
            // Update the status field in enroll table
            $mySQLFunction->updateRecord("enroll", "enroll_status", $status, $whereConditions);


            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['success'] = "Enrollment has been updated successfully.";
            header("location:../../index.php?page=register_student");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating teacher details: " . $e->getMessage());
        $_SESSION['sectionupdate_error'] = "An error occurred while updating the section details.";
        header("location:../../error.php");
        exit();
    }
}
