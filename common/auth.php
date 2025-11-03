<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: Admin/login.php");
  exit;
}
