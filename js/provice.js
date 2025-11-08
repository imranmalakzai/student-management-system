let isEditing = false;
let modal = document.getElementById("addProvinceModal");

//===================================| SHOW ALL RECORDS |=====================================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/province.php");
    const data = await res.json();
    let tbody = document.getElementById("provinceTableBody");
    tbody.innerHTML = "";
    data.forEach((prov) => {
      let row = document.createElement("tr");
      row.innerHTML = `
        <th class="text-center">${prov.province_id}</th>
        <td class="text-center">${prov.name}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${prov.province_id}">
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="btn btn-sm btn-danger delete-btn" data-id="${prov.province_id}">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      `;
      tbody.appendChild(row);
    });

    await attachBTN();
  } catch (error) {
    showError("Unable to load the provinces");
    console.log(error);
  }
};

//===============================| POST A NEW RECORD |======================================//
const addNewProvince = async function () {
  try {
    const form = new FormData(document.getElementById("addProvinceForm"));
    const res = await fetch("api/province.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Unable to add a new record");
    console.log(error);
  }
};

//===================================| UPDATE A RECORD  |======================================//
const updateNewProvince = async function (id) {
  try {
    const form = new FormData(document.getElementById("addProvinceForm"));
    form.append("_method", "PUT");
    form.append("province_id", id);
    const res = await fetch("api/province.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Unable to update province record");
    console.log(error);
  }
};

//==================================| DELETE A RECORD |=======================================//
const deleteARecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This province will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;

    const form = new FormData();
    form.append("_method", "DELETE");
    form.append("province_id", id);

    const res = await fetch("api/province.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Unable to delete this record");
    console.log(error);
  }
};

//==================================| GET SINGLE RECORD BY ID |===============================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/province.php?province_id=${id}`);
    const data = await res.json();
    if (!data || !data.name) {
      throw new Error("Invalid or empty record");
    }
    return data;
  } catch (error) {
    showError("Unable to get a single record");
    console.log(error);
    return null;
  }
};

//==================================| ATTACH BTN |=======================================//
async function attachBTN() {
  document.querySelectorAll(".delete-btn").forEach((btn) => {
    btn.addEventListener("click", async () => {
      const id = btn.getAttribute("data-id");
      await deleteARecord(id);
    });
  });

  document.querySelectorAll(".edit-btn").forEach((btn) => {
    btn.addEventListener("click", async () => {
      const id = btn.getAttribute("data-id");
      const data = await singleRecord(id);
      if (data) {
        document.getElementById("name").value = data.name;
        isEditing = true;
        document.querySelector("#addProvinceModalLabel").textContent =
          "Update Province Record";
        document.getElementById("addProvinceForm").setAttribute("data-id", id);
        new bootstrap.Modal(modal).show();
      }
    });
  });
}

//=============================Handle Form submission ================================//
const form = document.getElementById("addProvinceForm");
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  try {
    const id = form.getAttribute("data-id");
    if (isEditing) {
      await updateNewProvince(id);
    } else {
      await addNewProvince();
    }
    form.reset();
    document.querySelector("#addProvinceModalLabel").textContent =
      "Add New Province";
    isEditing = false;
    const modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
  } catch (error) {
    showError("Unable to handle the form submission");
    console.log(error);
  }
});

//============= Reset form and state when modal is closed (via X or Cancel button) =========//
modal.addEventListener("hidden.bs.modal", () => {
  document.getElementById("addProvinceForm").reset();
  modal.querySelector("#addProvinceModalLabel").textContent =
    "Add New Province";
  isEditing = false;
});

showAllRecords();
//=============================| Export to PDF |==================================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "province_list.pdf",
    title: "province list Report",
  });
});
//=============================| Export to CVS |==================================//

document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "province_records.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "province_list.pdf",
        title: "province list Report",
      }),
    () => exportTableToCSV("tableContainer", "province_list.csv")
  );
});

//===================================| SEARCH FUNCTIONALITY |=====================================//
document
  .getElementById("searchProvince")
  .addEventListener("input", function () {
    const searchValue = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll("#provinceTableBody tr");

    rows.forEach((row) => {
      const nameCell = row.querySelector("td:nth-child(2)");
      const name = nameCell ? nameCell.textContent.toLowerCase() : "";
      if (name.includes(searchValue)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
