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
<main class="col-md-12 ms-sm-auto col-lg-10 px-md-3 mt-5 py-4 me-2">
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
                        <div class="fw-semibold">
                            <div class="py-2 px-3 rounded-3 primary-color text-white">
                                <?php if (!empty($quizResult)) {
                                    foreach ($quizResult as $student) {
                                        echo htmlspecialchars($student["grade_lvl"]) . '  ';
                                        echo htmlspecialchars($student["section_name"]);
                                        break; // Exit loop after processing the first student
                                    }
                                } else {
                                    echo "No section";
                                }
                                ?>
                            </div>
                            <div class="pt-2">
                                <?php
                                if (!empty($numberOfEnrolledInSection)) {
                                    echo "<p class='text-black text-end'>" . count($numberOfEnrolledInSection) .  " Student(s)</p>";
                                } else {
                                    echo "<p class='text-black text-end'> " . count($numberOfEnrolledInSection) . "  Student</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="student_report" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-info">
                                <tr>

                                    <th scope="col" style="width: 100px;">Student name</th>
                                    <th scope="col" style="width: 100px;">Subject</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Score</th>
                                    <th scope="col" class="text-center" style="width: 100px;">Total Items</th>
<<<<<<< HEAD
                                    <!-- <th scope="col" style="width: 100px;">Equivalent Quiz Score</th> -->
=======
>>>>>>> 3ccae3e97c642f16d9dd73dc3ea92784f832d198
                                    <th scope="col" class="text-center" style="width: 100px;">Equivalent Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($quizResult)) {
                                    $count = 1;
                                    $activeQuarterArray = $mySQLFunction->checkQuarterStatus('quarterly');

                                    foreach ($quizResult as $row) {
                                        // Check if the current quarter matches the active quarter
                                        if (isset($row['quarter']) && trim($row['quarter']) === trim($activeQuarterArray[0])) {
                                            echo '<tr>';
                                            echo '<td class="small"> ' . $row["stu_lname"] . ',  ' . ucwords(strtolower($row["stu_fname"] . ' ' . $row["stu_mname"])) . '</td>';
                                            $subject = !empty($row["subject"]) ? ucwords(strtolower($row["subject"])) : '-';
                                            echo '<td class="small">' . htmlspecialchars($subject) . '</td>';

                                            echo '<td class="text-center text-success fw-bold">' . htmlspecialchars($row['scores'] ?? '0') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . htmlspecialchars($row['total_items'] ?? '0') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . htmlspecialchars($row['equivalent_scores'] ?? 'N/A') . '</td>';

                                            echo '</tr>';
                                            $count++;
                                        }
                                    }
                                } else {
                                    echo '<tr>
                                    <td class="text-center text-danger">No student found</td>
                                    <td class="text-center text-muted">N/A</td>
                                    <td class="text-center text-muted">0</td>
                                    <td class="text-center text-muted">0</td>    
                                    <td class="text-center text-muted">0</td>  
                                    </tr>';
                                }
                                ?>
                            </tbody>
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