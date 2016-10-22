-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2016 at 10:07 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kings`
--
CREATE DATABASE IF NOT EXISTS `kings` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kings`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `first_name` varchar(40) DEFAULT NULL,
  `middle_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `contact_number` varchar(22) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `province_region` varchar(225) DEFAULT NULL,
  `zip_code` int(4) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `last_log_date` date DEFAULT '0000-00-00',
  `last_edit_date` date DEFAULT '0000-00-00',
  `status` varchar(40) DEFAULT 'off',
  `type` varchar(40) NOT NULL DEFAULT 'Customer',
  `image` varchar(225) NOT NULL DEFAULT 'default.gif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `accounts` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `gender`, `email`, `contact_number`, `address`, `city`, `province_region`, `zip_code`, `birthdate`, `date_added`, `last_log_date`, `last_edit_date`, `status`, `type`, `image`) VALUES
(1, 'admin', '123456', 'King', 'a', 'Philippe', 'M', 'kingphilippe0323131@gmail.com', '9353960623', NULL, NULL, NULL, NULL, '2015-02-11', '2015-02-11', '2015-08-28', '2015-02-22', 'off', 'Admin', 'admin.png'),
(2, 'admin1', 'admin1', 'admin', NULL, 'admin', 'M', 'admin1@yahoo.com', '9061780313', NULL, NULL, NULL, NULL, '1993-11-25', '2015-02-11', '2015-03-03', '2015-02-11', 'off', 'Admin', 'default.gif'),
(3, 'customer1', 'customer', 'customer', NULL, 'customer', 'M', 'kingphilippe032313@gmail.com', '9061780313', NULL, NULL, NULL, NULL, '1993-11-25', '2015-02-11', '2015-08-28', '2015-02-11', 'off', 'Customer', 'default.gif'),
(4, 'customer2', 'customer', 'customer', NULL, 'customer', 'M', 'customer2@gmail.com', '9061780313', NULL, NULL, NULL, NULL, '1993-01-25', '2015-02-19', '2015-03-06', '2015-02-19', 'off', 'Customer', 'default.gif'),
(5, 'kings.23', '032313', 'King', NULL, 'Philippe', 'M', 'king@yahoo.com', '9061780313', NULL, NULL, NULL, NULL, '1993-11-25', '2015-02-22', '2015-03-27', '2015-02-22', 'off', 'Customer', 'kings.23.jpg'),
(7, 'shensantos', 'together', 'shen', NULL, 'santos', 'F', 'santosshannen@yahoo.com', '9069286854', NULL, NULL, NULL, NULL, '1995-09-06', '2015-03-25', '2015-03-25', '2015-03-25', 'off', 'Customer', 'default.gif'),
(8, 'darwinperez', '1234567', 'Darwin', NULL, 'perez', 'M', 'darwino_16@yahoo.com', '9055918996', NULL, NULL, NULL, NULL, '1996-01-09', '2015-03-25', '2015-03-30', '2015-03-25', 'off', 'Customer', 'default.gif'),
(9, 'vernadethsavio', '123456789', 'Vernadeth', NULL, 'Savio', 'F', 'savio_bernadeth9@yahoo.com', '9055918996', NULL, NULL, NULL, NULL, '1996-01-09', '2015-03-27', '0000-00-00', '2015-03-27', 'off', 'Customer', 'default.gif');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
CREATE TABLE IF NOT EXISTS `amenities` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `type` varchar(225) DEFAULT NULL,
  `offer` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `title`, `type`, `offer`) VALUES
(1, 'Party Package', 'Party', 'Free balloons and party hats'),
(2, 'Party Package', 'Party', 'Free Setup around San Pedro, Laguna'),
(3, 'Party Package', 'Party', 'Service of Uniformed and Trained Waiters'),
(4, 'Party Package', 'Party', 'Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece'),
(5, 'Party Package', 'Party', 'Round Tables with Floor Length Tablecloth and Toppings following your color motif'),
(6, 'Party Package', 'Party', 'Chairs with Floor-length Seat Covers'),
(7, 'Party Package', 'Party', 'Simple Fresh Floral Arrangement or Art Balloon DÃ©cor for every Guest Table'),
(8, 'Party Package', 'Party', 'Complete Dining Set-up (use of complete sets of dinnerware, flatware and beverageware)'),
(9, 'Party Package', 'Party', 'Purified Drinking Water'),
(10, 'Party Package', 'Party', 'Ice for the Beverage and Water'),
(11, 'Party Package', 'Party', 'Free Food Tasting good for 2 Persons'),
(12, 'Party Package', 'Party', 'Dresses-up Cake Table (upon request/as needed)'),
(13, 'Party Package', 'Party', 'Dresses-up Gift Table (upon request/as needed)'),
(14, 'Party Package', 'Party', 'Dresses-up Registration Table (upon request/as needed)'),
(15, 'Wedding Package', 'Wedding', 'Free set-up around San Pedro, Laguna'),
(16, 'Wedding Package', 'Wedding', 'Free cake, chocolate fountain and love birds (Dove)'),
(17, 'Wedding Package', 'Wedding', 'Service of Uniformed and Trained Waiters'),
(18, 'Wedding Package', 'Wedding', 'Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece'),
(19, 'Wedding Package', 'Wedding', 'Round Tables with Floor Length Tablecloth and Toppings following your color motif'),
(20, 'Wedding Package', 'Wedding', 'Chairs with Floor-length Seat Covers and Ribbon Accents'),
(21, 'Wedding Package', 'Wedding', 'Complete Dining Set-up (use of complete sets of dinnerware, flatware and beverageware) '),
(22, 'Wedding Package', 'Wedding', 'Purified Drinking Water'),
(23, 'Wedding Package', 'Wedding', 'Ice for the Beverage and Water'),
(24, 'Wedding Package', 'Wedding', 'Free Food Tasting good for 2 Persons'),
(25, 'Wedding Package', 'Wedding', 'Use of Rostrum and Table Numbers (upon request)'),
(26, 'Baptism Package', 'Baptism', 'Free chocolate fountain'),
(27, 'Baptism Package', 'Baptism', 'Free set-up around San Pedro, Laguna'),
(28, 'Baptism Package', 'Baptism', 'Service of Uniformed and Trained Waiters'),
(29, 'Baptism Package', 'Baptism', 'Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece'),
(30, 'Baptism Package', 'Baptism', 'Round Tables with Floor Length Tablecloth and Toppings following your color motif'),
(31, 'Baptism Package', 'Baptism', 'Chairs with Floor-length Seat Covers and Ribbon Accents'),
(32, 'Baptism Package', 'Baptism', 'Simple Fresh Floral Arrangement or Art Balloon DÃ©cor for every Guest Table'),
(33, 'Baptism Package', 'Baptism', 'Complete Dining Set-up (use of complete sets of dinnerware, flatware and beverageware)'),
(34, 'Baptism Package', 'Baptism', 'Purified Drinking Water'),
(35, 'Baptism Package', 'Baptism', 'Ice for the Beverage and Water'),
(36, 'Baptism Package', 'Baptism', 'Free Food Tasting good for 2 Persons (upon schedule)'),
(37, 'Cocktail Merrienda Package', 'Other Offered', 'Ideal for Kiddy Parties, Product Launching, Corporate Affairs or other events which prefer light but filling food choices.'),
(38, 'Budget Party Package', 'Other Offered', ' Recommended for Corporate Affairs or Parties with a big number of reservation with a particular working budget per head. Client may advise the Target Number of Reservation and specific budget to enable CVJ Food Catering form'),
(39, 'Seminar/Whole Day Affair Package', 'Other Offered', 'Includes AM and PM Snacks plus lunch complete with all the basic Party Package Amenities and Free-Flowing of Coffee / Tea.'),
(40, 'Packed Meals', 'Other Offered', ' A complete lunch or merrienda placed in styro packaging which comes complete with disposable tableware.');

-- --------------------------------------------------------

--
-- Table structure for table `catering_branches`
--

DROP TABLE IF EXISTS `catering_branches`;
CREATE TABLE IF NOT EXISTS `catering_branches` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `contact_number` varchar(225) DEFAULT NULL,
  `time` int(225) NOT NULL,
  `vdate` date DEFAULT NULL,
  `stime` time DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `barangay` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `province` varchar(225) DEFAULT NULL,
  `zip` varchar(225) DEFAULT NULL,
  `land` varchar(225) DEFAULT NULL,
  `event_id` int(225) DEFAULT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'serving',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catering_branches`
