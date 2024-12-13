 <!-- ADDING STRAND MODAL -->
 <div class="modal fade" id="section" tabindex="-1" aria-labelledby="strandModal" aria-hidden="true">
     <div class="modal-dialog ">
         <div class="modal-content">

             <div class="modal-header">
                 <h1 class="modal-title fs-5 text-primary">Create new section</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormSection()"></button>
             </div>

             <div class="modal-body">
                 <form id="sectionForm" action="./includes/section-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                     <!-- SECTION SELECTION -->
                     <div class="col-md-12">
                         <label class="form-label">Section name</label>
                         <input type="text" class="form-control" name="section" required>

                         <div class="invalid-feedback">
                             Please input a section name.
                         </div>
                     </div>



                     <!-- STRAND NAME  -->
                     <div class="col-md-12">
                         <label class="form-label">Strand </label>
                         <select class="form-select" id="strandSelect" name="strand_code" required>
                             <option value="" selected disabled>Select a strand...</option>
                             <!-- limit the strand display accourding to section  -->
                             <?php
                                $mySQLFunction->connection();
                                $result = $mySQLFunction->getStrand();
                                $hasAvailableStrand = false;

                                if (empty($result)) {
                                    echo '<option disabled>No strand found in the database.</option>';
                                } else {

                                    foreach ($result as $row) {
                                        // IF THE SECTION WAS MULTIPLE AT THE SAME STRAND WE LIMIT ATLEAST 10 
                                        // AND WILL NOT DISPLAY THE STRAND WHEN IT'S ALREADY MEET THE CONDTION
                                        if (($mySQLFunction->checkRowCount("section", "strand_code", $row["strand_code"])) == 10) {
                                            continue;
                                        } else {
                                            echo '<option value="' . $row["strand_code"] . '">' . $row["strand_desc"] . ' </option>';
                                            $hasAvailableStrand = true;
                                        }
                                    }
                                }

                                if (!$hasAvailableStrand) {
                                    echo '<option disabled>No strand available for section.</option>';
                                }

                                ?>
                         </select>
                         <div class="invalid-feedback">
                             Please select a strand name.
                         </div>
                     </div>



                     <!-- GRADE LEVEL -->
                     <div class="col-md-12">
                         <label class="form-label">Grade Level</label>
                         <select class="form-select" name="gradelvl" id="gradelvl" required>
                             <option selected disabled value="">Select...</option>
                             <option value="GRADE-12">GRADE-12</option>
                             <option value="GRADE-11">GRADE-11</option>
                         </select>
                         <div class="invalid-feedback">
                             Please select a grade level.
                         </div>
                     </div>


                     <div class="col-md-12">
                         <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Save</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script>
     // Function to reset the form inputs
     function resetFormSection() {
         const form = document.getElementById('sectionForm');
         form.reset();
         form.classList.remove('was-validated');
         sectionSelect.innerHTML = '<option selected disabled value="">Select...</option>';
     }
 </script>