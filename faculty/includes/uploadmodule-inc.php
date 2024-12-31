<?php
session_start(); // Start the session

if (!isset($_POST["submit"])) {
    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} else {
    include "../../includes/dbh-inc.php";
    // if (!isset($sched_id) || !isset($sub_code) || !isset($section_code)) {
    //     die("Required parameters are missing!");
    // }
    // Initialize variables with POST data
    $module_id = trim($mySQLFunction->generateID("MOD-"));
    $sched_id = trim($_POST["schedID"] ?? null);
    $sub_id = trim($_POST["subID"] ?? null);
    $sec_id = trim($_POST["secID"] ?? null);



    $mySQLFunction->connection(); // Establish database connection

    try {

        // Define allowed file types
        $allowedImageTypes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp'
        ];

        $allowedDocumentTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation', // .pptx
            'text/plain'
        ];

        $excludedFileTypes = ['audio/aac', 'application/octet-stream'];


        // Combine all allowed types
        $allowedTypes = array_merge($allowedImageTypes, $allowedDocumentTypes);

        // Maximum file size (in bytes) - 10MB
        $maxFileSize = 10 * 1024 * 1024;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $fileType = $_FILES['file']['type'];

                // Validation checks
                $errors = [];

                // Check file type
                if (!in_array($fileType, $allowedTypes)) {
                    // Combine all errors into a single string separated by line breaks
                    $_SESSION['error'] =  "<small><b>File type not allowed.</b> <br> Allowed types are: PDF, Word, Excel, PowerPoint, Text documents, and Images (JPEG, PNG, GIF, WEBP).</small>";
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }

                // Check for excluded file types
                if (in_array($fileType, $excludedFileTypes)) {
                    $_SESSION['error'] = "<small><b>File type '{$excludedFileTypes}' is not allowed.</b> <br> Please upload valid file types such as PDF, Word, Excel, PowerPoint, Text documents, or Images (JPEG, PNG, GIF, WEBP).</small>";
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }


                // Check file size
                if ($fileSize > $maxFileSize) {
                    $_SESSION['error'] = "File is too large. Maximum size allowed is " . $mySQLFunction->formatFileSize($maxFileSize);
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }

                // Additional security check with file extension
                $fileExtension = strtolower($mySQLFunction->getFileExtension($fileName)); // Convert extension to lowercase for consistency
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt']; // Allowed types

                if (!in_array($fileExtension, $allowedExtensions)) {
                    // Add error message to the errors array
                    $errors[] = "File extension not allowed. Allowed extensions are: " . implode(', ', $allowedExtensions);
                    // Store error messages in the session for display
                    $_SESSION['error'] = implode('<br>', $errors);
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }


                if (empty($errors)) {
                    $formattedSize = $mySQLFunction->formatFileSize($fileSize);

                    // Generate unique filename to prevent overwriting
                    $uploadFileDir = '../../assets/Module/';
                    $dest_path = $uploadFileDir . $fileName;

                    if (!is_dir($uploadFileDir)) {
                        mkdir($uploadFileDir, 0755, true);
                    }

                    // INSERTING THE MODULE 
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO module (module_id, file_name, file_size, formatted_size, file_type, sched_id) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("ssssss", $module_id, $dest_path, $fileSize, $formattedSize, $fileType, $sched_id);

                        if ($stmt->execute()) {
                            // Set session success message
                            $_SESSION['success'] = "File successfully uploaded. File size: " . $formattedSize;
                            header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                            exit();
                        } else {
                            $_SESSION['error'] = "Error: " . $stmt->error;
                            header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                            exit();
                        }
                        $stmt->close();
                    } else {
                        $_SESSION['error'] = "There was an error moving the uploaded file.";
                        header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                        exit();
                    }
                } else {
                    // foreach ($errors as $error) {
                    //     $_SESSION['error'] = "$error";
                    //     header("Location: ../index.php?page=student_subject_list");
                    //     exit();
                    // }
                    if (!empty($errors)) {
                        // Combine all errors into a single string separated by line breaks
                        $_SESSION['error'] = implode('<br>', $errors);
                        header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                        exit();
                    }
                }
            } else {
                $_SESSION['error'] = "No file uploaded or there was an upload error.";
                header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                exit();
            }
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $mySQLFunction->con->rollback();

        // Set error session message
        $_SESSION['error_subject'] = $e->getMessage();
        header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
        exit();
    } finally {
        // Close the connection
        $mySQLFunction->disconnect();
    }
}
