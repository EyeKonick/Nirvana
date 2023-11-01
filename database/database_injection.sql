CREATE DATABASE IF NOT EXISTS `nirvana_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `nirvana_db`;

CREATE TABLE `users`(
  `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
);

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `hotel_name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
);

CREATE TABLE `room_type_tbl`(
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `room_name` VARCHAR(255) NOT NULL,
    `cost` INT(11) NOT NULL,
    `size` INT(11) NOT NULL,
    `bed` VARCHAR(255) NOT NULL,
    `capacity` INT(11) NOT NULL,
    `services` VARCHAR(255) NOT NULL,
    `image_src` VARCHAR(255) NOT NULL
);

CREATE TABLE `room_tbl`(
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `room_number` INT(11) NOT NULL,
  `room_type_id` INT(11) NOT NULL, 
  `date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (`room_type_id`) REFERENCES `room_type_tbl`(`id`)
);

CREATE TABLE `bookings_tbl` (
  `id` INT(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  `room_id` INT(11) NOT NULL, 
  `check_in` DATE NOT NULL,
  `check_out` DATE NOT NULL,
  `date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (`room_id`) REFERENCES `room_tbl`(`id`)
);0

-- Table Data Dump
INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin123', 1);

INSERT INTO `system_settings` (`id`, `hotel_name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Nirvana', 'info@sample.com', '+6948 8542 623', '1600478940_hotel-cover.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;');


INSERT INTO `room_type_tbl` ( `room_name`, `cost`, `size`, `capacity`, `bed`,`services`,`image_src` ) VALUES
    ('Venue Hall', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom', 'room-1.png'),
    ('Bahay Kubo', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom', 'room-2.png'),
    ('Medium Room', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom', 'room-3.png'),
    ('Small Room', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom', 'room-4.png'),
    ('Premium King Room', 159, 30, 3,'King Beds' ,'Wifi, Television, Bathroom', 'room-5.jpg'),
    ('Deluxe Room', 159, 30, 5,'King Beds' ,'Wifi, Television, Bathroom', 'room-6.jpg'),
    ('Double Room', 159, 30, 2,'King Beds' ,'Wifi, Television, Bathroom', 'room-7.jpg'),
    ('Luxury Room', 159, 30, 1,'King Beds' ,'Wifi, Television, Bathroom', 'room-8.jpg'),
    ('Room with View', 159, 30, 1,'King Beds' ,'Wifi, Television, Bathroom', 'room-9.jpg'),
    ('Small View', 159, 30, 2,'King Beds' ,'Wifi, Television, Bathroom', 'room-10.jpg');

INSERT INTO `room_tbl` ( `room_number`, `room_type_id`) VALUES
  (1, 1),
  (2, 1),
  (3, 2),
  (4, 2),
  (5, 3),
  (6, 4),
  (7, 3),
  (8, 4),
  (9, 5),
  (10, 5),
  (11, 6),
  (12, 7),
  (13, 8),
  (14, 9);