<?php
require('common/auth.php');
require("common/header.php") ?>

<div class="container-fluid bg-light pt-5">
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-venus-mars me-2"></i><span data-translate="genders">Genders</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <button type="button" class="btn btn-purpal shadow-sm" data-bs-toggle="modal" data-bs-target="#addGenderModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addGenders">Add Gender</span>
      </button>
    </div>
  </div>

  <div class="row mb-4 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
      <div class="input-group shadow-sm border rounded">
        <span class="input-group-text bg-white border-0">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input type="text" id="searchGenders" placeholder="search genders" class="form-control border-0 ">
      </div>
    </div>
    <div class="col-md-6 text-end">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button id="pdf" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-file-pdf me-1"></i> <span data-translate="pdf">PDF</span></button>
        <button id="cvs" type="button" class="btn btn-outline-success"><i class="fa-solid fa-file-csv me-1"></i> <span data-translate="cvs">CSV</span></button>
        <button id="download" type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-download me-1"></i><span data-translate="download">Download</span></button>
      </div>
    </div>
  </div>

  <div class="row" id="tableContainer">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <table id="genderTable" class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th data-translate="id-number">ID</th>
                <th data-translate="gender">Gender Name</th>
                <th data-translate="action" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="gendersTableBody">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Add Gender Modal -->
<div class="modal fade" id="addGenderModal" tabindex="-1" aria-labelledby="addGenderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title">
          <i class="fa-solid fa-venus-mars me-2"></i> <span id="addGenderModalLabel">Add New Gender</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="addGenderForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="genderName" class="form-label fw-semibold">Gender Name</label>
            <input type="text" id="genderName" name="gender_name" class="form-control shadow-sm" placeholder="Enter gender (e.g. Male, Female, Other)" required>
          </div>

          <div class="alert alert-info d-flex align-items-center mt-3 mb-0" role="alert">
            <i class="fa-solid fa-circle-info me-2"></i>
            Example: <span class="ms-1">Male, Female, Other, Prefer not to say</span>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark me-1"></i> Cancel
          </button>
          <button type="submit" class="btn btn-purpal" id="submitGenderBtn">
            <i class="fa-solid fa-save me-1"></i> Save Gender
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="js/gender.js"></script>
<?php require("common/footer.php") ?>