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
        color: #ffffff;
        padding: 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-body {
        padding: 25px;
        font-size: 14px;
        color: #6c757d;
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

    .dropdown-css a {
        font-size: 13px;
    }
</style>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="container-fluid">
                    <h4 class="fw-bold text-muted mb-3 mt-4">
                        Quiz Management
                    </h4>
                    <p class="text-muted">Effortlessly organize subject quizzes, and analyze performance results with ease.</p>
                    <hr>
                    <div class="row g-4">
                        <?php if (!empty($teacherSubjectHandled)): ?>
                            <?php foreach ($teacherSubjectHandled as $schedule): ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card shadow-sm rounded-4 h-100">
                                        <!-- Card Header -->
                                        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center rounded-top-4">
                                            <div class="mb-0 fw-bold text-truncate pt-2 pb-2">
                                                <i class="bi bi-book me-2"></i>
                                                <?php echo htmlspecialchars(ucwords(strtolower($schedule['sub_title'] ?? 'No Title'))); ?>
                                            </div>
                                            <div class="dropdown">
                                                <i class="bi bi-three-dots-vertical text-white " id="kebabMenu" data-bs-toggle="dropdown" aria-expanded="false" role="button"></i>
                                                <ul class="dropdown-menu dropdown-menu-end dropdown-css">
                                                    <li>
                                                        <a href="index.php?page=create_quiz&sched_id=<?php echo urlencode($schedule['sched_id']); ?>&sub_code=<?php echo urlencode($schedule['sub_code']); ?>&section_code=<?php echo urlencode($schedule['section_code']); ?>"
                                                            class="dropdown-item text-black ">
                                                            <i class="bi bi-people-fill me-2 text-danger"></i>View students
                                                        </a>
                                                    </li>
                                                    <hr class="dropdown-divider">
                                                    <li>
                                                        <a class="dropdown-item" href="?page=teacher_quiz">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="text-muted fw-semibold mb-0">

                                                <div class="fw-bold"><?php echo ucwords(strtolower($schedule["grade_lvl"])) . ' ' . htmlspecialchars($schedule["section_name"]); ?></div>
                                            </div>
                                            <small class="text-sm fw-semibold mb-3">
                                                <?php echo   $schedule["strand_desc"] ?? 'No Strand'; ?>
                                            </small>
                                            <div class="text-muted mb-2 mt-4 fw-semibold">
                                                <i class="bi bi-people-fill text-danger"></i> Total Students:
                                                <?php
                                                $mySQLFunction->connection();
                                                $students = $mySQLFunction->getAllStudentBySectionAndSubjectWithModuleUploads($_SESSION['teacher_id'], $schedule['sub_code'], $schedule['section_code']);
                                                $totalStudentinSection = '0';
                                                foreach ($students as $student) {
                                                    $totalStudentinSection = $student['enrolled_count'] ?: '0';
                                                }
                                                $mySQLFunction->disconnect();
                                                echo $totalStudentinSection;
                                                ?>
                                            </div>

                                        </div>

                                        <!-- Card Footer -->
                                        <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                                            <a href="index.php?page=create_quiz&sched_id=<?php echo urlencode($schedule['sched_id']); ?>&sub_code=<?php echo urlencode($schedule['sub_code']); ?>&section_code=<?php echo urlencode($schedule['section_code']); ?>"
                                                class="btn btn-outline-danger w-100 fw-bold">
                                                <i class="bi bi-pencil-square me-2"></i>Create Quiz
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12 text-center py-5">
                                <div class="card">
                                    <div class="card-body">
                                        <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                                        <h5 class="text-secondary fw-bold">No Subject Assigned</h5>
                                        <p class="text-muted">You currently have no assigned subjects. Check with your administrator.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>