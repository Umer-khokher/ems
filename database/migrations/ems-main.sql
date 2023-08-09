-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 08, 2023 at 09:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems-main`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `status` enum('present','absent','late','leave','holiday','not_from_office') NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `is_edited` int(11) NOT NULL DEFAULT 0,
  `in_office` int(11) NOT NULL DEFAULT 1,
  `user_ip` varchar(255) DEFAULT NULL,
  `HTTP_USER_AGENT` varchar(512) DEFAULT NULL,
  `HTTP_ACCEPT` varchar(512) DEFAULT NULL,
  `HTTP_ACCEPT_LANGUAGE` varchar(512) DEFAULT NULL,
  `HTTP_ACCEPT_ENCODING` varchar(512) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `status`, `date`, `time`, `is_edited`, `in_office`, `user_ip`, `HTTP_USER_AGENT`, `HTTP_ACCEPT`, `HTTP_ACCEPT_LANGUAGE`, `HTTP_ACCEPT_ENCODING`, `created_at`, `updated_at`) VALUES
(1, 45, 'absent', '2023-08-03', '00:00:00', 1, 1, '203.175.72.72', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'en-US,en;q=0.9', 'gzip, deflate, br', '2023-08-03 09:32:20', '2023-08-03 18:45:59'),
(2, 45, 'late', '2023-08-04', '09:41:00', 0, 1, '203.175.72.72', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7', 'en-US,en;q=0.9', 'gzip, deflate, br', '2023-08-04 04:41:00', '2023-08-04 04:41:00'),
(29, 45, 'leave', '2023-08-22', '00:00:00', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-08-07 11:41:22', '2023-08-07 11:41:22'),
(30, 45, 'leave', '2023-08-23', '00:00:00', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-08-07 11:41:22', '2023-08-07 11:41:22'),
(31, 45, 'leave', '2023-08-24', '00:00:00', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-08-07 11:41:22', '2023-08-07 11:41:22'),
(32, 45, 'leave', '2023-08-25', '00:00:00', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-08-07 11:41:22', '2023-08-07 11:41:22'),
(33, 45, 'leave', '2023-08-28', '00:00:00', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-08-07 11:41:22', '2023-08-07 11:41:22');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2023_07_18_104434_create_sessions_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(7, '2023_07_18_174918_create_attendances_table', 3),
(8, '2023_08_03_105200_create_uleaver_table', 4),
(9, '2023_08_03_122403_create_uleavers_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `office_ips`
--

CREATE TABLE `office_ips` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office_ips`
--

INSERT INTO `office_ips` (`id`, `name`, `ip`, `date`, `created_at`, `updated_at`) VALUES
(4, 'nayatel', '39.32.108.93', '2023-08-06', NULL, NULL),
(5, 'stormfibre', '39.32.108.93', '2023-08-06', NULL, NULL),
(6, 'ptcl', '39.32.108.93', '2023-08-06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1pLumCU9ryLGppROrszyU7UngWwhR2WZ6sCqHQw7', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36', 'YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xlYXZlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJFZTNMMVhHeUxPeU9Gc0hkRUFudk8zN0o3SGhMMU1XVXFOWHVZZnpFIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1691410681);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Management', 'management', '2023-07-28 21:35:59', '2023-07-28 21:35:59'),
(2, 'Web Development', 'web-development', '2023-07-28 21:35:59', '2023-07-28 21:35:59'),
(3, 'Mobile Development', 'mobile-development', '2023-07-28 21:35:59', '2023-07-28 21:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uleavers`
--

CREATE TABLE `uleavers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `days` double(8,2) NOT NULL,
  `leave_reason` varchar(255) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uleavers`
--

INSERT INTO `uleavers` (`id`, `user_id`, `date`, `days`, `leave_reason`, `status`, `reject_reason`, `created_at`, `updated_at`) VALUES
(9, 45, '2023-08-05', 2.00, 'after', 'pending', NULL, '2023-08-04 10:29:00', '2023-08-04 10:29:00'),
(10, 45, '2023-08-11', 3.00, 'for testing', 'pending', NULL, '2023-08-04 10:31:51', '2023-08-04 10:31:51'),
(11, 45, '2023-08-13', 3.00, 'fortesting on aug 6 2023', 'pending', NULL, '2023-08-06 15:14:40', '2023-08-06 15:14:40'),
(12, 45, '2023-08-22', 5.00, 'final testing', 'approved', NULL, '2023-08-07 10:53:41', '2023-08-07 11:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` enum('superadmin','employee','interns') NOT NULL DEFAULT 'employee',
  `team_id` int(11) NOT NULL DEFAULT 2,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_new` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `employee_since` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `team_id`, `name`, `email`, `email_verified_at`, `password`, `is_new`, `remember_token`, `image`, `status`, `employee_since`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 1, 'PlanDStudios Administrator', 'admin@plandstudios.com', NULL, '$2y$10$lfeZgvej26SGGljuIXq5oe3JtFdvD3/Kuzbjmvka7uCha.qsjZxg.', 0, NULL, NULL, 'active', NULL, '2023-07-18 09:25:53', '2023-08-03 07:55:01'),
(45, 'employee', 2, 'umer khokher', 'umerkhokher11@gmail.com', NULL, '$2y$10$cN10Vb5kuKEj2DbUoketVucxGjB7t2cW2WCt5.o6llOngqSD29bB.', 0, NULL, NULL, 'active', '2023-08-03', '2023-08-03 09:20:45', '2023-08-03 09:32:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_ips`
--
ALTER TABLE `office_ips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uleavers`
--
ALTER TABLE `uleavers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uleavers_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `office_ips`
--
ALTER TABLE `office_ips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uleavers`
--
ALTER TABLE `uleavers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `uleavers`
--
ALTER TABLE `uleavers`
  ADD CONSTRAINT `uleavers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
