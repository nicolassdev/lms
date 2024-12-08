<?php
// PHP Logic
if (!isset($_SESSION['username'])) {
    header("location:../login.php?error=accessdenied");
    exit();
} elseif (isset($_SESSION['user_role'])) {

    $user_role = strtolower($_SESSION['user_role']);
    if ($user_role !== 'teacher') {
        header("location:../login.php?error=accessdenied"); // redirect access denied if user role is not admin
        exit();
    }
} else {
    header("location:../login.php"); // Redirect to login page if user role is not exist 
    exit();
}


require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();

// Debugging: Check if teacher_id is set in session
if (!isset($_SESSION['teacher_id'])) {
    echo "Teacher ID not set in session.";
    exit();
}

$teacherInfo = $mySQLFunction->getTeacherInfo($_SESSION['teacher_id']);

$teacherSectionHandled = $mySQLFunction->getTeacherSectionHandled($_SESSION['teacher_id']);  //section handled by teacher

$teacherSubjectHandled = $mySQLFunction->getTeacherSubjectHandled($_SESSION['teacher_id']); //get subject array in database

$teacherName = $teacherInfo['teacher_fname'] . ' ' . $teacherInfo['teacher_mname'] . ' ' . $teacherInfo['teacher_lname'];



// Birthday formatted
$birthDate = new DateTime($teacherInfo['teacher_dob']);

$formattedbirthDate = $birthDate->format('F j, Y');


$mySQLFunction->disconnect();
// include "../admin/includes/Forms/adminform.php";
?>

