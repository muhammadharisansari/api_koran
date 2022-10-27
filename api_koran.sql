-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2022 pada 09.31
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_koran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `koran`
--

CREATE TABLE `koran` (
  `id_koran` int(11) NOT NULL,
  `koran` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `koran`
--

INSERT INTO `koran` (`id_koran`, `koran`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 'Tribun news', '2022-08-24 07:56:41', '', '0000-00-00 00:00:00', ''),
(7, 'Habar Banua', '2022-08-24 09:56:41', '', '2022-09-20 16:40:21', ''),
(8, 'Koran Kalsel', '2022-08-24 09:56:41', '', '2022-10-05 17:22:44', ''),
(24, 'Banjarmasin Post', '2022-10-05 17:23:08', '', '2022-10-19 08:57:59', ''),
(28, 'Kandangan post', '2022-10-21 11:03:26', '', '2022-10-21 21:04:42', ''),
(38, 'coba postman', '2022-10-26 17:41:30', 'admin 1', '2022-10-26 17:45:12', 'user 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setoran`
--

CREATE TABLE `setoran` (
  `id` int(11) NOT NULL,
  `nama_koran` varchar(30) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setoran`
--

INSERT INTO `setoran` (`id`, `nama_koran`, `bulan`, `tanggal`, `jumlah`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(10, 'Habar Banua', 'September', '2022-09-29', 5, '2022-08-19 23:22:17', '', '2022-10-24 10:17:57', ''),
(38, 'Kandangan post', 'Oktober', '2022-10-23', 2, '2022-10-23 09:19:23', '', '0000-00-00 00:00:00', ''),
(39, 'Banjarmasin Post', 'Oktober', '2022-10-23', 3, '2022-10-23 09:20:54', '', '0000-00-00 00:00:00', ''),
(40, 'Koran Kalsel', 'Oktober', '2022-10-23', 3, '2022-10-23 09:21:59', '', '0000-00-00 00:00:00', ''),
(41, 'Habar Banua', 'Oktober', '2022-10-23', 2, '2022-10-23 09:22:10', '', '0000-00-00 00:00:00', ''),
(44, 'Kandangan post', 'September', '2022-09-30', 5, '2022-10-24 08:42:35', '', '0000-00-00 00:00:00', ''),
(47, 'Kandangan post', 'Oktober', '2022-10-24', 2, '2022-10-24 23:26:58', '', '0000-00-00 00:00:00', ''),
(48, 'Banjarmasin Post', 'Oktober', '2022-10-24', 3, '2022-10-24 23:27:21', '', '0000-00-00 00:00:00', ''),
(49, 'Koran Kalsel', 'Oktober', '2022-10-24', 2, '2022-10-24 23:27:30', '', '0000-00-00 00:00:00', ''),
(50, 'Habar Banua', 'Oktober', '2022-10-24', 2, '2022-10-24 23:27:45', '', '0000-00-00 00:00:00', ''),
(51, 'Tribun news', 'Oktober', '2022-10-24', 3, '2022-10-24 23:27:58', '', '0000-00-00 00:00:00', ''),
(52, 'Tribun news', 'Oktober', '2022-10-25', 3, '2022-10-25 09:23:50', '', '0000-00-00 00:00:00', ''),
(53, 'coba postman', 'Agustus', '2022-08-24', 2, '2022-10-26 17:56:19', 'user 2', '2022-10-26 17:57:23', 'admin 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `verify` char(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `pin`, `verify`, `created_at`) VALUES
(3, 'aris@gmail.com', '93279e3308bdbbeed946fc965017f67a', 'N', '2022-10-26 19:17:43'),
(5, 'baruaris@gmail.com', '93279e3308bdbbeed946fc965017f67a', 'N', '2022-10-27 15:25:05');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `koran`
--
ALTER TABLE `koran`
  ADD PRIMARY KEY (`id_koran`);

--
-- Indeks untuk tabel `setoran`
--
ALTER TABLE `setoran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `koran`
--
ALTER TABLE `koran`
  MODIFY `id_koran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
