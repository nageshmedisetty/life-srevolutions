-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 04:54 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `charity`
--

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `commission` decimal(24,8) NOT NULL,
  `type` int(11) NOT NULL,
  `comm_userId` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `querydata` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `diposits`
--

CREATE TABLE `diposits` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `amount` decimal(24,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diposits`
--

INSERT INTO `diposits` (`id`, `memberId`, `amount`, `description`, `created_by`, `created_on`, `updated_by`, `updated_on`, `status`) VALUES
(1, 1047, '5000.00', 'Diposits', 1, '2023-07-31 19:49:46', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pin_numbers`
--

CREATE TABLE `pin_numbers` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `refcode` varchar(15) NOT NULL,
  `pin` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pin_numbers`
--

INSERT INTO `pin_numbers` (`id`, `date`, `refcode`, `pin`, `status`) VALUES
(1, '2023-03-30 12:14:22', 'BP146913', 12345, 3),
(19, '2023-03-30 12:14:22', 'BP3596488', 12345, 3),
(20, '2023-06-29 15:25:00', 'BP3533375', 5555, 3),
(21, '2023-06-29 15:25:00', 'BP3289892', 9999, 3),
(22, '2023-06-29 15:28:14', 'BP4534866', 1111, 1),
(23, '2023-06-29 15:28:14', 'BP1137402', 2222, 1),
(24, '2023-07-31 12:32:07', '', 123, 1),
(25, '2023-07-31 12:32:50', '', 9630, 1);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `refcode` varchar(60) NOT NULL,
  `memtype` tinyint(4) NOT NULL COMMENT '1->Vendor, 2->customer',
  `name` varchar(160) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `referenceId` int(11) NOT NULL DEFAULT 0,
  `refId3` int(11) NOT NULL,
  `refId2` int(11) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 1,
  `payment_status` tinyint(1) NOT NULL DEFAULT 1,
  `plan` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `jdate` date DEFAULT NULL,
  `path` text NOT NULL,
  `image` text NOT NULL,
  `pan` varchar(30) NOT NULL,
  `aadhar` varchar(35) NOT NULL,
  `accno` varchar(90) NOT NULL,
  `bankname` varchar(120) NOT NULL,
  `ifsc` varchar(30) NOT NULL,
  `bankbranch` varchar(150) NOT NULL,
  `panfront` text NOT NULL,
  `panback` text NOT NULL,
  `aadharfront` text NOT NULL,
  `aadharback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `refcode`, `memtype`, `name`, `email`, `username`, `password`, `phone`, `address`, `referenceId`, `refId3`, `refId2`, `active_status`, `payment_status`, `plan`, `status`, `jdate`, `path`, `image`, `pan`, `aadhar`, `accno`, `bankname`, `ifsc`, `bankbranch`, `panfront`, `panback`, `aadharfront`, `aadharback`) VALUES
