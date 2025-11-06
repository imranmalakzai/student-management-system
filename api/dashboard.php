<?php
require("../config/db.php");
header("Content-Type:application/json");

$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

switch ($method) {
  case "COUNT_STUDENTS":
    $result = $conn->query("SELECT COUNT(*) AS total FROM students");
    $total = $result->fetch_assoc();
    echo json_encode($total ? $total : 0);
    break;
  case "COUNT_TEACHERS":
    $result = $conn->query("SELECT COUNT(*) AS total FROM teachers");
    $total = $result->fetch_assoc();
    echo json_encode($total ? $total : 0);
    break;
  case "COUNT_CLASSES":
    $result = $conn->query("SELECT COUNT(*) AS total FROM teachers");
    $total = $result->fetch_assoc();
    echo json_encode($total ? $total : 0);
    break;
  case "FEES_PAID":
    $result_students  = $conn->query("SELECT COUNT(*) AS total FROM students");
    $result_fees = $conn->query("SELECT COUNT(*) AS total FROM fees");
    $total_fees = $result_fees->fetch_assoc();
    $total_students = $result_students->fetch_assoc();
    $fees = intval($total_fees['total']);
    $students = intval($total_students["total"]);
    $percentage = ($fees / $students) * 100;
    echo json_encode($percentage);
    break;
  case "RESENT_STUDENTS":
    $result = $conn->query(" 
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
         ORDER BY student_id DESC limit 2");
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
    break;
  case "RESENT_TEACHERS":
    $result = $conn->query("SELECT teacher_id,first_name,last_name,name As subject FROM teachers INNER JOIN subjects ON subjects.subject_id = teachers.subject_id ORDER BY teacher_id DESC limit 2");
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
    break;
  case "RESENT_FEES":
    $result = $conn->query("SELECT first_name,last_name,last_payment_date,amount_paid, fees.student_id FROM fees INNER JOIN students ON students.student_id = fees.student_id ORDER BY fees.student_id DESC limit 2");
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
}
