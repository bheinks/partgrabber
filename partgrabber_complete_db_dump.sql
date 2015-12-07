-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2015 at 06:32 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `partgrabber`
--

-- --------------------------------------------------------

--
-- Table structure for table `comp_case`
--

CREATE TABLE `comp_case` (
  `comp_id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `form_factor` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cpu`
--

CREATE TABLE `cpu` (
  `comp_id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `architecture` varchar(32) NOT NULL,
  `socket` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpu`
--

INSERT INTO `cpu` (`comp_id`, `name`, `manufacturer`, `architecture`, `socket`) VALUES
(1, 'i5', 'Intel', 'x86', 'LGA1155');

-- --------------------------------------------------------

--
-- Table structure for table `gpu`
--

CREATE TABLE `gpu` (
  `comp_id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `clock_speed` varchar(32) NOT NULL,
  `vram` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gpu`
--

INSERT INTO `gpu` (`comp_id`, `name`, `manufacturer`, `clock_speed`, `vram`) VALUES
(9, 'GTX 550', 'Nvidia', '951 MHz', '1 GB');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `motherboard`
--

CREATE TABLE `motherboard` (
  `comp_id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `form_factor` varchar(32) NOT NULL,
  `socket` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motherboard`
--

INSERT INTO `motherboard` (`comp_id`, `name`, `manufacturer`, `form_factor`, `socket`) VALUES
(3, 'GigaFire XI', 'Gigabyte', 'ATX', 'LGA1150'),
(5, 'GigaFire XII', 'Gigabyte', 'ATX', 'LGA1155');

-- --------------------------------------------------------

--
-- Table structure for table `psu`
--

CREATE TABLE `psu` (
  `comp_id` int(5) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `wattage` varchar(32) NOT NULL,
  `form_factor` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ram`
--

CREATE TABLE `ram` (
  `comp_id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `capacity` varchar(32) NOT NULL,
  `speed` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retailer`
--

CREATE TABLE `retailer` (
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saved_build`
--

CREATE TABLE `saved_build` (
  `username` varchar(32) NOT NULL,
  `build_name` varchar(32) NOT NULL,
  `description` varchar(256) NOT NULL,
  `cost` float(6,2) NOT NULL,
  `cpu_id` int(5) NOT NULL,
  `gpu_id` int(5) NOT NULL,
  `storage_id` int(5) NOT NULL,
  `ram_id` int(5) NOT NULL,
  `motherboard_id` int(5) NOT NULL,
  `case_id` int(5) NOT NULL,
  `psu_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_build`
--

INSERT INTO `saved_build` (`username`, `build_name`, `description`, `cost`, `cpu_id`, `gpu_id`, `storage_id`, `ram_id`, `motherboard_id`, `case_id`, `psu_id`) VALUES
('user1', 'My first build!', 'I built this!', 469.97, 2, 4, 0, 0, 6, 0, 0),
('user1', 'My other build!', 'I built this too! Its cool!', 224.99, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sold_by`
--

CREATE TABLE `sold_by` (
  `sold_id` int(5) NOT NULL,
  `retail_name` varchar(32) NOT NULL,
  `comp_id` int(5) NOT NULL,
  `price` float(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sold_by`
--

INSERT INTO `sold_by` (`sold_id`, `retail_name`, `comp_id`, `price`) VALUES
(1, 'Amazon', 1, 224.99),
(2, 'Newegg', 1, 239.99),
(4, 'eBay', 9, 89.99),
(5, 'NewEgg', 3, 129.99),
(6, 'NewEgg', 5, 139.99);

-- --------------------------------------------------------

--
-- Table structure for table `storage`
--

CREATE TABLE `storage` (
  `comp_id` int(5) NOT NULL,
  `name` varchar(32) NOT NULL,
  `manufacturer` varchar(32) NOT NULL,
  `capacity` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('user1', '1234'),
('user2', '5678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comp_case`
--
ALTER TABLE `comp_case`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `gpu`
--
ALTER TABLE `gpu`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `motherboard`
--
ALTER TABLE `motherboard`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `psu`
--
ALTER TABLE `psu`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `retailer`
--
ALTER TABLE `retailer`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `saved_build`
--
ALTER TABLE `saved_build`
  ADD PRIMARY KEY (`username`,`build_name`);

--
-- Indexes for table `sold_by`
--
ALTER TABLE `sold_by`
  ADD PRIMARY KEY (`sold_id`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comp_case`
--
ALTER TABLE `comp_case`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cpu`
--
ALTER TABLE `cpu`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gpu`
--
ALTER TABLE `gpu`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `motherboard`
--
ALTER TABLE `motherboard`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `psu`
--
ALTER TABLE `psu`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ram`
--
ALTER TABLE `ram`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sold_by`
--
ALTER TABLE `sold_by`
  MODIFY `sold_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `comp_id` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
