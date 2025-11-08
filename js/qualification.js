let isEditing = false;
let modal = document.getElementById("addQualificationModal");

//=============================| show all records |=========================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/qualification.php");
    const data = await res.json();
    let tbody = document.getElementById("qualificationTableBody");
    tbody.innerHTML = "";
    data.forEach((qualification) => {
      let row = document.createElement("tr");
      row.innerHTML = `
      <th scope="row">${qualification.qualification_id}</th>
        <td>${qualification.name}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-warning me-2 shadow-sm edit-btn" data-id="${qualification.qualification_id}"><i class="fa-solid fa-pen-to-square"></i></button>
          <button class="btn btn-sm btn-danger shadow-sm delete-btn" data-id="${qualification.qualification_id}"><i class="fa-solid fa-trash"></i></button>
        </td>
      `;
      tbody.appendChild(row);
    });
    await attachBTN();
  } catch (error) {
    showError("Error inside showAllRecords sections");
    console.log(error);
  }
};

//======================== create a new Record ===========================//
const createRecord = async function (name) {
  try {
    const form = new FormData();
    form.append("name", name);
    const res = await fetch("api/qualification.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the create record section");
    console.log(error);
  }
};

//====================== Get single record ===================================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/qualification.php?qualification_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Error inside the single Record");
    console.log(error);
  }
};
//========================== Update record ====================================//
const updateRecord = async function (id, name) {
  try {
    const form = new FormData();
    form.append("qualification_id", id);
    form.append("name", name);
    form.append("_method", "PUT");
    const res = await fetch("api/qualification.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the update Record section");
    console.log(error);
  }
};
//=======================| Delete  Record |================================//
const deleteRecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This class will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;
    const form = new FormData();
    form.append("qualification_id", id);
    form.append("_method", "DELETE");
    const res = await fetch("api/qualification.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the deleteRecord function");
    console.log(error);
  }
};

//========================| Attach buttons ====================================//
const attachBTN = async function () {
  try {
    // - - - Delete buttons
    document.querySelectorAll(".delete-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        await deleteRecord(id);
      });
    });
    //- - -  UPdate buttons
    document.querySelectorAll(".edit-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        const data = await singleRecord(id);

        document.getElementById("qualificationName").value = data.name;
        isEditing = true;
        modal.querySelector("#addQualificationLabel").textContent =
          "Update Qualifications";
        const form = document.getElementById("addQualificationsForm");
        form.setAttribute("data-id", id);
        new bootstrap.Modal(modal).show();
      });
    });
  } catch (error) {
    showError("Error inside the attach button sections");
    console.log(error);
  }
};

//============================| Event handling |================================//
const form = document.getElementById("addQualificationsForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();
  try {
    const id = form.getAttribute("data-id");
    const name = document.getElementById("qualificationName").value;
    if (isEditing) {
      await updateRecord(id, name);
      isEditing = false;
      modal.querySelector("#addQualificationLabel").textContent =
        "Add New Qualifications";
    } else {
      await createRecord(name);
    }
    form.reset();
    bootstrap.Modal.getInstance(modal).hide();
  } catch (error) {
    showError("Error inside the form section");
    console.log(error);
  }
});
showAllRecords();
//====================Download as pdf file ====================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "qualification_list.pdf",
    title: "Qualification list Report",
  });
});
//==================download as cvs file ==========================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "qualification_list.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "qualification_list.pdf",
        title: "Qualification list Report",
      }),
    () => exportTableToCSV("tableContainer", "qualification_list.csv")
  );
});
//==================== Qualification Search Functionality =================//
document
  .getElementById("searchQualifications")
  .addEventListener("input", function () {
    const query = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll("#qualificationTableBody tr");
    rows.forEach((row) => {
      const cellName = document.querySelector("td:nth-child(2)");
      const cellText = cellName ? cellName.innerText.toLowerCase() : "";
      if (cellText.includes(query)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
