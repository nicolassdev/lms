<?php
 
if (!isset($_POST["submit"])) {
    // If the form was not submitted, redirect to the teacher page
    header("Location: index.php?page=schoolyear");
    exit();
}else{
    require_once("../../includes/dbh-inc.php");
 
    $syear = trim($_POST["schoolyear"]);

    $mySQLFunction->connection();
    $mySQLFunction->insertSy("sy", $syear);
    $mySQLFunction->disconnect();
    $_SESSION['insert_sy'] = true;
    header("Location: ../index.php?page=schoolyear");

}

 