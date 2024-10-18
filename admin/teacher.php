<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../includes/dbh-inc.php";
include "../admin/includes/Forms/teacherform.php";
?>



<!-- TABLE -->
<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h3 class="text-black">List of Faculty</h3>
                        <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#teacher">
                            <i class="bi bi-person-plus-fill me-1"></i>Register
                        </button>
                    </div>

                    <!-- NOTIFICATION -->
                    <?php
                    if (isset($_SESSION['deleted'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3 p-2" role="alert" style="font-size: 14px; line-height: 1.2;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];
                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted">Just now</small>';

                        echo '</div>';
                        unset($_SESSION['deleted']);
                    }
                    ?>

                    <!-- FACULTY TABLE  -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Name</th>
                                    <th scope="col">Middle name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col">Address</th>
                                    <th scope="col" class="text-center">Action</th> <!-- colspan should be 2 -->

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();
                                $result = $mySQLFunction->getTeacher();
                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        // Create a DateTime object and format the added_date
                                        $addedDate = new DateTime($row['teacher_dob']);
                                        $formattedBdate = $addedDate->format('F j, Y');

                                        // echo '<td>' . $row["teacher_id"] . '</td>';
                                        // echo '<td>' . $count . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["teacher_fname"])) . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_mname"])) . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_lname"])) . '</td>';
                                        echo '<td>+63' . $row["teacher_contact"] . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_gender"])) . '</td>';
                                        echo '<td>' . $formattedBdate  . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_address"])) . '</td>';
                                        echo '
                      <td class="d-flex justify-content-center">
                          <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#edit_teacher' . $row['teacher_id'] . '">
                              <i class="bi bi-pencil-square"></i>Edit
                          </button>
                      
                          <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_teacher' . $row['teacher_id'] . '">
                              <i class="bi bi-trash"></i>Delete
                          </button>
                      </td>
                        ';
                                        echo '</tr>';

                                        $count++;



                                        // Modal for updating teacher
                                        echo '
                                        <div class="modal fade" id="edit_teacher' . htmlspecialchars($row['teacher_id']) . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Edit Teacher Details</h5>
                                                        <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="./includes/Operation/updateTeacher.php" method="POST" class="row g-3 needs-validation" novalidate id="editTeacherForm' . htmlspecialchars($row['teacher_id']) . '">
                                                            <!-- Use hidden input -->
                                                            <input type="hidden" name="teacherID" value="' . htmlspecialchars($row['teacher_id']) . '">
                                        
                                                            <!-- First Name -->
                                                            <div class="col-12 mb-3">
                                                                <label for="firstName' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">First Name</label>
                                                                <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['teacher_fname']) . '" required>
                                                                <div class="invalid-feedback">Please enter a valid first name.</div>
                                                            </div>
                                        
                                                            <!-- Middle Name -->
                                                            <div class="col-12 mb-3">
                                                                <label for="middleName' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">Middle Name</label>
                                                                <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['teacher_mname']) . '">
                                                            </div>
                                        
                                                            <!-- Last Name -->
                                                            <div class="col-12 mb-3">
                                                                <label for="lastName' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">Last Name</label>
                                                                <input type="text" class="form-control" name="lastname" value="' . htmlspecialchars($row['teacher_lname']) . '" required>
                                                                <div class="invalid-feedback">Please enter a valid last name.</div>
                                                            </div>
                                        
                                                            <!-- Contact Number -->
                                                            <div class="col-12 mb-3">
                                                                <label for="contactNumber' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">Contact</label>
                                                                <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                                                    <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['teacher_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                                    <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                                                                </div>
                                                            </div>
                                        
                                                            <!-- Gender -->
                                                            <div class="col-12 mb-3">
                                                                <label for="gender' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">Gender</label>
                                                                <select class="form-select" name="gender" id="gender' . htmlspecialchars($row['teacher_id']) . '" required>
                                                                    <option disabled value="">Choose...</option>
                                                                    <option value="male"' . ($row['teacher_gender'] == 'MALE' ? ' selected' : '') . '>MALE</option>
                                                                    <option value="female"' . ($row['teacher_gender'] == 'FEMALE' ? ' selected' : '') . '>FEMALE</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please select a gender.</div>
                                                            </div>
                                        
                                                            <!-- Date of Birth -->
                                                            <div class="col-12 mb-3">
                                                                <label for="dob' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">Date of Birth</label>
                                                                <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['teacher_id']) . '" value="' . htmlspecialchars($row['teacher_dob']) . '" required>
                                                                <div class="invalid-feedback">Please enter a valid date of birth.</div>
                                                            </div>
                                        
                                                            <!-- Employment Status -->
                                                            <div class="col-12 mb-3">
                                                                <label for="employmentStatus' . htmlspecialchars($row['teacher_id']) . '" class="form-label fw-bold">Employment Status</label>
                                                                <select class="form-select" name="status" id="employmentStatus' . htmlspecialchars($row['teacher_id']) . '" required>
                                                                    <option disabled value="">Choose...</option>
                                                                    <option value="full time"' . ($row['status'] == 'FULL TIME' ? ' selected' : '') . '>Full-time job</option>
                                                                    <option value="part time"' . ($row['status'] == 'PART TIME' ? ' selected' : '') . '>Part-time job</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please select an employment status.</div>
                                                            </div>
                                        
                                                            <!-- Address -->
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label fw-bold">Address</label>
                                                                <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['teacher_address']) . '" required>
                                                                <div class="invalid-feedback">Please enter a valid address.</div>
                                                            </div>
                                        
                                                            <!-- Buttons -->
                                                            <div class="d-flex justify-content-between mt-4 gap-3">
                                                                <button name="submit" class="btn btn-primary w-100" type="submit">Save</button>
                                                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm(\'' . htmlspecialchars($row['teacher_id']) . '\')">Cancel</button>
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
                                        <div class="modal fade" id="del_teacher' . $row['teacher_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to delete "<span class="text-danger">' . ucwords(strtolower($row['teacher_fname'])) . ' ' . ucwords(strtolower($row['teacher_lname'])) . '</span>"?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-2 mb-4">
                                                        <a href="includes/Operation/deleteTeacher.php?id=' . $row['id'] . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Delete</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center">Teacher not found.<br>
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

<!-- PDF ,EXCEL, PRINT ,CVS -->
<script src="../assets/js/faculty.js"></script>