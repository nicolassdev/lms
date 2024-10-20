<?php

// TEACHER BUTTON MODOL IF INSERT OR ALREADY TAKEN 
// ===================================================== FACULTY UPDATE ALERT MODAL NOTIFY ===================================================
//INSERT TEACHER MODAL
if (isset($_SESSION['insert_success']) && $_SESSION['insert_success'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Teacher has been added successfully.</p>
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
    unset($_SESSION['insert_success']); // Unset the session variable
}
//INSERT STUDENT MODAL
if (isset($_SESSION['insert_student']) && $_SESSION['insert_student'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Student has been added successfully.</p>
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
    unset($_SESSION['insert_student']); // Unset the session variable
}

//INSERT ADMIN MODAL
if (isset($_SESSION['insert_admin']) && $_SESSION['insert_admin'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Admin Details has been added successfully.</p>
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
    unset($_SESSION['insert_admin']); // Unset the session variable
}

//INSERT STRAND MODAL
if (isset($_SESSION['insert_strand']) && $_SESSION['insert_strand'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Strand has been added successfully.</p>
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
    unset($_SESSION['insert_strand']); // Unset the session variable
}

//INSERT SECTION MODAL
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

//INSERT SUBJECT MODAL
if (isset($_SESSION['insert_subject']) && $_SESSION['insert_subject'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Subject has been added successfully.</p>
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
    unset($_SESSION['insert_subject']); // Unset the session variable
}





//INSERT ENROLLED MODAL
if (isset($_SESSION['insert_enrolled']) && $_SESSION['insert_enrolled'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Student has been enrolled.</p>
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
    unset($_SESSION['insert_enrolled']); // Unset the session variable
}
// INSERT SY 
if (isset($_SESSION['insert_sy']) && $_SESSION['insert_sy'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> School year has been added successfully.</p>
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
    unset($_SESSION['insert_sy']); // Unset the session variable
}

// INSERT SEMESTER
if (isset($_SESSION['insert_semester']) && $_SESSION['insert_semester'] == true) {
    echo ' 
            <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                        <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4"> Semester has been added successfully.</p>
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
    unset($_SESSION['insert_semester']); // Unset the session variable
}


// INSERT ERROR TEACHER
if (isset($_SESSION['insert_error']) && $_SESSION['insert_error'] == true) {
    echo '
    
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4"> Username or Faculty Details has been already taken.</p>
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
    unset($_SESSION['insert_error']); // Unset the session variable
}

//INSERT ERROR STUDENT
if (isset($_SESSION['error_student']) && $_SESSION['error_student'] == true) {
    echo '
    
    <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4"> Username or Student Details has been already taken.</p>
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


//INSERT ERROR ADMIN
    if (isset($_SESSION['error_principal']) && $_SESSION['error_principal'] == true) {
        echo '
        
        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
        <div class="modal-body text-center mt-5">
                            <div class="text-danger">
                                <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                            </div>
                            <p class="mb-4"> Username has been already taken.</p>
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
        unset($_SESSION['error_principal']); // Unset the session variable
    }
 

// INSERT ERROR STRAND
if (isset($_SESSION['error_strand']) && $_SESSION['error_strand'] == true) {
    echo '

        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4"> Strand name or description has been already taken.</p>
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
    unset($_SESSION['error_strand']); // Unset the session variable
}

//INSERT ERROR SECTION
if (isset($_SESSION['error_section']) && $_SESSION['error_section'] == true) {
    echo '

        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">Section has been already exist.</p>
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
    unset($_SESSION['error_section']); // Unset the session variable
}

//INSERT ERROR SUBJECT
if (isset($_SESSION['error_subject']) && $_SESSION['error_subject'] == true) {
    echo '

        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4"> Subject has been already taken.</p>
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
    unset($_SESSION['error_subject']); // Unset the session variable
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

//INSERT ERROR SEMESTER
if (isset($_SESSION['error_semester']) && $_SESSION['error_semester'] == true) {
    echo '

        <div class="modal fade" id="errorModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4"> Section name has been already taken.</p>
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
    unset($_SESSION['error_semester']); // Unset the session variable
}




//UPDATE MODAL
if (isset($_SESSION['update_faculty']) && $_SESSION['update_faculty'] == true) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Faculty has been updated successfully.</p>
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
    unset($_SESSION['update_faculty']);
}

if (isset($_SESSION['update_student']) && $_SESSION['update_student'] == true) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Student has been updated successfully.</p>
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


if (isset($_SESSION['update_section']) && $_SESSION['update_section'] == true) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Section     has been updated successfully.</p>
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

if (isset($_SESSION['update_subject']) && $_SESSION['update_subject'] == true) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Subject has been updated successfully.</p>
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
    unset($_SESSION['update_subject']);
}




if (isset($_SESSION['update_enroll']) && $_SESSION['update_enroll'] == true) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Enrollment has been updated successfully.</p>
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
    unset($_SESSION['update_enroll']);
}




//DELETE MODAL
if (isset($_SESSION['delete_faculty']) && $_SESSION['delete_faculty'] == true) {
    echo '
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center mt-5">
                    <div class="text-success">
                        <i class="bi bi-check-circle fs-1"></i><br><br>
                    </div>
                    <p class="mb-4">User has been deleted successfully.</p>
                </div>
                <div class="d-flex justify-content-center mt-3 mb-5">
                    <button class="btn btn-success" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
            deleteModal.show();
        });
    </script>';

    // Unset the session variable so the modal only shows once
    unset($_SESSION['delete_faculty']);
}


// ===================================================== FACULTY INSERT ALERT MODAL NOTIFICATION ===================================================

























// ===================================================== USER UPDATE ALERT MODAL NOTIFY ===================================================

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
                        <p class="mb-4">User has been updated successfully.</p>
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

//UPDATE ADMIN
if (isset($_SESSION['update_admin']) && $_SESSION['update_admin']) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Admin Information has been updated successfully.</p>
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
    unset($_SESSION['update_admin']);
}

// ERROR INSERT FACULTY
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



// ERROR UPDATE FACULTY


// DELETE FACULTY
if (isset($_SESSION['delete_faculty']) && $_SESSION['delete_faculty']) {
    echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-success">
                            <i class="bi bi-check-circle fs-1 "></i><br><br>
                        </div>
                        <p class="mb-4">Teacher has been deleted successfully.</p>
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
    unset($_SESSION['delete_faculty']);
}





// =====================================================UPDATE ERROR TEAHCER MODAL -========================================================
if (isset($_SESSION['teacherupdate_error'])) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['teacherupdate_error'] . '</p>
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
    unset($_SESSION['teacherupdate_error']); // Unset the session variable after displaying
}

if (isset($_SESSION['sectionupdate_error'])) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['sectionupdate_error'] . '</p>
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
    unset($_SESSION['sectionupdate_error']); // Unset the session variable after displaying
}


//SUBJECT EXIST 
if (isset($_SESSION['subject_error'])) {
    echo '
        <div class="modal fade" id="errorupdateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <div class="text-danger">
                            <i class="bi bi-exclamation-circle fs-1"></i><br><br>
                        </div>
                        <p class="mb-4">' . $_SESSION['subject_error'] . '</p>
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
    unset($_SESSION['subject_error']); // Unset the session variable after displaying
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