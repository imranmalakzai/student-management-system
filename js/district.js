let isEditing = false;
let modal = document.getElementById("addDistrictModal");

//============================| SHOW ALL RECORDS |============================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/district.php");
    const data = await res.json();
    let tbody = document.getElementById("districtsTableBody");
    tbody.innerHTML = "";
    data.forEach((district) => {
      let row = document.createElement("tr");
      row.innerHTML = `   
        <th>${district.district_id}</th>
        <td>${district.name}</td>
        <td>${district.province_name || "N/A"}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-warning me-2 shadow-sm edit-btn" data-id="${
            district.district_id
          }">
              <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="btn btn-sm btn-danger shadow-sm delete-btn" data-id="${
            district.district_id
          }">
              <i class="fa-solid fa-trash"></i>
          </button>
        </td>`;
      tbody.appendChild(row);
    });
    attachBtn();
  } catch (error) {
    showErro("Error on console");
    console.log(error);
  }
};
showAllRecords();

//====================| Attach Delete and Update Buttons |====================//
const attachBtn = async function () {
  // --- Delete Button
  document.querySelectorAll(".delete-btn").forEach((button) => {
    button.addEventListener("click", async function () {
      const id = button.getAttribute("data-id");
      await deleteRecord(id);
    });
  });

  // --- Edit Button
  document.querySelectorAll(".edit-btn").forEach((button) => {
    button.addEventListener("click", async function () {
      try {
        const id = button.getAttribute("data-id");
        const data = await singleRecord(id);
        isEditing = true;

        document.getElementById("name").value = data.name;
        document.getElementById("provinceName").value = data.province_id;

        modal.querySelector("#addDistrictModalLabel").textContent =
          "Update District";
        modal
          .querySelector("button[type='submit']")
          .setAttribute("data-id", id);

        const form = document.getElementById("addDistrictForm");
        form.setAttribute("data-id", id);

        new bootstrap.Modal(modal).show();
      } catch (error) {
        showError("Error inside the form sections");
        console.log(error);
      }
    });
  });
};

//==============================| DELETE A RECORD |===========================//
const deleteRecord = async function (district_id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This district will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;
    const form = new FormData();
    form.append("_method", "DELETE");
    form.append("district_id", district_id);
    const res = await fetch("api/district.php", {
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

//==============================| UPDATE A RECORD |===========================//
const updateRecord = async function (district_id, district_name, province_id) {
  try {
    const form = new FormData();
    form.append("_method", "PUT");
    form.append("district_id", district_id);
    form.append("province_id", province_id);
    form.append("name", district_name);

    const res = await fetch("api/district.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);

    bootstrap.Modal.getInstance(modal).hide();
    await showAllRecords();
  } catch (error) {
    showError("Unable to update this record");
    console.log(error);
  }
};

//=============================| GET A SINGLE RECORD |=======================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/district.php?district_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Error inside the single Record sections");
    console.log(error);
  }
};

//=============================| FORM SUBMIT HANDLER |========================//
const form = document.getElementById("addDistrictForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();

  const district_name = document.getElementById("name").value.trim();
  const province_id = document.getElementById("provinceName").value;

  if (!district_name || !province_id) {
    alert("Please fill in all fields");
    return;
  }

  if (isEditing) {
    const district_id = form.getAttribute("data-id");
    await updateRecord(district_id, district_name, province_id);
    isEditing = false;
    modal.querySelector("#addDistrictModalLabel").textContent =
      "Add New District";
  } else {
    await addNewRecord(district_name, province_id);
  }

  form.reset();
  modal.querySelector("#addDistrictModalLabel").textContent = "Add District";
});

//===============================| ADD NEW RECORD |==========================//
const addNewRecord = async function (district_name, province_id) {
  try {
    const formData = new FormData();
    formData.append("name", district_name);
    formData.append("province_id", province_id);

    const res = await fetch("api/district.php", {
      method: "POST",
      body: formData,
    });
    const data = await res.json();
    showSuccess(data.message);
    bootstrap.Modal.getInstance(modal).hide();
    await showAllRecords();
  } catch (error) {
    showError("Error in Add Record section");
    console.log(error);
  }
};

//=========================| SHOW DROP DOWN |===========================//
const loadDropDown = async function () {
  try {
    const res = await fetch("api/province.php");
    const data = await res.json();

    let select = document.getElementById("provinceName");
    select.innerHTML = "<option value=''>-- Choose Province --</option>";
    data.forEach((prov) => {
      select.innerHTML += `
        <option value="${prov.province_id}">${prov.name}</option>
      `;
    });
  } catch (error) {
    showError("Error to load the dropdown");
    console.log(error);
  }
};

//=========================| INITIALIZE PAGE |===========================//
document.addEventListener("DOMContentLoaded", function () {
  showAllRecords();
  loadDropDown();
});

//========================| Reset the form if click x |=====================//
modal.addEventListener("hidden.bs.modal", () => {
  document.getElementById("addDistrictForm").reset(); // Clear form
  modal.querySelector("#addDistrictModalLabel").textContent =
    "Add New Province"; // Reset title
  modal.querySelector("form button[type='submit']").removeAttribute("data-id"); // Clear ID
  isEditing = false; // Reset editing state
});

//================Downlod as a pdf file ==================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "District_list.pdf",
    title: "District list Report",
  });
});
//================= Download as CVS file =======================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "district_list.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "District_list.pdf",
        title: "District list Report",
      }),
    () => exportTableToCSV("tableContainer", "districts_list.csv")
  );
});

//===================== Search funtionality =====================//
document
  .getElementById("searchDistricts")
  .addEventListener("input", function () {
    const searchValue = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll("#districtsTableBody tr");

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
