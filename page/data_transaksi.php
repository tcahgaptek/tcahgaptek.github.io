<?php
include "../partials/head.php";
include "../partials/sidebar.php";
include "../partials/navbar.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Modal -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Data Transaksi Penjualan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nota</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $perintah = mysqli_query($koneksi, "SELECT a.no_transaksi, b.nama_pembeli, c.nama_barang, a.harga_barang, a.quantity, a.tgl_input FROM `transaksi` a
                        JOIN pembeli b ON b.id_pembeli=a.id_pembeli
                        JOIN barang c ON c.id_barang=a.id_barang");
                        $no = 1;
                        while ($baris = mysqli_fetch_array($perintah)) {
                        ?>
                            <tr>
                                <th scope='row'><?php echo $no++; ?></th>
                                <td><?php echo $baris['no_transaksi'] ?></td>
                                <td><?php echo $baris['nama_pembeli'] ?></td>
                                <td><?php echo $baris['nama_barang'] ?></td>
                                <td><?php echo $baris['harga_barang'] ?></td>
                                <td><?php echo $baris['quantity'] ?></td>
                                <td><?php echo $baris['tgl_input'] ?></td>
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