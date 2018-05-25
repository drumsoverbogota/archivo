-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2018 at 06:00 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pun`
--

-- --------------------------------------------------------

--
-- Table structure for table `banda`
--

CREATE TABLE `banda` (
  `id` int(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `otros` text NOT NULL,
  `integrantes` text,
  `comentarios` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banda_lanzamiento`
--

CREATE TABLE `banda_lanzamiento` (
  `banda_id` int(11) NOT NULL,
  `lanzamiento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lanzamiento`
--

CREATE TABLE `lanzamiento` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `referencia` text,
  `formato` enum('CD','Digipack','12"','10"','7"','Flexi','Cassette','Digital','Mini CD','DVD','Otros') DEFAULT NULL,
  `anho` text,
  `tracklist` text NOT NULL,
  `creditos` text,
  `notas` text,
  `link` text,
  `imagen` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banda`
--
ALTER TABLE `banda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banda_lanzamiento`
--
ALTER TABLE `banda_lanzamiento`
  ADD KEY `banda_lanzamiento_ibfk_1` (`banda_id`),
  ADD KEY `lanzamiento_id` (`lanzamiento_id`);

--
-- Indexes for table `lanzamiento`
--
ALTER TABLE `lanzamiento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banda`
--
ALTER TABLE `banda`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lanzamiento`
--
ALTER TABLE `lanzamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `banda_lanzamiento`
--
ALTER TABLE `banda_lanzamiento`
  ADD CONSTRAINT `banda_lanzamiento_ibfk_1` FOREIGN KEY (`banda_id`) REFERENCES `banda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banda_lanzamiento_ibfk_2` FOREIGN KEY (`lanzamiento_id`) REFERENCES `lanzamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;