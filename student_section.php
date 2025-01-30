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

// GET CLASSMATES AND ADVISER WITH THE SAME STRAND, SECTION AND GRADE LEVEL
$result = $mySQLFunction->getStudentStrandAndSectionaAlsoAdviser($_SESSION['stu_lrn']);


?>


<style>
    .classmate-img-circle {
        width: 100px;
        height: 100px;
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
                    <?php if (!empty($result)) : ?>
                        <div class="d-flex justify-content-between align-items-center border-bottom pt-2">
                            <div class="d-flex flex-column">
                                <?php
                                $payload = $result[0];
                                echo "<h5 class='fw-bold text-danger'>" . htmlspecialchars($payload["grade_lvl"]) . " - " . htmlspecialchars($payload["section_name"]) . "</h5>";
                                echo "<small class='fw-semibold pb-2'>" . htmlspecialchars($payload["strand_desc"]) . " </small>";

                                ?>
                            <?php endif; ?>
                            </div>

                        </div>

                        <!-- Main Student and Adviser Info -->
                        <div class="row align-items-center  border-bottom pt-3">
                            <?php if (!empty($result)) : ?>
                                <h5 class="fw-bold">Adviser</h5>
                                <div class="col-lg-12 text-center text-sm-start">
                                    <!-- </div>
                                <div class="col-lg-4 text-center"> -->
                                    <?php
                                    // Define the path to the uploaded images directory
                                    $uploadDir = "./assets/Upload/";

                                    // Check if the image path exists and the file is accessible
                                    if (!empty($payload['image']) && file_exists($uploadDir . $payload['image'])) {
                                    ?>
                                        <img src="<?= htmlspecialchars($uploadDir . $payload['image']); ?>" alt="Profile Image" draggable="false" class="classmate-img-circle mb-2">
                                        <?php
                                    } else {
                                        // Fallback to the default image based on gender
                                        if (!empty($payload['teacher_gender']) && $payload['teacher_gender'] === "MALE") {
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

                                    <h6 class="mb-3"><?= htmlspecialchars(ucwords(strtolower(($payload["teacher_fname"] . " " . $payload["teacher_lname"])))) ?></h6>

                                </div>
                            <?php else : ?>
                                <div class="col-12 text-center">
                                    <div class="py-5">
                                        <div class="card-body">
                                            <i class="bi bi-exclamation-circle text-danger display-4 mb-3"></i>
                                            <h5 class="text-secondary fw-bold no-subject">Section Not Available</h5>
                                            <p class="text-muted mb-0">There are currently no section assigned to you.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>


                        <!-- Classmates -->
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="fw-bold mb-4 mt-3">Classmates</h4>
                                <div class="text-end">
                                    <small class="text-muted">
                                        <?php
                                        if (!empty($result)) {
                                            echo (count($result) - 1) . " Student(s)";
                                        }
                                        ?>
                                    </small>
                                </div>
                            </div>

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
                                                        <h6 class="card-title"><?= htmlspecialchars(ucwords(strtolower(($classmate["classmate_fname"] . " " . $classmate["classmate_lname"])))) ?></h6>
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