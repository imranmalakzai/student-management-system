<?php
require("../config/db.php");
header("Content-Type: application/json");
$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "GET":
    if (isset($_GET["qualification_id"])) {
      $id = intval($_GET["qualification_id"]);
      $query = "SELECT * FROM qualifications WHERE qualification_id=$id";
      $result = $conn->query($query);
      $qualification = $result->fetch_assoc();
      if ($qualification) {
        echo json_encode($qualification);
      } else {
        echo json_encode(["message" => "No record found!!!"]);
      }
    } else {
      $query = "SELECT * FROM qualifications";
      $result = $conn->query($query);
      $qualifications = $result->fetch_all(MYSQLI_ASSOC);
      if ($qualifications) {
        echo json_encode($qualifications);
      } else {
        echo json_encode(["message" => "No record found!!!"]);
      };
    }
    break;
  case "POST":
    if (isset($_POST["name"])) {
      $name = $_POST["name"];
      $query = "INSERT INTO qualifications (name) VALUES ('$name')";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record added successfully"]);
      } else {
        echo json_encode(["message" => "Unable to add the record"]);
      }
    }
    break;
  case "PUT":
    if (isset($_POST["qualification_id"])) {
      $id = intval($_POST["qualification_id"]);
      $name = $_POST["name"];
      $query = "UPDATE qualifications set name='$name' WHERE qualification_id=$id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record update successfully"]);
      } else {
        echo json_encode(["message" => "unable to update the record"]);
      }
    }
    break;
  case "DELETE":
    if (isset($_POST["qualification_id"])) {
      $id = intval($_POST["qualification_id"]);
      $query = "DELETE FROM qualifications WHERE qualification_id =$id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record deleted successfully"]);
      } else {
        echo json_encode(["message" => "Unable to delete the record"]);
      }
    }
    break;
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
