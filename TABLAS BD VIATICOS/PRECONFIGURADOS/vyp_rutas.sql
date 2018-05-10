-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2018 a las 07:45:55
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
-- Estructura de tabla para la tabla `vyp_rutas`
--

DROP TABLE IF EXISTS `vyp_rutas`;
CREATE TABLE `vyp_rutas` (
  `id_vyp_rutas` int(11) NOT NULL,
  `id_oficina_origen_vyp_rutas` int(11) NOT NULL,
  `id_oficina_destino_vyp_rutas` int(11) DEFAULT NULL,
  `id_departamento_vyp_rutas` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `id_municipio_vyp_rutas` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `km_vyp_rutas` float(10,2) NOT NULL,
  `descripcion_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `latitud_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `longitud_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `opcionruta_vyp_rutas` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_rutas`
--

INSERT INTO `vyp_rutas` (`id_vyp_rutas`, `id_oficina_origen_vyp_rutas`, `id_oficina_destino_vyp_rutas`, `id_departamento_vyp_rutas`, `id_municipio_vyp_rutas`, `km_vyp_rutas`, `descripcion_destino_vyp_rutas`, `latitud_destino_vyp_rutas`, `longitud_destino_vyp_rutas`, `opcionruta_vyp_rutas`) VALUES
(1, 1, 8, 00001, 00001, 96.15, 'Oficina Central - Oficina Ahuachapán', '', '', 'destino_oficina'),
(2, 1, 3, 00002, 00013, 65.69, 'Oficina Central - Oficina Santa Ana', '', '', 'destino_oficina'),
(3, 1, 6, 00003, 00026, 66.36, 'Oficina Central - Oficina Sonsonate', '', '', 'destino_oficina'),
(4, 1, 11, 00005, 00075, 15.71, 'Oficina Central - Oficina La Libertad', '', '', 'destino_oficina'),
(5, 1, 10, 00007, 00116, 31.41, 'Oficina Central - Oficina Cuscatlán', '', '', 'destino_oficina'),
(6, 1, 4, 00008, 00132, 62.08, 'Oficina Central - Oficina La Paz', '', '', 'destino_oficina'),
(7, 1, 9, 00009, 00154, 80.18, 'Oficina Central - Oficina Cabañas', '', '', 'destino_oficina'),
(8, 1, 12, 00010, 00163, 55.81, 'Oficina Central - Oficina San Vicente', '', '', 'destino_oficina'),
(9, 1, 5, 00011, 00176, 113.17, 'Oficina Central - Oficina Usulután', '', '', 'destino_oficina'),
(10, 1, 2, 00012, 00199, 132.04, 'Oficina Central - Oficina San Miguel', '', '', 'destino_oficina'),
(11, 1, 7, 00014, 00245, 176.84, 'Oficina Central - Oficina La Unión', '', '', 'destino_oficina');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_rutas`
--
ALTER TABLE `vyp_rutas`
  ADD PRIMARY KEY (`id_vyp_rutas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_rutas`
--
ALTER TABLE `vyp_rutas`
  MODIFY `id_vyp_rutas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
