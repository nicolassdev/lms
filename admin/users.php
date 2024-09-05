 <?php
    include "../includes/dbh-inc.php";
    ?>


 <!-- TABLE -->

 <div class="mt-5">
     <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 ms-3 me-3">
             <h3 class="text-black">Users list</h3>
         </div>
         <!-- Search Form -->
         <form method="POST" action="index.php?page=users" class="ms-5 me-5">
             <div class="input-group mb-3 ms-3 me-3">
                 <input type="text" class="form-control form-control-sm " name="find-user" placeholder="Search users..." autocomplete="off" required style="width: 200px;" />
                 <button class="btn btn-outline-primary btn-sm" name="search" type="submit">
                     <i class="bi bi-search"></i> Search
                 </button>
             </div>
         </form>



         <div class="table-responsive ms-3 me-3">
             <table class="table table-bordered table-striped table-sm align-middle">
                 <thead class="table-dark text-light">
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Username</th>
                         <th scope="col">User Type</th>
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
                                echo '<tr>';
                                echo '<td>' . $count . '</td>';
                                echo '<td>' . $row["username"] . '</td>';
                                echo '<td>' . $row["role"] . '</td>';
                                echo '<td>' . $row["added_date"] . '</td>';
                                echo '
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </td>
                                    ';
                                $count++;
                            }
                        } else {
                            echo '<tr>
                                        <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>User not found.</td>              
                                  </tr>';
                        }
                        echo '</table>';
                        echo '<a href="" class="btn btn-primary" title="Refresh"><i class="bi bi-arrow-clockwise me-1"></i>Refresh</a>';

                        $mySQLFunction->disconnect();
                        ?>
                     </div>
     </main>
 </div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
 <script src="../js/clearinput.js"></script>