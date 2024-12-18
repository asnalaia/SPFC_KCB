<?php 

$idgejala = $_GET['id'];

if (isset($_POST['update'])) {
    $nmgejala = $_POST['nmgejala'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("UPDATE gejala SET nmgejala = ? WHERE idgejala = ?");
    $stmt->bind_param("si", $nmgejala, $idgejala); // "si" berarti string dan integer

    if ($stmt->execute()) {
        header("Location: ?page=gejala");
        exit(); // Menghentikan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Error: " . $stmt->error; // Menampilkan pesan error jika query gagal
    }

    // Menutup statement
    $stmt->close();
}

$sql = "SELECT * FROM gejala WHERE idgejala = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idgejala); // "i" berarti integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Update Data Gejala</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nmgejala">Nama Gejala</label>
                            <input type="text" class="form-control" name="nmgejala" value="<?php echo htmlspecialchars($row['nmgejala']); ?>" maxlength="200" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=gejala">Batal</a>
                    </div>
                </div>
        </form>
    </div>
</div> 
