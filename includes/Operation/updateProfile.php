<?php
session_start();

if (empty($_SESSION['stu_lrn'])) {
    header("location:../../login.php?error=accessdenied");
    exit();
}

include "../../includes/dbh-inc.php";

try {
    if (isset($_POST['submit'])) {
        $student_id = $_SESSION['stu_lrn'];

        $fields = [
            'stu_fname' => 'firstname',
            'stu_mname' => 'middlename',
            'stu_lname' => 'lastname',
            'stu_address' => 'address',
            'stu_contact' => 'scontact',
            'stu_gender' => 'gender',
            'stu_email' => 'email',
            'stu_dob' => 'dob',
            'stu_pob' => 'pob',
            'father_name' => 'fathername',
            'mother_name' => 'mothername',
            'parent_contact' => 'pcontact'
        ];

        $store = array_map(fn($key) => strtoupper(trim($_POST[$key] ?? '')), $fields);      // Cleaning and Transforming Input Data
        $mySQLFunction->connection();
        $mySQLFunction->updateStudentInfo($store, $student_id);

        $_SESSION['update_student'] = true;
        header("location:/lms/index.php?page=student_prof");
        exit();
    }
} catch (Exception $e) {
    error_log("Error updating student: " . $e->getMessage());
    // $_SESSION['update_error'] = $e->getMessage();
    $_SESSION['update_student'] = true;
    header("location:/lms/index.php?page=student_prof");
    exit();
} finally {
    $mySQLFunction->disconnect();
}
