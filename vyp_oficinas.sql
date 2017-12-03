-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-12-2017 a las 14:35:06
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
-- Estructura de tabla para la tabla `vyp_oficinas`
--

CREATE TABLE `vyp_oficinas` (
  `id_oficina` int(11) NOT NULL,
  `nombre_oficina` varchar(200) NOT NULL,
  `direccion_oficina` varchar(400) NOT NULL,
  `jefe_oficina` varchar(250) NOT NULL,
  `email_oficina` varchar(250) NOT NULL,
  `latitud_oficina` varchar(50) NOT NULL,
  `longitud_oficina` varchar(50) NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_oficinas`
--

INSERT INTO `vyp_oficinas` (`id_oficina`, `nombre_oficina`, `direccion_oficina`, `jefe_oficina`, `email_oficina`, `latitud_oficina`, `longitud_oficina`, `id_departamento`, `id_municipio`) VALUES
(1, 'Oficina Central', 'primera direccion', 'Douglas Recinos', 'sdfdf@fdfdf.com', '13.705542923582362', ' -89.20029401779175', 00011, 183),
(2, 'Oficina Paracentral', 'segunda direeccion', 'Willian Rivera', 'sdfdsf@dsfdsf.com', '13.641253371576248', ' -88.78463745117188', 00005, 93),
(3, 'Oficina regional de occidente', 'dsfsdfdsfds', 'Paz Alvarado', 'sdfdsf@dsfdsf.com', '13.995933662977752', ' -89.55837965011597', 00005, 77),
(4, 'prueba', 'ninguna', 'Paz Alvarado', 'd_Recinos@fdf.com', '13.70745038803979', ' -89.20013576745987', 00010, 174),
(5, 'prueba dos oficna', 'san vicente', 'Douglas Recinos', 'algo@fmail.com', '13.96072323963274', ' -88.11900327913463', 00005, 78),
(6, 'preubaz', 'aklslhjdksa', 'Willian Rivera', 'akdjas@kashdk.com', '13.673176208626606', ' -89.13971096277237', 00002, 15),
(7, 'oficina con depto', 'por ahi', 'Douglas Recinos', 'unjefe@gmail.com', '13.709535030934958', ' -89.21637868828839', 00010, 164);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_oficinas`
--
ALTER TABLE `vyp_oficinas`
  ADD PRIMARY KEY (`id_oficina`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_oficinas`
--
ALTER TABLE `vyp_oficinas`
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
