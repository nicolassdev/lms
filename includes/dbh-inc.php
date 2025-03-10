<?php
include "function.php";
/* NOTE: IF YOUR USING PASSWORD IN YOUR DATABASE CHANGE MAKE CHANGE THE PASSWORD */
$mySQLFunction = new myDataBase(
    "localhost",                     // host
    "root",                          // Username
    "",                // Password
    "lms_db"                        // Database
);
