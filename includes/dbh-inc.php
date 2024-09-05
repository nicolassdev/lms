<?php
include "function.php";
$mySQLFunction = new myDataBase("localhost", "root", "Nicolas051002", "lms_db");

// IS SET ADD 
if (isset($_GET["add"])) {
    // FORM FOR TEACHER
    if ($_GET["add"] == "newTeacher") {
        include "../admin/includes/forms/teacherform.php";
    }
}


// IS SET ADD TEACHER 

if (isset($_POST['save'])) {
    $fgmember->addStudent();
    header("location: index.php");
}
