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

                    <div class="container-fluid">
                        <h2>Quiz</h2>
                        <p class="text-muted">Here, you can take your subject quiz and view the results.</p>

                        <div class="row mt-4">

                            <!-- VIEW RESULT QUIZ -->
                            <!-- Quiz Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-lightbulb display-4 text-danger mb-3"></i>
                                        <h5 class="card-title">Quiz</h5>
                                        <p class="card-text">Check your quiz performance and score.</p>
                                        <a href="#" class="btn btn-danger">View Quiz</a>
                                    </div>
                                </div>
                            </div>
                            <!-- TAKE QUIZ -->
                            <!-- Quiz Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-lightbulb display-4 text-danger mb-3"></i>
                                        <h5 class="card-title">Quiz</h5>
                                        <p class="card-text">Start your quiz.</p>
                                        <a href="#" class="btn btn-danger">Take Quiz</a>
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