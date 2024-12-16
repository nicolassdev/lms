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
            <?php if (!empty($teacherSectionHandled)): ?>

                <!-- Section Card -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="card shadow-lg h-100 border-0">
                        <div class="card-body">
                            <!-- Card Header -->
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <!-- Icon and Title -->
                                <div>
                                    <i class="bi bi-journal-bookmark-fill display-5 text-primary mb-2"></i>
                                    <h5 class="card-title mt-2 mb-1 fw-bold text-secondary">
                                        Practical Research
                                    </h5>
                                    <small class="card-subtitle text-muted">
                                        <?php
                                        echo ucwords(strtolower($teacherSectionHandled["grade_lvl"])) . ' ' . $teacherSectionHandled["section_name"];
                                        ?>
                                    </small>
                                    <br>
                                    <small class="card-subtitle text-muted">
                                        <!-- Placeholder for strand_name if available -->
                                        <?php echo  ucwords(strtolower($teacherSectionHandled["strand_desc"])) ?? ''; ?>
                                    </small>
                                </div>
                                <!-- Number of Students -->
                                <div class="text-end">
                                    <h1 class="text-primary fw-bold display-6 mb-0">
                                        <?php echo $totalStudentinSection; ?>
                                    </h1>
                                    <small class="text-muted">Students</small>
                                </div>
                            </div>
                            <!-- Divider -->
                            <hr class="text-muted" />
                            <!-- Card Footer -->
                            <div class="text-start">
                                <a href="?page=student_list" class="btn btn-primary w-100 py-2">View</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- Error Message Card -->
                <div class="col-12">
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="card shadow-lg h-100 border-0">
                            <div class="card-body text-center">
                                <i class="bi bi-exclamation-circle display-4 text-warning"></i>
                                <h5 class="card-title mt-3 fw-bold text-secondary">No Subject Available</h5>
                                <p class="card-text text-muted">There are currently no subject assigned to you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>





    </main>