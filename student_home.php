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

<?php
include "./includes/dbh-inc.php";
$mySQLFunction->connection();

// set school year and semester
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$mySQLFunction->disconnect();
?>


<!-- Home Content -->

<div class="my-4">
    <main class="col-md-12 ms-sm-auto col-lg-10">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img
                        style="position: absolute; top: 50%; right: 5%; transform: translate(-0%, -45%); 
               width: 500px; opacity: 0.1; z-index: -1;"
                        src="./assets/img/csi.webp"
                        alt="LMS Logo">
                    <div class="container-fluid ">
                        <h4>Welcome back CSIan Student!</h4>
                        <p class="text-muted">Here you can manage your exam, quiz, assignments, and view your grades.</p>
                        <!-- School Year and Semester Display -->
                        <div class="col-md-12 text-muted">
                            <?php
                            if (!empty($activeSchoolYears) && !empty($activeSem)) {
                                foreach ($activeSchoolYears as $index => $schoolYear) {
                                    echo 'Semester: ' . htmlspecialchars($activeSem[$index]) . '<i class="bi bi-check-circle-fill text-success ms-2"></i> </br>';
                                    echo 'School Year: ' . htmlspecialchars($schoolYear) . '<i class="bi bi-check-circle-fill text-success ms-2"></i> ';
                                }
                            } else {
                                echo '<div class="alert alert-warning">No school year and semester found.</div>';
                            }
                            ?>
                            <!-- Static Data -->
                            <!-- <p>Logged in as : &nbsp;Student <i class="bi bi-patch-check-fill text-success ms-1"></i></p> -->
                        </div>
                        <div class="row mt-4">
                            <!-- Courses Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-person-lines-fill display-4 text-primary mb-3"></i>
                                        <h5 class="card-title">Profile</h5>
                                        <p class="card-text">View and manage your account.</p>
                                        <a href="?page=student_prof" class="btn btn-primary">Manage account</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Module Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-journal display-4 text-info mb-3"></i>
                                        <h5 class="card-title">Module</h5>
                                        <p class="card-text">Submit and track your Module.</p>
                                        <a href="#" class="btn btn-info text-black">View Module</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Activity Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-pencil-fill display-4 text-success mb-3"></i>
                                        <h5 class="card-title">Activity</h5>
                                        <p class="card-text">Submit and track your Activity.</p>
                                        <a href="#" class="btn btn-success">View Activity</a>
                                    </div>
                                </div>
                            </div>


                            <!-- Quiz Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-lightbulb display-4 text-danger mb-3"></i>
                                        <h5 class="card-title">Quiz</h5>
                                        <p class="card-text">Check your quiz performance.</p>
                                        <a href="#" class="btn btn-danger">View Quiz</a>
                                    </div>
                                </div>
                            </div>

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


                            <!-- Grades Card -->
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-bar-chart-fill display-4 text-warning mb-3"></i>
                                        <h5 class="card-title">Grades</h5>
                                        <p class="card-text">Check your academic performance.</p>
                                        <a href="#" class="btn btn-warning text-black">View Grades</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php
                include "includes/footer.php";
                ?>
    </main>
</div>