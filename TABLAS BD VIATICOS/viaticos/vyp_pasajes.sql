-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2018 a las 18:04:07
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
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_pasajes`
--

INSERT INTO `vyp_pasajes` (`id_solicitud_pasaje`, `id_municipio`, `id_departamento`, `fecha_mision`, `no_expediente`, `empresa_visitada`, `direccion_empresa`, `nr`, `monto_pasaje`, `id_actividad_realizada`, `estado`) VALUES
(27, 00045, 00004, '2018-04-18', '22222', 'asdfg', 'ddddd', '561C', 1.50, 2, 0),
(28, 00045, 00003, '2018-04-20', '222', 'eeeee', 'rrrrr', '2585', 0.50, 3, 0),
(29, 00045, 00002, '2018-04-20', '23', 'asdfg', 'asdv', '335C', 0.50, 1, 0),
(30, 00045, 00005, '2018-04-18', '123', '12qwww', 'cerca de casa', '335C', 1.50, 2, 1),
(31, 00045, 00002, '2018-04-16', '23', 'AAS', 'AAA', '335C', 2.00, 3, 1),
(32, 00027, 00003, '2018-04-19', '2', 'aaa', 'aaa', '335C', 1.00, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_pasajes`
--
ALTER TABLE `vyp_pasajes`
  ADD PRIMARY KEY (`id_solicitud_pasaje`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
