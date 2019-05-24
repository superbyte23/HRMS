-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 06:41 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsevenstar_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `value` tinyint(1) NOT NULL COMMENT 'Enable / Disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `menu`, `value`) VALUES
(1, 'Insert Old Records', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `id` int(11) NOT NULL COMMENT 'unique ID',
  `guest_name` varchar(100) NOT NULL COMMENT 'guest full name',
  `guest_address` varchar(100) NOT NULL COMMENT 'guest adress',
  `guest_contact` double NOT NULL COMMENT 'guest contact number',
  `guest_arrival` varchar(20) NOT NULL COMMENT 'guest arrival date',
  `end_reserve_date` varchar(203) NOT NULL,
  `room_type` int(11) NOT NULL COMMENT 'room type ID',
  `room_number` varchar(11) NOT NULL COMMENT 'room number ID',
  `guest_check_in` varchar(20) NOT NULL COMMENT 'guest check-in',
  `guest_check_out` varchar(20) NOT NULL COMMENT 'guest check-out',
  `number_of_nights` int(11) NOT NULL COMMENT 'total number of nights',
  `extra_bed` int(11) NOT NULL,
  `extra_person` int(11) NOT NULL,
  `extra_pillow` int(11) NOT NULL,
  `extra_blanket` int(11) NOT NULL,
  `extra_towel` int(11) NOT NULL,
  `trans_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

CREATE TABLE `tbl_rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `room_type` int(11) NOT NULL,
  `room_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`room_id`, `room_number`, `room_type`, `room_status`) VALUES
(1, '201', 1, 'active'),
(2, '203', 1, 'inactive'),
(3, '204', 1, 'inactive'),
(4, '205', 1, 'inactive'),
(5, '209', 1, 'inactive'),
(6, '215', 1, 'inactive'),
(7, '216', 1, 'inactive'),
(8, '217', 1, 'inactive'),
(9, '101', 16, 'inactive'),
(10, '102', 16, 'inactive'),
(11, '103', 16, 'inactive'),
(12, '104', 16, 'inactive'),
(13, '105', 16, 'inactive'),
(14, '106', 16, 'inactive'),
(15, '107', 16, 'inactive'),
(16, '108', 16, 'inactive'),
(17, '109', 16, 'inactive'),
(18, '110', 16, 'inactive'),
(19, '111', 16, 'inactive'),
(20, '112', 16, 'inactive'),
(21, '113', 16, 'inactive'),
(22, '114', 16, 'inactive'),
(23, '115', 16, 'inactive'),
(24, '116', 16, 'inactive'),
(25, '207', 17, 'inactive'),
(26, '208', 17, 'inactive'),
(27, '210', 17, 'inactive'),
(28, '211', 17, 'inactive'),
(29, '212', 17, 'inactive'),
(30, '214', 17, 'inactive'),
(31, '202', 18, 'inactive'),
(32, '218', 20, 'inactive'),
(33, '206', 19, 'inactive'),
(34, '220', 19, 'inactive'),
(35, '219', 19, 'inactive'),
(36, 'Function Hall', 21, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room_type`
--

CREATE TABLE `tbl_room_type` (
  `rm_type_id` int(11) NOT NULL,
  `rm_type_name` varchar(100) NOT NULL,
  `rm_type_pricing` varchar(100) NOT NULL,
  `rm_type_desc` varchar(100) NOT NULL,
  `rm_type_cover_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_room_type`
--

INSERT INTO `tbl_room_type` (`rm_type_id`, `rm_type_name`, `rm_type_pricing`, `rm_type_desc`, `rm_type_cover_img`) VALUES
(1, 'Standard', '900', 'Standard Room with 1 Bed', 'assets/images/rooms/architect.jpg'),
(16, 'Superior', '1200', 'Superior with Queen Bed', 'assets/images/rooms/room_double.jpg'),
(17, 'Mini Superior', '1000', 'Mini Superior Bedroom with mini Queen Bed', 'assets/images/rooms/room_deluxe.jpg'),
(18, 'Deluxe', '1400', 'Deluxe bedroom with king bed', 'assets/images/rooms/livingroom2.jpg'),
(19, 'Family Deluxe', '2500', 'Family Deluxe', 'assets/images/rooms/diningroom.jpg'),
(20, 'Family', '1800', 'Family Bedroom', 'assets/images/rooms/FB_IMG_15273702816219420.jpg'),
(21, 'Function Hall', '2000', 'Full Air Conditioned', 'assets/images/rooms/FB_IMG_15266988541027765.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_type`
--

CREATE TABLE `tbl_transaction_type` (
  `id` int(11) NOT NULL,
  `trans_name` varchar(100) NOT NULL,
  `trans_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaction_type`
--

INSERT INTO `tbl_transaction_type` (`id`, `trans_name`, `trans_desc`) VALUES
(1, 'Reservation', ''),
(2, 'Short-Time', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tbl_room_type`
--
ALTER TABLE `tbl_room_type`
  ADD PRIMARY KEY (`rm_type_id`);

--
-- Indexes for table `tbl_transaction_type`
--
ALTER TABLE `tbl_transaction_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique ID';

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_room_type`
--
ALTER TABLE `tbl_room_type`
  MODIFY `rm_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_transaction_type`
--
ALTER TABLE `tbl_transaction_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
