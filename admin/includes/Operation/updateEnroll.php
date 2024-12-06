<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["registrar_id"])) {
    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        // Ensure 'id' is passed via GET
        if (!isset($_POST["enrollID"])) {
            throw new Exception("Enrollment ID not provided");
        }

        $enrollID = $_POST["enrollID"];

        // Establish the database connection
        $mySQLFunction->connection();
        // $activeSem = $mySQLFunction->checkSemStatus('semester');
        $activeSem = $mySQLFunction->getActiveSemester();

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["enrollID"];  // This should be correctly set in your form, make sure the name attribute is 'enrollID'

            // Define the required documents
            $requiredDocuments = ["SF9", "SF10", "PSA", "LCR", "GMCC"];

            // Get the submitted documents from the form
            $submittedDocuments = isset($_POST['requirement']) ? $_POST['requirement'] : [];

            // Convert the array of submitted documents into a string
            $submittedDocumentsString = implode(', ', $submittedDocuments);

            // Check if all required documents are submitted
            $allDocumentsSubmitted = !array_diff($requiredDocuments, $submittedDocuments);

            // Set the enrollment status based on the document submission
            $status = $allDocumentsSubmitted ? 'Enrolled' : 'Pending';

            // Define the conditions for the WHERE clause
            $whereConditions = [
                "stu_lrn" => $id,           // Student learner's number
                "semester" => $activeSem    // Active semester
            ];
            // Update the 'requirements_submit' field with the submitted documents
            $mySQLFunction->updateRecord("enroll", "requirements_submit", $submittedDocumentsString, $whereConditions);
            $mySQLFunction->updateRecord("enroll", "enroll_status", $status, $whereConditions);


            // $mySQLFunction->updateEnrolled("requirements_submit", $submittedDocumentsString, $id, $activeSem);

            // Update the 'enroll_status' field with the new status
            // $mySQLFunction->updateEnrolled("enroll_status", $status, $id, $activeSem);

            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_enroll'] = true;
            header("location:../../index.php?page=enrolled");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating enrollment: " . $e->getMessage());
        $_SESSION['sectionupdate_error'] = "An error occurred while updating the enrollment.";
        header("location:../../error.php");
        exit();
    }
}
