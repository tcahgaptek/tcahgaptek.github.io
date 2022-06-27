-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2022 at 04:48 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_toko5758`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_suplier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `deskripsi`, `harga_beli`, `harga_jual`, `stok`, `id_suplier`) VALUES
(1, 'Shampoo Pantene', 'Mantap', 2000, 2100, 10, 1),
(11, 'Mendoan', 'ad', 200, 250, 12, 1),
(12, 'sosis kecil', 's', 500, 600, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `kembalian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL,
  `jk` char(1) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `jk`, `no_telp`, `alamat`) VALUES
(0, 'Non Member', 'L', '123456789', 'Arcawinangun'),
(1, 'Syabil', 'L', '085329918811', 'Cilacap');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `namalengkap` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `namalengkap`, `username`, `password`, `level`) VALUES
(1, 'Rudi Aditia', 'admin', 'admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id_suplier` int(11) NOT NULL,
  `nama_suplier` varchar(50) DEFAULT NULL,
  `no_hp` char(13) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `nama_perusahaan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_suplier`, `no_hp`, `alamat`, `nama_perusahaan`) VALUES
(1, 'Rudi Aditia', '085156904983', 'Kroya', 'Wings'),
(3, 'Wiwin Widiastuti', '085156904983', 'Jl. Perkutut Rt02/07 Desa Bajing Kulon\r\nKecamatan Kroya Kabupaten Cilacap', 'Sonice');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jk`
--

CREATE TABLE `tb_jk` (
  `id_jk` varchar(1) NOT NULL,
  `jk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jk`
--

INSERT INTO `tb_jk` (`id_jk`, `jk`) VALUES
('L', 'Laki-laki'),
('P', 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `bayar` varchar(255) NOT NULL,
  `kembalian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_keranjang`, `id_pembeli`, `id_barang`, `nama_barang`, `harga_barang`, `quantity`, `subtotal`, `tgl_input`, `no_transaksi`, `bayar`, `kembalian`) VALUES
(118, 1, 11, 'Mendoan', 250, 11, '2750', '9 June 2022', 'TRA90620221330', '12000', '12000'),
(119, 1, 1, 'Shampoo Pantene', 2100, 1, '2100', '10 June 2022', 'TRA10062022258', '10000', '10000'),
(120, 0, 1, 'Shampoo Pantene', 2100, 1, '2100', '10 June 2022', 'TRA10062022304', '2500', '2500'),
(121, 0, 1, 'Shampoo Pantene', 2100, 5, '10500', '10 June 2022', 'TRA10062022322', '20000', '20000'),
(122, 0, 12, 'sosis kecil', 600, 10, '6000', '10 June 2022', 'TRA10062022322', '20000', '20000'),
(123, 0, 1, 'Shampoo Pantene', 2100, 1212, '2545200', '27 June 2022', 'TRA270620221648', '10000000', '10000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `suplier` (`id_suplier`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `transaksi` (`id_transaksi`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `suplier` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id_suplier`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
