<?php

// Pastikan 'id' ada di URL
if (isset($_GET['id'])) {
    $idgejala = $_GET['id'];

    // Prepared Statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("DELETE FROM gejala WHERE idgejala = ?");
    $stmt->bind_param("i", $idgejala); // "i" berarti integer, sesuai dengan tipe data idgejala

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect jika berhasil menghapus
        header("Location: ?page=gejala");
        exit(); // Pastikan untuk menghentikan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
} else {
    echo "ID gejala tidak ditemukan.";
}

$conn->close();
?>
