let isEditing = false;
let modal = document.getElementById("addFeeModal");

//===================== Show All Records ===========================//
const showAllRecords = async function () {
  try {
    const res = await fetch("api/fees.php");
    const data = await res.json();

    const tbody = document.getElementById("feesTablebody");
    tbody.innerHTML = "";
    data.forEach((fee) => {
      let tr = document.createElement("tr");
      tr.innerHTML = `
      <td>${fee.fee_id}</td>
      <td>${fee.student_first_name} "${fee.student_last_name}"</td>
      <td>${fee.class_name}</td>
      <td>${fee.total_amount}</td>
      <td>${fee.amount_paid}</td>
      <td>${fee.due_amount}</td>
      <td>${fee.payment_status}</td>
      <td>${fee.last_payment_date}</td>
      <td class="text-center">
       <button class="btn btn-sm btn-warning me-2 edit-btn" data-id="${fee.fee_id}">
              <i class="fa-solid fa-pen-to-square"></i>
      </button>
      <button class="btn btn-sm btn-danger delete-btn" data-id="${fee.fee_id}">
              <i class="fa-solid fa-trash"></i>
      </button>
      </td>        
      `;
      tbody.appendChild(tr);
    });
    await attachButtons();
  } catch (error) {
    showError("Unable to show All Records");
    console.log(error);
  }
};

//============================ Create New Record =============================//
const createNewRecord = async function () {
  try {
    const records = document.getElementById("addFeeForm");
    const form = new FormData(records);
    const res = await fetch("api/fees.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Unable to create New Record");
    console.log(error);
  }
};

//============================= UPDate A Record ===========================//
const updateRecord = async function (id) {
  try {
    const records = document.getElementById("addFeeForm");
    const form = new FormData(records);
    form.append("_method", "PUT");
    form.append("fee_id", id);
    const res = await fetch("api/fees.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    showSuccess(data.message);
    await showAllRecords();
  } catch (error) {
    showError("Error inside the update Record sections");
    console.log(error);
  }
};

//================================== GeT a single Record ============================//
const singleRecord = async function (id) {
  try {
    const res = await fetch(`api/fees.php?fee_id=${id}`);
    const data = await res.json();
    return data;
  } catch (error) {
    showError("unable to load single Record");
    console.log(error);
  }
};
//============================== Delete A Record ==============================//
const deleteRecord = async function (id) {
  try {
    const result = await showConfirmDialog({
      title: "Delete Record?",
      text: "This class will be permanently removed!",
      confirmButtonText: "Yes, delete it!",
    });

    if (!result.isConfirmed) return;

    const form = new FormData();
    form.append("fee_id", id);
    form.append("_method", "DELETE");

    const res = await fetch("api/fees.php", {
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
//=============================== Attach buttons ==============================//
const attachButtons = async function () {
  try {
    // Delete buttons
    document.querySelectorAll(".delete-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        await deleteRecord(id);
      });
    });
    //Edite Records
    document.querySelectorAll(".edit-btn").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        const data = await singleRecord(id);
        console.log(data);
        isEditing = true;
        document.getElementById("class_id").value = data.class_id;
        document.getElementById("total_amount").value = data.total_amount;
        document.getElementById("amount_paid").value = data.amount_paid;
        document.getElementById("student_id").removeAttribute("disabled");
        await loadSudents(data.class_id);
        document.getElementById("student_id").value = data.student_id;
        document.getElementById("last_payment_date").value =
          data.last_payment_date;
        document.getElementById("notes").value = data.notes;
        document.getElementById("feesLableText").innerText =
          "update Fess Record";
        new bootstrap.Modal(modal).show();
        document.getElementById("addFeeForm").setAttribute("date-id", id);
      });
    });
  } catch (error) {
    showError("unable to attach buttons");
    console.log(error);
  }
};

//============================= From Handling Sections =========================//
const form = document.getElementById("addFeeForm");
form.addEventListener("submit", async function (e) {
  e.preventDefault();
  try {
    const id = document.getElementById("addFeeForm").getAttribute("date-id");
    if (isEditing) {
      await updateRecord(id);
      document.getElementById("feesLableText").innerText = "Add Fess Record";
      isEditing = false;
    } else {
      await createNewRecord();
    }
    form.reset();
    bootstrap.Modal.getInstance(modal).hide();
  } catch (error) {
    showError("Error in form submission sections");
    console.log(error);
  }
});

//======================= Load students pages on class ==========================//
const loadSudents = async function (class_id) {
  try {
    const form = new FormData();
    form.append("_method", "CLASS_STUDENTS");
    form.append("class_id", class_id);
    const res = await fetch("api/student.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    let select = document.getElementById("student_id");
    select.innerHTML = `<option value=''> -- Choose student -- </option>`;
    data.forEach((row) => {
      select.innerHTML += `<option value="${row.student_id}">${row.first_name} ${row.last_name}</option>`;
    });
  } catch (error) {
    showAllRecords("unable to load the students");
    console.log(error);
  }
};
// ======================= Load classes ==============================//
const loadClasses = async function () {
  try {
    const res = await fetch("api/class.php");
    const data = await res.json();
    let select = document.getElementById("class_id");
    select.innerHTML = "<option value=''>-- Choose Class --</option>";
    data.forEach((row) => {
      select.innerHTML += `
      <option value=${row.class_id}>${row.class_name}</option>
      `;
    });
    select.addEventListener("change", async function () {
      const class_id = this.value;
      document.getElementById("student_id").removeAttribute("disabled");
      await loadSudents(class_id);
    });
  } catch (error) {
    showError("Error inside the load classes ");
    console.log(error);
  }
};
loadClasses();
showAllRecords();
