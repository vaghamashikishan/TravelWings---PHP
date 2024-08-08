-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2022 at 06:52 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flightdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedbacktb`
--

CREATE TABLE `feedbacktb` (
  `fdbackid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `feedbackDate` date NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedbacktb`
--

INSERT INTO `feedbacktb` (`fdbackid`, `pid`, `feedbackDate`, `subject`, `content`) VALUES
(27, 33, '2022-06-14', 'Convenient', 'The ticket booking process was easy and convenient.'),
(28, 33, '2022-06-16', 'Easy', 'This flight booking platform is so good ;)');

-- --------------------------------------------------------

--
-- Table structure for table `flighttb`
--

CREATE TABLE `flighttb` (
  `fid` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `fsource` varchar(255) NOT NULL,
  `fdest` varchar(255) NOT NULL,
  `business_seat_capacity` int(255) NOT NULL,
  `business_price` int(255) NOT NULL,
  `firstclass_seat_capacity` int(255) NOT NULL,
  `firstclass_price` int(255) NOT NULL,
  `economy_seat_capacity` int(255) NOT NULL,
  `economy_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flighttb`
--

INSERT INTO `flighttb` (`fid`, `fname`, `fsource`, `fdest`, `business_seat_capacity`, `business_price`, `firstclass_seat_capacity`, `firstclass_price`, `economy_seat_capacity`, `economy_price`) VALUES
(1, 'AirIndia', 'Mumbai', 'Surat', 5, 1000, 5, 1000, 5, 1003),
(2, 'AirIndia1', 'Surat', 'Mumbai', 5, 5000, 5, 6000, 5, 4000),
(3, 'AirIndia2', 'Delhi', 'Surat', 5, 2000, 5, 3000, 5, 1000),
(4, 'AirIndia3', 'Surat', 'Pune', 5, 5000, 5, 6500, 5, 4500),
(5, 'AirIndia4', 'Kashmir', 'Kanyakumari', 5, 6400, 5, 6500, 5, 4000),
(6, 'AirIndia5', 'Pune ', 'Surat', 5, 4500, 5, 5600, 5, 4000),
(9, 'AirIndia9', 'Pune', 'Bangalore', 5, 5000, 5, 7000, 5, 4000),
(10, 'AirIndia10', 'Pune', 'Kerala', 5, 7000, 5, 9800, 5, 5600),
(11, 'AirIndia11', 'Kerala', 'Surat', 5, 6540, 5, 7650, 5, 3450);

-- --------------------------------------------------------

--
-- Table structure for table `passengertb`
--

CREATE TABLE `passengertb` (
  `pid` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `passportno` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passengertb`
--

INSERT INTO `passengertb` (`pid`, `fname`, `lname`, `bdate`, `passportno`, `gender`, `email`, `pass`) VALUES
(33, 'Dhrumin', 'Patel', '2001-08-02', 'dhruvpass', 'Male', 'dhruminpatel@gmail.com', 'dhruv123'),
(34, 'Kishan', 'Vaghamashi', '2001-02-08', 'kishanpassport', 'Male', '88.dhruv.it2019@gmail.com', 'kishan123'),
(35, 'Darshit', 'Sorathiya', '2001-03-02', 'darshitpassport', 'Male', 'dhruvhpatel.mscit19@vnsgu.ac.in', 'darshit123'),
(36, 'Dhrumin', 'Patel', '2001-09-03', 'dhruminpass', 'Male', 'dhrumin123@gmail.com', 'dhrumin123'),
(37, 'Rahul', 'Maurya', '2001-08-03', 'rahulpass', 'Male', 'rahul123@gmail.com', 'rahul123'),
(38, 'Chirag', 'Padsala', '2001-03-09', 'chirag123', 'Male', 'chirag123@gmail.com', 'chirag123');

-- --------------------------------------------------------

--
-- Table structure for table `tickettb`
--

