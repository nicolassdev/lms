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
    header("Location: ../../index.php?page=created_exam_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
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

        $id = $_POST["examID"];
        $exam_title = trim($_POST["exam_title"] ?? '');
        $exam_desc = trim($_POST["exam_description"] ?? '');
        $exam_duration = trim($_POST["exam_duration"] ?? '');
        $exam_quarter = trim($_POST["exam_quarter"] ?? '');
        $exam_date = trim($_POST["exam_date"] ?? '');

        // multiple questions
        // $questionIds = $_POST['multipleID'] ?? [];
        $questions = $_POST['question'] ?? [];
        $correctAnswerLetter = strtoupper(trim($_POST["correct_answer"][$index] ?? ''));
        $option = [
            'A' => $_POST['option_A'] ?? [],
            'B' => $_POST['option_B'] ?? [],
            'C' => $_POST['option_C'] ?? [],
            'D' => $_POST['option_D'] ?? []
        ];

        // Handle other types of questions
        $enum_question = $_POST["enum_question"] ?? [];
        $enum_answer = $_POST["answers"] ?? [];
        $essay_question = $_POST["essay_questions"] ?? [];

        //true or false
        $tf_question = $_POST["true_false_questions"] ?? [];
        $tf_answer = $_POST["true_false_answers"] ?? [];

        // EXAM TABLE (basic information)
        $storeExamTable = [
            'exam_title' => $exam_title,
            'exam_quarter' => $exam_quarter,
            'exam_duration' => $exam_duration,
            'exam_desc' => $exam_desc,
            'exam_date' => $exam_date,
        ];


        // Update Exam Table
        foreach ($storeExamTable as $column => $value) {
            if ($value !== null && $value !== '') { // Only update non-null and non-empty values
                $mySQLFunction->updateRecord("exam", $column, $value, "exam_id", $id);
            }
        }


        // Update Multiple Choice  
        if (isset($_POST["question"]) && is_array($_POST["question"])) {
            foreach ($_POST['multipleID'] as $index => $mulId) { // Use mulId consistently
                $question = trim($_POST['question'][$index] ?? ''); // Use $_POST directly
                if ($question !== '') {
                    $mySQLFunction->updateMultipleRecord('exam_multiple', 'mul_question', $question, 'mul_id', $mulId);
                }

                foreach (['A', 'B', 'C', 'D'] as $choice) {
                    $optionColumn = "choice_" . strtolower($choice);
                    $optionValue = trim($_POST['option_' . $choice][$index] ?? ''); // Use $_POST directly
                    if ($optionValue !== '') {
                        $mySQLFunction->updateMultipleRecord('exam_multiple', $optionColumn, $optionValue, 'mul_id', $mulId);
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
                $mySQLFunction->updateMultipleRecord('exam_multiple', 'is_correct', $correctAnswersString, 'mul_id', $mulId);
            }
        }


        // Update Enumeration
        if (isset($_POST["enum_questions"]) && is_array($_POST["enum_questions"])) {
            foreach ($_POST["enum_id"] as $index => $enumId) { // Loop using enum_id from the form
                $enumQuestion = trim($_POST["enum_questions"][$index] ?? '');
                $enumAnswer = trim($_POST["enum_answers"][$index] ?? '');
                if ($enumId !== '') {
                    $mySQLFunction->updateEnumerationRecord($enumId, $enumQuestion, $enumAnswer); // Use $enumId HERE
                }
            }
        }


        // Update Essay
        if (isset($_POST["essay_questions"]) && is_array($_POST["essay_questions"])) {
            foreach ($_POST["essay_id"] as $index => $essayId) { // Loop using essay_id from the form
                $essayQuestion = trim($_POST["essay_questions"][$index] ?? '');
                if ($essayId !== '') {
                    $mySQLFunction->updateEssayRecord($essayId, $essayQuestion); // Use $essayId HERE
                }
            }
        }

        // Update True/False
        if (isset($_POST["true_false_questions"]) && is_array($_POST["true_false_questions"])) {
            foreach ($_POST["tf_id"] as $index => $tfId) { // Loop using tf_id from the form
                $tfQuestion = trim($_POST["true_false_questions"][$index] ?? '');
                $tfAnswer = trim($_POST["true_false_answers"][$index] ?? '');
                if ($tfId !== '') {
                    $mySQLFunction->updateTrueFalseRecord($tfId, $tfQuestion, $tfAnswer); // Use $tfId HERE
                }
            }
        }

        // Set session variable to indicate successful update
        $_SESSION['success'] = "Successfully updated exam details.";
        header("Location: ../../index.php?page=created_exam_list&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
        exit();
    }
} catch (Exception $e) {
    // Handle exceptions and errors
    error_log("Error updating teacher details: " . $e->getMessage());
    $_SESSION['teacherupdate_error'] = "An error occurred while updating the teacher's details.";
    header("location:../../error.php");
    exit();
} finally {
    // Disconnect after updating
    $mySQLFunction->disconnect();
}
