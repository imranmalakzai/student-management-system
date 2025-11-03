let isEditing = false;
let modal = document.getElementById("addClassModal");

//=================== Show All Records ===================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/class.php");
    const data = await res.json();
    const tbody = document.getElementById("tablebody");
    tbody.innerHTML = "";

    data.forEach((c) => {
      let row = document.createElement("tr");
      row.innerHTML = `
        <th scope="row">${c.class_id}</th>
        <td>${c.class_name}</td>
        <td>${c.teacher_name || "—"}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${
            c.class_id
          }">
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="btn btn-sm btn-danger delete-btn" data-id="${
            c.class_id
          }">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      `;
      tbody.appendChild(row);
    });

    attachBTN();
  } catch (error) {
    showError("Error inside the show all records section");
    console.log(error);
  }
};

//====================== Get Single Record ===================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/class.php?class_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Error inside the single record section");
    console.log(error);
  }
};

//====================== Delete Record ====================//
const deleteRecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This class will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;

    const form = new FormData();
    form.append("class_id", id);
    form.append("_method", "DELETE");

    const res = await fetch("api/class.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the delete record section");
    console.log(error);
  }
};

//==================== Create Record =========================//
const createRecord = async function () {
  try {
    const form = new FormData(document.getElementById("addClassForm"));
    const res = await fetch("api/class.php", {
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

//===================== Update Record =========================//
const updateRecord = async function (id) {
  try {
    const form = new FormData(document.getElementById("addClassForm"));
    form.append("_method", "PUT");
    form.append("class_id", id);

    const res = await fetch("api/class.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the update record section");
    console.log(error);
  }
};

//==================== Attach Buttons ========================//
const attachBTN = function () {
  document.querySelectorAll(".delete-btn").forEach((button) => {
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      await deleteRecord(id);
    });
  });

  document.querySelectorAll(".edit-btn").forEach((button) => {
    button.addEventListener("click", async () => {
      const id = button.getAttribute("data-id");
      const data = await singleRecord(id);
      isEditing = true;

      document.querySelector("#addClassModalLabel").textContent =
        "Update Class";
      document.getElementById("name").value = data.class_name;
      document.getElementById("teacher_id").value = data.teacher_id;
      document.getElementById("addClassForm").setAttribute("data-id", id);

      new bootstrap.Modal(modal).show();
    });
  });
};

//================== Form Submit Handling ===================//
const form = document.getElementById("addClassForm");
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  try {
    const id = form.getAttribute("data-id");
    if (isEditing) {
      await updateRecord(id);
      isEditing = false;
      document.querySelector("#addClassModalLabel").textContent =
        "Add New Class";
      form.removeAttribute("data-id");
    } else {
      await createRecord();
    }

    form.reset();
    const modalInstance = bootstrap.Modal.getInstance(modal);
    modalInstance.hide();
  } catch (error) {
    showError("Error inside the form handling section");
    console.log(error);
  }
});

const loadDropDown = async function () {
  try {
    const res = await fetch("api/teacher.php");
    const data = await res.json();
    let select = document.getElementById("teacher_id");
    select.innerHTML = "<option value=''>-- Choose teacher --</option>";
    data.forEach((teacher) => {
      select.innerHTML += `
      <option value=${teacher.teacher_id}>${teacher.first_name} ${teacher.last_name}</option>
      `;
    });
  } catch (error) {
    showError("Error inside the dropdown");
    console.log(error);
  }
};

loadDropDown();
showAllRecords();

//================Downlod as a pdf ile ==================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "class_list.pdf",
    title: "Class list Report",
  });
});
//================Downlod as a csv file ==================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "class_lists.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "class_list.pdf",
        title: "class list Report",
      }),
    () => exportTableToCSV("tableContainer", "class_list.csv")
  );
});

//====================== Search functinality ============================//
document.getElementById("searchClass").addEventListener("input", (e) => {
  const query = e.target.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#tablebody tr");
  rows.forEach((row) => {
    const cellName = row.querySelector("td:nth-child(2)");
    const value = cellName ? cellName.innerText.toLowerCase() : "";
    if (value.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});
