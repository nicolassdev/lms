<?php
// Redirect if accessed without submitting the form
if (!isset($_POST["submit"])) {
    header("location:../login.php?error=accessdismissed");
    exit();
}

require_once "dbh-inc.php";
$mySQLFunction->connection();

// Get user input
$username = trim($_POST["username"]);
$passwordHash = $mySQLFunction->encrypt(trim($_POST["password"]));

// Verify login credentials
if ($mySQLFunction->checkLogin($username, $passwordHash)) {
    // Fetch the main user credentials
    $credential = $mySQLFunction->getCredential("users", "username", $username);
    $userRole = $credential["role"];

    // Common session data
    $commonData = [
        "username" => $credential["username"],
        "user_role" => $credential["role"],
        "id" => $credential["id"]
    ];

    // Format the added date
    $addedDate = new DateTime($credential["date_added"]);
    $formattedDate = $addedDate->format("F j, Y");

    // Role-specific configuration STUDENT , TEACHER, PRINCIPA, AND REGISTRAR .
    $roleConfig = [
        "STUDENT" => [
            "table" => "student",
            "fields" => ["stu_lrn", "stu_fname", "stu_lname"],
            "redirect" => "./index.php"
        ],
        "TEACHER" => [
            "table" => "teacher",
            "fields" => ["teacher_id", "teacher_fname", "teacher_lname", "teacher_gender"],
            "redirect" => "./faculty/index.php"
        ],
        "PRINCIPAL" => [
            "table" => "principal",
            "fields" => ["principal_id", "firstname", "lastname"],
            "redirect" => "./principal/index.php"
        ],
        "REGISTRAR" => [
            "table" => "registrar",
            "fields" => ["registrar_id", "firstname", "lastname"],
            "redirect" => "./admin/index.php"
        ]
    ];

    // Check if the user's role exists in the role configuration
    if (isset($roleConfig[$userRole])) {
        $roleData = $roleConfig[$userRole];

        // Fetch role-specific credentials
        $roleCredential = $mySQLFunction->getCredential($roleData["table"], "id", $credential["id"]);

        // Merge common and role-specific session data
        $sessionData = array_merge($commonData, array_intersect_key($roleCredential, array_flip($roleData["fields"])));
        $sessionData[$userRole . "_added"] = $formattedDate; // Add the formatted date to the session dynamically

        // Save session data and redirect the user
        $mySQLFunction->setSessionData($sessionData);

        // Redirect to the loading page with role data in query parameters
        header("location: ../loading.php?redirect=" . urlencode($roleData["redirect"]) . "&status=success");
        exit();
    }

    // Redirect for an invalid role
    header("location:../login.php?error=invalidrole");
    exit();
} else {
    // Redirect for invalid credentials
    header("location:../login.php?error=invalidcredentials");
    exit();
}
