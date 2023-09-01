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

CREATE TABLE `room_tbl`(
  `id` INT(11) NOT NULL AUTO_INCREMENT  PRIMARY KEY,
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