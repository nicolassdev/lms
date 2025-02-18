<?php
// Start session and validate user
// session_start();
if (!isset($_SESSION['stu_lrn'])) {
    header("Location: ./login.php?error=accessdenied");
    exit;
}

include "./includes/dbh-inc.php";
$mySQLFunction->connection();

// Check if required GET parameters are set
if (!empty($_GET['quiz_id']) && !empty($_GET['sub_code']) && !empty($_GET['section_code']) && !empty($_GET['grade_lvl'])) {
    $quiz_id = $_GET['quiz_id'];
    $sub_code = $_GET['sub_code'];
    $section_code = $_GET['section_code'];
    $grade_lvl = $_GET['grade_lvl'];
    $student_lrn = $_SESSION['stu_lrn'];

    // Fetch exam details and questions
    $quizzes = $mySQLFunction->getAllQuizTypeBySubjectsOfStudents($_SESSION['stu_lrn'], $quiz_id, $sub_code, $section_code, $grade_lvl);
    // echo "<pre>";
    // print_r($quizzes);
    // echo "</pre>";


    // check if the student is already  take the QUIZ if yes then the button will be disabled
    $checkIdExist = $mySQLFunction->checkExistByMultipleIDs("student_answers", ["stu_lrn" => $student_lrn, "quiz_id" => $quiz_id]);
    $isQuizTaken = $checkIdExist > 0;

    // GET THE QUIZ CORRECT RESULT IN QUIZ
    $quizResult = $mySQLFunction->getCorrectQuizResult($student_lrn, $quiz_id);

    // GET THE SCORE OF STUDENT IN QUIZ
    $quizScore = $mySQLFunction->getStudentQuizScore($student_lrn, $quiz_id);
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
                        <div class="card-body text-center <?php echo $isQuizTaken ? 'bg-dark' : 'bg-success'; ?> text-white rounded position-relative">
                            <div class="d-flex flex-column align-items-end">
                                <a <?php echo $isQuizTaken ? 'href="index.php?page=student_quiz_result" ' : 'href="index.php?page=student_quiz" ' ?> class="btn btn-sm btn-outline-light mt-2"> Back</a>
                                <div class="w-100  text-center"> <?php if ($isQuizTaken): ?>
                                        <h1 class="card-title fw-bold">Done <i class="bi bi-check-circle-fill fs-3 text-success"></i></h1>
                                        <p class="card-text"> You have already taken this quiz. </p>
                                        <button class="btn btn-outline-light btn-lg px-5 rounded-pill"
                                            data-bs-toggle="collapse" data-bs-target="#quizResultArea">
                                            <i class="bi bi-clipboard-data me-2"></i> View Result
                                        </button>
                                    <?php else: ?>
                                        <h1 class="card-title fw-bold">Take Your Quiz</h1>
                                        <p class="card-text"> Get ready to demonstrate your knowledge. Best of luck! </p>
                                        <button class="btn btn-outline-light btn-lg px-5 rounded-pill" id="startQuizButton">
                                            <i class="bi bi-play-circle me-2"></i> Start Quiz
                                        </button>



                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Exam Details Section -->

                    <div id="quizDetails">
                        <?php if (!empty($quizzes)) : ?>
                            <?php foreach ($quizzes  as $quizData) : ?>
                                <!-- Exam Title and Details -->
                                <div class="card mb-3 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="fw-bold text-dark mb-0">
                                                <?= htmlspecialchars(ucwords(strtolower($quizData["quiz_title"] ?? 'No Exam Title'))) ?>
                                            </h4>
                                            <span class="badge bg-success text-white px-3 py-2">
                                                <?= htmlspecialchars(($quizData["quiz_quarter"] ?? 'N/A') . ' / ' . ($quizData["sub_semester"] ?? 'N/A')) ?>
                                            </span>
                                        </div>

                                        <hr class="my-3">

                                        <div class="mb-2">
                                            <span class="fw-bold">Subject:</span>
                                            <span class="badge bg-success text-white px-3 py-2">
                                                <?= htmlspecialchars(ucwords(strtolower($quizData["sub_title"] ?? 'No Subject'))) ?>
                                            </span>
                                        </div>

                                        <div class="mb-2">
                                            <span class="fw-bold">Teacher:</span>
                                            <span class="badge bg-success text-white px-3 py-2">
                                                <?= htmlspecialchars(ucwords(strtolower(($quizData["teacher_fname"] ?? '') . ' ' . ($quizData["teacher_lname"] ?? 'N/A')))) ?>
                                            </span>
                                        </div>

                                        <div>
                                            <span class="fw-bold">Type of Quiz:</span>
                                            <span class="badge bg-success text-white px-3 py-2">
                                                <?= htmlspecialchars(($quizData["quiz_type"] == 0 ? 'Short Quiz' : 'Long Quiz')) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Exam Instructions -->
                                <?php if (!$isQuizTaken): ?>
                                    <div class="card mb-2 shadow-sm border-0">
                                        <div class="card-body bg-light">
                                            <h5 class="fw-bold text-dark">Exam Instructions</h5>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item bg-light">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    This exam has <span class="fw-semibold"><?= htmlspecialchars($quizData["quiz_items"] ?? 'N/A') ?> items</span> includes multiple-choice, enumeration, true or false, and essay questions.
                                                </li>
                                                <li class="list-group-item bg-light">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    Duration: <span class="fw-semibold"><?= htmlspecialchars($quizData["quiz_duration"] ?? 'N/A') ?> minutes</span>.
                                                </li>
                                                <li class="list-group-item bg-light">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    <span class="fw-semibold">Do not refresh </span>or navigate away during the exam.
                                                </li>
                                                <li class="list-group-item bg-light">
                                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                    Ensure to submit answers before time runs out.
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>

                </div>
                <!-- NOTE: If student not have not yet taken the exam this will be display  exam and the button will be start exam  -->
                <?php if (!$isQuizTaken): ?>
                    <!-- Timer and Exam Questions -->
                    <div id="quizArea" class="d-none">
                        <div class="row">
                            <!-- EXAM QUESTION ELEMENT -->
                            <div class="col-md-9">
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="fw-bold text-start">Questions</h5>
                                            <p class="fw-semibold text-end">
                                                <?= htmlspecialchars($quizData["quiz_items"] . ' Items' ?? 'No Items') ?><br>
                                            </p>
                                        </div>
                                        <!-- FORM ELEMENTS OF QUIZ -->
                                        <form action="./includes/studentexam-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                                            <!-- Hidden Inputs -->
                                            <input type="hidden" name="studID" value="<?php echo htmlspecialchars($_SESSION['stu_lrn']); ?>">
                                            <input type="hidden" name="quizID" value="<?php echo htmlspecialchars($_GET['quiz_id']); ?>">
                                            <input type="hidden" name="subID" value="<?php echo htmlspecialchars($_GET['sub_code']); ?>">
                                            <input type="hidden" name="secID" value="<?php echo htmlspecialchars($_GET['section_code']); ?>">
                                            <input type="hidden" name="gradelvlID" value="<?php echo htmlspecialchars($_GET['grade_lvl']); ?>">


                                            <ul class="list-group ">
                                                <?php if (!empty($quizzes)) : ?>
                                                    <?php foreach ($quizzes as $quizData) : ?>
                                                        <!-- Start of Question Loop -->
                                                        <?php $rowCount = 1; ?>
                                                        <?php if (!empty($quizData['quizzes'][0]['multiple_choice'])) : ?>
                                                            <li class="list-group-item">
                                                                <h6>Multiple Choice:</h6>
                                                                <?php foreach ($quizData['quizzes'][0]['multiple_choice'] as $mcq) : ?>
                                                                    <p class="pt-2"><?= $rowCount++ ?>.) <?= htmlspecialchars($mcq['q_mul_question']) ?></p>
                                                                    <ul class="list-unstyled">
                                                                        <!-- id of multiple choice -->
                                                                        <input type="hidden" class="form-control" name="qMulId[]" value="<?= htmlspecialchars($mcq['q_mul_id']) ?>">
                                                                        <?php foreach (['q_choice_a', 'q_choice_b', 'q_choice_c', 'q_choice_d'] as $choice) : ?>
                                                                            <li>
                                                                                <input type="radio" name="qmcq_<?= htmlspecialchars($mcq['q_mul_id']) ?>"
                                                                                    value="<?= htmlspecialchars($mcq[$choice]) ?>" required>
                                                                                <?= htmlspecialchars($mcq[$choice]) ?>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                <?php endforeach; ?>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if (!empty($quizData['quizzes'][0]['enumeration'])) : ?>
                                                            <li class="list-group-item">
                                                                <h6>Enumeration:</h6>
                                                                <?php foreach ($quizData['quizzes'][0]['enumeration'] as $enum) : ?>
                                                                    <p><?= $rowCount++ ?>.) <?= htmlspecialchars($enum['q_enum_question']) ?></p>
                                                                    <!-- id of enumeration -->
                                                                    <input type="hidden" class="form-control" name="qEnumId[]" value="<?= htmlspecialchars($enum['q_enum_id']) ?>">
                                                                    <input type="text" class="form-control" name="qenum_<?= htmlspecialchars($enum['q_enum_id']) ?>"
                                                                        placeholder="Enter your answer here, separated by commas ( , )" required>
                                                                <?php endforeach; ?>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if (!empty($quizData['quizzes'][0]['essay'])) : ?>
                                                            <li class="list-group-item">
                                                                <h6>Essay:</h6>
                                                                <?php foreach ($quizData['quizzes'][0]['essay'] as $essay) : ?>
                                                                    <p><?= $rowCount++ ?>.) <?= htmlspecialchars($essay['q_essay_question']) ?></p>
                                                                    <!-- id of essay -->
                                                                    <input type="hidden" class="form-control" name="qEssayId[]" value="<?= htmlspecialchars($essay['q_essay_id']) ?>">
                                                                    <textarea class="form-control" name="qessay_<?= htmlspecialchars($essay['q_essay_id']) ?>"
                                                                        rows="4" placeholder="Write your essay here"></textarea>
                                                                <?php endforeach; ?>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if (!empty($quizData['quizzes'][0]['true_false'])) : ?>
                                                            <li class="list-group-item">
                                                                <h6>True/False:</h6>
                                                                <?php foreach ($quizData['quizzes'][0]['true_false'] as $tf) : ?>
                                                                    <p><?= $rowCount++ ?>.) <?= htmlspecialchars($tf['q_tf_question']) ?></p>
                                                                    <div>
                                                                        <!-- id of true/false -->
                                                                        <input type="hidden" class="form-control" name="qTfId[]" value="<?= htmlspecialchars($tf['q_tf_id']) ?>">
                                                                        <input type="radio" name="qtf_<?= htmlspecialchars($tf['q_tf_id']) ?>"
                                                                            value="True" required> True <br>
                                                                        <input type="radio" name="qtf_<?= htmlspecialchars($tf['q_tf_id']) ?>"
                                                                            value="False" required> False
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </li>
                                                        <?php endif; ?>
                                                        <!-- End of Question Loop -->
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <p>No questions available.</p>
                                                <?php endif; ?>
                                            </ul>

                                            <!-- Submit Button -->
                                            <div class="mt-3">
                                                <button name="submit" type="submit" class="btn btn-primary">Submit Answers</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- QUIZ TIMER EMELEMENT FOR DESKTOP -->
                            <div class="col-md-2 d-none d-md-block " style="position:fixed; margin-left: 64%;">
                                <div class="card mb-4 shadow-sm text-center">
                                    <div class="card-body">
                                        <h4 class="fw-bold">Timer</h4>
                                        <div id="quizTimerDesktop" class="display-5 text-danger">
                                            00:00
                                        </div>
                                        <p class="text-muted">Time remaining</p>
                                        <button class="btn btn-danger mt-2" id="endQuizButtonDesktop">End Quiz</button>
                                    </div>
                                </div>
                            </div>
                            <!-- QUIZ TIMER EMELEMENT FOR MOBILE -->
                            <div class="col-6 col-sm-4 col-md-3 position-fixed end-0 top-50 translate-middle-y d-lg-none">
                                <div class="card shadow-sm text-center p-2">
                                    <div class="card-body p-2">
                                        <h6 class="fw-bold mb-1">Timer</h6>
                                        <div id="quizTimerMobile" class="fs-4 fw-bold text-danger">00:00</div>
                                        <p class="text-muted small mb-1">Time left</p>
                                        <button class="btn btn-sm btn-danger" id="endQuizButtonMobile">End</button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- NOTE: If student taken the exam this will be display  exam and the button will be view result  -->
                <?php else: ?>
                    <!-- Exam Result Section -->
                    <div id="quizResultArea" class="collapse">
                        <div class="card shadow-sm ms-2 me-2">
                            <div class="card-header bg-success text-white text-center">
                                <h4 class="fw-bold mb-0">Quiz Result</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <?php if (!empty($quizScore)) : ?>
                                        <h5 class="fw-bold">Total Score: <?= htmlspecialchars($quizScore["correct_answers"] ?? '0') ?> / <?= htmlspecialchars($quizScore["total_questions"] ?? 'N/A') ?></h5>
                                        <p class="text-muted">You have completed the quiz successfully.</p>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($quizResult)) : ?>


                                    <?php
                                    $correctAnswers = array_filter($quizResult, function ($question) {
                                        return $question["is_correct"] === "Correct" || ($question["is_correct"] === "Partial");
                                    });

                                    $incorrectAnswers = array_filter($quizResult, function ($question) {
                                        return $question["is_correct"] === "Incorrect";
                                    });


                                    ?>

                                    <div class="accordion" id="quizResultDetails">
                                        <!-- Correct Answers -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#correctAnswers">
                                                    ✅ Correct Answers (<?= count($correctAnswers) ?>)
                                                </button>
                                            </h2>
                                            <div id="correctAnswers" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <ul class="list-group">
                                                        <?php foreach ($correctAnswers as $question) : ?>
                                                            <li class="list-group-item">
                                                                <strong class="text-success">Q:</strong> <?= htmlspecialchars($question["question_text"]) ?><br>
                                                                <strong>Your Answer:</strong>
                                                                <?= ($question["question_type"] === 'enumeration') ? $mySQLFunction->highlightEnumerationAnswer($question["student_answer"], $question["correct_answer"]) : "<span class='text-success'>" . htmlspecialchars($question["student_answer"]) . "</span>"; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Incorrect Answers -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#incorrectAnswers">
                                                    ❌ Incorrect Answers (<?= count($incorrectAnswers) ?>)
                                                </button>
                                            </h2>
                                            <div id="incorrectAnswers" class="accordion-collapse collapse">
                                                <div class="accordion-body">
                                                    <ul class="list-group">
                                                        <?php foreach ($incorrectAnswers as $question) : ?>
                                                            <li class="list-group-item">
                                                                <strong class="text-danger">Q:</strong> <?= htmlspecialchars($question["question_text"]) ?><br>
                                                                <strong>Your Answer:</strong>
                                                                <?= ($question["question_type"] === 'enumeration') ? $mySQLFunction->highlightEnumerationAnswer($question["student_answer"], $question["correct_answer"]) : "<span class='text-danger'>" . htmlspecialchars($question["student_answer"]) . "</span>"; ?><br>
                                                                <strong>Correct Answer:</strong> <span class="text-success"><?= htmlspecialchars($question["correct_answer"]) ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php else: ?>
                                    <p class="text-center text-muted">No quiz results found.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>



                <!-- Exam Completion Section -->
                <div id="quizEndNotification" class="d-none text-center my-5">
                    <h2 class="fw-bold text-success">Quiz Completed!</h2>
                    <p>Your answers have been submitted successfully.</p>
                    <a href="?page=student_quiz_result" class="btn btn-outline-success">
                        <i class="bi bi-clipboard-data me-2"></i> View Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector(".needs-validation");
        const viewResultButton = document.getElementById("viewExamResultButton");
        const quizResultArea = document.getElementById("quizResultArea");
        const startButton = document.getElementById("startQuizButton");
        const quizDetails = document.getElementById("quizDetails"); // Reference to the exam details section
        const quizArea = document.getElementById("quizArea");

        const quizTimerDesktop = document.getElementById("quizTimerDesktop");
        const quizTimerMobile = document.getElementById("quizTimerMobile");
        const endQuizButtonDesktop = document.getElementById("endQuizButtonDesktop");
        const endQuizButtonMobile = document.getElementById("endQuizButtonMobile");

        const quizEndNotification = document.getElementById("quizEndNotification");

        let timerDuration = <?= json_encode($quizData["quiz_duration"] ?? 0) ?>; // In minutes

        // Check if the exam has been taken
        startButton.addEventListener("click", function() {
            // Hide the header card and exam details section
            startButton.closest('.card').classList.add("d-none");
            quizDetails.classList.add("d-none"); // Hide the exam details section

            // Show the exam area
            quizArea.classList.remove("d-none");

            // Start Timer
            let timer = timerDuration * 60;
            const timerInterval = setInterval(function() {
                const minutes = Math.floor(timer / 60);
                const seconds = timer % 60;
                // This part targets the HTML element where the timer will be displayed.
                const formattedTime = `${String(minutes).padStart(2, "0")}:${String(seconds).padStart(2, "0")}`;

                // Update both desktop and mobile timers
                if (quizTimerDesktop) quizTimerDesktop.textContent = formattedTime;
                if (quizTimerMobile) quizTimerMobile.textContent = formattedTime;
                timer--;

                if (timer < 0) {
                    clearInterval(timerInterval);
                    alert("Time's up!");
                    quizArea.classList.add("d-none");
                    quizEndNotification.classList.remove("d-none");
                }
            }, 1000);

            // End Exam Button for Desktop
            if (endQuizButtonDesktop) {
                endQuizButtonDesktop.addEventListener("click", function() {
                    clearInterval(timerInterval);
                    alert("Quiz ended.");
                    quizArea.classList.add("d-none");
                    quizEndNotification.classList.remove("d-none");
                });
            }

            // End Exam Button for Mobile
            if (endQuizButtonMobile) {
                endQuizButtonMobile.addEventListener("click", function() {
                    clearInterval(timerInterval);
                    alert("Quiz ended.");
                    quizArea.classList.add("d-none");
                    quizEndNotification.classList.remove("d-none");
                });
            }

        });



        // Form Validation
        form.addEventListener("submit", function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        }, false);

    });
</script>