<?php
include "../includes/dbh-inc.php";
?>

<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/enrollmentform.php";
?>





<!-- TABLE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h3 class="text-black">List of Enrolled Student</h3>


                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enroll" data-bs-whatever="@fat">
                            <i class="bi bi-person-plus-fill me-1"></i>Enroll Student
                        </button>
                    </div>


                    <div class="table-responsive small ms-3 me-3">
                        <table class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark text-light">
                                <tr>
                                    <th scope="col">Student name</th>
                                    <th scope="col">Strand</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Date Enrolled</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Current School</th>
                                    <th scope="col">School ID</th>
                                    <th scope="col">School Address</th>
                                    <th scope="col">School Type</th>
                                    <th scope="col" class="text-center" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                $result = $mySQLFunction->getEnroll();
                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        echo '<tr>';

                                        echo '<td>' . $row["student"] . '</td>';
                                        echo '<td>' . $row["strand_name"] . '</td>';
                                        echo '<td>' . $row["section_name"] . '</td>';
                                        echo '<td>' . $row["adviser"] . '</td>';
                                        echo '<td>' . $row["enroll_semester"] . '</td>';
                                        echo '<td>' . $row["date_enroll"] . '</td>';
                                        echo '<td>' . $row["enroll_status"] . '</td>';
                                        echo '<td>' . $row["current_school"] . '</td>';
                                        echo '<td>' . $row["school_id"] . '</td>';
                                        echo '<td>' . $row["school_address"] . '</td>';
                                        echo '<td>' . $row["school_type"] . '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#edit_enroll' . urlencode($row['student']) . '">
                                                <i class="bi bi-pencil-square"></i> 
                                            </button>
                                        
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_enrolled' . urlencode($row['student']) . '">
                                                <i class="bi bi-trash"></i> 
                                            </button>
                                        </td>
                                            ';
                                        echo '</tr>';

                                        $count++;




                                        // Modal for deleting enrolled student
                                        echo '
                                            <div class="modal fade" id="del_enrolled' . urlencode($row['student']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center mt-5">
                                                            <div class="text-danger">
                                                                <i class="bi bi-trash fs-1 "></i><br><br>
                                                            </div>
                                                            <h5>Are you sure you want to delete '  . $row['student'] . ' ?</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-5 mb-5">
                                                            <a href="includes/Operation/deleteEnrolled.php?id='  . urlencode($row['student']) . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
                                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>Section not found.<br>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>