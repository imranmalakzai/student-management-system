let isEditing = false;
let modal = document.getElementById("addTeacherModal");

//=========================| SHOW ALL RECORDS |========================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/teacher.php");
    const data = await res.json();
    const tbody = document.getElementById("teachersTableBody");
    tbody.innerHTML = "";
    data.forEach((teacher) => {
      let row = document.createElement("tr");
      row.innerHTML = `
      <td class="text-center">${teacher.teacher_id}</td>
      <td class="text-center">${teacher.first_name} ${teacher.last_name}</td>
      <td class="text-center">${teacher.date_of_birth}</td>
      <td class="text-center">${teacher.contact_number}</td>
      <td class="text-center">${teacher.email}</td>
      <td class="text-center">${teacher.hire_date}</td>
      <td class="text-center">${teacher.status}</td>
      <td class="text-center">${teacher.gender}</td>
      <td class="text-center">${teacher.qualification}</td>
      <td class="text-center">${teacher.subject}</td>
      <td class="text-center">
        <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${teacher.teacher_id}">
          <i class="fa-solid fa-pen-to-square"></i>
        </button>
        <button class="btn btn-sm btn-danger delete-btn" data-id="${teacher.teacher_id}">
          <i class="fa-solid fa-trash"></i>
        </button>
      </td>
      `;
      tbody.appendChild(row);
    });
    SearchQuery();
    await atachBTN();
  } catch (error) {
    showError("Error inside the show all records funtions");
    console.log(error);
  }
};

//========================== create a new record ===============================//
const createRecord = async function (id) {
  try {
    const teacherForm = document.getElementById("addTeacherForm");
    const form = new FormData(teacherForm);
    form.append("teacher_id", id);
    const res = await fetch("api/teacher.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    alert("Error inside the create record section");
  }
};

//================================= update a record ==============================//
const updateRecord = async function (id) {
  try {
    const teacherForm = document.getElementById("addTeacherForm");
    const form = new FormData(teacherForm);
    form.append("teacher_id", id);
    form.append("_method", "PUT");
    const res = await fetch("api/teacher.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the update record section");
    console.log("Error");
  }
};

const deleteRecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This Teacher will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });
    if (!result.isConfirmed) return;
    const form = new FormData();
    form.append("teacher_id", id);
    form.append("_method", "DELETE");
    const res = await fetch("api/teacher.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the update record sections");
    console.log(error);
  }
};

//================================| Single Record |============================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/teacher.php?teacher_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Error inside the single Record sections");
    console.log(error);
  }
};
//=================================| Attach buttons |==========================//
const atachBTN = async function () {
  try {
    // - - - Delete Sections
    document.querySelectorAll(".delete-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        await deleteRecord(id);
      });
    });

    //- -  Update Sections
    document.querySelectorAll(".edit-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        const data = await singleRecord(id);

        document.getElementById("first_name").value = data.first_name;
        document.getElementById("last_name").value = data.last_name;
        document.getElementById("date_of_birth").value = data.date_of_birth;
        document.getElementById("contact_number").value = data.contact_number;
        document.getElementById("email").value = data.email;
        document.getElementById("hire_date").value = data.hire_date;
        document.getElementById("status").value = data.status;
        document.getElementById("gender_id").value = data.gender_id;
        document.getElementById("qualification_id").value =
          data.qualification_id;
        document.getElementById("subject_id").value = data.subject_id;
        isEditing = true;
        modal.querySelector("#addTeacherModalLabel").textContent =
          "Update Teacher ";
        // modal
        //   .querySelector("button[type='submit']")
        //   .setAttribute("data-id", id);
        const form = document.getElementById("addTeacherForm");
        form.setAttribute("data-id", id);
        new bootstrap.Modal(modal).show();
      });
    });
  } catch (error) {
    showError("Error insidet the attach buttons");
    console.log(error);
  }
};

//=============================| Form Handling |============================//
const form = document.getElementById("addTeacherForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();
  try {
    const id = document
      .getElementById("addTeacherForm")
      .getAttribute("data-id");
    if (isEditing) {
      await updateRecord(id);
      isEditing = false;
      modal.querySelector("#addTeacherModalLabel").textContent =
        " Add New Teacher";
    } else {
      await createRecord(id);
    }
    form.reset();
    bootstrap.Modal.getInstance(modal).hide();
  } catch (error) {
    showError("Error inside the form handling sections");
    console.log(error);
  }
});

//=========================| Load dropdowns |==============================//
const loadGenders = async function () {
  try {
    const res = await fetch("api/gender.php");
    const data = await res.json();
    let select = document.getElementById("gender_id");
    select.innerHTML = "<option value=''>-- Choose Genders --</option>";
    data.forEach((gender) => {
      select.innerHTML += `
      <option value=${gender.gender_id}>${gender.name}</option>
      `;
    });
  } catch (error) {
    showError("Error inside the load Genders");
    console.log(error);
  }
};

const loadSubjects = async function () {
  try {
    const res = await fetch("api/subject.php");
    const data = await res.json();
    let select = document.getElementById("subject_id");
    select.innerHTML = "<option value=''>-- Choose Subject --</option>";
    data.forEach((subject) => {
      select.innerHTML += `
      <option value=${subject.subject_id}>${subject.name}</option>
      `;
    });
  } catch (error) {
    showError("Error inside the load Genders");
    console.log(error);
  }
};

const loadQualification = async function () {
  try {
    const res = await fetch("api/qualification.php");
    const data = await res.json();
    let select = document.getElementById("qualification_id");
    select.innerHTML = "<option value=''>-- Choose Qualifications --</option>";
    data.forEach((qualification) => {
      select.innerHTML += `
      <option value=${qualification.qualification_id}>${qualification.name}</option>
      `;
    });
  } catch (error) {
    showError("Error inside the load Genders");
    console.log(error);
  }
};

//======================  Load all dropdowns ===========================//
const alldropDowns = async function () {
  try {
    await loadGenders();
    await loadQualification();
    await loadSubjects();
  } catch (error) {
    showError("Error inside all Dropdowns");
    console.log(error);
  }
};

showAllRecords();
alldropDowns();

//=================Dowanload as pdf file ==========================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "teacher_list.pdf",
    title: "Techer list Report",
  });
});

//===============Download as cvs file =========================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "teachers_list.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "teachers_list.pdf",
        title: "Teachers list Report",
      }),
    () => exportTableToCSV("tableContainer", "provinces_list.csv")
  );
});

//===================== Search functionality =========================//
document.getElementById("searchTeacher").addEventListener("input", function () {
  const query = this.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#teachersTableBody tr");
  rows.forEach((row) => {
    const cellName = row.querySelector("td:nth-child(2)");
    const cellText = cellName ? cellName.innerText.toLowerCase() : "";
    if (cellText.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});

//=================== Search query ========================//
const SearchQuery = function () {
  try {
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    if (id) {
      const rows = document.querySelectorAll("#teachersTableBody tr");
      rows.forEach((row) => {
        const cell = row.querySelector("td:nth-child(1)");
        const text = cell ? cell.innerText : "";
        if (text === id) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    }
  } catch (error) {
    console.log(error);
  }
};
