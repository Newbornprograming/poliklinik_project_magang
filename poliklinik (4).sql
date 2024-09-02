-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 11:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataobat`
--

CREATE TABLE `dataobat` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataobat`
--

INSERT INTO `dataobat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(1, 'Antasida DOEN I tablet kunyah, kombinasi ', 'ktk 10 x 10 tablet kunyah', 14000),
(2, 'Tiamin (Vitamin B1) tablet 50 mg (HCl/Nitrat)', 'btl 1000 tablet', 140000),
(5, 'Retinol (Vitamin A) 200.000 IU kapsul lunak', 'btl 50 kapsul lunak', 25000),
(7, 'Difenhidramin injeksi i.m 10 mg/ml/(HCI)', 'ktk 30 amp @ 1 ml', 36000),
(8, 'Epinefrin (adrenalin) injeksi 0,1 % (sebagai HCL)', 'ktk 30 amp @ 1 ml', 49000),
(11, 'Zink tablet 20 mg', 'ktk 10 x 10 tablet', 30000),
(12, 'ACT (Artesunate tablet 50 mg + Amodiaquine anhydri', '2 blister @ 12 tablet / kotak', 44000);

-- --------------------------------------------------------

--
-- Table structure for table `datapoli`
--

CREATE TABLE `datapoli` (
  `id` int(11) NOT NULL,
  `nama_poli` varchar(25) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datapoli`
--

INSERT INTO `datapoli` (`id`, `nama_poli`, `keterangan`) VALUES
(1, 'Umum', 'Menyediakan layanan pemeriksaan dan pengobatan untuk berbagai masalah kesehatan umum.'),
(2, 'Mata', 'Khusus menangani masalah kesehatan mata, seperti pemeriksaan mata, koreksi penglihatan, dan pengobatan penyakit mata'),
(3, 'Gigi', 'Menyediakan layanan pemeriksaan gigi, perawatan gigi, dan tindakan kedokteran gigi lainnya'),
(4, 'Hidung', 'Untuk Spesialist Hidung');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `id_poli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id`, `nama`, `alamat`, `no_hp`, `id_poli`) VALUES
(1, 'paza', 'Jalan jalan yuk', '08125367432', 1),
(19, 'Adi', 'jalan kalicari', '08125367423', 2),
(20, 'robert', 'jalan sebelah udinus', '08125367431', 3),
(21, 'matthew', 'JL Supriyadi', '0812345678', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jadwaldokter`
--

CREATE TABLE `jadwaldokter` (
  `id` int(11) NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `aktif` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwaldokter`
--

INSERT INTO `jadwaldokter` (`id`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `aktif`) VALUES
(1, 1, 'Senin', '15:00:00', '16:00:00', 'Y'),
(2, 19, 'Selasa', '15:00:00', '16:00:00', 'Y'),
(3, 20, 'Rabu', '15:00:00', '16:00:00', 'Y'),
(4, 21, 'Sabtu', '15:00:00', '16:00:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `keluhan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text DEFAULT NULL,
  `obat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'deny', '$2y$10$HMOhkc5MH4e14GAM54H2GuGQbgXRV779D.sKNMzrlqJs7hTBCWjRi'),
(2, 'baru', '$2y$10$darEfCk/jm7GLJH/N72p3ewyZ2KBP2XPOPatGKBaq1XiBSHP9k6Ci'),
(3, 'faza', '$2y$10$bY05W.k52AmFUdjW8ASbiuoeNw0dqyiJnIrVv0dU2s56bUjzt2snq'),
(4, 'baksoikan', '$2y$10$JdMZnQ8LZXuU5oyo4hD.YeTLnHmY9sIpfzNsQT1X/jn6Qxxed8sEm'),
(5, 'cicakpirang', '$2y$10$yR2xDqQGT3IV2eGKEc6wtOfvIckOyc8jMI6Sddh1brQHiy6agkThK'),
(6, 'udinus', '$2y$10$akRmkq/hceepKzpV9zUInu73Xh01e11aSmMgNhD/XDN4d8P1lM2j2'),
(7, 'webbengkod', '$2y$10$nFDzmkPUaM7CNQAXvmz.JehFJFjNS5H1RUtbPXbFSbLJ9ePgTeI2O'),
(8, 'batikraft', '$2y$10$dmPGPUpT9/Czr80OcsK1c.PY3luhA8Nkl2GLXHVVhXH.Z3V0TJQIW'),
(9, 'dinay', '$2y$10$TYyndE/2fL895xhzrAl4QOLqpG5yIqrPGdwHlpWhkpAVeRBKafg/a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datapoli`
--
ALTER TABLE `datapoli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokter_ibfk_1` (`id_poli`);

--
-- Indexes for table `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwalDokter_ibfk_1` (`id_dokter`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_ibfk_1` (`id_jadwal`),
  ADD KEY `pasien_ibfk_2` (`id_poli`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `periksa_ibfk_3` (`id_dokter`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`id_poli`) REFERENCES `datapoli` (`id`);

--
-- Constraints for table `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  ADD CONSTRAINT `jadwalDokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwaldokter` (`id`),
  ADD CONSTRAINT `pasien_ibfk_2` FOREIGN KEY (`id_poli`) REFERENCES `datapoli` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`),
  ADD CONSTRAINT `periksa_ibfk_3` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
