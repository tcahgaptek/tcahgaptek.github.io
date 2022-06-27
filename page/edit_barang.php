<?php
error_reporting(0);
include "../partials/head.php";
include "../partials/sidebar.php";
include "../partials/navbar.php";
$id = $_GET['id'];
if (isset($_POST['simpan'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $id_suplier = $_POST['id_suplier'];
    $query = mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama_barang', deskripsi='$deskripsi', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok', id_suplier='$id_suplier' where id_barang='$id_barang'");
    // "insert into barang values ('','$nama_barang','$deskripsi','$harga_beli','$harga_jual','$stok','$id_suplier')");
    if ($query) {
        echo "<script>alert('Berhasil')</script>";
    } else {
        echo "<script>alert('Gagal')</script>";
    }

    echo "<meta http-equiv=refresh content=2;url=data_barang.php>";
}
$query = mysqli_query($koneksi, "select * from barang as b join suplier as s on b.id_suplier=s.id_suplier where id_barang='$id'");
$baris = mysqli_fetch_array($query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data Barang</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="edit_barang.php">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type=hidden name=id_barang value="<?php echo "$baris[id_barang]"; ?>">
                        <input type="text" class="form-control" name="nama_barang" value="<?php echo "$baris[nama_barang]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="deskripsi"><?php echo "$baris[deskripsi]"; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Beli</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_beli" value="<?php echo "$baris[harga_beli]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Jual</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_jual" value="<?php echo "$baris[harga_jual]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="stok" value="<?php echo "$baris[stok]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Suplier</label>
                    <div class="col-sm-10">
                        <select class="form-control" name=id_suplier>
                            <option value="<?php echo "$baris[id_suplier]"; ?>"><?php echo "$baris[nama_suplier]"; ?></option>
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
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type=submit class="btn btn-primary" name=simpan value=SIMPAN>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php
include "../partials/footer.php";
?>