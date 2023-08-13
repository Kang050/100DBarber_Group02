-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2023 at 09:34 AM
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
-- Database: `barber`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(50) NOT NULL,
  `client_id` int(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `client_id`, `province`, `address`) VALUES
(15, 25, 'Nha Trang', '20 Lê Lợi'),
(16, 25, 'TP. HCM', '25 Ngô Tất Tố'),
(19, 5, 'Huế', '20 Lê Lợi'),
(21, 34, 'egn', 'fwbfb'),
(22, 38, 'Huế', 'a'),
(23, 38, 'Huế', '23 Nguyễn Sinh Cung'),
(24, 39, 'hcm', '165 kenh tan hoa'),
(25, 40, 'Đồng Nai', '163 kenh tan hoa'),
(26, 41, 'no', '165 kenh tan hoa'),
(27, 42, 'no', '23'),
(28, 43, 'no', '165 kenh tan hoa'),
(29, 44, 'no', '165 kenh tan hoa'),
(30, 45, '', '165 kenh tan hoa'),
(31, 46, '', ''),
(32, 47, ' Bình Dương', '168 ');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time_expected` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `cancellation_reason` text DEFAULT NULL,
  `service_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `date_created`, `client_id`, `employee_id`, `start_time`, `end_time_expected`, `status`, `cancellation_reason`, `service_id`) VALUES
(31, '2023-08-12 08:38:11', 38, 1, '2023-08-12 09:00:00', '2023-08-12 10:30:00', 2, 'Quá giờ hẹn', 2),
(32, '2023-08-12 08:38:22', 38, 2, '2023-08-12 10:30:00', '2023-08-12 12:00:00', 2, 'Quá giờ hẹn', 2),
(33, '2023-08-12 15:00:01', 39, 2, '2023-08-14 02:30:00', '2023-08-14 03:30:00', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barber_admin`
--

CREATE TABLE `barber_admin` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barber_admin`
--

INSERT INTO `barber_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'anhao', 'aA123456');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `province_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`province_id`, `name`) VALUES
(1, ' Hà Nội'),
(2, ' Hà Giang'),
(3, ' Cao Bằng'),
(4, ' Bắc Kạn'),
(5, ' Tuyên Quang'),
(6, ' Lào Cai'),
(7, ' Điện Biên'),
(8, ' Lai Châu'),
(9, ' Sơn La'),
(10, ' Yên Bái'),
(11, ' Hoà Bình'),
(12, ' Thái Nguyên'),
(13, ' Lạng Sơn'),
(14, ' Quảng Ninh'),
(15, ' Bắc Giang'),
(16, ' Phú Thọ'),
(17, ' Vĩnh Phúc'),
(18, ' Bắc Ninh'),
(19, ' Hải Dương'),
(20, ' Hải Phòng'),
(21, ' Hưng Yên'),
(22, ' Thái Bình'),
(23, ' Hà Nam'),
(24, ' Nam Định'),
(25, ' Ninh Bình'),
(26, ' Thanh Hóa'),
(27, ' Nghệ An'),
(28, ' Hà Tĩnh'),
(29, ' Quảng Bình'),
(30, ' Quảng Trị'),
(31, ' Thừa Thiên Huế'),
(32, ' Đà Nẵng'),
(33, ' Quảng Nam'),
(34, ' Quảng Ngãi'),
(35, ' Bình Định'),
(36, ' Phú Yên'),
(37, ' Khánh Hòa'),
(38, ' Ninh Thuận'),
(39, ' Bình Thuận'),
(40, ' Kon Tum'),
(41, ' Gia Lai'),
(42, ' Đắk Lắk'),
(43, ' Đắk Nông'),
(44, ' Lâm Đồng'),
(45, ' Bình Phước'),
(46, ' Tây Ninh'),
(47, ' Bình Dương'),
(48, ' Đồng Nai'),
(49, ' Bà Rịa - Vũng Tàu'),
(50, ' Hồ Chí Minh'),
(51, ' Long An'),
(52, ' Tiền Giang'),
(53, ' Bến Tre'),
(54, ' Trà Vinh'),
(55, ' Vĩnh Long'),
(56, ' Đồng Tháp'),
(57, ' An Giang'),
(58, ' Kiên Giang'),
(59, ' Cần Thơ'),
(60, ' Hậu Giang'),
(61, ' Sóc Trăng'),
(62, ' Bạc Liêu'),
(63, ' Cà Mau');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_email`, `name`, `phone_number`, `password`) VALUES
(5, 'kietduong@gmail.com.vn', 'Kiệt', '0634308347', 'bB123456'),
(25, 'nguyen@gmail.com', 'Nguyên', '0987654321', 'bB234567'),
(34, 'ftynu@gmail.com', 'febeb', '09742524624', 'aA123456'),
(38, 'hung@gmail.com', 'Hưng', '09456456456', 'Kang2651'),
(39, 'kietduong611@gmail.com', 'tuan kiet', '0903534793', 'Kiet9733'),
(40, 'qnbivqjj@firstmailler.net', '123', '0938161668', 'aA123456'),
(41, 'cbrjdhda@firstmailler.netd', 'duong tuan kietd', '0903534797', 'aA123456'),
(42, 'kietduong6211@gmail.com', 'Student1420699', '0987654323', 'Kiet9733'),
(43, 'kietduong611@gmail.coms', 'duong tuan kiets', '0903534791', 'aA123456'),
(44, 'kietduong62311@gmail.com', '123', '01234567878', 'Kiet9733'),
(45, 'kietduong611232@gmail.com', 'Student1420699', '09035347123', 'Kiet9733'),
(46, '', '', '', ''),
(47, 'kietduong6122221@gmail.com', 'kietaaa', '0935123456', 'Kiet9733');

-- --------------------------------------------------------

--
-- Table structure for table `client_credit_card_info`
--

CREATE TABLE `client_credit_card_info` (
  `id` int(50) NOT NULL,
  `client_id` int(50) NOT NULL,
  `provider` varchar(40) NOT NULL,
  `card_number` varchar(23) NOT NULL,
  `expiry_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_credit_card_info`
--

INSERT INTO `client_credit_card_info` (`id`, `client_id`, `provider`, `card_number`, `expiry_date`) VALUES
(8, 25, 'TP Bank', '79789879', '03/24'),
(11, 25, 'jkljkljk', 'bhhhkjkjhkjh', 'jhkkk'),
(12, 39, 'viettin', '104875217127', '05/26');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `rate_count` int(100) NOT NULL DEFAULT 0,
  `score` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `phone_number`, `email`, `img`, `rate_count`, `score`) VALUES
(1, 'Adam', 'Phillips', '0786745662', 'adam@gmail.com', 'team-1.jpg', 3, '14.00'),
(2, 'Dylan', 'Adams', '0567567567', 'dylan@gmail.com', 'team-2.jpg', 5, '24.00'),
(3, 'Gloria', 'Edwards', '0456456456', 'gloria@gmail.com', 'team-3.jpg', 4, '19.00'),
(4, 'Josh', 'Dunn', '0999999999', 'josh@gmail.com', 'team-4.jpg', 3, '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift`
--

