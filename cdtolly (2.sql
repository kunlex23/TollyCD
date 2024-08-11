-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 11:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alabasepo`
--

INSERT INTO `alabasepo` (`id`, `Name`, `contact`, `accountNumber`, `bank`, `accountName`, `date`, `location`) VALUES
(2, 'Joshua L', '080646811510', '1234', 'ABCD', 'Joshua Isaac', '2024-07-10 11:55:06', ''),
(3, 'LOVE', '080', '1234', 'ABCD', 'qwerty', '2024-07-11 14:26:22', ''),
(4, 'Kazo Catherine', '0806468', '064024752', 'GTBank', 'Kazo Cathering', '2024-07-30 09:22:04', 'FCT');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eru`
--

INSERT INTO `eru` (`id`, `partner`, `productName`, `qty`, `ilu`, `date`) VALUES
(1, 'Partner1', '32GB hard Drive', '2', 'FCT', '2024-08-10 00:37:14'),
(2, 'Partner2', 'Techno C8', '3', 'Plateau', '2024-08-10 00:37:18'),
(3, 'Partner1', 'Hard Drive enclosure', '4', 'FCT', '2024-08-10 00:45:44'),
(4, 'Partner1', '32GB hard Drive', '4', 'FCT', '2024-08-10 00:46:54');

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
  `payID` varchar(100) NOT NULL,
  `payID1` varchar(255) NOT NULL,
  `payID2` varchar(255) NOT NULL,
  `payID3` varchar(255) NOT NULL,
  `payID4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gbigbe`
--

INSERT INTO `gbigbe` (`id`, `partner`, `shipmentType`, `product`, `availableUnit`, `quantity`, `unitPrice`, `amount`, `customersName`, `SOD`, `destination`, `customerContact`, `captain`, `status`, `paymentMethod`, `date`, `partnerRemitance`, `accCaptain`, `accPartner`, `partnerReward`, `deliveryFee`, `riderReward`, `profitReward`, `partnerPayStatus`, `captainPayStatus`, `returnReason`, `remitanceKind`, `payID`, `payID1`, `payID2`, `payID3`, `payID4`) VALUES
(1, 'Joshua L', 'Delivery', 'FREEZER =1', '41 (1)', 'FREEZER =1', '', 89000, 'Joshua Isaac', 'FCT', 'Kuje', '08033333333', 'Bryan', 'Completed', 'Cheque', '2024-08-11 08:51:47', 'beni', 'beni', 'rara', '85000', '4000', '2400', '1600', 'beni', 'beni', '', 'M2TCD', '', '1723366307728953786', '17232332040673382840', '', ''),
(2, 'Joshua L', 'Delivery', 'FREEZER =2', '40 (2)', 'FREEZER =2', '', 89000, 'Joshua Isaac', 'FCT', 'Kuje', '080111111111111', 'Captai', 'Completed', 'Cash', '2024-08-11 08:51:40', 'rara', 'beni', 'rara', '85000', '4000', '2400', '1600', 'beni', 'beni', '', 'NORMs', '1723233506195304906', '17233663000586657677', '', '', ''),
(3, 'LOVE', 'Delivery', 'Lotion =2', '75 (2)', 'Lotion =2', '', 120000, 'Joshua Isaac', 'FCT', 'Area 11', '080111111111111', 'Bryan', 'Completed', 'POS', '2024-08-11 08:51:47', 'rara', 'beni', 'rara', '115000', '5000', '3000', '2000.00', 'beni', 'beni', '', 'NORMs', '17232334812759880223', '1723366307728953786', '', '', ''),
(4, 'LOVE', 'Delivery', 'BlueSIL =2', '458 (2)', 'BlueSIL =2', '', 89000, 'Joshua', 'FCT', 'Kuje', '08033333333', 'Bryan', 'Completed', 'POS', '2024-08-09 23:09:50', 'beni', 'beni', 'rara', '85000', '4000', '2400', '1600', 'beni', 'beni', '', 'WP2P', '', '1723244990812357818', '', '', '1723239207866453177'),
(5, 'Kazo Catherine', 'Delivery', '65KG Cooking gas cylinder =1', '88 (1)', '65KG Cooking gas cylinder =1', '', 267000, 'Tolani', 'FCT', 'Lugbe', '08044444444', 'Bryan', 'Completed', 'POS', '2024-08-09 23:10:34', 'beni', 'beni', 'rara', '261000', '6000', '1500', '4500', 'beni', 'beni', '', 'WP2P', '', '17232450340705467245', '', '', '17232395927403203966'),
(6, 'Kazo Catherine', 'Delivery', '65KG Cooking gas cylinder =1', '87 (1)', '65KG Cooking gas cylinder =1', '', 89000, 'John Doe', 'FCT', 'Lugbe', '08044444444', 'Bryan', 'Completed', 'Cash', '2024-08-11 08:51:47', 'beni', 'beni', 'rara', '83000', '6000', '1500', '4500', 'beni', 'beni', '', 'M2TCD', '', '1723366307728953786', '1723233213375286660', '', ''),
(7, 'LOVE', 'Delivery', 'Lotion =1', '73 (1)', 'Lotion =1', '', 12000, 'Joshua Isaac', 'FCT', 'Lugbe', '08033333333', 'Bryan', 'Completed', 'Cash', '2024-08-11 08:51:47', 'beni', 'beni', 'rara', '6000', '6000', '1500', '4500', 'beni', 'beni', '', 'M2TCD', '', '1723366307728953786', '17232352812695901499', '', ''),
(8, 'LOVE', 'Delivery', 'BlueSIL =2', '456 (2)', 'BlueSIL =2', '', 89000, 'Tolani', 'FCT', 'Area 1', '08044444444', 'Captai', 'Completed', 'Transfer', '2024-08-11 08:51:40', 'beni', 'beni', 'rara', '84000', '5000', '3000', '2000.00', 'beni', 'beni', '', 'M2TCD', '', '17233663000586657677', '17232352812695901499', '', ''),
(9, 'LOVE', 'Delivery', 'BlueSIL =1', '454 (1)', 'BlueSIL =1', '', 120000, 'Tolani', 'FCT', 'Lokogoma', '08033333333', 'Bryan', 'Completed', 'Cash', '2024-08-09 23:09:50', 'beni', 'beni', 'rara', '116500', '3500', '1500', '2000', 'beni', 'beni', '', 'WP2P', '', '1723244990812357818', '', '', '1723239207866453177'),
(10, 'Kazo Catherine', 'Waybill', '65KG Cooking gas cylinder =2', '86 (2)', '65KG Cooking gas cylinder =2', '', 0, 'Joshua Isaac', '', 'Bayelsa', '08044444444', '', 'Completed', '', '2024-08-11 04:42:33', 'rara', 'rara', 'rara', '4600.00', '4600.00', '3000', '1600', 'rara', 'beni', '', 'NORMs', '17233513535026806106', '', '', '', ''),
(11, 'Joshua L', 'Delivery', 'FREEZER =1', '38 (1)', 'FREEZER =1', '', 120000, 'Joshua Isaac', 'FCT', 'Kuje', '08033333333', 'Captai', 'Pending', '', '2024-08-11 09:32:31', 'rara', 'rara', 'rara', '116000', '4000', '2400', '1600', 'rara', 'rara', '', 'NORMs', '', '', '', '', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inawo`
--

INSERT INTO `inawo` (`id`, `name`, `purpose`, `amount`, `approvedBy`, `date`) VALUES
(1, 'Glory', 'Utility', '2500', 'Blessing', '2024-07-12 10:07:59'),
(2, 'Mike', 'Fuel', '6000', 'Grace', '2024-08-11 08:17:45');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `olokadahistory`
--

INSERT INTO `olokadahistory` (`id`, `captain`, `amount`, `accountNumber`, `bank`, `accountName`, `date`, `payID`) VALUES
(1, 'Captai', '3000', '123451', 'bank1', 'CAPTAIN1', '2024-08-08 23:00:25', '17231580255679502177'),
(2, 'Bryan', '1500', '123', 'Access', 'Bryan', '2024-08-08 23:00:30', '17231580302701757087'),
(3, 'Captai', '5400', '123451', 'bank1', 'CAPTAIN1', '2024-08-11 08:51:40', '17233663000586657677'),
(4, 'Bryan', '8400', '123', 'Access', 'Bryan', '2024-08-11 08:51:47', '1723366307728953786');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `others_gifts`
--

INSERT INTO `others_gifts` (`id`, `fromW`, `amount`, `purpose`, `date`) VALUES
(1, 'Joshua', '267000', 'gift', '2024-08-11 04:40:11'),
(2, 'Kazo', '89000', 'gift', '2024-08-11 04:40:34');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owoalabasepohistory`
--

INSERT INTO `owoalabasepohistory` (`id`, `partner`, `totalAmount`, `accountNumber`, `bank`, `accountName`, `date`, `payID`) VALUES
(1, 'LOVE', '115000', '1234', 'ABCD', 'qwerty', '2024-08-09 19:58:01', '17232334812759880223'),
(2, 'Joshua L', '85000', '1234', 'ABCD', 'Joshua Isaac', '2024-08-09 19:58:26', '1723233506195304906');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owoalabasepohistory2`
--

INSERT INTO `owoalabasepohistory2` (`id`, `partner`, `totalAmount`, `accountNumber`, `bank`, `accountName`, `payID`, `date`) VALUES
(1, 'LOVE', '209000', '1234', 'ABCD', 'qwerty', '1723244990812357818', '2024-08-09 23:09:50'),
(2, 'Kazo Catherine', '267000', '064024752', 'GTBank', 'Kazo Cathering', '17232450340705467245', '2024-08-09 23:10:34');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owoalabasepowahistory`
--

INSERT INTO `owoalabasepowahistory` (`id`, `partner`, `totalAmount`, `payID`, `date`) VALUES
(1, 'Joshua L', '4000', '17232332040673382840', '2024-08-09 19:53:24'),
(2, 'Kazo Catherine', '6000', '1723233213375286660', '2024-08-09 19:53:33'),
(3, 'LOVE', '11000', '17232352812695901499', '2024-08-09 20:28:01'),
(4, 'LOVE', '7500', '1723239207866453177', '2024-08-09 21:33:27');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owoalabasepowawhistory`
--

INSERT INTO `owoalabasepowawhistory` (`id`, `partner`, `totalAmount`, `payID`, `date`) VALUES
(1, 'Kazo Catherine', '6000', '17232395927403203966', '2024-08-09 21:39:52');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `partner`, `productName`, `quantity`, `date`) VALUES
(1, 'Joshua L', 'FREEZER', '37', '2024-08-11 09:32:31'),
(2, 'LOVE', 'Lotion', '72', '2024-08-09 20:21:20'),
(3, 'LOVE', 'BlueSIL', '453', '2024-08-09 21:21:58'),
(4, 'LOVE', 'Soul Mate', '286', '2024-08-07 10:12:04'),
(5, 'Kazo Catherine', '65KG Cooking gas cylinder', '84', '2024-08-11 04:42:06');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userId`, `password`, `userType`, `date`) VALUES
(2, 'Joshua', 'joshua', '827ccb0eea8a706c4c34a16891f84e7b', 'Admin', '2024-08-10 09:11:19'),
(3, 'Adeola', 'adeola', '827ccb0eea8a706c4c34a16891f84e7b', 'Data_Entry', '2024-08-10 09:23:32'),
(4, 'vincent', 'vincent', '827ccb0eea8a706c4c34a16891f84e7b', 'Inventory', '2024-08-10 09:38:57'),
(5, 'gbenga', 'gb', '202cb962ac59075b964b07152d234b70', 'Admin', '2024-08-10 09:48:19'),
(6, 'mike', 'mi', '202cb962ac59075b964b07152d234b70', 'Accountant', '2024-08-10 09:48:35');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inawo`
--
ALTER TABLE `inawo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ninawo`
--
ALTER TABLE `ninawo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `olokadahistory`
--
ALTER TABLE `olokadahistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oluwa`
--
ALTER TABLE `oluwa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `others_gifts`
--
ALTER TABLE `others_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owoalabasepohistory`
--
ALTER TABLE `owoalabasepohistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owoalabasepohistory2`
--
ALTER TABLE `owoalabasepohistory2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owoalabasepowahistory`
--
ALTER TABLE `owoalabasepowahistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `owoalabasepowawhistory`
--
ALTER TABLE `owoalabasepowawhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
