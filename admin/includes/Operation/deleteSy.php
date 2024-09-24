
<?php
session_start();
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=schoolyear");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("sy", "school_year", $_GET["id"]);
    $_SESSION['deleted'] = "School year has been deleted successfully.";

    header("location:../../index.php?page=schoolyear");
    exit();
    $mySQLFunction->disconnect();
}
