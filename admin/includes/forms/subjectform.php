<!-- ADDING SUBJECT MODAL  -->
<div class="modal fade" id="subject" tabindex="-1" aria-labelledby="subjectModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-primary">Add new subject</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormSubject()"></button>
      </div>

      <div class="modal-body">
        <form id="subjectForm" action="./includes/subject-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>
          <div class="col-md-12">
            <label class="form-label">Subject Title</label>
            <input type="text" class="form-control" name="title" required>
            <div class="invalid-feedback">Please enter a subject title.</div>
          </div>

          <div class="col-md-12">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="type" required>
              <option selected disabled value="">Choose...</option>
              <option value="Specialized">Specialized Subject</option>
              <option value="Applied">Applied Subject</option>
              <option value="Core">Core Subject</option>
            </select>
            <div class="invalid-feedback">Please select a category.</div>
          </div>

          <div class="col-md-12">
            <label class="form-label">Time</label>
            <div class="input-group">
              <input type="text" autocomplete="off" class="form-control" name="time" value="--:-- --">
            </div>
          </div>

          <div class="col-md-12">
            <label class="form-label">Semester</label>
            <select class="form-select" name="semester" required>
              <option selected disabled value="">Select a semester...</option>
              <option value="1st Semester">1st Semester</option>
              <option value="2nd Semester">2nd Semester</option>
            </select>
            <div class="invalid-feedback">Please select a semester.</div>
          </div>

          <div class="col-md-12">
            <label class="form-label">Strand Name</label>
            <select class="form-select" name="strand_code" required>
              <option value="" selected disabled>Select a strand...</option>
              <?php
              $mySQLFunction->connection();
              $result = $mySQLFunction->getStrand();
              foreach ($result as $row) {
                echo '<option value="' . htmlspecialchars($row["strand_code"]) . '">' . ucwords(strtolower($row["strand_desc"])) . '</option>';
              }
              $mySQLFunction->disconnect();
              ?>
            </select>
            <div class="invalid-feedback">Please input a strand name.</div>
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


          <!-- TEACHER SELECTION -->
          <div class="col-md-12">
            <label class="form-label">Teacher</label>
            <select class="form-select" name="teacher_id" required>
              <option value="" selected disabled>Choose a teacher...</option>
              <?php
              $mySQLFunction->connection();
              $result = $mySQLFunction->getTeacher();
              $hasAvailableTeacher = false;

              if (empty($result)) {
                echo '<option disabled>No teaecher found in the database.</option>';
              } else {
                foreach ($result as $row) {
                  if (($mySQLFunction->checkRowCount("subject", "teacher_id", $row["teacher_id"])) == 3) { //check if the teacher id was exist 2x then skip to continue
                    continue;
                  } else {
                    echo '<option value="' . $row["teacher_id"] . '">' . $row["teacher_fname"] . ' ' . $row["teacher_mname"] . ' ' . $row["teacher_lname"] . '</option>';
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
            <button name="submit" class="btn btn-primary w-100 mt-3" type="submit">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to reset the form inputs
  function resetFormSubject() {
    const form = document.getElementById('subjectForm');
    form.reset();
    form.classList.remove('was-validated');

    // Reset the select elements
    document.querySelectorAll('select').forEach(select => {
      select.value = '';
    });
  }
</script>