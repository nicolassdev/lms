$(document).ready(function () {
  $("#example").DataTable({
    dom: "Bfrtip", // Include buttons in the dom
    buttons: [
      {
        extend: "copy",
        text: '<i class="fas fa-copy"></i> Copy',
        className: "btn btn-sm btn-primary",
        titleAttr: "Copy to clipboard",
      },
      {
        extend: "csvHtml5",
        text: '<i class="fas fa-file-csv"></i> CSV',
        className: "btn btn-sm btn-success",
        titleAttr: "Export as CSV",
        exportOptions: {
          columns: function (index, data, node) {
            // Exclude the "Action" column (assuming index 8)
            return index !== 8;
          },
        },
      },
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i> Excel',
        className: "btn btn-sm btn-success",
        titleAttr: "Export as Excel",
        exportOptions: {
          columns: function (index, data, node) {
            return index !== 8;
          },
        },
      },
      {
        extend: "pdfHtml5",
        text: '<i class="fas fa-file-pdf"></i> PDF',
        className: "btn btn-sm btn-danger",
        titleAttr: "Export as PDF",
        exportOptions: {
          columns: function (index, data, node) {
            return index !== 8;
          },
        },
      },
      {
        extend: "print",
        text: '<i class="fas fa-print"></i> Print',
        className: "btn btn-sm btn-info",
        titleAttr: "Print Table",
        autoPrint: true,
        customize: function (win) {
          // Hide the LMS heading during print
          $(win.document.body)
            .find('h1:contains("LMS")') // Adjust the selector if needed
            .css("display", "none");

          $(win.document.body)
            .css("font-size", "10pt")
            .prepend(
              // This is the container that holds both left and right aligned text
              '<div style="display: flex; justify-content: space-between; align-items: center;">' +
                // Left-aligned: List of Enrolled Students
                '<div style="text-align:left; flex: 1;">' +
                "<h5 style='font-size: 14px;'>List of Enrolled Students</h5>" +
                "<small>" +
                schoolYearSemester +
                "</small>" + // Inject the dynamically generated school year/semester
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
          columns: function (index, data, node) {
            return index !== 8;
          },
        },
      },
    ],
  });
});
