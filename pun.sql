-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-05-2018 a las 02:56:07
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `pun`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banda`
--

DROP TABLE IF EXISTS `banda`;
CREATE TABLE IF NOT EXISTS `banda` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `otros` text NOT NULL,
  `integrantes` text,
  `comentarios` text,
  `imagen` text,
  `extranjera` tinyint(1) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banda_lanzamiento`
--

DROP TABLE IF EXISTS `banda_lanzamiento`;
CREATE TABLE IF NOT EXISTS `banda_lanzamiento` (
  `banda_id` int(11) NOT NULL,
  `lanzamiento_id` int(11) NOT NULL,
  KEY `banda_lanzamiento_ibfk_1` (`banda_id`),
  KEY `lanzamiento_id` (`lanzamiento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lanzamiento`
--

DROP TABLE IF EXISTS `lanzamiento`;
CREATE TABLE IF NOT EXISTS `lanzamiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `referencia` text,
  `formato` enum('CD','Digipack','12"','10"','7"','Flexi','Cassette','Digital','Mini CD','DVD','Otros') DEFAULT NULL,
  `anho` text,
  `tracklist` text NOT NULL,
  `creditos` text,
  `notas` text,
  `link` text,
  `imagen` text,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `banda_lanzamiento`
--
ALTER TABLE `banda_lanzamiento`
  ADD CONSTRAINT `banda_lanzamiento_ibfk_1` FOREIGN KEY (`banda_id`) REFERENCES `banda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banda_lanzamiento_ibfk_2` FOREIGN KEY (`lanzamiento_id`) REFERENCES `lanzamiento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
