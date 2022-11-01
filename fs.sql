-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 06:46 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fs`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `address2` text DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `userId`, `name`, `email`, `contact`, `address`, `address2`, `city`, `state`, `country`, `zipcode`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'Mohamed Siddiq', 'siddiq@sparkztechin.com', '1234567890', '1/1', 'Nelson Manickam Road', 'Chennai', 'Tamil Nadu', '1', '600001', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2017-01-24 16:21:18', '21-06-2018 08:27:55 PM');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productQty` int(11) NOT NULL,
  `productPrice` float NOT NULL,
  `country` int(11) NOT NULL,
  `createdAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `country` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `description`, `image`, `parent`, `country`, `status`, `author`, `createdAt`, `updatedAt`) VALUES
(1, 'Abaya', 'abaya', NULL, '1667143629527.jpg', NULL, 1, 1, 1, '1667049997', '1667213475'),
(2, 'Accessories', 'accessories', NULL, '1667113720.jpg', NULL, 2, 1, 1, '1667113720', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(100) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `code` varchar(11) NOT NULL,
  `currency` varchar(1000) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `currency`, `status`) VALUES
(1, 'United Kingdom', 'UK', '£', 1),
(2, 'Malaysia', 'MY', 'RM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ondemand`
--

CREATE TABLE `ondemand` (
  `id` int(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDesc` varchar(255) NOT NULL,
  `productimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ondemand`
--

INSERT INTO `ondemand` (`id`, `productName`, `productDesc`, `productimage`) VALUES
(1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `addressId` int(11) NOT NULL,
  `products` text DEFAULT NULL,
  `subtotal` float NOT NULL,
  `discount` float NOT NULL,
  `total` float NOT NULL,
  `country` int(11) NOT NULL,
  `orderDate` varchar(255) NOT NULL,
  `orderStatus` int(11) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `paymentStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `addressId`, `products`, `subtotal`, `discount`, `total`, `country`, `orderDate`, `orderStatus`, `paymentMethod`, `paymentStatus`) VALUES
(1, 1, 1, '[{\"id\":\"5\",\"userId\":\"1\",\"productId\":\"2\",\"productQty\":\"2\",\"productPrice\":\"200\",\"country\":\"1\",\"createdAt\":\"1667322232\"}]', 200, 0, 200, 1, '1667322971', 1, 'COD', '1'),
(2, 1, 1, '[{\"id\":\"7\",\"userId\":\"1\",\"productId\":\"2\",\"productQty\":\"2\",\"productPrice\":\"200\",\"country\":\"1\",\"createdAt\":\"1667324340\"},{\"id\":\"6\",\"userId\":\"1\",\"productId\":\"1\",\"productQty\":\"3\",\"productPrice\":\"150\",\"country\":\"1\",\"createdAt\":\"1667324317\"}]', 350, 0, 350, 1, '1667324408', 1, 'COD', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertrackhistory`
--

INSERT INTO `ordertrackhistory` (`id`, `orderId`, `status`, `remark`, `postingDate`) VALUES
(1, 3, 'in Process', 'Order has been Shipped.', '2017-03-10 19:36:45'),
(2, 1, 'Delivered', 'Order Has been delivered', '2017-03-10 19:37:31'),
(3, 3, 'Delivered', 'Product delivered successfully', '2017-03-10 19:43:04'),
(4, 4, 'in Process', 'Product ready for Shipping', '2017-03-10 19:50:36'),
(5, 7, 'in Process', 'Your order was successfully delivered', '2022-09-07 05:44:36'),
(6, 7, 'Delivered', 'Your order was delivered today', '2022-09-07 05:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `productId` int(1) NOT NULL,
  `featured` int(11) DEFAULT NULL,
  `createdAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`id`, `name`, `productId`, `featured`, `createdAt`) VALUES
(6, '16671436792584.png', 1, 1, '1667143679'),
(7, '16671436792529.png', 1, NULL, '1667143679'),
(8, '16671436791008.png', 1, NULL, '1667143679'),
(9, '16671437222081.png', 2, NULL, '1667143722'),
(10, '16671437221965.png', 2, NULL, '1667143722'),
(11, '16671437222538.png', 2, 1, '1667143722');

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`id`, `productId`, `quality`, `price`, `value`, `name`, `summary`, `review`, `reviewDate`) VALUES
(2, 3, 4, 5, 5, 'Anuj Kumar', 'BEST PRODUCT FOR ME :)', 'BEST PRODUCT FOR ME :)', '2017-02-26 20:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `shortDescription` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `subCategory` varchar(255) DEFAULT NULL,
  `country` int(11) NOT NULL,
  `isDiscount` int(11) NOT NULL,
  `price` double NOT NULL,
  `discountedPrice` double DEFAULT NULL,
  `images` text DEFAULT NULL,
  `isTopProduct` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `shortDescription`, `description`, `category`, `subCategory`, `country`, `isDiscount`, `price`, `discountedPrice`, `images`, `isTopProduct`, `status`, `author`, `createdAt`, `updatedAt`) VALUES
