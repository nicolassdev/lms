
<?php
session_start(); // Ensure session is started

if (!isset($_POST["submit"])) {
    // Redirect if form is not submitted
    header("location:../../../index.php?page=section");
    exit();
} else {
    include "../../../includes/dbh-inc.php";

    try {
        $sectionID = $_GET["id"];
        // Establish the database connection
        $mySQLFunction->connection();

        // Fetch the current teacher details
        $sectionRow = $mySQLFunction->getSection("section_code", $sectionID);
        $semrow = $mySQLFunction->getSemester("semester_name", $semid);

        if (isset($_POST["submit"])) {
            // Sanitize and prepare input
            $id = $_POST["sectionID"];
            $strand = strtoupper(trim($_POST["strand_code"]));
            $gradelvl = strtoupper(trim($_POST["gradelvl"]));
            $section = strtoupper(trim($_POST["section"]));
            $semester = trim($_POST["semester"]);
            $teacher_id = strtoupper(trim($_POST["teacher_id"]));

            // Check if the new firstname and lastname already exist for another teacher
            $existingSection = $mySQLFunction->checkSectionExist($strand, $section, $teacher_id,  $id);

            if ($existingSection) {
                // If the same firstname and lastname exist and the ID does not match, prevent update
                $_SESSION['sectionupdate_error'] = "A strand ,section and advisor has already exists. Please choose different details.";
                header("location:../../index.php?page=section");
                exit();
            }

            // Reconnect to the database for updating the information
            $mySQLFunction->connection();

            // Update the teacher details
            $mySQLFunction->updateSection("strand_code	", $strand, $id);
            $mySQLFunction->updateSection("grade_lvl", $gradelvl, $id);
            $mySQLFunction->updateSection("section_name	", $section, $id);
            $mySQLFunction->updateSection("semester	", $semester, $id);
            $mySQLFunction->updateSection("teacher_id", $teacher_id, $id);

            // Disconnect after updating
            $mySQLFunction->disconnect();

            // Set session variable to indicate successful update
            $_SESSION['update_section'] = true;
            header("location:../../index.php?page=section");
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
