 <!-- VALIDATION CAN'T ACCESS THE URL -->
 <?php
    if (!isset($_SESSION['registrar_id'])) {
        header("location:../login.php?error=accessdenied");
    }
    ?>

 <?php
    include "../includes/dbh-inc.php";
    $mySQLFunction->connection();
    $activeSchoolYears = $mySQLFunction->checkSyStatus('sy');
    $activeSem = $mySQLFunction->checkSemStatus('semester');


    $result = $mySQLFunction->getSubjectbyStrands();


    $mySQLFunction->disconnect();
    ?>

 <!-- THIS THE SUBJECT TABLE -->


 <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
     <div class="container">
         <div class="row">
             <div class="col-12">
                 <div class="data-table">

                     <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3  ms-3 me-3">
                         <h6 class="text-muted fw-bold">
                             <?php
                                if (!empty($result)) {
                                    // List of strands to skip
                                    $strandsToSkip = [
                                        'SCIENCE, TECHNOLOGY, ENGINEERING, AND MATHEMATICS',
                                        'ACCOUNTANCY, BUSINESS, AND MANAGEMENT',
                                        'COMPUTER SYSTEM SERVICING',
                                        'HUMANITIES AND SOCIAL SCIENCES',
                                        'GENERAL ACADEMIC STRAND'
                                    ];

                                    // Iterate through each row in the result
                                    foreach ($result as $row) {
                                        // Ensure 'strand_desc' exists in the row
                                        if (!isset($row["strand_desc"])) {
                                            continue;  // Skip the iteration if 'strand_desc' is missing
                                        }

                                        // Check if the strand is in the skip list
                                        if (in_array(strtoupper($row["strand_desc"]), $strandsToSkip)) {
                                            continue;  // Skip this row
                                        }

                                        // Output the strand description
                                        echo ucwords(strtolower($row["strand_desc"]));
                                        break;
                                    }
                                } else {
                                    echo "No results found.";  // Provide a message if the result is empty
                                }
                                ?>
                             <div class="mt-2">
                                 <?php
                                    if (!empty($activeSchoolYears && !empty($activeSem))) {
                                        foreach ($activeSchoolYears as $index => $schoolYear) {
                                            echo '<div class="me-3  text-sm date-display">' . htmlspecialchars($activeSem[$index]) . '<i class="bi bi-check-circle-fill text-success ms-2"></i> </div>';
                                            echo '<span class="date-display  text-sm">SY ' . htmlspecialchars($schoolYear) . '</span>';;
                                        }
                                    } else {
                                        echo '<div class="alert alert-warning  text-sm">No school year and semester found.</div>';
                                    }
                                    ?>
                             </div>

                         </h6>
                         <h6 class="text-success fw-bold">
                             <?php
                                // Initialize a flag to check if 'GRADE-11' has been displayed
                                $gradelevelDisplayed = false;

                                // Iterate through the result set
                                foreach ($result as $row) {
                                    // Check if 'sub_gradelvl' is set and not empty
                                    if (!empty($row['grade_lvl'])) {
                                        // Check if 'grade_lvl' is 'GRADE-11' and hasn't been displayed yet
                                        if (strtoupper($row['grade_lvl']) == 'GRADE-11' && !$gradelevelDisplayed) {
                                            // Format and display the grade level
                                            echo ucwords(strtolower($row['grade_lvl']));
                                            // Set the flag to true to prevent further display
                                            $gradelevelDisplayed = true;
                                        }
                                    }
                                }
                                ?>
                         </h6>




                     </div>


                     <!-- SUBJECT TABLE -->
                     <div class="table-responsive small ms-3 me-3">
                         <table id="example" class="table table-bordered table-striped table-sm align-middle ">
                             <thead class="table-dark ">
                                 <tr>
                                     <th scope="col" class="small text-center">Subject</th>
                                     <th scope="col">Category</th>
                                     <th scope="col">Day</th>
                                     <th scope="col">Time</th>
                                     <th scope="col" class="small text-center ">Teacher</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php
                                    $mySQLFunction->connection();

                                    $result = $mySQLFunction->getSubjectbyStrands();

                                    if (!empty($result)) {
                                        $count = 0;
                                        foreach ($result as $row) {
                                            if (strtoupper($row["grade_lvl"]) == 'GRADE-11' && strtoupper($row["strand_name"]) == 'CP') {
                                                echo '<tr>';
                                                echo '<td>' . htmlspecialchars($row['sub_title']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['sub_type']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['sched_day']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['sched_from'] . ' - ' . $row['sched_to']) . '</td>';
                                                echo '<td>' . htmlspecialchars($row['teacher']) . '</td>';
                                                echo '</tr>';
                                            }
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
     <?php
        include("../admin/includes/extension.php");
        ?>
 </main>

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