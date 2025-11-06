const downloadBtn = document.getElementById("download-backup-btn");
const restoreForm = document.getElementById("backupForm");

// ========== CREATE BACKUP ========== //
downloadBtn.addEventListener("click", async (e) => {
  e.preventDefault();
  try {
    const form = new FormData();
    form.append("backup", "backup");

    const res = await fetch("api/backup.php", {
      method: "POST",
      body: form,
    });

    const data = await res.json();

    if (data.status === "success") {
      showSuccess(data.message);

      // Wait a bit then trigger file download
      setTimeout(() => {
        const link = document.createElement("a");
        link.href = data.file; // e.g. "backups/backup_2025-11-04_12-00-00.sql"
        link.download = data.file.split("/").pop();
        document.body.appendChild(link);
        link.click();
        link.remove();
      }, 1000);
    } else {
      showError(data.message);
    }
  } catch (err) {
    showError("❌ Error occurred while creating backup.");
    console.error(err);
  }
});

// ========== RESTORE BACKUP ========== //
restoreForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  try {
    const formData = new FormData(restoreForm);
    formData.append("restore", "restore");

    const res = await fetch("api/backup.php", {
      method: "POST",
      body: formData,
    });

    const data = await res.json();

    if (data.status === "success") {
      showSuccess(data.message);
    } else {
      showError(data.message);
    }
  } catch (err) {
    showError("❌ Error occurred while restoring database.");
    console.error(err);
  }
});
