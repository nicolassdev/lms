<?php
include "../includes/dbh-inc.php";

// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}

include "../faculty/includes/Forms/uploadmoduleform.php";


?>


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h5 class="text-black">Students</h5>
                        <div class="d-flex">
                            <?php
                            $mySQLFunction->connection();
                            $result = $mySQLFunction->checkEnrolledCountByTeacher($_SESSION['teacher_id']);
                            ?>

                            <button type="button" class="btn btn-primary btn-sm btn-animate" data-bs-toggle="modal" data-bs-target="#upload_module" data-bs-whatever="@fat"
                                <?php echo empty($result) ? 'disabled' : ''; ?>>
                                <i class="bi bi-cloud-arrow-up me-1"></i>Upload module
                            </button>
                        </div>
                    </div>


                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 50px;">LRN</th>
                                    <th scope="col" style="width: 100px;">Full name</th>
                                    <th scope="col" style="width: 50px;">Gender</th>
                                    <th scope="col" style="width: 150px;">Address</th>
                                    <th scope="col" style="width: 100px;">Contact</th>
                                    <th scope="col" style="width: 100px;">Email</th>
                                    <th scope="col" style="width: 100px;">Year level</th>
                                    <th scope="col" style="width: 100px;">Section</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                if (!empty($_GET['sub_code']) && !empty($_GET['section_code'])) {
                                    $sub_code = $_GET['sub_code'];
                                    $section_code = $_GET['section_code'];

                                    // Fetch students by subject handled of teacher 
                                    $students = $mySQLFunction->getAllStudentBySectionAndSubject($_SESSION['teacher_id'], $sub_code, $section_code);
                                } else {
                                    // Redirect back if required parameters are missing
                                    header("Location: /lms/faculty/index.php");
                                    exit;
                                }
                                if (!empty($students)) {
                                    $count = 1;
                                    foreach ($students as $student) {


                                        echo '<td>' . $count . '</td>';
                                        echo '<td class="text-center text-primary"> <a title="Student Information" data-bs-toggle="modal" data-bs-target="#view_student' . $student['stu_lrn'] . '">'
                                            . $student["stu_lrn"] . '</a></td>';
                                        echo '<td class="small text-center"> ' . $student["stu_lname"] . ',  ' .  ucwords(strtolower($student["stu_fname"] . ' ' . $student["stu_mname"] . '')) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($student["stu_gender"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($student["stu_address"])) . '</td>';
                                        echo '<td class="small text-center">+63' . $student["stu_contact"] . '</td>';
                                        echo '<td class="small text-center">' . strtolower($student["stu_email"]) . '</td>';
                                        echo '<td class="small text-center">' .  $student["grade_lvl"] . '</td>';
                                        echo '<td class="small text-center">' .  $student["section_name"] . '</td>';

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
    include("../admin/includes/extension.php");
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
                            return index !== 7;
                        },
                    },
                },
                {
                    extend: "excelHtml5",
                    text: "Excel",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 7;
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 7;
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
                            return index !== 7;
                        },
                    },
                },
            ],
        });
    });
</script>