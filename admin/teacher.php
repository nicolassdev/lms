<?php
include "../includes/dbh-inc.php";
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/teacherform.php";
?>

<!-- MODAL UPDATE DELETE  -->
<?php
include "../admin/includes/forms/teacherdelete.php";
?>

 

<!-- TABLE -->
 <main class="col-md-12 ms-sm-auto col-lg-10 px-md-4">

            <div class="container">
              <div class="row">
                <div class="col-12">
                  <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                      <h3 class="text-black">List of Faculty</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacher">
                          <i class="bi bi-person-plus-fill me-1"></i>Register
                        </button>
                     </div>

                      <!-- TABLE -->
                    <div class="table-responsive small ms-3 me-1">                          
                    <table id="example" class="table table-bordered table-striped table-sm align-middle">
                      <thead class="table-dark">
                        <tr>
                          <!-- <th scope="col">#</th> -->
                          <th scope="col">Name</th>
                          <th scope="col">Initial</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Birthday</th>
                                <!-- <th scope="col">Status</th> -->
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
                      echo '<tr>';
                      // echo '<td>' . $row["teacher_id"] . '</td>';
                      // echo '<td>' . $count . '</td>';
                      echo '<td>' . $row["teacher_fname"] . '</td>';
                      echo '<td>' . $row["teacher_mname"] . '</td>';
                      echo '<td>' . $row["teacher_lname"] . '</td>';
                      echo '<td>' . $row["teacher_contact"] . '</td>';
                      echo '<td>' . $row["teacher_gender"] . '</td>';
                      echo '<td>' . $row["teacher_dob"] . '</td>';
                      // echo '<td>' . $row["status"] . '</td>';
                      echo '<td>' . $row["teacher_address"] . '</td>';
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
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content b-grey">
                                <div class="modal-body">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-3 text-primary">Teacher Details</h1><i class="bi bi-pencil-square fs-4"></i>
                                    </div>
                                    <form action="./includes/Operation/updateTeacher.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editTeacherForm' . htmlspecialchars($row['teacher_id']) . '">
                                        <!-- Use hidden input -->
                                        <input type="hidden" name="teacherID" value="' . htmlspecialchars($row['teacher_id']) . '">

                                        <div class="col-md-12">
                                            <label for="firstName' . htmlspecialchars($row['teacher_id']) . '" class="form-label">First name</label>
                                            <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['teacher_fname']) . '" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid first name.
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="middleName' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Middle name</label>
                                            <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['teacher_mname']) . '">
                                        </div>

                                        <div class="col-md-12">
                                            <label for="lastName' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Last name</label>
                                            <input type="text" class="form-control" name="lastname" value="' . htmlspecialchars($row['teacher_lname']) . '" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid last name.
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="contactNumber' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Contact</label>
                                            <small style="color:red">( Please enter a valid 10-digit number starting with 9. )</small>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                                                <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['teacher_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid 10-digit number starting with 9.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="gender' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" id="gender' . htmlspecialchars($row['teacher_id']) . '" required>
                                                <option disabled value="">Choose...</option>
                                                <option value="male"' . ($row['teacher_gender'] == 'MALE' ? ' selected' : '') . '>MALE</option>
                                                <option value="female"' . ($row['teacher_gender'] == 'FEMALE' ? ' selected' : '') . '>FEMALE</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a gender.
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="dob' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['teacher_id']) . '" value="' . htmlspecialchars($row['teacher_dob']) . '" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid date of birth.
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="employmentStatus' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Employment Status</label>
                                            <select class="form-select" name="status" id="employmentStatus' . htmlspecialchars($row['teacher_id']) . '" required>
                                                <option disabled value="">Choose...</option>
                                                <option value="full time"' . ($row['status'] == 'FULL TIME' ? ' selected' : '') . '>Full-time job</option>
                                                <option value="part time"' . ($row['status'] == 'PART TIME' ? ' selected' : '') . '>Part-time job</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select an employment status.
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['teacher_address']) . '" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid address.
                                            </div>
                                        </div>

                                        <div class="d-flex justify-center gap-2">
                                            <div class="col-6">
                                                <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Update</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm(\'' . htmlspecialchars($row['teacher_id']) . '\')">Cancel</button>
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
                                  <div class="modal fade" id="del_teacher' . $row['teacher_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered modal-md">
                                          <div class="modal-content">
                                              <div class="modal-body text-center mt-5">
                                                  <div class="text-danger">
                                                      <i class="bi bi-trash fs-1 "></i><br><br>
                                                  </div>
                                                  <h5>Are you sure you want to delete '  . $row['teacher_fname'] . '&nbsp;' . $row['teacher_lname'] . '?</h5>
                                              </div>
                                              <div class="d-flex justify-content-center mt-5 mb-5">
                                                  <a href="includes/Operation/deleteTeacher.php?id='  . $row['id'] . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
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
 


<!-- Notification Insert Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center mt-5">
        <div class="text-success">
          <i class="bi bi-check-circle fs-1 "></i><br><br>
        </div>
        <p class="mb-4"> Teacher has been added successfully.</p>
      </div>
      <div class="d-flex justify-content-center mt-3 mb-5 ">
        <button class="btn btn-success me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
      </div>
    </div>
  </div>
</div>






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

<!-- PDF ,EXCEL, PRINT ,CVS -->
<script src="../assets/js/faculty.js"></script>
