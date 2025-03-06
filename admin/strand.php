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

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-3">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 mb-5 ms-3 me-3">
    <h5 class="fw-bold">List of Strand</h5>
    <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#strand" data-bs-whatever="@fat">
      <i class="bi bi-plus-circle-fill me-1"></i>Add Strand
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
  <div class="row g-3 ms-3 me-3">
  <?php
  $mySQLFunction->connection();
  if (!isset($_POST["search"])) {
    $result = $mySQLFunction->getStrand();
  }

  if (!empty($result)) {
    foreach ($result as $row) {
        echo '
        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold">' . htmlspecialchars($row["strand_name"]) . '</h5>
              <p class="card-text">' . htmlspecialchars($row["strand_desc"]) . '</p>
              <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#edit_strand' . $row['strand_code'] . '">
                <i class="bi bi-pencil-square me-1"></i> Edit
              </button>
            </div>
          </div>
        </div>
        ';
      
    

      // Modal for editing
      echo '<div class="modal fade" id="edit_strand' . htmlspecialchars($row['strand_code']) . '" tabindex="-1" aria-labelledby="editStrandLabel" aria-hidden="true">';
      echo '<div class="modal-dialog">';
      echo '<div class="modal-content">';
      echo '<div class="modal-header bg-success text-white">';
      echo '<h5 class="modal-title">Edit Strand</h5>';
      echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
      echo '</div>';
      echo '<div class="modal-body">';
      echo '<form action="./includes/Operation/updateStrand.php" method="POST">';
      echo '<input type="hidden" name="strandID" value="' . htmlspecialchars($row['strand_code']) . '">';
      echo '<div class="mb-3">';
      echo '<label class="form-label">Strand ACRO</label>';
      echo '<input type="text" class="form-control" name="strand_acro" value="' . htmlspecialchars($row['strand_name']) . '" required>';
      echo '</div>';
      echo '<div class="mb-3">';
      echo '<label class="form-label">Strand Name</label>';
      echo '<input type="text" class="form-control" name="strand_name" value="' . htmlspecialchars($row['strand_desc']) . '" required>';
      echo '</div>';
      echo '<div class="d-flex justify-content-between">';
      echo '<button type="submit" name="submit" class="btn btn-success">Update</button>';
      echo '<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>';
      echo '</div>';
      echo '</form>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  } else {
    echo '<div class="col-12 text-center">Strand not found.</div>';
  }
  $mySQLFunction->disconnect();
  ?>
</div>


  </div>

</main>






<script src="../assets/js/validationform.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>