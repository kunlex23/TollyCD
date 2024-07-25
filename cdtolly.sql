-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 05:59 PM
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
-- Table structure for table `alabasepo`
--

CREATE TABLE `alabasepo` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `accountNumber` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `accountName` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alabasepo`
--

INSERT INTO `alabasepo` (`id`, `Name`, `contact`, `accountNumber`, `bank`, `accountName`, `date`) VALUES
(2, 'Joshua L', '080646811510', '1234', 'ABCD', 'Joshua Isaac', '2024-07-10 11:55:06'),
(3, 'LOVE', '080', '1234', 'ABCD', 'qwerty', '2024-07-11 14:26:22');

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
  `riderReward` varchar(100) NOT NULL,
  `profitReward` varchar(100) NOT NULL,
  `partnerPayStatus` varchar(100) NOT NULL,
  `captainPayStatus` varchar(100) NOT NULL,
  `returnReason` varchar(255) NOT NULL,
  `payID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gbigbe`
--

INSERT INTO `gbigbe` (`id`, `partner`, `shipmentType`, `product`, `availableUnit`, `quantity`, `unitPrice`, `amount`, `customersName`, `SOD`, `destination`, `customerContact`, `captain`, `status`, `paymentMethod`, `date`, `accCaptain`, `accPartner`, `partnerReward`, `riderReward`, `profitReward`, `partnerPayStatus`, `captainPayStatus`, `returnReason`, `payID`) VALUES
(30, 'LOVE', 'Delivery', 'Lotion', '100', '1', '', 178000, 'Joshua Isaac', '', 'Lokogoma', '080', 'Captai', 'Completed', 'Transfer', '2024-07-24 10:05:21', 'beni', 'rara', '174500', '1500', '2000', 'rara', 'rara', '', ''),
(31, 'Joshua L', 'Delivery', 'FREEZER', '69', '1', '', 178000, 'Joshua Isaac', '', 'Lokogoma', '080', 'Bryan', 'Completed', 'POS', '2024-07-24 13:42:12', 'beni', 'rara', '174500', '1500', '2000', 'rara', 'rara', '', ''),
(32, 'LOVE', 'Delivery', 'BlueSIL', '500', '1', '', 178000, 'Joshua Isaac', '', 'Lugbe', '080', 'Bryan', 'Completed', 'POS', '2024-07-24 13:42:06', 'beni', 'rara', '172000', '1500', '4500', 'rara', 'rara', '', ''),
(33, 'Joshua L', 'Delivery', 'FREEZER', '68', '1', '', 178000, 'Joshua Isaac', '', 'Lokogoma', '080', 'Bryan', 'Pending', '', '2024-07-24 12:01:00', 'rara', 'rara', '174500', '1500', '2000', 'rara', 'rara', '', '');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(3, 'Bryan', '0903', 'Area 1', '12345', 'Bryan', 'Access', 'Goriola Olawuwo', '0703', 'Garki 2', 'Civil servant', 'Uncle', '2024-07-18 13:43:10');

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

--
-- Dumping data for table `others_gifts`
--

INSERT INTO `others_gifts` (`id`, `fromW`, `amount`, `purpose`, `date`) VALUES
(1, 'Joshua', '10000000', 'gift', '2024-07-12 10:57:20'),
(2, 'Joshua', '178000', 'Petrol', '2024-07-12 10:58:30');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owoalabasepohistory`
--

INSERT INTO `owoalabasepohistory` (`id`, `partner`, `totalAmount`, `accountNumber`, `bank`, `accountName`, `date`) VALUES
(1, 'Joshua L', '173000', '1234', 'ABCD', 'Joshua Isaac', '2024-07-11 11:46:38');

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
(1, 'Joshua L', 'FREEZER', '67', '2024-07-24 12:01:00'),
(2, 'LOVE', 'Lotion', '99', '2024-07-18 15:48:47'),
(3, 'LOVE', 'BlueSIL', '499', '2024-07-24 09:51:10'),
(4, 'LOVE', 'Soul Mate', '400', '2024-07-11 14:32:40');

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
-- AUTO_INCREMENT for table `alabasepo`
--
ALTER TABLE `alabasepo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gbigbe`
--
ALTER TABLE `gbigbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
