<!-- ADDING STRAND MODAL -->
<div class="modal fade" id="strand" tabindex="-1" aria-labelledby="strandModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-3 text-primary">New Strand</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetFormStrand()"></button>
            </div>

            <div class="modal-body">
                <form id="strandForm" action="./includes/strand-inc.php" method="POST" autocomplete="off" class="row g-2 needs-validation" novalidate>

                    <div class="col-md-12">
                        <label class="form-label">STRAND NAME</label>
                        <input list="strandOptions" type="text" class="form-control" name="strand" id="strandSelect" required>
                        <datalist id="strandOptions">
                            <option selected disabled value="">Choose...</option>
                            <option value="STEM">STEM</option>
                            <option value="HUMSS">HUMSS</option>
                            <option value="ABM">ABM</option>
                            <option value="GAS">GAS</option>
                            <option value="CP">CP</option>
                            <option value="CSS">CSS</option>
                        </datalist>
                        <div class="invalid-feedback">
                            Please select a strand name.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">STRAND DESCRIPTION</label>
                        <textarea class="form-control" name="desc" id="desc" rows="5" required></textarea>
                        <div class="invalid-feedback">
                            Please provide a description.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to clear the form inputs when "Cancel" is clicked
    function resetFormStrand() {
        const form = document.getElementById('strandForm');
        form.reset();
        form.classList.remove('was-validated');
        document.getElementById('desc').value = ''; // Clear the description textarea
    }
</script>