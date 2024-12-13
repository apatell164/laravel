-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2024 at 06:39 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_scratch`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Development', 'D_001', '2024-12-06 05:38:05', '2024-12-10 01:07:03'),
(2, 'Design', 'D_002', '2024-12-06 05:41:11', '2024-12-06 05:45:34'),
(3, 'SEO', 'D_003', '2024-12-06 05:42:31', '2024-12-06 05:42:31'),
(4, 'QA', 'D_004', '2024-12-09 23:53:55', '2024-12-09 23:53:55'),
(5, 'Sales', 'D_005', '2024-12-09 23:54:35', '2024-12-09 23:55:05'),
(6, 'Graphics', 'D_006', '2024-12-10 00:04:47', '2024-12-10 00:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
CREATE TABLE IF NOT EXISTS `designations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_structure_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `leave_day` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designations_salary_structure_id_index` (`salary_structure_id`),
  KEY `designations_department_id_index` (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `designation_name`, `designation_id`, `salary_structure_id`, `department_id`, `leave_day`, `created_at`, `updated_at`) VALUES
(1, 'Senior software engineer', 'Des_001', 2, 1, '20', '2024-12-09 03:54:29', '2024-12-09 03:54:29'),
(2, 'Jr designer', 'Des_002', 1, 2, '10', '2024-12-09 08:12:14', '2024-12-09 08:12:14'),
(3, 'Team lead', 'Des_003', 2, 3, '20', '2024-12-09 08:12:30', '2024-12-09 08:12:30'),
(4, 'Senior Web Designer', 'Des_004', 2, 2, '10', '2024-12-10 00:10:42', '2024-12-10 00:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `designation_id` bigint UNSIGNED NOT NULL,
  `salary_structure_id` bigint UNSIGNED NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `hire_date` date NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_mode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  KEY `employees_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `employee_id`, `department_id`, `designation_id`, `salary_structure_id`, `date_of_birth`, `hire_date`, `email`, `password`, `phone`, `location`, `employee_image`, `joining_mode`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Apeksha M Patel', 'RR_001', 1, 1, 2, '1999-04-16', '2024-11-25', 'ampatel@netclues.in', '$2y$12$Aa47rWTM5yO7dC04OMtu2OxOMJTyv2QkjKd8KE3AklKj27xihaS4K', '7968040366', 'Ahmedabad', NULL, 'referral', NULL, '2024-12-10 01:20:34', '2024-12-11 00:23:38'),
