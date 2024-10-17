 <?php
    include "../includes/dbh-inc.php";
    ?>


 <!-- TABLE -->


 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 ms-3 me-3">
         <h3 class="text-black">Users list</h3>
     </div>
     <!-- Search Form -->
     <form method="POST" action="index.php?page=users" class="ms-5 me-5">
         <div class="input-group mb-3">
             <input type="text" class="form-control form-control-sm " name="find-user" placeholder="Search user..." autocomplete="off" required style="width: 150px;" />
             <button class="btn btn-outline-primary btn-sm" name="search" type="submit">
                 <i class="bi bi-search"></i> Search
             </button>
         </div>
     </form>



     <div class="table-responsive ms-3 me-3">
         <table class="table table-bordered table-striped table-sm align-middle">
             <thead class="table-dark text-light">
                 <tr>
                     <th scope="col">ID</th>
                     <th scope="col">Username</th>
                     <th scope="col">Role</th>
                     <th scope="col">Date Added</th>
                     <th scope="col" class="text-center" colspan="2">Action</th>
                 </tr>
             </thead>
             <tbody
                 <?php
                    $mySQLFunction->connection();
                    if (!isset($_POST["search"])) {
                        $result = $mySQLFunction->getUsers();
                    } else {
                        $find = $_POST["find-user"];
                        $result = $mySQLFunction->searchUser($find);
                    }

                    if (!empty($result)) {
                        $count = 1;
                        foreach ($result as $row) {
                            // Create a DateTime object and format the added_date
                            $addedDate = new DateTime($row['added_date']); // Create a DateTime object for the current row
                            $formattedDate = $addedDate->format('F j, Y'); // Format to "August 11, 2024"

                            echo '<tr>';
                            echo '<td>' . $row["id"] . '</td>';
                            echo '<td>' . $row["username"] . '</td>';
                            echo '<td>' . $row["role"] . '</td>';
                            echo '<td>' . $formattedDate . '</td>';
                            echo '
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit_user' . $row['id'] . '"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_user' . $row['id'] . '"><i class="bi bi-trash"></i></button>
                                        </td>
                                    ';


                            //Modal for updating users 
                            echo '
                            <div class="modal fade" id="edit_user' . $row['id'] . '" tabindex="-1" aria-labelledby="teachModal" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content shadow">
                                        <div class="modal-header border-bottom-0">
                                            <h1 class="modal-title fs-5 text-primary" id="modalHeader' . $row['id'] . '">
                                                ' . ($row['role'] == 'TEACHER' ? 'Teacher Account' : ($row['role'] == 'ADMIN' ? 'Admin Account' : 'Student Account')) . '
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./includes/Operation/updateUser.php" method="POST" class="needs-validation" novalidate onsubmit="return validatePasswords()">
                                                <input type="hidden" name="userID" value="' . $row['id'] . '">
                                                
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" value="' . $row['username'] . '" required>
                                                    <div class="invalid-feedback">Please enter a username.</div>
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control password-input" name="password" required placeholder="Enter new password">
                                                    </div>
                                                    <div class="invalid-feedback">Please enter a password.</div>
                                                </div>
                            
                                                <div class="mb-3">
                                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" name="confirm_password" required placeholder="Confirm your password">
                                                    </div>
                                                    <div class="invalid-feedback">Please confirm your password.</div>
                                                </div>
                            
                                                        <div class="d-flex justify-content-between mt-4 gap-1">
                                                            <div class="col-6">
                                                                <button name="submit" class="btn btn-primary w-100" type="submit">Update</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetForm()">Cancel</button>
                                                            </div>
                                                        </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script src="../assets/js/validationform.js"></script>
                            ';




                            // Modal for deleting users
                            echo '
                            <div class="modal fade" id="del_user' . $row['id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content shadow-lg">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div class="text-danger">
                                                <i class="bi bi-trash fs-1 fade-in"></i>
                                            </div>
                                            <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to remove "<span class="text-danger">' . $row['id'] . '</span>" ?</h5>
                                            <small class="text-muted">This action cannot be undone. Please confirm your decision below.</small>
                                        </div>
                                        <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                                            <a href="includes/Operation/deleteUser.php?id=' . $row['id'] . '" class="btn btn-danger btn-md me-3" style="width: 120px;">Remove</a>
                                            <button class="btn btn-outline-secondary btn-md" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            $count++;
                        }
                    } else {
                        echo '<tr>
                                        <td colspan="10" class="text-center">User not found.</td>              
                                  </tr>';
                    }
                    echo '</table>';
                    echo '<a href="" class="btn btn-primary" title="Refresh"><i class="bi bi-arrow-clockwise me-1"></i>Refresh</a>';

                    $mySQLFunction->disconnect();
                    ?>
                 </div>
 </main>


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
 <script src="../js/clearinput.js"></script>