-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 10, 2023 at 03:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nirvana_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings_tbl`
--

CREATE TABLE `bookings_tbl` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `name` varchar(55) NOT NULL,
  `contact_number` varchar(55) NOT NULL,
  `isBooked` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings_tbl`
--

INSERT INTO `bookings_tbl` (`id`, `room_id`, `check_in`, `check_out`, `name`, `contact_number`, `isBooked`, `date_created`) VALUES
(31, 4, '2023-11-15', '2023-11-30', 'juan santos', '09123', 1, '2023-11-04 05:41:37'),
(32, 13, '2023-11-19', '2023-11-30', 'juan dela cruz', '55', 1, '2023-11-04 13:44:47'),
(33, 11, '2023-11-15', '2023-11-29', 'hello world', '12309', 1, '2023-11-04 14:16:23'),
(34, 12, '2023-12-20', '2023-01-10', 'Bebian', '09912345', 1, '2023-11-04 15:28:43'),
(35, 6, '2023-12-15', '2023-12-28', 'hello obadi', '2', 1, '2023-11-09 15:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `room_tbl`
--

CREATE TABLE `room_tbl` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_tbl`
--

INSERT INTO `room_tbl` (`id`, `room_number`, `room_type_id`, `date_created`) VALUES
(1, 1, 1, '2023-09-02 14:52:14'),
(2, 2, 1, '2023-09-02 14:52:14'),
(3, 3, 2, '2023-09-02 14:52:14'),
(4, 4, 2, '2023-09-02 14:52:14'),
(5, 5, 3, '2023-09-02 14:52:14'),
(6, 6, 4, '2023-09-02 14:52:14'),
(7, 7, 3, '2023-09-02 14:52:14'),
(8, 8, 4, '2023-09-02 14:52:14'),
(9, 9, 5, '2023-09-02 14:52:14'),
(10, 10, 5, '2023-09-02 14:52:14'),
(11, 11, 6, '2023-09-02 14:52:14'),
(12, 12, 7, '2023-09-02 14:52:14'),
(13, 13, 8, '2023-09-02 14:52:14'),
(14, 14, 9, '2023-09-02 14:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `room_type_tbl`
--

CREATE TABLE `room_type_tbl` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `cost` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `bed` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `services` varchar(255) NOT NULL,
  `image_src` varchar(255) NOT NULL,
  `room_size` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type_tbl`
--

INSERT INTO `room_type_tbl` (`id`, `room_name`, `cost`, `size`, `bed`, `capacity`, `services`, `image_src`, `room_size`) VALUES
(1, 'Venue Hall', 999, 30, 'King Beds', 5, 'Wifi, Television, Bathroom', 'room-1.png', 0),
(2, 'Bahay Kubo', 999, 30, 'King Beds', 5, 'Wifi, Television, Bathroom', 'room-2.png', 0),
(3, 'Medium Room', 999, 30, 'King Beds', 5, 'Wifi, Television, Bathroom', 'room-3.png', 2),
(4, 'Small Room', 999, 30, 'King Beds', 5, 'Wifi, Television, Bathroom', 'room-4.png', 1),
(5, 'Premium King Room', 159, 30, 'King Beds', 3, 'Wifi, Television, Bathroom', 'room-5.jpg', 0),
(6, 'Deluxe Room', 159, 30, 'King Beds', 5, 'Wifi, Television, Bathroom', 'room-6.jpg', 0),
(7, 'Double Room', 159, 30, 'King Beds', 2, 'Wifi, Television, Bathroom', 'room-7.jpg', 0),
(8, 'Luxury Room', 159, 30, 'King Beds', 1, 'Wifi, Television, Bathroom', 'room-8.jpg', 0),
(9, 'Room with View', 159, 30, 'King Beds', 1, 'Wifi, Television, Bathroom', 'room-9.jpg', 0),
(10, 'Small-kubo', 900, 20, '2 bed', 10, 'wifi, tv, Bathroom', 'room-10.jpg', 1),
(11, 'Small-kubo 2', 900, 20, '2 bed', 10, 'wifi, tv, Bathroom', 'room-10.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `hotel_name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `hotel_name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Nirvana', 'info@sample.com', '+6948 8542 623', '1600478940_hotel-cover.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings_tbl`
--
ALTER TABLE `bookings_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `room_tbl`
--
ALTER TABLE `room_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_type_id` (`room_type_id`);

--
-- Indexes for table `room_type_tbl`
--
ALTER TABLE `room_type_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings_tbl`
--
ALTER TABLE `bookings_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `room_tbl`
--
ALTER TABLE `room_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room_type_tbl`
--
ALTER TABLE `room_type_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings_tbl`
--
ALTER TABLE `bookings_tbl`
  ADD CONSTRAINT `bookings_tbl_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room_tbl` (`id`);

--
-- Constraints for table `room_tbl`
--
ALTER TABLE `room_tbl`
  ADD CONSTRAINT `room_tbl_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
