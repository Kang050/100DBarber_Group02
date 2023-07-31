-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th7 31, 2023 lúc 06:39 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `barber`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(50) NOT NULL,
  `client_id` int(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `addresses`
--

INSERT INTO `addresses` (`address_id`, `client_id`, `province`, `address`) VALUES
(2, 15, 'h', 'h'),
(3, 19, 'd', 'd'),
(5, 22, 'Hue', 'hủ'),
(6, 23, 'hue', 'hue');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time_expected` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` text DEFAULT NULL,
  `service_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `date_created`, `client_id`, `employee_id`, `start_time`, `end_time_expected`, `canceled`, `cancellation_reason`, `service_id`) VALUES
(4, '2023-07-31 03:32:04', 5, 2, '2023-08-01 02:30:00', '2023-08-01 04:30:00', 0, NULL, 3),
(5, '2023-07-31 03:35:32', 5, 2, '2023-08-01 04:30:00', '2023-08-01 06:00:00', 0, NULL, 2),
(6, '2023-07-31 04:10:21', 5, 2, '2023-08-01 03:30:00', '2023-08-01 04:30:00', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `barber_admin`
--

CREATE TABLE `barber_admin` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `barber_admin`
--

INSERT INTO `barber_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'anhao', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `clients`
--

CREATE TABLE `clients` (
  `client_id` int(5) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `clients`
--

INSERT INTO `clients` (`client_id`, `client_email`, `name`, `phone_number`, `password`) VALUES
(3, 'ad.keltoum@gmail.com', 'Keltoum', '0634355566', ''),
(4, 'jairi.hachemi123@gmail.com', 'Hachemi', '03033346655', ''),
(5, 'jairiidriss@gmail.com', 'Idriss', '0634308303', 'a1234567'),
(7, 'arabi.adrar@gmial.com', 'Arabi', '033201039290', ''),
(8, 'qsdqsdqs@d.ss', 'dqsd', '030300303', ''),
(13, '$email', '$name', '$phone', '$password'),
(14, 'a@a.com', 'a', '0999999999', '00000000'),
(15, 'b@b.com', 'b', '0999999999', '00000000'),
(16, 'c@c.com', 'c', '0989898989', 'cccccccc'),
(19, 'd@d.com', 'd', '0977777777', 'dddddddd'),
(22, 'hung@gmail.com', 'Hung', '0938707608', 'kang0508'),
(23, 'h@gmail.com', 'hao', '0989898989', 'a1234567');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `client_credit_card_info`
--

CREATE TABLE `client_credit_card_info` (
  `id` int(50) NOT NULL,
  `client_id` int(50) NOT NULL,
  `provider` varchar(40) NOT NULL,
  `card_number` varchar(23) NOT NULL,
  `expiry_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(10) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `phone_number`, `email`, `img`) VALUES
(1, 'Adam', 'Phillips', '', '', 'img/team-1.jpg'),
(2, 'Dylan', 'Adams', '', '', 'img/team-2.jpg'),
(3, 'Gloria', 'Edwards', '', '', 'img/team-3.jpg'),
(4, 'Josh', 'Dunn', '0999999999', '', 'img/team-4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee_shift`
--

CREATE TABLE `employee_shift` (
  `employee_id` int(10) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee_shift`
--

INSERT INTO `employee_shift` (`employee_id`, `time`, `date`, `status`) VALUES
(1, '09:00:00', '2023-08-01', NULL),
(1, '10:00:00', '2023-08-01', NULL),
(1, '11:00:00', '2023-08-01', NULL),
(1, '12:00:00', '2023-08-01', NULL),
(1, '13:00:00', '2023-08-01', NULL),
(1, '14:00:00', '2023-08-01', NULL),
(1, '15:00:00', '2023-08-01', NULL),
(1, '16:00:00', '2023-08-01', NULL),
(1, '17:00:00', '2023-08-01', NULL),
(1, '18:00:00', '2023-08-01', NULL),
(1, '09:00:00', '2023-08-02', NULL),
(1, '10:00:00', '2023-08-02', NULL),
(1, '11:00:00', '2023-08-02', NULL),
(1, '12:00:00', '2023-08-02', NULL),
(1, '13:00:00', '2023-08-02', NULL),
(1, '14:00:00', '2023-08-02', NULL),
(1, '15:00:00', '2023-08-02', NULL),
(1, '16:00:00', '2023-08-02', NULL),
(1, '17:00:00', '2023-08-02', NULL),
(1, '18:00:00', '2023-08-02', NULL),
(1, '09:00:00', '2023-08-03', NULL),
(1, '10:00:00', '2023-08-03', NULL),
(1, '11:00:00', '2023-08-03', NULL),
(1, '12:00:00', '2023-08-03', NULL),
(1, '13:00:00', '2023-08-03', NULL),
(1, '14:00:00', '2023-08-03', NULL),
(1, '15:00:00', '2023-08-03', NULL),
(1, '16:00:00', '2023-08-03', NULL),
(1, '17:00:00', '2023-08-03', NULL),
(1, '18:00:00', '2023-08-03', NULL),
(1, '09:00:00', '2023-08-04', NULL),
(1, '10:00:00', '2023-08-04', NULL),
(1, '11:00:00', '2023-08-04', NULL),
(1, '12:00:00', '2023-08-04', NULL),
(1, '13:00:00', '2023-08-04', NULL),
(1, '14:00:00', '2023-08-04', NULL),
(1, '15:00:00', '2023-08-04', NULL),
(1, '16:00:00', '2023-08-04', NULL),
(1, '17:00:00', '2023-08-04', NULL),
(1, '18:00:00', '2023-08-04', NULL),
(1, '09:00:00', '2023-08-05', NULL),
(1, '10:00:00', '2023-08-05', NULL),
(1, '11:00:00', '2023-08-05', NULL),
(1, '12:00:00', '2023-08-05', NULL),
(1, '13:00:00', '2023-08-05', NULL),
(1, '14:00:00', '2023-08-05', NULL),
(1, '15:00:00', '2023-08-05', NULL),
(1, '16:00:00', '2023-08-05', NULL),
(1, '17:00:00', '2023-08-05', NULL),
(1, '18:00:00', '2023-08-05', NULL),
(3, '09:00:00', '2023-08-01', NULL),
(3, '10:00:00', '2023-08-01', NULL),
(3, '11:00:00', '2023-08-01', NULL),
(3, '12:00:00', '2023-08-01', NULL),
(3, '13:00:00', '2023-08-01', NULL),
(3, '14:00:00', '2023-08-01', NULL),
(3, '15:00:00', '2023-08-01', NULL),
(3, '16:00:00', '2023-08-01', NULL),
(3, '17:00:00', '2023-08-01', NULL),
(3, '18:00:00', '2023-08-01', NULL),
(3, '09:00:00', '2023-08-02', NULL),
(3, '10:00:00', '2023-08-02', NULL),
(3, '11:00:00', '2023-08-02', NULL),
(3, '12:00:00', '2023-08-02', NULL),
(3, '13:00:00', '2023-08-02', NULL),
(3, '14:00:00', '2023-08-02', NULL),
(3, '15:00:00', '2023-08-02', NULL),
(3, '16:00:00', '2023-08-02', NULL),
(3, '17:00:00', '2023-08-02', NULL),
(3, '18:00:00', '2023-08-02', NULL),
(3, '09:00:00', '2023-08-03', NULL),
(3, '10:00:00', '2023-08-03', NULL),
(3, '11:00:00', '2023-08-03', NULL),
(3, '12:00:00', '2023-08-03', NULL),
(3, '13:00:00', '2023-08-03', NULL),
(3, '14:00:00', '2023-08-03', NULL),
(3, '15:00:00', '2023-08-03', NULL),
(3, '16:00:00', '2023-08-03', NULL),
(3, '17:00:00', '2023-08-03', NULL),
(3, '18:00:00', '2023-08-03', NULL),
(3, '09:00:00', '2023-08-04', NULL),
(3, '10:00:00', '2023-08-04', NULL),
(3, '11:00:00', '2023-08-04', NULL),
(3, '12:00:00', '2023-08-04', NULL),
(3, '13:00:00', '2023-08-04', NULL),
(3, '14:00:00', '2023-08-04', NULL),
(3, '15:00:00', '2023-08-04', NULL),
(3, '16:00:00', '2023-08-04', NULL),
(3, '17:00:00', '2023-08-04', NULL),
(3, '18:00:00', '2023-08-04', NULL),
(3, '09:00:00', '2023-08-05', NULL),
(3, '10:00:00', '2023-08-05', NULL),
(3, '11:00:00', '2023-08-05', NULL),
(3, '12:00:00', '2023-08-05', NULL),
(3, '13:00:00', '2023-08-05', NULL),
(3, '14:00:00', '2023-08-05', NULL),
(3, '15:00:00', '2023-08-05', NULL),
(3, '16:00:00', '2023-08-05', NULL),
(3, '17:00:00', '2023-08-05', NULL),
(3, '18:00:00', '2023-08-05', NULL),
(2, '09:30:00', '2023-08-01', 1),
(2, '10:30:00', '2023-08-01', 1),
(2, '11:30:00', '2023-08-01', 1),
(2, '12:30:00', '2023-08-01', NULL),
(2, '13:30:00', '2023-08-01', NULL),
(2, '14:30:00', '2023-08-01', NULL),
(2, '15:30:00', '2023-08-01', NULL),
(2, '16:30:00', '2023-08-01', NULL),
(2, '17:30:00', '2023-08-01', NULL),
(2, '18:30:00', '2023-08-01', NULL),
(2, '09:30:00', '2023-08-02', NULL),
(2, '10:30:00', '2023-08-02', NULL),
(2, '11:30:00', '2023-08-02', NULL),
(2, '12:30:00', '2023-08-02', NULL),
(2, '13:30:00', '2023-08-02', NULL),
(2, '14:30:00', '2023-08-02', NULL),
(2, '15:30:00', '2023-08-02', NULL),
(2, '16:30:00', '2023-08-02', NULL),
(2, '17:30:00', '2023-08-02', NULL),
(2, '18:30:00', '2023-08-02', NULL),
(2, '09:30:00', '2023-08-03', NULL),
(2, '10:30:00', '2023-08-03', NULL),
(2, '11:30:00', '2023-08-03', NULL),
(2, '12:30:00', '2023-08-03', NULL),
(2, '13:30:00', '2023-08-03', NULL),
(2, '14:30:00', '2023-08-03', NULL),
(2, '15:30:00', '2023-08-03', NULL),
(2, '16:30:00', '2023-08-03', NULL),
(2, '17:30:00', '2023-08-03', NULL),
(2, '18:30:00', '2023-08-03', NULL),
(2, '09:30:00', '2023-08-04', NULL),
(2, '10:30:00', '2023-08-04', NULL),
(2, '11:30:00', '2023-08-04', NULL),
(2, '12:30:00', '2023-08-04', NULL),
(2, '13:30:00', '2023-08-04', NULL),
(2, '14:30:00', '2023-08-04', NULL),
(2, '15:30:00', '2023-08-04', NULL),
(2, '16:30:00', '2023-08-04', NULL),
(2, '17:30:00', '2023-08-04', NULL),
(2, '18:30:00', '2023-08-04', NULL),
(2, '09:30:00', '2023-08-05', NULL),
(2, '10:30:00', '2023-08-05', NULL),
(2, '11:30:00', '2023-08-05', NULL),
(2, '12:30:00', '2023-08-05', NULL),
(2, '13:30:00', '2023-08-05', NULL),
(2, '14:30:00', '2023-08-05', NULL),
(2, '15:30:00', '2023-08-05', NULL),
(2, '16:30:00', '2023-08-05', NULL),
(2, '17:30:00', '2023-08-05', NULL),
(2, '18:30:00', '2023-08-05', NULL),
(4, '09:30:00', '2023-08-01', NULL),
(4, '10:30:00', '2023-08-01', NULL),
(4, '11:30:00', '2023-08-01', NULL),
(4, '12:30:00', '2023-08-01', NULL),
(4, '13:30:00', '2023-08-01', NULL),
(4, '14:30:00', '2023-08-01', NULL),
(4, '15:30:00', '2023-08-01', NULL),
(4, '16:30:00', '2023-08-01', NULL),
(4, '17:30:00', '2023-08-01', NULL),
(4, '18:30:00', '2023-08-01', NULL),
(4, '09:30:00', '2023-08-02', NULL),
(4, '10:30:00', '2023-08-02', NULL),
(4, '11:30:00', '2023-08-02', NULL),
(4, '12:30:00', '2023-08-02', NULL),
(4, '13:30:00', '2023-08-02', NULL),
(4, '14:30:00', '2023-08-02', NULL),
(4, '15:30:00', '2023-08-02', NULL),
(4, '16:30:00', '2023-08-02', NULL),
(4, '17:30:00', '2023-08-02', NULL),
(4, '18:30:00', '2023-08-02', NULL),
(4, '09:30:00', '2023-08-03', NULL),
(4, '10:30:00', '2023-08-03', NULL),
(4, '11:30:00', '2023-08-03', NULL),
(4, '12:30:00', '2023-08-03', NULL),
(4, '13:30:00', '2023-08-03', NULL),
(4, '14:30:00', '2023-08-03', NULL),
(4, '15:30:00', '2023-08-03', NULL),
(4, '16:30:00', '2023-08-03', NULL),
(4, '17:30:00', '2023-08-03', NULL),
(4, '18:30:00', '2023-08-03', NULL),
(4, '09:30:00', '2023-08-04', NULL),
(4, '10:30:00', '2023-08-04', NULL),
(4, '11:30:00', '2023-08-04', NULL),
(4, '12:30:00', '2023-08-04', NULL),
(4, '13:30:00', '2023-08-04', NULL),
(4, '14:30:00', '2023-08-04', NULL),
(4, '15:30:00', '2023-08-04', NULL),
(4, '16:30:00', '2023-08-04', NULL),
(4, '17:30:00', '2023-08-04', NULL),
(4, '18:30:00', '2023-08-04', NULL),
(4, '09:30:00', '2023-08-05', NULL),
(4, '10:30:00', '2023-08-05', NULL),
(4, '11:30:00', '2023-08-05', NULL),
(4, '12:30:00', '2023-08-05', NULL),
(4, '13:30:00', '2023-08-05', NULL),
(4, '14:30:00', '2023-08-05', NULL),
(4, '15:30:00', '2023-08-05', NULL),
(4, '16:30:00', '2023-08-05', NULL),
(4, '17:30:00', '2023-08-05', NULL),
(4, '18:30:00', '2023-08-05', NULL),
(4, '09:30:00', '2023-07-31', 0),
(4, '10:30:00', '2023-07-31', 0),
(4, '11:30:00', '2023-07-31', 0),
(4, '12:30:00', '2023-07-31', 0),
(4, '13:30:00', '2023-07-31', 0),
(4, '14:30:00', '2023-07-31', 0),
(4, '15:30:00', '2023-07-31', 0),
(4, '16:30:00', '2023-07-31', 0),
(4, '17:30:00', '2023-07-31', 0),
(4, '18:30:00', '2023-07-31', 0),
(2, '09:30:00', '2023-07-31', 0),
(2, '10:30:00', '2023-07-31', 0),
(2, '11:30:00', '2023-07-31', 0),
(2, '12:30:00', '2023-07-31', 0),
(2, '13:30:00', '2023-07-31', 0),
(2, '14:30:00', '2023-07-31', 0),
(2, '15:30:00', '2023-07-31', 0),
(2, '16:30:00', '2023-07-31', 0),
(2, '17:30:00', '2023-07-31', 0),
(2, '18:30:00', '2023-07-31', 0),
(1, '09:00:00', '2023-07-31', 0),
(1, '10:00:00', '2023-07-31', 0),
(1, '11:00:00', '2023-07-31', 0),
(1, '12:00:00', '2023-07-31', 0),
(1, '13:00:00', '2023-07-31', 0),
(1, '14:00:00', '2023-07-31', 0),
(1, '15:00:00', '2023-07-31', 0),
(1, '16:00:00', '2023-07-31', 0),
(1, '17:00:00', '2023-07-31', 0),
(1, '18:00:00', '2023-07-31', 0),
(3, '09:00:00', '2023-07-31', 0),
(3, '10:00:00', '2023-07-31', 0),
(3, '11:00:00', '2023-07-31', 0),
(3, '12:00:00', '2023-07-31', 0),
(3, '13:00:00', '2023-07-31', 0),
(3, '14:00:00', '2023-07-31', 0),
(3, '15:00:00', '2023-07-31', 0),
(3, '16:00:00', '2023-07-31', 0),
(3, '17:00:00', '2023-07-31', 0),
(3, '18:00:00', '2023-07-31', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `client_id` int(50) NOT NULL,
  `shipping_address` varchar(100) NOT NULL,
  `shipping_method` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'unfinished',
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `description`, `product_image`, `price`, `rate_count`, `score`) VALUES
(1, 1, 'Xịt dưỡng tóc Glanzen Magic Spray', 'Tạo phồng chân tóc, giúp tóc dày, khoẻ hơn, hút dầu thừa trên tóc giúp tóc khô thoáng cả ngày. Bảo vệ tóc bạn khỏi nhiệt độ cao và không khí ô nhiễm bằng cách cung cấp các dưỡng chất quý giá cho tóc (vitamin B5, Keratin và collagen từ tơ tằm). Những dưỡng chất này thấm sau vào trong tóc, làm cho tóc khỏe hơn từ bên trong, đồng thời lớp muối biển bảo vệ tóc từ bên ngoài. Sản phẩm này giúp bạn tạo kiểu tự nhiên và làm tóc dày hoặc có thể kết hợp với các sản phẩm tạo kiểu khác để giữ nếp tóc tự nhiên và lâu dài. Xịt muối này rất dễ gội rửa và được thiết kế với hương nước hoa nam tính.', 'PRE01.JPEG', 179.000, 0, 0),
(2, 1, 'Máy sấy tóc Furin - Mạnh gấp 10 máy sấy bạn có', 'Tiết kiệm điện năng và thời gian sấy tóc, hỗ trợ tạo kiểu hiệu quả, nhanh chóng chính là những ưu điểm vượt trội giúp máy sấy tóc Furin “chiều lòng” được rất nhiều anh em. Đây chắc chắn là sản phẩm không thể thiếu trong tủ đồ của cánh mày râu để luôn duy trì vẻ ngoài tự tin, thời thượng và cuốn hút.', 'SAY01.JPG', 429.000, 0, 0),
(3, 1, 'Sáp vuốt tóc Tạo kiểu Giữ nếp tự nhiên UNO Hybrid Hard', 'Nếu bạn đang không có quá nhiều tiền để mua sáp vuốt tóc nhưng vẫn muốn có được một kiểu tóc đẹp thì sáp vuốt tóc Uno Hybrid Hard chắc chắn sẽ là sản phẩm đáp ứng được những nhu cầu trên của bạn. Cùng 30Shine Shop khám phá sản phẩm chỉ với mức giá chưa đến 150 “cành” qua bài viết dưới đây!', 'SAP09.JPG', 120.000, 0, 0),
(4, 1, 'Sáp By Vilain Gold Digger Limited 2022', 'Sáp By Vilain Gold Digger Limited 2022', 'SAP04.JPG', 550.000, 0, 0),
(5, 1, 'Sáp vuốt tóc nam Volcanic Clay chính hãng - Version 5 mới nhất', 'Nhắc đến các sản phẩm làm đẹp, tạo kiểu tóc cho nam giới, không thể không nhắc tới sáp Volcanic Clay - một trong những sản phẩm sáp vuốt tóc bán chạy hiện nay. Sản phẩm được nam giới ưa chuộng nhờ khả năng giữ nếp lâu dài, phù hợp với nhiều phong cách tạo kiểu.', 'SAP10.JPG', 340.000, 0, 0),
(6, 2, 'Kem Chống Nắng Kiểm Soát Dầu Không Nhờn Rít La Roche-Posay', 'CÔNG DỤNG CHÍNH – MAIN FUNCTION\r\n•	Sản phẩm phù hợp cho da dầu, da mụn, da nhạy cảm\r\n•	Thích hợp sử ', 'KCN01.JPG', 250.000, 0, 0),
(7, 2, 'Serum Chống Nắng Dưỡng Sáng GGG Transparent Sun SPF50+/PA+ 50ml', 'GGG Transparent Sun Serum SPF50+/PA+++\r\nSerum chống nắng phổ rộng (BROAD SPECTRUM) với kết cấu mỏng ', 'KCN03.JPG', 456.000, 0, 0),
(8, 2, 'Kem Chống Nắng SNP Prep Vitaronic Sun Cream', 'Kem Chống Nắng SNP Prep Vitaronic Sun Cream là một sản phẩm thuộc thương hiệu mỹ phẩm SNP với khả năng cấp ẩm, dưỡng trắng, ngăn ngừa lão hóa.\r\n•	Chỉ số chống nắng SPF 50+ PA++++\r\n•	Khối lượng tịnh: 50g\r\n', 'KCN05.JPG', 390.000, 0, 0),
(9, 2, 'NƯỚC TẨY TRANG MICELLAR ULTRA', 'NƯỚC TẨY TRANG MICELLAR ULTRA dành cho da nhạy cảm giúp làm sạch da khỏi tạp chất, loại bỏ tối ưu lớp trang điểm và ô nhiễm. Sản phẩm đồng thời làm dịu da, đem lại cảm giác dễ chịu và tươi mát.', 'TTBC10.JPG', 399.000, 0, 0),
(10, 2, 'Mặt Nạ Than Hoạt Tính Mediheal H.D.P Pore-Stamping Charcoal-Mineral Mask EX Cho Da Mụn - 1 hộp x 10 ', 'Mặt Nạ Than Hoạt Tính Cho Da Mụn Mediheal H.D.P Pore-Stamping Charcoal-Mineral Mask EX - 25ml\r\n\r\n', 'MATNA06.JPG', 299.000, 0, 0),
(11, 3, 'Dầu gội giảm rụng tóc và ngăn gàu Dr. For Hair Anti-Dandruff Shampoo', 'Dầu gội giảm rụng tóc và ngăn gàu Dr. For Hair Anti-Dandruff Shampoo', 'DAUGOI05.JPG', 519.000, 0, 0),
(12, 3, 'Dầu gội Davines cho tóc nhuộm Davines MINU', 'Dầu gội Davines cho tóc nhuộm Davines MINU nhẹ nhàng làm sạch, khoá màu, bảo vệ và kéo dài tuổi thọ ', 'DAUGOI07.JPG', 360.000, 0, 0),
(13, 3, 'Dầu Xả Tạo Phồng Và Làm Dày Tóc Tigi Bed Head Gimme Grip', 'Dầu xả Tigi Bed Head Gimme Grip Texturizing Conditioner nằm trong bộ sản phẩm chăm sóc và cải thiện ', 'DAUXA06.JPG', 410.000, 0, 0),
(14, 3, 'Dầu xả Selsun Anti-Dandruff Conditioner', 'Dầu Xả Dưỡng Tóc Dành Cho Tóc Gàu Selsun Anti-Dandruff Conditioner là dòng sản phẩm dành cho tóc thuộc thương hiệu Selsun. Chứa công thức 3 tác động giúp chăm sóc và nuôi dưỡng mai tóc toàn diện, ngăn ngừa nấm gây gàu, mang đến mái tóc sạch khỏe, ngăn ngừa gàu ngứa quay trở lại, nuôi dưỡng mái tóc óng ả, suôn mượt', 'DAUXA08.JPG', 54.000, 0, 0),
(15, 3, 'Tẩy tế bào chết da đầu Cafe Mimi - Làm sạch và dày tóc', 'THÀNH PHẦN & CÔNG DỤNG TẨY TẾ BÀO CHẾT DA DẦU CAFE MIMI:\r\nMàu xanh dương - Dầu gội tẩy tế bào chết da đầu Deep Cleansing & Hair Growth Café Mimi Deep Cleansing & Hair Growth\r\nChứa hơn 50% muối biển tự nhiên có tác dụng hút dầu, làm sạch chân tóc, chống bết, loại bỏ tế bào chết\r\n', 'TTBC03.JPG', 229.000, 0, 0),
(16, 4, 'Sữa Tắm Khử Mùi Perspi-Guard Odour Control Body Wash', 'Sữa Tắm Ngăn Mồ Hôi Perspi-Guard Odour Control Body Wash Original Khử Mùi Vượt Trội 200ml\r\nSữa Tắm Ngăn Mồ Hôi Perspi-Guard Odour Control Body Wash Original Khử Mùi Vượt Trội 200ml là loại sữa tắm có thể giải quyết tận gốc nguyên nhân của vấn đề. Công thức khoa học ban đầu được phát triển để điều trị mùi hôi. Perspi-Guard Odor Control Bodywash được bào chế để làm sạch da và loại bỏ mùi cơ thể từ các vùng thường bị ảnh hưởng, chẳng hạn như nách, bàn chân và bẹn\r\n', 'SUATAM01.JPG', 250.000, 0, 0),
(17, 4, 'Xà Phòng Giảm Mụn Cơ Thể Derladie Body Cleansing Bar For Blemish Skin', 'Xà Phòng Giảm Mụn Cơ Thể Derladie Body Cleansing Bar For Blemish Skin là giải pháp chăm sóc và điều trị vùng da cơ thể có mụn hiệu quả với thành phần chính chiết xuất từ thiên nhiên, có hiệu quả làm sạch sâu lỗ chân lông, loại bỏ bã nhờn, bụi bẩn, đồng thời kháng viêm, phục hồi da hiệu quả, mang đến làn da sáng mịn và sạch mụn\r\n \r\n\r\n', 'SUATAM02.JPG\r\n', 119.000, 0, 0),
(18, 4, 'Sáp khử mùi Old Spice - New Collection', 'Sáp khử mùi Old Spice 85g nhập khẩu từ Mỹ, khử mùi bền bỉ suốt 48 giờ và đem lại hương thơm nam tính, dễ chịu cho vùng da dưới cánh tay và không để lại vệt sáp, không làm ố vàng áo giúp Phái Mạnh luôn t', 'KHUMUI01.JPG', 167.000, 0, 0),
(19, 4, 'Gel Khử Mùi Gillette Cool Wave', 'Gel Khử Mùi Gillette Giảm Tiết Mồ Hôi 107g là dòng sản phẩm khử mùi cho nam đến từ thương hiệu chăm sóc cơ thể Gillette của Mỹ, với công thức 3 tác động ngăn mùi và loại bỏ mùi cơ thể, ngăn sự ẩm ướt ở vùng da dưới cánh tay đem lại 48h khô thoáng, sạch sẽ và mùi hương thơm mát, quyến rũ.', 'KHUMUI02.JPG', 99.000, 0, 0),
(20, 4, 'Nước Hoa Xịt Toàn Thân Unisex Fogg', 'NƯỚC HOA XỊT TOÀN THÂN UNISEX FOGG – “SIÊU PHẨM” GIÚP PHÁI MẠNH TỰ TIN, THU HÚT TRONG MỌI TÌNH HUỐNG', 'NUOCHOA02.JPG', 150.000, 0, 0),
(21, 5, 'Máy tỉa lông mũi WL2604', 'Sản phẩm có bề ngoài đẹp mắt, thiết kế đơn giản, kích thước nhỏ gọn tiện mang theo bên mình.\r\nSản phẩm dùng để tỉa lông mũi, lông tai, ngoài ra bạn có thể dùng nó để tỉa các phần lông mày, râu thừa để cho nó vào kiểu lại.\r\nSản phẩm dùng lưỡi cắt hợp kim inox 201 hạn chế gỉ sét tối đa, độ an toàn cao, không gây dị ứng khi sử dụng.\r\n', 'CAORAU01.JPG', 150.000, 0, 0),
(22, 5, 'Máy Cạo Râu Flyco FS197VN', 'Máy cạo râu Flyco khả năng chống nước an toàn tuyệt đối nhờ công nghệ IPX7\r\nNhờ đó máy có thể được vệ sinh sạch kĩ càng, hạn chế tích tụ vi khuẩn gây mầm bệnh về da.\r\n', 'CAORAU04.JPG', 999.000, 0, 0),
(23, 5, 'Dung dịch Vệ Sinh Nam Grinif Men', 'Grinif Men Premium Intimate Wash chính hãng là dòng sản phẩm vệ sinh khá nổi tiếng ở thế giới. Với sự công thức đột phá mới, mang lại trải nghiệm toàn diện cho các đấng mày râu, sản phẩm này đang là tâm điểm của các quý ông', 'DDVS02.JPG', 216.000, 0, 0),
(24, 5, 'Kem Đánh Răng Than Hoạt Tính Splat Special Blackwood Trắng Sáng', 'Kem đánh răng than hoạt tính Splat Special trắng sáng Blackwood 75ml\r\nKEM ĐÁNH RĂNG LÀM TRẮNG HIỆU QUẢ VỚI THAN HOẠT TÍNH \r\nSplat Kem đánh răng uy tín được bầu chọn bởi hiệp hội Nha Khoa Châu Âu \r\nĐược kiểm nghiệm và chứng nhận Y khoa tại Châu Âu, Thụy Sĩ, Nhật Bản.\r\n', 'RANGMIENG02.JPG', 149.000, 0, 0),
(25, 5, 'Miếng Dán Trắng Răng Anriea - Hộp 3 miếng', 'Miếng dán trắng răng BLACK TOOTH WHITENER\r\nTHƯƠNG HIỆU: ANRIEA\r\nXUẤT XỨ: ĐÀI LOAN\r\n', 'RANGMIENG06.JPG', 219.000, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` int(50) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_name`) VALUES
(1, 'Tạo kiểu tóc'),
(2, 'Chăm sóc da'),
(3, 'Chăm sóc tóc'),
(4, 'Chăm sóc cơ thể'),
(5, 'Chăm sóc cá nhân');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `service_id` int(5) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `service_price` decimal(6,3) NOT NULL,
  `service_duration` int(5) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_description`, `service_price`, `service_duration`, `img`) VALUES
(1, 'Basic Hair Cut & Shave', 'Bao gồm: Cắt tóc; Gội đầu; Tạo kiểu', 150.000, 60, 'img/service-1.jpg'),
(2, 'Premium Hair Cut & Shave', 'Bao gồm: Cắt tóc; Gội đầu; Tạo kiểu; Lột mụn; Lấy ráy tai', 250.000, 90, 'img/service-2.jpg'),
(3, 'Luxury Hair Cut & Shave', 'Bao gồm: Cắt tóc; Gội đầu; Tạo kiểu; Lột mụn; Lấy ráy tai; Massage', 350.000, 120, 'img/service-3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(50) NOT NULL,
  `client_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shopping_cart_item`
--

CREATE TABLE `shopping_cart_item` (
  `id` int(50) NOT NULL,
  `cart_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `FK_client_address` (`client_id`);

--
-- Chỉ mục cho bảng `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `FK_client_appointment` (`client_id`),
  ADD KEY `FK_employee_appointment` (`employee_id`),
  ADD KEY `FK_service_appointment` (`service_id`);

--
-- Chỉ mục cho bảng `barber_admin`
--
ALTER TABLE `barber_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_email` (`client_email`);

--
-- Chỉ mục cho bảng `client_credit_card_info`
--
ALTER TABLE `client_credit_card_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_client_credit` (`client_id`);

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Chỉ mục cho bảng `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD KEY `FK_employee_shift` (`employee_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_client_order` (`client_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_product_category` (`category_id`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Chỉ mục cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FK_client_cart` (`client_id`);

--
-- Chỉ mục cho bảng `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_cart_id` (`cart_id`),
  ADD KEY `FK_cart_item` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `barber_admin`
--
ALTER TABLE `barber_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `client_credit_card_info`
--
ALTER TABLE `client_credit_card_info`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `FK_client_address` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_client_appointment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_employee_appointment` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_service_appointment` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `client_credit_card_info`
--
ALTER TABLE `client_credit_card_info`
  ADD CONSTRAINT `FK_client_credit` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD CONSTRAINT `FK_employee_shift` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_client_order` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `FK_client_cart` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `shopping_cart_item`
--
ALTER TABLE `shopping_cart_item`
  ADD CONSTRAINT `shopping_cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `shopping_cart` (`cart_id`),
  ADD CONSTRAINT `shopping_cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
