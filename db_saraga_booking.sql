-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2026 at 03:21 PM
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
-- Database: `db_saraga_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `court_id` bigint(20) UNSIGNED NOT NULL,
  `kode_booking` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `durasi` int(11) NOT NULL,
  `total_harga` decimal(12,2) NOT NULL,
  `platform_fee` decimal(12,2) NOT NULL DEFAULT 0.00,
  `vendor_share` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `is_checked_in` tinyint(1) NOT NULL DEFAULT 0,
  `payment_method` varchar(255) DEFAULT NULL,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `catatan_penolakan` text DEFAULT NULL,
  `is_offline` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `court_id`, `kode_booking`, `tanggal`, `jam_mulai`, `durasi`, `total_harga`, `platform_fee`, `vendor_share`, `status`, `is_checked_in`, `payment_method`, `bukti_pembayaran`, `catatan_penolakan`, `is_offline`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'SRG-B672H92', '2026-04-27', '19:00:00', 2, 300000.00, 0.00, 0.00, 'lunas', 0, NULL, NULL, NULL, 0, '2026-04-27 08:02:48', '2026-04-27 08:02:48'),
(2, 4, 1, 'SRG-X821K90', '2026-04-28', '20:00:00', 1, 150000.00, 0.00, 0.00, 'pending', 0, NULL, NULL, NULL, 0, '2026-04-27 08:02:48', '2026-04-27 08:02:48'),
(4, 31, 79, 'SRG-OHU1YTG', '2026-05-11', '09:00:00', 1, 10000.00, 0.00, 0.00, 'pending', 0, NULL, NULL, NULL, 0, '2026-05-11 10:53:28', '2026-05-11 10:53:28'),
(5, 31, 79, 'SRG-JGZF29S', '2026-05-18', '08:00:00', 1, 10000.00, 0.00, 0.00, 'pending', 0, NULL, NULL, NULL, 0, '2026-05-18 07:32:12', '2026-05-18 07:32:12'),
(6, 31, 79, 'SRG-9F5FQ3L', '2026-05-18', '09:00:00', 1, 10000.00, 0.00, 0.00, 'sedang_main', 1, NULL, '/storage/payment-proofs/qvC5wSFHxE6heZcQ0qyQbUq92HL1Guq0NrQl3VtK.jpg', NULL, 0, '2026-05-18 07:43:30', '2026-05-18 07:44:37'),
(7, 31, 77, 'SRG-VUFYYEA', '2026-05-18', '08:00:00', 1, 80000.00, 0.00, 0.00, 'lunas', 0, NULL, '/storage/payment-proofs/99dO85QKsi4OWWfURb2INpo986ZArFuNSoG6Zxum.jpg', NULL, 0, '2026-05-18 07:47:08', '2026-05-18 08:03:26'),
(8, 31, 79, 'SRG-FTAY4BW', '2026-05-18', '17:00:00', 1, 10000.00, 0.00, 0.00, 'batal', 0, NULL, NULL, NULL, 0, '2026-05-18 09:54:34', '2026-05-18 10:32:54'),
(9, 31, 79, 'SRG-YGG1RQT', '2026-05-19', '08:00:00', 2, 20000.00, 0.00, 0.00, 'batal', 0, NULL, '/storage/payment-proofs/tTLSlG3JwBSnBRhR1QdYgG2gV0PIn656G3xqBcfp.jpg', 'j', 0, '2026-05-18 10:12:36', '2026-05-18 10:32:42'),
(10, 31, 79, 'SRG-W0DHTJQ', '2026-05-19', '08:00:00', 2, 20000.00, 0.00, 0.00, 'batal', 0, NULL, '/storage/payment-proofs/lMpSF8xqzgT8g1ZExPXto3Is1rANALjnUy8g7JBe.jpg', 'g', 0, '2026-05-18 10:33:29', '2026-05-18 11:06:18'),
(11, 31, 79, 'SRG-H4LSFFP', '2026-05-19', '08:00:00', 2, 20000.00, 0.00, 0.00, 'sedang_main', 1, NULL, '/storage/payment-proofs/698LUuKJNnHdEZrmhW8QctFArEEJGGL5o87v9nNr.jpg', NULL, 0, '2026-05-18 11:06:32', '2026-05-18 11:47:03'),
(12, 34, 79, 'SRG-UBQ1MPQ', '2026-05-31', '08:00:00', 2, 23000.00, 0.00, 0.00, 'lunas', 0, NULL, '/storage/payment-proofs/zXNveTdprJpN6y3BPToUg1R96Vxa1O2Va0xXu3HF.jpg', NULL, 0, '2026-05-31 10:29:34', '2026-05-31 11:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venue_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lapangan` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tipe_olahraga` varchar(255) NOT NULL,
  `kategori_lokasi` varchar(255) DEFAULT NULL,
  `tipe_lantai` varchar(255) DEFAULT NULL,
  `harga_per_jam` decimal(12,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`id`, `venue_id`, `nama_lapangan`, `foto`, `tipe_olahraga`, `kategori_lokasi`, `tipe_lantai`, `harga_per_jam`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lapangan A (Sintetis)', NULL, 'Futsal', NULL, NULL, 150000.00, 1, '2026-04-27 08:02:47', '2026-04-27 08:02:47'),
(3, 3, 'lapangan winardo', NULL, 'Tennis', NULL, 'lantai', 75000.00, 1, '2026-05-04 10:49:14', '2026-05-11 08:01:15'),
(4, 3, 'lapangan nabil', NULL, 'Mini Soccer', NULL, 'lantai', 200000.00, 1, '2026-05-04 10:49:14', '2026-05-11 08:01:34'),
(5, 3, 'Court 2', NULL, 'Billiards', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(6, 4, 'Court 3', NULL, 'Mini Soccer', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(7, 4, 'Court 4', NULL, 'Futsal', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(8, 4, 'Court 5', NULL, 'Badminton', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(9, 5, 'Court 4', NULL, 'Volley', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(10, 5, 'Court 3', NULL, 'Tennis', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(11, 5, 'Court 3', NULL, 'Swimming', NULL, NULL, 250000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(12, 6, 'Court 5', NULL, 'Table Tennis', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(13, 6, 'Court 2', NULL, 'Yoga', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(14, 6, 'Court 3', NULL, 'Futsal', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(15, 7, 'Court 3', NULL, 'Basketball', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(16, 7, 'Court 3', NULL, 'Swimming', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(17, 7, 'Court 3', NULL, 'Swimming', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(18, 8, 'Court 3', NULL, 'Billiards', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(19, 8, 'Court 4', NULL, 'Swimming', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(20, 8, 'Court 4', NULL, 'Basketball', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(21, 9, 'Court 4', NULL, 'Yoga', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(22, 9, 'Court 3', NULL, 'Volley', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(23, 9, 'Court 2', NULL, 'Basketball', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(24, 10, 'Court 5', NULL, 'Yoga', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(25, 10, 'Court 5', NULL, 'Basketball', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(26, 10, 'Court 2', NULL, 'Futsal', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(27, 11, 'Court 5', NULL, 'Tennis', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(28, 11, 'Court 1', NULL, 'Futsal', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(29, 11, 'Court 5', NULL, 'Basketball', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(30, 12, 'Court 1', NULL, 'Tennis', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(31, 12, 'Court 2', NULL, 'Table Tennis', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(32, 12, 'Court 3', NULL, 'Swimming', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(33, 13, 'Court 5', NULL, 'Basketball', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(34, 13, 'Court 5', NULL, 'Zumba', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(35, 13, 'Court 5', NULL, 'Mini Soccer', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(36, 14, 'Court 1', NULL, 'Futsal', NULL, NULL, 250000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(37, 14, 'Court 5', NULL, 'Badminton', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(38, 14, 'Court 5', NULL, 'Table Tennis', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(39, 15, 'Court 4', NULL, 'Table Tennis', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(40, 15, 'Court 5', NULL, 'Billiards', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(41, 15, 'Court 2', NULL, 'Yoga', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(42, 16, 'Court 5', NULL, 'Billiards', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(43, 16, 'Court 4', NULL, 'Gym', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(44, 16, 'Court 2', NULL, 'Gym', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(45, 17, 'Court 3', NULL, 'Basketball', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(46, 17, 'Court 4', NULL, 'Basketball', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(47, 17, 'Court 2', NULL, 'Billiards', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(48, 18, 'Court 3', NULL, 'Badminton', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(49, 18, 'Court 3', NULL, 'Mini Soccer', NULL, NULL, 250000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(50, 18, 'Court 4', NULL, 'Tennis', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(51, 19, 'Court 1', NULL, 'Table Tennis', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(52, 19, 'Court 5', NULL, 'Zumba', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(53, 19, 'Court 1', NULL, 'Futsal', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(54, 20, 'Court 2', NULL, 'Yoga', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(55, 20, 'Court 4', NULL, 'Yoga', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(56, 20, 'Court 3', NULL, 'Gym', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(57, 21, 'Court 1', NULL, 'Badminton', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(58, 21, 'Court 4', NULL, 'Gym', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(59, 21, 'Court 2', NULL, 'Basketball', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(60, 22, 'Court 5', NULL, 'Gym', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(61, 22, 'Court 5', NULL, 'Swimming', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(62, 22, 'Court 2', NULL, 'Zumba', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(63, 23, 'Court 4', NULL, 'Zumba', NULL, NULL, 250000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(64, 23, 'Court 3', NULL, 'Futsal', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(65, 23, 'Court 3', NULL, 'Volley', NULL, NULL, 150000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(66, 24, 'Court 1', NULL, 'Billiards', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(67, 24, 'Court 2', NULL, 'Tennis', NULL, NULL, 75000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(68, 24, 'Court 4', NULL, 'Gym', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(69, 25, 'Court 2', NULL, 'Billiards', NULL, NULL, 200000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(70, 25, 'Court 5', NULL, 'Badminton', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(71, 25, 'Court 4', NULL, 'Gym', NULL, NULL, 50000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(72, 26, 'Court 2', NULL, 'Zumba', NULL, NULL, 100000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(73, 26, 'Court 4', NULL, 'Tennis', NULL, NULL, 250000.00, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(75, 27, 'Lapanagan ANugrah', 'venues/31/1778518091_47401b62-2f6d-4323-8923-a3bee3f3d011.jpg', 'Basketball', 'Outdoor', 'lantai', 800001.00, 1, '2026-05-11 09:22:19', '2026-05-11 09:48:11'),
(76, 27, 'Lapangan Winardo', '/storage/court-images/nHEK3RFj3NopjiU4daUiiaidCdJvHqIZMthM8Ejw.jpg', 'Futsal', 'Indoor', 'semen', 100000.00, 1, '2026-05-11 09:22:53', '2026-05-11 09:22:53'),
(77, 27, 'Lapangan nabil', '/storage/court-images/o5LNbAwquBliEi9HDEThI4zwgYzE40PxnGbB1JQK.jpg', 'Volley', 'Outdoor', 'semen', 80000.00, 1, '2026-05-11 09:23:16', '2026-05-11 09:23:16'),
(78, 27, 'fd', 'venues/31/1778518120_bd73b22b-ab84-46f1-a453-d4257ca66f06.jpg', 'Futsal', 'Indoor', 'dfd', 365425.00, 1, '2026-05-11 09:48:40', '2026-05-11 09:48:40'),
(79, 27, 'Lapangan Nababan', 'venues/31/1778519347_ecc7db39-2f9e-46e9-bc99-73aaba037033.jpg', 'Basketball', 'Indoor', 'lantai', 10000.00, 1, '2026-05-11 10:09:07', '2026-05-11 10:09:07'),
(80, 28, 'Lapangan Anugrah', 'venues/32/1779129638_cf7f0ac3-4c2e-477c-a626-78e9727d56bd.jpg', 'Basketball', 'Outdoor', 'semen', 1000000.00, 1, '2026-05-18 11:40:38', '2026-05-18 11:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` char(7) NOT NULL,
  `regency_id` char(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `regency_id`, `name`, `created_at`, `updated_at`) VALUES
