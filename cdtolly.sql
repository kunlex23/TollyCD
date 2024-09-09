-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 05:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdtolly`
--

-- --------------------------------------------------------

--
-- Table structure for table `afikun`
--

CREATE TABLE `afikun` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `oQuantity` varchar(100) NOT NULL,
  `rQuantity` varchar(100) NOT NULL,
  `bQuantity` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `afikun`
--

INSERT INTO `afikun` (`id`, `partner`, `productName`, `oQuantity`, `rQuantity`, `bQuantity`, `quantity`, `date`) VALUES
(2, 'Anagkazo Engineering', '6m DC cable', '0', '500', '2', '488', '2024-09-09 11:37:52'),
(3, 'Anagkazo Engineering', 'Luminous Inverter', '0', '10', '1', '9', '2024-09-09 11:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`id`, `fullname`, `contact`, `date`) VALUES
(4, 'Olu', '4232', '2024-09-09 15:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `alabasepo`
--

CREATE TABLE `alabasepo` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `accountNumber` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alabasepo`
--

INSERT INTO `alabasepo` (`id`, `Name`, `contact`, `accountNumber`, `bank`, `accountName`, `date`, `location`) VALUES
(3, 'LOVE', '08064681151', '0640247529', 'GTBank', 'LOVE', '2024-09-09 10:06:47', 'FCT'),
(4, 'Anagkazo Engineering', '08064681151', '0640247529', 'GTBank', 'Anagkazo Engineering LTD', '2024-09-09 10:07:07', 'FCT');

-- --------------------------------------------------------

--
-- Table structure for table `eru`
--

CREATE TABLE `eru` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `ilu` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gbigbe`
--

CREATE TABLE `gbigbe` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `shipmentType` varchar(100) NOT NULL,
  `product` varchar(255) NOT NULL,
  `availableUnit` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `unitPrice` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `customersName` varchar(100) NOT NULL,
  `SOD` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `customerContact` varchar(100) NOT NULL,
  `captain` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `partnerRemitance` varchar(255) NOT NULL DEFAULT 'rara',
  `accCaptain` varchar(100) NOT NULL,
  `accPartner` varchar(100) NOT NULL,
  `partnerReward` varchar(100) NOT NULL,
  `deliveryFee` varchar(100) NOT NULL,
  `riderReward` varchar(100) NOT NULL,
  `profitReward` varchar(100) NOT NULL,
  `partnerPayStatus` varchar(100) NOT NULL,
  `captainPayStatus` varchar(100) NOT NULL,
  `returnReason` varchar(255) NOT NULL,
  `remitanceKind` varchar(100) NOT NULL DEFAULT 'NORMs',
  `agentName` varchar(100) NOT NULL,
  `agentContact` varchar(100) NOT NULL,
  `park` varchar(100) NOT NULL,
  `payID` varchar(100) NOT NULL,
  `payID1` varchar(255) NOT NULL,
  `payID2` varchar(255) NOT NULL,
  `payID3` varchar(255) NOT NULL,
  `payID4` varchar(100) NOT NULL,
  `payID5` varchar(100) NOT NULL,
  `createdBy` varchar(100) NOT NULL,
  `editedBy` varchar(100) NOT NULL,
  `recalledBy` varchar(100) NOT NULL,
  `confirmedBy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gbigbe`
--

INSERT INTO `gbigbe` (`id`, `partner`, `shipmentType`, `product`, `availableUnit`, `quantity`, `unitPrice`, `amount`, `customersName`, `SOD`, `destination`, `customerContact`, `captain`, `status`, `paymentMethod`, `date`, `partnerRemitance`, `accCaptain`, `accPartner`, `partnerReward`, `deliveryFee`, `riderReward`, `profitReward`, `partnerPayStatus`, `captainPayStatus`, `returnReason`, `remitanceKind`, `agentName`, `agentContact`, `park`, `payID`, `payID1`, `payID2`, `payID3`, `payID4`, `payID5`, `createdBy`, `editedBy`, `recalledBy`, `confirmedBy`) VALUES
(35, 'Anagkazo Engineering', 'Delivery', '350W Solar Panel =1', '8 (1)', '350W Solar Panel =1', '', 120000, 'Tolani', 'Abia', 'Kuje', '08033333333', 'Oliver', 'Completed', 'POS', '2024-09-09 15:13:34', 'rara', 'beni', 'rara', '115000', '5000.00', '2000', '3000.00', 'rara', 'rara', '', 'NORMs', '', '', '', '', '', '', '', '', '', 'gbenga (Admin)', '', 'gbenga (Admin)', 'gbenga (Admin)'),
(36, 'LOVE', 'Waybill', 'Lotion =1', '100 (1)', 'Lotion =1', '', 0, 'Tolani', '', 'Benue', '08033333333', '', 'Sent', '', '2024-09-09 15:22:50', 'rara', 'rara', 'rara', '', '3000.00', '2000', '1000', 'rara', 'rara', '', 'NORMs', 'Audu', '080', 'Jabi', '', '', '', '', '', '', 'gbenga (Admin)', '', '', ''),
(37, 'LOVE', 'Delivery', 'Lotion =1', '99 (5)', 'Lotion =5', '', 70000, 'Tope', 'FCT', 'Lugbe', '08033333333', 'Oliver', 'Completed', 'POS', '2024-09-09 15:49:33', 'rara', 'beni', 'rara', '66000', '4000.00', '2000', '2000.00', 'rara', 'rara', '', 'NORMs', '', '', '', '', '', '', '', '', '', 'gbenga (Admin)', 'gbenga (Admin)', 'gbenga (Admin)', 'gbenga (Admin)');

-- --------------------------------------------------------

--
-- Table structure for table `inawo`
--

CREATE TABLE `inawo` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `approvedBy` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ninawo`
--

