
<?php

if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=users");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("users", "id", $_GET["id"]);
    $mySQLFunction->disconnect();
    header("location:../../index.php?page=users");
    exit();
}
