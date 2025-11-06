<?php

require_once("../config/db.php");
header("Content-Type: application/json");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "GET":
    if (isset($_GET["fee_id"])) {
      $fee_id = intval($_GET["fee_id"]);
      $query = "SELECT 
                f.fee_id,
                f.student_id,
                f.class_id,
                f.total_amount,
                f.amount_paid,
                f.due_amount,
                f.payment_status,
                f.last_payment_date,
                f.notes,
                s.first_name AS student_first_name,
                s.last_name AS student_last_name,
                c.name AS class_name
              FROM fees f
              LEFT JOIN students s ON f.student_id = s.student_id
              LEFT JOIN classes c ON f.class_id = c.class_id
              WHERE f.fee_id = $fee_id";
      $result = $conn->query($query);
      $fees = $result->fetch_assoc();
      echo json_encode($fees ? $fees : ["message" => "No Fees Record Exist"]);
    } else {
      $query = "SELECT 
                f.fee_id,
                f.student_id,
                f.class_id,
                f.total_amount,
                f.amount_paid,
                f.due_amount,
                f.payment_status,
                f.last_payment_date,
                f.notes,
                s.first_name AS student_first_name,
                s.last_name AS student_last_name,
                c.name AS class_name
              FROM fees f
              LEFT JOIN students s ON f.student_id = s.student_id
              LEFT JOIN classes c ON f.class_id = c.class_id";
      $result = $conn->query($query);
      $fees = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($fees ? $fees : ["message" => "No fees Record Exists"]);
    }
    break;

    if (isset($_GET["fee_id"])) {
      $fee_id = intval($_GET["fee_id"]);
      $query = "SELECT * FROM fees WHERE fee_id = $fee_id";
      $result = $conn->query($query2);
      $fees = $result->fetch_assoc();
      if ($fees) {
        echo json_encode($fees);
      } else {
        echo json_encode(["message" => "No Fees Record Exist"]);
      }
    } else {
      $query = "SELECT * FROM fees";
      $result = $conn->query($query);
      $fees = $result->fetch_all(MYSQLI_ASSOC);
      if ($fees) {
        echo json_encode($fees);
      } else {
        echo json_encode(["message" => "No fees Record Exists"]);
      }
    }
    break;
  case "POST":
    $student_id = intval($_POST["student_id"]);
    $class_id = intval($_POST["class_id"]);
    $total_amount = $_POST["total_amount"];
    $paid_amount = $_POST["amount_paid"];
    $last_payment_date = $_POST["last_payment_date"];
    $notes = $_POST["notes"];

    $query = "INSERT INTO fees (student_id,class_id,total_amount,amount_paid,last_payment_date,notes) 
      VALUES ($student_id,$class_id,$total_amount,$paid_amount,'$last_payment_date','$notes') ";
    $result = $conn->query($query);
    if ($result) {
      echo json_encode(["message" => "Added success fully"]);
    } else {
      echo json_encode(["message" => "Unable to add the Record"]);
    }
    break;
  case "PUT":
    if (isset($_POST["fee_id"])) {
      $fee_id = intval($_POST["fee_id"]);
      $student_id = intval($_POST["student_id"]);
      $class_id = intval($_POST["class_id"]);
      $total_amount = $_POST["total_amount"];
      $paid_amount = $_POST["amount_paid"];
      $last_payment_date = $_POST["last_payment_date"];
      $notes = $_POST["notes"];

      $query = "UPDATE fees set student_id = $student_id, class_id = $class_id,total_amount = $total_amount,amount_paid= $paid_amount, last_payment_date = '$last_payment_date', notes = '$notes' WHERE fee_id = $fee_id ";

      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "Record updated successfully"]);
      } else {
        echo json_encode(["message" => "Unable to update Record"]);
      }
    } else {
      echo json_encode(["message" => "Fee_id is not found"]);
    }
    break;
  case "DELETE":
    if (isset($_POST["fee_id"])) {
      $fee_id = intval($_POST["fee_id"]);
      $query = "DELETE FROM fees WHERE fee_id = $fee_id";
      if ($conn->query($query)) {
        echo json_encode(["message" => "Record Deleted successfully"]);
      } else {
        echo json_encode(["message" => "Unable to delte Record"]);
      }
    }
    break;
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
