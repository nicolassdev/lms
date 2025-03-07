<?php
// Start session and validate user
if (!isset($_SESSION['stu_lrn'])) {
    header("Location: ./login.php?error=accessdenied");
    exit;
}
?>

<main class="col-md-12 ms-sm-auto col-lg-10">
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">

                <!-- quiz Completion Section -->
                <div id="quizEndNotification" class="text-center my-5">
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