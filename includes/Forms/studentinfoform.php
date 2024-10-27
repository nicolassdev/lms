<!-- Modal to Update STUDENT Information -->


<div class="modal fade" id="updatestudentinfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Student Information</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()"></button>
            </div>
            <div class="modal-body">
                <form action="./includes/Operation/updateStudentProf.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="editAdminInfo">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" value="<?php echo htmlspecialchars($studentInfo['stu_fname']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" value="<?php echo htmlspecialchars($studentInfo['stu_mname']); ?>" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" value="<?php echo htmlspecialchars($studentInfo['stu_lname']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the last name.</div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($studentInfo['stu_address']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter your address.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                <input type="text" class="form-control" name="scontact" value="<?php echo htmlspecialchars($studentInfo['stu_contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select" required>
                                <option value="" disabled selected>Select gender</option>
                                <option value="MALE" <?php echo ($studentInfo['stu_gender'] === 'MALE') ? 'selected' : ''; ?>>Male</option>
                                <option value="FEMALE" <?php echo ($studentInfo['stu_gender'] === 'FEMALE') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <div class="invalid-feedback">Please select your gender.</div>
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($studentInfo['stu_email']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" value="<?php echo htmlspecialchars($studentInfo['stu_dob']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Place of Birth</label>
                            <input type="text" name="pob" value="<?php echo htmlspecialchars($studentInfo['stu_pob']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>



                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profileImage" name="image" accept="image/*" onchange="previewImage(event)" required>
                            <div class="invalid-feedback">Please upload an image.</div>
                        </div>


                        <div class="mb-3 text-center">
                            <img id="imagePreview" class="profile-img" src="#" alt="Image Preview" style="display:none;">
                        </div>


                        <div class="modal-header text-black mb-3">
                            <h5 class="modal-title">Parents/ Guardian Information</h5>

                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label">Father's Name</label>
                            <input type="text" name="fathername" value="<?php echo htmlspecialchars($studentInfo['father_name']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mother's Name</label>
                            <input type="text" name="mothername" value="<?php echo htmlspecialchars($studentInfo['mother_name']); ?>" class="form-control" required>
                            <div class="invalid-feedback">Please enter the first name.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Contact</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text bg-primary text-white" id="inputGroupPrepend">+63</span>
                                <input type="text" class="form-control" name="pcontact" value="<?php echo htmlspecialchars($studentInfo['parent_contact']); ?>" aria-describedby="inputGroupPrepend" maxlength="10" required>
                                <div class="invalid-feedback">Please enter a valid 10-digit number starting with 9.</div>
                            </div>
                        </div>



                        <div class="text-end">
                            <button name="submit" class="btn btn-primary" type="submit">Update Information</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>