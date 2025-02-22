<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";

?>

<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/Forms/scheduleform.php";
?>




<style>
    .text-sm {
        font-size: 0.7em;
    }

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

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h5 class="fw-bold">List of Schedules</h5>

                        <!-- DISABLED THE BUTTON IN ADMIN ! TAKE NOT TO ENABLE THE BUTTON YOU NEED A PERMISSION IN DEVELOPER  -->
                        <button type="button" class="btn btn-primary btn-sm btn-animate" data-bs-toggle="modal" data-bs-target="#schedule" data-bs-whatever="@fat">
                            <i class="bi  bi-clock-history me-1"></i>Add Schedule
                        </button>
                    </div>
                    <!-- NOTIFICATION -->
                    <?php
                    if (isset($_SESSION['deleted'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1200px;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                        echo '</div>';
                        unset($_SESSION['deleted']);
                    } else if (isset($_SESSION['check_enrolled'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1200px;">';
                        echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['check_enrolled'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                        echo '</div>';
                        unset($_SESSION['check_enrolled']);
                    }
                    ?>

                    <div class="table-responsive small ms-3 me-3">
                        <table id="subjectSched" class="table table-bordered table-striped table-sm align-middle">

                            <thead class="table-dark text-light">
                                <tr>
                                    <th scope="col" class="small text-center">Subject Teacher</th>
                                    <th scope="col" class="small text-center">Strand</th>
                                    <th scope="col" class="small text-center">Year level</th>
                                    <th scope="col" class="small text-center">Section</th>
                                    <th scope="col" class="small text-center">Semester</th>
                                    <th scope="col" class="small text-center">Subject</th>
                                    <th scope="col" class="small text-center">Category</th>
                                    <th scope="col" class="small text-center">Day</th>
                                    <th scope="col" class="small text-center">From</th>
                                    <th scope="col" class="small text-center">To</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                $result = $mySQLFunction->getSchedule();
                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        $formattedTimefrom = date("H:i", strtotime($row["sched_from"]));
                                        $formattedTimeTo = date("H:i", strtotime($row["sched_to"]));



                                        echo '<tr>';
                                        echo '<td>' . ucwords(strtolower($row["teacher"])) . '</td>';
                                        echo '<td>' . $row["strand_name"] . '</td>';
                                        echo '<td>' . $row["grade_lvl"] . '</td>';
                                        echo '<td>' . $row["section_name"] . '</td>';
                                        echo '<td>' . $row["semester"] . '</td>';
                                        echo '<td>' . $row["sub_title"] . '</td>';
                                        echo '<td>' . ucwords(strtolower($row["sub_type"])) . '</td>';
                                        echo '<td>' . $row["sched_day"] . '</td>';
                                        echo '<td>' . $row["sched_from"] . '</td>';
                                        echo '<td>' . $row["sched_to"] . '</td>';

                                        // THIS IS THE DELETE BUTTON I WILL LEAVE IT AS COMMENT IF NEEDED JUST UNCOMMENT 

                                        //     <button class="btn btn-sm btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#del_enrolled' . urlencode($row['sched_id']) . '">
                                        //     <i class="bi bi-trash"></i>
                                        // </button>
                                        echo '
                                        
                                        <td class="d-flex justify-content-center pt-2 pb-3 ">
                                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit_enrolled' . urlencode($row['sched_id']) . '">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        
                                        </td>
                                            ';
                                        echo '</tr>';

                                        $count++;


                                        //todo Modal for updating subject schedule
                                        echo '
                                                                                    
                                            <div class="modal fade" id="edit_enrolled' . htmlspecialchars($row['sched_id']) . '" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="text-start">
                                                                <h1 class="modal-title fs-5 text-white">Edit Schedule</h1>
                                                            </div>
                                                            </div>
                                                            <div class="text-end">
                                                            <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                            </div>                           
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <form action="./includes/Operation/updateSchedule.php" method="POST" class="row g-3 needs-validation" novalidate id="editEnrollForm' . htmlspecialchars($row['sched_id']) . '"> 
                                                                <input type="hidden" name="schedID" value="' . htmlspecialchars($row['sched_id']) . '">
                                                                
                                                                <!-- Student Name -->
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label fw-semibold fs-6">Subject teacher</label>
                                                                    <input type="text" class="form-control" value="' . htmlspecialchars($row['teacher']) . '" readonly>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a student name.
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label fw-semibold fs-6">Subject</label>
                                                                    <input type="text" class="form-control" name="subject" value="' . htmlspecialchars($row['sub_title']) . '" readonly>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a student name.
                                                                    </div>
                                                                </div>

                                                    
                                                                <div class="col-md-12 mb-3">
                                                                    <label class="form-label fw-semibold fs-6">Day Schedule</label>
                                                                    <select class="form-select" name="day" required>
                                                                        <option value="" disabled' . ($row['sched_day'] == '' ? ' selected' : '') . '>Select a day ..</option>
                                                                        <option value="Monday"' . ($row['sched_day'] == 'Monday' ? ' selected' : '') . '>Monday</option>
                                                                        <option value="Tuesday"' . ($row['sched_day'] == 'Tuesday' ? ' selected' : '') . '>Tuesday</option>
                                                                        <option value="Wednesday"' . ($row['sched_day'] == 'Wednesday' ? ' selected' : '') . '>Wednesday</option>
                                                                        <option value="Thursday"' . ($row['sched_day'] == 'Thursday' ? ' selected' : '') . '>Thursday</option>
                                                                        <option value="Friday"' . ($row['sched_day'] == 'Friday' ? ' selected' : '') . '>Friday</option>
                                                                        <option value="Saturday"' . ($row['sched_day'] == 'Saturday' ? ' selected' : '') . '>Saturday</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select the day of the subject.
                                                                    </div>
                                                                </div>

                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label fw-semibold fs-6">From</label>
                                                                    <input type="time" class="form-control" name="time_from" value="' . $formattedTimefrom . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a student name.
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label fw-semibold fs-6">To</label>
                                                                    <input type="time" class="form-control" name="time_to" value="' . $formattedTimeTo . '" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter a student name.
                                                                    </div>
                                                                </div>                                                                
</div>

                                                                <!-- Buttons -->
                                                                <div class="d-flex justify-content-between mt-4 gap-2">
                                                                    <button name="submit" class="btn btn-success w-100" type="submit">Update</button>
                                                                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetSchedule(\'' . htmlspecialchars($row['sched_id']) . '\')">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                function resetSchedule(id) {
                                                    var form = document.getElementById("editEnrollForm" + id);
                                                    if (form) {
                                                        form.reset(); // Clears the form fields
                                                        form.classList.remove("was-validated"); // Removes the validation styling
                                                    }
                                                }
                                            </script>
                                            ';



                                        // Modal for deleting enrolled student
                                        echo '
                                        <div class="modal fade" id="del_enrolled' . urlencode($row['sched_id']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to delete "<span class="text-danger">' . ucwords(strtolower($row['teacher'])) . '</span>"?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                                                        <a href="includes/Operation/deleteEnrolled.php?id=' . urlencode($row['sched_id']) . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                    <td class="text-center text-danger">Please add new  subject schedule for this semester.</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>
                                    <td class="text-center text-muted">-</td>    
                                    <td class="text-center text-muted">-</td> 
                                    <td class="text-center text-muted">-</td> 
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
        <div class="ms-2">
            <?php
            if (!empty($activeSchoolYears && !empty($activeSem))) {
                foreach ($activeSchoolYears as $index => $schoolYear) {
                    echo '<div class="me-3  text-sm date-display">' . htmlspecialchars($activeSem[$index]) . '<i class="bi bi-check-circle-fill text-success ms-2"></i> </div>';
                    echo '<span class="date-display  text-sm">SY ' . htmlspecialchars($schoolYear) . '</span>';;
                }
            } else {
                echo '<div class="alert alert-warning  text-sm">No school year and semester found.</div>';
            }
            ?>
        </div>
    </div>
    <?php
    include("../admin/includes/extension.php");
    ?>
</main>

<!-- PDF ,EXCEL, PRINT ,CVS -->
<script src="../assets/js/globaltables.js"></script>
<script>
    initializeDataTable("subjectSched", 10, "Schedule Records");
</script>

<?php
$school_year_semester = '';

if (!empty($activeSchoolYears) && !empty($activeSem)) {
    foreach ($activeSchoolYears as $index => $schoolYear) {
        $school_year_semester .= '<div class="me-3 text-success">' . htmlspecialchars($activeSem[$index]) . '</div>';
        $school_year_semester .= '<span class="">SY ' . htmlspecialchars($schoolYear) . '</span>';
    }
} else {
    $school_year_semester = '<div class="alert alert-warning">No school year and semester found.</div>';
}
?>