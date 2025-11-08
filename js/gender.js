let isEditing = false;
let modal = document.getElementById("addGenderModal");

//=======================| show all records |=======================//
const showAllrecords = async function () {
  try {
    const res = await fetch("api/gender.php");
    const data = await res.json();
    const tbody = document.getElementById("gendersTableBody");
    tbody.innerHTML = "";
    data.forEach((gender) => {
      let row = document.createElement("tr");
      row.innerHTML = `
        <th>${gender.gender_id}</th>
        <td>${gender.name}</td>
        <td class="text-center">
            <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${gender.gender_id}">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button class="btn btn-sm btn-danger delete-btn" data-id="${gender.gender_id}">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>`;
      tbody.appendChild(row);
    });
    attachBTN();
  } catch (error) {
    showError("Error insile show records");
    console.log(error);
  }
};

showAllrecords();
//===========================| Update A record |============================//
const updateRecord = async function (id, name) {
  try {
    const form = new FormData();
    form.append("_method", "PUT");
    form.append("gender_id", id);
    form.append("name", name);
    const res = await fetch("api/gender.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllrecords();
  } catch (error) {
    showError("Error in updateRecord sections");
  }
};
//========================| Get a single records |===============================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/gender.php?gender_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Error inside the single Records");
    console.log(error);
  }
};
//=============================| Delete A record |===================================//
const deleteRecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This gender will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;
    const form = new FormData();
    form.append("_method", "DELETE");
    form.append("gender_id", id);
    const res = await fetch("api/gender.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllrecords();
  } catch (error) {
    showError("Error inside the deleteRecord function");
    console.log(error);
  }
};

//==========================| create a new record |===================================//
const createRecord = async function (name) {
  try {
    const form = new FormData();
    form.append("name", name);
    const res = await fetch("api/gender.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllrecords();
  } catch (error) {
    showError("Error inside the create record function");
    console.log(error);
  }
};
//========================| Attach delete and update buttons |=====================//
const attachBTN = async function () {
  try {
    //--delete button
    document.querySelectorAll(".delete-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        await deleteRecord(id);
      });
    });
    //-- Edit sections
    document.querySelectorAll(".edit-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        const data = await singleRecord(id);
        document.getElementById("genderName").value = data.name;
        isEditing = true;
        modal.querySelector("#addGenderModalLabel").textContent =
          "Update gender ";
        // modal
        //   .querySelector("button type=['submit']")
        //   .setAttribute("data-id", id);
        const form = document.getElementById("addGenderForm");
        form.setAttribute("data-id", id);
        new bootstrap.Modal(modal).show();
      });
    });
  } catch (error) {
    showError("Error inside the attach buttons");
    console.log(error);
  }
};

//========================| Add Event lessonder to the form ===============================//
const form = document.getElementById("addGenderForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();
  try {
    const id = form.getAttribute("data-id");
    const name = document.getElementById("genderName").value;
    if (isEditing) {
      await updateRecord(id, name);
      isEditing = false;
      modal.querySelector("#addGenderModalLabel").textContent =
        "Add New Record";
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

//====================Download as pdf file ====================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "gender_list.pdf",
    title: "Gender list Report",
  });
});

//===================Download as CVS file ===================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "genders_list.csv");
});
//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "gender_list.pdf",
        title: "Gender list Report",
      }),
    () => exportTableToCSV("tableContainer", "gender_list.csv")
  );
});

//========================= Search functionality ========================//
document.getElementById("searchGenders").addEventListener("input", function () {
  const query = this.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#gendersTableBody tr");
  rows.forEach((row) => {
    const cell = row.querySelector("td:nth-child(2)");
    const rowText = cell ? cell.innerText.toLowerCase() : "";
    if (rowText.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});
