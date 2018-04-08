-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2018 a las 05:35:28
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
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_pasajes`
--

INSERT INTO `vyp_pasajes` (`id_solicitud_pasaje`, `id_municipio`, `id_departamento`, `fecha_mision`, `no_expediente`, `empresa_visitada`, `direccion_empresa`, `nr`, `monto_pasaje`, `estado`) VALUES
(1, 00015, 00002, '2018-02-06', '1524454', 'empresa ejemplo', 'direccion empresa', '2588', 0.90, 1),
(2, 00015, 00002, '2018-04-02', '2111', 'empresa1', 'frente a gasolinera', '602C', 0.50, 1);

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
