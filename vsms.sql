-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2016 at 06:54 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `cf_name` varchar(100) NOT NULL,
  `cl_name` varchar(100) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_mobile` varchar(100) NOT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `w_start` date NOT NULL,
  `w_end` date NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `invoice_id` varchar(100) NOT NULL,
  `c_address` varchar(400) NOT NULL,
  `c_pass` varchar(30) NOT NULL,
  `extra` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `v_id`, `cf_name`, `cl_name`, `c_email`, `c_mobile`, `nid`, `w_start`, `w_end`, `payment_type`, `invoice_id`, `c_address`, `c_pass`, `extra`) VALUES
(9, 78, 'Kisuke Urahara', 'Urahara', 'kisuke01@mail.ru', '01912878182', '9934993920023', '2016-05-02', '2015-11-30', 'Visa/Master Card', '#IE9S78S', '125/A, BD', '1234', 'AC, HEAD LIGHT');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(100) NOT NULL,
  `manufacturer_logo` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `manufacturer_name`, `manufacturer_logo`) VALUES
(5, 'Mitsubshi', NULL),
(29, 'Audi', NULL),
(30, 'BMW', NULL),
(31, 'FERRARI', NULL),
(32, 'LambourGini', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `manufacturer_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `model_name`, `manufacturer_name`) VALUES
(22, 'A1', 'Audi'),
(23, 'A4', 'Audi'),
(24, 'A6', 'Audi'),
(25, 'TT', 'Audi'),
(26, 'R8', 'Audi'),
(27, 'ASX', 'Mitsubshi'),
(28, 'Colt', 'Mitsubshi'),
(29, 'Lancer', 'Mitsubshi'),
(30, 'Mirage', 'Mitsubshi'),
(31, 'Daytona', 'FERRARI'),
(32, '250 GTO', 'FERRARI'),
(33, '275', 'FERRARI'),
(34, '599 GTB Fiorano', 'FERRARI');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `u_bday` date NOT NULL,
  `u_position` varchar(100) NOT NULL,
  `u_type` varchar(100) NOT NULL,
  `u_pass` varchar(100) NOT NULL,
  `u_mobile` varchar(100) NOT NULL,
  `u_gender` varchar(30) NOT NULL,
  `u_address` varchar(100) NOT NULL,
  `s_question` varchar(100) NOT NULL,
  `s_ans` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `f_name`, `l_name`, `u_bday`, `u_position`, `u_type`, `u_pass`, `u_mobile`, `u_gender`, `u_address`, `s_question`, `s_ans`) VALUES
(1, 'abc@abc.com', 'Soykottt', 'Chowww', '2016-04-14', 'Manager', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', '01912817231', 'Male', '129,North Jatrabari', 'What is your name???', 'sssjjjj'),
(4, 'ab@ab.com', 'asdasd', 'klasdkl', '2015-12-31', 'kasdkl', 'Employee', '202cb962ac59075b964b07152d234b70', 'klasdkl', 'Male', 'kasdklakld', 'klasldlk', 'kaskd'),
(6, 'abb@ab.com', 'klsdkl', 'klasdkl', '2016-12-31', 'mkasfmk', 'Employee', '202cb962ac59075b964b07152d234b70', '02304304', 'Male', 'sdklfkl', 'kzdkfk', 'ksdkfk');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `v_id` int(11) NOT NULL,
  `manufacturer_name` varchar(100) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `b_price` double NOT NULL,
  `s_price` double DEFAULT NULL,
  `mileage` double NOT NULL,
  `add_date` date NOT NULL,
  `sold_date` date DEFAULT NULL,
  `status` varchar(40) NOT NULL,
  `registration_year` int(11) NOT NULL,
  `insurance_id` int(11) DEFAULT NULL,
  `gear` varchar(100) NOT NULL,
  `doors` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `tank` float NOT NULL,
  `image` varchar(400) NOT NULL,
  `e_no` varchar(40) NOT NULL,
  `c_no` varchar(40) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `v_color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`v_id`, `manufacturer_name`, `model_name`, `category`, `b_price`, `s_price`, `mileage`, `add_date`, `sold_date`, `status`, `registration_year`, `insurance_id`, `gear`, `doors`, `seats`, `tank`, `image`, `e_no`, `c_no`, `u_id`, `v_color`) VALUES
(74, 'Mitsubshi', 'ASX', 'Subcompact', 20000000, NULL, 10000, '2016-11-30', NULL, 'Available', 2001, 2147483647, 'Auto', 2, 4, 100, '14620399372015-Mitsubishi-Outlander-Sport-2-4-GT-0.jpg*1462039937mitsubishi-outlander-sport-2.4-2*1462039937small-suvs-mitsubishi-asx-2015-wide.jpg', '', '', NULL, NULL),
(75, 'Audi', 'A1', 'Subcompact', 75000000, 399999, 1000, '2015-11-30', NULL, 'Available', 2016, 23999234, 'Auto', 2, 2, 200, '14620410292011-Audi-A1-00011.jpg*1462041029small-suvs-mitsubishi-asx-2015-wide.jpg', '', '', NULL, NULL),
(76, 'FERRARI', '599 GTB Fiorano', 'Compact', 40000040, NULL, 900, '2015-11-30', NULL, 'Available', 2015, 2147483647, 'Auto', 4, 2, 50, '14620451942007-ferrari-599-gtb-fiorano_100532846_m.jpg*146204519424375268_300x225.jpg*1462045194ferarri.jpg', '#093400', '#AJJSD93', NULL, 'Black'),
(77, 'Audi', 'A6', 'Subcompact', 75000000, 2000, 1000, '2015-11-30', NULL, 'Available', 2016, 2399923, 'Auto', 2, 2, 200, '14620410292011-Audi-A1-00011.jpg*1462041029small-suvs-mitsubishi-asx-2015-wide.jpg', '', '', NULL, NULL),
(78, 'FERRARI', '599 GTB Fiorano', 'Compact', 40000040, 20000000000, 900, '2015-11-30', '2016-05-02', 'Sold', 2015, 2147483647, 'Auto', 4, 2, 50, '14620451942007-ferrari-599-gtb-fiorano_100532846_m.jpg*146204519424375268_300x225.jpg*1462045194ferarri.jpg', '', '', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `v_id_2` (`v_id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`),
  ADD UNIQUE KEY `c_id` (`c_id`),
  ADD KEY `v_id` (`v_id`),
  ADD KEY `c_id_2` (`c_id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`),
  ADD UNIQUE KEY `manufacturer_name` (`manufacturer_name`),
  ADD KEY `manufacturer_name_2` (`manufacturer_name`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`),
  ADD UNIQUE KEY `model_name` (`model_name`),
  ADD KEY `manufacturer_name` (`manufacturer_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`u_email`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `manufacturer_name` (`manufacturer_name`),
  ADD KEY `model_name` (`model_name`),
  ADD KEY `c_no` (`c_no`),
  ADD KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`v_id`) REFERENCES `vehicle` (`v_id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`manufacturer_name`) REFERENCES `manufacturer` (`manufacturer_name`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`manufacturer_name`) REFERENCES `model` (`manufacturer_name`),
  ADD CONSTRAINT `vehicle_ibfk_2` FOREIGN KEY (`model_name`) REFERENCES `model` (`model_name`),
  ADD CONSTRAINT `vehicle_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
