<?php
include "../includes/dbh-inc.php";
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/strandform.php";
?>


<!-- THSI THE STRAND TABLE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 mb-5 ms-3 me-3">
    <h3 class="text-black">List of Strand</h3>
    <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#strand" data-bs-whatever="@fat">
      <i class="bi bi-plus-circle-fill"></i>
    </button>
  </div>

  <?php
  if (isset($_SESSION['deleted'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show mt-3 p-2" role="alert" style="font-size: 14px; line-height: 1.2;">';
    echo '<i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> ' . $_SESSION['deleted'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

    // Reduced font size for the timestamp
    echo '<small class="d-block mt-1 text-muted">Just now</small>';

    echo '</div>';
    unset($_SESSION['deleted']);
  }
  ?>
  <!-- THSI THE STRAND TABLE -->
  <!-- TABLE -->
  <div class="table-responsive small ms-3 me-3">
    <table id="example" class="table table-bordered table-striped table-sm align-middle">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Strand name</th>
          <th scope="col">Description</th>
          <th scope="col" class="text-center" colspan="2">Action</th> <!-- colspan should be 2 -->
        </tr>
      </thead>
      <tbody>
        <?php
        $mySQLFunction->connection();
        if (!isset($_POST["search"])) {
          $result = $mySQLFunction->getStrand();
        }
        // else {
        //   $find = $_POST["find"];
        //   $result = $mySQLFunction->searchTeacher($find);
        // }

        if (!empty($result)) {
          $count = 1;
          foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . $count . '</td>';
            // echo '<td>' . $row["strand_code"] . '</td>';
            echo '<td>' . $row["strand_name"] . '</td>';
            echo '<td>' . $row["strand_desc"] . '</td>';
            echo '
 
                      <td class="text-center">
                          <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_strand' . $row['strand_code'] . '">
                              <i class="bi bi-trash"></i>Delete
                          </button>
                      </td>
                    ';
            echo '</tr>';

            // Modal for deleting strand

            echo '
            <div class="modal fade" id="del_strand' . $row['strand_code'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content shadow-lg">
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <div class="text-danger">
                                <i class="bi bi-trash fs-1 fade-in"></i>
                            </div>
                            <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to remove "<span class="text-danger">' .  ($row['strand_name']) . '</span>"?</h5>
                            <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                        </div>
                        <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                            <a href="includes/Operation/deleteStrand.php?id=' . $row['strand_code'] . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                            <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>';

            $count++;
          }
        } else {
          echo '<tr>
                        <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>Strand not found.<br>
                        </td>
                      </tr>';
        }

        echo '</tbody>';
        echo '</table>';
        $mySQLFunction->disconnect();
        ?>

  </div>

</main>






<script src="../assets/js/validationform.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>