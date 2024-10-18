<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("section", "section_code", $_GET["id"]);

    $_SESSION['deleted'] = "Section has been deleted successfully.";
    header("location:../../index.php?page=section");
    exit();
    $mySQLFunction->disconnect();
}
