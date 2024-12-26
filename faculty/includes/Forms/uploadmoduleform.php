<!-- STUDENT INFORMATION ENTRY MODAL   -->
<div class="modal fade" id="upload_module" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content b-grey">
            <div class="modal-body">


                <!-- Form upload -->
                <!-- Modal Title & Icon -->
                <div class="text-center mb-4">
                    <h1 class="text-primary"><i class="bi bi-cloud-arrow-up" style="font-size: 120px;"></i></h1>
                    <h5 class="font-weight-bold text-dark">Upload Module</h5>
                </div>

                <form id="studentForm" action="./includes/upload-inc.php" method="POST" enctype="multipart/form-data" autocomplete="off" class="row g-2 needs-validation" novalidate>


                    <div class="mb-4">
                        <label for="fileInput" class="form-label text-secondary">Select a file to upload</label>
                        <input type="file" class="form-control form-control-lg border-primary" id="fileInput" name="file" required>
                        <small class="form-text text-danger" style="font-size: 12px;">Allowed file types: PDF, Word, Excel, PowerPoint, and Images (JPEG, PNG, GIF, WEBP)</small>
                        <div class="invalid-feedback">
                            Please upload a file module.
                        </div>
                    </div>


                    <div class="col-md-6">
                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Upload</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormUpload()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Function to clear the form inputs when " Cancel" is clicked
    function resetFormUpload() {
        document.getElementById('studentForm').reset();
        studentForm.classList.remove('was-validated');

    }
    // JavaScript for enabling Bootstrap 5.3.0 validation and LRN comparison
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(form => {
            form.addEventListener('submit', event => {
                const username = document.getElementById('username').value;
                const lrn = document.getElementById('lrn').value;
                const lrnError = document.getElementById('lrnError');

                // Check if username and student LRN are the same
                if (username !== lrn) {
                    lrnError.classList.remove('d-none');
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    lrnError.classList.add('d-none');
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();;
</script>