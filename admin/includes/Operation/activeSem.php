<?php
if (!isset($_GET["id"])) {
    header("location:../../../index.php?page=semester");
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    $mySQLFunction->connection();
    
    // Pass the ID to updateActiveSy function to update the correct row
    $mySQLFunction->setSemester("semester", "status", $_GET["id"]);
    
    $mySQLFunction->disconnect();
    header("location:../../index.php?page=semester");
    exit();
}

?>