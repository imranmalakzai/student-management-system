let isEditing = false;
let modal = document.getElementById("addStudentModal");

//============================== Show All Records =============================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/student.php");
    const data = await res.json();

    let tbody = document.getElementById("studentTableBody");
    tbody.innerHTML = "";
    data.forEach((student) => {
      let tr = document.createElement("tr");
      tr.innerHTML = `
        <td class="text-center">${student.student_id}</td>
        <td class="text-center">${student.first_name} ${student.last_name}</td>
        <td class="text-center">${student.father_name}</td>
        <td class="text-center">${student.gender}</td>
        <td class="text-center">${student.class_name}</td>
        <td class="text-center">${student.enrollment_date}</td>
        <td class="text-center">${student.province || "N/A"}</td>
        <td class="text-center">${student.district || "N/A"}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${
            student.student_id
          }">
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="btn btn-sm btn-danger delete-btn" data-id="${
            student.student_id
          }">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      `;
      tbody.appendChild(tr);
    });
    SearchQuery();
    await attchBTN();
  } catch (error) {
    showError("Unable to load the records");
    console.log(error);
  }
};

//========================= Delete A Record =========================//
const deleteRecord = async function (studentId) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This student will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });
    if (!result.isConfirmed) return;

    const form = new FormData();
    form.append("_method", "DELETE");
    form.append("student_id", studentId);

    const res = await fetch("api/student.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Unable to delete This Record");
    console.log(error);
  }
};

//========================= Update Record =========================//
const updateRecord = async function (studentId) {
  console.log(studentId);
  try {
    const form = new FormData(document.getElementById("addStudentForm"));
    form.append("_method", "PUT");
    form.append("student_id", studentId);

    const res = await fetch("api/student.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Unable to update This Record");
    console.log(error);
  }
};

//========================== Create Record =========================//
const createRecord = async function () {
  try {
    const form = new FormData(document.getElementById("addStudentForm"));
    const res = await fetch("api/student.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error creating record");
    console.log(error);
  }
};

