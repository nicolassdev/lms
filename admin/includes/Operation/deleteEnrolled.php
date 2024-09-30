
<?php
session_start();
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=enrollment");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("enroll", "stu_lrn", $_GET["id"]);


    $_SESSION['deleted'] = "Enrolled student has been deleted successfully.";
    header("location:../../index.php?page=enrollment");
    exit();
    $mySQLFunction->disconnect();
}
