-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 12:36 AM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 5.6.36-1+ubuntu17.10.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corephpadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `id` int(25) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `admin_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`id`, `user_name`, `passwd`, `admin_type`) VALUES
(1, 'chetan', '3b8ebe34e784a3593693a37baaacb016', 'super'),
(4, 'anand', '8bda8e915e629a9fd1bbca44f8099c81', 'admin'),
(6, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'super'),
(7, 'sid', 'b8c1a3069167247e3503f0daba6c5723', 'super'),
(8, 'sid', 'b8c1a3069167247e3503f0daba6c5723', 'super'),
(9, 'sid', 'b8c1a3069167247e3503f0daba6c5723', 'admin'),
(10, 'sid', 'b8c1a3069167247e3503f0daba6c5723', 'super');

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
  `city` varchar(15) NOT NULL,
  `state` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `f_name`, `l_name`, `gender`, `address`, `city`, `state`, `phone`, `email`, `date_of_birth`, `created_at`, `updated_at`) VALUES
(21, 'bhushan', 'sutar', 'male', 'Priyadarshini A102, adwa2', 'mumbai', 'Maharashtra', '34343432', 'bhusahan2@gmail.com', '2016-11-24', NULL, NULL),
(23, 'Paolo', ' Accorti', 'male', 'Priyadarshini A102, adwa2', 'mumbai', 'Maharashtra', '34343432', 'bhusahan2@gmail.com', '1992-02-04', NULL, NULL),
(24, 'Roland', ' Mendel', 'male', 'Priyadarshini A102, adwa2', 'mumbai', 'Maharashtra', '34343432', 'bhusahan2@gmail.com', '2016-11-30', NULL, NULL),
(25, 'John', 'doe', 'male', 'City, view', '', 'Maharashtra', '8875207658', 'john@abc.com', '2017-01-27', NULL, NULL),
(26, 'Maria', 'Anders', 'female', 'New york city', '', 'Maharashtra', '8856705387', 'chetanshenai9@gmail.com', '2017-01-28', NULL, NULL),
(28, 'Thomas', 'Hardy', 'male', '120 Hanover Sq', '', 'Maharashtra', '885115323', 'abc@abc.com', '1985-06-24', NULL, NULL),
(29, 'Christina', 'Berglund', 'female', 'Berguvsvägen 8', '', 'Maharashtra', '9985125366', 'chetanshenai9@gmail.com', '1997-02-12', NULL, NULL),
(30, 'Ann', 'Devon', 'male', '35 King George', '', 'Maharashtra', '8865356988', 'abc@abc.com', '1988-02-09', NULL, NULL),
(32, 'Annette', 'Roulet', 'female', '1 rue Alsace-Lorraine', '', ' ', '3410005687', 'abc@abc.com', '1992-01-13', NULL, NULL),
(33, 'Yoshi', 'Tannamuri', 'male', '1900 Oak St.', '', 'Maharashtra', '8855647899', 'chetanshenai9@gmail.com', '1994-07-28', NULL, NULL),
(34, 'Carlos', 'González', 'male', 'Barquisimeto', '', 'Maharashtra', '9966447554', 'abc@abc.com', '1997-06-24', NULL, NULL),
(35, 'Fran', ' Wilson', 'male', 'Priyadarshini ', '', 'Maharashtra', '5844775565', 'fran@abc.com', '1997-01-27', NULL, NULL),
(36, 'Jean', ' Fresnière', 'female', '43 rue St. Laurent', '', 'Maharashtra', '9975586123', 'chetanshenai9@gmail.com', '2002-01-28', NULL, NULL),
(37, 'Jose', 'Pavarotti', 'male', '187 Suffolk Ln.', '', 'Maharashtra', '875213654', ' Pavarotti@gmail.com', '1997-02-04', NULL, NULL),
(38, 'Palle', 'Ibsen', 'female', 'Smagsløget 45', '', 'Maharashtra', '9975245588', 'Palle@gmail.com', '1991-06-17', NULL, '2018-01-14 17:11:42'),
(39, 'Paula', 'Parente', 'male', 'Rua do Mercado, 12', '', 'Maharashtra', '659984878', 'abc@gmail.com', '1996-02-06', NULL, NULL),
(40, 'Siddy', 'V', 'male', 'pune', '', 'Maharashtra', '9830251478', 'sid@tewst.com', '1992-05-17', '2018-08-03 03:03:45', '2018-08-03 03:39:11'),
(41, 'Siddharth', 'Vitthaldas', 'male', 'Pune', '', 'Maharashtra', '9860676178', 'vitthaldas.siddharth@gmail.com', '2018-08-08', '2018-08-04 05:53:26', NULL),
(42, 'jane', 'doe', 'male', 'usa', '', 'Maharashtra', '12345', 'jane@gmail.com', '0000-00-00', '2018-08-04 06:48:21', NULL);

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

--
-- Dumping data for table `et_measurments`
--

INSERT INTO `et_measurments` (`measurment_id`, `customer_id`, `ub_a`, `ub_b`, `lb_a`, `lb_b`, `name`) VALUES
(1, 21, '12', '23', '34', '45', 'sid'),
(2, 21, '09', '87', '65', '43', 'nayan'),
(3, 23, 'sdf', 'sdf', 'sdf', NULL, 'sdf'),
(4, 23, 'dfg', 'sdf', 'sdf', NULL, 'dfg'),
(5, 23, '12', '23', '34', NULL, 'siddy'),
(6, 21, '12', '23', '34', NULL, 'siddy'),
(7, 21, '09', '98', '87', NULL, 'nanya'),
(8, 23, '345', '46', '56', NULL, 'sid'),
(9, 23, '11', '22', '33', NULL, 'siddy'),
(10, 41, '12', '23', '34', '45', 'sid'),
(11, 39, '23', '45', '78', '65', 'son'),
(12, 24, '34', '345', '67', '908', 'ronny');

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
(1, 21, 1, 'sherwani', 'sdf', '', 3, '2018-08-28', 200, 50, 'Processing', '2018-08-12 12:28:32', '2018-08-12 12:28:32'),
(2, 21, 2, 'sherwani', 'new order', 'new order suit', 3, '2018-08-31', 200, 100, 'Processing', '2018-08-12 13:24:14', '2018-08-12 13:24:14'),
(3, 23, 3, 'suit', '3 piece suit', 'new', 4, '2018-08-31', 1000, 300, 'Processing', '2018-08-12 13:30:37', '2018-08-12 13:30:37'),
(4, 41, 10, 'suit', '3 Piece Suit', '3 piece Suit with brown blazer', 4, '2018-09-05', 5000, 1500, 'Processing', '2018-08-12 15:41:55', '2018-08-12 15:41:55'),
(5, 39, 11, 'sherwani', 'Sherwani for Son', '', 3, '2018-09-07', 2000, 100, 'Processing', '2018-08-13 16:48:01', '2018-08-13 16:48:01'),
(6, 24, 12, 'sherwani', 'aksljaks', '', 4, '2018-08-29', 345, 23, 'Processing', '2018-08-13 18:12:14', '2018-08-13 18:12:14'),
(7, 23, 5, 'Sherwani', 'sdfdsADSFAD', '', 3, '2018-08-23', 400, 10, 'Processing', '2018-08-13 18:57:34', '2018-08-13 18:57:34');

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
(3, 'Siddharth V', 'sid', 'b8c1a3069167247e3503f0daba6c5723', 'administrator'),
(4, 'Nayan', 'nayan', 'b257312296cecbec7a9918cf5661dc51', 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `et_measurments`
--
ALTER TABLE `et_measurments`
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
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `et_measurments`
--
ALTER TABLE `et_measurments`
  MODIFY `measurment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `et_orders`
--
ALTER TABLE `et_orders`
  MODIFY `order_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `et_users`
--
ALTER TABLE `et_users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