--

INSERT INTO `catering_branches` (`id`, `contact_number`, `time`, `vdate`, `stime`, `address`, `barangay`, `city`, `province`, `zip`, `land`, `event_id`, `status`) VALUES
(1, '0871349220', 0, '2015-03-30', '16:30:00', '2302 luzon ave sampaloc manila', '555 zone 55', 'manila', 'none', '1008', 'Galas police station', '1', 'serving'),
(2, '9735423736', 0, '2015-03-30', '11:21:00', 'location', 'barangay', 'city', 'provice', '1800', 'McDo', '2', 'serving'),
(3, '1581368743', 0, '2015-03-07', '01:30:00', 'marikina', 'sto nino', 'marikina city', 'metro manila', '1800', 'Blue wave', '3', 'serving'),
(4, '0871349220', 0, '2015-03-30', '16:30:00', '2302 luzon ave sampaloc manila', 'zone 55', 'manila', 'none', '1008', 'Sampaloc police station', '4', 'serving'),
(5, '0871349220', 0, '2015-03-30', '16:30:00', 'Project 6 Quezon City', 'zone 55', 'manila', 'none', '1008', 'Trinoma', '5', 'serving'),
(6, '0871349220', 0, '2015-03-30', '16:30:00', 'Project 3 Quezon City', 'zone 55', 'manila', 'none', '1008', 'SM North Edsa', '6', 'serving'),
(7, '0871349220', 0, '2015-03-30', '16:30:00', 'Banawe Quzon City', 'zone 54', 'manila', 'none', '1008', 'Puregold QI', '7', 'serving'),
(8, '0871349220', 0, '2015-03-30', '16:30:00', 'Cubao Quezon City', 'zone 55', 'manila', 'none', '1008', 'Gateway', '8', 'serving'),
(9, '0871349220', 0, '2015-03-30', '16:30:00', 'Old Sta. Mesa Manila', 'zone 56', 'manila', 'none', '1008', 'SM Sta. Mesa', '9', 'serving'),
(10, '0871349220', 0, '2015-03-30', '16:30:00', 'Old Sta. Mesa Manila', 'zone 35', 'manila', 'none', '1008', 'Mezza - Sta. Mesa', '10','serving'),
(11, '0871349220', 0, '2015-03-30', '16:30:00', 'United Nations Avenue', 'zone 45', 'manila', 'none', '1008', 'SM Manila', '11', 'serving'),
(12, '0871349220', 0, '2015-03-30', '16:30:00', 'Gilmore', 'zone 125', 'manila', 'none', '1008', 'Robinsons Magnolia', '12', 'serving');
-- (13, '0871349220', 0, '2015-03-30', '16:30:00', '2302 luzon ave sampaloc manila', 'zone 55', 'manila', 'none', '1008', 'Robinsons Ermita', 'serving');

