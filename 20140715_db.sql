-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2014 at 07:49 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e-jewel`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CAT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CAT_NAME` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`CAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CAT_ID`, `CAT_NAME`) VALUES
(1, 'Plain Gold'),
(2, 'Cat-2'),
(3, 'Cat-3');

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `COMP_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `COMP_NAME` varchar(30) DEFAULT NULL,
  `COMP_CODE` varchar(15) NOT NULL,
  PRIMARY KEY (`COMP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`COMP_ID`, `COMP_NAME`, `COMP_CODE`) VALUES
(1, 'Metal', 'metal'),
(2, 'Diamond', 'diamond'),
(3, 'Colored Stone', 'colored_stone'),
(4, 'Labour', 'labor');

-- --------------------------------------------------------

--
-- Table structure for table `component_type`
--

CREATE TABLE IF NOT EXISTS `component_type` (
  `COMP_TYPE_ID` int(5) NOT NULL AUTO_INCREMENT,
  `COMP_TYPE_NAME` varchar(20) NOT NULL,
  `COMP_ID` int(5) NOT NULL,
  PRIMARY KEY (`COMP_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `component_type`
--

INSERT INTO `component_type` (`COMP_TYPE_ID`, `COMP_TYPE_NAME`, `COMP_ID`) VALUES
(1, 'Gold', 1),
(2, 'Silver', 1),
(3, 'Platinum', 1),
(5, 'Precious', 3),
(6, 'Semi Precious', 3),
(7, 'Palladium', 1),
(8, 'Natural', 2),
(9, 'Manmade', 2),
(10, 'Moissanite', 2),
(11, 'Imititation', 3);

-- --------------------------------------------------------

--
-- Table structure for table `c_stone_category`
--

CREATE TABLE IF NOT EXISTS `c_stone_category` (
  `C_STONE_CAT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `C_STONE_CAT_NAME` varchar(30) DEFAULT NULL,
  `COMP_TYPE_ID` int(5) NOT NULL,
  PRIMARY KEY (`C_STONE_CAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `c_stone_category`
--

INSERT INTO `c_stone_category` (`C_STONE_CAT_ID`, `C_STONE_CAT_NAME`, `COMP_TYPE_ID`) VALUES
(1, 'Emerald', 5),
(2, 'Ruby', 5),
(3, 'Sapphire', 5),
(4, 'Citrine', 6),
(5, 'Aquamarine', 6),
(6, 'Turmalin', 6);

-- --------------------------------------------------------

--
-- Table structure for table `c_stone_color`
--

CREATE TABLE IF NOT EXISTS `c_stone_color` (
  `C_STONE_COL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `C_STONE_COL_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`C_STONE_COL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `c_stone_color`
--

INSERT INTO `c_stone_color` (`C_STONE_COL_ID`, `C_STONE_COL_NAME`) VALUES
(1, 'Red'),
(2, 'Green'),
(3, 'Blue');

-- --------------------------------------------------------

--
-- Table structure for table `c_stone_cut`
--

CREATE TABLE IF NOT EXISTS `c_stone_cut` (
  `CUT_ID` int(5) NOT NULL AUTO_INCREMENT,
  `CUT_NAME` varchar(20) NOT NULL,
  PRIMARY KEY (`CUT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `c_stone_cut`
--

INSERT INTO `c_stone_cut` (`CUT_ID`, `CUT_NAME`) VALUES
(1, 'Cabochon'),
(2, 'Standard');

-- --------------------------------------------------------

--
-- Table structure for table `jw_prod_colored_stone`
--

CREATE TABLE IF NOT EXISTS `jw_prod_colored_stone` (
  `JW_P_COL_S_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JW_PROD_ID` int(10) unsigned NOT NULL,
  `P_COL_S_ID` int(10) unsigned NOT NULL,
  `JW_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`JW_P_COL_S_ID`),
  KEY `JW_PROD_COLORED_STONE_FKIndex1` (`P_COL_S_ID`),
  KEY `JW_PROD_COLORED_STONE_FKIndex2` (`JW_PROD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jw_prod_diamond`
--

CREATE TABLE IF NOT EXISTS `jw_prod_diamond` (
  `JW_P_STONE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JW_PROD_ID` int(10) unsigned NOT NULL,
  `P_STONE_ID` int(10) unsigned NOT NULL,
  `JW_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`JW_P_STONE_ID`),
  KEY `JW_PROD_STONE_FKIndex1` (`P_STONE_ID`),
  KEY `JW_PROD_STONE_FKIndex2` (`JW_PROD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jw_prod_labor`
--

CREATE TABLE IF NOT EXISTS `jw_prod_labor` (
  `JW_P_LABOR_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JW_PROD_ID` int(10) unsigned NOT NULL,
  `P_LABOR_ID` int(10) unsigned NOT NULL,
  `JW_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`JW_P_LABOR_ID`),
  KEY `JW_PROD_LABOR_FKIndex1` (`P_LABOR_ID`),
  KEY `JW_PROD_LABOR_FKIndex2` (`JW_PROD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jw_prod_metal`
--

CREATE TABLE IF NOT EXISTS `jw_prod_metal` (
  `JW_P_METAL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JW_PROD_ID` int(10) unsigned NOT NULL,
  `P_METAL_ID` int(10) unsigned NOT NULL,
  `JW_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`JW_P_METAL_ID`),
  KEY `JW_PROD_METAL_FKIndex1` (`P_METAL_ID`),
  KEY `JW_PROD_METAL_FKIndex2` (`JW_PROD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jw_prod_summary`
--

CREATE TABLE IF NOT EXISTS `jw_prod_summary` (
  `JW_PROD_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MF_USER_ID` int(10) unsigned NOT NULL,
  `PROD_ID` int(10) unsigned NOT NULL,
  `JW_USER_ID` int(10) unsigned DEFAULT NULL,
  `JW_TOTAL_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`JW_PROD_ID`),
  KEY `JW_PROD_SUMMARY_FKIndex1` (`PROD_ID`),
  KEY `JW_PROD_SUMMARY_FKIndex2` (`MF_USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_colored_stone`
--

CREATE TABLE IF NOT EXISTS `mf_prod_colored_stone` (
  `P_COL_S_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `C_STONE_COL_ID` int(10) unsigned NOT NULL,
  `C_STONE_CAT_ID` int(10) unsigned NOT NULL,
  `P_COMP_ID` int(10) unsigned NOT NULL,
  `COMP_TYPE_ID` int(5) DEFAULT NULL,
  `PROD_ID` int(10) unsigned NOT NULL,
  `SHAPE_ID` int(5) NOT NULL,
  `CUT_ID` int(5) NOT NULL,
  `SIZE_FROM` varchar(10) NOT NULL,
  `SIZE_TO` varchar(10) NOT NULL,
  `PLAC_ID` int(5) NOT NULL,
  `SET_ID` int(5) NOT NULL,
  `TOTAL_STONES` int(10) unsigned DEFAULT NULL,
  `GROSS_WEIGHT` varchar(10) DEFAULT NULL,
  `BASE_RATE` varchar(15) DEFAULT NULL,
  `MF_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`P_COL_S_ID`),
  KEY `MF_PROD_COLORED_STONE_FKIndex1` (`PROD_ID`),
  KEY `MF_PROD_COLORED_STONE_FKIndex2` (`P_COMP_ID`),
  KEY `MF_PROD_COLORED_STONE_FKIndex3` (`C_STONE_CAT_ID`),
  KEY `MF_PROD_COLORED_STONE_FKIndex4` (`C_STONE_COL_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mf_prod_colored_stone`
--

INSERT INTO `mf_prod_colored_stone` (`P_COL_S_ID`, `C_STONE_COL_ID`, `C_STONE_CAT_ID`, `P_COMP_ID`, `COMP_TYPE_ID`, `PROD_ID`, `SHAPE_ID`, `CUT_ID`, `SIZE_FROM`, `SIZE_TO`, `PLAC_ID`, `SET_ID`, `TOTAL_STONES`, `GROSS_WEIGHT`, `BASE_RATE`, `MF_PRICE`) VALUES
(1, 2, 2, 265, 5, 84, 1, 2, '10', '12', 1, 0, 2, '10', '0', '0'),
(2, 1, 3, 269, 5, 85, 1, 1, '10', '20', 1, 2, 2, '30', '0', '0'),
(3, 2, 5, 274, 6, 86, 2, 2, '10', '12', 2, 2, 2, '20', '0', '0'),
(4, 2, 5, 279, 6, 87, 2, 2, '10', '12', 1, 3, 2, '10', '0', '0'),
(5, 2, 1, 288, 5, 91, 1, 1, '12', '22', 1, 2, 2, '12', '200', '2400.00'),
(6, 3, 5, 297, 6, 96, 2, 1, '11', '20', 2, 2, 2, '10', '0', '0'),
(7, 1, 2, 304, 5, 98, 1, 2, '10', '12', 1, 2, 2, '20', '100', '2000.00'),
(8, 1, 1, 308, 5, 99, 2, 1, '10', '10', 1, 2, 2, '100', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_component`
--

CREATE TABLE IF NOT EXISTS `mf_prod_component` (
  `P_COMP_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `COMP_ID` int(10) unsigned NOT NULL,
  `PROD_ID` int(10) unsigned NOT NULL,
  `COMP_TYPE_ID` int(5) DEFAULT NULL,
  `COMP_TABLE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`P_COMP_ID`),
  KEY `MF_PROD_COMPONENT_FKIndex1` (`PROD_ID`),
  KEY `MF_PROD_COMPONENT_FKIndex2` (`COMP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=310 ;

--
-- Dumping data for table `mf_prod_component`
--

INSERT INTO `mf_prod_component` (`P_COMP_ID`, `COMP_ID`, `PROD_ID`, `COMP_TYPE_ID`, `COMP_TABLE`) VALUES
(235, 1, 72, 1, 'metal'),
(236, 4, 72, 0, 'labor'),
(237, 1, 73, 1, 'metal'),
(238, 4, 73, 0, 'labor'),
(239, 1, 74, 1, 'metal'),
(240, 4, 74, 0, 'labor'),
(243, 1, 75, 1, 'metal'),
(244, 4, 75, 0, 'labor'),
(255, 1, 76, 1, 'metal'),
(256, 4, 76, 0, 'labor'),
(257, 1, 78, 1, 'metal'),
(258, 1, 79, 1, 'metal'),
(259, 1, 80, 1, 'metal'),
(260, 1, 81, 1, 'metal'),
(261, 1, 82, 2, 'metal'),
(262, 1, 83, 2, 'metal'),
(263, 1, 84, 1, 'metal'),
(264, 2, 84, 0, 'diamond'),
(265, 3, 84, 5, 'colored_stone'),
(266, 1, 85, 3, 'metal'),
(267, 1, 85, 2, 'metal'),
(268, 2, 85, 0, 'diamond'),
(269, 3, 85, 5, 'colored_stone'),
(270, 4, 85, 0, 'labor'),
(271, 1, 86, 1, 'metal'),
(272, 1, 86, 2, 'metal'),
(273, 2, 86, 0, 'diamond'),
(274, 3, 86, 6, 'colored_stone'),
(275, 4, 86, 0, 'labor'),
(276, 1, 87, 1, 'metal'),
(277, 1, 87, 2, 'metal'),
(278, 2, 87, 0, 'diamond'),
(279, 3, 87, 6, 'colored_stone'),
(280, 1, 88, 1, 'metal'),
(281, 1, 88, 2, 'metal'),
(282, 1, 89, 1, 'metal'),
(283, 1, 90, 1, 'metal'),
(284, 1, 90, 2, 'metal'),
(285, 1, 91, 1, 'metal'),
(286, 1, 91, 2, 'metal'),
(287, 2, 91, 0, 'diamond'),
(288, 3, 91, 5, 'colored_stone'),
(289, 4, 91, 0, 'labor'),
(290, 1, 92, 1, 'metal'),
(291, 1, 93, 3, 'metal'),
(292, 1, 94, 2, 'metal'),
(293, 1, 95, 2, 'metal'),
(294, 1, 96, 1, 'metal'),
(295, 1, 96, 2, 'metal'),
(296, 2, 96, 0, 'diamond'),
(297, 3, 96, 6, 'colored_stone'),
(298, 4, 96, 0, 'labor'),
(299, 1, 97, 1, 'metal'),
(300, 1, 97, 2, 'metal'),
(301, 1, 98, 1, 'metal'),
(302, 1, 98, 2, 'metal'),
(303, 2, 98, 0, 'diamond'),
(304, 3, 98, 5, 'colored_stone'),
(305, 1, 99, 1, 'metal'),
(306, 1, 99, 2, 'metal'),
(307, 2, 99, 0, 'diamond'),
(308, 3, 99, 5, 'colored_stone'),
(309, 4, 99, 0, 'labor');

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_diamond`
--

CREATE TABLE IF NOT EXISTS `mf_prod_diamond` (
  `P_STONE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `P_COMP_ID` int(10) unsigned NOT NULL,
  `CUT_ID` int(10) unsigned NOT NULL,
  `PROD_ID` int(10) unsigned NOT NULL,
  `COMP_TYPE_ID` int(5) NOT NULL,
  `TOTAL_STONES` int(10) unsigned DEFAULT NULL,
  `COLOR_FROM_ID` int(10) unsigned DEFAULT NULL,
  `COLOR_TO_ID` int(10) unsigned DEFAULT NULL,
  `CLARITY_FROM_ID` int(10) unsigned DEFAULT NULL,
  `CLARITY_TO_ID` int(10) unsigned DEFAULT NULL,
  `SHAPE_ID` int(10) unsigned DEFAULT NULL,
  `SIZE_ID` int(5) DEFAULT NULL,
  `SIZE_FROM` varchar(10) DEFAULT NULL,
  `SIZE_TO` varchar(10) DEFAULT NULL,
  `FLU_ID` int(5) DEFAULT NULL,
  `PLAC_ID` int(5) DEFAULT NULL,
  `SET_ID` int(5) NOT NULL,
  `GROSS_WEIGHT` varchar(10) NOT NULL,
  `BASE_RATE` varchar(15) DEFAULT NULL,
  `MF_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`P_STONE_ID`),
  KEY `MF_PROD_STONE_FKIndex1` (`PROD_ID`),
  KEY `MF_PROD_STONE_FKIndex2` (`CUT_ID`),
  KEY `MF_PROD_STONE_FKIndex3` (`CLARITY_FROM_ID`),
  KEY `MF_PROD_STONE_FKIndex4` (`CLARITY_TO_ID`),
  KEY `MF_PROD_STONE_FKIndex5` (`COLOR_FROM_ID`),
  KEY `MF_PROD_STONE_FKIndex6` (`COLOR_TO_ID`),
  KEY `MF_PROD_STONE_FKIndex7` (`P_COMP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mf_prod_diamond`
--

INSERT INTO `mf_prod_diamond` (`P_STONE_ID`, `P_COMP_ID`, `CUT_ID`, `PROD_ID`, `COMP_TYPE_ID`, `TOTAL_STONES`, `COLOR_FROM_ID`, `COLOR_TO_ID`, `CLARITY_FROM_ID`, `CLARITY_TO_ID`, `SHAPE_ID`, `SIZE_ID`, `SIZE_FROM`, `SIZE_TO`, `FLU_ID`, `PLAC_ID`, `SET_ID`, `GROSS_WEIGHT`, `BASE_RATE`, `MF_PRICE`) VALUES
(1, 264, 1, 84, 8, 1, 2, 2, 1, 2, 1, 1, '2', '2', 1, 1, 1, '20', '0', '0'),
(2, 268, 2, 85, 8, 2, 1, 3, 1, 2, 1, NULL, '23', '25', 2, 1, 1, '10', '0', '0'),
(3, 273, 1, 86, 8, 2, 2, 3, 2, 1, 1, NULL, '10', '12', 2, 1, 1, '12', '0', '0'),
(4, 278, 1, 87, 10, 2, 1, 4, 2, 1, 2, NULL, NULL, '12', 1, 1, 1, '10', '0', '0'),
(5, 287, 1, 91, 8, 2, 2, 4, 1, 2, 2, NULL, NULL, '12', 1, 2, 1, '12', '200', '2400.00'),
(6, 296, 1, 96, 8, 2, 2, 3, 2, 1, 1, NULL, '10', '12', 1, 1, 1, '11', '0', '0'),
(7, 303, 1, 98, 8, 2, 1, 3, 2, 2, 1, NULL, '1', '2', 2, 1, 1, '20', '100', '2000.00'),
(8, 307, 1, 99, 8, 2, 1, 3, 1, 2, 1, NULL, '1', '2', 1, 1, 1, '10', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_labor`
--

CREATE TABLE IF NOT EXISTS `mf_prod_labor` (
  `P_LABOR_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `P_COMP_ID` int(10) unsigned NOT NULL,
  `PROD_ID` int(10) unsigned NOT NULL,
  `PRICE_TYPE` int(11) DEFAULT NULL,
  `BASE_RATE` varchar(15) DEFAULT NULL,
  `MF_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`P_LABOR_ID`),
  KEY `MF_PROD_LABOR_FKIndex1` (`PROD_ID`),
  KEY `MF_PROD_LABOR_FKIndex2` (`P_COMP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `mf_prod_labor`
--

INSERT INTO `mf_prod_labor` (`P_LABOR_ID`, `P_COMP_ID`, `PROD_ID`, `PRICE_TYPE`, `BASE_RATE`, `MF_PRICE`) VALUES
(39, 236, 72, 1, '534', '18156.00'),
(40, 238, 73, 2, '34', '1156.00'),
(41, 240, 74, 1, '43', '1462.00'),
(43, 244, 75, 1, '434', '18662.00'),
(49, 256, 76, 1, '4343', '147662.00'),
(50, 270, 85, 0, '0', '0'),
(51, 275, 86, 0, '0', '0'),
(52, 289, 91, 1, '500', '15000.00'),
(53, 298, 96, 0, '0', '0'),
(54, 309, 99, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_metal`
--

CREATE TABLE IF NOT EXISTS `mf_prod_metal` (
  `P_METAL_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PROD_ID` int(10) unsigned NOT NULL,
  `P_COMP_ID` int(10) unsigned NOT NULL,
  `COMP_TYPE_ID` int(5) NOT NULL,
  `GROSS_WEIGHT` varchar(20) DEFAULT NULL,
  `TYPE` int(2) DEFAULT NULL,
  `VALUE` varchar(20) NOT NULL,
  `BASE_RATE` varchar(15) DEFAULT NULL,
  `IS_PRIM` tinyint(1) NOT NULL,
  `MF_PRICE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`P_METAL_ID`),
  KEY `MF_PROD_METAL_FKIndex1` (`P_COMP_ID`),
  KEY `MF_PROD_METAL_FKIndex2` (`PROD_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=167 ;

--
-- Dumping data for table `mf_prod_metal`
--

INSERT INTO `mf_prod_metal` (`P_METAL_ID`, `PROD_ID`, `P_COMP_ID`, `COMP_TYPE_ID`, `GROSS_WEIGHT`, `TYPE`, `VALUE`, `BASE_RATE`, `IS_PRIM`, `MF_PRICE`) VALUES
(129, 72, 235, 1, '34', 43, '', '34', 0, '1156.00'),
(130, 73, 237, 1, '34', 434, '', '343', 1, '11662.00'),
(131, 74, 239, 1, '34', 34, '', '34', 1, '1156.00'),
(133, 75, 243, 1, '43', 434, '', '34', 1, '1462.00'),
(139, 76, 255, 1, '34', 34, '', '34', 1, '1156.00'),
(140, 83, 262, 2, '10', 2, '18k', '0', 1, '0'),
(141, 84, 263, 1, '20', 1, '18k', '0', 1, '0'),
(142, 85, 266, 3, '22', 3, '21k', '0', 1, '0'),
(143, 85, 267, 2, '22', 2, '', '0', 0, '0'),
(144, 86, 271, 1, '10', 1, '18k', '0', 1, '0'),
(145, 86, 272, 2, '23', 2, '', '0', 0, '0'),
(146, 87, 276, 1, '22', 1, '18k', '0', 1, '0'),
(147, 87, 277, 2, '20', 2, '', '0', 0, '0'),
(148, 88, 280, 1, '10', 1, '21k', '0', 1, '0'),
(149, 88, 281, 2, '22', 2, '', '0', 0, '0'),
(150, 89, 282, 1, '11', 1, '', '0', 1, '0'),
(151, 90, 283, 1, '20', 1, '', '0', 1, '0'),
(152, 90, 284, 2, '20', 2, '18k', '0', 0, '0'),
(153, 91, 285, 1, '10', 1, '18k', '1000', 1, '5200.00'),
(154, 91, 286, 2, '20', 2, '', '100', 0, '2000.00'),
(155, 92, 290, 1, '12', 1, '', '0', 1, '0'),
(156, 93, 291, 3, '20', 1, '18k', '0', 1, '0'),
(157, 94, 292, 2, '10', 2, '', '0', 1, '0'),
(158, 95, 293, 2, '22', 2, '0.75', '0', 0, '0'),
(159, 96, 294, 1, '10', 1, '', '0', 1, '0'),
(160, 96, 295, 2, '20', 2, '0.916', '0', 0, '0'),
(161, 97, 299, 1, '10', 1, '18k', '0', 1, '0'),
(162, 97, 300, 2, '20', 2, '', '0', 0, '0'),
(163, 98, 301, 1, '20', 1, '18k', '1000', 1, '12000.00'),
(164, 98, 302, 2, '20', 0, '21k', '200', 0, '4000.00'),
(165, 99, 305, 1, '10', 1, '18k', '0', 1, '0'),
(166, 99, 306, 2, '20', 2, '0.75', '0', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_other_charges`
--

CREATE TABLE IF NOT EXISTS `mf_prod_other_charges` (
  `P_OTH_ID` int(5) NOT NULL AUTO_INCREMENT,
  `PROD_ID` int(5) NOT NULL,
  `VAT_PRICE` varchar(10) DEFAULT NULL,
  `SHIP_CHARGES` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`P_OTH_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `mf_prod_other_charges`
--

INSERT INTO `mf_prod_other_charges` (`P_OTH_ID`, `PROD_ID`, `VAT_PRICE`, `SHIP_CHARGES`) VALUES
(22, 72, '212.43', '100'),
(23, 73, '141.00', '343'),
(24, 74, '28.80', '343'),
(26, 75, '221.36', '4343'),
(32, 76, '1637.00', '343'),
(33, 91, '297.00', '500'),
(34, 98, '220.00', '500');

-- --------------------------------------------------------

--
-- Table structure for table `mf_prod_summary`
--

CREATE TABLE IF NOT EXISTS `mf_prod_summary` (
  `PROD_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CAT_ID` int(10) unsigned NOT NULL,
  `MF_USER_ID` int(10) unsigned NOT NULL,
  `PROD_NAME` varchar(50) DEFAULT NULL,
  `PROD_SHORT_DESC` text,
  `PROD_DESC` longtext,
  `MF_TOTAL_PRICE` varchar(15) DEFAULT NULL,
  `DISCOUNT` varchar(10) DEFAULT NULL,
  `MF_FINAL_PRICE` varchar(20) NOT NULL,
  `MF_PRICE_APP_PEND` tinyint(1) NOT NULL DEFAULT '0',
  `PROD_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `PRICE_TYPE_ID` int(10) unsigned DEFAULT NULL,
  `PROD_DEF_THUMB` varchar(100) DEFAULT NULL,
  `PROD_THUMBS` text,
  `PROD_IMAGES` text,
  `PROD_TAGS` varchar(150) DEFAULT NULL,
  `CERTIFICATE` varchar(30) DEFAULT NULL,
  `HALLMARK` tinyint(1) DEFAULT NULL,
  `STOCK` varchar(30) DEFAULT NULL,
  `PROD_SIZE` varchar(25) DEFAULT NULL,
  `DAYS_30_RET` tinyint(1) DEFAULT NULL,
  `REF_100_PER` tinyint(1) DEFAULT NULL,
  `FREE_SHIP` tinyint(1) DEFAULT NULL,
  `LIFE_TIME_RET` tinyint(1) DEFAULT NULL,
  `FREE_RET` tinyint(1) DEFAULT NULL,
  `PAYMENT` tinyint(1) DEFAULT NULL,
  `DATE_CREATED` date NOT NULL,
  `DATE_UPDATED` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `PROD_STATUS` tinyint(1) NOT NULL,
  PRIMARY KEY (`PROD_ID`),
  KEY `MF_PROD_SUMMARY_FKIndex1` (`MF_USER_ID`),
  KEY `MF_PROD_SUMMARY_FKIndex2` (`CAT_ID`),
  KEY `MF_PROD_SUMMARY_FKIndex3` (`PRICE_TYPE_ID`),
  KEY `MF_PROD_SUMMARY_FKIndex4` (`PROD_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `mf_prod_summary`
--

INSERT INTO `mf_prod_summary` (`PROD_ID`, `CAT_ID`, `MF_USER_ID`, `PROD_NAME`, `PROD_SHORT_DESC`, `PROD_DESC`, `MF_TOTAL_PRICE`, `DISCOUNT`, `MF_FINAL_PRICE`, `MF_PRICE_APP_PEND`, `PROD_TYPE_ID`, `PRICE_TYPE_ID`, `PROD_DEF_THUMB`, `PROD_THUMBS`, `PROD_IMAGES`, `PROD_TAGS`, `CERTIFICATE`, `HALLMARK`, `STOCK`, `PROD_SIZE`, `DAYS_30_RET`, `REF_100_PER`, `FREE_SHIP`, `LIFE_TIME_RET`, `FREE_RET`, `PAYMENT`, `DATE_CREATED`, `DATE_UPDATED`, `PROD_STATUS`) VALUES
(72, 1, 29, 'dsfaf', 'fasd', 'fasd', '19624.43', '', '', 0, 1, 3, 'thumb_20140709101556.jpg', 'thumb_20140709101556.jpg;thumb_20140709101556.jpg;thumb_20140709101559.jpg', '20140709101556.jpg;20140709101556.jpg;20140709101559.jpg', 'asdf', 'igi', 0, 'Ready', '22 x 12', 0, 1, 0, 0, 0, 1, '2014-07-09', '2014-07-09 08:16:02', 0),
(73, 1, 29, 'fgsdf', 'gsdf', 'gsadf', '13302', '', '', 0, 1, 3, 'thumb_20140709101825.jpg', 'thumb_20140709101825.jpg;thumb_20140709101825.jpg;thumb_20140709101828.jpg', '20140709101825.jpg;20140709101825.jpg;20140709101828.jpg', 'fdsfas', 'igi', 0, 'Ready', 'fdsa', 0, 1, 0, 0, 0, 0, '2014-07-09', '2014-07-09 08:18:31', 0),
(74, 1, 29, 'dfasdf', 'fasd', 'fasdfads', '2989.8', '', '', 0, 1, 3, 'thumb_20140709132556.jpg', 'thumb_20140709132556.jpg;thumb_20140709132558.jpg', '20140709132556.jpg;20140709132558.jpg', 'fasdfdsa', 'igi', 0, 'Ready', 'fasdfds', 0, 0, 0, 0, 0, 1, '2014-07-09', '2014-07-09 11:26:27', 1),
(75, 1, 29, 'dfgasd', 'ffasd', 'fasd', '24688.36', '', '', 0, 1, 3, 'thumb_20140709111818.jpg', 'thumb_20140709111818.jpg;thumb_20140709111820.jpg;thumb_20140709112401.jpg;thumb_20140709112612.jpg;thumb_20140709113259.png', '20140709111818.jpg;20140709111820.jpg;20140709112401.jpg;20140709112612.jpg;20140709113259.png', 'asdfdsa', 'igi', 0, 'Ready', 'fads', 0, 1, 0, 0, 0, 1, '2014-07-09', '2014-07-09 11:19:48', 1),
(76, 1, 29, 'fadsfdsa', 'fasd', 'fasdf', '150798', '', '', 0, 1, 3, 'thumb_20140709142841.jpg', 'thumb_20140709142841.jpg', '20140709142841.jpg', 'fasdfdsa', 'igi', 0, 'Ready', 'fasdf', 0, 0, 0, 0, 0, 1, '2014-07-09', '2014-07-09 12:28:43', 0),
(78, 1, 29, 'dfgdfgdfg', 'fgdfg', 'fdgdfgfdg', '10000', '', '', 0, 1, 1, NULL, NULL, NULL, '', 'igi', 0, 'Ready', '22', 0, 0, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(79, 1, 29, 'Product 1', 'testing desc', 'Desc', '200', '', '', 0, 1, 1, NULL, NULL, NULL, '', 'igi', 0, 'Ready', '22', 0, 0, 1, 0, 0, 1, '2014-07-14', '0000-00-00 00:00:00', 0),
(80, 1, 29, 'Product 2', '', 'sdsdfssdf', '23000', '', '', 0, 1, 1, NULL, NULL, NULL, '', 'igi', 0, 'Ready', '', 0, 0, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(81, 2, 29, 'Product 123', 'fgdfgdfg', '', '300000', '', '', 0, 2, 1, NULL, NULL, NULL, '', 'igi', 0, 'On Request', '', 0, 1, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(82, 1, 29, 'dfgdfgdfg', '', '', '50000', '', '', 0, 2, 1, NULL, NULL, NULL, '', 'igi', 0, 'On Request', '', 0, 0, 0, 0, 0, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(83, 2, 29, 'sdddfsdf', '', '', '50000', '', '', 0, 2, 1, NULL, NULL, NULL, '', 'igi', 0, 'On Request', '20', 0, 0, 1, 0, 0, 1, '2014-07-14', '0000-00-00 00:00:00', 0),
(84, 2, 29, 'Product - Apeksha', 'desc', 'long desc', '700000', '', '', 0, 2, 1, NULL, NULL, NULL, 'test,test123', 'igi', 0, 'On Request', '22', 0, 0, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(85, 1, 29, 'Product 2-Apeksha', 'Short Desc', 'Long Desc', '100000', '', '', 0, 1, 1, NULL, NULL, NULL, 'gfdg', 'igi', 0, 'Ready', '22', 0, 0, 0, 1, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(86, 3, 29, 'Product 4 - Apeksha', 'sdfsdgdfg', 'fgfghfgh', '4654646', '', '', 0, 3, 1, NULL, NULL, NULL, 'fghgfh', 'igi', 0, 'On Request', '12', 0, 0, 0, 1, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(87, 2, 29, 'Product 5- Apeksha', 'dfgdfgfdg', 'fgdfgdfg', '78945656', '', '', 0, 3, 1, NULL, NULL, NULL, '', 'igi', 0, 'On Request', '22', 0, 0, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(88, 1, 29, 'tyrtyrty', 'rtyrtyrty', '', '545645', '', '', 0, 1, 1, NULL, NULL, NULL, '', 'igi', 0, 'Ready', '', 0, 0, 0, 1, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(89, 3, 29, 'ghfgh', 'fghfghfgh', '', '45645', '', '', 0, 3, 1, NULL, NULL, NULL, '', '', 0, '', '', 0, 0, 0, 0, 0, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(90, 1, 29, 'dfgfgfh', 'fghfghfgh', 'dfsdfsdf', '1232354', '', '', 0, 2, 1, NULL, NULL, NULL, 'sdfsdfsdf', 'igi', 0, 'On Request', '22', 0, 1, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(91, 1, 29, 'Product 6- Apeksha', 'ddfgdfg', 'dfgdfgfdg', '27797', '', '', 0, 2, 3, 'thumb_20140714123039.jpg', 'thumb_20140714123039.jpg;thumb_20140714123041.jpg;thumb_20140714123043.jpg;thumb_20140714123045.jpg', '20140714123039.jpg;20140714123041.jpg;20140714123043.jpg;20140714123045.jpg', 'dfgdfg,dfgdfgdf', 'igi', 0, 'On Request', '22', 0, 0, 1, 0, 1, 1, '2014-07-14', '2014-07-14 10:30:47', 0),
(92, 1, 29, 'testetdgdfg', 'fgfgfdg', 'dfgdfg', '45656', '', '', 0, 3, 1, NULL, NULL, NULL, 'dfdfg,dfgdfg', 'igi', 0, 'On Request', '12', 0, 0, 0, 1, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(93, 3, 29, 'ghhdgh', 'fghfghfgh', '', '455654', '', '', 0, 2, 1, NULL, NULL, NULL, '', 'igi', 0, 'Ready', '', 0, 1, 0, 0, 1, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(94, 2, 29, 'fgjhj', 'hjghjghj', 'hgjghjh', '456456', '', '', 0, 3, 1, NULL, NULL, NULL, '', '', 0, '', '', 0, 0, 0, 0, 0, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(95, 2, 29, 'dfgdfg', 'dfgdfg', 'dfgdgdfg', '45645645', '', '', 0, 3, 1, NULL, NULL, NULL, '', '', 0, '', '', 0, 0, 0, 0, 0, 0, '2014-07-14', '0000-00-00 00:00:00', 0),
(96, 2, 29, 'Product 10- apeksha', 'ghjghj', 'fdfghfgh', '5464565', '', '', 0, 3, 1, 'thumb_20140714125916.png', 'thumb_20140714125916.png;thumb_20140714125919.jpg;thumb_20140714125921.jpg;thumb_20140714125923.jpg;thumb_20140714125925.jpg;thumb_20140714125927.jpg', '20140714125916.png;20140714125919.jpg;20140714125921.jpg;20140714125923.jpg;20140714125925.jpg;20140714125927.jpg', 'ghfgh,fdghgfh', 'igi', 0, 'On Request', '', 0, 1, 0, 0, 1, 0, '2014-07-14', '2014-07-14 10:59:29', 0),
(97, 1, 29, 'dgdfgdf', 'dfgdfgdf', '', '45654656', '', '', 0, 3, 1, 'thumb_20140714130437.jpg', 'thumb_20140714130437.jpg;thumb_20140714130439.jpg;thumb_20140714130441.jpg', '20140714130437.jpg;20140714130439.jpg;20140714130441.jpg', '', 'igi', 0, 'Ready', '20', 0, 1, 0, 0, 1, 0, '2014-07-14', '2014-07-14 11:04:43', 0),
(98, 1, 29, 'Product 10- apeksha', 'test', 'dgdfg', '20720', '', '', 0, 2, 3, 'thumb_20140714162807.jpg', 'thumb_20140714162807.jpg;thumb_20140714162809.jpg;thumb_20140714162811.jpg;thumb_20140714162813.jpg;thumb_20140714162815.jpg', '20140714162807.jpg;20140714162809.jpg;20140714162811.jpg;20140714162813.jpg;20140714162815.jpg', 'dfgdfgd,dfgdfg', 'igi', 0, 'Ready', '2', 0, 0, 0, 0, 1, 0, '2014-07-14', '2014-07-14 14:28:17', 0),
(99, 1, 29, 'ddgdfg', 'dfgdfg', 'dfgdfg', '56456456', '', '', 0, 1, 1, 'thumb_20140715073733.jpg', 'thumb_20140715073733.jpg;thumb_20140715073735.jpg;thumb_20140715073737.jpg;thumb_20140715073739.jpg;thumb_20140715073741.jpg;thumb_20140715073743.jpg;thumb_20140715073745.jpg', '20140715073733.jpg;20140715073735.jpg;20140715073737.jpg;20140715073739.jpg;20140715073741.jpg;20140715073743.jpg;20140715073745.jpg', 'dgdfgdfg', 'igi', 0, 'Ready', '10', 0, 0, 0, 0, 1, 0, '2014-07-15', '2014-07-15 05:37:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `price_type`
--

CREATE TABLE IF NOT EXISTS `price_type` (
  `PRICE_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRICE_TYPE_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`PRICE_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `price_type`
--

INSERT INTO `price_type` (`PRICE_TYPE_ID`, `PRICE_TYPE_NAME`) VALUES
(1, 'Fixed'),
(2, 'MRP'),
(3, 'Component');

-- --------------------------------------------------------

--
-- Table structure for table `prod_history`
--

CREATE TABLE IF NOT EXISTS `prod_history` (
  `PH_ID` int(5) NOT NULL AUTO_INCREMENT,
  `PROD_ID` int(5) NOT NULL,
  `USER_ID` int(5) NOT NULL,
  `TABLE` varchar(30) NOT NULL,
  `TYPE` varchar(20) NOT NULL,
  `DATA` text NOT NULL,
  `SUMMARY` text NOT NULL,
  `DATE_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `REF_PH_ID` int(5) NOT NULL,
  `PH_STATUS` tinyint(1) NOT NULL,
  `VERSION_ID` int(6) NOT NULL,
  PRIMARY KEY (`PH_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `prod_history`
--

INSERT INTO `prod_history` (`PH_ID`, `PROD_ID`, `USER_ID`, `TABLE`, `TYPE`, `DATA`, `SUMMARY`, `DATE_CREATED`, `REF_PH_ID`, `PH_STATUS`, `VERSION_ID`) VALUES
(24, 72, 29, '', 'mf_prod_summary', 'CAT_ID=1,PROD_NAME=dsfaf,PROD_SHORT_DESC=fasd,PROD_DESC=fasd,PROD_TAGS=asdf,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=22+x+12,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=1', '', '2014-07-09 12:24:19', 0, 1, 0),
(25, 73, 29, '', 'mf_prod_summary', 'CAT_ID=1,PROD_NAME=fgsdf,PROD_SHORT_DESC=gsdf,PROD_DESC=gsadf,PROD_TAGS=fdsfas,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=fdsa,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=0', '', '2014-07-09 12:24:19', 0, 1, 0),
(26, 74, 29, '', 'mf_prod_summary', 'CAT_ID=1,PROD_NAME=dfasdf,PROD_SHORT_DESC=fasd,PROD_DESC=fasdfads,PROD_TAGS=fasdfdsa,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=fasdfds,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=1', '', '2014-07-09 12:24:19', 0, 1, 0),
(27, 75, 29, '', 'mf_prod_summary', 'CAT_ID=1,PROD_NAME=dfgasd,PROD_SHORT_DESC=ffasd,PROD_DESC=fasd,PROD_TAGS=asdfdsa,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=fads,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=1', '', '2014-07-09 12:24:19', 0, 1, 0),
(28, 75, 29, 'mf_prod_summary', 'Product Summary', 'PROD_NAME=df+asdfdsafsad', 'Product Name = df asdfdsafsad', '2014-07-09 12:27:29', 0, 0, 102272),
(29, 76, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=fadsfdsa,PROD_SHORT_DESC=fasd,PROD_DESC=fasdf,PROD_TAGS=fasdfdsa,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=fasdf,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=1', 'Category = 1;Product Name = fadsfdsa;Short Desp = fasd;Description = fasdf;Tag = fasdfdsa;Total Price = ;Discount = ;Product Type = 1;Price Type = 3;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = fasdf;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 0;Payment = 1', '2014-07-09 12:28:33', 0, 1, 0),
(30, 76, 29, 'mf_prod_summary', 'Product Summary', 'PROD_NAME=fasd+fdsaf+dsfs', 'Product Name = fasd fdsaf dsfs', '2014-07-09 12:28:56', 0, 0, 132460),
(31, 76, 29, 'mf_prod_summary', 'Product Summary', 'PROD_SHORT_DESC=fasd+ffdsafdsa', 'Short Desp = fasd ffdsafdsa', '2014-07-09 12:34:38', 0, 0, 118985),
(32, 76, 29, 'mf_prod_summary', 'Product Summary', 'PROD_NAME=Prodict+name-1,PROD_DESC=f+asfasd+fasdfsadf', 'Product Name = Prodict name-1;Description = f asfasd fasdfsadf', '2014-07-09 12:36:39', 0, 0, 131220),
(33, 76, 29, 'mf_prod_summary', 'Product Summary', 'LIFE_TIME_RET=1', 'Life time returns = 1', '2014-07-09 12:37:55', 0, 0, 132248),
(34, 76, 29, 'mf_prod_summary', 'Product Summary', 'REF_100_PER=1', '100% return = 1', '2014-07-09 12:38:20', 0, 0, 129236),
(35, 78, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=dfgdfgdfg,PROD_SHORT_DESC=fgdfg,PROD_DESC=fdgdfgfdg,PROD_TAGS=,MF_TOTAL_PRICE=10000,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = dfgdfgdfg;Short Desp = fgdfg;Description = fdgdfgfdg;Tag = ;Total Price = 10000;Discount = ;Product Type = 1;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = 22;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 07:40:33', 0, 1, 0),
(36, 79, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=Product+1,PROD_SHORT_DESC=testing+desc,PROD_DESC=Desc,PROD_TAGS=,MF_TOTAL_PRICE=200,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=1,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=1', 'Category = 1;Product Name = Product 1;Short Desp = testing desc;Description = Desc;Tag = ;Total Price = 200;Discount = ;Product Type = 1;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = 22;30 Days return = 0;100% return = 0;Free Shipping = 1;Life time returns = 0;Free returns = 0;Payment = 1', '2014-07-14 08:24:13', 0, 1, 0),
(37, 80, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=Product+2,PROD_SHORT_DESC=,PROD_DESC=sdsdfssdf,PROD_TAGS=,MF_TOTAL_PRICE=23000,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = Product 2;Short Desp = ;Description = sdsdfssdf;Tag = ;Total Price = 23000;Discount = ;Product Type = 1;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = ;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 08:29:21', 0, 1, 0),
(38, 81, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=Product+123,PROD_SHORT_DESC=fgdfgdfg,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=300000,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 2;Product Name = Product 123;Short Desp = fgdfgdfg;Description = ;Tag = ;Total Price = 300000;Discount = ;Product Type = 2;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = ;30 Days return = 0;100% return = 1;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 08:34:46', 0, 1, 0),
(39, 82, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=dfgdfgdfg,PROD_SHORT_DESC=,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=50000,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=0', 'Category = 1;Product Name = dfgdfgdfg;Short Desp = ;Description = ;Tag = ;Total Price = 50000;Discount = ;Product Type = 2;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = ;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 0;Payment = 0', '2014-07-14 08:48:11', 0, 1, 0),
(40, 83, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=sdddfsdf,PROD_SHORT_DESC=,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=50000,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=20,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=1,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=1', 'Category = 2;Product Name = sdddfsdf;Short Desp = ;Description = ;Tag = ;Total Price = 50000;Discount = ;Product Type = 2;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 20;30 Days return = 0;100% return = 0;Free Shipping = 1;Life time returns = 0;Free returns = 0;Payment = 1', '2014-07-14 08:53:05', 0, 1, 0),
(41, 84, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=Product+-+Apeksha,PROD_SHORT_DESC=desc,PROD_DESC=long+desc,PROD_TAGS=test%2Ctest123,MF_TOTAL_PRICE=700000,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 2;Product Name = Product - Apeksha;Short Desp = desc;Description = long desc;Tag = test,test123;Total Price = 700000;Discount = ;Product Type = 2;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 22;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 09:02:07', 0, 1, 0),
(42, 85, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=Product+2-Apeksha,PROD_SHORT_DESC=Short+Desc,PROD_DESC=Long+Desc,PROD_TAGS=gfdg,MF_TOTAL_PRICE=100000,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=1,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = Product 2-Apeksha;Short Desp = Short Desc;Description = Long Desc;Tag = gfdg;Total Price = 100000;Discount = ;Product Type = 1;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = 22;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 1;Free returns = 1;Payment = 0', '2014-07-14 09:14:31', 0, 1, 0),
(43, 86, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=3,PROD_NAME=Product+4+-+Apeksha,PROD_SHORT_DESC=sdfsdgdfg,PROD_DESC=fgfghfgh,PROD_TAGS=fghgfh,MF_TOTAL_PRICE=4654646,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=12,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=1,FREE_RET=1,PAYMENT=0', 'Category = 3;Product Name = Product 4 - Apeksha;Short Desp = sdfsdgdfg;Description = fgfghfgh;Tag = fghgfh;Total Price = 4654646;Discount = ;Product Type = 3;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 12;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 1;Free returns = 1;Payment = 0', '2014-07-14 09:55:45', 0, 1, 0),
(44, 87, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=Product+5-+Apeksha,PROD_SHORT_DESC=dfgdfgfdg,PROD_DESC=fgdfgdfg,PROD_TAGS=,MF_TOTAL_PRICE=78945656,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 2;Product Name = Product 5- Apeksha;Short Desp = dfgdfgfdg;Description = fgdfgdfg;Tag = ;Total Price = 78945656;Discount = ;Product Type = 3;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 22;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 10:09:32', 0, 1, 0),
(45, 88, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=tyrtyrty,PROD_SHORT_DESC=rtyrtyrty,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=545645,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=1,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = tyrtyrty;Short Desp = rtyrtyrty;Description = ;Tag = ;Total Price = 545645;Discount = ;Product Type = 1;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = ;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 1;Free returns = 1;Payment = 0', '2014-07-14 10:14:43', 0, 1, 0),
(46, 89, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=3,PROD_NAME=ghfgh,PROD_SHORT_DESC=fghfghfgh,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=45645,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=,HALLMARK=0,STOCK=,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=0', 'Category = 3;Product Name = ghfgh;Short Desp = fghfghfgh;Description = ;Tag = ;Total Price = 45645;Discount = ;Product Type = 3;Price Type = 1;Certificate = ;Hallmark = 0;Stock = ;Product Size = ;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 0;Payment = 0', '2014-07-14 10:15:42', 0, 1, 0),
(47, 90, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=dfgfgfh,PROD_SHORT_DESC=fghfghfgh,PROD_DESC=dfsdfsdf,PROD_TAGS=sdfsdfsdf,MF_TOTAL_PRICE=1232354,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = dfgfgfh;Short Desp = fghfghfgh;Description = dfsdfsdf;Tag = sdfsdfsdf;Total Price = 1232354;Discount = ;Product Type = 2;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 22;30 Days return = 0;100% return = 1;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 10:23:35', 0, 1, 0),
(48, 91, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=Product+6-+Apeksha,PROD_SHORT_DESC=ddfgdfg,PROD_DESC=dfgdfgfdg,PROD_TAGS=dfgdfg%2Cdfgdfgdf,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=22,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=1,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=1', 'Category = 1;Product Name = Product 6- Apeksha;Short Desp = ddfgdfg;Description = dfgdfgfdg;Tag = dfgdfg,dfgdfgdf;Total Price = ;Discount = ;Product Type = 2;Price Type = 3;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 22;30 Days return = 0;100% return = 0;Free Shipping = 1;Life time returns = 0;Free returns = 1;Payment = 1', '2014-07-14 10:30:25', 0, 1, 0),
(49, 92, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=testetdgdfg,PROD_SHORT_DESC=fgfgfdg,PROD_DESC=dfgdfg,PROD_TAGS=dfdfg%2Cdfgdfg,MF_TOTAL_PRICE=45656,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=12,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=1,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = testetdgdfg;Short Desp = fgfgfdg;Description = dfgdfg;Tag = dfdfg,dfgdfg;Total Price = 45656;Discount = ;Product Type = 3;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = 12;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 1;Free returns = 1;Payment = 0', '2014-07-14 10:52:44', 0, 1, 0),
(50, 93, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=3,PROD_NAME=ghhdgh,PROD_SHORT_DESC=fghfghfgh,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=455654,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 3;Product Name = ghhdgh;Short Desp = fghfghfgh;Description = ;Tag = ;Total Price = 455654;Discount = ;Product Type = 2;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = ;30 Days return = 0;100% return = 1;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 10:53:54', 0, 1, 0),
(51, 94, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=fgjhj,PROD_SHORT_DESC=hjghjghj,PROD_DESC=hgjghjh,PROD_TAGS=,MF_TOTAL_PRICE=456456,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=,HALLMARK=0,STOCK=,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=0', 'Category = 2;Product Name = fgjhj;Short Desp = hjghjghj;Description = hgjghjh;Tag = ;Total Price = 456456;Discount = ;Product Type = 3;Price Type = 1;Certificate = ;Hallmark = 0;Stock = ;Product Size = ;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 0;Payment = 0', '2014-07-14 10:54:40', 0, 1, 0),
(52, 95, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=dfgdfg,PROD_SHORT_DESC=dfgdfg,PROD_DESC=dfgdgdfg,PROD_TAGS=,MF_TOTAL_PRICE=45645645,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=,HALLMARK=0,STOCK=,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=0,PAYMENT=0', 'Category = 2;Product Name = dfgdfg;Short Desp = dfgdfg;Description = dfgdgdfg;Tag = ;Total Price = 45645645;Discount = ;Product Type = 3;Price Type = 1;Certificate = ;Hallmark = 0;Stock = ;Product Size = ;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 0;Payment = 0', '2014-07-14 10:56:51', 0, 1, 0),
(53, 96, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=2,PROD_NAME=Product+10-+apeksha,PROD_SHORT_DESC=ghjghj,PROD_DESC=fdfghfgh,PROD_TAGS=ghfgh%2Cfdghgfh,MF_TOTAL_PRICE=5464565,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=On+Request,PROD_SIZE=,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 2;Product Name = Product 10- apeksha;Short Desp = ghjghj;Description = fdfghfgh;Tag = ghfgh,fdghgfh;Total Price = 5464565;Discount = ;Product Type = 3;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = On Request;Product Size = ;30 Days return = 0;100% return = 1;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 10:59:01', 0, 1, 0),
(54, 97, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=dgdfgdf,PROD_SHORT_DESC=dfgdfgdf,PROD_DESC=,PROD_TAGS=,MF_TOTAL_PRICE=45654656,DISCOUNT=,PROD_TYPE_ID=3,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=20,DAYS_30_RET=0,REF_100_PER=1,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = dgdfgdf;Short Desp = dfgdfgdf;Description = ;Tag = ;Total Price = 45654656;Discount = ;Product Type = 3;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = 20;30 Days return = 0;100% return = 1;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 11:04:13', 0, 1, 0),
(55, 98, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=Product+10-+apeksha,PROD_SHORT_DESC=test,PROD_DESC=dgdfg,PROD_TAGS=dfgdfgd%2Cdfgdfg,MF_TOTAL_PRICE=,DISCOUNT=,PROD_TYPE_ID=2,PRICE_TYPE_ID=3,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=2,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = Product 10- apeksha;Short Desp = test;Description = dgdfg;Tag = dfgdfgd,dfgdfg;Total Price = ;Discount = ;Product Type = 2;Price Type = 3;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = 2;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-14 14:27:58', 0, 1, 0),
(56, 99, 29, 'mf_prod_summary', 'Product Summary', 'CAT_ID=1,PROD_NAME=ddgdfg,PROD_SHORT_DESC=dfgdfg,PROD_DESC=dfgdfg,PROD_TAGS=dgdfgdfg,MF_TOTAL_PRICE=56456456,DISCOUNT=,PROD_TYPE_ID=1,PRICE_TYPE_ID=1,CERTIFICATE=igi,HALLMARK=0,STOCK=Ready,PROD_SIZE=10,DAYS_30_RET=0,REF_100_PER=0,FREE_SHIP=0,LIFE_TIME_RET=0,FREE_RET=1,PAYMENT=0', 'Category = 1;Product Name = ddgdfg;Short Desp = dfgdfg;Description = dfgdfg;Tag = dgdfgdfg;Total Price = 56456456;Discount = ;Product Type = 1;Price Type = 1;Certificate = igi;Hallmark = 0;Stock = Ready;Product Size = 10;30 Days return = 0;100% return = 0;Free Shipping = 0;Life time returns = 0;Free returns = 1;Payment = 0', '2014-07-15 05:37:22', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `prod_type`
--

CREATE TABLE IF NOT EXISTS `prod_type` (
  `PROD_TYPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PROD_TYPE_NAME` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`PROD_TYPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `prod_type`
--

INSERT INTO `prod_type` (`PROD_TYPE_ID`, `PROD_TYPE_NAME`) VALUES
(1, 'Ring'),
(2, 'Earring'),
(3, 'Necklace');

-- --------------------------------------------------------

--
-- Table structure for table `stone_clarity`
--

CREATE TABLE IF NOT EXISTS `stone_clarity` (
  `CLARITY_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CLARITY_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CLARITY_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_clarity`
--

INSERT INTO `stone_clarity` (`CLARITY_ID`, `CLARITY_NAME`) VALUES
(1, 'VVS'),
(2, 'VS');

-- --------------------------------------------------------

--
-- Table structure for table `stone_color`
--

CREATE TABLE IF NOT EXISTS `stone_color` (
  `COLOR_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `COLOR_NAME` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`COLOR_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stone_color`
--

INSERT INTO `stone_color` (`COLOR_ID`, `COLOR_NAME`) VALUES
(1, 'G'),
(2, 'H'),
(3, 'E'),
(4, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `stone_cut`
--

CREATE TABLE IF NOT EXISTS `stone_cut` (
  `CUT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CUT_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CUT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_cut`
--

INSERT INTO `stone_cut` (`CUT_ID`, `CUT_NAME`) VALUES
(1, 'Good'),
(2, 'Poor');

-- --------------------------------------------------------

--
-- Table structure for table `stone_fluorescence`
--

CREATE TABLE IF NOT EXISTS `stone_fluorescence` (
  `FLU_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FLU_NAME` varchar(20) NOT NULL,
  PRIMARY KEY (`FLU_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stone_fluorescence`
--

INSERT INTO `stone_fluorescence` (`FLU_ID`, `FLU_NAME`) VALUES
(1, 'Strong'),
(2, 'Medium'),
(3, 'Faint');

-- --------------------------------------------------------

--
-- Table structure for table `stone_placement`
--

CREATE TABLE IF NOT EXISTS `stone_placement` (
  `PLAC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PLAC_NAME` varchar(25) NOT NULL,
  PRIMARY KEY (`PLAC_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_placement`
--

INSERT INTO `stone_placement` (`PLAC_ID`, `PLAC_NAME`) VALUES
(1, 'Center'),
(2, 'Side');

-- --------------------------------------------------------

--
-- Table structure for table `stone_seiv_size_from`
--

CREATE TABLE IF NOT EXISTS `stone_seiv_size_from` (
  `SEIV_SIZE_FROM_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SEIV_SIZE_FROM_NAME` varchar(30) NOT NULL,
  PRIMARY KEY (`SEIV_SIZE_FROM_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_seiv_size_from`
--

INSERT INTO `stone_seiv_size_from` (`SEIV_SIZE_FROM_ID`, `SEIV_SIZE_FROM_NAME`) VALUES
(1, 'Negative 000'),
(2, 'Positive 000');

-- --------------------------------------------------------

--
-- Table structure for table `stone_seiv_size_to`
--

CREATE TABLE IF NOT EXISTS `stone_seiv_size_to` (
  `SEIV_SIZE_TO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SEIV_SIZE_TO_NAME` varchar(30) NOT NULL,
  PRIMARY KEY (`SEIV_SIZE_TO_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_seiv_size_to`
--

INSERT INTO `stone_seiv_size_to` (`SEIV_SIZE_TO_ID`, `SEIV_SIZE_TO_NAME`) VALUES
(1, 'Negative 000'),
(2, 'Negative 00');

-- --------------------------------------------------------

--
-- Table structure for table `stone_setting`
--

CREATE TABLE IF NOT EXISTS `stone_setting` (
  `SET_ID` int(5) NOT NULL AUTO_INCREMENT,
  `SET_NAME` varchar(20) NOT NULL,
  PRIMARY KEY (`SET_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stone_setting`
--

INSERT INTO `stone_setting` (`SET_ID`, `SET_NAME`) VALUES
(1, 'Prong'),
(2, 'Bezel'),
(3, ' Pave');

-- --------------------------------------------------------

--
-- Table structure for table `stone_shape`
--

CREATE TABLE IF NOT EXISTS `stone_shape` (
  `SHAPE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SHAPE_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`SHAPE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_shape`
--

INSERT INTO `stone_shape` (`SHAPE_ID`, `SHAPE_NAME`) VALUES
(1, 'Round'),
(2, 'Square');

-- --------------------------------------------------------

--
-- Table structure for table `stone_size`
--

CREATE TABLE IF NOT EXISTS `stone_size` (
  `SIZE_ID` int(5) NOT NULL AUTO_INCREMENT,
  `SIZE_NAME` varchar(20) NOT NULL,
  PRIMARY KEY (`SIZE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stone_size`
--

INSERT INTO `stone_size` (`SIZE_ID`, `SIZE_NAME`) VALUES
(1, 'SEIV Size'),
(2, 'MM Size');

-- --------------------------------------------------------

--
-- Table structure for table `sub_users_table`
--

CREATE TABLE IF NOT EXISTS `sub_users_table` (
  `STORE_USER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `STORE_ID` int(10) unsigned NOT NULL,
  `USER_NAME` varchar(20) DEFAULT NULL,
  `PASS_WORD` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`STORE_USER_ID`),
  KEY `SUB_USERS_TABLE_FKIndex1` (`STORE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax_table`
--

CREATE TABLE IF NOT EXISTS `tax_table` (
  `TAX_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TAX_NAME` varchar(20) DEFAULT NULL,
  `TAX_STATUS` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`TAX_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `ROLE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ROLE_NAME` varchar(15) NOT NULL,
  `ROLE_STATUS` tinyint(1) NOT NULL,
  PRIMARY KEY (`ROLE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`ROLE_ID`, `ROLE_NAME`, `ROLE_STATUS`) VALUES
(1, 'Master', 0),
(2, 'Manufacturer', 0),
(3, 'Jeweller', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_store_settings`
--

CREATE TABLE IF NOT EXISTS `user_store_settings` (
  `STORE_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(10) unsigned NOT NULL,
  `LOGO` varchar(100) DEFAULT NULL,
  `BANNERS` text,
  `HEADER_NAME` varchar(50) DEFAULT NULL,
  `THEME_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`STORE_ID`),
  KEY `USER_STORE_SETTINGS_FKIndex1` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `USER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FIRST_NAME` varchar(20) DEFAULT NULL,
  `LAST_NAME` varchar(20) DEFAULT NULL,
  `USER_NAME` varchar(20) DEFAULT NULL,
  `EMAIL_ID` varchar(30) DEFAULT NULL,
  `PASS_WORD` varchar(200) DEFAULT NULL,
  `IS_VERIFIED` tinyint(1) DEFAULT '0',
  `IS_ACTIVE` tinyint(1) DEFAULT '0',
  `MOBILE` varchar(15) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `CITY` varchar(30) DEFAULT NULL,
  `STATE` varchar(30) DEFAULT NULL,
  `TELEPHONE` varchar(15) DEFAULT NULL,
  `COMP_NAME` varchar(100) DEFAULT NULL,
  `WEBSITE` varchar(100) DEFAULT NULL,
  `MEM_GJEPC_NO` varchar(50) DEFAULT NULL,
  `MEN_GJF_NO` varchar(50) DEFAULT NULL,
  `MEM_LOC_ASS_NAME` varchar(100) DEFAULT NULL,
  `MEM_LOC_ASS_CITY` varchar(50) DEFAULT NULL,
  `PINCODE` varchar(15) DEFAULT NULL,
  `USER_ROLE` int(10) unsigned DEFAULT NULL,
  `USER_CREATED` datetime NOT NULL,
  `USER_UPDATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `USER_NAME`, `EMAIL_ID`, `PASS_WORD`, `IS_VERIFIED`, `IS_ACTIVE`, `MOBILE`, `ADDRESS`, `CITY`, `STATE`, `TELEPHONE`, `COMP_NAME`, `WEBSITE`, `MEM_GJEPC_NO`, `MEN_GJF_NO`, `MEM_LOC_ASS_NAME`, `MEM_LOC_ASS_CITY`, `PINCODE`, `USER_ROLE`, `USER_CREATED`, `USER_UPDATED`) VALUES
(1, 'Administrator', 'Mf', 'admin', 'admin', 'YWRtaW4=', 1, 1, '9876543210', 'ECIL', 'Hyderabad', 'Andhra Pradesh', '0222222222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-07-03 00:00:00', '2014-07-03 10:02:49'),
(29, 'Laxman', 'Mf', '0', 'laxman1224@gmail.com', 'ZGVtbzEyMw==', 1, 1, '9876543210', 'ECIL', 'Hyderabad', 'Andhra Pradesh', '02224913013', '0', '0', '0', '0', '0', '0', '400034', 2, '2014-07-07 15:10:35', '2014-07-07 13:10:35'),
(30, 'Apeksha', 'L', 'Google-Pvt-Ltd', 'apeksha9july@gmail.com', 'ZGVtbzEyMw==', 1, 1, '9876543210', 'Mumbai Central', 'Mumbai', '0', '0222491301', 'Aavidcode', 'www.test.com', '', '12', 'test', 'Mumbai', '400034', 2, '2014-07-08 11:35:12', '2014-07-08 09:35:12'),
(37, 'apeksha', 'L', 'Aavidcode-Pvt-Ltd', 'apeksha9july@gmail.com', 'dGVzdDEyMw==', 0, 0, '0224913013', 'Grand Road', 'Mumbai', 'Maharashtra', '0224913013', 'Apeksha Pvt Ltd', 'http://www.gmail.com', '', '23', 'test', 'Mumbai', '0465464546', 2, '2014-07-11 11:41:15', '2014-07-11 09:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_tax_det`
--

CREATE TABLE IF NOT EXISTS `user_tax_det` (
  `USER_TAX_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TAX_ID` int(10) unsigned NOT NULL,
  `USER_ID` int(10) unsigned NOT NULL,
  `TAX_VALUE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`USER_TAX_ID`),
  KEY `USER_TAX_DET_FKIndex1` (`USER_ID`),
  KEY `USER_TAX_DET_FKIndex2` (`TAX_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jw_prod_colored_stone`
--
ALTER TABLE `jw_prod_colored_stone`
  ADD CONSTRAINT `jw_prod_colored_stone_ibfk_1` FOREIGN KEY (`P_COL_S_ID`) REFERENCES `mf_prod_colored_stone` (`P_COL_S_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jw_prod_colored_stone_ibfk_2` FOREIGN KEY (`JW_PROD_ID`) REFERENCES `jw_prod_summary` (`JW_PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jw_prod_diamond`
--
ALTER TABLE `jw_prod_diamond`
  ADD CONSTRAINT `jw_prod_diamond_ibfk_1` FOREIGN KEY (`P_STONE_ID`) REFERENCES `mf_prod_diamond` (`P_STONE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jw_prod_diamond_ibfk_2` FOREIGN KEY (`JW_PROD_ID`) REFERENCES `jw_prod_summary` (`JW_PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jw_prod_labor`
--
ALTER TABLE `jw_prod_labor`
  ADD CONSTRAINT `jw_prod_labor_ibfk_1` FOREIGN KEY (`P_LABOR_ID`) REFERENCES `mf_prod_labor` (`P_LABOR_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jw_prod_labor_ibfk_2` FOREIGN KEY (`JW_PROD_ID`) REFERENCES `jw_prod_summary` (`JW_PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jw_prod_metal`
--
ALTER TABLE `jw_prod_metal`
  ADD CONSTRAINT `jw_prod_metal_ibfk_1` FOREIGN KEY (`P_METAL_ID`) REFERENCES `mf_prod_metal` (`P_METAL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jw_prod_metal_ibfk_2` FOREIGN KEY (`JW_PROD_ID`) REFERENCES `jw_prod_summary` (`JW_PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jw_prod_summary`
--
ALTER TABLE `jw_prod_summary`
  ADD CONSTRAINT `jw_prod_summary_ibfk_1` FOREIGN KEY (`PROD_ID`) REFERENCES `mf_prod_summary` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jw_prod_summary_ibfk_2` FOREIGN KEY (`MF_USER_ID`) REFERENCES `user_table` (`USER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mf_prod_colored_stone`
--
ALTER TABLE `mf_prod_colored_stone`
  ADD CONSTRAINT `mf_prod_colored_stone_ibfk_1` FOREIGN KEY (`PROD_ID`) REFERENCES `mf_prod_summary` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_colored_stone_ibfk_2` FOREIGN KEY (`P_COMP_ID`) REFERENCES `mf_prod_component` (`P_COMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_colored_stone_ibfk_3` FOREIGN KEY (`C_STONE_CAT_ID`) REFERENCES `c_stone_category` (`C_STONE_CAT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_colored_stone_ibfk_4` FOREIGN KEY (`C_STONE_COL_ID`) REFERENCES `c_stone_color` (`C_STONE_COL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mf_prod_component`
--
ALTER TABLE `mf_prod_component`
  ADD CONSTRAINT `mf_prod_component_ibfk_1` FOREIGN KEY (`PROD_ID`) REFERENCES `mf_prod_summary` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_component_ibfk_2` FOREIGN KEY (`COMP_ID`) REFERENCES `component` (`COMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mf_prod_diamond`
--
ALTER TABLE `mf_prod_diamond`
  ADD CONSTRAINT `mf_prod_diamond_ibfk_1` FOREIGN KEY (`PROD_ID`) REFERENCES `mf_prod_summary` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_diamond_ibfk_2` FOREIGN KEY (`CUT_ID`) REFERENCES `stone_cut` (`CUT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_diamond_ibfk_3` FOREIGN KEY (`CLARITY_FROM_ID`) REFERENCES `stone_clarity` (`CLARITY_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_diamond_ibfk_4` FOREIGN KEY (`CLARITY_TO_ID`) REFERENCES `stone_clarity` (`CLARITY_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_diamond_ibfk_5` FOREIGN KEY (`COLOR_FROM_ID`) REFERENCES `stone_color` (`COLOR_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_diamond_ibfk_6` FOREIGN KEY (`COLOR_TO_ID`) REFERENCES `stone_color` (`COLOR_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_diamond_ibfk_7` FOREIGN KEY (`P_COMP_ID`) REFERENCES `mf_prod_component` (`P_COMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mf_prod_labor`
--
ALTER TABLE `mf_prod_labor`
  ADD CONSTRAINT `mf_prod_labor_ibfk_1` FOREIGN KEY (`PROD_ID`) REFERENCES `mf_prod_summary` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_labor_ibfk_2` FOREIGN KEY (`P_COMP_ID`) REFERENCES `mf_prod_component` (`P_COMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mf_prod_metal`
--
ALTER TABLE `mf_prod_metal`
  ADD CONSTRAINT `mf_prod_metal_ibfk_1` FOREIGN KEY (`P_COMP_ID`) REFERENCES `mf_prod_component` (`P_COMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_metal_ibfk_2` FOREIGN KEY (`PROD_ID`) REFERENCES `mf_prod_summary` (`PROD_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mf_prod_summary`
--
ALTER TABLE `mf_prod_summary`
  ADD CONSTRAINT `mf_prod_summary_ibfk_1` FOREIGN KEY (`MF_USER_ID`) REFERENCES `user_table` (`USER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_summary_ibfk_2` FOREIGN KEY (`CAT_ID`) REFERENCES `category` (`CAT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_summary_ibfk_3` FOREIGN KEY (`PRICE_TYPE_ID`) REFERENCES `price_type` (`PRICE_TYPE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `mf_prod_summary_ibfk_4` FOREIGN KEY (`PROD_TYPE_ID`) REFERENCES `prod_type` (`PROD_TYPE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_users_table`
--
ALTER TABLE `sub_users_table`
  ADD CONSTRAINT `sub_users_table_ibfk_1` FOREIGN KEY (`STORE_ID`) REFERENCES `user_store_settings` (`STORE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_store_settings`
--
ALTER TABLE `user_store_settings`
  ADD CONSTRAINT `user_store_settings_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user_table` (`USER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_tax_det`
--
ALTER TABLE `user_tax_det`
  ADD CONSTRAINT `user_tax_det_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user_table` (`USER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_tax_det_ibfk_2` FOREIGN KEY (`TAX_ID`) REFERENCES `tax_table` (`TAX_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
