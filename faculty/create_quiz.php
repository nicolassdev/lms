<?php
include "../includes/dbh-inc.php";

// Prevent unauthorized access
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit;
}

$mySQLFunction->connection();
if (!empty($_GET['sched_id']) && !empty($_GET['sub_code']) && !empty($_GET['section_code'])) {
    $sched_id = $_GET['sched_id'];
    $sub_code = $_GET['sub_code'];
    $section_code = $_GET['section_code'];



    // Fetch students by subject handled of teacher 
    $students = $mySQLFunction->getAllStudentBySectionAndSubjectWithModuleUploads($_SESSION['teacher_id'], $sub_code, $section_code);
    // echo "<pre>";
    // print_r($students);
    // echo "</pre>";
    $activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');
}


include "../faculty/includes/Forms/createquizform.php";
?>

<style>
    .data-table {
        font-size: 0.8em;
        /* Reduce font size */
    }

    .table th,
    .table td {
        padding: 0.1rem;
        /* Adjust padding */
    }
</style>

<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 ms-3 me-3">
                        <!-- Grade Level and Section and Subject-->
                        <div>
                            <!-- Display Subject Title -->
                            <h6 class="fw-bold text-primary">
                                <!-- Subject: -->
                                <?php
                                if (!empty($students)) {
                                    foreach ($students as $student) {
                                        echo htmlspecialchars($student["sub_title"]); // Display subject title
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Grade Level and Section -->
                            <h6 class="fw-semibold mt-1">
                                <?php
                                if (!empty($students)) {
                                    foreach ($students as $student) {
                                        echo htmlspecialchars($student["grade_lvl"]) . ' - ';
                                        echo htmlspecialchars($student["section_name"]);
                                        break; // Exit the loop after processing the first student
                                    }
                                }
                                ?>
                            </h6>

                            <!-- Student Count -->
                            <?php if (!empty($students)) : ?>
                                <h6 class="fw-semibold"><?php echo count($students); ?> Student(s)</h6>
                            <?php else : ?>
                                <h6 class="text-secondary fw-semibold mt-1">0 Student(s)</h6>
                            <?php endif; ?>


                        </div>

                        <!-- View Exam Button -->
                        <div class="d-flex gap-2 ms-2">
                            <div>
                                <a class="btn btn-primary fw-bold btn-sm btn-animate"
                                    href="index.php?page=created_quiz_list&sched_id=<?php echo urlencode($_GET['sched_id']); ?>&sub_code=<?php echo urlencode($_GET['sub_code']); ?>&section_code=<?php echo urlencode($_GET['section_code']); ?>">
                                    <span>View Quiz</span>
                                </a>
                            </div>

                            <!-- Upload Button -->
                            <div>
                                <?php
                                $btnClass = empty($students) ? 'btn-primary' : 'btn-primary';
                                $disabled = empty($students) ? 'disabled' : '';
                                ?>
                                <button type="button"
                                    class="btn <?php echo $btnClass; ?> btn-sm fw-bold d-flex align-items-center"
                                    data-bs-toggle="modal"
                                    data-bs-target="#create_quiz"
                                    data-bs-whatever="@fat"
                                    <?php echo $disabled; ?>>
                                    <i class="bi-plus-circle me-1"></i>Create Quiz
                                </button>
                            </div>
                        </div>
                    </div>



                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 100px;">Full name</th>
                                    <th scope="col" style="width: 50px;">Gender</th>
                                    <th scope="col" style="width: 100px;">Status</th>
                                    <th scope="col" style="width: 100px;">Score</th>
                                    <th scope="col" style="width: 100px;">Total Items</th>
                                    <th scope="col" style="width: 100px;">Transmutation Grade</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($students)) {
                                    $count = 1;
                                    foreach ($students as $row) {
                                        // Split the file names into an array
                                        $scores = explode(',', $row['quiz_scores'] ?? '');

                                        // Determine if the student's quarter matches the active quarter
                                        $isCurrentQuarter = in_array($row["quarter"], explode(",", implode(",", $activeQuarter)));

                                        // Determine status
                                        $status = (!empty($row['quiz_scores']) && count($scores) > 0);

                                        echo '<tr>';
                                        echo '<td class="text-center fw-bold">' . $count . '</td>';
                                        echo '<td class="text-center">' . $row["stu_lname"] . ', ' . ucwords(strtolower($row["stu_fname"])) . ' </td>';
                                        echo '<td class="text-center">' . ucwords(strtolower($row["stu_gender"])) . '</td>';

                                        echo '<td class="text-center">';
                                        if ($isCurrentQuarter) {
                                            if ($status) {
                                                echo '<span class="badge bg-success" data-bs-toggle="tooltip" title="Exam Completed"><i class="bi bi-check-circle"></i> Done</span>';
                                            } else {
                                                echo '<span class="badge bg-danger" data-bs-toggle="tooltip" title="No Exam Uploaded"><i class="bi bi-x-circle"></i> No Exam</span>';
                                            }
                                        } else {
                                            // Default to "No Exam" if quarter does not match
                                            echo '<span class="badge bg-danger" data-bs-toggle="tooltip" title="No Exam Available"><i class="bi bi-x-circle"></i> No Exam</span>';
                                        }
                                        echo '</td>';

                                        // Hide exam scores, total items, and equivalent if quarter does not match
                                        if ($isCurrentQuarter) {
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['quiz_scores']) : '0') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['quiz_items']) : '0') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . ($status ? htmlspecialchars($row['equivalent']) : '0') . '</td>';
                                        } else {
                                            echo '<td class="text-center text-muted">-</td>';
                                            echo '<td class="text-center text-muted">-</td>';
                                            echo '<td class="text-center text-muted">-</td>';
                                        }

                                        echo '</tr>';
                                        $count++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("../faculty/includes/extension.php");
    ?>
</main>
<!-- PDF ,EXCEL, PRINT ,CVS -->
<script src="../assets/js/globaltables.js"></script>
<script>
    initializeDataTable("example", 10, "Student taken exam");
</script>