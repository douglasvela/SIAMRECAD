-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 29-10-2017 a las 19:29:40
-- Versión del servidor: 5.7.19-0ubuntu0.17.04.1
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
-- Estructura de tabla para la tabla `vyp_oficinas_telefono`
--

CREATE TABLE `vyp_oficinas_telefono` (
  `id_vyp_oficinas_telefono` int(11) NOT NULL,
  `telefono_vyp_oficnas_telefono` varchar(9) NOT NULL,
  `id_oficina_vyp_oficnas_telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_oficinas_telefono`
--

INSERT INTO `vyp_oficinas_telefono` (`id_vyp_oficinas_telefono`, `telefono_vyp_oficnas_telefono`, `id_oficina_vyp_oficnas_telefono`) VALUES
(1, '7525-9130', 1),
(2, '4355-3451', 1),
(4, '6545-5255', 5),
(5, '2323-4343', 5),
(9, '7331-1111', 3),
(10, '2222-1113', 4),
(11, '2344-3333', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_oficinas_telefono`
--
ALTER TABLE `vyp_oficinas_telefono`
  ADD PRIMARY KEY (`id_vyp_oficinas_telefono`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_oficinas_telefono`
--
ALTER TABLE `vyp_oficinas_telefono`
  MODIFY `id_vyp_oficinas_telefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
