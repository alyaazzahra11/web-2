-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2025 at 06:02 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkegiatan_dosen`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_ilmu`
--

CREATE TABLE `bidang_ilmu` (
  `id` int NOT NULL,
  `nama` varchar(45) NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bidang_ilmu`
--

INSERT INTO `bidang_ilmu` (`id`, `nama`, `deskripsi`) VALUES
(1, 'Kecerdasan Buatan', 'Penelitian bidang AI'),
(2, 'Sistem Informasi', 'Penelitian SI'),
(3, 'Data Science', 'Penelitian Data');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `gelar_belakang` varchar(30) DEFAULT NULL,
  `gelar_depan` varchar(30) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(45) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `tahun_masuk` int DEFAULT NULL,
  `prodi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama`, `gelar_belakang`, `gelar_depan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `tahun_masuk`, `prodi_id`) VALUES
(1, '0012345678', 'Budi Santoso', 'M.Kom', 'Dr.', 'L', 'Bandung', '1980-03-12', 'Jl. Cendana 1', 'budi@univ.ac.id', 2005, 1),
(2, '0012345679', 'Siti Aminah', 'M.T', 'Dr.', 'P', 'Jakarta', '1982-05-22', 'Jl. Kenanga 2', 'siti@univ.ac.id', 2007, 2),
(3, '0012345680', 'Dewi Lestari', 'Ph.D', 'Prof.', 'P', 'Surabaya', '1978-01-10', 'Jl. Melati 5', 'dewi@univ.ac.id', 2003, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dosen_kegiatan`
--

CREATE TABLE `dosen_kegiatan` (
  `dosen_id` int NOT NULL,
  `kegiatan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dosen_kegiatan`
--

INSERT INTO `dosen_kegiatan` (`dosen_id`, `kegiatan_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `id` int NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis_kegiatan`
--

INSERT INTO `jenis_kegiatan` (`id`, `nama`) VALUES
(1, 'Seminar Nasional'),
(2, 'Workshop'),
(3, 'Pelatihan'),
(4, 'Kuliah Tamu');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `tempat` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `jenis_kegiatan_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `tanggal_mulai`, `tanggal_selesai`, `tempat`, `deskripsi`, `jenis_kegiatan_id`) VALUES
(1, '2023-01-10', '2023-01-11', 'Hotel Grand', 'Seminar AI Nasional', 1),
(2, '2023-02-05', '2023-02-07', 'Aula Kampus', 'Pelatihan Data Science', 3),
(3, '2023-03-15', '2023-03-15', 'Gedung Rektorat', 'Kuliah Tamu Prof. Tanaka', 4);

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE `penelitian` (
  `id` int NOT NULL,
  `judul` text NOT NULL,
  `mulai` date DEFAULT NULL,
  `akhir` date DEFAULT NULL,
  `tahun_ajaran` varchar(45) DEFAULT NULL,
  `bidang_ilmu_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id`, `judul`, `mulai`, `akhir`, `tahun_ajaran`, `bidang_ilmu_id`) VALUES
(1, 'Penerapan AI untuk Prediksi Cuaca', '2023-01-01', '2023-12-31', '2022/2023', 1),
(2, 'Sistem Informasi Akademik Berbasis Web', '2022-05-01', '2022-12-01', '2021/2022', 2),
(3, 'Analisis Big Data di Sektor Kesehatan', '2023-06-01', '2024-06-01', '2023/2024', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` int NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `ketua` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `kode`, `nama`, `alamat`, `telpon`, `ketua`) VALUES
(1, 'TI', 'Teknik Informatika', 'Jl. Merdeka 10', '08123456789', 'Dr. Andi'),
(2, 'SI', 'Sistem Informasi', 'Jl. Proklamasi 21', '08123456780', 'Dr. Siti');

-- --------------------------------------------------------

--
-- Table structure for table `tim_penelitian`
--

CREATE TABLE `tim_penelitian` (
  `dosen_id` int NOT NULL,
  `penelitian_id` int NOT NULL,
  `peran` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tim_penelitian`
--

INSERT INTO `tim_penelitian` (`dosen_id`, `penelitian_id`, `peran`) VALUES
(1, 1, 'Ketua'),
(1, 3, 'Anggota'),
(2, 1, 'Anggota'),
(2, 2, 'Ketua'),
(3, 3, 'Ketua');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nidn` (`nidn`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `dosen_kegiatan`
--
ALTER TABLE `dosen_kegiatan`
  ADD PRIMARY KEY (`dosen_id`,`kegiatan_id`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_kegiatan_id` (`jenis_kegiatan_id`);

--
-- Indexes for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidang_ilmu_id` (`bidang_ilmu_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_penelitian`
--
ALTER TABLE `tim_penelitian`
  ADD PRIMARY KEY (`dosen_id`,`penelitian_id`),
  ADD KEY `penelitian_id` (`penelitian_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_ilmu`
--
ALTER TABLE `bidang_ilmu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penelitian`
--
ALTER TABLE `penelitian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dosen_kegiatan`
--
ALTER TABLE `dosen_kegiatan`
  ADD CONSTRAINT `dosen_kegiatan_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dosen_kegiatan_ibfk_2` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_ibfk_1` FOREIGN KEY (`jenis_kegiatan_id`) REFERENCES `jenis_kegiatan` (`id`);

--
-- Constraints for table `penelitian`
--
ALTER TABLE `penelitian`
  ADD CONSTRAINT `penelitian_ibfk_1` FOREIGN KEY (`bidang_ilmu_id`) REFERENCES `bidang_ilmu` (`id`);

--
-- Constraints for table `tim_penelitian`
--
ALTER TABLE `tim_penelitian`
  ADD CONSTRAINT `tim_penelitian_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tim_penelitian_ibfk_2` FOREIGN KEY (`penelitian_id`) REFERENCES `penelitian` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
