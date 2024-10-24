<!-- FORM MODAL ADD TEACHER  -->
<div class="modal fade" id="teacher" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content b-grey">
            <div class="modal-body">
                <form id="teacherForm" action="./includes/teacher-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation " novalidate>
                    <div class="modal-header">
                        <h1 class="modal-title fs-3 text-primary">Create Account</h1>

                    </div>

                    <!-- hide the role of user which is TEACHER  -->
                    <input type="text" class="form-control d-none" name="role" value="TEACHER" required>



                    <div class="col-md-12">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <!-- <div class="col-md-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" required>
          </div> -->

                    <div class="modal-header">
                        <h1 class="modal-title fs-3 text-primary">Teacher Details</h1>
                    </div>

                    <div class="col-md-5">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class=" form-control" name="firstname" required>
                    </div>
                    <div class="col-md-3">
                        <label for="middleName" class="form-label">Middle name</label>
                        <input type="text" class="form-control" name="middlename">
                    </div>
                    <div class="col-md-4">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contactNumber" class="form-label">Contact</label>
                        <div class="input-group input-group has-validation">
                            <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                            <input type="numeric" class="form-control" name="contact" aria-describedby="inputGroupPrepend" pattern="9\d{9}" maxlength="10" required>
                            <div class="invalid-feedback">
                                Please enter a valid 10-digit number starting with 9.
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="male">MALE</option>
                            <option value="female">FEMALE</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" id="dob" required>
                    </div>
                    <div class="col-md-6">
                        <label for="employmentStatus" class="form-label">Employment Status</label>
                        <select class="form-select" name="status" id="employmentStatus" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="full time">Full-time job</option>
                            <option value="part time">Part-time job</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>


                    <!-- <div class="col-md-12">
                        <label for="teacherImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="teacherImage" accept="image/*" required>
                        <div class="invalid-feedback">
                            Please upload a valid image file.
                        </div>
                    </div> -->

                    <div class="col-6">
                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit"><i class="bi bi-pencil-fill me-2"></i>Create</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormTeacher()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to clear the form inputs when " Cancel" is clicked
    function resetFormTeacher() {
        document.getElementById('teacherForm').reset();
        teacherForm.classList.remove('was-validated');

    }
</script>