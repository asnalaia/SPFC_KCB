<?php
if (isset($_POST['simpan'])) {
    $nmpenyakit = trim($_POST['nmpenyakit']);

    if (empty($nmpenyakit)) {
        echo '<div class="alert alert-danger">Nama penyakit tidak boleh kosong!</div>';
    } else {
        // Validasi apakah penyakit sudah ada dalam basis aturan
        $sql = "SELECT basis_aturan.idaturan 
                FROM basis_aturan 
                INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit 
                WHERE penyakit.nmpenyakit = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nmpenyakit);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Data Basis aturan penyakit tersebut sudah ada!</strong>
                  </div>';
        } else {
            // Ambil data penyakit berdasarkan nama
            $sql = "SELECT * FROM penyakit WHERE nmpenyakit = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $nmpenyakit);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $idpenyakit = $row['idpenyakit'];

                // Proses simpan basis aturan
                $sql = "INSERT INTO basis_aturan (idpenyakit) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idpenyakit);

                if ($stmt->execute()) {
                    // Ambil ID aturan yang baru saja disimpan
                    $idaturan = $conn->insert_id;

                    // Proses simpan detail basis aturan
                    $idgejala = $_POST['idgejala'] ?? [];
                    if (!empty($idgejala)) {
                        $sql = "INSERT INTO detail_basis_aturan (idaturan, idgejala) VALUES (?, ?)";
                        $stmt = $conn->prepare($sql);

                        foreach ($idgejala as $idgejalane) {
                            $stmt->bind_param("ii", $idaturan, $idgejalane);
                            $stmt->execute();
                        }
                    }

                    header("Location:?page=aturan");
                    exit;
                } else {
                    echo '<div class="alert alert-danger">Gagal menyimpan data basis aturan!</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Penyakit tidak ditemukan!</div>';
            }
        }
    }
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card-header bg-primary text-white border-dark">
                    <strong>Tambah Data Basis Aturan</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nmpenyakit">Nama Penyakit</label>
                        <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nmpenyakit" required>
                            <option value="">Pilih Nama Penyakit</option>
                            <?php
                            $sql = "SELECT * FROM penyakit ORDER BY nmpenyakit ASC";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($row['nmpenyakit']) . '">' . htmlspecialchars($row['nmpenyakit']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Gejala-Gejala Berikut:</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="30px"></th>
                                    <th width="30px">No.</th>
                                    <th>Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                            <td align="center">
                                                <input type="checkbox" class="check-item" name="idgejala[]" value="' . htmlspecialchars($row['idgejala']) . '">
                                            </td>
                                            <td>' . $no++ . '</td>
                                            <td>' . htmlspecialchars($row['nmgejala']) . '</td>
                                          </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=aturan">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    function validasiForm() {
        var nmpenyakit = document.forms["Form"]["nmpenyakit"].value;

        if (nmpenyakit === "") {
            alert("Pilih nama penyakit");
            return false;
        }

        var checkbox = document.getElementsByName('idgejala[]');
        var isChecked = false;

        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            alert('Pilih setidaknya satu gejala!');
            return false;
        }

        return true;
    }
</script>
