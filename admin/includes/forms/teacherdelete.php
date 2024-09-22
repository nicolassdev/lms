<div class="modal fade" id="del_teacher' . $row['teacher_id'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body text-center mt-5">
                <div class="text-danger">
                    <i class="bi bi-trash fs-1 "></i><br><br>
                </div>
                <h5>Are you sure you want to delete?</h5>
            </div>
            <div class="d-flex justify-content-center mt-5 mb-5">
                <a href="includes/Operation/deleteTeacher.php?id=' . $row['teacher_id'] . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
            </div>
        </div>
    </div>
</div>