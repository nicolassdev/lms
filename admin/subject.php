<?php
include "../includes/dbh-inc.php";

?>
<?php
include "../admin/includes/Forms/subjectform.php";
?>
<!-- THIS THE SUBJECT TABLE -->


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="data-table">

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
            <h3 class="text-black">List of Subject</h3>
            <button type="button" class="btn btn-primary btn-animate" data-bs-toggle="modal" data-bs-target="#subject" data-bs-whatever="@fat">
              <i class="bi bi-plus-circle-fill me-2"></i>Subject
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
          } elseif (isset($_SESSION['subject_exist'])) {
            echo '<div class="alert alert-primary alert-dismissible fade show p-2" role="alert" style="font-size: 14px; line-height: 1.2;  max-width:1000px;">';
            echo '<i class="bi bi-info-square-fill fs-5 me-2"></i>' . $_SESSION['subject_exist'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

            // Reduced font size for the timestamp
            echo '<small class="d-block mt-1 text-muted">Just now</small>';

            echo '</div>';
            unset($_SESSION['subject_exist']);
          }

          ?>

          <!-- SUBJECT TABLE -->
          <div class="table-responsive small ms-3 me-3">
            <table id="example" class="table table-bordered table-striped table-sm align-middle ">
              <thead class="table-dark ">
                <tr>
                  <!-- <th scope="col">#</th> -->
                  <th scope="col" class="small text-center">Subject Code</th>
                  <th scope="col" class="small text-center">Subject</th>
                  <th scope="col" class="small text-center">Category</th>
                  <th scope="col" class="small text-center">Time</th>
                  <th scope="col" class="small text-center">Subject semester</th>
                  <th scope="col" class="small text-center">Strand</th>
                  <th scope="col" class="small text-center ">Teacher</th>
                  <th scope="col" class="text-center">Action</th> <!-- colspan should be 2 -->

                </tr>
              </thead>
              <tbody>
                <?php
                $mySQLFunction->connection();

                $result = $mySQLFunction->getSubject();
                if (!empty($result)) {
                  $count = 0;
                  foreach ($result as $row) {
                    echo '<tr>';

                    echo '<td>' . $row["sub_code"] . '</td>';
                    echo '<td>' . ucwords(strtolower($row["sub_title"])) . '</td>';
                    echo '<td>' . ucwords(strtolower($row["sub_type"])) . '</td>';
                    echo '<td>' . $row["sub_time"] . '</td>';
                    echo '<td>' . $row["sub_semester"] . '</td>';
                    echo '<td>' . $row["strand"] . '</td>';
                    echo '<td>' . ucwords(strtolower($row["teacher"])) . '</td>';
                    echo '
                                        <td class="d-flex justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#edit_subject' . $row['sub_code'] . '">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del_section' . $row['sub_code'] . '">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                            ';
                    echo '</tr>';

                    $count++;

                    //todo Modal for updating subject
                    // Modal for updating section
                    echo '
                    <div class="modal fade" id="edit_subject' . htmlspecialchars($row['sub_code']) . '"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Edit Subject Details</h5>
                                    <i class="bi bi-pencil-square fs-3 ms-2"></i>
                                </div>
                                <div class="modal-body p-4">
                                    <form action="./includes/Operation/updateSubject.php" method="POST" class="row g-3 needs-validation" novalidate id="editSubjectForm' . htmlspecialchars($row['sub_code']) . '">
                                        <!-- Use hidden input -->
                                        <input type="hidden" name="subID" value="' . htmlspecialchars($row['sub_code']) . '">
                
                                        <!-- Subject Name -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Subject Name</label>
                                            <input type="text" class="form-control" name="subject" value="' . htmlspecialchars($row['sub_title']) . '" required>
                                            <div class="invalid-feedback">
                                                Please enter a subject name.
                                            </div>
                                        </div>
                
                                        <!-- Category -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Category</label>
                                            <select class="form-select" name="type" required>
                                                <option value="SPECIALIZED SUBJECT"' . ($row['sub_type'] == 'SPECIALIZED SUBJECT' ? ' selected' : '') . '>SPECIALIZED SUBJECT</option>
                                                <option value="APPLIED SUBJECT"' . ($row['sub_type'] == 'APPLIED SUBJECT' ? ' selected' : '') . '>APPLIED SUBJECT</option>
                                                <option value="CORE SUBJECT"' . ($row['sub_type'] == 'CORE SUBJECT' ? ' selected' : '') . '>CORE SUBJECT</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a category.
                                            </div>
                                        </div>
                
                                        <!-- Time -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold">Time</label>
                                            <input type="text" class="form-control" name="time" value="' . htmlspecialchars($row['sub_time']) . '" >
                                            <div class="invalid-feedback">
                                                Please enter a valid time.
                                            </div>
                                        </div>
                
                                        <!-- Buttons -->
                                        <div class="d-flex justify-content-between mt-4 gap-1">
                                            <button name="submit" class="btn btn-primary w-100" type="submit">Save</button>
                                            <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="resetSubject(\'' . htmlspecialchars($row['sub_code']) . '\')">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <script>
                        function resetSubject(id) {
                            var form = document.getElementById("editSubjectForm" + id);
                            if (form) {
                                form.reset(); // Clears the form fields
                                form.classList.remove("was-validated"); // Removes validation styles
                            }
                        }
                    </script>
                ';



                    // todo Modal for deleting subject
                    echo '
                    <div class="modal fade" id="del_section' . $row['sub_code'] . '" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content shadow-lg">
                                <div class="modal-header border-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="text-danger">
                                        <i class="bi bi-trash fs-1 fade-in"></i>
                                    </div>
                                    <h5 class="mt-4 mb-4 text-dark fw-bold">Are you sure you want to remove "<span class="text-danger">' . ucwords(strtolower($row['sub_title'])) . '</span>" ?</h5>
                                    <p class="text-muted">This action cannot be undone. Please confirm your decision below.</p>
                                </div>
                        <div class="modal-footer justify-content-center border-0 mt-3 mb-4">
                                    <a href="includes/Operation/deleteSubject.php?id=' . $row['sub_code'] . '" class="btn btn-danger px-4 py-2 me-3" style="width: 120px;">Remove</a>
                                    <button class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>';
                  }
                } else {
                  echo '<tr>
                                <td colspan="10" class="text-center">Empty subject.<br>
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
              return index !== 7;
            },
          },
        },
        {
          extend: "excelHtml5",
          text: "Excel",
          exportOptions: {
            columns: function(index, data, node) {
              // Exclude the "Action" column (assuming index 7)
              return index !== 7;
            },
          },
        },
        {
          extend: "pdfHtml5",
          text: "PDF",
          exportOptions: {
            columns: function(index, data, node) {

              // Exclude the "Action" column (assuming index 7)
              return index !== 7;
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
              .find('h1:contains("LMS")') // Adjust the selector if needed
              .css("display", "none");

            $(win.document.body)
              .find("table")
              .addClass("compact") // Optional: Compact styling for the table in print view
              .css("font-size", "inherit");
          },
          exportOptions: {
            columns: function(index, data, node) {
              // Exclude the "Action" column (assuming index 7)
              return index !== 7;
            },
          },
        },
      ],
    });
  });
</script>