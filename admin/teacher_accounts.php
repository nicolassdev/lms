<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<!-- FORM MODAL ADD STUDENT  -->
<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$mySQLFunction->disconnect();
?>

<style>
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
<main class="col-md-12 ms-sm-auto col-lg-10">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h5 class="text-black">List of Faculty Accounts</h5>
                        <div class="d-flex">
                        </div>
                    </div>

                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Password</th>
                                    <!-- <th scope="col">Role</th> -->
                                    <th scope="col">Date Added</th>
                                    <!-- colspan should be 2 -->
                                    <!-- <th scope="col" class="text-center" style="width: 100px;">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();
                                $result = $mySQLFunction->getTeacherAccounts('TEACHER');
                                if (!empty($result)) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                        // Create a DateTime object and format the added_date
                                        $addedDate = new DateTime($row['date_added']); // Create a DateTime object for the current row
                                        $formattedDate = $addedDate->format('F j, Y'); // Format to "August 11, 2024"
                                        // Check if stu_dob is set and valid before using it
                                        if (isset($row['teacher_dob'])) {
                                            $formattedPassword = $mySQLFunction->generatePassword($row['teacher_dob']);
                                        } else {
                                            $formattedPassword = "N/A"; // Handle missing DOB
                                        }

                                        echo '<tr>';
                                        // echo '<td>' . $row["id"] . '</td>'; // Clickable ID
                                        echo '<td>' . $count . '</td>';
                                        echo '<td style="font-size:11px;">' .  ucwords(strtolower($row["teacher_fname"] . ' ' . $row["teacher_mname"] . ' ' . $row["teacher_lname"])) . '</td>';
                                        echo '<td style="color: #6610f2; font-weight:500;">' . $row["username"] . '</td>';
                                        echo '<td style="color: #6610f2; font-weight:500;">' . $formattedPassword . '</td>';
                                        // echo '<td>' . ucwords(strtolower($row["role"])) . '</td>';
                                        echo '<td>' . $formattedDate . '</td>';

                                        echo '</tr>';

                                        //Modal for updating users 
                                        echo '
                                        <div class="modal fade" id="edit_student' . $row['id'] . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content shadow">
                                                    <div class="modal-header border-bottom-0">
                                                        <h1 class="modal-title fs-5 text-primary" id="modalHeader' . $row['id'] . '">
                                                            ' . ($row['role'] == 'TEACHER' ? 'Teacher Account' : ($row['role'] == 'ADMIN' ? 'Admin Account' : 'Student Account')) . '
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="./includes/Operation/updateUser.php" method="POST" class="needs-validation" novalidate onsubmit="return validatePasswords()">
                                                            <input type="hidden" name="userID" value="' . $row['id'] . '">
                                                            
                                                            <div class="mb-3">
                                                                <label for="username" class="form-label">Username</label>
                                                                <input type="text" class="form-control" name="username" id="username" value="' . $row['username'] . '" required>
                                                                <div class="invalid-feedback">Please enter a username.</div>
                                                            </div>
                                        
                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control password-input" name="password" required placeholder="Enter new password">
                                                                </div>
                                                                <div class="invalid-feedback">Please enter a password.</div>
                                                            </div>
                                        
                                                            <div class="mb-3">
                                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" name="confirm_password" required placeholder="Confirm your password">
                                                                </div>
                                                                <div class="invalid-feedback">Please confirm your password.</div>
                                                            </div>
                                        
                                                                    <div class="d-flex justify-content-between mt-4 gap-1">
                                                                        <div class="col-6">
                                                                            <button name="submit" class="btn btn-primary w-100" type="submit">Update</button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script src="../assets/js/validationform.js"></script>
                                        ';




                                        // Modal for deleting users
                                        echo '
                                            <div class="modal fade" id="del_student' . $row['id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content shadow-lg">
                                                        <div class="modal-header border-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <div class="text-danger">
                                                                <i class="bi bi-trash fs-1 fade-in"></i>
                                                            </div>
                                                            <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to remove "<span class="text-danger">' . $row['id'] . '</span>" ?</h5>
                                                            <small class="text-muted">This action cannot be undone. Please confirm your decision below.</small>
                                                        </div>
                                                        <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                                                            <a href="includes/Operation/deleteUser.php?id=' . $row['id'] . '" class="btn btn-danger btn-md me-3" style="width: 120px;">Remove</a>
                                                            <button class="btn btn-outline-secondary btn-md" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                        $count++;
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center">Teacher accounts not found.<br>
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


<!-- PAGINATION AND SEARCH -->
<script>
    $(document).ready(function() {
        $("#example").DataTable({
            // dom: "Bfrtip", // Include buttons in the dom
            responsive: true,
            buttons: [],
        });
    });
</script>