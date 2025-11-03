<?php
require_once("../config/db.php");
header("Content-Type: application/json");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  //=================== READ ===================//
  case "GET":
    $query = "
      SELECT
        t.teacher_id,
        c.class_id,
        c.name AS class_name,
        CONCAT(t.first_name, ' ', t.last_name) AS teacher_name
      FROM classes c
      LEFT JOIN teachers t ON c.teacher_id = t.teacher_id
    ";

    if (isset($_GET["class_id"])) {
      $id = intval($_GET["class_id"]);
      $result = $conn->query($query . " WHERE c.class_id = $id");
      $class = $result ? $result->fetch_assoc() : null;
      echo json_encode($class ?: ["message" => "Unable to fetch record"]);
    } else {
      $result = $conn->query($query);
      $classes = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
      echo json_encode($classes);
    }
    break;

  //=================== CREATE ===================//
  case "POST":
    if (isset($_POST["name"], $_POST["teacher_id"])) {
      $name = $conn->real_escape_string($_POST["name"]);
      $teacher_id = intval($_POST["teacher_id"]);

      $result = $conn->query("INSERT INTO classes (name, teacher_id) VALUES ('$name', $teacher_id)");
      echo json_encode(["message" => $result ? "Record added successfully" : "Unable to add record"]);
    } else {
      echo json_encode(["message" => "Missing fields for insert"]);
    }
    break;

  //=================== UPDATE ===================//
  case "PUT":
    if (isset($_POST["class_id"], $_POST["name"], $_POST["teacher_id"])) {
      $class_id = intval($_POST["class_id"]);
      $name = $conn->real_escape_string($_POST["name"]);
      $teacher_id = intval($_POST["teacher_id"]);

      $result = $conn->query("UPDATE classes SET name='$name', teacher_id=$teacher_id WHERE class_id=$class_id");
      echo json_encode(["message" => $result ? "Record updated successfully" : "Unable to update record"]);
    } else {
      echo json_encode(["message" => "Missing fields for update"]);
    }
    break;

  //=================== DELETE ===================//
  case "DELETE":
    if (isset($_POST["class_id"])) {
      $id = intval($_POST["class_id"]);
      $result = $conn->query("DELETE FROM classes WHERE class_id=$id");
      echo json_encode(["message" => $result ? "Record deleted successfully" : "Unable to delete record"]);
    } else {
      echo json_encode(["message" => "Missing class_id for delete"]);
    }
    break;

  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
