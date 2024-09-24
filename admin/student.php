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

    .custom-btn {
        padding: 0.25rem 0.5rem;
        /* Adjust padding */
        font-size: 0.75em;
        /* Adjust font size */
    }
</style>


<!-- TABLE -->


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5 ms-3 me-3">
                        <h3 class="text-black">List of Student</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#student" data-bs-whatever="@fat">
                            <i class="bi bi-person-plus-fill me-1"></i>Student
                        </button>
                    </div>


                    <!-- NOTIFICATION -->
                    <?php
                    if (isset($_SESSION['deleted'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3 p-2" role="alert" style="font-size: 14px; line-height: 1.2;">';
                        echo '<strong>Notification: </strong> ' . $_SESSION['deleted'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted">Just now</small>';

                        echo '</div>';
                        unset($_SESSION['deleted']);
                    }
                    ?>
                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">LRN</th>
                                    <th scope="col" style="width: 100px;">Name</th>
                                    <th scope="col" style="width: 50px;">Initial</th>
                                    <th scope="col" style="width: 100px;">Surname</th>
                                    <th scope="col" style="width: 150px;">Address</th>
                                    <th scope="col" style="width: 100px;">Contact</th>
                                    <th scope="col" style="width: 50px;">Gender</th>
                                    <th scope="col" style="width: 100px;">Email</th>
                                    <th scope="col" style="width: 100px;">Birthday</th>
                                    <th scope="col" style="width: 150px;">Place of birth</th>
                                    <th scope="col" style="width: 100px;">Father</th>
                                    <th scope="col" style="width: 100px;">Mother</th>
                                    <th scope="col" style="width: 100px;">CP. No</th>
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
                                        echo '<td>' . $row["stu_lrn"] . '</td>';
                                        echo '<td>' . $row["stu_fname"] . '</td>';
                                        echo '<td>' . $row["stu_mname"] . '</td>';
                                        echo '<td>' . $row["stu_lname"] . '</td>';
                                        echo '<td>' . $row["stu_address"] . '</td>';
                                        echo '<td>' . $row["stu_contact"] . '</td>';
                                        echo '<td>' . $row["stu_gender"] . '</td>';
                                        echo '<td>' . $row["stu_email"] . '</td>';
                                        echo '<td>' . $row["stu_dob"] . '</td>';
                                        echo '<td>' . $row["stu_pob"] . '</td>';
                                        echo '<td>' . $row["father_name"] . '</td>';
                                        echo '<td>' . $row["mother_name"] . '</td>';
                                        echo '<td>' . $row["parent_contact"] . '</td>';
                                        echo '
                                            <td class="d-flex justify-content-center">
                                                <button  class="btn btn-sm btn-outline-primary custom-btn  me-2" data-bs-toggle="modal" data-bs-target="#edit_student' . $row['stu_lrn'] . '">
                                                    <i class="bi bi-pencil-square"></i>Edit
                                                </button>
                                            
                                                <button class="btn btn-sm btn-outline-danger custom-btn " data-bs-toggle="modal" data-bs-target="#del_student' . $row['stu_lrn'] . '">
                                                    <i class="bi bi-trash"></i>Delete
                                                </button>
                                            </td>
                                                ';
                                        echo '</tr>';

                                        $count++;



                                        // Modal for updating teacher
                                        echo '
                                            <div class="modal fade" id="edit_student' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content b-grey">
                                                        <div class="modal-body">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-3 text-primary">Student Details</h1><i class="bi bi-pencil-square fs-4"></i>
                                                            </div>
                                                            <form action="./includes/Operation/updateTeacher.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editTeacherForm' . htmlspecialchars($row['stu_lrn']) . '">
                                                                <!-- Use hidden input -->
                                                                <input type="hidden" name="lrnID" value="' . htmlspecialchars($row['stu_lrn']) . '">

                                                                <div class="col-md-12">
                                                                    <label for="firstName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">First name</label>
                                                                    <input type="text" class="form-control" name="fname" value="' . htmlspecialchars($row['stu_fname']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid first name.
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="middleName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Middle name</label>
                                                                    <input type="text" class="form-control" name="mname" value="' . htmlspecialchars($row['stu_mname']) . '">
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="lastName' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Last name</label>
                                                                    <input type="text" class="form-control" name="lname" value="' . htmlspecialchars($row['stu_lname']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid last name.
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Address</label>
                                                                    <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['stu_address']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid address.
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                    <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                                                    <div class="input-group has-validation">
                                                                        <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                                                                        <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['stu_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter a valid 10-digit number starting with 9.
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="gender' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Gender</label>
                                                                    <select class="form-select" name="gender" id="gender' . htmlspecialchars($row['stu_lrn']) . '" required>
                                                                        <option disabled value="">Choose...</option>
                                                                        <option value="male"' . ($row['stu_gender'] == 'MALE' ? ' selected' : '') . '>MALE</option>
                                                                        <option value="female"' . ($row['stu_gender'] == 'FEMALE' ? ' selected' : '') . '>FEMALE</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select a gender.
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="email' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Email</label>
                                                                    <input type="text" class="form-control" value="' . htmlspecialchars($row['stu_email']) . '"  placeholder="Enter your email address" name="email" pattern=".*@(gmail|yahoo)\.com$" required>
                                                                    <div class="invalid-feedback">
                                                                        Your email must contain an "@" symbol or gmail address ending with ".com".
                                                                    </div>
                                                                </div>




                                                                <div class="col-md-12">
                                                                    <label for="dob' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Date of Birth</label>
                                                                    <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['stu_dob']) . '" value="' . htmlspecialchars($row['stu_dob']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid date of birth.
                                                                    </div>
                                                                </div>
                                                   

                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Address</label>
                                                                    <input type="text" class="form-control" name="pob" value="' . htmlspecialchars($row['stu_pob']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid address.
                                                                    </div>
                                                                </div>

                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-primary">Guardian Details</h4> 
                                                            </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Father name</label>
                                                                    <input type="text" class="form-control" name="fathername" value="' . htmlspecialchars($row['father_name']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid address.
                                                                    </div>
                                                                </div>

                                                                

                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label">Mother name</label>
                                                                    <input type="text" class="form-control" name="mothername" value="' . htmlspecialchars($row['mother_name']) . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a valid address.
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-12">
                                                                    <label for="contactNumber' . htmlspecialchars($row['stu_lrn']) . '" class="form-label">Contact</label>
                                                                    <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                                                    <div class="input-group has-validation">
                                                                        <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                                                                        <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['parent_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                        <div class="invalid-feedback">
                                                                            Please enter a valid 10-digit number starting with 9.
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                                <div class="d-flex justify-center gap-2">
                                                                    <div class="col-6">
                                                                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Update</button>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm(\'' . htmlspecialchars($row['stu_lrn']) . '\')">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <script src="../assets/js/validationform.js"></script>

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




                                        // Modal for deleting teacher
                                        echo '
                                            <div class="modal fade" id="del_student' . $row['stu_lrn'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center mt-5">
                                                            <div class="text-danger">
                                                                <i class="bi bi-trash fs-1 "></i><br><br>
                                                            </div>
                                                            <h5>Are you sure you want to delete LRN '  . $row['stu_lrn'] . '?</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-5 mb-5">
                                                            <a href="includes/Operation/deleteStudent.php?id='  . $row['id'] . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
                                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
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






<script src="../assets/js/validationform.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>





<!-- jQuery and DataTables JS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script src="../assets/js/student.js"></script>