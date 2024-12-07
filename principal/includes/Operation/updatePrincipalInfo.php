<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["principal_id"])) {

    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
} else {
    include "../../../includes/dbh-inc.php";
    try {
        if (isset($_POST["submit"])) {
            // Clean and transform input data
            $prinid = $_POST["prinID"];
            $name = isset($_POST["firstname"]) ? strtoupper(trim($_POST["firstname"])) : null;
            $mname = isset($_POST["middlename"]) ? strtoupper(trim($_POST["middlename"])) : null;
            $lname = isset($_POST["lastname"]) ? strtoupper(trim($_POST["lastname"])) : null;
            $contact = isset($_POST["contact"]) ? strtoupper(trim($_POST["contact"])) : null;
            $gender = isset($_POST["gender"]) ? strtoupper(trim($_POST["gender"])) : null;
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
            $address = isset($_POST["address"]) ? strtoupper(trim($_POST["address"])) : null;

            $store = [
                'firstname' => $name,
                'middlename' => $mname,
                'lastname' => $lname,
                'contact' => $contact,
                'gender' => $gender,
                'email' => $email,
                'address' => $address,
            ];


            // Check if an image file was uploaded
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $imageName = $_FILES['profile_image']['name'];
                $imageTmpName = $_FILES['profile_image']['tmp_name'];
                $imageSize = $_FILES['profile_image']['size'];
                $imageError = $_FILES['profile_image']['error'];
                $imageType = $_FILES['profile_image']['type'];

                // Validate file type and size (e.g., allow only PNG/JPG and max size 2MB)
                $allowedExtensions = ['jpg', 'jpeg', 'webp', 'png'];
                $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions) && $imageSize <= 2 * 1024 * 1024) {
                    // Set a new unique name for the image
                    $newImageName = uniqid("principal_", true) . '.' . $fileExtension;

                    // Define upload directory
                    $uploadDir = "../../../assets/Upload/";
                    $uploadPath = $uploadDir . $newImageName;

                    // Move the uploaded file to the desired directory
                    if (move_uploaded_file($imageTmpName, $uploadPath)) {
                        // Update the storePrincipalInfo array to include the new image path
                        $store['image'] = $newImageName;
                    } else {
                        $_SESSION['error_handler'] = "Failed to upload image.";
                        header("location:../../index.php?page=principal_prof");
                        exit();
                    }
                } else {
                    // throw new Exception("Invalid file type or size.");
                    $_SESSION['error_handler'] = "Invalid file type or size.";
                    header("location:../../index.php?page=principal_prof");
                    exit();
                }
            }


            $mySQLFunction->connection();
            // Update Principal information in the database
            foreach ($store as $column => $value) {
                if ($value !== null) { // Only update non-null values
                    $mySQLFunction->updateRecord("principal", $column, $value, "principal_id", $prinid);
                }
            }

            $_SESSION['update_principal'] = true;
            header("location:../../index.php?page=principal_prof");
            exit();
            $mySQLFunction->disconnect();
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        error_log("Error updating admin details: " . $e->getMessage());
        $_SESSION['update_error'] = "An error occurred while updating the user's details.";
        header("location:../../error.php");
        exit();
    }
}
