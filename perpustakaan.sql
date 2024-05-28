-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2024 at 04:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_anggota`
--

CREATE TABLE `data_anggota` (
  `nim` int(255) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_anggota`
--

INSERT INTO `data_anggota` (`nim`, `nama_anggota`, `jenis_kelamin`) VALUES
(1212, 'jojosss', 'Laki-laki'),
(231431, 'sandy', 'Perempuan'),
(242343, 'patrick', 'Laki-laki'),
(1231231, 'ms puff', 'Perempuan'),
(1231312, 'Louisiana', 'Laki-laki'),
(124312432, 'Piccolo', 'Laki-laki'),
(2147483647, 'asdasdad', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` int(11) NOT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `isbn`, `judul`, `penulis`, `penerbit`, `tahun`) VALUES
(3, '103013012', 'dragon ball', 'Akira Toriyama', 'Vix Media', 1986),
(6, '9781454926221', 'The Computer Book: From the Abacus to Artificial Intelligence, 250 Milestones in the History of Computer Science', 'Simson L Garfinkel, Rachel H. Grunspan', 'Union Square + ORM', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('&lt;body&gt;', '$2y$10$T/83icHGK4pwjDJJuDKrruFOqLqHg9EivZPMgxImQwfNX2F6PBFkC'),
('&lt;script&gt;', '$2y$10$g30z1hixCmuAXu2mcD0BsevCqip9cS8j/zKKZ1ait3STV10V.8vNG'),
('admin', '$2y$10$CIMDgVvrIE097y5oNmtCaOg/drCH0x2GUBGCRlKYjca8VVRi59/Ry'),
('dua', '$2y$10$rFuDXWWsbt6PH9HRGgtbjeGxU0qXtt2chLq.CvO0RZoPuUycn8.5e'),
('satu', '$2y$10$2/pdIqL0yBIrOmnBoT25su7J4utWVyJdn2CzPz5wywJ/U2xh9Y9um');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
