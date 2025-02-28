<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$numberOfTotalUsers = $mySQLFunction->checkRowCount("users");

$numberOfStrand = $mySQLFunction->checkRowCount("strand");

$numberOfTeacher = $mySQLFunction->checkRowCount("teacher");

$numberOfAdviser = $mySQLFunction->checkRowCount("section");

$numberOfStudent = $mySQLFunction->checkRowCount("student");

$numberOfSubject = $mySQLFunction->checkRowCount("subject");

$numberOfEnrolled = $mySQLFunction->checkRowCount("enroll");

$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');
$mySQLFunction->disconnect();
?>

<style>
    /* Add card hover effects and modern shadow */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card i {
        font-size: 2.5rem;
        /* Smaller icons */
    }

    .btn {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .text-muted {
        font-size: 0.85rem;
        /* Slightly smaller text */
    }

    .fs-4 {
        font-size: 1.5rem !important;
        /* Consistent number size */
    }

    /* Responsive Padding */
    @media (max-width: 576px) {
        .card-body {
            padding: 1rem !important;
        }
    }
</style>
</head>

<body>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-3">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <div class="ms-1">
                <img
                    style="position: absolute; top: 50%; right: 5%; transform: translate(-0%, -45%); 
                    width: 500px; opacity: 0.1; z-index: -1;"
                    src="../assets/img/csi.webp"
                    alt="LMS Logo">
                <div class="container">
                    <div class="row">
                        <!-- Date and Time Display -->
                        <!-- 
                        <div id="date" class="date-display"></div>
                        <div id="time" class="date-display"></div> -->
                        <div class="date-display">
                            <?php
                            date_default_timezone_set("Asia/Manila");
                            echo "Today is : " . date("l, M d, Y") . "<br>";
                            echo "Time : "  .  date("h:i A");
                            ?>
                        </div>

                        <!-- School Year and Semester Display -->
                        <div class="col-md-12 date-display">
                            <?php
                            if (!empty($activeSchoolYears) && !empty($activeSem) && !empty($activeQuarter)) {
                                foreach ($activeSchoolYears as $index => $schoolYear) {
                                    echo '<div>Quarterly: ' . htmlspecialchars($activeQuarter[$index]) . '<i class="bi bi-check-circle-fill text-success ms-2"></i> </div>';
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
                                echo ucwords(strtolower($_SESSION['firstname'] . ' ' . $_SESSION['lastname']));
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <style>

        </style>

        <div class="container fade-in-input">
            <div class="row g-4">

                <!-- Account Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-lg border-0 h-100 rounded-4">
                        <div class="card-body text-center d-flex flex-column p-4">
                            <i class="bi bi-person-lines-fill text-primary display-3 mb-3"></i>
                            <h5 class="fw-bold text-dark">Accounts</h5>
                            <p class="text-muted small mb-3">Manage users' accounts easily.</p>
                            <p class="fs-4 text-primary fw-bold mb-4">
                                <?php echo htmlspecialchars($numberOfTotalUsers); ?>
                            </p>
                            <a href="?page=users" class="btn btn-outline-primary mt-auto rounded-pill fw-semibold">
                                <i class="bi bi-gear-fill me-1"></i> Manage Accounts
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Strand Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-lg border-0 h-100 rounded-4">
                        <div class="card-body text-center d-flex flex-column p-4">
                            <i class="bi bi-mortarboard text-success display-3 mb-3"></i>
                            <h5 class="fw-bold text-dark">Strands</h5>
                            <p class="text-muted small mb-3">Organize strands efficiently.</p>
                            <p class="fs-4 text-success fw-bold mb-4">
                                <?php echo htmlspecialchars($numberOfStrand); ?>
                            </p>
                            <a href="?page=strand" class="btn btn-outline-success mt-auto rounded-pill fw-semibold">
                                <i class="bi bi-pencil me-1"></i> Manage Strands
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Subject Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-lg border-0 h-100 rounded-4">
                        <div class="card-body text-center d-flex flex-column p-4">
                            <i class="bi bi-journal-bookmark text-danger display-3 mb-3"></i>
                            <h5 class="fw-bold text-dark">Subjects</h5>
                            <p class="text-muted small mb-3">Manage subjects effortlessly.</p>
                            <p class="fs-4 text-danger fw-bold mb-4">
                                <?php echo htmlspecialchars($numberOfSubject); ?>
                            </p>
                            <a href="?page=subject" class="btn btn-outline-danger mt-auto rounded-pill fw-semibold">
                                <i class="bi bi-book-half me-1"></i> Manage Subjects
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Section Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-lg border-0 h-100 rounded-4">
                        <div class="card-body text-center d-flex flex-column p-4">
                            <i class="bi bi-building-fill text-warning display-3 mb-3"></i>
                            <h5 class="fw-bold text-dark">Sections</h5>
                            <p class="text-muted small mb-3">Handle sections easily.</p>
                            <p class="fs-4 text-warning fw-bold mb-4">
                                <?php echo htmlspecialchars($numberOfAdviser); ?>
                            </p>
                            <a href="?page=section" class="btn btn-outline-warning mt-auto rounded-pill fw-semibold">
                                <i class="bi bi-columns me-1"></i> Manage Sections
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Teacher Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-lg border-0 h-100 rounded-4">
                        <div class="card-body text-center d-flex flex-column p-4">
                            <i class="bi bi-person-video3 text-info display-3 mb-3"></i>
                            <h5 class="fw-bold text-dark">Faculty</h5>
                            <p class="text-muted small mb-3">Manage faculty details.</p>
                            <p class="fs-4 text-info fw-bold mb-4">
                                <?php echo htmlspecialchars($numberOfTeacher); ?>
                            </p>
                            <a href="?page=section" class="btn btn-outline-info mt-auto rounded-pill fw-semibold">
                                <i class="bi bi-person-check-fill me-1"></i> Manage Faculty
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Student Card -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow-lg border-0 h-100 rounded-4">
                        <div class="card-body text-center d-flex flex-column p-4">
                            <i class="bi bi-people text-secondary display-3 mb-3"></i>
                            <h5 class="fw-bold text-dark">Students</h5>
                            <p class="text-muted small mb-3">Manage enrolled students.</p>
                            <p class="fs-4 text-secondary fw-bold mb-4">
                                <?php echo htmlspecialchars($numberOfStudent); ?>
                            </p>
                            <a href="?page=student" class="btn btn-outline-secondary mt-auto rounded-pill fw-semibold">
                                <i class="bi bi-person-rolodex me-1"></i> Manage Students
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>



        <?php
        include "../includes/footer.php";
        ?>
    </main>