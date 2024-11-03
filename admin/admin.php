<?php
// PHP Logic
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
    exit();
}
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();

$showResult = $mySQLFunction->getAdminInfo();

$fullName = $showResult['firstname'] . ' ' . $showResult['middlename'] . ' ' . $showResult['lastname'];

$mySQLFunction->disconnect();
include "../admin/includes/Forms/adminform.php";
?>


<!-- Modal to Update Admin Information -->
<div class="modal fade" id="updateadmininfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Update Principal Information</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form action="./includes/Operation/updateAdmin.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editAdminInfo">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($showResult['firstname']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($showResult['middlename']); ?>" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($showResult['lastname']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the last name.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                <input type="text" class="form-control" name="contact" value="<?php echo htmlspecialchars($showResult['contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="male" <?php echo ($showResult['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo ($showResult['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <div class="invalid-feedback">Please select your gender.</div>
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($showResult['email']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($showResult['address']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter your address.</div>
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
                            title="Edit" data-bs-toggle="modal" data-bs-target="#updateadmininfo">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <!-- this is adding another admin button -->
                        <!-- <button type="button" class="btn btn-success btn-sm me-2 mb-2"
                            title="Add Admin" data-bs-toggle="modal" data-bs-target="#admin">
                            <i class="bi bi-person-add"></i>
                        </button> -->
                    </div>

                    <div class="profile-header text-center mb-3">
                        <?php if ($showResult['gender'] === "MALE") { ?>
                            <img src="../assets/Upload/maleadmin.png" alt="Profile Image" class="profile-img-circle mb-2">
                        <?php } else { ?>
                            <img src="../assets/Upload/femaleadmin.png" alt="Profile Image" class="profile-img-circle mb-2">
                        <?php } ?>
                        <h4>
                            <?php echo ucwords(strtolower($fullName)); ?>
                            <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                        </h4>

                        <p class="text-muted"><?php echo ucwords(strtolower($showSchool['SCHOOL_NAME'])); ?></p>
                    </div>

                    <div class="profile-details">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p><?php echo $showResult['email']; ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Phone:</strong>
                                <p>+63<?php echo $showResult['contact']; ?></p>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Role:</strong>
                                <p><?php echo ucwords(strtolower($_SESSION["user_role"])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Joined:</strong>
                                <p><?php echo htmlspecialchars($_SESSION["admin_added"]); ?></p>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Address:</strong>
                                <p><?php echo ucwords(strtolower($showResult['address'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Gender:</strong>
                                <p><?php echo ucwords(strtolower($showResult['gender'])); ?></p>
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
        var form = document.getElementById("editAdminInfo");
        if (form) {
            form.reset(); // Clears the form fields
            form.classList.remove("was-validated"); // Removes the validation styling
        }
    }
</script>
<script src="../assets/js/validationform.js"></script>