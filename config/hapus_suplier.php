<?php
include "koneksi.php";
$id = $_GET['id'];
$perintah = mysqli_query($koneksi, "delete from suplier where id_suplier='$id'");
if ($perintah) {
    echo "<script>alert('Berhasil')</script>";
} else {
    echo "<script>alert('Gagal')</script>";
}
echo "<meta http-equiv=refresh content=2;url=../page/data_suplier.php>";
