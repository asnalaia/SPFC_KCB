<?php
include "config.php"; // Pastikan sudah menghubungkan dengan database

$idpenyakit = $_GET['id']; // Ambil idpenyakit dari URL

if (isset($_POST['update'])) {
    // Ambil data dari form
    $nmpenyakit = $_POST['nmpenyakit'];
    $keterangan = $_POST['keterangan'];
    $solusi = $_POST['solusi'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("UPDATE penyakit SET nmpenyakit = ?, keterangan = ?, solusi = ? WHERE idpenyakit = ?");
    $stmt->bind_param("sssi", $nmpenyakit, $keterangan, $solusi, $idpenyakit); // "sssi" berarti string, string, string, integer

    if ($stmt->execute()) {
        header("Location: ?page=penyakit"); // Redirect ke halaman penyakit setelah berhasil update
        exit(); // Menghentikan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Error: " . $stmt->error; // Menampilkan pesan error jika query gagal
    }

    // Menutup statement
    $stmt->close();
}

// Mengambil data penyakit yang ingin diupdate
$sql = "SELECT * FROM penyakit WHERE idpenyakit = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idpenyakit); // "i" berarti integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card-header bg-primary text-white border-dark">
                    <strong>Update Data Penyakit</strong>
                </div>
                <div class="card-body">
                    <!-- Input untuk Nama Penyakit -->
                    <div class="form-group">
                        <label for="nmpenyakit">Nama Penyakit</label>
                        <input type="text" class="form-control" name="nmpenyakit" value="<?php echo htmlspecialchars($row['nmpenyakit']); ?>" maxlength="200" required>
                    </div>

                    <!-- Input untuk Keterangan -->
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" maxlength="500" required><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
                    </div>

                    <!-- Input untuk Solusi -->
                    <div class="form-group">
                        <label for="solusi">Solusi</label>
                        <textarea class="form-control" name="solusi" maxlength="500" required><?php echo htmlspecialchars($row['solusi']); ?></textarea>
                    </div>

                    <!-- Tombol untuk mengupdate data -->
                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <!-- Tombol untuk batal kembali ke halaman penyakit -->
                    <a class="btn btn-danger" href="?page=penyakit">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Pastikan koneksi ditutup setelah selesai
$conn->close();
?>
