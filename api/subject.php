<?php

require("../config/db.php");
header("Content-Type: application/json");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "GET":
    if (isset($_GET["subject_id"])) {
      $id = intval($_GET["subject_id"]);
      $query = "SELECT * FROM subjects WHERE subject_id = $id";
      $result = $conn->query($query);
      $subject = $result->fetch_assoc();
      if ($subject) {
        echo json_encode($subject);
      } else {
        echo json_encode(["message" => "invalid id no subject found"]);
      }
    } else {
      $query = "SELECT * FROM subjects";
      $result = $conn->query($query);
      $subjects = $result->fetch_all(MYSQLI_ASSOC);
      if ($subjects) {
        echo json_encode($subjects);
      } else {
        echo json_encode(["message" => "Unable to load the  subjects"]);
      }
    }
    break;
  case "POST":
    if (isset($_POST["name"])) {
      $name = $_POST["name"];
      $query = "INSERT INTO subjects (name) VALUES ('$name')";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "subject added successfully"]);
      } else {
        echo json_encode(["message" => "unable to added the subject"]);
      }
    }
    break;
  case "DELETE":
    if (isset($_POST["subject_id"])) {
      $id = intval($_POST["subject_id"]);
      $query = "DELETE FROM subjects WHERE subject_id=$id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record deleted successfully"]);
      } else {
        echo json_encode(["message" => "Can't delete successfully"]);
      }
    }
    break;
  case "PUT":
    if (isset($_POST["subject_id"])) {
      $id = intval($_POST["subject_id"]);
      $name = $_POST["name"];
      $query = "UPDATE subjects SET name='$name' WHERE subject_id=$id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record updated successfully"]);
      } else {
        echo json_encode(["message" => "unable to update the record"]);
      }
    }
    break;
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
