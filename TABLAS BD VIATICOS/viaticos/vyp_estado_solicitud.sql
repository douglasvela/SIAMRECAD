-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-02-2018 a las 22:27:10
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
-- Estructura de tabla para la tabla `vyp_estado_solicitud`
--

DROP TABLE IF EXISTS `vyp_estado_solicitud`;
CREATE TABLE `vyp_estado_solicitud` (
  `id_estado_solicitud` int(10) UNSIGNED NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_estado_solicitud`
--

INSERT INTO `vyp_estado_solicitud` (`id_estado_solicitud`, `nombre_estado`) VALUES
(0, 'Incompleta'),
(1, 'Revisión jefe inmediato'),
(2, 'Observaciones del jefe inmediato'),
(3, 'Revisión del director o jefe de regional'),
(4, 'Observaciones del director o jefe de regional'),
(5, 'Revisión del Fondo Circulante del Monto Fijo'),
(6, 'Observaciones del Fondo Circulante del Monto Fijo'),
(7, 'Aprobada'),
(8, 'Pagada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_estado_solicitud`
--
ALTER TABLE `vyp_estado_solicitud`
  ADD PRIMARY KEY (`id_estado_solicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_estado_solicitud`
--
ALTER TABLE `vyp_estado_solicitud`
  MODIFY `id_estado_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
