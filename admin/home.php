<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
$numberOfTotalUsers = $mySQLFunction->checkRowCount("USERS");

$numberOfStrand = $mySQLFunction->checkRowCount("STRAND");

$numberOfTeacher = $mySQLFunction->checkRowCount("TEACHER");

$numberOfAdviser = $mySQLFunction->checkRowCount("SECTION");

$numberOfStudent = $mySQLFunction->checkRowCount("STUDENT");

$numberOfSubject = $mySQLFunction->checkRowCount("SUBJECT");

$numberOfEnrolled = $mySQLFunction->checkRowCount("ENROLL");

$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
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
                                echo ucwords(strtolower($_SESSION['firstname'] . ' ' . $_SESSION['lastname']));
                                ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <style>
            /* Global Styles */
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

        <div class="container">
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



        <!--       Teachers Card with count
            <div class="col-lg-6 col-sm-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Teacher</h5>
                        <p class="card-text">Number of teachers registered.</p>
                        <div id="teacherChart" style="height: 250px; max-width:100%;"></div>
                    </div>
                </div>
            </div>

            Students Card with count
            <div class="col-lg-6 col-sm-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Student</h5>
                        <p class="card-text">Number of Senior High School students enrolled.</p>
                        <div id="studentChart" style="height: 250px; max-width:100%;"></div>
                    </div>
                </div>
            </div> -->


        <?php
        include "../includes/footer.php";
        ?>
    </main>

    <!-- Time and Date Script -->
    <script>
        function updateTime() {
            var now = new Date();
            var timeString = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
            var dateString = now.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                weekday: 'long'
            });

            document.getElementById('time').innerHTML = 'Time: ' + timeString;
            document.getElementById('date').innerHTML = 'Today is: ' + dateString;
        }

        setInterval(updateTime, 1000); // Update time every second
        updateTime(); // Initial call
    </script>

    <!-- Morris.js Chart Script -->
    <script>
        $(document).ready(function() {
            new Morris.Donut({
                element: 'teacherChart',
                data: [{
                        label: 'Teacher',
                        value: <?php echo $numberOfTeacher; ?>
                    },
                    {
                        label: 'Adviser',
                        value: <?php echo $numberOfAdviser; ?>
                    },
                    {
                        label: 'Subject',
                        value: <?php echo $numberOfSubject; ?>
                    }
                ],
                colors: ['#D91656', '#640D5F', '#180161'],
                resize: true
            });
        });

        $(document).ready(function() {
            new Morris.Donut({
                element: 'studentChart',
                data: [{

                        label: 'Student',
                        value: <?php echo $numberOfStudent; ?>
                    },
                    {
                        label: 'Section',
                        value: <?php echo $numberOfAdviser; ?>
                    },
                    {
                        label: 'Enrolled',
                        value: <?php echo $numberOfEnrolled; ?>
                    }
                ],
                colors: ['#F3C623', '#EB8317', '#00FF9C'],
                resize: true
            });
        });
    </script>