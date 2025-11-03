<?php
require("../config/db.php");
header("Content-Type: application/json");
$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];
switch ($method) {
  case "GET":
    $query = "
      SELECT 
        t.teacher_id,
        t.qualification_id,
        t.gender_id,
        t.subject_id,
        t.first_name,
        t.last_name,
        t.date_of_birth,
        t.contact_number,
        t.email,
        t.hire_date,
        g.name AS gender,
        q.name AS qualification,
        s.name AS subject,
        t.status
      FROM teachers t
      LEFT JOIN genders g ON t.gender_id = g.gender_id
      LEFT JOIN qualifications q ON t.qualification_id = q.qualification_id
      LEFT JOIN subjects s ON t.subject_id = s.subject_id
    ";
    if (isset($_GET["teacher_id"])) {
      $id = intval($_GET["teacher_id"]);
      $result = $conn->query($query . "WHERE t.teacher_id=$id");
      $teacher = $result->fetch_assoc();
      if ($teacher) {
        echo json_encode($teacher);
      } else {
        json_encode(["message" => "unable to fetch the data"]);
      }
    } else {
      $result = $conn->query($query);
      $teachers = $result->fetch_all(MYSQLI_ASSOC);
      if ($teachers) {
        echo json_encode($teachers);
      } else {
        json_encode(["message" => "unable to fetch the data"]);
      }
    }
    break;
  case 'POST':
    $first_name       = $_POST['first_name'];
    $last_name        = $_POST['last_name'];
    $date_of_birth    = $_POST['date_of_birth'];
    $contact_number   = $_POST['contact_number'];
    $email            = $_POST['email'];
    $hire_date        = $_POST['hire_date'];
    $gender_id        = $_POST['gender_id'];
    $qualification_id = $_POST['qualification_id'];
    $subject_id       = $_POST['subject_id'];
    $status           = $_POST['status'];

    $query = "INSERT INTO teachers 
              (first_name, last_name, date_of_birth, contact_number, email, hire_date, gender_id, qualification_id, subject_id, status)
              VALUES ('$first_name', '$last_name', '$date_of_birth', '$contact_number', '$email', '$hire_date', '$gender_id', '$qualification_id', '$subject_id', '$status')";

    $result = $conn->query($query);
    if ($result) {
      echo json_encode(["message" => "Record added successfully"]);
    } else {
      echo json_encode(["message" => "unable to insert the record"]);
    }
    break;
  case "DELETE":
    if (isset($_POST["teacher_id"])) {
      $id = intval($_POST["teacher_id"]);
      $query = "DELETE FROM teachers WHERE teacher_id=$id";
      $result = $conn->query($query);
      if ($result) {
        echo json_encode(["message" => "record delete successfully"]);
      } else {
        echo json_encode(["message" => "unable to delete the record"]);
      }
    }
    break;
  case "PUT":
    if (isset($_POST["teacher_id"])) {
      $id = intval($_POST["teacher_id"]);
      $first_name       = $_POST['first_name'];
      $last_name        = $_POST['last_name'];
      $date_of_birth    = $_POST['date_of_birth'];
      $contact_number   = $_POST['contact_number'];
      $email            = $_POST['email'];
      $hire_date        = $_POST['hire_date'];
      $gender_id        = $_POST['gender_id'];
      $qualification_id = $_POST['qualification_id'];
      $subject_id       = $_POST['subject_id'];
      $status           = $_POST['status'];

      $query = "UPDATE teachers SET 
                first_name='$first_name',
                last_name='$last_name',
                date_of_birth='$date_of_birth',
                contact_number='$contact_number',
                email='$email',
                hire_date='$hire_date',
                gender_id='$gender_id',
                qualification_id='$qualification_id',
                subject_id='$subject_id',
                status='$status'
              WHERE teacher_id='$id'";
    }
    $resul = $conn->query($query);
    if ($resul) {
      echo json_encode(["message" => "Record update successfully"]);
    } else {
      echo json_encode(["message" => "Unable to delete the record"]);
    }
    break;
  default:
    echo json_encode(["message" => "Invalid request method"]);
    break;
}
