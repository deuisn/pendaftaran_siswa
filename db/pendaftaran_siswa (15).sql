-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Mar 2024 pada 06.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_siswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `notif`
--

CREATE TABLE `notif` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `nilai_un` double NOT NULL,
  `nilai_us` double NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `users_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `nama`, `tmpt_lahir`, `tgl_lahir`, `jns_kelamin`, `agama`, `jurusan`, `alamat`, `email`, `nilai_un`, `nilai_us`, `telepon`, `users_id`, `status`, `waktu`) VALUES
(33, 'deuis', 'bandung', '2024-02-02', 'Perempuan', 'Islam', 'RPL', 'bojong', 'deuis@gmail.com', 100, 100, '093820020185', 42, 'LOLOS', '2024-02-28 09:24:08'),
(42, 'deuis n', 'Bandung', '2024-02-10', 'Perempuan', 'Islam', 'ATPH', 'bjg', 'deuisn@gmail.com', 100, 100, '008674532311', 51, 'TIDAK LOLOS', '2024-02-28 09:24:08'),
(45, 'Deuis Nurhalizah', 'Bandung', '2024-02-02', 'Perempuan', 'Hindu', 'RPL', 'b', 'deuisnurhalizah@gmail.com', 100, 100, '08328329892', 54, 'Baru', '2024-02-28 09:24:08'),
(46, 'siswa', 'Bandung', '2024-02-01', 'Laki-Laki', 'Kristen', 'TBSM', 'bj', 'siswa@gmail.com', 0, 0, '08328329892', 55, 'Baru', '2024-02-29 10:58:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(25, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(42, 'deuis@gmail.com', '202cb962ac59075b964b07152d234b70', 'siswa'),
(51, 'deuisn@gmail.com', '202cb962ac59075b964b07152d234b70', 'siswa'),
(54, 'deuisnurhalizah@gmail.com', '202cb962ac59075b964b07152d234b70', 'siswa'),
(55, 'siswa@gmail.com', '202cb962ac59075b964b07152d234b70', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `notif`
--
ALTER TABLE `notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