CREATE TABLE `employee_shift` (
  `employee_id` int(10) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_shift`
--

INSERT INTO `employee_shift` (`employee_id`, `time`, `date`, `status`) VALUES
(1, '09:00:00', '2023-08-14', NULL),
(1, '10:00:00', '2023-08-14', NULL),
(1, '11:00:00', '2023-08-14', NULL),
(1, '12:00:00', '2023-08-14', NULL),
(1, '13:00:00', '2023-08-14', NULL),
(1, '14:00:00', '2023-08-14', NULL),
(1, '15:00:00', '2023-08-14', NULL),
(1, '16:00:00', '2023-08-14', NULL),
(1, '17:00:00', '2023-08-14', NULL),
(1, '18:00:00', '2023-08-14', NULL),
(3, '09:00:00', '2023-08-14', NULL),
(3, '10:00:00', '2023-08-14', NULL),
(3, '11:00:00', '2023-08-14', NULL),
(3, '12:00:00', '2023-08-14', NULL),
(3, '13:00:00', '2023-08-14', NULL),
(3, '14:00:00', '2023-08-14', NULL),
(3, '15:00:00', '2023-08-14', NULL),
(3, '16:00:00', '2023-08-14', NULL),
(3, '17:00:00', '2023-08-14', NULL),
(3, '18:00:00', '2023-08-14', NULL),
(2, '09:30:00', '2023-08-14', 1),
(2, '10:30:00', '2023-08-14', NULL),
(2, '11:30:00', '2023-08-14', NULL),
(2, '12:30:00', '2023-08-14', NULL),
(2, '13:30:00', '2023-08-14', NULL),
(2, '14:30:00', '2023-08-14', NULL),
(2, '15:30:00', '2023-08-14', NULL),
(2, '16:30:00', '2023-08-14', NULL),
(2, '17:30:00', '2023-08-14', NULL),
(2, '18:30:00', '2023-08-14', NULL),
(4, '09:30:00', '2023-08-14', NULL),
(4, '10:30:00', '2023-08-14', NULL),
(4, '11:30:00', '2023-08-14', NULL),
(4, '12:30:00', '2023-08-14', NULL),
(4, '13:30:00', '2023-08-14', NULL),
(4, '14:30:00', '2023-08-14', NULL),
(4, '15:30:00', '2023-08-14', NULL),
(4, '16:30:00', '2023-08-14', NULL),
(4, '17:30:00', '2023-08-14', NULL),
(4, '18:30:00', '2023-08-14', NULL),
(1, '09:00:00', '2023-08-13', 0),
(1, '10:00:00', '2023-08-13', NULL),
(1, '11:00:00', '2023-08-13', NULL),
(1, '12:00:00', '2023-08-13', NULL),
(1, '13:00:00', '2023-08-13', NULL),
(1, '14:00:00', '2023-08-13', NULL),
(1, '15:00:00', '2023-08-13', NULL),
(1, '16:00:00', '2023-08-13', NULL),
(1, '17:00:00', '2023-08-13', NULL),
(1, '18:00:00', '2023-08-13', NULL),
(3, '09:00:00', '2023-08-13', NULL),
(3, '10:00:00', '2023-08-13', NULL),
(3, '11:00:00', '2023-08-13', NULL),
(3, '12:00:00', '2023-08-13', NULL),
(3, '13:00:00', '2023-08-13', NULL),
(3, '14:00:00', '2023-08-13', NULL),
(3, '15:00:00', '2023-08-13', NULL),
(3, '16:00:00', '2023-08-13', NULL),
(3, '17:00:00', '2023-08-13', NULL),
(3, '18:00:00', '2023-08-13', NULL),
(2, '09:30:00', '2023-08-13', NULL),
(2, '10:30:00', '2023-08-13', NULL),
(2, '11:30:00', '2023-08-13', NULL),
(2, '12:30:00', '2023-08-13', NULL),
(2, '13:30:00', '2023-08-13', NULL),
(2, '14:30:00', '2023-08-13', NULL),
(2, '15:30:00', '2023-08-13', NULL),
(2, '16:30:00', '2023-08-13', NULL),
(2, '17:30:00', '2023-08-13', NULL),
(2, '18:30:00', '2023-08-13', NULL),
(4, '09:30:00', '2023-08-13', NULL),
(4, '10:30:00', '2023-08-13', NULL),
(4, '11:30:00', '2023-08-13', NULL),
(4, '12:30:00', '2023-08-13', NULL),
(4, '13:30:00', '2023-08-13', NULL),
(4, '14:30:00', '2023-08-13', NULL),
(4, '15:30:00', '2023-08-13', NULL),
(4, '16:30:00', '2023-08-13', NULL),
(4, '17:30:00', '2023-08-13', NULL),
(4, '18:30:00', '2023-08-13', NULL),
(1, '09:00:00', '2023-08-15', 0),
(1, '10:00:00', '2023-08-15', 0),
(1, '11:00:00', '2023-08-15', 0),
(1, '12:00:00', '2023-08-15', 0),
(1, '13:00:00', '2023-08-15', 0),
(1, '14:00:00', '2023-08-15', 0),
(1, '15:00:00', '2023-08-15', 0),
(1, '16:00:00', '2023-08-15', 0),
(1, '17:00:00', '2023-08-15', 0),
(1, '18:00:00', '2023-08-15', 0),
(3, '09:00:00', '2023-08-15', 0),
(3, '10:00:00', '2023-08-15', 0),
(3, '11:00:00', '2023-08-15', 0),
(3, '12:00:00', '2023-08-15', 0),
(3, '13:00:00', '2023-08-15', 0),
(3, '14:00:00', '2023-08-15', 0),
(3, '15:00:00', '2023-08-15', 0),
(3, '16:00:00', '2023-08-15', 0),
(3, '17:00:00', '2023-08-15', 0),
(3, '18:00:00', '2023-08-15', 0),
(2, '09:30:00', '2023-08-15', 0),
(2, '10:30:00', '2023-08-15', 0),
(2, '11:30:00', '2023-08-15', 0),
(2, '12:30:00', '2023-08-15', 0),
(2, '13:30:00', '2023-08-15', 0),
(2, '14:30:00', '2023-08-15', 0),
(2, '15:30:00', '2023-08-15', 0),
(2, '16:30:00', '2023-08-15', 0),
(2, '17:30:00', '2023-08-15', 0),
(2, '18:30:00', '2023-08-15', 0),
(4, '09:30:00', '2023-08-15', 0),
(4, '10:30:00', '2023-08-15', 0),
(4, '11:30:00', '2023-08-15', 0),
(4, '12:30:00', '2023-08-15', 0),
(4, '13:30:00', '2023-08-15', 0),
(4, '14:30:00', '2023-08-15', 0),
(4, '15:30:00', '2023-08-15', 0),
(4, '16:30:00', '2023-08-15', 0),
(4, '17:30:00', '2023-08-15', 0),
(4, '18:30:00', '2023-08-15', 0),
(1, '09:00:00', '2023-08-16', 0),
(1, '10:00:00', '2023-08-16', 0),
(1, '11:00:00', '2023-08-16', 0),
(1, '12:00:00', '2023-08-16', 0),
(1, '13:00:00', '2023-08-16', 0),
(1, '14:00:00', '2023-08-16', 0),
(1, '15:00:00', '2023-08-16', 0),
(1, '16:00:00', '2023-08-16', 0),
(1, '17:00:00', '2023-08-16', 0),
(1, '18:00:00', '2023-08-16', 0),
(3, '09:00:00', '2023-08-16', 0),
(3, '10:00:00', '2023-08-16', 0),
(3, '11:00:00', '2023-08-16', 0),
(3, '12:00:00', '2023-08-16', 0),
(3, '13:00:00', '2023-08-16', 0),
(3, '14:00:00', '2023-08-16', 0),
(3, '15:00:00', '2023-08-16', 0),
(3, '16:00:00', '2023-08-16', 0),
(3, '17:00:00', '2023-08-16', 0),
(3, '18:00:00', '2023-08-16', 0),
(2, '09:30:00', '2023-08-16', 0),
(2, '10:30:00', '2023-08-16', 0),
(2, '11:30:00', '2023-08-16', 0),
(2, '12:30:00', '2023-08-16', 0),
(2, '13:30:00', '2023-08-16', 0),
(2, '14:30:00', '2023-08-16', 0),
(2, '15:30:00', '2023-08-16', 0),
(2, '16:30:00', '2023-08-16', 0),
(2, '17:30:00', '2023-08-16', 0),
(2, '18:30:00', '2023-08-16', 0),
(4, '09:30:00', '2023-08-16', 0),
(4, '10:30:00', '2023-08-16', 0),
(4, '11:30:00', '2023-08-16', 0),
(4, '12:30:00', '2023-08-16', 0),
(4, '13:30:00', '2023-08-16', 0),
(4, '14:30:00', '2023-08-16', 0),
(4, '15:30:00', '2023-08-16', 0),
(4, '16:30:00', '2023-08-16', 0),
(4, '17:30:00', '2023-08-16', 0),
(4, '18:30:00', '2023-08-16', 0),
(1, '09:00:00', '2023-08-17', 0),
(1, '10:00:00', '2023-08-17', 0),
(1, '11:00:00', '2023-08-17', 0),
(1, '12:00:00', '2023-08-17', 0),
(1, '13:00:00', '2023-08-17', 0),
(1, '14:00:00', '2023-08-17', 0),
(1, '15:00:00', '2023-08-17', 0),
(1, '16:00:00', '2023-08-17', 0),
(1, '17:00:00', '2023-08-17', 0),
(1, '18:00:00', '2023-08-17', 0),
(3, '09:00:00', '2023-08-17', 0),
(3, '10:00:00', '2023-08-17', 0),
(3, '11:00:00', '2023-08-17', 0),
(3, '12:00:00', '2023-08-17', 0),
(3, '13:00:00', '2023-08-17', 0),
(3, '14:00:00', '2023-08-17', 0),
(3, '15:00:00', '2023-08-17', 0),
(3, '16:00:00', '2023-08-17', 0),
(3, '17:00:00', '2023-08-17', 0),
(3, '18:00:00', '2023-08-17', 0),
(2, '09:30:00', '2023-08-17', 0),
(2, '10:30:00', '2023-08-17', 0),
(2, '11:30:00', '2023-08-17', 0),
(2, '12:30:00', '2023-08-17', 0),
(2, '13:30:00', '2023-08-17', 0),
(2, '14:30:00', '2023-08-17', 0),
(2, '15:30:00', '2023-08-17', 0),
(2, '16:30:00', '2023-08-17', 0),
(2, '17:30:00', '2023-08-17', 0),
(2, '18:30:00', '2023-08-17', 0),
(4, '09:30:00', '2023-08-17', 0),
(4, '10:30:00', '2023-08-17', 0),
(4, '11:30:00', '2023-08-17', 0),
(4, '12:30:00', '2023-08-17', 0),
(4, '13:30:00', '2023-08-17', 0),
(4, '14:30:00', '2023-08-17', 0),
(4, '15:30:00', '2023-08-17', 0),
(4, '16:30:00', '2023-08-17', 0),
(4, '17:30:00', '2023-08-17', 0),
(4, '18:30:00', '2023-08-17', 0),
(1, '09:00:00', '2023-08-18', 0),
(1, '10:00:00', '2023-08-18', 0),
(1, '11:00:00', '2023-08-18', 0),
(1, '12:00:00', '2023-08-18', 0),
(1, '13:00:00', '2023-08-18', 0),
(1, '14:00:00', '2023-08-18', 0),
(1, '15:00:00', '2023-08-18', 0),
(1, '16:00:00', '2023-08-18', 0),
(1, '17:00:00', '2023-08-18', 0),
(1, '18:00:00', '2023-08-18', 0),
(3, '09:00:00', '2023-08-18', 0),
(3, '10:00:00', '2023-08-18', 0),
(3, '11:00:00', '2023-08-18', 0),
(3, '12:00:00', '2023-08-18', 0),
(3, '13:00:00', '2023-08-18', 0),
(3, '14:00:00', '2023-08-18', 0),
(3, '15:00:00', '2023-08-18', 0),
(3, '16:00:00', '2023-08-18', 0),
(3, '17:00:00', '2023-08-18', 0),
(3, '18:00:00', '2023-08-18', 0),
(2, '09:30:00', '2023-08-18', 0),
(2, '10:30:00', '2023-08-18', 0),
(2, '11:30:00', '2023-08-18', 0),
(2, '12:30:00', '2023-08-18', 0),
(2, '13:30:00', '2023-08-18', 0),
(2, '14:30:00', '2023-08-18', 0),
(2, '15:30:00', '2023-08-18', 0),
(2, '16:30:00', '2023-08-18', 0),
(2, '17:30:00', '2023-08-18', 0),
(2, '18:30:00', '2023-08-18', 0),
(4, '09:30:00', '2023-08-18', 0),
(4, '10:30:00', '2023-08-18', 0),
(4, '11:30:00', '2023-08-18', 0),
(4, '12:30:00', '2023-08-18', 0),
(4, '13:30:00', '2023-08-18', 0),
(4, '14:30:00', '2023-08-18', 0),
(4, '15:30:00', '2023-08-18', 0),
(4, '16:30:00', '2023-08-18', 0),
(4, '17:30:00', '2023-08-18', 0),
(4, '18:30:00', '2023-08-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `client_id` int(50) NOT NULL,
  `shipping_address` varchar(200) NOT NULL,
  `shipping_method` varchar(50) NOT NULL DEFAULT 'Shopee',
  `total` decimal(10,3) NOT NULL,
  `status` tinytext NOT NULL DEFAULT '0',
  `payment_method` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `client_id`, `shipping_address`, `shipping_method`, `total`, `status`, `payment_method`, `date_created`) VALUES
(26, 38, '23 Nguyễn Sinh Cung, Huế', 'Shopee', '907.000', '0', 'COD', '2023-08-12 08:39:13'),
(27, 39, '165 kenh tan hoa, hcm', 'Shopee', '179.000', 'đã hủy', 'COD', '2023-08-13 06:17:51'),
(28, 39, '165 kenh tan hoa, hcm', 'Shopee', '858.000', '', 'viettin, 104875217127', '2023-08-13 06:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `qty`) VALUES
(17, 26, 2, 1),
(18, 26, 3, 1),
(19, 26, 1, 2),
(20, 27, 1, 1),
(21, 28, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(50) NOT NULL,
  `category_id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `rate_count` int(100) NOT NULL DEFAULT 0,
  `score` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `description`, `product_image`, `price`, `rate_count`, `score`) VALUES
