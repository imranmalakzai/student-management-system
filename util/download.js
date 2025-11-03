/**
 * Show SweetAlert modal to choose download format
 * @param {string} buttonId - ID of the download button
 * @param {Function} pdfFunc - Function to call when PDF is selected
 * @param {Function} csvFunc - Function to call when CSV is selected
 */
function setupDownloadSelector(buttonId, pdfFunc, csvFunc) {
  const btn = document.getElementById(buttonId);
  if (!btn) return console.warn(`No button found with ID: ${buttonId}`);

  btn.addEventListener("click", () => {
    Swal.fire({
      title: "Select Download Format",
      icon: "info",
      showCancelButton: true,
      showDenyButton: true,
      confirmButtonText: "PDF",
      denyButtonText: "CSV",
      cancelButtonText: "Cancel",
      confirmButtonColor: "#0000ff", // PDF red
      denyButtonColor: "#09d209ff", // CSV green
    }).then((result) => {
      if (result.isConfirmed && typeof pdfFunc === "function") {
        pdfFunc();
      } else if (result.isDenied && typeof csvFunc === "function") {
        csvFunc();
      }
    });
  });
}