CREATE TABLE `tickettb` (
  `tid` int(255) NOT NULL,
  `pid` int(255) NOT NULL,
  `fid` int(255) NOT NULL,
  `pamt` int(255) NOT NULL,
  `pdate` date NOT NULL DEFAULT current_timestamp(),
  `Departure_Date` date NOT NULL DEFAULT current_timestamp(),
  `classtype` varchar(255) NOT NULL,
  `foodtype` varchar(255) NOT NULL,
  `pymt_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickettb`
--

INSERT INTO `tickettb` (`tid`, `pid`, `fid`, `pamt`, `pdate`, `Departure_Date`, `classtype`, `foodtype`, `pymt_id`, `status`) VALUES
(58, 33, 1, 5000, '2022-06-14', '2022-06-27', 'business', 'veg', 'pay_JhS3Iu1mxxTBN7', 'booked'),
(59, 33, 3, 6500, '2022-06-14', '2022-06-29', 'first', 'veg', 'pay_JhSDxNkAiUsibu', 'booked'),
(60, 33, 4, 6500, '2022-06-14', '2022-06-30', 'first', 'veg', 'pay_JhSFesgzJ7q3ed', 'booked'),
(61, 33, 4, 6500, '2022-06-14', '2022-06-29', 'first', 'veg', 'pay_JhSGU3FetcUV3b', 'cancelled'),
(62, 34, 1, 5000, '2022-06-15', '2022-06-27', 'economy', 'veg', 'pay_Jhe0vymnDlqeMQ', 'booked'),
(63, 35, 1, 4000, '2022-06-15', '2022-06-27', 'economy', 'veg', 'pay_Jhe4XfjtsrzGZG', 'booked'),
(64, 36, 1, 4000, '2022-06-15', '2022-06-27', 'economy', 'nonveg', 'pay_Jhe6NnPyMTZmyV', 'booked'),
(65, 37, 1, 4000, '2022-06-15', '2022-06-27', 'economy', 'veg', 'pay_Jhe9iz6NeCfewl', 'booked'),
(66, 38, 1, 4000, '2022-06-15', '2022-06-27', 'economy', 'veg', 'pay_JheCCpwb548dBr', 'booked'),
(67, 33, 4, 4000, '2022-06-15', '2022-06-30', 'economy', 'veg', 'pay_JheOwVGIcNvDxg', 'booked'),
(68, 33, 4, 6400, '2022-06-15', '2022-06-30', 'business', 'veg', 'pay_JhePbiH2wFIZNO', 'booked'),
(69, 34, 4, 6500, '2022-06-15', '2022-06-30', 'first', 'veg', 'pay_JheTU1mAxxDRjY', 'booked'),
(70, 34, 4, 6400, '2022-06-15', '2022-06-30', 'business', 'veg', 'pay_JheUKRvtcr5r8N', 'booked'),
(71, 34, 4, 4000, '2022-06-15', '2022-06-30', 'economy', 'veg', 'pay_JheVkTvQPtyORY', 'booked'),
(72, 35, 4, 6500, '2022-06-15', '2022-06-30', 'first', 'veg', 'pay_Jheb2kM4fTyW2G', 'booked'),
(73, 35, 4, 6400, '2022-06-15', '2022-06-30', 'business', 'veg', 'pay_Jhebg7ZRIVMLb1', 'booked'),
(74, 35, 4, 4000, '2022-06-15', '2022-06-30', 'economy', 'veg', 'pay_JhecPEY1JCPqey', 'booked'),
(75, 36, 4, 6500, '2022-06-15', '2022-06-30', 'first', 'veg', 'pay_JheeHpWvsQ0PVG', 'booked'),
(76, 36, 4, 6400, '2022-06-15', '2022-06-30', 'business', 'veg', 'pay_JhefytuskceE1V', 'booked'),
(77, 36, 4, 4000, '2022-06-15', '2022-06-30', 'economy', 'nonveg', 'pay_Jhegg9BpG1BazN', 'booked'),
(78, 37, 4, 6500, '2022-06-15', '2022-06-30', 'first', 'veg', 'pay_JheiNerxpmb3kf', 'booked'),
(79, 37, 4, 6400, '2022-06-15', '2022-06-30', 'business', 'veg', 'pay_JhevQsvqfSkwtu', 'booked'),
(80, 37, 4, 4000, '2022-06-15', '2022-06-30', 'economy', 'veg', 'pay_Jhew9qwpajNsfg', 'booked'),
(81, 33, 1, 1000, '2022-06-16', '2022-06-30', 'first', 'veg', 'pay_JiFoBHrHTfCSnY', 'cancelled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedbacktb`
--
ALTER TABLE `feedbacktb`
  ADD PRIMARY KEY (`fdbackid`),
  ADD KEY `feedbacktb_ibfk_1` (`pid`);

--
-- Indexes for table `flighttb`
--
ALTER TABLE `flighttb`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `passengertb`
--
ALTER TABLE `passengertb`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tickettb`
--
ALTER TABLE `tickettb`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `tickettb_ibfk_2` (`pid`),
  ADD KEY `fid` (`fid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedbacktb`
--
ALTER TABLE `feedbacktb`
  MODIFY `fdbackid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `flighttb`
--
ALTER TABLE `flighttb`
  MODIFY `fid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `passengertb`
--
ALTER TABLE `passengertb`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tickettb`
--
ALTER TABLE `tickettb`
  MODIFY `tid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedbacktb`
--
ALTER TABLE `feedbacktb`
  ADD CONSTRAINT `feedbacktb_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `passengertb` (`pid`) ON DELETE CASCADE;

--
-- Constraints for table `tickettb`
--
ALTER TABLE `tickettb`
  ADD CONSTRAINT `tickettb_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `passengertb` (`pid`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickettb_ibfk_3` FOREIGN KEY (`fid`) REFERENCES `flighttb` (`fid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
