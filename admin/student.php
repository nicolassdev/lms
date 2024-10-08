<?php
include "../includes/dbh-inc.php";
?>

<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/studentform.php";
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


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 ms-3 me-3">
                        <h3 class="text-black">List of Student</h3>
                        <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#student" data-bs-whatever="@fat">
                            <i class="bi bi-person-plus-fill me-1"></i>Student
                        </button>
                    </div>
                    <!-- NOTIFICATION -->
                    <?php
                    if (isset($_SESSION['deleted'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted">Just now</small>';

                        echo '</div>';
                        unset($_SESSION['deleted']);
                    } elseif (isset($_SESSION['check_id'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['check_id'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                        echo '</div>';
                        unset($_SESSION['check_id']);
                    }
                    ?>

                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">LRN</th>
                                    <th scope="col" style="width: 100px;">Name</th>
                                    <th scope="col" style="width: 50px;">Middle name</th>
                                    <th scope="col" style="width: 100px;">Surname</th>
                                    <th scope="col" style="width: 150px;">Address</th>
                                    <th scope="col" style="width: 100px;">Contact</th>
                                    <th scope="col" style="width: 50px;">Gender</th>
                                    <th scope="col" style="width: 100px;">Email</th>
                                    <th scope="col" style="width: 100px;">Birthday</th>
                                    <!-- <th scope="col" style="width: 150px;">Place of birth</th>
                                    <th scope="col" style="width: 100px;">Father</th>
                                    <th scope="col" style="width: 100px;">Mother</th>
                                    <th scope="col" style="width: 100px;">CP. No</th> -->
                                    <th scope="col" class="text-center" style="width: 100px;">Action</th><!-- colspan should be 2 -->

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                $result = $mySQLFunction->getStudent();

                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        echo '<tr>';
                                        // echo '<td>' . $count . '</td>';
                                        echo '<td class="small text-center">' . $row["stu_lrn"] . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_fname"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_mname"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_lname"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_address"])) . '</td>';
                                        echo '<td class="small text-center">' . $row["stu_contact"] . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($row["stu_gender"])) . '</td>';
                                        echo '<td class="small text-center">' . $row["stu_email"] . '</td>';
                                        echo '<td class="small text-center">' . $row["stu_dob"] . '</td>';
                                        // echo '<td class="small text-center">' . $row["stu_pob"] . '</td>';
                                        // echo '<td class="small text-center">' . $row["father_name"] . '</td>';
                                        // echo '<td class="small text-center">' . $row["mother_name"] . '</td>';
                                        // echo '<td class="small text-center">' . $row["parent_contact"] . '</td>';
                                        echo '
                                            <td class="d-flex justify-content-center">
                                                <button title="Student Information" class="btn btn-sm btn-outline-success me-2 " data-bs-toggle="modal" data-bs-target="#view_student' . $row['stu_lrn'] . '">
                                                    <i class="bi bi-person-vcard"></i>
                                                </button>
                                                <button title="Edit" class="btn btn-sm btn-outline-primary  me-2" data-bs-toggle="modal" data-bs-target="#edit_student' . $row['stu_lrn'] . '">
                                                    <i class="bi bi-pencil-square"></i> 
                                                </button>
                                            
                                                <button title="Delete" class="btn btn-sm btn-outline-danger " data-bs-toggle="modal" data-bs-target="#del_student' . $row['stu_lrn'] . '">
                                                    <i class="bi bi-trash"></i> 
                                                </button>
                                         
                                            </td>
                                                ';
                                        echo '</tr>';

                                        $count++;

                                        //todo Mddal for view student information
                                        echo '
                                        <div class="modal fade" id="view_student' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content b-grey">
                                                    <div class="modal-body">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-3 text-success">Student Information</h1><i class="bi bi-person-vcard-fill fs-1 text-success"></i>
                                                        </div>
                                                        <form action="./includes/Operation/updateStudent.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editTeacherForm' . htmlspecialchars($row['stu_lrn']) . '">
                                                            <!-- Use hidden input -->
                                                            <input type="hidden" name="lrnID" value="' . htmlspecialchars($row['stu_lrn']) . '">

                                                            <div class="col-md-12">
                                                                <label  ' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">First name</label>
                                                                <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['stu_fname']) . '" readonly disabled>
                                                               
                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="middleName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Middle name</label>
                                                                <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['stu_mname']) . '" disabled>
                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="lastName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Last name</label>
                                                                <input type="text" class="form-control" name="lastname" value="' . htmlspecialchars($row['stu_lname']) . '" readonly disabled>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid last name.
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label class="form-label">Address</label>
                                                                <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['stu_address']) . '" readonly disabled>
                                                             </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['stu_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" readonly disabled>
                                                                 </div>
                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="gender' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Gender</label>
                                                                <select class="form-select" name="gender" id="gender' . htmlspecialchars($row['stu_lrn']) . '" readonly disabled>
                                                                    <option disabled value="">Choose...</option>
                                                                    <option value="male"' . ($row['stu_gender'] == 'MALE' ? ' selected' : '') . '>MALE</option>
                                                                    <option value="female"' . ($row['stu_gender'] == 'FEMALE' ? ' selected' : '') . '>FEMALE</option>
                                                                </select>
                                                             </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="email' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Email</label>
                                                                <input type="text" name="email" class="form-control" value="' . htmlspecialchars($row['stu_email']) . '"  placeholder="Enter your email address" pattern=".*@(gmail|yahoo)\.com$" readonly disabled>
                                                             </div>



                                                            <div class="col-md-12 mt-2">
                                                                <label for="dob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Date of Birth</label>
                                                                <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['stu_dob']) . '" value="' . htmlspecialchars($row['stu_dob']) . '" readonly disabled>
                                                             </div>
                                               

                                                            <div class="col-md-12 mt-2">
                                                                <label class="form-label">Address</label>
                                                                <input type="text" class="form-control" name="pob" value="' . htmlspecialchars($row['stu_pob']) . '" readonly disabled>
                                                             </div>

                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-success">Guardian Information   </h4> 
                                                        </div>

                                                        <div class="col-md-12 mt-2">
                                                                <label class="form-label">Father name</label>
                                                                <input type="text" class="form-control" name="fathername" value="' . htmlspecialchars($row['father_name']) . '" readonly disabled>
                                                         </div>

                                                            

                                                            <div class="col-md-12 mt-2">
                                                                <label class="form-label">Mother name</label>
                                                                <input type="text" class="form-control" name="mothername" value="' . htmlspecialchars($row['mother_name']) . '" readonly disabled>
                                                            </div>


                                                            <div class="col-md-12 mt-2">
                                                                <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="pcontact" value="' . htmlspecialchars($row['parent_contact']) . '" readonly disabled>
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
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Edit Student Information</h5>
                                                        <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="./includes/Operation/updateStudent.php" method="POST" class="row g-3 needs-validation" novalidate id="editTeacherForm' . htmlspecialchars($row['stu_lrn']) . '">
                                                            <!-- Use hidden input -->
                                                            <input type="hidden" name="lrnID" value="' . htmlspecialchars($row['stu_lrn']) . '">
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="firstName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">First name</label>
                                                                <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['stu_fname']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid first name.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="middleName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Middle name</label>
                                                                <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['stu_mname']) . '">
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
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
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Contact</label>
                                                                <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['stu_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid 10-digit number starting with 9.
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
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
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="dob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Date of Birth</label>
                                                                <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['stu_dob']) . '" value="' . htmlspecialchars($row['stu_dob']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid date of birth.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="col-12 mb-3">
                                                                <label for="pob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label fw-bold">Place of Birth</label>
                                                                <input type="text" class="form-control" name="pob" value="' . htmlspecialchars($row['stu_pob']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid address.
                                                                </div>
                                                            </div>
                                    
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-primary">Guardian Details</h4> 
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
                                                                    <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="pcontact" value="' . htmlspecialchars($row['parent_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid 10-digit number starting with 9.
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                            <div class="d-flex justify-content-between mt-4 gap-2">
                                                                <button name="submit" class="btn btn-primary w-100" type="submit">Save</button>
                                                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm(\'' . htmlspecialchars($row['stu_lrn']) . '\')">Cancel</button>
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
                                <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>Teacher not found.<br>
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
</main>



<?php
include("../admin/includes/footer.php");
?>

<script src="../assets/js/student.js"></script>