-- --------------------------------------------------------

--
-- Table structure for table `course_description`
--

DROP TABLE IF EXISTS `course_description`;
CREATE TABLE IF NOT EXISTS `course_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_description` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_description`
--

INSERT INTO `course_description` (`id`, `course_description`) VALUES
(1, 'Pasta'),
(2, 'Beef'),
(3, 'Pork'),
(4, 'Chicken'),
(5, 'Fish'),
(6, 'Vegetable'),
(7, 'Drink'),
(8, 'Dessert'),
-- (9, 'Additional Service'),
(9, 'Rice');

-- --------------------------------------------------------

--
-- Table structure for table `custom_package`
--

DROP TABLE IF EXISTS `custom_package`;
CREATE TABLE IF NOT EXISTS `custom_package` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `type` int(225) DEFAULT NULL,
  `menu_id` int(225) DEFAULT NULL,
  `customer_id` int(225) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `status` varchar(225) DEFAULT 'set',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_package`
--

INSERT INTO `custom_package` (`id`, `type`, `menu_id`, `customer_id`, `date_created`, `status`) VALUES
(1, 3, 12, 5, '2015-02-22', 'set'),
(2, 3, 18, 5, '2015-02-22', 'set'),
(3, 3, 13, 5, '2015-02-22', 'set'),
(4, 3, 6, 3, '2015-02-28', 'set'),
(5, 3, 9, 3, '2015-02-28', 'set'),
(6, 3, 1, 3, '2015-02-28', 'set'),
(7, 3, 6, 4, '2015-03-06', 'set'),
(8, 3, 9, 4, '2015-03-06', 'set'),
(9, 3, 1, 4, '2015-03-06', 'set'),
(10, 3, 12, 3, '2015-03-06', 'set'),
(11, 3, 18, 3, '2015-03-06', 'set'),
(12, 3, 13, 3, '2015-03-06', 'set'),
(13, 4, 7, 8, '2015-03-25', 'set'),
(14, 4, 10, 8, '2015-03-25', 'set'),
(15, 4, 3, 8, '2015-03-25', 'set'),
(16, 4, 4, 8, '2015-03-25', 'set'),
(17, NULL, 2, 3, '2015-08-21', 'set'),
(18, NULL, 13, 3, '2015-08-21', 'set'),
(19, NULL, 4, 3, '2015-08-21', 'set'),
(20, NULL, 6, 3, '2015-08-21', 'set'),
(21, NULL, 16, 3, '2015-08-21', 'set'),
(22, NULL, 17, 3, '2015-08-21', 'set'),
(23, NULL, 1, 3, '2015-08-28', 'set'),
(24, 3, 4, 3, '2015-08-28', 'set'),
(25, NULL, 0, 3, '2015-08-28', 'set'),
(26, NULL, 0, 3, '2015-08-28', 'set'),
(27, NULL, 0, 3, '2015-08-28', 'set'),
(28, NULL, 0, 3, '2015-08-28', 'set'),
(29, NULL, 0, 3, '2015-08-28', 'set'),
(30, NULL, 0, 3, '2015-08-28', 'set'),
(31, NULL, 0, 3, '2015-08-28', 'set'),
(32, NULL, 0, 3, '2015-08-28', 'set'),
(33, NULL, 0, 3, '2015-08-28', 'set'),
(34, NULL, 0, 3, '2015-08-28', 'set');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

