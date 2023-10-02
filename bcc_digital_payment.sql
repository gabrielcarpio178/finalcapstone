-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2023 at 07:36 PM
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
  `cashin_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashin_tb`
--

INSERT INTO `cashin_tb` (`cashin_id`, `user_id`, `cashin_amount`, `ref_num`, `cashin_date`) VALUES
(7, 58, 30, '1234567890', '2023-10-03 01:08:01'),
(8, 33, 30, '1234567891', '2023-10-03 01:26:56'),
(9, 58, 30, '2851649730', '2023-10-03 01:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `cashout_tb`
--

CREATE TABLE `cashout_tb` (
  `cashier_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `cashout_date` date NOT NULL,
  `cashout_amount` int(11) NOT NULL,
  `cashout_refnum` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashout_tb`
--

INSERT INTO `cashout_tb` (`cashier_id`, `teller_id`, `cashout_date`, `cashout_amount`, `cashout_refnum`) VALUES
(1, 1, '2023-09-20', 45, '4083726951');

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
(23, 5, 'Viand'),
(24, 5, 'Delicacies'),
(25, 5, 'Drinks'),
(26, 4, 'Supplies'),
(27, 4, 'Necessities'),
(28, 3, 'Candies');

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
(26, 37, 1, 1, 'Mountain dew', '6383295515', 'Drinks', '2023-08-25 13:25:50', '2023-08-25 13:36:17', 20, 1, 0, 'PROCEED'),
(28, 36, 1, 10, 'Coke', '6383295516', 'Drinks', '2023-08-26 00:01:47', '2023-08-27 10:43:51', 20, 1, 0, 'PROCEED'),
(33, 45, 1, 1, 'Mountain dew', '9785410212', 'Drinks', '2023-08-26 12:03:44', '2023-08-26 12:15:18', 20, 1, 1, 'PROCEED'),
(34, 34, 1, 10, 'Coke', '7914538602', 'Drinks', '2023-08-26 12:14:10', '2023-08-26 12:24:35', 20, 1, 0, 'PROCEED'),
(36, 34, 1, 1, 'Mountain dew', '7914538602', 'Drinks', '2023-08-26 12:14:10', '2023-08-26 12:24:35', 20, 1, 0, 'PROCEED'),
(41, 35, 1, 1, 'Mountain dew', '1605379842', 'Drinks', '2023-08-27 10:18:10', '2023-08-27 10:58:37', 20, 1, 0, 'PROCEED'),
(51, 45, 1, 1, 'Mountain dew', '6708429351', 'Drinks', '2023-08-27 18:02:55', '2023-08-27 18:13:14', 20, 1, 1, 'PROCEED'),
(59, 45, 1, 1, 'Mountain dew', '8276514930', 'Drinks', '2023-08-27 19:02:33', '2023-08-27 19:04:54', 20, 1, 1, 'PROCEED'),
(61, 37, 1, 1, 'Mountain dew', '2398165704', 'Drinks', '2023-08-27 22:33:34', '2023-08-27 22:43:55', 20, 1, 0, 'PROCEED'),
(65, 36, 1, 1, 'Mountain dew', '8063592417', 'Drinks', '2023-08-27 22:40:46', '2023-08-27 22:43:07', 20, 1, 0, 'PROCEED'),
(73, 37, 1, 10, 'Coke', '8352196740', 'Drinks', '2023-08-28 00:21:22', '2023-08-28 00:26:42', 20, 1, 0, 'PROCEED'),
(79, 34, 1, 1, 'Mountain dew', '6041327895', 'Drinks', '2023-08-28 00:37:00', '2023-08-28 00:48:11', 20, 1, 0, 'PROCEED'),
(87, 45, 1, 1, 'Mountain dew', '0831562479', 'Drinks', '2023-08-28 10:44:11', '2023-08-28 10:55:47', 20, 1, 1, 'PROCEED'),
(96, 46, 2, 26, 'Fita', '1935867402', 'Biscuit', '2023-09-11 13:56:08', NULL, 16, 2, 0, NULL),
(97, 46, 2, 23, 'Iced Coffee', '1935867402', 'Coolers', '2023-09-11 13:56:08', NULL, 30, 1, 0, NULL),
(101, 47, 2, 28, 'Hansel', '0698145237', 'Biscuit', '2023-09-11 14:05:15', NULL, 16, 2, 0, NULL),
(102, 47, 2, 23, 'Iced Coffee', '0698145237', 'Coolers', '2023-09-11 14:05:15', NULL, 30, 1, 0, NULL),
(103, 45, 2, 23, 'Iced Coffee', '4526937108', 'Coolers', '2023-09-11 14:30:34', '2023-09-11 14:46:45', 30, 1, 1, 'PROCEED'),
(125, 45, 1, 56, 'Le Minerale', '0658473291', 'Drinks', '2023-09-20 09:33:16', NULL, 20, 1, 1, 'CANCELED'),
(241, 45, 4, 44, 'Wet wipes', '3976410825', 'Necessities', '2023-09-28 16:17:47', '2023-09-28 16:38:56', 20, 1, 0, 'PROCEED'),
(242, 33, 1, 19, 'showbear', '0423759618', 'Candy', '2023-10-03 01:27:27', '2023-10-03 01:57:46', 2, 1, 0, 'PROCEED'),
(243, 33, 1, 16, 'mountain dew', '0423759618', 'Drinks', '2023-10-03 01:27:27', '2023-10-03 01:57:46', 20, 1, 0, 'PROCEED');

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
(7, 48, '1234567896', 'SSG'),
(8, 45, '3208145697', 'Admin');

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
(16, 13, 1, 'mountain dew', 20, 197, 500, '2023-08-29', 'mountain_dew-64dc37f0c3a84-64e4c4caab3aa-64e6b8087f1b0.jpg'),
(17, 15, 1, 'Fita', 8, 204, 150, '2023-08-29', 'fita-64fdd6e8d8944.jpeg'),
(18, 15, 1, 'Hansel', 7, 200, 180, '2023-08-29', 'hansel-choco-sandwich-64ee0ae77871c.jpg'),
(19, 16, 1, 'showbear', 2, 195, 200, '2023-09-10', 'snowbear-64fdd755b51b4.jpg'),
(20, 16, 1, 'maxx', 2, 200, 200, '2023-09-10', 'maxx-64fdd7933fe07.jpg'),
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
(35, 23, 5, 'Adobo', 30, 50, 1000, '2023-09-11', 'adobo-64feaa4ab210a.jpeg'),
(36, 23, 5, 'Fried Chicken', 20, 50, 750, '2023-09-11', 'fried chicken-64feaaacbcc09.jpg'),
(37, 23, 5, 'Chicken Curry', 30, 30, 700, '2023-09-11', 'curry-64feaacb66f88.jpg'),
(38, 25, 5, 'Le Minerale', 25, 20, 360, '2023-09-11', 'le minerale-64feab0fa2376.jpg'),
(39, 24, 5, 'Empanada', 15, 100, 1000, '2023-09-11', 'empanada-64feac30cb06f.jpeg'),
(40, 24, 5, 'Tuna Pie', 15, 50, 600, '2023-09-11', 'tunapie-64feac5d28656.jpg'),
(41, 25, 5, 'Absolute', 20, 30, 500, '2023-09-11', 'absolute-64feac7d8076d.jpg'),
(42, 25, 5, 'Blue', 35, 30, 850, '2023-09-11', 'blue-64feaca1f3625.jpeg'),
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
(56, 13, 1, 'Le Minerale', 20, 100, 1500, '2023-09-11', 'le minerale-64feb25421c70.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `studentID_number` bigint(20) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `rfid_number` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_tb`
--

INSERT INTO `student_tb` (`studentID_number`, `course`, `year`, `rfid_number`, `user_id`) VALUES
(2020112300, 'BSOA', '4th', '', 33),
(2020115740, 'BSED', '4th', '', 37),
(1164973821, 'BSOA', '3rd', '', 46),
(1234567891, 'BSOA', '3rd', '', 47),
(2020590400, 'BEED', '4th', '', 50),
(2020115752, 'BSIS', '4th', '0472321553', 58);

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
(1, 'Ninang', 'Dela cruz', 9123456789, 'teller one', 'female', 58213946, '58213946.png', 'teller', 'teller1', '8f2ffd75dd4cd9e86ed995b7728a75e2'),
(2, 'Marlyn', 'Garcia', 9537583912, 'teller two', 'female', 76293105, '76293105.png', 'teller', 'marlyn', 'f15f8f0c7451118642dd9b602718c562'),
(3, 'Grace', 'Mhie', 9437482741, 'grace Store', 'female', 90456278, '90456278.png', 'teller', 'grace', '15e5c87b18c1289d45bb4a72961b58e8'),
(4, 'Kenny', 'Belarte', 9767686589, 'belarte Store', 'female', 62783140, '62783140.png', 'teller', 'belarte', '4df89289675f6a76284818a1e5ca6925'),
(5, 'Evelyn', 'Lopez', 9255223456, 'evelyn Store', 'female', 61054238, '61054238.png', 'teller', 'evelyn', '8fbb8264c5040ec3ef3320336afa435a'),
(6, 'Ma. helen', 'Carpio', 9574856823, 'carpio Store', 'female', 62548793, '62548793.png', 'teller', 'helen', '7a2eb41a38a8f4e39c1586649da21e5f'),
(7, 'Gabriel', 'Carpio', 9578429942, 'gabs Store', 'male', 43582961, '43582961.png', 'teller', 'gabs', 'd42bdb5732712ade3f2f6a49efe040da'),
(10, 'gabriel', 'carpio', 9472349213, 'cars', 'male', 38604975, '38604975.png', 'teller', 'cars', 'e66a124f9cabd3198d84dd68c8c87cf7');

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
(31, 1, 'teller', '2023-10-03');

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
  `usertype` varchar(20) DEFAULT NULL,
  `user_category` varchar(255) NOT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `firstname`, `lastname`, `email`, `phonenumber`, `gender`, `address`, `usertype`, `user_category`, `register_date`, `username`, `password`) VALUES
(33, 'Kenny', 'Belarte', 'kenny@gmail.com', 9546213879, 'female', 'bago', 'student', 'user_buyer', '2023-08-10', 'kenny', 'fde290ea8d375a112998beacd5f4cff5'),
(34, 'Ninang', 'Dela Cruz', 'ninang@gmail.com', 9987123654, 'female', 'non-bago', 'personnel', 'user_buyer', '2023-09-09', 'ninang', 'd54fd1674b1e312cba3cec56add7e00a'),
(35, 'Pablo', 'San jose', 'pablo@gmail.com', 9159357246, 'other', 'bago', 'personnel', 'user_buyer', '2023-09-06', 'pablo', '7e4b64eb65e34fdfad79e623c44abd94'),
(36, 'Jia mae', 'Gaspar', 'jiabadgirl@gmail.com', 9725468164, 'female', 'bago', 'personnel', 'user_buyer', '2023-09-10', 'jia', 'a6907acf5b337a322193f19b6698c867'),
(37, 'Abegail', 'Eparosa', 'abegail@gmail.com', 9158497685, 'female', 'non-bago', 'student', 'user_buyer', '2023-09-10', 'abegail', '7eb036d95efd0ec315606393479aec4a'),
(38, 'Angelo', 'Cortez', 'angelo@gmail.com', 9873465982, 'male', 'bago', 'personnel', 'user_buyer', '2023-09-10', 'angelo', '98a8d3f11b400ddc06d7343375b71a84'),
(45, 'Julie', 'Villacrusis', 'julie@gmail.com', 9578949584, 'female', 'bago', 'personnel', 'user_buyer', '2023-09-10', 'julie', '16f12f5e8379e22be995e505ebfc1b84'),
(46, 'Koa', 'Montelibano', 'koaknox8210@gmail.com', 9493582858, 'male', 'bago', 'student', 'user_buyer', '2023-09-11', 'KoaKnox', '8028d74fe6ae33700bad6be602886890'),
(47, 'Keam', 'Casseus', 'keamcasseus8210@gmail.com', 9103199898, 'female', 'non-bago', 'student', 'user_buyer', '2023-09-11', 'keamcasseus', '9dd736dbbbec565cfe90e38e93c5e3cd'),
(48, 'sherly', 'carpio', 'sherly@gmail.com', 9759872245, 'female', 'non-bago', 'personnel', 'user_buyer', '2023-09-12', 'sherly', '1c8b06358890d6c512859b21557315b4'),
(50, 'ashly', 'sunga', 'ashly@gmail.com', 9582349023, 'female', 'non-bago', 'student', 'user_buyer', '2023-09-18', 'ashly', 'c114e447529c910fb405cc586adabe8f'),
(51, 'Rogaciano', 'Carpio', 'Rogaciano@gmail.com', 9531248312, 'male', 'non-bago', NULL, 'user_buyer', '2023-09-30', 'Rogaciano', 'd84f5ebdbb0138d19376fead142c9ae4'),
(58, 'GABRIEL', 'CARPIO', 'GABRIELCARPIO178@GMAIL.COM', 9708038647, 'male', 'bago', 'student', 'user_buyer', '2023-10-01', 'gabrielcarpio', '505df4a053be83dbe1d6675d4c22031d');

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
  ADD PRIMARY KEY (`cashier_id`),
  ADD KEY `teller_id` (`teller_id`);

--
-- Indexes for table `category_tb`
--
ALTER TABLE `category_tb`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `category_tb_ibfk_1` (`teller_id`);

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
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `admin_tb`
--
ALTER TABLE `admin_tb`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashier_tb`
--
ALTER TABLE `cashier_tb`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cashin_tb`
--
ALTER TABLE `cashin_tb`
  MODIFY `cashin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cashout_tb`
--
ALTER TABLE `cashout_tb`
  MODIFY `cashier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_tb`
--
ALTER TABLE `category_tb`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_tb`
--
ALTER TABLE `order_tb`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

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
-- AUTO_INCREMENT for table `telleruser_tb`
--
ALTER TABLE `telleruser_tb`
  MODIFY `teller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userwebusages_tb`
--
ALTER TABLE `userwebusages_tb`
  MODIFY `userWebUsages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
-- Constraints for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD CONSTRAINT `student_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
