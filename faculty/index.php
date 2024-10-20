<?php
session_start();
 if (isset($_SESSION['user_role'])) {
    
    $user_role = strtolower($_SESSION['user_role']);
    if( $user_role !== 'teacher'){
        header("location:../login.php?error=accessdenied");
        exit();
    }else {
       include("./includes/teacher-header.php");
    }

} else{
    header("location:../login.php");
    exit();
}  
?>
 