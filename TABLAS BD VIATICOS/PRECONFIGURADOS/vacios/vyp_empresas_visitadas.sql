-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2018 a las 07:43:59
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
-- Estructura de tabla para la tabla `vyp_empresas_visitadas`
--

DROP TABLE IF EXISTS `vyp_empresas_visitadas`;
CREATE TABLE `vyp_empresas_visitadas` (
  `id_empresas_visitadas` int(10) UNSIGNED NOT NULL,
  `id_mision_oficial` int(10) UNSIGNED NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_municipio` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(200) NOT NULL,
  `tipo_destino` varchar(45) NOT NULL,
  `origen` varchar(100) NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_llegada` time NOT NULL,
  `viaticos` float NOT NULL,
  `pasajes` float NOT NULL,
  `kilometraje` float NOT NULL,
  `justificacion` varchar(500) NOT NULL,
  `orden` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_empresas_visitadas`
--
ALTER TABLE `vyp_empresas_visitadas`
  ADD PRIMARY KEY (`id_empresas_visitadas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_empresas_visitadas`
--
ALTER TABLE `vyp_empresas_visitadas`
  MODIFY `id_empresas_visitadas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
