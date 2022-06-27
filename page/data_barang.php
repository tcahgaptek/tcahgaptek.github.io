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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="data_barang.php">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" required name="nama_barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga Beli</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="harga_beli">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga Jual</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="harga_jual">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" required name="stok">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Suplier</label>
                            <div class="col-sm-10">
                                <select class="form-control" required name=id_suplier>
                                    <option value=->Pilih Suplier</option>
                                    <?php
                                    include "koneksi.php";
                                    $perintah = mysqli_query($koneksi, "select * from suplier");
                                    while ($baris = mysqli_fetch_array($perintah)) {
                                        echo "<option value=$baris[id_suplier]>$baris[nama_suplier]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary" name=simpan>Save changes</button> -->
                            <input type=submit class="btn btn-primary" name=simpan value=SIMPAN>
                        </div>

                    </form>
                    <?php
                    if (isset($_POST['simpan'])) {
                        $nama_barang = $_POST['nama_barang'];
                        $deskripsi = $_POST['deskripsi'];
                        $harga_beli = $_POST['harga_beli'];
                        $harga_jual = $_POST['harga_jual'];
                        $stok = $_POST['stok'];
                        $id_suplier = $_POST['id_suplier'];
                        $query = mysqli_query($koneksi, "insert into barang values ('','$nama_barang','$deskripsi','$harga_beli','$harga_jual','$stok','$id_suplier')");
                        if ($query) {
                            echo "<script>alert('Berhasil')</script>";
                        } else {
                            echo "<script>alert('Gagal')</script>";
                        }
                        echo "<meta http-equiv=refresh content=2;url=data_barang.php>";
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
                Tambah Barang
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Nama Suplier</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $perintah = mysqli_query($koneksi, "select * from barang join suplier on barang.id_suplier=suplier.id_suplier");
                        $no = 1;
                        while ($baris = mysqli_fetch_array($perintah)) {
                        ?>
                            <tr>
                                <th scope='row'><?php echo $no++; ?></th>
                                <td><?php echo $baris['nama_barang'] ?></td>
                                <td><?php echo $baris['harga_jual'] ?></td>
                                <td><?php echo $baris['stok'] ?></td>
                                <td><?php echo $baris['nama_suplier'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href='edit_barang.php?id=<?php echo $baris['id_barang'] ?>'><i class='fas fa-edit'></i></a>
                                    <a class="btn btn-primary" href='index.php'><i class='fas fa-info'></i></a>
                                    <a class="btn btn-danger" href='../config/hapus_barang.php?id=<?php echo $baris['id_barang'] ?>' onclick="javascript:return confirm('Hapus Data Barang ?');">

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