(1, 1, 'Xịt dưỡng tóc Glanzen Magic Spray', 'Tạo phồng chân tóc, giúp tóc dày, khoẻ hơn, hút dầu thừa trên tóc giúp tóc khô thoáng cả ngày. Bảo vệ tóc bạn khỏi nhiệt độ cao và không khí ô nhiễm bằng cách cung cấp các dưỡng chất quý giá cho tóc (vitamin B5, Keratin và collagen từ tơ tằm). Những dưỡng chất này thấm sau vào trong tóc, làm cho tóc khỏe hơn từ bên trong, đồng thời lớp muối biển bảo vệ tóc từ bên ngoài. Sản phẩm này giúp bạn tạo kiểu tự nhiên và làm tóc dày hoặc có thể kết hợp với các sản phẩm tạo kiểu khác để giữ nếp tóc tự nhiên và lâu dài. Xịt muối này rất dễ gội rửa và được thiết kế với hương nước hoa nam tính.', 'PRE01.jpg', '179.000', 25, 83),
(2, 1, 'Máy sấy tóc Furin - Mạnh gấp 10 máy sấy bạn có', 'Tiết kiệm điện năng và thời gian sấy tóc, hỗ trợ tạo kiểu hiệu quả, nhanh chóng chính là những ưu điểm vượt trội giúp máy sấy tóc Furin “chiều lòng” được rất nhiều anh em. Đây chắc chắn là sản phẩm không thể thiếu trong tủ đồ của cánh mày râu để luôn duy trì vẻ ngoài tự tin, thời thượng và cuốn hút.', 'SAY01.JPG', '429.000', 13, 53),
(3, 1, 'Sáp vuốt tóc Tạo kiểu Giữ nếp tự nhiên UNO Hybrid Hard', 'Nếu bạn đang không có quá nhiều tiền để mua sáp vuốt tóc nhưng vẫn muốn có được một kiểu tóc đẹp thì sáp vuốt tóc Uno Hybrid Hard chắc chắn sẽ là sản phẩm đáp ứng được những nhu cầu trên của bạn. Cùng 30Shine Shop khám phá sản phẩm chỉ với mức giá chưa đến 150 “cành” qua bài viết dưới đây!', 'SAP09.JPG', '120.000', 2, 8),
(4, 1, 'Sáp By Vilain Gold Digger Limited 2022', 'Sáp By Vilain Gold Digger Limited 2022', 'SAP04.JPG', '550.000', 6, 24),
(5, 1, 'Sáp vuốt tóc nam Volcanic Clay chính hãng - Version 5 mới nhất', 'Nhắc đến các sản phẩm làm đẹp, tạo kiểu tóc cho nam giới, không thể không nhắc tới sáp Volcanic Clay - một trong những sản phẩm sáp vuốt tóc bán chạy hiện nay. Sản phẩm được nam giới ưa chuộng nhờ khả năng giữ nếp lâu dài, phù hợp với nhiều phong cách tạo kiểu.', 'SAP10.JPG', '340.000', 0, 0),
(6, 2, 'Kem Chống Nắng Kiểm Soát Dầu Không Nhờn Rít La Roche-Posay', 'CÔNG DỤNG CHÍNH – MAIN FUNCTION\r\n•	Sản phẩm phù hợp cho da dầu, da mụn, da nhạy cảm\r\n•	Thích hợp sử ', 'KCN01.JPG', '250.000', 0, 0),
(7, 2, 'Serum Chống Nắng Dưỡng Sáng GGG Transparent Sun SPF50+/PA+ 50ml', 'GGG Transparent Sun Serum SPF50+/PA+++\r\nSerum chống nắng phổ rộng (BROAD SPECTRUM) với kết cấu mỏng ', 'KCN03.JPG', '456.000', 0, 0),
(8, 2, 'Kem Chống Nắng SNP Prep Vitaronic Sun Cream', 'Kem Chống Nắng SNP Prep Vitaronic Sun Cream là một sản phẩm thuộc thương hiệu mỹ phẩm SNP với khả năng cấp ẩm, dưỡng trắng, ngăn ngừa lão hóa.\r\n•	Chỉ số chống nắng SPF 50+ PA++++\r\n•	Khối lượng tịnh: 50g\r\n', 'KCN05.JPG', '390.000', 0, 0),
(9, 2, 'NƯỚC TẨY TRANG MICELLAR ULTRA', 'NƯỚC TẨY TRANG MICELLAR ULTRA dành cho da nhạy cảm giúp làm sạch da khỏi tạp chất, loại bỏ tối ưu lớp trang điểm và ô nhiễm. Sản phẩm đồng thời làm dịu da, đem lại cảm giác dễ chịu và tươi mát.', 'TTBC10.JPG', '399.000', 0, 0),
(10, 2, 'Mặt Nạ Than Hoạt Tính Mediheal H.D.P Pore-Stamping Charcoal-Mineral Mask EX Cho Da Mụn - 1 hộp x 10 ', 'Mặt Nạ Than Hoạt Tính Cho Da Mụn Mediheal H.D.P Pore-Stamping Charcoal-Mineral Mask EX - 25ml\r\n\r\n', 'MATNA06.JPG', '299.000', 0, 0),
(11, 3, 'Dầu gội giảm rụng tóc và ngăn gàu Dr. For Hair Anti-Dandruff Shampoo', 'Dầu gội giảm rụng tóc và ngăn gàu Dr. For Hair Anti-Dandruff Shampoo', 'DAUGOI05.JPG', '519.000', 0, 0),
(12, 3, 'Dầu gội Davines cho tóc nhuộm Davines MINU', 'Dầu gội Davines cho tóc nhuộm Davines MINU nhẹ nhàng làm sạch, khoá màu, bảo vệ và kéo dài tuổi thọ ', 'DAUGOI07.JPG', '360.000', 1, 5),
(13, 3, 'Dầu Xả Tạo Phồng Và Làm Dày Tóc Tigi Bed Head Gimme Grip', 'Dầu xả Tigi Bed Head Gimme Grip Texturizing Conditioner nằm trong bộ sản phẩm chăm sóc và cải thiện ', 'DAUXA06.JPG', '410.000', 0, 0),
(14, 3, 'Dầu xả Selsun Anti-Dandruff Conditioner', 'Dầu Xả Dưỡng Tóc Dành Cho Tóc Gàu Selsun Anti-Dandruff Conditioner là dòng sản phẩm dành cho tóc thuộc thương hiệu Selsun. Chứa công thức 3 tác động giúp chăm sóc và nuôi dưỡng mai tóc toàn diện, ngăn ngừa nấm gây gàu, mang đến mái tóc sạch khỏe, ngăn ngừa gàu ngứa quay trở lại, nuôi dưỡng mái tóc óng ả, suôn mượt', 'DAUXA08.JPG', '54.000', 0, 0),
(15, 3, 'Tẩy tế bào chết da đầu Cafe Mimi - Làm sạch và dày tóc', 'THÀNH PHẦN & CÔNG DỤNG TẨY TẾ BÀO CHẾT DA DẦU CAFE MIMI:\r\nMàu xanh dương - Dầu gội tẩy tế bào chết da đầu Deep Cleansing & Hair Growth Café Mimi Deep Cleansing & Hair Growth\r\nChứa hơn 50% muối biển tự nhiên có tác dụng hút dầu, làm sạch chân tóc, chống bết, loại bỏ tế bào chết\r\n', 'TTBC03.JPG', '229.000', 0, 0),
(16, 4, 'Sữa Tắm Khử Mùi Perspi-Guard Odour Control Body Wash', 'Sữa Tắm Ngăn Mồ Hôi Perspi-Guard Odour Control Body Wash Original Khử Mùi Vượt Trội 200ml\r\nSữa Tắm Ngăn Mồ Hôi Perspi-Guard Odour Control Body Wash Original Khử Mùi Vượt Trội 200ml là loại sữa tắm có thể giải quyết tận gốc nguyên nhân của vấn đề. Công thức khoa học ban đầu được phát triển để điều trị mùi hôi. Perspi-Guard Odor Control Bodywash được bào chế để làm sạch da và loại bỏ mùi cơ thể từ các vùng thường bị ảnh hưởng, chẳng hạn như nách, bàn chân và bẹn\r\n', 'SUATAM01.JPG', '250.000', 0, 0),
(17, 4, 'Xà Phòng Giảm Mụn Cơ Thể Derladie Body Cleansing Bar For Blemish Skin', 'Xà Phòng Giảm Mụn Cơ Thể Derladie Body Cleansing Bar For Blemish Skin là giải pháp chăm sóc và điều trị vùng da cơ thể có mụn hiệu quả với thành phần chính chiết xuất từ thiên nhiên, có hiệu quả làm sạch sâu lỗ chân lông, loại bỏ bã nhờn, bụi bẩn, đồng thời kháng viêm, phục hồi da hiệu quả, mang đến làn da sáng mịn và sạch mụn\r\n \r\n\r\n', 'SUATAM02.JPG\r\n', '119.000', 0, 0),
(18, 4, 'Sáp khử mùi Old Spice - New Collection', 'Sáp khử mùi Old Spice 85g nhập khẩu từ Mỹ, khử mùi bền bỉ suốt 48 giờ và đem lại hương thơm nam tính, dễ chịu cho vùng da dưới cánh tay và không để lại vệt sáp, không làm ố vàng áo giúp Phái Mạnh luôn t', 'KHUMUI01.JPG', '167.000', 0, 0),
(19, 4, 'Gel Khử Mùi Gillette Cool Wave', 'Gel Khử Mùi Gillette Giảm Tiết Mồ Hôi 107g là dòng sản phẩm khử mùi cho nam đến từ thương hiệu chăm sóc cơ thể Gillette của Mỹ, với công thức 3 tác động ngăn mùi và loại bỏ mùi cơ thể, ngăn sự ẩm ướt ở vùng da dưới cánh tay đem lại 48h khô thoáng, sạch sẽ và mùi hương thơm mát, quyến rũ.', 'KHUMUI02.JPG', '99.000', 0, 0),
(20, 4, 'Nước Hoa Xịt Toàn Thân Unisex Fogg', 'NƯỚC HOA XỊT TOÀN THÂN UNISEX FOGG – “SIÊU PHẨM” GIÚP PHÁI MẠNH TỰ TIN, THU HÚT TRONG MỌI TÌNH HUỐNG', 'NUOCHOA02.JPG', '150.000', 0, 0),
(21, 5, 'Máy tỉa lông mũi WL2604', 'Sản phẩm có bề ngoài đẹp mắt, thiết kế đơn giản, kích thước nhỏ gọn tiện mang theo bên mình.\r\nSản phẩm dùng để tỉa lông mũi, lông tai, ngoài ra bạn có thể dùng nó để tỉa các phần lông mày, râu thừa để cho nó vào kiểu lại.\r\nSản phẩm dùng lưỡi cắt hợp kim inox 201 hạn chế gỉ sét tối đa, độ an toàn cao, không gây dị ứng khi sử dụng.\r\n', 'CAORAU01.JPG', '150.000', 0, 0),
(22, 5, 'Máy Cạo Râu Flyco FS197VN', 'Máy cạo râu Flyco khả năng chống nước an toàn tuyệt đối nhờ công nghệ IPX7\r\nNhờ đó máy có thể được vệ sinh sạch kĩ càng, hạn chế tích tụ vi khuẩn gây mầm bệnh về da.\r\n', 'CAORAU04.JPG', '999.000', 0, 0),
(23, 5, 'Dung dịch Vệ Sinh Nam Grinif Men', 'Grinif Men Premium Intimate Wash chính hãng là dòng sản phẩm vệ sinh khá nổi tiếng ở thế giới. Với sự công thức đột phá mới, mang lại trải nghiệm toàn diện cho các đấng mày râu, sản phẩm này đang là tâm điểm của các quý ông', 'DDVS02.JPG', '216.000', 12, 54),
(24, 5, 'Kem Đánh Răng Than Hoạt Tính Splat Special Blackwood Trắng Sáng', 'Kem đánh răng than hoạt tính Splat Special trắng sáng Blackwood 75ml\r\nKEM ĐÁNH RĂNG LÀM TRẮNG HIỆU QUẢ VỚI THAN HOẠT TÍNH \r\nSplat Kem đánh răng uy tín được bầu chọn bởi hiệp hội Nha Khoa Châu Âu \r\nĐược kiểm nghiệm và chứng nhận Y khoa tại Châu Âu, Thụy Sĩ, Nhật Bản.\r\n', 'RANGMIENG02.JPG', '149.000', 0, 0),
(25, 5, 'Miếng Dán Trắng Răng Anriea - Hộp 3 miếng', 'Miếng dán trắng răng BLACK TOOTH WHITENER\r\nTHƯƠNG HIỆU: ANRIEA\r\nXUẤT XỨ: ĐÀI LOAN\r\n', 'RANGMIENG06.JPG', '219.000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` int(50) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_name`) VALUES
(1, 'Tạo kiểu tóc'),
(2, 'Chăm sóc da'),
(3, 'Chăm sóc tóc'),
(4, 'Chăm sóc cơ thể'),
(5, 'Chăm sóc cá nhân');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(20) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `service_price` decimal(20,3) NOT NULL,
  `service_duration` int(20) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_description`, `service_price`, `service_duration`, `img`) VALUES
(1, 'Basic Hair Cut & Shave', 'Bao gồm: Cắt tóc; Gội đầu; Tạo kiểu', '150.000', 60, 'service-1.jpg'),
(2, 'Premium Hair Cut & Shave', 'Bao gồm: Cắt tóc; Gội đầu; Tạo kiểu; Lột mụn; Lấy ráy tai', '250.000', 90, 'service-2.jpg'),
(3, 'Luxury Hair Cut & Shave', 'Bao gồm: Cắt tóc; Gội đầu; Tạo kiểu; Lột mụn; Lấy ráy tai; Massage', '350.000', 120, 'service-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(50) NOT NULL,
  `client_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `client_id`) VALUES
