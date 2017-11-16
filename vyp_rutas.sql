-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-11-2017 a las 23:41:41
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
  `nombre_vyp_rutas` varchar(300) NOT NULL,
  `descr_origen_vyp_rutas` varchar(300) NOT NULL,
  `latitud_origen_vyp_rutas` varchar(50) NOT NULL,
  `longitud_origen_vyp_rutas` varchar(50) NOT NULL,
  `descr_destino_vyp_rutas` varchar(300) NOT NULL,
  `latitud_destino_vyp_rutas` varchar(50) NOT NULL,
  `longitud_destino_vyp_rutas` varchar(50) NOT NULL,
  `distancia_km_vyp_rutas` varchar(15) NOT NULL,
  `tiempo_vyp_rutas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_rutas`
--

INSERT INTO `vyp_rutas` (`id_vyp_rutas`, `nombre_vyp_rutas`, `descr_origen_vyp_rutas`, `latitud_origen_vyp_rutas`, `longitud_origen_vyp_rutas`, `descr_destino_vyp_rutas`, `latitud_destino_vyp_rutas`, `longitud_destino_vyp_rutas`, `distancia_km_vyp_rutas`, `tiempo_vyp_rutas`) VALUES
(3, 'ruta santa - sanvi', 'Calle Dr Francisco Paniagua, San Vicente, El Salvador', '13.640648651718347', ' -88.78228568821214', 'Estaba ASD, Santa Ana, El Salvador', '13.984044761098026', ' -89.55858993111178', '123 km', '1h 54 min');

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
  MODIFY `id_vyp_rutas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
