<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<!-- FORM MODAL ADD STUDENT  -->
<?php
include "../includes/dbh-inc.php";

?>




<style>
    .text-sm {
        font-size: 0.7em;
    }

    .data-table {
        font-size: 0.7em;
        /* Reduce font size */
    }

    .table th,
    .table td {
        padding: 0.1rem;
        /* Adjust padding */
    }
</style>


<!-- TABLE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h5 class="text-black">Student Masterlist</h5>

                    </div>


                    <div class="table-responsive small ms-3 me-3">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">

                            <thead class="table-dark text-light">
                                <tr>
                                    <th scope="col" class="small text-center">#</th>
                                    <th scope="col" class="small text-center">Student name</th>
                                    <th scope="col" class="small text-center">Strand</th>
                                    <th scope="col" class="small text-center">Year level</th>
                                    <th scope="col" class="small text-center">Section</th>
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
                                    $count = 1;
                                    foreach ($result as $row) {

                                        // // Check if the enroll_status is not 'enrolled'
                                        // if ($row['enroll_status'] !== 'Enrolled') {
                                        //     continue; // Skip this iteration if not enrolled
                                        // }

                                        // Check if 'requirements_submit' exists and is not empty
                                        $submittedRequirements = isset($row['requirements_submit']) && !empty($row['requirements_submit'])
                                            ? explode(', ', $row['requirements_submit'])
                                            : [];
                                        // Determine the background color based on enrollment status
                                        $statusStyle = $row["enroll_status"] !== "Enrolled"
                                            ? 'background-color: red; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;'
                                            : 'background-color: green; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;';

                                        echo '<tr>';
                                        echo '<td>' . $count . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["student"])) . '</td>';
                                        echo '<td>' . $row["strand_name"] . '</td>';
                                        echo '<td>' . $row["grade_lvl"] . '</td>';
                                        echo '<td>' . $row["section_name"] . '</td>';
                                        echo '<td>' . $row["enroll_semester"] . '</td>';
                                        echo '<td>' . $row["sy"] . '</td>';
                                        echo '<td>' . $row["date_enroll"] . '</td>';
                                        echo '<td><span style="' . $statusStyle . '">' . ucwords(strtolower($row["enroll_status"])) . '</span></td>';

                                        echo '
                                        
                                        <td class="d-flex justify-content-center pt-2 pb-3 ">
 

                                            <button class="btn btn-sm btn-outline-success me-2  " data-bs-toggle="modal" data-bs-target="#view_enrolled' . $row['stu_lrn'] . '">
                                                <i class="bi bi-eye me-1"></i><small>View</small>
                                            </button>
                                        
                                        </td>
                                            ';
                                        echo '</tr>';

                                        $count++;

                                        //todo Mddal for view student information
                                        echo '
                                                                                <div class="modal fade" id="view_enrolled' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="studentModal" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-lg">
                                                                                        <div class="modal-content b-grey">
                                                                                            <div class="modal-body"> 
                                                                                         
                                                                                            <div style="position: relative; ">
                                                                                                <img
                                                                                                    style="position: absolute; top: 10%; left: 60%; transform: translate(-30%, -0%); 
                                                                                                    width: 400px; opacity: 0.1; z-index: 1;"
                                                                                                    src="../assets/img/csi.webp"
                                                                                                    alt="LMS Logo">
                                                                                            </div>
                                                                                     
                                                 
                                                                                               <div class="modal-header">
                                                                                                    <div class="d-flex align-items-center justify-content-between w-100">
                                                                                                        <div class="text-start">
                                                                                                            <h1 class="modal-title fs-5 text-success">Student Information</h1>
                                                                                                        </div>
                                                                                                        <div class="text-end">
                                                                                                            <i class="bi bi-person-vcard-fill fs-1 text-success"></i>
                                                                                                            <div class="text-success fw-bold">LRN: ' . htmlspecialchars($row['stu_lrn']) . '</div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                        
                                        
                                        
                                         
                                                                                                <form action="./includes/Operation/updateStudent.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editTeacherForm' . htmlspecialchars($row['stu_lrn']) . '">
                                                                                                    <!-- Use hidden input -->
                                                                                                    <input type="hidden" name="lrnID" value="' . htmlspecialchars($row['stu_lrn']) . '">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-6 mt-2 fw-semibold fs-6">
                                                                                                                <label for="firstName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Full name</label>
                                                                                                                <input type="text" class="form-control" value="' . htmlspecialchars($row['student']) . '" readonly disabled>
                                                                                                            </div>
                                                                                                 
                                                                                                            <div class="col-md-6 mt-2 fw-semibold fs-6">
                                                                                                                <label class="form-label">Address</label>
                                                                                                                <input type="text" class="form-control" value="' . htmlspecialchars($row['stu_address']) . '" readonly disabled>
                                                                                                            </div>
                                        
                                                                                                            <div class="col-md-4 mt-2 fw-semibold fs-6">
                                                                                                                <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                                                                <div class="input-group has-validation">
                                                                                                                    <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                                                                    <input type="text" class="form-control" value="' . htmlspecialchars($row['stu_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" readonly disabled>
                                                                                                                </div>
                                                                                                            </div>
                                        
                                                                                                            
                                                                                                            <div class="col-md-3 mt-2 fw-semibold fs-6">
                                                                                                                <label for="gender' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Gender</label>
                                                                                                                <input type="text" class="form-control" id="gender' . htmlspecialchars($row['stu_lrn']) . '" value="' . htmlspecialchars($row['stu_gender']) . '" readonly disabled>
                                                                                                            </div>
                                                                                                            
                                                                                                            <div class="col-md-5 mt-2 fw-semibold fs-6">
                                                                                                                <label for="email' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Email</label>
                                                                                                                <input type="text"  class="form-control" value="' . htmlspecialchars($row['stu_email']) . '"  placeholder="Enter your email address" pattern=".*@(gmail|yahoo)\.com$" readonly disabled>
                                                                                                            </div>
                                                                                                            
                                                                                                            
                                                                                                            <div class="col-md-4 mt-2 fw-semibold fs-6">
                                                                                                                <label class="form-label">Place of Birth</label>
                                                                                                                <input type="text" class="form-control"   value="' . htmlspecialchars($row['stu_pob']) . '" readonly disabled>
                                                                                                            </div>
                                                                                                            
                                                                                                            <div class="col-md-3 mt-2 fw-semibold fs-6">
                                                                                                            <label for="dob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Date of Birth</label>
                                                                                                                <input type="date" class="form-control"  id="dob' . htmlspecialchars($row['stu_dob']) . '" value="' . htmlspecialchars($row['stu_dob']) . '" readonly disabled>
                                                                                                            </div>
                                                                                                            
                                                                                                        </div>
                                        
                                          
                                        
                                                                                                    <div class="modal-header">
                                                                                                        <h1 class="modal-title fs-6 text-success">Guardian Information</h1> 
                                                                                                    </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-6 mt-2">
                                                                                                                    <label class="form-label fw-semibold fs-6">Father\'s name</label>
                                                                                                                    <input type="text" class="form-control" value="' . htmlspecialchars($row['father_name']) . '" readonly disabled>
                                                                                                            </div>
                                        
                                                                                                            
                                        
                                                                                                            <div class="col-md-6 mt-2">
                                                                                                                <label class="form-label fw-semibold fs-6">Mother\'s name</label>
                                                                                                                <input type="text" class="form-control"   value="' . htmlspecialchars($row['mother_name']) . '" readonly disabled>
                                                                                                            </div>
                                        
                                        
                                                                                                            <div class="col-md-7  mt-2 fw-semibold fs-6">
                                                                                                                <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                                                                <div class="input-group has-validation">
                                                                                                                    <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                                                                    <input type="text" class="form-control"  value="' . htmlspecialchars($row['parent_contact']) . '" readonly disabled>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>




                                                                                                    <div class="modal-header">
                                                                                                        <h1 class="modal-title fs-6 text-success">Section and Adviser</h1> 
                                                                                                    </div> 
                                                                                                     <div class="row">
                                                                                                            <div class="col-md-6 mt-2">
                                                                                                                    <label class="form-label fw-semibold fs-6">Section</label>
                                                                                                                    <input type="text" class="form-control" value="' . htmlspecialchars($row['section_name']) . '" readonly disabled>
                                                                                                            </div>
                                        
                                                                                                            
                                        
                                                                                                            <div class="col-md-6 mt-2">
                                                                                                                <label class="form-label fw-semibold fs-6">Grade level</label>
                                                                                                                <input type="text" class="form-control"   value="' . htmlspecialchars($row['grade_lvl']) . '" readonly disabled>
                                                                                                            </div>
                                                                                                                                                                                                                        <div class="col-md-6 mt-2">
                                                                                                                    <label class="form-label fw-semibold fs-6">Strand</label>
                                                                                                                    <input type="text" class="form-control" value="' . htmlspecialchars($row['strand_name']) . '" readonly disabled>
                                                                                                            </div>
                                        
                                                                                                            
                                        
                                                                                                            <div class="col-md-6 mt-2">
                                                                                                                <label class="form-label fw-semibold fs-6">Adviser</label>
                                                                                                                <input type="text" class="form-control"   value="' . htmlspecialchars($row['adviser']) . '" readonly disabled>
                                                                                                            </div>


                                                                                                    
                                                                                                     </div>
                                                                                                    
                                        
                                                                                                    <div class="modal-header">
                                                                                                        <h1 class="modal-title fs-6 text-success">Requirement Submitted</h1> <i class="bi bi-folder-check display-6 ms-2"></i>
                                                                                                    </div>   
                                                                                                        <!-- Requirement Submitted -->
                                                                                                        <div class="row">                                                                                                                                         
                                                                                                            <div class="col-md-12 mt-3">
                                                                                                                <div class="d-flex flex-wrap gap-4 p-3 border rounded bg-light fs-6">
                                                                                                                    <div class="form-text">
                                                                                                                        ' . (in_array("SF9", $submittedRequirements) ? '<i class="bi bi-file-earmark-check text-success"></i>' : '<i class="bi bi-file-earmark-excel text-danger"></i>') . ' SF9
                                                                                                                        <span>' . (in_array("SF9", $submittedRequirements) ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Not Submitted</span>') . '</span>
                                                                                                                    </div>
                                                                                                                    <div class="form-text">
                                                                                                                        ' . (in_array("SF10", $submittedRequirements) ? '<i class="bi bi-file-earmark-check text-success"></i>' : '<i class="bi bi-file-earmark-excel text-danger"></i>') . ' SF10
                                                                                                                        <span>' . (in_array("SF10", $submittedRequirements) ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Not Submitted</span>') . '</span>
                                                                                                                    </div>
                                                                                                                    <div class="form-text">
                                                                                                                        ' . (in_array("PSA", $submittedRequirements) ? '<i class="bi bi-file-earmark-check text-success"></i>' : '<i class="bi bi-file-earmark-excel text-danger"></i>') . ' PSA Birth Certificate
                                                                                                                        <span>' . (in_array("PSA", $submittedRequirements) ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Not Submitted</span>') . '</span>
                                                                                                                    </div>
                                                                                                                    <div class="form-text">
                                                                                                                        ' . (in_array("LCR", $submittedRequirements) ? '<i class="bi bi-file-earmark-check text-success"></i>' : '<i class="bi bi-file-earmark-excel text-danger"></i>') . ' LCR Birth Certificate
                                                                                                                        <span>' . (in_array("LCR", $submittedRequirements) ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Not Submitted</span>') . '</span>
                                                                                                                    </div>
                                                                                                                    <div class="form-text">
                                                                                                                        ' . (in_array("GMCC", $submittedRequirements) ? '<i class="bi bi-file-earmark-check text-success"></i>' : '<i class="bi bi-file-earmark-excel text-danger"></i>') . ' GMCC
                                                                                                                        <span>' . (in_array("GMCC", $submittedRequirements) ? '<span class="text-success">Submitted</span>' : '<span class="text-danger">Not Submitted</span>') . '</span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                        
                                                                                                    <div class=" justify-center ">
                                                                                                        <div class="col-12">
                                                                                                            <button type="button"  class="btn btn-success w-100 mt-3 mb-2"  data-bs-dismiss="modal">Okay</button>
                                                                                                        </div>
                                                                                                       </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                ';
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

    </div>
    <?php
    include("../admin/includes/extension.php");
    ?>
</main>


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
                            // Exclude the "Action" column (assuming index 9)
                            return index !== 9;
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
                            return index !== 9;
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
                            return index !== 9;
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
                            .find('h1:contains("Learning Management System")') // Adjust the selector if needed
                            .css("display", "none");

                        $(win.document.body)
                            .css("font-size", "10pt")
                            .prepend(
                                // This is the container that holds both left and right aligned text
                                '<div style="display: flex; justify-content: space-between; align-items: center;">' +
                                // Left-aligned: Student Masterlist
                                '<div style="text-align:left; flex: 1;">' +
                                "<h5 style='font-size: 14px; margin-left: 15px;'>Student Masterlist</h5>" +
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
                            return index !== 9;
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