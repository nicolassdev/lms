<?php
require_once("../includes/dbh-inc.php");
$mySQLFunction->connection();
$result = $mySQLFunction->getSchool();
$mySQLFunction->disconnect();

if (isset($_POST["submit"])) {
    $name = isset($_POST["school"]) ? strtoupper(trim($_POST["school"])) : null;
    $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;
    $sy = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;


     
    $mySQLFunction->connection();
    $mySQLFunction->updateSchool("SCHOOL_NAME", $name);
    $mySQLFunction->updateSchool("SCHOOL_ADDRESS", $address);
    $mySQLFunction->disconnect();

    // Trigger the modal using a Bootstrap modal component
    echo '<script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById("updateModal"));
                myModal.show();
            });
          </script>';
}
