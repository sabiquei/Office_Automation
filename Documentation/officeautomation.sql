-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 30, 2018 at 06:30 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `officeautomation`
--

-- --------------------------------------------------------

--
-- Table structure for table `hod_info`
--

CREATE TABLE `hod_info` (
  `name` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `semester` int(5) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `ph` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `UserID` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL,
  `psw_repeat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `principal_info`
--

CREATE TABLE `principal_info` (
  `name` varchar(20) NOT NULL,
  `ph` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `UserID` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL,
  `psw_repeat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `name` int(30) NOT NULL,
  `dob` date NOT NULL,
  `sex` int(5) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `f_occupation` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `m_occupation` varchar(30) NOT NULL,
  `religion` varchar(20) NOT NULL,
  `caste` varchar(10) NOT NULL,
  `category` int(5) NOT NULL,
  `bgroup` varchar(12) NOT NULL,
  `aadhar` bigint(50) NOT NULL,
  `hname` varchar(20) NOT NULL,
  `plc` varchar(20) NOT NULL,
  `post` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `yoa` int(20) NOT NULL,
  `admno` int(30) NOT NULL,
  `register` int(30) NOT NULL,
  `course` varchar(20) NOT NULL,
  `semester` int(5) NOT NULL,
  `UserID` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL,
  `psw_repeat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutor_info`
--

CREATE TABLE `tutor_info` (
  `name` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `semester` int(5) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `mob` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `UserID` varchar(20) NOT NULL,
  `psw` varchar(20) NOT NULL,
  `psw_repeat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
