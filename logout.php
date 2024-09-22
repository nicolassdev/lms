<?php
session_start();
session_destroy();
// header("location:login.php");
header("refresh:1 ; url=login.php");
exit();
