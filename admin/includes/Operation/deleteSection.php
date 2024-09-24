
<?php
session_start();
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=section");
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
