
<?php
session_start();

if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=semester");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("semester", "semester_name", $_GET["id"]);

    $_SESSION['deleted'] = "Semester has been deleted successfully.";
    header("location:../../index.php?page=semester");
    exit();
    $mySQLFunction->disconnect();
}
