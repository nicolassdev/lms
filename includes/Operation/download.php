<?php
// Define the directory where modules are stored
$uploadDir = '../../faculty/module_uploaded/';


$errorModal = ''; // Initialize error modal message

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
        // File not found
        $errorModal = "The file you're trying to download does not exist.";
    }
} else {
    // Missing file parameter
    $errorModal = "No file specified. Please select a file to proceed.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - File Download</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <?php if ($errorModal): ?>
        <!-- Error Modal -->
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="errorModalLabel">
                            <i class="bi bi-exclamation-circle me-2"></i>File Error
                        </h5>
                    </div>
                    <div class="modal-body text-center">
                        <p class="fs-5">Files was deleted.<br><?php echo htmlspecialchars($errorModal); ?></p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a href="/lms/index.php?page=student_module" class="btn btn-danger">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Show the error modal automatically
            document.addEventListener("DOMContentLoaded", function() {
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            });
        </script>
    <?php endif; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>