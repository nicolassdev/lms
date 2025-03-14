<div class="modal fade" id="quarterly" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content b-grey">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateModalLabel">Add Quarterly</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to update quarterly details -->
                <form id="quarterlyForm" action="./includes/quarterly-inc.php" method="POST" class="needs-validation" novalidate>
                    <!-- quarterly input -->
                    <div class="mb-3">
                        <label for="quarterlyInput" class="form-label">Quarter</label>
                        <input type="text" id="quarterlyInput" name="quarterly" class="form-control" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Only "1st Quarter", "2nd Quarter", "3rd Quarter", "4th Quarter" is allowed.
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="text-end">
                        <button type="submit" name="submit" class="btn btn-primary">Add Quarter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Bootstrap 5 form validation with custom quarterly input validation
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                var quarterlyInput = document.getElementById('quarterlyInput').value.trim();

                // Custom validation for "1st quarterly" and "2nd quarterly"
                if (quarterlyInput !== "1st Quarter" && quarterlyInput !== "2nd Quarter" && quarterlyInput !== "3rd Quarter" && quarterlyInput !== "4th Quarter") {
                    event.preventDefault();
                    event.stopPropagation();
                    document.getElementById('quarterlyInput').classList.add('is-invalid');
                } else {
                    document.getElementById('quarterlyInput').classList.remove('is-invalid');
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