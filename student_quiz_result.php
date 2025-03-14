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
$studentSubjects = $mySQLFunction->getAllStudentSubjectsQuiz($_SESSION['stu_lrn'], 'view_results');
// echo "<pre>";
// print_r($studentSubjects);
// echo "</pre>";
// foreach ($studentSubjects as $subject) {
//     foreach ($subject["quizzes"] as $quiz) {
//         $quiz_id = $quiz['quiz_id'];
//         echo "<pre>";
//         print_r($quiz_id);
//         echo "</pre>";
//     }
// }


// $hideQuiz = $mySQLFunction->checkExistIDinAssessment("student_scores", $_SESSION['stu_lrn'], $quiz_id);
// $hideDoneExam = $hideQuiz > 0;

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
                            Quiz Result
                        </h4>
                        <!-- Search Bar -->
                        <div class="col-md-4">
                            <div class="input-group input-group-sm">
                                <?php
                                $hasQuiz = false; // Start with the assumption that no quiz are found.

                                foreach ($studentSubjects as $subject):
                                    $mySQLFunction->connection();
                                    foreach ($subject["quizzes"] as $quiz) {
                                        $quiz_id = $quiz['quiz_id'];
                                        $hasQuiz = $mySQLFunction->checkExistByID("student_answers", "quiz_id", $quiz_id);
                                    }

                                    if ($hasQuiz > 0): // If exam exists for this subject
                                        $hasQuiz = true;
                                        break; // No need to continue checking other subjects if we already found a quiz.
                                    endif;
                                endforeach;
                                ?>
                                <!-- Search Input -->
                                <input type="text" id="searchBar" class="form-control" placeholder="Search subject exam..." <?php echo $hasQuiz ? '' : 'disabled'; ?>>
                                <i class="bi bi-search me-2 ms-2 fs-5"></i>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row g-4 mb-3" id="subjectContainer">
                        <?php if (!empty($studentSubjects)): ?>
                            <?php $hasCompletedSubjects = false; ?>
                            <?php foreach ($studentSubjects as $subject): ?>
                                <?php if (!empty($subject['quizzes'])): ?>
                                    <?php foreach ($subject["quizzes"] as $quiz): ?>
                                        <?php
                                        $mySQLFunction->connection();
                                        $quiz_id = $quiz['quiz_id'];
                                        $stu_lrn = $_SESSION['stu_lrn'];
                                        $hasAnsweredQuiz = $mySQLFunction->checkExistByMultipleIDs("student_answers", ["stu_lrn" => $stu_lrn, "quiz_id" => $quiz_id]);
                                        $hasQuizScore = $mySQLFunction->checkExistByMultipleIDs("student_scores", ["stu_lrn" => $stu_lrn, "quiz_id" => $quiz_id]);
                                        ?>

                                        <?php if ($hasAnsweredQuiz || $hasQuizScore): ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 subject-card" data-title="<?php echo htmlspecialchars(strtolower($subject['sub_title'])); ?>">
                                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                                    <div class="card-header secondary-color rounded-top-4 px-3 py-3 d-flex align-items-center">
                                                        <div class="text-truncate">
                                                        <h6 class="mb-0 fw-bold text-truncate mt-2">
                                                            <i class="bi bi-book-half me-2 text-danger"></i>
                                                            <?php echo htmlspecialchars(ucwords(strtolower($subject['sub_title'] ?? 'No Title'))); ?></h6>
                                                            <small class="fw-semibold ms-4 text-sm">
                                                                <?php echo htmlspecialchars(ucwords(strtolower($subject['sub_type'] ?? 'No Type'))); ?> Subject
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row align-items-center mb-1">
                                                            <div class="col text-start">
                                                                <small class="fw-bold fs-6 ms-3">
                                                                    <?php
                                                                    echo ucwords(strtolower($subject["teacher_fname"] . ' ' . $subject["teacher_lname"])) ?: 'No Subject Teacher';
                                                                    ?>
                                                                </small>
                                                            </div>
                                                            <div class="col-auto">
                                                                <?php
                                                                $uploadDir = "./assets/Upload/";
                                                                if (!empty($subject['image']) && file_exists($uploadDir . $subject['image'])) {
                                                                ?>
                                                                    <img src="<?php echo htmlspecialchars($uploadDir . $subject['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-teacher">
                                                                <?php
                                                                } else {
                                                                    $defaultImage = $subject['teacher_gender'] === "MALE" ? "default-male.png" : "default-female.png";
                                                                ?>
                                                                    <img src="./assets/Upload/resources/<?php echo $defaultImage; ?>" alt="Profile Image" draggable="false" class="profile-img-teacher">
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                        <div class="mb-1">
                                                            <span class="fw-bold fs-6 ms-3 text-muted">
                                                                <?php echo $subject["grade_lvl"] . ' ' . htmlspecialchars($subject["section_name"]); ?><br>
                                                            </span>
                                                            <small class="text-dark text-sm ms-3 fw-semibold text-muted">
                                                                <?php echo ucwords(strtolower($subject["strand_desc"])); ?>
                                                            </small>
                                                            <div>
                                                                <small class="text-dark text-sm ms-3 fw-semibold text-dark">
                                                                    Date of Quiz : <?php echo date('F j, Y', strtotime($quiz["quiz_date"])); ?>
                                                                </small>
                                                            </div>
                                                        </div>
                                                
                                                    
                                                    </div>

                                                    <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                                                        <a href="index.php?page=student_take_quiz&quiz_id=<?php echo urlencode($quiz['quiz_id']); ?>&sub_code=<?php echo urlencode($subject['sub_code']); ?>&section_code=<?php echo urlencode($subject['section_code']); ?>&grade_lvl=<?php echo urlencode($subject['grade_lvl']); ?>"
                                                            class="btn secondary-color w-100 fw-bold d-flex align-items-center justify-content-center shadow-sm">
                                                            View Result
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php $hasCompletedSubjects = true; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if (!$hasCompletedSubjects): ?>
                                <div class="col-12 text-center py-5">
                                    <div class="card-body">
                                        <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                        <h5 class="text-secondary fw-bold">No Result Found</h5>
                                        <small class="text-muted">You have not completed any quizzes yet.</small><br>
                                        <small><a href="?page=student_quiz">Take a quiz now!</a></small>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-12 text-center d-none no-results">
                                <div class="card-body">
                                    <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                    <h5 class="text-secondary fw-bold">Quiz Not Found</h5>
                                    <small class="text-muted">You can use the search bar above to find your exam.</small>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <div class="card-body">
                                    <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                    <h5 class="text-secondary fw-bold">No Quiz Found</h5>
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
    document.getElementById('searchBar').addEventListener('input', function() {
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