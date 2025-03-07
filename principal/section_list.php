<!-- VALIDATION CAN'T ACCESS THE URL -->
<?php
if (!isset($_SESSION['principal_id'])) {
    header("location:../login.php?error=accessdenied");
}
?>

<?php
include "../includes/dbh-inc.php";
?>
<!-- FORM MODAL ADD TEACHER  -->
<?php
include "../principal/includes/Forms/sectionform.php";
?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 pt-2">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data-table">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                        <h5 class="fw-bold">List of Section</h5>
                        <button type="button" class="btn btn-primary btn-sm btn-animate" data-bs-toggle="modal" data-bs-target="#section" data-bs-whatever="@fat">
                            <i class="bi bi-plus-circle-fill me-2"></i>Add Section
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
                        <table id="sectionRecord" class="table table-bordered table-striped table-sm align-middle">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col" class="small text-center">Section</th>
                                    <th scope="col" class="small text-center">Strand</th>
                                    <th scope="col" class="small text-center">Year level</th>
                                    <th scope="col" class="small text-center">School year</th>
                                    <th scope="col" class="small text-center">Adviser</th>
                                    <th scope="col" class="text-center">Action</th>
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
                                        // echo '<td class="small text-center">' . $row["section_code"] . '</td>';
                                        echo '<td class="small text-center">' . $row["section_name"] . '</td>';
                                        echo '<td class="small text-center">' . $row["strand_name"] . '</td>';
                                        echo '<td class="small text-center">' . $row["grade_lvl"] . '</td>';
                                        echo '<td class="small text-center">' . $row["school_year"] . '</td>';
                                        echo '<td class="small text-center">' . ucwords(strtolower($row["adviser"])) . '</td>';

                                        echo '
                                            <td class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#edit_section' . $row['section_code'] . '">
                                                <i class="bi bi-pencil-square me-1"></i>Edit
                                            </button>
                                            </td>
                                            ';
                                        // THIS IS THE DELETE BUTTON I WILL LEAVE IT COMMENT , IF NEEDED JUST UNCOMMENT 
                                        // <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete_section' . $row['section_code'] . '">
                                        //     <i class="bi bi-trash"></i>Delete
                                        // </button>

                                        echo '</tr>';

                                        $count++;

                                        //Todo Modal for updating section
                                        echo '
                                        <div class="modal fade" id="edit_section' . htmlspecialchars($row['section_code']) . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                        <div class="modal-header bg-success text-white">
                                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                            <div class="text-start">
                                                                <h1 class="modal-title fs-5 text-white">Edit Section details</h1>
                                                            </div>
                                                            </div>
                                                            <div class="text-end">
                                                            <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                                            </div>                           
                                                        </div>
                                                    <div class="modal-body p-4">
                                                        <form action="./includes/Operation/updateSection.php" method="POST" class="row g-3 needs-validation" novalidate id="editSectionForm' . htmlspecialchars($row['section_code']) . '">
                                                            <!-- Use hidden input -->
                                                            <input type="hidden" name="sectionID" value="' . htmlspecialchars($row['section_code']) . '">';


                                        //<div class="col-md-12 mb-3">
                                        // <label class="form-label fw-bold">Strand Name</label>
                                        // <select name="strand_code" class="form-select" id="strand_code' . htmlspecialchars($row['section_code']) . '" >

                                        //     // Fetch and populate strand options
                                        //     $mySQLFunction->connection();
                                        //     $strands = $mySQLFunction->getStrand();
                                        //     foreach ($strands as $strand) {
                                        //         // Check if the strand matches the current row
                                        //         $selected = $strand["strand_name"] == $row['strand_name'] ? ' selected' : '';
                                        //         echo '<option value="' . htmlspecialchars($strand["strand_name"]) . '"' . $selected . '>' . htmlspecialchars($strand["strand_desc"]) . '</option>';
                                        //     }
                                        //     $mySQLFunction->disconnect();


                                        //             </select>
                                        //             <div class="invalid-feedback">
                                        //                 Please input a strand name.
                                        //             </div>
                                        //         </div>
                                        echo '
                                    
                                                                        
                                                            <!-- Section Name -->
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label fw-bold">Section</label>
                                                                <input type="text" class="form-control" name="section" value="' . htmlspecialchars($row['section_name']) . '" required>
                                                                <div class="invalid-feedback">
                                                                    Please select a section name.
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


                                                            <div class="col-md-12 mb-3">
                                                            <label class="form-label fw-bold">School year</label>
                                                            <select name="school_year" class="form-select" id="strand_code' . htmlspecialchars($row['section_code']) . '" > ';
                                        // Fetch and populate sy options
                                        $mySQLFunction->connection();
                                        $schoolyear = $mySQLFunction->getSchoolyear();
                                        foreach ($schoolyear as $sy) {
                                            // Check if the sy matches the current row
                                            $selected = $sy["school_year"] == $row['school_year'] ? ' selected' : '';
                                            echo '<option value="' . htmlspecialchars($sy["school_year"]) . '"' . $selected . '>' . htmlspecialchars($sy["school_year"]) . '</option>';
                                        }
                                        $mySQLFunction->disconnect();

                                        echo '  </select>
                                                                <div class="invalid-feedback">
                                                                    Please input a strand name.
                                                                 </div>
                                                            </div>



                                                         <div class="col-md-12 mb-3">
                                                            <label class="form-label fw-bold">Strand</label>
                                                            <input text="text" class="form-control" name="strand_code" value="' . htmlspecialchars($row['strand_desc']) . '"  disabled>                                                                                             
                                                            <div class="invalid-feedback">
                                                                Please select an adviser.
                                                        </div>


                                                         <div class="col-md-12 mt-3">
                                                            <label class="form-label fw-bold">Adviser</label>
                                                            <input text="text" class="form-control" name="teacher_id" value="' . htmlspecialchars($row['adviser']) . '"  disabled>                                                                                             
                                                            <div class="invalid-feedback">
                                                                Please select an adviser.
                                                        </div>
                                                    </div>';


                                        echo '


                                                            <!-- Buttons -->
                                                            <div class="d-flex justify-content-between gap-2 mt-3">
                                                                <button name="submit" class="btn btn-success w-100 mt-3" type="submit">Update</button>
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
                                        <div class="modal fade" id="delete_section' . htmlspecialchars($row['section_code'])  . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
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
    <?php
    include("../principal/includes/extension.php");
    ?>
