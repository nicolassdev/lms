<?php
// Start session and validate user

if (!isset($_SESSION['stu_lrn'])) {
    header("Location: ./login.php?error=accessdenied");
    exit;
}

include "./includes/dbh-inc.php";
$mySQLFunction->connection();

// Check if required GET parameters are set
if (!empty($_GET['exam_id']) && !empty($_GET['sub_code']) && !empty($_GET['section_code']) && !empty($_GET['grade_lvl'])) {
    $exam_id = $_GET['exam_id'];
    $sub_code = $_GET['sub_code'];
    $section_code = $_GET['section_code'];
    $grade_lvl = $_GET['grade_lvl'];

    // Fetch exam details and questions
    $exams = $mySQLFunction->getAllExamTypeBySubjectsOfStudents($_SESSION['stu_lrn'], $exam_id, $sub_code, $section_code, $grade_lvl);
}

$mySQLFunction->disconnect();
?>

<main class="col-md-12 ms-sm-auto col-lg-10">
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Exam Header Section -->
                <div class="container">
                    <!-- Header Section -->
                    <div class="card mb-2 shadow-lg border-0">
                        <div class="card-body text-center bg-primary text-white rounded">
                            <h1 class="card-title fw-bold">Take Your Exam</h1>
                            <p class="card-text">Get ready to demonstrate your knowledge. Best of luck!</p>
                            <button class="btn btn-outline-light btn-lg px-5 rounded-pill" id="startExamButton">
                                <i class="bi bi-play-circle me-2"></i> Start Exam
                            </button>
                        </div>
                    </div>
                    <!-- Exam Details Section -->

                    <div id="examDetails">
                        <?php if (!empty($exams)) : ?>
                            <?php foreach ($exams as $examData) : ?>
                                <!-- Exam Title and Details -->
                                <div class="card mb-2 shadow-sm border-0">
                                    <div class="card-body">
                                        <h4 class="fw-bold text-dark">
                                            <?= htmlspecialchars(ucwords(strtolower($examData["exam_title"] ?? 'No Exam Title'))) ?>
                                        </h4>
                                        <p class="mb-2 text-secondary">
                                            Subject: <span class="text-primary fw-semibold"><?= htmlspecialchars(ucwords(strtolower($examData["sub_title"] ?? 'No Subject'))) ?></span>
                                        </p>
                                        <p class="mb-2 text-secondary">
                                            Quarter & Semester: <?= htmlspecialchars(($examData["exam_quarter"] . ' Quarter' . ' / ' . $examData["sub_semester"] . ' ' ?? 'N/A')) ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Exam Instructions -->
                                <div class="card mb-2 shadow-sm border-0">
                                    <div class="card-body bg-light">
                                        <h5 class="fw-bold text-dark">Exam Instructions</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item bg-light">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                This exam includes multiple-choice, enumeration, and essay questions.
                                            </li>
                                            <li class="list-group-item bg-light">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                Duration: <span class="fw-semibold"><?= htmlspecialchars($examData["exam_duration"] ?? 'N/A') ?> minutes</span>.
                                            </li>
                                            <li class="list-group-item bg-light">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                Do not refresh or navigate away during the exam.
                                            </li>
                                            <li class="list-group-item bg-light">
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                Ensure to submit answers before time runs out.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                </div>


                <!-- Timer and Exam Questions -->
                <div id="examArea" class="d-none">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="fw-bold">Questions</h5>
                                    <small class="fw-semibold">
                                        <?= htmlspecialchars(ucwords(strtolower($examData["sub_semester"] ?? 'No semester'))) ?><br>
                                    </small>
                                    <ul class="list-group">
                                        <?php if (!empty($exams)) : ?>
                                            <?php foreach ($exams as $examData) : ?>
                                                <!-- Example for multiple-choice question -->
                                                <?php $rowCount = 1; ?>
                                                <?php if (!empty($examData['exams'][0]['multiple_choice'])) : ?>
                                                    <li class="list-group-item">
                                                        <h6>Multiple Choice:</h6>
                                                        <?php foreach ($examData['exams'][0]['multiple_choice'] as $mcq) : ?>
                                                            <p class="pt-2"><?= $rowCount++ ?>.) <?= htmlspecialchars($mcq['mul_question']) ?></p>
                                                            <ul class="list-unstyled">
                                                                <?php foreach (['choice_a', 'choice_b', 'choice_c', 'choice_d'] as $choice) : ?>
                                                                    <li>
                                                                        <input type="radio" name="<?= htmlspecialchars($mcq['mul_question']) ?>" value="<?= htmlspecialchars($mcq[$choice]) ?>">
                                                                        <?= htmlspecialchars($mcq[$choice]) ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endforeach; ?>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (!empty($examData['exams'][0]['enumeration'])) : ?>
                                                    <!-- Enumeration question -->
                                                    <li class="list-group-item">
                                                        <h6>Enumeration:</h6>
                                                        <?php foreach ($examData['exams'][0]['enumeration'] as $enum) : ?>
                                                            <p><?= $rowCount++ ?>.) <?= htmlspecialchars($enum['enum_question']) ?></p>
                                                            <input type="text" class="form-control" name="enum_answer" placeholder="Enter your answer here">
                                                        <?php endforeach; ?>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (!empty($examData['exams'][0]['essay'])) : ?>
                                                    <!-- Essay question -->
                                                    <li class="list-group-item">
                                                        <h6>Essay:</h6>
                                                        <?php foreach ($examData['exams'][0]['essay'] as $essay) : ?>
                                                            <p><?= $rowCount++ ?>.) <?= htmlspecialchars($essay['essay_question']) ?></p>
                                                            <textarea class="form-control" name="essay<?= htmlspecialchars($essay['essay_id']) ?>" rows="4" placeholder="Write your essay here"></textarea>
                                                        <?php endforeach; ?>
                                                    </li>
                                                <?php endif; ?>
                                                <?php if (!empty($examData['exams'][0]['true_false'])) : ?>
                                                    <!-- True/False question -->
                                                    <li class="list-group-item">
                                                        <h6>True/False:</h6>
                                                        <?php foreach ($examData['exams'][0]['true_false'] as $tf) : ?>
                                                            <p><?= $rowCount++ ?>.) <?= htmlspecialchars($tf['tf_question']) ?></p>
                                                            <div>
                                                                <input type="radio" name="tf<?= htmlspecialchars($tf['tf_id']) ?>" value="True"> True
                                                                <input type="radio" name="tf<?= htmlspecialchars($tf['tf_id']) ?>" value="False"> False
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </li>
                                                <?php endif; ?>

                                            <?php endforeach; ?>

                                        <?php else : ?>
                                            <p>No questions available.</p>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm text-center">
                                <div class="card-body">
                                    <h4 class="fw-bold">Timer</h4>
                                    <div id="examTimer" class="display-5 text-danger">
                                        00:00
                                    </div>
                                    <p class="text-muted">Time remaining</p>
                                    <button class="btn btn-danger mt-2" id="endExamButton">End Exam</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exam Completion Section -->
                <div id="examEndNotification" class="d-none text-center my-5">
                    <h2 class="fw-bold text-success">Exam Completed!</h2>
                    <p>Your answers have been submitted successfully.</p>
                    <a href="?page=student_exam_result" class="btn btn-outline-success">
                        <i class="bi bi-clipboard-data me-2"></i> View Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const startButton = document.getElementById("startExamButton");
        const examDetails = document.getElementById("examDetails"); // Reference to the exam details section
        const examArea = document.getElementById("examArea");
        const examTimer = document.getElementById("examTimer");
        const endExamButton = document.getElementById("endExamButton");
        const examEndNotification = document.getElementById("examEndNotification");
        let timerDuration = <?= json_encode($examData["exam_duration"] ?? 0) ?>; // In minutes

        startButton.addEventListener("click", function() {
            // Hide the header card and exam details section
            startButton.closest('.card').classList.add("d-none");
            examDetails.classList.add("d-none"); // Hide the exam details section

            // Show the exam area
            examArea.classList.remove("d-none");

            // Start Timer
            let timer = timerDuration * 60;
            const timerInterval = setInterval(function() {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;
                examTimer.textContent = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;
                timer--;

                if (timer < 0) {
                    clearInterval(timerInterval);
                    alert("Time's up!");
                    examArea.classList.add("d-none");
                    examEndNotification.classList.remove("d-none");
                }
            }, 1000);

            endExamButton.addEventListener("click", function() {
                clearInterval(timerInterval);
                alert("Exam ended.");
                examArea.classList.add("d-none");
                examEndNotification.classList.remove("d-none");
            });
        });
    });
</script>