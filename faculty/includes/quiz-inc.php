<?php
session_start();
include "../../includes/dbh-inc.php"; // Database connection



if (!isset($_POST["submit"])) {
    $sched_id = $_GET['sched_id'] ?? '';
    $sub_id = $_GET['sub_code'] ?? '';
    $sec_id = $_GET['section_code'] ?? '';
    header("Location: ../index.php?page=create_quiz&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
}


try {
    // Get POST data and sanitize inputs
    $sub_id = trim($_POST["subID"] ?? '');
    $sec_id = trim($_POST["secID"] ?? '');
    $sched_id = trim($_POST["schedID"] ?? '');
    $quizTitle = trim($_POST["quiz_title"] ?? '');
    $quizDescription = trim($_POST["quiz_description"] ?? '');
    $quizDuration = trim($_POST["quiz_duration"] ?? '');
    $quizQuarter = trim($_POST["quiz_quarter"] ?? '');
    $quizDate = trim($_POST["quiz_date"] ?? '');

    // to know what type of exam is 
    $quizType = is_array($_POST['quiz_type']) ? implode(',', $_POST['quiz_type']) : '';

    // to count the total number of exam 
    $quizTotalItems = 0;


    $quiz_id = trim($mySQLFunction->generateID("QZ-"));
    $mySQLFunction->connection();

    // Insert exam details into database
    $stmt = $mySQLFunction->con->prepare("INSERT INTO quiz (quiz_id, sched_id, quiz_type, quiz_quarter, quiz_duration, quiz_title, quiz_desc, quiz_items, quiz_date) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $quiz_id, $sched_id, $quizType, $quizQuarter, $quizDuration, $quizTitle, $quizDescription, $quizTotalItems, $quizDate);
    $stmt->execute();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Loop through the submitted exam types
        if (isset($_POST['quiz_type']) && is_array($_POST['quiz_type'])) {
            foreach ($_POST['quiz_type'] as $questionIndex => $type) {
                switch ($type) {
                    case "1": // Multiple Choice
                        $question = $_POST['quiz_question'][$questionIndex] ?? '';
                        $choiceA = $_POST['choice_a'][$questionIndex] ?? '';
                        $choiceB = $_POST['choice_b'][$questionIndex] ?? '';
                        $choiceC = $_POST['choice_c'][$questionIndex] ?? '';
                        $choiceD = $_POST['choice_d'][$questionIndex] ?? '';
                        // Get and sanitize the correct answer
                        $quiz_correct_answer = strtoupper(trim($_POST["quiz_correct_answer"][$questionIndex] ?? '')); // Convert to uppercase to standardize input

                        $isCorrect = match ($quiz_correct_answer) {
                            'A' => $choiceA,
                            'B' => $choiceB,
                            'C' => $choiceC,
                            'D' => $choiceD,
                            default => ''
                        };
                        // Validate and insert into the database
                        // Example: Insert into quiz_multiple table
                        if (!empty($isCorrect)) {
                            $stmt = $mySQLFunction->con->prepare("INSERT INTO quiz_multiple (quiz_id, q_mul_question, q_choice_a, q_choice_b, q_choice_c, q_choice_d, is_correct) 
                                                  VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("sssssss", $quiz_id, $question, $choiceA, $choiceB, $choiceC, $choiceD, $isCorrect);
                            $stmt->execute();
                            $quizTotalItems++;
                        }
                        break;

                    case "2": // Enumeration
                        $question = $_POST['quiz_enumeration_question'][$questionIndex] ?? '';
                        $answers = strtolower($_POST['quiz_enumeration_answers'][$questionIndex] ?? '');

                        // Count the number of enumeration answers (split by comma)
                        $answerCount = count(array_filter(array_map('trim', explode(',', $answers))));

                        // Insert into the exam_enumeration table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO quiz_enumeration (quiz_id, q_enum_question, q_enum_answer) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $quiz_id, $question, $answers);
                        $stmt->execute();

                        // Increase the exam items count based on enumeration answers
                        $quizTotalItems += $answerCount;
                        break;

                    case "3": // Essay
                        $question = $_POST['quiz_essay_question'][$questionIndex] ?? '';

                        // Example: Insert into exam_essay table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO quiz_essay (quiz_id, q_essay_question) VALUES (?, ?)");
                        $stmt->bind_param("ss", $quiz_id, $question);
                        $stmt->execute();

                        $quizTotalItems++;
                        break;

                    case "4": // True/False
                        $question = $_POST['quiz_tf_question'][$questionIndex] ?? '';
                        $correctAnswer = $_POST['quiz_correct_answer'][$questionIndex] ?? '';

                        // Example: Insert into exam_tf table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO quiz_tf (quiz_id, q_tf_question, q_tf_answer) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $quiz_id, $question, $correctAnswer);
                        $stmt->execute();

                        $quizTotalItems++;
                        break;

                    default:
                        // Invalid type handling (if necessary)
                        break;
                }
            }
        }
    }

    // Update quiz_items count in the database
    $stmt = $mySQLFunction->con->prepare("UPDATE quiz SET quiz_items = ? WHERE quiz_id = ?");
    $stmt->bind_param("is", $quizTotalItems, $quiz_id);
    $stmt->execute();

    $_SESSION['success'] = "Successfully created exam!";
    header("Location: ../index.php?page=create_quiz&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header("Location: ../index.php?page=create_quiz&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} finally {
    $mySQLFunction->disconnect();
}
