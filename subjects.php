<?php
require('common/auth.php');
require("common/header.php") ?>
<div class="container-fluid bg-light pt-5 pb-4">
  <!-- Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-book me-2"></i> <span data-translate="subjects">Subjects</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <!-- Add Subject Button -->
      <button class="btn btn-purpal shadow-sm" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="addSubject">Add Subject</span>
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
        <input type="text" id="searchSubject" placeholder="search subject" class="form-control border-0 ">
      </div>
    </div>
    <div class="col-md-6 text-end">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button id="pdf" type="button" class="btn btn-outline-primary">
          <i class="fa-solid fa-file-pdf me-1"></i> <span data-translate="pdf">PDF</span>
        </button>
        <button id="cvs" type="button" class="btn btn-outline-success">
          <i class="fa-solid fa-file-csv me-1"></i> <span data-translate="cvs">CSV</span>
        </button>
        <button id="download" type="button" class="btn btn-outline-secondary">
          <i class="fa-solid fa-download me-1"></i> <span data-translate="download">Download</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Table -->
  <div class="row" id="tableContainer">
    <div class="col-12">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <table class="table table-hover align-middle" id="subjectTable">
            <thead class="table-primary">
              <tr>
                <th scope="col"><span data-translate="id-number">ID</span></th>
                <th scope="col"><i class="fa-solid fa-book-open me-1"></i><span data-translate="subject">Subject Name</span></th>
                <th scope="col" class="text-center"><i class="fa-solid fa-gear me-1"></i> <span data-translate="action">Actions</span></th>
              </tr>
            </thead>
            <tbody id="subjectTableBody">
              <!-- <tr>
                <th scope="row">1</th>
                <td>Mathematics</td>
                <td class="text-center">
                  <button class="btn btn-sm btn-warning me-2"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Physics</td>
                <td class="text-center">
                  <button class="btn btn-sm btn-warning me-2"><i class="fa-solid fa-pen-to-square"></i></button>
                  <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Chemistry</td>
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

<!-- Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title" id="addSubjectLabel"><i class="fa-solid fa-plus me-2"></i> Add New Subject</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form id="addSubjectForm">
        <div class="modal-body">
          <div class="mb-3">
            <label for="subjectName" class="form-label">Subject Name</label>
            <input type="text" class="form-control" id="subjectName" placeholder="Enter subject name" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-purpal">Save Subject</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="js/subject.js"></script>
<?php require("common/footer.php") ?>