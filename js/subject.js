let modal = document.getElementById("addSubjectModal");
let isEditing = false;

//=============================| Show All Records |==============================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/subject.php");
    const data = await res.json();
    const tbody = document.getElementById("subjectTableBody");
    tbody.innerHTML = "";
    data.forEach((subject) => {
      let row = document.createElement("tr");
      row.innerHTML = `
      <th scope="row">${subject.subject_id}</th>
       <td>${subject.name}</td>
       <td class="text-center">
         <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${subject.subject_id}">
           <i class="fa-solid fa-pen-to-square"></i>
         </button>
         <button class="btn btn-sm btn-danger delete-btn" data-id="${subject.subject_id}">
           <i class="fa-solid fa-trash"></i>
         </button>
       </td>
     `;
      tbody.appendChild(row);
    });
    attachBTN();
  } catch (error) {
    showError("Error in showing all subjects");
    console.log(error);
  }
};
showAllRecords();

//===========================| Add a new record |================================//
const addNewRecord = async function (name) {
  try {
    const form = new FormData();
    form.append("name", name);
    const res = await fetch("api/subject.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside Add New Record function");
    console.log(error);
  }
};

//========================| GET A SINGLE RECORD |================================//
const getSingleRecord = async function (id) {
  try {
    const res = await fetch(`api/subject.php?subject_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Error inside the getSingleRecord function");
    console.log(error);
  }
};

//======================| Delete a Record |=====================================//
const deleteRecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This subject will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;
    const form = new FormData();
    form.append("_method", "DELETE");
    form.append("subject_id", id);
    const res = await fetch("api/subject.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the delete record function");
    console.log(error);
  }
};

//====================| Update a Record based on Id |============================//
const updateRecord = async function (id, name) {
  try {
    const form = new FormData();
    form.append("_method", "PUT");
    form.append("subject_id", id);
    form.append("name", name);
    const res = await fetch("api/subject.php", {
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

//==============================| Attach update and Delete buttons |==========================//
const attachBTN = async function () {
  try {
    //--Delete button
    document.querySelectorAll(".delete-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        await deleteRecord(id);
      });
    });

    //--Update button
    document.querySelectorAll(".edit-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        const data = await getSingleRecord(id);
        document.getElementById("subjectName").value = data.name;
        isEditing = true;
        modal.querySelector("#addSubjectLabel").textContent = "Update Subject";
        // modal
        //   .querySelector("button[type='submit']")
        //   .setAttribute("data-id", id);
        const form = document.getElementById("addSubjectForm");
        form.setAttribute("data-id", id);
        new bootstrap.Modal(modal).show();
      });
    });
  } catch (error) {
    showError("Error inside the attachBTN function");
    console.log(error);
  }
};

//======================| Form Handling |================================//
const form = document.getElementById("addSubjectForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();
  try {
    const name = document.getElementById("subjectName").value.trim();
    if (!name) {
      showError("Please enter subject name");
      return;
    }

    if (isEditing) {
      const id = form.getAttribute("data-id");
      await updateRecord(id, name);
      isEditing = false;
      modal.querySelector("#addSubjectLabel").textContent = "Add New Subject";
    } else {
      await addNewRecord(name);
    }

    form.reset();
    bootstrap.Modal.getInstance(modal).hide();
  } catch (error) {
    showError("Error on form handling section");
    console.log(error);
  }
});

//==================== Download as PDF file ======================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "subject_list.pdf",
    title: "Subject list Report",
  });
});

//==================== Download as CSV file ======================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "subject_list.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "subject_list.pdf",
        title: "Subject list Report",
      }),
    () => exportTableToCSV("tableContainer", "subject_list.csv")
  );
});

//====================== Search funtionality =======================//
document.getElementById("searchSubject").addEventListener("input", function () {
  const searchValue = this.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#subjectTableBody tr");

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
