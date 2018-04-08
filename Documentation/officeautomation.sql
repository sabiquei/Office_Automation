-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 08, 2018 at 06:13 AM
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
  `name` varchar(20) NOT NULL,
  `designation` varchar(25) NOT NULL DEFAULT 'Head of the Department',
  `department` varchar(5) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod_info`
--

INSERT INTO `hod_info` (`name`, `designation`, `department`, `mobile`, `email`, `user_id`, `password`) VALUES
('HOD EC', 'Head of the Department', '412', 1234556, 'hodec@a.com', 'hodec', '5f4dcc3b5aa765d61d8327deb882cf99'),
('HOD CS', 'HOD', '415', 32432, 'dfksf@dsjfs.com', 'newhod', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `no_due_requests`
--

CREATE TABLE `no_due_requests` (
  `request_no` int(10) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `415` int(1) NOT NULL DEFAULT '0' COMMENT 'Status',
  `415_remarks` varchar(100) NOT NULL DEFAULT 'Pending',
  `411` int(1) NOT NULL DEFAULT '0' COMMENT 'Status',
  `411_remarks` varchar(100) NOT NULL DEFAULT 'Pending',
  `412` int(1) NOT NULL DEFAULT '0' COMMENT 'Status',
  `412_remarks` varchar(100) NOT NULL DEFAULT 'Pending',
  `416` int(1) NOT NULL DEFAULT '0' COMMENT 'Status',
  `416_remarks` varchar(100) NOT NULL DEFAULT 'Pending',
  `401` int(1) NOT NULL DEFAULT '0' COMMENT 'Status',
  `401_remarks` varchar(100) NOT NULL DEFAULT 'Pending',
  `403` int(1) NOT NULL DEFAULT '0' COMMENT 'Status',
  `403_remarks` varchar(100) NOT NULL DEFAULT 'Pending',
  `other_status` int(11) NOT NULL DEFAULT '1',
  `other_remarks` varchar(50) NOT NULL DEFAULT 'No Dues'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `no_due_requests`
--

INSERT INTO `no_due_requests` (`request_no`, `student_id`, `415`, `415_remarks`, `411`, `411_remarks`, `412`, `412_remarks`, `416`, `416_remarks`, `401`, `401_remarks`, `403`, `403_remarks`, `other_status`, `other_remarks`) VALUES
(1, 'sabique', 1, 'No Dues', 0, 'Pending', 1, 'No Dues', 0, 'Pending', 0, 'Pending', 0, 'Pending', 1, 'No Dues'),
(2, 'ashraya', 1, 'Accepted No Dues', 0, 'Pending', 2, 'Complete Lab Dues', 0, 'Pending', 0, 'Pending', 0, 'Pending', 1, 'No Dues'),
(3, 'rishiprasadriz', 1, 'sdjfklds', 0, 'Pending', 0, 'Pending', 0, 'Pending', 0, 'Pending', 0, 'Pending', 1, 'No Dues');

-- --------------------------------------------------------

--
-- Table structure for table `pending_requests_other`
--

CREATE TABLE `pending_requests_other` (
  `request_no` int(10) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `levels` int(3) NOT NULL,
  `tutor_id` varchar(20) NOT NULL,
  `hod_id` varchar(20) NOT NULL,
  `current_level` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `remarks` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pending_requests_other`
--

INSERT INTO `pending_requests_other` (`request_no`, `student_id`, `date`, `subject`, `category`, `body`, `levels`, `tutor_id`, `hod_id`, `current_level`, `status`, `remarks`) VALUES
(4, 'sabique', '2018-04-02 12:02:08', 'another one', 'Other', 'sadlfjsadkjflasd  ', 1, 'teacher1', 'newhod', 0, 0, ''),
(5, 'ashraya', '2018-04-02 12:03:51', 'sdfdsfdsf', 'Other', '  sdsdfadsfasfdadfsa', 1, 'teacher1', 'newhod', 1, 1, 'My remarks'),
(6, 'sabique', '2018-04-02 12:30:21', 'hello', 'Other', 'hiii  ', 1, 'teacher1', 'newhod', 0, 0, ''),
(7, 'ashraya', '2018-04-03 10:11:29', 'Leave Letter', 'Other', 'Hi,\r\n  I will be absent on 3rd April.', 3, 'teacher1', 'newhod', 3, 1, 'Accepted'),
(8, 'sabique', '2018-04-03 13:07:19', 'Late Assignment Submission', 'Other', 'Hi, \r\n  I was not able to submit my assignment on time due to personal reasons. \r\n\r\n\r\nThank You', 1, 'teacher1', 'newhod', 0, 0, ''),
(9, 'sabique', '2018-04-06 03:54:46', 'Leave Letter', 'Other', 'dskfjldkasfjlasdkjfsa]f\r\nsadfsadfdshjf\'asfl\r\nds\r\ndsvsdkvsad\r\nv]\r\ndjvksdfkldsjfldshgerpog fd\r\nva klkdj\r\n  ', 1, 'teacher1', 'newhod', 0, 2, 'Rejected because it\'s all garbage'),
(10, 'rishiprasadriz', '2018-04-07 08:53:50', 'jhsgad', 'Other', '  kagdkadlahj akjd cmabakukb buhk bak ja ka', 1, 'teacher1', 'newhod', 1, 1, 'Okay');

