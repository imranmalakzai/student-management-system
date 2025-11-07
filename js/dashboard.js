//================== Show students Counts =================//
const showStudentCount = async function () {
  try {
    const form = new FormData();
    form.append("_method", "COUNT_STUDENTS");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    document.getElementById("showStudentCounts").innerText = data.total || 0;
  } catch (error) {
    console.log(error);
  }
};
//=================== Show Teachers Counts =======================//
const showTeachersCount = async function () {
  try {
    const form = new FormData();
    form.append("_method", "COUNT_TEACHERS");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    document.getElementById("showTeachersCounts").innerText = data.total || 0;
  } catch (error) {
    console.log(error);
  }
};
//======================== Show paid fees =============================//
const showPaidFees = async function () {
  try {
    const form = new FormData();
    form.append("_method", "FEES_PAID");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    const result = Math.round(data);
    document.getElementById("feesPaid").innerText = `${result}%`;
  } catch (error) {
    console.log(error);
  }
};
//======================== Show Classes =============================//
const showClasses = async function () {
  try {
    const form = new FormData();
    form.append("_method", "COUNT_CLASSES");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    document.getElementById("classes").innerText = data.total || 0;
  } catch (error) {
    console.log(error);
  }
};

//============================ Show Resent students ============================//
const resentStudents = async function () {
  try {
    const form = new FormData();
    form.append("_method", "RESENT_STUDENTS");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    const tbody = document.getElementById("studentTableBody");
    data.forEach((row) => {
      let tr = document.createElement("tr");
      tr.innerHTML += `
        <td>STU-${row.student_id}</td>
        <td>${row.first_name} ${row.last_name}</td>
        <td>${row.class_name}</td>
        <td><button class="btn btn-sm btn-outline-primary std-view" data-id=${row.student_id}><i class="fa-solid fa-eye"></i><span data-translate="view"> View </span></button></td>
      `;
      tbody.appendChild(tr);
    });

    document.querySelectorAll(".std-view").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        window.location.href = `students.php?id=${id}`;
      });
    });
  } catch (error) {
    console.log(error);
  }
};

//============================ Resent Teachers ============================//
const resentTeachers = async function () {
  try {
    const form = new FormData();
    form.append("_method", "RESENT_TEACHERS");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    const tbody = document.getElementById("teachersTableBody");
    data.forEach((row) => {
      const tr = document.createElement("tr");
      tr.innerHTML += `
        <td>TEA-${row.teacher_id}</td>
        <td>${row.first_name} ${row.last_name}</td>
        <td>${row.subject}</td>
        <td><button data-id=${row.teacher_id} class="btn btn-sm btn-outline-primary tech-view"><i class="fa-solid fa-eye"></i><span data-translate="view"> View </span></button></td>
      `;
      tbody.appendChild(tr);
    });
    document.querySelectorAll(".tech-view").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        window.location.href = `teachers.php?id=${id}`;
      });
    });
  } catch (error) {
    console.log(error);
  }
};

//====================== Resent paid fees ============================//
const resentFeesPaid = async function () {
  try {
    const form = new FormData();
    form.append("_method", "RESENT_FEES");
    const res = await fetch("api/dashboard.php", {
      method: "POST",
      body: form,
    });
    const data = await res.json();
    const tbody = document.getElementById("fees");
    data.forEach((row) => {
      let tr = document.createElement("tr");
      tr.innerHTML += `
        <td>STU-${row.student_id}</td>
        <td>${row.first_name} ${row.last_name}</td>
        <td>$${row.amount_paid}</td>
        <td>${row.last_payment_date}</td>
        <td><button data-id=${row.fee_id} class="btn btn-sm btn-outline-primary fee-view"><i class="fa-solid fa-eye"></i><span data-translate="view"> View </span></button></td>
      `;
      tbody.append(tr);
    });
    document.querySelectorAll(".fee-view").forEach((button) => {
      button.addEventListener("click", async function () {
        const id = button.getAttribute("data-id");
        window.location.href = `fees.php?id=${id}`;
      });
    });
  } catch (error) {
    console.log(error);
  }
};

resentFeesPaid();
resentTeachers();
resentStudents();
showClasses();
showPaidFees();
showTeachersCount();
showStudentCount();
