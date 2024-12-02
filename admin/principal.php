<?php
// PHP Logic
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
    exit();
}
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();



$showResult = $mySQLFunction->getInfo('PRINCIPAL');
if ($showResult) { // Check if data was returned
    $principalfullName = $showResult['firstname'] . ' ' . $showResult['middlename'] . ' ' . $showResult['lastname'];
    // echo "Full Name: $fullName";
} else {
    echo "No data found for the specified table.";
}
$mySQLFunction->disconnect();
include "../admin/includes/Forms/principalform.php";
?>
<style>
    .profile-img-circle {
        border-radius: 50%;
        border: 2px solid #f1f1f1;
    }

    .profile-header h4 {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .profile-header p {
        font-size: 1rem;
        color: #777;
    }
</style>

<!-- Modal to Update Admin Information -->
<div class="modal fade" id="updateprincipalinfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Update Principal Information</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form action="./includes/Operation/updatePrincipal.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editAdminInfo">
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
                                <option value="MALE" <?php echo ($showResult['gender'] === 'MALE') ? 'selected' : ''; ?>>Male</option>
                                <option value="FEMALE" <?php echo ($showResult['gender'] === 'FEMALE') ? 'selected' : ''; ?>>Female</option>
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

                        <!-- Profile Image -->
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image" accept="image/*" onchange="previewImage(event)">
                            <div class="invalid-feedback">Please upload an image.</div>
                        </div>

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

                <div class="d-flex flex-wrap justify-content-end">
                    <!-- <button class="btn btn-secondary btn-sm me-2 mb-2"
                        onclick="location.href='index.php?page=index'">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </button> -->

                    <button type="button" class="btn btn-primary btn-sm mb-2 me-2"
                        title="Edit" data-bs-toggle="modal" data-bs-target="#updateprincipalinfo">
                        <i class="bi bi-pencil-square me-2"></i>Edit information
                    </button>
                    <!-- this is adding another principal button i will leave it comment , if needed just uncomment this button down-->
                    <!-- <button type="button" class="btn btn-success btn-sm me-2 mb-2"
                        title="Add Principal" data-bs-toggle="modal" data-bs-target="#principal">
                        <i class="bi bi-person-add"></i>
                    </button> -->
                </div>

                <div class="container py-4">
                    <img
                        style="position: absolute; top: 50%; right: 10%; transform: translate(-10%, -45%); 
                        width: 450px; opacity: 0.1; z-index: -1;"
                        src="../assets/img/csi.webp"
                        alt="LMS Logo">
                    <div class="row">
                        <!-- Left side: Image and Name -->
                        <div class="col-md-4 d-flex flex-column align-items-center text-center">


                            <?php
                            // Define the path to the uploaded images directory
                            $uploadDir = "../assets/Upload/";

                            // Check if the image path exists and the file is accessible
                            if (!empty($showResult['image']) && file_exists($uploadDir . $showResult['image'])) {
                            ?>
                                <img src="<?php echo htmlspecialchars($uploadDir . $showResult['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                <?php
                            } else {
                                // Fallback to the default image based on gender
                                if ($showResult['gender'] === "MALE") {
                                ?>
                                    <img src="../assets/Upload/default-male.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                <?php
                                } else {
                                ?>
                                    <img src="../assets/Upload/default-female.png" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                            <?php
                                }
                            }
                            ?>


                            <!-- Principal's Name and School -->
                            <div class="profile-header mb-4">
                                <h4 class="mb-2"><?php echo ucwords(strtolower($principalfullName)); ?>
                                    <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                                </h4>
                                <p class="text-muted"><?php echo ucwords(strtolower($showSchool['SCHOOL_NAME'])); ?></p>
                            </div>
                        </div>

                        <!-- Right side: Information -->
                        <div class="col-md-8">
                            <form>
                                <!-- Email and Phone Row -->
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" value="<?php echo $showResult['email']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="phone" value="+63<?php echo $showResult['contact']; ?>" readonly>
                                    </div>
                                </div>

                                <!-- Role and Join Date Row -->
                                <div class="mb-3 row">
                                    <label for="role" class="col-sm-3 col-form-label">Role:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="role" value="<?php echo ucwords(strtolower($showResult["role"])); ?>" readonly>
                                    </div>
                                </div>


                                <!-- Address and Gender Row -->
                                <div class="mb-3 row">
                                    <label for="address" class="col-sm-3 col-form-label">Address:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" value="<?php echo ucwords(strtolower($showResult['address'])); ?>" readonly>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="gender" class="col-sm-3 col-form-label">Gender:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="gender" value="<?php echo ucwords(strtolower($showResult['gender'])); ?>" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="joined" class="col-sm-3 col-form-label">Joined:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="joined" value="<?php echo htmlspecialchars($_SESSION["admin_added"]); ?>" readonly>
                                    </div>
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
    function resetForm() {
        var form = document.getElementById("editAdminInfo");
        if (form) {
            form.reset(); // Clears the form fields
            form.classList.remove("was-validated"); // Removes the validation styling
        }
    }
</script>
<script src="../assets/js/validationform.js"></script>