//========================== Get single Record ==========================//
const singleRecord = async function (studentId) {
  try {
    const res = await fetch(`api/student.php?id=${studentId}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("Unable to fetch This Record");
    console.log(error);
  }
};

//========================== Attach buttons ================================//
const attchBTN = async function () {
  try {
    document.querySelectorAll(".delete-btn").forEach((btn) => {
      btn.addEventListener("click", async function () {
        const id = btn.getAttribute("data-id");
        await deleteRecord(id);
      });
    });

    document.querySelectorAll(".edit-btn").forEach((btn) => {
      btn.addEventListener("click", async function () {
        const id = btn.getAttribute("data-id");
        let data = await singleRecord(id);
        document.getElementById("first_name").value = data.first_name;
        document.getElementById("last_name").value = data.last_name;
        document.getElementById("father_name").value = data.father_name;
        document.getElementById("gender_id").value = data.gender_id;
        document.getElementById("class_id").value = data.class_id;
        document.getElementById("province_id").value = data.province_id;

        // ✅ Load districts based on selected province
        await loadDistrictsByProvince(data.province_id, data.district_id);

        document.getElementById("date_of_birth").value = data.date_of_birth;

        isEditing = true;
        modal.querySelector("#addStudentModalLabel").textContent =
          "Update Student";
        document.getElementById("addStudentForm").setAttribute("data-id", id);
        new bootstrap.Modal(modal).show();
      });
    });
  } catch (error) {
    showError("Unable to add the delete and update buttons");
    console.log(error);
  }
};

//====================== Form submit =============================//
const form = document.getElementById("addStudentForm");
form.addEventListener("submit", async (e) => {
  e.preventDefault();
  try {
    const id = form.getAttribute("data-id");
    if (isEditing) {
      await updateRecord(id);
      modal.querySelector("#addStudentModalLabel").textContent =
        "Add New Student";
      isEditing = false;
    } else {
      await createRecord();
    }
    form.reset();
    bootstrap.Modal.getInstance(modal).hide();
  } catch (error) {
    showError("Error inside the form submit section");
    console.log(error);
  }
});

//===========================| Load Genders |==============================//
const loadGenders = async function () {
  try {
    const res = await fetch("api/gender.php");
    const data = await res.json();
    let select = document.getElementById("gender_id");
    select.innerHTML = "<option value=''>-- Choose Gender --</option>";
    data.forEach((record) => {
      select.innerHTML += `<option value='${record.gender_id}'>${record.name}</option>`;
    });
  } catch (error) {
    showError("Error inside the load Genders function");
    console.log(error);
  }
};

//===========================| Load Classes |==============================//
const loadClasses = async function () {
  try {
    const res = await fetch("api/class.php");
    const data = await res.json();
    let select = document.getElementById("class_id");
    select.innerHTML = "<option value=''>-- Choose Class --</option>";
    data.forEach((record) => {
      select.innerHTML += `<option value='${record.class_id}'>${record.class_name}</option>`;
    });
  } catch (error) {
    showError("Error inside the load class section");
    console.log(error);
  }
};

//===========================| Load province and districts |======================//
const loadProvinceAndDistricts = async function () {
  try {
    const res = await fetch("api/province.php");
    const data = await res.json();
    let provinceSelect = document.getElementById("province_id");
    provinceSelect.innerHTML =
      "<option value=''>-- Choose Province --</option>";

    data.forEach((record) => {
      provinceSelect.innerHTML += `<option value='${record.province_id}'>${record.name}</option>`;
    });

    // ✅ Change listener
    provinceSelect.addEventListener("change", async (e) => {
      await loadDistrictsByProvince(e.target.value);
    });
  } catch (error) {
    showError("Error inside the load province and districts");
    console.log(error);
  }
};

//===========================| Load districts by province helper |======================//
const loadDistrictsByProvince = async function (
  provinceId,
  selectedDistrict = null
) {
  try {
    const districtSelect = document.getElementById("district_id");
    districtSelect.innerHTML =
      "<option value=''>-- Choose District --</option>";

    if (!provinceId) return;

    const form = new FormData();
    form.append("_method", "DISTRICT_BY_PROVINCE");
    form.append("province_id", provinceId);

    const res = await fetch("api/student.php", {
      method: "POST",
      body: form,
    });
    const districts = await res.json();

    districts.forEach((record) => {
      districtSelect.innerHTML += `<option value='${record.district_id}'>${record.name}</option>`;
    });

    if (selectedDistrict) districtSelect.value = selectedDistrict;
  } catch (error) {
    console.log(error);
  }
};

//===========================| Initial load |======================//
loadProvinceAndDistricts();
loadClasses();
loadGenders();
showAllRecords();

//================= Download as pdf file ====================//
document.getElementById("pdf").addEventListener("click", () => {
  downloadTableAsPDF({
    elementId: "tableContainer",
    fileName: "student_list.pdf",
    title: "Student list Report",
  });
});

//================== Download as CVS file ==========================//
document.getElementById("cvs").addEventListener("click", () => {
  exportTableToCSV("tableContainer", "student_list.csv");
});

//==================== Download selector modal ===================//
document.getElementById("download").addEventListener("click", () => {
  setupDownloadSelector(
    "download",
    () =>
      downloadTableAsPDF({
        elementId: "tableContainer",
        fileName: "Student_list.pdf",
        title: "Student list Report",
      }),
    () => exportTableToCSV("tableContainer", "student_list.csv")
  );
});
//=================== Search Functionality ========================//
document.getElementById("studentSearch").addEventListener("input", function () {
  const query = this.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#studentTableBody tr");
  rows.forEach((row) => {
    const cell = row.querySelector("td:nth-child(2)");
    const text = cell ? cell.innerText.toLowerCase() : "";
    if (text.includes(query)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
});

const SearchQuery = function () {
  try {
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    if (id) {
      const rows = document.querySelectorAll("#studentTableBody tr");
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
