<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";
$mySQLFunction->connection();
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
            <div class="ms-3">
                <h4>Welcome Back <?php echo ucwords(strtolower($_SESSION["user_role"])); ?> ! </h4>
                <div class="container mt-3">
                    <div class="row">
                        <!-- Date and Time Display -->
                        <div class="col-md-6">
                            <div id="date" class="date-display"></div>
                            <div id="time" class="date-display"></div>
                        </div>

                        <!-- School Year and Semester Display -->
                        <div class="col-md-6 school-semester-info">
                            <?php
                            if (!empty($activeSchoolYears) && !empty($activeSem)) {
                                foreach ($activeSchoolYears as $index => $schoolYear) {
                                    echo '<h6>School Year: ' . htmlspecialchars($schoolYear) . '</h6>';
                                    echo '<h6>Semester: ' . htmlspecialchars($activeSem[$index]) . '</h6>';
                                }
                            } else {
                                echo '<div class="alert alert-warning">No school year and semester found.</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <!-- Account Card -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width:100%;">
                    <div class="card-body">
                        <h5 class="card-title">Account</h5>
                        <p class="card-text">Manage your account here.</p>
                        <a href="?page=admin" class="btn btn-primary text-white text-center btn-animate">
                            Manage Account
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Strand Card -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Strand</h5>
                        <p class="card-text">Manage all strands here.</p>
                        <a href="index.php?page=strand" class="btn btn-primary text-white text-center btn-animate">
                            Manage Strand
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Subject Card -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Subject</h5>
                        <p class="card-text">Manage subjects here.</p>
                        <a href="index.php?page=subject" class="btn btn-primary text-white text-center btn-animate">
                            Manage Subject
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section Card -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Section</h5>
                        <p class="card-text">Manage sections here.</p>
                        <a href="index.php?page=section" class="btn btn-primary text-white text-center btn-animate">
                            Manage Section
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Teachers Card with count -->
            <div class="col-lg-6 col-sm-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Teacher</h5>
                        <p class="card-text">Number of teachers registered.</p>
                        <!-- Morris.js chart for teachers and students -->
                        <div id="teacherChart" style="height: 250px; max-width:100%;"></div>
                    </div>
                </div>
            </div>

            <!-- Students Card with count -->
            <div class="col-lg-6 col-sm-12">
                <div class="card mb-3 mx-auto shadow-sm animate__animated animate__fadeInUp" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Student</h5>
                        <p class="card-text">Number of Senior High School students enrolled.</p>
                        <!-- Morris.js chart for teachers and students -->
                        <div id="studentChart" style="height: 250px; max-width:100%;"></div>
                    </div>
                </div>
            </div>
        </div>

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