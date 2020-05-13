-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2020 at 06:36 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mail`
--

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `CourierID` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_bin NOT NULL,
  `Phone` int(15) NOT NULL,
  `URL` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`CourierID`, `Name`, `Phone`, `URL`) VALUES
(1, 'Kerry', 2147483647, 'www.kerry.com'),
(2, 'Thailand Post', 2147483647, 'www.thpost.com'),
(3, 'KNU', 5832929, 'www.sumitrknu.com'),
(4, 'Brew', 445892019, 'www.brew.com'),
(5, 'DKBA', 90898781, 'dkba.sakyawkyaw.com');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `ShipmentID` int(11) NOT NULL,
  `Recipient` varchar(50) COLLATE utf8_bin NOT NULL,
  `TrackingNumber` varchar(50) COLLATE utf8_bin NOT NULL,
  `Type` varchar(10) COLLATE utf8_bin NOT NULL,
  `CourierID` int(11) NOT NULL,
  `ArrivalDate` date NOT NULL,
  `PickupDate` date DEFAULT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`ShipmentID`, `Recipient`, `TrackingNumber`, `Type`, `CourierID`, `ArrivalDate`, `PickupDate`, `UserID`) VALUES
(2, 'Gabriel', '518593878KJLJLK', 'Box', 1, '2019-01-02', '2019-01-04', 1),
(4, 'Messi', '123KJL5KJ3LKJ', 'Letter', 1, '2019-02-18', '2019-02-19', 1),
(5, 'Where', '128397G9S8D7F', 'Gun', 3, '2005-01-01', '2005-08-01', 1),
(7, 'Hazard', '8798019283511', 'Parcel', 1, '2019-01-16', '2019-01-18', 1),
(8, 'Dybala', '123KLK7409817', 'Letter', 1, '2019-01-20', '2019-04-10', 1),
(11, 'Sela', '1KL76463KJK2J', 'Parcel', 3, '2018-09-26', '2018-10-01', 1),
(12, 'No one', '8970987ADSG9A', 'Letter', 1, '2017-10-14', '2017-10-19', 1),
(13, 'Tun Oo', '23587KLKJ6322', 'Bae Lae', 1, '2019-04-09', '2019-04-18', 1),
(15, 'Twin', '8909898JKJKJK', 'Letter', 2, '2019-04-23', '2019-04-24', 1),
(16, 'Black Sheep', '3899K89001', 'Bomb', 4, '2019-05-01', '2019-05-06', 1),
(17, 'Jino Kuplee', '987IOUI32', 'Rocket', 5, '2019-06-28', '2019-07-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(30) COLLATE utf8_bin NOT NULL,
  `Password` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`) VALUES
(1, 'gabriel', '4bd11f2c5462e8171328a9d2f01cb9c31c3bcc4b834f109a509d1f57bfc94770');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`CourierID`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`ShipmentID`),
  ADD KEY `CourierID` (`CourierID`) USING BTREE,
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `CourierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `ShipmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`CourierID`) REFERENCES `courier` (`CourierID`),
  ADD CONSTRAINT `shipment_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
