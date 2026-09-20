-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2025 at 07:15 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE IF NOT EXISTS `tblcart` (
  `cartid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `addedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cartid`),
  UNIQUE KEY `ux_user_product` (`userid`,`productid`),
  KEY `idx_user` (`userid`),
  KEY `idx_product` (`productid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE IF NOT EXISTS `tblorder` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `totalamout` int(11) NOT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`orderid`, `userid`, `orderdate`, `totalamout`) VALUES
(1, 1, '2025-08-27 01:36:12', 1044);

-- --------------------------------------------------------

--
-- Table structure for table `tblorderdetails`
--

CREATE TABLE IF NOT EXISTS `tblorderdetails` (
  `detailid` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `qty` int(11) DEFAULT '1',
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`detailid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblorderdetails`
--

INSERT INTO `tblorderdetails` (`detailid`, `orderid`, `productid`, `qty`, `price`, `subtotal`) VALUES
(1, 0, 9, 1, 44, 44),
(2, 1, 8, 1, 1000, 1000),
(3, 1, 9, 1, 44, 44);

-- --------------------------------------------------------

--
--
-- Table structure for table `tblpro`
--

CREATE TABLE IF NOT EXISTS `tblpro` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `des` text NOT NULL,
  `img` varchar(500) NOT NULL,
  PRIMARY KEY (`productid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblpro`
--

INSERT INTO `tblpro` (`productid`, `title`, `mrp`, `price`, `des`, `img`) VALUES
(1, 'Sony PlayStation 5 Disc Edition Console (1TB SSD)', 54990, 49990, 'Ultra-high speed 1TB SSD, Ray Tracing, 4K-TV gaming up to 120fps with 120Hz output, Tempest 3D AudioTech, DualSense wireless controller included.', 'console-ps5.jpg'),
(2, 'Logitech G815 RGB Mechanical Gaming Keyboard (Purple GL Tactile)', 19995, 15995, 'Low profile GL Tactile mechanical switches, LIGHTSYNC RGB lighting, aircraft-grade 5052 aluminum alloy top case, dedicated media controls and volume roller.', 'keyboard-mechanical.jpg'),
(3, 'Logitech G PRO X SUPERLIGHT 2 Wireless Gaming Mouse', 14995, 12499, 'Ultra-lightweight 60g design, HERO 2 sensor with 32,000 DPI, LIGHTFORCE optical-mechanical hybrid switches, 95 hours continuous battery life.', 'mouse-wireless.jpg'),
(4, 'Microsoft Xbox Series Wireless Controller — Robot White', 5990, 4999, 'Sculpted surfaces and refined geometry for enhanced comfort, hybrid D-pad, textured grip on triggers and bumpers, Bluetooth and Xbox Wireless connectivity.', 'xbox-controller-white.jpg'),
(5, 'Razer BlackShark V2 Pro Wireless Esports Headset', 19999, 14999, 'Razer HyperClear Super Wideband Mic, TriForce Titanium 50mm Drivers, ultra-soft breathable memory foam ear cushions, 70 hours battery life.', 'headphone-pro.jpg'),
(6, 'Sony DualSense Wireless Controller — Midnight Black', 6490, 5490, 'Immersive haptic feedback, dynamic adaptive triggers, integrated microphone and headset jack, signature ergonomic gaming grip.', 'controller-rgb.jpg'),
(7, 'Samsung Odyssey G9 49\" Curved OLED Gaming Monitor', 149999, 119999, 'Dual QHD 5120x1440 OLED panel, 240Hz refresh rate, 0.03ms response time, 1800R curvature, Neo Quantum Processor Pro.', 'curved-monitor.jpg'),
(8, 'Secretlab TITAN Evo 2024 Ergonomic Gaming Chair', 49999, 39999, 'Proprietary Pebble Seat Base, 4-way L-ADAPT Lumbar Support System, Magnetic Memory Foam Head Pillow, NEO Hybrid Leatherette.', 'gaming-chair.jpg'),
(9, 'ASUS TUF NVIDIA GeForce RTX 4080 Super 16GB GPU', 109999, 96999, 'Powered by NVIDIA DLSS3, Ada Lovelace arch, Axial-tech fans scaled up for 23% more airflow, Dual ball fan bearings, Military-grade capacitors.', 'rtx-4080-gpu.jpg'),
(10, 'Microsoft Xbox Series X 1TB Gaming Console', 55990, 49990, '12 teraflops of raw graphic processing power, DirectX ray tracing, True 4K gaming, 1TB custom NVMe SSD, Quick Resume for multiple games.', 'xbox-series-x.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `hobbies` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `username`, `password`, `email`, `gender`, `hobbies`) VALUES
(1, 'user', '1234', 'user@gmail.com', 'male', 'football,reading'),
(2, 'keshav', 'K1234', 'keshav@gmail.com', 'male', 'sleeping,writing'),
(3, 'pratham', 'P1234', 'pratham@gmail.com', 'male', 'football,reading'),
(4, 'keshav', 'K1234', 'keshav@gmail.com', 'male', 'sleeping,writing'),
(5, 'tyrus', 't1234', 'tyrus@gmail.com', 'Male', 'Vollyball,Football');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
