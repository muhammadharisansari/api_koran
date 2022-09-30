-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Sep 2022 pada 03.45
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
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `koran`
--

INSERT INTO `koran` (`id_koran`, `koran`, `created_at`, `updated_at`) VALUES
(6, 'Tribun news', '2022-08-24 07:56:41', '0000-00-00 00:00:00'),
(7, 'Habar habari', '2022-08-24 09:56:41', '2022-09-20 16:40:21'),
(8, 'Koran Kalsel edited', '2022-08-24 09:56:41', '0000-00-00 00:00:00'),
(13, 'coba lagi', '2022-09-25 09:38:19', '0000-00-00 00:00:00');

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
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setoran`
--

INSERT INTO `setoran` (`id`, `nama_koran`, `bulan`, `tanggal`, `jumlah`, `created_at`, `updated_at`) VALUES
(3, 'Banjarmasin Post', 'Maret', '2022-08-18', 5, '2022-08-16 23:45:10', '2022-08-18 10:36:47'),
(10, 'Tribun News', 'Februari', '2022-08-18', 5, '2022-08-19 23:22:17', '2022-08-19 23:39:29'),
(11, 'Habar banua', 'Mei', '2022-09-20', 7, '2022-08-19 23:22:17', '2022-08-19 23:22:17');

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
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `koran`
--
ALTER TABLE `koran`
  MODIFY `id_koran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `setoran`
--
ALTER TABLE `setoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
