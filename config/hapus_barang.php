<?php
include "koneksi.php";
$id = $_GET['id'];
$perintah = mysqli_query($koneksi, "delete from barang where id_barang='$id'");
if ($perintah) {
    echo "<script>alert('Barang berhasil dihapus')</script>";
} else {
    echo "<script>alert('Barang gagal dihapus')</script>";
}
echo "<meta http-equiv=refresh content=2;url=../page/data_barang.php>";