-- --------------------------------------------------------

--
-- Table structure for table `principal_info`
--

CREATE TABLE `principal_info` (
  `name` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `principal_info`
--

INSERT INTO `principal_info` (`name`, `mobile`, `email`, `user_id`, `password`) VALUES
('CEMP Principal', 9000090000, 'principal@cemp.com', 'principal', '5f4dcc3b5aa765d61d8327deb882cf99');

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
  `password` varchar(256) NOT NULL,
  `image_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`name`, `dob`, `sex`, `father`, `f_occupation`, `mother`, `m_occupation`, `category`, `blood_group`, `aadhar`, `house_name`, `place`, `post_office`, `district`, `mobile`, `email`, `yoa`, `admission_no`, `register_no`, `course`, `semester`, `user_id`, `password`, `image_path`) VALUES
('Another User', '1996-02-29', 'male', 'Father', 'Job', 'Mother', 'Occupation', 'OBC', 'O+', 324832, 'HOuse', 'Place', 'Post Office', 'District', 7560961356, 'user@game.com', 2014, '2011', 2432432, '415', 'S8', 'new_user', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
('Muhammed Sabique M P', '1996-11-20', 'male', 'Bichikoya M P', 'Driver', 'Safiya K', 'Home Maker', 'Gener', 'O+', 123456789, 'B S Nivas', 'North Pally', 'G A College', 'Kozhikode', 7012334186, 'sabique@live.com', 2014, 'CEMP CS 52', 14420028, '415', 'S8', 'sabique', '5f4dcc3b5aa765d61d8327deb882cf99', ''),
('Ashraya K K', '1995-09-14', 'female', 'Devadas K K', 'Driver', 'Geetha', 'Home Maker', 'OEC', 'O+', 0, 'House', 'Place', 'PO', 'Kannur', 7025621881, 'ashrayakk09@gmail.com', 2014, '15', 14420015, '415', 'S8', 'ashraya', '5f4dcc3b5aa765d61d8327deb882cf99', '../../images/student_profile/ashraya.jpg'),
('Rishi Prasad ', '1996-01-20', 'male', 'Prasad', 'SI', 'Selna', 'Private engineer', 'OBC', 'o+', 0, 'jgd', 'hasd', 'lasd', 'kugkau', 7012939014, 'rishiprasadriz@gmail.com', 2014, '60', 14420036, '415', 'S8', 'rishiprasadriz', '6eea9b7ef19179a06954edd0f6c05ceb', '../../images/student_profile/rishiprasadriz.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_info`
--

CREATE TABLE `tutor_info` (
  `name` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `department` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor_info`
--

INSERT INTO `tutor_info` (`name`, `designation`, `semester`, `department`, `mobile`, `email`, `user_id`, `password`) VALUES
('EC Teacher 1', 'Tutor', 'S8', '412', 9000090000, 'ecteacher@gmail.com', 'ecs8tutor', '5f4dcc3b5aa765d61d8327deb882cf99'),
('Teacher1', 'Tutor', 'S8', '415', 999999, 'teacher1@gmail.com', 'teacher1', '5f4dcc3b5aa765d61d8327deb882cf99'),
('Teacher 2', 'Tutor', 'S2', '411', 12345678, 'hahha@gmail.com', 'teacher2', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hod_info`
--
ALTER TABLE `hod_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `no_due_requests`
--
ALTER TABLE `no_due_requests`
  ADD PRIMARY KEY (`request_no`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `pending_requests_other`
--
ALTER TABLE `pending_requests_other`
  ADD PRIMARY KEY (`request_no`);

--
-- Indexes for table `tutor_info`
--
ALTER TABLE `tutor_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `no_due_requests`
--
ALTER TABLE `no_due_requests`
  MODIFY `request_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pending_requests_other`
--
ALTER TABLE `pending_requests_other`
  MODIFY `request_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;