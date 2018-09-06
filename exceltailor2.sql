-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 06, 2018 at 02:50 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 5.6.36-1+ubuntu17.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exceltailor2`
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
  `address` varchar(100) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_customers`
--

INSERT INTO `et_customers` (`customer_id`, `f_name`, `l_name`, `address`, `state`, `phone`, `created_at`, `updated_at`) VALUES
(5, 'Jane', 'Doe', 'Pune', 'Maharashtra', '9976655432', '2018-09-02 09:16:10', '2018-09-02 10:18:18'),
(6, 'John', 'Doe', 'Mumbai', 'Maharashtra', '1234567890', '2018-09-02 10:18:46', '2018-09-02 10:18:46'),
(7, 'Test', 'test', 'test', 'Maharashtra', '9878675645', '2018-09-03 14:47:57', '2018-09-03 14:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `et_items`
--

CREATE TABLE `et_items` (
  `item_id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `item_type` varchar(50) NOT NULL,
  `item_quantity` int(20) NOT NULL,
  `assigned_to` int(20) NOT NULL,
  `item_rate` int(20) NOT NULL,
  `item_title` varchar(50) NOT NULL,
  `item_description` varchar(500) DEFAULT NULL,
  `item_amount` int(20) NOT NULL,
  `item_status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_items`
--

INSERT INTO `et_items` (`item_id`, `order_id`, `item_type`, `item_quantity`, `assigned_to`, `item_rate`, `item_title`, `item_description`, `item_amount`, `item_status`, `created_at`) VALUES
(17, 22, 'Indo-Westren', 2, 2, 3000, 'test', '', 6000, 'Processing', '2018-09-02 09:29:04'),
(21, 24, 'Suit', 2, 1, 3000, 'new', '', 6000, 'Pending', '2018-09-02 15:44:19'),
(22, 24, 'Safari', 3, 1, 5000, 'new 2', '', 15000, 'Pending', '2018-09-02 15:44:20'),
(23, 25, 'Sherwani', 1, 1, 2000, 'test1', '', 2000, 'Pending', '2018-09-03 14:51:15'),
(24, 25, 'Kurta Pajama', 2, 2, 1000, 'test2', '', 2000, 'Pending', '2018-09-03 14:51:15'),
(25, 25, '3 Piece Suit', 2, 2, 3000, 'test3', '', 6000, 'Pending', '2018-09-03 14:51:15'),
(26, 25, 'Suit', 1, 1, 1500, 'test4', '', 1500, 'Pending', '2018-09-03 14:51:15'),
(27, 25, 'Pant', 3, 2, 500, 'test5', '', 1500, 'Pending', '2018-09-03 14:51:15'),
(28, 25, 'Shirt', 4, 2, 200, 'test6', '', 800, 'Pending', '2018-09-03 14:51:15'),
(29, 25, 'Jodhpuri', 1, 2, 4000, 'test7', '', 4000, 'Pending', '2018-09-03 14:51:15'),
(30, 25, 'Pathani Salwar', 2, 2, 2500, 'test8', '', 5000, 'Pending', '2018-09-03 14:51:15'),
(31, 25, 'Safari', 1, 2, 6000, 'test9', '', 6000, 'Pending', '2018-09-03 14:51:15'),
(32, 25, 'Jackets', 1, 2, 1700, 'test10', '', 1700, 'Pending', '2018-09-03 14:51:15'),
(33, 25, 'Others', 3, 2, 1250, 'test11', '', 3750, 'Pending', '2018-09-03 14:51:15'),
(34, 26, 'Shirt', 2, 1, 4000, 'jsd', '', 8000, 'Completed', '2018-09-04 04:44:12');

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
  `ub_comments` varchar(100) NOT NULL,
  `lb_length` varchar(20) DEFAULT NULL,
  `lb_waist` varchar(20) DEFAULT NULL,
  `lb_hip` varchar(20) DEFAULT NULL,
  `lb_thigh` varchar(20) DEFAULT NULL,
  `lb_knee` varchar(20) DEFAULT NULL,
  `lb_bottom` varchar(20) DEFAULT NULL,
  `lb_inside` varchar(20) DEFAULT NULL,
  `lb_comments` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_new_measurments`
--

INSERT INTO `et_new_measurments` (`measurment_id`, `customer_id`, `measurment_name`, `ub_length`, `ub_chest`, `ub_stomach`, `ub_hip`, `ub_shoulders`, `ub_sleeves`, `ub_sleeve_round`, `ub_neck`, `ub_comments`, `lb_length`, `lb_waist`, `lb_hip`, `lb_thigh`, `lb_knee`, `lb_bottom`, `lb_inside`, `lb_comments`) VALUES
(9, 5, 'Jane', '12', '34', '54', '65', '76', '87', '98', '09', 'likes a little loose', '65', '65', '76', '98', '09', '786', '65', 'Slim fit in thigh'),
(10, 6, 'new', '12', '12', '65', '8', '76', '65', '7', '6', ',HKJHJKNJNK', '677', '9', '76', '5', '7', '67', '78', 'MNBVJFJHB'),
(11, 7, 'test', '12', '34', '56', '78', '09', '09', '87', '65', 'testtest', '34', '6578', '90', '09', '87', '65', '54', 'test test test');

-- --------------------------------------------------------

--
-- Table structure for table `et_orders`
--

CREATE TABLE `et_orders` (
  `order_id` int(50) NOT NULL,
  `customer_id` int(50) NOT NULL,
  `measurment_id` int(50) NOT NULL,
  `delivery_date` date NOT NULL,
  `total_amount` int(20) NOT NULL,
  `amount_paid` int(20) DEFAULT NULL,
  `receipt_no` varchar(20) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `et_orders`
--

INSERT INTO `et_orders` (`order_id`, `customer_id`, `measurment_id`, `delivery_date`, `total_amount`, `amount_paid`, `receipt_no`, `order_status`, `created_at`, `updated_at`) VALUES
(22, 5, 9, '2018-09-30', 6000, 1500, 'A1234', 'Processing', '2018-09-02 09:29:04', '2018-09-02 13:31:45'),
(24, 6, 10, '2018-09-24', 21000, 1800, 'ET1234', 'Pending', '2018-09-02 15:44:19', '2018-09-03 17:02:49'),
(25, 7, 11, '2018-09-30', 34250, 15000, 'ET1705', 'Completed', '2018-09-03 14:51:15', '2018-09-03 16:33:05'),
(26, 7, 11, '2018-09-30', 8000, 5000, 'ET5656', 'Completed', '2018-09-04 04:44:11', '2018-09-04 04:44:11');

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
(1, 'Excel Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
(2, 'Tailor', 'tailor', 'acf6b443c56e67e0dbd86323e8751121', 'employee');

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
-- Indexes for table `et_items`
--
ALTER TABLE `et_items`
  ADD PRIMARY KEY (`item_id`);

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
  MODIFY `customer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `et_items`
--
ALTER TABLE `et_items`
  MODIFY `item_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `et_new_measurments`
--
ALTER TABLE `et_new_measurments`
  MODIFY `measurment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `et_orders`
--
ALTER TABLE `et_orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `et_users`
--
ALTER TABLE `et_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
