<?php
// PHP Logic
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();
$showResult = $mySQLFunction->getAdminInfo();
$showUser = $mySQLFunction->getUserInfo();
$fullName = $showResult['firstname'] . ' ' . $showResult['middlename'] . ' ' . $showResult['lastname'];
$addedDate = new DateTime($showUser['date_added']);
$formattedDate = $addedDate->format('F j, Y');
$mySQLFunction->disconnect();
include "../admin/includes/Forms/adminform.php";
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

    /* .profile-header h2,
    .profile-header p {
        font-size: 1.5rem;
    } */
</style>

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
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($showResult['firstname']); ?>" class="form-control" required>
                        <div class="invalid-feedback">Please enter the first name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($showResult['middlename']); ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($showResult['lastname']); ?>" class="form-control" required>
                        <div class="invalid-feedback">Please enter the last name.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Contact</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                            <input type="text" class="form-control" name="contact" value="<?php echo htmlspecialchars($showResult['contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                            <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*" onchange="previewImage(event)" required>
                        <div class="invalid-feedback">Please upload an image.</div>
                    </div>

                    <div class="mb-3 text-center">
                        <img id="imagePreview" class="profile-img" src="#" alt="Image Preview" style="display:none;">
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

                    <div class="text-end">
                        <button name="submit" class="btn btn-primary" type="submit">Update Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-left: 12px;">
            <div class="profile-card">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-secondary btn-sm-custom me-2" onclick="location.href='index.php?page=index'">
                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                    </button>
                    <button type="button" class="btn btn-primary btn-sm-custom me-2" title="Edit" data-bs-toggle="modal" data-bs-target="#updateadmininfo">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <button type="button" class="btn btn-success btn-sm-custom me-2" title="Edit" data-bs-toggle="modal" data-bs-target="#admin">
                        <i class="bi bi-person-add"></i>
                    </button>
                </div>
                <div class="profile-header text-center mb-3">
                    <img src="includes/Upload/admin.jpg" alt="Profile Image" class="profile-img-circle mb-2">
                    <h4><?php echo ucwords(strtolower($fullName)); ?></h4>
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
                            <p><?php echo ucwords(strtolower($showUser['role'])); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Joined:</strong>
                            <p><?php echo htmlspecialchars($formattedDate); ?></p>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6">
                            <strong>Address:</strong>
                            <p><?php echo ucwords(strtolower($showResult['address'])); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <p>Active</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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