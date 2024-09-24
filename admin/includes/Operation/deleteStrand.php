
<?php
session_start();
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=strand");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("strand", "strand_code", $_GET["id"]);

    $_SESSION['deleted'] = "Strand has been deleted successfully.";
    header("location:../../index.php?page=strand");
    exit();
    $mySQLFunction->disconnect();
}
