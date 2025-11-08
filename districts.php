<?php
require('common/auth.php');
require("common/header.php") ?>
<div class="container-fluid bg-light pt-5 pb-4 data-container">
  <!-- Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-location-dot me-2"></i> <span data-translate="districts">Districts</span>
      </h2>
    </div>
    <div class="col-md-6 text-md-end text-center mt-3 mt-md-0">
      <!-- Button trigger modal -->
      <button class="btn btn-purpal shadow-sm" data-bs-toggle="modal" data-bs-target="#addDistrictModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addDistricts">Add District</span>
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
        <input type="text" id="searchDistricts" placeholder="search districts" class="form-control border-0 ">
      </div>
    </div>
    <div class="col-md-6 text-md-end text-center">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button type="button" id="pdf" class="btn btn-outline-primary shadow-sm">
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
      <table class="table table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th data-translate="id-number">ID</th>
            <th data-translate="district-name">District Name</th>
            <th data-translate="province">Province</th>
            <th data-translate="action" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody id="districtsTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<!-- Add District Modal -->
<div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="addDistrictModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title">
          <i class="fa-solid fa-location-dot me-2"></i> <span id="addDistrictModalLabel">Add New District</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addDistrictForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="districtName" class="form-label">District Name</label>
            <input type="text" id="name" name="district_name" class="form-control shadow-sm" placeholder="Enter district name" required>
          </div>
          <div class="mb-3">
            <label for="provinceSelect" class="form-label">Select Province</label>
            <select id="provinceName" name="province_id" class="form-select shadow-sm" required>
              <!-- <option value="">-- Choose Province --</option>
              <option value="1">Kabul</option>
              <option value="2">Laghman</option>
              <option value="3">Nangarhar</option> -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-purpal">Add District</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="js/district.js"></script>
<?php require("common/footer.php") ?>