</main>


<!-- PDF ,EXCEL, PRINT ,CVS -->
<script>
    $(document).ready(function() {
        $("#sectionRecord").DataTable({
            dom: "Bfrtip", // Include buttons in the dom
            buttons: [{
                    extend: "excelHtml5",
                    text: '<i class="fas fa-file-excel"></i>Download Excel',
                    className: "btn btn-sm btn-success",
                    titleAttr: "Export as Excel",
                    exportOptions: {
                        columns: function(index, data, node) {
                            return index !== 5;
                        },
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: '<i class="fas fa-file-pdf"></i> Download PDF',
                    className: "btn btn-sm btn-danger",
                    titleAttr: "Export as PDF",
                    exportOptions: {
                        columns: [0, 1, 2, 3], // Explicitly include columns 0 to 3
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    customize: function(doc) {
                        doc.pageMargins = [40, 60, 40, 60];
                        doc.defaultStyle.fontSize = 10;
                        doc.styles.tableHeader.fontSize = 12;

                        // Add header and footer (example)
                        doc['header'] = (function(page, pages) {
                            return {
                                columns: [{
                                    alignment: 'right',
                                    text: ['Page ', {
                                        text: page.toString()
                                    }, ' of ', {
                                        text: pages.toString()
                                    }]
                                }],
                                margin: [10, 10, 10, 0]
                            }
                        });

                        doc.styles.header = {
                            fontSize: 18,
                            bold: true,
                            margin: [0, 0, 0, 10]
                        };

                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('').map(function(s) {
                                return '*';
                            });
                    }
                },
                {
                    extend: "print",
                    text: '<i class="fas fa-print"></i> Print',
                    className: "btn btn-sm btn-info",
                    titleAttr: "Print Table",
                    autoPrint: true,
                    customize: function(win) {
                        // Hide the LMS heading during print
                        $(win.document.body)
                            .find('h1:contains("Learning Management System")') // Adjust the selector if needed
                            .css("display", "none");

                        $(win.document.body)
                            .css("font-size", "10pt")
                            .prepend(
                                // This is the container that holds both left and right aligned text
                                '<div style="display: flex; justify-content: space-between; align-items: center;">' +
                                // Left-aligned: List of Enrolled Students
                                '<div style="text-align:left; flex: 1;">' +
                                "<h5 style='font-size: 14px; margin-left: 15px;'>Sections</h5>" +
                                "</div>" +
                                // Right-aligned: Computer Systems Institute
                                '<div style="text-align:right; flex: 1;">' +
                                "<h6>Computer Systems Institute</h6>" +
                                "<small>F. Imperial st., Brgy. 36 - Capantawan, Legazpi City</small><br>" +
                                "</div>" +
                                "</div>"
                            );

                        $(win.document.body)
                            .find("table thead th")
                            .css("background-color", "#007bff") // Header color
                            .css("color", "#ffffff")
                            .css("padding", "10px");

                        $(win.document.body)
                            .find("table")
                            .addClass("compact")
                            .css("font-size", "inherit");
                    },
                    exportOptions: {
                        columns: function(index, data, node) {
                            return index !== 5;
                        },
                    },
                },
            ],
        });
    });
</script>


<!-- PDF ,EXCEL, PRINT ,CVS -->
<!-- <script src="../assets/js/globaltables.js"></script>
<script>
    initializeDataTable("sectionRecord", 5, "Sections");
</script> -->