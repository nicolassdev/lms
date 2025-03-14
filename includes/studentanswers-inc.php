<?php
session_start();
include "dbh-inc.php"; // Database connection

if (!isset($_POST["submit"])) {
    header("Location: ../index.php?page=student_exam");
    exit();
}

try {
    $stud_id = $_POST['studID']; // student lrn 
    $sub_code = $_POST['subID'];  // subect code 
    $exam_id = $_POST['examID'] ?? null; // If examID exists, else set null
    $quiz_id = $_POST['quizID'] ?? null; // If quizID exists, else set null

    // Database connection
    $mySQLFunction->connection();

    if (!empty($exam_id)) {
        // ✅ Handle Multiple Choice Questions (Exam)
        if (!empty($_POST['mulId'])) {
            foreach ($_POST['mulId'] as $mul_id) {
                if (!empty($_POST["mcq_$mul_id"])) {
                    $mul_answer = $_POST["mcq_$mul_id"];
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $mul_id, "multiple_choice", $mul_answer);
                }
            }
        }

        // ✅ Handle Enumeration Questions (Exam)
        if (!empty($_POST['enumId'])) {
            foreach ($_POST['enumId'] as $enum_id) {
                if (!empty($_POST["enum_$enum_id"])) {
                    $enum_answer = strtolower($_POST["enum_$enum_id"]);
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $enum_id, "enumeration", $enum_answer);
                }
            }
        }

        // ✅ Handle True/False Questions (Exam)
        if (!empty($_POST['tfId'])) {
            foreach ($_POST['tfId'] as $tf_id) {
                if (!empty($_POST["tf_$tf_id"])) {
                    $tf_answer = strtolower($_POST["tf_$tf_id"]);
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $tf_id, "true_false", $tf_answer);
                }
            }
        }

        // ✅ Handle Essay Questions (Exam)
        if (!empty($_POST['essayId'])) {
            foreach ($_POST['essayId'] as $essay_id) {
                if (!empty($_POST["essay_$essay_id"])) {
                    $essay_answer = $_POST["essay_$essay_id"];
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $essay_id, "essay", $essay_answer);
                }
            }
        }

        $mySQLFunction->calculateEquivalentAndStoreStudentScore($stud_id, $exam_id, null);
    } else if (!empty($quiz_id)) {
        // ✅ Handle Multiple Choice Questions (QUIZ)
        if (!empty($_POST['qMulId'])) {
            foreach ($_POST['qMulId'] as $q_mul_id) {
                if (!empty($_POST["qmcq_$q_mul_id"])) {
                    $mul_answer = $_POST["qmcq_$q_mul_id"];
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $q_mul_id, "multiple_choice", $mul_answer);
                }
            }
        }

        // ✅ Handle Enumeration Questions (QUIZ)
        if (!empty($_POST['qEnumId'])) {
            foreach ($_POST['qEnumId'] as $q_enum_id) {
                if (!empty($_POST["qenum_$q_enum_id"])) {
                    $enum_answer = strtolower($_POST["qenum_$q_enum_id"]);
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $q_enum_id, "enumeration", $enum_answer);
                }
            }
        }

        // ✅ Handle True/False Questions (QUIZ)
        if (!empty($_POST['qTfId'])) {
            foreach ($_POST['qTfId'] as $q_tf_id) {
                if (!empty($_POST["qtf_$q_tf_id"])) {
                    $tf_answer = strtolower($_POST["qtf_$q_tf_id"]);
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $q_tf_id, "true_false", $tf_answer);
                }
            }
        }

        // ✅ Handle Essay Questions (QUIZ)
        if (!empty($_POST['qEssayId'])) {
            foreach ($_POST['qEssayId'] as $q_essay_id) {
                if (!empty($_POST["qessay_$q_essay_id"])) {
                    $essay_answer = $_POST["qessay_$q_essay_id"];
                    $mySQLFunction->insertStudentAnswer($stud_id, $sub_code, $exam_id, $quiz_id, $q_essay_id, "essay", $essay_answer);
                }
            }
        }

        $mySQLFunction->calculateEquivalentAndStoreStudentScore($stud_id, null, $quiz_id);
    }

    // ✅ Redirect Based on Exam or Quiz
    if ($exam_id) {
        $_SESSION['success_handler'] = "Successfully submitted exam.";
        header("Location: ../index.php?page=exam_result");
    } elseif ($quiz_id) {
        $_SESSION['success_handler'] = "Successfully submitted quiz.";
        header("Location: ../index.php?page=quiz_result");
    }
    exit();
} catch (Exception $e) {
    $_SESSION['error_handler'] = "Error: " . $e->getMessage();
    // ✅ Redirect Based on Exam or Quiz in case of an error
    if ($exam_id) {
        header("Location: ../index.php?page=student_exam");
    } elseif ($quiz_id) {
        header("Location: ../index.php?page=student_quiz");
    }
    exit();
} finally {
    $mySQLFunction->disconnect();
}
