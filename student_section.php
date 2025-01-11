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

$studentStrandAndSection = $mySQLFunction->getStudentStrandAndSection($_SESSION['stu_lrn']); //get student section array in database


$studentFullName = $studentInfo['stu_fname'] . ' ' . $studentInfo['stu_mname'] . ' ' . $studentInfo['stu_lname'];



// Birthday formatted
$birthDate = new DateTime($studentInfo['stu_dob']);
$formattedbirthDate = $birthDate->format('F j, Y');



$mySQLFunction->disconnect();
// include "../lms/includes/Forms/studentinfoform.php";
?>
<main class="col-md-12 ms-sm-auto col-lg-10">
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Header -->
                <div class="profile-header text-center mb-4">
                    <!-- Profile image and name -->
                    <h4 class="fw-bold text-primary">
                        <?php echo ucwords(strtolower($studentFullName)); ?>
                        <i class="bi bi-patch-check-fill ms-1 text-success" style="font-size: 1.1rem;"></i>
                    </h4>
                    <span class="badge bg-success text-white">LRN</span>
                    <small class="text-muted fw-semibold d-block mt-1">
                        <?php echo htmlspecialchars($studentInfo['stu_lrn'], ENT_QUOTES, 'UTF-8'); ?>
                    </small>
                </div>

                <!-- Buttons Section -->
                <div class="d-flex justify-content-center mb-4">
                    <button class="btn btn-primary me-2" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" onclick="toggleProfileDetails()">People</button>
                    <button class="btn btn-secondary" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" onclick="toggleAdviserSection()">Adviser</button>
                </div>

                <!-- Profile Details (Initially hidden) -->
                <div id="profileDetails" class="profile-details border rounded p-4" style="background-color: #f9f9f9; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); display: none;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Email:</strong>
                            <p><?php echo strtolower($studentInfo['stu_email']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong>
                            <p>+63<?php echo $studentInfo['stu_contact']; ?></p>
                        </div>
                    </div>

                    <!-- Add additional sections as needed, same as "People" profile -->

                </div>

                <!-- Section and Adviser (Initially hidden) -->
                <div id="adviserSection" class="adviser-details border rounded p-4" style="background-color: #f9f9f9; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); display: none;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Section and Adviser:</strong>
                            <p>
                                <?php
                                if (!empty($studentStrandAndSection)) {
                                    foreach ($studentStrandAndSection as $section) {
                                        echo htmlspecialchars($section["section_name"]) . ' - ' . htmlspecialchars(ucwords(strtolower($section["teacher_fname"] . ' ' . $section["teacher_lname"]))) . '<br>';
                                    }
                                } else {
                                    echo '<span class="text-danger">No section assigned to this student.</span>';
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Function to toggle visibility of profile details
    function toggleProfileDetails() {
        var profileDetails = document.getElementById("profileDetails");
        if (profileDetails.style.display === "none") {
            profileDetails.style.display = "block"; // Show profile details
        } else {
            profileDetails.style.display = "none"; // Hide profile details
        }
    }

    // Function to toggle visibility of adviser section (with section and adviser data)
    function toggleAdviserSection() {
        var adviserSection = document.getElementById("adviserSection");
        if (adviserSection.style.display === "none") {
            adviserSection.style.display = "block"; // Show adviser section
        } else {
            adviserSection.style.display = "none"; // Hide adviser section
        }
    }
</script>


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