<?php




if (isset($_SESSION['isnot_update']) && $_SESSION['isnot_update']) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-primary">
                            <i class="bi bi-info-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">The following data was not updated.</p>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-5 ">
                        <button class="btn btn-primary me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var successModal = new bootstrap.Modal(document.getElementById("successModal"));
            successModal.show();
        </script>';
    // Unset session variable to prevent modal from showing again on page refresh
    unset($_SESSION['isnot_update']);
}


//INSERT ERROR STUDENT MODAL
if (isset($_SESSION['error_student']) && $_SESSION['error_student'] == true) {
    echo '
    
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4"> Username or Student Details have been already taken.</p>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-5 ">
                        <button class="btn btn-danger me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            });
        </script>';
    unset($_SESSION['error_student']); // Unset the session variable
}

//INSERT ENROLLED MODAL
if (isset($_SESSION['insert_registered']) && $_SESSION['insert_registered'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Student has been registered.</p>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-5 ">
                        <button class="btn btn-success me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                    </div>
                </div>
            </div>
            </div>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                var insertModal = new bootstrap.Modal(document.getElementById("insertModal"));
                insertModal.show();
            });
          </script>";
    ';
    unset($_SESSION['insert_registered']); // Unset the session variable
}


//INSERT ERROR ENROLl
if (isset($_SESSION['error_enrolled']) && $_SESSION['error_enrolled'] == true) {
    echo '

        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">The student has been already enrolled.</p>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-5 ">
                        <button class="btn btn-danger me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            });
        </script>';
    unset($_SESSION['error_enrolled']); // Unset the session variable
}



//ERROR MODAL 
if (isset($_SESSION['error'])) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['error'] . '</p>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-5">
                        <button class="btn btn-danger me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var errorupdateModal = new bootstrap.Modal(document.getElementById("errorupdateModal"));
                errorupdateModal.show();
            });
        </script>
    ';
    unset($_SESSION['error']); // Unset the session variable after displaying
}




// SUCCESS MODAL
if (isset($_SESSION['success'])) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['success'] . '</p>
                    </div>
                    <div class="d-flex justify-content-center mt-3 mb-5 ">
                        <button class="btn btn-success me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var successModal = new bootstrap.Modal(document.getElementById("successModal"));
            successModal.show();
        </script>';
    unset($_SESSION['success']); // Unset the session variable after displaying
}
