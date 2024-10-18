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
            $strand = strtoupper(trim($_POST["strand_code"]));
            $gradelvl = strtoupper(trim($_POST["gradelvl"]));
            $section = strtoupper(trim($_POST["section"]));

            // Check if section name already exist 
            if ($mySQLFunction->checkSectionName("section", "section_name", $section, $sec_id) == 1) {
                $_SESSION['sectionupdate_error'] = "<small>Section already exists. Please choose different details.</small>";
                header("location:../../index.php?page=section");
                exit();
            }

            // Check if the same grade level and section name already exist (excluding the current record)
            if ($mySQLFunction->checkRowCountSection("section", $section, $gradelvl, $sec_id) > 0) {
                $_SESSION['sectionupdate_error'] = "<small>Section and Grade level combination already exists. Please choose different details.</small>";
                header("location:../../index.php?page=section");
                exit();
            } else {
                // Proceed with updating the section details
                $mySQLFunction->updateSection("strand_code", $strand, $sec_id);
                $mySQLFunction->updateSection("grade_lvl", $gradelvl, $sec_id);
                $mySQLFunction->updateSection("section_name", $section, $sec_id);

                // Disconnect after updating
                $mySQLFunction->disconnect();

                // Set session variable to indicate successful update
                $_SESSION['update_section'] = true;
                header("location:../../index.php?page=section");
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
