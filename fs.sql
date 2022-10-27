-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2022 at 10:38 PM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `id` int(100) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `address3` text NOT NULL,
  `new address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address1`, `address2`, `address3`, `new address`) VALUES
(1, '13/A,LKM street,chennai', '14/B,VOK street,salem', '10/S,IOL street,Trichy', ''),
(4, '12/A,lpm street', '13/9,akj street', '19/K,gth street', ''),
(6, '12/A,JIK street', '7th street,salem', '10th street,chennai', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2017-01-24 16:21:18', '21-06-2018 08:27:55 PM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Kids products', 'Test anuj', '2017-01-24 19:17:37', '30-01-2017 12:22:24 AM'),
(2, 'Teens products', 'Electronic Products', '2017-01-24 19:19:32', ''),
(3, 'Women products', 'test', '2017-01-24 19:19:54', ''),
(6, 'All', 'Fashion', '2017-02-20 19:18:52', '');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(100) NOT NULL,
  `country_name` varchar(1000) NOT NULL,
  `currency` varchar(1000) NOT NULL,
  `country_flag` varchar(255) DEFAULT NULL,
  `size_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `currency`, `country_flag`, `size_name`) VALUES
(1, 'UK', '<i class=\"fa fa-gbp\"></i>', 'united kingdom', 'xl'),
(2, 'MY', 'RM', 'malaysia', 'xl');

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
  `productId` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `orderStatus` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `productId`, `quantity`, `orderDate`, `paymentMethod`, `orderStatus`) VALUES
(1, 1, '3', 1, '2017-03-07 19:32:57', 'COD', NULL),
(3, 1, '4', 1, '2017-03-10 19:43:04', 'Debit / Credit card', 'Delivered'),
(4, 1, '17', 1, '2017-03-08 16:14:17', 'COD', 'in Process'),
(5, 1, '3', 1, '2017-03-08 19:21:38', 'COD', NULL),
(6, 1, '4', 1, '2017-03-08 19:21:38', 'COD', NULL),
(7, 1, '3', 1, '2022-09-07 04:54:14', 'Debit / Credit card', 'Delivered'),
(8, 1, '2', 1, '2022-09-07 05:02:06', 'COD', NULL),
(9, 1, '7', 1, '2022-09-19 06:13:56', 'Internet Banking', NULL),
(10, 1, '4', 2, '2022-10-01 08:34:28', 'Internet Banking', NULL),
(11, 1, '8', 1, '2022-10-01 08:58:14', 'Debit / Credit card', NULL),
(12, 1, '2', 1, '2022-10-01 11:34:55', 'Debit / Credit card', NULL),
(13, 1, '2', 1, '2022-10-01 11:35:13', 'Debit / Credit card', NULL),
(14, 1, '1', 1, '2022-10-06 10:04:51', 'Internet Banking', NULL),
(15, 1, '3', 1, '2022-10-06 10:04:51', 'Internet Banking', NULL),
(16, 1, '1', 1, '2022-10-07 05:58:20', 'Internet Banking', NULL),
(17, 1, '2', 1, '2022-10-08 05:15:53', 'COD', NULL),
(18, 1, '9', 1, '2022-10-10 05:18:52', 'Internet Banking', NULL),
(19, 1, '17', 1, '2022-10-10 07:37:06', 'Internet Banking', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordertrackhistory`
--

CREATE TABLE `ordertrackhistory` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `review` longtext,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `category` int(11) NOT NULL,
  `subCategory` int(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productPrice` varchar(11) DEFAULT NULL,
  `productPriceBeforeDiscount` int(11) DEFAULT NULL,
  `productDescription` longtext,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL,
  `country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `subCategory`, `productName`, `productCompany`, `productPrice`, `productPriceBeforeDiscount`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `shippingCharge`, `productAvailability`, `postingDate`, `updationDate`, `country`) VALUES
(1, 2, 4, 'Black  red style abaya', '', '567', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '002.png', '003.png', '001.png', 50, 'In Stock', '2017-01-30 16:54:35', '', 2),
(2, 2, 6, 'Blue fashion abaya', 'AAA', '1990', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '006.png', '005.png', '004.png', 0, 'In Stock', '2017-01-30 16:59:00', '', 1),
(3, 1, 4, 'White fashion abaya', 'MALYSIA', '999', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '009.png', '007.png', '008.png', 0, 'In Stock', '2017-02-04 04:03:15', '', 2),
(4, 3, 4, 'Ethnic Flared Sleeve Abaya', 'Lenovo', '919', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '010.png', '012.png', '011.png', 45, 'In Stock', '2017-02-04 04:04:43', '', 1),
(5, 3, 3, 'Pink Kaftan\'s Style Abaya', 'UK', '199', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '014.png', '015.png', '013.png', 0, 'In Stock', '2017-02-04 04:06:17', '', 2),
(6, 3, 4, 'Yellow Abaya Maxi Dress', 'UK', '699', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '017.png', '018.png', '016.png', 35, 'In Stock', '2017-02-04 04:08:07', '', 1),
(7, 2, 4, 'Model red  black abaya  ', 'MALYSIA', '1490', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '020.png', '021.png', '019.png', 20, 'In Stock', '2017-02-04 04:10:17', '', 2),
(8, 6, 5, 'plain embroid abaya', 'UK', '900', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '024.png', '023.png', '022.png', 0, 'In Stock', '2017-02-04 04:11:54', '', 1),
(9, 3, 4, 'Nardeen black abaya', 'MALAYSIA', '259', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '027.png', '025.png', '026.png', 10, 'In Stock', '2017-02-04 04:17:03', '', 2),
(11, 3, 8, 'Dress flower sleeve abaya', 'UK', '990', 0, '<ul><li>Fabric:Rayon Sleeve Length<br></li><li>Sleeves Pattern:Solid Net Quantity<br></li>', '028.png', '030.png', '029.png', 50, 'In Stock', '2017-02-04 04:26:17', '', 1),
(12, 6, 4, 'modern printed abaya\r\n', 'sinagpore', '346', 289, 'long lasting cloth\r\ngood quality', '003.png\r\n', '002.png', '001.png', 45, 'In Stock', '2022-09-19 11:08:11', '19/09/2022', 2),
(13, 6, 4, 'Front open casual abaya', 'uk', '564', 465, 'This casual abaya is front-open style abaya on the front. One of the best abaya for daily wear. The color and the simplicity of the abaya makes it more attractable. This dress can be used as cardigan also.', '004.png', '006.png', '005.png', 78, 'In Stock', '2022-09-19 11:12:41', '19/09/2022', 1),
(14, 1, 4, 'abaya', 'uk', '876', 567, 'good', '008.png', '007.png', '009.png', 67, 'In Stock', '2022-09-19 11:12:41', '19/09/2022', 2),
(15, 1, 4, 'abaya', 'uk', '786', 456, 'good', '011.png', '012.png', '010.png', 45, 'In Stock', '2022-09-19 11:15:49', '12.09.2022', 1),
(16, 1, 4, 'abaya', 'singapore', '678', 657, 'good', '015.png', '013.png', '014.png', 56, 'In Stock', '2022-09-19 11:15:49', '13.09.2022', 2),
(17, 1, 4, 'abaya', 'uk', '678', 567, 'good', '017.png', '018.png', '019.png', 50, 'In Stock', '2022-09-19 11:22:57', '12.09.2022', 1),
(19, 2, 4, 'abaya', 'uk', '654', 600, 'good', '025.png', '027.png', '026.png', 40, 'In Stock', '2022-09-19 11:22:57', '12/09/2022', 2),
(20, 2, 4, 'abaya', 'uk', '789', 700, 'abaya', '030.png', '029.png', '031.png', 60, 'In Stock', '2022-09-19 11:24:47', '20/02/2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `loginTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `role` int(11) NOT NULL,
  `createdAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `password`, `role`, `createdAt`) VALUES
(1, 'Mohamed Siddiq', 'siddiq@sparkztechin.com', '', '235eca186d5aa9a3b026aaca483d8c32e3c4397f', 1, '1666522532'),
(2, 'Test User', 'test@gmail.com', '', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 1, '1666523319'),
(3, 'Ameen Malik', 'ameenmalik03@yahoo.co.uk', '', '28cc6082cf391cdef7a4065b256cbb482eb39e35', 1, '1666567142');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `userId`, `productId`, `postingDate`) VALUES
(1, 1, 0, '2017-02-27 18:53:17'),
(4, 1, 18, '2022-09-05 05:18:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ordertrackhistory`
--
ALTER TABLE `ordertrackhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
