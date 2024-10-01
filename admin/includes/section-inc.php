<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: index.php?page=section");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    // Initialize variables with POST data
    $code = trim($mySQLFunction->generateSectionCode());
    $strandcode = trim($_POST["strand_code"] ?? null);
    $gradelvl = strtoupper(trim($_POST["gradelvl"] ?? null));
    $section = strtoupper(trim($_POST["section"] ?? null));
    $sem = trim($_POST["semester"] ?? null);
    $advisor = trim($_POST["teacher_id"] ?? null);

    $mySQLFunction->connection(); // Establish database connection

    try {
        // Start transaction
        $mySQLFunction->con->begin_transaction();

        // Prepare a statement for checking if section already exists
        $checkSectionSql = "
            SELECT 1 FROM `section` 
            WHERE `strand_code` = ? AND `grade_lvl` = ? AND `section_name` = ?
            LIMIT 1";
        $stmt = $mySQLFunction->con->prepare($checkSectionSql);
        $stmt->bind_param("sss", $strandcode, $gradelvl, $section);
        $stmt->execute();
        $stmt->store_result();

        // Check if a record exists
        if ($stmt->num_rows > 0) {
            throw new Exception("Strand grade level with this section name already exists. No data will be inserted.");
        }

        // Close the prepared statement
        $stmt->close();

        // Insert section data into `section` table using prepared statements
        $insertSection = "
            INSERT INTO `section` (`section_code`, `strand_code`, `grade_lvl`, `section_name`, `semester`, `teacher_id`) 
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mySQLFunction->con->prepare($insertSection);
        $stmt->bind_param("ssssss", $code, $strandcode, $gradelvl, $section, $sem, $advisor);
        $stmt->execute();

        // Commit the transaction
        $mySQLFunction->con->commit();

        // Set session success message
        $_SESSION['insert_section'] = true;
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
