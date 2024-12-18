<?php

if (isset($_POST['simpan'])) {
    // Pastikan untuk mengambil data dengan benar dari form
    $nmpenyakit = $_POST['nmpenyakit'];
    $ket = $_POST['ket'];
    $solusi = $_POST['solusi'];
    
    // Prepared statement untuk menghindari SQL Injection
    $stmt = $conn->prepare("INSERT INTO penyakit (nmpenyakit, keterangan, solusi) VALUES (?, ?, ?)");
    
    // Bind parameter untuk prepared statement (s = string)
    $stmt->bind_param("sss", $nmpenyakit, $ket, $solusi);

    // Eksekusi query
    if ($stmt->execute()) {
        header("Location: ?page=penyakit");
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
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Penyakit</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nmpenyakit">Nama Penyakit</label>
                        <input type="text" class="form-control" name="nmpenyakit" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <input type="text" class="form-control" name="ket" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="solusi">Solusi</label>
                        <input type="text" class="form-control" name="solusi" maxlength="200" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=penyakit">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
