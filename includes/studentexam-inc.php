<?php
session_start();
include "dbh-inc.php"; // Database connection

if (!isset($_POST["submit"])) {
    header("Location: ../index.php?page=student_exam");
    exit();
}

try {
    $stud_id = $_POST['studID'];
    $exam_id = $_POST['examID'];

    // Database connection
    $mySQLFunction->connection();


    // Handle Multiple Choice Questions
    if (!empty($_POST['mulId'])) {
        foreach ($_POST['mulId'] as $mul_id) {
            if (!empty($_POST["mcq_$mul_id"])) {
                $answer = $_POST["mcq_$mul_id"]; // Directly store the selected choice
                $mySQLFunction->insertAnswer($stud_id, $exam_id, $mul_id, "multiple_choice", $answer);
            }
        }
    }

    // Handle Enumeration Questions
    if (!empty($_POST['enumId'])) {
        foreach ($_POST['enumId'] as $enum_id) {
            if (!empty($_POST["enum_$enum_id"])) {
                $mySQLFunction->insertAnswer($stud_id, $exam_id, $enum_id, "enumeration", $_POST["enum_$enum_id"]);
            }
        }
    }

    // Handle Essay Questions
    if (!empty($_POST['essayId'])) {
        foreach ($_POST['essayId'] as $essay_id) {
            if (!empty($_POST["essay_$essay_id"])) {
                $mySQLFunction->insertAnswer($stud_id, $exam_id, $essay_id, "essay", $_POST["essay_$essay_id"]);
            }
        }
    }

    // Handle True/False Questions
    if (!empty($_POST['tfId'])) {
        foreach ($_POST['tfId'] as $tf_id) {
            if (!empty($_POST["tf_$tf_id"])) {
                $mySQLFunction->insertAnswer($stud_id, $exam_id, $tf_id, "true_false", $_POST["tf_$tf_id"]);
            }
        }
    }

    $_SESSION['success_handler'] = "Successfully submitted exam!";
    header("Location: ../index.php?page=student_exam");
    exit();
} catch (Exception $e) {
    $_SESSION['error_handler'] = "Error: " . $e->getMessage();
    header("Location: ../index.php?page=student_exam");
    exit();
} finally {
    $mySQLFunction->disconnect();
}
