-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 05:48 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p2t_quanly`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `stars` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `hotel_type` int(11) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_keywords` text,
  `meta_desc` text,
  `amenities` text,
  `payment_opt` text,
  `check_in` varchar(15) DEFAULT NULL,
  `check_out` varchar(15) DEFAULT NULL,
  `policy` text,
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `surcharge` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `display_order` int(11) DEFAULT NULL,
  `related` varchar(200) DEFAULT NULL,
  `comm_fixed` double DEFAULT '0',
  `comm_percentage` double DEFAULT '0',
  `tax_fixed` double DEFAULT '0',
  `tax_percentage` double DEFAULT '0',
  `email` varchar(200) DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(250) DEFAULT NULL,
  `com_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 hoa hong 2 tu don',
  `com_value` int(11) DEFAULT NULL,
  `refundable` tinyint(4) DEFAULT '1',
  `arrivalpay` tinyint(4) DEFAULT '1',
  `tripadvisor_id` varchar(100) DEFAULT NULL,
  `thumbnail_image` varchar(200) DEFAULT 'blank.jpg',
  `thumbnail_id` int(11) DEFAULT NULL,
  `near` text,
  `diem_noi_bat` varchar(500) DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `slug`, `description`, `stars`, `hotel_type`, `city_id`, `latitude`, `longitude`, `meta_title`, `meta_keywords`, `meta_desc`, `amenities`, `payment_opt`, `check_in`, `check_out`, `policy`, `is_hot`, `surcharge`, `status`, `display_order`, `related`, `comm_fixed`, `comm_percentage`, `tax_fixed`, `tax_percentage`, `email`, `banner_url`, `phone`, `website`, `com_type`, `com_value`, `refundable`, `arrivalpay`, `tripadvisor_id`, `thumbnail_image`, `thumbnail_id`, `near`, `diem_noi_bat`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, 'Khách sạn An Phú', 'khach-san-an-phu', NULL, '3', 97, NULL, NULL, NULL, 'Khách sạn An Phú Phú Quốc', NULL, NULL, '78,182,192,195', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, '/uploads/images/anphu_01-1565271612.jpg', NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 4, NULL, NULL, 1, 1, '2019-08-08 06:39:16', '2019-08-12 01:52:19'),
(2, '9 Station Hostel & Bar', '9-station-hostel-bar', NULL, '2', 2893, NULL, NULL, NULL, '9 Station Hostel & Bar', NULL, NULL, '182,192', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 105, NULL, NULL, 1, 1, '2019-08-08 08:39:39', '2019-08-12 02:45:56'),
(3, 'Boulevard Hotel', 'boulevard-hotel', NULL, '3', 97, NULL, NULL, NULL, 'Boulevard Hotel', NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 102, NULL, NULL, 1, 1, '2019-08-08 08:48:16', '2019-08-12 02:44:57'),
(4, 'Đảo Ngọc', 'dao-ngoc', NULL, '3', 97, NULL, NULL, NULL, 'Khách sạn Đảo Ngọc', NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 98, NULL, NULL, 1, 1, '2019-08-08 09:44:18', '2019-08-12 02:43:29'),
(5, 'Khách sạn Galaxy', 'khach-san-galaxy', NULL, '2', 97, NULL, NULL, NULL, 'Khách sạn Galaxy', NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 97, NULL, NULL, 1, 1, '2019-08-08 09:49:50', '2019-08-12 02:41:47'),
(6, 'Khách sạn Golden Daisy', 'khach-san-golden-daisy', NULL, '3', 97, NULL, NULL, NULL, 'Khách sạn Golden Daisy', NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 90, NULL, NULL, 1, 1, '2019-08-08 09:59:09', '2019-08-12 02:37:35'),
(7, 'Hạnh Ngọc Resort', 'hanh-ngoc-resort', NULL, '3', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 86, NULL, NULL, 1, 1, '2019-08-08 20:20:26', '2019-08-12 02:35:40'),
(8, 'Homestead Phú Quốc Resort', 'homestead-phu-quoc-resort', NULL, '3', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 81, NULL, NULL, 1, 1, '2019-08-08 20:28:01', '2019-08-12 02:33:52'),
(9, 'Khánh Duy Bungalow', 'khanh-duy-bungalow', NULL, '3', 2894, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 80, NULL, NULL, 1, 1, '2019-08-08 20:54:01', '2019-08-12 02:32:21'),
(10, 'Kim Hoa Resort', 'kim-hoa-resort', NULL, '3', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 74, NULL, NULL, 1, 1, '2019-08-09 16:11:22', '2019-08-12 02:31:10'),
(11, 'King Bungalow', 'king-bungalow', NULL, '2', 2894, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 73, NULL, NULL, 1, 1, '2019-08-09 16:16:09', '2019-08-12 02:30:16'),
(12, 'Lahana Resort', 'lahana-resort', NULL, '3', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 70, NULL, NULL, 1, 1, '2019-08-09 16:21:44', '2019-08-12 02:28:50'),
(13, 'Levan Hotel', 'levan-hotel', NULL, '3', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 66, NULL, NULL, 1, 1, '2019-08-09 16:29:00', '2019-08-12 02:27:52'),
(14, 'Mango Resort & Residence', 'mango-resort-residence', NULL, '2', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 65, NULL, NULL, 1, 1, '2019-08-09 16:32:02', '2019-08-12 02:25:40'),
(15, 'Miana Resort', 'miana-resort', NULL, '2', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 61, NULL, NULL, 1, 1, '2019-08-09 16:33:55', '2019-08-12 02:24:36'),
(16, 'Khách sạn Nesta', 'khach-san-nesta', NULL, '3', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 56, NULL, NULL, 1, 1, '2019-08-09 16:36:05', '2019-08-12 02:17:02'),
(17, 'Ngọc Châu Hotel', 'ngoc-chau-hotel', NULL, '3', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 52, NULL, NULL, 1, 1, '2019-08-09 16:38:43', '2019-08-12 02:14:32'),
(18, 'Nice Life Hotel', 'nice-life-hotel', NULL, '3', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 49, NULL, NULL, 1, 1, '2019-08-09 16:43:28', '2019-08-12 02:13:41'),
(19, 'Ocean Pearl Hotel', 'ocean-pearl-hotel', NULL, '4', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 47, NULL, NULL, 1, 1, '2019-08-09 16:45:24', '2019-08-12 02:12:20'),
(20, 'Philip Bungalow', 'philip-bungalow', NULL, '2', 2894, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 42, NULL, NULL, 1, 1, '2019-08-09 16:47:42', '2019-08-12 02:10:17'),
(21, 'Phú Vân Resort & Spa', 'phu-van-resort-spa', NULL, '4', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 2, 100000, 1, 1, NULL, 'blank.jpg', 36, NULL, NULL, 1, 1, '2019-08-09 16:50:35', '2019-08-20 14:47:31'),
(22, 'Seashells Hotel & Spa', 'seashells-hotel-spa', NULL, '4', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 33, NULL, NULL, 1, 1, '2019-08-09 16:54:05', '2019-08-12 02:08:20'),
(23, 'Sol Beach House', 'sol-beach-house', NULL, '5', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 30, NULL, NULL, 1, 1, '2019-08-09 16:57:05', '2019-08-12 02:07:29'),
(24, 'South Wind Hotel', 'south-wind-hotel', NULL, '3', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 28, NULL, NULL, 1, 1, '2019-08-09 16:59:55', '2019-08-12 02:06:39'),
(25, 'Sunny Hotel', 'sunny-hotel', NULL, '2', 97, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 25, NULL, NULL, 1, 1, '2019-08-09 18:04:55', '2019-08-12 02:05:37'),
(26, 'Thanh Kiều Beach Resort', 'thanh-kieu-beach-resort', NULL, '3', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 22, NULL, NULL, 1, 1, '2019-08-09 18:07:55', '2019-08-12 02:04:28'),
(27, 'The Shells Resort & Spa', 'the-shells-resort-spa', NULL, '5', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 17, NULL, NULL, 1, 1, '2019-08-09 18:10:44', '2019-08-12 02:03:21'),
(28, 'Tom Hill Resort & Spa', 'tom-hill-resort-spa', NULL, '3', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 15, NULL, NULL, 1, 1, '2019-08-09 18:12:56', '2019-08-12 02:01:54'),
(29, 'Tràng An Beach Resort and Spa', 'trang-an-beach-resort-and-spa', NULL, '4', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 11, NULL, NULL, 1, 1, '2019-08-09 18:22:16', '2019-08-12 01:59:45'),
(30, 'Tropicana Resort', 'tropicana-resort', NULL, '4', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, NULL, 'blank.jpg', 5, NULL, NULL, 1, 1, '2019-08-09 18:25:49', '2019-08-12 01:56:14'),
(31, 'Vin Oasis', 'vin-oasis', NULL, '5', 98, NULL, NULL, NULL, NULL, NULL, NULL, '182', NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, '/uploads/images/hotels/vin-01-1565400668.jpg', NULL, NULL, 2, 150000, 1, 1, NULL, 'blank.jpg', 9, NULL, NULL, 1, 1, '2019-08-09 18:28:28', '2019-08-20 14:46:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `adults` tinyint(4) DEFAULT NULL,
  `children` tinyint(4) DEFAULT NULL,
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `min_stay` tinyint(4) DEFAULT '1',
  `amenities` text,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `extra_bed` tinyint(4) DEFAULT '0',
  `extra_bed_charges` double DEFAULT '0',
  `quantity` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image_url` varchar(255) DEFAULT 'blank.jpg',
  `breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `created_user` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `name`, `description`, `adults`, `children`, `is_hot`, `min_stay`, `amenities`, `display_order`, `extra_bed`, `extra_bed_charges`, `quantity`, `status`, `image_url`, `breakfast`, `created_user`, `updated_user`, `created_at`, `updated_at`) VALUES
(1, 1, 'DORM', '15m2 , 3 giường tầng, 6 kh&aacute;ch/ph&ograve;ng', 6, NULL, 0, 1, '1830', 0, NULL, NULL, 6, 1, '/uploads/images/rooms/an-phu-dorm-01-1565275552.jpeg', 0, 1, 1, '2019-08-08 07:47:22', '2019-08-08 07:47:22'),
(2, 1, 'STANDARD DOUBLE OR TWIN ROOM', '27m2 , hướng nh&igrave;n s&ocirc;ng, 1 giường King size hoặc 2 giường đơn', 2, NULL, 0, 1, '170,174', 0, NULL, NULL, 3, 1, '/uploads/images/rooms/an-phu-standard-double-or-twin-01-1565275767.jpeg', 0, 1, 1, '2019-08-08 07:50:09', '2019-08-08 07:50:09'),
(3, 1, 'SUPERIOR DOUBLE OR TWIN ROOM', '26-35m2 , hướng nh&igrave;n đường phố v&agrave; s&ocirc;ng, 1 giường King size hoặc 2 giường đơn', 2, NULL, 0, 1, '174', 0, 1, NULL, 29, 1, '/uploads/images/rooms/an-phu-superior-double-or-twin-room-1565276045.jpeg', 0, 1, 1, '2019-08-08 07:54:22', '2019-08-08 07:54:22'),
(4, 1, 'SUPERIOR TRIPLE ROOM', '28-30m2 , hướng nh&igrave;n đường phố v&agrave; n&uacute;i, 1 giường ngủ Queen size v&agrave; 1 giường đơn', 3, NULL, 0, 1, '151,169,174,1465', 0, NULL, NULL, 16, 1, '/uploads/images/rooms/an-phu-superior-triple-room-01-1565276258.jpeg', 0, 1, 1, '2019-08-08 07:58:09', '2019-08-08 07:58:09'),
(5, 1, 'SUPERIOR FAMILY ROOM', '35m2, hướng nh&igrave;n s&ocirc;ng, 2 giường ngủ King size.', 4, NULL, 0, 1, '170', 0, NULL, NULL, 1, 1, NULL, 0, 1, 1, '2019-08-08 08:30:58', '2019-08-08 08:30:58'),
(6, 1, 'DELUXE DOUBLE ROOM WITH STREET VIEW', '40m2, hướng nh&igrave;n to&agrave;n cảnh đường phố v&agrave; n&uacute;i, 1 giường ngủ King size.', 2, NULL, 0, 1, '170', 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-08 08:38:03', '2019-08-08 08:38:03'),
(7, 1, 'DELUXE FAMILY ROOM WITH RIVER VIEW', '35-40m2, hướng nh&igrave;n to&agrave;n cảnh s&ocirc;ng, 2 giường ngủ King size.', 4, NULL, 0, 1, '170', 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-08 08:40:46', '2019-08-08 08:40:46'),
(8, 2, 'Private Double Room', NULL, 2, NULL, 0, 1, '170', 0, NULL, NULL, 12, 1, NULL, 0, 1, 1, '2019-08-08 08:41:14', '2019-08-08 08:41:14'),
(9, 2, 'Private Twin Room', NULL, 2, NULL, 0, 1, '170', 0, NULL, NULL, 4, 1, NULL, 0, 1, 1, '2019-08-08 08:41:40', '2019-08-08 08:41:40'),
(10, 2, 'Dormitory 4 Beds mix', NULL, 1, NULL, 0, 1, '170', 0, NULL, NULL, 20, 1, NULL, 0, 1, 1, '2019-08-08 08:42:06', '2019-08-08 08:42:06'),
(11, 2, 'Dormitory 8 Beds mix', NULL, 1, NULL, 0, 1, '170', 0, NULL, NULL, 24, 1, NULL, 0, 1, 1, '2019-08-08 08:43:09', '2019-08-08 08:43:09'),
(12, 1, 'FAMILY SUITE WITH RIVER VIEW', '50m2, hướng nh&igrave;n to&agrave;n cảnh s&ocirc;ng, 1 ph&ograve;ng kh&aacute;ch, 1 ph&ograve;ng ngủ với 2<br />\r\ngiường ngủ King size.', 4, NULL, 0, 1, '170', 0, NULL, NULL, 1, 1, NULL, 0, 1, 1, '2019-08-08 08:43:43', '2019-08-08 08:43:43'),
(13, 2, 'Dormitory 8 Beds Female', NULL, 1, NULL, 0, 1, '170', 0, NULL, NULL, 32, 1, NULL, 0, 1, 1, '2019-08-08 08:43:44', '2019-08-08 08:43:44'),
(14, 2, 'Dormitory 12 Beds mix', NULL, 1, NULL, 0, 1, '170', 0, NULL, NULL, 72, 1, NULL, 0, 1, 1, '2019-08-08 08:44:21', '2019-08-08 08:44:21'),
(16, 3, 'SUPERIOR / TWIN', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 16, 1, NULL, 0, 1, 1, '2019-08-08 08:58:56', '2019-08-08 08:58:56'),
(17, 3, 'Superior Swimming Pool', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 9, 1, NULL, 0, 1, 1, '2019-08-08 09:02:52', '2019-08-08 09:02:52'),
(18, 3, 'Superior Sea view', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 4, 1, NULL, 0, 1, 1, '2019-08-08 09:04:16', '2019-08-08 09:04:16'),
(19, 3, 'Superior Family', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 20, 1, NULL, 0, 1, 1, '2019-08-08 09:04:53', '2019-08-08 09:04:53'),
(20, 3, 'Deluxe', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-08 09:05:30', '2019-08-08 09:05:30'),
(21, 3, 'Bolevard Family', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 2, 1, NULL, 0, 1, 1, '2019-08-08 09:06:31', '2019-08-08 09:06:31'),
(23, 4, 'SUPERIOR TWIN/DOUBLE', NULL, 2, NULL, 0, 1, '151', 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:46:36', '2019-08-08 09:46:36'),
(24, 4, 'PREMIUM SUPERIOR DOUBLE', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:47:03', '2019-08-08 09:47:03'),
(25, 4, 'DELUXE TRIPLE', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:47:45', '2019-08-08 09:47:45'),
(26, 4, 'SUITE TRIPLE', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:48:14', '2019-08-08 09:48:14'),
(27, 5, 'SUPERIOR– 2 PAX', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:52:37', '2019-08-08 09:55:37'),
(28, 5, 'DELUXE – 2 PAX', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:56:14', '2019-08-08 09:56:14'),
(29, 5, 'DELUXE – 3 PAX', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:56:23', '2019-08-08 09:56:23'),
(30, 5, 'SEA VIEW – 2 PAX', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:56:47', '2019-08-08 09:56:47'),
(31, 5, 'SEA VIEW – 3 PAX', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 09:56:57', '2019-08-08 09:56:57'),
(32, 6, 'Double Superior', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:03:06', '2019-08-08 20:03:06'),
(33, 6, 'Triple Superior', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:03:28', '2019-08-08 20:03:28'),
(34, 6, 'Family Superior', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:03:44', '2019-08-08 20:03:44'),
(35, 7, 'STANDARD DOUBLE', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:25:55', '2019-08-08 20:25:55'),
(36, 7, 'DELUXE BUNGALOW', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:26:27', '2019-08-08 20:26:27'),
(37, 7, 'BUNGALOW 3 PAX', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:26:38', '2019-08-08 20:26:38'),
(38, 7, 'FAMILY 4 PAX', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:26:47', '2019-08-08 20:26:47'),
(39, 8, 'Double Deluxe (2A 1C)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:30:30', '2019-08-08 20:30:30'),
(40, 8, 'Pre Double Deluxe (2A 1C)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:30:44', '2019-08-08 20:30:44'),
(41, 8, 'Twin Deluxe (2A)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:31:05', '2019-08-08 20:31:05'),
(42, 8, 'Triple Deluxe (3A 1C)', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:31:15', '2019-08-08 20:31:15'),
(43, 8, 'Family Deluxe (4A 2C)', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:31:33', '2019-08-08 20:31:33'),
(44, 8, 'Family Suite (6A)', NULL, 6, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-08 20:31:45', '2019-08-08 20:31:45'),
(45, 9, 'Phòng đôi 2px', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:08:52', '2019-08-09 16:08:52'),
(47, 9, 'Phòng Triple 3px', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:09:30', '2019-08-09 16:09:30'),
(48, 9, 'Phòng Family 4px', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:09:42', '2019-08-09 16:09:42'),
(49, 10, 'Standard Garden View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:12:35', '2019-08-09 16:12:35'),
(50, 10, 'Superior Garden View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:12:56', '2019-08-09 16:12:56'),
(51, 10, 'Superior Ocean View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:13:06', '2019-08-09 16:13:06'),
(52, 10, 'Bungalow Garden View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:13:17', '2019-08-09 16:13:17'),
(53, 10, 'Bungalow Pool View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:13:29', '2019-08-09 16:13:29'),
(54, 10, 'Family', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:13:38', '2019-08-09 16:13:38'),
(55, 10, 'Bungalow Beach Front', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:13:55', '2019-08-09 16:13:55'),
(56, 10, 'VIP', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:14:05', '2019-08-09 16:14:05'),
(57, 11, 'Phòng đôi', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:16:42', '2019-08-09 16:16:42'),
(58, 11, 'Phòng 4 người', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:17:06', '2019-08-09 16:17:06'),
(59, 12, 'Deluxe Double Garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 14, 1, NULL, 0, 1, 1, '2019-08-09 16:23:08', '2019-08-09 16:23:08'),
(60, 12, 'Deluxe Twin Garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-09 16:23:17', '2019-08-09 16:23:17'),
(61, 12, 'Deluxe Double Panorama', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 13, 1, NULL, 0, 1, 1, '2019-08-09 16:23:25', '2019-08-09 16:23:25'),
(62, 12, 'Deluxe Triple Garden', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-09 16:23:36', '2019-08-09 16:23:36'),
(63, 12, 'Deluxe Family Garden', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 11, 1, NULL, 0, 1, 1, '2019-08-09 16:23:46', '2019-08-09 16:23:46'),
(64, 12, 'Bungalow Superior Garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 14, 1, NULL, 0, 1, 1, '2019-08-09 16:23:55', '2019-08-09 16:23:55'),
(65, 12, 'Bungalow Delxue Garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:24:09', '2019-08-09 16:24:09'),
(66, 12, 'Bungalow Ocean', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-09 16:24:30', '2019-08-09 16:24:30'),
(67, 12, 'Bungalow Family', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 2, 1, NULL, 0, 1, 1, '2019-08-09 16:24:59', '2019-08-09 16:24:59'),
(68, 12, 'Lahana Villa', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 1, 1, NULL, 0, 1, 1, '2019-08-09 16:25:08', '2019-08-09 16:25:08'),
(69, 13, 'Standard', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:30:06', '2019-08-09 16:30:06'),
(70, 13, 'Superior Hướng Phố', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:30:12', '2019-08-09 16:30:12'),
(71, 13, 'Deluxe Hướng Phố', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:30:24', '2019-08-09 16:30:24'),
(72, 13, 'Deluxe Hướng Biển', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:30:42', '2019-08-09 16:30:42'),
(73, 14, 'Bungalow 2 pax', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:32:43', '2019-08-09 16:32:43'),
(74, 14, 'Bungalow 3 pax', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:32:52', '2019-08-09 16:33:07'),
(75, 14, 'Bungalow Family 4 pax', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:33:03', '2019-08-09 16:33:03'),
(76, 15, 'Bunglow Garden View (Double bed)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 12, 1, NULL, 0, 1, 1, '2019-08-09 16:34:56', '2019-08-09 16:34:56'),
(77, 15, 'Bunglow Garden View (Twin bed)', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:35:12', '2019-08-09 16:35:12'),
(78, 16, 'Standard', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 5, 1, NULL, 0, 1, 1, '2019-08-09 16:37:07', '2019-08-09 16:37:07'),
(79, 16, 'Superior with balcony', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 27, 1, NULL, 0, 1, 1, '2019-08-09 16:37:15', '2019-08-09 16:37:15'),
(80, 16, 'Deluxe with balcony', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 27, 1, NULL, 0, 1, 1, '2019-08-09 16:37:24', '2019-08-09 16:37:24'),
(81, 16, 'Nesta Suite', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 5, 1, NULL, 0, 1, 1, '2019-08-09 16:37:35', '2019-08-09 16:37:35'),
(82, 17, 'STANDARD', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 3, 1, NULL, 0, 1, 1, '2019-08-09 16:39:38', '2019-08-09 16:39:38'),
(83, 17, 'SUPERIOR GARDEN VIEW', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 2, 1, NULL, 0, 1, 1, '2019-08-09 16:39:52', '2019-08-09 16:39:52'),
(84, 17, 'SUPERIOR OCEAN VIEW', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 7, 1, NULL, 0, 1, 1, '2019-08-09 16:40:09', '2019-08-09 16:40:09'),
(85, 17, 'DELUXE FOREST VIEW', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 16, 1, NULL, 0, 1, 1, '2019-08-09 16:40:27', '2019-08-09 16:40:27'),
(86, 17, 'DELUXE OCEAN VIEW', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 12, 1, NULL, 0, 1, 1, '2019-08-09 16:40:47', '2019-08-09 16:40:47'),
(87, 17, 'SUITE OCEAN VIEW', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 5, 1, NULL, 0, 1, 1, '2019-08-09 16:41:16', '2019-08-09 16:41:16'),
(88, 17, 'VIP JACCUZZI OCEAN VIEW', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 3, 1, NULL, 0, 1, 1, '2019-08-09 16:41:55', '2019-08-09 16:41:55'),
(89, 18, 'STANDARD', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:43:53', '2019-08-09 16:43:53'),
(90, 18, 'SUPERIOR', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:44:14', '2019-08-09 16:44:14'),
(91, 18, 'LUXURY', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:44:24', '2019-08-09 16:44:24'),
(92, 19, 'Superior (Twin/ Double)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 16:46:35', '2019-08-09 16:46:35'),
(93, 19, 'Deluxe (Double)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 16:46:46', '2019-08-09 16:46:46'),
(94, 19, 'Suite (Double)', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 16:46:58', '2019-08-09 16:46:58'),
(95, 20, 'Standard Single', NULL, 1, NULL, 0, 1, NULL, 0, NULL, NULL, 1, 1, NULL, 0, 1, 1, '2019-08-09 16:48:33', '2019-08-09 16:48:33'),
(96, 20, 'Standard Double', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 2, 1, NULL, 0, 1, 1, '2019-08-09 16:48:42', '2019-08-09 16:48:42'),
(97, 20, 'Superior Double', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 11, 1, NULL, 0, 1, 1, '2019-08-09 16:48:52', '2019-08-09 16:48:52'),
(98, 20, 'Superior Twin', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 1, 1, NULL, 0, 1, 1, '2019-08-09 16:49:05', '2019-08-09 16:49:05'),
(99, 20, 'Superior Triple', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-09 16:49:28', '2019-08-09 16:49:28'),
(100, 20, 'Deluxe triple', NULL, 3, NULL, 0, 1, NULL, 0, NULL, NULL, 1, 1, NULL, 0, 1, 1, '2019-08-09 16:49:38', '2019-08-09 16:49:38'),
(101, 21, 'SUPERIOR', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 15, 1, NULL, 0, 1, 1, '2019-08-09 16:52:15', '2019-08-09 16:52:15'),
(102, 21, 'DELUXE', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 5, 1, NULL, 0, 1, 1, '2019-08-09 16:52:23', '2019-08-09 16:52:23'),
(103, 21, 'BUNGALOWS', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 34, 1, NULL, 0, 1, 1, '2019-08-09 16:52:40', '2019-08-09 16:52:40'),
(104, 21, 'PREMIUM', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 8, 1, NULL, 0, 1, 1, '2019-08-09 16:52:50', '2019-08-09 16:52:50'),
(105, 21, 'SUITE', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 6, 1, NULL, 0, 1, 1, '2019-08-09 16:53:03', '2019-08-09 16:53:03'),
(106, 22, 'Classic City View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:55:04', '2019-08-09 16:55:04'),
(107, 22, 'Classic Ocean View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:55:14', '2019-08-09 16:55:14'),
(108, 22, 'Junior Suite One-Bedroom', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:55:22', '2019-08-09 16:55:22'),
(109, 22, 'Phu Quoc Suite Two-Bedroom', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:55:36', '2019-08-09 16:55:36'),
(110, 22, 'Club Room Ocean View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:55:44', '2019-08-09 16:55:44'),
(111, 22, 'Club Suite', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:55:55', '2019-08-09 16:55:55'),
(112, 23, 'Beach House Room', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:57:32', '2019-08-09 16:57:32'),
(113, 23, 'Big Beach House Room', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:57:43', '2019-08-09 16:57:43'),
(114, 23, 'Xtra Beach House Room', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:57:51', '2019-08-09 16:57:51'),
(115, 23, 'Xtra Beach House Junior Suite', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:58:01', '2019-08-09 16:58:01'),
(116, 23, 'Xtra Beach House Suite', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 16:58:10', '2019-08-09 16:58:10'),
(117, 24, 'Phòng đơn', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:02:41', '2019-08-09 18:02:41'),
(118, 24, 'Phòng đôi', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:03:01', '2019-08-09 18:03:50'),
(119, 24, 'Phòng đôi lớn', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:03:11', '2019-08-09 18:03:39'),
(120, 24, 'Phòng đặc biệt', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:03:32', '2019-08-09 18:03:32'),
(121, 25, 'Deluxe room', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 18:05:39', '2019-08-09 18:05:39'),
(122, 25, 'Deluxe - family room 1', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 18:05:59', '2019-08-09 18:05:59'),
(123, 25, 'Deluxe – family room 2', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 18:06:05', '2019-08-09 18:06:05'),
(124, 26, 'Sea View Bungalow', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 7, 1, NULL, 1, 1, 1, '2019-08-09 18:09:17', '2019-08-09 18:09:17'),
(125, 26, 'Sea & Pool View Bungalow', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 3, 1, NULL, 1, 1, 1, '2019-08-09 18:09:32', '2019-08-09 18:09:32'),
(126, 26, 'Superior Bungalow', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 12, 1, NULL, 1, 1, 1, '2019-08-09 18:09:45', '2019-08-09 18:09:45'),
(127, 26, 'Garden View Bungalow', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 18, 1, NULL, 1, 1, 1, '2019-08-09 18:09:57', '2019-08-09 18:09:57'),
(128, 27, 'Luxury Villa Garden View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:11:33', '2019-08-09 18:11:33'),
(129, 27, 'Luxury Villa Poolside', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:11:46', '2019-08-09 18:11:46'),
(130, 27, 'Premium Deluxe Ocean View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:11:56', '2019-08-09 18:11:56'),
(131, 28, 'Superior', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:19:03', '2019-08-09 18:19:03'),
(132, 28, 'Family', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:19:17', '2019-08-09 18:19:17'),
(133, 28, 'Deluxe Sea View', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:19:30', '2019-08-09 18:19:30'),
(134, 28, 'Deluxe Villa', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:19:43', '2019-08-09 18:19:43'),
(135, 28, 'Villa Sea View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:19:55', '2019-08-09 18:19:55'),
(136, 28, 'Penhouse 501 & 502', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:20:20', '2019-08-09 18:20:20'),
(137, 28, 'Penhouse 503', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:20:37', '2019-08-09 18:20:37'),
(138, 28, 'Penhouse', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:20:48', '2019-08-09 18:20:48'),
(139, 29, 'Deluxe Twin garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 14, 1, NULL, 1, 1, 1, '2019-08-09 18:23:50', '2019-08-09 18:23:50'),
(140, 29, 'Deluxe Twin Ocean', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 14, 1, NULL, 1, 1, 1, '2019-08-09 18:23:58', '2019-08-09 18:23:58'),
(141, 29, 'Deluxe DBL Garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 9, 1, NULL, 1, 1, 1, '2019-08-09 18:24:11', '2019-08-09 18:24:11'),
(142, 29, 'Dluxe DBL Ocean', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:24:24', '2019-08-09 18:24:24'),
(143, 29, 'Suite Ocean View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 8, 1, NULL, 1, 1, 1, '2019-08-09 18:24:34', '2019-08-09 18:24:34'),
(144, 29, 'Suite Garden View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 8, 1, NULL, 1, 1, 1, '2019-08-09 18:24:50', '2019-08-09 18:24:50'),
(145, 30, 'Standard Garden view', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 2, 1, NULL, 1, 1, 1, '2019-08-09 18:26:11', '2019-08-09 18:26:11'),
(146, 30, 'Deluxe Pool View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 12, 1, NULL, 1, 1, 1, '2019-08-09 18:26:23', '2019-08-09 18:26:23'),
(147, 30, 'DeluxeTwin/double Ocean View', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 5, 1, NULL, 1, 1, 1, '2019-08-09 18:26:52', '2019-08-09 18:26:52'),
(148, 30, 'Bungalow Garden', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 1, 1, 1, '2019-08-09 18:27:06', '2019-08-09 18:27:06'),
(149, 30, 'Beach Front', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 8, 1, NULL, 1, 1, 1, '2019-08-09 18:27:19', '2019-08-09 18:27:19'),
(150, 30, 'Family Beach Front', NULL, 4, NULL, 0, 1, NULL, 0, NULL, NULL, 2, 1, NULL, 1, 1, 1, '2019-08-09 18:27:32', '2019-08-09 18:27:32'),
(151, 31, 'Standard', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 18:29:32', '2019-08-09 18:29:32'),
(152, 31, 'Junior Suite', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 18:29:42', '2019-08-09 18:29:42'),
(153, 31, 'VIN Suite', NULL, 2, NULL, 0, 1, NULL, 0, NULL, NULL, 10, 1, NULL, 0, 1, 1, '2019-08-09 18:29:52', '2019-08-09 18:29:52');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `check_in` (`check_in`),
  ADD KEY `check_out` (`check_out`);
ALTER TABLE `hotels` ADD FULLTEXT KEY `title` (`name`);
ALTER TABLE `hotels` ADD FULLTEXT KEY `city` (`city_id`);

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel` (`hotel_id`);

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
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
