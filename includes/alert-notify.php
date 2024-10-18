<?php
//WRONG PASSWORD OR USERNAME
if (isset($_GET["error"]) && $_GET["error"] == "invalidcredentials") {
    echo "<div class='alert-1'>
        <span class='alert-icon'>&#9888;</span> 
        Incorrect username and password
        </div>";
    header("refresh:2; url=login.php");
}

if (isset($_GET["error"]) && $_GET["error"] == "accessdenied") {
    echo "<div class='alert-1'>
        <span class='alert-icon'>&#9888;</span> 
        Access Dismissed!
        Please contact administrator.
        </div>";
    header("refresh:2; url=login.php");
}
