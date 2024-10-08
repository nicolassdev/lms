
<?php
session_start(); // Ensure session is started

if (!isset($_POST["submit"])) {
    // Redirect if form is not submitted
    header("location:../../../index.php?page=section");
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {

        $mySQLFunction->connection();


        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["sectionID"];
            $strand = strtoupper(trim($_POST["strand_code"]));
            $gradelvl = strtoupper(trim($_POST["gradelvl"]));
            $section = strtoupper(trim($_POST["section"]));
            // $teacher = trim($_POST["teacher_id"]);


            if ($mySQLFunction->checkRowCount("section", "grade_lvl", $gradelvl) == 1) {
                $_SESSION['sectionupdate_error'] = "<small>Section and Grade level has already exists. Please choose different details.</small>";
                header("location:../../index.php?page=section");
                exit();
            } else {
                // Reconnect to the database for updating the information
                $mySQLFunction->connection();

                // Update the teacher details
                $mySQLFunction->updateSection("strand_code", $strand, $id);
                $mySQLFunction->updateSection("grade_lvl", $gradelvl, $id);
                $mySQLFunction->updateSection("section_name", $section, $id);
                // $mySQLFunction->updateSection("teacher_id", $teacher, $id);

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
        error_log("Error updating teacher details: " . $e->getMessage());
        $_SESSION['sectionupdate_error'] = "An error occurred while updating the section details.";
        header("location:../../error.php");
        exit();
    }
}
