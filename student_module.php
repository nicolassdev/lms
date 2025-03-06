<?php
// Prevent unauthorized access

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
?>
<?php

include "./includes/dbh-inc.php";

$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
// Get teacher's assigned subjects
$studentSubjects = $mySQLFunction->getStudentSubjects($_SESSION['stu_lrn']);

// Disconnect DB
$mySQLFunction->disconnect();
?>

<!-- Style for the cards and layout -->
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        transform: scale(1.05);
    }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <div class="ms-3 w-100">
            <div class="container mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold text-muted">
                        Module
                    </h4>



                    <!-- Search Bar -->
                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <?php
                            $hasModules = false; // Start with the assumption that no modules are found.

                            foreach ($studentSubjects as $subject):
                                $mySQLFunction->connection();
                                $schedId = $subject['sched_id'];
                                $hasModule = $mySQLFunction->checkExistByID("module", "sched_id", $schedId);

                                if ($hasModule > 0): // If module exists for this subject
                                    $hasModules = true;
                                    break; // No need to continue checking other subjects if we already found a module.
                                endif;
                            endforeach;
                            ?>

                            <!-- Search Input -->
                            <input type="text" id="searchModule" class="form-control" placeholder="Search subject module..." <?php echo $hasModules ? '' : 'disabled'; ?>>
                            <i class="bi bi-search me-2 ms-2 fs-5"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!-- Subject Cards -->
    <div class="row g-4 mb-4 ms-2 me-2" id="subjectContainer">
        <?php if (!empty($studentSubjects)): ?>
            <?php
            $hasModules = false; // Flag to check if at least one subject has a module

            foreach ($studentSubjects as $subject):
                $mySQLFunction->connection();
                $schedId = $subject['sched_id'];
                // $hasModule = $mySQLFunction->checkExistModuleID("module", $schedId);
                $hasModule = $mySQLFunction->checkExistByID("module", "sched_id", $schedId);
                if ($hasModule > 0): // If module exists, render the subject
                    $hasModules = true;
            ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 subject-card" data-title="<?php echo htmlspecialchars(strtolower($subject['sub_title'])); ?>">
                        <div class="card h-100 border-0 shadow-lg rounded-4">
                            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4 px-3 py-2">
                                <div class="text-truncate">
                                    <h6 class="mb-0 fw-bold text-truncate mt-3">
                                        <i class="bi bi-book-half me-2"></i>
                                        <?php echo htmlspecialchars(ucwords(strtolower($subject['sub_title'] ?? 'No Title'))); ?>
                                    </h6>
                                    <small class="fw-semibold ms-4 text-sm">
                                        <?php echo htmlspecialchars(ucwords(strtolower($subject['sub_type'] ?? 'No Type'))); ?> Subject
                                    </small>
                                </div>
                                <div class="dropdown">
                                    <i class="bi bi-three-dots-vertical text-white fs-5" id="kebabMenu" data-bs-toggle="dropdown" role="button" aria-expanded="false" style="cursor: pointer;"></i>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="kebabMenu">
                                        <li><a class="dropdown-item text-black" href="#" onclick="confirmDelete()">Move</a></li>
                                        <hr class="dropdown-divider">
                                        <li><a class="dropdown-item text-black" href="#" onclick="cancelAction()">Cancel</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row align-items-center mb-2">
                                    <div class="col text-start">
                                        <small class="fw-bold fs-6 ms-3">
                                            <?php
                                            echo ucwords(strtolower($subject["teacher_fname"] . ' ' . $subject["teacher_lname"])) ?: 'No Subject Teacher';
                                            ?>
                                        </small>
                                    </div>
                                    <div class="col-auto">
                                        <?php
                                        $uploadDir = "./assets/Upload/";
                                        if (!empty($subject['image']) && file_exists($uploadDir . $subject['image'])) {
                                        ?>
                                            <img src="<?php echo htmlspecialchars($uploadDir . $subject['image']); ?>" alt="Profile Image" draggable="false" class="profile-img-teacher">
                                        <?php
                                        } else {
                                            $defaultImage = $subject['teacher_gender'] === "MALE" ? "default-male.png" : "default-female.png";
                                        ?>
                                            <img src="./assets/Upload/resources/<?php echo $defaultImage; ?>" alt="Profile Image" draggable="false" class="profile-img-teacher">
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center text-muted">

                                    <span class="fw-bold fs-6 ms-3"><?php echo ucwords(strtolower($subject["grade_lvl"])) . ' ' . htmlspecialchars($subject["strand_name"]); ?></span>
                                </div>

                                <div class="text-secondary ms-3">
                                    <small class="fw-semibold">
                                        <?php
                                        if (!empty($activeSchoolYears) && !empty($activeSem)) {
                                            foreach ($activeSchoolYears as $index => $schoolYear) {
                                                echo '<div>' . htmlspecialchars($activeSem[$index]) . '</div>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-warning p-2 mb-0">No active school year and semester found.</div>';
                                        }
                                        ?>
                                    </small>
                                </div>


                            </div>

                            <div class="card-footer bg-light d-flex justify-content-center rounded-bottom-4">
                                <a href="index.php?page=subject_list&sub_code=<?php echo urlencode($subject['sub_code']); ?>&strand_code=<?php echo urlencode($subject['strand_code']); ?>&grade_lvl=<?php echo urlencode($subject['grade_lvl']); ?>" class="btn btn-outline-success w-100 fw-bold d-flex align-items-center justify-content-center">
                                    <i class="bi bi-journals me-2"></i> View Module
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;

            // Display message only if no subjects had modules
            if (!$hasModules):
                ?>
                <div class="col-12 text-center py-5">
                    <div class="card-body">
                        <i class="bi bi-info-circle-fill text-danger display-4 mb-3"></i>
                        <h5 class="text-secondary fw-bold">No Modules Found</h5>
                        <small class="text-muted"> Please reach out to your subject teacher or administrator for further assistance.</small>
                    </div>
                </div>
            <?php endif; ?>



            <!-- NOTE: for search bar purpose -->
            <!-- No Subjects Found Message  search bar-->
            <div class="col-12 text-center d-none no-results">
                <div class="py-5">
                    <div class="card-body">
                        <i class="bi bi-exclamation-circle text-danger display-4 mb-3"></i>
                        <h5 class="text-secondary fw-bold no-subject">No Modules Found</h5>
                        <p class="text-muted mb-0">You can use the search bar above to find your modules.</p>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="col-12 text-center">
                <div class="py-5">
                    <div class="card-body">
                        <i class="bi bi-exclamation-circle text-danger display-4 mb-3"></i>
                        <h5 class="text-secondary fw-bold no-subject">No Subject Available</h5>
                        <p class="text-muted mb-0">There are currently no subjects assigned to you.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

</main>

<script>
    document.getElementById('searchModule').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const cards = document.querySelectorAll('.subject-card');
        let found = false;

        cards.forEach(card => {
            const title = card.getAttribute('data-title') || '';
            const matches = title.includes(filter);
            card.style.display = matches ? '' : 'none';
            if (matches) found = true;
        });

        // Show/Hide the "No Results Found" message
        document.querySelector('.no-results').classList.toggle('d-none', found);
    });
</script>


<!-- This is post method -->
<!-- <form action="index.php?page=upload_module" method="POST" class="d-inline">
    <input type="hidden" name="sub_code" value=" ">
    <input type="hidden" name="section_code" value=" ">
    <button type="submit" class="btn btn-outline-success w-100 fw-bold">
        <i class="bi bi-person-lines-fill me-2"></i>View Students
    </button>
</form> -->