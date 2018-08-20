-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 20, 2018 at 09:24 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 5.6.36-1+ubuntu17.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exceltailor`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(15) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `et_customers`
--

CREATE TABLE `et_customers` (
  `customer_id` int(20) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `date_of_birth` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_customers`
--

INSERT INTO `et_customers` (`customer_id`, `f_name`, `l_name`, `gender`, `address`, `state`, `email`, `phone`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(1, 'sidd', 'vitt', 'male', 'pune', 'Maharashtra', 'sid@sid.com', '0998776', '2018-12-12', '2018-08-20 14:30:27', '2018-08-20 14:30:27'),
(3, 'test', 'test', 'female', 'test customer', 'Maharashtra', 'sid@sid.com', '0987654567', '0002-12-12', '2018-08-20 14:39:46', '2018-08-20 14:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `et_measurments`
--

CREATE TABLE `et_measurments` (
  `measurment_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `ub_a` varchar(50) DEFAULT NULL,
  `ub_b` varchar(50) DEFAULT NULL,
  `lb_a` varchar(50) DEFAULT NULL,
  `lb_b` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `et_new_measurments`
--

CREATE TABLE `et_new_measurments` (
  `measurment_id` int(20) NOT NULL,
  `customer_id` int(20) NOT NULL,
  `measurment_name` varchar(100) NOT NULL,
  `ub_length` varchar(20) DEFAULT NULL,
  `ub_chest` varchar(20) DEFAULT NULL,
  `ub_stomach` varchar(20) DEFAULT NULL,
  `ub_hip` varchar(20) DEFAULT NULL,
  `ub_shoulders` varchar(20) DEFAULT NULL,
  `ub_sleeves` varchar(20) DEFAULT NULL,
  `ub_sleeve_round` varchar(20) DEFAULT NULL,
  `ub_neck` varchar(20) DEFAULT NULL,
  `lb_length` varchar(20) DEFAULT NULL,
  `lb_waist` varchar(20) DEFAULT NULL,
  `lb_hip` varchar(20) DEFAULT NULL,
  `lb_thigh` varchar(20) DEFAULT NULL,
  `lb_knee` varchar(20) DEFAULT NULL,
  `lb_bottom` varchar(20) DEFAULT NULL,
  `lb_inside` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_new_measurments`
--

INSERT INTO `et_new_measurments` (`measurment_id`, `customer_id`, `measurment_name`, `ub_length`, `ub_chest`, `ub_stomach`, `ub_hip`, `ub_shoulders`, `ub_sleeves`, `ub_sleeve_round`, `ub_neck`, `lb_length`, `lb_waist`, `lb_hip`, `lb_thigh`, `lb_knee`, `lb_bottom`, `lb_inside`) VALUES
(1, 3, 'sidd', '76', '78', '9876', '86', '65', '8', '56', '568', '587', '567', '568', '68', '657', '65', '876'),
(2, 3, 'test', '23', '675', '786', '78', '65', '765', '8756', '5', '675', '75', '785', '75', '7567', '5', '6576');

-- --------------------------------------------------------

--
-- Table structure for table `et_orders`
--

CREATE TABLE `et_orders` (
  `order_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `measurment_id` int(50) NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `order_title` varchar(100) NOT NULL,
  `order_description` varchar(500) DEFAULT NULL,
  `assigned_to` int(50) NOT NULL,
  `delivery_date` date NOT NULL,
  `total_amount` int(20) NOT NULL,
  `amount_paid` int(20) DEFAULT NULL,
  `order_status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_orders`
--

INSERT INTO `et_orders` (`order_id`, `customer_id`, `measurment_id`, `order_type`, `order_title`, `order_description`, `assigned_to`, `delivery_date`, `total_amount`, `amount_paid`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Sherwani', 'test', 'test order', 1, '2018-08-17', 5000, 1000, 'Completed', '2018-08-20 15:00:25', '2018-08-20 15:11:57'),
(3, 3, 2, 'Pathani', 'test', 'test order', 1, '2018-08-29', 9000, 1750, 'Processing', '2018-08-20 15:32:18', '2018-08-20 15:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `et_users`
--

CREATE TABLE `et_users` (
  `id` int(20) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_users`
--

INSERT INTO `et_users` (`id`, `full_name`, `user_name`, `password`, `type`) VALUES
(1, 'Excel Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`f_name`, `l_name`, `gender`) VALUES
('sid', 'sid', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `et_customers`
--
ALTER TABLE `et_customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `et_measurments`
--
ALTER TABLE `et_measurments`
  ADD PRIMARY KEY (`measurment_id`);

--
-- Indexes for table `et_new_measurments`
--
ALTER TABLE `et_new_measurments`
  ADD PRIMARY KEY (`measurment_id`);

--
-- Indexes for table `et_orders`
--
ALTER TABLE `et_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `et_users`
--
ALTER TABLE `et_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `et_customers`
--
ALTER TABLE `et_customers`
  MODIFY `customer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `et_measurments`
--
ALTER TABLE `et_measurments`
  MODIFY `measurment_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `et_new_measurments`
--
ALTER TABLE `et_new_measurments`
  MODIFY `measurment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `et_orders`
--
ALTER TABLE `et_orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `et_users`
--
ALTER TABLE `et_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
