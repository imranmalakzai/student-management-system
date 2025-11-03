<?php

require_once("../config/db.php");

// Correct Content-Type header
header("Content-Type: application/json");

// Method override (_method) support
$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {

  // ====================== GET ======================
  case "GET":
    // Get single record based on id
    if (isset($_GET["province_id"])) {
      $id = intval($_GET["province_id"]);
      $query = "SELECT * FROM province WHERE province_id = $id";
      $response = $conn->query($query);
      if (!$response) {
        echo json_encode(["message" => "Province ID is invalid"]);
      } else {
        $province = $response->fetch_assoc();
        echo json_encode($province);
      };
    }
    // Get all records
    else {
      $query =  "SELECT * FROM province";
      $res = $conn->query($query);
      $province = $res->fetch_all(MYSQLI_ASSOC);
      echo json_encode($province);
    }
    break;

  // ====================== POST ======================
  case "POST":
    if (isset($_POST["name"])) {
      $name = $_POST["name"];
      $query = "INSERT INTO province (name) VALUES ('$name')";
      $res = $conn->query($query);
      if (!$res) {
        echo json_encode(["message" => "Province can't be added"]);
      } else {
        echo json_encode(["message" => "Province added successfully"]);
      }
    }
    break;

  // ====================== PUT ======================
  case "PUT":
    if (isset($_POST["province_id"])) {
      $id = intval($_POST["province_id"]);
      $name = $_POST["name"];
      $query = "UPDATE province SET name = '$name' WHERE province_id = $id";
      $res = $conn->query($query);
      if (!$res) {
        echo json_encode(["message" => "Can't update the province"]);
      } else {
        echo json_encode(["message" => "Province updated successfully"]);
      }
    }
    break;

  // ====================== DELETE ======================
  case "DELETE":
    if (isset($_POST["province_id"])) {
      $id = intval($_POST["province_id"]);
      $query = "DELETE FROM province WHERE province_id = $id";
      $res = $conn->query($query);
      if ($res && $conn->affected_rows > 0) {
        echo json_encode(["message" => "Record deleted successfully"]);
      } else {
        if ($conn->errno === 1451) {
          echo json_encode(["message" => "Can't delete this record; it’s linked to other data"]);
        } else {
          echo json_encode(["message" => "Something went wrong; can't delete record"]);
        }
      }
    }
    break;

  // ====================== DEFAULT ======================
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
