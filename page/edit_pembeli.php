<?php
error_reporting(0);
include "../partials/head.php";
include "../partials/sidebar.php";
include "../partials/navbar.php";
$id = $_GET['id'];
if (isset($_POST['simpan'])) {
    $id_pembeli = $_POST['id_pembeli'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $no_telp = $_POST['no_telp'];
    $query = mysqli_query($koneksi, "UPDATE pembeli SET nama_pembeli='$nama_pembeli', alamat='$alamat', jk='$jk', no_telp='$no_telp' where id_pembeli='$id_pembeli'");
    if ($query) {
        echo "<script>alert('Berhasil')</script>";
    } else {
        echo "<script>alert('Gagal')</script>";
    }

    echo "<meta http-equiv=refresh content=2;url=data_pembeli.php>";
}
$query = mysqli_query($koneksi, "select * from pembeli join tb_jk on pembeli.jk=tb_jk.id_jk where id_pembeli='$id'");
$baris = mysqli_fetch_array($query);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Data pembeli</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="edit_pembeli.php">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama pembeli</label>
                    <div class="col-sm-10">
                        <input type=hidden name=id_pembeli value="<?php echo "$baris[id_pembeli]"; ?>">
                        <input type="text" class="form-control" name="nama_pembeli" value="<?php echo "$baris[nama_pembeli]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="alamat"><?php echo "$baris[alamat]"; ?></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. HP</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="no_telp" value="<?php echo "$baris[no_telp]"; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select class="form-control" required name=jk>
                            <option value="<?php echo "$baris[id_jk]"; ?>"><?php echo "$baris[jk]"; ?></option>
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