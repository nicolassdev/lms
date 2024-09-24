<?php
session_start();


if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=schoolyear");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();

    // Pass the ID to updateActiveSy function to update the correct row
    $mySQLFunction->setSchoolYear("sy", "status", $_GET["id"]);
    $_SESSION['setactive'] = "School year has been set successfully.";

    header("location:../../index.php?page=schoolyear");
    exit();
    $mySQLFunction->disconnect();
}
