-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Okt 2022 pada 11.48
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengajuan_aplikasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `spesifikasi`, `harga_barang`, `created_at`, `updated_at`) VALUES
(4, 'laptop', 'sdecond', '200000', '2022-09-28 04:08:41', '2022-09-28 04:08:41'),
(5, 'TV', 'second dan baru', '2000004', '2022-09-28 04:18:11', '2022-10-07 05:59:16'),
(9, 'sas', 'dsd', '2', '2022-10-05 08:43:25', '2022-10-05 08:43:25'),
(11, 'dimmas', 'adad', '2', '2022-10-06 04:18:13', '2022-10-06 04:18:13'),
(12, 'sdsd', 'dsss', '2', '2022-10-07 05:59:09', '2022-10-07 05:59:09'),
(13, 'dsd', 'dsd', '2', '2022-10-07 09:38:27', '2022-10-07 09:38:27'),
(14, 'dsd', 'ds', '22', '2022-10-07 09:38:34', '2022-10-07 09:38:34'),
(15, 'dwd', 'dds', '22', '2022-10-10 02:39:54', '2022-10-10 02:39:54'),
(16, 'ds', 'sds', '22', '2022-10-10 02:40:01', '2022-10-10 02:40:01'),
(17, 'ewew', 'sds', '2', '2022-10-11 06:33:30', '2022-10-11 09:36:16'),
(18, 'dimmassssbudi', 'speck', '2', '2022-10-11 09:11:40', '2022-10-11 09:35:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengajuan`
--

CREATE TABLE `detail_pengajuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detail_pengajuan`
--

INSERT INTO `detail_pengajuan` (`id`, `pengajuan_id`, `barang_id`, `jumlah_barang`, `harga_satuan`, `created_at`, `updated_at`) VALUES
(192, 74, 15, 3, 22, '2022-10-10 04:11:40', '2022-10-10 04:11:40'),
(193, 74, 6, 5, 200000, '2022-10-10 04:12:21', '2022-10-10 04:12:21'),
(194, 74, 12, 6, 2, '2022-10-10 04:18:01', '2022-10-10 04:18:01'),
(204, 87, 5, 7, 2000004, '2022-10-11 07:35:46', '2022-10-11 09:39:17'),
(209, 87, 11, 10, 2, '2022-10-11 09:09:13', '2022-10-11 09:39:12'),
(210, 89, 9, 2, 2, '2022-10-11 09:10:10', '2022-10-11 09:10:10'),
(211, 89, 5, 200, 2000004, '2022-10-11 09:10:10', '2022-10-11 09:10:10'),
(213, 91, 11, 222, 2, '2022-10-11 09:10:45', '2022-10-11 09:10:45'),
(214, 91, 16, 10, 22, '2022-10-11 09:10:45', '2022-10-11 09:10:45'),
(216, 91, 17, 100, 2, '2022-10-11 09:46:10', '2022-10-11 09:46:10'),
(217, 87, 9, 3, 2, '2022-10-11 09:47:34', '2022-10-11 09:47:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `barang_id`, `jumlah`, `harga_satuan`, `user_id`, `created_at`, `updated_at`) VALUES
(35, 3, 1, 400000, 1, '2022-09-29 07:31:16', '2022-09-29 07:31:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_09_28_082808_create_barang_table', 1),
(5, '2022_09_28_082940_create_pengajuan_table', 1),
(6, '2022_09_28_083142_create_detail_pengajuan_table', 1),
(7, '2022_09_28_083300_create_keranjang_table', 1),
(8, '2022_09_28_103649_create_keranjang_table', 2),
(9, '2022_09_29_145339_create_admin_table', 3),
(10, '2022_09_29_145357_create_super_admin_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id_pengajuan` int(11) NOT NULL,
  `level_1` int(11) DEFAULT NULL,
  `level_2` int(11) DEFAULT NULL,
  `level_3` int(11) DEFAULT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `tanggal`, `user_id_pengajuan`, `level_1`, `level_2`, `level_3`, `total_biaya`, `created_at`, `updated_at`) VALUES
(87, '11 Oktober 2022', 2, 1, 4, 3, 14000054, '2022-10-11 07:35:46', '2022-10-11 09:47:37'),
(89, '11 Oktober 2022', 2, 1, 4, 3, 400000804, '2022-10-11 09:10:10', '2022-10-11 09:47:44'),
(91, '11 Oktober 2022', 2, 1, 4, NULL, 864, '2022-10-11 09:10:45', '2022-10-11 09:46:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'level_1', 'level_1@gmail.com', 'level_1', NULL, '$2y$10$PmsVZK1Y.0Em2ksuyHIxbulO2jimUTbAp4Rd1MH.uWwMcWUpoVqcu', NULL, '2022-09-28 01:45:11', '2022-09-28 01:45:11'),
(2, 'penyok', 'penyok@gmail.com', NULL, NULL, '$2y$10$v0FmmUU7BoRWj6a7b3AtAemywlMSOiA1FhoAP4IybTcyV80My/yOi', NULL, '2022-09-29 07:37:52', '2022-09-29 07:37:52'),
(3, 'level_3', 'level_3@gmail.com', 'level_3', NULL, '$2y$10$V6.kECGeYD6syPX1NHtwnOY7MIqzyd9F47nGw98cu5CUN0Uyf5oGm', NULL, '2022-09-29 08:30:04', '2022-09-29 08:30:04'),
(4, 'level_2', 'level_2@gmail.com', 'level_2', NULL, '$2y$10$VRShwCaTYe4.YJ3.TOisau1Ur2KN8go6f6DFTx4.9T4sK5mZVorwq', NULL, '2022-10-06 03:18:33', '2022-10-06 03:18:33');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
