<?php
require('common/auth.php');
require("common/header.php") ?>
<div class="container-fluid bg-light pt-5">
  <!-- Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-map-location-dot me-2"></i> <span data-translate="provinces">Provinces</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <!-- Add Province Button -->
      <button class="btn btn-purpal" data-bs-toggle="modal" data-bs-target="#addProvinceModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addProvince">Add Province</span>
      </button>
    </div>
  </div>

  <!-- Search and Export -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 mb-2 mb-md-0">
      <div class="input-group shadow-sm border rounded">
        <span class="input-group-text bg-white border-0">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
        </span>
        <input type="text" id="searchProvince" placeholder="search province" class="form-control border-0 ">
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

  <!-- Province Table -->
  <div class="row" id="tableContainer">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <table class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th class="text-center" data-translate="id-number">ID</th>
                <th class="text-center" data-translate="province-name">Province Name</th>
                <th data-translate="action" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="provinceTableBody">
              <!-- Dynamic Rows Will Appear Here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Province Add Modal -->
<div class="modal fade" id="addProvinceModal" tabindex="-1" aria-labelledby="addProvinceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title"> <i class="fa-solid fa-map-location-dot me-2"></i><span id="addProvinceModalLabel">Add New Province</span></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addProvinceForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Province Name</label>
            <input type="text" id="name" name="name" class="form-control shadow-sm" placeholder="Enter province name" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-purpal" name="submit">Save Province</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="js/provice.js"></script>
<?php require("common/footer.php") ?>