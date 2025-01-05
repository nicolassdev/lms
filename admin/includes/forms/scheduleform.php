<?php

if (!isset($_SESSION['registrar_id'])) {
    header("location:../../../login.php?error=accessdenied");
    exit();
}
?>

<?php
$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$mySQLFunction->disconnect();

?>

<!-- STUDENT INFORMATION ENTRY MODAL   -->
<div class="modal fade" id="schedule" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md ">
        <div class="modal-content b-grey">
            <div class="modal-body">

                <!-- Form -->
                <!-- action="./includes/student-inc.php " method="POST" -->
                <form id="schedForm" action="./includes/schedule-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="fs-6"><span class="text-primary form-label fw-bold">Create Schedule </span><br>
                            <?php
                            if (!empty($activeSchoolYears) && !empty($activeSem)) {
                                foreach ($activeSchoolYears as $index => $schoolYear) {
                                    echo '<span class="me-3">SY ' . htmlspecialchars($schoolYear) . '</span>';;
                                }
                            } else {
                                echo '<div class="alert alert-warning">No school year and semester found.</div>';
                            }
                            ?>
                        </div>
                        <img src="../assets/img/csi.webp" alt="CSI Logo" class="img-fluid" style="max-height: 70px;">
                    </div>

                    <!-- SECTION  -->
                    <div class="col-md-12">
                        <label class="form-label">Section name <span style="color: red;">*</span></label>
                        <select class="form-select" name="sectionID" id="sectionSelect" required>
                            <option value="" selected disabled>Select a section...</option>
                            <?php
                            $mySQLFunction->connection();
                            $result = $mySQLFunction->getSection();

                            if (empty($result)) {
                                // If no data is found, display a message
                                echo '<option value="">No data available in the database</option>';
                            } else {
                                // If data is available, loop through the result and display the options
                                foreach ($result as $row) {
                                    echo '<option value="' . $row["section_code"] . '" 
                                                data-strand="' . htmlspecialchars($row["strand_name"]) . '" 
                                                data-gradelvl="' . htmlspecialchars($row["grade_lvl"]) . '">'
                                        . htmlspecialchars($row["section_name"]) . '</option>';
                                }
                            }
                            ?>

                        </select>
                        <div class="invalid-feedback">
                            Please select a section.
                        </div>
                    </div>


                    <div class="col-md-6">
                        <label class="fs-6 mb-1">Strand</label>
                        <input type="text" class="form-control" id="strandInput" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="fs-6 mb-1">Grade level</label>
                        <input type="text" class="form-control" id="gradelvlInput" readonly>
                    </div>


                    <!-- SUBJECT -->
                    <div class="col-md-12">
                        <label class="form-label">Subject <span style="color: red;">*</span></label>
                        <select class="form-select" name="subjectID" id="subjectSelect" required>
                            <option value="" selected disabled>Select a subject ...</option>
                            <?php
                            $mySQLFunction->connection();
                            $result = $mySQLFunction->getSubject();
                            $activeSemester = $mySQLFunction->getActiveSemester(); // Get the active semester from your logic
                            $hasAvailableSubject = false;

                            if (empty($result)) {
                                echo '<option disabled>No subject found in the database.</option>';
                            } else {
                                foreach ($result as $row) {
                                    // Check if the subject's semester matches the active semester
                                    if ($row["sub_semester"] !== $activeSemester) {
                                        continue; // Skip this subject if it's not for the active semester
                                    }

                                    // Skip the subject if it is already scheduled the maximum number of times (e.g., 6 times)
                                    if ($mySQLFunction->checkRowCount("schedule", "sub_code", $row["sub_code"]) >= 6) {
                                        continue;
                                    }

                                    // Output available subjects as <option>
                                    echo '<option value="' . htmlspecialchars($row["sub_code"]) . '" 
                                            data-subject="' . htmlspecialchars($row["sub_title"]) . '" 
                                            data-subtype="' . ucwords(strtolower($row["sub_type"])) . '" 
                                            data-teacher="' . ucwords(strtolower($row["teacher"])) . '"
                                            data-semester="' . ucwords(strtolower($row["sub_semester"])) . '">'
                                        . htmlspecialchars($row["sub_title"]) . '</option>';

                                    $hasAvailableSubject = true;
                                }
                            }

                            // Show a message if no subjects are available
                            if (!$hasAvailableSubject) {
                                echo '<option disabled>No subject available for scheduling in the active semester.</option>';
                            }

                            $mySQLFunction->disconnect();
                            ?>

                        </select>
                        <div class="invalid-feedback">
                            Please select a subject.
                        </div>
                    </div>


                    <div class="col-md-5">
                        <label class="fs-6 mb-1">Category</label>
                        <input type="text" class="form-control" id="subtypeInput" readonly>
                    </div>


                    <div class="col-md-7">
                        <label class="fs-6 mb-1">Semester</label>
                        <input type="text" class="form-control" id="subsemesterInput" readonly>
                    </div>

                    <!-- TEACHER SELECTION -->
                    <div class="col-md-12">
                        <label class="form-label">Teacher <span style="color: red;">*</span></label>
                        <select class="form-select" name="teacherID" required>
                            <option value="" selected disabled>Choose a teacher...</option>
                            <?php
                            $mySQLFunction->connection();
                            $result = $mySQLFunction->getTeacher();
                            $hasAvailableTeacher = false;

                            if (empty($result)) {
                                echo '<option disabled>No teaecher found in the database.</option>';
                            } else {
                                foreach ($result as $row) {
                                    if (($mySQLFunction->checkRowCount("schedule", "teacher_id", $row["teacher_id"])) == 2) { //check if the teacher id was exist 2x then skip to continue
                                        continue;
                                    } else {
                                        echo '<option value="' . $row["teacher_id"] . '">' . $row["teacher_fname"] . ' ' . $row["teacher_lname"] . '</option>';
                                        $hasAvailableTeacher = true;
                                    }
                                }
                            }
                            if (!$hasAvailableTeacher) {
                                echo '<option disabled>No teacher available for subject.</option>';
                            }
                            $mySQLFunction->disconnect();

                            ?>
                        </select>
                        <div class="invalid-feedback">Please select a teacher.</div>
                    </div>




                    <div class="col-md-12">
                        <label class="form-label">Day <span style="color: red;">*</span></label>
                        <select class="form-select" name="day" required>
                            <option value="" disabled selected>Select a day ..</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select the day of the subject.
                        </div>
                    </div>


                    <label class="form-label">Time <span style="color: red;">*</span></label>
                    <div class="col-md-6">
                        <label class="form-label small">From</label>
                        <input type="time" class="form-control" name="time_from" placeholder="e.g., 7:30 AM" required>
                        <div class="invalid-feedback">
                            Please input the time of the subject.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small">To</label>
                        <input type="time" class="form-control" name="time_to" placeholder="e.g., 9:30 AM" required>
                        <div class="invalid-feedback">
                            Please input the time of the subject.
                        </div>
                    </div>




                    <div class="col-6">
                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Save</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormEnroll()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Function to clear the form inputs when " Cancel" is clicked
    function resetFormEnroll() {
        document.getElementById('schedForm').reset();
        schedForm.classList.remove('was-validated');

    }

    // JavaScript for enabling Bootstrap 5.3.0 validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();


    document.addEventListener('DOMContentLoaded', function() {
        const sectionSelect = document.getElementById('sectionSelect');
        const strandInput = document.getElementById('strandInput');
        const gradelvlInput = document.getElementById('gradelvlInput');

        sectionSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            // Get strand and adviser from data attributes
            const strand = selectedOption.getAttribute('data-strand') || '';
            const gradelvl = selectedOption.getAttribute('data-gradelvl') || '';

            // Set the values to the input fields
            strandInput.value = strand;
            gradelvlInput.value = gradelvl;
        });
    });


    //SUBJECT FORM SELECTED 

    document.addEventListener('DOMContentLoaded', function() {
        const subjectSelect = document.getElementById('subjectSelect');
        const subtypeInput = document.getElementById('subtypeInput');
        const subsemesterInput = document.getElementById('subsemesterInput');

        subjectSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            // Get strand and adviser from data attributes
            const subtype = selectedOption.getAttribute('data-subtype') || '';
            const semester = selectedOption.getAttribute('data-semester') || '';

            // Set the values to the input fields
            subtypeInput.value = subtype;
            subsemesterInput.value = semester;
        });
    });






    // Custom form validation for School ID to ensure it's exactly 6 digits
    document.getElementById('schoolId').addEventListener('input', function() {
        const inputField = this;
        const value = inputField.value;

        // Check if the input length is exactly 6 digits
        if (value.length === 6) {
            inputField.setCustomValidity(''); // Clear invalid state
        } else {
            inputField.setCustomValidity('School ID must be exactly 6 digits.'); // Set invalid state
        }
    });



    // Add validation for checkboxes
    document.getElementById('schedForm').addEventListener('submit', function(event) {
        const checkboxes = document.querySelectorAll('input[name="requirement[]"]');
        const checkboxFeedback = document.getElementById('checkbox-feedback');
        let checked = false;

        // Loop through checkboxes to check if any is selected
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checked = true;
            }
        });

        // If no checkbox is checked, prevent form submission and show feedback
        if (!checked) {
            event.preventDefault();
            checkboxFeedback.style.display = 'block';
        } else {
            checkboxFeedback.style.display = 'none';
        }
    });
</script>