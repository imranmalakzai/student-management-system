<?php
require('common/auth.php');
require("common/header.php");
?>

<div class="container-fluid bg-light pt-5">
  <!-- Header -->
  <div class="row mb-4 align-items-center">
    <div class="col-md-6 me-auto">
      <h2 class="text-purpal fw-bold">
        <i class="fa-solid fa-money-bill-wave me-2"></i> <span data-translate="fees-management">Fees Management</span>
      </h2>
    </div>
    <div class="col-md-3 text-end">
      <button class="btn btn-purpal shadow" data-bs-toggle="modal" data-bs-target="#addFeeModal">
        <i class="fa-solid fa-plus me-2"></i> <span data-translate="add-fee">Add Fee Record</span>
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
        <input type="text" id="searchFee" placeholder="Search by student name" class="form-control border-0">
      </div>
    </div>
    <div class="col-md-6 text-end">
      <div class="btn-group" role="group" aria-label="Export Options">
        <button type="button" id="pdf" class="btn btn-outline-primary"><i class="fa-solid fa-file-pdf me-1"></i> PDF</button>
        <button id="csv" type="button" class="btn btn-outline-success"><i class="fa-solid fa-file-csv me-1"></i> CSV</button>
        <button id="download" type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-download me-1"></i> Download</button>
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
                <th>ID</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Total Amount</th>
                <th>Paid</th>
                <th>Due</th>
                <th>Status</th>
                <th>Last Payment</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="feesTablebody"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add / Update Modal -->
<div class="modal fade" id="addFeeModal" tabindex="-1" aria-labelledby="addFeeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-purpal text-white">
        <h5 class="modal-title" id="addFeeModalLabel">
          <i class="fa-solid fa-circle-plus me-2"></i> <span id="feesLableText">Add / Update Fee</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="addFeeForm">
        <div class="modal-body">
          <div class="row g-3">
            <!-- CLASS SELECT -->
            <div class="col-12">
              <label class="form-label fw-semibold">Select Class</label>
              <select id="class_id" name="class_id" class="form-select shadow-sm" required>
                <!-- Filled dynamically via AJAX -->
              </select>
            </div>

            <!-- STUDENT SELECT -->
            <div class="col-12">
              <label class="form-label fw-semibold">Select Student</label>
              <select id="student_id" name="student_id" class="form-select shadow-sm" required disabled>
                <option value="">Select class first</option>
              </select>
            </div>

            <!-- AMOUNTS -->
            <div class="col-md-6">
              <label class="form-label fw-semibold">Total Amount</label>
              <input id="total_amount" name="total_amount" type="number" min="0" class="form-control shadow-sm" placeholder="Enter total amount" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Amount Paid</label>
              <input id="amount_paid" name="amount_paid" type="number" min="0" class="form-control shadow-sm" placeholder="Enter amount paid" required>
            </div>

            <!-- DATE -->
            <div class="col-12">
              <label class="form-label fw-semibold">Last Payment Date</label>
              <input id="last_payment_date" name="last_payment_date" type="date" class="form-control shadow-sm">
            </div>

            <!-- NOTES -->
            <div class="col-12">
              <label class="form-label fw-semibold">Notes</label>
              <textarea id="notes" name="notes" rows="2" class="form-control shadow-sm" placeholder="Optional notes..."></textarea>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fa-solid fa-xmark me-1"></i> Cancel
          </button>
          <button type="submit" class="btn btn-purpal">
            <i class="fa-solid fa-save me-1"></i> Save Record
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="js/fees.js"></script>
<?php require("common/footer.php"); ?>