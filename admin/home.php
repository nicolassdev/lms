<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$numberOfTeacher = $mySQLFunction->checkRowCount("TEACHER");
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$mySQLFunction->disconnect();
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="ms-3">
            <h4>Welcome Back!</h4>
            <div class="container mt-3">
                <div class="row">
                    <!-- Date and Time Display -->
                    <div class="col-md-6">
                        <?php
                        date_default_timezone_set("Asia/Manila");
                        echo '<div class="date-display">Today is ' . date("M d, Y l") . '</div>';
                        echo '<div class="date-display">Time ' . date("h:i A") . '</div>';
                        ?>
                    </div>

                    <!-- School Year and Semester Display -->
                    <div class="col-md-6">
                        <?php
                        if (!empty($activeSchoolYears) && !empty($activeSem)) {
                            // Assuming both arrays have the same length and represent corresponding data
                            foreach ($activeSchoolYears as $index => $schoolYear) {
                                echo '<div class="date-display">School Year: ' . htmlspecialchars($schoolYear) . '</div>';
                                echo '<div class="date-display">Semester: ' . htmlspecialchars($activeSem[$index]) . '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-warning">No school year or semester found.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row g-3">
        <!-- Example Cards -->
        <div class="col-md-3 col-sm-6 col-12">
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

        <div class="col-md-3 col-sm-6 col-12">
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

        <div class="col-md-3 col-sm-6 col-12">
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

        <div class="col-md-3 col-sm-6 col-12">
            <div class="card mb-3 mx-auto shadow-sm" style="max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Section</h5>
                    <p class="card-text">Manage section an here.</p>
                    <a href="#" class="btn btn-secondary text-white text-center">
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
                    <p class="card-text">Number of enrolled student in SHS.</p>
                    <a href="#" class="btn btn-warning text-white text-center fs-1 fw-bold">
                        20
                    </a>
                </div>
            </div>
        </div>
    </div>


</main>