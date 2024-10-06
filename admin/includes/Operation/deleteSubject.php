
<?php
session_start();
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=subject");
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
