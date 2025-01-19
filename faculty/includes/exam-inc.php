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
    $examType = is_array($_POST['exam_type']) ? implode(',', $_POST['exam_type']) : '';





    $exam_id = trim($mySQLFunction->generateID("EXM-"));
    $mySQLFunction->connection();

    // Insert exam details into database
    $stmt = $mySQLFunction->con->prepare("INSERT INTO exam (exam_id, sched_id, exam_type, exam_quarter, exam_duration, exam_title, exam_desc, exam_date) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $exam_id, $sched_id, $examType, $examQuarter, $examDuration, $examTitle, $examDescription, $examDate);
    $stmt->execute();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Loop through the submitted exam types
        if (isset($_POST['exam_type']) && is_array($_POST['exam_type'])) {
            foreach ($_POST['exam_type'] as $questionIndex => $type) {
                switch ($type) {
                    case "1": // Multiple Choice
                        $question = $_POST['exm_question'][$questionIndex] ?? '';
                        $choiceA = $_POST['choice_a'][$questionIndex] ?? '';
                        $choiceB = $_POST['choice_b'][$questionIndex] ?? '';
                        $choiceC = $_POST['choice_c'][$questionIndex] ?? '';
                        $choiceD = $_POST['choice_d'][$questionIndex] ?? '';
                        // Get and sanitize the correct answer
                        $correct_answer = strtoupper(trim($_POST["correct_answer"][$questionIndex] ?? '')); // Convert to uppercase to standardize input

                        // Map the correct answer to the corresponding choice
                        switch ($correct_answer) {
                            case 'A':
                                $isCorrect = $choiceA;
                                break;
                            case 'B':
                                $isCorrect = $choiceB;
                                break;
                            case 'C':
                                $isCorrect = $choiceC;
                                break;
                            case 'D':
                                $isCorrect = $choiceD;
                                break;
                            default:
                                $isCorrect = ''; // If the correct answer does not match A-D, set as empty
                        }

                        // Skip inserting if isCorrect is empty (invalid answer provided)
                        if (empty($isCorrect)) {
                            continue;
                        }

                        // Validate and insert into the database
                        // Example: Insert into exam_multiple table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_multiple (exam_id, mul_question, choice_a, choice_b, choice_c, choice_d, is_correct) 
                                              VALUES (?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssssss", $exam_id, $question, $choiceA, $choiceB, $choiceC, $choiceD, $isCorrect);
                        $stmt->execute();
                        break;

                    case "2": // Enumeration
                        $question = $_POST['enumeration_question'][$questionIndex] ?? '';
                        $answers = $_POST['enumeration_answers'][$questionIndex] ?? '';

                        // Example: Insert into exam_enumeration table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_enumeration (exam_id, enum_question, enum_answer) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $exam_id, $question, $answers);
                        $stmt->execute();
                        break;

                    case "3": // Essay
                        $question = $_POST['essay_question'][$questionIndex] ?? '';

                        // Example: Insert into exam_essay table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_essay (exam_id, essay_question) VALUES (?, ?)");
                        $stmt->bind_param("ss", $exam_id, $question);
                        $stmt->execute();
                        break;

                    case "4": // True/False
                        $question = $_POST['tf_question'][$questionIndex] ?? '';
                        $correctAnswer = $_POST['correct_answer'][$questionIndex] ?? '';

                        // Example: Insert into exam_tf table
                        $stmt = $mySQLFunction->con->prepare("INSERT INTO exam_tf (exam_id, tf_question, tf_answer) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $exam_id, $question, $correctAnswer);
                        $stmt->execute();
                        break;

                    default:
                        // Invalid type handling (if necessary)
                        break;
                }
            }
        }
    }

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
