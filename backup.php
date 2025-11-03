<?php require("common/header.php") ?>

<div class="container">
  <div class="card p-4">
    <h3 class="text-center mb-4"><i class="fa-solid fa-database"></i> Database Backup & Recovery</h3>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-3" id="backupTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="store-tab" data-bs-toggle="tab" data-bs-target="#store" type="button" role="tab">
          <i class="fa-solid fa-cloud-arrow-down"></i> Store Backup
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="recover-tab" data-bs-toggle="tab" data-bs-target="#recover" type="button" role="tab">
          <i class="fa-regular fa-window-restore"></i> Recover Backup
        </button>
      </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="backupTabsContent">
      <!-- STORE BACKUP TAB -->
      <div class="tab-pane fade show active" id="store" role="tabpanel">
        <form method="post">
          <div class="text-center py-4">
            <p class="text-muted">Download your full database as a .sql file and save it anywhere you like.</p>
            <button type="submit" name="backup" id="download-backup-btn" class="btn btn-purple btn-lg">
              <i class="fa-solid fa-cloud-arrow-down"></i> Download Backup
            </button>
          </div>
        </form>
      </div>

      <!-- RECOVER BACKUP TAB -->
      <div class="tab-pane fade" id="recover" role="tabpanel">
        <form id="backupForm" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="sql_file" class="form-label fw-semibold">Select Backup File (.sql)</label>
            <input type="file" name="sql_file" id="sql_file" class="form-control" required>
          </div>
          <button type="submit" name="restore" class="btn btn-purple btn-lg">
            <i class="fa-solid fa-upload"></i> Restore Database
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<style>
  .card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  }

  .nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 600;
  }

  .nav-tabs .nav-link.active {
    color: #0d6efd;
    border-bottom: 3px solid #0d6efd;
    background-color: transparent;
  }

  .btn-purple {
    background-color: #6f42c1;
    color: #fff;
    border-radius: 10px;
  }

  .btn-purple:hover {
    background-color: #5a32a3;
    color: #fff;
  }

  .container {
    max-width: 700px;
    margin-top: 60px;
  }
</style>
<script src="js/backup.js"></script>
<?php require("common/footer.php") ?>