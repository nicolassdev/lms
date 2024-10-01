<?php
include "../includes/dbh-inc.php";
?>

<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/enrollmentform.php";
?>





<!-- TABLE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h3 class="text-black">List of Enrolled Student</h3>


                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enroll" data-bs-whatever="@fat">
                            <i class="bi bi-person-plus-fill me-1"></i>Enroll Student
                        </button>
                    </div>


                    <div class="table-responsive small ms-3 me-3">
                        <table class="table table-bordered table-striped table-sm align-middle">
                            <!-- NOTIFICATION -->
                            <?php
                            if (isset($_SESSION['deleted'])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1200px;">';
                                echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];

                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                                // Reduced font size for the timestamp
                                echo '<small class="d-block mt-1 text-muted ms-4">Just now.</small>';

                                echo '</div>';
                                unset($_SESSION['deleted']);
                            }
                            ?>
                            <thead class="table-dark text-light">
                                <tr>
                                    <th scope="col">Student name</th>
                                    <th scope="col">Strand</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">SY</th>
                                    <th scope="col">Date Enrolled</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Current School</th>
                                    <th scope="col">School ID</th>
                                    <th scope="col">School Address</th>
                                    <th scope="col">School Type</th>
                                    <th scope="col" class="text-center" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                $result = $mySQLFunction->getEnroll();
                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        echo '<tr>';
                                        echo '<td>' . $row["student"] . '</td>';
                                        echo '<td>' . $row["strand_name"] . '</td>';
                                        echo '<td>' . $row["section_name"] . '</td>';
                                        echo '<td>' . $row["adviser"] . '</td>';
                                        echo '<td>' . $row["enroll_semester"] . '</td>';
                                        echo '<td>' . $row["sy"] . '</td>';
                                        echo '<td>' . $row["date_enroll"] . '</td>';
                                        echo '<td>' . $row["enroll_status"] . '</td>';
                                        echo '<td>' . $row["current_school"] . '</td>';
                                        echo '<td>' . $row["school_id"] . '</td>';
                                        echo '<td>' . $row["school_address"] . '</td>';
                                        echo '<td>' . $row["school_type"] . '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#edit_enrolled' . urlencode($row['stu_lrn']) . '">
                                                <i class="bi bi-pencil-square"></i>Edit 
                                            </button>
                                        
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_enrolled' . urlencode($row['stu_lrn']) . '">
                                                <i class="bi bi-trash"></i>Delete
                                            </button>
                                        </td>
                                            ';
                                        echo '</tr>';

                                        $count++;



                                        // Modal for updating enroolled
                                        echo '
                                            <div class="modal fade" id="edit_enrolled' . htmlspecialchars($row['stu_lrn']) . '" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content b-grey">
                                                        <div class="modal-body">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-3 text-primary">Student Enrolled Details</h1><i class="bi bi-pencil-square fs-4"></i>
                                                            </div>
                                                            <form action="./includes/Operation/updateSection.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editSectionForm' . htmlspecialchars($row['stu_lrn']) . '">
                                                                <!-- Use hidden input -->
                                                                    <input type="hidden" name="studentID" value="' . htmlspecialchars($row['stu_lrn']) . '">

                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Student Name</label>
                                                                            <select class="form-select" id="studentsSelect" name="stu_lrn" required>';

                                        // Fetch and populate student options
                                        $mySQLFunction->connection();
                                        $students = $mySQLFunction->getStudent();
                                        foreach ($students as $student) {
                                            $selected = $student["stu_lrn"] == $row['stu_lrn'] ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($student["stu_lrn"]) . '"' . $selected . '>' . htmlspecialchars($student["stu_fname"]) . ' ' . htmlspecialchars($student["stu_lname"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Please input a strand name.
                                                                            </div>
                                                                        </div>


                                                                <div class="col-md-12 mb-3">
                                                                            <label class="form-label">Strand Name</label>
                                                                            <select class="form-select" id="strandSelect' . htmlspecialchars($row['section_code']) . '" name="strand_code" required>';

                                        // Fetch and populate strand options
                                        $mySQLFunction->connection();
                                        $strands = $mySQLFunction->getStrand();
                                        foreach ($strands as $strand) {
                                            $selected = $strand["strand_name"] == $row['strand_name'] ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($strand["strand_name"]) . '"' . $selected . '>' . htmlspecialchars($strand["strand_desc"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Please input a strand name.
                                                                            </div>
                                                                        </div>









                                                                    <!-- GRADE LEVEL -->
                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">Grade Level</label>
                                                                        <select class="form-select" name="gradelvl" id="gradeLvl' . htmlspecialchars($row['stu_lrn']) . '" required>                                                                        
                                                                            <option value="GRADE-12"' . ($row['grade_lvl'] == 'GRADE-12' ? ' selected' : '') . '>GRADE-12</option>
                                                                            <option value="GRADE-11"' . ($row['grade_lvl'] == 'GRADE-11' ? ' selected' : '') . '>GRADE-11</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Please select a grade level.
                                                                        </div>
                                                                    </div>';
                                        echo '
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label id="section' . htmlspecialchars($row['stu_lrn']) . '">Section</label>
                                                                            <input type="text" class="form-control" name="section" value="' . htmlspecialchars($row['section_name']) . '" required>
                                                                            <div class="invalid-feedback">
                                                                                Please select a section name.
                                                                            </div>
                                                                        </div>
                                                                                        

                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">Semester</label>
                                                                            <select class="form-select" name="semester" id="semester' . htmlspecialchars($row['stu_lrn']) . '" required>';
                                        // <option selected disabled value="">Select...</option>

                                        // Fetch and populate semester options
                                        $mySQLFunction->connection();
                                        $result = $mySQLFunction->getSemester();
                                        foreach ($result as $semester) {
                                            // Dynamically set selected if the current semester matches the one from the database
                                            $selected = ($semester['semester_name'] == $row['semester_name']) ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($semester['semester_name']) . '"' . $selected . '>' . htmlspecialchars($semester['semester_name']) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Please select a semester.
                                                                            </div>
                                                                    </div>

                                                                        ';
                                        echo '
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Adviser</label>
                                                                        <select class="form-select" name="teacher_id" required>
                                                                            <option value="" selected disabled>Choose an adviser...</option>
                                                                            ';
                                        $mySQLFunction->connection();
                                        // Fetch the teachers and populate the dropdown
                                        $result = $mySQLFunction->getTeacher();
                                        foreach ($result as $teacher) {
                                            $selected = ($teacher['teacher_id'] == $row['teacher_id']) ? ' selected' : '';

                                            echo '<option value="' . htmlspecialchars($teacher["teacher_id"]) . '">' . htmlspecialchars($teacher["teacher_fname"]) . ' ' . htmlspecialchars($teacher["teacher_mname"]) . ' ' . htmlspecialchars($teacher["teacher_lname"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Please select an advisor.
                                                                        </div>
                                                                    </div>
                                                                    ';
                                        echo '

                                                                    <div class="d-flex justify-center gap-2">
                                                                        <div class="col-6">
                                                                            <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Update</button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetSection(\'' . htmlspecialchars($row['stu_lrn']) . '\')">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <script>
                                            function resetSection(id) {
                                                    var form = document.getElementById("editSectionForm" + id);
                                                        if (form) {
                                                        form.reset(); // Clears the form fields
                                                        form.classList.remove("was-validated"); // Removes the validation styling
                                                        }
                                                    }
                                            </script>
                                            ';










                                        // Modal for deleting enrolled student
                                        echo '
                                            <div class="modal fade" id="del_enrolled' . urlencode($row['stu_lrn']) . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center mt-5">
                                                            <div class="text-danger">
                                                                <i class="bi bi-trash fs-1 "></i><br><br>
                                                            </div>
                                                            <h5>Are you sure you want to delete '  . $row['student'] . ' ?</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-5 mb-5">
                                                            <a href="includes/Operation/deleteEnrolled.php?id='  . urlencode($row['stu_lrn']) . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>                                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center "><i class="bi bi-emoji-frown me-2"></i>Enrolled not found.<br>
                                </td>
                              </tr>';
                                }

                                echo '</tbody>';
                                echo '</table>';
                                $mySQLFunction->disconnect();
                                ?>


                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>