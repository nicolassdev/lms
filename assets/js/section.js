$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip', // Include buttons in the dom
        buttons: [
            'copy', 
            {
                extend: 'csvHtml5',
                text: 'CSV',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the "Action" column (assuming index 7)
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'excelHtml5',
                text: 'Excel',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the "Action" column (assuming index 7)
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the "Action" column (assuming index 7)
                        return index !== 6;
                    }
                }
            },
            {
                extend: 'print',
                text: 'Print',
                autoPrint: true, // This will print in the same tab (no new window)
                customize: function (win) {
                    // Custom styling or adjustments for print can go here
                    $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend(
                            '<h3>Section Details</h3>' // Add a custom title for the print view
                        );
                    $(win.document.body).find('table')
                        .addClass('compact') // Optional: Compact styling for the table in print view
                        .css('font-size', 'inherit');
                },
                exportOptions: {
                    columns: function (index, data, node) {
                        // Exclude the "Action" column (assuming index 7)
                        return index !== 6;
                    }
                }
            }
        ]
    });
  });