<!-- ADDING SUBJECT MODAL  -->

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
