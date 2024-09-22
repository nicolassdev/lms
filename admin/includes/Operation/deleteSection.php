
<?php

if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=section");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $mySQLFunction->delete("section", "section_code", $_GET["id"]);
    // $mySQLFunction->delete("teacher", "teacher_id", $_GET["id"]);
    $mySQLFunction->disconnect();
    header("location:../../index.php?page=section");
    exit();
}
