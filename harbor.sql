-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2019 at 03:29 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harbor`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` text NOT NULL,
  `branch_openhrs` time NOT NULL,
  `branch_closehrs` time NOT NULL,
  `branch_est` date NOT NULL,
  `branch_manager` int(11) DEFAULT NULL,
  `branch_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_address`, `branch_openhrs`, `branch_closehrs`, `branch_est`, `branch_manager`, `branch_status`) VALUES
(1, 'MAIN BRANCH', 'V.Gullas St. Cebu City', '08:00:00', '17:00:00', '1994-07-08', NULL, 'A'),
(2, 'DB Colon', '138 Mall, Colon St. Cebu City Philippines 6000', '08:00:00', '17:00:00', '1994-03-14', NULL, 'A'),
(3, 'DB Avila', 'Block 41, Ground Floor, SM Seaside City Cebu, 6000', '10:00:00', '20:00:00', '2015-03-31', NULL, 'A'),
(4, 'HC SM', 'SM City Cebu', '08:00:00', '17:00:00', '2000-10-24', 1, 'A'),
(5, 'HC Ayala', 'Ayala Center Cebu', '09:00:00', '18:00:00', '1994-03-14', 1, 'A'),
(6, 'Ding How', 'Cebu City', '08:00:00', '16:00:00', '1988-02-10', 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `charges_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total_charge` decimal(10,2) NOT NULL,
  `charges_date` date NOT NULL,
  `notes` text,
  `charge_type` int(11) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `charge_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`charges_id`, `emp_id`, `branch_id`, `total_charge`, `charges_date`, `notes`, `charge_type`, `approver_id`, `charge_status`) VALUES
(1, 3, 4, '361.00', '2019-03-21', 'Extra Coke for Manager Kim', 3, 1, 'A'),
(2, 3, 2, '241.00', '2019-03-21', 'Please deliver now', 2, NULL, 'P'),
(3, 3, 2, '2100.00', '2019-03-27', NULL, 1, NULL, 'P'),
(4, 4, 5, '835.00', '2019-03-27', NULL, 3, 1, 'A'),
(5, 4, 4, '365.00', '2019-03-27', '', 2, NULL, 'P');

-- --------------------------------------------------------

--
-- Table structure for table `charges_details`
--

CREATE TABLE `charges_details` (
  `cd_id` int(11) NOT NULL,
  `charges_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_saved` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cd_status` char(1) NOT NULL,
  `date_transacted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges_details`
--

INSERT INTO `charges_details` (`cd_id`, `charges_id`, `prod_id`, `quantity`, `price_saved`, `total`, `cd_status`, `date_transacted`) VALUES
(1, 1, 3, 2, '83.00', '166.00', 'A', '2019-03-21'),
(2, 1, 4, 3, '65.00', '195.00', 'A', '2019-03-21'),
(3, 2, 1, 1, '81.00', '81.00', 'P', '2019-03-21'),
(4, 2, 2, 2, '80.00', '160.00', 'P', '2019-03-21'),
(5, 3, 1, 12, '70.00', '840.00', 'P', '2019-03-27'),
(6, 3, 5, 21, '60.00', '1260.00', 'P', '2019-03-27'),
(7, 4, 1, 2, '70.00', '140.00', 'A', '2019-03-27'),
(8, 4, 2, 3, '70.00', '210.00', 'A', '2019-03-27'),
(9, 4, 3, 3, '75.00', '225.00', 'A', '2019-03-27'),
(10, 4, 4, 4, '65.00', '260.00', 'A', '2019-03-27'),
(11, 5, 1, 2, '70.00', '140.00', 'P', '2019-03-27'),
(12, 5, 3, 3, '75.00', '225.00', 'P', '2019-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `charge_type`
--

CREATE TABLE `charge_type` (
  `chtype_id` int(11) NOT NULL,
  `chtype_name` varchar(50) NOT NULL,
  `chtype_desc` varchar(100) NOT NULL,
  `chtype_discount` decimal(10,2) DEFAULT NULL,
  `chtype_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charge_type`
--

INSERT INTO `charge_type` (`chtype_id`, `chtype_name`, `chtype_desc`, `chtype_discount`, `chtype_status`) VALUES
(1, 'Duty Meal', 'Meals for employees during duty', '0.00', 'A'),
(2, 'Charge Meals', 'Meals charged by employee to his/her salary', '0.00', 'A'),
(3, 'Privilege Meal', 'Discounted Meal', '0.10', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_firstname` varchar(50) NOT NULL,
  `emp_lastname` varchar(50) NOT NULL,
  `emp_address` varchar(50) NOT NULL,
  `emp_username` varchar(50) NOT NULL,
  `emp_password` text NOT NULL,
  `emp_branch` int(11) NOT NULL,
  `emp_type` char(1) NOT NULL COMMENT 'M- Manager| E-Ordinary Employee | C- Cashier',
  `emp_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_firstname`, `emp_lastname`, `emp_address`, `emp_username`, `emp_password`, `emp_branch`, `emp_type`, `emp_status`) VALUES
(1, 'John Gabriel', 'Tejoc', 'Sitio Manol, Tisa Cebu City', 'jgctejoc', '6c2292f874552cd50227a1d55d6d30cd', 1, 'M', 'A'),
(2, 'Jane', 'Doe', 'Sito Kabunkalan, Cansojong, Talisay Cebu City', 'jdoe', '97f87363ee02118458c6875f0ce81142', 1, 'C', 'A'),
(3, 'John', 'Doe', 'Mandaue City, Cebu 6011', 'jhdoe', '32b9851dac32685965d2abb16cb3af7e', 2, 'E', 'A'),
(4, 'Ryan', 'Doe', 'IT Park, Cebu City', 'rydoe', 'ce63490764d7187305f160432497b226', 3, 'E', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `m_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_sent` date NOT NULL,
  `m_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`m_id`, `emp_id`, `name`, `email`, `message`, `date_sent`, `m_status`) VALUES
(1, 3, 'Christian Barral', 'kredoteacher.christian@gmail.com', 'This is love!', '2019-03-11', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_code` varchar(50) DEFAULT NULL,
  `prod_name` varchar(50) NOT NULL,
  `prod_desc` text NOT NULL,
  `prod_priceprunit` decimal(10,2) NOT NULL,
  `prod_costprice` decimal(10,2) NOT NULL,
  `prod_img` text NOT NULL,
  `prod_status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_code`, `prod_name`, `prod_desc`, `prod_priceprunit`, `prod_costprice`, `prod_img`, `prod_status`) VALUES
(1, 'HC0001', 'Shaomai', 'Siomai made of Pork and Shark', '70.00', '19.67', '../images/siomai.jpg', 'A'),
(2, 'HC0002', 'Spring rolls', 'Vegetable spring rolls', '70.00', '19.41', '../images/springroll.jpg', 'A'),
(3, 'HC0003', 'Steamed Fried Rice', 'Fried Steam Rice with Pork Sauce and Pork cutlets', '75.00', '46.08', '../images/steamedrice.jpg', 'A'),
(4, 'HC0004', 'Coke Regular Can', 'Coke Regular Can', '65.00', '45.00', '../images/coke.jpg', 'A'),
(5, 'HC0005', 'Xie Ping Ube', 'Pinoy Halo-halo with rice crispies, leche flan, stick-o and many more', '60.00', '29.76', '../images/halohalo.jpg', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`charges_id`);

--
-- Indexes for table `charges_details`
--
ALTER TABLE `charges_details`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `charge_type`
--
ALTER TABLE `charge_type`
  ADD PRIMARY KEY (`chtype_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `charges_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `charges_details`
--
ALTER TABLE `charges_details`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `charge_type`
--
ALTER TABLE `charge_type`
  MODIFY `chtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
