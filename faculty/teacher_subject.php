<?php
// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}

include "../includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
// Get teacher's assigned subjects
$teacherSubjectHandled = $mySQLFunction->getTeacherSubSchedule($_SESSION['teacher_id']);

// Disconnect DB
$mySQLFunction->disconnect();
?>

<!-- Style for the cards and layout -->
<style>
    h5 {
        color: #495057;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .card {
        border: 1px solid #e0e0e0;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
        background-color: #ffffff;
    }

    .card:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transform: scale(1.02);
    }

    .card-header {
        background-color: #0069d9;
        color: #ffffff;
        padding: 15px;
        font-size: 14px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 30px;
        font-size: 14px;
        color: #6c757d;
    }

    .card-footer {
        padding: 10px;
        border-top: 1px solid #e0e0e0;
        background-color: #f8f9fa;
    }

    small {
        font-size: 14px;
    }



    .text-secondary {

        font-size: 12px;
        color: #6c757d;
    }

    .badge {
        font-size: 12px;
        padding: 5px 10px;
    }

    .no-subject {
        color: #6c757d;
        font-size: 18px;
        font-weight: bold;
    }

    .dropdown-menu {
        transition: transform 0.4s ease, opacity 0.4s ease;
        transform: translateY(-10px);
        /* opacity: 0; */
    }

    .dropdown.show .dropdown-menu {
        transform: translateY(0);
        opacity: 1;
    }

    .dropdown-menu a {
        font-size: 13px;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="ms-3">
            <img
                style="position: absolute; top: 50%; right: 5%; transform: translate(-0%, -45%); 
                    width: 700px; opacity: 0.1; z-index: -1;"
                src="../assets/img/bg-home.webp"
                alt="LMS Logo">
            <div class="container mt-4">
                <h5>Subjects </h5>
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
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100 border-0 shadow-lg rounded-4">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                            <h6 class="mb-0 fw-bold text-truncate">
                                <i class="bi bi-book-half me-2"></i>
                                <?php echo htmlspecialchars(ucwords(strtolower($schedule['sub_title'] ?? 'No Title'))); ?>
                            </h6>
                            <!-- Kebab Menu -->
                            <div class="dropdown">
                                <i class="bi bi-three-dots-vertical text-white" id="kebabMenu" data-bs-toggle="dropdown" role="button" aria-expanded="false" style="cursor: pointer;"></i>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="kebabMenu">
                                    <li>
                                        <a class="dropdown-item text-black" href="#" onclick="confirmDelete()">Move</a>
                                    </li>
                                    <hr class="me-2 ms-2">
                                    <li>
                                        <a class="dropdown-item text-black" href="#" onclick="cancelAction()">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-award text-danger fs-2 me-2"></i>
                                <span class="fw-bold fs-5"><?php echo ucwords(strtolower($schedule["grade_lvl"])) . ' ' . htmlspecialchars($schedule["section_name"]); ?></span>
                            </div>
                            <div class="text-secondary mb-3 d-flex align-items-center">
                                <!-- <i class="bi bi-diagram-2 text-info fs-6 me-3"></i> -->
                                <small class="fw-semibold"><?php echo  $schedule["strand_desc"] ?? 'No Strand'; ?></small>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-people-fill text-primary fs-6 me-2"></i>
                                <span class="fw-semibold">Total Students: <?php
                                                                            // Get total count for each student in subject handled by teacher
                                                                            $mySQLFunction->connection();
                                                                            $students = $mySQLFunction->getAllStudentBySectionAndSubject($_SESSION['teacher_id'], $schedule['sub_code'], $schedule['section_code']);
                                                                            $totalStudentinSection = '0';
                                                                            foreach ($students as $student) {
                                                                                $totalStudentinSection = $student['enrolled_count'] ?: '0';
                                                                            }
                                                                            $mySQLFunction->disconnect();
                                                                            echo $totalStudentinSection;
                                                                            ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 text-success fs-6 me-2"></i>
                                <span>
                                    <?php
                                    echo ucwords(strtolower($schedule["sched_day"])) . ' ' .
                                        ($schedule["sched_from"] && $schedule["sched_to"]
                                            ? $schedule["sched_from"] . ' - ' . $schedule["sched_to"]
                                            : 'No schedule time');
                                    ?>
                                </span>

                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                            <a href="index.php?page=student_subject_list&sub_code=<?php echo urlencode($schedule['sub_code']); ?>&section_code=<?php echo urlencode($schedule['section_code']); ?>"
                                class="btn btn-outline-primary w-100 fw-bold d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-lines-fill me-2"></i> View Students
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="py-5">
                    <div class="card-body">
                        <i class="bi bi-exclamation-circle text-danger display-4 mb-3"></i>
                        <h5 class="text-secondary fw-bold no-subject">No Subject Available</h5>
                        <p class="text-muted mb-0">There are currently no subjects assigned to you.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>



</main>
<!-- This is post method -->
<!-- <form action="index.php?page=student_subject_list" method="POST" class="d-inline">
    <input type="hidden" name="sub_code" value=" ">
    <input type="hidden" name="section_code" value=" ">
    <button type="submit" class="btn btn-outline-primary w-100 fw-bold">
        <i class="bi bi-person-lines-fill me-2"></i>View Students
    </button>
</form> -->