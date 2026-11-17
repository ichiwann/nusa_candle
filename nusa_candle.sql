-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2026 at 08:15 AM
-- Server version: 8.4.7
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nusa_candle`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` bigint UNSIGNED NOT NULL,
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jumlah` bigint UNSIGNED NOT NULL,
  `harga_satuan` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_produk`, `jumlah`, `harga_satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 100000, '2026-11-10 06:23:41', '2026-11-10 06:23:41'),
(2, 2, 2, 2, 100000, '2026-11-14 06:37:06', '2026-11-14 06:37:06'),
(3, 3, 1, 2, 90000, '2026-11-15 01:37:11', '2026-11-15 01:37:11'),
(4, 4, 3, 2, 125000, '2026-11-16 00:26:16', '2026-11-16 00:26:16'),
(5, 5, 2, 2, 100000, '2026-11-16 00:36:11', '2026-11-16 00:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hadiah`
--

CREATE TABLE `hadiah` (
  `id_hadiah` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `poin_dibutuhkan` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hadiah`
--

INSERT INTO `hadiah` (`id_hadiah`, `id_produk`, `poin_dibutuhkan`, `created_at`, `updated_at`) VALUES
(1, 2, 70, '2026-11-10 07:46:35', '2026-11-10 07:46:35'),
(3, 1, 70, '2026-11-14 06:47:33', '2026-11-14 06:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jumlah` bigint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_user`, `id_produk`, `jumlah`, `created_at`, `updated_at`) VALUES
(4, 2, 1, 2, '2026-11-13 07:47:19', '2026-11-14 05:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `kode_redeem`
--

CREATE TABLE `kode_redeem` (
  `id_kode` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `kode` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poin` bigint UNSIGNED NOT NULL,
  `status` enum('tersedia','terpakai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `berlaku_hingga` date DEFAULT NULL,
  `dipakai_pada` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kode_redeem`
--

INSERT INTO `kode_redeem` (`id_kode`, `id_user`, `kode`, `poin`, `status`, `berlaku_hingga`, `dipakai_pada`, `created_at`, `updated_at`) VALUES
(1, NULL, 'EFIZKBZZ', 5, 'terpakai', '2026-11-11', '2026-11-10 14:39:27', '2026-11-10 06:46:28', '2026-11-10 07:39:27'),
(2, NULL, 'SBKGYKB7', 5, 'tersedia', '2026-11-11', NULL, '2026-11-10 06:46:28', '2026-11-10 06:46:28'),
(3, NULL, 'VAOSZV5M', 5, 'tersedia', '2026-11-11', NULL, '2026-11-10 06:46:28', '2026-11-10 06:46:28'),
(4, NULL, 'YKLR1F1D', 5, 'tersedia', '2026-11-11', NULL, '2026-11-10 06:46:28', '2026-11-10 06:46:28'),
(5, NULL, 'PVOTTSDS', 5, 'tersedia', '2026-11-11', NULL, '2026-11-10 06:46:28', '2026-11-10 06:46:28'),
(6, NULL, 'U8ZOZJPX', 5, 'tersedia', '2026-11-11', NULL, '2026-11-10 06:46:28', '2026-11-10 06:46:28'),
(7, NULL, 'BGXD8GFK', 5, 'tersedia', '2026-11-11', NULL, '2026-11-10 06:46:28', '2026-11-10 06:46:28'),
(8, 2, 'LLS54HYS', 5, 'terpakai', '2027-01-14', '2026-11-13 13:41:55', '2026-11-13 06:41:15', '2026-11-13 06:41:55'),
(9, NULL, 'DH8UDPHI', 5, 'tersedia', '2027-01-14', NULL, '2026-11-13 06:41:15', '2026-11-13 06:41:15'),
(10, 4, '9ODQQYKR', 5, 'terpakai', '2027-01-14', '2026-11-15 08:41:20', '2026-11-13 06:41:15', '2026-11-15 01:41:20'),
(11, 2, '70POIN', 70, 'terpakai', '2026-11-15', '2026-11-14 14:57:05', '2026-11-14 07:56:53', '2026-11-14 07:57:05'),
(12, 2, '80P0IN', 70, 'terpakai', '2026-11-15', '2026-11-14 15:07:24', '2026-11-14 08:07:14', '2026-11-14 08:07:24'),
(13, 2, 'QGDBFFEK', 5, 'terpakai', '2027-01-17', '2026-11-16 07:38:52', '2026-11-16 00:38:08', '2026-11-16 00:38:52'),
(14, NULL, 'Q145QPWC', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(15, NULL, '76CD4D0V', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(16, NULL, '5GTRQFLC', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(17, NULL, 'CCY4VCI5', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(18, NULL, 'KOHY744E', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(19, NULL, 'BS8CTBCD', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(20, NULL, 'IQZUYCJE', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(21, NULL, 'WMYXSE1M', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08'),
(22, NULL, 'K4XNRWI5', 5, 'tersedia', '2027-01-17', NULL, '2026-11-16 00:38:08', '2026-11-16 00:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_29_111526_create_produk_table', 1),
(5, '2026_10_29_111620_create_hadiah_table', 1),
(6, '2026_10_29_111653_create_keranjang_table', 1),
(7, '2026_10_29_111722_create_pesanan_table', 1),
(8, '2026_10_29_111802_create_detail_pesanan_table', 1),
(9, '2026_10_29_111833_create_transaksi_table', 1),
(10, '2026_10_29_111916_create_kode_redeem_table', 1),
(11, '2026_10_29_112005_create_penukaran_hadiah_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penukaran_hadiah`
--

CREATE TABLE `penukaran_hadiah` (
  `id_penukaran` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_hadiah` bigint UNSIGNED NOT NULL,
  `poin_ditukar` bigint UNSIGNED NOT NULL,
  `poin_saat_klaim` bigint UNSIGNED NOT NULL,
  `status_klaim` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penukaran_hadiah`
--

INSERT INTO `penukaran_hadiah` (`id_penukaran`, `id_user`, `id_hadiah`, `poin_ditukar`, `poin_saat_klaim`, `status_klaim`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 70, 70, 'disetujui', NULL, '2026-11-10 07:47:17', '2026-11-10 07:48:28'),
(2, 2, 3, 70, 75, 'disetujui', NULL, '2026-11-14 07:57:19', '2026-11-14 07:57:45'),
(3, 2, 3, 70, 75, 'ditolak', 'Ditolak: Tidak ada alasan', '2026-11-14 08:07:32', '2026-11-14 08:07:45'),
(4, 2, 3, 70, 75, 'disetujui', NULL, '2026-11-14 08:07:57', '2026-11-14 08:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `total_harga` bigint UNSIGNED NOT NULL,
  `status_pesanan` enum('menunggu_pembayaran','diproses','dikirim','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_pembayaran',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_user`, `total_harga`, `status_pesanan`, `created_at`, `updated_at`) VALUES
(1, 2, 120000, 'selesai', '2026-11-10 06:23:41', '2026-11-14 06:43:20'),
(2, 2, 220000, 'selesai', '2026-11-14 06:37:06', '2026-11-14 06:42:22'),
(3, 4, 200000, 'selesai', '2026-11-15 01:37:11', '2026-11-15 01:43:31'),
(4, 2, 270000, 'dikirim', '2026-11-16 00:26:16', '2026-11-16 00:27:04'),
(5, 2, 220000, 'menunggu_pembayaran', '2026-11-16 00:36:11', '2026-11-16 00:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` bigint UNSIGNED NOT NULL DEFAULT '0',
  `harga` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `stok`, `harga`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Lilin Aromatherapi - Cengkeh', 97, 90000, 'produk/1UXVmApHIzVsZnvjaNdEJLgmRtQtmBtH2J1ib3HJ.jpg', '2026-11-10 06:22:14', '2026-11-15 01:37:11'),
(2, 'Lilin Aromatherapi - Apel', 95, 100000, 'produk/dbrIJB6YgvI7I3dRnk12VCSCNhe7rPbCtonCuu7U.jpg', '2026-11-10 06:22:32', '2026-11-16 00:36:11'),
(3, 'Roti Coklat', 10, 125000, 'produk/KtG6GnVaIGulwrbe33xj3G5FXjtXZPFM3fHhLpNq.jpg', '2026-11-16 00:21:13', '2026-11-16 00:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EO2VaCAWE6pj2vIcKjVN71HApTyK1cWvUyBWhMDX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJKQk84WmlreFptUEpKOU1CZHBpekVxT1VtdTg0WVdXT3ZiNXNubTR0IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInBhc3N3b3JkX2hhc2hfd2ViIjoiYmY1MDk5ZmRkMzFjMWFjMzk0OTNmMjg5MGMwOGFmNjY2OGViZjViMWJhZWRlZjU4MTVlOTJlMDMwZGI3OGJkNCJ9', 1794816345),
('kUsno2xjDilnCDHVdBRudUYkqnaXS0hJYkbmwfUw', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJtQmNiWE56QzhUSklSUXhyS1BlNnNxbVYxY1NhQ0RMM1JUMGk3azhhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiNzhlZWYwOWZjZmZlZGVhY2QyNGIyNWFiZmMwMzgzY2RjNGJlMzNiZmEzYWVlMjllN2ExYjRlMjU1OGZhZWZlZCJ9', 1794816867);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint UNSIGNED NOT NULL,
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `metode_pembayaran` enum('bca','mandiri','gopay','dana','shopeepay','cod') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` enum('menunggu','berhasil','gagal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `bukti_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `metode_pembayaran`, `status_pembayaran`, `bukti_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 'cod', 'berhasil', NULL, '2026-11-10 06:23:41', '2026-11-14 06:43:20'),
(2, 2, 'bca', 'berhasil', 'bukti_pembayaran/W45IHFSOrsHheXQpn8Fp3JWT1UZNvvstAK0x4adh.png', '2026-11-14 06:37:06', '2026-11-14 06:41:48'),
(3, 3, 'cod', 'berhasil', NULL, '2026-11-15 01:37:11', '2026-11-15 01:43:31'),
(4, 4, 'cod', 'menunggu', NULL, '2026-11-16 00:26:16', '2026-11-16 00:26:16'),
(5, 5, 'bca', 'menunggu', 'bukti_pembayaran/IVaJaeQIsRvsnDwOUkJ4YPLzTQAkDckGnlSMLRSl.png', '2026-11-16 00:36:11', '2026-11-16 00:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pembeli') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pembeli',
  `total_poin` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `email`, `alamat`, `no_telepon`, `password`, `role`, `total_poin`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', 'Malang', '081234567890', '$2y$12$a9xQV9oRqCTtgdm3BzuFPu0GcLSf5MvWD9A1wyQAZUksVXDZuAPfa', 'admin', NULL, '2026-11-10 06:21:35', '2026-11-10 06:21:35'),
(2, 'Ichwan Akbar', 'iwan', 'iwan@gmail.com', 'kemantren', '082555477611', '$2y$12$0jUgCIEHN896m2GNJVbmNOBynYgq5A0vAKsdACh7yLdAG4OOQZwYS', 'pembeli', 10, '2026-11-10 06:21:35', '2026-11-16 00:38:52'),
(3, 'nadia', 'nadia', 'nadia@mail.com', 'JL.Korea NO.12', '097676545644', '$2y$12$Y8otx6yxCxEhSqlVFfXfRuDJUz4cB6B2iLLH6iJeltGO0o0qTsEPq', 'pembeli', 0, '2026-11-15 01:35:00', '2026-11-15 01:35:00'),
(4, 'hera', 'hera', 'hera@mail.com', 'JL.Korea NO.12', '097676545644', '$2y$12$wL30pEKC7qKznTAbmUwszOz7SXJxISiCN13I6gLCTDIyutlzUS7BS', 'pembeli', 5, '2026-11-15 01:35:38', '2026-11-15 01:41:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_pesanan_id_pesanan_foreign` (`id_pesanan`),
  ADD KEY `detail_pesanan_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id_hadiah`),
  ADD KEY `hadiah_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjang_id_user_foreign` (`id_user`),
  ADD KEY `keranjang_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `kode_redeem`
--
ALTER TABLE `kode_redeem`
  ADD PRIMARY KEY (`id_kode`),
  ADD UNIQUE KEY `kode_redeem_kode_unique` (`kode`),
  ADD KEY `kode_redeem_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penukaran_hadiah`
--
ALTER TABLE `penukaran_hadiah`
  ADD PRIMARY KEY (`id_penukaran`),
  ADD KEY `penukaran_hadiah_id_user_foreign` (`id_user`),
  ADD KEY `penukaran_hadiah_id_hadiah_foreign` (`id_hadiah`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `pesanan_id_user_foreign` (`id_user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_pesanan_foreign` (`id_pesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id_hadiah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kode_redeem`
--
ALTER TABLE `kode_redeem`
  MODIFY `id_kode` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penukaran_hadiah`
--
ALTER TABLE `penukaran_hadiah`
  MODIFY `id_penukaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pesanan_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `hadiah`
--
ALTER TABLE `hadiah`
  ADD CONSTRAINT `hadiah_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjang_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `kode_redeem`
--
ALTER TABLE `kode_redeem`
  ADD CONSTRAINT `kode_redeem_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `penukaran_hadiah`
--
ALTER TABLE `penukaran_hadiah`
  ADD CONSTRAINT `penukaran_hadiah_id_hadiah_foreign` FOREIGN KEY (`id_hadiah`) REFERENCES `hadiah` (`id_hadiah`) ON DELETE CASCADE,
  ADD CONSTRAINT `penukaran_hadiah_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
