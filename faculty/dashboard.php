<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$numberOfTeacher = $mySQLFunction->checkRowCount("teacher");

$numberOfSection = $mySQLFunction->checkRowCount("section");

$numberOfStudent = $mySQLFunction->checkRowCount("student");

$numberOfSubject = $mySQLFunction->checkRowCount("subject");

$numberOfEnrolled = $mySQLFunction->checkRowCount("enroll");

$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');


$teacherSubjectHandled = $mySQLFunction->getTeacherSubjectHandled($_SESSION['teacher_id']); //get subject array in database
// Check if the teacher have subject if not then value is 0
$subjectCount = isset($teacherSubjectHandled['subject_count']) ? $teacherSubjectHandled['subject_count'] : 0;



//section handled by teacher
$numberOfEnrolledInSection = $mySQLFunction->checkEnrolledCountByTeacher($_SESSION['teacher_id']);

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
                <div class="container">
                    <div class="row">
                        <!-- Date and Time Display -->
                        <!-- <div class="col-md-12">
                            <div id="date" class="date-display"></div>
                            <div id="time" class="date-display"></div>
                        </div> -->
                        <div class="date-display mt-3">
                            <?php
                            date_default_timezone_set("Asia/Manila");
                            echo "Today is : " . date("l, M d, Y") . "<br>";
                            echo "Time : "  .  date("h:i A");
                            ?>
                        </div>
                        <!-- School Year and Semester Display -->
                        <div class="col-md-12 text-muted">
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
                            <!-- Info name -->
                            <p>Logged in as :
                                <?php
                                echo ucwords(strtolower($_SESSION['teacher_fname'] . ' ' . $_SESSION['teacher_lname']));
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row g-1 ">




            <!-- Subject Card -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Icon and title -->
                            <div class="" style="margin-left:20px">
                                <i class="bi bi-journal-bookmark-fill display-5 text-primary mb-2"></i>
                                <h5 class="card-title">Subject</h5>
                                <p class="card-text">Total number of subject handled</p>
                            </div>
                            <!-- Number of students -->
                            <div class="text-end">
                                <h1 class="text-primary fw-bold display-5"><?php echo $subjectCount; ?></h1>
                            </div>
                        </div>
                        <hr class="text-muted" />
                        <!-- View account button -->
                        <div class="text-start mt-3 ms-3">
                            <a href="?page=teacher_subject" class="btn btn-primary w-50">View subjects</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teacher Card -->
            <!-- <h1 class="text-success fw-bold display-5"></?php echo $numberOfTeacher; ?></h1> -->
            <!-- <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">

                            <div class="" style="margin-left:20px">
                                <i class="bi bi-people-fill display-5 text-success mb-2"></i>
                                <h5 class="card-title">Faculty</h5>
                                <p class="card-text">Total number of faculty members</p>
                            </div>

                            <div class="text-end">
                                dito ilagay h1
                            </div>
                        </div>
                        <hr class="text-muted" />

                        <div class="text-start mt-3 ms-3">
                            <a href="?page=facultymembers" class="btn btn-success w-70">View faculty members</a>
                        </div>
                    </div>
                </div>
            </div> -->


            <!-- Section Card -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card shadow-lg h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <!-- Icon and title -->
                            <div class="" style="margin-left:20px">
                                <i class="bi bi-people-fill display-5 text-danger mb-2"></i>
                                <h5 class="card-title">Student</h5>
                                <p class="card-text">Total number of students in section</p>
                            </div>
                            <!-- Number of students -->
                            <div class="text-end">
                                <h1 class="text-danger fw-bold display-5"> <?php echo $totalStudentinSection; ?></h1>

                            </div>
                        </div>
                        <hr class="text-muted" />
                        <!-- Manage account button -->
                        <div class="text-start mt-3 ms-3">
                            <a href="?page=section_handled" class="btn btn-danger w-50">View students</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="position-fixed bottom-0 start-50 mb-3">
            <?php
            include "../includes/footer.php";
            ?>
        </div>

    </main>