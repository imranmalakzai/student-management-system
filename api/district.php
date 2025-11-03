<?php

require_once("../config/db.php");

// Correct Content-Type header
header("Content-Type: application/json");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "GET":
    if (isset($_GET["district_id"])) {
      $id = intval($_GET["district_id"]);
      $query = "SELECT * FROM district WHERE district_id=$id";
      $result = $conn->query($query);
      $district = $result->fetch_assoc();
      if ($district) {
        echo json_encode($district);
      } else {
        echo json_encode(["message" => "district not exist by this id"]);
      }
    } else {
      $query = "SELECT d.district_id,d.name,p.name AS province_name FROM district d JOIN province p ON d.province_id =p.province_id";
      $result = $conn->query($query);
      $districts = $result->fetch_all(MYSQLI_ASSOC);
      if ($districts) {
        echo json_encode($districts);
      } else {
        echo json_encode(["message" => "districts not exist"]);
      }
    }
    break;
  case "POST":
    if (isset($_POST["name"])) {
      $province = $_POST["province_id"];
      $name = $_POST["name"];
      $query = "INSERT INTO district (name,province_id) VALUES ('$name',$province)";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "district added successfully"]);
      } else {
        echo json_encode(["message" => "con't add the districts"]);
      }
    }
    break;
  case "DELETE":
    if (isset($_POST["district_id"])) {
      $id = intval($_POST["district_id"]);
      $query = "DELETE FROM district WHERE district_id = $id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "district deleted successfully"]);
      } else {
        echo json_encode(["message" => "unable to delete the districts"]);
      };
    }
    break;
  case "PUT":
    if (isset($_POST["district_id"])) {
      $id = intval($_POST["district_id"]);
      $name = $_POST["name"];
      $province = intval($_POST["province_id"]);
      $query = "UPDATE district SET name = '$name',province_id = $province WHERE district_id = $id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record update successfully"]);
      } else {
        echo json_encode(["message" => "unable to update record"]);
      }
    }
    break;
  case "PROVINCE":
    if (isset($_POST["province_id"])) {
      $id = intval($_POST["province_id"]);
      $query = "SELECT * FROM district WHERE province_id = $id";
      $result = $conn->query($query);
      $districts = $result->fetch_all(MYSQLI_ASSOC);
      if ($districts) {
        echo json_encode($districts);
      } else {
        echo json_encode(["message" => "No districts for this province"]);
      }
    }
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