(1, 'UR8674092', 1, 'Administrator', 'admin@gmail.com', 'admin', 'fb0eec58ddc2c6caaa5e5c33d6a25ece', '9866022961', '#50-92-32/1,santipuram,visakhapatnam,530016', 0, 0, 0, 1, 1, 0, 1, '2021-07-07', 'uploads/items/0a113.jpg', '38286.jpg', '', '', '', '', '', '', '', '', '', ''),
(1047, 'BP9656503', 1, 'Nagesh Medisetty', 'vownagesh@vowerp.com', 'BP9656503', '675c015f312014a13a413443488f2fbd', '9177012346', 'Maddilapalem, VSKP', 1, 1, 1, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1048, 'BP7557560', 1, 'Rajesh Alluri', 'rajesh_alluri@gmail.com', 'BP7557560', '675c015f312014a13a413443488f2fbd', '9247916929', 'Maddilapalem, VSKP', 1047, 1047, 1047, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1049, 'BP5495380', 1, 'Kurma Rao', 'kurma@vowerp.com', 'BP5495380', '675c015f312014a13a413443488f2fbd', '9632587410', 'Madhurawada', 1047, 1047, 1047, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1050, 'BP950810', 1, 'Goush Baba', 'goush@vowerp.com', 'BP950810', '675c015f312014a13a413443488f2fbd', '9258741003', 'Maddilapalem, VSKP', 1047, 1047, 1048, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1051, 'BP4175918', 1, 'Baskar Ramesh', 'baskar@vowerp.com', 'BP4175918', '675c015f312014a13a413443488f2fbd', '7412586903', 'Maddilapalem, VSKP', 1047, 1048, 1048, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1052, 'BP4086779', 1, 'Bujji', 'bujji809@gmail.com', 'BP4086779', '675c015f312014a13a413443488f2fbd', '7455000200', 'Maddilapalem, VSKP', 1047, 1048, 1049, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1053, 'BP3022224', 1, 'Javeed Basha', 'javeed@vowerp.com', 'BP3022224', '675c015f312014a13a413443488f2fbd', '8887444122', 'Maddilapalem, VSKP', 1047, 1049, 1050, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1054, 'BP753521', 1, 'Bhavya', 'bhavya@vowerp.com', 'BP753521', '675c015f312014a13a413443488f2fbd', '9888787885', 'Maddilapalem, VSKP', 1047, 1048, 1049, 1, 1, 0, 1, '2023-07-12', '', '', '', '', '', '', '', '', '', '', '', ''),
(1055, 'BP4363797', 1, 'Hima', 'himajk123@gmail.com', 'BP4363797', '675c015f312014a13a413443488f2fbd', '7444445555', 'Madhurawada', 1049, 1049, 1052, 1, 1, 0, 1, '2023-07-12', '', '', '125462222555', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `valumepoints`
--

CREATE TABLE `valumepoints` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `value` decimal(24,8) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `pvtype` int(11) NOT NULL,
  `grppv` decimal(24,8) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_register`
-- (See below for the actual view)
--
CREATE TABLE `view_register` (
`id` int(11)
,`refcode` varchar(60)
,`memtype` tinyint(4)
,`name` varchar(160)
,`email` text
,`username` varchar(60)
,`password` text
,`phone` varchar(12)
,`pan` varchar(30)
,`aadhar` varchar(35)
,`accno` varchar(90)
,`bankname` varchar(120)
,`ifsc` varchar(30)
,`bankbranch` varchar(150)
,`address` text
,`referenceId` int(11)
,`active_status` tinyint(1)
,`payment_status` tinyint(1)
,`plan` tinyint(1)
,`status` tinyint(1)
,`jdate` date
,`path` text
,`image` text
,`panfront` text
,`panback` text
,`aadharfront` text
,`aadharback` text
,`member` varchar(4)
,`walletamt` decimal(46,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `wallet_amt` decimal(24,2) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `payment_active` tinyint(1) NOT NULL,
  `order_id` text NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `amount` decimal(24,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`id`, `memberId`, `amount`, `description`, `created_by`, `created_on`, `updated_by`, `updated_on`, `status`) VALUES
(1, 1047, '2500.00', 'wertyuio', 1, '2023-07-31 19:49:46', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure for view `view_register`
--
DROP TABLE IF EXISTS `view_register`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_register`  AS SELECT `register`.`id` AS `id`, `register`.`refcode` AS `refcode`, `register`.`memtype` AS `memtype`, `register`.`name` AS `name`, `register`.`email` AS `email`, `register`.`username` AS `username`, `register`.`password` AS `password`, `register`.`phone` AS `phone`, `register`.`pan` AS `pan`, `register`.`aadhar` AS `aadhar`, `register`.`accno` AS `accno`, `register`.`bankname` AS `bankname`, `register`.`ifsc` AS `ifsc`, `register`.`bankbranch` AS `bankbranch`, `register`.`address` AS `address`, `register`.`referenceId` AS `referenceId`, `register`.`active_status` AS `active_status`, `register`.`payment_status` AS `payment_status`, `register`.`plan` AS `plan`, `register`.`status` AS `status`, `register`.`jdate` AS `jdate`, `register`.`path` AS `path`, `register`.`image` AS `image`, `register`.`panfront` AS `panfront`, `register`.`panback` AS `panback`, `register`.`aadharfront` AS `aadharfront`, `register`.`aadharback` AS `aadharback`, CASE WHEN `register`.`memtype` = 1 THEN 'User' WHEN `register`.`memtype` = 3 THEN 'User' ELSE 'User' END AS `member`, (select coalesce(sum(`wallet`.`wallet_amt`),0) from `wallet` where `wallet`.`userId` = `register`.`id`) AS `walletamt` FROM `register` WHERE `register`.`status` = 1 AND `register`.`id` <> 1111 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diposits`
--
ALTER TABLE `diposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin_numbers`
--
ALTER TABLE `pin_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valumepoints`
--
ALTER TABLE `valumepoints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diposits`
--
ALTER TABLE `diposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pin_numbers`
--
ALTER TABLE `pin_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1056;

--
-- AUTO_INCREMENT for table `valumepoints`
--
ALTER TABLE `valumepoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
