<?php
include "../includes/dbh-inc.php";

?>

<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/Forms/enrollmentform.php";
?>





<!-- TABLE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h3 class="text-black">List of Enrolled Student</h3>
                        <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#enroll" data-bs-whatever="@fat">
                            <i class="bi bi-person-plus-fill me-1"></i>Enroll Student
                        </button>
                    </div>
                    <!-- NOTIFICATION -->
                    <?php
                    if (isset($_SESSION['deleted'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1200px;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                        echo '</div>';
                        unset($_SESSION['deleted']);
                    } else if (isset($_SESSION['check_enrolled'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1200px;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['check_enrolled'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                        echo '</div>';
                        unset($_SESSION['check_enrolled']);
                    }
                    ?>

                    <div class="table-responsive small ms-3 me-3">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">

                            <thead class="table-dark text-light">
                                <tr>
                                    <th scope="col" class="small text-center">Student name</th>
                                    <th scope="col" class="small text-center">Strand</th>
                                    <th scope="col" class="small text-center">Section</th>
                                    <th scope="col" class="small text-center">Adviser</th>
                                    <th scope="col" class="small text-center">Semester</th>
                                    <th scope="col" class="small text-center">School year</th>
                                    <th scope="col" class="small text-center">Date Enrolled</th>
                                    <th scope="col" class="small text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                $result = $mySQLFunction->getEnroll();
                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        echo '<tr>';
                                        echo '<td>' . ucwords(strtolower($row["student"])) . '</td>';
                                        echo '<td>' . $row["strand_name"] . '</td>';
                                        echo '<td>' . $row["section_name"] . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["adviser"])) . '</td>';
                                        echo '<td>' . $row["enroll_semester"] . '</td>';
                                        echo '<td>' . $row["sy"] . '</td>';
                                        echo '<td>' . $row["date_enroll"] . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["enroll_status"])) . '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center pt-2 pb-3 ">
                                            <button class="btn btn-sm btn-outline-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#edit_enrolled' . urlencode($row['stu_lrn']) . '">
                                                <i class="bi bi-pencil-square "></i>
                                            </button>
                                        
                                            <button class="btn btn-sm btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#del_enrolled' . urlencode($row['stu_lrn']) . '">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                            ';
                                        echo '</tr>';

                                        $count++;


                                        // Modal for updating enrolled
                                        echo '
                                                                                    
                                            <div class="modal fade" id="edit_enrolled' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Edit Student Enrolled</h5>
                                                            <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <form action="./includes/Operation/updateEnroll.php" method="POST" class="row g-3 needs-validation" novalidate id="editEnrollForm' . htmlspecialchars($row['stu_lrn']) . '"> 
                                                                <input type="hidden" name="enrollID" value="' . htmlspecialchars($row['stu_lrn']) . '">
                                                                
                                                                <!-- Student Name -->
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label fw-bold">Student Name</label>
                                                                    <input type="text" class="form-control" name="student" value="' . htmlspecialchars($row['student']) . '" disabled>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a student name.
                                                                    </div>
                                                                </div>

                                                                <!-- Status -->
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label fw-bold">Status</label>
                                                                    <select class="form-select" name="status" required>  
                                                                        <option value="Enrolled"' . ($row['enroll_status'] == 'Enrolled' ? ' selected' : '') . '>Enrolled</option>
                                                                        <option value="Not Enrolled"' . ($row['enroll_status'] == 'Not Enrolled' ? ' selected' : '') . '>Not Enrolled</option>
                                                                        <option value="Pending"' . ($row['enroll_status'] == 'Pending' ? ' selected' : '') . '>Pending</option>
                                                                        <option value="Dropped"' . ($row['enroll_status'] == 'Dropped' ? ' selected' : '') . '>Dropped</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select a status.
                                                                    </div>
                                                                </div>

                                                                <!-- Buttons -->
                                                                <div class="d-flex justify-content-between mt-4 gap-2">
                                                                    <button name="submit" class="btn btn-primary w-100" type="submit">Save</button>
                                                                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetSection(\'' . htmlspecialchars($row['stu_lrn']) . '\')">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function resetSection(id) {
                                                    var form = document.getElementById("editEnrollForm" + id);
                                                    if (form) {
                                                        form.reset(); // Clears the form fields
                                                        form.classList.remove("was-validated"); // Removes the validation styling
                                                    }
                                                }
                                            </script>
                                            ';



                                        // Modal for deleting enrolled student
                                        echo '
                                        <div class="modal fade" id="del_enrolled' . urlencode($row['stu_lrn']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to delete "<span class="text-danger">' . ucwords(strtolower($row['student'])) . '</span>"?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                                                        <a href="includes/Operation/deleteEnrolled.php?id=' . urlencode($row['stu_lrn']) . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center ">Enrolled students not found.<br>
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
        <div class="ms-2">
            <?php
            if (!empty($activeSchoolYears && !empty($activeSem))) {
                foreach ($activeSchoolYears as $index => $schoolYear) {
                    echo '<div class="me-3 date-display">' . htmlspecialchars($activeSem[$index]) . '</div>';
                    echo '<span class="date-display">SY ' . htmlspecialchars($schoolYear) . '</span>';;
                }
            } else {
                echo '<div class="alert alert-warning">No school year and semester found.</div>';
            }
            ?>
        </div>
    </div>
</main>


<?php
include("../admin/includes/footer.php");
?>
<!-- <script src="../assets/js/enrollment.js"></script> -->
<!-- PDF ,EXCEL, PRINT ,CVS -->
<script>
    $(document).ready(function() {
        $("#example").DataTable({
            dom: "Bfrtip", // Include buttons in the dom
            buttons: [{
                    extend: "copy",
                    text: '<i class="fas fa-copy"></i> Copy',
                    className: "btn btn-sm btn-primary",
                    titleAttr: "Copy to clipboard",
                },
                {
                    extend: "csvHtml5",
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: "btn btn-sm btn-success",
                    titleAttr: "Export as CSV",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 8)
                            return index !== 8;
                        },
                    },
                },
                {
                    extend: "excelHtml5",
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: "btn btn-sm btn-success",
                    titleAttr: "Export as Excel",
                    exportOptions: {
                        columns: function(index, data, node) {
                            return index !== 8;
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: "btn btn-sm btn-danger",
                    titleAttr: "Export as PDF",
                    exportOptions: {
                        columns: function(index, data, node) {
                            return index !== 8;
                        },
                    },
                },
                {
                    extend: "print",
                    text: '<i class="fas fa-print"></i> Print',
                    className: "btn btn-sm btn-info",
                    titleAttr: "Print Table",
                    autoPrint: true,
                    customize: function(win) {
                        // Hide the LMS heading during print
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
                                "<h5 style='font-size: 14px;'>List of Enrolled Students</h5>" +
                                "<small>" +
                                schoolYearSemester +
                                "</small>" + // Inject the dynamically generated school year/semester
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
                            .addClass("compact")
                            .css("font-size", "inherit");
                    },
                    exportOptions: {
                        columns: function(index, data, node) {
                            return index !== 8;
                        },
                    },
                },
            ],
        });
    });
</script>

<?php
$school_year_semester = '';

if (!empty($activeSchoolYears) && !empty($activeSem)) {
    foreach ($activeSchoolYears as $index => $schoolYear) {
        $school_year_semester .= '<div class="me-3 text-success">' . htmlspecialchars($activeSem[$index]) . '</div>';
        $school_year_semester .= '<span class="">SY ' . htmlspecialchars($schoolYear) . '</span>';
    }
} else {
    $school_year_semester = '<div class="alert alert-warning">No school year and semester found.</div>';
}
?>

<script>
    var schoolYearSemester = `<?php echo $school_year_semester; ?>`;
</script>