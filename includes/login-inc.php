<?php

if (!isset($_POST["submit"])) {
    header("location:../login.php?error=accessdismissed");
    exit();
} else {
    require_once "dbh-inc.php";
    $mySQLFunction->connection();

    $username = trim($_POST["username"]);
    $passwordHash = $mySQLFunction->encrypt(trim($_POST["password"]));

    // Check if username and password match
    if ($mySQLFunction->checkLogin($username, $passwordHash)) {
        session_start();

        // Get user credentials
        $credential = $mySQLFunction->getCredential("USERNAME", $username);


        $userRole = $credential["role"]; // Assume there's a ROLE field to identify if admin, teacher, or student


        // Common session variables
        $_SESSION["ID"] = $credential["ID"];
        $_SESSION["USERNAME"] = $username;

        // Redirect based on user role
        if ($userRole === "STUDENT") {
            $studentCredential = $mySQLFunction->getStudentCredential("ID", $credential["ID"]);
            $_SESSION["STU_LRN"] = $studentCredential["STU_LRN"];
            $_SESSION["STU_FNAME"] = $studentCredential["STU_FNAME"];

            // Redirect student to student dashboard
            header("location:../index.php?page=student_home");
            exit();
        } elseif ($userRole === "TEACHER") {
            $teacherCredential = $mySQLFunction->getTeacherCredential("ID", $credential["ID"]);
            $_SESSION["TEACHER_ID"] = $teacherCredential["TEACHER_ID"];
            $_SESSION["TEACHER_FNAME"] = $teacherCredential["TEACHER_FNAME"];

            // Redirect teacher to teacher dashboard
            header("location:../index.php?page=teacher_home");
            exit();
        } elseif ($userRole === "ADMIN") {
            $_SESSION["ADMIN_ID"] = $credential["ID"]; // Admin session
            $_SESSION["ADMIN_FNAME"] = $credential["FNAME"];

            // Redirect admin to admin dashboard
            header("location:../admin/index.php?page=admin_home");
            exit();
        } else {
            // Invalid role, show error
            header("location:../login.php?error=invalidrole");
            exit();
        }
    } else {
        // Invalid credentials
        header("location:../login.php?error=invalidcredentials");
        exit();
    }
}
