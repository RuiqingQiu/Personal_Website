-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2012 at 10:16 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

-- --------------------------------------------------------

--
-- Database: `db_cp`
--
CREATE DATABASE `ucsdcarpool` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ucsdcarpool`;
-- -----------------------------------------------
--
-- Table structure for table `cp_regular_places`
--
CREATE TABLE IF NOT EXISTS `cp_regular_places` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `place` varchar(20) NOT NULL,
  `time` date NOT NULL,
  `num_limit` int(11) NOT NULL,
  `num_current` int(11) NOT NULL DEFAULT '0',
  `initiator_id` int(11) NOT NULL DEFAULT ' ',
  `note` varchar(100) NOT NULL DEFAULT ' ',
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
--
-- Dumping data for table `cp_regular_places`
--
INSERT INTO `cp_regular_places` (`place`, `time`, `num_limit`, `num_current`, `note`, `password`) VALUES
('大华', '2012-11-22 00:00:00', 4, 1, '1刀1人', '123456'),
('price center', '2012-11-23 10:00:00', 4, 1, '1刀1人', '157'),
('la', '2012-11-22 00:00:00', 3, 0, '请客吃PIZZA', '7348');
-- -----------------------------------------------
--
-- Table structure for table `cp_special_places`
--
CREATE TABLE IF NOT EXISTS `cp_special_places` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `place` varchar(20) NOT NULL,
  `time` date NOT NULL,
  `num_limit` int(11) NOT NULL,
  `num_current` int(11) NOT NULL DEFAULT '0',
  `note` varchar(100) NOT NULL DEFAULT ' ',
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
--
-- Dumping data for table `cp_special_places`
--
INSERT INTO `cp_special_places` (`place`, `time`, `num_limit`, `num_current`, `note`, `password`) VALUES
('LA', '2012-11-23 00:00:00', 0, 0, '请客吃PIZZA', '0');
-- -----------------------------------------------
--
-- Table structure for table `cp_user`
--
CREATE TABLE IF NOT EXISTS `cp_user` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `zh_name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL,
	`drive_age` int(5) NOT NUll,
	`mobile` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
	`password` varchar(50) NOT NULL,
	`credit` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
--
-- Dumping data for table `cp_user`
--
INSERT INTO `cp_user` (`zh_name`, `gender`, `grade`, `type`, `drive_age`, `mobile`, `email`, `password`, `credit`) VALUES
('张三', '男', 'm', 1, 5 , 8589001234, 'abc123@ucsd.edu', '1234',10);
-- ----------------------------------------------