(1, 'Hijab', 'hijab', 'Product short description', '\"<p><strong>Hi,<\\/strong><\\/p><p>This is test product edited description<\\/p>\"', '1', NULL, 1, 1, 100, 50, NULL, 1, 1, 1, '1667048775', '1667143679'),
(2, 'New Hijab', 'new-hijab', '', '\"<p>Test<\\/p>\"', '1', NULL, 1, 0, 100, 0, NULL, 0, 1, 1, '1667113828', '1667287469');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `createdAt`) VALUES
(1, 'Super Admin', ''),
(2, 'Admin', ''),
(3, 'User', '');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `categoryid`, `subcategory`, `creationDate`, `updationDate`) VALUES
(2, 4, 'Led Television', '2017-01-26 16:24:52', '26-01-2017 11:03:40 PM'),
(3, 4, 'Television', '2017-01-26 16:29:09', ''),
(4, 4, 'Mobiles', '2017-01-30 16:55:48', ''),
(5, 4, 'Mobile Accessories', '2017-02-04 04:12:40', ''),
(6, 4, 'Laptops', '2017-02-04 04:13:00', ''),
(7, 4, 'Computers', '2017-02-04 04:13:27', ''),
(8, 3, 'Comics', '2017-02-04 04:13:54', ''),
(9, 5, 'Beds', '2017-02-04 04:36:45', ''),
(10, 5, 'Sofas', '2017-02-04 04:37:02', ''),
(11, 5, 'Dining Tables', '2017-02-04 04:37:51', ''),
(12, 6, 'Men Footwears', '2017-03-10 20:12:59', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(1, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 11:18:50', '', 1),
(2, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 11:29:33', '', 1),
(3, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 11:30:11', '', 1),
(4, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 15:00:23', '26-02-2017 11:12:06 PM', 1),
(5, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:08:58', '', 0),
(6, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:09:41', '', 0),
(7, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:10:04', '', 0),
(8, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:10:31', '', 0),
(9, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-26 18:13:43', '', 1),
(10, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-27 18:52:58', '', 0),
(11, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-02-27 18:53:07', '', 1),
(12, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-03 18:00:09', '', 0),
(13, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-03 18:00:15', '', 1),
(14, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-06 18:10:26', '', 1),
(15, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 12:28:16', '', 1),
(16, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 18:43:27', '', 1),
(17, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 18:55:33', '', 1),
(18, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-07 19:44:29', '', 1),
(19, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-08 19:21:15', '', 1),
(20, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-15 17:19:38', '', 1),
(21, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-15 17:20:36', '15-03-2017 10:50:39 PM', 1),
(22, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2017-03-16 01:13:57', '', 1),
(23, 'hgfhgf@gmass.com', 0x3a3a3100000000000000000000000000, '2018-04-29 09:30:40', '', 1),
(24, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-02 08:37:45', NULL, 0),
(25, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-02 08:41:00', '02-09-2022 02:11:59 PM', 1),
(26, 'admin@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-02 08:42:27', NULL, 0),
(27, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-02 08:42:45', NULL, 1),
(28, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-05 03:04:10', '05-09-2022 08:35:05 AM', 1),
(29, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-05 03:05:28', '05-09-2022 08:36:47 AM', 1),
(30, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-05 03:07:45', NULL, 1),
(31, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-05 05:18:05', '05-09-2022 10:48:54 AM', 1),
(32, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-07 04:53:54', '07-09-2022 11:11:31 AM', 1),
(33, 'aspire@tripleminfotech.com', 0x3a3a3100000000000000000000000000, '2022-09-08 06:07:02', NULL, 0),
(34, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 06:07:30', NULL, 1),
(35, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 10:08:14', '08-09-2022 03:45:46 PM', 1),
(36, 'karthikathiya8@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 10:21:09', '08-09-2022 04:13:15 PM', 1),
(37, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 10:45:42', '08-09-2022 04:20:58 PM', 1),
(38, 'karthikathiya8@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 10:52:42', NULL, 0),
(39, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 10:53:06', '08-09-2022 04:26:07 PM', 1),
(40, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-08 12:29:26', '08-09-2022 06:10:23 PM', 1),
(41, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-09 05:12:32', NULL, 1),
(42, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-11 13:54:28', NULL, 1),
(43, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-12 07:23:35', NULL, 1),
(44, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-13 04:43:41', NULL, 1),
(45, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 06:11:45', '19-09-2022 09:30:34 PM', 1),
(46, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:02:09', '19-09-2022 09:32:33 PM', 1),
(47, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:10:41', '19-09-2022 09:56:53 PM', 1),
(48, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:27:42', '19-09-2022 09:58:11 PM', 1),
(49, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:31:55', '19-09-2022 10:02:06 PM', 1),
(50, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:33:50', '19-09-2022 10:05:40 PM', 1),
(51, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:37:35', '19-09-2022 10:11:13 PM', 1),
(52, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:43:57', '19-09-2022 10:14:21 PM', 1),
(53, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:51:03', '19-09-2022 10:24:54 PM', 1),
(54, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-19 16:58:35', '19-09-2022 10:29:26 PM', 1),
(55, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-20 10:10:07', '20-09-2022 03:43:46 PM', 1),
(56, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-20 11:00:35', '20-09-2022 04:30:40 PM', 1),
(57, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-20 11:01:57', '20-09-2022 04:32:00 PM', 1),
(58, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-21 12:10:32', '21-09-2022 05:40:38 PM', 1),
(59, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-22 07:48:31', '22-09-2022 01:22:00 PM', 1),
(60, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-22 08:14:16', NULL, 1),
(61, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-23 05:18:43', NULL, 1),
(62, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 04:49:12', '26-09-2022 03:16:39 PM', 1),
(63, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 09:50:48', '26-09-2022 03:20:54 PM', 1),
(64, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 09:56:25', '26-09-2022 03:26:31 PM', 1),
(65, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 10:16:14', '26-09-2022 04:45:41 PM', 1),
(66, 'thiya8@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 11:16:13', NULL, 0),
(67, 'thiya8@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 11:16:52', NULL, 0),
(68, 'karthikathiya8@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 11:17:32', NULL, 0),
(69, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-26 11:18:06', NULL, 1),
(70, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 07:20:01', '30-09-2022 01:28:58 PM', 1),
(71, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:16:16', '30-09-2022 03:46:39 PM', 1),
(72, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:26:29', NULL, 1),
(73, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:26:39', '30-09-2022 03:56:49 PM', 0),
(74, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:31:19', '30-09-2022 04:01:24 PM', 1),
(75, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:32:04', '30-09-2022 04:02:07 PM', 1),
(76, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:32:42', '30-09-2022 04:02:58 PM', 1),
(77, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-09-30 10:38:58', '30-09-2022 04:09:01 PM', 1),
(78, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 05:15:38', '01-10-2022 10:45:48 AM', 1),
(79, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 05:16:59', '01-10-2022 10:47:02 AM', 1),
(80, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 05:18:21', '01-10-2022 10:48:28 AM', 1),
(81, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 05:21:11', '01-10-2022 10:51:15 AM', 1),
(82, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 05:24:44', '01-10-2022 10:54:48 AM', 1),
(83, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 05:30:55', '01-10-2022 11:00:58 AM', 1),
(84, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 06:34:03', '01-10-2022 12:04:27 PM', 1),
(85, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 06:37:08', '01-10-2022 12:25:00 PM', 1),
(86, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 06:59:05', '01-10-2022 12:30:10 PM', 1),
(87, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 07:33:41', '01-10-2022 01:04:27 PM', 1),
(88, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 08:34:18', '01-10-2022 02:33:11 PM', 1),
(89, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 10:04:45', '01-10-2022 03:35:26 PM', 1),
(90, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:34:44', '01-10-2022 05:06:42 PM', 1),
(91, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:37:36', '01-10-2022 05:07:40 PM', 1),
(92, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:41:56', '01-10-2022 05:11:58 PM', 1),
(93, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:43:08', '01-10-2022 05:13:11 PM', 1),
(94, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:43:46', '01-10-2022 05:13:50 PM', 1),
(95, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:44:40', '01-10-2022 05:14:43 PM', 1),
(96, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:48:41', '01-10-2022 05:18:44 PM', 1),
(97, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 11:57:06', '01-10-2022 05:27:14 PM', 1),
(98, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:02:46', '01-10-2022 05:32:48 PM', 1),
(99, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:06:27', '01-10-2022 05:36:30 PM', 1),
(100, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:07:40', '01-10-2022 05:37:43 PM', 1),
(101, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:10:17', '01-10-2022 05:40:19 PM', 1),
(102, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:12:15', '01-10-2022 05:42:17 PM', 1),
(103, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:16:40', '01-10-2022 05:46:43 PM', 1),
(104, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:17:20', '01-10-2022 05:47:22 PM', 1),
(105, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:18:19', '01-10-2022 05:48:27 PM', 1),
(106, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-01 12:21:31', '01-10-2022 05:51:34 PM', 1),
(107, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-03 11:45:48', '03-10-2022 05:16:07 PM', 1),
(108, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-05 07:02:58', '05-10-2022 12:36:04 PM', 1),
(109, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-05 07:06:31', '05-10-2022 12:37:27 PM', 1),
(110, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-05 07:08:33', '05-10-2022 01:05:43 PM', 1),
(111, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 05:17:46', '06-10-2022 10:53:28 AM', 1),
(112, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 05:33:56', '06-10-2022 12:40:29 PM', 1),
(113, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 08:00:29', '06-10-2022 01:30:48 PM', 1),
(114, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 08:01:08', '06-10-2022 01:31:23 PM', 1),
(115, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 08:04:29', '06-10-2022 02:02:50 PM', 1),
(116, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 08:35:21', '06-10-2022 02:05:26 PM', 1),
(117, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 09:20:02', '06-10-2022 02:55:50 PM', 1),
(118, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-06 10:02:48', '06-10-2022 03:38:43 PM', 1),
(119, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-07 05:58:03', '07-10-2022 11:29:49 AM', 1),
(120, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-07 08:21:13', '07-10-2022 01:52:48 PM', 1),
(121, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-07 11:41:21', NULL, 0),
(122, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-08 05:15:46', '08-10-2022 10:51:45 AM', 1),
(123, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-10 05:17:58', '10-10-2022 10:58:08 AM', 1),
(124, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-10 05:43:12', '10-10-2022 11:13:19 AM', 1),
(125, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-10 05:46:15', '10-10-2022 01:07:49 PM', 1),
(126, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2022-10-13 06:07:32', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `password`, `image`, `role`, `status`, `createdAt`) VALUES
(1, 'Mohamed Siddiq', 'siddiq@sparkztechin.com', '123', '235eca186d5aa9a3b026aaca483d8c32e3c4397f', '1667045275.jpg', 1, 1, '1666522532');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `createdAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `country`, `createdAt`) VALUES
(1, 1, 0, 0, ''),
(4, 1, 18, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ondemand`
--
ALTER TABLE `ondemand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ondemand`
--
ALTER TABLE `ondemand`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
