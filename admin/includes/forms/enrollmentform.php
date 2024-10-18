<?php

if (!isset($_SESSION['principal_id'])) {
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
<div class="modal fade" id="enroll" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content b-grey">
            <div class="modal-body">

                <!-- Form -->
                <!-- action="./includes/student-inc.php " method="POST" -->
                <form id="enrollForm" action="./includes/enroll-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <!-- Left Image -->
                        <img src="../assets/img/edukasyon.png" alt="Edukasyon Logo" class="img-fluid" style="max-height: 100px;">

                        <!-- Centered Modal Title -->
                        <div class="text-center">
                            <small class="">Republic of the Philippines</small>
                            <small class="modal-title fs-6 d-block">Department of Education</small>
                            <small class="">Bicol Region</small>
                            <small class="modal-title fs-6 d-block">Division of Legazpi City</small>
                            <small class="">District 2</small>
                        </div>

                        <!-- Right Image -->
                        <img src="../assets/img/csi.png" alt="CSI Logo" class="img-fluid" style="max-height: 100px;">
                    </div>

                    <div class="modal-header">
                        <div class="fs-5">Registration/Enrollment Form
                            <?php
                            if (!empty($activeSchoolYears) && !empty($activeSem)) {
                                foreach ($activeSchoolYears as $index => $schoolYear) {
                                    echo '<span class="me-3">SY ' . htmlspecialchars($schoolYear) . '</span>';;
                                    echo '<div class=" text-success">' . htmlspecialchars($activeSem[$index]) . '</div>';
                                }
                            } else {
                                echo '<div class="alert alert-warning">No school year and semester found.</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Student</label>
                        <select class="form-select" name="stu_lrn" required>
                            <option value="" selected disabled>Select a student...</option>
                            <?php
                            $mySQLFunction->connection();
                            $result = $mySQLFunction->getStudent();

                            $activeSemester = $activeSem[0]; // Assuming there's at least one active semester
                            $selectedSectionCode = isset($_POST['section_code']) ? $_POST['section_code'] : ''; // Ensure you retrieve the selected section
                            $hasAvailableStudents = false;

                            if (empty($result)) {
                                echo '<option disabled>No students found in the database.</option>';
                            } else {
                                foreach ($result as $row) {
                                    // Check if the student is enrolled in the active semester and selected section
                                    $isEnrolledInSem = $mySQLFunction->checkEnrollmentInSemester($row["stu_lrn"], $activeSemester);

                                    if ($isEnrolledInSem == 0) {
                                        echo '<option value="' . htmlspecialchars($row["stu_lrn"]) . '">';
                                        echo htmlspecialchars($row["stu_fname"]) . ' ' . htmlspecialchars($row["stu_mname"]) . ' ' . htmlspecialchars($row["stu_lname"]);
                                        echo '</option>';
                                        $hasAvailableStudents = true;
                                    }
                                }

                                if (!$hasAvailableStudents) {
                                    echo '<option disabled>No students available for enrollment</option>';
                                }
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please select a student.
                        </div>
                    </div>




                    <div class="col-md-12">
                        <label class="form-label">Section name</label>
                        <select class="form-select" name="section_code" id="sectionSelect" required>
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
                                                data-gradelvl="' . htmlspecialchars($row["grade_lvl"]) . '" 
                                                data-adviser="' . htmlspecialchars($row["adviser"]) . '">'
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
                        <label class="form-label">Strand</label>
                        <input type="text" class="form-control" id="strandInput" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Grade level</label>
                        <input type="text" class="form-control" id="gradelvlInput" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Adviser</label>
                        <input type="text" class="form-control" id="adviserInput" readonly>
                    </div>


                    <!-- CURRENT ATTEND SCHOOL OF STUDENT  -->

                    <div class="modal-header">
                        <div class="fs-5">Current School :</div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">School name</label>
                        <input type="text" class="form-control" name="currentchool" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">School ID <small class="text-danger">(Optional)</small></label>
                        <input type="number" class="form-control" name="schoolid" id="schoolId" oninput="this.value = this.value.slice(0, 6);">
                        <div class=" invalid-feedback">
                            School ID must be exactly 6 digits.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">School Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Shool Type</label>
                        <select class="form-select" name="schooltype" required>
                            <option selected disabled value="">Select...</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>

                    <label class="form-label">Requirements Submitted</label>
                    <div class="col-md-12">
                        SF9 <input class="me-3" type="checkbox" name="requirement[]" value="SF9">
                        SF10 <input class="me-3" type="checkbox" name="requirement[]" value="SF10">
                        PSA Birth Certificate <input class="me-3" type="checkbox" name="requirement[]" value="PSA Birth Certificate">
                        LCR Birth Certificate <input class="me-3" type="checkbox" name="requirement[]" value="LCR Birth Certificate">
                        GMCC <input class="me-3" type="checkbox" name="requirement[]" value="GMCC">
                        2x2 <input class="me-3" type="checkbox" name="requirement[]" value="2x2">
                    </div>
                    <div class="invalid-feedback" id="checkbox-feedback">
                        Please select at least one requirement.
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
        document.getElementById('enrollForm').reset();
        enrollForm.classList.remove('was-validated');

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
        const adviserInput = document.getElementById('adviserInput');

        sectionSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            // Get strand and adviser from data attributes
            const strand = selectedOption.getAttribute('data-strand') || '';
            const gradelvl = selectedOption.getAttribute('data-gradelvl') || '';
            const adviser = selectedOption.getAttribute('data-adviser') || '';

            // Set the values to the input fields
            strandInput.value = strand;
            gradelvlInput.value = gradelvl;
            adviserInput.value = adviser;
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
    document.getElementById('enrollForm').addEventListener('submit', function(event) {
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