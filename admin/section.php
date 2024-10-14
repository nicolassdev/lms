<?php
include "../includes/dbh-inc.php";
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../admin/includes/Forms/sectionform.php";
?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h3 class="text-black">List of Section</h3>
                        <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#section" data-bs-whatever="@fat">
                            <i class="bi bi-plus-circle-fill me-2"></i>Section
                        </button>
                    </div>
                    <!-- NOTIFICATION -->

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
                    <!-- TABLE -->
                    <div class="table-responsive small ms-3 me-3">
                        <table id="example" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-dark ">
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col" class="small text-center">Section Code</th>
                                    <th scope="col" class="small text-center">Strand</th>
                                    <th scope="col" class="small text-center">Year level</th>
                                    <th scope="col" class="small text-center">Section name</th>
                                    <th scope="col" class="small text-center">Adviser</th>
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

                                        echo '<td class="small text-center">' . $row["section_code"] . '</td>';
                                        echo '<td class="small text-center">' . $row["strand_name"] . '</td>';
                                        echo '<td class="small text-center">' . $row["grade_lvl"] . '</td>';
                                        echo '<td class="small text-center">' . $row["section_name"] . '</td>';
                                        echo '<td class="small text-center">' . ucwords(strtolower($row["adviser"])) . '</td>';

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

                                        //Todo Modal for updating section
                                        echo '
                                        <div class="modal fade" id="edit_section' . htmlspecialchars($row['section_code']) . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">Edit Section Details</h5>
                                                        <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="./includes/Operation/updateSection.php" method="POST" class="row g-3 needs-validation" novalidate id="editSectionForm' . htmlspecialchars($row['section_code']) . '">
                                                            <!-- Use hidden input -->
                                                            <input type="hidden" name="sectionID" value="' . htmlspecialchars($row['section_code']) . '">
                                    
                                                           
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Strand Name</label>
                                    <select name="strand_code" class="form-select" id="strandSelect' . htmlspecialchars($row['section_code']) . '" disabled>';

                                        // Fetch and populate strand options
                                        $mySQLFunction->connection();
                                        $strands = $mySQLFunction->getStrand();
                                        foreach ($strands as $strand) {
                                            // Check if the strand matches the current row
                                            $selected = $strand["strand_name"] == $row['strand_name'] ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($strand["strand_name"]) . '"' . $selected . '>' . htmlspecialchars($strand["strand_desc"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please input a strand name.
                                                </div>
                                            </div>
                                        
                                    
                                    
                                                            <!-- Grade Level -->
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label fw-bold">Grade Level</label>
                                                                <select class="form-select" name="gradelvl" id="gradeLvl' . htmlspecialchars($row['section_code']) . '" required>                                                                        
                                                                    <option value="GRADE-12"' . ($row['grade_lvl'] == 'GRADE-12' ? ' selected' : '') . '>GRADE-12</option>
                                                                    <option value="GRADE-11"' . ($row['grade_lvl'] == 'GRADE-11' ? ' selected' : '') . '>GRADE-11</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Please select a grade level.
                                                                </div>
                                                            </div>
                                    
                                                            <!-- Section Name -->
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label fw-bold">Section</label>
                                                                <input type="text" class="form-control" name="section" value="' . htmlspecialchars($row['section_name']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please select a section name.
                                                                </div>
                                                            </div>      



                                                    <div class="col-md-12 mb-3">
                                                            <label class="form-label fw-bold">Adviser</label>
                                                            <input text="text" class="form-control" name="teacher_id" value="' . htmlspecialchars($row['adviser']) . '"  disabled>                                                                                             
                                                            <div class="invalid-feedback">
                                                                Please select an adviser.
                                                        </div>
                                                    </div>';




                                        echo '


                                                            <!-- Buttons -->
                                                            <div class="d-flex justify-content-between gap-2">
                                                                <button name="submit" class="btn btn-primary w-100 mt-3" type="submit">Save</button>
                                                                <button type="button" class="btn btn-outline-secondary w-100 mt-3" data-bs-dismiss="modal" aria-label="Close" onclick="resetSection(\'' . htmlspecialchars($row['section_code']) . '\')">Cancel</button>
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


                                        //todo Modal for deleting section
                                        echo '
                                        <div class="modal fade" id="del_section' . $row['section_code'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md">
                                                <div class="modal-content shadow-lg border-0 rounded">
                                                    <!-- Modal Body -->
                                                    <div class="modal-body text-center py-5">
                                                        <!-- Icon with subtle animation -->
                                                        <div class="text-danger mb-4">
                                                            <i class="bi bi-trash fs-1 bounce-animation"></i>
                                                        </div>
                                                        <!-- Section Name Confirmation -->
                                                        <h5 class="mb-4 fw-bold text-dark">Are you sure you want to remove "<span class="text-danger">' . ucwords(strtolower($row['section_name'])) . '</span>"?</h5>
                                                        <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                                    </div>
                                                    <!-- Action Buttons -->
                                                    <div class="d-flex justify-content-center mb-5">
                                                        <a href="includes/Operation/deleteSection.php?id=' . $row['section_code'] . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                                        <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<tr>
                                <td colspan="10" class="text-center">Section not found.<br>
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


<?php
include("../admin/includes/footer.php");
?>

<!-- PDF ,EXCEL, PRINT ,CVS -->
<script>
    $(document).ready(function() {
        $("#example").DataTable({
            dom: "Bfrtip", // Include buttons in the dom
            buttons: [
                "copy",
                {
                    extend: "csvHtml5",
                    text: "CSV",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 5;
                        },
                    },
                },
                {
                    extend: "excelHtml5",
                    text: "Excel",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 5;
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 5;
                        },
                    },
                },
                {
                    extend: "print",
                    text: "Print",
                    autoPrint: true, // This will print in the same tab (no new window)
                    customize: function(win) {
                        // Custom styling or adjustments for print can go here
                        $(win.document.body).css("font-size", "10pt").prepend(
                            "<h3>Section Details</h3>" // Add a custom title for the print view
                        );
                        $(win.document.body)
                            .find("table")
                            .addClass("compact") // Optional: Compact styling for the table in print view
                            .css("font-size", "inherit");
                    },
                    exportOptions: {
                        columns: function(index, data, node) {
                            // Exclude the "Action" column (assuming index 7)
                            return index !== 5;
                        },
                    },
                },
            ],
        });
    });
</script>