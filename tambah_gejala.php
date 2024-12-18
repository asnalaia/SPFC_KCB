<?php

if (isset($_POST['simpan'])) {
    // Pastikan untuk mengambil data dengan benar dari form
    $nmgejala = $_POST['nmgejala'];
    
    // Prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO gejala (nmgejala) VALUES (?)");
    $stmt->bind_param("s", $nmgejala); // "s" berarti string

    // Eksekusi query
    if ($stmt->execute()) {
        header("Location: ?page=gejala");
        exit(); // Menghentikan eksekusi lebih lanjut setelah redirect
    } else {
        echo "Error: " . $stmt->error; // Menampilkan pesan error jika query gagal
    }

    // Menutup statement
    $stmt->close();
}

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Gejala</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nmgejala">Nama Gejala</label>
                        <input type="text" class="form-control" name="nmgejala" maxlength="200" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=gejala">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
