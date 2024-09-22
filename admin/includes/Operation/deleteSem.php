
<?php

if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=semester");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("semester", "semester_name", $_GET["id"]);
    $mySQLFunction->disconnect();
    header("location:../../index.php?page=semester");
    exit();
}
