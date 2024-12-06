<?php
session_start(); // Start the session

if (empty($_SESSION['teacher_id'])) {
    header("location:../../../login.php?error=accessdenied"); // Redirect if not logged in
    exit();
}

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
            'teacher_address' => $address
        ];

        // Check if an image file was uploaded
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $imageName = $_FILES['profile_image']['name'];
            $imageTmpName = $_FILES['profile_image']['tmp_name'];
            $imageSize = $_FILES['profile_image']['size'];
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            // Validate file type and size (e.g., allow only PNG/JPG and max size 2MB)
            $allowedExtensions = ['jpg', 'jpeg', 'webp', 'png'];
            if (in_array($fileExtension, $allowedExtensions) && $imageSize <= 2 * 1024 * 1024) {
                // Set a new unique name for the image
                $newImageName = uniqid("teacher_", true) . '.' . $fileExtension;

                // Define upload directory
                $uploadDir = "../../../assets/Upload/";
                $uploadPath = $uploadDir . $newImageName;

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($imageTmpName, $uploadPath)) {
                    // Update the store array to include the new image path
                    $store['image'] =  $newImageName; // Relative file path
                } else {
                    $_SESSION['teacherupdate_error'] = "Failed to upload image.";
                    header("location:../../index.php?page=admin");
                    exit();
                }
            } else {
                $_SESSION['teacherupdate_error'] = "Invalid file type or size.";
                header("location:../../index.php?page=admin");
                exit();
            }
        }

        // Establish database connection
        $mySQLFunction->connection();

        // Update teacher information in the database
        foreach ($store as $column => $value) {
            if ($value !== null) { // Only update non-null values
                $mySQLFunction->updateRecord("teacher", $column, $value, "teacher_id", $teacherID);
            }
        }

        // Set session variable for successful update
        $_SESSION['success'] = "Teacher Information has been updated successfully.";

        // Redirect to teacher profile page
        header("location:/lms/faculty/index.php?page=teacher_prof");
        exit();
    }
} catch (Exception $e) {
    // Log error message for debugging
    error_log("Error updating teacher: " . $e->getMessage());

    // Set session variable for error feedback
    $_SESSION['isnot_update'] = true;

    // Redirect to teacher profile
    header("location:/lms/faculty/index.php?page=teacher_prof");
    exit();
} finally {
    // Disconnect from the database
    $mySQLFunction->disconnect();
}