(3, 'Megha Rajavat', 'RR_002', 2, 2, 1, '2000-04-12', '2023-01-02', 'mrajavat@netclues.in', '$2y$12$Aa47rWTM5yO7dC04OMtu2OxOMJTyv2QkjKd8KE3AklKj27xihaS4K', '8523697410', 'Ahmedabad', NULL, 'walk-in', NULL, '2024-12-10 07:48:13', '2024-12-10 07:48:37'),
(4, 'Aarul Vala', 'RR_003', 1, 1, 2, '2000-11-01', '2023-12-20', 'avala@netclues.in', '$2y$12$QCQw.Q6BQIWi1puiTNjZsOE7x3XmU71u576brSwz6cJYxZ6biQAIe', '7968040366', 'Ahmedabad', NULL, 'referral', NULL, '2024-12-10 07:59:13', '2024-12-10 07:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `employees_old`
--

DROP TABLE IF EXISTS `employees_old`;
CREATE TABLE IF NOT EXISTS `employees_old` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees_old`
--

INSERT INTO `employees_old` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '$2y$12$Aa47rWTM5yO7dC04OMtu2OxOMJTyv2QkjKd8KE3AklKj27xihaS4K', '2024-12-05 06:17:05', '2024-12-05 06:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

DROP TABLE IF EXISTS `leaves`;
CREATE TABLE IF NOT EXISTS `leaves` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_type_id` bigint UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `leave_type_id`, `from_date`, `to_date`, `total_days`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 2, '2024-12-23', '2024-12-24', '1', 'Test', 'approved', '2024-12-10 04:43:35', '2024-12-11 05:20:34');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `leave_type_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_days` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `leave_type_id`, `leave_days`, `created_at`, `updated_at`) VALUES
(1, 'Half Day', '0.5', '2024-12-10 03:08:05', '2024-12-11 00:27:05'),
(2, 'Full Day', '1', '2024-12-10 03:08:11', '2024-12-10 03:08:11'),
(3, 'Birthday Leave', '0.5', '2024-12-10 03:08:33', '2024-12-10 03:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2024_12_06_093938_create_departments_table', 2),
(4, '2024_12_06_093736_create_designations_table', 3),
(5, '2024_12_06_122340_create_salary_structures_table', 4),
(6, '2024_12_10_082055_create_leave_types_table', 5),
(7, '2024_12_10_095413_create_leaves_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ampatel@netclues.in', '$2y$12$I8jdjuS/tYpVfYkljZjygOBxqO1HBSCO9JrEq.Qes1AZG0pZoesiC', '2024-12-05 07:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `salary_structures`
--

DROP TABLE IF EXISTS `salary_structures`;
CREATE TABLE IF NOT EXISTS `salary_structures` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `salary_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `mobile_allowance` decimal(8,2) NOT NULL,
  `medical_expenses` decimal(8,2) NOT NULL,
  `houseRent_allowance` decimal(8,2) NOT NULL,
  `total_salary` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_structures`
--

INSERT INTO `salary_structures` (`id`, `salary_class`, `basic_salary`, `mobile_allowance`, `medical_expenses`, `houseRent_allowance`, `total_salary`, `created_at`, `updated_at`) VALUES
(1, 'Entry Level', 3000.00, 200.00, 100.00, 200.00, 3500.00, '2024-12-06 07:13:36', '2024-12-11 05:31:02'),
(2, 'Senior Level', 50000.00, 2000.00, 3000.00, 5000.00, 60000.00, '2024-12-06 07:35:48', '2024-12-11 05:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bjm8RdPsItSAdS6UgeDRbDkH9zRniFNB0tScroIR', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib1c0SXcxQ0FCSWM2eGk4VnRUQzFyRkROZ3ZzaUM2ZU5JSlJCaHVhciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1MjoiaHR0cDovL2xvY2FsaG9zdC9sYXJhdmVsL3B1YmxpYy9FbXBsb3llZS9hZGRFbXBsb3llZSI7fX0=', 1733921349),
('Fky1oBnhcvbRuGznou4JZPJrTty7fsVDhvRW2z1w', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHo4QWcxeWFmOUtMMk5WSjBlTVFHVmhJMjhYSUN5WXRqUng0VEs5ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9wdWJsaWMvTGVhdmUvTGVhdmVTdGF0dXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1734070493),
('bqBYK7ylAYjxbpSojTIFnwmcr8pBW99tlSGeMNZr', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTTZGcHRiMzI1T0gxaUpPWHVCbEtmS0U1eGJDUGxzcHVRZ0dGeU5IVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly9sb2NhbGhvc3QvbGFyYXZlbC9wdWJsaWMvTGVhdmUvbXlMZWF2ZUJhbGFuY2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjU3OiJsb2dpbl9mcm9udC11c2VyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1733913472);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2024-12-05 04:38:59', '$2y$12$PcB8PY9tMZNlep85F4OZC.LK.kAB53j.EerExjYVDbbgBCy3OMTym', 'hCtd2Tc2Gx', '2024-12-05 04:39:00', '2024-12-05 04:39:00'),
(2, 'Apeksha Patel', 'ampatel@netclues.in', NULL, '$2y$12$ZcsSlnM2XGf.AHdNILUc7OMhOrw83..zZYdn47D00gGtBHhNhaXR.', NULL, '2024-12-05 04:46:11', '2024-12-11 00:06:27');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
