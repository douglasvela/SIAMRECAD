-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2018 a las 18:49:42
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `org_linea_trabajo`
--

CREATE TABLE `org_linea_trabajo` (
  `id_linea_trabajo` int(2) NOT NULL COMMENT 'Indentificador de la linea de trabajo',
  `linea_trabajo` char(4) DEFAULT '' COMMENT 'Linea de trabajo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `org_linea_trabajo`
--

INSERT INTO `org_linea_trabajo` (`id_linea_trabajo`, `linea_trabajo`) VALUES
(1, '0101'),
(2, '0102'),
(3, '0103'),
(4, '0201'),
(5, '0202'),
(6, '0203'),
(7, '0204'),
(8, '0401'),
(9, '0402'),
(10, '0403'),
(11, '0404'),
(12, '0405'),
(13, '0406'),
(14, '0701'),
(15, '0501'),
(16, '0301'),
(17, '0601');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `org_linea_trabajo`
--
ALTER TABLE `org_linea_trabajo`
  ADD PRIMARY KEY (`id_linea_trabajo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `org_linea_trabajo`
--
ALTER TABLE `org_linea_trabajo`
  MODIFY `id_linea_trabajo` int(2) NOT NULL AUTO_INCREMENT COMMENT 'Indentificador de la linea de trabajo', AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
