 
<!-- ADDING STRAND MODAL -->
<div class="modal fade" id="section" tabindex="-1" aria-labelledby="strandModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-3 text-primary">New Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormStrand()"></button>
            </div>

            <div class="modal-body">
                <form id="strandForm" action="./includes/section-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                    <div class="col-md-12">
                        <label class="form-label">STRAND NAME</label>
                        <select class="form-select" id="strandSelect" name="strand_code" required>
                            <option value="" selected disabled>Choose a strand...</option>
                            <?php
                            $mySQLFunction->connection();
                            $result = $mySQLFunction->getStrand();
                            foreach ($result as $row) {
                                echo '<option value="' . $row["strand_code"] . '">' . $row["strand_name"] . ' </option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please input a strand name.
                        </div>
                    </div>

                    <!-- GRADE LEVEL -->
                    <div class="col-md-12">
                        <label class="form-label">Grade Level</label>
                        <select class="form-select" name="gradelvl" id="gradelvl" required>
                            <option selected disabled value="">Select...</option>
                            <option value="GRADE-12">GRADE-12</option>
                            <option value="GRADE-11">GRADE-11</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a grade level.
                        </div>
                    </div>

                    <!-- SECTION SELECTION -->
                    <div class="col-md-12">
                        <label class="form-label">Section</label>
                        <input type="text" class="form-control" name="section" required>

                        <div class="invalid-feedback">
                            Please select a section name.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Semester</label>
                        <select class="form-select" name="semester" id="semester" required>
                            <option selected disabled value="">Select...</option>
                            <?php
                            $result = $mySQLFunction->getSemester();
                            foreach ($result as $row) {
                                echo '<option value="' . $row["semester_name"] . '">' . $row["semester_name"] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please select a semester.
                        </div>
                    </div>

                    <!-- ADVISOR SELECTION -->
                    <div class="col-md-12">
                        <label class="form-label">Adviser</label>
                        <select class="form-select" name="teacher_id" required>
                            <option value="" selected disabled>Choose an adviser...</option>
                            <?php
                            $result = $mySQLFunction->getTeacher();
                            foreach ($result as $row) {
                                echo '<option value="' . $row["teacher_id"] . '">' . $row["teacher_fname"] . ' ' . $row["teacher_lname"] . '</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Please select an advisor.
                        </div>
                    </div>

                     <div class="col-md-12">
                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
         // Function to reset the form inputs
    function resetFormStrand() {
        const form = document.getElementById('strandForm');
        form.reset();
        form.classList.remove('was-validated');
        sectionSelect.innerHTML = '<option selected disabled value="">Select...</option>';
    }
</script>