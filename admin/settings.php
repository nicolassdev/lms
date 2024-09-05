<?php
include "../admin/includes/update-inc.php";
include "../admin/includes/Operation/updateSetting.php";
?>
<!-- DISPLAY IN HOME  -->
<div class="mt-5">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
            <h2 class="ms-3">School Information</h2>

            <button type="button" class="btn btn-primary mb-3 me-3" title="Edit" data-bs-toggle="modal" data-bs-target="#setting" data-bs-whatever="@fat">
                <i class="bi bi-pencil-square"></i>
            </button>
        </div>
        <form action="?page=settings" method="POST" class="border rounded p-5 bg-light mb-5 ms-3 me-3 shadow">
            <div class="mb-4">
                <label for="school" class="form-label">School Name</label>
                <input type="text" id="school" name="school" value="<?php echo $result['SCHOOL_NAME']; ?>" class="form-control form-control-lg" autocomplete="off" disabled>
            </div>
            <div class="mb-4">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $result['SCHOOL_ADDRESS']; ?>" class="form-control form-control-lg" autocomplete="off" disabled>
            </div>
        </form>
    </main>
</div>


<!-- MODAL TO UPDATE  -->
<!-- <div class="modal fade" id="student" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content b-grey">
             <div class="modal-header">
                 <h5 class="modal-title " id="updateModalLabel">Edit School Information</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <div class="modal-body">

                 Form of student
                 <form action="?page=settings" method="POST" class="mb-3 ms-3 m-3">
                     <div class="mb-3">
                         <label for="school" class="form-label">School Name</label>

                         <input type="text" id="school" name="school" value=" " class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="address" class="form-label">Address</label>
                         <input type="text" id="address" name="address" value=" " class="form-control" autocomplete="off">
                     </div>
                     <div class="text-end">
                         <button name="submit" class="btn btn-success">Update</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div> -->



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
                <button class="btn btn-success me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
            </div>
        </div>
    </div>
</div>





<!-- Bootstrap JS (Ensure Bootstrap JS is loaded for modal functionality) -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>