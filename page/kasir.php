<?php
include "../partials/head.php";
include "../partials/sidebar.php";
include "../partials/navbar.php";
$barang = mysqli_query($koneksi, "SELECT * FROM barang");
$jsArray = "var harga_jual = new Array();";
$jsArray1 = "var nama_barang = new Array();";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">

        <div class="col-lg-6">

            <!-- Circle Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Transaksi</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="tgl_input" value="<?php echo  date("j F Y"); ?>" readonly>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Pembeli</b></label>
                            <div class="col-sm-8 mb-2">
                                <select c class="form-control form-control-sm" name=pembeli>
                                    <option value=-></option>
                                    <?php
                                    include "koneksi.php";
                                    $perintah = mysqli_query($koneksi, "select * from pembeli");
                                    while ($baris = mysqli_fetch_array($perintah)) {
                                        echo "<option value=$baris[id_pembeli]>$baris[nama_pembeli]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kode Barang</b></label>
                            <div class="col-sm-8 mb-2">
                                <div class="input-group">
                                    <input type="text" name="id_barang" class="form-control form-control-sm border-right-0" list="datalist1" onchange="changeValue(this.value)" aria-describedby="basic-addon2" required>
                                    <datalist id="datalist1">
                                        <?php if (mysqli_num_rows($barang)) { ?>
                                            <?php while ($row_brg = mysqli_fetch_array($barang)) { ?>
                                                <option value="<?php echo $row_brg["id_barang"] ?>"> <?php echo $row_brg["nama_barang"] ?>
                                                <?php $jsArray .= "harga_jual['" . $row_brg['id_barang'] . "'] = {harga_jual:'" . addslashes($row_brg['harga_jual']) . "'};";
                                                $jsArray1 .= "nama_barang['" . $row_brg['id_barang'] . "'] = {nama_barang:'" . addslashes($row_brg['nama_barang']) . "'};";
                                            } ?>
                                            <?php } ?>
                                    </datalist>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-white border-left-0" id="basic-addon2" style="border-radius:0px 15px 15px 0px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                                <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                            </svg></span>
                                    </div>
                                </div>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Barang</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="text" class="form-control form-control-sm" name="nama_barang" id="nama_barang" readonly>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="number" class="form-control form-control-sm" id="harga_jual" onchange="total()" value="<?php echo $row['harga_jual']; ?>" name="harga_jual" readonly>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Quantity</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="number" class="form-control form-control-sm" id="quantity" onchange="total()" name="quantity" placeholder="0" required>
                            </div>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Sub-Total</b></label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="subtotal" name="subtotal" onchange="total()" name="sub_total" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-purple btn-sm" name="save" value="simpan" type="submit">
                                            <i class="fa fa-plus mr-2"></i>Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['save'])) {
                        $idb = $_POST['id_barang'];
                        $nama = $_POST['nama_barang'];
                        $harga = $_POST['harga_jual'];
                        $qty = $_POST['quantity'];
                        $total = $_POST['subtotal'];
                        $tgl = $_POST['tgl_input'];
                        $pembeli = $_POST['pembeli'];
                        $query = mysqli_query($koneksi, "INSERT INTO keranjang
                        VALUES('', '$pembeli','$idb','$nama','$harga','$qty','$total','$tgl','','','')");
                    } ?>
                    <hr>
                    <form method="POST">
                        <div class="form-group row mb-0">
                            <input type="hidden" class="form-control" name="no_transaksi" value="TRA<?php echo date("jmYGi"); ?>" readonly>
                            <input type="hidden" class="form-control" value="<?php echo $tot_bayar; ?>" id="hargatotal" readonly>
                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Bayar</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="number" class="form-control form-control-sm" name="bayar" id="bayarnya" onchange="totalnya()">
                            </div>
                            <!-- <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kembali</b></label>
                            <div class="col-sm-8 mb-2">
                                <input type="number" class="form-control form-control-sm" name="kembalian" id="total1" readonly>
                            </div> -->
                        </div>
                        <div class="text-right">
                            <button class="btn btn-purple btn-sm" name="save1" value="simpan" type="submit">
                                <i class="fa fa-shopping-cart mr-2"></i>Bayar</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['save1'])) {
                        $notrans = $_POST['no_transaksi'];
                        $bayar = $_POST['bayar'];
                        $total = $r['harga_barang'] * $r['quantity'];
                        $tot_bayar += $total;
                        $kembali = $bayar - $tot_bayar;
                        $sql = "UPDATE keranjang SET no_transaksi='$notrans',bayar='$bayar',kembalian='$kembali' ";
                        $query = mysqli_query($koneksi, $sql);
                        echo '<script>window.location="kasir.php"</script>';
                    } ?>
                </div>
            </div>

        </div>

        <div class="col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rincian Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="card" id="print">
                        <div class="card-header bg-white border-0 pb-0 pt-4">
                            <h5 class='card-tittle mb-0 text-center'>
                                <div class="sidebar-brand-icon rotate-n-15">
                                    <i class="fas fa-fw fa-shopping-bag"></i>
                                </div><b>Toko<sup>5758</sup></b>
                            </h5>
                            <p class='m-0 small text-center'>Jl. KH. Ahmad Dahlan No.56 Kec. Kembaran Kab. Banyumas</p>
                            <p class='small text-center'>Telp. 0851 5690 4983</p>
                            <div class="row">
                                <div class="col-8 col-sm-9 pr-0">
                                    <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                                        <!-- <li>NOTA : </li> -->
                                        <li>KASIR : <?php echo $_SESSION['username']; ?></li>
                                    </ul>
                                </div>
                                <div class="col-4 col-sm-3 pl-0">
                                    <ul class="pl-0 small" style="list-style: none;">
                                        <li>TGL : <?php echo  date("j-m-Y"); ?></li>
                                        <li>JAM : <?php echo  date("G:i:s"); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body small pt-0">
                            <hr class="mt-0">
                            <div class="row">
                                <div class="col-5 pr-0">
                                    <span><b>Nama Barang</b></span>
                                </div>
                                <div class="col-1 px-0 text-center">
                                    <span><b>Qty</b></span>
                                </div>
                                <div class="col-3 px-0 text-right">
                                    <span><b>Harga</b></span>
                                </div>
                                <div class="col-3 pl-0 text-right">
                                    <span><b>Subtotal</b></span>
                                </div>
                                <div class="col-12">
                                    <hr class="mt-2">
                                </div>
                                <div class="col-12">
                                    <hr class="mt-2">
                                </div>
                                <?php
                                error_reporting(0);
                                if (!empty($_GET['id'])) {
                                    $id = $_GET['id'];
                                    $hapus_data = mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_keranjang ='$id'");
                                    echo '<script>window.location="kasir.php"</script>';
                                }

                                ?>
                                <?php
                                $data_barang = mysqli_query($koneksi, "SELECT * FROM keranjang");
                                while ($d = mysqli_fetch_array($data_barang)) {
                                ?>
                                    <div class="col-5 pr-0">
                                        <a href="?id=<?php echo $d['id_keranjang']; ?>" onclick="javascript:return confirm('Hapus Data Barang ?');" style="text-decoration:none;">
                                            <i class="fa fa-times fa-xs text-danger mr-1"></i>
                                            <span class="text-dark"><?php echo $d['nama_barang']; ?></span>
                                        </a>
                                    </div>
                                    <div class="col-1 px-0 text-center">
                                        <span><?php echo $d['quantity']; ?></span>
                                    </div>
                                    <div class="col-3 px-0 text-right">
                                        <span><?php echo $d['harga_barang']; ?></span>
                                    </div>
                                    <div class="col-3 pl-0 text-right">
                                        <span><?php echo $d['subtotal']; ?></span>
                                    </div>
                                <?php } ?>
                                <div class="col-12">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM keranjang");
                                    $total = 0;
                                    $tot_bayar = 0;
                                    $no = 1;
                                    while ($r = $query->fetch_assoc()) {
                                        $total = $r['harga_barang'] * $r['quantity'];
                                        $tot_bayar += $total;
                                        $bayar = $r['bayar'];
                                        $kembalian = $bayar - $tot_bayar;
                                    }
                                    error_reporting(0);
                                    ?>
                                    <hr class="mt-2">
                                    <ul class="list-group border-0">
                                        <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                            <b>Total</b>
                                            <span><b><?php echo $tot_bayar; ?></b></span>
                                        </li>
                                        <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                            <b>Bayar</b>
                                            <span><b><?php echo $bayar; ?></b></span>
                                        </li>
                                        <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                            <b>Kembalian</b>
                                            <span><b><?php echo $kembalian; ?></b></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 mt-3 text-center">
                                    <p>TERIMA KASIH TELAH BERBELANJA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <form method="POST">
                            <button class="btn btn-purple-light btn-sm mr-2" onclick="printContent('print')"><i class="fa fa-print mr-1"></i> Cetak</button>
                            <button class="btn btn-purple btn-sm" name="selesai" type="submit"><i class="fa fa-check mr-1"></i> Selesai</button>
                        </form>
                    </div>
                    <?php
                    if (isset($_POST['selesai'])) {
                        $ambildata = mysqli_query($koneksi, "INSERT INTO transaksi (id_keranjang,id_pembeli,id_barang,nama_barang,harga_barang,quantity,subtotal,tgl_input,no_transaksi,bayar,kembalian)
                SELECT id_keranjang,id_pembeli,id_barang,nama_barang,harga_barang,quantity,subtotal,tgl_input,no_transaksi,bayar,kembalian
                FROM keranjang ") or die(mysqli_connect_error());
                        $hapusdata = mysqli_query($koneksi, "DELETE FROM keranjang");
                        echo '<script>window.location="index.php"</script>';
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- /.container-fluid -->
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script type="text/javascript">
    <?php echo $jsArray; ?>
    <?php echo $jsArray1; ?>

    function changeValue(id_barang) {
        document.getElementById("nama_barang").value = nama_barang[id_barang].nama_barang;
        document.getElementById("harga_jual").value = harga_jual[id_barang].harga_jual;
    };

    function total() {
        var harga = parseInt(document.getElementById('harga_jual').value);
        var jumlah_beli = parseInt(document.getElementById('quantity').value);
        var jumlah_harga = harga * jumlah_beli;
        document.getElementById('subtotal').value = jumlah_harga;
    }

    function totalnya() {
        var harga = parseInt(document.getElementById('hargatotal').value);
        var pembayaran = parseInt(document.getElementById('bayarnya').value);
        var kembali = pembayaran - harga;
        document.getElementById('total1').value = kembali;
    }

    function printContent(print) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(print).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<?php
include "../partials/footer.php";
?>