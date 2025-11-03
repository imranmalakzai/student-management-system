-- Simple School Management System Database Schema
CREATE DATABASE IF NOT EXISTS school_db;
USE school_db;

-- =====================
-- 1. Admin Table
-- =====================
CREATE TABLE tbl_admin (
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================
-- 2. Teacher Table
-- =====================
CREATE TABLE tbl_teacher (
  teacher_id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE,
  phone VARCHAR(50),
  address VARCHAR(255),
  hire_date DATE,
  subject_specialty VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================
-- 3. Class Table
-- =====================
CREATE TABLE tbl_class (
  class_id INT AUTO_INCREMENT PRIMARY KEY,
  class_name VARCHAR(100) NOT NULL, -- e.g. Grade 10
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================
-- 4. Section Table
-- =====================
CREATE TABLE tbl_section (
  section_id INT AUTO_INCREMENT PRIMARY KEY,
  class_id INT NOT NULL,
  section_name VARCHAR(50) NOT NULL, -- e.g. A, B
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_id) REFERENCES tbl_class(class_id) ON DELETE CASCADE
);

-- =====================
-- 5. Student Table
-- =====================
CREATE TABLE tbl_student (
  student_id INT AUTO_INCREMENT PRIMARY KEY,
  roll_no VARCHAR(50) UNIQUE,
  full_name VARCHAR(100) NOT NULL,
  gender ENUM('Male', 'Female') NOT NULL,
  dob DATE,
  phone VARCHAR(50),
  email VARCHAR(150),
  address VARCHAR(255),
  class_id INT,
  section_id INT,
  admission_date DATE,
  status ENUM('Active', 'Graduated', 'Left') DEFAULT 'Active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_id) REFERENCES tbl_class(class_id) ON DELETE SET NULL,
  FOREIGN KEY (section_id) REFERENCES tbl_section(section_id) ON DELETE SET NULL
);

-- =====================
-- 6. Subject Table
-- =====================
CREATE TABLE tbl_subject (
  subject_id INT AUTO_INCREMENT PRIMARY KEY,
  subject_name VARCHAR(100) NOT NULL,
  subject_code VARCHAR(50),
  class_id INT,
  teacher_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_id) REFERENCES tbl_class(class_id) ON DELETE SET NULL,
  FOREIGN KEY (teacher_id) REFERENCES tbl_teacher(teacher_id) ON DELETE SET NULL
);

-- =====================
-- 7. Enrollment Table
-- =====================
CREATE TABLE tbl_enrollment (
  enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  class_id INT NOT NULL,
  section_id INT,
  enrollment_date DATE DEFAULT CURRENT_DATE,
  FOREIGN KEY (student_id) REFERENCES tbl_student(student_id) ON DELETE CASCADE,
  FOREIGN KEY (class_id) REFERENCES tbl_class(class_id) ON DELETE CASCADE,
  FOREIGN KEY (section_id) REFERENCES tbl_section(section_id) ON DELETE SET NULL,
  UNIQUE (student_id, class_id)
);

-- =====================
-- 8. Exam Table
-- =====================
CREATE TABLE tbl_exam (
  exam_id INT AUTO_INCREMENT PRIMARY KEY,
  exam_name VARCHAR(100) NOT NULL, -- e.g. Midterm, Final
  class_id INT NOT NULL,
  exam_date DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_id) REFERENCES tbl_class(class_id) ON DELETE CASCADE
);

-- =====================
-- 9. Result Table
-- =====================
CREATE TABLE tbl_result (
  result_id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  exam_id INT NOT NULL,
  subject_id INT NOT NULL,
  marks_obtained DECIMAL(5,2),
  max_marks DECIMAL(5,2) DEFAULT 100,
  grade VARCHAR(5),
  remarks VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES tbl_student(student_id) ON DELETE CASCADE,
  FOREIGN KEY (exam_id) REFERENCES tbl_exam(exam_id) ON DELETE CASCADE,
  FOREIGN KEY (subject_id) REFERENCES tbl_subject(subject_id) ON DELETE CASCADE
);

-- =====================
-- 10. Fee Table
-- =====================
CREATE TABLE tbl_fee (
  fee_id INT AUTO_INCREMENT PRIMARY KEY,
  class_id INT NOT NULL,
  fee_type VARCHAR(100) NOT NULL, -- e.g. Tuition, Library
  amount DECIMAL(10,2) NOT NULL,
  due_date DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_id) REFERENCES tbl_class(class_id) ON DELETE CASCADE
);

-- =====================
-- 11. Payment Table
-- =====================
CREATE TABLE tbl_payment (
  payment_id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  fee_id INT NOT NULL,
  amount_paid DECIMAL(10,2) NOT NULL,
  payment_date DATE DEFAULT CURRENT_DATE,
  payment_method ENUM('Cash', 'Card', 'Bank Transfer') DEFAULT 'Cash',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES tbl_student(student_id) ON DELETE CASCADE,
  FOREIGN KEY (fee_id) REFERENCES tbl_fee(fee_id) ON DELETE CASCADE
);
