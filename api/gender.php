<?php

require("../config/db.php");
header("Content-Type: application/json");

// Detect HTTP method or override via _method
$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {

  // ======================| GET: Fetch All or Single Record |======================
  case "GET":
    if (isset($_GET["gender_id"])) {
      $id = intval($_GET["gender_id"]);
      $query = "SELECT * FROM genders WHERE gender_id = $id";
      $result = $conn->query($query);
      $gender = $result->fetch_assoc();
      echo json_encode($gender ? $gender : ["message" => "Record not found"]);
    } else {
      $query = "SELECT * FROM genders";
      $result = $conn->query($query);
      $genders = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($genders ? $genders : ["message" => "Record not found"]);
    }
    break;


  // ======================| POST: Add a New Record |======================
  case "POST":
    if (isset($_POST["name"])) {
      $name = trim($_POST["name"]);
      if (empty($name)) {
        echo json_encode(["message" => "Name field cannot be empty"]);
        exit;
      }

      $query = "INSERT INTO genders (name) VALUES ('$name')";
      $result = $conn->query($query);

      if ($result) {
        echo json_encode(["message" => "Record added successfully"]);
      } else {
        echo json_encode(["message" => "Unable to add the record"]);
      }
    }
    break;


  // ======================| PUT: Update a Record |======================
  case "PUT":
    if (isset($_POST["gender_id"]) && isset($_POST["name"])) {
      $id = intval($_POST["gender_id"]);
      $name = trim($_POST["name"]);
      $query = "UPDATE genders SET name = '$name' WHERE gender_id = $id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record updated successfully"]);
      } else {
        echo json_encode(["message" => "Unable to update record"]);
      }
    } else {
      echo json_encode(["message" => "Missing required parameters"]);
    }
    break;


  // ======================| DELETE: Delete a Record |======================
  case "DELETE":
    if (isset($_POST["gender_id"])) {
      $id = intval($_POST["gender_id"]);
      $query = "DELETE FROM genders WHERE gender_id = $id";
      $result = $conn->query($query);

      if ($result) {
        echo json_encode(["message" => "Record deleted successfully"]);
      } else {
        echo json_encode(["message" => "Unable to delete record"]);
      }
    } else {
      echo json_encode(["message" => "Missing gender_id"]);
    }
    break;


  // ======================| DEFAULT: Invalid Method |======================
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
