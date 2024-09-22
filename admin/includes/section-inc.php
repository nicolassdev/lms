<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("location:index.php?page=section");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    // If all checks pass, proceed with the insertion

    $code = trim($mySQLFunction->generateSectionCode());
    $strandcode = isset($_POST["strand_code"]) ? trim($_POST["strand_code"]) : null;
    $gradelvl = isset($_POST["gradelvl"]) ? strtoupper(trim($_POST["gradelvl"])) : null;
    $section = isset($_POST["section"]) ? strtoupper(trim($_POST["section"])) : null;


    $mySQLFunction->connection();

    try {
        // Check if the strand with the same strandname and description already exists

        $checkSectionSql = "SELECT * FROM `section` WHERE `strand_code` = '" . mysqli_real_escape_string($mySQLFunction->con, $strandcode) . "' AND `grade_lvl` = '" . mysqli_real_escape_string($mySQLFunction->con, $gradelvl) . "'  AND `section_name` = '" . mysqli_real_escape_string($mySQLFunction->con, $section) . "' ";
        $checkSectionResult = $mySQLFunction->con->query($checkSectionSql);

        if ($checkSectionResult && $checkSectionResult->num_rows > 0) {
            throw new Exception("strand grade level with this section name already exists. No data will be inserted.");
        }

        $code = trim($mySQLFunction->generateSectionCode());
        $strandcode = isset($_POST["strand_code"]) ? trim($_POST["strand_code"]) : null;
        $gradelvl = isset($_POST["gradelvl"]) ? strtoupper(trim($_POST["gradelvl"])) : null;
        $section = isset($_POST["section"]) ? strtoupper(trim($_POST["section"])) : null;
        $sem = isset($_POST["semester"]) ? trim($_POST["semester"]): null;
        $advisor = isset($_POST["teacher_id"]) ? trim($_POST["teacher_id"]) : null;



        $strandColumns = ['section_code', 'strand_code', 'grade_lvl', 'section_name', 'semester', 'teacher_id '];
        $strandValues = [$code, $strandcode, $gradelvl, $section, $sem, $advisor];


        $mySQLFunction->insertSection("section", $strandColumns, $strandValues);

        $_SESSION['insert_section'] = true; // Set session variable
        $mySQLFunction->disconnect();
        header("location:../index.php?page=section");
        exit();
    } catch (Exception $e) {
        $_SESSION['error_section'] = $e->getMessage(); // Set session error message
        header("location:../index.php?page=section"); // Redirect back to the form
        exit();
    }

    $mySQLFunction->disconnect();
}
