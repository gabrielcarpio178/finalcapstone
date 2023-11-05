-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 02:56 PM
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
-- Database: `bcc_digital_payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminannoucement`
--

CREATE TABLE `adminannoucement` (
  `announcement_id` int(11) NOT NULL,
  `post` varchar(225) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_type` varchar(225) NOT NULL,
  `posted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminannoucement`
--

INSERT INTO `adminannoucement` (`announcement_id`, `post`, `post_date`, `post_type`, `posted`) VALUES
(1, 'GOOD DAY USERS', '2023-08-15 14:09:22', 'All', 'not-active'),
(4, 'System maintenance ', '2023-09-12 21:26:31', 'Buyer', 'not-active'),
(6, 'Purchase under maintenance right now', '2023-09-12 21:32:05', 'Buyer', 'not-active'),
(8, 'GOOD MORNING', '2023-09-12 21:37:22', 'Canteen Staff', 'not-active'),
(14, 'good day', '2023-09-16 13:58:27', 'All', 'not-active');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `admin_id` int(11) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`admin_id`, `user_category`, `username`, `password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `cashierrates_tb`
--

CREATE TABLE `cashierrates_tb` (
  `cashierRates_id` int(11) NOT NULL,
  `cashierRates_request` varchar(255) NOT NULL,
  `cashierRatesCertificate` varchar(255) NOT NULL,
  `cashierRates_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashierrates_tb`
--

INSERT INTO `cashierrates_tb` (`cashierRates_id`, `cashierRates_request`, `cashierRatesCertificate`, `cashierRates_amount`) VALUES
(1, 'Non Bago Fee', 'Non Bago Fee', 500),
(2, 'Transcript of Record', 'Transcript of Record', 130),
(3, 'certificate', 'Certificate of Enrollment', 20),
(4, 'certificate', 'Certificate of Transfer Crendential', 100),
(7, 'certificate', 'Grades', 50);

-- --------------------------------------------------------

--
-- Table structure for table `cashier_tb`
--

CREATE TABLE `cashier_tb` (
  `cashier_id` int(11) NOT NULL,
  `firstname_cashier` varchar(255) NOT NULL,
  `lastname_cashier` varchar(255) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cashier_tb`
--

INSERT INTO `cashier_tb` (`cashier_id`, `firstname_cashier`, `lastname_cashier`, `user_category`, `username`, `password`) VALUES
(1, 'Rosana', 'Rosario', 'cashier', 'cashier', '6ac2470ed8ccf204fd5ff89b32a355cf');

-- --------------------------------------------------------

--
-- Table structure for table `cashin_tb`
--

CREATE TABLE `cashin_tb` (
  `cashin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cashin_amount` int(11) NOT NULL,
  `ref_num` varchar(200) NOT NULL,
  `cashin_noti` tinyint(1) NOT NULL,
  `cashin_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashin_tb`
--

INSERT INTO `cashin_tb` (`cashin_id`, `user_id`, `cashin_amount`, `ref_num`, `cashin_noti`, `cashin_date`) VALUES
(12, 36, 40, '9726843150', 0, '2023-10-03 12:54:03'),
(20, 36, 30, '7489526310', 0, '2023-10-03 13:32:12'),
(28, 65, 500, '6578241930', 0, '2023-10-11 15:01:09'),
(30, 79, 500, '1365890742', 1, '2023-10-11 23:02:57'),
(32, 79, 500, '7283651049', 1, '2023-10-12 11:23:11'),
(33, 79, 500, '3479621085', 1, '2023-10-13 10:32:41'),
(34, 79, 200, '4158632970', 1, '2023-10-13 12:42:37'),
(35, 79, 1000, '6704359812', 1, '2023-10-14 23:30:06'),
(36, 79, 500, '3598170462', 1, '2023-10-15 00:27:27'),
(37, 79, 500, '7153290486', 1, '2023-10-15 11:43:17'),
(38, 79, 50, '2846719503', 1, '2023-10-15 12:54:00'),
(39, 79, 50, '1947386052', 1, '2023-10-15 12:54:12'),
(40, 65, 500, '0496132785', 0, '2023-10-15 12:54:31'),
(42, 79, 500, '2793541608', 1, '2023-10-16 22:49:12'),
(43, 79, 500, '0458739612', 1, '2023-10-17 16:56:57'),
(44, 79, 300, '3816027594', 1, '2023-10-18 00:20:08'),
(46, 79, 500, '4085623719', 1, '2023-10-19 08:26:54'),
(47, 83, 1000, '0645719823', 1, '2023-10-19 09:01:25'),
(49, 86, 2000, '3961287450', 0, '2023-11-05 21:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `cashout_tb`
--

CREATE TABLE `cashout_tb` (
  `cashout_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `cashout_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cashout_amount` int(11) NOT NULL,
  `cashout_status` varchar(100) NOT NULL,
  `cashout_refnum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashout_tb`
--

INSERT INTO `cashout_tb` (`cashout_id`, `teller_id`, `cashout_date`, `cashout_amount`, `cashout_status`, `cashout_refnum`) VALUES
(1, 1, '2023-10-10 23:53:20', 50, 'accepted', '4971032586'),
(5, 1, '2023-10-15 11:39:48', 20, 'accepted', '8620973145'),
(6, 1, '2023-10-16 11:42:29', 100, 'accepted', '7143580962'),
(7, 1, '2023-10-18 12:43:14', 100, 'accepted', '2104953786'),
(8, 1, '2023-10-19 00:35:29', 10, 'accepted', '8971630245'),
(9, 1, '2023-10-19 08:58:19', 50, 'accepted', '9681532047');

-- --------------------------------------------------------

--
-- Table structure for table `category_tb`
--

CREATE TABLE `category_tb` (
  `category_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category_tb`
--

INSERT INTO `category_tb` (`category_id`, `teller_id`, `category_name`) VALUES
(13, 1, 'Drinks'),
(15, 1, 'Biscuit'),
(16, 1, 'Candy'),
(17, 2, 'Coolers'),
(18, 2, 'Biscuit '),
(19, 2, 'Fruits'),
(20, 3, 'Drinks'),
(22, 3, 'Curls'),
(26, 4, 'Supplies'),
(27, 4, 'Necessities'),
(28, 3, 'Candies');

-- --------------------------------------------------------

--
-- Table structure for table `digitalpayment_tb`
--

CREATE TABLE `digitalpayment_tb` (
  `digitalPayment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_amount` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_ref` varchar(100) NOT NULL,
  `semester_year` varchar(50) NOT NULL,
  `requestType` varchar(100) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `digitalpayment_tb`
--

INSERT INTO `digitalpayment_tb` (`digitalPayment_id`, `user_id`, `payment_amount`, `payment_type`, `payment_ref`, `semester_year`, `requestType`, `payment_date`) VALUES
(1, 79, '50', 'Transcript of Record', '9501486237', 'first-semester', 'accepted', '2023-10-18 23:15:37'),
(3, 79, '100', 'Certificate of Transfer Crendential', '1245309768', 'first-semester', 'accepted', '2023-10-18 23:17:32'),
(4, 79, '50', 'Certificate of Enrollment', '4901578263', 'first-semester', 'accepted', '2023-10-19 00:06:50'),
(5, 79, '100', 'Certificate of Transfer Crendential', '6835172904', 'first-semester', 'accepted', '2023-10-19 00:07:07'),
(6, 79, '100', 'Certificate of Transfer Crendential', '9427810356', 'first-semester', 'accepted', '2023-10-19 00:14:05'),
(7, 79, '50', 'Certificate of Enrollment', '3158460297', 'first-semester', 'accepted', '2023-10-19 00:14:36'),
(8, 79, '50', 'Certificate of Enrollment', '1742695038', 'first-semester', 'accepted', '2023-10-19 00:14:56'),
(10, 79, '50', 'Transcript of Record', '7361204985', 'first-semester', 'accepted', '2023-10-19 00:37:34'),
(12, 79, '100', 'Certificate of Transfer Crendential', '5327081649', 'first-semester', 'accepted', '2023-10-19 08:28:07'),
(13, 79, '50', 'Transcript of Record', '0615982347', 'first-semester', 'accepted', '2023-10-19 08:28:18'),
(14, 83, '20', 'Certificate of Enrollment', '9732540861', 'first-semester', 'accepted', '2023-10-19 09:09:36'),
(17, 79, '100', 'Certificate of Transfer Crendential', '2389041576', 'first-semester', 'pending', '2023-10-19 09:47:10'),
(32, 79, '500', 'Non Bago Fee', '5279081463', 'first-semester', 'accepted', '2023-11-04 00:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_tb`
--

CREATE TABLE `order_tb` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `orderproduct_name` varchar(255) NOT NULL,
  `order_num` varchar(255) NOT NULL,
  `order_productcategory` varchar(255) NOT NULL,
  `order_time` datetime NOT NULL,
  `deadline_time` datetime DEFAULT NULL,
  `order_amount` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `num_noti` tinyint(1) DEFAULT NULL,
  `statues` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_tb`
--

INSERT INTO `order_tb` (`order_id`, `user_id`, `teller_id`, `product_id`, `orderproduct_name`, `order_num`, `order_productcategory`, `order_time`, `deadline_time`, `order_amount`, `order_quantity`, `num_noti`, `statues`) VALUES
(18, 38, 1, 1, 'Mountain dew', '6383295511', 'Drinks', '2023-08-24 13:05:36', '2023-08-24 13:33:21', 20, 1, 0, 'PROCEED'),
(20, 38, 1, 1, 'Mountain dew', '6383295512', 'Drinks', '2023-08-24 13:31:34', '2023-08-24 13:41:58', 20, 1, 0, 'PROCEED'),
(28, 36, 1, 10, 'Coke', '6383295516', 'Drinks', '2023-08-26 00:01:47', '2023-08-27 10:43:51', 20, 1, 0, 'PROCEED'),
(34, 34, 1, 10, 'Coke', '7914538602', 'Drinks', '2023-08-26 12:14:10', '2023-08-26 12:24:35', 20, 1, 0, 'PROCEED'),
(36, 34, 1, 1, 'Mountain dew', '7914538602', 'Drinks', '2023-08-26 12:14:10', '2023-08-26 12:24:35', 20, 1, 0, 'PROCEED'),
(41, 35, 1, 1, 'Mountain dew', '1605379842', 'Drinks', '2023-08-27 10:18:10', '2023-08-27 10:58:37', 20, 1, 0, 'PROCEED'),
(65, 36, 1, 1, 'Mountain dew', '8063592417', 'Drinks', '2023-08-27 22:40:46', '2023-08-27 22:43:07', 20, 1, 0, 'PROCEED'),
(79, 34, 1, 1, 'Mountain dew', '6041327895', 'Drinks', '2023-08-28 00:37:00', '2023-08-28 00:48:11', 20, 1, 0, 'PROCEED'),
(96, 46, 2, 26, 'Fita', '1935867402', 'Biscuit', '2023-09-11 13:56:08', NULL, 16, 2, 0, NULL),
(97, 46, 2, 23, 'Iced Coffee', '1935867402', 'Coolers', '2023-09-11 13:56:08', NULL, 30, 1, 0, NULL),
(101, 47, 2, 28, 'Hansel', '0698145237', 'Biscuit', '2023-09-11 14:05:15', NULL, 16, 2, 0, NULL),
(102, 47, 2, 23, 'Iced Coffee', '0698145237', 'Coolers', '2023-09-11 14:05:15', NULL, 30, 1, 0, NULL),
(248, 79, 1, 20, 'maxx', '5213096748', 'Candy', '2023-10-13 09:21:47', '2023-10-13 09:52:07', 2, 1, 1, 'PROCEED'),
(249, 79, 1, 56, 'Le Minerale', '5213096748', 'Drinks', '2023-10-13 09:21:47', '2023-10-13 09:52:07', 20, 1, 1, 'PROCEED'),
(250, 79, 1, 16, 'mountain dew', '5213096748', 'Drinks', '2023-10-13 09:21:47', '2023-10-13 09:52:07', 20, 1, 1, 'PROCEED'),
(251, 79, 1, 20, 'maxx', '0765418239', 'Candy', '2023-10-13 09:40:42', '2023-10-13 10:11:07', 2, 1, 1, 'PROCEED'),
(252, 79, 1, 56, 'Le Minerale', '0765418239', 'Drinks', '2023-10-13 09:40:42', '2023-10-13 10:11:07', 20, 1, 1, 'PROCEED'),
(253, 79, 1, 16, 'mountain dew', '0765418239', 'Drinks', '2023-10-13 09:40:42', '2023-10-13 10:11:07', 20, 1, 1, 'PROCEED'),
(254, 79, 1, 19, 'showbear', '3941605728', 'Candy', '2023-10-13 13:33:25', '2023-10-13 14:09:29', 2, 1, 1, 'PROCEED'),
(255, 79, 1, 17, 'Fita', '3941605728', 'Biscuit', '2023-10-13 13:33:25', '2023-10-13 14:09:29', 8, 1, 1, 'PROCEED'),
(258, 79, 1, 19, 'showbear', '4629810375', 'Candy', '2023-10-13 15:36:11', '2023-10-13 15:39:02', 2, 1, NULL, 'CANCELED'),
(259, 79, 1, 18, 'Hansel', '4629810375', 'Biscuit', '2023-10-13 15:36:11', '2023-10-13 15:39:02', 7, 1, NULL, 'CANCELED'),
(260, 79, 1, 19, 'showbear', '1897643502', 'Candy', '2023-10-13 15:36:40', '2023-10-13 15:37:30', 2, 1, 1, 'CANCELED'),
(261, 79, 1, 17, 'Fita', '1897643502', 'Biscuit', '2023-10-13 15:36:40', '2023-10-13 15:37:30', 8, 1, 1, 'CANCELED'),
(264, 79, 1, 56, 'Le Minerale', '6705314928', 'Drinks', '2023-10-13 15:43:15', '2023-10-13 15:43:33', 20, 1, 1, 'CANCELED'),
(265, 79, 1, 19, 'showbear', '6705314928', 'Candy', '2023-10-13 15:43:15', '2023-10-13 15:43:33', 2, 1, 1, 'CANCELED'),
(266, 79, 1, 56, 'Le Minerale', '0698243715', 'Drinks', '2023-10-13 15:48:42', '2023-10-13 15:56:46', 20, 1, 1, 'CANCELED'),
(267, 79, 1, 19, 'showbear', '0698243715', 'Candy', '2023-10-13 15:48:42', '2023-10-13 15:56:46', 2, 1, 1, 'CANCELED'),
(268, 79, 1, 22, 'Nature Spring', '2960831754', 'Drinks', '2023-10-13 15:54:23', '2023-10-13 15:54:54', 20, 1, 1, 'CANCELED'),
(269, 79, 1, 56, 'Le Minerale', '2960831754', 'Drinks', '2023-10-13 15:54:23', '2023-10-13 15:54:54', 20, 1, 1, 'CANCELED'),
(270, 79, 1, 16, 'mountain dew', '8470132659', 'Drinks', '2023-10-13 15:55:34', '2023-10-13 15:55:59', 20, 1, 1, 'CANCELED'),
(271, 79, 1, 56, 'Le Minerale', '0893647125', 'Drinks', '2023-10-13 15:56:59', '2023-10-13 16:28:33', 20, 1, 1, 'PROCEED'),
(272, 79, 1, 19, 'showbear', '0893647125', 'Candy', '2023-10-13 15:56:59', '2023-10-13 16:28:33', 2, 1, 1, 'PROCEED'),
(273, 79, 1, 56, 'Le Minerale', '7098635142', 'Drinks', '2023-10-18 11:14:17', '2023-10-18 11:15:14', 20, 1, 1, 'CANCELED'),
(274, 79, 1, 16, 'mountain dew', '7098635142', 'Drinks', '2023-10-18 11:14:17', '2023-10-18 11:15:14', 20, 1, 1, 'CANCELED'),
(275, 79, 1, 19, 'showbear', '2814603975', 'Candy', '2023-10-23 15:40:20', NULL, 2, 1, NULL, NULL),
(276, 79, 1, 18, 'Hansel', '2814603975', 'Biscuit', '2023-10-23 15:40:20', NULL, 7, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personnel_tb`
--

CREATE TABLE `personnel_tb` (
  `personnel_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `personnelUser_id` varchar(100) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personnel_tb`
--

INSERT INTO `personnel_tb` (`personnel_id`, `user_id`, `personnelUser_id`, `department`) VALUES
(1, 34, '1234567890', 'SASO'),
(2, 35, '1234567891', 'Guidance'),
(3, 38, '1234567892', 'Admin'),
(4, 36, '1234567893', 'Admin'),
(7, 48, '1234567896', 'SSG');

-- --------------------------------------------------------

--
-- Table structure for table `product_tb`
--

CREATE TABLE `product_tb` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `producer_price` int(11) NOT NULL,
  `date_post` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_tb`
--

INSERT INTO `product_tb` (`product_id`, `category_id`, `teller_id`, `product_name`, `price`, `quantity`, `producer_price`, `date_post`, `image`) VALUES
(16, 13, 1, 'mountain dew', 15, 195, 500, '2023-08-29', 'mountain_dew-64dc37f0c3a84-64e4c4caab3aa-64e6b8087f1b0.jpg'),
(17, 15, 1, 'Fita', 8, 201, 150, '2023-08-29', 'fita-64fdd6e8d8944.jpeg'),
(18, 15, 1, 'Hansel', 7, 199, 180, '2023-08-29', 'hansel-choco-sandwich-64ee0ae77871c.jpg'),
(19, 16, 1, 'showbear', 2, 192, 200, '2023-09-10', 'snowbear-64fdd755b51b4.jpg'),
(20, 16, 1, 'maxx', 2, 198, 200, '2023-09-10', 'maxx-64fdd7933fe07.jpg'),
(21, 13, 1, 'Dutch Mill', 25, 19, 400, '2023-09-11', 'dutchmill-64f56e1fa2939-64fe971262c90.jpeg'),
(22, 13, 1, 'Nature Spring', 20, 50, 750, '2023-09-11', 'nature spring-64f56df68f994-64fe974e186cf.jpeg'),
(23, 17, 2, 'Iced Coffee', 30, 9, 200, '2023-09-11', 'iced coffee-64f5507b9f3a5-64fe97e827018.jpg'),
(24, 19, 2, 'Apple', 15, 99, 1300, '2023-09-11', 'apple-64f54ac5b3da4-64fe980226904.jpg'),
(25, 17, 2, 'Lemonade', 15, 17, 200, '2023-09-11', 'lemonade-64f551159d2da-64fe985e2ff5d.jpg'),
(26, 18, 2, 'Fita', 8, 51, 320, '2023-09-11', 'fita-64f54a56dbb8a-64fe98947f16a.jpeg'),
(27, 18, 2, 'Fita Spreadz', 9, 100, 800, '2023-09-11', 'fita-64f56f51d1b65-64fe98c0e5f9b.jpeg'),
(28, 18, 2, 'Hansel', 8, 19, 110, '2023-09-11', 'hansel-choco-sandwich-64ee0ae77871c-64fe9914ef205.jpg'),
(29, 19, 2, 'Orange', 13, 20, 150, '2023-09-11', 'orange-64f54a8909a6f-64fe995a5fa74.jpeg'),
(30, 22, 3, 'Patata', 8, 100, 650, '2023-09-11', 'patata-64fea5ed95a19.jpeg'),
(31, 22, 3, 'Nova', 15, 49, 600, '2023-09-11', 'nova-64fea62d0db5e.jpeg'),
(32, 22, 3, 'Cracklings', 9, 20, 120, '2023-09-11', 'cracklings-64fea672772d2.jpeg'),
(33, 20, 3, 'Le Minerale', 25, 49, 900, '2023-09-11', 'le minerale-64fea6a4b1bca.jpg'),
(34, 20, 3, 'Chuckie', 20, 20, 300, '2023-09-11', 'chuckie-64fea6cc5e124.jpeg'),
(43, 27, 4, 'Sanitary pads', 8, 80, 500, '2023-09-11', 'pads-64feacf57ffab.jpg'),
(44, 27, 4, 'Wet wipes', 20, 18, 300, '2023-09-11', 'wipes-64fead2067002.jpg'),
(45, 27, 4, 'Tissue roll', 10, 20, 120, '2023-09-11', 'tissue-64fead5c39d15.jpeg'),
(46, 26, 4, 'Yellow pad', 60, 9, 550, '2023-09-11', 'yellow pad-64fead88279df.jpeg'),
(47, 26, 4, 'Faber Castel 0.5', 15, 20, 150, '2023-09-11', 'Ballpen-64feadb4a5beb.jpeg'),
(48, 26, 4, 'Short Bondpaper', 1, 1000, 750, '2023-09-11', 'bondpaper-64feadf85bd91.jpeg'),
(49, 28, 3, 'XO', 1, 100, 70, '2023-09-11', 'xo-64feaed1adccb.jpeg'),
(50, 20, 3, 'Yakult', 10, 100, 900, '2023-09-11', 'yakult-64feaf05479fb.jpg'),
(51, 28, 3, 'V-fresh', 1, 100, 70, '2023-09-11', 'vfresh-64feaf901823d.jpeg'),
(52, 28, 3, 'Fres', 1, 100, 60, '2023-09-11', 'fres-64feafb845a21.jpg'),
(53, 20, 3, 'Absolute', 20, 20, 300, '2023-09-11', 'absolute-64feb0aa49f1a.jpg'),
(54, 17, 2, 'Gulaman', 15, 19, 150, '2023-09-11', 'gulaman-64feb1711b91e.jpeg'),
(55, 18, 2, 'Cream-o', 9, 100, 750, '2023-09-11', 'cream-o-64feb18b6a4c3.jpeg'),
(56, 13, 1, 'Le Minerale', 20, 97, 1500, '2023-09-11', 'le minerale-64feb25421c70.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `semesteryear_tb`
--

CREATE TABLE `semesteryear_tb` (
  `semesterYear_id` int(11) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `semester_start` date NOT NULL DEFAULT current_timestamp(),
  `semester_end` date DEFAULT NULL,
  `semester_pair` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesteryear_tb`
--

INSERT INTO `semesteryear_tb` (`semesterYear_id`, `semester`, `semester_start`, `semester_end`, `semester_pair`) VALUES
(1, 'first-semester', '2018-06-27', '2018-11-01', 1),
(14, 'second-semester', '2018-11-01', '2019-04-01', 1),
(15, 'first-semester', '2019-06-01', '2019-11-01', 2),
(16, 'second-semester', '2019-11-01', '2020-04-01', 2),
(17, 'first-semester', '2020-06-01', '2020-11-01', 3),
(18, 'second-semester', '2020-11-01', '2021-04-01', 3),
(19, 'first-semester', '2021-06-01', '2021-11-01', 4),
(20, 'second-semester', '2021-11-01', '2022-04-01', 4),
(21, 'first-semester', '2022-06-01', '2022-11-01', 5),
(22, 'second-semester', '2022-11-01', '2023-04-01', 5),
(23, 'first-semester', '2023-04-01', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sendbalance_tb`
--

CREATE TABLE `sendbalance_tb` (
  `sendBalance_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `send_amount` int(11) NOT NULL,
  `sendBalance_ref` varchar(50) NOT NULL,
  `sendBalance_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sendbalance_tb`
--

INSERT INTO `sendbalance_tb` (`sendBalance_id`, `sender_id`, `receiver_id`, `send_amount`, `sendBalance_ref`, `sendBalance_Date`) VALUES
(3, 79, 83, 100, '3928164750', '2023-10-24 23:18:21'),
(4, 79, 65, 100, '0473861925', '2023-10-24 23:25:47'),
(6, 79, 83, 100, '9134607285', '2023-10-24 23:31:44'),
(10, 79, 83, 500, '9286351704', '2023-10-26 07:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `studentID_number` bigint(20) NOT NULL,
  `course` varchar(255) NOT NULL,
  `program_description` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `rfid_number` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_tb`
--

INSERT INTO `student_tb` (`studentID_number`, `course`, `program_description`, `year`, `rfid_number`, `user_id`) VALUES
(1164973821, 'BSOA', '', '3rd', '', 46),
(1234567891, 'BSCRIM', '', '3rd', '', 47),
(2020590400, 'BEED', '', '4th', '', 50),
(2023019305, 'BSED', '', '1st', '2059831325', 64),
(2020115558, 'BSIS', '', '4th', '0477300257', 65),
(2021117366, 'BSOA', '', '3rd', '0463113411', 66),
(2021116715, 'BSOA', '', '3rd', '0472665361', 67),
(2021116526, 'BSCRIM', '', '3rd', '', 68),
(2019113585, 'BSIS', '', '3rd', '3391757350', 69),
(2022017958, 'BSED', '', '2nd', '0461417986', 70),
(2022018006, 'BSED', '', '2nd', '0455007746', 71),
(2020115788, 'BSED', '', '4th', '0688068140', 72),
(2020115817, 'BSED', '', '4th', '', 73),
(2020115739, 'BSCRIM', '', '4th', '', 74),
(2022118767, 'BSCRIM', '', '2nd', '0485950241', 75),
(2020115761, 'BSIS', '', '4th', '0437282034', 76),
(2020115752, 'BSIS', 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', '4th', '0472321553', 79),
(2020115166, 'BSIS', '', '4th', '0476723473', 80),
(2020114925, 'BSIS', '', '4th', '0478138897', 83),
(2020115048, 'BSIS', 'BACHELOR OF SCIENCE IN INFORMATION SYSTEM', '4th', '0442750691', 86);

-- --------------------------------------------------------

--
-- Table structure for table `telleruser_tb`
--

CREATE TABLE `telleruser_tb` (
  `teller_id` int(11) NOT NULL,
  `firstname_teller` varchar(255) NOT NULL,
  `lastname_teller` varchar(255) NOT NULL,
  `phonenumber_teller` bigint(20) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `teller_gender` varchar(50) NOT NULL,
  `teller_qr` int(11) NOT NULL,
  `tellerqr_image` varchar(255) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `telleruser_tb`
--

INSERT INTO `telleruser_tb` (`teller_id`, `firstname_teller`, `lastname_teller`, `phonenumber_teller`, `store_name`, `teller_gender`, `teller_qr`, `tellerqr_image`, `user_category`, `username`, `password`) VALUES
(1, 'Ninang', 'Dela cruz', 9123456789, 'EATScetera', 'female', 58213946, '58213946.png', 'teller', 'teller1', '8f2ffd75dd4cd9e86ed995b7728a75e2'),
(2, 'Marlyn', 'Garcia', 9537583912, 'Mags Food Hub', 'female', 76293105, '76293105.png', 'teller', 'marlyn', 'f15f8f0c7451118642dd9b602718c562'),
(3, 'Grace', 'Mhie', 9437482741, 'Yanong\'s Store', 'female', 90456278, '90456278.png', 'teller', 'grace', '15e5c87b18c1289d45bb4a72961b58e8'),
(4, 'Kenny', 'Belarte', 9767686589, 'JD\'s Eatery', 'female', 62783140, '62783140.png', 'teller', 'belarte', '4df89289675f6a76284818a1e5ca6925');

-- --------------------------------------------------------

--
-- Table structure for table `userwebusages_tb`
--

CREATE TABLE `userwebusages_tb` (
  `userWebUsages_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `use_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userwebusages_tb`
--

INSERT INTO `userwebusages_tb` (`userWebUsages_id`, `user_id`, `user_category`, `use_date`) VALUES
(1, 1, 'teller', '2023-01-10'),
(2, 40, 'user_buyer', '2023-02-10'),
(3, 1, 'cashier', '2023-03-10'),
(4, 2, 'teller', '2023-04-10'),
(5, 45, 'user_buyer', '2023-05-10'),
(6, 37, 'user_buyer', '2023-06-10'),
(7, 36, 'user_buyer', '2023-07-10'),
(8, 41, 'user_buyer', '2023-08-10'),
(9, 5, 'teller', '2023-09-10'),
(10, 33, 'user_buyer', '2023-09-10'),
(11, 1, 'teller', '2023-09-11'),
(12, 2, 'teller', '2023-09-11'),
(13, 4, 'teller', '2023-09-11'),
(14, 45, 'user_buyer', '2023-09-11'),
(15, 3, 'teller', '2023-09-11'),
(16, 46, 'user_buyer', '2023-09-11'),
(17, 40, 'user_buyer', '2023-09-11'),
(18, 47, 'user_buyer', '2023-09-11'),
(19, 1, 'cashier', '2023-09-11'),
(20, 48, 'user_buyer', '2023-09-12'),
(21, 6, 'teller', '2023-09-13'),
(22, 7, 'teller', '2023-09-13'),
(23, 41, 'user_buyer', '2023-09-17'),
(24, 8, 'teller', '2023-09-19'),
(25, 9, 'teller', '2023-09-25'),
(26, 10, 'teller', '2023-09-28'),
(27, 1, 'cashier', '2023-10-01'),
(28, 40, 'user_buyer', '2023-10-01'),
(29, 58, 'user_buyer', '2023-10-01'),
(30, 33, 'user_buyer', '2023-10-03'),
(31, 1, 'teller', '2023-10-03'),
(32, 61, 'user_buyer', '2023-10-03'),
(33, 63, 'user_buyer', '2023-10-11'),
(34, 79, 'user_buyer', '2023-10-11'),
(35, 81, 'user_buyer', '2023-10-19'),
(36, 83, 'user_buyer', '2023-10-19'),
(37, 84, 'user_buyer', '2023-10-25'),
(38, 1, 'cashier', '2023-11-01'),
(39, 79, 'user_buyer', '2023-11-01'),
(40, 84, 'user_buyer', '2023-11-05'),
(41, 1, 'teller', '2023-11-05'),
(42, 86, 'user_buyer', '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `user_category` varchar(255) NOT NULL,
  `statues` varchar(20) NOT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `firstname`, `lastname`, `email`, `phonenumber`, `gender`, `address`, `complete_address`, `usertype`, `user_category`, `statues`, `register_date`, `username`, `password`) VALUES
(34, 'Ninang', 'Dela Cruz', 'ninang@gmail.com', 9987123654, 'female', 'non-bago', '', 'personnel', 'user_buyer', 'not-active', '2023-09-09', 'ninang', 'd54fd1674b1e312cba3cec56add7e00a'),
(35, 'Pablo', 'San jose', 'pablo@gmail.com', 9159357246, 'other', 'bago', '', 'personnel', 'user_buyer', 'not-active', '2023-09-06', 'pablo', '7e4b64eb65e34fdfad79e623c44abd94'),
(36, 'Jia mae', 'Gaspar', 'jiabadgirl@gmail.com', 9725468164, 'female', 'bago', '', 'personnel', 'user_buyer', 'not-active', '2023-09-10', 'jia', 'a6907acf5b337a322193f19b6698c867'),
(38, 'Angelo', 'Cortez', 'angelo@gmail.com', 9873465982, 'male', 'bago', '', 'personnel', 'user_buyer', 'not-active', '2023-09-10', 'angelo', '98a8d3f11b400ddc06d7343375b71a84'),
(46, 'Koa', 'Montelibano', 'koaknox8210@gmail.com', 9493582858, 'male', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-09-11', 'KoaKnox', '8028d74fe6ae33700bad6be602886890'),
(47, 'Keam', 'Casseus', 'keamcasseus8210@gmail.com', 9103199898, 'female', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-09-11', 'keamcasseus', '9dd736dbbbec565cfe90e38e93c5e3cd'),
(48, 'sherly', 'carpio', 'sherly@gmail.com', 9759872245, 'female', 'non-bago', '', 'personnel', 'user_buyer', 'not-active', '2023-09-12', 'sherly', '1c8b06358890d6c512859b21557315b4'),
(50, 'ashly', 'sunga', 'ashly@gmail.com', 9582349023, 'female', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-09-18', 'ashly', 'c114e447529c910fb405cc586adabe8f'),
(51, 'Rogaciano', 'Carpio', 'Rogaciano@gmail.com', 9531248312, 'male', 'non-bago', '', NULL, 'user_buyer', 'not-active', '2023-09-30', 'Rogaciano', 'd84f5ebdbb0138d19376fead142c9ae4'),
(64, 'KISSHA VERONICA', 'BELARTE', '', 9810552536, 'female', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2023019305', '3fd0f9eb0dee1fa44f22cec8d806a07a'),
(65, 'KIAN', 'SADIO', 'KIANSADIO283@GMAIL.COM', 9939064484, 'male', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2020115558', '9d0fdff0a7ca1f9cbe0b7553ee887719'),
(66, 'ROSALY', 'BARREDO', 'BARREDOROSALY@GMAIL.COM', 9301020253, 'female', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2021117366', 'a9eb8cb1236b1ff06141a564f9a71381'),
(67, 'JONA MAY', 'ODELMO', 'ODELMOJONAMAY@GMAIL.COM', 9152630029, 'female', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2021116715', '9e5b014336f2f454bd95480fbe6327ef'),
(68, 'CRIS DHENIEL', 'BATHAN', 'CRISDHENIELBATHAN@GMAIL.COM', 9122443890, 'male', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2021116526', '91cb88099fb85538ff3068ba143fd554'),
(69, 'JOSHUA JADE', 'DE ASIS', 'JOSHUAJADE2000@GMAIL.COM', 9076715377, 'male', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2019113585', '11943f599ef8db7d79e3559be7726eb2'),
(70, 'CHOLEN KATE', 'VILLAHERMOZA', '', 9565709333, 'female', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2022017958', '1946359365173169d03238de8e79e1f1'),
(71, 'JUARHT', 'VALENZUELA', 'NONOYARHTBOY@GMAIL.COM', 9506451553, 'male', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2022018006', '6dd93c8a6f36b0e40c2ef65b1df844f8'),
(72, 'MA. ALCREZA', 'ALAMPAYAN', 'MAALCREZAALAMPAYAN25@GMAIL.COM', 9101086430, 'female', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2020115788', '5b498e58edc0b2aee39277f88d7107b7'),
(73, 'MEL JHON', 'MALINAO', 'MELJHONMALINAO18@GMAIL.COM', 9163170404, 'male', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2020115817', 'bc499d94a3bd353ff3ddaee4fe55d99c'),
(74, 'CLARENCE', 'GALEA', '', 9369448732, 'male', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2020115739', '8f465e4dfb551860ff6b3cc8212ab6c8'),
(75, 'BIANCA MARIE', 'SION', '', 9388042554, 'female', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-11', '2022118767', '911ff67ab51513c03af3127f7c755592'),
(76, 'ARIEL', 'GABIANDAN', 'COLUMNAARIEL460@GMAIL.COM', 9922073188, 'male', 'non-bago', '', 'student', 'user_buyer', 'not-active\n', '2023-10-11', '2020115761', 'ed1a085c3eba34485679181c9a4c19c0'),
(79, 'GABRIEL', 'CARPIO', 'GABRIELCARPIO178@GMAIL.COM', 9708038647, 'male', 'non-bago', 'PUROK. CAMATIS, PACOL, BAGO CITY', 'student', 'user_buyer', 'not-active', '2023-10-11', 'gabrielcarpio', '505df4a053be83dbe1d6675d4c22031d'),
(80, 'ABEGAIL', 'EPAROSA', 'AEEPAROSA@GMAIL.COM', 9302442883, 'female', 'non-bago', '', 'student', 'user_buyer', 'not-active', '2023-10-12', '2020115166', '448d581442ea70e5b3d7a5e04bc2a56d'),
(83, 'KENNY', 'BELARTE', 'KNYBELARTE1120@GMAIL.COM', 9777180551, 'female', 'bago', '', 'student', 'user_buyer', 'not-active', '2023-10-19', '2020114925', '88594835d20004f1de8c2b9fdf7cf942'),
(86, 'JULIE', 'VILLACRUSIS', 'VILLACRUSISJULIE6@GMAIL.COM', 9107855364, 'female', 'bago', 'PRK. MASINADYAHON, BUSAY, BAGO CITY', 'student', 'user_buyer', 'not-active', '2023-11-05', '2020115048', 'b417b37ca4a6ef42fc8924ce6d9f323c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminannoucement`
--
ALTER TABLE `adminannoucement`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `admin_tb`
--
ALTER TABLE `admin_tb`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cashierrates_tb`
--
ALTER TABLE `cashierrates_tb`
  ADD PRIMARY KEY (`cashierRates_id`);

--
-- Indexes for table `cashier_tb`
--
ALTER TABLE `cashier_tb`
  ADD PRIMARY KEY (`cashier_id`);

--
-- Indexes for table `cashin_tb`
--
ALTER TABLE `cashin_tb`
  ADD PRIMARY KEY (`cashin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cashout_tb`
--
ALTER TABLE `cashout_tb`
  ADD PRIMARY KEY (`cashout_id`),
  ADD KEY `teller_id` (`teller_id`);

--
-- Indexes for table `category_tb`
--
ALTER TABLE `category_tb`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_tb_ibfk_1` (`teller_id`);

--
-- Indexes for table `digitalpayment_tb`
--
ALTER TABLE `digitalpayment_tb`
  ADD PRIMARY KEY (`digitalPayment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `teller_id` (`teller_id`);

--
-- Indexes for table `personnel_tb`
--
ALTER TABLE `personnel_tb`
  ADD PRIMARY KEY (`personnel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_tb`
--
ALTER TABLE `product_tb`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `teller_id` (`teller_id`);

--
-- Indexes for table `semesteryear_tb`
--
ALTER TABLE `semesteryear_tb`
  ADD PRIMARY KEY (`semesterYear_id`);

--
-- Indexes for table `sendbalance_tb`
--
ALTER TABLE `sendbalance_tb`
  ADD PRIMARY KEY (`sendBalance_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `telleruser_tb`
--
ALTER TABLE `telleruser_tb`
  ADD PRIMARY KEY (`teller_id`);

--
-- Indexes for table `userwebusages_tb`
--
ALTER TABLE `userwebusages_tb`
  ADD PRIMARY KEY (`userWebUsages_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminannoucement`
--
ALTER TABLE `adminannoucement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashierrates_tb`
--
ALTER TABLE `cashierrates_tb`
  MODIFY `cashierRates_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cashier_tb`
--
ALTER TABLE `cashier_tb`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashin_tb`
--
ALTER TABLE `cashin_tb`
  MODIFY `cashin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cashout_tb`
--
ALTER TABLE `cashout_tb`
  MODIFY `cashout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category_tb`
--
ALTER TABLE `category_tb`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `digitalpayment_tb`
--
ALTER TABLE `digitalpayment_tb`
  MODIFY `digitalPayment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `personnel_tb`
--
ALTER TABLE `personnel_tb`
  MODIFY `personnel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_tb`
--
ALTER TABLE `product_tb`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `semesteryear_tb`
--
ALTER TABLE `semesteryear_tb`
  MODIFY `semesterYear_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sendbalance_tb`
--
ALTER TABLE `sendbalance_tb`
  MODIFY `sendBalance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `telleruser_tb`
--
ALTER TABLE `telleruser_tb`
  MODIFY `teller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userwebusages_tb`
--
ALTER TABLE `userwebusages_tb`
  MODIFY `userWebUsages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashin_tb`
--
ALTER TABLE `cashin_tb`
  ADD CONSTRAINT `cashin_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `cashout_tb`
--
ALTER TABLE `cashout_tb`
  ADD CONSTRAINT `cashout_tb_ibfk_1` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `category_tb`
--
ALTER TABLE `category_tb`
  ADD CONSTRAINT `category_tb_ibfk_1` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `digitalpayment_tb`
--
ALTER TABLE `digitalpayment_tb`
  ADD CONSTRAINT `digitalpayment_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_tb`
--
ALTER TABLE `order_tb`
  ADD CONSTRAINT `order_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_tb_ibfk_2` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `personnel_tb`
--
ALTER TABLE `personnel_tb`
  ADD CONSTRAINT `personnel_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_tb`
--
ALTER TABLE `product_tb`
  ADD CONSTRAINT `product_tb_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_tb` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tb_ibfk_2` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sendbalance_tb`
--
ALTER TABLE `sendbalance_tb`
  ADD CONSTRAINT `sendbalance_tb_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sendbalance_tb_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD CONSTRAINT `student_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
