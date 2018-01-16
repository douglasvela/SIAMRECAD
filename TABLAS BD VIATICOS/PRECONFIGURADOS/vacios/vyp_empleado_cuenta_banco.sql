-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2018 a las 07:43:49
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
-- Estructura de tabla para la tabla `vyp_empleado_cuenta_banco`
--

DROP TABLE IF EXISTS `vyp_empleado_cuenta_banco`;
CREATE TABLE `vyp_empleado_cuenta_banco` (
  `id_empleado_banco` int(10) UNSIGNED NOT NULL,
  `nr` varchar(4) NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL,
  `numero_cuenta` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_empleado_cuenta_banco`
--
ALTER TABLE `vyp_empleado_cuenta_banco`
  ADD PRIMARY KEY (`id_empleado_banco`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_empleado_cuenta_banco`
--
ALTER TABLE `vyp_empleado_cuenta_banco`
  MODIFY `id_empleado_banco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
