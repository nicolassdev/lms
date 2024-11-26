<?php
session_start(); // Start the session

if (empty($_SESSION['stu_lrn'])) {
    header("location:../../login.php?error=accessdenied"); // Redirect if not logged in
    exit();
} else {
    include "../../includes/dbh-inc.php"; // Include database connection

    try {
        if (isset($_POST['submit'])) {
            $studentID = $_SESSION['stu_lrn'];

            // Clean and transform input data
            $fname = isset($_POST['firstname']) ? strtoupper(trim($_POST['firstname'])) : null;
            $mname = isset($_POST['middlename']) ? strtoupper(trim($_POST['middlename'])) : null;
            $lname = isset($_POST['lastname']) ? strtoupper(trim($_POST['lastname'])) : null;
            $address = isset($_POST['address']) ? strtoupper(trim($_POST['address'])) : null;
            $contact = isset($_POST['scontact']) ? strtoupper(trim($_POST['scontact'])) : null;
            $gender = isset($_POST['gender']) ? strtoupper(trim($_POST['gender'])) : null;
            $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $dob = isset($_POST['dob']) ? trim($_POST['dob']) : null;
            $pob = isset($_POST['pob']) ? trim($_POST['pob']) : null;
            $father_name = isset($_POST['fathername']) ? strtoupper(trim($_POST['fathername'])) : null;
            $mother_name = isset($_POST['mothername']) ? strtoupper(trim($_POST['mothername'])) : null;
            $parent_contact = isset($_POST['pcontact']) ? strtoupper(trim($_POST['pcontact'])) : null;

            // Store cleaned data in an associative array
            $store = [
                'stu_fname' => $fname,
                'stu_mname' => $mname,
                'stu_lname' => $lname,
                'stu_address' => $address,
                'stu_contact' => $contact,
                'stu_gender' => $gender,
                'stu_email' => $email,
                'stu_dob' => $dob,
                'stu_pob' => $pob,
                'father_name' => $father_name,
                'mother_name' => $mother_name,
                'parent_contact' => $parent_contact,
            ];

            // Establish database connection
            $mySQLFunction->connection();

            // Update student information in the database
            $mySQLFunction->updateTeacherAndStudentInfo('STUDENT', $store, 'stu_lrn', $studentID);

            // Set session variable for successful update
            $_SESSION['update_student'] = true;

            // Redirect to student profile page
            header("location:/lms/index.php?page=student_prof");
            exit();
        }
    } catch (Exception $e) {
        // Log error message for debugging
        error_log("Error updating student: " . $e->getMessage());

        // Set session variable for error feedback
        $_SESSION['isnot_update'] = true;

        // Redirect to error page or student profile
        header("location:/lms/index.php?page=student_prof");
        exit();
    } finally {
        // Disconnect from the database
        $mySQLFunction->disconnect();
    }
}
