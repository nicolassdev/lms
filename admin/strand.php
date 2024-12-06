<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['registrar_id'])) {
  header("location:../login.php?error=accessdenied");
}
?>
<?php
include "../includes/dbh-inc.php";
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/Forms/strandform.php";
?>


<!-- THSI THE STRAND TABLE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 mb-5 ms-3 me-3">
    <h4 class="text-black">List of Strand</h4>
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
          <th scope="col">Strand ACRO</th>
          <th scope="col">Strand name </th>
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
            echo '<td>' . ucwords(strtolower($row["strand_desc"])) . '</td>';

            // This is the delete button i will uncomment this , if needed just uncomment this 
            // <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_strand' . $row['strand_code'] . '">
            //     <i class="bi bi-trash"></i>Delete
            // </button>
            echo '
 
                      <td class="text-center">
                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit_strand' . $row['strand_code'] . '">
                          <i class="bi bi-pencil-square me-1"></i>Edit
                        </button>
                      </td>
                    ';
            echo '</tr>';


            // todo Modal for editing strand
            echo '
            <div class="modal fade" id="edit_strand' . htmlspecialchars($row['strand_code']) . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">

                        <div class="modal-header bg-success text-white">
                            <div class="d-flex align-items-center justify-content-between w-100">
                              <div class="text-start">
                                <h1 class="modal-title fs-5 text-white">Edit Strand details</h1>
                              </div>
                            </div>
                            <div class="text-end">
                               <i class="bi bi-pencil-square fs-3 ms-2"></i>
                            </div>                           
                        </div>


                        <div class="modal-body p-4">
                            <form action="./includes/Operation/updateStrand.php" method="POST" class="row g-3 needs-validation" novalidate id="editStrand' . htmlspecialchars($row['strand_code']) . '">
                                <!-- Use hidden input -->
                                <input type="hidden" name="strandID" value="' . htmlspecialchars($row['strand_code']) . '">

 
                                <!-- Section Name -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Strand ACRO</label>
                                    <input type="text" class="form-control" name="strand_acro" value="' . htmlspecialchars($row['strand_name']) . '" required>
                                    <div class="invalid-feedback">
                                        Please select a section name.
                                    </div>
                                </div>      

                             <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Strand name</label>
                                <input text="text" class="form-control" name="strand_name" value="' . htmlspecialchars($row['strand_desc']) . '"  required>                                                                                             
                                <div class="invalid-feedback">
                                    Please select an adviser.
                            </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-between gap-2 mt-3">
                                    <button name="submit" class="btn btn-success w-100 mt-3" type="submit">Update</button>
                                    <button type="button" class="btn btn-outline-secondary w-100 mt-3" data-bs-dismiss="modal" aria-label="Close" onclick="resetStrand(\'' . htmlspecialchars($row['strand_code']) . '\')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
            <script>
                function resetStrand(id) {
                    var form = document.getElementById("editStrand" + id);
                    if (form) {
                        form.reset(); // Clears the form fields
                        form.classList.remove("was-validated"); // Removes the validation styling
                    }
                }
            </script>
            ';



            // todo Modal for deleting strand
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
                        <td colspan="10" class="text-center">Strand not found.<br>
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