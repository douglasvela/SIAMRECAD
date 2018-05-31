-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-05-2018 a las 21:56:07
-- Versión del servidor: 5.7.20-0ubuntu0.17.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.17.04.1

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
-- Estructura de tabla para la tabla `vyp_pasajes`
--

CREATE TABLE `vyp_pasajes` (
  `id_solicitud_pasaje` int(11) NOT NULL,
  `id_municipio` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fecha_mision` date NOT NULL,
  `no_expediente` varchar(15) NOT NULL,
  `empresa_visitada` varchar(30) NOT NULL,
  `direccion_empresa` varchar(50) NOT NULL,
  `nr` varchar(10) NOT NULL,
  `monto_pasaje` float(10,2) NOT NULL,
  `id_actividad_realizada` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_mision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_pasajes`
--
ALTER TABLE `vyp_pasajes`
  ADD PRIMARY KEY (`id_solicitud_pasaje`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_pasajes`
--
ALTER TABLE `vyp_pasajes`
  MODIFY `id_solicitud_pasaje` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
