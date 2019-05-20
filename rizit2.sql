-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2018 at 02:39 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rizit2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Index', 'fa-bar-chart', '/', NULL, NULL),
(2, 0, 2, 'Admin', 'fa-tasks', '', NULL, NULL),
(3, 2, 3, 'Users', 'fa-users', 'auth/users', NULL, NULL),
(4, 2, 4, 'Roles', 'fa-user', 'auth/roles', NULL, NULL),
(5, 2, 5, 'Permission', 'fa-ban', 'auth/permissions', NULL, NULL),
(6, 2, 6, 'Menu', 'fa-bars', 'auth/menu', NULL, NULL),
(7, 2, 7, 'Operation log', 'fa-history', 'auth/logs', NULL, NULL),
(8, 0, 7, 'Helpers', 'fa-gears', '', '2018-09-25 03:06:11', '2018-09-25 03:06:11'),
(9, 8, 8, 'Scaffold', 'fa-keyboard-o', 'helpers/scaffold', '2018-09-25 03:06:12', '2018-09-25 03:06:12'),
(10, 8, 9, 'Database terminal', 'fa-database', 'helpers/terminal/database', '2018-09-25 03:06:12', '2018-09-25 03:06:12'),
(11, 8, 10, 'Laravel artisan', 'fa-terminal', 'helpers/terminal/artisan', '2018-09-25 03:06:13', '2018-09-25 03:06:13'),
(12, 8, 11, 'Routes', 'fa-list-alt', 'helpers/routes', '2018-09-25 03:06:13', '2018-09-25 03:06:13'),
(13, 0, 12, 'Media manager', 'fa-file', 'media', '2018-09-25 03:07:20', '2018-09-25 03:07:20'),
(14, 0, 0, 'professions', 'fa-bars', 'professions', '2018-09-25 03:52:15', '2018-09-25 03:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_operation_log`
--

INSERT INTO `admin_operation_log` (`id`, `user_id`, `path`, `method`, `ip`, `input`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-09-25 03:03:49', '2018-09-25 03:03:49'),
(2, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-09-25 03:12:39', '2018-09-25 03:12:39'),
(3, 1, 'admin/media', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:12:44', '2018-09-25 03:12:44'),
(4, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-09-25 03:47:17', '2018-09-25 03:47:17'),
(5, 1, 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:47:28', '2018-09-25 03:47:28'),
(6, 1, 'admin/helpers/scaffold', 'POST', '127.0.0.1', '{\"table_name\":\"professions\",\"model_name\":\"App\\\\Models\\\\Professions\",\"controller_name\":\"App\\\\Admin\\\\Controllers\\\\Professions\\\\ProfessionsController\",\"create\":[\"controller\"],\"primary_key\":\"id\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\"}', '2018-09-25 03:48:47', '2018-09-25 03:48:47'),
(7, 1, 'admin/helpers/scaffold', 'GET', '127.0.0.1', '[]', '2018-09-25 03:48:47', '2018-09-25 03:48:47'),
(8, 1, 'admin/helpers/scaffold', 'POST', '127.0.0.1', '{\"table_name\":\"professions\",\"model_name\":\"App\\\\Models\\\\Professions\",\"controller_name\":\"App\\\\Admin\\\\Controllers\\\\Professions\\\\ProfessionsController\",\"create\":[\"controller\"],\"fields\":[{\"name\":null,\"type\":\"string\",\"key\":null,\"default\":null,\"comment\":null}],\"timestamps\":\"on\",\"primary_key\":\"id\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\"}', '2018-09-25 03:49:08', '2018-09-25 03:49:08'),
(9, 1, 'admin/helpers/scaffold', 'GET', '127.0.0.1', '[]', '2018-09-25 03:49:09', '2018-09-25 03:49:09'),
(10, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:52:03', '2018-09-25 03:52:03'),
(11, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"professions\",\"icon\":\"fa-bars\",\"uri\":\"professions\",\"roles\":[\"1\",null],\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\"}', '2018-09-25 03:52:15', '2018-09-25 03:52:15'),
(12, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2018-09-25 03:52:15', '2018-09-25 03:52:15'),
(13, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '[]', '2018-09-25 03:52:17', '2018-09-25 03:52:17'),
(14, 1, 'admin/professions', 'GET', '127.0.0.1', '[]', '2018-09-25 03:53:36', '2018-09-25 03:53:36'),
(15, 1, 'admin/professions', 'GET', '127.0.0.1', '[]', '2018-09-25 03:54:30', '2018-09-25 03:54:30'),
(16, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"page\":\"2\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:54:35', '2018-09-25 03:54:35'),
(17, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"page\":\"2\"}', '2018-09-25 03:54:43', '2018-09-25 03:54:43'),
(18, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"page\":\"3\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:54:47', '2018-09-25 03:54:47'),
(19, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"4\"}', '2018-09-25 03:54:50', '2018-09-25 03:54:50'),
(20, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"page\":\"4\"}', '2018-09-25 03:55:07', '2018-09-25 03:55:07'),
(21, 1, 'admin/professions/74', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:55:16', '2018-09-25 03:55:16'),
(22, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"page\":\"4\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:55:20', '2018-09-25 03:55:20'),
(23, 1, 'admin/professions/61/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:58:02', '2018-09-25 03:58:02'),
(24, 1, 'admin/media', 'GET', '127.0.0.1', '[]', '2018-09-25 03:59:42', '2018-09-25 03:59:42'),
(25, 1, 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:59:47', '2018-09-25 03:59:47'),
(26, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:59:52', '2018-09-25 03:59:52'),
(27, 1, 'admin/professions/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 03:59:54', '2018-09-25 03:59:54'),
(28, 1, 'admin/professions/61/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:01:24', '2018-09-25 04:01:24'),
(29, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:01:29', '2018-09-25 04:01:29'),
(30, 1, 'admin/professions/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:01:31', '2018-09-25 04:01:31'),
(31, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:01:46', '2018-09-25 04:01:46'),
(32, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:03:06', '2018-09-25 04:03:06'),
(33, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:03:17', '2018-09-25 04:03:17'),
(34, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:03:33', '2018-09-25 04:03:33'),
(35, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:03:50', '2018-09-25 04:03:50'),
(36, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:04:30', '2018-09-25 04:04:30'),
(37, 1, 'admin/professions', 'GET', '127.0.0.1', '[]', '2018-09-25 04:04:32', '2018-09-25 04:04:32'),
(38, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:04:38', '2018-09-25 04:04:38'),
(39, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:04:47', '2018-09-25 04:04:47'),
(40, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:05:08', '2018-09-25 04:05:08'),
(41, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:05:49', '2018-09-25 04:05:49'),
(42, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:06:08', '2018-09-25 04:06:08'),
(43, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:07:24', '2018-09-25 04:07:24'),
(44, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:08:03', '2018-09-25 04:08:03'),
(45, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:08:20', '2018-09-25 04:08:20'),
(46, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:08:35', '2018-09-25 04:08:35'),
(47, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:08:41', '2018-09-25 04:08:41'),
(48, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:08:56', '2018-09-25 04:08:56'),
(49, 1, 'admin/professions/1', 'PUT', '127.0.0.1', '{\"ar_name\":\"exercitationem\",\"en_name\":\"blanditiis\",\"is_active\":\"off\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/professions\\/1\"}', '2018-09-25 04:09:07', '2018-09-25 04:09:07'),
(50, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:09:07', '2018-09-25 04:09:07'),
(51, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:09:09', '2018-09-25 04:09:09'),
(52, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:09:12', '2018-09-25 04:09:12'),
(53, 1, 'admin/professions/1', 'PUT', '127.0.0.1', '{\"ar_name\":\"exercitationem\",\"en_name\":\"blanditiis\",\"is_active\":\"on\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/professions\"}', '2018-09-25 04:09:13', '2018-09-25 04:09:13'),
(54, 1, 'admin/professions', 'GET', '127.0.0.1', '[]', '2018-09-25 04:09:14', '2018-09-25 04:09:14'),
(55, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:09:15', '2018-09-25 04:09:15'),
(56, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:09:21', '2018-09-25 04:09:21'),
(57, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:09:23', '2018-09-25 04:09:23'),
(58, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:09:31', '2018-09-25 04:09:31'),
(59, 1, 'admin/professions/1', 'PUT', '127.0.0.1', '{\"ar_name\":\"exercitationem\",\"en_name\":\"blanditiis\",\"is_active\":\"on\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\",\"after-save\":\"2\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/professions\"}', '2018-09-25 04:09:34', '2018-09-25 04:09:34'),
(60, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:09:35', '2018-09-25 04:09:35'),
(61, 1, 'admin/professions', 'GET', '127.0.0.1', '[]', '2018-09-25 04:13:16', '2018-09-25 04:13:16'),
(62, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"saleem\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:13:25', '2018-09-25 04:13:25'),
(63, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"ar_name\":\"t\"}', '2018-09-25 04:13:27', '2018-09-25 04:13:27'),
(64, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\"}', '2018-09-25 04:14:47', '2018-09-25 04:14:47'),
(65, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\"}', '2018-09-25 04:15:31', '2018-09-25 04:15:31'),
(66, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\",\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:15:45', '2018-09-25 04:15:45'),
(67, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\",\"_scope_\":\"is_active\"}', '2018-09-25 04:16:13', '2018-09-25 04:16:13'),
(68, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\",\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:16:19', '2018-09-25 04:16:19'),
(69, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\",\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:16:23', '2018-09-25 04:16:23'),
(70, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"ar_name\":\"t\",\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:16:25', '2018-09-25 04:16:25'),
(71, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:16:27', '2018-09-25 04:16:27'),
(72, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"is_active\"}', '2018-09-25 04:16:29', '2018-09-25 04:16:29'),
(73, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\"}', '2018-09-25 04:16:43', '2018-09-25 04:16:43'),
(74, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:16:47', '2018-09-25 04:16:47'),
(75, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:16:50', '2018-09-25 04:16:50'),
(76, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\",\"page\":\"2\"}', '2018-09-25 04:16:53', '2018-09-25 04:16:53'),
(77, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\",\"page\":\"3\"}', '2018-09-25 04:16:54', '2018-09-25 04:16:54'),
(78, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\",\"page\":\"3\"}', '2018-09-25 04:16:54', '2018-09-25 04:16:54'),
(79, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"page\":\"3\"}', '2018-09-25 04:17:24', '2018-09-25 04:17:24'),
(80, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"not_active\",\"page\":\"3\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:17:27', '2018-09-25 04:17:27'),
(81, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"not_active\",\"_pjax\":\"#pjax-container\",\"ar_name\":\"sale\",\"en_name\":null}', '2018-09-25 04:17:39', '2018-09-25 04:17:39'),
(82, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"not_active\",\"_pjax\":\"#pjax-container\",\"ar_name\":\"sale\"}', '2018-09-25 04:17:43', '2018-09-25 04:17:43'),
(83, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"not_active\",\"_pjax\":\"#pjax-container\",\"ar_name\":null,\"en_name\":null}', '2018-09-25 04:17:46', '2018-09-25 04:17:46'),
(84, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:17:51', '2018-09-25 04:17:51'),
(85, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"_pjax\":\"#pjax-container\",\"ar_name\":\"exercitationem\",\"en_name\":null}', '2018-09-25 04:17:59', '2018-09-25 04:17:59'),
(86, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:18:08', '2018-09-25 04:18:08'),
(87, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:18:23', '2018-09-25 04:18:23'),
(88, 1, 'admin/professions/create', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:18:30', '2018-09-25 04:18:30'),
(89, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:18:37', '2018-09-25 04:18:37'),
(90, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"is_active\"}', '2018-09-25 04:19:05', '2018-09-25 04:19:05'),
(91, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"not_active\"}', '2018-09-25 04:19:09', '2018-09-25 04:19:09'),
(92, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"not_active\",\"ar_name\":\"s\",\"en_name\":null}', '2018-09-25 04:19:15', '2018-09-25 04:19:15'),
(93, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:19:32', '2018-09-25 04:19:32'),
(94, 1, 'admin/media', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:19:38', '2018-09-25 04:19:38'),
(95, 1, 'admin/helpers/scaffold', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:19:39', '2018-09-25 04:19:39'),
(96, 1, 'admin/helpers/terminal/database', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:19:43', '2018-09-25 04:19:43'),
(97, 1, 'admin/helpers/terminal/database', 'POST', '127.0.0.1', '{\"c\":\"db:mysql\",\"q\":\"show tables\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\"}', '2018-09-25 04:19:47', '2018-09-25 04:19:47'),
(98, 1, 'admin/helpers/terminal/artisan', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:19:51', '2018-09-25 04:19:51'),
(99, 1, 'admin/helpers/routes', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:19:52', '2018-09-25 04:19:52'),
(100, 1, 'admin/helpers/routes', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:20:00', '2018-09-25 04:20:00'),
(101, 1, 'admin/helpers/routes', 'GET', '127.0.0.1', '[]', '2018-09-25 04:26:39', '2018-09-25 04:26:39'),
(102, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:26:46', '2018-09-25 04:26:46'),
(103, 1, 'admin/professions/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:26:48', '2018-09-25 04:26:48'),
(104, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:26:50', '2018-09-25 04:26:50'),
(105, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:26:51', '2018-09-25 04:26:51'),
(106, 1, 'admin/professions/1', 'PUT', '127.0.0.1', '{\"ar_name\":\"exercitationem\",\"en_name\":\"blanditiis\",\"is_active\":\"on\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\",\"after-save\":\"1\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/professions\"}', '2018-09-25 04:27:01', '2018-09-25 04:27:01'),
(107, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '[]', '2018-09-25 04:27:02', '2018-09-25 04:27:02'),
(108, 1, 'admin/professions/1', 'PUT', '127.0.0.1', '{\"ar_name\":\"exercitationem\",\"en_name\":\"blanditiis\",\"is_active\":\"on\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\",\"after-save\":\"2\",\"_method\":\"PUT\"}', '2018-09-25 04:27:06', '2018-09-25 04:27:06'),
(109, 1, 'admin/professions/1', 'GET', '127.0.0.1', '[]', '2018-09-25 04:27:07', '2018-09-25 04:27:07'),
(110, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:27:09', '2018-09-25 04:27:09'),
(111, 1, 'admin/media', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:27:11', '2018-09-25 04:27:11'),
(112, 1, 'admin/media', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:27:32', '2018-09-25 04:27:32'),
(113, 1, 'admin/media', 'GET', '127.0.0.1', '[]', '2018-09-25 04:27:58', '2018-09-25 04:27:58'),
(114, 1, 'admin/media/folder', 'POST', '127.0.0.1', '{\"name\":\"test\",\"dir\":\"\\/\",\"_token\":\"AMKIrdKuxYPUTmeAzd0F1VdzD5gKcxy4gaQAyoMa\"}', '2018-09-25 04:28:10', '2018-09-25 04:28:10'),
(115, 1, 'admin/media', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:28:11', '2018-09-25 04:28:11'),
(116, 1, 'admin/media', 'GET', '127.0.0.1', '[]', '2018-09-25 04:28:29', '2018-09-25 04:28:29'),
(117, 1, 'admin/media/download', 'GET', '127.0.0.1', '{\"file\":\"badge_1.jpg\"}', '2018-09-25 04:28:35', '2018-09-25 04:28:35'),
(118, 1, 'admin/media', 'GET', '127.0.0.1', '{\"path\":\"\\/\",\"view\":\"list\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:28:41', '2018-09-25 04:28:41'),
(119, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:28:56', '2018-09-25 04:28:56'),
(120, 1, 'admin/media', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:29:09', '2018-09-25 04:29:09'),
(121, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:29:10', '2018-09-25 04:29:10'),
(122, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"is_active\"}', '2018-09-25 04:29:14', '2018-09-25 04:29:14'),
(123, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"not_active\"}', '2018-09-25 04:29:16', '2018-09-25 04:29:16'),
(124, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:29:19', '2018-09-25 04:29:19'),
(125, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:29:21', '2018-09-25 04:29:21'),
(126, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_export_\":\"page:1\"}', '2018-09-25 04:29:26', '2018-09-25 04:29:26'),
(127, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:29:38', '2018-09-25 04:29:38'),
(128, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:33:02', '2018-09-25 04:33:02'),
(129, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"2\"}', '2018-09-25 04:33:05', '2018-09-25 04:33:05'),
(130, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"3\"}', '2018-09-25 04:33:06', '2018-09-25 04:33:06'),
(131, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"4\"}', '2018-09-25 04:33:08', '2018-09-25 04:33:08'),
(132, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"page\":\"5\"}', '2018-09-25 04:33:10', '2018-09-25 04:33:10'),
(133, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:33:13', '2018-09-25 04:33:13'),
(134, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:33:19', '2018-09-25 04:33:19'),
(135, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 04:34:33', '2018-09-25 04:34:33'),
(136, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-09-25 04:34:35', '2018-09-25 04:34:35'),
(137, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-09-25 05:35:52', '2018-09-25 05:35:52'),
(138, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 06:19:27', '2018-09-25 06:19:27'),
(139, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"is_active\"}', '2018-09-25 06:19:33', '2018-09-25 06:19:33'),
(140, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"not_active\"}', '2018-09-25 06:19:36', '2018-09-25 06:19:36'),
(141, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 06:19:39', '2018-09-25 06:19:39'),
(142, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"is_active\"}', '2018-09-25 06:19:42', '2018-09-25 06:19:42'),
(143, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\",\"_scope_\":\"is_active\",\"ar_name\":\"et\",\"en_name\":null}', '2018-09-25 06:19:47', '2018-09-25 06:19:47'),
(144, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"is_active\",\"ar_name\":\"et\",\"en_name\":null}', '2018-09-25 06:21:27', '2018-09-25 06:21:27'),
(145, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"id\",\"ar_name\":\"et\",\"_pjax\":\"#pjax-container\"}', '2018-09-25 06:21:38', '2018-09-25 06:21:38'),
(146, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_scope_\":\"id\",\"_pjax\":\"#pjax-container\",\"ar_name\":null,\"en_name\":null}', '2018-09-25 06:21:47', '2018-09-25 06:21:47'),
(147, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 06:22:16', '2018-09-25 06:22:16'),
(148, 1, 'admin', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 06:22:18', '2018-09-25 06:22:18'),
(149, 1, 'admin', 'GET', '127.0.0.1', '[]', '2018-09-25 08:23:58', '2018-09-25 08:23:58'),
(150, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 08:24:02', '2018-09-25 08:24:02'),
(151, 1, 'admin/professions/1', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 08:24:07', '2018-09-25 08:24:07'),
(152, 1, 'admin/professions', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 08:24:09', '2018-09-25 08:24:09'),
(153, 1, 'admin/professions/1/edit', 'GET', '127.0.0.1', '{\"_pjax\":\"#pjax-container\"}', '2018-09-25 08:24:11', '2018-09-25 08:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, 'All permission', '*', '', '*', NULL, NULL),
(2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL),
(3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL),
(4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL),
(5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL),
(6, 'Admin helpers', 'ext.helpers', NULL, '/helpers/*', '2018-09-25 03:06:14', '2018-09-25 03:06:14'),
(7, 'Media manager', 'ext.media-manager', NULL, '/media*', '2018-09-25 03:07:20', '2018-09-25 03:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '2018-09-25 03:02:55', '2018-09-25 03:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL),
(1, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Eg403gu5tDGokfx/l2VBTeXvMhdA9UpWRp3UbaNrCSFF18WWkdUh2', 'Administrator', NULL, NULL, '2018-09-25 03:02:52', '2018-09-25 03:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_permissions`
--

CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_04_173148_create_admin_tables', 1),
(4, '2018_09_24_124709_create_professions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` int(10) UNSIGNED NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `ar_name`, `en_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'exercitationem', 'blanditiis', 1, '2018-09-25 03:29:02', '2018-09-25 04:09:14'),
(2, 'ipsa', 'quod', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(3, 'numquam', 'autem', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(4, 'et', 'doloremque', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(5, 'ut', 'corporis', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(6, 'animi', 'ut', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(7, 'in', 'qui', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(8, 'reiciendis', 'asperiores', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(9, 'eos', 'nesciunt', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(10, 'dolore', 'fugiat', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(11, 'facere', 'et', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(12, 'laborum', 'doloribus', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(13, 'quia', 'suscipit', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(14, 'pariatur', 'occaecati', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(15, 'pariatur', 'consectetur', 0, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(16, 'molestias', 'voluptas', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(17, 'delectus', 'doloremque', 1, '2018-09-25 03:29:02', '2018-09-25 03:29:02'),
(18, 'neque', 'ullam', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(19, 'in', 'eaque', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(20, 'molestiae', 'tempora', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(21, 'eos', 'error', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(22, 'ex', 'at', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(23, 'aut', 'suscipit', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(24, 'iure', 'minima', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(25, 'ut', 'sit', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(26, 'consequatur', 'ducimus', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(27, 'fugit', 'magni', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(28, 'deleniti', 'rerum', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(29, 'voluptate', 'minima', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(30, 'commodi', 'eum', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(31, 'illo', 'non', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(32, 'doloribus', 'nisi', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(33, 'eos', 'vitae', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(34, 'vitae', 'eaque', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(35, 'aut', 'modi', 0, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(36, 'occaecati', 'excepturi', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(37, 'rerum', 'accusantium', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(38, 'quasi', 'iste', 1, '2018-09-25 03:29:03', '2018-09-25 03:29:03'),
(39, 'praesentium', 'quasi', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(40, 'blanditiis', 'cupiditate', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(41, 'iure', 'ipsam', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(42, 'dolorem', 'qui', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(43, 'quo', 'voluptates', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(44, 'voluptatem', 'tempora', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(45, 'a', 'excepturi', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(46, 'dolor', 'debitis', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(47, 'voluptate', 'beatae', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(48, 'laboriosam', 'voluptatibus', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(49, 'dolorum', 'velit', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(50, 'excepturi', 'beatae', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(51, 'quasi', 'numquam', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(52, 'corrupti', 'nesciunt', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(53, 'id', 'saepe', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(54, 'qui', 'qui', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(55, 'dolore', 'omnis', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(56, 'dignissimos', 'nostrum', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(57, 'porro', 'omnis', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(58, 'molestiae', 'reprehenderit', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(59, 'id', 'quia', 0, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(60, 'omnis', 'pariatur', 1, '2018-09-25 03:29:04', '2018-09-25 03:29:04'),
(61, 'debitis', 'delectus', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(62, 'iste', 'et', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(63, 'harum', 'temporibus', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(64, 'voluptatem', 'ipsam', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(65, 'molestiae', 'qui', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(66, 'qui', 'adipisci', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(67, 'officiis', 'voluptatem', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(68, 'velit', 'incidunt', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(69, 'eum', 'alias', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(70, 'fugit', 'pariatur', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(71, 'et', 'eos', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(72, 'molestias', 'quos', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(73, 'optio', 'ut', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(74, 'voluptatem', 'ducimus', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(75, 'doloremque', 'illo', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(76, 'nam', 'beatae', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(77, 'provident', 'ut', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(78, 'quam', 'id', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(79, 'sit', 'sit', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(80, 'in', 'recusandae', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(81, 'qui', 'fugit', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(82, 'recusandae', 'et', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(83, 'blanditiis', 'dolores', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(84, 'voluptatem', 'esse', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(85, 'voluptas', 'officia', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(86, 'in', 'incidunt', 0, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(87, 'maxime', 'provident', 1, '2018-09-25 03:29:05', '2018-09-25 03:29:05'),
(88, 'voluptatibus', 'eaque', 0, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(89, 'excepturi', 'consectetur', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(90, 'voluptatem', 'fuga', 0, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(91, 'quia', 'quaerat', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(92, 'id', 'saepe', 0, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(93, 'eum', 'quibusdam', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(94, 'qui', 'quibusdam', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(95, 'repellat', 'et', 0, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(96, 'aut', 'et', 0, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(97, 'atque', 'sit', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(98, 'in', 'natus', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(99, 'laborum', 'ad', 0, '2018-09-25 03:29:06', '2018-09-25 03:29:06'),
(100, 'quia', 'ratione', 1, '2018-09-25 03:29:06', '2018-09-25 03:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_name_unique` (`name`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_name_unique` (`name`);

--
-- Indexes for table `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`);

--
-- Indexes for table `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- Indexes for table `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- Indexes for table `admin_user_permissions`
--
ALTER TABLE `admin_user_permissions`
  ADD KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
