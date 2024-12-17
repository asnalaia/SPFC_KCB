<?php
include "config.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC</title>

    <!-- boostrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Gejala</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Penyakit</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link disabled" href="#">Aturan</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link disabled" href="#">Konsultasi</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link disabled" href="#">Logout</a>
    </li>
  </ul>
</nav>

<div class="container mt-2">
    <?php

    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page==""){
        include "welcome.php";
            }elseif ($page=="NAMA_PAGE"){
        if ($action==""){
          include "NAMA_HALAMAN";
        }elseif ($action=="NAMA_ACTION"){
            include "NAMA_HALAMAN";
        }elseif ($action=="NAMA_ACTION"){
            include "NAMA_HALAMAN";
        }else{
            include "NAMA_HALAMAN";
        }
    }else{
        include "NAMA_HALAMAN";
    }
?>

</div>


<!-- jquery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>


<!-- bosstrap js-->
<link rel="stylesheet" href="assets\js\bootstrap.min.js">
</body>
</html>