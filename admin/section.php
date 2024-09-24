<?php
include "../includes/dbh-inc.php";
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/forms/sectionform.php";
?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h3 class="text-black">List of Section</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#section" data-bs-whatever="@fat">
                            <i class="bi bi-plus-circle-fill"></i>
                        </button>
                    </div>
                    <!-- NOTIFICATION -->

                    <?php
                    if (isset($_SESSION['deleted'])) {
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3 p-2" role="alert" style="font-size: 14px; line-height: 1.2;">';
                        echo '<strong>Notification: </strong> ' . $_SESSION['deleted'];

                        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

                        // Reduced font size for the timestamp
                        echo '<small class="d-block mt-1 text-muted">Just now</small>';

                        echo '</div>';
                        unset($_SESSION['deleted']);
                    }
                    ?>
                    <!-- TABLE -->
                    <div class="table-responsive small ms-3 me-3">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark ">
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col">Section Code</th>
                                    <th scope="col">Strand</th>
                                    <th scope="col">Year level</th>
                                    <th scope="col">Section name</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Adviser</th>
                                    <th scope="col" class="text-center">Action</th> <!-- colspan should be 2 -->

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $mySQLFunction->connection();

                                $result = $mySQLFunction->getSection();
                                if (!empty($result)) {
                                    $count = 0;
                                    foreach ($result as $row) {
                                        echo '<tr>';

                                        echo '<td>' . $row["section_code"] . '</td>';
                                        echo '<td>' . $row["strand_name"] . '</td>';
                                        echo '<td>' . $row["grade_lvl"] . '</td>';
                                        echo '<td>' . $row["section_name"] . '</td>';
                                        echo '<td>' . $row["semester"] . '</td>';
                                        echo '<td>' . $row["adviser"] . '</td>';
                                        echo '
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#edit_section' . $row['section_code'] . '">
                                                <i class="bi bi-pencil-square"></i>Edit
                                            </button>
                                        
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_section' . $row['section_code'] . '">
                                                <i class="bi bi-trash"></i>Delete
                                            </button>
                                        </td>
                                            ';
                                        echo '</tr>';

                                        $count++;


                                        // Modal for updating section
                                        echo '
                                            <div class="modal fade" id="edit_section' . htmlspecialchars($row['section_code']) . '" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content b-grey">
                                                        <div class="modal-body">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-3 text-primary">Section Details</h1><i class="bi bi-pencil-square fs-4"></i>
                                                            </div>
                                                            <form action="./includes/Operation/updateSection.php" method="POST" class="row g-2 needs-validation mb-3" novalidate id="editSectionForm' . htmlspecialchars($row['section_code']) . '">
                                                                <!-- Use hidden input -->
                                                                    <input type="hidden" name="sectionID" value="' . htmlspecialchars($row['section_code']) . '">

                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label">STRAND NAME</label>
                                                                            <select class="form-select" id="strandSelect' . htmlspecialchars($row['section_code']) . '" name="strand_code" required>';

                                        // Fetch and populate strand options
                                        $mySQLFunction->connection();
                                        $strands = $mySQLFunction->getStrand();
                                        foreach ($strands as $strand) {
                                            $selected = $strand["strand_name"] == $row['strand_name'] ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($strand["strand_name"]) . '"' . $selected . '>' . htmlspecialchars($strand["strand_name"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Please input a strand name.
                                                                            </div>
                                                                        </div>

                                                                    <!-- GRADE LEVEL -->
                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">Grade Level</label>
                                                                        <select class="form-select" name="gradelvl" id="gradeLvl' . htmlspecialchars($row['section_code']) . '" required>                                                                        
                                                                            <option value="GRADE-12"' . ($row['grade_lvl'] == 'GRADE-12' ? ' selected' : '') . '>GRADE-12</option>
                                                                            <option value="GRADE-11"' . ($row['grade_lvl'] == 'GRADE-11' ? ' selected' : '') . '>GRADE-11</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Please select a grade level.
                                                                        </div>
                                                                    </div>';
                                        echo '
                                                                        <div class="col-md-12 mb-3">
                                                                            <label class="form-label id="section' . htmlspecialchars($row['section_code']) . '">Section</label>
                                                                            <input type="text" class="form-control" name="section" value="' . htmlspecialchars($row['section_name']) . '" required>
                                                                            <div class="invalid-feedback">
                                                                                Please select a section name.
                                                                            </div>
                                                                        </div>
                                                                                        

                                                                    <div class="col-md-12 mb-3">
                                                                        <label class="form-label">Semester</label>
                                                                            <select class="form-select" name="semester" id="semester' . htmlspecialchars($row['section_code']) . '" required>';
                                        // <option selected disabled value="">Select...</option>

                                        // Fetch and populate semester options
                                        $mySQLFunction->connection();
                                        $result = $mySQLFunction->getSemester();
                                        foreach ($result as $semester) {
                                            // Dynamically set selected if the current semester matches the one from the database
                                            $selected = ($semester['semester_name'] == $row['semester_name']) ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($semester['semester_name']) . '"' . $selected . '>' . htmlspecialchars($semester['semester_name']) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                            </select>
                                                                            <div class="invalid-feedback">
                                                                                Please select a semester.
                                                                            </div>
                                                                    </div>

                                                                        ';
                                        echo '
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Adviser</label>
                                                                        <select class="form-select" name="teacher_id" required>
                                                                            <option value="" selected disabled>Choose an adviser...</option>
                                                                            ';
                                        $mySQLFunction->connection();
                                        // Fetch the teachers and populate the dropdown
                                        $result = $mySQLFunction->getTeacher();
                                        foreach ($result as $teacher) {
                                            $selected = ($teacher['teacher_id'] == $row['teacher_id']) ? ' selected' : '';

                                            echo '<option value="' . htmlspecialchars($teacher["teacher_id"]) . '">' . htmlspecialchars($teacher["teacher_fname"]) . ' ' . htmlspecialchars($teacher["teacher_mname"]) . ' ' . htmlspecialchars($teacher["teacher_lname"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                                        </select>
                                                                        <div class="invalid-feedback">
                                                                            Please select an advisor.
                                                                        </div>
                                                                    </div>
                                                                    ';
                                        echo '

                                                                    <div class="d-flex justify-center gap-2">
                                                                        <div class="col-6">
                                                                            <button name="submit" class="btn btn-primary w-100 mt-3 mb-2" type="submit">Update</button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                        <button type="button" class="btn btn-outline-secondary w-100 mt-3 mb-2" data-bs-dismiss="modal" aria-label="Close" onclick="resetSection(\'' . htmlspecialchars($row['section_code']) . '\')">Cancel</button>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <script>
                                            function resetSection(id) {
                                                    var form = document.getElementById("editSectionForm" + id);
                                                        if (form) {
                                                        form.reset(); // Clears the form fields
                                                        form.classList.remove("was-validated"); // Removes the validation styling
                                                        }
                                                    }
                                            </script>
                                            ';

                                        // Modal for deleting section
                                        echo '
                                            <div class="modal fade" id="del_section' . $row['section_code'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center mt-5">
                                                            <div class="text-danger">
                                                                <i class="bi bi-trash fs-1 "></i><br><br>
                                                            </div>
                                                            <h5>Are you sure you want to delete '  . $row['section_code'] . ' ?</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-center mt-5 mb-5">
                                                            <a href="includes/Operation/deleteSection.php?id='  . $row['section_code'] . '" class="btn btn-danger me-3" style="width: 120px;">Remove</a>
                                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center fs-3"><i class="bi bi-emoji-frown me-2"></i>Section not found.<br>
                                </td>
                              </tr>';
                                }

                                echo '</tbody>';
                                echo '</table>';
                                $mySQLFunction->disconnect();
                                ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


</main>







<script src="../assets/js/validationform.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


<!-- jQuery and DataTables JS -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<!-- PDF ,EXCEL, PRINT ,CVS -->
<script src="../assets/js/section.js"></script>