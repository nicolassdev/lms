<?php
// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}
if (!isset($_SESSION['username'])) {
    header("location:../login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'teacher') {
        header("location:../login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:../login.php"); // Redirect to login page if user role is not exist 
    exit();
}
?>

<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();


$numberOfSection = $mySQLFunction->checkRowCount("section");

$numberOfStudent = $mySQLFunction->checkRowCount("student");

$numberOfSubject = $mySQLFunction->checkRowCount("subject");

$numberOfEnrolled = $mySQLFunction->checkRowCount("enroll");

$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');

// GET ASSIGNED SECTION 
$teacherSectionHandled = $mySQLFunction->getTeacherSectionHandled($_SESSION['teacher_id']);


//GET THE NUMBER OF ENRLLED IN THAT SECTION
$numberOfEnrolledInSection = $mySQLFunction->checkEnrolledCountByTeacher($_SESSION['teacher_id']); //section handled by teacher

$totalStudentinSection = '0';
foreach ($numberOfEnrolledInSection as $section) {
    $totalStudentinSection = $section['enrolled_count'] ?: '0';
}



$mySQLFunction->disconnect();
?>

<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
</style>

<body>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="ms-3">
                <img
                    style="position: absolute; top: 50%; right: 5%; transform: translate(-0%, -45%); 
                    width: 700px; opacity: 0.1; z-index: -1;"
                    src="../assets/img/bg-home.webp"
                    alt="LMS Logo">
                <div class="container mt-4">
                    <h4 class="fw-bold text-muted mb-3">
                        Section
                    </h4>
                    <div class="">

                        <!-- School Year and Semester Display -->
                        <div class="col-md-12 date-display row">
                            <?php
                            if (!empty($activeSchoolYears) && !empty($activeSem)) {
                                foreach ($activeSchoolYears as $index => $schoolYear) {
                                    echo '<div>Semester: ' . htmlspecialchars($activeSem[$index]) . '<i class="bi bi-check-circle-fill text-success ms-2"></i> </div>';
                                    echo '<div>School Year: ' . htmlspecialchars($schoolYear) . '<i class="bi bi-check-circle-fill text-success ms-2"></i></div>';
                                }
                            } else {
                                echo '<div class="alert alert-warning" style="font-size: small;">No active school year and semester found.</div>';
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>




        <div class="row g-4">
            <?php if (!empty($teacherSectionHandled)): ?>
                <!-- Section Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100 border-0 shadow-lg rounded-4 py-3">
                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column justify-content-between">
                            <!-- Card Header -->
                            <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
                                <!-- Icon and Title -->
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-bank display-4 text-danger me-3"></i>
                                    <div>
                                        <h5 class="fw-bold text-secondary mb-1">
                                            <?php echo htmlspecialchars($teacherSectionHandled["section_name"]); ?>
                                        </h5>
                                        <small class="text-muted">
                                            <?php echo ucwords(strtolower($teacherSectionHandled["grade_lvl"])) . ' | ' .
                                                htmlspecialchars($teacherSectionHandled["strand_desc"] ?? ''); ?>
                                        </small>
                                    </div>
                                </div>
                                <!-- Number of Students -->
                                <div class="text-end me-2">
                                    <h2 class="text-danger fw-bold mb-0">
                                        <?php echo $totalStudentinSection; ?>
                                    </h2>
                                    <small class="text-muted">Students</small>
                                </div>
                            </div>

                            <!-- Divider -->
                            <hr class="text-muted" />

                            <!-- Card Footer -->
                            <div class="text-center mt-auto">
                                <a href="?page=student_list" class="btn btn-outline-danger fw-semibold w-100 py-2 rounded-pill">
                                    <i class="bi bi-eye me-2"></i>View Students
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- No Data Found Card -->
                <div class="col-12 text-center">
                    <div class="py-5 mt-5">
                        <div class="card-body">
                            <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                            <h5 class="text-secondary fw-bold">No Section Available</h5>
                            <p class="text-muted mb-0">There are currently no sections assigned to you. Check with your administrator.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>



    </main>