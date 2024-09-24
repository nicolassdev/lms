
<?php
session_start();
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=student");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("users", "id", $_GET["id"]);


    $_SESSION['deleted'] = "Student Details has been deleted successfully.";
    header("location:../../index.php?page=student");
    exit();
    $mySQLFunction->disconnect();
}
