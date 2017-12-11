-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-12-2017 a las 05:50:27
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
-- Estructura de tabla para la tabla `vyp_rutas`
--

CREATE TABLE `vyp_rutas` (
  `id_vyp_rutas` int(11) NOT NULL,
  `id_oficina_origen_vyp_rutas` int(11) NOT NULL,
  `id_oficina_destino_vyp_rutas` int(11) DEFAULT NULL,
  `id_departamento_vyp_rutas` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `id_municipio_vyp_rutas` int(11) DEFAULT NULL,
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
(22, 1, 2, 00000, 0, 100.00, 'destino oficina', '', '', 'destino_oficina'),
(23, 1, 0, 00001, 9, 120.00, 'destino municipio', '', '', 'destino_municipio'),
(24, 3, 0, 00001, 12, 334.00, 'destino mapa', '13.97199560155885', ' -89.75115395151079', 'destino_mapa'),
(25, 4, 2, 00000, 0, 34.00, 'otro destino oficina', '', '', 'destino_oficina'),
(26, 1, 0, 00014, 253, 40.00, 'otra ruta mapa', '13.799018213299096', ' -87.89583778940141', 'destino_mapa'),
(27, 5, 0, 00012, 211, 34.00, 'otro de municipio', '', '', 'destino_municipio'),
(28, 1, 6, 00000, 0, 4.00, 'dd', '', '', 'destino_oficina'),
(29, 1, 0, 00012, 208, 3.00, 'ddd', '13.539812599756564', ' -88.27349281869829', 'destino_mapa'),
(30, 2, 6, 00000, 0, 4.00, 'sdfsdf', '', '', 'destino_oficina'),
(31, 1, 5, 00000, 0, 32.00, 'sd', '', '', 'destino_oficina'),
(32, 2, 4, 00000, 0, 23.00, 'dsf', '', '', 'destino_oficina');

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
  MODIFY `id_vyp_rutas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
