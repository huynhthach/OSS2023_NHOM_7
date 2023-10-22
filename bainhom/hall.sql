-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2023 at 10:27 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hall`
--

-- --------------------------------------------------------

--
-- Table structure for table `itemcategories`
--

CREATE TABLE `itemcategories` (
  `CategoryID` varchar(10) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(255) DEFAULT NULL,
  `ItemCategory` varchar(10) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newscategories`
--

CREATE TABLE `newscategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsdetails`
--

CREATE TABLE `newsdetails` (
  `NewsID` int(11) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `Content` varchar(500) DEFAULT NULL,
  `ThuTu` int(11) DEFAULT NULL,
  `Form` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owneditems`
--

CREATE TABLE `owneditems` (
  `ItemID` int(11) DEFAULT NULL,
  `OwnerID` int(11) DEFAULT NULL,
  `NgaySoHuu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `RecieptID` int(11) NOT NULL,
  `UserIDBuy` int(11) DEFAULT NULL,
  `UserIDSell` int(11) DEFAULT NULL,
  `RecieptDate` datetime DEFAULT NULL,
  `TotalAmount` int(11) DEFAULT NULL,
  `CategoryReceiptID` varchar(10) DEFAULT NULL,
  `State` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recieptcategories`
--

CREATE TABLE `recieptcategories` (
  `CategoryID` varchar(10) NOT NULL,
  `CategoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recieptdetails`
--

CREATE TABLE `recieptdetails` (
  `DetailID` int(11) NOT NULL,
  `RecieptID` int(11) DEFAULT NULL,
  `ItemID` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NgayTao` datetime DEFAULT NULL,
  `IDRole` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `Rank` varchar(10) DEFAULT NULL,
  `SoDu` int(11) DEFAULT NULL,
  `Win` int(11) DEFAULT NULL,
  `image` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itemcategories`
--
ALTER TABLE `itemcategories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `ItemCategory` (`ItemCategory`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NewsID`),
  ADD KEY `AuthorID` (`AuthorID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `newscategories`
--
ALTER TABLE `newscategories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `newsdetails`
--
ALTER TABLE `newsdetails`
  ADD KEY `NewsID` (`NewsID`);

--
-- Indexes for table `owneditems`
--
ALTER TABLE `owneditems`
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`RecieptID`),
  ADD KEY `UserIDBuy` (`UserIDBuy`),
  ADD KEY `UserIDSell` (`UserIDSell`),
  ADD KEY `CategoryReceiptID` (`CategoryReceiptID`);

--
-- Indexes for table `recieptcategories`
--
ALTER TABLE `recieptcategories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `recieptdetails`
--
ALTER TABLE `recieptdetails`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `RecieptID` (`RecieptID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `IDRole` (`IDRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newscategories`
--
ALTER TABLE `newscategories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `RecieptID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recieptdetails`
--
ALTER TABLE `recieptdetails`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`ItemCategory`) REFERENCES `itemcategories` (`CategoryID`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `news_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `newscategories` (`CategoryID`);

--
-- Constraints for table `newsdetails`
--
ALTER TABLE `newsdetails`
  ADD CONSTRAINT `newsdetails_ibfk_1` FOREIGN KEY (`NewsID`) REFERENCES `news` (`NewsID`);

--
-- Constraints for table `owneditems`
--
ALTER TABLE `owneditems`
  ADD CONSTRAINT `owneditems_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`),
  ADD CONSTRAINT `owneditems_ibfk_2` FOREIGN KEY (`OwnerID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`UserIDBuy`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`UserIDSell`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `receipt_ibfk_3` FOREIGN KEY (`CategoryReceiptID`) REFERENCES `recieptcategories` (`CategoryID`);

--
-- Constraints for table `recieptdetails`
--
ALTER TABLE `recieptdetails`
  ADD CONSTRAINT `recieptdetails_ibfk_1` FOREIGN KEY (`RecieptID`) REFERENCES `receipt` (`RecieptID`),
  ADD CONSTRAINT `recieptdetails_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`IDRole`) REFERENCES `roles` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
