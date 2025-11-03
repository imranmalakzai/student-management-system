// js/helpers/pdfHelper.js
// ===============================| PDF Helper |===============================
// Requires: jsPDF and html2canvas libraries to be loaded globally
async function downloadTableAsPDF(options) {
  const {
    elementId, // ID of the container (table or section to print)
    fileName = "Report.pdf",
    title = "Data Report",
    hideSelectors = [".btn", ".pagination"], // elements to temporarily hide
  } = options;

  const { jsPDF } = window.jspdf;
  const element = document.getElementById(elementId);

  if (!element) {
    console.error(`Element with ID '${elementId}' not found`);
    return;
  }

  // Hide unwanted elements
  hideSelectors.forEach((selector) => {
    document
      .querySelectorAll(selector)
      .forEach((el) => (el.style.display = "none"));
  });

  // Capture element as canvas
  await html2canvas(element, { scale: 2 }).then((canvas) => {
    const pdf = new jsPDF("p", "mm", "a4");
    const imgData = canvas.toDataURL("image/png");
    const pageWidth = 190;
    const pageHeight = 295;
    const imgHeight = (canvas.height * pageWidth) / canvas.width;
    let heightLeft = imgHeight;
    let position = 30; // leave space for title

    // Add modern header with title and subtle background
    pdf.setFillColor(245, 245, 245); // Light gray background for header
    pdf.rect(0, 0, 210, 25, "F"); // Header rectangle across page width
    pdf.setFont("helvetica", "bold");
    pdf.setFontSize(18);
    pdf.setTextColor(33, 37, 41); // Dark gray for professional look
    pdf.text(title, 105, 15, { align: "center" });

    // Add timestamp with refined styling
    pdf.setFont("helvetica", "normal");
    pdf.setFontSize(9);
    pdf.setTextColor(108, 117, 125); // Muted gray for secondary text
    pdf.text(`Generated on: ${new Date().toLocaleString()}`, 10, 22);

    // Add subtle divider line below header
    pdf.setDrawColor(200, 200, 200);
    pdf.setLineWidth(0.5);
    pdf.line(10, 25, 200, 25);

    // Add table image with clean margins
    pdf.addImage(imgData, "PNG", 10, position, pageWidth, imgHeight);
    heightLeft -= pageHeight;

    while (heightLeft > 0) {
      position = heightLeft - imgHeight;
      pdf.addPage();

      // Repeat header on additional pages
      pdf.setFillColor(245, 245, 245);
      pdf.rect(0, 0, 210, 25, "F");
      pdf.setFont("helvetica", "bold");
      pdf.setFontSize(18);
      pdf.setTextColor(33, 37, 41);
      pdf.text(title, 105, 15, { align: "center" });
      pdf.setFont("helvetica", "normal");
      pdf.setFontSize(9);
      pdf.setTextColor(108, 117, 125);
      pdf.text(`Generated on: ${new Date().toLocaleString()}`, 10, 22);
      pdf.setDrawColor(200, 200, 200);
      pdf.setLineWidth(0.5);
      pdf.line(10, 25, 200, 25);

      pdf.addImage(imgData, "PNG", 10, position, pageWidth, imgHeight);
      heightLeft -= pageHeight;
    }

    // Add footer with page number on all pages
    const pageCount = pdf.internal.getNumberOfPages();
    for (let i = 1; i <= pageCount; i++) {
      pdf.setPage(i);
      pdf.setFont("helvetica", "normal");
      pdf.setFontSize(8);
      pdf.setTextColor(108, 117, 125);
      pdf.text(`Page ${i} of ${pageCount}`, 190, 290, { align: "right" });
      // Add subtle footer line
      pdf.setDrawColor(200, 200, 200);
      pdf.setLineWidth(0.3);
      pdf.line(10, 287, 200, 287);
    }

    pdf.save(fileName);
  });

  // Restore hidden elements
  hideSelectors.forEach((selector) => {
    document
      .querySelectorAll(selector)
      .forEach((el) => (el.style.display = ""));
  });
}
