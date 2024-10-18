<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>
<?php
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$activeSemester = $mySQLFunction->checkSemStatus('semester');
$mySQLFunction->disconnect();



?>
<?php

include "../admin/includes/Forms/semesterform.php";
?>

<!-- DISPLAY IN HOME  -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h3 class="ms-3">Semester</h3>
        <!-- Button container for proper alignment -->
        <div class="d-flex gap-3">
            <!-- Semester button -->
            <button type="button" class="btn btn-success mb-3 btn-animate" title="Semester" data-bs-toggle="modal" data-bs-target="#semester" data-bs-whatever="@fat">
                <i class="bi bi-plus me-1"></i>Semester
            </button>
            <button class="btn btn-secondary mb-3 me-3 btn-animate"><a class="nav-link " href="index.php?page=settings"><i class="bi bi-arrow-left-circle me-1"></i>Back</a>
            </button>
        </div>
    </div>



    <div class="border rounded p-5 bg-light mb-5 ms-3 me-3 shadow">
        <table id="example" class="table table-bordered table-striped table-sm align-middle ">
            <!-- NOTFICATION -->
            <?php
            if (isset($_SESSION['insert'])) {
                echo '<div class="alert alert-primary alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
                echo '<i class="bi bi-info-square-fill fs-5 me-2"></i>' . $_SESSION['insert'];

                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                // Reduced font size for the timestamp
                echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                echo '</div>';
                unset($_SESSION['insert']);
            } elseif (isset($_SESSION['setactive'])) {
                echo '<div class="alert alert-success alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
                echo '<i class="bi bi-check-circle-fill fs-5 me-2"></i>' . $_SESSION['setactive'];

                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                // Reduced font size for the timestamp
                echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                echo '</div>';
                unset($_SESSION['setactive']);
            } elseif (isset($_SESSION['deleted'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
                echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];

                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                // Reduced font size for the timestamp
                echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                echo '</div>';
                unset($_SESSION['deleted']);
            } elseif (isset($_SESSION['error_insert'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
                echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>' . $_SESSION['error_insert'];

                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                // Reduced font size for the timestamp
                echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';
                echo '</div>';
                unset($_SESSION['error_insert']);
            }
            ?>

            <div class="mb-4 col-5">
                <label class="form-label fs-5">Active semester</label>
                <input type="text" name="schoolyear" value="<?php if (!empty($activeSemester)) {
                                                                foreach ($activeSemester as $semester) {
                                                                    echo   "" . $semester . "";
                                                                }
                                                            } else {
                                                                echo "No active semester found.";
                                                            } ?>" class="form-control form-control-lg" autocomplete="off" disabled>
            </div>
            <thead class="table-dark">
                <tr>
                    <th scope="col">Semester</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center" colspan="3">Action</th> <!-- colspan should be 2 -->
                </tr>
            </thead>
            <tbody>
                <?php
                $mySQLFunction->connection();
                $result = $mySQLFunction->getSemester();
                if (!empty($result)) {
                    $count = 1;
                    foreach ($result as $row) {
                        echo '<tr>';
                        //   echo '<td>' . $row["num"] . '</td>';
                        echo '<td>' . $row["semester_name"]  . '</td>';
                        echo '<td>' . $row["status"] . '</td>';

                        // Check if status is Active or Inactive to toggle button label and style
                        if ($row["status"] == 'Active') {
                            echo '
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger">
                                    Default
                                </button>
                            </td>';
                        } else {
                            echo '
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#sem_active' . urlencode($row['semester_name']) . '">
                                    Set Active
                                </button>
                            </td>';
                        }

                        echo '
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_sem' . urlencode($row['semester_name']) . '">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        ';

                        echo '</tr>';

                        // Modal for deleting semester

                        echo '
                            <div class="modal fade" id="del_sem' . urlencode($row['semester_name']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-body text-center mt-5">
                                            <div class="text-danger">
                                                <i class="bi bi-trash fs-1"></i><br><br>
                                            </div>
                                                <h5>Are you sure you want to remove "<span class="text-danger">' . str_replace('+', ' ', $row['semester_name']) . '</span>" ?</h5>
                                        </div>
                                        <div class="d-flex justify-content-center mt-5 mb-5">
                                            <a href="includes/Operation/deleteSem.php?id=' . urlencode($row['semester_name']) . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                        //  Modal set active semester
                        echo '
                          <div class="modal fade" id="sem_active' . urlencode($row['semester_name']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-md">
                                  <div class="modal-content">
                                      <div class="modal-body text-center mt-5">
                                          <div class="text-success">
                                              <i class="bi bi-question-circle fs-1 "></i><br><br>
                                          </div>
                                          <h6>Are you sure you want to set the school year "<span class="text-success">'  . str_replace('+', ' ', $row['semester_name']) . '</span>" to Active?</h5>
                                      </div>
                                      <div class="d-flex justify-content-center mt-5 mb-5">
                                          <a href="includes/Operation/activeSem.php?id='  . urlencode($row['semester_name']) . '" class="btn btn-success me-3" style="width: 120px;">Active</a>
                                          <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                          </div>';

                        $count++;
                    }
                } else {
                    echo '<tr>
                        <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>No active semester found.<br>
                        </td>
                      </tr>';
                }

                echo '</tbody>';
                echo '</table>';
                $mySQLFunction->disconnect();
                ?>


    </div>



</main>







<!-- Bootstrap JS (Ensure Bootstrap JS is loaded for modal functionality) -->

<script src="../assets/js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>