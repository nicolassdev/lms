<?php
if (!isset($_SESSION['username'])) {
    header("location:login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'student') {
        header("location:login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:login.php"); // Redirect to login page if user role is not exist 
    exit();
}
require_once "./includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();


// Getters

$account = $mySQLFunction->getAccountUser($_SESSION['id']);

$studentInfo  = $mySQLFunction->getStudentInfo($_SESSION['stu_lrn']); //handled by student 

$studentFullName = $studentInfo['stu_fname'] . ' ' . $studentInfo['stu_mname'] . ' ' . $studentInfo['stu_lname'];


// Birthday formatted
$birthDate = new DateTime($studentInfo['stu_dob']);
$formattedbirthDate = $birthDate->format('F j, Y');



$mySQLFunction->disconnect();
// include "../lms/includes/Forms/studentinfoform.php";
?>



<!-- Modal to Update STUDENT Account -->

<main class="col-md-12 ms-sm-auto col-lg-10">

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="profile-card">
                    <div class="d-flex flex-wrap justify-content-end mb-3">
                        <!-- <button class="btn btn-secondary btn-sm me-2 mb-2"
                            onclick="location.href='index.php?page=student_prof'">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </button> -->
                    </div>


                    <!-- STUDENT UPDATE FORM -->
                    <div class="container position-relative">
                        <img
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-20%, -50%); 
                            width: 500px; opacity: 0.10; z-index: -1;"
                            src="./assets/img/csi.webp"
                            alt="LMS Logo">
                        <div class="row justify-content-between fade-in-input">
                            <!-- Left side: Profile -->
                            <div class="col-md-6 col-12 text-center">
                                <div class="profile-header" style="margin-top: 60px;">


                                    <?php
                                    // Define the path to the uploaded images directory
                                    $uploadDir = "./assets/Upload/";

                                    // Check if the image path exists and the file is accessible
                                    if (!empty($studentInfo['image']) && file_exists($uploadDir . $studentInfo['image'])) {
                                    ?>
                                        <img src="<?php echo htmlspecialchars($uploadDir . $studentInfo['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                        <?php
                                    } else {
                                        // Fallback to the default image based on gender
                                        if ($studentInfo['stu_gender'] === "MALE") {
                                        ?>
                                            <img src="./assets/Upload/resources/default-male.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="./assets/Upload/resources/default-female.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                    <?php
                                        }
                                    }
                                    ?>



                                    <h4><?php echo ucwords(strtolower($studentFullName)); ?>
                                        <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                                    </h4>

                                    <span class="badge bg-success text-white">LRN</span>
                                    <small class="text-muted fw-semibold">
                                        <?php echo htmlspecialchars($studentInfo['stu_lrn'], ENT_QUOTES, 'UTF-8'); ?>
                                    </small>
                                    <br />
                                </div>
                            </div>

                            <!-- Right side: Update Form -->
                            <div class="col-md-6 col-12">
                                <form action="./includes/Operation/updateStudentAccount.php" method="POST" class="needs-validation" novalidate>

                                    <div class="mb-3">
                                        <strong class="fs-5">Your Account</strong>
                                        <p style="font-size: 13px;">Change username and password</p>
                                    </div>
                                    <!-- hide id of student d-none -->
                                    <input type="hidden" class="form-control" name="studentid" value="<?php echo $account['id']; ?>" required>

                                    <!-- Username Field -->
                                    <div class="mb-3">
                                        <small>Username <b class="text-danger">*</b></small>
                                        <input type="text" name="username" value="<?php echo $account['username']; ?>" class="form-control" required>
                                        <div class="invalid-feedback">Please enter the username.</div>
                                    </div>

                                    <!-- Old Password Field -->
                                    <div class="mb-2">
                                        <small>Enter old password <b class="text-danger">*</b></small>
                                        <input type="password" name="oldpass" placeholder="Enter the old password" class="form-control" required>
                                        <div class="invalid-feedback">Please enter the old password.</div>
                                    </div>

                                    <!-- New Password Field -->
                                    <div class="mb-2">
                                        <small>New Password <b class="text-danger">*</b></small>
                                        <input type="password" name="newpass" placeholder="Enter new password" class="form-control" required>
                                        <div class="invalid-feedback">Please enter the new password.</div>
                                    </div>

                                    <!-- Confirm Password Field -->
                                    <div class="mb-3">
                                        <small>Confirm Password <b class="text-danger">*</b></small>
                                        <input type="password" name="confirmpass" placeholder="Confirm your password" class="form-control" required>
                                        <div class="invalid-feedback">Please confirm your password.</div>
                                        <small class="error-message text-danger" style="display: none;">Passwords do not match!</small>
                                    </div>

                                    <div style="margin-bottom: 50px;">
                                        <button name="submit" class="btn btn-success" type="submit">Update Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>



<script>
    // Bootstrap's custom validation
    (function() {
        "use strict";
        var forms = document.querySelectorAll(".needs-validation");

        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener(
                "submit",
                function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
</script>