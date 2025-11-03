<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?php echo isset($page_title) ? $page_title : 'School Management'; ?></title>
  <link href="css/bootsrap.css" rel="stylesheet" />
  <link href="css/all.css" rel="stylesheet" />
  <link href="css/sweetalert2.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="assets/img/logo2.png">
  <!-- <script>
    // Hide entire page until translation loaded
    document.documentElement.style.visibility = 'hidden';
  </script> -->
  <style>
    body {
      visibility: hidden;
    }

    body.loaded {
      visibility: visible;
      transition: visibility 0s ease-in 0s;
    }
  </style>


  <!-- Favicon -->

</head>

<body style="background-color: #F6F6F6;">
  <!-- Fixed Navbar -->
  <?php require("navbar.php") ?>

  <!-- Fixed Sidebar -->
  <?php require("sidebar.php") ?>
  <!-- Main Content -->
  <div class="main-content">