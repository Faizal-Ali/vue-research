-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2022 pada 07.49
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_link`
--

CREATE TABLE `tb_data_link` (
  `id` int(11) NOT NULL,
  `id_link` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `terjual_sebelumnya` int(11) NOT NULL,
  `total_terjual` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_data_link`
--

INSERT INTO `tb_data_link` (`id`, `id_link`, `harga`, `stok`, `terjual_sebelumnya`, `total_terjual`, `created_at`, `updated_at`) VALUES
(1, 1, 799999, 11, 113, 113, '2022-11-29 11:23:29', '2022-11-29 18:23:29'),
(2, 1, 799999, 11, 113, 113, '2022-11-30 11:23:29', '2022-11-30 18:23:29'),
(3, 4, 805000, 11, 745, 745, '2022-11-29 17:19:16', '2022-11-30 18:23:29'),
(4, 4, 805000, 11, 745, 745, '2022-11-29 11:23:29', '2022-11-29 18:23:29'),
(5, 4, 805000, 11, 745, 745, '2022-12-01 04:00:26', '2022-12-01 05:03:30'),
(6, 1, 799999, 11, 113, 113, '2022-12-01 04:00:27', '2022-12-01 05:03:26'),
(7, 5, 5688, 4387, 0, 18630, '2022-12-01 04:01:06', '2022-12-01 05:03:33'),
(8, 6, 7000, 98590, 0, 2405, '2022-12-01 04:01:09', '2022-12-01 05:03:36'),
(9, 7, 90000, 13, 0, 671, '2022-12-01 04:01:13', '2022-12-01 05:03:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_link`
--

CREATE TABLE `tb_link` (
  `id` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `ecom` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_link`
--

INSERT INTO `tb_link` (`id`, `id_toko`, `link`, `ecom`, `nama_produk`) VALUES
(1, 62501287, 'https://shopee.co.id/Print-Head-Epson-L110-L120-L210-L220-L300-L310-L350-L355-L360-L365-L455-L550-L555-L565-L380-new-i.62501287.9383385397', 'shopee', 'Print Head Epson L110 L120 L210 L220 L300 L310 L350 L355 L360 L365 L455, L550, L555, L565, L380 new'),
(4, 225311, 'https://www.tokopedia.com/fastprint/print-head-printer-epson-l130-l220-l310-l355-l360-l365-l455-original', 'tokopedia', 'Print Head Printer Epson L130 L220 L310 L355 L360 L365 L455 Original'),
(5, 676011039, 'https://shopee.co.id/Fake-Nail-Stickers-3D-Kuku-Palsu-24pcs-Stiker-Kuku-Sticker-Kuku-Tahan-Air-i.676011039.17931693688?sp_atk=1e719a05-11ed-49be-a867-ba10ecf45ca0&xptdk=1e719a05-11ed-49be-a867-ba10ecf45ca0', 'shopee', 'Fake Nail Stickers / 3D Kuku Palsu 24pcs/ Stiker Kuku / Sticker Kuku Tahan Air'),
(6, 293350020, 'https://shopee.co.id/Gagang-Stempel-Flash-D40-i.293350020.5145571970', 'shopee', 'Gagang Stempel Flash D40'),
(7, 6326904, 'https://www.tokopedia.com/fastprintbandung/head-cleaner-premium-fast-print-100ml', 'tokopedia', 'Head Cleaner Premium Fast Print 100ML');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id` int(11) NOT NULL,
  `id_shopee` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `ecom` varchar(10) NOT NULL,
  `rating_star` float(4,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id`, `id_shopee`, `nama`, `lokasi`, `ecom`, `rating_star`, `created_at`, `updated_at`) VALUES
(1, 62501287, 'sepatu-anda', 'KOTA JAKARTA UTARA', 'shopee', 4.86, '2022-11-30 16:43:25', '2022-12-01 05:03:27'),
(2, 225311, 'Fast Print Indonesia', 'Kota Surabaya', 'tokopedia', 4.80, '2022-11-30 17:19:19', '2022-12-01 05:03:31'),
(3, 676011039, 'Toko BY', 'KOTA JAKARTA BARAT', 'shopee', 4.85, '2022-12-01 04:01:07', '2022-12-01 05:03:34'),
(4, 293350020, 'universalstamp', 'KOTA CIMAHI', 'shopee', 4.91, '2022-12-01 04:01:10', '2022-12-01 05:03:37'),
(5, 6326904, 'Fast Print Bandung', 'Kota Bandung', 'tokopedia', 4.90, '2022-12-01 04:01:14', '2022-12-01 05:03:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `nama` varchar(255) NOT NULL,
  `img` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `img`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'faizal', '{\"file_name\":\"screencapture-fasposodoo-fastprint-co-id-omset-ito-2022-11-29-13_35_11.png\",\"file_type\":\"image\\/png\",\"file_path\":\"B:\\/xampp\\/htdocs\\/research\\/back\\/assets\\/user_files\\/\",\"full_path\":\"B:\\/xampp\\/htdocs\\/research\\/back\\/assets\\/user_files\\/screencapture-fasposodoo-fastprint-co-id-omset-ito-2022-11-29-13_35_11.png\",\"raw_name\":\"screencapture-fasposodoo-fastprint-co-id-omset-ito-2022-11-29-13_35_11\",\"orig_name\":\"screencapture-fasposodoo-fastprint-co-id-omset-ito-2022-11-29-13_35_11.png\",\"client_name\":\"screencapture-fasposodoo-fastprint-co-id-omset-ito-2022-11-29-13_35_11.png\",\"file_ext\":\".png\",\"file_size\":120.09,\"is_image\":true,\"image_width\":1805,\"image_height\":657,\"image_type\":\"png\",\"image_size_str\":\"width=\\\"1805\\\" height=\\\"657\\\"\"}');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_data_link`
--
ALTER TABLE `tb_data_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keyword` (`id_link`),
  ADD KEY `harga` (`harga`),
  ADD KEY `stok` (`stok`),
  ADD KEY `total_terjual` (`total_terjual`),
  ADD KEY `terjual_sebelumnya` (`terjual_sebelumnya`),
  ADD KEY `id_link` (`id_link`);

--
-- Indeks untuk tabel `tb_link`
--
ALTER TABLE `tb_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link` (`link`),
  ADD KEY `ecom` (`ecom`),
  ADD KEY `nama_produk` (`nama_produk`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `lokasi` (`lokasi`),
  ADD KEY `rating_star` (`rating_star`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_data_link`
--
ALTER TABLE `tb_data_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_link`
--
ALTER TABLE `tb_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
