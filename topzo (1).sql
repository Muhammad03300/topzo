-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2024 at 05:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topzo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `number`, `email`, `password`) VALUES
(1, 'Shafiq', '03025878055', 'muhammad03300@gmail.com', '$2y$10$lgBFzsz6E7xfdIYgNdzqReUWNPAsfVi7.0ba5T/si0Mx0kyMcrBgm');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderss`
--

CREATE TABLE `orderss` (
  `order_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `order_date` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orderss`
--

INSERT INTO `orderss` (`order_id`, `product_title`, `quantity`, `total_price`, `shipping_address`, `email`, `phone_no`, `username`, `order_date`) VALUES
(8, 'Shoes', 3, 6000, 'Nowshera', 'umar@gmail.com', '03489533227', 'Umar', 2147483647),
(12, 'Shoes', 2, 4000, 'Akora Khattak', 'abubakkar3694@gmail.com', '03025878055', 'Muhammad Abu Bakkar Siddique', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `google_product_category` varchar(255) NOT NULL,
  `stock_availability` int(11) NOT NULL,
  `regular_price` int(11) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `mpn` varchar(255) NOT NULL,
  `shipping` varchar(255) NOT NULL,
  `adult` varchar(255) NOT NULL,
  `age_group` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `item_group_id` int(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_title`, `product_description`, `product_category`, `google_product_category`, `stock_availability`, `regular_price`, `product_condition`, `manufacturer`, `mpn`, `shipping`, `adult`, `age_group`, `color`, `gender`, `size`, `material`, `pattern`, `item_group_id`, `file_path`) VALUES
(2, 'Shoes', 'Jogers shoes for boys', 'Shoes', '0', 4, 3000, 'New', 'Nike', '32434', '0', 'Yes', '18-50', 'Black, Green', 'Male', 'S, M, L, XL', 'Leather', 'Black', 344, 'uploads/663c6041d9df9.jpg'),
(3, 'Ring', 'Gold ring for women', 'rings', '0', 5, 4000, 'New', 'Unknown', '23544', '0', 'Yes', '18-50', 'Gold', 'Female', 'S, M, L, XL', 'Gold', 'Gold', 4, 'uploads/663c620da4e05.jpg'),
(4, 'Necklace', 'Necklace for women', 'necklace', '0', 25, 1400, 'New', 'None', '34432', '0', 'Yes', '18-50', 'Golden, Silver', 'Female', 'S, M, L, XL', 'Silver', 'Gold', 3244, 'uploads/66436a1c17406.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `phone_no`, `email`, `password`) VALUES
(1, 'Muhammad Abu Bakkar Siddique', '03025878055', 'abubakkar3694@gmail.com', '$2y$10$LAfbAU2/lvK2SHvB/QL8ZeJH7bAviMn1/okzzaL/UMfndfPaoFBmC'),
(2, 'Umar', '03489533227', 'umar@gmail.com', '$2y$10$GCnsAm2YXlr4hpVlmGT9he/TQxOslq6mnc2bl3/ANIOtJTvHd9SFi'),
(3, 'Abdullah', '03115687413', 'abdullah@gmail.com', '$2y$10$86EyRCfRvsFGBOrc7NxIb./dOLstUoz6JNze6XuNiAtLR4RRjwlkO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orderss`
--
ALTER TABLE `orderss`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orderss`
--
ALTER TABLE `orderss`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
