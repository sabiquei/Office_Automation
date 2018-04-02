-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 31, 2018 at 04:37 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
-- Table structure for table `pending_requests_other`
--

CREATE TABLE `pending_requests_other` (
  `request_no` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `body` varchar(500) NOT NULL,
  `levels` int(3) NOT NULL,
  `tutor_id` int(20) NOT NULL,
  `hod_id` int(20) NOT NULL
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
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(8) NOT NULL,
  `father` varchar(30) NOT NULL,
  `f_occupation` varchar(30) NOT NULL,
  `mother` varchar(30) NOT NULL,
  `m_occupation` varchar(30) NOT NULL,
  `category` varchar(5) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `aadhar` bigint(20) NOT NULL,
  `house_name` varchar(20) NOT NULL,
  `place` varchar(20) NOT NULL,
  `post_office` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `yoa` int(20) NOT NULL,
  `admission_no` varchar(20) NOT NULL,
  `register_no` bigint(10) NOT NULL,
  `course` varchar(30) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`name`, `dob`, `sex`, `father`, `f_occupation`, `mother`, `m_occupation`, `category`, `blood_group`, `aadhar`, `house_name`, `place`, `post_office`, `district`, `mobile`, `email`, `yoa`, `admission_no`, `register_no`, `course`, `semester`, `user_id`, `password`) VALUES
('Muhammed Sabique', '1996-02-29', 'male', 'Father', 'Job', 'Mother', 'Job', 'Gener', 'o+', 12345678, 'House Name', 'Place', 'Post Office', 'Kannur', 7012334186, 'sabique@live.com', 2012, 'CEMP CS 123', 144200123, 'CSE', 'S8', 'sabique', '5f4dcc3b5aa765d61d8327deb882cf99'),
('user 2', '1996-01-01', 'female', 'fatehr', 'job', 'mother', 'job', 'Gener', 'a', 22332, 'jfsl', 'dfjl', 'fjslj', 'dfjalk', 2321, 'sasdk', 34, '34', 23432, 'cse', 's8', 'user2', '7e58d63b60197ceb55a1c487989a3720');

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