(1, 5),
(2, 25),
(4, 34),
(5, 38),
(6, 39),
(7, 40),
(8, 41),
(9, 42),
(10, 43),
(11, 44),
(12, 45),
(13, 46),
(14, 47);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_item`
--

CREATE TABLE `shopping_cart_item` (
  `id` int(50) NOT NULL,
  `cart_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `FK_client_address` (`client_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `FK_client_appointment` (`client_id`),
  ADD KEY `FK_employee_appointment` (`employee_id`),
  ADD KEY `FK_service_appointment` (`service_id`);

--
-- Indexes for table `barber_admin`
--
ALTER TABLE `barber_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_email` (`client_email`);

--
-- Indexes for table `client_credit_card_info`
--
ALTER TABLE `client_credit_card_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_client_credit` (`client_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD KEY `FK_employee_shift` (`employee_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_client_order` (`client_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_ibfk_1` (`order_id`),
  ADD KEY `order_item_ibfk_2` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_product_category` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FK_client_cart` (`client_id`);

--
-- Indexes for table `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_id` (`cart_id`),
  ADD KEY `FK_cart_item` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `barber_admin`
--
ALTER TABLE `barber_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `client_credit_card_info`
--
ALTER TABLE `client_credit_card_info`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `FK_client_address` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_client_appointment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_employee_appointment` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_service_appointment` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Constraints for table `client_credit_card_info`
--
ALTER TABLE `client_credit_card_info`
  ADD CONSTRAINT `FK_client_credit` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD CONSTRAINT `FK_employee_shift` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_client_order` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `FK_client_cart` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  ADD CONSTRAINT `shopping_cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `shopping_cart` (`cart_id`),
  ADD CONSTRAINT `shopping_cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
