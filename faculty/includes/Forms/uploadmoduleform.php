<!-- STUDENT INFORMATION ENTRY MODAL -->
<div class="modal fade" id="upload_module" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content b-grey">
            <div class="modal-body">
                <!-- Modal Title & Icon -->
                <div class="text-center mb-4">
                    <h1 class="text-primary"><i class="bi bi-cloud-arrow-up" style="font-size: 120px;"></i></h1>
                    <h5 class="font-weight-bold text-dark">Upload Module</h5>
                </div>

                <!-- Form Upload -->
                <form id="uploadFileForm" action="./includes/uploadmodule-inc.php" method="POST" enctype="multipart/form-data" autocomplete="off" class="row g-2 needs-validation" novalidate>
                    <input type="hidden" name="schedID" value="<?php echo htmlspecialchars($_GET['sched_id']); ?>"> <!-- SCHEDULE ID -->
                    <input type="hidden" name="subID" value="<?php echo htmlspecialchars($_GET['sub_code']); ?>"> <!-- SUBJECT ID -->
                    <input type="hidden" name="secID" value="<?php echo htmlspecialchars($_GET['section_code']); ?>"> <!-- SECTION ID -->

                    <!-- Error Alert -->
                    <div id="errorAlert" class="alert alert-danger d-none" role="alert">
                        <strong>Error:</strong> <span id="errorMessage"></span>
                    </div>

                    <!-- File Input -->
                    <div class="mb-4">
                        <label for="fileInput" class="form-label text-secondary">Select a file to upload</label>
                        <input type="file" class="form-control form-control-lg border-primary" id="fileInput" name="file" required>
                        <div class="mt-2">
                            <small style="font-size: 12px;">Allowed: <strong class="text-black">10MB</strong> - PDF, Word, Excel, PowerPoint, and Images (JPEG, PNG, WEBP).</small>
                        </div>
                        <div class="invalid-feedback">
                            Please upload a file module.
                        </div>
                    </div>

                    <!-- Buttons -->
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
    // Function to clear the form inputs and error messages
    function resetFormUpload() {
        const uploadFileForm = document.getElementById('uploadFileForm');
        uploadFileForm.reset();
        uploadFileForm.classList.remove('was-validated');

        const errorAlert = document.getElementById('errorAlert');
        errorAlert.classList.add('d-none');
        document.getElementById('errorMessage').textContent = '';
    }

    // JavaScript for Bootstrap validation and file upload constraints
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

        // File validation
        const fileInput = document.getElementById('fileInput');
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            const errorAlert = document.getElementById('errorAlert');
            const errorMessage = document.getElementById('errorMessage');

            const allowedTypes = [
                'application/pdf',
                'application/vnd.ms-excel',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'image/jpeg',
                'image/png',
                'image/webp'
            ];
            const maxSize = 10 * 1024 * 1024; // 10MB

            if (file && !allowedTypes.includes(file.type)) {
                errorAlert.classList.remove('d-none');
                errorMessage.textContent = 'Invalid file type. Allowed types: PDF, Word, Excel, PowerPoint, and Images.';
                fileInput.value = '';
            } else if (file && file.size > maxSize) {
                errorAlert.classList.remove('d-none');
                errorMessage.textContent = 'File size exceeds 10MB.';
                fileInput.value = '';
            } else {
                errorAlert.classList.add('d-none');
                errorMessage.textContent = '';
            }
        });
    })();
</script>

<style>
    #errorAlert {
        font-size: 14px;
        margin-bottom: 15px;
    }

    @media (max-width: 576px) {
        #upload_module .modal-dialog {
            max-width: 95%;
            margin: auto;
        }
    }
</style>