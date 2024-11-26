<?php
session_start(); // Start the session

if (empty($_SESSION['teacher_id'])) {
    header("location:../../../login.php?error=accessdenied"); // Redirect if not logged in
    exit();
} else {
    include "../../../includes/dbh-inc.php"; // Include database connection

    try {
        if (isset($_POST['submit'])) {
            $teacherID = $_SESSION['teacher_id'];

            // Clean and transform input data
            $fname = isset($_POST['firstname']) ? strtoupper(trim($_POST['firstname'])) : null;
            $mname = isset($_POST['middlename']) ? strtoupper(trim($_POST['middlename'])) : null;
            $lname = isset($_POST['lastname']) ? strtoupper(trim($_POST['lastname'])) : null;
            $contact = isset($_POST['contact']) ? strtoupper(trim($_POST['contact'])) : null;
            $gender = isset($_POST['gender']) ? strtoupper(trim($_POST['gender'])) : null;
            // $email = isset($_POST['email']) ? trim($_POST['email']) : null;
            $dob = isset($_POST['dob']) ? trim($_POST['dob']) : null;
            $employement = isset($_POST['employementstatus']) ? strtoupper(trim($_POST['employementstatus'])) : null;
            $address = isset($_POST['address']) ? strtoupper(trim($_POST['address'])) : null;


            // Store cleaned data in an associative array
            $store = [
                'teacher_fname' => $fname,
                'teacher_mname' => $mname,
                'teacher_lname' => $lname,
                'teacher_contact' => $contact,
                'teacher_gender' => $gender,
                'teacher_dob' => $dob,
                'status' => $employement,
                'teacher_address' => $address,


            ];

            // Establish database connection
            $mySQLFunction->connection();

            // Update student information in the database
            $mySQLFunction->updateTeacherAndStudentInfo('TEACHER', $store, 'teacher_id',  $teacherID);

            // Set session variable for successful update
            $_SESSION['update_faculty'] = true;

            // Redirect to student profile page
            header("location:/lms/faculty/index.php?page=teacher_prof");
            exit();
        }
    } catch (Exception $e) {
        // Log error message for debugging
        error_log("Error updating student: " . $e->getMessage());

        // Set session variable for error feedback
        $_SESSION['isnot_update'] = true;

        // Redirect to error page or student profile
        header("location:/lms/faculty/index.php?page=teacher_prof");
        exit();
    } finally {
        // Disconnect from the database
        $mySQLFunction->disconnect();
    }
}
