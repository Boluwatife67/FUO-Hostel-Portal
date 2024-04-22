document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("input", function () {
      const searchValue = searchInput.value.toLowerCase();
      const tableRows = document.querySelectorAll("table tbody tr");
      tableRows.forEach(function (row) {
        const tableDataValues = row.querySelectorAll("td");
        let showRow = false;
        tableDataValues.forEach(function (tableData) {
          const tableDataValue = tableData.textContent.toLowerCase();
          if (tableDataValue.includes(searchValue)) {
            showRow = true;
          }
        });
        if (showRow) {
          row.style.display = "table-row";
        } else {
          row.style.display = "none";
        }
      });
    });
  });
  