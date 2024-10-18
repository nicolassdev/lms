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
        $userID = $mySQLFunction->getCredential("id", $user_id);
        $userRole = $credential["role"];

        $redirectUrl = '';

        // Determine the redirect URL based on user role
        if ($userRole === "STUDENT") {
            session_start();
            $user = $mySQLFunction->getCredential("username", $username);
            $studentCredential = $mySQLFunction->getStudentCredential("id", $user["id"]);
            $_SESSION["id"] = $studentCredential["id"];
            $_SESSION["stu_lrn"] = $studentCredential["stu_lrn"];
            $_SESSION["stu_fname"] = $studentCredential["stu_fname"];
            $_SESSION["stu_lname"] = $studentCredential["stu_lname"];

            $_SESSION["username"] = $user;  // username of student

            //redirect to url 
            header("location: ../loading.php?redirect=" . urlencode("./index.php"));
            exit();
        } elseif ($userRole === "TEACHER") {
            session_start();
            $user = $mySQLFunction->getCredential("username", $username);
            $teacherCredential = $mySQLFunction->getTeacherCredential("id", $user["id"]);
            $_SESSION["id"] = $teacherCredential["id"];

            $_SESSION["teacher_id"] = $teacherCredential["teacher_id"];
            $_SESSION["teacher_fname"] = $teacherCredential["teacher_fname"];
            $_SESSION["teacher_lname"] = $teacherCredential["teacher_lname"];

            $_SESSION["username"] = $username;

            //redirect to url 
            header("location: ../loading.php?redirect=" . urlencode("./faculty/index.php"));
            exit();
        } elseif ($userRole === "ADMIN") {
            session_start();

            $user = $mySQLFunction->getCredential("username", $username);
            $adminCredential = $mySQLFunction->getAdminCredential("id", $user["id"]);

            $_SESSION["id"] = $adminCredential["id"];
            $_SESSION["principal_id"] = $adminCredential["principal_id"];
            $_SESSION["firstname"] = $adminCredential["firstname"];
            $_SESSION["lastname"] = $adminCredential["lastname"];

            $_SESSION["username"] = $username;  // username of admin

            //redirect to url 
            header("location:../loading.php?redirect=" . urlencode("./admin/index.php"));
            exit();
        } else {
            header("location:../login.php?error=invalidrole");
            exit();
        }

        // Redirect to loading page
        header("location: loading.php?redirect=" . urlencode($redirectUrl));
        exit();
    } else {
        // Invalid credentials
        header("location:../login.php?error=invalidcredentials");
        exit();
    }
}
