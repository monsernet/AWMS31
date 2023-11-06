-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 08:21 PM
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
-- Database: `awmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE `application_settings` (
  `id` int(11) NOT NULL,
  `long_name` text NOT NULL,
  `short_name` text NOT NULL,
  `logo` text NOT NULL,
  `favicon` text NOT NULL,
  `use_captcha` varchar(10) NOT NULL,
  `secret_key` text DEFAULT NULL,
  `site_key` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_settings`
--

INSERT INTO `application_settings` (`id`, `long_name`, `short_name`, `logo`, `favicon`, `use_captcha`, `secret_key`, `site_key`) VALUES
(1, 'Advanced Warehouse Management System', 'AWMS - V3.1', '02191a1126c73c12.png', '609e24335f001328.ico', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `backup_id` int(10) UNSIGNED NOT NULL,
  `backup_name` varchar(255) NOT NULL,
  `backup_location` varchar(255) NOT NULL,
  `backup_type` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barcode_technologies`
--

CREATE TABLE `barcode_technologies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcode_technologies`
--

INSERT INTO `barcode_technologies` (`id`, `name`, `description`) VALUES
(1, '1D Barcodes (Linear)', '1D Barcodes (like UPC, EAN, ...)'),
(2, '2D Barcodes', '2D Barcodes (like QR, Data Matrix, ...)');

-- --------------------------------------------------------

--
-- Table structure for table `barcode_types`
--

CREATE TABLE `barcode_types` (
  `id` int(11) NOT NULL,
  `technologyId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcode_types`
--

INSERT INTO `barcode_types` (`id`, `technologyId`, `name`, `description`) VALUES
(1, 1, 'Code128 (All ASCII data)', 'Code128 (All ASCII data 0-127)'),
(2, 1, 'Code39 (Alpha-numeric data)', 'Code39 (Alpha-numeric data)'),
(3, 2, 'QR Code', 'QR Code'),
(4, 2, 'Data Matrix', 'Data Matrix');

-- --------------------------------------------------------

--
-- Table structure for table `barcoding_packs`
--

CREATE TABLE `barcoding_packs` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `barcode_technology` int(11) NOT NULL,
  `barcode_type` int(11) NOT NULL,
  `paper_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcoding_packs`
--

INSERT INTO `barcoding_packs` (`id`, `warehouse_id`, `barcode_technology`, `barcode_type`, `paper_size`) VALUES
(1, 1, 1, 2, 1),
(2, 4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barcoding_products`
--

CREATE TABLE `barcoding_products` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `barcode_technology` int(11) NOT NULL,
  `barcode_type` int(11) NOT NULL,
  `paper_size` int(11) NOT NULL,
  `paper_orientation` int(11) NOT NULL,
  `margin_top` float NOT NULL,
  `margin_bottom` float NOT NULL,
  `margin_left` float NOT NULL,
  `margin_right` float NOT NULL,
  `barcodes_row` int(11) NOT NULL,
  `barcodes_col` int(11) NOT NULL,
  `barcode_padding` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcoding_products`
--

INSERT INTO `barcoding_products` (`id`, `warehouse_id`, `barcode_technology`, `barcode_type`, `paper_size`, `paper_orientation`, `margin_top`, `margin_bottom`, `margin_left`, `margin_right`, `barcodes_row`, `barcodes_col`, `barcode_padding`) VALUES
(1, 1, 1, 2, 1, 1, 6, 6, 6, 6, 3, 12, 0),
(2, 4, 1, 2, 1, 1, 3, 3, 3, 3, 3, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barcoding_racks`
--

CREATE TABLE `barcoding_racks` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `barcode_technology` int(11) NOT NULL,
  `barcode_type` int(11) NOT NULL,
  `paper_size` int(11) NOT NULL,
  `shelf_barcoding` int(11) NOT NULL,
  `rack_barcoding` int(11) NOT NULL,
  `aisle_barcoding` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barcoding_racks`
--

INSERT INTO `barcoding_racks` (`id`, `warehouse_id`, `barcode_technology`, `barcode_type`, `paper_size`, `shelf_barcoding`, `rack_barcoding`, `aisle_barcoding`) VALUES
(1, 1, 1, 2, 2, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clientorders`
--

CREATE TABLE `clientorders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `limited_period` int(11) NOT NULL DEFAULT 0,
  `delivery_limit` date DEFAULT NULL,
  `agent_id` int(11) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0,
  `loaded` int(11) NOT NULL DEFAULT 0,
  `delivered` int(11) NOT NULL DEFAULT 0,
  `received` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientorders`
--

INSERT INTO `clientorders` (`order_id`, `order_code`, `datetime`, `client_id`, `warehouse_id`, `limited_period`, `delivery_limit`, `agent_id`, `approved`, `loaded`, `delivered`, `received`) VALUES
(1, 'OC185236-22', '2022-06-23', 1, 1, 0, '2022-06-24', 1, 1, 0, 0, 0),
(2, '1234567', '2022-11-01', 2, 1, 0, '2022-11-10', 1, 1, 0, 0, 0),
(3, 'OR1522', '2022-11-02', 1, 1, 1, '2022-11-23', 1, 1, 0, 0, 0),
(4, '234454545', '2022-11-09', 2, 1, 1, '2022-11-16', 1, 1, 0, 0, 0),
(5, '233433434', '2022-11-10', 1, 1, 1, '2022-11-17', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clientorder_details`
--

CREATE TABLE `clientorder_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `price_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `volume` float NOT NULL,
  `weight` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientorder_details`
--

INSERT INTO `clientorder_details` (`id`, `order_id`, `warehouse_id`, `price_id`, `product_id`, `qty`, `volume`, `weight`) VALUES
(1, 1, 1, NULL, 1, 15, 1.6875, 112.5),
(2, 1, 1, NULL, 5, 2, 0.3024, 29),
(3, 2, 1, NULL, 1, 40, 4.5, 312),
(4, 2, 1, NULL, 4, 40, 1.125, 400),
(5, 3, 1, NULL, 1, 45, 5.0625, 351),
(6, 3, 1, NULL, 4, 35, 0.984375, 350),
(7, 4, 1, NULL, 1, 15, 1.6875, 117),
(8, 4, 1, NULL, 4, 25, 0.703125, 250),
(9, 4, 1, NULL, 5, 45, 0.28125, 202.5),
(10, 5, 1, NULL, 1, 500, 56.25, 3900);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` bigint(20) NOT NULL,
  `client_code` varchar(50) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `business_title` varchar(200) DEFAULT NULL,
  `tax` float NOT NULL,
  `mobile` varchar(50) NOT NULL DEFAULT '0',
  `phone` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `shippingAddress` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `price_level` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_code`, `full_name`, `business_title`, `tax`, `mobile`, `phone`, `address`, `shippingAddress`, `city`, `country`, `email`, `price_level`, `status`) VALUES
(1, 'CUST0001', 'General Trading Company', 'General Trading Company', 12, '12563256842', '14523254789', '114 Yongue Street Toronto ON M4R 1A2', '114 Yongue Street Toronto ON M4R 1A2', 'Toronto', 'Canada', 'sales@gtc.com', 1, 1),
(2, 'CUST0002', 'Helen Sandu', 'Helen Sandu', 12, '1452369542', '1452369852', '123 Nepean Street Ottawa ON K2P 0C3', '123 Nepean Street Ottawa ON K2P 0C3', 'Ottawa', 'Canada', 'helen.sandu@mail.com', 1, 1),
(3, 'CUST0003', 'Customer 03', 'Business Title Customer 03', 12, '1236547852369', '123456789632', 'address of customer 03', 'address of customer 03', 'city03', 'country03', 'email@customer03.com', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companysettings`
--

CREATE TABLE `companysettings` (
  `id` int(11) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `business_title` varchar(100) NOT NULL,
  `companyAddress` varchar(200) NOT NULL,
  `shippingAddress` varchar(200) NOT NULL,
  `tax_number` varchar(100) NOT NULL,
  `register_number` varchar(100) NOT NULL,
  `companyPhone` varchar(20) NOT NULL,
  `companyEmail` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companysettings`
--

INSERT INTO `companysettings` (`id`, `companyName`, `business_title`, `companyAddress`, `shippingAddress`, `tax_number`, `register_number`, `companyPhone`, `companyEmail`, `country`, `city`) VALUES
(1, 'My Company', 'MyCompany', 'Bloc 12, str 18B, District 12A', 'Bloc 12, str 18B, District 12A', '1523148/MF', '1245263/15', '+123456789632', 'info@mycompany.com', 'Canada', 'Quebec');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `curr_symbol` varchar(20) NOT NULL,
  `curr_code` varchar(10) NOT NULL,
  `curr_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `curr_symbol`, `curr_code`, `curr_name`) VALUES
(1, '$', 'USD', 'US Dollar'),
(2, '€', 'Euro', 'Euro'),
(3, '$', 'CAD', 'Canadian Dollar');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `delivery_id` int(11) NOT NULL,
  `delivery_code` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_order` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `agent_id` int(10) NOT NULL,
  `picked` int(11) NOT NULL DEFAULT 0,
  `packed` int(11) NOT NULL DEFAULT 0,
  `delivered` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`delivery_id`, `delivery_code`, `datetime`, `client_id`, `client_order`, `warehouse_id`, `agent_id`, `picked`, `packed`, `delivered`) VALUES
(1, 'DN0001-22', '2022-06-24', 1, 1, 1, 1, 1, 1, 1),
(2, 'DLN-0002-22', '2022-11-10', 2, 2, 1, 1, 1, 1, 1),
(3, 'DLN-0003-22', '2022-11-12', 1, 3, 1, 1, 1, 1, 0),
(4, 'DLN-0004-22', '2022-11-12', 2, 4, 1, 1, 1, 0, 0),
(5, 'DLN-0005-22', '2022-11-12', 1, 5, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_qty` float NOT NULL,
  `qty` float NOT NULL,
  `volume` float NOT NULL,
  `weight` float NOT NULL,
  `loaded` int(11) NOT NULL DEFAULT 0,
  `packed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`id`, `delivery_id`, `warehouse_id`, `product_id`, `order_qty`, `qty`, `volume`, `weight`, `loaded`, `packed`) VALUES
(1, 1, 1, 1, 15, 15, 1.6875, 112.5, 1, 1),
(2, 1, 1, 5, 2, 2, 0.3024, 29, 1, 1),
(3, 2, 1, 1, 40, 40, 4.5, 312, 1, 1),
(4, 2, 1, 4, 40, 40, 1.125, 400, 1, 1),
(5, 3, 1, 1, 45, 45, 5.0625, 351, 1, 1),
(6, 3, 1, 4, 35, 35, 0.984375, 350, 1, 1),
(7, 4, 1, 1, 15, 15, 1.6875, 117, 1, 0),
(8, 4, 1, 4, 25, 25, 0.703125, 250, 1, 0),
(9, 4, 1, 5, 45, 45, 0.28125, 202.5, 1, 0),
(10, 5, 1, 1, 500, 500, 56.25, 3900, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dimensions`
--

CREATE TABLE `dimensions` (
  `ID` int(20) NOT NULL,
  `product_id` int(20) DEFAULT NULL,
  `length_pr` float NOT NULL,
  `width_pr` float DEFAULT NULL,
  `height_pr` float DEFAULT NULL,
  `weight_pr` float NOT NULL,
  `units_pr` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dimensions`
--

INSERT INTO `dimensions` (`ID`, `product_id`, `length_pr`, `width_pr`, `height_pr`, `weight_pr`, `units_pr`) VALUES
(1, 1, 50, 50, 45, 7.8, 12),
(2, 2, 60, 60, 50, 9, 12),
(3, 3, 50, 50, 45, 7.5, 12),
(4, 4, 25, 45, 25, 10, 6),
(5, 5, 25, 10, 25, 4.5, 12),
(6, 6, 43, 40, 40, 11.5, 6),
(7, 7, 25, 25, 25, 11.4, 3),
(8, 8, 15, 15, 15, 4.5, 12),
(9, 9, 10, 15, 10, 3.5, 12),
(10, 10, 55, 55, 15, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `email_method` varchar(20) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `mail_server` varchar(100) NOT NULL DEFAULT 'NA',
  `mail_port` int(11) NOT NULL DEFAULT 0,
  `mail_password` varchar(255) NOT NULL DEFAULT 'NA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_settings`
--

INSERT INTO `email_settings` (`id`, `warehouse_id`, `email_method`, `sender_name`, `sender_email`, `mail_server`, `mail_port`, `mail_password`) VALUES
(1, 1, 'phpmail', 'My Warehouse Admin', 'info@mywarehouse.com', 'NA', 0, '123456'),
(2, 4, 'phpmail', 'Admin', 'info@mail.com', 'NA', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `eoq_settings`
--

CREATE TABLE `eoq_settings` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `holdingCost` float NOT NULL,
  `orderingCost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoq_settings`
--

INSERT INTO `eoq_settings` (`id`, `warehouse_id`, `holdingCost`, `orderingCost`) VALUES
(1, 1, 27, 32),
(2, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE `functions` (
  `function_id` bigint(20) NOT NULL,
  `function_code` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `function_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` bigint(20) NOT NULL,
  `dateinventory` date NOT NULL,
  `inn` bigint(20) DEFAULT NULL,
  `out_inv` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `transfer_id` bigint(20) NOT NULL DEFAULT 0,
  `delivery_id` bigint(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `lot` varchar(50) NOT NULL,
  `return_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `dateinventory`, `inn`, `out_inv`, `product_id`, `warehouse_id`, `transfer_id`, `delivery_id`, `order_id`, `lot`, `return_id`, `user_id`) VALUES
(1, '2022-05-26', 250, 0, 1, 1, 0, 0, 0, 'inv123-22', 0, 0),
(2, '2022-05-26', 500, 0, 2, 1, 0, 0, 0, 'inv14523-22', 0, 0),
(3, '2022-05-26', 100, 0, 5, 1, 0, 0, 0, '125632-22', 0, 0),
(4, '2022-05-27', 0, 50, 1, 1, 1, 0, 0, 'Transfer 1', 0, 0),
(5, '2022-05-27', 0, 120, 1, 1, 2, 0, 0, 'Transfer 2', 0, 0),
(6, '2022-05-27', 0, 100, 2, 1, 2, 0, 0, 'Transfer 2', 0, 0),
(7, '2022-05-27', 0, 75, 1, 1, 3, 0, 0, 'Transfer 3', 0, 0),
(8, '2022-05-27', 0, 100, 2, 1, 3, 0, 0, 'Transfer 3', 0, 0),
(9, '2022-05-27', 0, 100, 5, 1, 3, 0, 0, 'Transfer 3', 0, 0),
(10, '2022-05-28', 50, 0, 1, 2, 1, 0, 0, 'Transfer 1', 0, 1),
(11, '2022-06-03', 120, 0, 1, 2, 2, 0, 0, 'Transfer 2', 0, 1),
(12, '2022-06-03', 100, 0, 2, 2, 2, 0, 0, 'Transfer 2', 0, 1),
(13, '2022-06-17', 50, 0, 1, 1, 0, 0, 1, 'Order #1', 0, 1),
(14, '2022-06-17', 50, 0, 2, 1, 0, 0, 1, 'Order #1', 0, 1),
(15, '2022-06-17', 50, 0, 5, 1, 0, 0, 1, 'Order #1', 0, 1),
(16, '2022-06-30', 0, 15, 1, 1, 0, 1, 0, 'Delivery #1', 0, 0),
(17, '2022-07-01', 0, 2, 5, 1, 0, 1, 0, 'Delivery #1', 0, 0),
(18, '2022-07-13', 250, 0, 1, 1, 0, 0, 0, 'inv13122', 0, 0),
(19, '2022-08-17', 0, 100, 2, 1, 4, 0, 0, 'Transfer 4', 0, 0),
(20, '2022-11-06', 520, 0, 1, 1, 0, 0, 0, 'DN12345-33', 0, 0),
(21, '2022-11-06', 400, 0, 1, 1, 0, 0, 0, 'DN12345-33', 0, 0),
(22, '2022-11-06', 2120, 0, 4, 1, 0, 0, 0, 'DN16574-22', 0, 0),
(23, '2022-11-06', 0, 122, 1, 1, 6, 0, 0, 'Transfer 6', 0, 0),
(24, '2022-11-06', 0, 85, 2, 1, 6, 0, 0, 'Transfer 6', 0, 0),
(25, '2022-11-10', 350, 0, 1, 1, 0, 0, 2, 'Order #2', 0, 1),
(26, '2022-11-10', 450, 0, 5, 1, 0, 0, 2, 'Order #2', 0, 1),
(27, '2022-11-10', 250, 0, 1, 1, 0, 0, 0, 'inv1342-22', 0, 0),
(28, '2022-11-10', 450, 0, 4, 1, 0, 0, 3, 'Order #3', 0, 1),
(29, '2022-11-10', 0, 40, 1, 1, 0, 2, 0, 'Delivery #2', 0, 0),
(30, '2022-11-10', 0, 40, 4, 1, 0, 2, 0, 'Delivery #2', 0, 0),
(31, '2022-11-12', 0, 45, 1, 1, 0, 3, 0, 'Delivery #3', 0, 0),
(32, '2022-11-12', 0, 35, 4, 1, 0, 3, 0, 'Delivery #3', 0, 0),
(33, '2022-11-12', 0, 15, 1, 1, 0, 4, 0, 'Delivery #4', 0, 0),
(34, '2022-11-12', 0, 25, 4, 1, 0, 4, 0, 'Delivery #4', 0, 0),
(35, '2022-11-12', 0, 45, 5, 1, 0, 4, 0, 'Delivery #4', 0, 0),
(36, '2022-11-12', 0, 500, 1, 1, 0, 5, 0, 'Delivery #5', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_adjustments`
--

CREATE TABLE `inventory_adjustments` (
  `id` int(11) NOT NULL,
  `warehouseId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  `startingStock` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_settings`
--

CREATE TABLE `inventory_settings` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `inventory_technique` int(11) NOT NULL,
  `pickpack_method` int(11) NOT NULL,
  `aisle_label_format` int(11) NOT NULL,
  `bay_label_format` int(11) NOT NULL,
  `shelf_label_format` int(11) NOT NULL,
  `bin_label_format` int(11) NOT NULL,
  `holding_cost` float NOT NULL DEFAULT 0,
  `ordering_cost` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_settings`
--

INSERT INTO `inventory_settings` (`id`, `warehouse_id`, `inventory_technique`, `pickpack_method`, `aisle_label_format`, `bay_label_format`, `shelf_label_format`, `bin_label_format`, `holding_cost`, `ordering_cost`) VALUES
(1, 1, 3, 1, 2, 1, 1, 1, 0, 0),
(2, 4, 3, 1, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_systems`
--

CREATE TABLE `inventory_systems` (
  `id` int(11) NOT NULL,
  `shortName` varchar(50) NOT NULL,
  `longName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_systems`
--

INSERT INTO `inventory_systems` (`id`, `shortName`, `longName`) VALUES
(1, 'FIFO', 'First In, First Out'),
(2, 'LIFO', 'Last In, First Out');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_techniques`
--

CREATE TABLE `inventory_techniques` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_techniques`
--

INSERT INTO `inventory_techniques` (`id`, `name`, `status`) VALUES
(1, 'ABC Analysis', 0),
(2, 'Just-In-Time (JIT)', 0),
(3, 'Economic Order Quantity (EOQ)', 1),
(4, 'Material Requirements Planning (MRP)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tmp`
--

CREATE TABLE `inventory_tmp` (
  `inventory_id` bigint(20) NOT NULL,
  `dateinventory` date NOT NULL,
  `inn` bigint(20) DEFAULT NULL,
  `out_inv` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `transfer_id` bigint(20) NOT NULL DEFAULT 0,
  `delivery_id` bigint(20) NOT NULL,
  `order_id` int(11) NOT NULL,
  `lot` varchar(50) NOT NULL,
  `return_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_tmp`
--

INSERT INTO `inventory_tmp` (`inventory_id`, `dateinventory`, `inn`, `out_inv`, `product_id`, `warehouse_id`, `transfer_id`, `delivery_id`, `order_id`, `lot`, `return_id`, `user_id`) VALUES
(8, '2022-08-19', 0, 100, 1, 1, 5, 0, 0, 'TR-0005-22', 0, 1),
(9, '2022-08-19', 0, 50, 2, 1, 5, 0, 0, 'TR-0005-22', 0, 1),
(12, '2022-11-10', 0, 200, 1, 1, 8, 0, 0, 'TR-0008-22', 0, 1),
(13, '2022-11-10', 0, 200, 4, 1, 8, 0, 0, 'TR-0008-22', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `iso_code` varchar(10) NOT NULL,
  `lang_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`id`, `iso_code`, `lang_name`) VALUES
(1, 'en', 'English'),
(2, 'fr', 'Français'),
(3, 'ar', 'العربية');

-- --------------------------------------------------------

--
-- Table structure for table `loadings`
--

CREATE TABLE `loadings` (
  `id` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `reference_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `transport_date` date NOT NULL,
  `vehicle_registration` varchar(50) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `driver_id_number` varchar(50) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loadings`
--

INSERT INTO `loadings` (`id`, `reference`, `reference_id`, `warehouse_id`, `transport_date`, `vehicle_registration`, `driver_name`, `driver_id_number`, `agent_id`) VALUES
(1, 'Delivery', 1, 1, '2022-07-08', '123/18563256', 'John Mecklen', '12345865932', 1),
(2, 'Delivery', 2, 1, '2022-11-10', '9345 RN 16', 'John', '123456789034', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loading_approve`
--

CREATE TABLE `loading_approve` (
  `loading_approve_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `date_approve` datetime NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `qty_appr` float NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_sessions`
--

CREATE TABLE `login_sessions` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `session_timeout` int(11) NOT NULL,
  `login_attempts` int(11) NOT NULL,
  `wrong_attempts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_sessions`
--

INSERT INTO `login_sessions` (`id`, `warehouse_id`, `session_timeout`, `login_attempts`, `wrong_attempts`) VALUES
(1, 1, 180, 5, 3),
(2, 4, 180, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `measuring_units`
--

CREATE TABLE `measuring_units` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `measuring_units`
--

INSERT INTO `measuring_units` (`id`, `code`, `designation`) VALUES
(1, 'PC', 'Piece'),
(2, 'UN', 'Unit'),
(3, 'M', 'Meter'),
(4, 'CM', 'Centimeter'),
(5, 'KG', 'Kilogram');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` bigint(20) NOT NULL,
  `message_datetime` datetime DEFAULT NULL,
  `message_detail` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_meta`
--

CREATE TABLE `message_meta` (
  `msg_meta_id` bigint(20) NOT NULL,
  `message_id` bigint(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `from_id` bigint(20) DEFAULT NULL,
  `to_id` bigint(20) DEFAULT NULL,
  `subject_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_id` bigint(20) NOT NULL,
  `note_date` date DEFAULT NULL,
  `note_title` varchar(200) DEFAULT NULL,
  `note_detail` varchar(600) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `readstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupancy`
--

CREATE TABLE `occupancy` (
  `id_occ` int(20) NOT NULL,
  `date_occ` date NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL DEFAULT 0,
  `delivery_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `return_id` int(11) NOT NULL DEFAULT 0,
  `inn_occ` float NOT NULL DEFAULT 0,
  `out_occ` float NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `ref_occ` varchar(100) NOT NULL DEFAULT 'NA',
  `row_occ` int(11) NOT NULL,
  `line_occ` int(11) NOT NULL,
  `shelf_occ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `occupancy`
--

INSERT INTO `occupancy` (`id_occ`, `date_occ`, `inventory_id`, `transfer_id`, `delivery_id`, `order_id`, `return_id`, `inn_occ`, `out_occ`, `product_id`, `warehouse_id`, `ref_occ`, `row_occ`, `line_occ`, `shelf_occ`) VALUES
(1, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 1, 1),
(2, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 1, 2),
(3, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 1, 3),
(4, '0000-00-00', 1, 0, 0, 0, 0, 6, 0, 1, 1, 'inv123-22', 1, 3, 1),
(5, '0000-00-00', 1, 0, 0, 0, 0, 4.13, 0, 1, 1, 'inv123-22', 1, 3, 2),
(6, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 1, 1),
(7, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 1, 2),
(8, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 1, 3),
(9, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 3, 1, 1),
(10, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 3, 9, 2),
(11, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 3, 9, 3),
(12, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 4, 9, 1),
(13, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 4, 1, 2),
(14, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 4, 1, 3),
(15, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 5, 1, 1),
(16, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 8, 9, 1),
(17, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 8, 9, 2),
(18, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 8, 9, 3),
(19, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 16, 1),
(20, '0000-00-00', 2, 0, 0, 0, 0, 6, 0, 2, 1, 'inv14523-22', 2, 16, 2),
(21, '0000-00-00', 3, 0, 0, 0, 0, 6, 0, 5, 1, '125632-22', 7, 15, 1),
(22, '0000-00-00', 3, 0, 0, 0, 0, 6, 0, 5, 1, '125632-22', 7, 15, 2),
(23, '0000-00-00', 3, 0, 0, 0, 0, 3.12, 0, 5, 1, '125632-22', 7, 15, 3),
(24, '2022-05-27', 0, 1, 0, 0, 0, 0, 5.63, 1, 1, 'transfer', 1, 1, 1),
(25, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 1, 1, 'transfer', 1, 1, 2),
(26, '2022-05-27', 0, 2, 0, 0, 0, 0, 0.37, 1, 1, 'transfer', 1, 1, 1),
(27, '2022-05-27', 0, 2, 0, 0, 0, 0, 1.13, 1, 1, 'transfer', 1, 3, 2),
(28, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 1, 1, 'transfer', 1, 1, 3),
(29, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 1, 2),
(30, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 1, 1),
(31, '2022-05-27', 0, 2, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 1, 3),
(32, '2022-05-27', 0, 3, 0, 0, 0, 0, 2.44, 1, 1, 'transfer', 1, 3, 2),
(33, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 1, 1, 'transfer', 1, 3, 1),
(34, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 2, 1, 'transfer', 3, 1, 1),
(35, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 16, 1),
(36, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 2, 1, 'transfer', 2, 16, 2),
(37, '2022-05-27', 0, 3, 0, 0, 0, 0, 3.11, 5, 1, 'transfer', 7, 15, 3),
(38, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 5, 1, 'transfer', 7, 15, 2),
(39, '2022-05-27', 0, 3, 0, 0, 0, 0, 6, 5, 1, 'transfer', 7, 15, 1),
(40, '2022-06-03', 0, 1, 0, 0, 0, 5.63, 0, 1, 2, 'reception', 1, 1, 1),
(41, '2022-06-17', 13, 0, 0, 1, 0, 5.63, 0, 1, 1, 'receiving', 11, 24, 2),
(42, '2022-06-17', 14, 0, 0, 1, 0, 6, 0, 2, 1, 'receiving', 5, 1, 2),
(43, '2022-06-17', 14, 0, 0, 1, 0, 3, 0, 2, 1, 'receiving', 5, 1, 3),
(44, '2022-06-17', 15, 0, 0, 1, 0, 6, 0, 5, 1, 'receiving', 9, 16, 2),
(45, '2022-06-17', 15, 0, 0, 1, 0, 1.56, 0, 5, 1, 'receiving', 9, 16, 3),
(46, '2022-06-30', 16, 0, 1, 0, 0, 0, 1.69, 1, 1, 'transfer', 11, 24, 2),
(47, '2022-07-01', 17, 0, 1, 0, 0, 0, 0.3, 5, 1, 'transfer', 9, 16, 2),
(48, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 18, 1),
(49, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 18, 2),
(50, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 18, 3),
(51, '0000-00-00', 18, 0, 0, 0, 0, 6, 0, 1, 1, 'inv13122', 12, 19, 1),
(52, '0000-00-00', 18, 0, 0, 0, 0, 4.13, 0, 1, 1, 'inv13122', 12, 19, 2),
(53, '2022-08-17', 0, 4, 0, 0, 0, 0, 6, 2, 1, 'transfer', 3, 9, 3),
(54, '2022-08-17', 0, 4, 0, 0, 0, 0, 6, 2, 1, 'transfer', 4, 1, 2),
(55, '2022-08-17', 0, 4, 0, 0, 0, 0, 6, 2, 1, 'transfer', 3, 9, 2),
(56, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 3, 10, 2),
(57, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 11, 16, 2),
(58, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 17, 13, 2),
(59, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 12, 10, 2),
(60, '0000-00-00', 21, 0, 0, 0, 0, 8, 0, 1, 1, 'DN12345-33', 15, 22, 1),
(61, '0000-00-00', 21, 0, 0, 0, 0, 5, 0, 1, 1, 'DN12345-33', 10, 15, 2),
(62, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 15, 22, 2),
(63, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 16, 21, 1),
(64, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 16, 22, 2),
(65, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 3, 3, 2),
(66, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 4, 4, 2),
(67, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 4, 3, 2),
(68, '0000-00-00', 22, 0, 0, 0, 0, 8, 0, 4, 1, 'DN16574-22', 4, 4, 1),
(69, '0000-00-00', 22, 0, 0, 0, 0, 3.63, 0, 4, 1, 'DN16574-22', 10, 19, 2),
(70, '2022-11-06', 0, 6, 0, 0, 0, 0, 0.56, 1, 1, 'transfer', 1, 3, 2),
(71, '2022-11-06', 0, 6, 0, 0, 0, 0, 5, 1, 1, 'transfer', 10, 15, 2),
(72, '2022-11-06', 0, 6, 0, 0, 0, 0, 8, 1, 1, 'transfer', 3, 10, 2),
(73, '2022-11-06', 0, 6, 0, 0, 0, 0, 0.17, 1, 1, 'transfer', 11, 16, 2),
(74, '2022-11-06', 0, 6, 0, 0, 0, 0, 6, 2, 1, 'transfer', 4, 1, 3),
(75, '2022-11-06', 0, 6, 0, 0, 0, 0, 6, 2, 1, 'transfer', 4, 9, 1),
(76, '2022-11-06', 0, 6, 0, 0, 0, 0, 3.3, 2, 1, 'transfer', 5, 1, 1),
(77, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 2, 3, 2),
(78, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 2, 3, 3),
(79, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 2, 3, 2),
(80, '2022-11-10', 25, 0, 0, 2, 0, 8, 0, 1, 1, 'receiving', 15, 19, 2),
(81, '2022-11-10', 25, 0, 0, 2, 0, 7.38, 0, 1, 1, 'receiving', 19, 25, 3),
(82, '2022-11-10', 26, 0, 0, 2, 0, 2.81, 0, 5, 1, 'receiving', 12, 13, 2),
(83, '0000-00-00', 27, 0, 0, 0, 0, 8, 0, 1, 1, 'inv1342-22', 1, 1, 1),
(84, '0000-00-00', 27, 0, 0, 0, 0, 8, 0, 1, 1, 'inv1342-22', 1, 3, 1),
(85, '0000-00-00', 27, 0, 0, 0, 0, 8, 0, 1, 1, 'inv1342-22', 1, 3, 1),
(86, '0000-00-00', 27, 0, 0, 0, 0, 4.13, 0, 1, 1, 'inv1342-22', 1, 1, 1),
(87, '2022-11-10', 28, 0, 0, 3, 0, 8, 0, 4, 1, 'receiving', 15, 25, 3),
(88, '2022-11-10', 28, 0, 0, 3, 0, 4.66, 0, 4, 1, 'receiving', 16, 12, 2),
(89, '2022-11-10', 29, 0, 2, 0, 0, 0, 4.5, 1, 1, 'transfer', 1, 1, 1),
(90, '2022-11-10', 30, 0, 2, 0, 0, 0, 1.13, 4, 1, 'transfer', 3, 3, 2),
(91, '2022-11-12', 31, 0, 3, 0, 0, 0, 2, 1, 1, 'transfer', 1, 1, 1),
(92, '2022-11-12', 31, 0, 3, 0, 0, 0, 3.05, 1, 1, 'transfer', 1, 3, 1),
(93, '2022-11-12', 32, 0, 3, 0, 0, 0, 0.98, 4, 1, 'transfer', 10, 19, 2),
(94, '2022-11-12', 33, 0, 4, 0, 0, 0, 1.69, 1, 1, 'transfer', 1, 1, 1),
(95, '2022-11-12', 34, 0, 4, 0, 0, 0, 0.7, 4, 1, 'transfer', 10, 19, 2),
(96, '2022-11-12', 35, 0, 4, 0, 0, 0, 0.28, 5, 1, 'transfer', 9, 16, 3),
(97, '2022-11-12', 36, 0, 5, 0, 0, 0, 3.94, 1, 1, 'transfer', 1, 1, 1),
(98, '2022-11-12', 36, 0, 5, 0, 0, 0, 16, 1, 1, 'transfer', 2, 3, 2),
(99, '2022-11-12', 36, 0, 5, 0, 0, 0, 12.95, 1, 1, 'transfer', 1, 3, 1),
(100, '2022-11-12', 36, 0, 5, 0, 0, 0, 8, 1, 1, 'transfer', 2, 3, 3),
(101, '2022-11-12', 36, 0, 5, 0, 0, 0, 7.36, 1, 1, 'transfer', 11, 16, 2),
(102, '2022-11-12', 36, 0, 5, 0, 0, 0, 8, 1, 1, 'transfer', 12, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `occupancy_tmp`
--

CREATE TABLE `occupancy_tmp` (
  `id_occ` int(20) NOT NULL,
  `date_occ` date NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL DEFAULT 0,
  `delivery_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `return_id` int(11) NOT NULL DEFAULT 0,
  `inn_occ` float NOT NULL DEFAULT 0,
  `out_occ` float NOT NULL DEFAULT 0,
  `product_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `ref_occ` varchar(100) NOT NULL DEFAULT 'NA',
  `row_occ` int(11) NOT NULL,
  `line_occ` int(11) NOT NULL,
  `shelf_occ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` bigint(20) NOT NULL,
  `option_name` varchar(500) NOT NULL,
  `option_value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`) VALUES
(6, 'site_url', ' www.mycompany.com'),
(7, 'site_name', ' My Company'),
(8, 'email_from', 'noreply@mywarehouse.com'),
(9, 'email_to', 'contact@mywarehouse.com'),
(10, 'installation', 'Yes'),
(11, 'version', '1.3'),
(12, 'language', 'english'),
(13, 'redirect_on_logout', 'index.php'),
(14, 'register_user_level', 'subscriber'),
(15, 'session_timeout', '180'),
(16, 'maximum_login_attempts', '5'),
(17, 'wrong_attempts_time', '3');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `agent_id` bigint(20) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0,
  `delivery_limit` date DEFAULT NULL,
  `received` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_code`, `datetime`, `supplier_id`, `warehouse_id`, `agent_id`, `approved`, `delivery_limit`, `received`) VALUES
(1, 'LPO-0001-22', '2022-06-10 00:00:00', 1, 1, 1, 1, '2022-06-25', 0),
(2, 'LPO-0002-22', '2022-11-06 00:00:00', 1, 1, 1, 1, '2022-11-01', 0),
(3, 'LPO-0003-22', '2022-11-06 00:00:00', 2, 1, 1, 1, '2022-10-30', 0),
(4, 'LPO-0004-22', '2022-11-06 00:00:00', 1, 1, 1, 0, NULL, 0),
(5, 'LPO-0005-22', '2022-11-10 00:00:00', 2, 1, 1, 1, '2022-11-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `price_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `warehouse_id`, `price_id`, `product_id`, `qty`) VALUES
(1, 1, 1, NULL, 1, 50),
(2, 1, 1, NULL, 2, 50),
(3, 1, 1, NULL, 5, 50),
(4, 2, 1, NULL, 1, 350),
(5, 2, 1, NULL, 5, 450),
(6, 3, 1, NULL, 4, 450),
(7, 4, 1, NULL, 5, 100),
(8, 5, 1, NULL, 6, 400),
(9, 5, 1, NULL, 4, 500);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_code` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `shipping_address` varchar(150) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_code`, `datetime`, `warehouse_id`, `client_id`, `shipping_address`, `agent_id`) VALUES
(1, 'PCK202207220002', '2022-07-22', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(2, 'PCK2207260002', '2022-07-26', 1, 2, '123 Nepean Street Ottawa ON K2P 0C3', 1),
(3, 'PCK2207260002', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(4, 'PCK2207260002', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(5, 'PCK2207261128330005', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(6, 'PCK2207261129370006', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(7, 'PCK2207261132580007', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(8, 'PCK2207261141560008', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(9, 'PCK2207261147080009', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(10, 'PCK2207261152340010', '2022-07-26', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(11, 'PCK2207261156430011', '2022-07-26', 1, 2, '123 Nepean Street Ottawa ON K2P 0C3', 1),
(12, 'PCK2207271206170012', '2022-07-27', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(13, 'PCK2207271215080013', '2022-07-27', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(14, 'PCK2207271224200014', '2022-07-27', 1, 3, 'address of customer 03', 1),
(15, 'PCK2208171006510015', '2022-08-17', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(16, 'PCK2208181125280016', '2022-08-18', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(17, 'PCK2208191111030017', '2022-08-19', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(18, 'PCK2210220601050018', '2022-10-22', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1),
(19, 'PCK2211170700230019', '2022-11-17', 1, 1, '114 Yongue Street Toronto ON M4R 1A2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `volume` float NOT NULL,
  `weight` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `package_id`, `warehouse_id`, `product_id`, `qty`, `volume`, `weight`) VALUES
(1, 1, 1, 1, 100, 11.25, 750),
(2, 1, 1, 2, 100, 18, 900),
(3, 2, 1, 1, 45, 5.0625, 337.5),
(4, 2, 1, 2, 25, 4.5, 225),
(5, 3, 1, 1, 50, 5.625, 375),
(6, 3, 1, 2, 45, 8.1, 405),
(7, 4, 1, 1, 25, 2.8125, 187.5),
(8, 4, 1, 2, 45, 8.1, 405),
(9, 5, 1, 1, 25, 2.8125, 187.5),
(10, 5, 1, 2, 72, 12.96, 648),
(11, 6, 1, 1, 125, 14.0625, 937.5),
(12, 6, 1, 2, 12, 2.16, 108),
(13, 7, 1, 1, 50, 5.625, 375),
(14, 7, 1, 2, 65, 11.7, 585),
(15, 8, 1, 1, 50, 5.625, 375),
(16, 8, 1, 2, 50, 9, 450),
(17, 9, 1, 1, 50, 5.625, 375),
(18, 9, 1, 2, 50, 9, 450),
(19, 9, 1, 3, 50, 5.625, 375),
(20, 10, 1, 1, 50, 5.625, 375),
(21, 10, 1, 2, 50, 9, 450),
(22, 10, 1, 3, 60, 6.75, 450),
(23, 11, 1, 1, 120, 13.5, 900),
(24, 11, 1, 2, 50, 9, 450),
(25, 12, 1, 1, 72, 8.1, 540),
(26, 12, 1, 2, 72, 12.96, 648),
(27, 13, 1, 1, 75, 8.4375, 562.5),
(28, 13, 1, 2, 75, 13.5, 675),
(29, 14, 1, 1, 75, 8.4375, 562.5),
(30, 14, 1, 2, 75, 13.5, 675),
(31, 15, 1, 1, 50, 5.625, 375),
(32, 15, 1, 2, 50, 9, 450),
(33, 16, 1, 1, 50, 5.625, 375),
(34, 16, 1, 2, 50, 9, 450),
(35, 17, 1, 1, 50, 5.625, 375),
(36, 18, 1, 1, 30, 3.375, 225),
(37, 18, 1, 2, 25, 4.5, 225),
(38, 18, 1, 3, 50, 5.625, 375),
(39, 19, 1, 2, 45, 8.1, 405),
(40, 19, 1, 3, 125, 14.0625, 937.5),
(41, 19, 1, 4, 70, 1.96875, 700);

-- --------------------------------------------------------

--
-- Table structure for table `physical_inventories`
--

CREATE TABLE `physical_inventories` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `physical_inventories`
--

INSERT INTO `physical_inventories` (`id`, `warehouse_id`, `designation`, `creation_date`) VALUES
(1, 1, 'inv-14-7-2022', '2022-07-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `phys_inv_details`
--

CREATE TABLE `phys_inv_details` (
  `id` int(11) NOT NULL,
  `invId` int(11) NOT NULL,
  `warehouseId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `stock` float NOT NULL,
  `stock_date` datetime NOT NULL DEFAULT current_timestamp(),
  `invCount` float NOT NULL,
  `invDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phys_inv_details`
--

INSERT INTO `phys_inv_details` (`id`, `invId`, `warehouseId`, `productId`, `stock`, `stock_date`, `invCount`, `invDate`) VALUES
(1, 1, 1, 1, 290, '2022-07-14 00:00:00', 293, '2022-07-14'),
(2, 1, 1, 2, 250, '2022-07-14 00:00:00', 250, '2022-07-14'),
(3, 1, 1, 4, 0, '2022-07-14 00:00:00', 0, '2022-07-14'),
(4, 1, 1, 11, 0, '2022-07-14 00:00:00', 0, '2022-07-14'),
(5, 1, 1, 5, 48, '2022-07-14 00:00:00', 48, '2022-07-14'),
(6, 1, 1, 6, 0, '2022-07-14 00:00:00', 0, '2022-07-14'),
(7, 1, 1, 7, 0, '2022-07-14 00:00:00', 0, '2022-07-14'),
(8, 1, 1, 8, 0, '2022-07-14 00:00:00', 0, '2022-07-14'),
(9, 1, 1, 9, 0, '2022-07-14 00:00:00', 0, '2022-07-14'),
(10, 1, 1, 10, 0, '2022-07-14 00:00:00', 0, '2022-07-14');

-- --------------------------------------------------------

--
-- Table structure for table `picking_methods`
--

CREATE TABLE `picking_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picking_methods`
--

INSERT INTO `picking_methods` (`id`, `name`, `status`) VALUES
(1, 'Piece Picking', 1),
(2, 'Batch Picking', 0),
(3, 'Zone Picking', 0),
(4, 'Wave Picking', 0);

-- --------------------------------------------------------

--
-- Table structure for table `picking_systems`
--

CREATE TABLE `picking_systems` (
  `id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picking_systems`
--

INSERT INTO `picking_systems` (`id`, `designation`, `description`) VALUES
(1, 'Single Order Picking', 'Pickers move through the warehouse and retrieve SKUs one by one to fulfill one order at a time.'),
(2, 'Batch Picking', 'Batch picking optimizes picking activities by retrieving SKUs in bulk to fulfill multiple orders at a time.');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `id` int(11) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `lpo_id` int(11) NOT NULL,
  `quotation` varchar(50) NOT NULL,
  `datetime` date NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `agent_id` bigint(20) NOT NULL,
  `delivery_limit` date DEFAULT NULL,
  `received` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`id`, `po_code`, `lpo_id`, `quotation`, `datetime`, `supplier_id`, `warehouse_id`, `agent_id`, `delivery_limit`, `received`) VALUES
(1, 'PO-0001-22', 1, 'QT123-22', '2022-06-11', 1, 1, 1, '2022-06-25', 1),
(2, 'PO-0002-22', 2, 'quote1234-22', '2022-11-06', 1, 1, 1, '2022-11-01', 1),
(3, 'PO-0003-22', 3, 'qwqwqw', '2022-11-06', 2, 1, 1, '2022-10-30', 1),
(4, 'PO-0004-22', 5, '', '2022-11-10', 2, 1, 1, '2022-11-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `po_details`
--

CREATE TABLE `po_details` (
  `id` bigint(20) NOT NULL,
  `po_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `qty_appr` bigint(20) NOT NULL,
  `agent_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po_details`
--

INSERT INTO `po_details` (`id`, `po_id`, `warehouse_id`, `product_id`, `qty`, `qty_appr`, `agent_id`) VALUES
(1, 1, 1, 1, 50, 50, 1),
(2, 1, 1, 2, 50, 50, 1),
(3, 1, 1, 5, 50, 50, 1),
(4, 2, 1, 1, 350, 350, 1),
(5, 2, 1, 5, 450, 450, 1),
(6, 3, 1, 4, 450, 450, 1),
(7, 4, 1, 6, 400, 400, 1),
(8, 4, 1, 4, 500, 500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `price_id` bigint(20) NOT NULL,
  `cost` float DEFAULT NULL,
  `selling_price` float DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`price_id`, `cost`, `selling_price`, `tax`, `warehouse_id`, `product_id`, `type`) VALUES
(1, 45, 73.5, NULL, 1, 1, 0),
(2, 57, 84, NULL, 1, 2, 0),
(3, 45, 73.5, NULL, 2, 3, 0),
(4, 25, 47, NULL, 1, 4, 0),
(5, 20, 37, NULL, 1, 5, 0),
(6, 27, 48, NULL, 1, 6, 0),
(7, 37, 58, NULL, 1, 7, 0),
(8, 18, 45, NULL, 1, 8, 0),
(9, 13, 32, NULL, 1, 9, 0),
(10, 45, 75, NULL, 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `price_levels`
--

CREATE TABLE `price_levels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `discount_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `price_levels`
--

INSERT INTO `price_levels` (`id`, `name`, `discount_rate`) VALUES
(1, 'Default', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `product_barcode` varchar(50) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_picture` text DEFAULT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `product_unit` int(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `tax_id` bigint(20) DEFAULT NULL,
  `min_stock` float NOT NULL,
  `sec_stock` float NOT NULL,
  `max_stock` float NOT NULL DEFAULT 0,
  `alert_units` varchar(100) DEFAULT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_barcode`, `product_name`, `product_picture`, `supplier_id`, `product_unit`, `category_id`, `tax_id`, `min_stock`, `sec_stock`, `max_stock`, `alert_units`, `warehouse_id`, `status`) VALUES
(1, '123456789001', 'Electric Heater 600 W', 'ed57c3dc3a47bb20.jpg', 1, 1, 1, 12, 100, 400, 0, '500', 1, 1),
(2, '123456789002', 'Electric Heater 1200 W', 'eqIZoKoMfRTPz8Xj.jpg', 1, 1, 1, 12, 100, 400, 0, '500', 1, 0),
(3, '88H-0000UB-0TV', 'Halogen Heater 1800 W', 'mJsEYVRjzLF93aeQ.jpg', 1, 1, 1, 12, 100, 400, 0, '500', 2, 1),
(4, '123456789562', 'Halogen Heater 1200W', 'w16cnhNz6oh7SZRH.jpg', 2, 1, 1, 12, 20, 80, 0, '100', 1, 1),
(5, '123456789123', 'Halogen Heater 600 W', 'OciVLCv3e1OySuDh.jpg', 1, 1, 1, 7, 50, 150, 0, '200', 1, 1),
(6, '123456789128', 'Electric Heater HVW11A', 'AJ6cznN4aEv92G7S.jpg', 2, 1, 1, 3, 50, 200, 0, '250', 1, 1),
(7, '123456765456', 'Electric Heater VSW12', '3RcNLV3E5c1VpfiS.jpg', 4, 1, 1, 12, 100, 300, 0, '400', 1, 1),
(8, '1564328794563', 'Heating Fan 2000W', '7FKFbAdBqpSJX4qt.jpg', 4, 2, 3, 12, 100, 300, 0, '400', 1, 1),
(9, '1734524583456', 'Heating Fan 1500W', 'K5Cb0ranHGQHiN0j.jpg', 4, 1, 3, 12, 100, 300, 0, '400', 1, 1),
(10, '1239873456785', 'Electric Fan 40 cm', '1CUo9tSbqSpZjamv.jpg', 1, 1, 7, 12, 50, 200, 0, '250', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` bigint(20) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_description` varchar(600) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_name`, `category_description`, `warehouse_id`, `status`) VALUES
(1, 'Electric Heaters', 'Electric Heaters', 1, 1),
(2, 'Ceramic Heaters', 'Ceramic Heaters', 1, 1),
(3, 'Fan heaters', 'Fan heaters', 1, 1),
(4, 'Electric Stones', 'Electric Stones', 1, 0),
(5, 'Ceramic Stones', 'Ceramic Stones', 1, 0),
(6, 'Compressors', 'Compressors', 1, 0),
(7, 'Electric Fans', 'Electric Fans', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_qrcodes`
--

CREATE TABLE `product_qrcodes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_qr_settings`
--

CREATE TABLE `product_qr_settings` (
  `id` int(11) NOT NULL,
  `ecc_level` varchar(1) NOT NULL,
  `size` int(11) NOT NULL,
  `display_text` int(11) NOT NULL DEFAULT 0,
  `text_position` varchar(10) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_qr_settings`
--

INSERT INTO `product_qr_settings` (`id`, `ecc_level`, `size`, `display_text`, `text_position`, `warehouse_id`) VALUES
(1, 'L', 10, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_rates`
--

CREATE TABLE `product_rates` (
  `rate_id` bigint(20) NOT NULL,
  `default_rate` float DEFAULT NULL,
  `level_1` float DEFAULT NULL,
  `level_2` float DEFAULT NULL,
  `level_3` float DEFAULT NULL,
  `level_4` float DEFAULT NULL,
  `level_5` float DEFAULT NULL,
  `store_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_rates`
--

INSERT INTO `product_rates` (`rate_id`, `default_rate`, `level_1`, `level_2`, `level_3`, `level_4`, `level_5`, `store_id`, `product_id`) VALUES
(1, 73.5, 73.5, 73.5, 73.5, 73.5, 73.5, 1, 1),
(2, 84, 84, 84, 84, 84, 84, 1, 2),
(3, 73.5, 73.5, 73.5, 73.5, 73.5, 73.5, 2, 3),
(4, 47, 47, 47, 47, 47, 47, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_taxes`
--

CREATE TABLE `product_taxes` (
  `tax_id` bigint(20) NOT NULL,
  `tax_name` varchar(200) DEFAULT NULL,
  `tax_rate` varchar(200) DEFAULT NULL,
  `tax_type` varchar(200) DEFAULT NULL,
  `tax_description` varchar(600) DEFAULT NULL,
  `store_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `racking_systems`
--

CREATE TABLE `racking_systems` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racking_systems`
--

INSERT INTO `racking_systems` (`id`, `name`) VALUES
(1, 'Selective Racking System');

-- --------------------------------------------------------

--
-- Table structure for table `receivings`
--

CREATE TABLE `receivings` (
  `id` int(11) NOT NULL,
  `rc_code` varchar(50) NOT NULL,
  `po_id` int(11) NOT NULL,
  `lpo_id` int(11) NOT NULL,
  `datetime` date NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `agent_id` bigint(20) NOT NULL,
  `stored` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receivings`
--

INSERT INTO `receivings` (`id`, `rc_code`, `po_id`, `lpo_id`, `datetime`, `supplier_id`, `warehouse_id`, `agent_id`, `stored`) VALUES
(1, 'RC-0001-22', 1, 1, '2022-06-17', 1, 1, 1, 1),
(2, 'RC-0002-22', 2, 2, '2022-11-10', 1, 1, 1, 1),
(3, 'RC-0003-22', 3, 3, '2022-11-10', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_details`
--

CREATE TABLE `receiving_details` (
  `id` bigint(20) NOT NULL,
  `rc_id` int(11) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `lpo_id` int(11) NOT NULL,
  `date_reception` date NOT NULL,
  `warehouse_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `qty` float NOT NULL,
  `qty_appr` float NOT NULL,
  `qty_dmg` float NOT NULL,
  `agent_id` bigint(20) NOT NULL,
  `stored` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receiving_details`
--

INSERT INTO `receiving_details` (`id`, `rc_id`, `order_id`, `lpo_id`, `date_reception`, `warehouse_id`, `product_id`, `qty`, `qty_appr`, `qty_dmg`, `agent_id`, `stored`) VALUES
(1, 1, 1, 1, '2022-06-17', 1, 1, 50, 50, 0, 1, 1),
(2, 1, 1, 1, '2022-06-17', 1, 2, 50, 50, 0, 1, 1),
(3, 1, 1, 1, '2022-06-17', 1, 5, 50, 50, 0, 1, 1),
(4, 2, 2, 2, '2022-11-10', 1, 1, 350, 350, 0, 1, 1),
(5, 2, 2, 2, '2022-11-10', 1, 5, 450, 450, 0, 1, 1),
(6, 3, 3, 3, '2022-11-10', 1, 4, 450, 450, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `return_code` varchar(50) NOT NULL,
  `return_date` date NOT NULL,
  `return_reference` varchar(100) NOT NULL,
  `from_warehouse` int(11) NOT NULL,
  `from_client` int(11) NOT NULL,
  `to_warehouse` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `delivery_id`, `transfer_id`, `return_code`, `return_date`, `return_reference`, `from_warehouse`, `from_client`, `to_warehouse`, `agent_id`) VALUES
(1, 0, 2, 'RET-0001-22', '2022-07-10', 'DC1523172001', 2, 0, 1, 1),
(2, 1, 0, 'RET-0002-22', '2022-07-11', 'CR123456183', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `return_details`
--

CREATE TABLE `return_details` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty_returned` float NOT NULL,
  `return_reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_details`
--

INSERT INTO `return_details` (`id`, `return_id`, `warehouse_id`, `product_id`, `qty_returned`, `return_reason`) VALUES
(1, 1, 1, 1, 2, 'Not working'),
(2, 1, 1, 2, 0, 'Nothing'),
(3, 2, 1, 1, 3, ''),
(4, 2, 1, 5, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `warehouseId` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `multiLang` int(11) NOT NULL,
  `tzone` varchar(100) NOT NULL,
  `firstDay` int(11) NOT NULL,
  `dateFormat` varchar(10) NOT NULL,
  `timeFormat` int(11) NOT NULL,
  `defaultCurrency` int(11) NOT NULL,
  `decimalDigits` int(11) NOT NULL,
  `useThSep` int(11) NOT NULL,
  `thSepChar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `warehouseId`, `lang`, `multiLang`, `tzone`, `firstDay`, `dateFormat`, `timeFormat`, `defaultCurrency`, `decimalDigits`, `useThSep`, `thSepChar`) VALUES
(1, 1, 1, 1, 'America/Vancouver', 2, 'dd-mm-yyyy', 1, 3, 3, 1, 2),
(2, 4, 1, 0, 'UTC', 2, 'mm-dd-yyyy', 1, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `storage_area`
--

CREATE TABLE `storage_area` (
  `id` int(11) NOT NULL,
  `warehouseId` int(11) NOT NULL,
  `StorageLength` float NOT NULL,
  `StorageWidth` float NOT NULL,
  `StorageHeight` float NOT NULL,
  `stockType` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_area`
--

INSERT INTO `storage_area` (`id`, `warehouseId`, `StorageLength`, `StorageWidth`, `StorageHeight`, `stockType`) VALUES
(1, 1, 70, 55, 7, 1),
(2, 2, 50, 15, 4, 1),
(3, 4, 50, 15, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `storage_racking`
--

CREATE TABLE `storage_racking` (
  `id` int(11) NOT NULL,
  `warehouseId` int(11) NOT NULL,
  `rackingSystem` int(11) NOT NULL,
  `inventorySystem` int(11) NOT NULL,
  `storageSystem` int(11) NOT NULL,
  `rackHeight` float NOT NULL,
  `rackLength` float NOT NULL,
  `rackWidth` float NOT NULL,
  `shelfHeight` float NOT NULL,
  `aisle` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_racking`
--

INSERT INTO `storage_racking` (`id`, `warehouseId`, `rackingSystem`, `inventorySystem`, `storageSystem`, `rackHeight`, `rackLength`, `rackWidth`, `shelfHeight`, `aisle`) VALUES
(1, 1, 1, 1, 1, 6, 2, 2, 2, 2),
(2, 2, 1, 1, 1, 4, 2, 2, 1.5, 2),
(3, 4, 1, 1, 1, 4, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `storage_reallines`
--

CREATE TABLE `storage_reallines` (
  `id` int(11) NOT NULL,
  `virtualLine` int(11) NOT NULL,
  `visualLine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_reallines`
--

INSERT INTO `storage_reallines` (`id`, `virtualLine`, `visualLine`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 4, 3),
(4, 6, 4),
(5, 7, 5),
(6, 9, 6),
(7, 10, 7),
(8, 12, 8),
(9, 13, 9),
(10, 15, 10),
(11, 16, 11),
(12, 18, 12),
(13, 19, 13),
(14, 21, 14),
(15, 22, 15),
(16, 24, 16),
(17, 25, 17),
(18, 27, 18),
(19, 28, 19),
(20, 30, 20),
(21, 31, 21),
(22, 33, 22),
(23, 34, 23),
(24, 36, 24),
(25, 37, 25),
(26, 39, 26),
(27, 40, 27),
(28, 42, 28),
(29, 43, 29),
(30, 45, 30),
(31, 46, 31),
(32, 48, 32),
(33, 49, 33),
(34, 51, 34),
(35, 52, 35),
(36, 54, 36),
(37, 55, 37),
(38, 57, 38),
(39, 58, 39),
(40, 60, 40),
(41, 61, 41),
(42, 63, 42),
(43, 64, 43),
(44, 66, 44),
(45, 67, 45),
(46, 69, 46),
(47, 70, 47),
(48, 72, 48),
(49, 73, 49),
(50, 75, 50),
(51, 76, 51),
(52, 78, 52),
(53, 79, 53),
(54, 81, 54),
(55, 82, 55),
(56, 84, 56),
(57, 85, 57),
(58, 87, 58),
(59, 88, 59),
(60, 90, 60),
(61, 91, 61),
(62, 93, 62),
(63, 94, 63),
(64, 96, 64),
(65, 97, 65),
(66, 99, 66),
(67, 100, 67);

-- --------------------------------------------------------

--
-- Table structure for table `storage_systems`
--

CREATE TABLE `storage_systems` (
  `id` int(11) NOT NULL,
  `systemName` varchar(150) NOT NULL,
  `systemDescription` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_systems`
--

INSERT INTO `storage_systems` (`id`, `systemName`, `systemDescription`) VALUES
(1, 'Static Shelving', 'Static Shelving is storage mechanism that is designed to keep shelves in one place. For the most part, they are meant to hold inventory that is fairly lightweight (a few hundred pounds per shelf). It’s commonly used for storing inventory that needs continuous replenishment.'),
(2, 'Mobile Shelving', 'The Mobile Racking System is a system where racks are built on a mobile base and guided by rails on the floor. Driven by an electrical motor, the mobile base move along the rails to open one or more access aisle.');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `store_id` bigint(20) NOT NULL,
  `store_manual_id` varchar(100) NOT NULL,
  `store_name` varchar(100) NOT NULL,
  `business_type` varchar(100) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `store_logo` varchar(500) NOT NULL,
  `description` varchar(600) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` bigint(20) NOT NULL,
  `supplier_code` varchar(50) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `register_number` varchar(100) DEFAULT NULL,
  `mobile` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_code`, `full_name`, `register_number`, `mobile`, `phone`, `address`, `city`, `country`, `email`, `status`) VALUES
(1, 'SUPP0001', 'General Equipments', '1234567', '125478963', '145236987', '123, str Jean Dunold,', 'City', 'Canada', 'contact@generalequipments.com', 1),
(2, 'SUPP0002', 'Appliances Company ', '375-218-259', '6529856584', '6529856321', '12-153 2/4 main street Montreal QC H32 2YZ', 'Montreal', 'Canada', 'sales@appliacescmp.com', 1),
(4, 'SUPP0003', 'Supplier 3', '145-523-654', '', '4521875', 'Adress of supplier 3', 'City', 'Canada', '', 0),
(5, 'SP0004', 'Apha Supplies', '125-458-563-213', '3464646', '2121454545', 'District 15A, Road 123, Bloc B3', 'city 4', 'Canada', 'info@aphasupplies.com', 1),
(6, 'SP0005', 'Dudet Electics', '145-256-521', '1234569874', '1234567891', 'Adress of supplier 5', 'City 5', 'Canada', 'supp5@mail.com', 1),
(7, 'SP0006', 'Supplier 6', '12345698ME/20', '987654321', '123456789', 'Bloc 1, str 125, Disctrict 12A', 'Quebec', 'Canada', 'info@supp6.com', 1),
(8, 'SP0008', 'Supplier 08', '123456789/MF', '1478523699632', '123456789213', 'Bloc 1, Street 123, Building 2C', 'Montreal', 'Canada', 'info@supplier.com', 1),
(9, 'SP0009', 'Supplier 09', '12345879/MF', '125469856', '125456321', 'Address of supplier 09', 'city 9', 'country 9', 'info@supplier09.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` bigint(20) NOT NULL,
  `transfer_code` varchar(20) NOT NULL,
  `datetime` date DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `destination_id` bigint(20) DEFAULT NULL,
  `agent_id` bigint(20) DEFAULT NULL,
  `approved` int(11) NOT NULL,
  `loaded` int(11) NOT NULL DEFAULT 0,
  `received` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`transfer_id`, `transfer_code`, `datetime`, `warehouse_id`, `destination_id`, `agent_id`, `approved`, `loaded`, `received`) VALUES
(1, 'TR-0001-22', '2022-05-27', 1, 2, 1, 1, 1, 1),
(2, 'TR-0002-22', '2022-05-27', 1, 2, 1, 1, 1, 1),
(3, 'TR-0003-22', '2022-05-27', 1, 3, 1, 1, 1, 0),
(4, 'TR-0004-22', '2022-05-27', 1, 2, 1, 1, 1, 0),
(5, 'TR-0005-22', '2022-08-17', 1, 2, 1, 1, 0, 0),
(6, 'TR-0006-22', '2022-08-19', 1, 2, 1, 1, 1, 0),
(7, 'TR-0007-22', '2022-11-06', 1, 2, 1, 0, 0, 0),
(8, 'TR-0008-22', '2022-11-10', 1, 2, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_approved`
--

CREATE TABLE `transfer_approved` (
  `approval_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `date_approve` date NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `qty_appr` float NOT NULL,
  `loaded` int(11) NOT NULL DEFAULT 0,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_approved`
--

INSERT INTO `transfer_approved` (`approval_id`, `transfer_id`, `date_approve`, `warehouse_id`, `destination_id`, `product_id`, `qty`, `qty_appr`, `loaded`, `agent_id`) VALUES
(1, 1, '2022-05-27', 1, 2, 1, 50, 50, 1, 1),
(2, 2, '2022-05-27', 1, 2, 1, 120, 120, 1, 1),
(3, 2, '2022-05-27', 1, 2, 2, 100, 100, 1, 1),
(4, 3, '2022-05-27', 1, 3, 1, 75, 75, 1, 1),
(5, 3, '2022-05-27', 1, 3, 2, 100, 100, 1, 1),
(6, 3, '2022-05-27', 1, 3, 5, 100, 100, 1, 1),
(7, 4, '2022-05-27', 1, 2, 2, 100, 100, 1, 1),
(8, 5, '2022-08-19', 1, 2, 1, 100, 100, 0, 1),
(9, 5, '2022-08-19', 1, 2, 2, 50, 50, 0, 1),
(10, 6, '2022-11-06', 1, 2, 1, 122, 122, 1, 1),
(11, 6, '2022-11-06', 1, 2, 2, 85, 85, 1, 1),
(12, 8, '2022-11-10', 1, 2, 1, 200, 200, 0, 1),
(13, 8, '2022-11-10', 1, 2, 4, 200, 200, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_details`
--

CREATE TABLE `transfer_details` (
  `detailId` int(10) NOT NULL,
  `transferId` int(10) NOT NULL,
  `origin` int(10) NOT NULL,
  `destination` int(10) NOT NULL,
  `productId` bigint(20) NOT NULL,
  `qty` float NOT NULL,
  `volume` float NOT NULL,
  `weight` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_details`
--

INSERT INTO `transfer_details` (`detailId`, `transferId`, `origin`, `destination`, `productId`, `qty`, `volume`, `weight`) VALUES
(1, 1, 1, 2, 1, 50, 5.625, 375),
(2, 2, 1, 2, 1, 120, 13.5, 900),
(3, 2, 1, 2, 2, 100, 18, 900),
(4, 3, 1, 3, 1, 75, 8.4375, 562.5),
(5, 3, 1, 3, 2, 100, 18, 900),
(6, 3, 1, 3, 5, 100, 15.12, 1450),
(7, 4, 1, 2, 2, 100, 18, 900),
(8, 5, 1, 2, 1, 100, 11.25, 750),
(9, 5, 1, 2, 2, 50, 9, 450),
(10, 6, 1, 2, 1, 122, 13.725, 915),
(11, 6, 1, 2, 2, 85, 15.3, 765),
(12, 7, 1, 2, 1, 150, 16.875, 1125),
(13, 7, 1, 2, 2, 100, 18, 900),
(14, 8, 1, 2, 1, 200, 22.5, 1560),
(15, 8, 1, 2, 4, 200, 5.625, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_received`
--

CREATE TABLE `transfer_received` (
  `reception_id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `date_reception` date NOT NULL,
  `from_warehouse` int(11) NOT NULL,
  `to_warehouse` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` float NOT NULL,
  `qty_appr` float NOT NULL,
  `agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_received`
--

INSERT INTO `transfer_received` (`reception_id`, `transfer_id`, `date_reception`, `from_warehouse`, `to_warehouse`, `product_id`, `qty`, `qty_appr`, `agent_id`) VALUES
(1, 1, '2022-05-28', 1, 2, 1, 50, 50, 1),
(2, 2, '2022-06-03', 1, 2, 1, 120, 120, 1),
(3, 2, '2022-06-03', 1, 2, 2, 100, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profileImage` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `activation_key` varchar(100) DEFAULT NULL,
  `activation_expiry` datetime DEFAULT NULL,
  `registerDate` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(100) NOT NULL,
  `user_function` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `username`, `email`, `password`, `profileImage`, `status`, `activation_key`, `activation_expiry`, `registerDate`, `user_type`, `user_function`) VALUES
(1, 'Admin', 'admin', 'admin@awms.com', '$2y$10$wUs54bWihSHMujEeDqDn4OCvM1cDOSbdAcQrTIZJwVHQtNkJvzOjO', '', 1, NULL, NULL, '2023-01-03 00:00:00', 'admin', ''),
(2, 'John Doe', 'johndoe', 'johndoe@awms.com', '$2y$10$JOgRbkivb/8pQbnVv.0Z0.HdS3yehdWWgy7JynUZtHp3s6SSOrMue', '55f1cceffb32d824.png', 1, NULL, NULL, '2023-11-03 13:24:54', '6', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `level_id` bigint(20) NOT NULL,
  `level_name` varchar(200) NOT NULL,
  `level_description` varchar(600) NOT NULL,
  `level_page` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`, `level_description`, `level_page`) VALUES
(1, 'subscriber', 'Default user level given access to profile.php', 'profile.php');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE `user_meta` (
  `user_meta_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `message_email` varchar(50) NOT NULL,
  `last_login_time` datetime NOT NULL,
  `last_login_ip` varchar(120) NOT NULL,
  `login_attempt` bigint(20) NOT NULL,
  `login_lock` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`user_meta_id`, `user_id`, `message_email`, `last_login_time`, `last_login_ip`, `login_attempt`, `login_lock`) VALUES
(1, 1, '', '2021-12-17 10:19:59', '::1', 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `type_description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `user_type`, `type_description`) VALUES
(1, 'Admin', ''),
(2, 'Warehouse Manager', ''),
(3, 'Inventory Controller', ''),
(4, 'Purchasing Manager', ''),
(5, 'Purchasing agent', ''),
(6, 'Warehouse Supervisor', ''),
(7, 'Storage Agent', ''),
(8, 'Pick & Pack Agent', ''),
(9, 'Quality Control Inspector', '');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(20) NOT NULL,
  `warehouseName` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `manager` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `mobile` varchar(20) NOT NULL DEFAULT '0',
  `area` float NOT NULL,
  `volume` float NOT NULL,
  `freezone` float NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `warehouseName`, `address`, `city`, `state`, `country`, `manager`, `contact`, `mobile`, `area`, `volume`, `freezone`, `disabled`) VALUES
(1, 'My Warehouse', 'str1, b123B, district 12', 'Montreal', 'Quebec', 'Canada', 'Patrick Lubom', '12345678912', '145236589', 1500, 5000, 500, 0),
(2, 'Warehouse 2', 'str1. bl2, disctrict 124', 'Montreal', 'Montreal', 'Canada', 'John Edison', '001586965423', '0', 1000, 3000, 300, 0),
(3, 'Warehouse 3', 'str15A. bl7, disctrict 18', 'Montreal', 'Montreal', 'Canada', 'Edward Nilpom', '001586965423', '0', 1000, 3000, 300, 0),
(4, 'Warehouse 4', 'Address of Warehouse 4', 'city 4', '', 'country 4', 'manager waeh 4', '123456789', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_access`
--

CREATE TABLE `warehouse_access` (
  `access_id` bigint(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `warehouse_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_access`
--

INSERT INTO `warehouse_access` (`access_id`, `user_id`, `warehouse_id`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_currencies`
--

CREATE TABLE `warehouse_currencies` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `is_default` int(11) NOT NULL DEFAULT 0,
  `change_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_currencies`
--

INSERT INTO `warehouse_currencies` (`id`, `warehouse_id`, `currency_id`, `is_default`, `change_rate`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warh_dimensions`
--

CREATE TABLE `warh_dimensions` (
  `id` int(11) NOT NULL,
  `warehouseId` int(11) NOT NULL,
  `warhLength` float NOT NULL,
  `warhWidth` float NOT NULL,
  `warhHeigth` float NOT NULL,
  `office` float NOT NULL DEFAULT 0,
  `restroom` float NOT NULL DEFAULT 0,
  `otherFreeSpace` float NOT NULL DEFAULT 0,
  `storage_cost_rate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warh_dimensions`
--

INSERT INTO `warh_dimensions` (`id`, `warehouseId`, `warhLength`, `warhWidth`, `warhHeigth`, `office`, `restroom`, `otherFreeSpace`, `storage_cost_rate`) VALUES
(1, 1, 80, 70, 7, 12, 10, 0, 11.5),
(2, 4, 80, 25, 4, 15, 10, 22, 11.6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_settings`
--
ALTER TABLE `application_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`backup_id`),
  ADD UNIQUE KEY `backup_name_UNIQUE` (`backup_name`);

--
-- Indexes for table `barcode_technologies`
--
ALTER TABLE `barcode_technologies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcode_types`
--
ALTER TABLE `barcode_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcoding_packs`
--
ALTER TABLE `barcoding_packs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcoding_products`
--
ALTER TABLE `barcoding_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcoding_racks`
--
ALTER TABLE `barcoding_racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `clientorders`
--
ALTER TABLE `clientorders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `clientorder_details`
--
ALTER TABLE `clientorder_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `companysettings`
--
ALTER TABLE `companysettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dimensions`
--
ALTER TABLE `dimensions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eoq_settings`
--
ALTER TABLE `eoq_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `functions`
--
ALTER TABLE `functions`
  ADD PRIMARY KEY (`function_id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `inventory_adjustments`
--
ALTER TABLE `inventory_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_settings`
--
ALTER TABLE `inventory_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_systems`
--
ALTER TABLE `inventory_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_techniques`
--
ALTER TABLE `inventory_techniques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_tmp`
--
ALTER TABLE `inventory_tmp`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loadings`
--
ALTER TABLE `loadings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loading_approve`
--
ALTER TABLE `loading_approve`
  ADD PRIMARY KEY (`loading_approve_id`);

--
-- Indexes for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measuring_units`
--
ALTER TABLE `measuring_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_meta`
--
ALTER TABLE `message_meta`
  ADD PRIMARY KEY (`msg_meta_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `occupancy`
--
ALTER TABLE `occupancy`
  ADD PRIMARY KEY (`id_occ`);

--
-- Indexes for table `occupancy_tmp`
--
ALTER TABLE `occupancy_tmp`
  ADD PRIMARY KEY (`id_occ`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `physical_inventories`
--
ALTER TABLE `physical_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phys_inv_details`
--
ALTER TABLE `phys_inv_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picking_methods`
--
ALTER TABLE `picking_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picking_systems`
--
ALTER TABLE `picking_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_details`
--
ALTER TABLE `po_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `price_levels`
--
ALTER TABLE `price_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_qrcodes`
--
ALTER TABLE `product_qrcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_qr_settings`
--
ALTER TABLE `product_qr_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_rates`
--
ALTER TABLE `product_rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `product_taxes`
--
ALTER TABLE `product_taxes`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `racking_systems`
--
ALTER TABLE `racking_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receivings`
--
ALTER TABLE `receivings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_details`
--
ALTER TABLE `receiving_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_details`
--
ALTER TABLE `return_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_area`
--
ALTER TABLE `storage_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_racking`
--
ALTER TABLE `storage_racking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_reallines`
--
ALTER TABLE `storage_reallines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_systems`
--
ALTER TABLE `storage_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `transfer_approved`
--
ALTER TABLE `transfer_approved`
  ADD PRIMARY KEY (`approval_id`);

--
-- Indexes for table `transfer_details`
--
ALTER TABLE `transfer_details`
  ADD PRIMARY KEY (`detailId`);

--
-- Indexes for table `transfer_received`
--
ALTER TABLE `transfer_received`
  ADD PRIMARY KEY (`reception_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`user_meta_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_access`
--
ALTER TABLE `warehouse_access`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `warehouse_currencies`
--
ALTER TABLE `warehouse_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warh_dimensions`
--
ALTER TABLE `warh_dimensions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_settings`
--
ALTER TABLE `application_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `backup`
--
ALTER TABLE `backup`
  MODIFY `backup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barcode_technologies`
--
ALTER TABLE `barcode_technologies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barcode_types`
--
ALTER TABLE `barcode_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barcoding_packs`
--
ALTER TABLE `barcoding_packs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barcoding_products`
--
ALTER TABLE `barcoding_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barcoding_racks`
--
ALTER TABLE `barcoding_racks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientorders`
--
ALTER TABLE `clientorders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientorder_details`
--
ALTER TABLE `clientorder_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companysettings`
--
ALTER TABLE `companysettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dimensions`
--
ALTER TABLE `dimensions`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eoq_settings`
--
ALTER TABLE `eoq_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `functions`
--
ALTER TABLE `functions`
  MODIFY `function_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `inventory_adjustments`
--
ALTER TABLE `inventory_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_settings`
--
ALTER TABLE `inventory_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_systems`
--
ALTER TABLE `inventory_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_techniques`
--
ALTER TABLE `inventory_techniques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_tmp`
--
ALTER TABLE `inventory_tmp`
  MODIFY `inventory_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loadings`
--
ALTER TABLE `loadings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loading_approve`
--
ALTER TABLE `loading_approve`
  MODIFY `loading_approve_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_sessions`
--
ALTER TABLE `login_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `measuring_units`
--
ALTER TABLE `measuring_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_meta`
--
ALTER TABLE `message_meta`
  MODIFY `msg_meta_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `note_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occupancy`
--
ALTER TABLE `occupancy`
  MODIFY `id_occ` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `occupancy_tmp`
--
ALTER TABLE `occupancy_tmp`
  MODIFY `id_occ` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `physical_inventories`
--
ALTER TABLE `physical_inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phys_inv_details`
--
ALTER TABLE `phys_inv_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `picking_methods`
--
ALTER TABLE `picking_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `picking_systems`
--
ALTER TABLE `picking_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `po_details`
--
ALTER TABLE `po_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `price_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `price_levels`
--
ALTER TABLE `price_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_qrcodes`
--
ALTER TABLE `product_qrcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_qr_settings`
--
ALTER TABLE `product_qr_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_rates`
--
ALTER TABLE `product_rates`
  MODIFY `rate_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_taxes`
--
ALTER TABLE `product_taxes`
  MODIFY `tax_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `racking_systems`
--
ALTER TABLE `racking_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receivings`
--
ALTER TABLE `receivings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receiving_details`
--
ALTER TABLE `receiving_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `return_details`
--
ALTER TABLE `return_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `storage_area`
--
ALTER TABLE `storage_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `storage_racking`
--
ALTER TABLE `storage_racking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `storage_reallines`
--
ALTER TABLE `storage_reallines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `storage_systems`
--
ALTER TABLE `storage_systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transfer_approved`
--
ALTER TABLE `transfer_approved`
  MODIFY `approval_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transfer_details`
--
ALTER TABLE `transfer_details`
  MODIFY `detailId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `transfer_received`
--
ALTER TABLE `transfer_received`
  MODIFY `reception_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `user_meta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse_access`
--
ALTER TABLE `warehouse_access`
  MODIFY `access_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouse_currencies`
--
ALTER TABLE `warehouse_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warh_dimensions`
--
ALTER TABLE `warh_dimensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
