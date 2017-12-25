-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-12-2017 a las 21:43:03
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
<<<<<<< HEAD
=======
-- Volcado de datos para la tabla `vyp_oficinas`
--

INSERT INTO `vyp_oficinas` (`id_oficina`, `nombre_oficina`, `direccion_oficina`, `jefe_oficina`, `email_oficina`, `latitud_oficina`, `longitud_oficina`, `id_departamento`, `id_municipio`) VALUES
(1, 'Oficina Central', 'primera direccion', '', 'sdfdf@fdfdf.com', '13.705542923582362', ' -89.20029401779175', 00012, 211),
(2, 'Oficina Paracentral', 'segunda direeccion', 'Willian Rivera', 'sdfdsf@dsfdsf.com', '13.641253371576248', ' -88.78463745117188', 00005, 93),
(3, 'Oficina regional de occidente', 'dsfsdfdsfds', 'Paz Alvarado', 'sdfdsf@dsfdsf.com', '13.995933662977752', ' -89.55837965011597', 00005, 77);

--
-- Índices para tablas volcadas
--

--
>>>>>>> 851904da3d287facf19bf1248a4534477c87c8ed
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
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
