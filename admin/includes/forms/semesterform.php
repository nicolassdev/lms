 

<div class="modal fade" id="semester" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content b-grey">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateModalLabel">Add Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to update semester details -->
                <form id="semesterForm" action="./includes/semester-inc.php" method="POST" class="needs-validation" novalidate>
                    <!-- Semester input -->
                    <div class="mb-3">
                        <label for="semesterInput" class="form-label">Semester</label>
                        <input type="text" id="semesterInput" name="semester" class="form-control" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Only "1st Semester" or "2nd Semester" is allowed.
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="text-end">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Bootstrap 5 form validation with custom semester input validation
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            var semesterInput = document.getElementById('semesterInput').value.trim();

            // Custom validation for "1st Semester" and "2nd Semester"
            if (semesterInput !== "1st Semester" && semesterInput !== "2nd Semester") {
                event.preventDefault();
                event.stopPropagation();
                document.getElementById('semesterInput').classList.add('is-invalid');
            } else {
                document.getElementById('semesterInput').classList.remove('is-invalid');
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    });
})();
</script>

