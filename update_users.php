<?php

$idusers = $_GET['id']; // Ambil idpenyakit dari URL

if (isset($_POST['update'])) {

    $role=$_POST['update'];

    $sql = "UPDATE users SET role='$role' WHERE idusers='$idusers'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=users");
    }
}

// Mengambil data penyakit yang ingin diupdate
$sql = "SELECT * FROM users WHERE idusers = '$idusers'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card-header bg-primary text-white border-dark"><strong>Update Data Users</strong>
                </div>
                <div class="card-body">
                    <!-- Input untuk Nama Penyakit -->
                    <div class="form-group">
                        <label for="nmpenyakit">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" readonly>
                    </div>

                    <!-- Input untuk Keterangan -->
                    <div class="form-group">
                        <label for="keterangan">Password</label>
                        <input type="password" class="form-control" name="keterangan" maxlength="500" required><?php echo $row['pass'] ?>" readonly>
                    </div>

                    <!-- Input untuk Solusi -->
                    <div class="form-group">
                        <label for="solusi">Role</label>
                        <select class="form-control chosen" data-placeholder="Pilih Role" name="role" required>
                            <option value="<?php echo $row['role']; ?>"> <?php echo $row['role'] ?></option>
                            <option value="Dokter">Dokter</option>
                            <option value="Admin">Admin</option>
                            <option value="Pasien">Pasien</option>
                        </select>
                    </div>

                    <!-- Tombol untuk mengupdate data -->
                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <!-- Tombol untuk batal kembali ke halaman penyakit -->
                    <a class="btn btn-danger" href="?page=users">Batal</a>
                </div> 
            </div>
        </form>
    </div>
</div>

<?php
// Pastikan koneksi ditutup setelah selesai
$conn->close();
?>
