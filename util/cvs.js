// ===== Reusable CSV Export Function =====
function exportTableToCSV(tableSelector, filename = "data.csv") {
  const table = document.getElementById(tableSelector);
  if (!table) {
    console.error(`Table not found: ${tableSelector}`);
    return;
  }

  const rows = table.querySelectorAll("tr");
  let csv = [];

  rows.forEach((row) => {
    const cols = row.querySelectorAll("th, td");
    const rowData = [];
    cols.forEach((col) => {
      // Escape quotes and commas
      const text = col.innerText.replace(/"/g, '""');
      rowData.push(`"${text}"`);
    });
    csv.push(rowData.join(","));
  });

  const csvContent = csv.join("\n");
  const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
  const url = URL.createObjectURL(blob);

  const link = document.createElement("a");
  link.href = url;
  link.setAttribute("download", filename);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
