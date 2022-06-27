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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pembeli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="data_pembeli.php">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Pembeli</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="nama_pembeli">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name=jk>
                                    <option value=-></option>
                                    <?php
                                    include "koneksi.php";
                                    $perintah = mysqli_query($koneksi, "select * from tb_jk");
                                    while ($baris = mysqli_fetch_array($perintah)) {
                                        echo "<option value=$baris[id_jk]>$baris[jk]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No. HP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="no_telp">
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
                        $nama_pembeli = $_POST['nama_pembeli'];
                        $no_telp = $_POST['no_telp'];
                        $alamat = $_POST['alamat'];
                        $jk = $_POST['jk'];
                        $query = mysqli_query($koneksi, "insert into pembeli values ('','$nama_pembeli','$jk','$no_telp','$alamat')");
                        if ($query) {
                            echo "<script>alert('Berhasil')</script>";
                        } else {
                            echo "<script>alert('Gagal')</script>";
                        }
                        echo "<meta http-equiv=refresh content=2;url=data_pembeli.php>";
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
                Tambah pembeli
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama pembeli</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No. HP</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $perintah = mysqli_query($koneksi, "select * from pembeli join tb_jk on pembeli.jk=tb_jk.id_jk ");
                        $no = 1;
                        while ($baris = mysqli_fetch_array($perintah)) {
                        ?>
                            <tr>
                                <th scope='row'><?php echo $no++; ?></th>
                                <td><?php echo $baris['nama_pembeli'] ?></td>
                                <td><?php echo $baris['jk'] ?></td>
                                <td><?php echo $baris['alamat'] ?></td>
                                <td><?php echo $baris['no_telp'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href='edit_pembeli.php?id=<?php echo $baris['id_pembeli'] ?>'><i class='fas fa-edit'></i></a>
                                    <a class="btn btn-danger" href='../config/hapus_pembeli.php?id=<?php echo $baris['id_pembeli'] ?>' onclick="javascript:return confirm('Hapus Data pembeli ?');">

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