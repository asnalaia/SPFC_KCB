<?php 
// Validasi input idaturan
$idaturan = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idaturan > 0) {
    // Query untuk mendapatkan data penyakit
    $sql = "SELECT 
                basis_aturan.idaturan, 
                basis_aturan.idpenyakit, 
                penyakit.nmpenyakit, 
                penyakit.keterangan 
            FROM 
                basis_aturan 
            INNER JOIN 
                penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit 
            WHERE 
                basis_aturan.idaturan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idaturan);
    $stmt->execute();
    $result = $stmt->get_result();

    // Validasi hasil query
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = [
            'nmpenyakit' => 'Data tidak ditemukan',
            'keterangan' => 'Data tidak ditemukan',
        ];
    }

    // Query untuk mendapatkan gejala
    $sql_gejala = "SELECT 
                       detail_basis_aturan.idgejala, 
                       gejala.nmgejala 
                   FROM 
                       detail_basis_aturan
                   INNER JOIN 
                       gejala ON detail_basis_aturan.idgejala = gejala.idgejala 
                   WHERE 
                       detail_basis_aturan.idaturan = ?";
    $stmt_gejala = $conn->prepare($sql_gejala);
    $stmt_gejala->bind_param("i", $idaturan);
    $stmt_gejala->execute();
    $result_gejala = $stmt_gejala->get_result();
} else {
    $row = [
        'nmpenyakit' => 'Invalid ID',
        'keterangan' => 'Invalid ID',
    ];
    $result_gejala = false;
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark">
                        <strong>Detail Halaman Basis Aturan</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Penyakit</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="nama" 
                                id="nama" 
                                value="<?php echo htmlspecialchars($row['nmpenyakit']); ?>" 
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea 
                                class="form-control" 
                                name="ket" 
                                id="keterangan" 
                                readonly><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
                        </div>
                    </div>

                    <label for="">Gejala-gejala Penyakit:</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="40px">No.</th>
                                <th width="700px">Nama Gejala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result_gejala && $result_gejala->num_rows > 0): ?>
                                <?php 
                                $no = 1;
                                while ($gejala = $result_gejala->fetch_assoc()): 
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($gejala['nmgejala']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada gejala ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="card-footer">
                        <a class="btn btn-danger" href="?page=aturan">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
