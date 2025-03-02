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


include "../faculty/includes/Forms/createexamform.php";
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

<main class="col-md-12 ms-sm-auto col-lg-10 px-md-3 mt-5 py-4 me-2">
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
                                    href="index.php?page=created_exam_list&sched_id=<?php echo urlencode($_GET['sched_id']); ?>&sub_code=<?php echo urlencode($_GET['sub_code']); ?>&section_code=<?php echo urlencode($_GET['section_code']); ?>">
                                    <span>View Exam</span>
                                </a>
                            </div>



                            <!-- Upload Button -->
                            <?php
                            // Fetch schedule ID (Make sure you get this from the right context)
                            $sched_id = $_GET['sched_id']; // Adjust as needed

                            // Check if an exam exists for the schedule in the active quarter
                            $examExists = $sched_id ? $mySQLFunction->checkExistExam($sched_id) : false;
                            // Check if students are available
                            $studentsAvailable = !empty($students);
                            // Determine button state
                            $btnClass = ($examExists || !$studentsAvailable) ? 'btn-primary' : 'btn-primary';
                            $disabled = ($examExists || !$studentsAvailable) ? 'disabled' : '';
                            ?>
                            <!-- Upload Button -->
                            <div>
                                <button type="button"
                                    class="btn <?php echo $btnClass; ?> btn-sm fw-bold d-flex align-items-center"
                                    data-bs-toggle="modal"
                                    data-bs-target="#create_exam"
                                    data-bs-whatever="@fat"
                                    <?php echo $disabled; ?>>
                                    <i class="bi-plus-circle me-1"></i> Create Exam
                                </button>
                            </div>


                        </div>
                    </div>



                    <!-- STUDENT DETAILS -->
                    <div class="table-responsive small ms-3 me-1">
                        <table id="studenttakeexam" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 100px;">Student Name</th>
                                    <th scope="col" style="width: 50px;">Quarter</th>
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
                                        // if ($activeQuarter) {
                                        // }

                                        // Determine if the student's quarter matches the active quarter
                                        $isCurrentQuarter = in_array($row["quarter_exam"], explode(",", implode(",", $activeQuarter)));

                                        // Determine if an exam was taken (regardless of score)
                                        $examTaken = !empty($row['exam_items']); // Check if exam_items has a value

                                        echo '<tr>';
                                        echo '<td class="text-center fw-bold">' . $count . '</td>';
                                        echo '<td class="text-center">' . $row["stu_lname"] . ', ' . ucwords(strtolower($row["stu_fname"])) . ' </td>';

                                        foreach ($activeQuarter as $quarter) {
                                            echo '<td class="text-center">'  . ucwords(strtolower($quarter)) . ' </td>';
                                        }

                                        echo '<td class="text-center">';
                                        if ($isCurrentQuarter) {
                                            if ($examTaken) {
                                                echo '<span style="background-color: #198754; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;" title="Exam Completed">Done</span>';
                                            } else {
                                                echo '<span style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;" title="No Exam Uploaded">No Exam</span>';
                                            }
                                        } else {
                                            echo '<span style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;" title="No Exam Available">No Exam</span>';
                                        }
                                        echo '</td>';

                                        // Display scores, items, and equivalent if the quarter matches, regardless of score
                                        if ($isCurrentQuarter) {
                                            echo '<td class="text-center text-success fw-bold">' . htmlspecialchars($row['exam_scores'] ?? '0') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . htmlspecialchars($row['exam_items'] ?? '0') . '</td>';
                                            echo '<td class="text-center text-success fw-bold">' . htmlspecialchars($row['equivalent_exam'] ?? '0') . '</td>';
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
    initializeDataTable("studenttakeexam", 7, "Student taken exam");
</script>