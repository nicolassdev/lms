<?php
// Prevent unauthorized access
if (!isset($_SESSION['stu_lrn'])) {
    header("location:./login.php?error=accessdenied");
    exit;
}

include "./includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
// Get teacher's assigned subjects
$studentSubjects = $mySQLFunction->getAllStudentSubjectsQuiz($_SESSION['stu_lrn']);
// echo "<pre>";
// print_r($studentSubjects);
// echo "</pre>";
// foreach ($studentSubjects as $subject) {
//     foreach ($subject["exams"] as $quiz) {
//         $quiz_id = $quiz['quiz_id'];
//         echo "<pre>";
//         print_r($quiz_id);
//         echo "</pre>";
//     }
// }


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
                            Quiz
                        </h4>
                        <!-- Search Bar -->
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">

                                <!-- Search Input -->
                                <input type="text" id="searchQuiz" class="form-control" placeholder="Search subject quiz...">
                                <i class="bi bi-search me-2 ms-2 fs-5"></i>
                            </div>
                        </div>

                        <?php $hasQuiz = false; ?>
                        <?php foreach ($studentSubjects as $subject): ?>
                            <?php
                            $mySQLFunction->connection();
                            $allQuizCompleted = true; // Assume all quizzes are completed

                            if (!empty($subject['quizzes'])):
                                foreach ($subject["quizzes"] as $quiz) {
                                    $quiz_id = $quiz['quiz_id'];
                                    $stu_lrn = $_SESSION['stu_lrn'];
                                    // check if the student have answer in table STUDENT ANSWERS and STUDENT SCORES
                                    $hideQuiz = $mySQLFunction->checkExistByMultipleIDs("student_answers", ["stu_lrn" => $stu_lrn, "quiz_id" => $quiz_id]);
                                    $hideQuizScore = $mySQLFunction->checkExistByMultipleIDs("student_scores",  ["stu_lrn" => $stu_lrn, "quiz_id" => $quiz_id]);

                                    if ($hideQuiz == 0 && $hideQuizScore == 0) {
                                        $allQuizCompleted = false; // At least one quiz is not completed
                                        break;
                                    }
                                }

                                if ($allQuizCompleted) {
                                    continue; // Skip rendering this subject if all quiz are completed
                                }

                                $hasQuiz = true;
                            ?>

                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>
                    <hr>

                    <div class="row g-4 mb-3" id="subjectContainer">
                        <?php if (!empty($studentSubjects)): ?>
                            <?php $hasQuiz = false; ?>
                            <?php foreach ($studentSubjects as $subject): ?>
                                <?php
                                $mySQLFunction->connection();
                                $allQuizCompleted = true; // Assume all quizzes are completed

                                if (!empty($subject['quizzes'])):
                                    foreach ($subject["quizzes"] as $quiz) {
                                        $quiz_id = $quiz['quiz_id'];
                                        $stu_lrn = $_SESSION['stu_lrn'];
                                        // check if the student have answer in table STUDENT ANSWERS and STUDENT SCORES
                                        $hideQuiz = $mySQLFunction->checkExistByMultipleIDs("student_answers", ["stu_lrn" => $stu_lrn, "quiz_id" => $quiz_id]);
                                        $hideQuizScore = $mySQLFunction->checkExistByMultipleIDs("student_scores",  ["stu_lrn" => $stu_lrn, "quiz_id" => $quiz_id]);

                                        if ($hideQuiz == 0 && $hideQuizScore == 0) {
                                            $allQuizCompleted = false; // At least one quiz is not completed
                                            break;
                                        }
                                    }

                                    if ($allQuizCompleted) {
                                        continue; // Skip rendering this subject if all quiz are completed
                                    }

                                    $hasQuiz = true;
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

                                                <div class="quiz-info">
                                                    <i class="bi bi-calendar3 text-warning me-1"></i>
                                                    <span class="text-secondary">
                                                        <?php
                                                        foreach ($subject["quizzes"] as $quiz) {
                                                            echo '<span class="text-dark">' . htmlspecialchars($quiz["quiz_quarter"]) . ' - ' . $subject["sub_semester"] . ' </span> <br> ' .
                                                                '<small class="text-dark ms-4">Date of Quiz : ' . date('F j, Y', strtotime($quiz["quiz_date"])) . ' </small> ';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Card Footer -->
                                            <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                                                <a href="index.php?page=student_take_quiz&quiz_id=<?php echo urlencode($quiz['quiz_id']); ?>&sub_code=<?php echo urlencode($subject['sub_code']); ?>&section_code=<?php echo urlencode($subject['section_code']); ?>&grade_lvl=<?php echo urlencode($subject['grade_lvl']); ?>"
                                                    class="btn btn-success w-100 fw-bold d-flex align-items-center justify-content-center shadow-sm">
                                                    Take Quiz
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <!-- No Subjects Found -->
                            <?php if (!$hasQuiz): ?>
                                <div class="col-12 text-center py-5">
                                    <div class="card-body">
                                        <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                        <h5 class="text-secondary fw-bold">No Quiz Found</h5>
                                        <small class="text-muted">You currently have no assigned quizzes. Check with your subject teacher.</small>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- NOTE: for search bar purpose -->
                            <!-- No Subjects Found Message  search bar-->
                            <div class="col-12 text-center d-none no-results">
                                <div class="card-body">
                                    <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                    <h5 class="text-secondary fw-bold">Quiz Not Found</h5>
                                    <small class="text-muted">You can use the search bar above to find your quiz.</small>
                                </div>
                            </div>

                        <?php else: ?>
                            <!-- No Quiz Available -->
                            <div class="col-12 text-center py-5">
                                <div class="card-body">
                                    <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                    <h5 class="text-secondary fw-bold">No Quiz Found</h5>
                                    <small class="text-muted">You currently have no assigned quizzes. Check with your subject teacher.</small>
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
    document.getElementById('searchQuiz').addEventListener('input', function() {
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