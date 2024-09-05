<!-- ADDING TEACHER MODAL  -->

<div class="modal fade" id="subject" tabindex="-1" aria-labelledby="subjectModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="subjectModal">Add Subject </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-2 needs-validation small-form" novalidate>
          <div class="col-md-6">
            <label class="form-label">Subject Code</label>
            <input type="text" class="form-control" id="sub_name" required>
          </div>
          <div class="col-md-6">
            <label for="status" class="form-label">Type Of Subject</label>
            <select class="form-select" id="status" required>
              <option selected disabled value="">Choose...</option>
              <option value="core">Core Subject</option>
              <option value="applied">Applied Track Subject</option>
              <option value="specialized">Specialized Subject</option>
            </select>
          </div>
          <div class="col-md-12">
            <label class="form-label">Subject name</label>
            <input type="text" class="form-control" id="sub_name" required>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Subject Description</label>
            <input type="text" arial="Enter your Email" class="form-control" id="email" required>
          </div>

          <div class="col-md-12">
            <button class="btn btn-primary w-100 mt-3" type="submit">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>





<!-- THSI THE SUBJECT TABLE -->

<div class="mt-5">
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4 mb-5 ms-3 me-3">
      <h3 class="text-black">List of Subject</h3>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subject" data-bs-whatever="@fat">
        <i class="bi bi-plus-circle-fill me-2"></i>Add new
      </button>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="../js/clearinput.js"></script>