-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 12:13 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm`
--
CREATE DATABASE IF NOT EXISTS `crm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crm`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `c_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'potential'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`c_id`, `name`, `address`, `email`, `contact_no`, `status`) VALUES
(1, 'Client1', 'some-address-client-1', 'some-email-client-1@gmail.com', '123456789', 'active'),
(2, 'Client2', 'some-address-client-2', 'some-email-client-2@gmail.com', '123456788', 'active'),
(3, 'Client3', 'some-address-client-3', 'some-email-client-3@gmail.com', '123456777', 'potential'),
(4, 'Client4', 'some-address-client-4', 'some-email-client-4@gmail.com', '123456666', 'active'),
(5, 'Client5', 'some-address-client-5', 'some-email-client-5@gmail.com', '123455555', 'potential'),
(6, 'Client6', 'some-address-client-6', 'some-email-client-6@gmail.com', '123444444', 'active'),
(7, 'Client7', 'some-address-client-7', 'some-email-client-7@gmail.com', '123333333', 'potential'),
(8, 'Client8', 'some-address-client-8', 'some-email-client-8@gmail.com', '122222222', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `provider` varchar(30) NOT NULL,
  `price` bigint(20) NOT NULL,
  `warranty` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `specification` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `name`, `provider`, `price`, `warranty`, `added_on`, `last_modified`, `specification`) VALUES

(1, 'Product1', 'Manufacturer1', 5000, 1, '2021-04-05 15:10:13', current_timestamp, 'None'),
(2, 'Product2', 'Manufacturer2', 5000, 2, '2021-04-07 20:04:41', current_timestamp, 'None'),
(3, 'Product3', 'Manufacturer3', 5000, 3, '2021-04-10 15:41:26', current_timestamp, 'None'),
(4, 'Product4', 'Manufacturer4', 5000, 4, '2021-04-11 04:13:41', current_timestamp, 'None'),
(5, 'Product5', 'Manufacturer5', 5000, 5, '2021-04-11 20:41:32', current_timestamp, 'None'),
(6, 'Product6', 'Manufacturer6', 5000, 6, '2021-04-12 20:10:04', current_timestamp, 'None'),
(7, 'Product7', 'Manufacturer7', 5000, 7, '2021-04-15 15:04:13', current_timestamp, 'None'),
(8, 'Product8', 'Manufacturer8', 5000, 8, '2021-04-18 20:10:41', current_timestamp, 'None');
-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cost` bigint(20) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'ongoing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_id`, `product_id`, `seller_id`, `buyer_id`, `sale_date`, `cost`, `status`) VALUES
(1, 3, 7, 8, current_timestamp, 4500, 'ongoing'),
(2, 3, 3, 3, current_timestamp, 4999, 'closed'),
(3, 5, 2, 2, current_timestamp, 4572, 'closed'),
(4, 7, 7, 8, current_timestamp, 5990, 'ongoing'),
(5, 5, 3, 3, current_timestamp, 10000, 'closed'),
(6, 3, 2, 5, current_timestamp, 29999, 'ongoing'),
(7, 8, 5, 2, current_timestamp, 47500, 'closed'),
(8, 1, 1, 8, current_timestamp, 32000, 'closed'),
(9, 1, 2, 3, current_timestamp, 1000, 'closed'),
(10, 8, 7, 1, current_timestamp, 27760, 'ongoing'),
(11, 1, 2, 2, current_timestamp, 54500, 'closed'),
(12, 8, 7, 6, current_timestamp, 50000, 'ongoing'),
(13, 5, 5, 2, current_timestamp, 75450, 'ongoing'),
(14, 2, 3, 6, current_timestamp, 35278, 'ongoing'),
(15, 7, 5, 3, current_timestamp, 12679, 'closed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contact_no` varchar(13) CHARACTER SET utf8 NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp ON UPDATE current_timestamp() NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `name`, `email`, `password`, `contact_no`, `reg_date`, `last_updated`) VALUES 
(1, 'Employee1', 'some-email-employee-1@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(2, 'Employee2', 'some-email-employee-2@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(3, 'Employee3', 'some-email-employee-3@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(4, 'Employee4', 'some-email-employee-4@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(5, 'Employee5', 'some-email-employee-5@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(6, 'Employee6', 'some-email-employee-6@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(7, 'Employee7', 'some-email-employee-7@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp()),
(8, 'Employee8', 'some-email-employee-8@gmail.com', '$2y$10$aF/wROvxcfnrKZlqEZ9Wqudl6uRBY0Z.2HRSwSoLhJa/P1IyyeVH2', '1234567899', '2021-04-19 16:11:12', current_timestamp());

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
