<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis Aturan</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nmpenyakit">Nama Penyakit</label>
                        <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nmpenyakit">
                            <option value=""></option>
                            <?php
                                $sql = "SELECT * FROM penyakit ORDER BY nmpenyakit ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['idpenyakit']; ?>"><?php echo $row['nmpenyakit']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <!-- tabel data gejala -->
                    <div class="form group">
                        <label for="">Pilih gejala-gejala berikut: </label>
                        <table class="table table-bordered" >
                            <thead>
                            <tr>
                                <th width="30px"></th> 
                                <th width="30px">No.</th> 
                                <th width="700px">Nama Gejala
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=1;
                                    $sql = "SELECT*FROM gejala BY nmgejala Asc";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" name="" ></td>
                                        <td><?php echo $no++; ?> </td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                        
                                    </tr>
                                    <?php
                                        }
                                        $conn->close();
                                 ?>
                            </tbody>
                        </table>
                    </div>

                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=penyakit">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>