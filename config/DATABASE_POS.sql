-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql203.infinityfree.com
-- Generation Time: Dec 03, 2024 at 03:27 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37176330_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Telephone', '2024-11-30 09:44:04', '2024-12-02 12:21:08'),
(2, 'Tablette/ipoad', '2024-11-30 09:44:16', '2024-12-02 12:23:55'),
(3, 'PC Portable', '2024-11-30 09:44:26', '2024-11-30 09:44:26'),
(4, 'PC Desktop', '2024-11-30 09:44:38', '2024-11-30 09:44:38'),
(7, 'beauty and care', '2024-12-02 21:30:41', '2024-12-02 21:30:41');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `balance`, `created_at`, `updated_at`) VALUES
(9, 'Anes', '22263146', '6.00', '2024-12-01 13:01:55', '2024-12-01 13:01:55'),
(10, 'wiem', '41000002', '-5600.00', '2024-12-01 13:04:58', '2024-12-01 13:04:58'),
(5, 'TestCustomer', '25000000', '0.00', '2024-11-30 20:34:17', '2024-11-30 20:34:17'),
(6, 'Foulen', '25705895', '0.00', '2024-11-30 20:35:15', '2024-11-30 20:35:15'),
(7, 'Med Ali', '25700000', '0.00', '2024-11-30 20:40:56', '2024-11-30 20:40:56'),
(8, 'Customer', '25544455', '-8755.42', '2024-11-30 20:50:39', '2024-11-30 20:50:39'),
(11, 'Mr X', '45111001', '-11225.00', '2024-12-02 12:24:57', '2024-12-02 12:24:57'),
(12, 'takwa', '2202230', '10.00', '2024-12-02 21:33:30', '2024-12-02 21:34:56'),
(13, 'amal', '92000358', '-37550.00', '2024-12-02 21:37:05', '2024-12-02 21:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customer_name`, `customer_phone`, `total_amount`, `created_at`) VALUES
(10, 'Mr X', '45111001', '11225.00', '2024-12-02 12:24:57'),
(9, 'wiem', '41000002', '5600.00', '2024-12-01 13:04:58'),
(8, 'Customer', '25544455', '8755.42', '2024-11-30 20:50:39'),
(7, 'Test Customer', '45885588', '8755.42', '2024-11-30 20:47:06'),
(6, 'Said', '154545454', '92228.40', '2024-11-30 20:06:23'),
(11, 'takwa', '2202230', '0.00', '2024-12-02 21:33:30'),
(12, 'amal', '92000358', '37550.00', '2024-12-02 21:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(5,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_name`, `quantity`, `price`, `tax`, `total`) VALUES
(1, 1, 'Ipad Pro MAX', 1, '5000.00', '23.00', '6150.00'),
(2, 1, 'iphone 13', 1, '2500.00', '12.00', '2800.00'),
(3, 2, 'iphone 15 pro max', 3, '4520.00', '2.00', '13831.20'),
(4, 2, 'Dell', 1, '2000.00', '10.00', '2200.00'),
(5, 3, 'iphone 15 pro max', 1, '4520.00', '2.00', '4610.40'),
(6, 4, 'Asus H5 15 P', 2, '1200.00', '12.00', '2688.00'),
(7, 5, 'Asus H5 15 P', 1, '1200.00', '12.00', '1344.00'),
(8, 5, 'iphone 15 pro max', 5, '4520.00', '2.00', '23052.00'),
(9, 6, 'iphone 15 pro max', 20, '4521.00', '2.00', '92228.40'),
(10, 7, 'iphone 13', 1, '2500.00', '12.00', '2800.00'),
(11, 7, 'iphone 15 pro max', 1, '4521.00', '2.00', '4611.42'),
(12, 7, 'Asus H5 15 P', 1, '1200.00', '12.00', '1344.00'),
(13, 8, 'iphone 13', 1, '2500.00', '12.00', '2800.00'),
(14, 8, 'iphone 15 pro max', 1, '4521.00', '2.00', '4611.42'),
(15, 8, 'Asus H5 15 P', 1, '1200.00', '12.00', '1344.00'),
(16, 9, 'iphone 13', 1, '2500.00', '12.00', '2800.00'),
(17, 9, 'iphone 13', 1, '2500.00', '12.00', '2800.00'),
(18, 10, 'Dell', 1, '2000.00', '10.00', '2200.00'),
(19, 10, 'Ipad Pro MAX', 1, '5000.00', '23.00', '6150.00'),
(20, 10, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(21, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(22, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(23, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(24, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(25, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(26, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(27, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(28, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(29, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(30, 12, 'iphone 13', 1, '2500.00', '15.00', '2875.00'),
(31, 12, 'Dell', 1, '2000.00', '10.00', '2200.00'),
(32, 12, 'Dell', 1, '2000.00', '10.00', '2200.00'),
(33, 12, 'Dell', 1, '2000.00', '10.00', '2200.00'),
(34, 12, 'Dell', 1, '2000.00', '10.00', '2200.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `office` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tax` float NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `office`, `quantity`, `tax`, `description`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'iphone 13', 2500, '', 9, 15, NULL, 1, '2024-11-30 10:37:30', '2024-12-02 21:37:05'),
(8, 'foundation', 5200, '', 50, 19, NULL, 7, '2024-12-02 21:31:17', '2024-12-02 21:31:17'),
(4, 'Ipad Pro MAX', 5000, '', 19, 23, NULL, 2, '2024-11-30 10:38:28', '2024-12-02 12:24:57'),
(5, 'Asus H5 15 P', 1200, '', 42, 12, NULL, 3, '2024-11-30 10:39:27', '2024-11-30 20:50:39'),
(6, 'Dell', 2000, '', -3, 10, NULL, 4, '2024-11-30 10:49:45', '2024-12-02 21:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin', '2024-11-30 11:34:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
