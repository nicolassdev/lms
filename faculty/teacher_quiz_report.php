<?php
// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}
if (!isset($_SESSION['username'])) {
    header("location:../login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'teacher') {
        header("location:../login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:../login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>


<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeSy = $mySQLFunction->checkSyStatus('sy');

$quizResult = $mySQLFunction->setEquivalentScoreBySubjectOfStudent($_SESSION['teacher_id'], 'quiz');
$numberOfEnrolledInSection = $mySQLFunction->checkEnrolledCountByTeacher($_SESSION['teacher_id']); //section handled by teacher

// echo "<pre>";
// print_r($quizResult);
// echo "</pre>";
?>


<!-- TABLE REPORT -->
<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">

                        <div class="text-dark">
                            <div class="fs-5 fw-bold">Quiz Reports</div>
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
                        <div class="text-dark fw-bold">
                            <?php if (!empty($quizResult)) {
                                foreach ($quizResult as $student) {
                                    echo htmlspecialchars($student["grade_lvl"]) . '  ';
                                    echo htmlspecialchars($student["section_name"]);
                                    break; // Exit loop after processing the first student
                                }
                            }
                            ?>
                            <?php
                            if (!empty($numberOfEnrolledInSection)) {
                                echo "<h6 class='text-black'>" . count($numberOfEnrolledInSection) .  " Student(s)</h6>";
                            } else {
                                echo "<h6 class='text-black'> " . count($numberOfEnrolledInSection) . "  Student</h6>";
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
                                if (!empty($quizResult)) {
                                    $count = 1;
                                    foreach ($quizResult as $row) {
                                        // Split scores
                                        $scores = explode(',', $row['scores'] ?? '');

                                        // Determine if the student's quarter matches the active quarter
                                        $isCurrentQuarter = in_array($row["quarter"], explode(",", implode(",", $activeQuarter)));

                                        // Determine status
                                        $status = (!empty($row['scores']) && count($scores) > 0);



                                        echo '<td class="small"> ' . $row["stu_lname"] . ',  ' .  ucwords(strtolower($row["stu_fname"] . ' ' . $row["stu_mname"] . '')) . '</td>';

                                        if ($isCurrentQuarter) {
                                            echo '<td class="small">' . (!empty($row["subject"]) ? ucwords(strtolower($row["subject"])) : '-') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['scores']) : '<span class="text-danger">0</span>') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['total_items']) : '<span class="text-danger">0</span>') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['equivalent_scores']) : '<span class="text-danger">N/A</span>') . '</td>';
                                        } else {
                                            echo '<td class="text-center text-muted">-</td>';
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
    initializeDataTable("student_report", 7, "Quiz Reports");
</script>