<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['stu_lrn'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<!-- FORM MODAL ADD STUDENT  -->
<?php
include "./includes/dbh-inc.php";

include "./faculty/includes/Forms/uploadmoduleform.php";
$mySQLFunction->connection();

// GET CLASSMATES AND ADVISER WITH THE SAME STRAND, SECTION AND GRADE LEVEL
$result = $mySQLFunction->getStudentStrandAndSectionaAlsoAdviser($_SESSION['stu_lrn']);


?>


<style>
    .classmate-img-circle {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #ddd;
    }



    .section {
        transition: transform 0.2s;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top: 10px;
    }

    .section:hover {
        transform: translateY(-5px);
    }
</style>


<!-- TABLE -->


<main class="col-md-12 ms-sm-auto col-lg-10 px-md-4 mt-3">

    <div class="row">
        <div class="col-12">
            <div class="container">
                <div class="mt-2">
                    <!-- Section and Student Count -->
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom ">
                        <div class="d-flex flex-column">
                            <h4 class="fw-bold">People</h4>
                            <small class="text-muted">
                                <?php
                                if (!empty($result)) {
                                    echo (count($result) - 1) . " Student(s)";
                                }
                                ?>
                            </small>
                        </div>
                        <div class="text-end">
                            <?php if (!empty($result)) : ?>
                                <?php
                                $studentInfo = $result[0];
                                echo "<h5 class='fw-bold'>" . htmlspecialchars($studentInfo["section_name"]) . " - Grade " . htmlspecialchars($studentInfo["grade_lvl"]) . "</h5>";
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Main Student and Adviser Info -->
                    <div class="row align-items-center  border-bottom">
                        <?php if (!empty($result)) : ?>
                            <div class="col-lg-12">
                                <h4 class="fw-bold">Adviser</h4>
                                <!-- </div>
                                <div class="col-lg-4 text-center"> -->
                                <?php
                                // Define the path to the uploaded images directory
                                $uploadDir = "./assets/Upload/";

                                // Check if the image path exists and the file is accessible
                                if (!empty($studentInfo['image']) && file_exists($uploadDir . $studentInfo['image'])) {
                                ?>
                                    <img src="<?= htmlspecialchars($uploadDir . $studentInfo['image']); ?>" alt="Profile Image" draggable="false" class="classmate-img-circle mb-2">
                                    <?php
                                } else {
                                    // Fallback to the default image based on gender
                                    if (!empty($studentInfo['teacher_gender']) && $studentInfo['teacher_gender'] === "MALE") {
                                    ?>
                                        <img src="./assets/Upload/resources/default-male.png" alt="Profile Image" draggable="false" class="classmate-img-circle mb-2">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="./assets/Upload/resources/default-female.png" alt="Profile Image" draggable="false" class="classmate-img-circle mb-2">
                                <?php
                                    }
                                }
                                ?>

                                <h6 class="text-muted mb-3"><?= htmlspecialchars($studentInfo["teacher_fname"] . " " . $studentInfo["teacher_lname"]) ?></h6>

                            </div>
                        <?php else : ?>
                            <div class="col-12">
                                <p class="text-danger">No student information available.</p>
                            </div>
                        <?php endif; ?>
                    </div>


                    <!-- Classmates -->
                    <div>
                        <h4 class="fw-bold mb-4 mt-3">Classmates</h4>
                        <div class="row lms-scroll-bar">
                            <?php if (!empty($result)) : ?>
                                <?php foreach ($result as $classmate) : ?>
                                    <?php if ($classmate["classmate_lrn"] !== $_SESSION['stu_lrn']) : ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                            <div class="card section shadow-sm">
                                                <?php
                                                // Define the path to the uploaded images directory
                                                $uploadDir = "./assets/Upload/";

                                                // Check if student_image exists and file path is valid
                                                $studentImagePath = !empty($classmate['student_image']) ? $uploadDir . $classmate['student_image'] : '';
                                                if (!empty($studentImagePath) && file_exists($studentImagePath)) {
                                                    echo '<img src="' . htmlspecialchars($studentImagePath) . '" alt="Profile Image" draggable="false" class="classmate-img-circle mb-2">';
                                                } else {
                                                    // Fallback to default image based on gender
                                                    $defaultImage = $classmate['stu_gender'] === "MALE"
                                                        ? "./assets/Upload/resources/default-male.png"
                                                        : "./assets/Upload/resources/default-female.png";
                                                    echo '<img src="' . htmlspecialchars($defaultImage) . '" alt="Default Profile" draggable="false" class="classmate-img-circle mb-2">';
                                                }
                                                ?>
                                                <div class="card-body">
                                                    <h6 class="card-title"><?= htmlspecialchars($classmate["classmate_fname"] . " " . $classmate["classmate_lname"]) ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="col-12">
                                    <p class="text-danger">No classmates found.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php
    include("./admin/includes/extension.php");
    ?>


</main>