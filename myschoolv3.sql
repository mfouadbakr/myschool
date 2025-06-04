-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2019 at 07:37 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myschoolv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `isactive` tinyint(1) DEFAULT '0',
  `country` varchar(50) NOT NULL DEFAULT 'Egypt',
  `referral` varchar(20) NOT NULL DEFAULT 'Other',
  `school_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `fname`, `lname`, `email`, `password`, `type`, `isactive`, `country`, `referral`, `school_id`, `user_id`) VALUES
(1, 'Mohamed', 'Bakr', 'royal@school.com', 'password', 'school', 0, 'Egypt', 'social media', 1, NULL),
(2, 'Yahia', 'Ashraf', 'manar@school.com', 'password', 'school', 0, 'Egypt', 'friend', 2, NULL),
(3, 'Ahmad', 'Adel', 'ma7ma7@gmail.com', 'password', 'user', 1, 'Egypt', 'friend', NULL, 1),
(4, 'Ahmed', 'Ali', 'bakr@gmail.com', 'password', 'user', 1, 'Egypt', 'social media', NULL, 2),
(11, 'Mohamed', 'Gad', 'mohamed-bakr@live.com', '1234', 'user', 1, 'Egypt', 'social media', NULL, 4),
(12, 'Mohamed', 'Hassan', 'pcgamedeveloper@gmail.com', '1234', 'school', 1, 'Egypt', 'students', 3, NULL),
(13, 'Mohamed', 'Bakr', 'admin@gmail.com', '1234', 'admin', 1, 'Egypt', 'Other', NULL, NULL),
(14, 'Hassan', 'Helal', 'school@gmail.com', '1234', 'school', 1, 'Egypt', 'social media', 4, NULL),
(15, 'Ahmad', 'Adel', 'ma7ma721@gmail.com', 'ma7ma7', 'user', 1, 'Egypt', 'social media', NULL, 5),
(16, 'yahia', 'ashraf', 'nile@school.com', '123', 'school', 1, 'Egypt', 'other', 5, NULL),
(17, 'Ashrkat', 'Youssef', 'ash@gmail.com', '1234', 'school', 1, 'Egypt', 'students', 6, NULL),
(18, 'Ahmed', 'Fouad', 'ahmed@gmail.com', '12345', 'school', 1, 'Egypt', 'other', 7, NULL),
(19, 'Gad', 'Ahmed', 'zero@gmail.com', '1234', 'school', 1, 'Egypt', 'students', 8, NULL),
(20, 'Mohamed', 'Bakr', 'mohamed@yahoo.com', '123', 'school', 1, 'Egypt', 'students', 9, NULL),
(21, 'Adel', 'Bakr', 'abakr@gmail.com', '1234', 'school', 1, 'Egypt', 'other', 10, NULL),
(22, 'Mohamed', 'Bakr', 'hshg', '1234', 'user', 1, 'Egypt', 'social media', NULL, 6),
(23, 'gasf', 'Bakr', 'gsd', '1234', 'user', 1, 'Egypt', 'social media', NULL, 7),
(24, 'Hassan', 'Bakr', 'gfasdf', '1234', 'user', 1, 'Egypt', 'social media', NULL, 8),
(25, 'Hassan', 'Bakr', 'erds@gmail.com', '1234', 'user', 1, 'Egypt', 'social media', NULL, 9),
(26, 'Mohamed', 'Ahmed', 'major@gmail.com', '1234', 'user', 1, 'Egypt', 'social media', NULL, 10),
(27, 'Mohamed', 'Ahmed', 'hello@gmail.com', '1234', 'user', 1, 'Egypt', 'social media', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `app_link` varchar(100) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `app_link`, `school_id`) VALUES
(1, 'link', 1),
(2, 'link2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int(11) NOT NULL,
  `interest_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `interest_name`) VALUES
(1, 'acting'),
(2, 'swimming'),
(3, 'football'),
(4, 'basketball'),
(5, 'arts'),
(6, 'Special_Needs'),
(7, 'gym');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level_name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `type_no` int(11) NOT NULL,
  `tutition_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `istest` tinyint(1) NOT NULL DEFAULT '0',
  `test_fee` decimal(10,0) NOT NULL DEFAULT '0',
  `age_from` int(11) NOT NULL DEFAULT '0',
  `score` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `age_to` int(11) DEFAULT NULL,
  `school_prog_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `level_name`, `type`, `type_no`, `tutition_fee`, `istest`, `test_fee`, `age_from`, `score`, `isactive`, `age_to`, `school_prog_id`, `school_id`) VALUES