DROP TABLE IF EXISTS `description`;
CREATE TABLE IF NOT EXISTS `description` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `description` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`id`, `description`) VALUES
(1, 'For Birthdays, Baptismal Parties, Anniversaries, Simple Wedding Receptions, Inaugurations, Home Blessings & other Events'),
(2, 'For an Elegant and Worry-free Wedding Reception'),
(3, 'For a Memorable and Worry-free Debut Party');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

DROP TABLE IF EXISTS `dish`;
CREATE TABLE IF NOT EXISTS `dish` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `course` varchar(225) DEFAULT NULL,
  `food_type` varchar(225) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `image` varchar(225) NOT NULL DEFAULT 'default.gif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `name`, `course`, `food_type`, `price`, `image`) VALUES
(1, 'Spaghetti', 'Main Course', 'Pasta', '70.00', 'Spaghetti.jpg'),
(2, 'Carbonara', 'Main course', 'Pasta', '80.00', 'default.gif'),
(3, 'Baked Macaroni', 'Main Course', 'Pasta', '80.00', 'default.gif'),
(4, 'Pancit Bihon', 'Main course', 'Pasta', '60.00', 'default.gif'),
(5, 'Pancit Canton', 'Main Course', 'Pasta', '65.00', '15.jpg'),
(6, 'Pesto', 'Main Course', 'Pasta', '80.00', 'default.gif'),
(7, 'Lasagna', 'Main course', 'Pasta', '90.00', 'default.gif'),
(8, 'Beef Stew', 'Main Course', 'Beef', '80.00', 'default.gif'),
(9, 'Beef Asado', 'Main Course', 'Beef', '80.00', '19.jpg'),
(10, 'Beef Tips Oriental', 'Main Course', 'Beef', '75.00', 'Beef Tips Oriental.jpg'),
(11, 'Beef Mechado', 'Main Course', 'Beef', '75.00', '19.jpg'),
(12, 'Lengua', 'Main Course', 'Beef', '75.00', '19.jpg'),
(13, 'Swedish Meatballs', 'Main Course', 'Beef', '70.00', '19.jpg'),
(14, 'Corned Beef Hash', 'Main Course', 'Beef', '70.00', '19.jpg'),
(15, 'Beef Sukiyaki', 'Main Course', 'Beef', '85.00', '19.jpg'),
(16, 'Beef Morcon', 'Main Course', 'Beef', '70.00', '19.jpg'),
(17, 'Kare-kare', 'Main Course', 'Beef', '90.00', '19.jpg'),
(18, 'Cream Beef Mushroom', 'Main Course', 'Beef', '85.00', '19.jpg'),
(19, 'Roast Pork with Gravy', 'Main Course', 'Pork', '75.00', '19.jpg'),
(20, 'Pork Tips Oriental', 'Main Course', 'Pork', '70.00', '19.jpg'),
(21, 'Pork Asado', 'Main Course', 'Pork', '75.00', '19.jpg'),
(22, 'Afritada', 'Main Course', 'Pork', '70.00', '19.jpg'),
(23, 'Stir-fry Pork with Pineapple', 'Main Course', 'Pork', '70.00', '19.jpg'),
(24, 'Savory Pork in Crispy Noodle', 'Main Course', 'Pork', '75.00', '19.jpg'),
(25, 'Pork Loaf', 'Main Course', 'Pork', '70.00', 'pork_loaf.jpg'),
(26, 'Chinese Barbeque', 'Main Course', 'Pork', '75.00', '19.jpg'),
(27, 'Spareribs', 'Main Course', 'Pork', '85.00', '19.jpg'),
(28, 'Morcon', 'Main Course', 'Pork', '75.00', 'morcon.jpg'),
(29, 'Cordon Bleu', 'Main Course', 'Pork', '75.00', '19.jpg'),
(30, 'Spicy Adobo', 'Main Course', 'Pork', '80.00', '19.jpg'),
(31, 'Chicken Adobo', 'Main Course', 'Chicken', '65.00', '19.jpg'),
(32, 'Chicken Relleno', 'Main Course', 'Chicken', '70.00', '19.jpg'),
(33, 'Chicken Gumbo', 'Main Course', 'Chicken', '70.00', '19.jpg'),
(34, 'Chinese Chicken with Pineapple', 'Main Course', 'Chicken', '75.00', '19.jpg'),
(35, 'Chicken in Vegetable Nest', 'Main Course', 'Chicken', '75.00', '19.jpg'),
(36, 'Fried Chicken', 'Main Course', 'Chicken', '70.00', '19.jpg'),
(37, 'Sweet Lemon Chicken', 'Main Course', 'Chicken', '75.00', '19.jpg'),
(38, 'Chicken Teriyaki', 'Main Course', 'Chicken', '80.00', 'chicken_teriyaki.jpg'),
(39, 'Fish Fillet', 'Main Course', 'Fish', '75.00', 'fish_fillet.jpg'),
(40, 'Grilled Blue Marlin', 'Main Course', 'Fish', '80.00', '19.jpg'),
(41, 'Salmon Verte', 'Main Course', 'Fish', '90.00', '19.jpg'),
(42, 'Inihaw na Bangus', 'Main Course', 'Fish', '75.00', '19.jpg'),
(43, 'Inihaw na Tilapia', 'Main Course', 'Fish', '70.00', '19.jpg'),
(44, 'Fried Fish with Sweet and Sour Sauce', 'Main Course', 'Fish', '75.00', '19.jpg'),
(45, 'Buttered Vegetables', 'Main Course', 'Vegetable', '60.00', '19.jpg'),
(46, 'Hard Boiled Egg and Vegetable Salad', 'Main Course', 'Vegetable', '60.00', '19.jpg'),
(47, 'Tuna and Cabbage Salad', 'Main Course', 'Vegetable', '65.00', '19.jpg'),
(48, 'Chopsuey Guisado', 'Main Course', 'Vegetable', '60.00', '19.jpg'),
(49, 'Fresh Lumpia Ubod', 'Main Course', 'Vegetable', '50.00', '19.jpg'),
(50, 'Mixed Vegetables', 'Main Course', 'Vegetable', '65.00', 'mixed_veggies.jpg'),
(51, 'Orange Juice', 'Drink', 'Drink', '30.00', '19.jpg'),
(52, 'Iced Tea', 'Drink', 'Drink', '30.00', '19.jpg'),
(53, 'Four Seasons', 'Drink', 'Drink', '60.00', '19.jpg'),
(54, 'Assorted Native Kakanin', 'Dessert', 'Dessert', '50.00', '19.jpg'),
(55, 'Fruit Salad', 'Dessert', 'Dessert', '50.00', 'fruit_salad.jpg'),
(56, 'Buko Pandan', 'Dessert', 'Dessert', '50.00', '19.jpg'),
(57, 'Assorted Pastries', 'Dessert', 'Dessert', '50.00', '19.jpg'),
(58, 'Assorted Sweets', 'Dessert', 'Dessert', '50.00', '19.jpg'),
-- (61, 'Chocolate Fountain', 'Additional Service', 'Additional Service', '150.00', 'chocolate_fountain.jpg'),
-- (62, 'Event Setup', 'Additional Service', 'Additional Service', '150.00', '19.jpg'),
-- (63, 'Tables and Chairs', 'Additional Service', 'Additional Service', '150.00', '19.jpg'),
(61, 'Plain Rice', 'Side Dish', 'Rice', '25.00', '19.jpg'),
(62, 'Java Rice', 'Side Dish', 'Rice', '35.00', '19.jpg'),
(63, 'Yangchow', 'Side Dish', 'Rice', '40.00', '19.jpg'),
(64, 'Grilled Chicken', 'Main Course', 'Chicken', '75.00', 'grilled_chicken.jpg'),
(65, 'Sotanghon', 'Main Course', 'Pasta', '70.00', 'sotanghon.jpg'),
(66, 'Crab and Corn', 'Soup', 'Soup', '70.00', '19.jpg'),
(67, 'Mushroom Soup', 'Soup', 'Soup', '60.00', '19.jpg'),
(68, 'Hototay', 'Soup', 'Soup', '60.00', '19.jpg');
-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `date` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_reservation`
--

DROP TABLE IF EXISTS `event_reservation`;
CREATE TABLE IF NOT EXISTS `event_reservation` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `customer_id` int(225) NOT NULL,
  `event_type` varchar(225) DEFAULT NULL,
  `package_type` varchar(225) DEFAULT NULL,
  `package_id` int(225) DEFAULT NULL,
  `amount` varchar(225) DEFAULT NULL,
  `head_count` int(225) NOT NULL,
  `date` datetime DEFAULT NULL,
  `location` varchar(225) DEFAULT NULL,
  `in_laguna` tinyint(1) DEFAULT '1',
  `time_start` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_end` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(225) NOT NULL DEFAULT 'pending',
  primary key (id)
) ;

