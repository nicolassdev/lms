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
    $exams = $mySQLFunction->getAllExamCreatedByTeacher($_SESSION['teacher_id'], $sub_code,  $section_code);
    // echo "<pre>";
    // print_r($exams);
    // echo "</pre>";
}
?>

<!-- <style>
    .data-table {
        font-size: 0.8em;
        /* Reduce font size */
    }

    .table th,
    .table td {
        padding: 0.1rem;
        /* Adjust padding */
    }
</style> -->

<main class="col-md-12 ms-sm-auto col-lg-10 px-md-3 mt-5 py-4 me-2">
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
                                if (!empty($exams)) {
                                    foreach ($exams as $student) {
                                        echo htmlspecialchars($student["sub_title"]); // Display subject title
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Grade Level and Section -->
                            <h6 class="fw-semibold mt-1">
                                <?php
                                if (!empty($exams)) {
                                    foreach ($exams as $student) {
                                        echo htmlspecialchars($student["grade_lvl"]) . ' - ';
                                        echo htmlspecialchars($student["section_name"]) . '<br> ';
                                        echo htmlspecialchars($student["sub_semester"]);
                                        break; // Exit the loop after processing the first student
                                    }
                                } else {
                                    echo
                                    '<div class="alert alert-danger d-flex align-items-center badge">
                                        <div>
                                            <strong>No Exam Created!</strong> It seems there are no exams uploaded yet.
                                        </div>
                                    </div>';
                                }
                                ?>
                            </h6>

                        </div>

                        <!-- Back button -->
                        <div class="d-flex gap-2 ms-2">
                            <a class="btn btn-primary fw-bold btn-sm btn-animate"
                                href="index.php?page=create_exam<?php if ($sched_id && $sub_code && $section_code) {
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
                                    <th scope="col" style="width: 50px;" class="text-center">Quarterly Exam</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Exam Name</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Total Items</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Date</th>
                                    <th scope="col" style="width: 50px;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($exams)) {
                                    foreach ($exams as $exam) {
                                        $rowExamCount = 1;
                                        $multipleQuestions = ($exam["multiple_questions"]);
                                        $enumerationQuestions =  ($exam["enumeration_questions"]);
                                        $essayQuestions = ($exam["essay_questions"]);
                                        $trueFalseQuestions = ($exam["tf_questions"]);

                                        // $multipleQuestions = json_decode($exam["multiple_questions"], true);
                                        // $enumerationQuestions = json_decode($exam["enumeration_questions"], true);
                                        // $essayQuestions = json_decode($exam["essay_questions"], true);

                                        // // Assuming this part is within the loop processing the exams
                                        // // $essayQuestions = explode(" || ", $exam["essay_questions"]); // Split the string into an array
                                        // $trueFalseQuestions = json_decode($exam["tf_questions"], true);

                                        echo '<tr>';
                                        // echo '<td>' . $count . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($exam["exam_quarter"])) . '</td>';
                                        echo '<td class="small text-center">' .  ucwords(strtolower($exam["exam_title"])) . '</td>';
                                        echo '<td class="small text-center">' .  $exam["exam_items"] . '</td>';
                                        echo '<td class="small text-center">' . date('F j, Y', strtotime($exam["exam_date"])) .  '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#edit_exam' . $exam['exam_id'] . '">
                                            <i class="bi bi-pencil-square"></i> 
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_exam' . $exam['exam_id'] . '">
                                               <i class="bi bi-trash"></i> 
                                        </button>
                                        
                                        </td>';

                                        // todo Modal for editing exam

                                        echo '
                                        <div class="modal fade" id="edit_exam' . $exam['exam_id'] . '" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="text-start">
                                                                <h1 class="modal-title fs-4 text-white">Edit Exam Details</h1>
                                                            </div>
                                                            </div>
                                                            <div class="text-end">
                                                            <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                            </div>                           
                                                        </div>
                                                    <div class="modal-body">
                                                        <form id="createExamForm" action="./includes/Operation/updateExam.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                                                            <input type="hidden" name="schedID" value="' . htmlspecialchars($_GET['sched_id']) . '">
                                                            <input type="hidden" name="subID" value="' . htmlspecialchars($_GET['sub_code']) . '">
                                                            <input type="hidden" name="secID" value="' . htmlspecialchars($_GET['section_code']) . '">
                                                            <input type="hidden" name="examID" value="' . htmlspecialchars($exam['exam_id']) . '">

                                                            <div class="mb-2">
                                                                <label for="examTitle" class="form-label fw-bold">Exam Title</label>
                                                                <input type="text" id="examTitle" name="exam_title" value="' . htmlspecialchars($exam['exam_title']) . '" class="form-control" placeholder="Enter the exam title" required>
                                                            </div>
 
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                        <label for="examDate" class="form-label fw-bold">Exam Date</label>
                                                                        <input type="date" id="examDate" name="exam_date" value="' . htmlspecialchars($exam['exam_date']) . '" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="examDuration" class="form-label fw-bold">Duration (minutes)</label>
                                                                        <input type="number" id="examDuration" name="exam_duration" value="' . htmlspecialchars($exam['exam_duration']) . '" class="form-control" placeholder="Enter duration" min="1" oninput="checkNegativeValue(this)" required>
                                                                    </div>
                                                                </div>
                                                            <div class="mb-4">
                                                                <label for="quarterExam" class="form-label fw-bold mt-2">Quarterly Exam</label>
                                                                <select id="quarterExam" name="exam_quarter" class="form-select" required>
                                                                    <option  disabled value="">Select a quarter...</option>
                                                                    <option value="1st Quarter"' . ($exam['exam_quarter'] == '1st Quarter' ? ' selected' : '') . '>1st Quarter</option>
                                                                    <option value="2nd Quarter"' . ($exam['exam_quarter'] == '2nd Quarter' ? ' selected' : '') . '>2nd Quarter</option>
                                                                    <option value="3rd Quarter"' . ($exam['exam_quarter'] == '3rd Quarter' ? ' selected' : '') . '>3rd Quarter</option>
                                                                    <option value="4th Quarter"' . ($exam['exam_quarter'] == '4th Quarter' ? ' selected' : '') . '>4th Quarter</option>
                                                                </select>
                                                            </div>
                                                            <hr>
                                                            <h6 class="text-primary">Multiple Choice Questions</h6>
                                                            ';
                                        // Check if there are multiple questions
                                        if (!empty($multipleQuestions)) {
                                            foreach ($multipleQuestions as $index => $mcq) {
                                                echo '<label class="form-label">Question ' .  $rowExamCount++ . ':</label>';
                                                echo '<div class="mb-3 p-3 border rounded" id="question-container-' . $mcq["mul_id"] . '">';
                                                echo '<input type="hidden" name="multipleID[]" value="' . $mcq["mul_id"] . '">';
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
                                                    //NOTE IF RADIO I CAN SELECT ONLY ONE , IF CHECKBOX I CAN SELECT MULTIPLE
                                                    echo '<input type="radio" name="correct_answer[' . $mcq["mul_id"] . '][]" value="' . $optionLetter . '" ' . ($isCorrect ? 'checked' : '') . ' class="correct-answer-checkbox">';
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
                                            foreach ($enumerationQuestions as $enumQuestion) {
                                                echo '<div class="mb-3">';
                                                echo '<label class="form-label">Question ' .  $rowExamCount++ . ':</label>';
                                                // ***ADD HIDDEN INPUT HERE***
                                                echo '<input type="hidden" name="enum_id[]" value="' . $enumQuestion["enum_id"] . '">'; // CRUCIAL
                                                echo '<textarea class="form-control" name="enum_questions[]" rows="2" required>' . htmlspecialchars($enumQuestion["question"]) . '</textarea>';
                                                echo '<label class="form-label mt-2 text-success">Correct Answers:</label>';
                                                $answers = explode(" || ", $enumQuestion["answers"]);
                                                echo '<div class="input-group">';
                                                foreach ($answers as $index => $answer) {
                                                    echo '<input type="text" class="form-control" name="enum_answers[]" value="' . htmlspecialchars($answer) . '" required>';
                                                }
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<p class="text-danger">No enumeration questions found.</p>';
                                        }

                                        // Check if there are essay questions
                                        echo '<hr><h6 class="text-primary">Essay Questions</h6>';
                                        if (!empty($essayQuestions)) {
                                            foreach ($essayQuestions as $essayQuestion) {
                                                echo '<div class="mb-3">';
                                                echo '<label class="form-label">Question ' . $rowExamCount++ . ':</label>';
                                                // ***ADD HIDDEN INPUT HERE***
                                                echo '<input type="hidden" name="essay_id[]" value="' . $essayQuestion["essay_id"] . '">'; // CRUCIAL
                                                echo '<textarea class="form-control" name="essay_questions[]" rows="4" required>' . htmlspecialchars($essayQuestion["question"]) . '</textarea>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo '<p class="text-danger">No essay questions found.</p>';
                                        }

                                        // Check if there are true/false questions
                                        echo '<hr><h6 class="text-primary">True/False Questions</h6>';
                                        if (!empty($trueFalseQuestions)) {
                                            foreach ($trueFalseQuestions as $index => $tf) {
                                                echo '<div class="mb-3">';
                                                echo '<label class="form-label"> Question ' . $rowExamCount++ . ':</label>';
                                                // ***ADD HIDDEN INPUT HERE***
                                                echo '<input type="hidden" name="tf_id[]" value="' . $tf["tf_id"] . '">'; // CRUCIAL
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
                                                                <button name="submit" type="submit" class="btn btn-success">Update exam</button>
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="resetFormUpload()">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> ';



                                        // todo Modal for deleting exam
                                        echo '
                                        <div class="modal fade" id="del_exam' . $exam['exam_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg">
                                                    <div class="modal-header border-0">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <div class="text-danger">
                                                            <i class="bi bi-trash fs-1 fade-in"></i>
                                                        </div>
                                                        <h6 class="mt-4 mb-4 text-dark fw-bold">
                                                            Are you sure you want to remove "<span class="text-danger">' . ucwords(strtolower($exam['exam_quarter'])) . ' Quarter Exam</span>"?
                                                        </h6>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center border-0 mt-2 mb-4">
                                                        <a href="includes/Operation/deleteExam.php?exam_id=' . urlencode($exam['exam_id']) . '&sched_id=' . urlencode($sched_id) . '&sub_code=' . urlencode($sub_code) . '&section_code=' . urlencode($section_code) . '" 
                                                        class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center mt-2"> No exams found. </td>
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