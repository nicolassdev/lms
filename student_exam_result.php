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

include "./includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
// Get teacher's assigned subjects
$studentSubjects = $mySQLFunction->getAllStudentSubjectsExam($_SESSION['stu_lrn']);
// echo "<pre>";
// print_r($studentSubjects);
// echo "</pre>";
// foreach ($studentSubjects as $subject) {
//     foreach ($subject["exams"] as $exam) {
//         $exam_id = $exam['exam_id'];
//         echo "<pre>";
//         print_r($exam_id);
//         echo "</pre>";
//     }
// }


// $hideExam = $mySQLFunction->checkExistIDinAssessment("student_scores", $_SESSION['stu_lrn'], $exam_id);
// $hideDoneExam = $hideExam > 0;

// Disconnect DB
$mySQLFunction->disconnect();
?>


<!-- Main QUIZ -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4 mt-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold text-muted">
                            Exam Result
                        </h4>
                        <!-- <p class="text-muted"> Here, you will test your knowledge and skills in the subject matter within a set time limit.</p> -->
                        <!-- Search Bar -->
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <?php
                                $hasExams = false; // Start with the assumption that no exam are found.

                                foreach ($studentSubjects as $subject):
                                    $mySQLFunction->connection();
                                    foreach ($subject["exams"] as $exam) {
                                        $exam_id = $exam['exam_id'];
                                        $hasExams = $mySQLFunction->checkExistByID("student_answers", "exam_id", $exam_id);
                                    }

                                    if ($hasExams > 0): // If exam exists for this subject
                                        $hasExams = true;
                                        break; // No need to continue checking other subjects if we already found a exam.
                                    endif;
                                endforeach;
                                ?>
                                <!-- Search Input -->
                                <input type="text" id="searchResult" class="form-control" placeholder="Search subject exam..." <?php echo $hasExams ? '' : 'disabled'; ?>>
                                <i class="bi bi-search me-2 ms-2 fs-5"></i>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row g-4 mb-3" id="subjectContainer">
                        <?php if (!empty($studentSubjects)): ?>
                            <?php $hasCompletedSubjects = false; ?>
                            <?php foreach ($studentSubjects as $subject): ?>
                                <?php
                                $mySQLFunction->connection();
                                $allExamsCompleted = true; // Assume all exams are completed

                                if (!empty($subject['exams'])):
                                    foreach ($subject["exams"] as $exam) {
                                        $exam_id = $exam['exam_id'];
                                        $stu_lrn = $_SESSION['stu_lrn'];
                                        // Check if the student has answered in both tables
                                        $hideExam = $mySQLFunction->checkExistByMultipleIDs("student_answers", ["stu_lrn" => $stu_lrn, "exam_id" => $exam_id]);
                                        $hideExamScore = $mySQLFunction->checkExistByMultipleIDs("student_scores", ["stu_lrn" => $stu_lrn, "exam_id" => $exam_id]);

                                        if ($hideExam == 0 || $hideExamScore == 0) {
                                            $allExamsCompleted = false; // Subject is not fully completed
                                            break;
                                        }
                                    }

                                    if (!$allExamsCompleted) {
                                        continue; // Skip this subject as not all exams are completed
                                    }

                                    $hasCompletedSubjects = true;
                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 subject-card" data-title="<?php echo htmlspecialchars(strtolower($subject['sub_title'])); ?>">
                                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                            <!-- Card Header -->
                                            <div class="card-header bg-success text-white rounded-top-4 px-3 py-3 d-flex align-items-center">
                                                <i class="bi bi-book-half fs-4 me-2"></i>
                                                <div class="text-truncate">
                                                    <h6 class="mb-0 fw-bold text-truncate"><?php echo htmlspecialchars(ucwords(strtolower($subject['sub_title'] ?? 'No Title'))); ?></h6>
                                                    <small class="fw-semibold"><?php echo htmlspecialchars(ucwords(strtolower($subject['sub_type'] ?? 'No Type'))); ?> Subject</small>
                                                </div>
                                            </div>

                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <i class="bi bi-person-circle text-success me-2"></i>
                                                    <span class="fw-bold">
                                                        <?php echo ucwords(strtolower($subject["teacher_fname"] . ' ' . $subject["teacher_lname"])) ?: 'No Subject Teacher'; ?>
                                                    </span>
                                                </div>

                                                <div class="mb-3">
                                                    <i class="bi bi-layers text-primary me-2"></i>
                                                    <span class="text-dark fw-semibold">
                                                        <?php echo  $subject["grade_lvl"] . ' ' . htmlspecialchars($subject["section_name"]); ?><br>
                                                    </span>
                                                    <small class="text-dark ms-4">
                                                        <?php echo ucwords(strtolower($subject["strand_desc"])); ?>
                                                    </small>
                                                </div>

                                                <div class="exam-info">
                                                    <i class="bi bi-calendar3 text-warning me-1"></i>
                                                    <span class="text-secondary">
                                                        <?php
                                                        foreach ($subject["exams"] as $exam) {
                                                            echo '<span class="text-dark">' . htmlspecialchars($exam["exam_quarter"]) . ' - ' . $subject["sub_semester"] . ' </span> <br> ' .
                                                                '<small class="text-dark ms-4">Date of Exam : ' . date('F j, Y', strtotime($exam["exam_date"])) . ' </small> ';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- Card Footer -->
                                            <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                                                <a href="index.php?page=student_take_exam&exam_id=<?php echo urlencode($exam['exam_id']); ?>&sub_code=<?php echo urlencode($subject['sub_code']); ?>&section_code=<?php echo urlencode($subject['section_code']); ?>&grade_lvl=<?php echo urlencode($subject['grade_lvl']); ?>"
                                                    class="btn btn-success w-100 fw-bold d-flex align-items-center justify-content-center shadow-sm">
                                                    View Result
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <!-- No Subjects EXAM result Found -->
                            <?php if (!$hasCompletedSubjects): ?>
                                <div class="col-12 text-center py-5">
                                    <div class="card-body">
                                        <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                        <h5 class="text-secondary fw-bold">No Result Found</h5>
                                        <small class="text-muted">You have not completed any exams yet.</small><br>
                                        <small><a href="?page=student_exam">Take an exam now!</a></small>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- NOTE: for search bar purpose -->
                            <!-- No Subjects Found Message  search bar-->
                            <div class="col-12 text-center d-none no-results">
                                <div class="card-body">
                                    <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                    <h5 class="text-secondary fw-bold">No Exam Found</h5>
                                    <small class="text-muted">You can use the search bar above to find your exam.</small>
                                </div>
                            </div>

                        <?php else: ?>
                            <!-- No Subjects Available -->
                            <div class="col-12 text-center py-5">
                                <div class="card-body">
                                    <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                    <h5 class="text-secondary fw-bold">No Exam Found</h5>
                                    <small class="text-muted">You currently have no assigned subjects.</small>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>



                </div>
            </div>
        </div>
    </div>
</main>



<script>
    document.getElementById('searchResult').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const cards = document.querySelectorAll('.subject-card');
        let found = false;

        cards.forEach(card => {
            const title = card.getAttribute('data-title') || '';
            const matches = title.includes(filter);
            card.style.display = matches ? '' : 'none';
            if (matches) found = true;
        });

        // Show/Hide the "No Results Found" message
        document.querySelector('.no-results').classList.toggle('d-none', found);
    });
</script>