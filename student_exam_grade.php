<?php

if (!isset($_SESSION['username'])) {
    header("location:login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'student') {
        header("location:login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>

<?php
//connect 
include "./includes/dbh-inc.php";

$mySQLFunction->connection();
$activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeSy = $mySQLFunction->checkSyStatus('sy');

$examResult = $mySQLFunction->getEquivalentScoreBySubjectOfIndividualStudent($_SESSION['stu_lrn'], 'exam');

// echo "<pre>";
// print_r($examResult);
// echo "</pre>";
?>

<!-- TABLE REPORT -->
<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-4 pt-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">

                        <div class="text-dark">
                            <h4 class="fw-bold text-muted">
                                Exam Grade
                            </h4>
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
                        <div class="text-dark fw-bold bg-dark text-white py-2 px-3 rounded-3">
                            <?php if (!empty($examResult)) {
                                foreach ($examResult as $student) {
                                    echo htmlspecialchars($student["grade_lvl"]) . '  ';
                                    echo htmlspecialchars($student["section_name"]);
                                    break; // Exit loop after processing the first student
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <hr class="text-secondary" />
                    <!-- STUDENT EXAM RESULT -->
                    <div class="small ms-3 me-1 lms-scroll-bar">
                        <div class="row g-3">
                            <?php
                            if (!empty($examResult)) {
                                $count = 0;
                                foreach ($examResult as $row) {
                                    if (empty($row["subject"])) continue;

                                    $scores = explode(',', $row['scores'] ?? '');
                                    $isCurrentQuarter = in_array($row["quarter"], explode(",", implode(",", $activeQuarter)));
                                    $status = (!empty($row['scores']) && count($scores) > 0);

                                    if ($isCurrentQuarter) {
                                        // Data processing
                                        $subject = ucwords(strtolower($row["subject"]));
                                        $score = $status ? htmlspecialchars($row['scores']) : '0';
                                        $totalItems = isset($row['total_items']) ? htmlspecialchars($row['total_items']) : '0';
                                        $equivalentGrade = isset($row['equivalent_scores']) ? htmlspecialchars($row['equivalent_scores']) : 'N/A';

                                        // Color-based on grade
                                        $gradeColor = ($equivalentGrade != 'N/A' && $equivalentGrade != 65) ? "text-success" : "text-danger";

                                        echo '<div class="col-md-4 col-sm-6 col-12">';
                                        echo '<div class="card shadow border-0 h-100  rounded-3">';
                                        echo '<div class="card-body">';
                                        echo '<h6 class="card-title fw-bold text-truncate text-dark">' . $subject . '</h6>';
                                        echo '<hr class="text-secondary" />';
                                        echo '<p class="mb-2 text-dark"><strong>Score:</strong> <span class="text-primary fw-bold">' . $score . '</span></p>';
                                        echo '<p class="mb-2 text-dark"><strong>Total Items:</strong> <span class="text-info fw-bold">' . $totalItems . '</span></p>';
                                        echo '<p class="mb-2 text-dark"><strong>Equivalent Grade:</strong> <span class="' . $gradeColor . ' fw-bold">' . $equivalentGrade . '</span></p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';

                                        $count++;
                                    }
                                }
                                if ($count === 0) {
                                    echo '
                                        <div class="card-body text-center">
                                            <i class="bi bi-info-circle-fill text-danger display-6 mb-3 "></i>
                                            <h6 class="text-secondary fw-bold">Result not found.</h6>
                                            <p class="text-muted">Please take exam first.</p>
                                        </div>
                                   ';
                                }
                            } else {
                                echo '
                                <div class="card-body text-center">
                                    <i class="bi bi-info-circle-fill text-danger display-6 mb-3 "></i>
                                    <h6 class="text-secondary fw-bold">Result not found.</h6>
                                    <p class="text-muted">Please take exam first.</p>
                                </div>
                           ';
                            }
                            ?>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</main>