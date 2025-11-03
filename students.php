<?php
require('common/auth.php');
require "common/header.php" ?>
<div class="container-fluid bg-light pt-5">
  <!-- Page Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-user-graduate me-2"></i> <span data-translate="students">Students</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-purpal shadow-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addStudents">Add Student</span>
      </button>
    </div>
  </div>

  <!-- Search and Export Buttons -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
      <div class="input-group shadow-sm border rounded">
        <span class="input-group-text bg-white border-0">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input id="studentSearch" type="text" placeholder="Search students..." class="form-control border-0">
      </div>
    </div>
    <div class="col-md-6 text-end">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button id="pdf" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pdf me-1"></i><span data-translate="pdf">PDF</span></button>
        <button id="cvs" type="button" class="btn btn-outline-success"><i class="fa-solid fa-file-csv me-1"></i> <span data-translate="cvs">CSV</span></button>
        <button id="download" type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-download me-1"></i> <span data-translate="download">Download</span></button>
      </div>
    </div>
  </div>

  <!-- Student Table -->
  <div class="row" id="tableContainer">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <table class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th class="text-center" data-translate="id-number">ID</th>
                <th class="text-center" data-translate="name">Full Name</th>
                <th class="text-center" data-translate="f-name">Father Name</th>
                <th class="text-center" data-translate="gender">Gender</th>
                <th class="text-center" data-translate="class">Class</th>
                <th class="text-center" data-translate="enrollment-date">Enrollment Date</th>
                <th class="text-center" data-translate="province">Province</th>
                <th class="text-center" data-translate="district-name">District</th>
                <th class="text-center" data-translate="action">Actions</th>
              </tr>
            </thead>
            <tbody id="studentTableBody">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title" id="addStudentModalLabel">
          <i class="fa-solid fa-user-graduate me-2"></i> Add New Student
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addStudentForm" method="POST" action="add_student.php">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">First Name</label>
              <input id="first_name" type="text" placeholder="first name" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name</label>
              <input id="last_name" type="text" placeholder="last name" name="last_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input id="date_of_birth" type="date" name="date_of_birth" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Father Name</label>
              <input id="father_name" type="text" placeholder="father name" name="father_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Province</label>
              <select id="province_id" name="province_id" class="form-select" required>
                <!-- <option value="">Select Province</option>
                <option value="1">Kabul</option>
                <option value="2">Laghaman</option>
                <option value="3">Zabul</option> -->
                <!-- Dynamic options from DB -->
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">District</label>
              <select id="district_id" name="district_id" class="form-select" required>
                <!-- <option value="">Select District</option>
                <option value="1">Nimrooz</option>
                <option value="2">Hira</option>
                <option value="3">Wila</option> -->
                <!-- Dynamic options -->
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Gender</label>
              <select id="gender_id" name="gender_id" class="form-select" required>
                <!-- <option value="">Select Gender</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option> -->
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Class</label>
              <select id="class_id" name="class_id" class="form-select" required>
                <!-- <option value="">Select Class</option>
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option> -->
                <!-- Dynamic options -->
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-purpal">
            <i class="fa-solid fa-save me-1"></i> Save Student
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="js/student.js"></script>
<?php require("common/footer.php") ?>