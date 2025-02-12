<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["registrar_id"])) {
    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("quarterly", "quarterly_name", $_GET["id"]);

    $_SESSION['deleted'] = "Quarter has been deleted successfully.";
    header("location:../../index.php?page=quarterly");
    exit();
    $mySQLFunction->disconnect();
}
