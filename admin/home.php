<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$numberOfTeacher = $mySQLFunction->checkRowCount("TEACHER");
$mySQLFunction->disconnect();
?>
 
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="ms-3">
                <h4>Welcome Back!</h4>
                <div class="date-time mt-3">
                    <?php
                    date_default_timezone_set("Asia/Manila");
                    echo '<div class="date-display">Today is ' . date("M d, Y l") . '</div>';
                    echo '<div class="time-display text-primary">' . date("h:i:sa") . '</div>';


                    ?>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <!-- Example Cards -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width:100%;">
                    <div class="card-body">
                        <h5 class="card-title">Account</h5>
                        <p class="card-text">Manage your account here.</p>
                        <a href="?page=admin" class="btn btn-primary text-white text-center">
                            Manage account
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Strand</h5>
                        <p class="card-text">Manage all strand here.</p>
                        <a href="#" class="btn btn-success text-white text-center">
                            Manage strand
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Subject</h5>
                        <p class="card-text">Manage subject here.</p>
                        <a href="#" class="btn btn-danger text-white text-center">
                            Manage subject
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Teacher</h5>
                        <p class="card-text">Number of teacher registered.</p>
                        <a href="#" class="btn btn-info text-white text-center fs-1 fw-bold">
                            <?php echo $numberOfTeacher; ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-12">
                <div class="card mb-3 mx-auto shadow-sm" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Student</h5>
                        <p class="card-text">Enrolled Student in SHS.</p>
                        <a href="#" class="btn btn-warning text-white text-center fs-1 fw-bold">
                            20
                        </a>
                    </div>
                </div>
            </div>
        </div>


</main>
 