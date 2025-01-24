<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=section");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    // Initialize variables with POST data
    $code = trim($mySQLFunction->generateID("SECTION-"));
    $strandcode = trim($_POST["strand_code"] ?? null);
    $gradelvl = strtoupper(trim($_POST["gradelvl"] ?? null));
    $section = strtoupper(str_replace(' ', '', trim($_POST["section"] ?? null)));
    $advisor = trim($_POST["teacher_id"] ?? null);
    $sy = trim($_POST["school_year"] ?? null);
    $date_created = date("Ymd");

    $mySQLFunction->connection(); // Establish database connection

    try {

        // Check if section name already exist 
        if ($mySQLFunction->checkSectionName("section", "section_name", $section, $code) == 1) {
            $_SESSION['error_notify'] = "<small>Section already exists. Please choose different details.</small>";
            header("location:../index.php?page=section");
            exit();
        }

        // Check if the strand , grade level and section has already exist 
        if ($mySQLFunction->checkRowCountSection("section", $section, $gradelvl, $sec_id) > 0) {
            $_SESSION['error_notify'] = "<small>Section already exists. Please choose different details.</small>";
            header("location:../index.php?page=section");
            exit();
        }

        // Insert Section
        $sectionColumns = ['section_code', 'strand_code', 'grade_lvl', 'section_name', 'school_year', 'teacher_id', 'date_created'];
        $sectionValues = [$code, $strandcode, $gradelvl, $section, $sy, $advisor, $date_created];
        $mySQLFunction->insert("section", $sectionColumns, $sectionValues);


        // Set session success message
        $_SESSION['success_notify'] = "Section has been created successfully.";
        header("Location: ../index.php?page=section");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $mySQLFunction->con->rollback();

        // Set error session message
        $_SESSION['error_section'] = $e->getMessage();
        header("Location: ../index.php?page=section");
        exit();
    } finally {
        // Close the connection
        $mySQLFunction->disconnect();
    }
}
