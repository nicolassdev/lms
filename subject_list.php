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
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center    ms-3 me-3">
                        <h5 class="fw-bold">
                            <div class="fs-5">
                                <?php
                                if (!empty($modules)) {
                                    foreach ($modules as $module) {
                                        echo htmlspecialchars($module['grade_lvl']) . ' ' . htmlspecialchars($module['strand_name']);
                                        break; // Exit loop after displaying grade and strand information
                                    }
                                }
                                ?>
                            </div>
                            Modules
                        </h5>

                        <!-- Upload Button -->
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#upload_module">
                                <i class="bi bi-cloud-arrow-up me-1"></i>Upload module answer
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <input type="text" id="searchInput" class="form-control form-control-sm w-25 me-2" placeholder="Search modules...">
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
                                    <th class="text-center">Download file</th>
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
                                        echo '<td>' . htmlspecialchars($fileNameForDisplay) . '</td>';
                                        echo '<td>' . date('F j, Y', strtotime($row["uploaded_date"])) . '</td>';
                                        echo '<td>' . htmlspecialchars($row["teacher_fname"] . ' ' . $row["teacher_lname"]) . '</td>';

                                        //  Download link
                                        // echo '<td><a href="faculty/includes/download.php?file=' . urlencode($fileNameForDownload) . '" class="btn btn-success btn-sm">';
                                        // echo '<i class="fas fa-download"></i> Download</a></td>';

                                        echo '
                                        <td class="d-flex justify-content-center">
                                          <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit_subject' . $row['module_id'] . '">
                                            <i class="fas fa-download"></i>Download
                                          </button>
                                        </td>
                                        ';

                                        echo '</tr>';


                                        // todo Modal for download modulesubject
                                        echo '
                                        <div class="modal fade" id="edit_subject' . $row['module_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-success">
                                                              <h1 class="text-success"><i class="bi bi-cloud-arrow-down" style="font-size: 120px;"></i></h1>
                                                        </div>
                                                        <h5 class="mb-4 text-dark fw-bold">Download "<span class="text-success">' . ucwords(strtolower($fileNameForDisplay)) . '</span>" ?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-3 mb-4">

                                                        <a href="faculty/includes/download.php?file=' . urlencode($fileNameForDownload) . '" class="btn btn-success px-4 py-2 me-3" style="width: 120px;">Download</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr><td colspan="5" class="text-center">No modules found.</td></tr>';
                                }
                                ?>

                                <tr id="noResultsMessage" style="display: none;">
                                    <td colspan="5" class="text-center">No results found.</td>
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