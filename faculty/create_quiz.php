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
        font-size: 0.7em;
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
                        <table id="quizTable" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" style="width: 50px;">#</th>
                                    <th scope="col" style="width: 150px;">Student Name</th>
                                    <th scope="col" style="width: 100px;">Gender</th>
                                    <th scope="col" style="width: 100px;">Status</th>

                                    <?php
                                    // this function is base in the table count of the quiz 
                                    // NOTE: IF HOW MANY NUMBER OF THE FACULTY CREATED QUIZ THE NUMBER OF TABLE IN QUIZ NUMBER IN TABLE,
                                    $numberOfQuiz = $mySQLFunction->checkRowCount("quiz", 'sched_id', $sched_id);

                                    // Dynamically add Quiz Columns based on the highest quiz count
                                    $maxQuiz = $numberOfQuiz; // Set max quiz count (or you can calculate it dynamically)
                                    for ($i = 1; $i <= $maxQuiz; $i++) {
                                        echo "<th scope='col' class='text-center'>Quiz $i Score</th>";
                                        echo "<th scope='col' class='text-center'>Quiz $i Items</th>";
                                        echo "<th scope='col' class='text-center'>Quiz $i Equivalent</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($students)) {
                                    $count = 1;
                                    foreach ($students as $row) {
                                        $scores = !empty($row['quiz_scores']) ? explode(',', $row['quiz_scores']) : [];
                                        $items = !empty($row['quiz_items']) ? explode(',', $row['quiz_items']) : [];
                                        $equivalents = !empty($row['equivalent_quiz']) ? explode(',', $row['equivalent_quiz']) : [];


                                        $isCurrentQuarter = in_array($row["quarter_quiz"], explode(",", implode(",", $activeQuarter)));
                                        $status = (!empty($row['quiz_scores']) && count($scores) > 0);

                                        echo '<tr>';
                                        echo '<td class="text-center fw-bold">' . $count . '</td>';
                                        echo '<td class="text-center">' . $row["stu_lname"] . ', ' . ucwords(strtolower($row["stu_fname"])) . '</td>';
                                        echo '<td class="text-center">' . ucwords(strtolower($row["stu_gender"])) . '</td>';

                                        echo '<td class="text-center">';
                                        if ($isCurrentQuarter) {
                                            if ($status) {
                                                echo '<span style="background-color: #198754; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;">Done</span>';
                                            } else {
                                                echo '<span style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;">N/A</span>';
                                            }
                                        } else {
                                            echo '<span style="background-color:gray; color: white; padding: 5px 10px; border-radius: 15px; display: inline-block;">No Avalable Quiz</span>';
                                        }
                                        echo '</td>';

                                        // Display Quiz Scores
                                        if ($isCurrentQuarter) {
                                            $scores = !empty($scores) ? array_reverse($scores) : [];
                                            $items = !empty($items) ? array_reverse($items) : [];
                                            $equivalents = !empty($equivalents) ? array_reverse($equivalents) : [];
                                        
                                            for ($i = 0; $i < $maxQuiz; $i++) {
                                                echo '<td class="text-center text-success fw-semibold">' . ($status && isset($scores[$i]) ? htmlspecialchars($scores[$i]) : '-') . '</td>';
                                                echo '<td class="text-center text-success fw-semibold">' . ($status && isset($items[$i]) ? htmlspecialchars($items[$i]) : '-') . '</td>';
                                                echo '<td class="text-center text-success fw-semibold">' . ($status && isset($equivalents[$i]) ? htmlspecialchars($equivalents[$i]) : '-') . '</td>';
                                            }
                                            
                                        } else {
                                            for ($i = 0; $i < $maxQuiz; $i++) {
                                                echo '<td class="text-center text-muted">-</td>';
                                                echo '<td class="text-center text-muted">-</td>';
                                                echo '<td class="text-center text-muted">-</td>';
                                            }
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
    initializeDataTable("quizTable", 10, "Student taken exam");
</script>