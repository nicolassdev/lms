<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<!-- FORM MODAL ADD STUDENT  -->
<?php
include "../includes/dbh-inc.php";

include "../faculty/includes/Forms/uploadmoduleform.php";
$mySQLFunction->connection();

$result = $mySQLFunction->checkEnrolledCountByTeacher($_SESSION['teacher_id']);


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


<!-- TABLE -->


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">

                        <div class="fw-bold fs-5 text-danger">
                            <?php if (!empty($result)) {
                                foreach ($result as $student) {
                                    echo htmlspecialchars($student["grade_lvl"]) . '  ';
                                    echo htmlspecialchars($student["section_name"]);
                                    break; // Exit loop after processing the first student
                                }
                            }
                            ?>
                        </div>
                        <div class="text-black">
                            <?php
                            if (!empty($result)) {
                                echo "<h6 class='text-black'>" . count($result) . " Student(s)</h6>";
                            } else {
                                echo "<h6 class='text-black'> " . count($result) . "  Student</h6>";
                            }
                            ?>
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
                                    <th scope="col" style="width: 100px;">Section</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($result)) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                        // Create a DateTime object and format the added_date
                                        $addedDate = new DateTime($row['stu_dob']);
                                        $formattedBdate = $addedDate->format('F j, Y');

                                        echo '<td>' . $count . '</td>';
                                        echo '<td class="text-center text-primary"> <a title="Student Information" data-bs-toggle="modal" data-bs-target="#view_student' . $row['stu_lrn'] . '">'
                                            . $row["stu_lrn"] . '</a></td>';
                                        echo '<td class="small text-center"> ' . $row["stu_lname"] . ',  ' .  ucwords(strtolower($row["stu_fname"] . ' ' . $row["stu_mname"] . '')) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_gender"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_address"])) . '</td>';
                                        echo '<td class="small text-center">+63' . $row["stu_contact"] . '</td>';
                                        echo '<td class="small text-center">' . strtolower($row["stu_email"]) . '</td>';
                                        echo '<td class="small text-center">' .  $row["section_name"] . '</td>';


                                        echo '</tr>';

                                        $count++;

                                        //todo Mddal for view student information
                                        echo '
                                        <div class="modal fade" id="view_student' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
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
                                                                    <div class="col-md-4">
                                                                        <label for="firstName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">First Name</label>
                                                                        <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['stu_fname']) . '" readonly disabled>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="middleName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Middle Name</label>
                                                                        <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['stu_mname']) . '" disabled>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="lastName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Last name</label>
                                                                        <input type="text" class="form-control" name="lastname" value="' . htmlspecialchars($row['stu_lname']) . '" readonly disabled>
                                                                    </div>
                                                                    <div class="col-md-5 mt-2">
                                                                        <label class="form-label">Address</label>
                                                                        <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['stu_address']) . '" readonly disabled>
                                                                    </div>

                                                                    <div class="col-md-4 mt-2">
                                                                        <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                        <div class="input-group has-validation">
                                                                            <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                            <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['stu_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" readonly disabled>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="col-md-3 mt-2">
                                                                        <label for="gender' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Gender</label>
                                                                        <input type="text" class="form-control" name="gender" id="gender' . htmlspecialchars($row['stu_lrn']) . '" value="' . htmlspecialchars($row['stu_gender']) . '" readonly disabled>
                                                                    </div>
                                                                    
                                                                <div class="col-md-5 mt-2">
                                                                        <label for="email' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Email</label>
                                                                        <input type="text" name="email" class="form-control" value="' . htmlspecialchars($row['stu_email']) . '"  placeholder="Enter your email address" pattern=".*@(gmail|yahoo)\.com$" readonly disabled>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="col-md-4 mt-2">
                                                                        <label class="form-label">Place of Birth</label>
                                                                        <input type="text" class="form-control" name="pob" value="' . htmlspecialchars($row['stu_pob']) . '" readonly disabled>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-3 mt-2">
                                                                    <label for="dob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Date of Birth</label>
                                                                        <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['stu_dob']) . '" value="' . htmlspecialchars($row['stu_dob']) . '" readonly disabled>
                                                                    </div>
                                                                    
                                                                </div>

  

                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5 text-success">Guardian Information   </h1> 
                                                            </div>
                                                            <div class="row"> 
                                                                <div class="col-md-6 mt-2">
                                                                        <label class="form-label">Father\'s name</label>
                                                                        <input type="text" class="form-control" name="fathername" value="' . htmlspecialchars($row['father_name']) . '" readonly disabled>
                                                                </div>

                                                                    

                                                                    <div class="col-md-6 mt-2">
                                                                        <label class="form-label">Mother\'s name</label>
                                                                        <input type="text" class="form-control" name="mothername" value="' . htmlspecialchars($row['mother_name']) . '" readonly disabled>
                                                                    </div>


                                                                    <div class="col-md-12 mt-2">
                                                                        <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                        <div class="input-group has-validation">
                                                                            <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                            <input type="text" class="form-control" name="pcontact" value="' . htmlspecialchars($row['parent_contact']) . '" readonly disabled>
                                                                        </div>
                                                                    </div>
                                                            </div>

                                                            <div class=" justify-center ">
                                                                <div class="col-12">
                                                                    <button type="button"  class="btn btn-success w-100 mt-3 mb-2"  data-bs-dismiss="modal">Okay</button>
                                                                </div>
                                                              
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';





                                        // todo Modal for updating student
                                        echo '
                                        <div class="modal fade" id="edit_student' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="editStudentModal" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="text-start">
                                                                <h1 class="modal-title fs-5 text-white">Edit Student details</h1>
                                                            </div>
                                                            </div>
                                                            <div class="text-end">
                                                            <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                            </div>                           
                                                        </div>
                                                    <div class="modal-body p-4">
                                                        <form action="./includes/Operation/updateStudent.php" method="POST" class="row g-3 needs-validation" novalidate id="editTeacherForm' . htmlspecialchars($row['stu_lrn']) . '">
                                                        <div class="row">
                                                        <!-- Use hidden input -->
                                                            <input type="hidden" name="lrnID" value="' . htmlspecialchars($row['stu_lrn']) . '">
                                    
                                                            <div class="col-md-4 mb-3">
                                                                <label for="firstName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">First name</label>
                                                                <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['stu_fname']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid first name.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-md-4 mb-3">
                                                                <label for="middleName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Middle name</label>
                                                                <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['stu_mname']) . '">
                                                            </div>
                                    
                                                            <div class="col-md-4 mb-3">
                                                                <label for="lastName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Last name</label>
                                                                <input type="text" class="form-control" name="lastname" value="' . htmlspecialchars($row['stu_lname']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid last name.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label fw-bold">Address</label>
                                                                <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['stu_address']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid address.
                                                                </div>
                                                            </div>
                                    
                                                            
                                                            <div class="col-md-6 mb-3">
                                                                <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Contact</label>
                                                                <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['stu_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid 10-digit number starting with 9.
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                           
                                                            <div class="col-md-6 mb-3">
                                                                <label for="gender' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Gender</label>
                                                                <select class="form-select" name="gender" id="gender' . htmlspecialchars($row['stu_lrn']) . '" required>
                                                                    <option disabled value="">Choose...</option>
                                                                    <option value="male"' . ($row['stu_gender'] == 'MALE' ? ' selected' : '') . '>MALE</option>
                                                                    <option value="female"' . ($row['stu_gender'] == 'FEMALE' ? ' selected' : '') . '>FEMALE</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Please select a gender.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="email' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Email</label>
                                                                <input type="text" name="email" class="form-control" value="' . htmlspecialchars($row['stu_email']) . '" placeholder="Enter your email address" pattern=".*@(gmail|yahoo)\.com$" required>
                                                                <div class="invalid-feedback">
                                                                    Your email must contain an "@" symbol or gmail address ending with ".com".
                                                                </div>
                                                            </div>
                                    
                                                             <div class="col-md-6 mb-3">
                                                                <label for="dob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Date of Birth</label>
                                                                <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['stu_dob']) . '" value="' . htmlspecialchars($row['stu_dob']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid date of birth.
                                                                </div>
                                                            </div>
                                    
                                                             <div class="col-md-6 mb-3">
                                                                <label for="pob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Place of Birth</label>
                                                                <input type="text" class="form-control" name="pob" value="' . htmlspecialchars($row['stu_pob']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid address.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="modal-header mb-2">
                                                                <h4 class="modal-title text-success">Guardian Details</h4> 
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label fw-bold">Father name</label>
                                                                <input type="text" class="form-control" name="fathername" value="' . htmlspecialchars($row['father_name']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid name.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label fw-bold">Mother name</label>
                                                                <input type="text" class="form-control" name="mothername" value="' . htmlspecialchars($row['mother_name']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid name.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="pcontact' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Guardian Contact</label>
                                                                <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="pcontact" value="' . htmlspecialchars($row['parent_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid 10-digit number starting with 9.
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="d-flex justify-content-between mt-4 gap-2">
                                                                <button name="submit" class="btn btn-success w-100" type="submit">Update</button>
                                                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm(\'' . htmlspecialchars($row['stu_lrn']) . '\')">Cancel</button>
                                                            </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                    

                                        <script>
                                            function resetForm(id) {
                                                var form = document.getElementById("editTeacherForm" + id);
                                                if (form) {
                                                    form.reset(); // Clears the form fields
                                                    form.classList.remove("was-validated"); // Removes the validation styling
                                                }
                                            }
                                        </script>
                                    ';





                                        // todo Modal for deleting student
                                        echo '
                                        <div class="modal fade" id="del_student' . $row['stu_lrn'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to remove LRN "<span class="text-danger">' . $row['stu_lrn'] . '</span>" ?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                                                        <a href="includes/Operation/deleteStudent.php?id=' . $row['id'] . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
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

                {
                    extend: "excelHtml5",
                    text: "Download Excel",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 8;
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: "Dowload PDF",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 8;
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
                            return index !== 8;
                        },
                    },
                },
            ],
        });
    });
</script>