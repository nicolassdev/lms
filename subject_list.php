<?php
include "./includes/dbh-inc.php";

// Prevent unauthorized access
if (!isset($_SESSION['stu_lrn'])) {
    header("location:./login.php?error=accessdenied");
    exit;
}
$mySQLFunction->connection();

// Initialize $modules to avoid undefined variable warning
$modules = [];

if (!empty($_GET['sub_code']) && !empty($_GET['strand_code']) && !empty($_GET['grade_lvl'])) {

    // Retrieve values from GET
    $sub_code = $_GET['sub_code'];
    $strand_code = $_GET['strand_code'];
    $grade_lvl = $_GET['grade_lvl'];;

    // Fetch modules based on student information and subject handled by the teacher
    // $modules = $mySQLFunction->getModuleOfStudentBySectionStrandAndGradelevel($_SESSION['stu_lrn'], $sub_code, $strand_code, $grade_lvl);
    $modules = $mySQLFunction->getModuleOfStudentByStrandAndGradelevel($sub_code, $strand_code, $grade_lvl);

    // echo "<pre>";
    // print_r($modules);
    // echo "</pre>";
}


// include "../faculty/includes/Forms/uploadmoduleform.php";
?>



<style>
    .data-table {
        font-size: 0.8em;
        /* Reduce font size */
    }

    .table th,
    .table td {
        padding: 0.1rem;
        /* Adjust padding */
    }
</style>

