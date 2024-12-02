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




$studentInfo  = $mySQLFunction->getStudentInfo($_SESSION['stu_lrn']); //handled by student 

$studentSection = $mySQLFunction->getStudentSection($_SESSION['stu_lrn']); //get student section array in database

$studentStrandName = $mySQLFunction->getStudentStrandName($_SESSION['stu_lrn']); // Get strand name


$studentFullName = $studentInfo['stu_fname'] . ' ' . $studentInfo['stu_mname'] . ' ' . $studentInfo['stu_lname'];



// Birthday formatted
$birthDate = new DateTime($studentInfo['stu_dob']);
$formattedbirthDate = $birthDate->format('F j, Y');



$mySQLFunction->disconnect();
// include "../lms/includes/Forms/studentinfoform.php";
?>



<!-- Modal to Update STUDENT Information -->
<div class="modal fade" id="updatestudentinfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Student Information</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form action="./includes/Operation/updateStudentProfile.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editStudentInfo">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['stu_fname']))); ?>" class="form-control" readonly>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['stu_mname']))); ?>" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['stu_lname']))); ?>" class="form-control" readonly>
                            <div class="invalid-feedback">Please enter the last name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['stu_address']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter your address.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                <input type="text" class="form-control" name="scontact" value="<?php echo htmlspecialchars($studentInfo['stu_contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="MALE" <?php echo ($studentInfo['stu_gender'] === 'MALE') ? 'selected' : ''; ?>>Male</option>
                                <option value="FEMALE" <?php echo ($studentInfo['stu_gender'] === 'FEMALE') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <div class="invalid-feedback">Please select your gender.</div>
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars(strtolower($studentInfo['stu_email'])); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo htmlspecialchars($studentInfo['stu_dob']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Place of Birth</label>
                            <input type="text" name="pob" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['stu_pob']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>

                        <!-- Profile Image -->
                        <div class="mb-3">
                            <label class="form-label">Upload photo</label>
                            <input type="file" class="form-control" name="profile_image" accept="image/*" onchange="previewImage(event)">
                            <div class="invalid-feedback">Please upload an image.</div>
                        </div>


                        <div class="mb-3 text-center">
                            <img id="imagePreview" class="profile-img" src="#" alt="Image Preview" style="display:none;">
                        </div>


                        <div class="modal-header text-black mb-3">
                            <h5 class="modal-title">Parents/ Guardian Information</h5>

                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Father's Name</label>
                            <input type="text" name="fathername" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['father_name']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mother's Name</label>
                            <input type="text" name="mothername" value="<?php echo htmlspecialchars(ucwords(strtolower($studentInfo['mother_name']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                <input type="text" class="form-control" name="pcontact" value="<?php echo htmlspecialchars($studentInfo['parent_contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                            </div>
                        </div>



                        <div class="text-end">
                            <button name="submit" class="btn btn-primary" type="submit">Update Information</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- TABLE -->
<main class="col-md-12 ms-sm-auto col-lg-10">

    <div class="container">

        <div class="row">
            <img
                style="position: absolute; top: 50%; left: 50%; transform: translate(-10%, -20%); 
                   width:600px; opacity: 0.1; z-index: -1;"
                src="./assets/img/csi.webp"
                alt="LMS Logo">
            <div class="col-md-12">
                <div class="profile-card">
                    <div class="d-flex flex-wrap justify-content-end mb-3">
                        <!-- <button class="btn btn-secondary btn-sm me-2 mb-2"
                            onclick="location.href='index.php?page=index'">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </button> -->

                        <button type="button" class="btn btn-primary btn-sm mt-4"
                            title="Edit" data-bs-toggle="modal" data-bs-target="#updatestudentinfo">
                            <i class="bi bi-pencil-square me-1"></i>Edit information
                        </button>
                    </div>

                    <div class="profile-header text-center mb-3">
                        <!-- Display the uploaded profile image -->
                        <?php if (!empty($studentInfo['image'])) { ?>
                            <img src="./assets/Upload/<?php echo htmlspecialchars($studentInfo['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                        <?php } else { ?>
                            <!-- Nested loop condition -->
                            <!-- Check if the gender if male or female the show the default image  by gender -->
                            <?php if ($studentInfo['stu_gender'] === "MALE") { ?>
                                <img src="./assets/Upload/default-male.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                            <?php } else { ?>
                                <img src="./assets/Upload/default-female.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                            <?php } ?>

                        <?php } ?>

                        <h4><?php echo ucwords(strtolower($studentFullName)); ?>
                            <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                        </h4>

                        <span class="badge bg-success text-white">LRN</span>
                        <small class="text-muted fw-semibold">
                            <?php echo htmlspecialchars($studentInfo['stu_lrn'], ENT_QUOTES, 'UTF-8'); ?>
                        </small>
                        <br />


                    </div>

                    <div class="profile-details">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p><?php echo strtolower($studentInfo['stu_email']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Phone:</strong>
                                <p>+63<?php echo $studentInfo['stu_contact']; ?></p>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Role:</strong>
                                <p><?php echo ucwords(strtolower($_SESSION["user_role"])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Gender</strong>
                                <p><?php echo ucwords(strtolower($studentInfo['stu_gender'])); ?></p>
                            </div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Date of Birth</strong>
                                <p><?php echo htmlspecialchars($formattedbirthDate); ?></p>
                            </div>

                            <div class="col-md-6">
                                <strong>Place of Birth</strong>
                                <p><?php echo $studentInfo['stu_pob']; ?></p>
                            </div>
                        </div>




                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Strand:</strong>
                                <p>
                                    <?php
                                    if (!empty($studentStrandName)) {
                                        foreach ($studentStrandName as $strand) {
                                            echo htmlspecialchars($strand["strand_name"]);
                                        }
                                    } else {
                                        echo '<div class="text-danger">No strand assigned.</div>';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Section and Grade level:</strong>
                                <p>
                                    <?php
                                    if (!empty($studentSection)) {
                                        foreach ($studentSection as $section) {
                                            echo ucwords(strtolower($section["grade_lvl"])) . ' - ' . htmlspecialchars($section["section_name"]) . ' <br>'; // Display each subject with strand code
                                        }
                                    } else {
                                        echo '<div class="text-danger">No section assigned to this student.</div>';
                                    }
                                    ?>
                                </p>
                            </div>

                        </div>


                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Parents/ Guardian:</strong>
                                <p><?php echo ucwords(strtolower($studentInfo['father_name'])); ?></br>
                                    <?php echo ucwords(strtolower($studentInfo['mother_name'])); ?></p>

                            </div>
                            <div class="col-md-6">
                                <strong>Guardian Contact:</strong>
                                <p>+63<?php echo  $studentInfo['parent_contact']; ?></p>

                            </div>

                        </div>



                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>School Name:</strong>
                                <p><?php echo ucwords(strtolower($showSchool['SCHOOL_NAME'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Address:</strong>
                                <p><?php echo ucwords(strtolower($studentInfo['stu_address'])); ?></p>
                            </div>

                        </div>




                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong> Status:</strong>
                                <p>Active</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Joined:</strong>
                                <p><?php echo htmlspecialchars($_SESSION["student_added"]); ?></p>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


</main>


<script>
    function resetForm() {
        var form = document.getElementById("editStudentInfo");
        if (form) {
            form.reset(); // Clears the form fields
            form.classList.remove("was-validated"); // Removes the validation styling
        }
    }
</script>
<script src="/lms/assets/js/validationform.js"></script>