<?php

// PHP Logic
if (!isset($_SESSION['stu_lrn'])) {
    header("location:./login.php?error=accessdenied");
    exit();
}
require_once "./includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();


$showUserID = $mySQLFunction->getUserInfo($_SESSION['id']);

$studentInfo  = $mySQLFunction->getStudentInfo($_SESSION['stu_lrn']);

$fullName = $studentInfo['stu_fname'] . ' ' . $studentInfo['stu_mname'] . ' ' . $studentInfo['stu_lname'];



// Birthday formatted
$birthDate = new DateTime($studentInfo['stu_dob']);
$formattedbirthDate = $birthDate->format('F j, Y');



$mySQLFunction->disconnect();
// include "../lms/includes/Forms/studentinfoform.php";
?>

<style>
    body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow-x: hidden;
        /* Remove horizontal scrollbar */
    }


    /* Custom styling for profile */
    .profile-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #2980b9, #6dd5fa, #ffffff);
        width: 100%;
        /* Ensure full width */
        max-width: 1200px;
        /* Optional max width */
        margin: 0 auto;
        /* Center the container */
    }

    .profile-header,
    .profile-details {
        text-align: center;
    }

    .profile-img-circle {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 3px solid #007bff;
    }

    .modal-content {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
    }

    @media (max-width: 576px) {
        .btn-sm {
            padding: 0.25rem 0.5rem;
            /* Smaller padding */
            font-size: 0.875rem;
            /* Smaller font size */
        }
    }


    /* .profile-header h2,
    .profile-header p {
        font-size: 1.5rem;
    } */
</style>

<!-- Modal to Update STUDENT Information -->


<div class="modal fade" id="updatestudentinfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Student Information</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form action="./includes/Operation/updateProfile.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editStudentInfo">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars($studentInfo['stu_fname']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" value="<?php echo htmlspecialchars($studentInfo['stu_mname']); ?>" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" value="<?php echo htmlspecialchars($studentInfo['stu_lname']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the last name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($studentInfo['stu_address']); ?>" class="form-control" required>
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
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($studentInfo['stu_email']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo htmlspecialchars($studentInfo['stu_dob']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Place of Birth</label>
                            <input type="text" name="pob" value="<?php echo htmlspecialchars($studentInfo['stu_pob']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>


                        <!-- 
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profileImage" name="image" accept="image/*" onchange="previewImage(event)" required>
                            <div class="invalid-feedback">Please upload an image.</div>
                        </div> -->


                        <div class="mb-3 text-center">
                            <img id="imagePreview" class="profile-img" src="#" alt="Image Preview" style="display:none;">
                        </div>


                        <div class="modal-header text-black mb-3">
                            <h5 class="modal-title">Parents/ Guardian Information</h5>

                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Father's Name</label>
                            <input type="text" name="fathername" value="<?php echo htmlspecialchars($studentInfo['father_name']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mother's Name</label>
                            <input type="text" name="mothername" value="<?php echo htmlspecialchars($studentInfo['mother_name']); ?>" class="form-control" required>
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
            <div class="col-md-12">
                <div class="profile-card">
                    <div class="d-flex flex-wrap justify-content-end mb-3">
                        <button class="btn btn-secondary btn-sm me-2 mb-2"
                            onclick="location.href='index.php?page=index'">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </button>

                        <button type="button" class="btn btn-primary btn-sm mb-2"
                            title="Edit" data-bs-toggle="modal" data-bs-target="#updatestudentinfo">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <!-- this is adding another admin button -->
                        <!-- <button type="button" class="btn btn-success btn-sm me-2 mb-2"
                            title="Add Admin" data-bs-toggle="modal" data-bs-target="#admin">
                            <i class="bi bi-person-add"></i>
                        </button> -->
                    </div>

                    <div class="profile-header text-center mb-3">
                        <img src="admin/includes/Upload/admin.jpg" alt="Profile Image" class="profile-img-circle mb-2">
                        <h4><?php echo ucwords(strtolower($fullName)); ?>
                            <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                        </h4>
                        <p class="text-muted">LRN: <?php echo  $studentInfo['stu_lrn']; ?></p>
                        <p class="text-muted"></p>

                    </div>

                    <div class="profile-details">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p><?php echo $studentInfo['stu_email']; ?></p>
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
                                <p><?php echo $studentInfo['stu_gender']; ?></p>
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
                                <strong>Address:</strong>
                                <p><?php echo ucwords(strtolower($studentInfo['stu_address'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong>
                                <p>Active</p>
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
                                <strong>Joined:</strong>
                                <p><?php echo htmlspecialchars($_SESSION["user_added"]); ?></p>
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