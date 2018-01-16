-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2018 a las 06:40:34
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
-- Estructura de tabla para la tabla `vyp_horario_viatico`
--

DROP TABLE IF EXISTS `vyp_horario_viatico`;
CREATE TABLE `vyp_horario_viatico` (
  `id_horario_viatico` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_horario_viatico`
--

INSERT INTO `vyp_horario_viatico` (`id_horario_viatico`, `descripcion`, `hora_inicio`, `hora_fin`, `monto`) VALUES
(1, 'Desayuno', '05:00:00', '06:30:00', 3),
(2, 'Almuerzo', '06:31:00', '18:29:00', 4),
(3, 'Cena', '18:30:00', '23:59:00', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
