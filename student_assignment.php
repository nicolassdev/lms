<?php

if (!isset($_SESSION['username'])) {
    header("location:login.php?error=accessdenied");
    exit();
}
?>

<!-- Main EXAM -->
<div class="my-5">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row">
            <div class="container-fluid ">
                <h2>Assignment</h2>
                <p class="text-muted">Here, you can take your indiviual and group assignment also view the results.</p>

                <div class="row mt-4">

                    <!-- VIEW RESULT Exam -->
                    <!-- Exam Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-pencil display-4 text-success mb-3"></i>
                                <h5 class="card-title">Assignment</h5>
                                <p class="card-text">Check your assignment performance.</p>
                                <a href="#" class="btn btn-success">View Assignment</a>
                            </div>
                        </div>
                    </div>

                    <!-- TAKE Exam -->
                    <!-- Exam Card -->
                    <!-- Exam Card -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-pencil display-4 text-success mb-3"></i>
                                <h5 class="card-title">Assignment</h5>
                                <p class="card-text">Start your assignment.</p>
                                <a href="#" class="btn btn-success">Take Assignment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>