<!-- Modal to Update STUDENT Information -->
<div class="modal fade" id="updateteacherinfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Teacher Information</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form action="./includes/Operation/updateTeacherProfile.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editTeacherInfo">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars(ucwords(strtolower($teacherInfo['teacher_fname']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" value="<?php echo htmlspecialchars(ucwords(strtolower($teacherInfo['teacher_mname']))); ?>" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" value="<?php echo htmlspecialchars(ucwords(strtolower($teacherInfo['teacher_lname']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the last name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars(ucwords(strtolower($teacherInfo['teacher_address']))); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter your address.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                <input type="text" class="form-control" name="contact" value="<?php echo htmlspecialchars($teacherInfo['teacher_contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="MALE" <?php echo ($teacherInfo['teacher_gender'] === 'MALE') ? 'selected' : ''; ?>>Male</option>
                                <option value="FEMALE" <?php echo ($teacherInfo['teacher_gender'] === 'FEMALE') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <div class="invalid-feedback">Please select your gender.</div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo htmlspecialchars($teacherInfo['teacher_dob']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label for="employementstatus" class="form-label">Employment Status</label>
                            <select name="employementstatus" id="employementstatus" class="form-select" required>
                                <option value="" disabled selected>Select Employment Status</option>
                                <option value="full time"
                                    <?php echo (strtolower($teacherInfo['status']) === 'full time') ? 'selected' : ''; ?>>
                                    Full-Time
                                </option>
                                <option value="part time"
                                    <?php echo (strtolower($teacherInfo['status']) === 'part time') ? 'selected' : ''; ?>>
                                    Part-Time
                                </option>

                                <option value="On Leave"
                                    <?php echo (strtolower($teacherInfo['status']) === 'on leave') ? 'selected' : ''; ?>>
                                    On Leave
                                </option>
                                <option value="Inactive"
                                    <?php echo (strtolower($teacherInfo['status']) === 'inactive') ? 'selected' : ''; ?>>
                                    Inactive
                                </option>
                            </select>
                            <div class="invalid-feedback">Please select an employment status.</div>
                        </div>
                        <!-- Profile Image -->
                        <div class="mb-3">
                            <label class="form-label">Upload photo</label>
                            <input type="file" class="form-control" name="profile_image" accept="image/*" onchange="previewImage(event)">
                            <div class="invalid-feedback">Please upload an image.</div>
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
        <img
            style="position: absolute; top: 50%; right: 10%; transform: translate(-10%, -45%); 
                        width: 500px; opacity: 0.1; z-index: -1;"
            src="../assets/img/csi.webp"
            alt="LMS Logo">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex flex-wrap justify-content-end mb-4">
                    <!-- <button class="btn btn-secondary btn-sm me-2 mb-2"
                            onclick="location.href='index.php?page=index'">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </button> -->

                    <button type="button" class="btn btn-primary btn-sm me-3"
                        title="Edit" data-bs-toggle="modal" data-bs-target="#updateteacherinfo">
                        <i class="bi bi-pencil-square me-1"></i>Edit Information
                    </button>
                </div>


                <div class="container">

                    <div class="row">

                        <!-- Right Column: Profile Header -->
                        <div class="col-md-4 text-center profile-header">

                            <?php
                            // Define the path to the uploaded images directory
                            $uploadDir = "../assets/Upload/";

                            // Check if the image path exists and the file is accessible
                            if (!empty($teacherInfo['image']) && file_exists($uploadDir . $teacherInfo['image'])) {
                            ?>
                                <img src="<?php echo htmlspecialchars($uploadDir . $teacherInfo['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-circle mb-2">
                                <?php
                            } else {
                                // Fallback to the default image based on gender
                                if ($teacherInfo['teacher_gender'] === "MALE") {
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


                            <h4>
                                <?php echo ucwords(strtolower($teacherName)); ?>
                                <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                            </h4>

                            <p class="text-muted"><?php echo ucwords(strtolower($showSchool['SCHOOL_NAME'])); ?></p>
                            <span class="badge bg-success text-white">ID</span>
                            <small class="text-muted fw-semibold">
                                <?php echo htmlspecialchars($teacherInfo['teacher_id'], ENT_QUOTES, 'UTF-8'); ?>
                            </small>
                        </div>
                        <!-- Left Column: Profile Details -->
                        <div class="col-md-8 profile-details">
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <strong>Role:</strong>
                                    <p><?php echo ucwords(strtolower($_SESSION["user_role"])); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone:</strong>
                                    <p>+63<?php echo $teacherInfo['teacher_contact']; ?></p>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <strong>Gender:</strong>
                                    <p><?php echo ucwords(strtolower($teacherInfo['teacher_gender'])); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Employment Status:</strong>
                                    <p><?php echo ucwords(strtolower($teacherInfo['status'])); ?></p>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <strong>Date of Birth:</strong>
                                    <p><?php echo htmlspecialchars($formattedbirthDate); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Address:</strong>
                                    <p><?php echo ucwords(strtolower($teacherInfo['teacher_address'])); ?></p>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <strong>Username:</strong>
                                    <p><?php echo htmlspecialchars($_SESSION["username"]); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <p>Active</p>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <strong>Section Handled:</strong>
                                    <p>
                                        <?php
                                        if (isset($teacherSectionHandled["grade_lvl"]) && isset($teacherSectionHandled["section_name"])) {
                                            echo ucwords(strtolower($teacherSectionHandled["grade_lvl"])) . ' ' . ucwords(strtolower($teacherSectionHandled["section_name"]));
                                        } else {
                                            echo '<div class="text-danger">Section information not available!</div>';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Subjects Handled:</strong>
                                    <p>
                                        <?php
                                        if (!empty($teacherSubjectHandled)) {
                                            foreach ($teacherSubjectHandled as $subject) {
                                                echo ucwords(strtolower($subject["sub_title"])) . ' | ' . htmlspecialchars($subject["strand_name"]) . ' | ' . ucwords(strtolower($subject["sub_gradelvl"])) . '<br>';
                                            }
                                        } else {
                                            echo '<div class="text-danger">No subject handled available.</div>';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Joined:</strong>
                                    <p>
                                        <?php
                                        if (isset($_SESSION["teacher_added"])) {
                                            echo htmlspecialchars($_SESSION["teacher_added"]);
                                        } else {
                                            echo 'Join date not available.';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                >












            </div>
        </div>
    </div>
</main>



<script>
    function resetForm() {
        var form = document.getElementById("editTeacherInfo");
        if (form) {
            form.reset(); // Clears the form fields
            form.classList.remove("was-validated"); // Removes the validation styling
        }
    }
</script>
<script src="../assets/js/validationform.js"></script>