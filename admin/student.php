<!-- STUDENT FORM MODAL -->
<div class="modal fade" id="student" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content b-grey">
            <div class="modal-body">

                <!-- Form -->
                <form autocomplete="off" class="row g-2 needs-validation small-form" novalidate>
                    <div class="modal-header">
                        <h1 class="modal-title fs-3 text-primary">Create Account</h1>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">User type</label>
                        <select class="form-select" id="usertype" required onchange="toggleForm()">
                            <option selected disabled value="">Select...</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" required>
                    </div>

                    <!-- Student Details (Initially Hidden) -->
                    <div id="studentForm" style="display: none;">
                        <div class="modal-header">
                            <h1 class="modal-title fs-3 text-primary">Student Details</h1>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">LRN</label>
                            <div class="input-group input-group has-validation">
                                <input type="numeric" class="form-control" name="contact" aria-describedby="inputGroupPrepend"
                                    pattern="1144\d{8}" required>
                                <div class="invalid-feedback">
                                    Please enter a valid 12-digit number starting with 1144.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-md-3">
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
                                <span class="input-group-text" id="inputGroupPrepend">+63</span>
                                <input type="numeric" class="form-control" name="contact" aria-describedby="inputGroupPrepend"
                                    pattern="9\d{9}" required>
                                <div class="invalid-feedback">
                                    Please enter a valid 10-digit number starting with 9.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
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
                    </div>

                    <!-- Teacher Details (Initially Hidden) -->
                    <div id="teacherForm" style="display: none;">

                        <div class="modal-header">
                            <h1 class="modal-title fs-3 text-primary">Teacher Details</h1>
                        </div>

                        <div class="col-md-12">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class=" form-control" name="firstname" required>
                        </div>
                        <div class="col-md-12">
                            <label for="middleName" class="form-label">Middle name</label>
                            <input type="text" class="form-control" name="middlename" required>
                        </div>
                        <div class="col-md-12">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" name="lastname" required>
                        </div>
                        <div class="col-md-12">
                            <label for="contactNumber" class="form-label">Contact</label>
                            <div class="input-group input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">+63</span>
                                <input type="numeric" class="form-control" name="contact" aria-describedby="inputGroupPrepend"
                                    pattern="9\d{9}" required>
                                <div class="invalid-feedback">
                                    Please enter a valid 10-digit number starting with 9.
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="gender" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="male">MALE</option>
                                <option value="female">FEMALE</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" id="dob" required>
                        </div>
                        <div class="col-md-12">
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


                        <div class="col-md-12">
                            <label for="teacherImage" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" name="teacherImage" accept="image/*" required>
                            <div class="invalid-feedback">
                                Please upload a valid image file.
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <button class="btn btn-primary w-100 mt-3 mb-2" type="submit"><i class="bi bi-pencil-fill me-2"></i>Create</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<!-- TABLE -->

<div class="mt-5">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-5 ms-3 me-3">
            <h3 class="text-black">List of Student</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#student" data-bs-whatever="@fat">
                <i class="bi bi-person-plus-fill me-1"></i>Student
            </button>
        </div>


        <div class="table-responsive small ms-3 me-3">
            <table class="table table-bordered table-striped table-sm align-middle">
                <thead class="table-dark text-light">
                    <tr>
                        <th scope="col">LRN</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Initial</th>
                        <th scope="col">Surname</th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Email</th>
                        <th scope="col">Birdthday</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>23920178192010</td>
                        <td>Anthony</td>
                        <td>Dado</td>
                        <td>Daen</td>
                        <td>Buraguis</td>
                        <td>0923923920</td>
                        <td>Male</td>
                        <td>anthondaen25@gmail.com</td>
                        <td>2002-10-02</td>
                        <td>Enrolled</td>

                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    function toggleForm() {
        const userType = document.getElementById('usertype').value;
        const studentForm = document.getElementById('studentForm');
        const teacherForm = document.getElementById('teacherForm');

        if (userType === 'student') {
            studentForm.style.display = 'block';
            teacherForm.style.display = 'none';
        } else if (userType === 'teacher') {
            studentForm.style.display = 'none';
            teacherForm.style.display = 'block';
        } else {
            studentForm.style.display = 'none';
            teacherForm.style.display = 'none';
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="../js/clearinput.js"></script>