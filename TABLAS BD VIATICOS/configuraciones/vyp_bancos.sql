-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2017 a las 19:27:24
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.0.22

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
-- Estructura de tabla para la tabla `cvr_bancos`
--

CREATE TABLE `vyp_bancos` (
  `id_banco` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `caracteristicas` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cvr_bancos`
--

INSERT INTO `cvr_bancos` (`id_banco`, `nombre`, `caracteristicas`) VALUES
(2, 'Agricola S.A de C', 'PERTENECE A EL SALVADOR CON PARTE EN COL'),
(3, 'CUSCATLAN', 'ALGUNOS EMPLEADOS USAN ESTE BANCO'),
(4, 'DAVIVIENDA', 'FORMA PARTE DE LAS PLANILLAS'),
(5, 'BANCOVI', 'BANCO PARA EMPLEADOS'),
(6, 'BANCO LA FINCA', 'BANCO FINCA DE EL SALVADOR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cvr_bancos`
--
ALTER TABLE `cvr_bancos`
  ADD PRIMARY KEY (`id_banco`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
