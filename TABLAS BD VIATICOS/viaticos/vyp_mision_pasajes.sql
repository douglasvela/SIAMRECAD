-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2018 a las 17:10:27
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
-- Estructura de tabla para la tabla `vyp_mision_pasajes`
--

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
-- Volcado de datos para la tabla `vyp_mision_pasajes`
--

INSERT INTO `vyp_mision_pasajes` (`id_mision_pasajes`, `nr`, `nombre_empleado`, `nr_jefe_inmediato`, `nr_jefe_regional`, `aprobado1`, `aprobado2`, `aprobado3`, `estado`, `ruta_justificacion`, `ultima_observacion`, `mes_pasaje`, `anio_pasaje`, `fecha_solicitud_pasaje`, `fechas_pasajes`) VALUES
(1, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '2018-04-11', 04, 2018, '0000-00-00 00:00:00', ''),
(2, '335C', 'ABEL CABRERA ROMAN', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00', 04, 2018, '2018-04-17 09:07:44', ' 11-04-2018,16-04-2018,16-04-2018,');

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
  MODIFY `id_mision_pasajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
