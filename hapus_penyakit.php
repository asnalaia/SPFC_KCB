<?php

// Pastikan 'id' ada di URL
if (isset($_GET['id'])) {
    $idpenyakit = $_GET['id'];

    // Prepared Statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("DELETE FROM penyakit WHERE idpenyakit = ?");
    $stmt->bind_param("i", $idpenyakit); // "i" berarti integer, sesuai dengan tipe data idgejala

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect jika berhasil menghapus
        header("Location: ?page=penyakit");
        exit(); // Pastikan untuk menghentikan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
} else {
    echo "ID penyakit tidak ditemukan.";
}

$conn->close();
?>
