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

        // Common session variables
        // $_SESSION["ID"] = $credential["ID"];
        // $_SESSION["USERNAME"] = $username;

        // Prepare redirect URL
        $redirectUrl = '';

        // Determine the redirect URL based on user role
        if ($userRole === "STUDENT") {

            $studentCredential = $mySQLFunction->getStudentCredential("ID", $credential["ID"]);
            $_SESSION["stu_lrn"] = $studentCredential["stu_lrn"];
            $_SESSION["stu_fname"] = $studentCredential["stu_fname"];
            $_SESSION["stu_lname"] = $studentCredential["stu_lname"];

            //redirect to url 
            header("location: ../loading.php?redirect=" . urlencode("./index.php?page=student_home"));
            exit();
        } elseif ($userRole === "TEACHER") {

            $teacherCredential = $mySQLFunction->getTeacherCredential("ID", $credential["ID"]);
            $_SESSION["TEACHER_ID"] = $teacherCredential["TEACHER_ID"];
            $_SESSION["TEACHER_FNAME"] = $teacherCredential["TEACHER_FNAME"];

            //redirect to url 
            header("location: ../loading.php?redirect=" . urlencode("./faculty/index.php?page=teacher_dashboard"));
            exit();
            // $redirectUrl = "../index.php?page=teacher_home";
        } elseif ($userRole === "ADMIN") {
            session_start();
            $user = $mySQLFunction->getCredential("username", $username);
            $adminCredential = $mySQLFunction->getAdminCredential("id", $user["id"]);

            $_SESSION["id"] = $adminCredential["id"];
            $_SESSION["principal_id"] = $adminCredential["principal_id"];
            $_SESSION["username"] = $username;



            //redirect to url 
            header("location:../loading.php?redirect=" . urlencode("./admin/index.php?page=home"));
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
