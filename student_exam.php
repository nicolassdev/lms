<?php

if (!isset($_SESSION['username'])) {
    header("location:login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'student') {
        header("location:login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>

<!-- Main QUIZ -->
<div class="my-5">
    <main class="col-md-12 ms-sm-auto col-lg-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="container-fluid ">
                        <h2>Exam</h2>
                        <p class="text-muted">Here, you can take your subject exam and view the results.</p>

                        <div class="row mt-4">

                            <!-- VIEW RESULT Exam -->
                            <!-- Exam Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-book display-4 text-info mb-3"></i>
                                        <h5 class="card-title">Exam</h5>
                                        <p class="card-text">Check your exam performance.</p>
                                        <a href="#" class="btn btn-info text-black">View Exam</a>
                                    </div>
                                </div>
                            </div>

                            <!-- TAKE Exam -->
                            <!-- Exam Card -->
                            <!-- Exam Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-book display-4 text-info mb-3"></i>
                                        <h5 class="card-title">Exam</h5>
                                        <p class="card-text">Start your exam.</p>
                                        <a href="index.php?page=student_take_exam" class="btn btn-info text-black">Take Exam</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>