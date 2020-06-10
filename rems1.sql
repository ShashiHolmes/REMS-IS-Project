-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2020 at 08:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rems1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `passcode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_email`, `name`, `contact`, `address`, `passcode`) VALUES
('msshashi21@gmail.com', 'Shashi Kumar', 1234567890, 'NITK', '2k16nitk'),
('sanathramesh55@gmail.com', 'Sanath Ramesh', 2147483647, 'NITK', '2k16nitk');

-- --------------------------------------------------------

--
-- Table structure for table `booking1`
--

CREATE TABLE `booking1` (
  `bid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `b_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking2`
--

CREATE TABLE `booking2` (
  `pid` int(11) NOT NULL,
  `o_email` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `trans_ref` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `property1`
--

CREATE TABLE `property1` (
  `pid` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property1`
--

INSERT INTO `property1` (`pid`, `email`) VALUES
(173, 'sanat@gmail.com'),
(174, 'shashi@gmail.com'),
(175, 'shashi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `property2`
--

CREATE TABLE `property2` (
  `pid` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `location` int(10) NOT NULL,
  `price` int(10) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(20) NOT NULL,
  `key_code` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'unsold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property2`
--

INSERT INTO `property2` (`pid`, `pname`, `location`, `price`, `description`, `image`, `key_code`, `status`) VALUES
(173, 'Sam Towers', 575025, 10000000, 'This immaculate, professionally-designed 2-story condo with a private deck and patio invites comfort, and exudes modern elegance. With 2 bedrooms, 2 and a half baths, generous living space and stylish finishes, you\'ll enjoy a perfect setting for relaxing and entertaining.', 'download (1).jfif', '81dc9bdb52d04dc20036dbd8313ed055', 'unsold'),
(174, 'Arunodaya Builders', 654321, 13000000, 'The living is easy in this impressive, generously proportioned contemporary residence with lake and ocean views, located within a level stroll to the sand and surf.', 'download (3).jfif', '81dc9bdb52d04dc20036dbd8313ed055', 'unsold'),
(175, 'Holmes\' Group', 577228, 30000000, 'Cool, calm and sophisticated with a youthful edge, this functional home is enveloped in light and comfort. Crisp white walls, timber floors and high ceilings create a style as timeless as the sparkling ocean view. The calming sea vista, captured through the extensive use of glass, will help you forget your city stress.', 'download.jfif', '81dc9bdb52d04dc20036dbd8313ed055', 'unsold');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `premium` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `contact`, `address`, `question`, `answer`, `image`, `premium`) VALUES
('Kiran', 'kiran@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '8877665544', 'Karnataka', 'what is your fav game', 'call of duty', '', 'yes'),
('Sanat Ramesh', 'sanat@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'NITK', 'favourite food', 'cheese burger', '', 'no'),
('Shashi Kumar', 'shashi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9876543210', 'NITK, Surathkal', 'favourite game', 'pubg mobile', '', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_email`);

--
-- Indexes for table `booking1`
--
ALTER TABLE `booking1`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `email` (`b_email`);

--
-- Indexes for table `booking2`
--
ALTER TABLE `booking2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `o_email` (`o_email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `trans_ref` (`trans_ref`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `property1`
--
ALTER TABLE `property1`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `property2`
--
ALTER TABLE `property2`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking1`
--
ALTER TABLE `booking1`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `booking2`
--
ALTER TABLE `booking2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `property1`
--
ALTER TABLE `property1`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `property2`
--
ALTER TABLE `property2`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking1`
--
ALTER TABLE `booking1`
  ADD CONSTRAINT `booking1_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `property2` (`pid`),
  ADD CONSTRAINT `booking1_ibfk_2` FOREIGN KEY (`b_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `booking2`
--
ALTER TABLE `booking2`
  ADD CONSTRAINT `booking2_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `property2` (`pid`),
  ADD CONSTRAINT `booking2_ibfk_2` FOREIGN KEY (`o_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `booking1` (`bid`);

--
-- Constraints for table `property1`
--
ALTER TABLE `property1`
  ADD CONSTRAINT `property1_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
