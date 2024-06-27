-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 10:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-ukom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Alat Diagnostik', '2024-06-27 02:28:45', '2024-06-27 12:21:12'),
(2, 'Alat Bedah', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(3, 'Alat Laboratorium', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(4, 'Alat Terapi', '2024-06-27 02:28:45', '2024-06-27 12:10:41');

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Stetoskop', 475000, 1, 'stetoskop.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(2, 'Sfigmomanometer', 649000, 1, 'sfigmomanometer.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(3, 'Termometer', 249000, 1, 'termometer.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(4, 'Elektrokardiogram (EKG)', 87999000, 1, 'Elektrokardiogram-(EKG).jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(5, 'Ultrasonografi (USG)', 36999000, 1, 'Ultrasonografi-(USG).jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(6, 'Pisau Bedah (Scalpel)', 12000, 2, 'Pisau-Bedah-(Scalpel).jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(7, 'Gunting Bedah', 149000, 2, 'gunting-bedah.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(8, 'Forceps', 5399000, 2, 'forceps.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(9, 'Retractor', 366300, 2, 'retractor.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(10, 'Centrifuge', 159999000, 3, 'centrifuge.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(11, 'Mikroskop', 13999000, 3, 'mikroskop.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(12, 'Spectrophotometer', 26999000, 3, 'spectrophotometer.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(13, 'Nebulizer', 919000, 4, 'nebulizer.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(14, 'Inhaler', 168700, 4, 'inhaler.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(15, 'Pompa Infus', 12979000, 4, 'pompa-infus.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45'),
(16, 'Electroconvulsive Therapy (ECT) Machines', 3644000, 4, 'Electroconvulsive-Therapy-(ECT)-Machines.jpg', '2024-06-27 02:28:45', '2024-06-27 02:28:45');

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
(4, '2024_06_03_111118_add_userdata_to_user', 1),
(5, '2024_06_03_111131_create_categories_table', 1),
(6, '2024_06_03_111222_create_items_table', 1),
(7, '2024_06_03_111230_create_transacations_table', 1),
(8, '2024_06_03_111415_create_transaction_item_table', 1),
(9, '2024_06_04_100828_add_role_to_users', 1),
(10, '2024_06_05_052109_add_price_to_transaction_item', 1),
(11, '2024_06_05_054010_add_status_to_transactions', 1);

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
('lAXAf3uEANuUIXFSiddm29UeSdnOaOTJbB0ythLD', 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibEVDdlUzaWF4a0Q1SUpYYjNLMllncmdRSGdkWVJoaVFnd00yVTlHeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yeSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIxO30=', 1719518343),
('lskwpqC8vCEDbeAmgm4DnfNwiACnL7UBLyf7hX2i', 22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWFJuZUZqeHBnNjBTNDBtQWxyRkVqVm1BY0hkcXgyUjRzSmFKR1c2diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjIyO30=', 1719517902),
('OOXRCneyXLq8pOUKCCfebTNoJz6sVWla9F82o1Ug', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibDJQeWprN2ltTEIyYUZQUjhLSUZuaDNFcHYwMkVjeDB4QTZFYWZsMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1719517885);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `total` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','shipped','canceled','done') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `payment_method`, `total`, `created_at`, `updated_at`, `status`) VALUES
(1, 22, 'debit', 898000, '2024-06-27 12:48:53', '2024-06-27 12:48:53', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_item`
--

CREATE TABLE `transaction_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_item`
--

INSERT INTO `transaction_item` (`id`, `transaction_id`, `item_id`, `qty`, `created_at`, `updated_at`, `price`) VALUES
(1, 1, 2, 1, NULL, NULL, 649000),
(2, 1, 3, 1, NULL, NULL, 249000);

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `metadata` text DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `birthdate`, `gender`, `address`, `city`, `phone`, `metadata`, `role`) VALUES
(1, 'Candida Reynolds', 'jadon39@example.net', '2024-06-27 02:28:45', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', '7ZsvXn5oaD', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1994-03-22', 'female', '72708 Erling Cliffs\nNorth Efren, CO 77031', 'Gleasonhaven', '+1-248-348-0352', NULL, 'admin'),
(2, 'Chandler Roob', 'econn@example.com', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'J6GtWSmBYK', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2003-04-27', 'female', '21120 Collins Branch Suite 343\nWuckertborough, NY 60860', 'Hermannmouth', '(386) 346-5024', NULL, 'visitor'),
(3, 'Reanna Koch II', 'rsauer@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', '7xRb3ji7ak', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1972-05-29', 'male', '11140 Waters Station\nDellview, AR 96704', 'New Elzashire', '+1-551-753-6522', NULL, 'visitor'),
(4, 'Brett Rosenbaum', 'buford71@example.net', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'cUolYavKv8', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2008-02-13', 'male', '9589 Mante View\nBernardoport, TX 64667-4941', 'Port Andreanne', '1-781-604-7171', NULL, 'visitor'),
(5, 'Sandra Tromp', 'morissette.griffin@example.net', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'KigI1J8H2K', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2013-12-13', 'female', '8351 Lang Dam Apt. 275\nLake Nova, VA 45033-5292', 'Runteton', '+1 (386) 573-1724', NULL, 'visitor'),
(6, 'Salma Abernathy', 'skuhic@example.com', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'ZjMq1K3tbX', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1974-08-06', 'female', '3655 Dudley Villages Apt. 787\nSanfordberg, OK 17391', 'West Caterina', '+1-706-859-6267', NULL, 'visitor'),
(7, 'Ayden Larkin', 'qrowe@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'iRgh4pJGZ7', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2006-07-09', 'male', '61132 Maegan Tunnel Apt. 365\nSawaynport, RI 47904', 'Howellhaven', '952-731-6059', NULL, 'visitor'),
(8, 'Dr. Jana Borer DVM', 'mills.ladarius@example.com', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'WuSPzsZJsK', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1976-06-14', 'male', '90356 Alf Isle Apt. 794\nFlatleyville, OR 59738', 'West Amytown', '973.380.8157', NULL, 'visitor'),
(9, 'Roslyn Hand V', 'botsford.lucas@example.net', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'xL8zhNTCYD', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1978-10-15', 'female', '57798 Margaretta Spur\nAdriennehaven, NH 28669-1157', 'Raleighville', '+1.806.587.7220', NULL, 'visitor'),
(10, 'Kay Frami', 'carolyn65@example.net', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'zr2szEmDyq', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2018-07-18', 'male', '138 Romaguera Lakes Apt. 764\nPort Alethamouth, CT 61789', 'Brakustown', '+1 (781) 817-5034', NULL, 'visitor'),
(11, 'Prof. Oral Rohan PhD', 'ladarius63@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'EV0KhbeykD', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2016-05-21', 'male', '585 Prosacco Row Apt. 299\nWest Shaunbury, PA 63999-8924', 'South Bobbieport', '+1.408.440.0276', NULL, 'visitor'),
(12, 'Mr. Axel Bartoletti', 'feest.ahmad@example.net', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'MmRLLj1rSR', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1992-04-06', 'male', '952 Geo Points Suite 437\nWest Marcville, IL 60518-5859', 'Kovacekmouth', '(323) 299-0195', NULL, 'visitor'),
(13, 'Agustina Wiegand', 'imonahan@example.com', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'LTztrG08Hb', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1989-12-31', 'male', '260 Lang Locks Apt. 473\nPort Lowellland, KY 47616', 'Port Tateborough', '1-458-526-2277', NULL, 'visitor'),
(14, 'Hollie Jenkins', 'cormier.torey@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'ZnfchpEXsO', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2013-03-04', 'male', '7682 Everett Fords Apt. 991\nJohnathonland, OR 74244-2051', 'Jadonstad', '+1.980.277.8497', NULL, 'visitor'),
(15, 'Dr. Arianna McKenzie', 'jacobi.laney@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'eEDJRlyQWC', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2007-11-12', 'male', '2548 Rippin Mount\nPagacchester, NV 18150-7546', 'South Frederik', '337.884.5833', NULL, 'visitor'),
(16, 'Harmony Bednar IV', 'marisa26@example.net', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'vCvtrmdoTe', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1970-03-11', 'female', '97003 Clair Cliff Suite 581\nSouth Elisabeth, DC 62092', 'North Kimchester', '+1 (732) 966-8973', NULL, 'visitor'),
(17, 'Carey Moen MD', 'wcollier@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'fn8MLnv5BB', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2009-04-20', 'male', '72172 Lang Shores Suite 718\nCliftonville, CA 29874-9374', 'Kunzeburgh', '786-897-8877', NULL, 'visitor'),
(18, 'Prof. Mose Kertzmann', 'danyka.leuschke@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'YwSFlr1C5D', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '1976-09-13', 'female', '903 Kathleen Stravenue Apt. 039\nNew Sandyshire, CO 36689', 'Wizamouth', '1-817-899-3726', NULL, 'visitor'),
(19, 'Anita Kreiger', 'gtrantow@example.org', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'aHCX8DzUep', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2017-01-30', 'male', '82019 Runolfsdottir Viaduct\nWest Brendon, MD 15448', 'Port Sydneeview', '878-596-5313', NULL, 'visitor'),
(20, 'Billie Russel', 'madalyn.stoltenberg@example.com', '2024-06-27 02:28:46', '$2y$12$qFnYVwxydZ.1vMNSYeAzDeXVkSuaW0OO99LsME/2GIrcjpODowu9C', 'frselP9vRE', '2024-06-27 02:28:46', '2024-06-27 02:28:46', '2016-05-16', 'male', '94115 Carroll Pine\nMarkstown, LA 75185-5296', 'North Jaylen', '+1.325.493.3125', NULL, 'visitor'),
(21, 'Pira Admin', 'piraadmin@gmail.com', NULL, '$2y$12$xqMSjx5s6kY0xvcwFXZAIuHUPwE7vFZ4y82tsLGG6d1enOtU6Nm4e', NULL, '2024-06-27 02:29:59', '2024-06-27 02:29:59', '2024-06-09', 'male', 'bumi', 'bumi', '586-318-7655', NULL, 'admin'),
(22, 'Pira User', 'pirauser@gmail.com', NULL, '$2y$12$Z6zWxU5M.NISf/u215QTreBdDCz/FscJ1RauV1Q7fDYVPoXomk/Gy', NULL, '2024-06-27 08:36:56', '2024-06-27 08:36:56', '2024-06-17', 'male', 'bumi', 'bumi', '586-318-7655', NULL, 'visitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_item_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_item`
--
ALTER TABLE `transaction_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaction_item`
--
ALTER TABLE `transaction_item`
  ADD CONSTRAINT `transaction_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `transaction_item_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
