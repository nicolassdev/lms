/**
 * Initialize DataTable with export buttons and dynamic column exclusion.
 * @param {string} tableId - The ID of the table to initialize DataTable on.
 * @param {number} excludeIndex - The column index to exclude from export options.
 * @param {string} title - The title to display in the print and export customizations.
 */
function initializeDataTable(tableId, excludeIndex, title) {
  $(document).ready(function () {
    $(`#${tableId}`).DataTable({
      dom: "Bfrtip", // Include buttons in the dom
      buttons: [
        {
          extend: "excelHtml5",
          text: "Download Excel",
          exportOptions: {
            columns: function (index, data, node) {
              // Exclude the specified column
              return index !== excludeIndex;
            },
          },
        },
        {
          extend: "pdfHtml5",
          text: "Download PDF",
          exportOptions: {
            columns: function (index, data, node) {
              // Exclude the specified column
              return index !== excludeIndex;
            },
          },
        },
        {
          extend: "print",
          text: "Print",
          autoPrint: true,
          customize: function (win) {
            // Custom styling or adjustments for print can go here
            $(win.document.body)
              .find('h1:contains("Learning Management System")')
              .css("display", "none");

            // Customize print view
            $(win.document.body)
              .css("font-size", "10pt")
              .prepend(
                `<div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="text-align:left; flex: 1;">
                                            <h5 style='font-size: 14px;'>${title}</h5>
                                        </div>
                                        <div style="text-align:right; flex: 1;">
                                            <h6>Computer Systems Institute</h6>
                                            <small>F. Imperial st., Brgy. 36 - Capantawan, Legazpi City</small><br>
                                        </div>
                                    </div>`
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
              // Exclude the specified column
              return index !== excludeIndex;
            },
          },
        },
      ],
    });
  });
}
