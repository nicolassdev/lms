<!-- UPDATE ENROLLLMENT  -->
<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $enrollID = $_GET["id"];
        // Establish the database connection
        $mySQLFunction->connection();
        $activeSem = $mySQLFunction->checkSemStatus('semester');
        // Fetch the current teacher details
        // todo $enrollRow = $mySQLFunction->getEnroll("stu_lrn", $enrollID);

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["enrollID"];
            $status = strtoupper(trim($_POST["status"]));

            // Update the teacher details
            // $mySQLFunction->updateEnrollment("section_code	", $section, $id);
            $mySQLFunction->updateEnrollment("enroll_status", $status, $id, $activeSem);

            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_enroll'] = true;
            header("location:../../index.php?page=enrollment");
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
