<?php
session_start(); // Ensure session is started

if (!isset($_SESSION["teacher_id"])) {
    header("location:../../../login.php?error=accessdenied");   //Redirect to URL login When trying to go this file
    exit();
}

if (!isset($_POST["submit"])) {
    $sched_id = $_GET['sched_id'] ?? '';
    $sub_id = $_GET['sub_code'] ?? '';
    $sec_id = $_GET['section_code'] ?? '';
    header("Location: ../../index.php?page=created_quiz_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
}

// Database connection
include "../../../includes/dbh-inc.php";

try {
    // Establish the database connection
    $mySQLFunction->connection();

    if (isset($_POST["submit"])) {

        // Sanitize and prepare input
        // Get POST data and sanitize inputs
        $sub_id = trim($_POST["subID"] ?? '');
        $sec_id = trim($_POST["secID"] ?? '');
        $sched_id = trim($_POST["schedID"] ?? '');

        $id = $_POST["quizID"];
        $quiz_title = trim($_POST["quiz_title"] ?? '');
        $quiz_desc = trim($_POST["quiz_description"] ?? '');
        $quiz_duration = trim($_POST["quiz_duration"] ?? '');
        $quiz_quarter = trim($_POST["quiz_quarter"] ?? '');
        $quiz_date = trim($_POST["quiz_date"] ?? '');

        // multiple questions
        // $questionIds = $_POST['q_multiId'] ?? [];
        $questions = $_POST['question'] ?? [];
        $correctAnswerLetter = strtoupper(trim($_POST["correct_answer"][$index] ?? ''));
        $option = [
            'A' => $_POST['option_A'] ?? [],
            'B' => $_POST['option_B'] ?? [],
            'C' => $_POST['option_C'] ?? [],
            'D' => $_POST['option_D'] ?? []
        ];

        // Handle other types of questions
        $enum_questions = $_POST["enum_questions"] ?? [];
        $enum_answers = $_POST["answers"] ?? [];
        $essay_question = $_POST["essay_questions"] ?? [];

        //true or false
        $tf_question = $_POST["true_false_questions"] ?? [];
        $tf_answer = $_POST["true_false_answers"] ?? [];

        // EXAM TABLE (basic information)
        $storeQuizTable = [
            'quiz_title' => $quiz_title,
            'quiz_quarter' => $quiz_quarter,
            'quiz_duration' => $quiz_duration,
            'quiz_desc' => $quiz_desc,
            'quiz_date' => $quiz_date,
        ];


        // Update Quiz Table
        foreach ($storeQuizTable as $column => $value) {
            if ($value !== null && $value !== '') { // Only update non-null and non-empty values
                $mySQLFunction->updateRecord("quiz", $column, $value, "quiz_id", $id);
            }
        }


        // Update Multiple Choice  
        if (isset($_POST["question"]) && is_array($_POST["question"])) {
            foreach ($_POST['quiz_multipleId'] as $index => $mulId) { // Use mulId consistently
                $question = trim($_POST['question'][$index] ?? ''); // Use $_POST directly
                if ($question !== '') {
                    $mySQLFunction->updateQuizMultipleRecord('quiz_multiple', 'q_mul_question', $question, 'q_mul_id', $mulId);
                }

                foreach (['A', 'B', 'C', 'D'] as $choice) {
                    $optionColumn = "q_choice_" . strtolower($choice);
                    $optionValue = trim($_POST['option_' . $choice][$index] ?? ''); // Use $_POST directly
                    if ($optionValue !== '') {
                        $mySQLFunction->updateQuizMultipleRecord('quiz_multiple', $optionColumn, $optionValue, 'q_mul_id', $mulId);
                    }
                }

                $correctAnswersForQuestion = $_POST["correct_answer"][$mulId] ?? [];

                // Build comma-separated string of correct answers
                $correctAnswersString = "";
                if (is_array($correctAnswersForQuestion)) {
                    $correctAnswersArray = [];
                    foreach ($correctAnswersForQuestion as $correctAnswerLetter) {
                        $correctAnswerValue = trim($_POST['option_' . $correctAnswerLetter][$index] ?? '');
                        if ($correctAnswerValue !== '') {
                            $correctAnswersArray[] = $correctAnswerValue;
                        }
                    }
                    $correctAnswersString = implode(",", $correctAnswersArray);
                }

                // Update is_correct ONCE
                $mySQLFunction->updateQuizMultipleRecord('quiz_multiple', 'is_correct', $correctAnswersString, 'q_mul_id', $mulId);
            }
        }


        // Update Enumeration
        if (isset($_POST["enum_questions"]) && is_array($_POST["enum_questions"])) {
            foreach ($_POST["quiz_enumId"] as $index => $enumId) { // Loop using enum_id from the form
                $enumQuestion = trim($_POST["enum_questions"][$index] ?? '');
                $enumAnswer = trim($_POST["enum_answers"][$index] ?? '');
                if ($enumId !== '') {
                    $mySQLFunction->updateQuizEnumerationRecord($enumId, $enumQuestion, $enumAnswer); // Use $enumId HERE
                }
            }
        }


        // Update Essay
        if (isset($_POST["essay_questions"]) && is_array($_POST["essay_questions"])) {
            foreach ($_POST["quiz_essayId"] as $index => $essayId) { // Loop using quiz_essayId from the form
                $essayQuestion = trim($_POST["essay_questions"][$index] ?? '');
                if ($essayId !== '') {
                    $mySQLFunction->updateQuizEssayRecord($essayId, $essayQuestion); // Use $essayId HERE
                }
            }
        }

        // Update True/False
        if (isset($_POST["true_false_questions"]) && is_array($_POST["true_false_questions"])) {
            foreach ($_POST["quiz_tfId"] as $index => $tfId) { // Loop using quiz_tfId from the form
                $tfQuestion = trim($_POST["true_false_questions"][$index] ?? '');
                $tfAnswer = trim($_POST["true_false_answers"][$index] ?? '');
                if ($tfId !== '') {
                    $mySQLFunction->updateQuizTrueFalseRecord($tfId, $tfQuestion, $tfAnswer); // Use $tfId HERE
                }
            }
        }

        // Set session variable to indicate successful update
        $_SESSION['success'] = "Successfully updated exam details.";
        header("Location: ../../index.php?page=created_quiz_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
        exit();
    }
} catch (Exception $e) {
    // Handle exceptions and errors
    error_log("Error updating teacher details: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred while updating the quiz's details. " . $e->getMessage();
    header("Location: ../../index.php?page=created_quiz_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} finally {
    // Disconnect after updating
    $mySQLFunction->disconnect();
}
