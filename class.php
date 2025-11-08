<?php
require('common/auth.php');
require("common/header.php") ?>
<div class="container-fluid bg-light pt-5">
  <!-- Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-school-flag me-2"></i> <span data-translate="classes">Classes</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <button class="btn btn-purpal shadow" data-bs-toggle="modal" data-bs-target="#addClassModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addClass">Add Class</span>
      </button>
    </div>
  </div>

  <!-- Search & Export Row -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
      <div class="input-group shadow-sm border rounded">
        <span class="input-group-text bg-white border-0">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input type="text" id="searchClass" placeholder="search class" class="form-control border-0 ">
      </div>
    </div>
    <div class="col-md-6 text-end">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button type="button" id="pdf" class="btn btn-outline-primary"><i class="fa-solid fa-file-pdf me-1"></i> <span data-translate="pdf">PDF</span></button>
        <button id="cvs" type="button" class="btn btn-outline-success"><i class="fa-solid fa-file-csv me-1"></i> <span data-translate="cvs">CSV</span></button>
        <button id="download" type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-download me-1"></i> <span data-translate="download">Download</span></button>
      </div>
    </div>
  </div>

  <!-- Table -->
  <div class="row" id="tableContainer">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <table class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th data-translate="id-number">ID</th>
                <th data-translate="class-name">Class Name</th>
                <th data-translate="teacher">Teacher</th>
                <th data-translate="action" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="tablebody"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add / Update Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title">
          <i class="fa-solid fa-school-flag me-2"></i> <span id="addClassModalLabel">Add New Class</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="addClassForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label fw-semibold">Class Name</label>
              <input id="name" type="text" name="name" class="form-control shadow-sm" placeholder="Enter class name" required>
            </div>

            <div class="col-12">
              <label class="form-label fw-semibold">Teacher</label>
              <select id="teacher_id" name="teacher_id" class="form-select shadow-sm" required>
                <!-- <option value="">Select Teacher</option>
                <option value="1">Imran Malakzai</option>
                <option value="2">Aisha Rahimi</option> -->
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark me-1"></i> Cancel
          </button>
          <button type="submit" class="btn btn-purpal">
            <i class="fa-solid fa-save me-1"></i> Save Class
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="js/class.js"></script>
<?php require("common/footer.php") ?>