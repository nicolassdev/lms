<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>
<?php
include "../admin/includes/update-inc.php";
include "../admin/includes/Operation/updateSetting.php";
$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$activeQuarter = $mySQLFunction->checkQuarterStatus('quarterly');


$mySQLFunction->disconnect();



?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  ">
        <h3 class="fw-bold ms-3">Settings</h3>

        <!-- Button container for proper alignment -->
        <div class="d-flex flex-wrap gap-2 justify-content-center p-3">
            <!-- Admin Account Button -->
            <a href="index.php?page=account" class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-3 py-2">
                <i class="bi bi-person-vcard-fill me-2"></i> Account
            </a>

            <!-- Quarterly Button -->
            <a href="index.php?page=quarterly" class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-3 py-2">
                <i class="bi bi-gear-fill me-2"></i> Quarterly
            </a>

            <!-- Semester Button -->
            <a href="index.php?page=semester" class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-3 py-2">
                <i class="bi bi-sliders me-2"></i> Semester
            </a>

            <!-- School Year Button -->
            <a href="index.php?page=schoolyear" class="btn btn-outline-dark btn-sm rounded-pill shadow-sm px-3 py-2">
                <i class="bi bi-calendar3 me-2"></i> School Year
            </a>
        </div>


        <!-- Edit button with tooltip
            <button type="button" class="btn btn-secondary btn-sm btn-animate" title="Edit" data-bs-toggle="modal" data-bs-target="#setting" data-bs-whatever="@fat">
                <i class="bi bi-pencil-square"></i>
            </button> -->
        <!-- </div> -->
    </div>

    <!-- Form Section -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-20">
                <div class="row">
                    <div class="col-md-7 mb-4">
                        <div class="card shadow-lg fade-in-input">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-semibold">School Information</h6>
                                <button type="button" class="btn btn-success btn-sm btn-animate" title="Edit" data-bs-toggle="modal" data-bs-target="#setting" data-bs-whatever="@fat">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                            <div class="card-body p-4">
                                <form action="?page=settings" method="POST" class="row g-3">
                                    <div class="col-md-12">
                                        <label for="school" class="form-label"><i class="bi bi-bank text-primary"></i> School Name</label>
                                        <input type="text" id="school" name="school" value="<?php echo ucwords(strtolower($result['school_name'])); ?>" class="form-control" autocomplete="off" disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address" class="form-label"><i class="bi bi-geo-alt-fill me-2 text-danger"></i> Address</label>
                                        <input type="text" id="address" name="address" value="<?php echo ucwords(strtolower($result['school_address'])); ?>" class="form-control" autocomplete="off" disabled>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 mb-4">
                        <div class="card shadow-lg fade-in-input">
                            <div class="card-header bg-light">
                                <h6 class="mb-0 fw-semibold">Active Periods</h6>
                            </div>
                            <div class="card-body p-4 row g-3">
                                <div class="col-md-12 mb-3">
                                    <label for="semester" class="form-label"> <i class="bi bi-gear-fill text-secondary"></i> Quarter</label>
                                    <input type="text" name="semester" value="<?php if (!empty($activeQuarter)) {
                                                                                    foreach ($activeQuarter as $quarter) {
                                                                                        echo $quarter;
                                                                                    }
                                                                                } else {
                                                                                    echo "No active quarter found.";
                                                                                } ?>" class="form-control" autocomplete="off" disabled>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="semester" class="form-label"><i class="bi bi-sliders text-success"></i> Semester</label>
                                    <input type="text" name="semester" value="<?php if (!empty($activeSem)) {
                                                                                    foreach ($activeSem as $semester) {
                                                                                        echo $semester;
                                                                                    }
                                                                                } else {
                                                                                    echo "No active semester found.";
                                                                                } ?>" class="form-control" autocomplete="off" disabled>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="schoolyear" class="form-label"><i class="bi bi-calendar4-week text-warning"></i> School Year</label>
                                    <input type="text" name="schoolyear" value="<?php if (!empty($activeSchoolYears)) {
                                                                                    foreach ($activeSchoolYears as $schoolYear) {
                                                                                        echo $schoolYear;
                                                                                    }
                                                                                } else {
                                                                                    echo "No active school year found.";
                                                                                } ?>" class="form-control" autocomplete="off" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<!-- Modal successfully update structure -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center mt-5">
                <div class="text-success">
                    <i class="bi bi-check-circle fs-1 "></i><br><br>
                </div>
                <p class="mb-4"> School information has been successfully updated. </p>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-5 ">
                <a href="./index.php?page=settings" class="btn btn-success" style="width: 120px;">Okay</a>
            </div>
        </div>
    </div>
</div>





<!-- Bootstrap JS (Ensure Bootstrap JS is loaded for modal functionality) -->

<script src="../assets/js/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>