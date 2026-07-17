-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql309.infinityfree.com
-- Generation Time: Jul 16, 2026 at 11:35 PM
-- Server version: 11.4.12-MariaDB
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
-- Database: `if0_42410940_satifia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmins`
--

CREATE TABLE `tbladmins` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'Staff',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmins`
--

INSERT INTO `tbladmins` (`id`, `fullname`, `username`, `password`, `role`, `date_created`) VALUES
(1, 'Super Admin', 'admin', '$2y$10$imXrVsGDf0n/xRYfnj.qZ.ka9WKYJITEnczFpu7LeuAyNHd5J1ysi\r\n', 'Admin', '2026-06-21 11:13:39'),
(2, 'Staff Member', 'staff1', '$2y$10$OU0sn.ruQxApemlGo6Uqpe8ygaOqLhytBM3CmEQBtOk5WUfKCOF0u', 'Staff', '2026-06-22 11:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `tblaudit_log`
--

CREATE TABLE `tblaudit_log` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaudit_log`
--

INSERT INTO `tblaudit_log` (`id`, `admin_id`, `admin_name`, `action`, `date_created`) VALUES
(1, 1, 'Super Admin', 'Added new product: Test', '2026-06-22 12:03:14'),
(2, 1, 'Super Admin', 'Deleted product: Test', '2026-06-22 12:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblbuyers`
--

CREATE TABLE `tblbuyers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `is_confirmed` tinyint(4) NOT NULL DEFAULT 0,
  `confirm_token` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbuyers`
--

INSERT INTO `tblbuyers` (`id`, `fullname`, `email`, `password`, `address`, `contact`, `is_confirmed`, `confirm_token`, `date_created`) VALUES
(5, 'Sam Nieves', 'samnieves1206@gmail.com', '$2y$10$4exunvJvtlWtSHVRmvd/4u3uzv8xR3M8O5UFWarV2KQHU6FtrnOYS', '589 Tanglaw, Barangka Drive', '09455269755', 1, NULL, '2026-07-06 11:38:53'),
(8, 'Sam Nieves', 'nievessamkenneth@gmail.com', '$2y$10$KokSHFvw/6wDYyI8bG3oY.85UzKiZX0ggfQ9IjD1g.2yW6Jdrq/Mm', '598 Tanglaw, Mandaluyong City', '09513506316', 0, '0f28419aa890cd6e12209373dd2b0883b66e97d5b38e583d3c0900cd66ffe918', '2026-07-08 14:03:39'),
(10, 'Afio Sheesh', 'afioasheesh@gmail.com', '$2y$10$Z1nSWS2oTEfflXuzs73FCuspjpm/lu2rrkm0rnYYDaIQJ8UjRqjom', 'Bonifacio street, Bgy. Poblacion, Makati City', '09124686542', 0, 'ad7d8b5b3a81f944ca1ded36dd6ed08fbc3320eefdaa882dadd1e8c7c2002479', '2026-07-15 03:46:18'),
(11, 'Sam Nieves', 'samkennethperaltanieves@gmail.com', '$2y$10$2Afw21lNPk3WD2eaBKcwPOI2RWGnvHhDxe0zSJ5sz5/yGqlRIGNhK', '589 Tanglaw, Barangka Drive', '09513506315', 1, NULL, '2026-07-15 08:22:16'),
(12, 'Kristine Joy Sarzuelo', 'joy2x09@gmail.com', '$2y$10$IKaIqBzzBBFHGkt9La2er.97FFoq3L.0kt69uVA0FYtWJ59a1yz5u', 'blk32 lot.5 k104 st. karangalan village', '09766679145', 1, NULL, '2026-07-15 08:25:55'),
(13, 'DARYL NIEVES', 'kenjiminatozaki@gmail.com', '$2y$10$HTmgz3eF1HeOLiKhmm3LA.jSr0HBS5gKa.pPlT.MUhF44SWObh56C', '589 Tanglaw, Barangka Drive', '09513506316', 0, 'da1d9d7f53397c65281da754a5e514203e1941f9483de0adbf359105f6938f89', '2026-07-15 08:27:34'),
(14, 'Nieves Snow Galvez', 'JOSEJHANELROSE@GMAIL.COM', '$2y$10$3yhPHnzQBnHgJTxlD5qC3ejaXQu5qrUVF5f1K.o4Z8djbIb7qbhJi', 'Costa Leona Balungao Pangasinan', '09763048088', 1, NULL, '2026-07-15 14:35:38'),
(15, 'Francine Riel', 'francineriel396@gmail.com', '$2y$10$1s8PfK5Vu9OVyZSV0uB9P.KOenT3ML/jFMxjo6pIJMrIxJ8hAH5na', 'Blk 9 Lot 29 Malipaka St Maligaya Park Novaliches Quezon City', '09944244253', 1, NULL, '2026-07-15 15:08:45'),
(16, 'Satifia ', 'satifia2026@gmail.com', '$2y$10$eJjPKeB.HDTIsE19UTIXdO.jCcgxkpAgHy3T4E9wm3FJMvdbk.nOK', 'Sampaloc, Manila', '09123456789', 1, NULL, '2026-07-16 14:33:54');

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`id`, `buyer_id`, `recipient_name`, `address`, `contact`, `email`, `payment_method`, `total`, `date_created`) VALUES
(1, 5, 'Sam Nieves', '589 Tanglaw, Barangka Drive', '09455269755', 'samnieves1206@gmail.com', 'Cash on Delivery (COD)', '1898.00', '2026-07-14 17:16:37'),
(2, 5, 'Sam Nieves', '589 Tanglaw, Barangka Drive', '09455269755', 'samnieves1206@gmail.com', 'Cash on Delivery (COD)', '949.00', '2026-07-14 17:43:21'),
(3, 5, 'Sam Nieves', '589 Tanglaw, Barangka Drive', '09455269755', 'samnieves1206@gmail.com', 'Cash on Delivery (COD)', '2499.00', '2026-07-15 14:30:20'),
(4, 15, 'Francine Riel', 'Blk 9 Lot 29 Malipaka St Maligaya Park Novaliches Quezon City', '09944244253', 'francineriel396@gmail.com', 'Cash on Delivery (COD)', '449.00', '2026-07-15 15:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_items`
--

CREATE TABLE `tblorder_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorder_items`
--

INSERT INTO `tblorder_items` (`id`, `order_id`, `product_name`, `price`, `qty`) VALUES
(1, 1, 'Floral Button Shirt', '799.00', 1),
(2, 1, 'Wide-Leg Linen Pants', '1099.00', 1),
(3, 2, 'Floral Button Shirt', '799.00', 1),
(4, 3, 'Trench Coat', '2499.00', 1),
(5, 4, 'Pearl Stud Earrings', '299.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(150) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `category`, `image`, `price`, `stock`, `date_created`) VALUES
(1, 'Linen Wrap Blouse', 'Tops', 'linen-wrap-blouse.jpg', '899.00', 15, '2026-06-21 11:13:39'),
(2, 'Floral Button Shirt', 'Tops', 'floral-button-shirt.jpg', '799.00', 18, '2026-06-21 11:13:39'),
(3, 'Ribbed Tank Top', 'Tops', 'ribbed-tank-top.jpg', '499.00', 30, '2026-06-21 11:13:39'),
(4, 'High-Waist Trousers', 'Bottoms', 'high-waist-trousers.jpg', '1199.00', 10, '2026-06-21 11:13:39'),
(5, 'Pleated Midi Skirt', 'Bottoms', 'pleated-midi-skirt.jpg', '999.00', 12, '2026-06-21 11:13:39'),
(6, 'Wide-Leg Linen Pants', 'Bottoms', 'wide-leg-linen-pants.jpg', '1099.00', 7, '2026-06-21 11:13:39'),
(7, 'Midi Sundress', 'Dresses', 'midi-sundress.jpg', '1499.00', 7, '2026-06-21 11:13:39'),
(8, 'Wrap Maxi Dress', 'Dresses', 'wrap-maxi-dress.jpg', '1699.00', 5, '2026-06-21 11:13:39'),
(9, 'Cropped Blazer', 'Outerwear', 'cropped-blazer.jpg', '1899.00', 6, '2026-06-21 11:13:39'),
(10, 'Trench Coat', 'Outerwear', 'trench-coat.png', '2499.00', 3, '2026-06-21 11:13:39'),
(11, 'Pearl Stud Earrings', 'Accessories', 'pearl-stud-earrings.jpg', '299.00', 49, '2026-06-21 11:13:39'),
(12, 'Canvas Tote Bag', 'Accessories', 'canvas-tote-bag.jpg', '599.00', 25, '2026-06-21 11:13:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmins`
--
ALTER TABLE `tbladmins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tblaudit_log`
--
ALTER TABLE `tblaudit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbuyers`
--
ALTER TABLE `tblbuyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmins`
--
ALTER TABLE `tbladmins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblaudit_log`
--
ALTER TABLE `tblaudit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblbuyers`
--
ALTER TABLE `tblbuyers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
