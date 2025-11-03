<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("❌ Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8 (important for proper text handling)
$conn->set_charset("utf8mb4");

// ✅ Connection successful
// You can now include this file wherever you need a database connection
