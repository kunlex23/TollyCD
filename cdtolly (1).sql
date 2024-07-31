-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2024 at 05:53 PM
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
(1, 'Joshua L', 'FREEZER', '53', '2', '0', '2', '2024-07-30 10:44:01'),
(2, 'Joshua L', 'FREEZER', '55', '4', '0', '5', '2024-07-30 10:44:44');

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
(2, 'Joshua L', '080646811510', '1234', 'ABCD', 'Joshua Isaac', '2024-07-10 11:55:06', ''),
(3, 'LOVE', '080', '1234', 'ABCD', 'qwerty', '2024-07-11 14:26:22', ''),
(4, 'Kazo Catherine', '0806468', '064024752', 'GTBank', 'Kazo Cathering', '2024-07-30 09:22:04', 'FCT');

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
  `accCaptain` varchar(100) NOT NULL,
  `accPartner` varchar(100) NOT NULL,
  `partnerReward` varchar(100) NOT NULL,
  `deliveryFee` varchar(100) NOT NULL,
  `riderReward` varchar(100) NOT NULL,
  `profitReward` varchar(100) NOT NULL,
  `partnerPayStatus` varchar(100) NOT NULL,
  `captainPayStatus` varchar(100) NOT NULL,
  `returnReason` varchar(255) NOT NULL,
  `payID` varchar(100) NOT NULL,
  `payID1` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gbigbe`
--

INSERT INTO `gbigbe` (`id`, `partner`, `shipmentType`, `product`, `availableUnit`, `quantity`, `unitPrice`, `amount`, `customersName`, `SOD`, `destination`, `customerContact`, `captain`, `status`, `paymentMethod`, `date`, `accCaptain`, `accPartner`, `partnerReward`, `deliveryFee`, `riderReward`, `profitReward`, `partnerPayStatus`, `captainPayStatus`, `returnReason`, `payID`, `payID1`) VALUES
(1, 'Joshua L', 'Delivery', 'FREEZER =2', '60 (2)', 'FREEZER =2', '', 120001, 'John Doe', 'FCT', 'Kuje', '08022222', 'Bryan', 'Completed', 'POS', '2024-07-31 14:01:29', 'beni', 'rara', '116000', '4000', '2400', '1600', 'rara', 'rara', '', '', ''),
(3, 'Joshua L', 'Waybill', 'FREEZER =1', '58 (1)', 'FREEZER =1', '', 0, 'John Doe', '', 'Adamawa', '08022222', '', 'Completed', '', '2024-07-31 14:01:14', 'beni', 'rara', '3600.00', '3600.00', '2000', '1600', 'rara', 'rara', '', '', ''),
(4, 'LOVE', 'Waybill', 'Lotion =2, BlueSIL =2, BlueSIL =2', '85 (2), 477 (2), 477 (2)', 'Lotion =2, BlueSIL =2, BlueSIL =2', '', 0, 'Joshua', '', 'Akwa Ibom', '08022222', '', 'Return', '', '2024-07-31 11:58:55', 'rara', 'rara', '4000.00', '4000.00', '2400', '1600', 'rara', 'rara', 'no car', '', ''),
(5, 'LOVE', 'Waybill', 'BlueSIL =2', '477 (2)', 'BlueSIL =2', '', 0, 'John Doe', '', 'FCT', '080', '', 'Sent', '', '2024-07-31 13:44:40', 'rara', 'rara', '5000.00', '5000.00', '3000', '2000', 'rara', 'rara', '', '', ''),
(6, 'Joshua L', 'Delivery', 'FREEZER =1', '57 (1)', 'FREEZER =1', '', 178000, 'John Doe', 'FCT', 'Kuje', '08022222', 'Bryan', 'Return', '', '2024-07-31 13:48:23', 'rara', 'rara', '174000', '4000', '2400', '1600', 'rara', 'rara', 'no reason', '', ''),
(7, 'LOVE', 'Delivery', 'BlueSIL =1', '475 (1)', 'BlueSIL =1', '', 10000, 'Joshua', 'FCT', 'Kuje', '080111111111111', 'Captai', 'Completed', 'POS', '2024-07-31 14:31:50', 'beni', 'rara', '6000', '4000', '2400', '1600', 'beni', 'rara', '', '1722436310212435791', ''),
(8, 'LOVE', 'Delivery', 'BlueSIL =1', '474 (1)', 'BlueSIL =1', '', 12000, 'John Doe', 'FCT', 'Lokogoma', '08033333333', 'Bryan', 'Pending', '', '2024-07-31 13:52:16', 'rara', 'rara', '8500', '3500', '1500', '2000', 'rara', 'rara', '', '', '');

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

--
-- Dumping data for table `inawo`
--

INSERT INTO `inawo` (`id`, `name`, `purpose`, `amount`, `approvedBy`, `date`) VALUES
(1, 'Glory', 'Utility', '2500', 'Blessing', '2024-07-12 10:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `ninawo`
--

CREATE TABLE `ninawo` (
  `id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `partnerPrice` varchar(100) NOT NULL,
  `dispatcherPrice` varchar(100) NOT NULL,
  `profit` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ninawo`
--

INSERT INTO `ninawo` (`id`, `location`, `partnerPrice`, `dispatcherPrice`, `profit`, `date`) VALUES
(1, 'Lugbe', '6000', '1500', '4500', '2024-07-11 11:42:42'),
(2, 'Kuje', '4000', '2400', '1600', '2024-07-10 09:23:01'),
(3, 'Lokogoma', '3500', '1500', '2000', '2024-07-11 10:03:36'),
(4, 'Lugbe', '6000', '1500', '4500', '2024-07-11 11:42:42'),
(5, 'Area 1', '5000', '3000', '2000.00', '2024-07-11 10:22:59'),
(6, 'Area 11', '5000', '3000', '2000.00', '2024-07-11 10:22:59');

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
(1, 'Captai', '089', 'mara1', '123451', 'CAPTAIN1', 'bank1', 'fName1', '07031', 'nya1', 'worker', 'brother1.', '2024-07-18 13:43:24'),
(3, 'Bryan', '0903', 'Area 1', '123', 'Bryan', 'Access', 'Goriola Olawuwo', '0703', 'Garki 2', 'Civil servant', 'Uncle', '2024-07-29 11:58:50');

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

--
-- Dumping data for table `owoalabasepohistory`
--

INSERT INTO `owoalabasepohistory` (`id`, `partner`, `totalAmount`, `accountNumber`, `bank`, `accountName`, `date`, `payID`) VALUES
(1, 'LOVE', '6000', '1234', 'ABCD', 'qwerty', '2024-07-31 14:31:50', '1722436310212435791');

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
(1, 'Joshua L', 'FREEZER', '57', '2024-07-31 13:48:23'),
(2, 'LOVE', 'Lotion', '85', '2024-07-31 11:58:55'),
(3, 'LOVE', 'BlueSIL', '473', '2024-07-31 13:52:16'),
(4, 'LOVE', 'Soul Mate', '338', '2024-07-30 11:58:14');

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
(1, 'Joshua', 'ade', 'a562cfa07c2b1213b3a5c99b756fc206', 'olowo', '2024-07-11 14:38:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `afikun`
--
ALTER TABLE `afikun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alabasepo`
--
ALTER TABLE `alabasepo`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `alabasepo`
--
ALTER TABLE `alabasepo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gbigbe`
--
ALTER TABLE `gbigbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inawo`
--
ALTER TABLE `inawo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ninawo`
--
ALTER TABLE `ninawo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `others_gifts`
--
ALTER TABLE `others_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `owoalabasepohistory`
--
ALTER TABLE `owoalabasepohistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
