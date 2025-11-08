<?php
require('common/auth.php');
require("common/header.php") ?>
<div class="container-fluid bg-light pt-5 pb-4">
  <!-- Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6">
      <h2 class="text-purpal fw-bold">
        <i class="fas fa-graduation-cap me-2"></i> <span data-translate="qualifications">Qualifications</span>
      </h2>
    </div>
    <div class="col-md-6 text-md-end text-center mt-3 mt-md-0">
      <button class="btn btn-purpal shadow-sm" data-bs-toggle="modal" data-bs-target="#addQualificationModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addQualifications">Add Qualification</span>
      </button>
    </div>
  </div>

  <!-- Search & Export -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
      <div class="input-group shadow-sm border rounded">
        <span class="input-group-text bg-white border-0">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input type="text" id="searchQualifications" placeholder="search qualifications" class="form-control border-0 ">
      </div>
    </div>
    <div class="col-md-6 text-md-end text-center">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button id="pdf" type="button" class="btn btn-outline-primary shadow-sm">
          <i class="fa-solid fa-file-pdf me-1"></i> <span data-translate="pdf">PDF</span>
        </button>
        <button id="cvs" type="button" class="btn btn-outline-success shadow-sm">
          <i class="fa-solid fa-file-csv me-1"></i> <span data-translate="cvs">CSV</span>
        </button>
        <button id="download" type="button" class="btn btn-outline-secondary shadow-sm">
          <i class="fa-solid fa-download me-1"></i> <span data-translate="download">Download</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Table -->
  <div class="card shadow-sm border-0" id="tableContainer">
    <div class="card-body">
      <table id="qualifications-table" class="table table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th class="text-center" data-translate="id-number">ID</th>
            <th class="text-center" data-translate="qualification">Qualification Name</th>
            <th data-translate="action" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody id="qualificationTableBody"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addQualificationModal" tabindex="-1" aria-labelledby="addQualificationLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title"><i class="fas fa-graduation-cap me-2"></i>
          <span id="addQualificationLabel">
            Add New Qualification
          </span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addQualificationsForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="qualificationName" class="form-label">Qualification Name</label>
            <input type="text" id="qualificationName" name="name" class="form-control" placeholder="Enter qualification name" required>
            <input type="hidden" id="qualificationId" name="qualification_id">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-purpal">Save Qualification</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="js/qualification.js"></script>
<?php require("common/footer.php") ?>