CREATE TABLE `ninawo` (
  `id` int(11) NOT NULL,
  `sod` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `partnerPrice` varchar(100) NOT NULL,
  `dispatcherPrice` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ninawo`
--

INSERT INTO `ninawo` (`id`, `sod`, `location`, `partnerPrice`, `dispatcherPrice`, `profit`, `date`) VALUES
(6, 'FCT', 'Lugbe', '4000.00', '2000', '2000.00', '2024-09-09 14:06:54'),
(7, 'Abia', 'Kuje', '5000.00', '2000', '3000.00', '2024-09-09 14:07:27'),
(8, 'Akwa Ibom', 'ulu', '6000', '2000', '4000', '2024-09-09 14:14:15'),
(9, 'Zamfara', 'izo', '4000.00', '1500', '2500.00', '2024-09-09 14:15:25'),
(10, 'FCT', 'Kuje', '5000.00', '2000', '3000.00', '2024-09-09 14:21:39');

-- --------------------------------------------------------

--
-- Table structure for table `olokadahistory`
--

CREATE TABLE `olokadahistory` (
  `id` int(11) NOT NULL,
  `captain` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `accountNumber` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oluwa`
--

CREATE TABLE `oluwa` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `accountNumber` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `bankName` varchar(100) NOT NULL,
  `gFullname` varchar(100) NOT NULL,
  `gContact` varchar(100) NOT NULL,
  `gAddress` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oluwa`
--

INSERT INTO `oluwa` (`id`, `fullname`, `contact`, `Address`, `accountNumber`, `accountName`, `bankName`, `gFullname`, `gContact`, `gAddress`, `occupation`, `relationship`, `date`) VALUES
(1, 'Oliver', '090', 'Nynanya', '090', '1233', 'ere', 'ewww', '121', 'www', 'wwww', 'wwww', '2024-08-22 12:30:54'),
(2, 'Peter', '090', 'Jabi', '090', '1233', 'ere', 'ewww', '121', 'www', 'wwww', 'wwww', '2024-08-22 12:46:58'),
(3, 'John', '08111', 'Masaka', '111111111111', '111111', 'eco', 'johnn', '7777', 'wuye', 'student', 'sister', '2024-09-06 14:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `onahistory`
--

CREATE TABLE `onahistory` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `totalAmount` varchar(100) NOT NULL,
  `payID` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `others_gifts`
--

CREATE TABLE `others_gifts` (
  `id` int(11) NOT NULL,
  `fromW` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owoalabasepohistory`
--

CREATE TABLE `owoalabasepohistory` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `totalAmount` varchar(100) NOT NULL,
  `accountNumber` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owoalabasepohistory2`
--

CREATE TABLE `owoalabasepohistory2` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `totalAmount` varchar(100) NOT NULL,
  `accountNumber` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `payID` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owoalabasepowahistory`
--

CREATE TABLE `owoalabasepowahistory` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `totalAmount` varchar(100) NOT NULL,
  `payID` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owoalabasepowawhistory`
--

CREATE TABLE `owoalabasepowawhistory` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `totalAmount` varchar(100) NOT NULL,
  `payID` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `partner`, `productName`, `quantity`, `date`) VALUES
(3, 'LOVE', 'Lotion', '98', '2024-09-09 15:49:15'),
(4, 'Anagkazo Engineering', '350W Solar Panel', '7', '2024-09-09 15:05:01'),
(5, 'Anagkazo Engineering', '6m DC cable', '488', '2024-09-09 11:37:52'),
(6, 'Anagkazo Engineering', 'Luminous Inverter', '9', '2024-09-09 11:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userId`, `password`, `userType`, `date`) VALUES
(5, 'gbenga', 'gb', '202cb962ac59075b964b07152d234b70', 'Admin', '2024-08-10 08:48:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `afikun`
--
ALTER TABLE `afikun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alabasepo`
--
ALTER TABLE `alabasepo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eru`
--
ALTER TABLE `eru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gbigbe`
--
ALTER TABLE `gbigbe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inawo`
--
ALTER TABLE `inawo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ninawo`
--
ALTER TABLE `ninawo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olokadahistory`
--
ALTER TABLE `olokadahistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oluwa`
--
ALTER TABLE `oluwa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `onahistory`
--
ALTER TABLE `onahistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others_gifts`
--
ALTER TABLE `others_gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owoalabasepohistory`
--
ALTER TABLE `owoalabasepohistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owoalabasepohistory2`
--
ALTER TABLE `owoalabasepohistory2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owoalabasepowahistory`
--
ALTER TABLE `owoalabasepowahistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owoalabasepowawhistory`
--
ALTER TABLE `owoalabasepowawhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `afikun`
--
ALTER TABLE `afikun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alabasepo`
--
ALTER TABLE `alabasepo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `eru`
--
ALTER TABLE `eru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gbigbe`
--
ALTER TABLE `gbigbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `inawo`
--
ALTER TABLE `inawo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ninawo`
--
ALTER TABLE `ninawo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `olokadahistory`
--
ALTER TABLE `olokadahistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oluwa`
--
ALTER TABLE `oluwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `onahistory`
--
ALTER TABLE `onahistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others_gifts`
--
ALTER TABLE `others_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owoalabasepohistory`
--
ALTER TABLE `owoalabasepohistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owoalabasepohistory2`
--
ALTER TABLE `owoalabasepohistory2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owoalabasepowahistory`
--
ALTER TABLE `owoalabasepowahistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owoalabasepowawhistory`
--
ALTER TABLE `owoalabasepowawhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
