<!-- STUDENT INFORMATION ENTRY MODAL   -->
<div class="modal fade" id="student" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content b-grey">
            <div class="modal-body">

                <!-- Form -->
                <!-- action="./includes/student-inc.php " method="POST" -->
                <form id="studentForm" autocomplete="off" class="row g-2 needs-validation" novalidate>
                    <div class="modal-header">
                        <h1 class="modal-title fs-3 text-primary">Create Account</h1>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">User type</label>
                        <select class="form-select" name="role" id="usertype" required>
                            <option selected disabled value="">Select...</option>
                            <option value="student">STUDENT</option>
                            <option value="teacher" disabled>TEACHER</option>
                        </select>
                    </div>


                    <div class="col-md-12">
                        <label class="form-label">LRN</label>
                        <input type="text" class="form-control" name="username" maxlength="12" pattern="\d{12}" inputmode="numeric" required>
                        <div class="invalid-feedback">
                            Please enter a valid 12-digit LRN number (numbers only).
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <div class="modal-header">
                        <h1 class="modal-title fs-3 text-primary">Student Details</h1>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">LRN</label>
                        <div class="input-group input-group has-validation">
                            <input type="numeric" class="form-control" name="contact" aria-describedby="inputGroupPrepend"
                                pattern="1144\d{8}" required>
                            <div class="invalid-feedback">
                                Please enter a valid 12-digit number starting with 1144.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Middle name</label>
                        <input type="text" class="form-control" id="middleName">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contactNumber" class="form-label">Contact</label>
                        <div class="input-group input-group has-validation">
                            <span class="input-group-text bg-primary" style="color:white" id="inputGroupPrepend">+63</span>
                            <input type="numeric" class="form-control" name="contact" aria-describedby="inputGroupPrepend"
                                pattern="9\d{9}" required>
                            <div class="invalid-feedback">
                                Please enter a valid 10-digit number starting with 9.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select class="form-select" id="gender" required>
                            <option selected disabled value="">Select..</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Enter your Email" id="email" name="email"
                            pattern=".*@(gmail|yahoo)\.com$" required>
                        <div class="invalid-feedback">
                            Your email must contain an "@" symbol or gmail address ending with ".com".
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="birthdate" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Grade level</label>
                        <select class="form-select" id="gradeLevel" required>
                            <option selected disabled value="">Select...</option>
                            <option value="Grade 12">Grade 12</option>
                            <option value="Grade 11">Grade 11</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Strand</label>
                        <select class="form-select" id="strand" required>
                            <option selected disabled value="">Select...</option>
                            <option value="STEM">STEM</option>
                            <option value="ABM">ABM</option>
                            <option value="GAS">GAS</option>
                            <option value="HUMSS">HUMSS</option>
                            <option value="Computer Programming">Computer Programming</option>
                            <option value="Computer System Servicing">Computer System Servicing</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Section</label>
                        <select class="form-select" id="section" required>
                            <option selected disabled value="">Select...</option>
                            <option value="Chrome">Chrome</option>
                            <option value="Edge">Edge</option>
                            <option value="FireFox">FireFox</option>
                            <option value="St.Padre Pio">St.Padre Pio</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="status" required>
                            <option selected disabled value="">Select...</option>
                            <option value="Enrolled">Enrolled</option>
                            <option value="Not Enrolled">Not Enrolled</option>
                        </select>
                    </div>




                    <div class="col-md-6">
                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit"><i class="bi bi-pencil-fill me-2"></i>Create</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormStudent()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Function to clear the form inputs when " Cancel" is clicked
    function resetFormStudent() {
        document.getElementById('studentForm').reset();
        studentForm.classList.remove('was-validated');

    }

    // JavaScript for enabling Bootstrap 5.3.0 validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>