<?php
include "../includes/dbh-inc.php";
include "../admin/includes/update-teacher-inc.php";
include "../admin/includes/Operation/updateTeacher.php"
?>

<!-- TABLE -->
<div class="mt-5">
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
      <h3 class="text-black">List of Faculty</h3>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacher">
        <i class="bi bi-person-plus-fill me-1"></i>Faculty
      </button>
    </div>
    <!-- Search Form -->
    <form method="POST" action="index.php?page=teacher" class="ms-5 me-5">
      <div class="input-group mb-3 ms-3 me-3">
        <input type="text" class="form-control form-control-sm" name="find" placeholder="Search name..." autocomplete="off" required style="width: 200px;" />
        <button class="btn btn-outline-primary btn-sm" name="search" type="submit">
          <i class="bi bi-search"></i> Search
        </button>
      </div>
    </form>


    <!-- TABLE -->
    <div class="table-responsive small ms-3 me-3">
      <table class="table table-bordered table-striped table-sm align-middle">
        <thead class="table-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">First</th>
            <th scope="col">Middle</th>
            <th scope="col">Last</th>
            <th scope="col">Contact</th>
            <th scope="col">Gender</th>
            <th scope="col">Birthday</th>
            <th scope="col">Status</th>
            <th scope="col">Address</th>
            <th scope="col" class="text-center" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $mySQLFunction->connection();
          if (!isset($_POST["search"])) {
            $result = $mySQLFunction->getTeacher();
          } else {
            $find = $_POST["find"];
            $result = $mySQLFunction->searchTeacher($find);
          }
          if (!empty($result)) {
            $count = 1;
            foreach ($result as $row) {
              echo '<tr>';
              // echo '<td>' . $count . '</td>';
              echo '<td>' . $row["teacher_id"] . '</td>';
              echo '<td>' . $row["teacher_fname"] . '</td>';
              echo '<td>' . $row["teacher_mname"] . '</td>';
              echo '<td>' . $row["teacher_lname"] . '</td>';
              echo '<td>' . $row["teacher_contact"] . '</td>';
              echo '<td>' . $row["teacher_gender"] . '</td>';
              echo '<td>' . $row["teacher_dob"] . '</td>';
              echo '<td>' . $row["status"] . '</td>';
              echo '<td>' . $row["teacher_address"] . '</td>';
              echo '
                  <td class="text-center">
                      <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit_teacher">
                          <i class="bi bi-pencil-square"></i>
                      </button>
                  </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </td>
                ';
              echo '</tr>';
              $count++;
            }
          } else {
            echo '<tr>
                    <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>Teacher not found.<br>
         
                    </td>
                  </tr>';
          }
          echo '</table>';
          echo '<a href="" class="btn btn-primary" title="Refresh"><i class="bi bi-arrow-clockwise me-1"></i>Refresh</a>';
          $mySQLFunction->disconnect();
          ?>
    </div>
  </main>
</div>


<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/teacherform.php";
?>


<!-- Notification Insert Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center mt-5">
        <div class="text-success">
          <i class="bi bi-check-circle fs-1 "></i><br><br>
        </div>
        <p class="mb-4"> Teacher has been added successfully.</p>
      </div>
      <div class="d-flex justify-content-center mt-3 mb-5 ">
        <button class="btn btn-success me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
      </div>
    </div>
  </div>
</div>


<!-- Notification ERROR Modal -->
<div class="modal fade" id="notificationError" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center mt-5">
        <div class="text-danger">
          <i class="bbi bi-exclamation-circle fs-1"></i><br><br>
        </div>
        <p class="mb-4"> Username or details has been already taken.</p>
      </div>
      <div class="d-flex justify-content-center mt-3 mb-5 ">
        <button class="btn btn-danger me-2" data-bs-dismiss="modal" style="width: 120px;">Okay</button>
      </div>
    </div>
  </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="../js/clearinput.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>