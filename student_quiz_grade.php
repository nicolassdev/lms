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

$quizResult = $mySQLFunction->getEquivalentScoreBySubjectOfIndividualStudent($_SESSION['stu_lrn'], 'quiz');

// echo "<pre>";
// print_r($quizResult);
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
                            <h4 class="fw-bold text-muted">Quiz Reports</h4>
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
                            <?php if (!empty($quizResult)) {
                                foreach ($quizResult as $student) {
                                    echo htmlspecialchars($student["grade_lvl"]) . '  ';
                                    echo htmlspecialchars($student["section_name"]);
                                    break; // Exit loop after processing the first student
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <hr class="text-secondary" />
                    <!-- STUDENT QUIZ RESULT -->
                    <div class="small ms-3 me-1 lms-scroll-bar">
                        <div class="row g-3 fade-in-input">
                            <?php
                            if (!empty($quizResult)) {
                                $count = 0;
                                foreach ($quizResult as $row) {
                                    if (empty($row["subject"])) continue;

                                    $scores = explode(',', $row['scores'] ?? '');
                                    $isCurrentQuarter = in_array($row["quarter"], explode(",", implode(",", $activeQuarter)));
                                    $status = (!empty($row['scores']) && count($scores) > 0);

                                    if ($isCurrentQuarter) {
                                        $subject = ucwords(strtolower($row["subject"]));
                                        $score = $status ? htmlspecialchars($row['scores']) : '0';
                                        $totalItems = isset($row['total_items']) ? htmlspecialchars($row['total_items']) : '0';
                                        $equivalentGrade = isset($row['equivalent_scores']) ? htmlspecialchars($row['equivalent_scores']) : 'N/A';

                                        $gradeColor = ($equivalentGrade != 'N/A' && $equivalentGrade != 65) ? "text-success" : "text-danger";

                                        echo '<div class="col-md-4 col-sm-6 col-12">';
                                        echo '<div class="card shadow-sm border-0 h-100 rounded-4">';
                                        echo '<div class="card-body text-center p-4">';
                                        echo '<h6 class="card-title fw-bold text-truncate text-primary">' . $subject . '</h6>';
                                        echo '<hr class="text-secondary" />';
                                        echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                                        echo '<span class="text-dark">Score:</span>';
                                        echo '<span class="fw-bold text-primary">' . $score . '</span>';
                                        echo '</div>';
                                        echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                                        echo '<span class="text-dark">Total Items:</span>';
                                        echo '<span class="fw-bold text-info">' . $totalItems . '</span>';
                                        echo '</div>';
                                        echo '<div class="d-flex justify-content-between align-items-center">';
                                        echo '<span class="text-dark">Grade:</span>';
                                        echo '<span class="fw-bold ' . $gradeColor . '">' . $equivalentGrade . '</span>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        $count++;
                                    }
                                }
                                if ($count === 0) {
                                    echo '<div class="col-12 text-center">';
                                    echo '<div class="card border-0 shadow-sm rounded-4">';
                                    echo '<div class="card-body py-5">';
                                    echo '<i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>';
                                    echo '<h6 class="text-secondary fw-bold">Result not found</h6>';
                                    echo '<p class="text-muted">Please take your quiz first.</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="col-12 text-center">';
                                echo '<div class="card border-0 shadow-sm rounded-4">';
                                echo '<div class="card-body py-5">';
                                echo '<i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>';
                                echo '<h6 class="text-secondary fw-bold">Result not found</h6>';
                                echo '<p class="text-muted">Please take your quiz first.</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>