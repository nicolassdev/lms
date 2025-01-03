<?php
session_start();

if (!isset($_POST["submit"])) {
    $sched_id = $_GET['sched_id'] ?? '';
    $sub_id = $_GET['sub_code'] ?? '';
    $sec_id = $_GET['section_code'] ?? '';
    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} else {
    include "../../includes/dbh-inc.php";

    $sched_id = trim($_POST["schedID"] ?? '');
    $sub_id = trim($_POST["subID"] ?? '');
    $sec_id = trim($_POST["secID"] ?? '');
    $module_id = trim($mySQLFunction->generateID("MOD-"));

    $mySQLFunction->connection();

    try {


        // Check the number of uploads already for this subject and session
        $stmt = $mySQLFunction->con->prepare("SELECT COUNT(*) FROM module WHERE sched_id = ?");
        $stmt->bind_param("s", $sched_id);
        $stmt->execute();
        $stmt->bind_result($uploadCount);
        $stmt->fetch();
        $stmt->close();

        // Check if the limit of 5 uploads is reached
        if ($uploadCount >= 5) {
            $_SESSION['error'] = "You have already uploaded 5 modules for this subject.";
            header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
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
                    $_SESSION['error'] = "Invalid file type: $fileType. Please upload allowed file types only.";
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }

                if ($fileSize > $maxFileSize) {
                    $_SESSION['error'] = "File too large. Maximum size allowed is " . $mySQLFunction->formatFileSize($maxFileSize);
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }

                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];
                if (!in_array($fileExtension, $allowedExtensions)) {
                    $_SESSION['error'] = "Invalid file extension. Allowed extensions are: " . implode(', ', $allowedExtensions);
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }

                $uploadFileDir = '../../assets/Module/';
                if (!is_dir($uploadFileDir)) mkdir($uploadFileDir, 0755, true);
                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $formattedSize = $mySQLFunction->formatFileSize($fileSize);
                    $stmt = $mySQLFunction->con->prepare("INSERT INTO module (module_id, file_name, file_size, formatted_size, file_type, sched_id) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $module_id, $dest_path, $fileSize, $formattedSize, $fileType, $sched_id);

                    if ($stmt->execute()) {
                        $_SESSION['success'] = "File successfully uploaded.";
                        header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                        exit();
                    } else {
                        $_SESSION['error'] = "Database error: " . $stmt->error;
                        header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                        exit();
                    }
                } else {
                    $_SESSION['error'] = "Error moving uploaded file.";
                    header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                    exit();
                }
            } else {
                $_SESSION['error'] = "No file uploaded.";
                header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
                exit();
            }
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../index.php?page=student_subject_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
        exit();
    } finally {
        $mySQLFunction->disconnect();
    }
}
