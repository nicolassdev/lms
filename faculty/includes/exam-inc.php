<?php
session_start();
include "../../includes/dbh-inc.php"; // Database connection



if (!isset($_POST["submit"])) {
    $sched_id = $_GET['sched_id'] ?? '';
    $sub_id = $_GET['sub_code'] ?? '';
    $sec_id = $_GET['section_code'] ?? '';
    header("Location: ../index.php?page=create_exam&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
}


try {
    // Get POST data and sanitize inputs
    $sub_id = trim($_POST["subID"] ?? '');
    $sec_id = trim($_POST["secID"] ?? '');
    $sched_id = trim($_POST["schedID"] ?? '');
    $examTitle = trim($_POST["exam_title"] ?? '');
    $examDescription = trim($_POST["exam_description"] ?? '');
    $examDuration = trim($_POST["exam_duration"] ?? '');
    $examQuarter = trim($_POST["exam_quarter"] ?? '');
    $examDate = trim($_POST["exam_date"] ?? '');

    // to know what type of exam is 
    $examType = is_array($_POST['exam_type']) ? implode(',', $_POST['exam_type']) : '';

    // to count the total number of exam 
    // Initialize exam total count
    $examTotal = 0;


    $exam_id = trim($mySQLFunction->generateID("EXM-"));
    $mySQLFunction->connection();

    // Insert exam details into database
    $stmt = $mySQLFunction->con->prepare("INSERT INTO exam (exam_id, sched_id, exam_type, exam_quarter, exam_duration, exam_title, exam_desc, exam_items, exam_date) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $exam_id, $sched_id, $examType, $examQuarter, $examDuration, $examTitle, $examDescription, $examTotal, $examDate);
    $stmt->execute();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Loop through the submitted exam types
        if (isset($_POST['exam_type']) && is_array($_POST['exam_type'])) {
            foreach ($_POST['exam_type'] as $questionIndex => $type) {
                switch ($type) {
                    case "1": // Multiple Choice
                        $question = $_POST['exam_question'][$questionIndex] ?? '';
                        $choiceA = $_POST['choice_a'][$questionIndex] ?? '';
                        $choiceB = $_POST['choice_b'][$questionIndex] ?? '';
                        $choiceC = $_POST['choice_c'][$questionIndex] ?? '';
                        $choiceD = $_POST['choice_d'][$questionIndex] ?? '';

                        // Get and sanitize the correct answer
                        $correct_answer = strtoupper(trim($_POST["correct_answer"][$questionIndex] ?? '')); // Convert to uppercase to standardize input

                        $isCorrect = match ($correct_answer) {
                            'A' => $choiceA,
                            'B' => $choiceB,
                            'C' => $choiceC,
                            'D' => $choiceD,
                            default => ''
                        };

                        // Validate and insert into the database
                        // Insert into exam_multiple table
                        if (!empty($isCorrect)) {
                            $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_multiple (exam_id, mul_question, choice_a, choice_b, choice_c, choice_d, is_correct) 
                                                                  VALUES (?, ?, ?, ?, ?, ?, ?)");
                            $stmt->bind_param("sssssss", $exam_id, $question, $choiceA, $choiceB, $choiceC, $choiceD, $isCorrect);
                            $stmt->execute();
                            $examTotal++; // Increment count for each multiple-choice question
                        }
                        break;

                    case "2": // Enumeration
                        $question = $_POST['enumeration_question'][$questionIndex] ?? '';
                        $answers = strtolower($_POST['enumeration_answers'][$questionIndex] ?? '');

                        // Count the number of enumeration answers (split by comma)
                        $answerCount = count(array_filter(array_map('trim', explode(',', $answers))));

                        // Insert into the exam_enumeration table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_enumeration (exam_id, enum_question, enum_answer) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $exam_id, $question, $answers);
                        $stmt->execute();

                        // Increase the exam items count based on enumeration answers
                        $examTotal += $answerCount;
                        break;

                    case "3": // Essay
                        $question = $_POST['essay_question'][$questionIndex] ?? '';

                        // Example: Insert into exam_essay table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_essay (exam_id, essay_question) VALUES (?, ?)");
                        $stmt->bind_param("ss", $exam_id, $question);
                        $stmt->execute();

                        $examTotal++; // Increment count for each essay question
                        break;

                    case "4": // True/False
                        $question = $_POST['tf_question'][$questionIndex] ?? '';
                        $correctAnswer = strtolower($_POST['correct_answer'][$questionIndex] ?? '');

                        // Example: Insert into exam_tf table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_tf (exam_id, tf_question, tf_answer) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $exam_id, $question, $correctAnswer);
                        $stmt->execute();

                        $examTotal++; // Increment count for each True/False question
                        break;

                    default:
                        // Invalid type handling (if necessary)
                        break;
                }
            }
        }
    }
    // Update exam_items count in the database
    $stmt = $mySQLFunction->con->prepare("UPDATE exam SET exam_items = ? WHERE exam_id = ?");
    $stmt->bind_param("is", $examTotal, $exam_id);
    $stmt->execute();

    $_SESSION['success'] = "Successfully created exam!";
    header("Location: ../index.php?page=create_exam&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} catch (Exception $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header("Location: ../index.php?page=create_exam&sched_id=" . urlencode($sched_id) . "&sub_code=" . urlencode($sub_id) . "&section_code=" . urlencode($sec_id));
    exit();
} finally {
    $mySQLFunction->disconnect();
}
