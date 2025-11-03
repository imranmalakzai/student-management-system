const downloadBtn = document.getElementById("download-backup-btn");
const restoreForm = document.getElementById("backupForm");

// ========== CREATE BACKUP ==========
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
      await showSuccess(data.message);
      window.location.href = "index.php";
      // waits 2 seconds, then redirects
    } else {
      showError(data.message);
    }
  } catch (err) {
    showError("❌ Error occurred while creating backup.");
  }
});

// ========== RESTORE BACKUP ==========
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
  }
});
