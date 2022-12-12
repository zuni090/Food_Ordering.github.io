-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Dec 08, 2022 at 10:39 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restuarant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(10) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Username` text NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Name`, `Username`, `Password`, `Email`, `status`) VALUES
('AD_001', 'Muhammad Zunique 123', 'zunique', 'zuni', 'zunique@gmail.com', 1),
('AD_004', 'Test1', 'test4', '1234', 'test4@gmail.com', 1),
('AD_012', 'hello weold', 'abc123', 'wxyz', 'abc123@gmail.com', 1),
('AD_016', 'ali', 'ali124', '1234', 'ali124@gmail.com', 1),
('AD_018', 'abcdabc', 'abcabc@gmail.com', '123', 'abcabc@gmail.com@gmail.com', 1),
('AD_022', 'newname', 'newname', '1dbb5a92', 'newname@gmail.com', 1);

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `AdminLogID` BEFORE INSERT ON `admin` FOR EACH ROW begin
INSERT INTO logs(AdminID) VALUES(null);
SET NEW.id = CONCAT('AD_', LPAD(LAST_INSERT_ID(), 3, '0'));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setEmail` BEFORE INSERT ON `admin` FOR EACH ROW begin
INSERT INTO logs(AdminUsername) VALUES(new.username);
SET NEW.email = CONCAT(new.username , '@gmail.com');
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setPassword` BEFORE INSERT ON `admin` FOR EACH ROW begin
set new.password = SUBSTR(MD5(RAND()), 1, 8);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `dish_detail_id` int(11) UNSIGNED NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp(),
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `order_number` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `category`, `order_number`, `status`, `added_on`) VALUES
(27, 'Shakes', 130, 1, '2022-10-23 00:00:00'),
(29, 'Burgers', 90, 1, '2022-10-23 00:00:00'),
(30, 'Momos', 67, 1, '2022-10-23 00:00:00'),
(31, 'Deserts', 430, 1, '2022-10-24 00:00:00'),
(32, 'Pizza', 213, 1, '2022-10-24 00:00:00'),
(38, 'Rolls', 120, 1, '2022-11-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Mobile_num` varchar(13) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`ID`, `Name`, `Mobile_num`, `Password`, `Status`, `added_on`) VALUES
(5, 'Helo', '03142345678', '4321', 1, '2022-10-20 00:00:00'),
(14, 'Test', '03142345679', '1234', 1, '2022-10-24 00:00:00'),
(15, 'Test ', '12345678901', '1234', 1, '2022-11-27 00:00:00'),
(16, 'Ali', '03101207890', 'abc', 1, '2022-12-01 00:00:00'),
(17, 'Memon', '12345678909', '1234', 1, '2022-12-01 00:00:00'),
(18, 'Helo ABC', '0989456790', '1234', 1, '2022-12-01 00:00:00'),
(19, 'han kch tou', 'sahi hai sheh', '739445f8', 1, '2022-12-09 02:05:40');

--
-- Triggers `delivery_boy`
--
DELIMITER $$
CREATE TRIGGER `setPasswordDelivery` BEFORE INSERT ON `delivery_boy` FOR EACH ROW begin
set new.Password = SUBSTR(MD5(RAND()), 1, 8);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `ID` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `Dish` varchar(100) NOT NULL,
  `Dish_detail` text NOT NULL DEFAULT 'N/A',
  `Image` varchar(100) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`ID`, `category_id`, `Dish`, `Dish_detail`, `Image`, `Status`, `added_on`) VALUES
