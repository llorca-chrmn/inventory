-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 02:42 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory-system`
--

CREATE Database `inventory-system`;
-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE `computer` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `row` varchar(50) NOT NULL,
  `hostname` varchar(50) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `motherboard` varchar(100) NOT NULL,
  `processor` varchar(100) NOT NULL,
  `VDCard` varchar(100) NOT NULL,
  `space` varchar(100) NOT NULL,
  `remarks` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RAM_model` char(50) DEFAULT NULL,
  `diskDrive_model` char(50) DEFAULT NULL,
  `Laptop_model` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `computers_peripherals`
--

CREATE TABLE `computers_peripherals` (
  `id` int(11) NOT NULL,
  `computer_id` int(11) DEFAULT NULL,
  `peripheral_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `space` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `computer_id` int(11) DEFAULT NULL,
  `peripheral_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peripheral`
--

CREATE TABLE `peripheral` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(50) NOT NULL,
  `deployed` int(11) NOT NULL,
  `defected` int(11) NOT NULL,
  `spare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peripheral`
--

INSERT INTO `peripheral` (`id`, `asset_name`, `deployed`, `defected`, `spare`) VALUES
(1, 'Keyboard', 0, 0, 0),
(2, 'Mouse', 0, 0, 0),
(3, 'Processor', 0, 0, 0),
(4, 'Motherboard', 0, 0, 0),
(5, 'Video Card', 0, 0, 0),
(6, 'Diskdrive', 0, 0, 0),
(7, 'RAM', 0, 0, 0),
(8, 'Laptop', 0, 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `peripheral_info`
--

CREATE TABLE `peripheral_info` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `port_type` varchar(50) NOT NULL,
  `remarks` text,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `peripheral_id` int(11) DEFAULT NULL,
  `unit_cost` decimal(19,2) NOT NULL,
  `active_type` enum('spare','defected','deployed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `usertype` enum('Admin','User') NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userinfo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `usertype`, `date_added`, `userinfo_id`) VALUES
(1, 'itsupport', 'itsupport', 1, 'Admin', '2019-07-20 16:29:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `age` int(11) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT 'logo.png',
  `first_access` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `firstname`, `middlename`, `lastname`, `DOB`, `age`, `contact`, `email`, `image`, `first_access`) VALUES
(1, 'itsupport', 'itsupport', 'itsupport', '1994-02-09', 23, '09964545008', 'itsupport@gmail.com', 'ffdffdfd.jpg', '2018-07-10 03:19:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `computers_peripherals`
--
ALTER TABLE `computers_peripherals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_computerID` (`computer_id`),
  ADD KEY `fk_peripheralID` (`peripheral_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_computerID` (`computer_id`),
  ADD KEY `fk_peripheralID` (`peripheral_id`);

--
-- Indexes for table `peripheral`
--
ALTER TABLE `peripheral`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_name` (`asset_name`);

--
-- Indexes for table `peripheral_info`
--
ALTER TABLE `peripheral_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_peripheralID1` (`peripheral_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userinfoID` (`userinfo_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `computer`
--
ALTER TABLE `computer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `computers_peripherals`
--
ALTER TABLE `computers_peripherals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peripheral`
--
ALTER TABLE `peripheral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peripheral_info`
--
ALTER TABLE `peripheral_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `computers_peripherals`
--
ALTER TABLE `computers_peripherals`
  ADD CONSTRAINT `fk_computerID` FOREIGN KEY (`computer_id`) REFERENCES `computer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_peripheralID` FOREIGN KEY (`peripheral_id`) REFERENCES `peripheral_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_computerView` FOREIGN KEY (`computer_id`) REFERENCES `computer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_peripheralView` FOREIGN KEY (`peripheral_id`) REFERENCES `peripheral_info` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `peripheral_info`
--
ALTER TABLE `peripheral_info`
  ADD CONSTRAINT `fk_peripheralID1` FOREIGN KEY (`peripheral_id`) REFERENCES `peripheral` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_userinfoID` FOREIGN KEY (`userinfo_id`) REFERENCES `user_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
