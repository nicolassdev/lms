<?php
// Define the directory where modules are stored
$uploadDir = '../../assets/Module/';

$subCode = trim($_GET["sub_code"] ?? '');
$strandCode = trim($_GET["strand_code"] ?? '');
$gradeLvl = trim($_GET["grade_lvl"] ?? '');

if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']); // Remove directory paths
    $filePath = $uploadDir . $fileName;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set appropriate headers for download
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Define the MIME type based on file extension
        $contentType = match ($extension) {
            'pdf' => 'application/pdf',
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'txt' => 'text/plain',
            'zip' => 'application/zip',
            'doc', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            default => 'application/octet-stream',
        };

        header('Content-Description: File Transfer');
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Output the file for download
        readfile($filePath);
        exit;
    } else {
        // Handle file not found
        http_response_code(404);
        echo "Error: File does not exist.";
        // throw new Exception("The LRN and Username must be the same. No data will be inserted.");
        // $_SESSION['error'] = "Error: File does not exist.";
        // header("Location: ../index.php?page=subject_list&sub_code=" . urlencode($subCode) . "&strand_code=" . urlencode($strandCode) . "&grade_lvl=" . urlencode($gradeLvl));
        // exit();
    }
} else {
    // Handle missing file parameter
    http_response_code(400);
    echo "Error: No file specified.";
}
