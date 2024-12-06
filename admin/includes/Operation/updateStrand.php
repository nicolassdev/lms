<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["registrar_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $mySQLFunction->connection();

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $strand_id = $_POST["strandID"];
            $strandacro = strtoupper(trim($_POST["strand_acro"]));
            $strandname = strtoupper(trim($_POST["strand_name"]));

            // Check if strand name already exist database 
            $existingTeacher = $mySQLFunction->checkEntityExist('strand', 'strand_name', 'strand_desc', 'strand_code', $strandacro, $strandname, $strand_id);
            if ($existingTeacher) {
                // If the same firstname and lastname exist and the ID does not match, prevent update
                $_SESSION['teacherupdate_error'] = "Strand name has already exist";
                header("location:../../index.php?page=strand");
                exit();
            }

            // Reconnect to the database for updating the information
            $mySQLFunction->connection();


            // Proceed with updating the section details
            $mySQLFunction->updateRecord("strand", "strand_name", $strandacro, "strand_code", $strand_id);
            $mySQLFunction->updateRecord("strand", "strand_desc", $strandname, "strand_code", $strand_id);


            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_section'] = true;
            header("location:../../index.php?page=strand");
            exit();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating section details: " . $e->getMessage());
        $_SESSION['sectionupdate_error'] = "An error occurred while updating the section details.";
        header("location:../../error.php");
        exit();
    }
}
