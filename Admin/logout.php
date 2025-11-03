<?php
session_start();
session_unset();  // remove all session variables
session_destroy(); // destroy the session completely

header("Content-Type: application/json");
echo json_encode([
  "status" => "success",
  "message" => "Logged out successfully"
]);
exit;
