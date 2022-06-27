<?php
error_reporting(0);
include "../partials/head.php";
include "../partials/sidebar.php";
include "../partials/navbar.php";
$id = $_GET['id'];
if (isset($_POST['simpan'])) {
    $id_suplier = $_POST['id_suplier'];
    $nama_suplier = $_POST['nama_suplier'];
    $alamat = $_POST['alamat'];
    $nama_perusahaan = $_POST['nama_perusahaan'];
    $no_hp = $_POST['no_hp'];
    $query = mysqli_query($koneksi, "UPDATE suplier SET nama_suplier='$nama_suplier', alamat='$alamat', nama_perusahaan='$nama_perusahaan', no_hp='$no_hp' where id_suplier='$id_suplier'");
    // "insert into suplier values ('','$nama_suplier','$alamat','$nama_perusahaan','$no_hp','$stok','$id_suplier')");
    if ($query) {
        echo "<script>alert('Berhasil')</script>";
    } else {
        echo "<script>alert('Gagal')</script>";
    }

    echo "<meta http-equiv=refresh content=2;url=data_suplier.php>";
}
$query = mysqli_query($koneksi, "select * from suplier where id_suplier='$id'");
$baris = mysqli_fetch_array($query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data suplier</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="edit_suplier.php">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama suplier</label>
                    <div class="col-sm-10">
                        <input type=hidden name=id_suplier value="<?php echo "$baris[id_suplier]"; ?>">
                        <input type="text" class="form-control" name="nama_suplier" value="<?php echo "$baris[nama_suplier]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="alamat"><?php echo "$baris[alamat]"; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Perusahaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo "$baris[nama_perusahaan]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. HP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="no_hp" value="<?php echo "$baris[no_hp]"; ?>">
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