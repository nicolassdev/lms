
<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("subject", "sub_code", $_GET["id"]);

    $_SESSION['deleted'] = "Subject has been deleted successfully.";
    header("location:../../index.php?page=subject");
    exit();
    $mySQLFunction->disconnect();
}
