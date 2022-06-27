<?php
include "../partials/head.php";
include "../partials/sidebar.php";
include "../partials/navbar.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Suplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="data_suplier.php">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Suplier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="nama_suplier">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="nama_perusahaan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No. HP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="no_hp">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <!-- <button type="button" class="btn btn-primary" name=simpan>Save changes</button> -->
                            <input type=submit class="btn btn-primary" name=simpan value=SIMPAN>
                        </div>

                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $nama_suplier = $_POST['nama_suplier'];
                        $no_hp = $_POST['no_hp'];
                        $alamat = $_POST['alamat'];
                        $nama_perusahaan = $_POST['nama_perusahaan'];
                        $query = mysqli_query($koneksi, "insert into suplier values ('','$nama_suplier','$no_hp','$alamat','$nama_perusahaan')");
                        if ($query) {
                            echo "<script>alert('Berhasil')</script>";
                        } else {
                            echo "<script>alert('Gagal')</script>";
                        }
                        echo "<meta http-equiv=refresh content=2;url=data_suplier.php>";
                    }

                    ?>
                </div>

            </div>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah suplier
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Suplier</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">No. HP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $perintah = mysqli_query($koneksi, "select * from suplier");
                        $no = 1;
                        while ($baris = mysqli_fetch_array($perintah)) {
                        ?>
                            <tr>
                                <th scope='row'><?php echo $no++; ?></th>
                                <td><?php echo $baris['nama_suplier'] ?></td>
                                <td><?php echo $baris['alamat'] ?></td>
                                <td><?php echo $baris['nama_perusahaan'] ?></td>
                                <td><?php echo $baris['no_hp'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href='edit_suplier.php?id=<?php echo $baris['id_suplier'] ?>'><i class='fas fa-edit'></i></a>
                                    <a class="btn btn-danger" href='../config/hapus_suplier.php?id=<?php echo $baris['id_suplier'] ?>' onclick="javascript:return confirm('Hapus Data suplier ?');">

                                        <i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php
include "../partials/footer.php";
?>