<?php
require('common/auth.php');
require("common/header.php") ?>

<div class="container-fluid bg-light pt-5">
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-chalkboard-teacher me-2"></i> <span data-translate="teachers">Teachers</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <button class="btn btn-purpal" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addTeacher">Add Teacher</span>
      </button>
    </div>
  </div>

  <div class="row mb-4 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
      <div class="input-group shadow-sm border rounded">
        <span class="input-group-text bg-white border-0">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input type="text" id="searchTeacher" placeholder="search teacher" class="form-control border-0 ">
      </div>
    </div>
    <div class="col-md-6 text-end">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button id="pdf" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pdf me-1"></i> <span data-translate="pdf">PDF</span></button>
        <button id="cvs" type="button" class="btn btn-outline-success"><i class="fa-solid fa-file-csv me-1"></i> <span data-translate="cvs">CSV</span></button>
        <button id="download" type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-download me-1"></i> <span data-translate="download">Download</span></button>
      </div>
    </div>
  </div>

  <div class="row" id="tableContainer">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <table class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th class="text-center" data-translate="id-number">ID</th>
                <th class="text-center" data-translate="name">Full Name</th>
                <th class="text-center" data-translate="dob">DOB</th>
                <th class="text-center" data-translate="contact">Contact</th>
                <th class="text-center" data-translate="email">Email</th>
                <th class="text-center" data-translate="hire-date">Hire Date</th>
                <th class="text-center" data-translate="status">Status</th>
                <th class="text-center" data-translate="gender">Gender</th>
                <th class="text-center" data-translate="qualification">Qualification</th>
                <th class="text-center" data-translate="subject">Subject</th>
                <th data-translate="action" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="teachersTableBody">
              <!-- <tr>
                <th scope="row">1</th>
                <td>Imran Malakzai</td>
                <td>2000-05-12</td>
                <td>0777123456</td>
                <td>imran@example.com</td>
                <td>2024-08-01</td>
                <td>Active</td>
                <td>Male</td>
                <td>BSc Computer Science</td>
                <td>Math</td>
                <td class="text-center">
                  <button class="btn btn-sm btn-warning me-2"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Teacher Modal -->

<div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title" id="addTeacherModalLabel">
          <i class="fa-solid fa-user-plus me-2"></i> Add New Teacher
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addTeacherForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">First Name</label>
              <input id="first_name" placeholder="Enter your first name" type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name</label>
              <input placeholder="Enter your last name" id="last_name" type="text" name="last_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input id="date_of_birth" type="date" name="date_of_birth" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Contact Number</label>
              <input id="contact_number" type="text" name="contact_number" class="form-control" placeholder="Enter your Phone number" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input id="email" type="email" name="email" placeholder="Enter your Email address" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Hire Date</label>
              <input id="hire_date" type="date" name="hire_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select id="status" name="status" class="form-select" required>
                <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Gender</label>
              <select id="gender_id" name="gender_id" class="form-select" required></select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Qualification</label>
              <select id="qualification_id" name="qualification_id" class="form-select" required></select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <select id="subject_id" name="subject_id" class="form-select" required></select>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-purpal"><i class="fa-solid fa-save me-1"></i> Save Teacher</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="js/teacher.js"></script>

<?php require("common/footer.php") ?>