<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>
<?php
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');
$mySQLFunction->disconnect();



?>
<?php

include "../admin/includes/Forms/quarterlyform.php";
?>

<!-- DISPLAY IN HOME  -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-3">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h5 class="fw-bold ms-3">Quarterly</h5>
        <!-- Button container for proper alignment -->
        <div class="d-flex gap-2">
            <!-- Semester button -->
            <button type="button" class="btn btn-primary btn-sm btn-animate" title="Quarterly" data-bs-toggle="modal" data-bs-target="#quarterly" data-bs-whatever="@fat">
                <i class="bi bi-plus me-1"></i>Quarterly
            </button>
            <button class="btn btn-secondary btn-sm me-3 btn-animate"><a class="nav-link " href="index.php?page=settings"><i class="bi bi-arrow-left-circle me-1"></i>Back</a>
            </button>
        </div>
    </div>



    <div class="border rounded p-5 bg-light mb-5 ms-3 me-3 shadow">
        <table id="example" class="table table-bordered table-striped table-sm align-middle ">
            <!-- NOTFICATION -->
            <?php
            if (isset($_SESSION['setactive'])) {
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
            }
            ?>

            <div class="mb-4 col-5">
                <h6 class="fw-semibold text-dark mb-2">
                    Active Quarter
                    <i class="bi bi-check-circle-fill text-success"></i>
                </h6>
                <span class="badge bg-success text-white px-3 py-2 rounded-pill">
                    <?php if (!empty($activeQuarter)) {
                        foreach ($activeQuarter as $quarter) {
                            echo htmlspecialchars($quarter);
                        }
                    } else {
                        echo "No active semester found.";
                    } ?>
                </span>
            </div>

            <thead class="table-info">
                <tr>
                    <th scope="col">Quarterly</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center" colspan="3">Action</th> <!-- colspan should be 2 -->
                </tr>
            </thead>
            <tbody>
                <?php
                $mySQLFunction->connection();
                $result = $mySQLFunction->getQuarter();
                if (!empty($result)) {
                    $count = 1;
                    foreach ($result as $row) {
                        echo '<tr>';
                        //   echo '<td>' . $row["num"] . '</td>';
                        echo '<td>' . $row["quarterly_name"]  . '</td>';
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
                                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#sem_active' . urlencode($row['quarterly_name']) . '">
                                    Set Active
                                </button>
                            </td>';
                        }
                        // THIS IS THE DELETE BUTTON I WILL LEAVE IT COMMENT JUST UNCOMMENT IF NEEDED 
                        // echo '
                        //     <td class="text-center">
                        //         <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_sem' . urlencode($row['quarterly_name']) . '">
                        //             <i class="bi bi-trash"></i> Delete
                        //         </button>
                        //     </td>
                        // ';

                        echo '</tr>';

                        // Modal for deleting semester

                        echo '
                            <div class="modal fade" id="del_sem' . urlencode($row['quarterly_name']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-body text-center mt-5">
                                            <div class="text-danger">
                                                <i class="bi bi-trash fs-1"></i><br><br>
                                            </div>
                                                <h5>Are you sure you want to remove "<span class="text-danger">' . str_replace('+', ' ', $row['quarterly_name']) . '</span>" ?</h5>
                                        </div>
                                        <div class="d-flex justify-content-center mt-5 mb-5">
                                            <a href="includes/Operation/deleteQuarter.php?id=' . urlencode($row['quarterly_name']) . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';

                        //  Modal set active semester
                        echo '
                          <div class="modal fade" id="sem_active' . urlencode($row['quarterly_name']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-md">
                                  <div class="modal-content">
                                      <div class="modal-body text-center mt-5">
                                          <div class="text-success">
                                              <i class="bi bi-question-circle fs-1 "></i><br><br>
                                          </div>
                                          <h6>Are you sure you want to set the school year "<span class="text-success">'  . str_replace('+', ' ', $row['quarterly_name']) . '</span>" to Active?</h5>
                                      </div>
                                      <div class="d-flex justify-content-center mt-5 mb-5">
                                          <a href="includes/Operation/activeQuarter.php?id='  . urlencode($row['quarterly_name']) . '" class="btn btn-success me-3" style="width: 120px;">Active</a>
                                          <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                      </div>
                                  </div>
                              </div>
                          </div>';

                        $count++;
                    }
                } else {
                    echo '<tr>
                        <td colspan="10" class="text-center">No active semester found.<br>
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