<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center ms-3 me-3">
                        <h5 class="fw-bold">
                            <div class="fs-6 text-muted">
                                <?php
                                if (!empty($modules)) {
                                    foreach ($modules as $module) {
                                        echo htmlspecialchars($module['sub_title']);
                                        break; // Exit loop after displaying subtitle
                                    }
                                } else {
                                    echo "<div class='text-danger'>NO MODULE FOUND!</div>"; // Optional: Display a message when there are no modules
                                }
                                ?>
                            </div>
                            <div class="fs-6 text-muted">
                                <?php
                                if (!empty($modules)) {
                                    echo htmlspecialchars($module['grade_lvl']) . ' ' . htmlspecialchars($module['strand_name']) . ' ';
                                } else {
                                    echo "<small class='text-danger'>No uploaded modules for now.</small>"; // Optional: Display fallback content
                                }
                                ?><br>
                                Modules
                            </div>
                        </h5>

                        <!-- Search Module  -->
                        <div class="d-flex justify-content-end">
                            <input type="text" id="searchInput" class="form-control form-control-sm w-100 me-1" placeholder="Search modules...">
                            <i class="bi bi-search ms-1 fs-4"></i>
                        </div>

                    </div>


                    <!-- Table displaying student modules -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Filename</th>
                                    <th>Uploaded Date</th>
                                    <th>Uploaded by</th>
                                    <th class="text-center">Module</th>
                                </tr>
                            </thead>

                            <tbody id="modulesTableBody">
                                <?php
                                if (!empty($modules)) {
                                    $count = 1;
                                    foreach ($modules as $row) {
                                        // Extract the base file name for display
                                        $fileNameForDisplay = basename($row['file_name']);
                                        $fileNameForDownload = htmlspecialchars($row['file_name']); // Prevent XSS attacks

                                        echo '<tr>';
                                        echo '<td>' . $count++ . '</td>';
                                        echo '<td>' . ucwords(strtolower($fileNameForDisplay)) . '</td>';
                                        echo '<td>' . date('F j, Y', strtotime($row["uploaded_date"])) . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["teacher_fname"] . ' ' . $row["teacher_lname"])) . '</td>';

                                        //  Download link
                                        // echo '<td><a href="faculty/includes/download.php?file=' . urlencode($fileNameForDownload) . '" class="btn btn-success btn-sm">';
                                        // echo '<i class="fas fa-download"></i> Download</a></td>';

                                        echo '
                                        <td class="d-flex justify-content-center">
                                          <button class="btn btn-sm btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#download_module' . $row['module_id'] . '">
                                            <i class="fas fa-download"></i>Download
                                          </button>
                                          <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#upload_answer' . $row['module_id'] . '">
                                            <i class="fas fa-download"></i>Upload
                                          </button>
                                        </td>
                                        ';

                                        echo '</tr>';


                                        // todo Modal for download module subject
                                        echo '
                                        <div class="modal fade" id="download_module' . $row['module_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-success">
                                                              <h1 class="text-success"><i class="bi bi-cloud-arrow-down" style="font-size: 120px;"></i></h1>
                                                        </div>
                                                        <h5 class="mb-4 text-dark fw-bold">Download Module <br/>"<span class="text-success">' . ucwords(strtolower($fileNameForDisplay)) . '</span>" ?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-2 mb-4">

                                                        <a href="includes/Operation/download.php?file=' . urlencode($fileNameForDownload) . '" class="btn btn-success px-4 py-2 me-3" style="width: 120px;">Download</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

                                        // todo Upload for module subject
                                        echo '
                                        <!-- STUDENT INFORMATION ENTRY MODAL -->
                                        <div class="modal fade" id="upload_answer' . $row['module_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                               <div class="modal-content shadow-lg">
                                                    <div class="modal-body">
                                                        <!-- Modal Title & Icon -->
                                                        <div class="text-center mb-4">
                                                            <h1 class="text-primary"><i class="bi bi-cloud-arrow-up" style="font-size: 120px;"></i></h1>
                                                            <h5 class="font-weight-bold text-dark">Upload Module</h5>
                                                        </div>

                                                        <!-- Form Upload -->
                                                        <form id="uploadFileForm" action="includes/Operation/upload.php" method="POST" enctype="multipart/form-data" autocomplete="off" class="row g-2 needs-validation" novalidate>
                                                            <input type="hidden" name="subID" value="' . htmlspecialchars($_GET['sub_code']) . '"> <!-- SCHEDULE ID -->
                                                            <input type="hidden" name="strandID" value="' . htmlspecialchars($_GET['strand_code']) . '"> <!-- SUBJECT ID -->
                                                            <input type="hidden" name="gLevel" value="' . htmlspecialchars($_GET['grade_lvl']) . '"> <!-- SECTION ID -->
                                                            <input type="hidden" name="modID" value="' . $row['module_id']  . '"> <!-- SECTION ID -->
                                                            <input type="hidden" name="studID" value="' . $_SESSION['stu_lrn']  . '"> <!-- SECTION ID -->



                                                            <!-- Error Alert -->
                                                            <div id="errorAlert" class="alert alert-danger d-none" role="alert">
                                                                <strong>Error:</strong> <span id="errorMessage"></span>
                                                            </div>

                                                            <!-- File Input -->
                                                            <div class="mb-4">
                                                            <label class="fs-6 fw-bold text-muted">' . ucwords(strtolower($fileNameForDisplay)) . '</label><br/>
                                                                <label for="fileInput" class="fs-6 mb-2 text-muted">Select a file to upload</label>
                                                                <input type="file" class="form-control form-control-lg border-primary" id="fileInput" name="file" required>
                                                                <div class="mt-2">
                                                                    <small style="font-size: 12px;">Allowed: <strong class="text-black">10MB</strong> - PDF, Word, Excel, PowerPoint, and Images (JPEG, PNG, WEBP).</small>
                                                                </div>
                                                                <div class="invalid-feedback">
                                                                    Please upload a file module.
                                                                </div>
                                                            </div>

                                                            <!-- Buttons -->
                                                            <div class="col-md-6 w-100">
                                                                <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Upload</button>
                                                            </div>
                                                              <div class="col-md-6 w-100">
                                                                <button type="button" class="btn btn-outline-secondary w-100 mt-2 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormUpload()">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            // Function to clear the form inputs and error messages
                                            function resetFormUpload() {
                                                const uploadFileForm = document.getElementById("uploadFileForm");
                                                uploadFileForm.reset();
                                                uploadFileForm.classList.remove("was-validated");

                                                const errorAlert = document.getElementById("errorAlert");
                                                errorAlert.classList.add("d-none");
                                                document.getElementById("errorMessage").textContent = "";
                                            }

                                            // JavaScript for Bootstrap validation and file upload constraints
                                            (() => {
                                                "use strict";
                                                const forms = document.querySelectorAll(".needs-validation");
                                                Array.prototype.slice.call(forms).forEach((form) => {
                                                    form.addEventListener("submit", (event) => {
                                                        if (!form.checkValidity()) {
                                                            event.preventDefault();
                                                            event.stopPropagation();
                                                        }
                                                        form.classList.add("was-validated");
                                                    }, false);
                                                });

                                                // File validation
                                                const fileInput = document.getElementById("fileInput");
                                                fileInput.addEventListener("change", function () {
                                                    const file = fileInput.files[0];
                                                    const errorAlert = document.getElementById("errorAlert");
                                                    const errorMessage = document.getElementById("errorMessage");

                                                    const allowedTypes = [
                                                        "application/pdf",
                                                        "application/vnd.ms-excel",
                                                        "application/msword",
                                                        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                                                        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                                                        "image/jpeg",
                                                        "image/png",
                                                        "image/webp"
                                                    ];
                                                    const maxSize = 10 * 1024 * 1024; // 10MB

                                                    if (file && !allowedTypes.includes(file.type)) {
                                                        errorAlert.classList.remove("d-none");
                                                        errorMessage.textContent = "Invalid file type. Allowed types: PDF, Word, Excel, PowerPoint, and Images.";
                                                        fileInput.value = "";
                                                    } else if (file && file.size > maxSize) {
                                                        errorAlert.classList.remove("d-none");
                                                        errorMessage.textContent = "File size exceeds 10MB.";
                                                        fileInput.value = "";
                                                    } else {
                                                        errorAlert.classList.add("d-none");
                                                        errorMessage.textContent = "";
                                                    }
                                                });
                                            })();
                                        </script>

                                        <style>
                                            #errorAlert {
                                                font-size: 14px;
                                                margin-bottom: 15px;
                                            }

                                            @media (max-width: 576px) {
                                                #upload_module .modal-dialog {
                                                    max-width: 95%;
                                                    margin: auto;
                                                }
                                            }
                                        </style>
                                        ';
                                    }
                                } else {
                                    echo '<tr><td colspan="5" class="text-center">No modules found.</td></tr>';
                                }
                                ?>

                                <tr id="noResultsMessage" style="display: none;">
                                    <td colspan="5" class="text-center">No modules found.</td>
                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#modulesTableBody tr');
        let hasMatch = false;

        rows.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            const match = cells.some(cell => cell.textContent.toLowerCase().includes(filter));
            row.style.display = match ? '' : 'none';
            if (match) hasMatch = true;
        });

        // Show or hide the "No results found" message
        const noResultsMessage = document.getElementById('noResultsMessage');
        noResultsMessage.style.display = hasMatch ? 'none' : '';
    });
</script>