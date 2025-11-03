<?php
require('../config/db.php'); // adjust path if needed

header('Content-Type: application/json');

// Database credentials
$database = 'school';
$user = 'root';
$pass = '';
$response = [];

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ====================== BACKUP ====================== //
    if (isset($_POST['backup'])) {
      $backupFile = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
      $command = "\"d:\\xampp\\mysql\\bin\\mysqldump.exe\" --user={$user} --password={$pass} {$database}";
      $output = shell_exec($command);

      if ($output) {
        // Save to a temporary file
        $filePath = __DIR__ . "/../backups/{$backupFile}";
        if (!file_exists(__DIR__ . '/../backups')) {
          mkdir(__DIR__ . '/../backups', 0777, true);
        }
        file_put_contents($filePath, $output);

        $response = [
          "status" => "success",
          "message" => "Backup created successfully!",
          "file" => "backups/{$backupFile}"
        ];
      } else {
        throw new Exception("⚠️ Failed to create backup. Please check your server settings.");
      }
    }

    // ====================== RESTORE ====================== //
    elseif (isset($_POST['restore'])) {
      if (
        isset($_FILES['sql_file']) &&
        $_FILES['sql_file']['error'] === UPLOAD_ERR_OK &&
        pathinfo($_FILES['sql_file']['name'], PATHINFO_EXTENSION) === 'sql'
      ) {
        $uploadedFile = $_FILES['sql_file']['tmp_name'];
        $command = "\"d:\\xampp\\mysql\\bin\\mysql.exe\" --user={$user} --password={$pass} {$database} < \"{$uploadedFile}\"";
        system($command, $resultCode);

        if ($resultCode === 0) {
          $response = [
            "status" => "success",
            "message" => " Database restored successfully!"
          ];
        } else {
          throw new Exception("❌ Restore failed. Please check the SQL file or server permissions.");
        }
      } else {
        throw new Exception("⚠️ Invalid file type. Please upload a valid .sql file.");
      }
    }

    // If neither backup nor restore
    else {
      throw new Exception("Invalid request type.");
    }
  } else {
    throw new Exception("Invalid request method.");
  }
} catch (Exception $e) {
  $response = [
    "status" => "error",
    "message" => $e->getMessage()
  ];
}

echo json_encode($response);
exit;
