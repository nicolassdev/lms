<?php
session_start();

if (!isset($_POST["submit"])) {
    $sub_code = $_GET['sub_code'] ?? '';
    $str_code = $_GET['strand_code'] ?? '';
    $gradelvl = $_GET['grade_lvl'] ?? '';

    header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
    exit();
} else {
    include "../../includes/dbh-inc.php";

    $sub_code = trim($_POST["subID"] ?? '');
    $str_code = trim($_POST["strandID"] ?? '');
    $gradelvl = trim($_POST["gLevel"] ?? '');

    $mod_id = trim($_POST["modID"] ?? '');
    $stud_id = trim($_POST["studID"] ?? '');
    // Generate unique id
    $ans_id = trim($mySQLFunction->generateID("ANS-"));
    $mySQLFunction->connection();

    try {


        // Check the number of uploads already for this subject and session
        $stmt = $mySQLFunction->con->prepare("SELECT COUNT(*) FROM module_answer WHERE module_id = ?");
        $stmt->bind_param("s", $mod_id);
        $stmt->execute();
        $stmt->bind_result($uploadCount);
        $stmt->fetch();
        $stmt->close();

        // Check if the limit of 5 uploads is reached
        if ($uploadCount >= 5) {
            $_SESSION['error_handler'] = "You have already uploaded 2 modules answer for this subject.";
            header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
            exit();
        }



        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $allowedDocumentTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain'
        ];
        $allowedTypes = array_merge($allowedImageTypes, $allowedDocumentTypes);
        $maxFileSize = 10 * 1024 * 1024;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileSize = $_FILES['file']['size'];
                $fileType = $_FILES['file']['type'];

                $errors = [];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['error_handler'] = "Invalid file type: $fileType. Please upload allowed file types only.";
                    header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
                    exit();
                }

                if ($fileSize > $maxFileSize) {
                    $_SESSION['error_handler'] = "File too large. Maximum size allowed is " . $mySQLFunction->formatFileSize($maxFileSize);
                    header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
                    exit();
                }

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];
                if (!in_array($fileExtension, $allowedExtensions)) {
                    $_SESSION['error_handler'] = "Invalid file extension. Allowed extensions are: " . implode(', ', $allowedExtensions);
                    header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
                    exit();
                }

                $uploadFileDir = '../../includes/uploaded_files/';
                if (!is_dir($uploadFileDir)) mkdir($uploadFileDir, 0755, true);
                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $formattedSize = $mySQLFunction->formatFileSize($fileSize);
                    $stmt = $mySQLFunction->con->prepare("INSERT INTO module_answer (answer_id, module_id, stu_lrn, file_name, file_size, formatted_size, file_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssssss", $ans_id, $mod_id, $stud_id, $dest_path, $fileSize, $formattedSize, $fileType);

                    if ($stmt->execute()) {
                        $_SESSION['success_handler'] = "File successfully uploaded.";
                        header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
                        exit();
                    } else {
                        $_SESSION['error_handler'] = "Database error: " . $stmt->error;
                        header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
                        exit();
                    }
                } else {
                    $_SESSION['error_handler'] = "Error moving uploaded file.";
                    header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&strand_code=" . urlencode($str_code) . "&grade_lvl=" . urlencode($gradelvl));
                    exit();
                }
            } else {
                $_SESSION['error_handler'] = "No file uploaded.";
                header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&sub_code=" . urlencode($str_code) . "&section_code=" . urlencode($gradelvl));
                exit();
            }
        }
    } catch (Exception $e) {
        $_SESSION['error_handler'] = "Error: " . $e->getMessage();
        header("Location:/lms/index.php?page=subject_list&sub_code=" . urlencode($sub_code) . "&sub_code=" . urlencode($str_code) . "&section_code=" . urlencode($gradelvl));
        exit();
    } finally {
        $mySQLFunction->disconnect();
    }
}
