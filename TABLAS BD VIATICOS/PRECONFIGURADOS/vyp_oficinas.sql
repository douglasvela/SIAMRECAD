-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2018 a las 07:18:05
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
-- Estructura de tabla para la tabla `vyp_oficinas`
--

DROP TABLE IF EXISTS `vyp_oficinas`;
CREATE TABLE `vyp_oficinas` (
  `id_oficina` int(11) NOT NULL,
  `nombre_oficina` varchar(200) NOT NULL,
  `direccion_oficina` varchar(400) NOT NULL,
  `jefe_oficina` varchar(250) NOT NULL,
  `email_oficina` varchar(250) NOT NULL,
  `latitud_oficina` varchar(50) NOT NULL,
  `longitud_oficina` varchar(50) NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_municipio` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_oficinas`
--

INSERT INTO `vyp_oficinas` (`id_oficina`, `nombre_oficina`, `direccion_oficina`, `jefe_oficina`, `email_oficina`, `latitud_oficina`, `longitud_oficina`, `id_departamento`, `id_municipio`) VALUES
(1, 'Oficina Central (San Salvador)', 'Centro de Gobierno, San Salvador, El Salvador', '116 ', 'correo@mtps.gob.sv', '13.705537711909635', ' -89.20028865337372', 00006, 00097),
(2, 'Oficina Regional de Oriente (San Miguel)', 'San Miguel, El Salvador', '218 ', 'correo@mtps.gob.sv', '13.478022085521037', ' -88.17572772502899', 00012, 00199),
(3, 'Oficina Regional de Occidente (Santa Ana)', 'Urbanizacion Pinar, Santa Ana, El Salvador', '1000035 ', 'correo@mtps.gob.sv', '13.995933662977752', ' -89.55837696790695', 00002, 00013),
(4, 'Oficina Paracentral (La Paz)', '3a Av. Sur, Zacatecoluca, La Paz.', '472 ', 'correo@mtps.gob.sv', '13.50745798979771', ' -88.86813461780548', 00008, 00132),
(5, 'Oficina Departamental de Usulután', 'Usulután, El Salvador', '470 ', 'correo@mtps.gob.sv', '13.343002533617929', ' -88.43868026509881', 00011, 00176),
(6, 'Oficina Departamental de Sonsonate', 'Final Res. Rafael Campos, Bulevard Las Palmeras, No.1, Sonsonate.', '197 ', 'correo@mtps.gob.sv', '13.72253757324673', ' -89.7272295691073', 00003, 00026),
(7, 'Oficina Departamental de la Unión', 'La Unión, El Salvador', '761 ', 'correo@mtps.gob.sv', '13.33673891971017', ' -87.84370729699731', 00014, 00245),
(8, 'Oficina Departamental de Ahuachapán', 'Ahuachapán, El Salvador', '458 ', 'correo@mtps.gob.sv', '13.921222237319311', ' -89.84681227477267', 00001, 00001),
(9, 'Oficina Departamental de Cabañas', 'Barrio El Calvario, Sensuntepeque, El Salvador', '57 ', 'correo@mtps.gob.sv', '13.874194385184378', ' -88.63067764788866', 00009, 00154),
(10, 'Oficina Departamental de Cuscatlán', 'Calle Francisco Lopez Oriente, Cojutepeque, El Salvador', '86 ', 'correo@mtps.gob.sv', '13.721834047305459', ' -88.93401478417218', 00007, 00116),
(11, 'Oficina Departamental de la Libertad', 'Residencial Vila Camila, Santa Tecla, El Salvador', '349 ', 'correo@mtps.gob.sv', '13.677131076213042', ' -89.28797140717506', 00005, 00075),
(12, 'Oficina Departamental de San Vicente', '3a Av. Nte. y 5a Calle Pte., San Vicente.', '818 ', 'correo@mtps.gob.sv', '13.64702941077421', ' -88.78594879992306', 00010, 00163);

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
  MODIFY `id_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
