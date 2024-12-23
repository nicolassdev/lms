<?php
// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}

include "../includes/dbh-inc.php";

$mySQLFunction->connection();

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
        /* margin-bottom: 20px; */
        padding-top: 30px;
        padding-bottom: 20px;
        letter-spacing: 1px;
        padding-left: 10px;
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

    .btn {
        border-radius: 30px;
    }

    .text-secondary {
        ''
        font-size: 12px;
        color: #6c757d;
    }

    .badge {
        font-size: 14px;
        padding: 5px 10px;
    }

    .no-subject {
        color: #6c757d;
        font-size: 18px;
        font-weight: bold;
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
    <h5>Subjects</h5>
    <div class="row g-4">
        <?php if (!empty($teacherSubjectHandled)): ?>
            <?php foreach ($teacherSubjectHandled as $schedule): ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">
                                <i class="bi bi-book-half me-2"></i>
                                <?php echo htmlspecialchars($schedule['sub_title'] ?? 'No Title'); ?>
                            </h6>
                            <span class="badge bg-light text-primary">
                                <i class="bi bi-award"></i>
                                <?php echo ucwords(strtolower($schedule["grade_lvl"])) . ' ' . htmlspecialchars($schedule["section_name"]); ?>
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="mb-3 text-secondary">
                                <i class="bi bi-diagram-2 me-1"></i>
                                <small>
                                    <b><?php echo ucwords(strtolower($schedule["strand_desc"] ?? 'No Strand')); ?></b>
                                </small>
                            </div>Every
                            <?php echo ucwords(strtolower($schedule["sched_day"] ?? 'No schedule day')); ?>
                            <div>
                                <i class="bi bi-clock-history text-warning fs-6 me-1"></i>
                                <?php
                                echo
                                $schedule["sched_from"] && $schedule["sched_to"]
                                    ? $schedule["sched_from"] . ' - ' . $schedule["sched_to"]
                                    : 'No set time for this subject';
                                ?>

                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                            <a href="index.php?page=student_subject_list&sub_code=<?php echo urlencode($schedule['sub_code']); ?>&section_code=<?php echo urlencode($schedule['section_code']); ?>"
                                class="btn btn-outline-primary w-100 fw-bold">
                                <i class="bi bi-person-lines-fill me-2"></i>View Students
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <div class="py-5 mt-5">
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