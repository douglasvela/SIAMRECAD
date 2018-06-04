-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-05-2018 a las 21:56:29
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
-- Estructura de tabla para la tabla `vyp_mision_pasajes`
--
DROP TABLE IF EXISTS `vyp_mision_pasajes`;
CREATE TABLE `vyp_mision_pasajes` (
  `id_mision_pasajes` int(11) NOT NULL,
  `nr` varchar(5) NOT NULL,
  `nombre_empleado` varchar(30) NOT NULL,
  `nr_jefe_inmediato` varchar(5) NOT NULL,
  `nr_jefe_regional` varchar(5) NOT NULL,
  `aprobado1` datetime NOT NULL,
  `aprobado2` datetime NOT NULL,
  `aprobado3` datetime NOT NULL,
  `estado` int(10) NOT NULL,
  `ruta_justificacion` varchar(200) NOT NULL,
  `ultima_observacion` date NOT NULL,
  `mes_pasaje` int(2) UNSIGNED ZEROFILL NOT NULL,
  `anio_pasaje` int(4) NOT NULL,
  `fecha_solicitud_pasaje` datetime NOT NULL,
  `fechas_pasajes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_mision_pasajes`
--
ALTER TABLE `vyp_mision_pasajes`
  ADD PRIMARY KEY (`id_mision_pasajes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_mision_pasajes`
--
ALTER TABLE `vyp_mision_pasajes`
  MODIFY `id_mision_pasajes` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
