CREATE DATABASE IF NOT EXISTS `nirvana_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `nirvana_db`;

CREATE TABLE `room_type_tbl`(
    `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `room_name` VARCHAR(255) NOT NULL,
    `cost` INT(11) NOT NULL,
    `size` INT(11) NOT NULL,
    `bed` VARCHAR(255) NOT NULL,
    `capacity` INT(11) NOT NULL,
    `services` VARCHAR(255) NOT NULL 
);

CREATE TABLE `bookings_tbl` (
  `id` INT(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  `customer_name` VARCHAR(255) NOT NULL,
  `contact_no` VARCHAR(255) NOT NULL,
  `room_id` INT(11) NOT NULL, 
  `check_in` DATE NOT NULL,
  `check_out` DATE NOT NULL,
  `date_created` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP(),
  FOREIGN KEY (`room_id`) REFERENCES `room_type_tbl`(`id`)
);

-- Table Data Dump
INSERT INTO `room_type_tbl` ( `room_name`, `cost`, `size`, `capacity`, `bed`,`services` ) VALUES
    ('Venue Hall', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Bahay Kubo', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Medium Room', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Small Room', 999, 30, 5,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Premium King Room', 159, 30, 3,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Deluxe Room', 159, 30, 5,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Double Room', 159, 30, 2,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Luxury Room', 159, 30, 1,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Room with View', 159, 30, 1,'King Beds' ,'Wifi, Television, Bathroom'),
    ('Small View', 159, 30, 2,'King Beds' ,'Wifi, Television, Bathroom');