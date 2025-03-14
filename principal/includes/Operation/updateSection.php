<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $mySQLFunction->connection();

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $sec_id = $_POST["sectionID"];
            $section = strtoupper(trim($_POST["section"]));
            $gradelvl = strtoupper(trim($_POST["gradelvl"]));
            $sy = trim($_POST["school_year"]);

            // Check if section name already exist 
            if ($mySQLFunction->checkSectionName("section", "section_name", $section, $sec_id) == 1) {
                $_SESSION['error_notify'] = "<small>Section already exists. Please choose different details.</small>";
                header("location:../../index.php?page=section_list");
                exit();
            }

            // Check if the same grade level and section name already exist (excluding the current record)
            if ($mySQLFunction->checkRowCountSection("section", $section, $gradelvl, $sec_id) > 0) {
                $_SESSION['error_notify'] = "<small>Section and grade level combination already exists. Please choose different details.</small>";
                header("location:../../index.php?page=section_list");
                exit();
            } else {
                // Proceed with updating the section details

                $mySQLFunction->updateRecord("section", "section_name", $section, "section_code", $sec_id);
                $mySQLFunction->updateRecord("section", "grade_lvl", $gradelvl, "section_code", $sec_id);
                $mySQLFunction->updateRecord("section", "school_year", $sy, "section_code", $sec_id);

                // Disconnect after updating
                $mySQLFunction->disconnect();

                // Set session variable to indicate successful update
                $_SESSION['success_notify'] = "Section has been updated successfully.";
                header("location:../../index.php?page=section_list");
                exit();
            }
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating section details: " . $e->getMessage());
        $_SESSION['sectionupdate_error'] = "An error occurred while updating the section details.";
        header("location:../../error.php");
        exit();
    }
}
