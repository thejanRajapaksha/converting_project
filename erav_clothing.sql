-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 12:16 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erav_clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `idtbl_bank` int(11) NOT NULL,
  `bname` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`idtbl_bank`, `bname`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Commercial Bank', 1, '2024-07-15 10:15:23', '2024-07-15 10:18:35', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cloth`
--

CREATE TABLE `tbl_cloth` (
  `idtbl_cloth` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cloth`
--

INSERT INTO `tbl_cloth` (`idtbl_cloth`, `type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'shirt', 1, '2024-06-06 10:41:06', NULL, NULL, 1),
(2, 'T-shirt', 1, '2024-06-06 10:57:02', '2024-06-06 12:03:55', NULL, 1),
(3, 'Trouser', 3, '2024-06-06 10:58:09', '2024-06-06 11:12:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colorcuff`
--

CREATE TABLE `tbl_colorcuff` (
  `idtbl_colorcuff` int(11) NOT NULL,
  `CMcategorytypeID` int(11) NOT NULL,
  `CMSupplierID` int(11) NOT NULL,
  `CMColorcodeID` int(11) NOT NULL,
  `CMOrderQuantity` int(11) NOT NULL,
  `CMOrderDate` date NOT NULL,
  `status` int(11) NOT NULL,
  `CMremark` varchar(255) DEFAULT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_order_idtbl_order` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_colorcuff`
--

INSERT INTO `tbl_colorcuff` (`idtbl_colorcuff`, `CMcategorytypeID`, `CMSupplierID`, `CMColorcodeID`, `CMOrderQuantity`, `CMOrderDate`, `status`, `CMremark`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`, `tbl_order_idtbl_order`, `tbl_inquiry_idtbl_inquiry`) VALUES
(1, 1, 4, 1, 2, '2024-08-22', 1, '', '2024-08-22 09:24:20', NULL, NULL, 1, 2, 35),
(2, 2, 4, 3, 6, '2024-08-12', 1, 'abc', '2024-08-22 09:36:16', NULL, NULL, 1, 2, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colour`
--

CREATE TABLE `tbl_colour` (
  `idtbl_colour` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_colour`
--

INSERT INTO `tbl_colour` (`idtbl_colour`, `type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Blue', 1, '2024-06-06 11:26:22', NULL, NULL, 1),
(2, 'Red', 3, '2024-06-06 11:27:50', '2024-06-06 12:05:57', NULL, 1),
(3, 'Red', 1, '2024-06-13 10:47:16', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `idtbl_customer` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_1` varchar(15) NOT NULL,
  `contact_2` varchar(15) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `address` varchar(150) NOT NULL,
  `nic` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`idtbl_customer`, `name`, `email`, `contact_1`, `contact_2`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`, `address`, `nic`) VALUES
(1, 'Thejan Rajapaksha', 'rajapakshalista41@gmail.com', '0768305353', '0768305353', 1, '2024-06-18 12:01:51', '2024-06-06 14:27:06', NULL, 1, 'NO 177/A MADA GONAWILLA DANKOTUWA, GONAWILLA', '2147483647'),
(2, 'Oshan Udara', 'oshanudara505@gmail.com', '0769454561', '0769454561', 1, '2024-06-18 12:03:12', '2024-06-06 14:27:35', NULL, 1, 'NO 2/1 Mada Gonawila, Dankotuwa', '2147483647');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_detail`
--

CREATE TABLE `tbl_delivery_detail` (
  `idtbl_delivery_detail` int(11) NOT NULL,
  `deliver_quantity` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `tbl_cloth_idtbl_cloth` int(11) NOT NULL,
  `tbl_size_idtbl_size` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_delivery_detail`
--

INSERT INTO `tbl_delivery_detail` (`idtbl_delivery_detail`, `deliver_quantity`, `delivery_date`, `tbl_cloth_idtbl_cloth`, `tbl_size_idtbl_size`, `tbl_inquiry_idtbl_inquiry`, `insertdatetime`, `tbl_user_idtbl_user`, `status`, `updatedatetime`, `updateuser`) VALUES
(1, 2, '2024-09-02', 2, 5, 35, '2024-09-04 11:47:14', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE `tbl_inquiry` (
  `idtbl_inquiry` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_customer_idtbl_customer` int(11) NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_inquiry`
--

INSERT INTO `tbl_inquiry` (`idtbl_inquiry`, `date`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_customer_idtbl_customer`, `tbl_user_idtbl_user`) VALUES
(2, '2024-06-19', 1, '2024-06-19 00:00:00', NULL, NULL, 1, 1),
(3, '2024-06-19', 1, '2024-06-19 00:00:00', '2024-06-19 13:07:11', NULL, 1, 1),
(4, '2024-06-04', 1, '2024-06-19 00:00:00', NULL, NULL, 2, 1),
(5, '2024-06-05', 1, '2024-06-20 10:10:58', NULL, NULL, 2, 1),
(6, '2024-06-05', 1, '2024-06-20 10:11:25', NULL, NULL, 2, 1),
(7, '2024-06-20', 1, '2024-06-20 10:16:25', NULL, NULL, 1, 1),
(8, '2024-06-20', 1, '2024-06-20 10:25:25', NULL, NULL, 2, 1),
(9, '2024-06-20', 1, '2024-06-20 10:30:08', NULL, NULL, 2, 1),
(10, '2024-06-21', 1, '2024-06-20 10:31:58', NULL, NULL, 1, 1),
(11, '2024-06-19', 1, '2024-06-20 10:38:07', NULL, NULL, 1, 1),
(35, '2024-07-09', 1, '2024-07-09 10:40:41', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry_detail`
--

CREATE TABLE `tbl_inquiry_detail` (
  `idtbl_inquiry_detail` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_cloth_idtbl_cloth` int(11) NOT NULL,
  `tbl_material_idtbl_material` int(11) NOT NULL,
  `tbl_salesrep_idtbl_salesrep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_inquiry_detail`
--

INSERT INTO `tbl_inquiry_detail` (`idtbl_inquiry_detail`, `quantity`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_inquiry_idtbl_inquiry`, `tbl_user_idtbl_user`, `tbl_cloth_idtbl_cloth`, `tbl_material_idtbl_material`, `tbl_salesrep_idtbl_salesrep`) VALUES
(1, 111, 1, '0000-00-00 00:00:00', NULL, NULL, 2, 1, 1, 1, 0),
(2, 222, 1, '0000-00-00 00:00:00', NULL, NULL, 2, 1, 1, 1, 0),
(3, 12, 1, '0000-00-00 00:00:00', NULL, NULL, 3, 1, 1, 1, 0),
(4, 11, 1, '0000-00-00 00:00:00', NULL, NULL, 3, 1, 2, 3, 0),
(5, 23, 1, '0000-00-00 00:00:00', NULL, NULL, 4, 1, 1, 3, 0),
(6, 55, 1, '0000-00-00 00:00:00', NULL, NULL, 4, 1, 2, 1, 0),
(7, 263, 1, '2024-06-20 10:10:58', NULL, NULL, 5, 1, 1, 1, 0),
(8, 263, 1, '2024-06-20 10:11:25', NULL, NULL, 6, 1, 1, 1, 0),
(26, 900, 1, '2024-06-20 11:50:00', NULL, NULL, 24, 1, 1, 3, 0),
(27, 700, 3, '2024-06-20 11:50:55', '2024-06-20 11:54:42', NULL, 25, 1, 1, 1, 0),
(28, 123, 1, '2024-06-20 12:41:14', '2024-06-20 12:41:25', NULL, 26, 1, 1, 3, 1),
(29, 32, 1, '2024-07-08 11:54:09', '2024-07-08 11:54:40', NULL, 34, 1, 1, 1, 1),
(30, 12, 1, '2024-07-09 10:40:41', NULL, NULL, 35, 1, 1, 1, 1),
(31, 32, 1, '2024-07-09 10:40:41', NULL, NULL, 35, 1, 2, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material`
--

CREATE TABLE `tbl_material` (
  `idtbl_material` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_material`
--

INSERT INTO `tbl_material` (`idtbl_material`, `type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Linen', 1, '2024-06-06 12:11:37', NULL, NULL, 1),
(2, 'Cotton', 3, '2024-06-06 12:11:43', '2024-06-06 12:12:12', NULL, 1),
(3, 'poliyester', 1, '2024-06-13 10:47:29', '2024-08-14 15:20:18', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_material_detail`
--

CREATE TABLE `tbl_material_detail` (
  `idtbl_material_detail` int(11) NOT NULL,
  `mat_quantity` int(11) NOT NULL,
  `mat_balance` int(11) DEFAULT NULL,
  `mat_odate` date NOT NULL,
  `mat_remarks` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_material_idtbl_material` int(11) NOT NULL,
  `tbl_order_idtbl_order` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_material_detail`
--

INSERT INTO `tbl_material_detail` (`idtbl_material_detail`, `mat_quantity`, `mat_balance`, `mat_odate`, `mat_remarks`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`, `tbl_material_idtbl_material`, `tbl_order_idtbl_order`, `tbl_inquiry_idtbl_inquiry`) VALUES
(1, 1, 4, '2024-07-29', '', 1, '2024-07-29 13:59:44', NULL, NULL, 1, 3, 2, 35),
(2, 2, 3, '2024-07-29', 'aa', 1, '2024-07-29 14:04:28', NULL, NULL, 1, 1, 2, 35),
(3, 3, 3, '2024-07-29', '', 1, '2024-07-29 14:05:25', NULL, NULL, 1, 1, 2, 35),
(4, 4, 4, '2024-07-17', '', 1, '2024-07-29 14:09:36', NULL, NULL, 1, 3, 2, 35),
(5, 7, 4, '2024-07-02', '', 1, '2024-07-29 14:16:32', NULL, NULL, 1, 3, 2, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_list`
--

CREATE TABLE `tbl_menu_list` (
  `idtbl_menu_list` int(11) NOT NULL,
  `menu` varchar(450) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_menu_list`
--

INSERT INTO `tbl_menu_list` (`idtbl_menu_list`, `menu`, `status`) VALUES
(1, 'User Account', 1),
(2, 'User Type', 1),
(3, 'User Privileges', 1),
(4, 'Customer', 1),
(5, 'Cloth', 1),
(6, 'Colour', 1),
(7, 'Material', 1),
(8, 'Size', 1),
(9, 'Inquiry', 1),
(10, 'Quotation', 1),
(11, 'Rejected Inquiry', 1),
(12, 'Reason', 1),
(13, 'Order', 1),
(14, 'Supplier', 1),
(15, 'Supplier Type', 1),
(16, 'Payment', 1),
(17, 'Salesrep', 1),
(18, 'Bankdetails', 1),
(19, 'Materialdetail\r\n', 1),
(20, 'Printingdetail', 1),
(21, 'Deliverydetail', 1),
(22, 'Completedorder', 1),
(38, 'Getquotation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `idtbl_order` int(11) NOT NULL,
  `advance` double NOT NULL,
  `order_sdate` date NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `tbl_bank_idtbl_bank` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_payment_idtbl_payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`idtbl_order`, `advance`, `order_sdate`, `tbl_inquiry_idtbl_inquiry`, `tbl_bank_idtbl_bank`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`, `tbl_payment_idtbl_payment`) VALUES
(2, 10000, '2024-07-15', 35, 1, 1, '2024-07-15 18:59:13', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `idtbl_order_detail` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cutting_qty` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `tbl_size_idtbl_size` int(11) NOT NULL,
  `tbl_colour_idtbl_colour` int(11) DEFAULT NULL,
  `tbl_material_idtbl_material` int(11) NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_quotation_idtbl_quotation` int(11) DEFAULT NULL,
  `tbl_cloth_idtbl_cloth` int(11) NOT NULL,
  `tbl_order_idtbl_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`idtbl_order_detail`, `quantity`, `cutting_qty`, `start_date`, `end_date`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_inquiry_idtbl_inquiry`, `tbl_size_idtbl_size`, `tbl_colour_idtbl_colour`, `tbl_material_idtbl_material`, `tbl_user_idtbl_user`, `tbl_quotation_idtbl_quotation`, `tbl_cloth_idtbl_cloth`, `tbl_order_idtbl_order`) VALUES
(7, 11, 10, NULL, NULL, 1, '2024-07-16 16:29:51', NULL, NULL, 35, 1, NULL, 1, 1, NULL, 1, 2),
(8, 10, 9, NULL, NULL, 1, '2024-07-16 16:29:51', NULL, NULL, 35, 3, NULL, 1, 1, NULL, 1, 2),
(9, 13, 0, NULL, NULL, 1, '2024-07-16 16:31:03', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2),
(10, 15, 0, NULL, NULL, 1, '2024-07-16 19:38:17', NULL, NULL, 35, 1, NULL, 3, 1, NULL, 2, 2),
(11, 32, 0, NULL, NULL, 1, '2024-07-16 20:09:44', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2),
(12, 56, 0, NULL, NULL, 1, '2024-07-16 20:16:19', NULL, NULL, 35, 3, NULL, 1, 1, NULL, 1, 2),
(13, 45, 0, NULL, NULL, 1, '2024-07-17 11:31:33', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2),
(14, 11, 0, NULL, NULL, 1, '2024-07-17 11:36:49', NULL, NULL, 35, 5, NULL, 3, 1, NULL, 2, 2),
(15, 11, 0, NULL, NULL, 1, '2024-07-17 11:40:56', NULL, NULL, 35, 5, NULL, 3, 1, NULL, 2, 2),
(16, 34, 0, NULL, NULL, 1, '2024-07-17 11:41:13', NULL, NULL, 35, 5, NULL, 3, 1, NULL, 2, 2),
(17, 9, 0, NULL, NULL, 0, '2024-07-22 09:21:35', NULL, NULL, 35, 6, NULL, 3, 1, NULL, 2, 2),
(18, 12, 0, NULL, NULL, 0, '2024-07-22 09:26:41', NULL, NULL, 35, 6, NULL, 3, 1, NULL, 2, 2),
(19, 45, 0, NULL, NULL, 0, '2024-07-22 09:43:45', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2),
(20, 98, 0, NULL, NULL, 0, '2024-07-22 09:43:45', NULL, NULL, 35, 3, NULL, 3, 1, NULL, 2, 2),
(21, 20, 0, NULL, NULL, 0, '2024-07-22 09:55:16', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2),
(22, 23, 0, NULL, NULL, 0, '2024-07-22 10:04:56', NULL, NULL, 35, 5, NULL, 1, 1, NULL, 1, 2),
(23, 3, 0, NULL, NULL, 0, '2024-07-22 10:07:13', NULL, NULL, 35, 5, NULL, 3, 1, NULL, 2, 2),
(24, 20, 0, NULL, NULL, 0, '2024-07-22 10:09:46', NULL, NULL, 35, 5, NULL, 3, 1, NULL, 2, 2),
(25, 50, 0, NULL, NULL, 0, '2024-07-22 10:10:46', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2),
(26, 1, 0, NULL, NULL, 1, '2024-07-22 10:18:22', NULL, NULL, 35, 4, NULL, 3, 1, NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packaging_detail`
--

CREATE TABLE `tbl_packaging_detail` (
  `idtbl_packaging_detail` int(11) NOT NULL,
  `packed_quantity` int(11) NOT NULL,
  `packaging_date` date NOT NULL,
  `tbl_cloth_idtbl_cloth` int(11) NOT NULL,
  `tbl_size_idtbl_size` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_packaging_detail`
--

INSERT INTO `tbl_packaging_detail` (`idtbl_packaging_detail`, `packed_quantity`, `packaging_date`, `tbl_cloth_idtbl_cloth`, `tbl_size_idtbl_size`, `tbl_inquiry_idtbl_inquiry`, `insertdatetime`, `tbl_user_idtbl_user`, `status`, `updatedatetime`, `updateuser`) VALUES
(1, 5, '2024-09-02', 2, 1, 35, '2024-09-04 11:14:32', 1, 1, NULL, NULL),
(2, 4, '2024-09-01', 2, 3, 35, '2024-09-04 11:16:17', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `idtbl_payment` int(11) NOT NULL,
  `p_type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`idtbl_payment`, `p_type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Cash', 1, '2024-06-27 12:00:03', NULL, NULL, 1),
(2, 'Bank Transfer', 1, '2024-06-27 12:00:27', '2024-06-27 12:05:58', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_detail`
--

CREATE TABLE `tbl_payment_detail` (
  `idtbl_payment_details` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `tbl_payment_idtbl_payment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_detail`
--

INSERT INTO `tbl_payment_detail` (`idtbl_payment_details`, `amount`, `payment_date`, `tbl_inquiry_idtbl_inquiry`, `tbl_payment_idtbl_payment`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 100, '2024-09-01', 35, 1, 1, '2024-09-03 14:39:44', NULL, NULL, 1),
(2, 100, '2024-09-01', 35, 1, 1, '2024-09-03 14:44:20', NULL, NULL, 1),
(3, 200, '2024-09-02', 35, 2, 1, '2024-09-03 14:45:23', NULL, NULL, 1),
(4, 500, '2024-09-01', 35, 2, 1, '2024-09-03 15:53:15', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_printing_detail`
--

CREATE TABLE `tbl_printing_detail` (
  `idtbl_printing_detail` int(11) NOT NULL,
  `printing_qty` int(11) NOT NULL,
  `sewing_com` int(11) NOT NULL,
  `printing_com` int(11) NOT NULL,
  `assigndate` date NOT NULL,
  `design_type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_cloth_idtbl_cloth` int(11) NOT NULL,
  `tbl_order_idtbl_order` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_printing_detail`
--

INSERT INTO `tbl_printing_detail` (`idtbl_printing_detail`, `printing_qty`, `sewing_com`, `printing_com`, `assigndate`, `design_type`, `status`, `remark`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`, `tbl_cloth_idtbl_cloth`, `tbl_order_idtbl_order`, `tbl_inquiry_idtbl_inquiry`) VALUES
(1, 1, 3, 2, '2024-08-08', 'Embroid', 1, 'aaa', '2024-08-08 11:58:26', NULL, NULL, 1, 1, 2, 35),
(2, 20, 3, 2, '2024-08-08', 'Screen Printing', 1, NULL, '2024-08-08 12:15:35', NULL, NULL, 1, 2, 2, 35),
(3, 31, 3, 2, '2024-08-08', 'Submission', 1, NULL, '2024-08-08 12:15:35', NULL, NULL, 1, 1, 2, 35),
(4, 3, 3, 2, '2024-08-08', 'DTF', 1, NULL, '2024-08-08 12:18:34', NULL, NULL, 1, 1, 2, 35),
(5, 3, 3, 2, '2024-08-08', 'Screen Printing', 1, NULL, '2024-08-08 12:45:34', NULL, NULL, 1, 1, 2, 35),
(6, 2, 3, 2, '2024-08-09', 'Embroid, Screen Printing', 1, NULL, '2024-08-09 10:15:27', NULL, NULL, 1, 2, 2, 35),
(7, 17, 3, 2, '2024-08-12', 'DTF', 1, NULL, '2024-08-12 09:18:35', NULL, NULL, 1, 1, 2, 35),
(8, 7, 3, 2, '2024-08-12', 'DTF', 1, 'svdxcv', '2024-08-12 09:23:12', NULL, NULL, 1, 1, 2, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_printing_receive`
--

CREATE TABLE `tbl_printing_receive` (
  `idtbl_printing_receive` int(11) NOT NULL,
  `sewing_com` int(11) DEFAULT NULL,
  `printing_com` int(11) DEFAULT NULL,
  `colorcuff_com` int(11) DEFAULT NULL,
  `design_type` varchar(45) DEFAULT NULL,
  `colorcuff` int(11) DEFAULT NULL,
  `received_qty` int(11) DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_cloth_idtbl_cloth` int(11) DEFAULT NULL,
  `tbl_order_idtbl_order` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `Rremark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_printing_receive`
--

INSERT INTO `tbl_printing_receive` (`idtbl_printing_receive`, `sewing_com`, `printing_com`, `colorcuff_com`, `design_type`, `colorcuff`, `received_qty`, `received_date`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`, `tbl_cloth_idtbl_cloth`, `tbl_order_idtbl_order`, `tbl_inquiry_idtbl_inquiry`, `Rremark`) VALUES
(1, NULL, 0, NULL, 'Embroid', NULL, 1, '2024-08-15', 1, '2024-08-15 12:06:50', NULL, NULL, 1, 1, 2, 35, ''),
(2, NULL, NULL, NULL, 'Embroid', NULL, 1, '2024-08-15', 1, '2024-08-15 12:14:39', NULL, NULL, 1, 1, 2, 35, ''),
(3, NULL, NULL, NULL, 'Screen Printing', NULL, 1, '2024-08-15', 1, '2024-08-15 12:19:56', NULL, NULL, 1, 1, 2, 35, ''),
(4, NULL, NULL, NULL, 'Screen Printing', NULL, 1, '2024-08-15', 1, '2024-08-15 12:28:54', NULL, NULL, 1, 1, 2, 35, ''),
(5, 3, 2, NULL, 'Screen Printing', NULL, 1, '2024-08-15', 1, '2024-08-15 12:33:14', NULL, NULL, 1, 2, 2, 35, ''),
(6, NULL, 2, NULL, 'Screen Printing', NULL, 1, '2024-08-15', 1, '2024-08-15 12:34:08', NULL, NULL, 1, 1, 2, 35, ''),
(7, 3, NULL, NULL, 'Screen Printing', NULL, 1, '2024-08-08', 1, '2024-08-15 12:34:08', NULL, NULL, 1, 2, 2, 35, ''),
(8, NULL, 2, NULL, 'Screen Printing', NULL, 1, '2024-08-15', 1, '2024-08-15 13:55:15', NULL, NULL, 1, 1, 2, 35, ''),
(9, 3, NULL, NULL, 'Embroid', NULL, 3, '2024-08-17', 1, '2024-08-15 13:58:26', NULL, NULL, 1, 1, 2, 35, 'ax'),
(12, NULL, NULL, 4, '', 1, 3, '2024-08-27', 1, '2024-08-27 11:47:03', NULL, NULL, 1, 0, 2, 35, ''),
(13, 3, NULL, NULL, 'DTF', 0, 2, '2024-08-27', 1, '2024-08-27 11:48:23', NULL, NULL, 1, 1, 2, 35, ''),
(14, NULL, NULL, 4, '', 1, 4, '2024-08-14', 1, '2024-08-27 11:49:43', NULL, NULL, 1, 0, 2, 35, ''),
(15, NULL, NULL, NULL, '', 1, 5, '2024-08-27', 1, '2024-08-27 11:52:22', NULL, NULL, 1, 0, 2, 35, ''),
(16, NULL, NULL, 4, '', 2, 2, '2024-08-27', 1, '2024-08-27 11:57:58', NULL, NULL, 1, 0, 2, 35, ''),
(17, NULL, NULL, 4, '', 2, 3, '2024-08-05', 1, '2024-08-27 11:58:18', NULL, NULL, 1, 2, 2, 35, ''),
(18, NULL, NULL, NULL, NULL, NULL, 6, '2024-08-27', 1, '2024-08-27 12:09:45', NULL, NULL, 1, 2, 2, 35, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image`
--

CREATE TABLE `tbl_product_image` (
  `idtbl_product_image` int(11) NOT NULL,
  `imagepath` mediumtext NOT NULL,
  `imgtype` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_quotation_idtbl_quotation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product_image`
--

INSERT INTO `tbl_product_image` (`idtbl_product_image`, `imagepath`, `imgtype`, `status`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_quotation_idtbl_quotation`) VALUES
(1, 'images/uploads/b00ad815ba9521e48a22279909a9fb7d2024-07-0109-48-48am40292153.jpg', 0, 1, '2024-07-01 09:48:48', 1, 10),
(2, 'images/uploads/c97f2ea008a46d10d4c2cd57ae0c25092024-07-0109-50-29am58204443.jpg', 0, 1, '2024-07-01 09:50:29', 1, 11),
(3, 'images/uploads/c97f2ea008a46d10d4c2cd57ae0c25092024-07-0109-50-29am58204443.jpg', 0, 1, '2024-07-01 09:50:29', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation`
--

CREATE TABLE `tbl_quotation` (
  `idtbl_quotation` int(11) NOT NULL,
  `quot_date` date NOT NULL,
  `duedate` date NOT NULL,
  `total` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `nettotal` double DEFAULT NULL,
  `delivery_charge` double DEFAULT NULL,
  `approvestatus` int(11) DEFAULT NULL,
  `approvedate` date DEFAULT NULL,
  `approveuser` int(11) DEFAULT NULL,
  `reject_resone` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_inquiry_idtbl_inquiry` int(11) NOT NULL,
  `tbl_customer_idtbl_customer` int(11) NOT NULL,
  `tbl_reason_idtbl_reason` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_quotation`
--

INSERT INTO `tbl_quotation` (`idtbl_quotation`, `quot_date`, `duedate`, `total`, `discount`, `nettotal`, `delivery_charge`, `approvestatus`, `approvedate`, `approveuser`, `reject_resone`, `remarks`, `status`, `insertdatetime`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_inquiry_idtbl_inquiry`, `tbl_customer_idtbl_customer`, `tbl_reason_idtbl_reason`) VALUES
(3, '2024-07-01', '2024-07-01', 35236, 0, 0, 0, 1, '2024-07-23', 1, 'blah blah', '', 1, '2024-07-01 11:48:37', '2024-07-23 10:10:12', 1, 4, 2, 2),
(4, '2024-07-09', '2024-07-09', 17840, 0, 0, 0, 1, '2024-07-23', 1, '', '', 4, '2024-07-09 10:41:21', '2024-09-10 13:42:09', 1, 35, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_detail`
--

CREATE TABLE `tbl_quotation_detail` (
  `idtbl_quotation_detail` int(11) NOT NULL,
  `qty` double NOT NULL,
  `unitprice` double NOT NULL,
  `discountamount` double NOT NULL,
  `total` double NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `tbl_quotation_idtbl_quotation` int(11) NOT NULL,
  `tbl_material_idtbl_material` int(11) NOT NULL,
  `tbl_cloth_idtbl_cloth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_quotation_detail`
--

INSERT INTO `tbl_quotation_detail` (`idtbl_quotation_detail`, `qty`, `unitprice`, `discountamount`, `total`, `comment`, `status`, `tbl_quotation_idtbl_quotation`, `tbl_material_idtbl_material`, `tbl_cloth_idtbl_cloth`) VALUES
(1, 55, 531, 0, 29205, '', 1, 9, 1, 2),
(2, 23, 132, 0, 3036, '', 1, 10, 3, 1),
(3, 23, 135, 0, 3105, '', 1, 11, 3, 1),
(4, 55, 531, 0, 29205, '', 1, 11, 1, 2),
(5, 23, 1532, 0, 35236, '', 1, 3, 3, 1),
(6, 12, 420, 0, 5040, '', 1, 4, 1, 1),
(7, 32, 400, 0, 12800, '', 1, 4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_reject`
--

CREATE TABLE `tbl_quotation_reject` (
  `idtbl_quotation_reject` int(11) NOT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_reason_idtbl_reason` int(11) NOT NULL,
  `tbl_quotation_idtbl_quotation` int(11) NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reason`
--

CREATE TABLE `tbl_reason` (
  `idtbl_reason` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_reason`
--

INSERT INTO `tbl_reason` (`idtbl_reason`, `type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Price miss match', 1, '2024-06-06 12:29:57', NULL, NULL, 1),
(2, 'Material Problem', 1, '2024-06-06 12:30:16', '2024-06-06 12:30:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salesrep`
--

CREATE TABLE `tbl_salesrep` (
  `idtbl_salesrep` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_1` varchar(15) NOT NULL,
  `contact_2` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `nic` varchar(13) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_salesrep`
--

INSERT INTO `tbl_salesrep` (`idtbl_salesrep`, `name`, `email`, `contact_1`, `contact_2`, `address`, `nic`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Thejan ', 'rajapakshalista41@gmail.com', '0768305353', '', 'NO 177/A MADA GONAWILLA DANKOTUWA, GONAWILLA', '200236502892', 1, '2024-07-08 09:52:09', '2024-07-08 09:52:09', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `idtbl_size` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`idtbl_size`, `type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'XS', 1, '2024-06-06 12:16:38', NULL, NULL, 1),
(2, 'S', 3, '2024-06-06 12:16:47', '2024-06-06 12:17:14', NULL, 1),
(3, 'L', 1, '2024-06-13 10:47:37', NULL, NULL, 1),
(4, 'S', 1, '2024-06-27 11:55:16', '2024-06-27 11:57:47', NULL, 1),
(5, 'XL', 1, '2024-06-27 11:57:28', '2024-06-27 11:57:59', NULL, 1),
(6, 'XXL', 1, '2024-06-27 11:58:26', '2024-06-27 11:59:55', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `idtbl_supplier` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `contact_1` varchar(45) NOT NULL,
  `contact_2` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_vender_idtbl_vender` int(11) NOT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`idtbl_supplier`, `name`, `email`, `contact_1`, `contact_2`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_vender_idtbl_vender`, `tbl_user_idtbl_user`) VALUES
(2, 'Thejan', 'sample@gmail.com', '0768305353', '', 1, '2024-06-06 15:17:39', NULL, NULL, 1, 1),
(3, 'Saman', 'saman@gmail.com', '0761234567', '', 1, '2024-06-06 15:44:43', '2024-06-06 15:52:45', NULL, 2, 1),
(4, 'Yohan', 'sample@gmail.com', '0771474195', '', 1, '2024-08-20 11:43:01', NULL, NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `idtbl_user` int(11) NOT NULL,
  `name` varchar(450) NOT NULL,
  `nicno` varchar(12) NOT NULL,
  `username` varchar(450) NOT NULL,
  `password` mediumtext NOT NULL,
  `status` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL,
  `tbl_user_type_idtbl_user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`idtbl_user`, `name`, `nicno`, `username`, `password`, `status`, `updatedatetime`, `tbl_user_type_idtbl_user_type`) VALUES
(1, 'Super Administrator', '', 'admin', 'd821593fb69464313bee856b9174d815', 1, '2024-06-05 15:02:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_privilege`
--

CREATE TABLE `tbl_user_privilege` (
  `idtbl_user_privilege` int(11) NOT NULL,
  `add` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `statuschange` int(11) NOT NULL,
  `remove` int(11) NOT NULL,
  `access_status` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL,
  `tbl_menu_list_idtbl_menu_list` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_privilege`
--

INSERT INTO `tbl_user_privilege` (`idtbl_user_privilege`, `add`, `edit`, `statuschange`, `remove`, `access_status`, `status`, `insertdatetime`, `updateuser`, `updatedatetime`, `tbl_user_idtbl_user`, `tbl_menu_list_idtbl_menu_list`) VALUES
(1, 1, 1, 1, 1, 1, 1, '2024-06-05 11:47:51', NULL, NULL, 1, 1),
(2, 1, 1, 1, 1, 1, 1, '2024-06-05 11:47:51', NULL, NULL, 1, 2),
(3, 1, 1, 1, 1, 1, 1, '2024-06-05 11:47:51', NULL, NULL, 1, 3),
(4, 1, 1, 1, 1, 1, 1, '2024-06-05 15:40:45', NULL, NULL, 1, 4),
(5, 1, 1, 1, 1, 1, 1, '2024-06-05 15:41:38', NULL, NULL, 1, 5),
(6, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 6),
(7, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 7),
(8, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 8),
(9, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 9),
(10, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 10),
(11, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 11),
(12, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 12),
(13, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 13),
(14, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 14),
(15, 1, 1, 1, 1, 1, 1, '2024-06-05 15:42:23', NULL, NULL, 1, 15),
(41, 1, 1, 1, 1, 1, 1, '2024-06-24 06:56:29', NULL, NULL, 1, 38),
(42, 1, 1, 1, 1, 1, 1, '2024-06-27 11:45:50', NULL, NULL, 1, 16),
(43, 1, 1, 1, 1, 1, 1, '2024-07-06 11:19:47', NULL, NULL, 1, 17),
(44, 1, 1, 1, 1, 1, 1, '2024-07-15 09:53:18', NULL, NULL, 1, 18),
(45, 1, 1, 1, 1, 1, 1, '2024-07-23 10:33:26', 1, '2024-07-23 03:36:01', 1, 19),
(46, 1, 1, 1, 1, 1, 1, '2024-07-23 10:33:39', NULL, NULL, 1, 20),
(47, 1, 1, 1, 1, 1, 1, '2024-08-29 09:39:06', NULL, NULL, 1, 21),
(48, 1, 1, 1, 1, 1, 1, '2024-09-09 09:39:24', NULL, NULL, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_type`
--

CREATE TABLE `tbl_user_type` (
  `idtbl_user_type` int(11) NOT NULL,
  `usertype` varchar(450) NOT NULL,
  `status` int(11) NOT NULL,
  `updatedatetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_type`
--

INSERT INTO `tbl_user_type` (`idtbl_user_type`, `usertype`, `status`, `updatedatetime`) VALUES
(1, 'Super Administrator\r\n', 1, '2024-05-06 09:52:00'),
(2, 'Administrator\r\n', 1, '2024-05-06 09:52:00'),
(3, 'User', 1, '2024-05-06 09:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vender`
--

CREATE TABLE `tbl_vender` (
  `idtbl_vender` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `insertdatetime` datetime NOT NULL,
  `updatedatetime` datetime DEFAULT NULL,
  `updateuser` int(11) DEFAULT NULL,
  `tbl_user_idtbl_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_vender`
--

INSERT INTO `tbl_vender` (`idtbl_vender`, `type`, `status`, `insertdatetime`, `updatedatetime`, `updateuser`, `tbl_user_idtbl_user`) VALUES
(1, 'Printing', 1, '2024-06-06 12:34:49', NULL, NULL, 1),
(2, 'Sewing', 1, '2024-06-06 12:36:06', '2024-06-06 12:36:33', NULL, 1),
(3, 'Color/Cuff', 1, '2024-08-06 12:46:13', NULL, NULL, 1),
(4, 'Sewing', 3, '2024-08-06 12:46:21', NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`idtbl_bank`),
  ADD KEY `fk_tbl_size_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_cloth`
--
ALTER TABLE `tbl_cloth`
  ADD PRIMARY KEY (`idtbl_cloth`),
  ADD KEY `fk_tbl_cloth_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_colorcuff`
--
ALTER TABLE `tbl_colorcuff`
  ADD PRIMARY KEY (`idtbl_colorcuff`),
  ADD KEY `fk_tbl_printing_detail_tbl_order1_idx` (`tbl_order_idtbl_order`),
  ADD KEY `fk_tbl_printing_detail_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`);

--
-- Indexes for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  ADD PRIMARY KEY (`idtbl_colour`),
  ADD KEY `fk_tbl_colour_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`idtbl_customer`),
  ADD KEY `fk_tbl_customer_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_delivery_detail`
--
ALTER TABLE `tbl_delivery_detail`
  ADD PRIMARY KEY (`idtbl_delivery_detail`),
  ADD KEY `fk_tbl_order_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_order_tbl_size1_idx` (`tbl_size_idtbl_size`),
  ADD KEY `fk_tbl_order_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_order_tbl_cloth1_idx` (`tbl_cloth_idtbl_cloth`);

--
-- Indexes for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD PRIMARY KEY (`idtbl_inquiry`),
  ADD KEY `fk_tbl_inquiry_tbl_customer1_idx` (`tbl_customer_idtbl_customer`),
  ADD KEY `fk_tbl_inquiry_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_inquiry_detail`
--
ALTER TABLE `tbl_inquiry_detail`
  ADD PRIMARY KEY (`idtbl_inquiry_detail`),
  ADD KEY `fk_tbl_inquiry_detail_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_inquiry_detail_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_inquiry_detail_tbl_cloth1_idx` (`tbl_cloth_idtbl_cloth`),
  ADD KEY `fk_tbl_inquiry_detail_tbl_material1_idx` (`tbl_material_idtbl_material`),
  ADD KEY `fk_tbl_inquiry_detail_tbl_salesrep1_idx` (`tbl_salesrep_idtbl_salesrep`);

--
-- Indexes for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`idtbl_material`),
  ADD KEY `fk_tbl_material_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_material_detail`
--
ALTER TABLE `tbl_material_detail`
  ADD PRIMARY KEY (`idtbl_material_detail`),
  ADD KEY `fk_tbl_material_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_material_detail_tbl_material1_idx` (`tbl_material_idtbl_material`),
  ADD KEY `fk_tbl_material_detail_tbl_order1_idx` (`tbl_order_idtbl_order`),
  ADD KEY `fk_tbl_material_detail_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`);

--
-- Indexes for table `tbl_menu_list`
--
ALTER TABLE `tbl_menu_list`
  ADD PRIMARY KEY (`idtbl_menu_list`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`idtbl_order`),
  ADD KEY `fk_tbl_size_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_order_tbl_bank1_idx` (`tbl_bank_idtbl_bank`),
  ADD KEY `fk_tbl_order_tbl_inquiry2_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_order_tbl_payment1_idx` (`tbl_payment_idtbl_payment`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`idtbl_order_detail`),
  ADD KEY `fk_tbl_order_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_order_tbl_size1_idx` (`tbl_size_idtbl_size`),
  ADD KEY `fk_tbl_order_tbl_colour1_idx` (`tbl_colour_idtbl_colour`),
  ADD KEY `fk_tbl_order_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_order_tbl_quotation1_idx` (`tbl_quotation_idtbl_quotation`),
  ADD KEY `fk_tbl_order_tbl_material1_idx` (`tbl_material_idtbl_material`),
  ADD KEY `fk_tbl_order_tbl_cloth1_idx` (`tbl_cloth_idtbl_cloth`),
  ADD KEY `fk_tbl_order_detail_tbl_order1_idx` (`tbl_order_idtbl_order`);

--
-- Indexes for table `tbl_packaging_detail`
--
ALTER TABLE `tbl_packaging_detail`
  ADD PRIMARY KEY (`idtbl_packaging_detail`),
  ADD KEY `fk_tbl_order_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_order_tbl_size1_idx` (`tbl_size_idtbl_size`),
  ADD KEY `fk_tbl_order_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_order_tbl_cloth1_idx` (`tbl_cloth_idtbl_cloth`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`idtbl_payment`),
  ADD KEY `fk_tbl_payment_tbl_user1_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  ADD PRIMARY KEY (`idtbl_payment_details`),
  ADD KEY `fk_tbl_size_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_order_tbl_inquiry2_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_order_tbl_payment1_idx` (`tbl_payment_idtbl_payment`);

--
-- Indexes for table `tbl_printing_detail`
--
ALTER TABLE `tbl_printing_detail`
  ADD PRIMARY KEY (`idtbl_printing_detail`),
  ADD KEY `fk_tbl_printing_detail_tbl_cloth1_idx` (`tbl_cloth_idtbl_cloth`),
  ADD KEY `fk_tbl_printing_detail_tbl_order1_idx` (`tbl_order_idtbl_order`),
  ADD KEY `fk_tbl_printing_detail_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`);

--
-- Indexes for table `tbl_printing_receive`
--
ALTER TABLE `tbl_printing_receive`
  ADD PRIMARY KEY (`idtbl_printing_receive`),
  ADD KEY `fk_tbl_printing_detail_tbl_cloth1_idx` (`tbl_cloth_idtbl_cloth`),
  ADD KEY `fk_tbl_printing_detail_tbl_order1_idx` (`tbl_order_idtbl_order`),
  ADD KEY `fk_tbl_printing_detail_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`);

--
-- Indexes for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  ADD PRIMARY KEY (`idtbl_product_image`),
  ADD KEY `fk_tbl_product_image_tbl_user1_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_product_image_tbl_quotation1_idx` (`tbl_quotation_idtbl_quotation`);

--
-- Indexes for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  ADD PRIMARY KEY (`idtbl_quotation`),
  ADD KEY `fk_tbl_quatation_tbl_inquiry1_idx` (`tbl_inquiry_idtbl_inquiry`),
  ADD KEY `fk_tbl_quatation_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_quotation_tbl_customer1_idx` (`tbl_customer_idtbl_customer`),
  ADD KEY `fk_tbl_quotation_tbl_reason1_idx` (`tbl_reason_idtbl_reason`);

--
-- Indexes for table `tbl_quotation_detail`
--
ALTER TABLE `tbl_quotation_detail`
  ADD PRIMARY KEY (`idtbl_quotation_detail`);

--
-- Indexes for table `tbl_quotation_reject`
--
ALTER TABLE `tbl_quotation_reject`
  ADD PRIMARY KEY (`idtbl_quotation_reject`),
  ADD KEY `fk_tbl_quatation_reject_tbl_reason1_idx` (`tbl_reason_idtbl_reason`),
  ADD KEY `fk_tbl_quatation_reject_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_quatation_reject_tbl_quatation1_idx` (`tbl_quotation_idtbl_quotation`);

--
-- Indexes for table `tbl_reason`
--
ALTER TABLE `tbl_reason`
  ADD PRIMARY KEY (`idtbl_reason`),
  ADD KEY `fk_tbl_reason_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_salesrep`
--
ALTER TABLE `tbl_salesrep`
  ADD PRIMARY KEY (`idtbl_salesrep`),
  ADD KEY `fk_tbl_customer_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`idtbl_size`),
  ADD KEY `fk_tbl_size_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`idtbl_supplier`),
  ADD KEY `fk_tbl_supplier_tbl_vender1_idx` (`tbl_vender_idtbl_vender`),
  ADD KEY `fk_tbl_supplier_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`idtbl_user`),
  ADD KEY `fk_tbl_user_tbl_user_type2_idx` (`tbl_user_type_idtbl_user_type`);

--
-- Indexes for table `tbl_user_privilege`
--
ALTER TABLE `tbl_user_privilege`
  ADD PRIMARY KEY (`idtbl_user_privilege`),
  ADD KEY `fk_tbl_user_privilege_tbl_user2_idx` (`tbl_user_idtbl_user`),
  ADD KEY `fk_tbl_user_privilege_tbl_menu_list2_idx` (`tbl_menu_list_idtbl_menu_list`);

--
-- Indexes for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  ADD PRIMARY KEY (`idtbl_user_type`);

--
-- Indexes for table `tbl_vender`
--
ALTER TABLE `tbl_vender`
  ADD PRIMARY KEY (`idtbl_vender`),
  ADD KEY `fk_tbl_vender_tbl_user2_idx` (`tbl_user_idtbl_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `idtbl_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cloth`
--
ALTER TABLE `tbl_cloth`
  MODIFY `idtbl_cloth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_colorcuff`
--
ALTER TABLE `tbl_colorcuff`
  MODIFY `idtbl_colorcuff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  MODIFY `idtbl_colour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `idtbl_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_delivery_detail`
--
ALTER TABLE `tbl_delivery_detail`
  MODIFY `idtbl_delivery_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  MODIFY `idtbl_inquiry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_inquiry_detail`
--
ALTER TABLE `tbl_inquiry_detail`
  MODIFY `idtbl_inquiry_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `idtbl_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_material_detail`
--
ALTER TABLE `tbl_material_detail`
  MODIFY `idtbl_material_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_menu_list`
--
ALTER TABLE `tbl_menu_list`
  MODIFY `idtbl_menu_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `idtbl_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `idtbl_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_packaging_detail`
--
ALTER TABLE `tbl_packaging_detail`
  MODIFY `idtbl_packaging_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `idtbl_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  MODIFY `idtbl_payment_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_printing_detail`
--
ALTER TABLE `tbl_printing_detail`
  MODIFY `idtbl_printing_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_printing_receive`
--
ALTER TABLE `tbl_printing_receive`
  MODIFY `idtbl_printing_receive` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  MODIFY `idtbl_product_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `idtbl_quotation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_quotation_detail`
--
ALTER TABLE `tbl_quotation_detail`
  MODIFY `idtbl_quotation_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_quotation_reject`
--
ALTER TABLE `tbl_quotation_reject`
  MODIFY `idtbl_quotation_reject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_reason`
--
ALTER TABLE `tbl_reason`
  MODIFY `idtbl_reason` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_salesrep`
--
ALTER TABLE `tbl_salesrep`
  MODIFY `idtbl_salesrep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `idtbl_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `idtbl_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `idtbl_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_privilege`
--
ALTER TABLE `tbl_user_privilege`
  MODIFY `idtbl_user_privilege` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_user_type`
--
ALTER TABLE `tbl_user_type`
  MODIFY `idtbl_user_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vender`
--
ALTER TABLE `tbl_vender`
  MODIFY `idtbl_vender` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD CONSTRAINT `fk_tbl_size_tbl_user20` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_cloth`
--
ALTER TABLE `tbl_cloth`
  ADD CONSTRAINT `fk_tbl_cloth_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_colorcuff`
--
ALTER TABLE `tbl_colorcuff`
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_inquiry100` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_order100` FOREIGN KEY (`tbl_order_idtbl_order`) REFERENCES `tbl_order` (`idtbl_order`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  ADD CONSTRAINT `fk_tbl_colour_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `fk_tbl_customer_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_delivery_detail`
--
ALTER TABLE `tbl_delivery_detail`
  ADD CONSTRAINT `fk_tbl_order_tbl_cloth100` FOREIGN KEY (`tbl_cloth_idtbl_cloth`) REFERENCES `tbl_cloth` (`idtbl_cloth`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_inquiry100` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_size100` FOREIGN KEY (`tbl_size_idtbl_size`) REFERENCES `tbl_size` (`idtbl_size`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_user200` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_inquiry`
--
ALTER TABLE `tbl_inquiry`
  ADD CONSTRAINT `fk_tbl_inquiry_tbl_customer1` FOREIGN KEY (`tbl_customer_idtbl_customer`) REFERENCES `tbl_customer` (`idtbl_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_inquiry_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_inquiry_detail`
--
ALTER TABLE `tbl_inquiry_detail`
  ADD CONSTRAINT `fk_tbl_inquiry_detail_tbl_cloth1` FOREIGN KEY (`tbl_cloth_idtbl_cloth`) REFERENCES `tbl_cloth` (`idtbl_cloth`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_inquiry_detail_tbl_inquiry1` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_inquiry_detail_tbl_material1` FOREIGN KEY (`tbl_material_idtbl_material`) REFERENCES `tbl_material` (`idtbl_material`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_inquiry_detail_tbl_salesrep1` FOREIGN KEY (`tbl_salesrep_idtbl_salesrep`) REFERENCES `tbl_salesrep` (`idtbl_salesrep`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_inquiry_detail_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD CONSTRAINT `fk_tbl_material_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_material_detail`
--
ALTER TABLE `tbl_material_detail`
  ADD CONSTRAINT `fk_tbl_material_detail_tbl_inquiry1` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_detail_tbl_material1` FOREIGN KEY (`tbl_material_idtbl_material`) REFERENCES `tbl_material` (`idtbl_material`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_detail_tbl_order1` FOREIGN KEY (`tbl_order_idtbl_order`) REFERENCES `tbl_order` (`idtbl_order`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_material_tbl_user20` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `fk_tbl_order_tbl_inquiry2` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_payment1` FOREIGN KEY (`tbl_payment_idtbl_payment`) REFERENCES `tbl_payment` (`idtbl_payment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_size_tbl_user21` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `fk_tbl_order_detail_tbl_order1` FOREIGN KEY (`tbl_order_idtbl_order`) REFERENCES `tbl_order` (`idtbl_order`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_cloth1` FOREIGN KEY (`tbl_cloth_idtbl_cloth`) REFERENCES `tbl_cloth` (`idtbl_cloth`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_colour1` FOREIGN KEY (`tbl_colour_idtbl_colour`) REFERENCES `tbl_colour` (`idtbl_colour`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_inquiry1` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_material1` FOREIGN KEY (`tbl_material_idtbl_material`) REFERENCES `tbl_material` (`idtbl_material`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_quotation1` FOREIGN KEY (`tbl_quotation_idtbl_quotation`) REFERENCES `tbl_quotation` (`idtbl_quotation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_size1` FOREIGN KEY (`tbl_size_idtbl_size`) REFERENCES `tbl_size` (`idtbl_size`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_packaging_detail`
--
ALTER TABLE `tbl_packaging_detail`
  ADD CONSTRAINT `fk_tbl_order_tbl_cloth10` FOREIGN KEY (`tbl_cloth_idtbl_cloth`) REFERENCES `tbl_cloth` (`idtbl_cloth`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_inquiry10` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_size10` FOREIGN KEY (`tbl_size_idtbl_size`) REFERENCES `tbl_size` (`idtbl_size`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_user20` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `fk_tbl_payment_tbl_user1` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_payment_detail`
--
ALTER TABLE `tbl_payment_detail`
  ADD CONSTRAINT `fk_tbl_order_tbl_inquiry20` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_order_tbl_payment10` FOREIGN KEY (`tbl_payment_idtbl_payment`) REFERENCES `tbl_payment` (`idtbl_payment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_size_tbl_user210` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_printing_detail`
--
ALTER TABLE `tbl_printing_detail`
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_cloth1` FOREIGN KEY (`tbl_cloth_idtbl_cloth`) REFERENCES `tbl_cloth` (`idtbl_cloth`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_inquiry1` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_order1` FOREIGN KEY (`tbl_order_idtbl_order`) REFERENCES `tbl_order` (`idtbl_order`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_printing_receive`
--
ALTER TABLE `tbl_printing_receive`
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_inquiry10` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_printing_detail_tbl_order10` FOREIGN KEY (`tbl_order_idtbl_order`) REFERENCES `tbl_order` (`idtbl_order`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  ADD CONSTRAINT `fk_tbl_product_image_tbl_quotation1` FOREIGN KEY (`tbl_quotation_idtbl_quotation`) REFERENCES `tbl_quotation` (`idtbl_quotation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_product_image_tbl_user1` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  ADD CONSTRAINT `fk_tbl_quatation_tbl_inquiry1` FOREIGN KEY (`tbl_inquiry_idtbl_inquiry`) REFERENCES `tbl_inquiry` (`idtbl_inquiry`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quatation_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quotation_tbl_customer1` FOREIGN KEY (`tbl_customer_idtbl_customer`) REFERENCES `tbl_customer` (`idtbl_customer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quotation_tbl_reason1` FOREIGN KEY (`tbl_reason_idtbl_reason`) REFERENCES `tbl_reason` (`idtbl_reason`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_quotation_reject`
--
ALTER TABLE `tbl_quotation_reject`
  ADD CONSTRAINT `fk_tbl_quatation_reject_tbl_quatation1` FOREIGN KEY (`tbl_quotation_idtbl_quotation`) REFERENCES `tbl_quotation` (`idtbl_quotation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quatation_reject_tbl_reason1` FOREIGN KEY (`tbl_reason_idtbl_reason`) REFERENCES `tbl_reason` (`idtbl_reason`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_quatation_reject_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_reason`
--
ALTER TABLE `tbl_reason`
  ADD CONSTRAINT `fk_tbl_reason_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_salesrep`
--
ALTER TABLE `tbl_salesrep`
  ADD CONSTRAINT `fk_tbl_customer_tbl_user20` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD CONSTRAINT `fk_tbl_size_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD CONSTRAINT `fk_tbl_supplier_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_supplier_tbl_vender1` FOREIGN KEY (`tbl_vender_idtbl_vender`) REFERENCES `tbl_vender` (`idtbl_vender`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_tbl_user_tbl_user_type2` FOREIGN KEY (`tbl_user_type_idtbl_user_type`) REFERENCES `tbl_user_type` (`idtbl_user_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user_privilege`
--
ALTER TABLE `tbl_user_privilege`
  ADD CONSTRAINT `fk_tbl_user_privilege_tbl_menu_list2` FOREIGN KEY (`tbl_menu_list_idtbl_menu_list`) REFERENCES `tbl_menu_list` (`idtbl_menu_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_user_privilege_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_vender`
--
ALTER TABLE `tbl_vender`
  ADD CONSTRAINT `fk_tbl_vender_tbl_user2` FOREIGN KEY (`tbl_user_idtbl_user`) REFERENCES `tbl_user` (`idtbl_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
