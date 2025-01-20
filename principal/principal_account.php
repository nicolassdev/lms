<?php
if (!isset($_SESSION['username'])) {
    header("location:../login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'principal') {
        header("location:../login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:../login.php"); // Redirect to login page if user role is not exist 
    exit();
}
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();


// Getters

$account = $mySQLFunction->getAccountUser($_SESSION['id']);

// $principalInfo = $mySQLFunction->getAdminInfo($_SESSION['principal_id']);

// $principalFullName = $principalInfo['firstname'] . ' ' . $principalInfo['middlename'] . ' ' . $principalInfo['lastname'];


$principalInfo = $mySQLFunction->getInfo('principal', $_SESSION['principal_id']);
if ($principalInfo) { // Check if data was returned
    $principalFullName = $principalInfo['firstname'] . ' ' . $principalInfo['middlename'] . ' ' . $principalInfo['lastname'];
    // echo "Full Name: $fullName";
} else {
    echo "No data found for the specified table.";
}





$mySQLFunction->disconnect();
// include "../lms/includes/Forms/studentinfoform.php";
?>



<!-- Modal to Update STUDENT Account -->

<main class="col-md-12 ms-sm-auto col-lg-10">

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex flex-wrap justify-content-end mb-3">
                    <!-- <button class="btn btn-secondary btn-sm me-2 mb-2"
                            onclick="location.href='index.php?page=student_prof'">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </button> -->
                </div>


                <!-- Principal UPDATE FORM -->

                <div class="container position-relative">
                    <img
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-20%, -50%); 
                            width: 500px; opacity: 0.1; z-index: -1;"
                        src="../assets/img/csi.webp"
                        alt="LMS Logo">
                    <div class="row justify-content-between">
                        <!-- Left side: Profile -->
                        <div class="col-md-6 col-12 text-center">
                            <div class="profile-header" style="margin-top: 60px;">


                                <?php
                                // Define the path to the uploaded images directory
                                $uploadDir = "../assets/Upload/";

                                // Check if the image path exists and the file is accessible
                                if (!empty($principalInfo['image']) && file_exists($uploadDir . $principalInfo['image'])) {
                                ?>
                                    <img src="<?php echo htmlspecialchars($uploadDir . $principalInfo['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                    <?php
                                } else {
                                    // Fallback to the default image based on gender
                                    if ($principalInfo['gender'] === "MALE") {
                                    ?>
                                        <img src="../assets/Upload/resources/default-male.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="../assets/Upload/resources/default-female.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                <?php
                                    }
                                }
                                ?>


                                <h4><?php echo ucwords(strtolower($principalFullName)); ?>
                                    <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                                </h4>

                                <span class="badge bg-success text-white">ID</span>
                                <small class="text-muted fw-semibold">
                                    <?php echo $principalInfo['principal_id']; ?>
                                </small>
                                <br />
                            </div>
                        </div>

                        <!-- Right side: Update Form -->
                        <div class="col-md-6 col-12">
                            <form action="./includes/Operation/updatePrincipalAccount.php" method="POST" class="needs-validation" novalidate>

                                <div class="mb-3">
                                    <strong class="fs-5">Your Account</strong>
                                    <p style="font-size: 13px;">Change username and password</p>
                                </div>
                                <!-- hide id of student d-none -->
                                <input type="hidden" class="form-control" name="principalid" value="<?php echo $account['id']; ?>" required>

                                <!-- Username Field -->
                                <div class="mb-3">
                                    <small>Username <span class="text-danger">*</span></small>
                                    <input type="text" name="username" value="<?php echo $account['username']; ?>" class="form-control" required>
                                    <div class="invalid-feedback">Please enter the username.</div>
                                </div>

                                <!-- Old Password Field -->
                                <div class="mb-2">
                                    <small>Enter old password <span class="text-danger">*</span></small>
                                    <input type="password" name="oldpass" placeholder="Enter the old password" class="form-control" required>
                                    <div class="invalid-feedback">Please enter the old password.</div>
                                </div>

                                <!-- New Password Field -->
                                <div class="mb-2">
                                    <small>New Password <span class="text-danger">*</span></small>
                                    <input type="password" name="newpass" placeholder="Enter new password" class="form-control" required>
                                    <div class="invalid-feedback">Please enter the new password.</div>
                                </div>

                                <!-- Confirm Password Field -->
                                <div class="mb-3">
                                    <small>Confirm Password <span class="text-danger">*</span></small>
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
