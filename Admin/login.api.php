<?php
session_start();
require_once "../config/db.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $conn->real_escape_string($_POST["username"]);
  $password = md5($_POST["password"]); // simple hash for now

  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION["admin"] = $username;

    echo json_encode([
      "status" => "success",
      "message" => "Login successful"
    ]);
    exit;
  } else {
    echo json_encode([
      "status" => "error",
      "message" => "Invalid username or password"
    ]);
    exit;
  }
}
