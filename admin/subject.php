 
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/subjectform.php";
?>
<!-- THIS THE SUBJECT TABLE -->

 
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 mb-5 ms-3 me-3">
            <h3 class="ms-3">List of Subject</h3>

            <div class="d-flex gap-3">

            <button type="button" class="btn btn-primary mb-3 me-3" data-bs-toggle="modal" data-bs-target="#subject" data-bs-whatever="@fat">
              <i class="bi bi-plus-circle-fill me-2"></i>Add new
            </button>
            </div>
      </div>


      <!-- THSI THE SUBJECT TABLE -->
      <div class="table-responsive small ms-3 me-3">
        <table class="table table-bordered table-striped table-sm align-middle">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">First</th>
              <th scope="col">Last</th>
              <th scope="col">Handle</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
              <td>
                <button class="btn btn-sm btn-outline-danger me-2"><i class="bi bi-trash"></i> Delete</button>
                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</button>
              </td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
              <td>
                <button class="btn btn-sm btn-outline-danger me-2"><i class="bi bi-trash"></i> Delete</button>
                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</button>
              </td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
              <td>
                <button class="btn btn-sm btn-outline-danger me-2"><i class="bi bi-trash"></i> Delete</button>
                <button class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </main>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="../js/clearinput.js"></script>