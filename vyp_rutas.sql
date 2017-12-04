-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-12-2017 a las 20:41:45
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
  `id_oficina_destino_vyp_rutas` int(11) NOT NULL,
  `id_departamento_vyp_rutas` int(11) NOT NULL,
  `id_municipio_vyp_rutas` int(11) NOT NULL,
  `km_vyp_rutas` float(10,2) NOT NULL,
  `descripcion_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `latitud_vyp_rutas` varchar(200) DEFAULT NULL,
  `longitud_vyp_rutas` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id_vyp_rutas` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