(1, 'Primary 1', 'PRIMARY', 2, '5000.00', 0, '500', 8, '0.00', 1, NULL, 1, 1),
(2, 'Primary 2', 'PRIMARY', 2, '5000.00', 0, '500', 9, '0.00', 1, NULL, 1, 1),
(3, 'Primary 1', 'PRIMARY', 2, '7000.00', 0, '600', 8, '0.00', 1, NULL, 4, 2),
(4, 'Grade 1', 'GRADES ', 2, '15000.00', 0, '1000', 8, '0.00', 1, NULL, 3, 1),
(5, 'Prep 2', 'PREPARTORY', 3, '10000.00', 0, '700', 13, '0.00', 1, NULL, 2, 1),
(6, 'Primary 6', 'PRIMARY', 2, '10000.00', 0, '700', 13, '0.00', 1, NULL, 5, 2),
(7, 'Primary 3', 'PRIMARY', 2, '5000.00', 0, '500', 10, '0.00', 1, NULL, 1, 1),
(8, 'Primary 4', 'PRIMARY', 2, '5000.00', 0, '500', 10, '0.00', 1, NULL, 1, 1),
(9, 'Primary 5', 'PRIMARY', 2, '5000.00', 0, '500', 10, '0.00', 1, NULL, 1, 1),
(10, 'Primary 6', 'PRIMARY', 2, '5000.00', 0, '500', 10, '0.00', 1, NULL, 1, 1),
(11, 'Prep 1', 'PREPARTORY', 3, '5000.00', 0, '500', 11, '0.00', 1, NULL, 1, 1),
(12, 'Prep 2', 'PREPARTORY', 3, '5000.00', 0, '500', 12, '0.00', 1, NULL, 1, 1),
(13, 'Prep 3', 'PREPARTORY', 3, '5000.00', 0, '500', 13, '0.00', 1, NULL, 1, 1),
(14, '1st secondary', 'Secondary', 3, '5000.00', 0, '500', 14, '0.00', 1, NULL, 1, 1),
(15, 'Nursery last test', 'Preschool', 1, '123.00', 1, '123', 3, '34.00', 0, 4, 8, 6),
(16, 'again', 'Preschool', 1, '123.00', 0, '123', 2, '23.00', 1, 4, 8, 6),
(17, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(18, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(19, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(20, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(21, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(22, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(23, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(24, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(25, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(26, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(27, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(28, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(29, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(30, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 8, 6),
(31, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(32, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(33, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(34, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(35, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(36, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(37, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(38, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(39, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(40, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(41, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(42, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(43, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(44, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(45, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(46, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 9, 6),
(47, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(48, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(49, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(50, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(51, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(52, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(53, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(54, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(55, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(56, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(57, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(58, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(59, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(60, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(61, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(62, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 10, 6),
(63, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(64, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(65, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(66, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(67, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(68, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(69, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(70, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(71, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(72, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(73, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(74, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(75, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(76, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(77, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(78, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 11, 6),
(79, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(80, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(81, 'kg4', 'Kindergarten', 2, '342.00', 1, '432', 2, '34.00', 1, 6, 12, 6),
(82, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(83, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(84, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(85, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(86, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(87, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(88, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(89, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(90, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(91, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(92, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(93, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(94, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 12, 6),
(95, 'Nursery ', 'Preschool', 1, '1000.00', 1, '200', 3, '10.00', 1, 4, 13, 7),
(96, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(97, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(98, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(99, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(100, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(101, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(102, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(103, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(104, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(105, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(106, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(107, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(108, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(109, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(110, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 13, 7),
(111, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(112, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(113, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(114, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(115, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(116, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(117, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(118, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(119, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(120, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(121, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(122, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(123, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(124, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(125, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(126, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 14, 8),
(127, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(128, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(129, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(130, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(131, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(132, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(133, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(134, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(135, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(136, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(137, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(138, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(139, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(140, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(141, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(142, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 15, 9),
(143, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(144, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(145, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(146, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(147, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(148, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(149, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(150, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(151, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(152, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(153, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(154, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(155, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(156, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(157, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(158, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 16, 9),
(159, 'Nursery 1', 'Preschool', 1, '1500.00', 1, '100', 3, '5.00', 1, 5, 17, 10),
(160, 'Reception', 'Preschool', 1, '100.00', 1, '100', 1, '12.00', 0, 2, 17, 10),
(161, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(162, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(163, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(164, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(165, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(166, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(167, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(168, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(169, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(170, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(171, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(172, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(173, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(174, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 17, 10),
(175, 'Nursery', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(176, 'Reception', 'Preschool', 1, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(177, 'KG 1', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(178, 'KG 2', 'Kindergarten', 2, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(179, 'Primary 1', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(180, 'Primary 2', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(181, 'Primary 3', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(182, 'Primary 4', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(183, 'Primary 5', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(184, 'Primary 6', 'Primary', 3, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(185, 'Prepratory 1', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(186, 'Prepratory 2', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(187, 'Prepratory 3', 'Prepratory', 4, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(188, 'Secondary 1', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(189, 'Secondary 2', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6),
(190, 'Secondary 3', 'Secondary', 5, '0.00', 0, '0', 0, '0.00', 1, NULL, 18, 6);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `program_name`) VALUES
(1, 'International'),
(3, 'National'),
(4, 'experimental'),
(5, 'Special_Needs');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `app_code` int(11) DEFAULT NULL,
  `fname` varchar(20) NOT NULL,
  `mname1` varchar(20) NOT NULL,
  `mname2` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `birth_pplace` varchar(50) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `religion` varchar(10) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `home_phone` int(11) NOT NULL,
  `last_school` varchar(50) DEFAULT NULL,
  `prep_school` varchar(50) DEFAULT NULL,
  `prim_school` varchar(50) DEFAULT NULL,
  `father_job` varchar(20) NOT NULL,
  `mother_job` varchar(20) NOT NULL,
  `issue_date` date NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `isattended` tinyint(1) NOT NULL DEFAULT '0',
  `result` tinyint(1) DEFAULT NULL,
  `level_id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `app_code`, `fname`, `mname1`, `mname2`, `lname`, `gender`, `dob`, `birth_pplace`, `nationality`, `religion`, `address1`, `address2`, `home_phone`, `last_school`, `prep_school`, `prim_school`, `father_job`, `mother_job`, `issue_date`, `appointment_date`, `isattended`, `result`, `level_id`, `application_id`, `user_id`, `school_id`) VALUES
(6, NULL, 'Ma7ma7', 'Adel', 'Mohamed', 'Ayoub', 'Male', '1997-09-21', 'Cairo', 'Egyption', 'Muslim', 'home', NULL, 324849974, NULL, NULL, NULL, 'engineer', 'teatcher', '2019-04-14', NULL, 0, NULL, 1, 1, 1, 1),
(7, NULL, 'Yahia', 'Ashraf', 'Safwat', 'Ayoub', 'Male', '1997-09-21', 'Cairo', 'Egyption', 'Muslim', 'home', NULL, 324849974, NULL, NULL, NULL, 'doctor', 'teatcher', '2019-04-14', NULL, 0, NULL, 5, 2, 1, 1),
(8, NULL, 'Mohamed', 'Ahmed', 'Helmy', 'Ibrahim', 'Male', '1996-12-10', 'Cairo', 'Egyption', 'Muslim', 'home', NULL, 324849974, NULL, NULL, NULL, 'doctor', 'teatcher', '2019-04-14', '2019-04-29', 1, 1, 4, 2, 2, 1),
(9, NULL, 'ahmed', 'ali', 'abdelmawla', 'Ibrahim', 'Male', '1996-12-10', 'Giza', 'Egyption', 'Muslim', 'home', NULL, 324849974, NULL, NULL, NULL, 'doctor', 'teatcher', '2019-04-14', '2019-04-30', 0, 0, 3, 2, 2, 2),
(10, NULL, 'ahmed', 'Adel', 'Mohamed', 'a', 'Male', '1996-12-10', 'Giza', 'Egyption', 'Muslim', 'home', NULL, 324849974, NULL, NULL, NULL, 'doctor', 'teatcher', '2019-04-14', NULL, 1, NULL, 6, 2, 1, 2),
(11, NULL, 'Mohamed', 'Ahmed', 'Fouad', 'Bakr', 'Male', '1997-01-23', 'Meet oobaa', 'Egypt', 'Muslim', '66 st. abd menhm reyad', 'portsaid st 23', 2147483647, 'manor house school', 'manor house school', 'manor house school', 'hr', 'accountant', '0000-00-00', '2019-05-30', 1, 1, 47, NULL, 2, 6),
(12, NULL, 'Mohamed', 'Ahmed', 'Fouad', 'Bakr', 'Male', '1997-01-23', 'Meet oobaa', 'Egypt', 'Muslim', '66 st. abd menhm reyad', 'portsaid st 23', 2147483647, 'manor house school', 'manor house school', 'manor house school', 'hr', 'accountant', '2019-05-02', NULL, 0, 0, 47, NULL, 2, 6),
(13, NULL, '', '', '', '', 'Male', '0000-00-00', '', 'Egypt', 'Muslim', '', '', 0, '', '', '', '', '', '2019-05-02', '2019-05-16', 1, 0, 47, NULL, 2, 6),
(14, NULL, 'Mahmoud', 'Ahmed', 'Fouad', 'Bakr', 'Male', '2000-12-03', 'Agouza district - dimishk hospital', 'Egypt', 'Muslim', '6 Abd El menhem reyad', '', 233445567, 'Manor house school', 'Manor house school', 'Manor house school', 'Human resources', 'Accountant', '2019-05-03', NULL, 0, NULL, 95, NULL, 2, 7),
(15, NULL, 'Mahmoud', 'ahmed', 'fouad', 'helmy', 'Male', '2000-12-03', '', 'Egypt', 'Muslim', 'Abd elmnhem reyad', '', 2147483647, 'Manor house', 'Manor house', 'Manor house', 'Human resources', 'Accountant', '2019-05-10', NULL, 0, NULL, 110, NULL, 2, 7),
(16, NULL, '', '', '', '', 'Male', '0000-00-00', '', 'Egypt', 'Muslim', '', '', 0, '', '', '', '', '', '2019-05-25', NULL, 0, NULL, 101, NULL, 2, 7),
(17, NULL, 'Ashrakt', 'adel', 'neseem', 'bakr', 'Female', '1997-06-11', 'Unknown', 'Egypt', 'Christian', 'Agouza', 'Gouna', 234456406, 'None', 'None', 'None', 'Accountant', 'HR', '2019-05-26', '2019-05-28', 0, NULL, 159, NULL, 2, 10),
(18, NULL, '', '', '', '', 'Male', '0000-00-00', '', 'Egypt', 'Muslim', '', '', 0, '', '', '', '', '', '2019-05-26', '2019-05-27', 1, 1, 143, NULL, 2, 9),
(19, NULL, '', '', '', '', 'Male', '0000-00-00', '', 'Egypt', 'Muslim', '', '', 0, '', '', '', '', '', '2019-06-23', NULL, 0, NULL, 17, NULL, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `service_pakage` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `longitude` decimal(10,4) DEFAULT NULL,
  `latitude` decimal(10,4) DEFAULT NULL,
  `max_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bio` varchar(1000) NOT NULL DEFAULT 'Unavailable',
  `logo` varchar(100) NOT NULL DEFAULT 'logo.jpg',
  `pic1` varchar(100) NOT NULL DEFAULT 'pic1.jpg',
  `pic2` varchar(100) NOT NULL DEFAULT 'pic2.jpg',
  `pic3` varchar(100) NOT NULL DEFAULT 'pic3.jpg',
  `hits` int(11) NOT NULL DEFAULT '0',
  `applies` int(11) NOT NULL DEFAULT '0',
  `advising_status` tinyint(1) NOT NULL DEFAULT '0',
  `isaccepted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `service_pakage`, `address`, `city`, `area`, `longitude`, `latitude`, `max_fee`, `bio`, `logo`, `pic1`, `pic2`, `pic3`, `hits`, `applies`, `advising_status`, `isaccepted`) VALUES
(1, 'Royal international School', 'advising system', 'main street, 123', '6 October', 'Hosary', '1.3435', '2.3453', '1500.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 4, 0, 1, 1),
(2, 'Manar house', 'advising system', 'el haram, main street', '6 October', 'Hosary', '1.3435', '2.3453', '7000.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 2, 0, 0, 1),
(3, 'Manor House School', 'Full package', '6 october, safwa mall', '6 October', 'Hosary', '1.3435', '2.3453', '2000.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 0, 0, 0, 1),
(4, 'magic school', 'advising system', '6 october, mall of arabia', '6 October', 'Hosary', '1.3435', '2.3453', '0.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 0, 0, 0, 1),
(5, 'nile', 'Full package', 'aad', '6 October', 'Hosary', '1.3435', '2.3453', '12838.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 0, 0, 0, 1),
(6, 'Sunshine school', 'Full package', 'zaid, yasmine', '6 October', 'Hosary', '1.3435', '2.3453', '0.00', 'Welcome to sunshine by ashrakt kamel', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 7, 0, 1, 1),
(7, 'Food international school', 'Full package', '66 batal Ahmed street', '6 October', 'Hosary', '12.3456', '34.4524', '0.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 1, 0, 1, 1),
(8, 'Abbas language school', 'Full package', '6 october, safwa mall', '6 October', 'Hosary', '1.3435', '2.3453', '0.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 2, 0, 0, 1),
(9, 'mohamed banen', 'Advertising only', '6 october, safwa mall', '6 October', 'Hosary', '1.3535', '2.3253', '0.00', 'Unavailable', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 5, 3, 1, 1),
(10, 'Adel language school', 'Full package', 'Giza, 6 OCT industry 11', 'Giza', '6th of October - Industrial Section', '1.3435', '2.3453', '0.00', 'Hello welcome to adel bakr school', 'logo.jpg', 'pic1.jpg', 'pic2.jpg', 'pic3.jpg', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_contact`
--

CREATE TABLE `school_contact` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `mobile_phone` varchar(20) NOT NULL,
  `job_title` varchar(20) NOT NULL,
  `School_phone` varchar(20) NOT NULL,
  `School_website` varchar(100) DEFAULT NULL,
  `payment_method` varchar(20) NOT NULL,
  `card_no` int(12) NOT NULL,
  `issignup` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `school_contact`
--

INSERT INTO `school_contact` (`id`, `school_id`, `fname`, `lname`, `mobile_phone`, `job_title`, `School_phone`, `School_website`, `payment_method`, `card_no`, `issignup`) VALUES
(1, 1, 'hamada', 'mansour', '0114879877', 'It manager', '0238354369', 'www.royal.com', 'visa', 12562258, 1),
(2, 2, 'hussein', 'zaky', '0123457968', 'advisor', '0254895778', 'www.manar.com', 'visa', 999999999, 1),
(3, 3, 'Mohamed', 'Bakr', '01003004001', 'CEO', '', 'www.manorhouse.com', 'Visa', 1234567, 1),
(4, 4, 'Mohamed', 'Hussain', '01005007001', 'IT manager', '', 'www.magicschool.com', 'Visa', 123456, 1),
(5, 5, 'yahia', 'ashraf', '0221', 'eng', '', 'asfs', 'Visa', 123, 1),
(6, 6, 'Ashrkat', 'Kamel', '01002003004', 'Tea Manager', '', 'www.sunshine.com', 'Visa', 1234466, 1),
(7, 7, 'Ahmed', 'Fouad', '01003004005', 'Accountant', '', 'www.foodschool.com', 'Visa', 123456, 1),
(8, 8, 'Mohamed', 'Ahmed', '02003004005', 'CEO', '', 'www.zero.com', 'Visa', 123455, 1),
(9, 9, 'Mohamed', 'Hussain', '01003004001', 'CEO', '', 'mohamed banen', 'Visa', 1, 1),
(10, 10, 'Adel', 'Bakr', '01003304530', 'Doctor', '', 'www.zero.com', 'Visa', 123456, 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_interest`
--

CREATE TABLE `school_interest` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `school_interest`
--

INSERT INTO `school_interest` (`id`, `school_id`, `interest_id`) VALUES
(1, 1, 1),
(2, 1, 5),
(3, 1, 7),
(4, 1, 4),
(5, 2, 4),
(6, 2, 2),
(7, 2, 3),
(8, 2, 7),
(9, 2, 5),
(10, 3, 5),
(11, 6, 3),
(12, 6, 1),
(13, 6, 5),
(14, 7, 7),
(15, 6, 2),
(16, 8, 1),
(17, 8, 4),
(18, 9, 3),
(19, 9, 1),
(20, 10, 4),
(21, 6, 6),
(22, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `school_program`
--

CREATE TABLE `school_program` (
  `id` int(11) NOT NULL,
  `school_ID` int(11) NOT NULL,
  `prog_ID` int(11) NOT NULL,
  `first_lang` varchar(50) NOT NULL,
  `second_langs` varchar(50) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_program`
--

INSERT INTO `school_program` (`id`, `school_ID`, `prog_ID`, `first_lang`, `second_langs`, `isactive`) VALUES
(1, 1, 3, 'English', 'ANY', 1),
(2, 1, 3, 'French', 'ANY', 1),
(3, 1, 1, 'American', 'ANY', 1),
(4, 2, 3, 'English', 'ANY', 1),
(5, 2, 1, 'British', 'ANY', 1),
(7, 3, 4, 'english', 'ANY', 1),
(8, 6, 1, 'English', '', 0),
(9, 6, 1, 'French', '', 0),
(10, 6, 3, 'Arabic', '', 0),
(11, 6, 4, 'Arabic', '', 0),
(12, 6, 1, 'Spanish', '', 0),
(13, 7, 1, 'English', '', 0),
(14, 8, 4, 'English', '', 0),
(15, 9, 3, 'Arabic', '', 0),
(16, 9, 4, 'French', '', 0),
(17, 10, 4, 'Spanish', '', 0),
(18, 6, 5, 'English', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `trans_name` varchar(50) NOT NULL,
  `trans_type` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `trans_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `school_id`, `trans_name`, `trans_type`, `amount`, `trans_datetime`) VALUES
(1, 3, 'First-time activation', 'School Year', '2000.00', '2019-04-28 23:38:19'),
(2, 4, 'First-time activation', 'School Year', '2000.00', '2019-04-28 23:45:04'),
(3, 5, 'First-time activation', 'School Year', '2000.00', '2019-04-30 01:31:31'),
(4, 6, 'First-time activation', 'School Year', '2000.00', '2019-04-30 01:42:17'),
(5, 7, 'First-time activation', 'School Year', '2000.00', '2019-05-03 03:48:27'),
(6, 8, 'First-time activation', 'School Year', '2000.00', '2019-05-24 18:29:45'),
(7, 9, 'First-time activation', 'School Year', '2000.00', '2019-05-25 17:15:44'),
(8, 10, 'First-time activation', 'School Year', '2000.00', '2019-05-26 02:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`) VALUES
(1),
(2),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_prog_id` (`school_prog_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `application_id` (`application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_contact`
--
ALTER TABLE `school_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `school_interest`
--
ALTER TABLE `school_interest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `interest_id` (`interest_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `school_program`
--
ALTER TABLE `school_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prog_ID` (`prog_ID`),
  ADD KEY `school_ID` (`school_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_contact`
--
ALTER TABLE `school_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_interest`
--
ALTER TABLE `school_interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `school_program`
--
ALTER TABLE `school_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `level_ibfk_1` FOREIGN KEY (`school_prog_id`) REFERENCES `school_program` (`id`),
  ADD CONSTRAINT `level_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`),
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `request_ibfk_4` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `school_contact`
--
ALTER TABLE `school_contact`
  ADD CONSTRAINT `school_contact_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `school_interest`
--
ALTER TABLE `school_interest`
  ADD CONSTRAINT `school_interest_ibfk_1` FOREIGN KEY (`interest_id`) REFERENCES `interest` (`id`),
  ADD CONSTRAINT `school_interest_ibfk_2` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `school_program`
--
ALTER TABLE `school_program`
  ADD CONSTRAINT `school_program_ibfk_1` FOREIGN KEY (`prog_ID`) REFERENCES `program` (`id`),
  ADD CONSTRAINT `school_program_ibfk_2` FOREIGN KEY (`school_ID`) REFERENCES `school` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
