<?php
//WRONG PASSWORD OR USERNAME
if (isset($_GET["error"]) && $_GET["error"] == "invalidcredentials") {
    echo "<div class='alert-1'>
        <span class='alert-icon'>&#9888;</span> 
        Incorrect username and password
        </div>";
    header("refresh:2; url=login.php");
}

if (isset($_GET["error"]) && $_GET["error"] == "accessdenied") {
    echo "<div class='alert-1'>
        <span class='alert-icon'>&#9888;</span> 
        Access Dismissed!
        Please contact administrator.
        </div>";
    header("refresh:2; url=login.php");
}





//UPDATE ADMIN
if (isset($_SESSION['update_student']) && $_SESSION['update_student']) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Student Information has been updated successfully.</p>
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
    unset($_SESSION['update_student']);
}
