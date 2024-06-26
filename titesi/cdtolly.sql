-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 11:11 PM
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
-- Table structure for table `alabasepo`
--

CREATE TABLE `alabasepo` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `accountNumber` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `accountName` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alabasepo`
--

INSERT INTO `alabasepo` (`id`, `Name`, `contact`, `accountNumber`, `bank`, `accountName`, `date`) VALUES
(19, 'Anagkazo Engineering', '0806468115', '064024752', 'GTBank 4', 'Anagkazo Engineering LTD', '2024-06-25 19:51:37'),
(20, 'Google', '08063478720', '0640247529', 'ACCESS', 'Google LTD', '2024-06-25 21:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `gbigbe`
--

CREATE TABLE `gbigbe` (
  `id` int(11) NOT NULL,
  `partner` varchar(100) NOT NULL,
  `product` varchar(100) NOT NULL,
  `availableUnit` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `unitPrice` varchar(100) NOT NULL,
  `amount` int(100) NOT NULL,
  `customersName` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `customerContact` varchar(100) NOT NULL,
  `captain` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `paymentMethod` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gbigbe`
--

INSERT INTO `gbigbe` (`id`, `partner`, `product`, `availableUnit`, `quantity`, `unitPrice`, `amount`, `customersName`, `destination`, `customerContact`, `captain`, `status`, `paymentMethod`, `date`) VALUES
(1, 'Anagkazo Engineering', '350W Solar Panel', '50', '2', '100', 200, 'Joshua.', 'maraba', '080', 'Mike', 'pending', 'cash', '2024-06-26 20:56:38'),
(2, 'Anagkazo Engineering', '350W Solar Panel', '50', '2', '100', 200, 'Joshua.', 'maraba', '080', 'Mike', 'pending', 'cash', '2024-06-26 21:08:12'),
(3, 'Google', 'Google Dongle', '10', '2', '100', 200, 'Joshua.', 'maraba', '080', 'Mike', 'pending', 'cash', '2024-06-26 21:09:31');

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
(1, 'Anagkazo Engineering', 'FREEZER', '8', '2024-06-25 19:53:34'),
(2, 'Anagkazo Engineering', '350W Solar Panel', '50', '2024-06-25 19:49:04'),
(3, 'Anagkazo Engineering', '2KVA Inverter', '10', '2024-06-25 19:49:04'),
(4, 'Anagkazo Engineering', '100A Charge Controller', '5', '2024-06-25 19:49:04'),
(5, 'Google', 'Google Dongle', '10', '2024-06-25 21:55:09');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gbigbe`
--
ALTER TABLE `gbigbe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
