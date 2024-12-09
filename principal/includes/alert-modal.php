<?php
// SUCCESS MODAL NOTIFICATION
if (isset($_SESSION['success_notify'])) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> ' . $_SESSION['success_notify'] . '</p>
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
    unset($_SESSION['success_notify']); // Unset the session variable
}

// ERROR MODAL NOTIFICATION
if (isset($_SESSION['error_notify'])) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['error_notify'] . '</p>
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
    unset($_SESSION['error_notify']); // Unset the session variable after displaying
}