--
-- Dumping data for table `event_reservation`
--

INSERT INTO `event_reservation` (`id`, `customer_id`, `event_type`, `package_type`, `package_id`, `amount`, `head_count`, `date`, `location`, `in_laguna`, `time_start`, `time_end`, `status`) VALUES
(1, 5, 'Wedding', 'Fixed', 1, '24000', 100, '2016-09-09 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-09-09 13:00:00.000000', '2016-09-09 15:00:00.000000', 'finished'),
(2, 4, 'Debut', 'Fixed', 2, '24000', 200, '2016-10-30 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-10-30 13:00:00.000000', '2016-10-30 15:00:00.000000', 'paid'),
(3, 4, 'Wedding', 'Fixed', 3, '24000', 200, '2016-11-04 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-11-04 13:00:00.000000', '2016-11-04 15:00:00.000000', 'paid'),
(4, 4, 'Debut', 'Fixed', 4, '24000', 200, '2016-10-01 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-10-01 13:00:00.000000', '2016-10-01 15:00:00.000000', 'pending'),
(5, 3, 'Wedding', 'Fixed', 3, '24000', 150, '2016-03-06 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-03-06 13:00:00.000000', '2016-03-06 15:00:00.000000', 'finished'),
(6, 3, 'Debut', 'Fixed', 2, '24000', 150, '2016-03-06 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-03-06 13:00:00.000000', '2016-03-06 15:00:00.000000', 'finished'),
(7, 3, 'Wedding', 'Fixed', 4, '24000', 150, '2016-10-20 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-10-20 13:00:00.000000', '2016-10-20 15:00:00.000000', 'paid'),
(8, 7, 'Debut', 'Fixed', 1, '24000', 100, '2016-10-20 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-10-20 13:00:00.000000', '2016-10-20 15:00:00.000000', 'overdue'),
(9, 7, 'Wedding', 'Fixed', 5, '24000', 100, '2016-10-27 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-10-27 13:00:00.000000', '2016-10-27 15:00:00.000000', 'paid'),
(10, 7, 'Debut', 'Fixed', 3, '24000', 100, '2016-11-15 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-11-15 13:00:00.000000', '2016-11-15 15:00:00.000000', 'pending'),
(11, 7, 'Wedding', 'Fixed', 4, '24000', 100, '2016-09-09 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-09-09 13:00:00.000000', '2016-09-09 15:00:00.000000', 'finished'),
(12, 5, 'Debut', 'Fixed', 2, '24000', 22, '2016-10-20 00:00:00', '1234 Sarap St. Binan, Laguna', 1, '2016-10-20 13:00:00.000000', '2016-10-20 15:00:00.000000', 'overdue');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_package`
--

DROP TABLE IF EXISTS `fixed_package`;
CREATE TABLE IF NOT EXISTS `fixed_package` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `num_course` int(225) DEFAULT NULL,
  `package_type` varchar(225) DEFAULT NULL,
  `package_id` int(225) DEFAULT NULL,
  `dish_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixed_package`
--

INSERT INTO `fixed_package` (`id`, `num_course`, `package_type`, `package_id`, `dish_id`, `date_created`) VALUES
(1, 10, 'Fixed', 1, 63, '2015-02-11 00:00:00'),
(2, 1, 'Fixed', 1, 1, '2015-02-11 00:00:00'),
(3, 6, 'Fixed', 1, 50, '2015-02-11 00:00:00'),
(4, 3, 'Fixed', 1, 28, '2015-02-11 00:00:00'),
(5, 4, 'Fixed', 1, 38, '2015-02-11 00:00:00'),
(6, 5, 'Fixed', 1, 39, '2015-02-11 00:00:00'),
(7, 8, 'Fixed', 1, 56, '2015-02-11 00:00:00'),
(8, 7, 'Fixed', 1, 52, '2015-02-11 00:00:00'),
(9, 10, 'Fixed', 2, 65, '2015-02-11 00:00:00'),
(10, 1, 'Fixed', 2, 2, '2015-02-11 00:00:00'),
(11, 2, 'Fixed', 2, 12, '2015-02-11 00:00:00'),
(12, 3, 'Fixed', 2, 21, '2015-02-11 00:00:00'),
(13, 4, 'Fixed', 2, 36, '2015-02-11 00:00:00'),
(14, 5, 'Fixed', 2, 42, '2015-02-11 00:00:00'),
(15, 6, 'Fixed', 2, 45, '2015-02-11 00:00:00'),
(16, 7, 'Fixed', 2, 51, '2015-02-11 00:00:00'),
(17, 8, 'Fixed', 2, 56, '2015-02-11 00:00:00'),
(18, 10, 'Fixed', 3, 64, '2015-02-11 00:00:00'),
(19, 1, 'Fixed', 3, 3, '2015-02-11 00:00:00'),
(20, 2, 'Fixed', 3, 9, '2015-02-11 00:00:00'),
(21, 3, 'Fixed', 3, 20, '2015-02-11 00:00:00'),
(22, 4, 'Fixed', 3, 33, '2015-02-11 00:00:00'),
(23, 5, 'Fixed', 3, 40, '2015-02-11 00:00:00'),
(24, 6, 'Fixed', 3, 48, '2015-02-11 00:00:00'),
(25, 8, 'Fixed', 3, 57, '2015-02-11 00:00:00'),
(26, 7, 'Fixed', 3, 53, '2015-02-11 00:00:00'),
(27, 10, 'Fixed', 4, 63, '2015-02-11 00:00:00'),
(28, 2, 'Fixed', 4, 11, '2015-02-11 00:00:00'),
(29, 3, 'Fixed', 4, 27, '2015-02-11 00:00:00'),
(30, 4, 'Fixed', 4, 34, '2015-02-11 00:00:00'),
(31, 5, 'Fixed', 4, 43, '2015-02-11 00:00:00'),
(32, 6, 'Fixed', 4, 49, '2015-02-11 00:00:00'),
(33, 7, 'Fixed', 4, 53, '2015-02-11 00:00:00'),
(34, 8, 'Fixed', 4, 55, '2015-02-11 00:00:00'),
(35, 10, 'Fixed', 5, 63, '2015-02-11 00:00:00'),
(36, 1, 'Fixed', 5, 5, '2015-02-11 00:00:00'),
(37, 2, 'Fixed', 5, 18, '2015-02-11 00:00:00'),
(38, 3, 'Fixed', 5, 25, '2015-02-11 00:00:00'),
(39, 4, 'Fixed', 5, 37, '2015-02-11 00:00:00'),
(40, 5, 'Fixed', 5, 44, '2015-02-11 00:00:00'),
(41, 6, 'Fixed', 5, 47, '2015-02-11 00:00:00'),
(42, 7, 'Fixed', 5, 53, '2015-02-11 00:00:00'),
(43, 8, 'Fixed', 5, 54, '2015-02-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_package_details`
--

