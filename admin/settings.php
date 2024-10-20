<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>
<?php
include "../admin/includes/update-inc.php";
include "../admin/includes/Operation/updateSetting.php";
$mySQLFunction->connection();
$activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
$activeSem = $mySQLFunction->checkSemStatus('semester');
$mySQLFunction->disconnect();



?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
        <h4 class="ms-3">School Information</h4>

        <!-- Button container for proper alignment -->
        <div class="d-flex gap-3">
            <!-- Semester button -->
            <a href="index.php?page=semester" class="btn btn-primary mb-3 ms-3 btn-animate">
                <span>📅 Semester</span>
            </a>

            <a href="index.php?page=schoolyear" class="btn btn-primary mb-3 btn-animate">
                <span>🗓 School Year</span>
            </a>

            <!-- Edit button with tooltip -->
            <button type="button" class="btn btn-secondary mb-3 btn-animate" title="Edit" data-bs-toggle="modal" data-bs-target="#setting" data-bs-whatever="@fat">
                <i class="bi bi-pencil-square"></i>
            </button>
        </div>
    </div>

    <!-- Form Section -->
    <form action="?page=settings" method="POST" class="border rounded p-4 bg-light mb-5 ms-3 me-3 shadow-lg row form-hover custom-shadow">
        <div class="mb-3 fade-in-input">
            <label for="school" class="form-label"><i class="bi bi-bank text-primary"></i> School Name</label>
            <input type="text" id="school" name="school" value="<?php echo ucwords(strtolower($result['SCHOOL_NAME'])); ?>" class="form-control" autocomplete="off" disabled>
        </div>
        <div class="mb-3 fade-in-input">
            <label for="address" class="form-label"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Address</label>
            <input type="text" id="address" name="address" value="<?php echo ucwords(strtolower($result['SCHOOL_ADDRESS'])); ?>" class="form-control" autocomplete="off" disabled>
        </div>
        <div class="col-6 mb-3 fade-in-input">
            <label for="schoolyear" class="form-label"><i class="bi bi-calendar4-week text-warning"></i> School Year</label>
            <input type="text" name="schoolyear" value="<?php
                                                        if (!empty($activeSchoolYears)) {
                                                            foreach ($activeSchoolYears as $schoolYear) {
                                                                echo $schoolYear;
                                                            }
                                                        } else {
                                                            echo "No active school year found.";
                                                        } ?>" class="form-control" autocomplete="off" disabled>
        </div>
        <div class="col-6 mb-3 fade-in-input">
            <label for="semester" class="form-label"><i class="bi bi-calendar-month text-success"></i> Semester</label>
            <input type="text" name="semester" value="<?php
                                                        if (!empty($activeSem)) {
                                                            foreach ($activeSem as $semester) {
                                                                echo $semester;
                                                            }
                                                        } else {
                                                            echo "No active semester found.";
                                                        } ?>" class="form-control" autocomplete="off" disabled>
        </div>
    </form>
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