<!-- STUDENT INFORMATION ENTRY MODAL   -->
<div class="modal fade" id="student" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content b-grey">
            <div class="modal-body">


                <!-- Form -->
                <!-- action="./includes/student-inc.php " method="POST" -->
                <form id="studentForm" action="./includes/newstudent-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary">Create Account</h1>
                    </div>
                    <!-- hide the role of user which is STUDENT  -->
                    <input type="text" class="form-control d-none" name="role" value="STUDENT" required>

                    <!-- Username (LRN) -->
                    <div class="col-md-12">
                        <label class="form-label small">Username (LRN)</label>
                        <input type="numeric" class="form-control" name="username" id="username" placeholder="Enter your 12-digit LRN (starting with 1144)" maxlength="12" pattern="1144\d{8}" inputmode="numeric" oninput="fillStudentLRN()" required>
                        <div class="invalid-feedback">
                            Please enter a valid 12-digit number starting with 1144 (numbers only).
                        </div>
                    </div>


                    <!-- Student LRN input that will be automatically filled -->
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary">Student Details</h1>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small">Student LRN</label>
                        <input type="text" class="form-control" id="studentLRN" name="lrn" readonly>
                    </div>



                    <div class="col-md-5">
                        <label class="form-label small">First name</label>
                        <input type="text" class="form-control" name="fname" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small">Middle name</label>
                        <input type="text" class="form-control" name="mname">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small">Last name</label>
                        <input type="text" class="form-control" name="lname" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="col-md-7">
                        <label for="contactNumber" class="form-label small">Contact</label>
                        <div class="input-group input-group has-validation">
                            <span class="input-group-text bg-primary" style="color:white">+63</span>
                            <input type="numeric" class="form-control" name="stu_contact" pattern="9\d{9}" maxlength="10" required>
                            <div class="invalid-feedback">
                                Please enter a valid 10-digit number starting with 9.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small">Gender</label>
                        <select class="form-select" name="gender" required>
                            <option selected disabled value="">Select..</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small">Email</label>
                        <input type="text" class="form-control" placeholder="Enter your email address" name="email"
                            pattern=".*@(gmail|yahoo)\.com$" required>
                        <div class="invalid-feedback">
                            Your email must contain an "@" symbol or gmail address ending with ".com".
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label small">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" required>
                    </div>

                    <div class="col-md-7">
                        <label class="form-label small">Place of Birth</label>
                        <input type="text" class="form-control" name="pob" required>
                    </div>


                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary">Parent / Guardian Information</h1>
                    </div>
                    <!-- PARENT INFORMATION  -->
                    <div class="col-md-12">
                        <label class="form-label small">Father name</label>
                        <input type="text" name="fathername" class="form-control" placeholder="Full Name (last name, first name, middlename)" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small">Mother name</label>
                        <input type="text" name="mothername" class="form-control" placeholder="Full Name (last name, first name, middlename)" required>
                    </div>

                    <div class="col-md-12">
                        <label for="contactNumber" class="form-label small">Contact</label>
                        <div class="input-group input-group has-validation">
                            <span class="input-group-text bg-primary" style="color:white">+63</span>
                            <input type="numeric" class="form-control" name="p_contact" pattern="9\d{9}" maxlength="10" required>
                            <div class="invalid-feedback">
                                Please enter a valid 10-digit number starting with 9.
                            </div>
                        </div>
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
       // Function to automatically fill the Student LRN input and disable it
    function fillStudentLRN() {
        const usernameInput = document.getElementById('username');
        const studentLRNInput = document.getElementById('studentLRN');
        studentLRNInput.value = usernameInput.value;
    }

    // Function to clear the form inputs when "Cancel" is clicked
    function resetFormTeacher() {
        document.getElementById('teacherForm').reset();
        document.getElementById('teacherForm').classList.remove('was-validated');
        document.getElementById('studentLRN').value = ''; // Clear the Student LRN field
    }


    // Function to clear the form inputs when " Cancel" is clicked
    function resetFormStudent() {
        document.getElementById('studentForm').reset();
        studentForm.classList.remove('was-validated');

    }
    // JavaScript for enabling Bootstrap 5.3.0 validation and LRN comparison
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(form => {
            form.addEventListener('submit', event => {
                const username = document.getElementById('username').value;
                const lrn = document.getElementById('lrn').value;
                const lrnError = document.getElementById('lrnError');

                // Check if username and student LRN are the same
                if (username !== lrn) {
                    lrnError.classList.remove('d-none');
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    lrnError.classList.add('d-none');
                }

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();;
</script>