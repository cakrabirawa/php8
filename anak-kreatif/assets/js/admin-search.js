/**
 * Initializes a live search feature for a table.
 * @param {string} inputId The ID of the search input element.
 * @param {string} tableBodyId The ID of the tbody element of the table to be filtered.
 * @param {string} noResultsId The ID of the element (td) to show when no results are found.
 */
function initLiveSearch(inputId, tableBodyId, noResultsId) {
  const searchInput = document.getElementById(inputId);
  const tableBody = document.getElementById(tableBodyId);
  const noResultsRow = document.getElementById(noResultsId)?.parentElement; // Get the <tr> parent

  if (!searchInput || !tableBody) {
    console.error("Live search initialization failed: Input or Table Body not found.");
    return;
  }

  // Get all data rows, excluding the 'no results' row
  const dataRows = Array.from(tableBody.querySelectorAll('tr')).filter(tr => !tr.contains(document.getElementById(noResultsId)));

  searchInput.addEventListener('input', function () {
    const keyword = this.value.toLowerCase().trim();
    let hasVisibleRows = false;

    dataRows.forEach(row => {
      const rowText = row.textContent.toLowerCase();
      if (rowText.includes(keyword)) {
        row.style.display = ''; // Show row
        hasVisibleRows = true;
      } else {
        row.style.display = 'none'; // Hide row
      }
    });

    // Toggle the visibility of the "no results" message row
    if (noResultsRow) {
      if (hasVisibleRows) {
        noResultsRow.style.display = 'none';
      } else {
        // If there are no results, show the message row
        noResultsRow.style.display = '';
      }
    }
  });

  // Initially hide the 'no results' row if there are data rows
  if (noResultsRow && dataRows.length > 0) {
    noResultsRow.style.display = 'none';
  }
}