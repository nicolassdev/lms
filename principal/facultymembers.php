<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../includes/dbh-inc.php";
?>
<!-- 
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
</style> -->

<!-- TABLE -->
<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-2">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h5 class="fw-bold">Faculty Members</h5>
                        <!-- <button type="button" class="btn btn-primary btn-sm btn-animate" data-bs-toggle="modal" data-bs-target="#teacher">
                            <i class="bi bi-person-plus-fill me-1"></i>Add Faculty
                        </button> -->
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
                        <table id="facultyMembers" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Middle name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Birthday</th>
                                    <th scope="col">Address</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();
                                $result = $mySQLFunction->getTeacher();
                                if (!empty($result)) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                        // Create a DateTime object and format the added_date
                                        $addedDate = new DateTime($row['teacher_dob']);
                                        $formattedBdate = $addedDate->format('F j, Y');

                                        echo '<td>' . $count . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["teacher_fname"])) . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_mname"])) . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_lname"])) . '</td>';
                                        echo '<td>+63' . $row["teacher_contact"] . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_gender"])) . '</td>';
                                        echo '<td>' . $formattedBdate  . '</td>';
                                        echo '<td>' .  ucwords(strtolower($row["teacher_address"])) . '</td>';
                                        echo '
                                          <td class="d-flex justify-content-center">
                                              <button class="btn btn-sm btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#edit_teacher' . $row['teacher_id'] . '">
                                                  <i class="bi bi-eye me-1"></i>View
                                              </button>

                                              </td>
                                              ';

                                        echo '</tr>';

                                        $count++;


                                        //todo Mddal for view faculty information
                                        echo '
                                        <div class="modal fade" id="edit_teacher' . htmlspecialchars($row['teacher_id']) . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
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
                                                                    <h1 class="modal-title fs-5 text-success">Faculty Information</h1>
                                                                </div>

                                                                            <div class="text-end">
                                                                            <i class="bi bi-person-fill-check fs-1 text-success"></i>
                                                                                <div class="text-success fw-bolder">ID: ' . htmlspecialchars($row['teacher_id']) . '</div>
                                                                            </div>
                                                                    </div>
                                                                </div> 



 
                                                        <form action="./includes/Operation/updateStudent.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editTeacherForm' . htmlspecialchars($row['teacher_id']) . '">
                                                            <!-- Use hidden input -->
                                                            <input type="hidden" name="lrnID" value="' . htmlspecialchars($row['teacher_id']) . '">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="firstName' . htmlspecialchars($row['teacher_id']) . '" class="form-label">First Name</label>
                                                                        <input type="text" class="form-control" name="firstname" value="' . htmlspecialchars($row['teacher_fname']) . '" readonly disabled>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="middleName' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Middle Name</label>
                                                                        <input type="text" class="form-control" name="middlename" value="' . htmlspecialchars($row['teacher_mname']) . '" disabled>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="lastName' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Last name</label>
                                                                        <input type="text" class="form-control" name="lastname" value="' . htmlspecialchars($row['teacher_lname']) . '" readonly disabled>
                                                                    </div>
                                                                    <div class="col-md-12 mt-2">
                                                                        <label class="form-label">Address</label>
                                                                        <input type="text" class="form-control" name="address" value="' . htmlspecialchars($row['teacher_address']) . '" readonly disabled>
                                                                    </div>

                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="contactNumber' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Contact</label>
                                                                        <div class="input-group has-validation">
                                                                            <span class="input-group-text bg-success" style="color:white" id="inputGroupPrepend">+63</span>
                                                                            <input type="text" class="form-control" name="contact" value="' . htmlspecialchars($row['teacher_contact']) . '" aria-describedby="inputGroupPrepend" pattern="9\\d{9}" maxlength="10" readonly disabled>
                                                                        </div>
                                                                    </div>

                                                                    
                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="gender' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Gender</label>
                                                                        <input type="text" class="form-control" name="gender" id="gender' . htmlspecialchars($row['teacher_id']) . '" value="' . htmlspecialchars($row['teacher_gender']) . '" readonly disabled>
                                                                    </div>
                                                                    
 
                                                                    <div class="col-md-6 mt-2">
                                                                    <label for="dob' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Date of Birth</label>
                                                                        <input type="date" class="form-control" name="dob" id="dob' . htmlspecialchars($row['teacher_dob']) . '" value="' . htmlspecialchars($row['teacher_dob']) . '" readonly disabled>
                                                                    </div>

                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="status' . htmlspecialchars($row['teacher_id']) . '" class="form-label">Employment Status</label>
                                                                        <input type="text" class="form-control" name="status" id="status' . htmlspecialchars($row['status']) . '" value="' . htmlspecialchars($row['status']) . '" readonly disabled>
                                                                    </div>
                                                                    
                                                                </div>
                                                                
 
                                                            <div class="justify-center mt-3">
                                                                <div class="col-12">
                                                                    <button type="button"  class="btn btn-success w-100 mt-3 mb-2"  data-bs-dismiss="modal">Okay</button>
                                                                </div>
                                                              
                                                            </div>
                                                        </form>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                        ';
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
    <?php
    include("../admin/includes/extension.php");
    ?>

</main>

<!-- PDF ,EXCEL, PRINT ,CVS -->
<script src="../assets/js/globaltables.js"></script>
<script>
    initializeDataTable("facultyMembers", 8, "Faculty Members");
</script>