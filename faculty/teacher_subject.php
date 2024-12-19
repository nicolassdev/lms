<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();


$numberOfSection = $mySQLFunction->checkRowCount("SECTION");

$numberOfStudent = $mySQLFunction->checkRowCount("STUDENT");

$numberOfSubject = $mySQLFunction->checkRowCount("SUBJECT");

$numberOfEnrolled = $mySQLFunction->checkRowCount("ENROLL");

$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');

// GET ASSIGNED SECTION 
$teacherSubjectHandled = $mySQLFunction->getTeacherSubSchedule($_SESSION['teacher_id']);

// // Debug $schedule
// if ($teacherSubjectHandled) {
//     echo "<pre>";
//     print_r($teacherSubjectHandled);
//     echo "</pre>";
// } else {
//     echo "No schedule found!";
// }



// Example teacher ID from session
$result = $mySQLFunction->getAllStudentDetailsByTeacherId($_SESSION['teacher_id']);

if (!empty($result)) {
    foreach ($result as $row) {
        echo "<pre>";
        print_r($row);  // This will output student details, including section and subject
        echo "</pre>";
    }
} else {
    echo "No data found.";
}




//GET THE NUMBER OF ENRLLED IN THAT SECTION
$numberOfEnrolledInSection = $mySQLFunction->checkEnrolledCountByTeacher($_SESSION['teacher_id']); //section handled by teacher

$totalStudentinSection = '0';
foreach ($numberOfEnrolledInSection as $section) {
    $totalStudentinSection = $section['enrolled_count'] ?: '0';
}



$mySQLFunction->disconnect();
?>

<style>
    /* Add card hover effects and modern shadow */
    .card {
        border: 1px solid #e0e0e0;
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
</style>
</head>

<body>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="ms-3">
                <img
                    style="position: absolute; top: 50%; right: 5%; transform: translate(-0%, -45%); 
                    width: 700px; opacity: 0.2; z-index: -1;"
                    src="../assets/img/bg-home.webp"
                    alt="LMS Logo">
                <h5>Subject</h5>
                <div class="container mt-3">
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
                            <!-- Static Data -->
                            <!-- <p>Logged in as : Principal <i class="bi bi-patch-check-fill text-success ms-1"></i></p> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="row g-4">
            <?php if (!empty($teacherSubjectHandled)): ?>
                <?php foreach ($teacherSubjectHandled as $schedule): ?>
                    <!-- Subject Card -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card h-100 border-0 shadow-sm rounded-4">
                            <!-- Card Header Icon -->
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">
                                    <i class="bi bi-book-half me-2"></i>
                                    <?php echo htmlspecialchars($schedule['sub_title'] ?? 'No subject title'); ?>
                                </h6>
                                <span class="badge bg-light text-primary">
                                    <i class="bi bi-award me-1"></i>
                                    <?php echo ucwords(strtolower($schedule["grade_lvl"])) . ' ' . htmlspecialchars($schedule["section_name"]); ?>
                                </span>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body p-4">
                                <!-- Subject Details -->
                                <div class="mb-3 text-secondary">
                                    <i class="bi bi-diagram-2 me-1"></i>
                                    <small>
                                        <b> <?php echo ucwords(strtolower($schedule["strand_desc"] ?? 'No description')); ?></b>
                                    </small>
                                </div>
                                <!-- Icon Indicator -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="bi bi-clock-history me-2 text-warning fs-5"></i>
                                        <span class="fw-semibold">Active Schedule</span>
                                    </div>
                                    <!-- Placeholder for Schedule Badge -->
                                    <span class="badge bg-success px-3 py-2">On-going</span>
                                </div>
                            </div>
                            <!-- Card Footer -->
                            <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                                <a href="?page=student_list" class="btn btn-outline-primary w-100 fw-bold">
                                    <i class="bi bi-person-lines-fill me-2"></i>View Students
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No Data Found Card -->
                <div class="col-12 text-center">
                    <div class="card border-0 shadow-sm rounded-4 py-5">
                        <div class="card-body">
                            <i class="bi bi-exclamation-circle text-danger display-4 mb-3"></i>
                            <h5 class="text-secondary fw-bold">No Subject Available</h5>
                            <p class="text-muted mb-0">There are currently no subjects assigned to you.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>






    </main>