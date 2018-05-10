-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2018 a las 06:16:50
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

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
  `opcionruta_vyp_rutas` varchar(35) NOT NULL,
  `nombre_empresa_vyp_rutas` varchar(200) NOT NULL,
  `direccion_empresa_vyp_rutas` varchar(400) NOT NULL,
  `estado_vyp_rutas` tinyint(1) NOT NULL
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
