-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2018 a las 17:58:33
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Estructura de tabla para la tabla `vyp_observaciones_pasajes`
--

CREATE TABLE `vyp_observaciones_pasajes` (
  `id_observacion_pasaje` int(10) UNSIGNED NOT NULL,
  `id_mision_pasajes` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(150) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `corregido` tinyint(1) NOT NULL,
  `nr_observador` varchar(5) NOT NULL,
  `id_tipo_observador` int(10) UNSIGNED NOT NULL,
  `tipo_observador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_observaciones_pasajes`
--

INSERT INTO `vyp_observaciones_pasajes` (`id_observacion_pasaje`, `id_mision_pasajes`, `observacion`, `fecha_hora`, `corregido`, `nr_observador`, `id_tipo_observador`, `tipo_observador`) VALUES
(2, 3, 'otra observacion', '2018-03-27 12:54:05', 0, '988C', 1, 'Jefe inmediato'),
(3, 3, 'nueva observacion', '2018-03-27 12:57:09', 0, '988C', 1, 'Jefe inmediato');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_observaciones_pasajes`
--
ALTER TABLE `vyp_observaciones_pasajes`
  ADD PRIMARY KEY (`id_observacion_pasaje`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
