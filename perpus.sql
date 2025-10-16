-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 10:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `kode_buku` int(11) NOT NULL,
  `judul_buku` varchar(200) NOT NULL,
  `penulis_buku` varchar(150) DEFAULT NULL,
  `penerbit_buku` varchar(150) DEFAULT NULL,
  `sinopsis_buku` text DEFAULT NULL,
  `stok_buku` int(11) DEFAULT 0,
  `id_lembaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul_buku`, `penulis_buku`, `penerbit_buku`, `sinopsis_buku`, `stok_buku`, `id_lembaga`) VALUES
(25, 'Pemrograman Dasar', 'Andi Nugroho', 'Erlangga', 'Buku pengantar dasar pemrograman untuk pemula.', 10, 3),
(26, 'Matematika Lanjut', 'Budi Santoso', 'Gramedia', 'Pembahasan konsep matematika tingkat lanjut.', 7, 1),
(27, 'Basis Data', 'Citra Dewi', 'Informatika', 'Dasar-dasar sistem basis data dan implementasinya.', 5, 2),
(28, 'Jaringan Komputer', 'Dewi Lestari', 'Salemba', 'Konsep jaringan komputer modern dan praktikum.', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lembaga`
--

CREATE TABLE `lembaga` (
  `id_lembaga` int(11) NOT NULL,
  `nama_lembaga` varchar(150) NOT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lembaga`
--

INSERT INTO `lembaga` (`id_lembaga`, `nama_lembaga`, `alamat`, `email`) VALUES
(1, 'sasi', 'Jl. Merdeka No.10', 'sasi@gmail.com'),
(2, 'gatsu', 'Jl. Pendidikan No.45', 'gatsu@gmail.com'),
(3, 'Perpustakaan SD ujung', 'Jl. pantura lama', 'ujung@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `email_peminjam` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lembaga_pendidikan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `nama_peminjam`, `email_peminjam`, `password`, `nama_lembaga_pendidikan`) VALUES
(1, 'diva prancis', 'div@gmail.com', '123', 'sasi'),
(2, 'liyah', 'li@gmail.com', '456', 'gatsu');

-- --------------------------------------------------------

--
-- Table structure for table `staf_perpus`
--

CREATE TABLE `staf_perpus` (
  `nip` int(11) NOT NULL,
  `nama_staf` varchar(100) NOT NULL,
  `email_staf` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lembaga_pendidikan` varchar(150) DEFAULT NULL,
  `id_lembaga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staf_perpus`
--

INSERT INTO `staf_perpus` (`nip`, `nama_staf`, `email_staf`, `password`, `nama_lembaga_pendidikan`, `id_lembaga`) VALUES
(1, 'Arfa Zulhilmi', 'a@gmail.com', '11', 'Politeknik Indramayu', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kode_buku`),
  ADD KEY `id_lembaga` (`id_lembaga`);

--
-- Indexes for table `lembaga`
--
ALTER TABLE `lembaga`
  ADD PRIMARY KEY (`id_lembaga`);

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id_peminjam`),
  ADD UNIQUE KEY `email_peminjam` (`email_peminjam`);

--
-- Indexes for table `staf_perpus`
--
ALTER TABLE `staf_perpus`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `email_staf` (`email_staf`),
  ADD KEY `id_lembaga` (`id_lembaga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `kode_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lembaga`
--
ALTER TABLE `lembaga`
  MODIFY `id_lembaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staf_perpus`
--
ALTER TABLE `staf_perpus`
  MODIFY `nip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`);

--
-- Constraints for table `staf_perpus`
--
ALTER TABLE `staf_perpus`
  ADD CONSTRAINT `staf_perpus_ibfk_1` FOREIGN KEY (`id_lembaga`) REFERENCES `lembaga` (`id_lembaga`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
