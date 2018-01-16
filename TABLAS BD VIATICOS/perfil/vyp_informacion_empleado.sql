-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2018 a las 07:44:21
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
-- Estructura de tabla para la tabla `vyp_informacion_empleado`
--

DROP TABLE IF EXISTS `vyp_informacion_empleado`;
CREATE TABLE `vyp_informacion_empleado` (
  `id_informacion_empleado` int(10) UNSIGNED NOT NULL,
  `nr` varchar(4) NOT NULL,
  `nr_jefe_inmediato` varchar(4) NOT NULL,
  `id_oficina_departamental` varchar(5) NOT NULL,
  `id_region` int(5) UNSIGNED ZEROFILL NOT NULL,
  `partida` varchar(45) NOT NULL,
  `sub_numero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_informacion_empleado`
--
ALTER TABLE `vyp_informacion_empleado`
  ADD PRIMARY KEY (`id_informacion_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_informacion_empleado`
--
ALTER TABLE `vyp_informacion_empleado`
  MODIFY `id_informacion_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
