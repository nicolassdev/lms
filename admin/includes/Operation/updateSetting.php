 <!-- MODAL TO UPDATE school information  -->

 
 <div class="modal fade" id="setting" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content bg-gray">
             <div class="modal-header">
                 <h5 class="modal-title " id="updateModalLabel">Edit School Information</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>

             <div class="modal-body">

                 <!-- Form of student -->
                 <form action="?page=settings" method="POST" class="mb-3 ms-3 m-3">
                     <div class="mb-3">
                         <label for="school" class="form-label">School Name</label>

                         <input type="text" id="school" name="school" value="<?php echo $result['SCHOOL_NAME']; ?>" class="form-control">
                     </div>
                     <div class="mb-3">
                         <label for="address" class="form-label">Address</label>
                         <input type="text" id="address" name="address" value="<?php echo $result['SCHOOL_ADDRESS']; ?>" class="form-control" autocomplete="off">
                     </div>
 

                     <div class="text-end">
                         <button name="submit" class="btn btn-success">Update</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 