('1171010', '1171', 'Kecamatan Pusat KOTA BANDA ACEH', NULL, NULL),
('1271010', '1271', 'Kecamatan Pusat KOTA MEDAN', NULL, NULL),
('1371010', '1371', 'Kecamatan Pusat KOTA PADANG', NULL, NULL),
('3171010', '3171', 'Kecamatan Pusat KOTA JAKARTA PUSAT', NULL, NULL),
('3174010', '3174', 'Kecamatan Pusat KOTA JAKARTA SELATAN', NULL, NULL),
('3273010', '3273', 'Kecamatan Pusat KOTA BANDUNG', NULL, NULL),
('3374010', '3374', 'Kecamatan Pusat KOTA SEMARANG', NULL, NULL),
('3578010', '3578', 'Kecamatan Pusat KOTA SURABAYA', NULL, NULL),
('5171010', '5171', 'Kecamatan Pusat KOTA DENPASAR', NULL, NULL),
('6471010', '6471', 'Kecamatan Pusat KOTA BALIKPAPAN', NULL, NULL),
('7371010', '7371', 'Kecamatan Pusat KOTA MAKASSAR', NULL, NULL),
('9171010', '9171', 'Kecamatan Pusat KOTA JAYAPURA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_20_103416_add_role_and_points_to_users_table', 1),
(5, '2026_04_20_103436_create_venues_table', 1),
(6, '2026_04_20_103437_create_courts_table', 1),
(7, '2026_04_20_103438_create_bookings_table', 1),
(8, '2026_04_20_103439_create_subscriptions_table', 1),
(9, '2026_04_21_084334_create_provinces_table', 1),
(10, '2026_04_21_084334_create_regencies_table', 1),
(11, '2026_04_21_084335_create_districts_table', 1),
(12, '2026_04_21_084336_add_location_ids_to_venues_table', 1),
(13, '2026_04_21_092940_add_is_checked_in_to_bookings_table', 1),
(14, '2026_04_21_092941_create_payouts_table', 1),
(15, '2026_04_21_092941_create_wallets_table', 1),
(16, '2026_04_21_094711_upgrade_admin_and_add_venue_verification', 1),
(17, '2026_04_21_145610_add_registration_info_to_venues_table', 1),
(18, '2026_04_21_151627_add_bukti_bayar_to_subscriptions_table', 1),
(19, '2026_04_27_123143_add_metode_pembayaran_to_subscriptions_table', 1),
(20, '2026_04_27_140928_add_details_to_courts_table', 1),
(21, '2026_04_27_144633_add_verification_fields_to_bookings_table', 1),
(22, '2026_05_11_150638_add_kategori_lokasi_to_courts_table', 2),
(23, '2026_05_18_194129_add_revenue_columns_to_bookings_table', 3),
(24, '2026_05_18_195036_add_details_to_payouts_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(14,2) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `metode_penarikan` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `admin_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`id`, `vendor_id`, `amount`, `bank_account`, `nama_penerima`, `no_hp`, `metode_penarikan`, `status`, `admin_note`, `created_at`, `updated_at`) VALUES
(1, 31, 100000.00, '089506546565', 'anugrah nababan', '089506546565', 'DANA', 'approved', NULL, '2026-05-18 12:59:38', '2026-05-18 13:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
('11', 'ACEH', NULL, NULL),
('12', 'SUMATERA UTARA', NULL, NULL),
('13', 'SUMATERA BARAT', NULL, NULL),
('14', 'RIAU', NULL, NULL),
('15', 'JAMBI', NULL, NULL),
('16', 'SUMATERA SELATAN', NULL, NULL),
('17', 'BENGKULU', NULL, NULL),
('18', 'LAMPUNG', NULL, NULL),
('19', 'KEP. BANGKA BELITUNG', NULL, NULL),
('21', 'KEPULAUAN RIAU', NULL, NULL),
('31', 'DKI JAKARTA', NULL, NULL),
('32', 'JAWA BARAT', NULL, NULL),
('33', 'JAWA TENGAH', NULL, NULL),
('34', 'DI YOGYAKARTA', NULL, NULL),
('35', 'JAWA TIMUR', NULL, NULL),
('36', 'BANTEN', NULL, NULL),
('51', 'BALI', NULL, NULL),
('52', 'NUSA TENGGARA BARAT', NULL, NULL),
('53', 'NUSA TENGGARA TIMUR', NULL, NULL),
('61', 'KALIMANTAN BARAT', NULL, NULL),
('62', 'KALIMANTAN TENGAH', NULL, NULL),
('63', 'KALIMANTAN SELATAN', NULL, NULL),
('64', 'KALIMANTAN TIMUR', NULL, NULL),
('65', 'KALIMANTAN UTARA', NULL, NULL),
('71', 'SULAWESI UTARA', NULL, NULL),
('72', 'SULAWESI TENGAH', NULL, NULL),
('73', 'SULAWESI SELATAN', NULL, NULL),
('74', 'SULAWESI TENGGARA', NULL, NULL),
('75', 'GORONTALO', NULL, NULL),
('76', 'SULAWESI BARAT', NULL, NULL),
('81', 'MALUKU', NULL, NULL),
('82', 'MALUKU UTARA', NULL, NULL),
('91', 'PAPUA', NULL, NULL),
('92', 'PAPUA BARAT', NULL, NULL),
('93', 'PAPUA SELATAN', NULL, NULL),
('94', 'PAPUA TENGAH', NULL, NULL),
('95', 'PAPUA PEGUNUNGAN', NULL, NULL),
('96', 'PAPUA BARAT DAYA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regencies`
--

CREATE TABLE `regencies` (
  `id` char(4) NOT NULL,
  `province_id` char(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regencies`
--

INSERT INTO `regencies` (`id`, `province_id`, `name`, `created_at`, `updated_at`) VALUES
('1171', '11', 'KOTA BANDA ACEH', NULL, NULL),
('1271', '12', 'KOTA MEDAN', NULL, NULL),
('1371', '13', 'KOTA PADANG', NULL, NULL),
('3171', '31', 'KOTA JAKARTA PUSAT', NULL, NULL),
('3174', '31', 'KOTA JAKARTA SELATAN', NULL, NULL),
('3273', '32', 'KOTA BANDUNG', NULL, NULL),
('3374', '33', 'KOTA SEMARANG', NULL, NULL),
('3578', '35', 'KOTA SURABAYA', NULL, NULL),
('5171', '51', 'KOTA DENPASAR', NULL, NULL),
('6471', '64', 'KOTA BALIKPAPAN', NULL, NULL),
('7371', '73', 'KOTA MAKASSAR', NULL, NULL),
('9171', '91', 'KOTA JAYAPURA', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4bTKETVe5tH4tHsRI99oASk4LD2dqkjSThp4JTj7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.26.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'eyJfdG9rZW4iOiJ1SXo4MTNJRGtDR3ZvdTh5OHVmUzZhTDUyUEtqM0c0dEwwc0hZUDBZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780399775),
('DUgTO4aGxbaqbL4ySqF3u6fPFzdFmwZSnjjDqAae', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.26.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'eyJfdG9rZW4iOiJScUg0bUJabWNGTFRYcXQ3YXBCRWFBSm5leDlWYkQzUm5RWUZybVJHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780413778),
('keDmsSeZpTFqMiTAcq8BItAgjQPQsGq2EJ27np03', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJTZVJ3V0Z2UVFvM2EyVzlydjJVZWM1b09lOFBHQTNuNVV2NkJ1TDdCIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvc2lzdGVtLWJvb2tpbmcudGVzdFwvYWRtaW5cL2Rhc2hib2FyZCJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvc2lzdGVtLWJvb2tpbmcudGVzdFwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780400436),
('mgkftoIFbklHIMJtB8EROweUf3PGZh7Z2Yyj8Ot4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.26.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36', 'eyJfdG9rZW4iOiJLYjhlNDh2N3I0NldlOEg4SFRNN0NGR2g2TXc5Rk94emJuSld2VnB6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcLz9oZXJkPXByZXZpZXciLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780241975),
('NAOjwI1WUq9ncZBjl016GVhh0IIcZ9H1jLGvDjs2', 34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJzQmNubklkRlR3Mk00d1I1cEtHZmRqU2NXODZKZUg1aXFEaFdQQWxYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MzR9', 1780405203),
('P949hBjGFaygDEEiY5qwoGKIZcqyp7RHdQfNp5OE', 34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJVNkhEaGFTZGJWWk9neFlZOTBac3pqVVVLSzE5NHpBWDQ5UHVDWTA5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcL2tlbWl0cmFhbiIsInJvdXRlIjoia2VtaXRyYWFuIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjM0fQ==', 1780337247),
('rw78kMuRjAEiGYLcQ6t9HroIlwoExPY0F8mVnW0v', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJLVktrY2VSYnVVY2Nhdm10S1RENnZURXo0UmZjaTA4bERRallFQVhqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcL2FkbWluXC9sYXBvcmFuIiwicm91dGUiOiJhZG1pbi5sYXBvcmFuIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjp7ImludGVuZGVkIjoiaHR0cDpcL1wvc2lzdGVtLWJvb2tpbmcudGVzdFwvYWRtaW5cL2Rhc2hib2FyZCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1780411321),
('srVqjIZjlqeoM0bkZelaS1WC4Rt1zOVmU3NYctwt', 31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkOXU5V3I1Y2M1NEtJeG9oS0szNXRLODQwTEhCSUl4R1AxZktoMUNyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcL21pdHJhXC9wZXNhbmFuIiwicm91dGUiOiJtaXRyYS5wZXNhbmFuIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMxfQ==', 1780251387),
('VMZD19oQm161Xw2GLod0cPz3fcKKMUkinRbIrKfS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI5dDBMWXJ5cU5GcUlJRkRDNnFZckdIVkZieFJoZXEzTm5wa0VVOHZjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3RcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780251160),
('W8rr6EpmU1ji4Ct4vEYxEddC5BYKbYpytKGKVfXL', 34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkRTZaaExnVE5uWHpFaTNuRmluWGdKUzA0ZFpRSVd3ZE91UkRjNENiIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvc2lzdGVtLWJvb2tpbmcudGVzdFwvZGFzaGJvYXJkXC9wZW5nYXR1cmFuIiwicm91dGUiOiJkYXNoYm9hcmQucGVuZ2F0dXJhbiJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MzR9', 1780252984),
('XqhvUy7tFTWGIQ2GkBAihgXK3L31eRS7OfJpLbtK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJ4dVJ3M2JxZ0piRlFIemhaV0plQ3Z5VVh5c3pvNjZFT21QNFYwaGVCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3Npc3RlbS1ib29raW5nLnRlc3QiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780413778);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `paket` varchar(255) NOT NULL,
  `metode_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` varchar(255) NOT NULL DEFAULT 'pending',
  `price` decimal(12,2) NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `vendor_id`, `paket`, `metode_pembayaran`, `status_pembayaran`, `price`, `bukti_bayar`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'tahunan', NULL, 'verified', 1500000.00, NULL, '2027-04-27 08:02:47', '2026-04-27 08:02:47', '2026-04-27 08:02:47'),
(2, 3, 'bulanan', NULL, 'verified', 150000.00, NULL, NULL, '2026-04-27 08:02:47', '2026-06-02 04:48:29'),
(3, 6, 'tahunan', 'qris', 'verified', 1500000.00, 'bukti-bayar/vhJiFSlaN3qrmF5y6iMtlOIJyFRs3LZzFwH3xLx7.png', '2027-04-27 20:07:55', '2026-04-27 20:07:55', '2026-04-27 20:08:05'),
(4, 31, 'tahunan', 'qris', 'verified', 1500000.00, 'bukti-bayar/oEP8SNqDMfD8RY6BpgyuvaSHgXhyxhvSN8JxrTG4.jpg', '2027-05-11 09:20:43', '2026-05-11 09:20:43', '2026-05-11 09:20:52'),
(5, 32, 'tahunan', 'bank', 'verified', 1500000.00, 'bukti-bayar/rBR4o2C7GtjekjxlgMCIMiyfG2wYqdlzedr457mD.jpg', '2027-05-18 11:33:08', '2026-05-18 11:33:08', '2026-05-18 11:35:52'),
(6, 33, 'tahunan', 'bank', 'verified', 1500000.00, 'bukti-bayar/ebIfck9psfqxzd5uWOuVDF4abIlwwDxs2YQmlpT7.jpg', '2027-05-18 12:03:16', '2026-05-18 12:03:16', '2026-05-18 12:06:18'),
(7, 34, 'tahunan', 'qris', 'verified', 1500000.00, 'bukti-bayar/RB4NIpKwff1VaOEJXMhSgoNO9PFxjJCPvalbiyyH.jpg', '2027-06-02 05:28:13', '2026-06-02 05:28:13', '2026-06-02 05:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `points_balance` bigint(20) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `points_balance`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@saraga.id', NULL, '$2y$12$ik9WWsgscRCV6SUY9uqwLe4f4Gc13gwpuOcGzmOH5o.Fjqa9K5hOi', 'superadmin', 0, 1, NULL, '2026-04-27 08:02:46', '2026-04-27 08:02:46'),
(2, 'Bambang Sudjatmiko', 'bambang@elitearena.com', NULL, '$2y$12$SshJrZNYmFEwBFKkPgrpzuKfnHnJIvaazg0IT.oovmNr52wWs3//y', 'vendor', 0, 1, NULL, '2026-04-27 08:02:47', '2026-04-27 08:02:47'),
(3, 'Siti Aminah', 'siti@badmintonhub.id', NULL, '$2y$12$LvFwGmP8JuqEN4Oz2yTp0uHYIQxSdrS6Z3AX8eFWz/zR5hBcgW4i.', 'vendor', 0, 1, NULL, '2026-04-27 08:02:47', '2026-06-02 04:48:29'),
(4, 'Anugrah Nababan', 'anugrah@user.com', NULL, '$2y$12$wsq6eMmwl5E9AgHp.SZx2.qNP2Yf/o4MyuX.xSnvMd4pPLfNEBw6a', 'user', 25000, 1, NULL, '2026-04-27 08:02:48', '2026-04-27 08:02:48'),
(5, 'Budi Santoso', 'budi@user.com', NULL, '$2y$12$Pb7h7xEmizWPVtxI09psXOXiFONSMTIhPQmuyYnTUB3b38gBkQYvO', 'user', 0, 1, NULL, '2026-04-27 08:02:48', '2026-04-27 08:02:48'),
(6, 'nabil', 'nabil22@gmail.com', NULL, '$2y$12$Gs2Z1k0IDkAflqkBlwiccepkrBCkg4if9DTkS8X197FB6.hQ.iHZq', 'vendor', 0, 1, NULL, '2026-04-27 20:05:53', '2026-04-27 20:08:05'),
(7, 'Dinda Lalita Kuswandari', 'yolanda.mujur@example.com', '2026-05-04 10:49:13', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'zF8zXPyjtV', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(8, 'Hana Kamila Purnawati S.H.', 'yahya57@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'ER024HH197', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(9, 'Ilsa Eka Permata S.I.Kom', 'palastri.ganjaran@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'fkzWWgIpcf', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(10, 'Rudi Balamantri Wahyudin S.Kom', 'jaya.hidayanto@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'iCwyaBYoav', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(11, 'Mulya Saragih', 'umansur@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'bEBCyLtmGZ', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(12, 'Candra Darmaji Tampubolon S.E.I', 'kayla.prabowo@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'AmhO9BjoXv', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(13, 'Yulia Maryati', 'eva94@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'MlF20RrIIF', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(14, 'Wisnu Wacana S.E.', 'pertiwi.prakosa@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'CIyFlxms1Y', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(15, 'Vicky Mandasari S.IP', 'sirait.zulfa@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'kJ1bciBy7o', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(16, 'Ajeng Salimah Laksmiwati S.E.I', 'kania.wasita@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'yM4bweTiKu', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(17, 'Jarwadi Salahudin S.E.', 'najib.halim@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'PcHJUHJqiU', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(18, 'Belinda Widiastuti', 'irnanto.nashiruddin@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, '2JUM3lG7QV', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(19, 'Kemal Mustofa', 'vnababan@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'IXukoSSfiV', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(20, 'Galar Gaman Nababan S.I.Kom', 'sitorus.putri@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'NuvND8Mphk', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(21, 'Oni Pertiwi', 'asirwanda51@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 't9p4slbGQp', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(22, 'Latika Lestari', 'etamba@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, '2Bv50t7E7B', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(23, 'Eli Eka Wahyuni S.Sos', 'ysuartini@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'VNNZUtisc6', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(24, 'Radika Jailani', 'anggraini.ghani@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, '0om72olvk4', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(25, 'Martani Harjo Marbun M.TI.', 'niyaga11@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'HgdNK2Zrvb', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(26, 'Patricia Maryati', 'winarno.silvia@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'DgvcSLoqJ8', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(27, 'Jagapati Sihombing', 'situmorang.zelaya@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'gqDRiS1AFA', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(28, 'Janet Zulfa Purnawati S.T.', 'bsiregar@example.com', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'UMiNSyLijR', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(29, 'Marwata Prabawa Saputra S.E.', 'violet79@example.net', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'HKB6swqnci', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(30, 'Harto Prasasta S.Kom', 'inapitupulu@example.org', '2026-05-04 10:49:14', '$2y$12$FiCsryYOlzpnhkWDGyVbueIellDLE6SyGlRZwo1adIOiLlkJI4OMC', 'vendor', 0, 1, 'DZyt6KS9iE', '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(31, 'Anugrah Nababan', 'anugrah222@gmail.com', NULL, '$2y$12$UpffNEOemUIZ5CQUO.BdT.xSdGS5Z3zxe9FB1Wjs5Mdm875OJxCGi', 'vendor', 2, 1, NULL, '2026-05-11 09:12:23', '2026-05-18 11:08:18'),
(32, 'jija sembiring', 'jija12345@gmail.com', NULL, '$2y$12$yf1tDjhXzxGqrI0pAumG5.6431gEncI/bPOn3dRQqj9DkY4SS2IPq', 'vendor', 0, 1, NULL, '2026-05-18 11:12:08', '2026-05-18 11:35:52'),
(33, 'jija sembiring', 'jija111@gmail.com', NULL, '$2y$12$6SdpsTvGHUoufkfCAmiazew5MMU27ktzMmsGoPgc8YRxphpFUXOEy', 'vendor', 0, 1, NULL, '2026-05-18 12:01:58', '2026-05-18 12:06:18'),
(34, 'Anugrah Nababan', 'anugrah123@gmail.com', NULL, '$2y$12$cue019abRPcuTZ7eHoTN9us.4ERVn9dlYnImV.R3sw2tc4UKMf32u', 'vendor', 2, 1, NULL, '2026-05-31 09:21:58', '2026-06-02 05:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `nama_venue` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `province_id` char(2) DEFAULT NULL,
  `regency_id` char(4) DEFAULT NULL,
  `district_id` char(7) DEFAULT NULL,
  `timezone` enum('WIB','WITA','WIT') NOT NULL DEFAULT 'WIB',
  `description` text DEFAULT NULL,
  `foto_venue` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `vendor_id`, `owner_name`, `whatsapp`, `nama_venue`, `slug`, `alamat`, `province_id`, `regency_id`, `district_id`, `timezone`, `description`, `foto_venue`, `is_verified`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, 'Elite Arena Futsal', 'elite-arena-futsal', 'Jl. Kebon Jeruk No. 12, Jakarta', NULL, NULL, NULL, 'WIB', 'Lapangan futsal standar FIFA dengan rumput sintetis terbaik.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-04-27 08:02:47', '2026-04-27 08:02:47'),
(2, 6, 'anugrah nababan', '89502953434', 'sbt basket', 'sbt-basket-tkZNS', 'jl.glambir 5', NULL, NULL, NULL, 'WIB', NULL, NULL, 1, 1, '2026-04-27 20:07:23', '2026-04-27 20:07:32'),
(3, 6, NULL, NULL, 'The Cage Tennis Sport Club', 'the-cage-tennis-sport-club-270', 'Jl. Olahraga Utama No. 37, KOTA BANDA ACEH', '11', '1171', '1171010', 'WIB', 'Ab est eos consequatur cupiditate occaecati qui. Ex eaque pariatur sequi eos atque minima sunt. Et consequatur error asperiores doloribus ex soluta ducimus. Voluptatem iure assumenda ut est.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(4, 6, NULL, NULL, 'Prime Futsal Center', 'prime-futsal-center-537', 'Jl. Olahraga Utama No. 37, KOTA BANDA ACEH', '11', '1171', '1171010', 'WIB', 'Quo voluptatum libero officiis eius quas aut. Porro tempore nobis quia similique labore exercitationem est nulla. Ipsum saepe eius aperiam explicabo voluptate vitae dolor. Aliquid voluptas suscipit aspernatur aliquam fugit. Sint unde nam et voluptatem dolorem.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(5, 6, NULL, NULL, 'Victory Tennis Stadium', 'victory-tennis-stadium-150', 'Jl. Olahraga Utama No. 36, KOTA MEDAN', '12', '1271', '1271010', 'WITA', 'Molestias quibusdam ut sit architecto. Maiores quo dolores dolorum molestiae provident. Deleniti iste est repellendus et illo molestiae. Beatae possimus nihil tempore quisquam fuga aut dolores.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(6, 6, NULL, NULL, 'Prime Badminton Hall', 'prime-badminton-hall-909', 'Jl. Olahraga Utama No. 36, KOTA MEDAN', '12', '1271', '1271010', 'WITA', 'Quo odit cumque rem enim. Ipsa ut quis enim. Cum numquam culpa esse et aliquam amet totam. Voluptatem sed explicabo reprehenderit voluptatibus ut rerum dolores.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(7, 2, NULL, NULL, 'Nexus Basketball Arena', 'nexus-basketball-arena-654', 'Jl. Olahraga Utama No. 10, KOTA PADANG', '13', '1371', '1371010', 'WITA', 'Qui at repellat velit consequatur aut voluptatum. Sunt inventore non vel aut dignissimos sit ut velit. Repudiandae ut accusantium eos sed facere vero et. Harum et repellendus magni odit et laboriosam minus officiis.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(8, 2, NULL, NULL, 'Prime Tennis Sport Club', 'prime-tennis-sport-club-422', 'Jl. Olahraga Utama No. 10, KOTA PADANG', '13', '1371', '1371010', 'WIB', 'Nihil est ea sint et officia tenetur eum. Tempora natus vero aut occaecati autem expedita. Ipsam ducimus autem libero voluptas nemo quam.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(9, 2, NULL, NULL, 'The Cage Futsal Hub', 'the-cage-futsal-hub-203', 'Jl. Olahraga Utama No. 29, KOTA JAKARTA PUSAT', '31', '3171', '3171010', 'WITA', 'Corporis dolor dignissimos aut sunt voluptas. Possimus ducimus ea illo velit rerum. Repellendus facilis eum voluptas non eum eveniet. Iure asperiores fugiat distinctio quia blanditiis.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(10, 2, NULL, NULL, 'Grand Futsal Hub', 'grand-futsal-hub-923', 'Jl. Olahraga Utama No. 29, KOTA JAKARTA PUSAT', '31', '3171', '3171010', 'WIT', 'Ut inventore debitis ut accusamus voluptate cupiditate. Dolorum ratione sint assumenda quia est illo. Earum saepe saepe est iste repellat sapiente voluptates. Vero repudiandae et officia cupiditate quo debitis.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(11, 2, NULL, NULL, 'Prime Tennis Hall', 'prime-tennis-hall-416', 'Jl. Olahraga Utama No. 12, KOTA JAKARTA SELATAN', '31', '3174', '3174010', 'WIB', 'Ducimus dolorem placeat voluptas molestiae. Officiis placeat porro atque quaerat. Neque ullam quibusdam laudantium.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(12, 2, NULL, NULL, 'The Cage Tennis Arena', 'the-cage-tennis-arena-988', 'Jl. Olahraga Utama No. 12, KOTA JAKARTA SELATAN', '31', '3174', '3174010', 'WIB', 'Debitis et eum praesentium veniam fugit laborum rerum. Sit sapiente consequatur est vitae accusantium voluptatem vel ullam. Odit nisi saepe quae et atque ipsum.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(13, 2, NULL, NULL, 'Victory Badminton Hub', 'victory-badminton-hub-289', 'Jl. Olahraga Utama No. 54, KOTA BANDUNG', '32', '3273', '3273010', 'WIT', 'Sint unde aspernatur animi enim. Debitis dolorem harum ad aut voluptas. Nostrum veritatis aut voluptatum in ut. Corrupti libero rerum labore.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(14, 2, NULL, NULL, 'Elite Futsal Hub', 'elite-futsal-hub-457', 'Jl. Olahraga Utama No. 54, KOTA BANDUNG', '32', '3273', '3273010', 'WITA', 'Inventore id voluptate quam dolor consequuntur. Non eius qui ad soluta id velit ad quia. Voluptatibus veniam architecto ut quos suscipit asperiores et. Voluptas eum distinctio sed nulla at velit reprehenderit.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(15, 6, NULL, NULL, 'Nexus Badminton Hub', 'nexus-badminton-hub-758', 'Jl. Olahraga Utama No. 4, KOTA SEMARANG', '33', '3374', '3374010', 'WIB', 'Ipsam ex id velit fuga. Eveniet provident et dolorem ut doloribus et architecto.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(16, 6, NULL, NULL, 'Nexus Futsal Stadium', 'nexus-futsal-stadium-786', 'Jl. Olahraga Utama No. 4, KOTA SEMARANG', '33', '3374', '3374010', 'WIT', 'Sequi assumenda porro quasi et explicabo neque numquam qui. Excepturi et asperiores ducimus sapiente aut. Maiores aut rerum molestiae et. Nesciunt sint sint quo dolore est.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(17, 6, NULL, NULL, 'Elite Tennis Stadium', 'elite-tennis-stadium-661', 'Jl. Olahraga Utama No. 50, KOTA SURABAYA', '35', '3578', '3578010', 'WIT', 'Repellat totam alias omnis quasi quo autem. Iusto consequatur enim doloremque. Et dicta reiciendis odit corrupti maiores itaque.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(18, 6, NULL, NULL, 'Nexus Badminton Hub', 'nexus-badminton-hub-812', 'Jl. Olahraga Utama No. 50, KOTA SURABAYA', '35', '3578', '3578010', 'WITA', 'Excepturi temporibus tempora qui repellat ut ipsum. Ratione in autem iste quo. Voluptas voluptatem ut asperiores eaque laboriosam quis eum. Dolores rerum ut earum.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(19, 2, NULL, NULL, 'Champion Tennis Center', 'champion-tennis-center-293', 'Jl. Olahraga Utama No. 73, KOTA DENPASAR', '51', '5171', '5171010', 'WIB', 'Et eveniet ipsum ad illum velit ducimus. Rerum molestiae voluptas dolorum sed. Eligendi id distinctio sint amet perferendis eius omnis ab. Et quia est omnis voluptatum temporibus. Pariatur voluptatem vel perspiciatis et.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(20, 2, NULL, NULL, 'The Cage Futsal Hub', 'the-cage-futsal-hub-406', 'Jl. Olahraga Utama No. 73, KOTA DENPASAR', '51', '5171', '5171010', 'WITA', 'Quidem est et id inventore. Magni neque inventore eos quas qui. Dolorum nesciunt atque labore et ab voluptates. Aut nam voluptas ut.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(21, 2, NULL, NULL, 'Elite Tennis Sport Club', 'elite-tennis-sport-club-102', 'Jl. Olahraga Utama No. 67, KOTA BALIKPAPAN', '64', '6471', '6471010', 'WIB', 'Illum suscipit dolor ut dolores praesentium consectetur vitae. Fugiat alias esse ut. Nulla voluptas quia veniam. Quam facere accusamus voluptatem et dignissimos neque. Dolor in in vitae ab autem modi.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(22, 2, NULL, NULL, 'Grand Badminton Center', 'grand-badminton-center-320', 'Jl. Olahraga Utama No. 67, KOTA BALIKPAPAN', '64', '6471', '6471010', 'WITA', 'Eveniet rerum sequi minus earum perferendis. Nostrum nisi cum amet dolorum. Cumque quis enim nisi commodi architecto sint. Est veritatis eligendi aut qui.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(23, 2, NULL, NULL, 'Pro Basketball Stadium', 'pro-basketball-stadium-159', 'Jl. Olahraga Utama No. 100, KOTA MAKASSAR', '73', '7371', '7371010', 'WIT', 'Quia saepe voluptatem debitis dolorem inventore deleniti id. Quae adipisci ad vero totam. Ut ipsam amet autem molestiae facere. Et laudantium consequatur ut et.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(24, 2, NULL, NULL, 'The Cage Futsal Hub', 'the-cage-futsal-hub-895', 'Jl. Olahraga Utama No. 100, KOTA MAKASSAR', '73', '7371', '7371010', 'WIT', 'Dolor saepe officiis velit nemo voluptate dicta dignissimos. Eos necessitatibus est omnis quae natus nulla. Aspernatur cum beatae nam. Ab placeat nobis veniam iure. Qui ipsa aut hic veritatis quia.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(25, 6, NULL, NULL, 'Sky Futsal Hub', 'sky-futsal-hub-592', 'Jl. Olahraga Utama No. 16, KOTA JAYAPURA', '91', '9171', '9171010', 'WIT', 'Non blanditiis sint eos aut in odit quos. Enim autem dolorem nisi eos blanditiis impedit quam. Fugiat ut modi dolorem libero reiciendis.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(26, 6, NULL, NULL, 'Sky Badminton Hub', 'sky-badminton-hub-623', 'Jl. Olahraga Utama No. 16, KOTA JAYAPURA', '91', '9171', '9171010', 'WIB', 'Illum quam sapiente saepe quia blanditiis quia quaerat aut. Quasi nihil accusamus illo sit reprehenderit ad et. Dolorem ut velit quia maxime dolore impedit commodi aut.', 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&q=80&w=800', 0, 1, '2026-05-04 10:49:14', '2026-05-04 10:49:14'),
(27, 31, 'anugrah nababan', '89502953434', 'Lapangan Anugrah', 'lapangan-anugrah-7jvEq', 'jl.glambir 5', NULL, '1271', NULL, 'WIB', NULL, NULL, 1, 1, '2026-05-11 09:20:00', '2026-05-11 09:20:24'),
(28, 32, 'anugrah nababan', '89502953221', 'Lapangan Anugrah Nababan', 'lapangan-anugrah-nababan-dmiYi', 'jl.glambir 5', NULL, '1271', NULL, 'WIB', NULL, NULL, 1, 1, '2026-05-18 11:13:42', '2026-05-18 11:20:26'),
(29, 33, 'Jija Sembiring', '89502953221', 'Jija Lapangan', 'jija-lapangan-AmfUe', 'jl.glambir 5', NULL, '5171', NULL, 'WIB', NULL, NULL, 1, 1, '2026-05-18 12:02:53', '2026-05-18 12:02:59'),
(30, 34, 'anugrah nababan', '89502953221', 'Sport center asikin', 'sport-center-asikin-7wXMj', 'jl.glambir 5', NULL, '1271', NULL, 'WIB', NULL, NULL, 1, 1, '2026-06-02 04:35:32', '2026-06-02 07:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `balance` decimal(14,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `vendor_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 6, 9000000.00, '2026-04-27 20:10:33', '2026-04-27 20:10:33'),
(2, 31, 220700.00, '2026-05-11 10:29:26', '2026-05-31 11:16:27'),
(3, 34, 0.00, '2026-06-02 05:37:20', '2026-06-02 05:37:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_kode_booking_unique` (`kode_booking`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_court_id_foreign` (`court_id`);

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
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courts_venue_id_foreign` (`venue_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_regency_id_foreign` (`regency_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payouts_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regencies`
--
ALTER TABLE `regencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regencies_province_id_foreign` (`province_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `venues_slug_unique` (`slug`),
  ADD KEY `venues_vendor_id_foreign` (`vendor_id`),
  ADD KEY `venues_province_id_foreign` (`province_id`),
  ADD KEY `venues_regency_id_foreign` (`regency_id`),
  ADD KEY `venues_district_id_foreign` (`district_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_vendor_id_foreign` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_court_id_foreign` FOREIGN KEY (`court_id`) REFERENCES `courts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courts`
--
ALTER TABLE `courts`
  ADD CONSTRAINT `courts_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_regency_id_foreign` FOREIGN KEY (`regency_id`) REFERENCES `regencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regencies`
--
ALTER TABLE `regencies`
  ADD CONSTRAINT `regencies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `venues`
--
ALTER TABLE `venues`
  ADD CONSTRAINT `venues_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `venues_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `venues_regency_id_foreign` FOREIGN KEY (`regency_id`) REFERENCES `regencies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `venues_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
