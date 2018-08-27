-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2018 at 09:22 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mylife`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_category`
--

CREATE TABLE `menu_item_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_menu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_EN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_JP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_VN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `companyId` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_item_category`
--

INSERT INTO `menu_item_category` (`id`, `code`, `name_menu`, `name_EN`, `name_JP`, `name_VN`, `image`, `companyId`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Z', 'ZENSAI', 'APPETIZER', '前菜', 'KHAI VỊ', NULL, 2, '2018-08-20 17:00:00', '2018-08-20 17:00:00', NULL),
(2, 'Z', 'MUSHI', 'CHAWANMUSHI', '茶碗蒸し', '', NULL, 2, '2018-08-21 05:01:33', '2018-08-21 05:01:33', NULL),
(3, 'SL', 'SALADA', 'SALAD', 'サラダ', 'RAU TRỘN', NULL, 2, '2018-08-21 05:05:19', '2018-08-21 05:05:19', NULL),
(4, 'SA', 'SASHIMI', 'SASHIMI', 'お刺身', 'ĐỒ SỐNG', NULL, 2, '2018-08-21 05:05:19', '2018-08-21 05:05:19', NULL),
(5, 'NI', 'NIGIRI', 'NIGIRI SUSHI', 'にぎり', 'CƠM NẮM', NULL, 2, '2018-08-21 05:05:20', '2018-08-21 05:05:20', NULL),
(6, 'GU', 'GUNKAN', 'RICE WITH NORI', '軍艦巻き', 'CƠM CUỘN RONG BIỂN', NULL, 2, '2018-08-21 06:52:05', '2018-08-21 06:52:05', NULL),
(7, 'TM', 'TEMAKI', ' HAND ROLL', '手巻き', 'CƠM CUỘN', NULL, 2, '2018-08-21 07:01:14', '2018-08-21 07:01:14', NULL),
(8, 'R', 'ROLL', 'ROLL', '巻き寿司', 'CƠM CUỘN', NULL, 2, '2018-08-21 07:01:14', '2018-08-21 07:01:14', NULL),
(9, 'MA', 'MAKI', 'MAKI SUSHI', '巻き', 'CƠM CUỘN MAKI ', NULL, 2, '2018-08-21 07:01:14', '2018-08-21 07:01:14', NULL),
(10, 'A', 'AGEMONO', 'FRIED', '揚げ物', 'ĐỒ CHIÊN', NULL, 2, '2018-08-21 07:01:14', '2018-08-21 07:01:14', NULL),
(11, 'Y', 'YAKIMONO', 'GRILLED', '焼き物', 'ĐỒ NƯỚNG', NULL, 2, '2018-08-21 07:01:15', '2018-08-21 07:01:15', NULL),
(12, 'GO', 'GOHANMONO', 'RICE', 'ご飯もの', 'CƠM', NULL, 2, '2018-08-21 07:01:15', '2018-08-21 07:01:15', NULL),
(13, 'MI', 'MISO', 'SOUP', '汁物', 'CANH', NULL, 2, '2018-08-21 07:12:43', '2018-08-21 07:12:43', NULL),
(14, 'O', 'OKAYU', 'CONGEE', 'お粥', 'CHÁO', NULL, 2, '2018-08-21 07:12:43', '2018-08-21 07:12:43', NULL),
(15, 'ME', 'MENRUI', 'NOODLE', '麺類', 'MÌ ', NULL, 2, '2018-08-21 07:12:43', '2018-08-21 07:12:43', NULL),
(16, 'NA', 'NABEMONO', 'HOT POT', 'お鍋', 'LẨU', NULL, 2, '2018-08-21 07:12:43', '2018-08-21 07:12:43', NULL),
(17, 'EXTRA', 'EXTRA', 'EXTRA', 'お鍋の追加', 'MÓN THÊ', NULL, 2, '2018-08-21 07:12:43', '2018-08-21 07:12:43', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_item_category`
--
ALTER TABLE `menu_item_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_companyid_foreign` (`companyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_item_category`
--
ALTER TABLE `menu_item_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_item_category`
--
ALTER TABLE `menu_item_category`
  ADD CONSTRAINT `menu_companyid_foreign0` FOREIGN KEY (`companyId`) REFERENCES `company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
