<?php

$servername = "localhost"; // Nama server (default: localhost)
$username = "root";        // Username MySQL (default: root)
$password = "";            // Password MySQL (default: kosong di XAMPP)
$dbname = "db_spfc"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