(51, 38, 'Mayo Burrito 37', 'Chicken with Garlic / Mayo and Cheese', 'Burrito.jpg', 1, '2022-11-10 00:00:00'),
(53, 38, 'Fajita Roll', 'Dekhlunga', 'Chicken Fajita Roll.jpg', 1, '2022-11-11 00:00:00'),
(55, 29, 'Chicken Burger ', 'shhhhhh', 'dishpexels-rajesh-tp-1633578 (9).jpg', 1, '2022-11-11 00:00:00'),
(56, 32, 'pizza', 'acha pizza hai', 'class Diagram.png', 1, '2022-12-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dish_detail`
--

CREATE TABLE `dish_detail` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Dish_id` int(10) UNSIGNED NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dish_detail`
--

INSERT INTO `dish_detail` (`ID`, `Dish_id`, `attribute`, `Price`, `Status`, `added_on`) VALUES
(48, 51, 'Chicken (Mayo)', 120, 1, '2022-11-10 00:00:00'),
(49, 51, 'Chicken (Garlic) ', 140, 1, '2022-11-10 00:00:00'),
(52, 53, 'Small', 150, 1, '2022-11-11 00:00:00'),
(53, 53, 'Large', 190, 1, '2022-11-11 00:00:00'),
(56, 55, 'With Cheese', 550, 1, '2022-11-11 00:00:00'),
(57, 55, 'Without Cheese', 450, 1, '2022-11-11 00:00:00'),
(58, 56, 'small', 400, 1, '2022-12-07 00:00:00'),
(59, 56, 'large', 40000, 1, '2022-12-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `AdminID` int(10) NOT NULL,
  `AdminUsername` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`AdminID`, `AdminUsername`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(6, ''),
(7, 'hyhy'),
(8, 'test4'),
(9, 'hyhy6'),
(10, ''),
(11, 'MZU'),
(12, ''),
(13, 'abc123'),
(14, ''),
(15, 'insha'),
(16, ''),
(17, 'ali124'),
(18, ''),
(19, 'abcabc@gmail.com'),
(20, ''),
(21, 'newname'),
(22, ''),
(23, 'newname');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `Order_id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `Dish_details_id` int(10) UNSIGNED NOT NULL,
  `voucher_id` varchar(10) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`ID`, `user`, `Order_id`, `qty`, `Dish_details_id`, `voucher_id`, `Price`) VALUES
(22, 10, 16, 4, 53, 'FMfBsX16', 760),
(23, 1, 17, 5, 53, 'bbCyvz17', 950),
(24, 4, 18, 10, 49, 'KWX6SY18', 1400),
(26, 1, 19, 1, 52, 'Lb5Jhh19', 150),
(27, 1, 19, 2, 48, 'Lb5Jhh19', 240),
(28, 4, 20, 1, 52, 'KNU6P920', 150),
(29, 12, 21, 4, 58, 'Ft813Z21', 1600),
(30, 1, 22, 1, 49, '86rMzx22', 140),
(31, 1, 23, 7, 52, 'nfhsep23', 1050);

--
-- Triggers `order_details`
--
DELIMITER $$
CREATE TRIGGER `insert_order_history` AFTER INSERT ON `order_details` FOR EACH ROW BEGIN
insert into order_history values(null,new.user,new.dish_Details_id,new.qty,new.Price);
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setVoucherID` BEFORE INSERT ON `order_details` FOR EACH ROW begin
set new.voucher_id =  CONCAT(SUBSTR(MD5(RAND()), 1, 6) , new.Order_id);
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `ID` int(10) UNSIGNED NOT NULL,
  `User_id` int(10) UNSIGNED NOT NULL,
  `Dish_details_id` int(10) UNSIGNED NOT NULL,
  `Qty` int(11) NOT NULL,
  `tot_Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`ID`, `User_id`, `Dish_details_id`, `Qty`, `tot_Price`) VALUES
(3, 1, 49, 2, 280),
(4, 1, 56, 5, 2750),
(6, 1, 52, 7, 1050),
(7, 1, 49, 10, 1400),
(8, 1, 49, 2, 280),
(9, 1, 49, 2, 280),
(10, 1, 53, 5, 950),
(11, 1, 49, 6, 840),
(12, 1, 53, 6, 1140),
(13, 1, 48, 6, 720),
(14, 1, 49, 10, 1400),
(15, 1, 53, 5, 950),
(16, 1, 49, 4, 560),
(17, 1, 49, 4, 560),
(18, 10, 53, 4, 760),
(19, 1, 53, 5, 950),
(20, 4, 49, 10, 1400),
(22, 1, 52, 1, 150),
(23, 1, 52, 1, 150),
(24, 1, 48, 2, 240),
(25, 1, 48, 2, 240),
(26, 4, 52, 1, 150),
(27, 4, 52, 1, 150),
(28, 12, 58, 4, 1600),
(29, 12, 58, 4, 1600),
(30, 1, 49, 1, 140),
(31, 1, 49, 1, 140),
(32, 1, 52, 7, 1050),
(33, 1, 52, 7, 1050);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` float NOT NULL,
  `gst` float NOT NULL DEFAULT 0,
  `delivery_boy_id` int(10) UNSIGNED NOT NULL,
  `Payment_address` varchar(200) NOT NULL,
  `payment_status` int(10) NOT NULL DEFAULT 0,
  `order_status` int(10) UNSIGNED NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`ID`, `user_id`, `total_price`, `gst`, `delivery_boy_id`, `Payment_address`, `payment_status`, `order_status`, `added_on`) VALUES
(16, 10, 760, 100, 14, 'House # L92 Block 13G Gulshane Iqbal karachi', 0, 1, '2022-11-25 00:00:00'),
(17, 1, 950, 100, 14, 'nhi btaunga', 1, 1, '2022-11-27 00:00:00'),
(18, 4, 1400, 100, 14, 'chup kr bey', 1, 2, '2022-11-27 00:00:00'),
(19, 1, 390, 100, 5, 'nhi btaunga', 0, 1, '2022-12-07 00:00:00'),
(20, 4, 150, 100, 14, 'chup kr bey', 0, 1, '2022-12-07 00:00:00'),
(21, 12, 1600, 100, 16, 'abc street', 0, 1, '2022-12-07 00:00:00'),
(22, 1, 140, 100, 17, 'nhi btaunga', 1, 2, '2022-12-08 00:00:00'),
(23, 1, 1050, 100, 14, 'nhi btaunga', 0, 1, '2022-12-08 00:00:00');

--
-- Triggers `order_master`
--
DELIMITER $$
CREATE TRIGGER `AssignDeliveryBoy` BEFORE INSERT ON `order_master` FOR EACH ROW BEGIN
set new.delivery_boy_id = (select id from delivery_boy order by RAND() limit 1);

end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_order_status` BEFORE INSERT ON `order_master` FOR EACH ROW BEGIN
set new.order_status = 0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_payment_status` BEFORE INSERT ON `order_master` FOR EACH ROW BEGIN
set new.payment_status = 0;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `ID` int(10) UNSIGNED NOT NULL,
  `order_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`ID`, `order_status`) VALUES
(1, 'Pending'),
(2, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile_num` varchar(13) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Name`, `Email`, `Mobile_num`, `Address`, `Password`, `added_on`, `status`) VALUES
(1, 'Muhammad Zunique', 'zunique101@gmail.com', '03142011072', 'nhi btaunga', 'zuni', '2022-10-18 09:46:49', 1),
(4, 'Laiba ', 'laibasheikh@gmail.com', '03101234567', 'chup kr bey', 'laiba', '2022-11-11 00:00:00', 1),
(5, 'Ali', 'ali@gmail.com', '03142015432', 'sheesh ', '1234', '2022-11-13 00:00:00', 1),
(6, 'Test User New', 'Test@gmail.com', '0314-2987654', 'ABC street', 'helo', '2022-11-24 00:00:00', 1),
(7, 'abc', 'abc@gmail.com', '03141234567', 'abc street', '1234', '2022-11-25 00:00:00', 1),
(9, 'HeloAbc', 'heloabc@gmail.com', '0314209567', 'New House', '4321', '2022-11-27 00:00:00', 1),
(10, 'Muhammad Zunique', 'k200145@gmail.com', '03142019876', 'House # L92 Block 13G Gulshane Iqbal karachi', '1234', '2022-11-25 00:00:00', 1),
(12, 'memon bdullah', 'abdu123@gmailc.om', '031421312131', 'abc street', '1234', '2022-12-07 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`) USING HASH,
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_FK` (`user_id`),
  ADD KEY `Dish_detail_FK` (`dish_detail_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `category` (`category`),
  ADD UNIQUE KEY `order_number` (`order_number`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Mobile_num` (`Mobile_num`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Dish` (`Dish`),
  ADD KEY `FK_CatID` (`category_id`);

--
-- Indexes for table `dish_detail`
--
ALTER TABLE `dish_detail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_dishID` (`Dish_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `oder_master_FK` (`Order_id`),
  ADD KEY `Dish_details_FK` (`Dish_details_id`),
  ADD KEY `user_FK3` (`user`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `User_FK2` (`User_id`),
  ADD KEY `Dish_detail_FK2` (`Dish_details_id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `delivery_boy_FK` (`delivery_boy_id`),
  ADD KEY `order_status` (`order_status`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Mobile_num` (`Mobile_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `dish_detail`
--
ALTER TABLE `dish_detail`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `AdminID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `Dish_detail_FK` FOREIGN KEY (`dish_detail_id`) REFERENCES `dish_detail` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `FK_CatID` FOREIGN KEY (`category_id`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dish_detail`
--
ALTER TABLE `dish_detail`
  ADD CONSTRAINT `FK_dishID` FOREIGN KEY (`Dish_id`) REFERENCES `dish` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `Dish_details_FK` FOREIGN KEY (`Dish_details_id`) REFERENCES `dish_detail` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oder_master_FK` FOREIGN KEY (`Order_id`) REFERENCES `order_master` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_FK3` FOREIGN KEY (`user`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `Dish_detail_FK2` FOREIGN KEY (`Dish_details_id`) REFERENCES `dish_detail` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_FK2` FOREIGN KEY (`User_id`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_master`
--
ALTER TABLE `order_master`
  ADD CONSTRAINT `delivery_boy_FK` FOREIGN KEY (`delivery_boy_id`) REFERENCES `delivery_boy` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_master_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_status` FOREIGN KEY (`order_status`) REFERENCES `order_status` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
