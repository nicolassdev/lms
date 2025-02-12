<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<!-- FORM MODAL ADD STUDENT  -->
<?php
include "../includes/dbh-inc.php";

include "../faculty/includes/Forms/uploadmoduleform.php";
$mySQLFunction->connection();
$activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeSy = $mySQLFunction->checkSyStatus('sy');

$result = $mySQLFunction->setStudentEquivalentScoreBySubject($_SESSION['teacher_id']);

// echo "<pre>";
// print_r($result);
// echo "</pre>";
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


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">

                        <div class="text-dark">
                            <div class="fs-5 fw-bold">Transmutation Grade</div>
                            <small class="fw-semibold">
                                <span class="me-1">Quarterly:</span>
                                <?php if (!empty($activeQuarter)) {
                                    foreach ($activeQuarter as $quarter) {
                                        echo '<span class="ms-1">' . htmlspecialchars($quarter) . '</span> 
                                        <i class="bi bi-check-circle-fill text-success"></i>';
                                    }
                                } else {
                                    echo '<span class="alert alert-warning badge py-1 d-inline-block" style="font-size: small;">No active quarter found.</span>';
                                } ?><br>
                                <span class="me-1">Semester:</span>
                                <?php if (!empty($activeSem)) {
                                    foreach ($activeSem as $semester) {
                                        echo '<span class="ms-1">' . htmlspecialchars($semester) . '</span> 
                                        <i class="bi bi-check-circle-fill text-success"></i>';
                                    }
                                } else {
                                    echo '<span class="alert alert-warning badge py-1 d-inline-block" style="font-size: small;">No active semester found.</span>';
                                } ?><br>
                                <span class="me-1">School Year:</span>
                                <?php if (!empty($activeSy)) {
                                    foreach ($activeSy as $syear) {
                                        echo '<span class="ms-1">' . htmlspecialchars($syear) . '</span> 
                                        <i class="bi bi-check-circle-fill text-success"></i>';
                                    }
                                } else {
                                    echo '<span class="alert alert-warning badge py-1 d-inline-block" style="font-size: small;">No active school year found.</span>';
                                } ?>
                            </small>

                        </div>
                        <div class="text-black">
                            <?php if (!empty($result)) {
                                foreach ($result as $student) {
                                    echo htmlspecialchars($student["grade_lvl"]) . '  ';
                                    echo htmlspecialchars($student["section_name"]);
                                    break; // Exit loop after processing the first student
                                }
                            }
                            ?>
                            <?php
                            if (!empty($result)) {
                                echo "<h6 class='text-black'>" . count($result) . " Student(s)</h6>";
                            } else {
                                echo "<h6 class='text-black'> " . count($result) . "  Student</h6>";
                            }
                            ?>
                        </div>
                    </div>


                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="student_report" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>

                                    <th scope="col" style="width: 100px;">Student name</th>
                                    <th scope="col" style="width: 100px;">Subject</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Score</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Total Items</th>
                                    <!-- <th scope="col" style="width: 100px;">Equivalent Quiz Score</th> -->
                                    <th scope="col" class="text-center" style="width: 100px;">Equivalent Exam Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($result)) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                        // Split scores
                                        $scores = explode(',', $row['exam_scores'] ?? '');

                                        // Determine if the student's quarter matches the active quarter
                                        $isCurrentQuarter = in_array($row["quarter"], explode(",", implode(",", $activeQuarter)));

                                        // Determine status
                                        $status = (!empty($row['exam_scores']) && count($scores) > 0);



                                        echo '<td class="small"> ' . $row["stu_lname"] . ',  ' .  ucwords(strtolower($row["stu_fname"] . ' ' . $row["stu_mname"] . '')) . '</td>';
                                        echo '<td class="small">' . ucwords(strtolower($row["subject"])) . '</td>';

                                        if ($isCurrentQuarter) {
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['exam_scores']) : '<span class="text-danger">0</span>') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['exam_items']) : '<span class="text-danger">0</span>') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['equivalent_scores']) : '<span class="text-danger">N/A</span>') . '</td>';
                                        } else {
                                            echo '<td class="text-center text-muted">-</td>';
                                            echo '<td class="text-center text-muted">-</td>';
                                            echo '<td class="text-center text-muted">-</td>';
                                        }




                                        echo '</tr>';

                                        $count++;
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center mt-2 text-danger"><strong>Student not found.</strong>
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

<script src="../assets/js/globaltables.js"></script>
<!-- PDF ,EXCEL, PRINT ,CVS -->
<script>
    initializeDataTable("student_report", 7, "Reports");
</script>