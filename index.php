<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC - Sistem Pakar Penyakit Gigi dan Mulut</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
        }

        .navbar {
            margin-bottom: 30px;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover {
            background-color: #007bff;
            border-radius: 5px;
        }

        .navbar-nav .active .nav-link {
            background-color: #007bff;
            border-radius: 5px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .card-body {
            background-color: #f9f9f9;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: white;
            margin-top: 30px;
        }

        .page-title {
            font-weight: 700;
            color: #007bff;
        }

        h2 {
            color: #343a40;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">SPFC</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <?php
      if($_SESSION['role']!="Dokter"){
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=users">users</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=aturan">Basis Aturan</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=">Konsultasi</a>
      </li>

      <?php
      } elseif($_SESSION['role']!="Admin"){
       ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=gejala">Gejala</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=penyakit">Penyakit</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=aturan">Basis Aturan</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
      </li>

      <?php
      } else{
        ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
      </li>
      <?php
      }
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<?php 
    if($_SESSION['status']!="y"){
        header("Location:login.php");
    }
?>

<div class="container mt-4">

    <h1 class="text-center page-title">Sistem Pakar Penyakit Gigi dan Mulut</h1>
    <h2 class="text-center mb-4">Proyek Akhir Kecerdasan Buatan</h2>

    <!-- Include page content dynamically -->
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page == "") {
        include "welcome.php";
    } elseif ($page == "gejala") {
        if ($action == "") {
            include "tampil_gejala.php";
        } elseif ($action == "tambah") {
            include "tambah_gejala.php";
        } elseif ($action == "update") {
            include "update_gejala.php";
        } else {
            include "hapus_gejala.php";
        }
    } elseif ($page == "penyakit") {
        if ($action == "") {
            include "tampil_penyakit.php";
        } elseif ($action == "tambah") {
            include "tambah_penyakit.php";
        } elseif ($action == "update") {
            include "update_penyakit.php";
        } else {
            include "hapus_penyakit.php";
        }
    }elseif ($page == "aturan") {
        if ($action == "") {
            include "tampil_aturan.php";
        } elseif ($action == "tambah") {
            include "tambah_aturan.php";
        } elseif ($action == "detail") {
            include "detail_aturan.php";
        } elseif ($action == "update") {
            include "update_aturan.php";
        } elseif ($action == "hapus_gejala") {
            include "hapus_detail_aturan.php";
        } else {
            include "hapus_aturan.php";
        }
    }elseif ($page == "konsultasi") {
        if ($action == "") {
            include "tampil_konsultasi.php";
        } elseif ($action == "tambah") {
            include "tambah_penyakit.php";
        } elseif ($action == "update") {
            include "update_penyakit.php";
        } else {
            include "hapus_penyakit.php";
        }

    }elseif ($page == "users") {
        if ($action == "") {
            include "tampil_users.php";
        } elseif ($action == "tambah") {
            include "tambah_users.php";
        } elseif ($action == "update") {
            include "update_users.php";
        } else {
            include "hapus_users.php";
        }
    } else {
        include "logout.php";
    }

    ?>

</div>

<!-- Footer -->
<div class="footer">
    <p>&copy; 2024 SPFC - Sistem Pakar Penyakit Gigi dan Mulut. All Rights Reserved.</p>
</div>

<!-- jQuery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="assets/js/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

<script src="assets/js/all.js"></script>
<script src="assets/js/chosen.jquery.min.js"></script>
<script>
      $(function() {
        $('.chosen').chosen();
      });
</script>

</body>
</html>
