<?php

include "../includes/dbh-inc.php";

// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}

$mySQLFunction->connection();
if (!empty($_GET['sched_id']) && !empty($_GET['sub_code']) && !empty($_GET['section_code'])) {
    $sched_id = $_GET['sched_id'];
    $sub_code = $_GET['sub_code'];
    $section_code = $_GET['section_code'];

    // Fetch uploaded module by subject handled of teacher 
    $modules = $mySQLFunction->getModuleCreatedByTeacher($_SESSION['teacher_id'], $sub_code,  $section_code);
    // echo "<pre>";
    // print_r($modules);
    // echo "</pre>";
}
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
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 ms-3 me-3">
                        <!-- Grade Level and Section and Subject-->
                        <div>
                            <!-- Display Subject Title -->
                            <h6 class="fw-bold text-primary">
                                <!-- Subject: -->

                                <?php
                                if (!empty($modules)) {
                                    foreach ($modules as $student) {
                                        echo htmlspecialchars($student["sub_title"]); // Display subject title
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Grade Level and Section -->
                            <h6 class="fw-semibold mt-1">
                                <?php
                                if (!empty($modules)) {
                                    foreach ($modules as $student) {
                                        echo htmlspecialchars($student["grade_lvl"]) . ' - ';
                                        echo htmlspecialchars($student["section_name"]) . '<br> ';
                                        echo htmlspecialchars($student["sub_semester"]);
                                        break; // Exit the loop after processing the first student
                                    }
                                } else {
                                    echo
                                    '<div class="alert alert-danger d-flex align-items-center badge">
                                        <div>
                                            <strong>No Module Uploaded!</strong> It seems there are no modules uploaded yet.
                                        </div>
                                    </div>';
                                }
                                ?>
                            </h6>

                        </div>

                        <!-- Back button -->
                        <div class="d-flex gap-2 ms-2">
                            <a class="btn btn-primary fw-bold btn-sm btn-animate"
                                href="index.php?page=upload_module<?php if ($sched_id && $sub_code && $section_code) {
                                                                        echo '&sched_id=' . urlencode($sched_id) . '&sub_code=' . urlencode($sub_code) . '&section_code=' . urlencode($section_code);
                                                                    } ?>">
                                <span>Back</span>
                            </a>
                        </div>
                    </div>



                    <!-- Module DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Module Name</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Uploaded by</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Date Uploaded</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Semester</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($modules)) {
                                    $count = 1;
                                    foreach ($modules as $module) {
                                        // Extract the base file name for display
                                        // $fileNameWithoutExt = basename($module['file_name']);
                                        $fileNameForDownload = htmlspecialchars($module['file_name']); // Prevent XSS attacks
                                        $fileNameWithoutExt = pathinfo($module['file_name'], PATHINFO_FILENAME);
                                        echo '<tr>';
                                        echo '<td>' . $count . '</td>';
                                        echo '<td class="small text-center">' . ucwords(strtolower($fileNameWithoutExt)) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($module["teacher"])) . '</td>';
                                        echo '<td class="small text-center">' . date('F j, Y', strtotime($module["uploaded_date"])) .  '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($module["sub_semester"])) . '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_module' . $module['module_id'] . '">
                                        <i class="bi bi-trash"></i> 
                                        </button>
                                        
                                        </td>';

                                        $count++;

                                        // <button class="btn btn-sm btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#edit_exam' . $module['module_id'] . '">
                                        //     <i class="bi bi-pencil-square"></i> 
                                        // </button>




                                        // todo Modal for deleting exam
                                        echo '
                                        <div class="modal fade" id="del_module' . $module['module_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h5 class="mt-4 mb-4 text-dark fw-bold">
                                                            Are you sure you want to remove "<span class="text-danger">' . ucwords(strtolower($fileNameWithoutExt)) . '</span>"?
                                                        </h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-2 mb-4">
                                                        <a href="includes/Operation/deleteModule.php?module_id=' . urlencode($module['module_id']) . '&sched_id=' . urlencode($sched_id) . '&sub_code=' . urlencode($sub_code) . '&section_code=' . urlencode($section_code) . '" 
                                                        class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center mt-2"> No modules found. </td>
                              </tr>';
                                }

                                echo '</tbody>';
                                echo '</table>';
                                $mySQLFunction->disconnect();
                                ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("../faculty/includes/extension.php");
    ?>
</main>
<!-- PAGINATION AND SEARCH -->
<script>
    $(document).ready(function() {
        $("#example").DataTable({
            // dom: "Bfrtip", // Include buttons in the dom
            responsive: true,
            buttons: [],
        });
    });
</script>