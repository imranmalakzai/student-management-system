<?php
require("../config/db.php");
header("Content-Type: application/json");

$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  // ---------------- GET ----------------
  case 'GET':
    $query = "
            SELECT 
                c.class_id,
                p.province_id,
                d.district_id,
                g.gender_id,
                s.student_id,
                s.first_name,
                s.last_name,
                s.father_name,
                s.date_of_birth,
                s.enrollment_date,
                g.name AS gender,
                c.name AS class_name,
                p.name AS province,
                d.name AS district
            FROM students s
            LEFT JOIN genders g ON s.gender_id = g.gender_id
            LEFT JOIN classes c ON s.class_id = c.class_id
            LEFT JOIN province p ON s.province_id = p.province_id
            LEFT JOIN district d ON s.district_id = d.district_id
        ";

    if (isset($_GET['student_id'])) {
      $id = intval($_GET['student_id']);
      $query .= " WHERE s.student_id = $id";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode($student);
      } else {
        echo json_encode(["message" => "Student not found"]);
      }
    } else {
      $result = $conn->query($query);
      $students = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($students);
    }
    break;

  // ---------------- POST ----------------
  case 'POST':
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender_id = intval($_POST['gender_id']);
    $class_id = intval($_POST['class_id']);
    $province_id = intval($_POST['province_id']);
    $district_id = intval($_POST['district_id']);

    $query = "INSERT INTO students (first_name, last_name, father_name, date_of_birth, gender_id, class_id, province_id, district_id) VALUES ('$first_name','$last_name', '$father_name', '$date_of_birth',$gender_id,$class_id,$province_id,$district_id)";

    $result = $conn->query($query);
    if ($result) {
      echo json_encode(["message" => "Student added successfully"]);
    } else {
      echo json_encode(["message" => "Failed to add student"]);
    }
    break;

  // ---------------- DELETE ----------------
  case 'DELETE':
    $id = intval($_POST['student_id']);
    $query = "DELETE FROM students WHERE student_id = $id";
    $result = $conn->query($query);
    if ($result) {
      echo json_encode(["message" => "Student deleted successfully"]);
    } else {
      echo json_encode(["message" => "Failed to delete student"]);
    }
    break;
  // ---------------- PUT ----------------
  case 'PUT':
    $id = intval($_POST['student_id']);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $father_name = $_POST['father_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender_id = intval($_POST['gender_id']);
    $class_id = intval($_POST['class_id']);
    $province_id = intval($_POST['province_id']);
    $district_id = intval($_POST['district_id']);

    $query = "UPDATE students SET first_name = '$first_name', last_name = '$last_name', father_name = '$father_name', date_of_birth = '$date_of_birth', gender_id = $gender_id, class_id = $class_id, province_id = $province_id, district_id = $district_id WHERE student_id = $id";
    $result = $conn->query($query);
    if ($result) {
      echo json_encode(["message" => "Student updated successfully"]);
    } else {
      echo json_encode(["message" => "Failed to update student"]);
    }
    break;
  // ---------------- DISTRICT_BY_PROVINCE ----------------
  case "DISTRICT_BY_PROVINCE":
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
    break;

  // ---------------- DEFAULT ----------------
  case "CLASS_STUDENTS":
    if (isset($_POST["class_id"])) {
      $class_id = intval($_POST["class_id"]);
      $query = "SELECT * FROM students WHERE class_id = $class_id";
      $result = $conn->query($query);
      $students = $result->fetch_all(MYSQLI_ASSOC);
      if ($username) {
        echo json_encode($students);
      } else {
        echo json_encode(["message" => "unable to fetch students records"]);
      }
    }
    break;
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
$conn->close();
