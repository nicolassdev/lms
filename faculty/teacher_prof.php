<?php
// PHP Logic
if (!isset($_SESSION['teacher_id'])) {
    header("location:../login.php?error=accessdenied");
    exit();
}
require_once "../includes/dbh-inc.php";
$mySQLFunction->connection();
$showSchool = $mySQLFunction->getSchool();


$teacherInfo = $mySQLFunction->getTeacherInfo($_SESSION['teacher_id']);


$teacherFullName = $teacherInfo['teacher_fname'] . ' ' . $teacherInfo['teacher_mname'] . ' ' . $teacherInfo['teacher_lname'];



// Birthday formatted
$birthDate = new DateTime($teacherInfo['teacher_dob']);

$formattedbirthDate = $birthDate->format('F j, Y');




$mySQLFunction->disconnect();
// include "../admin/includes/Forms/adminform.php";
?>

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
                            title="Edit" data-bs-toggle="modal" data-bs-target="#updateteacherinfo">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>

                    <div class="profile-header text-center mb-3">
                        <img src="../assets/Upload/admin.jpg" alt="Profile Image" class="profile-img-circle mb-2">
                        <h4><?php echo ucwords(strtolower($teacherFullName)); ?>
                            <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                        </h4>

                        <p class="text-muted"><?php echo ucwords(strtolower($showSchool['SCHOOL_NAME'])); ?></p>




                    </div>

                    <div class="profile-details">
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
                                <strong>Gender</strong>
                                <p><?php echo ucwords(strtolower($teacherInfo['teacher_gender'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Employee Status:</strong>
                                <p><?php echo ucwords(strtolower($teacherInfo['status'])); ?></p>
                            </div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Date of Birth</strong>
                                <p><?php echo htmlspecialchars($formattedbirthDate); ?></p>
                            </div>

                            <div class="col-md-6">
                                <strong>Address:</strong>
                                <p><?php echo ucwords(strtolower($teacherInfo['teacher_address'])); ?></p>
                            </div>
                        </div>




                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Address:</strong>
                                <p><?php echo ucwords(strtolower($teacherInfo['teacher_address'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong>
                                <p>Active</p>
                            </div>
                        </div>




                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>School Name:</strong>
                                <p><?php echo ucwords(strtolower($showSchool['SCHOOL_NAME'])); ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Joined:</strong>
                                <p><?php echo htmlspecialchars($_SESSION["teacher_added"]); ?></p>
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
        var form = document.getElementById("editteacherInfo");
        if (form) {
            form.reset(); // Clears the form fields
            form.classList.remove("was-validated"); // Removes the validation styling
        }
    }
</script>
<script src="../assets/js/validationform.js"></script>