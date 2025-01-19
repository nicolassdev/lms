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



    // Fetch students by subject handled of teacher 
    $students = $mySQLFunction->getAllStudentBySectionAndSubjectWithModuleUploads($_SESSION['teacher_id'], $sub_code, $section_code);
    // echo "<pre>";
    // print_r($students);
    // echo "</pre>";
}


include "../faculty/includes/Forms/createexamform.php";
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
                                if (!empty($students)) {
                                    foreach ($students as $student) {
                                        echo htmlspecialchars($student["sub_title"]); // Display subject title
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Grade Level and Section -->
                            <h6 class="fw-semibold mt-1">
                                <?php
                                if (!empty($students)) {
                                    foreach ($students as $student) {
                                        echo htmlspecialchars($student["grade_lvl"]) . ' - ';
                                        echo htmlspecialchars($student["section_name"]);
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Student Count -->
                            <?php if (!empty($students)) : ?>
                                <h6 class="fw-semibold"><?php echo count($students); ?> Student(s)</h6>
                            <?php else : ?>
                                <h6 class="text-secondary fw-semibold mt-1">0 Student(s)</h6>
                            <?php endif; ?>


                        </div>

                        <!-- Upload Button -->
                        <div>
                            <?php
                            $btnClass = empty($students) ? 'btn-danger' : 'btn-primary';
                            $disabled = empty($students) ? 'disabled' : '';
                            ?>
                            <button type="button"
                                class="btn <?php echo $btnClass; ?> btn-sm fw-bold d-flex align-items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#create_exam"
                                data-bs-whatever="@fat"
                                <?php echo $disabled; ?>>
                                <i class="bi-plus-circle me-1"></i>Create Exam
                            </button>
                        </div>
                    </div>



                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <!-- <th scope="col" style="width: 50px;">LRN</th> -->
                                    <th scope="col" style="width: 100px;">Full name</th>
                                    <th scope="col" style="width: 50px;">Gender</th>
                                    <th scope="col" style="width: 150px;">Address</th>
                                    <th scope="col" style="width: 100px;">Contact</th>
                                    <th scope="col" style="width: 100px;">Email</th>
                                    <th scope="col" style="width: 100px;">Year level</th>
                                    <th scope="col" style="width: 100px;">Section</th>
                                    <th scope="col" style="width: 100px;">Status</th>
                                    <th scope="col" style="width: 100px;">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($students)) {
                                    $count = 1;
                                    foreach ($students as $row) {
                                        // Split the file names into an array
                                        $fileNames = explode(',', $row['file_names']); // Split the file names by comma

                                        // Loop through the file names and generate download links
                                        echo '<tr>';
                                        echo '<td>' . $count . '</td>';
                                        // echo '<td class="text-center text-primary"><a title="Student Information" data-bs-toggle="modal" data-bs-target="#view_student' . $row['stu_lrn'] . '">' . $row["stu_lrn"] . '</a></td>';
                                        echo '<td class="small text-center"> ' . $row["stu_lname"] . ', ' .  ucwords(strtolower($row["stu_fname"] . ' ' . $row["stu_mname"] . '')) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_gender"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_address"])) . '</td>';
                                        echo '<td class="small text-center">+63' . $row["stu_contact"] . '</td>';
                                        echo '<td class="small text-center">' . strtolower($row["stu_email"]) . '</td>';
                                        echo '<td class="small text-center">' .  $row["grade_lvl"] . '</td>';
                                        echo '<td class="small text-center">' .  $row["section_name"] . '</td>';

                                        // Check if there are no files uploaded
                                        echo '<td>';
                                        if (empty($row['file_names']) || count($fileNames) == 0) {
                                            echo '<span class="text-danger mr-2">No Exam</span>';
                                        } else {
                                            foreach ($fileNames as $fileName) {
                                                $fileNameForDownload = htmlspecialchars(trim($fileName)); // Clean up file name
                                                echo '<a href="includes/download.php?file=' . urlencode($fileNameForDownload) . '" class="btn btn-success btn-sm mb-1">';
                                                echo '<i class="fas fa-download"></i> Download</a><br>';
                                            }
                                        }
                                        echo '</td>';
                                        echo '<td class="small text-center"> <span class="text-danger mr-2">No Score</span></td>';
                                        echo '</tr>';
                                        $count++;
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center mt-2 text-danger"><strong>Student not found.</strong>
                                </td>
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
<!-- PDF ,EXCEL, PRINT ,CVS -->
<script>
    $(document).ready(function() {
        $("#example").DataTable({
            dom: "Bfrtip", // Include buttons in the dom
            buttons: [
                "copy",
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 9;
                        },
                    },
                },
                {
                    extend: "excelHtml5",
                    text: "Excel",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 9;
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 9;
                        },
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    autoPrint: true, // This will print in the same tab (no new window)
                    customize: function(win) {
                        // Custom styling or adjustments for print can go here
                        $(win.document.body)
                            .find('h1:contains("LMS")') // Adjust the selector if needed
                            .css("display", "none");

                        $(win.document.body)
                            .css("font-size", "10pt")
                            .prepend(
                                // This is the container that holds both left and right aligned text
                                '<div style="display: flex; justify-content: space-between; align-items: center;">' +
                                // Left-aligned: List of Enrolled Students
                                '<div style="text-align:left; flex: 1;">' +
                                "<h5 style='font-size: 14px;'>Enrolled Students</h5>" +
                                "</div>" +
                                // Right-aligned: Computer Systems Institute
                                '<div style="text-align:right; flex: 1;">' +
                                "<h6>Computer Systems Institute</h6>" +
                                "<small>F. Imperial st., Brgy. 36 - Capantawan, Legazpi City</small><br>" +
                                "</div>" +
                                "</div>"
                            );

                        $(win.document.body)
                            .find("table thead th")
                            .css("background-color", "#007bff") // Header color
                            .css("color", "#ffffff")
                            .css("padding", "10px");
                        $(win.document.body)
                            .find("table")
                            .addClass("compact") // Optional: Compact styling for the table in print view
                            .css("font-size", "inherit");
                    },
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 9;
                        },
                    },
                },
            ],
        });
    });
</script>