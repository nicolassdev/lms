<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("location:index.php?page=strand");
    exit();
} else {
    include "../../includes/dbh-inc.php";

    // If all checks pass, proceed with the insertion
    $uid = trim($mySQLFunction->generateStrandCode());
    $strand = isset($_POST["strand"]) ? strtoupper(trim($_POST["strand"])) : null;
    $desc = isset($_POST["desc"]) ?  (trim($_POST["desc"])) : null;



    $mySQLFunction->connection();

    try {
        // Check if the strand with the same strandname and description already exists
        $checkStrandSql = "SELECT * FROM `strand` WHERE `strand_name` = '" . mysqli_real_escape_string($mySQLFunction->con, $strand) . "' OR `strand_desc` = '" . mysqli_real_escape_string($mySQLFunction->con, $desc) . "'";
        $checkStrandResult = $mySQLFunction->con->query($checkStrandSql);

        if ($checkStrandResult && $checkStrandResult->num_rows > 0) {
            throw new Exception("STRAND with this  DESCRIPTION already exists. No data will be inserted.");
        }


        $uid = trim($mySQLFunction->generateStrandCode());
        $strand = isset($_POST["strand"]) ? strtoupper(trim($_POST["strand"])) : null;
        $desc = isset($_POST["desc"]) ?  (trim($_POST["desc"])) : null;


        $strandColumns = ['strand_code', 'strand_name', 'strand_desc'];
        $strandValues = [$uid, $strand, $desc];


        $mySQLFunction->insertStrand("STRAND", $strandColumns, $strandValues);

        $_SESSION['insert_strand'] = true; // Set session variable
        header("location:../index.php?page=strand");
        exit();
    } catch (Exception $e) {
        $_SESSION['error_strand'] = $e->getMessage(); // Set session error message
        header("location:../index.php?page=strand"); // Redirect back to the form
        exit();
    }

    $mySQLFunction->disconnect();
}
