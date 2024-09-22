<!-- ============================================================== SCHOOL YEAR ========================================================= -->
<div class="modal fade" id="school_year" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content b-grey">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="updateModalLabel">Add School Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to update school year details -->
                <form id="schoolYearForm" action="./includes/sy-inc.php" method="POST" class="needs-validation" novalidate>
                    <!-- School year input -->
                    <div class="mb-3">
                        <label for="schoolyearInput" class="form-label">School Year</label>
                        <input type="text" name="schoolyear" id="schoolyearInput" class="form-control" autocomplete="off"
                               pattern="\d{4}-\d{4}" maxlength="9" required>
                        <div class="invalid-feedback">
                            School year must be in the format YYYY-YYYY (e.g., 2024-2025).
                        </div>
                    </div>
                    <!-- Error message for year gap -->
                    <div class="text-danger" id="error-message" style="display: none;">
                        School year format must have at least a 1-year gap (e.g., 2024-2025).
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
document.getElementById('schoolYearForm').addEventListener('submit', function(event) {
    // Get the value of the school year input
    var schoolYearInput = document.getElementById('schoolyearInput').value;
    
    // Split the input into start and end year
    var years = schoolYearInput.split('-');
    
    // Ensure the input follows the YYYY-YYYY format
    if (years.length !== 2 || isNaN(parseInt(years[0])) || isNaN(parseInt(years[1]))) {
        event.preventDefault(); // Prevent submission
        document.getElementById('schoolyearInput').classList.add('is-invalid'); // Show invalid feedback
        return;
    }

    // Convert the years to integers
    var startYear = parseInt(years[0]);
    var endYear = parseInt(years[1]);

    // Check if the year gap is at least 1 year
    if (endYear - startYear < 1) {
        // Show the custom error message and prevent submission
        document.getElementById('error-message').style.display = 'block';
        event.preventDefault();
    } else {
        // Hide the error message if the validation passes
        document.getElementById('error-message').style.display = 'none';
        document.getElementById('schoolyearInput').classList.remove('is-invalid'); // Clear invalid feedback
    }

    // Standard Bootstrap validation
    var form = document.getElementById('schoolYearForm');
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
});
</script>