DROP TABLE IF EXISTS `fixed_package_details`;
CREATE TABLE IF NOT EXISTS `fixed_package_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `pax` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixed_package_details`
--

INSERT INTO `fixed_package_details` (`id`, `package_id`, `price`, `pax`) VALUES
(1, 1, 22000, 50),
(2, 2, 105000, 100),
(3, 3, 35000, 100),
(4, 4, 76000, 100),
(5, 5, 40000, 100),
(6, 6, 60000, 100);


-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery_menu`;
CREATE TABLE IF NOT EXISTS `gallery_menu` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `food_type` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO `gallery_menu` (`name`, `food_type`) VALUES
('Beef Tips Oriental.jpg', 'Beef'),
('Chicken Teriyaki.jpg', 'Chicken'),
('Spaghetti.jpg', 'Pasta'),
('Fish Fillet.jpg', 'Fish'),
('Fruit Salad.jpg', 'Dessert'),
('Grilled Chicken.jpg', 'Chicken'),
('Mixed Veggies.jpg', 'Vegetable'),
('Morcon.jpg', 'Beef'),
('Pork Loaf.jpg', 'Pork'),
('Sotanghon.jpg', 'Pasta');


DROP TABLE IF EXISTS `gallery`;
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `source` varchar(225) DEFAULT NULL,
  `is_deleted` boolean NOT NULL DEFAULT false,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;


INSERT INTO `gallery` (`title`, `name`, `source`) VALUES
('Catering', 'Catering-1.jpg', 'images/gal'),
('Catering', 'Catering-2.jpg', 'images/gal'),
('Catering', 'Catering-3.jpg', 'images/gal'),
('Catering', 'Catering-4.jpg', 'images/gal'),
('Catering', 'Catering-5.jpg', 'images/gal'),
('Catering', 'Catering-6.jpg', 'images/gal'),
('Catering', 'Catering-7.jpg', 'images/gal'),
('Catering', 'Catering-8.jpg', 'images/gal'),
('Catering', 'Catering-9.jpg', 'images/gal'),
('Catering', 'Catering-10.jpg', 'images/gal'),
('Catering', 'Catering-11.jpg', 'images/gal'),
('Catering', 'Catering-12.jpg', 'images/gal'),
('Catering', 'Catering-13.jpg', 'images/gal'),
('Menu', 'Beef Tips Oriental.jpg', 'images/gal'),
('Menu', 'Chicken Teriyaki.jpg', 'images/gal'),
('Menu', 'Spaghetti.jpg', 'images/gal'),
('Menu', 'Fish Fillet.jpg', 'images/gal'),
('Menu', 'Fruit Salad.jpg', 'images/gal'),
('Menu', 'Grilled Chicken.jpg', 'images/gal'),
('Menu', 'Mixed Veggies.jpg', 'images/gal'),
('Menu', 'Morcon.jpg', 'images/gal'),
('Menu', 'Pork Loaf.jpg', 'images/gal'),
('Menu', 'Sotanghon.jpg', 'images/gal'),
('Set Up', 'Set Up-1.jpg', 'images/gal'),
('Set Up', 'Set Up-2.jpg', 'images/gal'),
('Set Up', 'Set Up-3.jpg', 'images/gal'),
('Set Up', 'Set Up-4.jpg', 'images/gal'),
('Set Up', 'Set Up-5.jpg', 'images/gal'),
('Set Up', 'Set Up-6.jpg', 'images/gal'),
('Set Up', 'Set Up-7.jpg', 'images/gal'),
('Set Up', 'Set Up-8.jpg', 'images/gal'),
('Set Up', 'Set Up-9.jpg', 'images/gal'),
('Set Up', 'Set Up-10.jpg', 'images/gal'),
('Set Up', 'Set Up-11.jpg', 'images/gal'),
('Set Up', 'Set Up-12.jpg', 'images/gal'),
('Set Up', 'Set Up-13.jpg', 'images/gal'),
('Set Up', 'Set Up-14.jpg', 'images/gal'),
('Set Up', 'Set Up-15.jpg', 'images/gal'),
('Set Up', 'Set Up-16.jpg', 'images/gal'),
('Set Up', 'Set Up-17.jpg', 'images/gal'),
('Set Up', 'Set Up-18.jpg', 'images/gal'),
('Set Up', 'Set Up-19.jpg', 'images/gal'),
('Set Up', 'Set Up-20.jpg', 'images/gal'),
('Set Up', 'Set Up-21.jpg', 'images/gal'),
('Set Up', 'Set Up-22.jpg', 'images/gal'),
('Set Up', 'Set Up-23.jpg', 'images/gal'),
('Set Up', 'Set Up-24.jpg', 'images/gal');
-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `customer_id` int(225) NOT NULL,
  `event_id` int(225) NOT NULL,
  `path` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `receipt` (`customer_id`,`event_id`,`path`, `name`) VALUES
(4, 2, "images/receipt", "default.gif"),
(4, 3, "images/receipt", "default.gif"),
(3, 7, "images/receipt", "default.gif"),
(7, 9, "images/receipt", "default.gif");

DROP TABLE IF EXISTS `service_provider`;
CREATE TABLE IF NOT EXISTS `service_provider` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `name` varchar(22) DEFAULT NULL,
  `suf` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`id`, `name`, `suf`) VALUES
(1, 'Globe ', 905),
(2, 'Globe ', 906),
(3, 'Smart ', 907),
(4, 'Smart ', 908),
(5, 'Smart ', 909),
(6, 'Smart', 910),
(7, 'Smart ', 912),
(8, 'Globe ', 915),
(9, 'Globe ', 916),
(10, 'Globe ', 917),
(11, 'Globe ', 9178),
(12, 'Smart', 918),
(13, 'Smart ', 919),
(14, 'Smart', 920),
(15, 'Smart ', 921),
(16, 'Sun ', 922),
(17, 'Sun ', 923),
(18, 'Sun ', 925),
(19, 'Globe ', 926),
(20, 'Globe ', 927),
(21, 'Smart ', 928),
(22, 'Smart ', 929),
(23, 'Smart', 930),
(24, 'Sun ', 932),
(25, 'Sun ', 933),
(26, 'Sun ', 934),
(27, 'Globe ', 935),
(28, 'Globe ', 936),
(29, 'Globe ', 937),
(30, 'Smart', 938),
(31, 'Smart', 939),
(32, 'Sun ', 942),
(33, 'Sun ', 943),
(34, 'Talk N Text', 946),
(35, 'Smart', 947),
(36, 'Smart', 948),
(37, 'Smart ', 949),
(38, 'Extelcom', 973),
(39, 'Smart ', 989),
(40, 'Globe', 994),
(41, 'Globe ', 996),
(42, 'Globe ', 997),
(43, 'Smart', 998),
(44, 'Smart', 999),
(45, 'Smart', 813),
(46, 'Globe', 817),
(47, 'Globe', 925),
(48, 'Sun ', 934),
(49, 'Smart ', 946),
(50, 'Smart', 947),
(51, 'Globe', 994),
(52, 'Smart', 998),
(53, 'Globe', 903);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
