-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2015 at 09:09 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kings`
--
CREATE DATABASE IF NOT EXISTS `kingsDB` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `kingsDB`;

-- --------------------------------------------------------

--
-- Table structure for table `eventss`
--

CREATE TABLE IF NOT EXISTS `eventss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `evdate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custo`
--

CREATE TABLE IF NOT EXISTS `tbl_custo` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `code` varchar(225) DEFAULT NULL,
  `type` varchar(225) DEFAULT NULL,
  `mid` int(225) DEFAULT NULL,
  `paks` int(11) NOT NULL,
  `creator` int(225) DEFAULT NULL,
  `datec` date DEFAULT NULL,
  `status` varchar(225) DEFAULT 'set',
  `times` int(225) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `tbl_custo`
--

INSERT INTO `tbl_custo` (`id`, `code`, `type`, `mid`, `paks`, `creator`, `datec`, `status`, `times`) VALUES
(1, 'BOSSTX6TH5', 'cm3', 12, 150, 5, '2015-02-22', 'set', 1),
(2, 'BOSSTX6TH5', 'cm3', 18, 150, 5, '2015-02-22', 'set', 1),
(3, 'BOSSTX6TH5', 'cm3', 13, 150, 5, '2015-02-22', 'set', 1),
(4, 'NPOMILQ8LF', 'cm3', 6, 456, 3, '2015-02-28', 'set', 1),
(5, 'NPOMILQ8LF', 'cm3', 9, 456, 3, '2015-02-28', 'set', 1),
(6, 'NPOMILQ8LF', 'cm3', 1, 456, 3, '2015-02-28', 'set', 1),
(7, 'HUKSOH1VH0', 'cm3', 6, 200, 4, '2015-03-06', 'set', 1),
(8, 'HUKSOH1VH0', 'cm3', 9, 200, 4, '2015-03-06', 'set', 1),
(9, 'HUKSOH1VH0', 'cm3', 1, 200, 4, '2015-03-06', 'set', 1),
(10, 'QD5380FWIB', 'cm3', 12, 150, 3, '2015-03-06', 'set', 1),
(11, 'QD5380FWIB', 'cm3', 18, 150, 3, '2015-03-06', 'set', 1),
(12, 'QD5380FWIB', 'cm3', 13, 150, 3, '2015-03-06', 'set', 1),
(13, 'IRTGNL86TG', 'cm4', 7, 1000, 8, '2015-03-25', 'set', 1),
(14, 'IRTGNL86TG', 'cm4', 10, 1000, 8, '2015-03-25', 'set', 1),
(15, 'IRTGNL86TG', 'cm4', 3, 1000, 8, '2015-03-25', 'set', 1),
(16, 'IRTGNL86TG', 'cm4', 4, 1000, 8, '2015-03-25', 'set', 1),
(17, '9N4WQ4UBGS', NULL, 2, 0, 3, '2015-08-21', 'set', 1),
(18, '9N4WQ4UBGS', NULL, 13, 0, 3, '2015-08-21', 'set', 1),
(19, '9N4WQ4UBGS', NULL, 4, 0, 3, '2015-08-21', 'set', 1),
(20, '9N4WQ4UBGS', NULL, 6, 0, 3, '2015-08-21', 'set', 1),
(21, '9N4WQ4UBGS', NULL, 16, 0, 3, '2015-08-21', 'set', 1),
(22, '9N4WQ4UBGS', NULL, 17, 0, 3, '2015-08-21', 'set', 1),
(23, 'D3VVWUK6KU', NULL, 1, 0, 3, '2015-08-28', 'set', 1),
(25, 'D3VVWUK6KU', 'cm3', 4, 0, 3, '2015-08-28', 'set', 1),
(66, '123', NULL, 123, 0, 3, '2015-08-28', 'set', 1),
(67, 'B0H7CFUMEG', NULL, 13, 0, 3, '2015-08-28', 'set', 1),
(68, 'B0H7CFUMEG', NULL, 3, 0, 3, '2015-08-28', 'set', 1),
(69, 'OVGPPYYZMS', NULL, 18, 0, 3, '2015-08-28', 'set', 1),
(70, 'U31US2DTJK', NULL, 13, 0, 3, '2015-08-28', 'set', 1),
(71, 'U31US2DTJK', NULL, 3, 0, 3, '2015-08-28', 'set', 1),
(72, 'U31US2DTJK', NULL, 4, 0, 3, '2015-08-28', 'set', 1),
(73, 'U31US2DTJK', NULL, 5, 0, 3, '2015-08-28', 'set', 1),
(74, 'U31US2DTJK', NULL, 15, 0, 3, '2015-08-28', 'set', 1),
(75, 'U31US2DTJK', NULL, 17, 0, 3, '2015-08-28', 'set', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_desc`
--

CREATE TABLE IF NOT EXISTS `tbl_desc` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `des` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_desc`
--

INSERT INTO `tbl_desc` (`id`, `des`) VALUES
(1, 'For Birthdays, Baptismal Parties, Anniversaries, Simple Wedding Receptions, Inaugurations, Home Blessings & other Events'),
(2, 'For an Elegant and Worry-free Wedding Reception'),
(3, 'For a Memorable and Worry-free Debut Party');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gal`
--

CREATE TABLE IF NOT EXISTS `tbl_gal` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `piccnt` int(225) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tbl_gal`
--

INSERT INTO `tbl_gal` (`id`, `title`, `piccnt`) VALUES
(30, 'Catering', 13),
(31, 'set up', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `code` varchar(225) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `course` varchar(225) DEFAULT NULL,
  `wala` varchar(225) DEFAULT NULL,
  `ppserve` decimal(6,2) DEFAULT NULL,
  `image` varchar(225) NOT NULL DEFAULT 'default.gif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `code`, `name`, `course`, `wala`, `ppserve`, `image`) VALUES
(1, '74IY743N5E', 'sour cream', 'Appetizer', 'Dips', '53.00', '1.jpg'),
(2, 'AU7S154NTN', 'Taco Dip', 'Appetizer', 'Dips', '30.00', 'default.gif'),
(3, '4TLXXLU2QW', 'Strawberries & Grapes', 'Appetizer', 'Vegetable and Fruit Trays', '70.00', 'default.gif'),
(4, 'IPA03XRTKA', 'Stuffed Chicken Breast w/ Prosciotto & Gruyere Cheese', 'Entree', 'Chicken', '80.00', 'default.gif'),
(5, 'XNCWZCGDN8', 'Beef Burgandy', 'Entree', 'Beef', '120.00', 'default.gif'),
(6, 'CS47ZQ5JUB', 'Herb-roasted Beef Tenderloin', 'Main course', 'Beef', '100.00', 'default.gif'),
(7, 'Y4V48BK97W', 'Pork Tenderloin', 'Main course', 'Pork', '100.00', 'default.gif'),
(8, 'WALAACN9RZ', 'Pad Thai with Chicken and Shrimp', 'Main course', 'Chicken', '105.00', 'default.gif'),
(9, '17RB0Y9X9V', 'Salty Chocolate Chunk Cookies', 'Dessert', 'Cookies', '30.00', 'default.gif'),
(10, 'QY1R4X2YXZ', 'Banana Cream Pie', 'Dessert', 'Pies', '80.00', 'default.gif'),
(11, '1M6QJ4RVD2', 'sample', 'Main course', 'Pork', '333.00', 'default.gif'),
(12, 'GGEDS8YIVD', 'sample 2', 'Main course', 'Chicken', '22.00', 'default.gif'),
(13, 'T4ZLEHNZQD', 'sample 3', 'Appetizer', 'Dips', '55.00', 'default.gif'),
(14, 'MYTBYCHL8P', 'sample 4', 'Main course', 'Beef', '255.00', 'default.gif'),
(15, 'Y11VLZ2CM9', 'Sample 5', 'Appetizer', 'Meal and Cheese Trays', '66.00', '15.jpg'),
(16, 'V5Q9ZE7SCP', 'sample 7', 'Entree', 'Beef', '99.00', 'default.gif'),
(17, 'O8F4GF6A7O', 'Sample6', 'Main course', 'Pasta', '120.00', 'default.gif'),
(18, '385V4M0CRI', 'Sample 8', 'Dessert', 'Cakes', '55.00', 'default.gif'),
(19, 'V1E9JDPD3K', 'bago', 'Appetizer', 'Vegetable and Fruit Trays', '22.00', '19.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE IF NOT EXISTS `tbl_offer` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `type` varchar(225) DEFAULT NULL,
  `offer` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `tbl_offer`
--

INSERT INTO `tbl_offer` (`id`, `title`, `type`, `offer`) VALUES
(1, 'Party Package', 'Party', 'Free Flow Beverage (Choice of either Soft Drinks or Chilled Lemon Iced Tea)'),
(2, 'Party Package', 'Party', 'Service of Uniformed and Trained Waiters'),
(3, 'Party Package', 'Party', 'Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece'),
(4, 'Party Package', 'Party', 'Round Tables with Floor Length Tablecloth and Toppings following your color motif'),
(5, 'Party Package', 'Party', 'Chairs with Floor-length Seat Covers'),
(6, 'Party Package', 'Party', 'Simple Fresh Floral Arrangement or Art Balloon DÃ©cor for every Guest Table'),
(7, 'Party Package', 'Party', 'Complete Dining Set-up (use of complete sets of dinnerware, flatware and beverageware)'),
(8, 'Party Package', 'Party', 'Purified Drinking Water'),
(9, 'Party Package', 'Party', 'Ice for the Beverage and Water'),
(10, 'Party Package', 'Party', 'Free Food Tasting good for 2 Persons'),
(11, 'Party Package', 'Party', 'Dresses-up Cake Table (upon request/as needed)'),
(12, 'Party Package', 'Party', 'Dresses-up Gift Table (upon request/as needed)'),
(13, 'Party Package', 'Party', 'Dresses-up Registration Table (upon request/as needed)'),
(14, 'Wedding Package', 'Wedding', 'Free Flow Beverage (Choice of either Soft Drinks or Chilled Lemon Iced Tea)'),
(15, 'Wedding Package', 'Wedding', 'Service of Uniformed and Trained Waiters'),
(16, 'Wedding Package', 'Wedding', 'Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece'),
(17, 'Wedding Package', 'Wedding', 'Round Tables with Floor Length Tablecloth and Toppings following your color motif'),
(18, 'Wedding Package', 'Wedding', 'Chairs with Floor-length Seat Covers and Ribbon Accents'),
(19, 'Wedding Package', 'Wedding', 'Complete Dining Set-up (use of complete sets of dinnerware, flatware and beverageware) '),
(20, 'Wedding Package', 'Wedding', 'Purified Drinking Water'),
(21, 'Wedding Package', 'Wedding', 'Ice for the Beverage and Water'),
(22, 'Wedding Package', 'Wedding', 'Ice for the Beverage and Water'),
(23, 'Wedding Package', 'Wedding', 'Free Food Tasting good for 2 Persons'),
(24, 'Wedding Package', 'Wedding', 'Use of Rostrum and Table Numbers (upon request)'),
(25, 'Debut Package', 'Debut', 'Free Flow Beverage (Choice of either Soft Drinks or Chilled Lemon Iced Tea)'),
(26, 'Debut Package', 'Debut', 'Service of Uniformed and Trained Waiters'),
(27, 'Debut Package', 'Debut', 'Elegant Buffet Set-up complete with Buffet Skirting and Centerpiece'),
(28, 'Debut Package', 'Debut', 'Round Tables with Floor Length Tablecloth and Toppings following your color motif'),
(29, 'Debut Package', 'Debut', 'Chairs with Floor-length Seat Covers and Ribbon Accents'),
(30, 'Debut Package', 'Debut', 'Simple Fresh Floral Arrangement or Art Balloon DÃ©cor for every Guest Table'),
(31, 'Debut Package', 'Debut', 'Simple Fresh Floral Arrangement or Art Balloon DÃ©cor for every Guest Table'),
(32, 'Debut Package', 'Debut', 'Complete Dining Set-up (use of complete sets of dinnerware, flatware and beverageware)'),
(33, 'Debut Package', 'Debut', 'Purified Drinking Water'),
(34, 'Debut Package', 'Debut', 'Ice for the Beverage and Water'),
(35, 'Debut Package', 'Debut', 'Free Food Tasting good for 2 Persons (upon schedule)'),
(36, 'Debut Package', 'Debut', 'Free Food Tasting good for 2 Persons (upon schedule)'),
(37, 'Cocktail Merrienda Package', 'Other Offered', 'Ideal for Kiddy Parties, Product Launching, Corporate Affairs or other events which prefer light but filling food choices.'),
(38, 'Budget Party Package', 'Other Offered', ' Recommended for Corporate Affairs or Parties with a big number of reservation with a particular working budget per head. Client may advise the Target Number of Reservation and specific budget to enable CVJ Food Catering form'),
(39, 'Seminar/Whole Day Affair Package', 'Other Offered', 'Includes AM and PM Snacks plus lunch complete with all the basic Party Package Amenities and Free-Flowing of Coffee / Tea.'),
(40, 'Packed Meals', 'Other Offered', ' A complete lunch or merrienda placed in styro packaging which comes complete with disposable tableware.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE IF NOT EXISTS `tbl_package` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `type` varchar(225) DEFAULT NULL,
  `pset` int(225) DEFAULT NULL,
  `mid` int(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`id`, `type`, `pset`, `mid`) VALUES
(1, 'cm1', 1, 6),
(2, 'cm3', 1, 2),
(3, 'cm3', 1, 7),
(4, 'cm3', 1, 10),
(5, 'cm2', 1, 6),
(6, 'cm2', 1, 10),
(7, 'cm4', 1, 1),
(8, 'cm4', 1, 5),
(9, 'cm4', 1, 8),
(10, 'cm4', 1, 9),
(11, 'cm1', 2, 7),
(12, 'cm2', 2, 7),
(13, 'cm2', 2, 9),
(14, 'cm1', 3, 8),
(15, 'cm4', 2, 1),
(16, 'cm4', 2, 5),
(17, 'cm4', 2, 7),
(18, 'cm4', 2, 9),
(19, 'cm1', 4, 7),
(20, 'cm1', 5, 11),
(21, 'cm1', 6, 12),
(22, 'cm4', 3, 13),
(23, 'cm4', 3, 5),
(24, 'cm4', 3, 14),
(25, 'cm4', 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phone`
--

CREATE TABLE IF NOT EXISTS `tbl_phone` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `name` varchar(22) DEFAULT NULL,
  `suf` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `tbl_phone`
--

INSERT INTO `tbl_phone` (`id`, `name`, `suf`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resdes`
--

CREATE TABLE IF NOT EXISTS `tbl_resdes` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `retns` varchar(225) DEFAULT NULL,
  `reuid` int(225) NOT NULL,
  `vdate` date DEFAULT NULL,
  `stime` time DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `barangay` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `province` varchar(225) DEFAULT NULL,
  `zip` varchar(225) DEFAULT NULL,
  `land` varchar(225) DEFAULT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'serving',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_resdes`
--

INSERT INTO `tbl_resdes` (`id`, `retns`, `reuid`, `vdate`, `stime`, `address`, `barangay`, `city`, `province`, `zip`, `land`, `status`) VALUES
(2, '9735423736', 4, '2015-03-30', '11:21:00', 'location', 'barangay', 'city', 'provice', '1800', 'McDo', 'serving'),
(3, '1581368743', 3, '2015-03-07', '01:30:00', 'marikina', 'sto nino', 'marikina city', 'metro manila', '1800', 'Blue wave', 'serving'),
(4, '0871349220', 7, '2015-03-30', '16:30:00', '2302 luzon ave sampaloc manila', '555 zone 55', 'manila', 'none', '1008', 'Galas police station', 'serving');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reser`
--

CREATE TABLE IF NOT EXISTS `tbl_reser` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `tnsid` varchar(225) DEFAULT NULL,
  `uid` int(225) NOT NULL,
  `fcode` varchar(225) DEFAULT NULL,
  `fcourse` varchar(225) DEFAULT NULL,
  `fname` varchar(225) DEFAULT NULL,
  `fwala` varchar(225) DEFAULT NULL,
  `fppserve` decimal(6,2) DEFAULT NULL,
  `pak` int(225) NOT NULL,
  `pdate` date NOT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'ufinal',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_reser`
--

INSERT INTO `tbl_reser` (`id`, `tnsid`, `uid`, `fcode`, `fcourse`, `fname`, `fwala`, `fppserve`, `pak`, `pdate`, `status`) VALUES
(1, '0995891683', 5, 'CS47ZQ5JUB', 'Main course', 'Herb-roasted Beef Tenderloin', 'Beef', '100.00', 100, '2016-9-20', 'ufinal'),
(2, '9735423736', 4, 'HUKSOH1VH0', 'Main course', 'Herb-roasted Beef Tenderloin', 'Beef', '100.00', 200, '2015-03-06', 'ufinal'),
(3, '9735423736', 4, 'HUKSOH1VH0', 'Dessert', 'Salty Chocolate Chunk Cookies', 'Cookies', '30.00', 200, '2015-03-06', 'ufinal'),
(4, '9735423736', 4, 'HUKSOH1VH0', 'Appetizer', 'Spinach and Artichoke Dip', 'Dips', '50.00', 200, '2015-03-06', 'ufinal'),
(5, '1581368743', 3, 'QD5380FWIB', 'Main course', 'sample 2', 'Chicken', '22.00', 150, '2015-03-06', 'ufinal'),
(6, '1581368743', 3, 'QD5380FWIB', 'Dessert', 'Sample 8', 'Cakes', '55.00', 150, '2015-03-06', 'ufinal'),
(7, '1581368743', 3, 'QD5380FWIB', 'Appetizer', 'sample 3', 'Dips', '55.00', 150, '2015-03-06', 'ufinal'),
(8, '0871349220', 7, '74IY743N5E', 'Appetizer', 'Spinach and Artichoke Dip', 'Dips', '53.00', 100, '2015-03-25', 'ufinal'),
(9, '0871349220', 7, 'XNCWZCGDN8', 'Entree', 'Beef Burgandy', 'Beef', '120.00', 100, '2015-03-25', 'ufinal'),
(10, '0871349220', 7, 'WALAACN9RZ', 'Main course', 'Pad Thai with Chicken and Shrimp', 'Chicken', '105.00', 100, '2015-03-25', 'ufinal'),
(11, '0871349220', 7, '17RB0Y9X9V', 'Dessert', 'Salty Chocolate Chunk Cookies', 'Cookies', '30.00', 100, '2015-03-25', 'ufinal'),
(12, '1836923009', 5, 'CS47ZQ5JUB', 'Main course', 'Herb-roasted Beef Tenderloin', 'Beef', '100.00', 22, '2015-03-28', 'ufinal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(225) NOT NULL AUTO_INCREMENT,
  `user` varchar(40) DEFAULT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `fname` varchar(40) DEFAULT NULL,
  `mname` varchar(40) DEFAULT NULL,
  `lname` varchar(40) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `number` varchar(22) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `provinceRegion` varchar(225) DEFAULT NULL,
  `zipCode` int(4) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `lastLogDate` date DEFAULT '0000-00-00',
  `lastEditDate` date DEFAULT '0000-00-00',
  `status` varchar(40) DEFAULT 'off',
  `type` varchar(40) NOT NULL DEFAULT 'Customer',
  `image` varchar(225) NOT NULL DEFAULT 'default.gif',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `user`, `pass`, `fname`, `mname`, `lname`, `gender`, `email`, `number`, `address`, `city`, `provinceRegion`, `zipCode`, `birthdate`, `dateAdded`, `lastLogDate`, `lastEditDate`, `status`, `type`, `image`) VALUES
(1, 'admin', '123456', 'King', 'a', 'Philippe', 'Male', 'kingphilippe0323131@gmail.com', '9353960623', NULL, NULL, NULL, NULL, '2015-02-11', '2015-02-11', '2015-08-28', '2015-02-22', 'off', 'Admin', 'admin.png'),
(2, 'admin1', 'admin1', 'admin', NULL, 'admin', 'Male', 'admin1@yahoo.com', '9061780313', NULL, NULL, NULL, NULL, '1993-11-25', '2015-02-11', '2015-03-03', '2015-02-11', 'off', 'Admin', 'default.gif'),
(3, 'customer1', 'customer', 'customer', NULL, 'customer', 'Male', 'kingphilippe032313@gmail.com', '9061780313', NULL, NULL, NULL, NULL, '1993-11-25', '2015-02-11', '2015-08-28', '2015-02-11', 'on', 'Customer', 'default.gif'),
(4, 'customer2', 'customer', 'customer', NULL, 'customer', 'Male', 'customer2@gmail.com', '9061780313', NULL, NULL, NULL, NULL, '1993-01-25', '2015-02-19', '2015-03-06', '2015-02-19', 'off', 'Customer', 'default.gif'),
(5, 'kings.23', '032313', 'King', NULL, 'Philippe', 'Male', 'king@yahoo.com', '9061780313', NULL, NULL, NULL, NULL, '1993-11-25', '2015-02-22', '2015-03-27', '2015-02-22', 'off', 'Customer', 'kings.23.jpg'),
(7, 'shensantos', 'together', 'shen', NULL, 'santos', 'Female', 'santosshannen@yahoo.com', '9069286854', NULL, NULL, NULL, NULL, '1995-09-06', '2015-03-25', '2015-03-25', '2015-03-25', 'off', 'Customer', 'default.gif'),
(8, 'darwinperez', '1234567', 'Darwin', NULL, 'perez', 'Male', 'darwino_16@yahoo.com', '9055918996', NULL, NULL, NULL, NULL, '1996-01-09', '2015-03-25', '2015-03-30', '2015-03-25', 'off', 'Customer', 'default.gif'),
(9, 'vernadethsavio', '123456789', 'Vernadeth', NULL, 'Savio', 'Female', 'savio_bernadeth9@yahoo.com', '9055918996', NULL, NULL, NULL, NULL, '1996-01-09', '2015-03-27', '0000-00-00', '2015-03-27', 'off', 'Customer', 'default.gif');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
