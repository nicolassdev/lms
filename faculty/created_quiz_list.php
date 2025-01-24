<?php
include "../includes/dbh-inc.php";

// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}

$mySQLFunction->connection();
if (!empty($_GET['sched_id']) && !empty($_GET['sub_code']) && !empty($_GET['section_code'])) {
    $sched_id = $_GET['sched_id'];
    $sub_code = $_GET['sub_code'];
    $section_code = $_GET['section_code'];



    // Fetch students by subject handled of teacher 
    $quizzes = $mySQLFunction->getAllQuizCreatedByTeacher($_SESSION['teacher_id'], $sub_code, $section_code);
    // echo "<pre>";
    // print_r($quizzes);
    // echo "</pre>";
}
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

<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 ms-3 me-3">
                        <!-- Grade Level and Section and Subject-->
                        <div>
                            <!-- Display Subject Title -->
                            <h6 class="fw-bold text-primary">
                                <!-- Subject: -->
                                <?php
                                if (!empty($quizzes)) {
                                    foreach ($quizzes as $student) {
                                        echo htmlspecialchars($student["sub_title"]); // Display subject title
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Grade Level and Section -->
                            <h6 class="fw-semibold mt-1">
                                <?php
                                if (!empty($quizzes)) {
                                    foreach ($quizzes as $student) {
                                        echo htmlspecialchars($student["grade_lvl"]) . ' - ';
                                        echo htmlspecialchars($student["section_name"]) . '<br> ';
                                        echo htmlspecialchars($student["sub_semester"]);
                                        break; // Exit the loop after processing the first student
                                    }
                                } else {
                                    echo
                                    '<div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <div>
                                            <strong>No Uploaded Quiz!</strong> It seems there is no quiz uploaded yet.
                                        </div>
                                    </div>';
                                }
                                ?>
                            </h6>

                        </div>

                        <!-- Back button -->
                        <div class="d-flex gap-2 ms-2">
                            <a class="btn btn-primary fw-bold btn-sm btn-animate"
                                href="index.php?page=create_quiz<?php if ($sched_id && $sub_code && $section_code) {
                                                                    echo '&sched_id=' . urlencode($sched_id) . '&sub_code=' . urlencode($sub_code) . '&section_code=' . urlencode($section_code);
                                                                } ?>">
                                <span>Back</span>
                            </a>
                        </div>
                    </div>



                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <!-- <th scope="col" style="width: 50px;">#</th> -->
                                    <th scope="col" style="width: 50px;" class="text-center">Quarterly Quiz</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Quiz Title</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Quiz Description</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Date</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($quizzes)) {
                                    $count = 1;
                                    foreach ($quizzes as $quiz) {
                                        $multipleQuestions = ($quiz["quiz_multiple_questions"]);
                                        $enumerationQuestions =  ($quiz["quiz_enumeration_questions"]);
                                        $essayQuestions = ($quiz["quiz_essay_questions"]);
                                        $trueFalseQuestions = ($quiz["quiz_tf_questions"]);


                                        // $multipleQuestions = json_decode($quiz["quiz_multiple_questions"], true);
                                        // $enumerationQuestions = json_decode($quiz["quiz_enumeration_questions"], true);
                                        // $essayQuestions = json_decode($quiz["quiz_essay_questions"], true);
                                        // $trueFalseQuestions = json_decode($quiz["quiz_tf_questions"], true);

                                        // Assuming this part is within the loop processing the quizzes
                                        // $essayQuestions = explode(" || ", $quiz["essay_questions"]); // Split the string into an array

                                        echo '<tr>';
                                        // echo '<td>' . $count . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($quiz["quiz_quarter"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($quiz["quiz_title"])) . '</td>';
                                        echo '<td class="small text-center">' . (strpos($quiz["quiz_desc"], '!') !== false ? '<p class="text-danger">No description</p>' :  ucwords(strtolower($quiz["quiz_desc"]))) . '</td>';
                                        echo '<td class="small text-center">' . date('F j, Y', strtotime($quiz["quiz_date"])) .  '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#edit_quiz' . $quiz['quiz_id'] . '">
                                            <i class="bi bi-pencil-square"></i> 
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_quiz' . $quiz['quiz_id'] . '">
                                               <i class="bi bi-trash"></i> 
                                        </button>
                                        
                                        </td>';

                                        $count++;

                                        // todo Modal for editing quiz

                                        echo '
                                        <div class="modal fade" id="edit_quiz' . $quiz['quiz_id'] . '" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="text-start">
                                                                <h1 class="modal-title fs-4 text-white">Edit Quiz Details</h1>
                                                            </div>
                                                            </div>
                                                            <div class="text-end">
                                                            <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                            </div>                           
                                                        </div>
                                                    <div class="modal-body">
                                                        <form id="createQuizForm" action="./includes/Operation/updateQuiz.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                                                            <input type="hidden" name="schedID" value="' . htmlspecialchars($_GET['sched_id']) . '">
                                                            <input type="hidden" name="subID" value="' . htmlspecialchars($_GET['sub_code']) . '">
                                                            <input type="hidden" name="secID" value="' . htmlspecialchars($_GET['section_code']) . '">
                                                            <input type="hidden" name="quizID" value="' . htmlspecialchars($quiz['quiz_id']) . '">

                                                            <div class="mb-2">
                                                                <label for="quizTitle" class="form-label fw-bold">Quiz Title</label>
                                                                <input type="text" id="quizTitle" name="quiz_title" value="' . htmlspecialchars($quiz['quiz_title']) . '" class="form-control" placeholder="Enter the quiz title" required>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="quizDescription" class="form-label fw-bold">Description</label>
                                                                <textarea id="quizDescription" name="quiz_description" class="form-control" rows="3" placeholder="Enter a brief description">' . htmlspecialchars($quiz['quiz_desc']) . '</textarea>
                                                            </div>
                                        
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                        <label for="quizDate" class="form-label fw-bold">Date</label>
                                                                        <input type="date" id="quizDate" name="quiz_date" value="' . htmlspecialchars($quiz['quiz_date']) . '" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="quizDuration" class="form-label fw-bold">Duration (minutes)</label>
                                                                        <input type="number" id="quizDuration" name="quiz_duration" value="' . htmlspecialchars($quiz['quiz_duration']) . '" class="form-control" placeholder="Enter duration" min="1" oninput="checkNegativeValue(this)" required>
                                                                    </div>
                                                                </div>
                                                            <div class="mb-4">
                                                                <label for="quarterQuiz" class="form-label fw-bold mt-2">Quarterly Quiz</label>
                                                                <select id="quarterQuiz" name="quiz_quarter" class="form-select" required>
                                                                    <option  disabled value="">Select a quarter...</option>
                                                                    <option value="1st"' . ($quiz['quiz_quarter'] == '1st' ? ' selected' : '') . '>1st Quarter</option>
                                                                    <option value="2nd"' . ($quiz['quiz_quarter'] == '2nd' ? ' selected' : '') . '>2nd Quarter</option>
                                                                    <option value="3rd"' . ($quiz['quiz_quarter'] == '3rd' ? ' selected' : '') . '>3rd Quarter</option>
                                                                    <option value="4th"' . ($quiz['quiz_quarter'] == '4th' ? ' selected' : '') . '>4th Quarter</option>
                                                                </select>
                                                            </div>
                                                            <hr>
                                                            <h6 class="text-primary">Multiple Choice Questions</h6>
                                                            ';
                                        // Check if there are multiple questions
                                        if (!empty($multipleQuestions)) {
                                            foreach ($multipleQuestions as $index => $mcq) {
                                                echo '<div class="mb-3 p-3 border rounded" id="question-container-' . $mcq["q_mul_id"] . '">';
                                                echo '<label class="form-label">Question ' . ($index + 1) . ':</label>';
                                                echo '<input type="hidden" name="quiz_multipleId[]" value="' . $mcq["q_mul_id"] . '">';
                                                echo '<textarea class="form-control" name="question[]" rows="2">' . htmlspecialchars($mcq["question"]) . '</textarea>';
                                                echo '<div class="row mt-2">';

                                                foreach (['A', 'B', 'C', 'D'] as $optionLetter) {
                                                    $optionValue = trim($mcq[$optionLetter]);
                                                    $isCorrect = strtolower(trim($mcq["correct"])) === strtolower($optionValue);

                                                    echo '<div class="col-md-6 mb-2">';
                                                    echo '<label class="form-label">' . $optionLetter . ')</label>';
                                                    echo '<div class="input-group">';
                                                    echo '<input type="text" class="form-control" name="option_' . $optionLetter . '[]" value="' . htmlspecialchars($optionValue) . '">';
                                                    echo '<div class="input-group-text">';
                                                    // KEY CHANGE: Checkbox and array name
                                                    echo '<input type="checkbox" name="correct_answer[' . $mcq["q_mul_id"] . '][]" value="' . $optionLetter . '" ' . ($isCorrect ? 'checked' : '') . ' class="correct-answer-checkbox">';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }

                                                echo '<div class="col-md-6 mb-2">';
                                                echo '<label class="form-label mt-2 text-success">Correct Answer:</label>';
                                                echo '<input type="text" class="form-control" name="correctanswer" value="' . htmlspecialchars(trim($mcq["correct"])) . '" readonly>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<p class="text-danger">No multiple-choice questions found.</p>';
                                        }
                                        // Check if there are enumeration questions
                                        echo '<hr><h6 class="text-primary">Enumeration Questions</h6>';
                                        if (!empty($enumerationQuestions)) {
                                            $enumerationCounter = 1;
                                            foreach ($enumerationQuestions as $enumQuestion) {
                                                echo '<div class="mb-3">';
                                                echo '<label class="form-label">Question ' . $enumerationCounter . ':</label>';
                                                // ***ADD HIDDEN INPUT HERE***
                                                echo '<input type="hidden" name="quiz_enumId[]" value="' . $enumQuestion["q_enum_id"] . '">'; // CRUCIAL
                                                echo '<textarea class="form-control" name="enum_questions[]" rows="2" required>' . htmlspecialchars($enumQuestion["question"]) . '</textarea>';
                                                echo '<label class="form-label mt-2 text-success">Correct Answers:</label>';
                                                $answers = explode(" || ", $enumQuestion["answers"]);
                                                echo '<div class="input-group">';
                                                foreach ($answers as $index => $answer) {
                                                    echo '<input type="text" class="form-control" name="enum_answers[]" value="' . htmlspecialchars($answer) . '" required>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                                $enumerationCounter++;
                                            }
                                        } else {
                                            echo '<p class="text-danger">No enumeration questions found.</p>';
                                        }

                                        // Check if there are essay questions
                                        echo '<hr><h6 class="text-primary">Essay Questions</h6>';
                                        if (!empty($essayQuestions)) {
                                            $essayCounter = 1;
                                            foreach ($essayQuestions as $essayQuestion) {
                                                echo '<div class="mb-3">';
                                                echo '<label class="form-label">Question ' . $essayCounter . ':</label>';
                                                // ***ADD HIDDEN INPUT HERE***
                                                echo '<input type="hidden" name="quiz_essayId[]" value="' . $essayQuestion["q_essay_id"] . '">'; // CRUCIAL
                                                echo '<textarea class="form-control" name="essay_questions[]" rows="4" required>' . htmlspecialchars($essayQuestion["question"]) . '</textarea>';
                                                echo '</div>';
                                                $essayCounter++;
                                            }
                                        } else {
                                            echo '<p class="text-danger">No essay questions found.</p>';
                                        }

                                        // Check if there are true/false questions
                                        echo '<hr><h6 class="text-primary">True/False Questions</h6>';
                                        if (!empty($trueFalseQuestions)) {
                                            foreach ($trueFalseQuestions as $index => $tf) {
                                                echo '<div class="mb-3">';
                                                echo '<label class="form-label"> Question ' . ($index + 1) . ':</label>';
                                                // ***ADD HIDDEN INPUT HERE***
                                                echo '<input type="hidden" name="quiz_tfId[]" value="' . $tf["q_tf_id"] . '">'; // CRUCIAL
                                                echo '<textarea class="form-control" name="true_false_questions[]" rows="2" required>' . htmlspecialchars($tf["question"]) . '</textarea>';
                                                echo '<label class="form-label mt-2 text-success">Correct Answers:</label>';
                                                echo '<select class="form-select" name="true_false_answers[]" required>';
                                                echo '<option value="True"' . ($tf["correct"] == "True" ? " selected" : "") . '>True</option>';
                                                echo '<option value="False"' . ($tf["correct"] == "False" ? " selected" : "") . '>False</option>';
                                                echo '</select>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<p class="text-danger">No true/false questions found.</p>';
                                        }
                                        echo '
                                                            <hr>
                                                            <div class="text-end">
                                                                <button name="submit" type="submit" class="btn btn-success">Update Quiz</button>
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="resetFormUpload()">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> ';



                                        // todo Modal for deleting quiz
                                        echo '
                                        <div class="modal fade" id="del_quiz' . $quiz['quiz_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h5 class="mt-4 mb-4 text-dark fw-bold">
                                                            Are you sure you want to remove "<span class="text-danger">' . ucwords(strtolower($quiz['quiz_quarter'])) . ' Quarter Quiz</span>"?
                                                        </h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-2 mb-4">
                                                        <a href="includes/Operation/deleteQuiz.php?quiz_id=' . urlencode($quiz['quiz_id']) . '&sched_id=' . urlencode($sched_id) . '&sub_code=' . urlencode($sub_code) . '&section_code=' . urlencode($section_code) . '" 
                                                        class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center mt-2"> No quizzes found. </td>
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
    include("../faculty/includes/extension.php");
    ?>
</main>
<!-- PAGINATION AND SEARCH -->
<script>
    $(document).ready(function() {
        $("#example").DataTable({
            // dom: "Bfrtip", // Include buttons in the dom
            responsive: true,
            buttons: [],
        });
    });
</script>