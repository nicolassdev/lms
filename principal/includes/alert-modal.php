<?php
//INSERT SECTION MODAL NOTIFICATION
if (isset($_SESSION['insert_section']) && $_SESSION['insert_section'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Section has been created successfully.</p>
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
    unset($_SESSION['insert_section']); // Unset the session variable
}

// UPDATE SECTION INFO MODAL NOTFICATION 
if (isset($_SESSION['update_section']) && $_SESSION['update_section'] == true) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Section has been updated successfully.</p>
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
    // Unset session variable to prevent modal from showing again on page refresh
    unset($_SESSION['update_section']);
}


// ERROR USERNAME ALREADY TAKEN
if (isset($_SESSION['user_taken']) && $_SESSION['user_taken'] == true) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">Username is already taken. Please input another one.</p>
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
    unset($_SESSION['user_taken']); // Unset the session variable
}



//PASSWORD DOESN'T MATCH 
if (isset($_SESSION['password_error'])) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['password_error'] . '</p>
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
    unset($_SESSION['password_error']); // Unset the session variable after displaying
}


// UPDATE USER
if (isset($_SESSION['update_user']) && $_SESSION['update_user']) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Account has been updated successfully.</p>
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
    // Unset session variable to prevent modal from showing again on page refresh
    unset($_SESSION['update_user']);
}


//UPDATE PRINCIPAL INFORMATION
if (isset($_SESSION['update_principal']) && $_SESSION['update_principal']) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Principal Information has been updated successfully.</p>
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
    // Unset session variable to prevent modal from showing again on page refresh
    unset($_SESSION['update_principal']);
}
