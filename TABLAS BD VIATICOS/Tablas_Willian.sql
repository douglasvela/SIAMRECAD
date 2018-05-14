--
-- Estructura de tabla para la tabla `vyp_alojamientos`
--

DROP TABLE IF EXISTS `vyp_alojamientos`;
CREATE TABLE `vyp_alojamientos` (
  `id_alojamiento` int(10) UNSIGNED NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `fecha_alojamiento` date NOT NULL,
  `monto` float(5,2) NOT NULL,
  `id_ruta_visitada` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_alojamientos`
--

INSERT INTO `vyp_alojamientos` (`id_alojamiento`, `id_mision`, `fecha_alojamiento`, `monto`, `id_ruta_visitada`) VALUES
(15, 14, '2017-01-16', 25.00, 29),
(16, 15, '2017-01-17', 10.00, 32),
(17, 23, '2017-02-06', 25.00, 46),
(21, 24, '2017-02-06', 25.00, 49),
(22, 24, '2017-02-07', 25.00, 49),
(23, 24, '2017-02-08', 25.00, 49),
(42, 30, '2017-02-24', 25.00, 60),
(43, 30, '2017-02-27', 25.00, 60),
(44, 32, '2017-02-08', 10.00, 65),
(45, 32, '2017-02-09', 25.00, 66),
(46, 35, '2017-01-09', 25.00, 72),
(47, 35, '2017-01-10', 25.00, 72),
(48, 35, '2017-01-11', 25.00, 72),
(49, 35, '2017-01-12', 25.00, 72),
(50, 36, '2017-01-23', 25.00, 74),
(51, 38, '2017-01-26', 25.00, 77),
(52, 39, '2017-01-02', 25.00, 80),
(53, 41, '2017-01-16', 25.00, 82),
(54, 41, '2017-01-17', 25.00, 82),
(55, 42, '2017-01-23', 25.00, 86),
(56, 43, '2017-01-11', 25.00, 88),
(57, 43, '2017-01-12', 25.00, 88),
(58, 45, '2017-01-05', 25.00, 92),
(59, 46, '2017-01-17', 25.00, 94),
(60, 46, '2017-01-18', 25.00, 94),
(61, 46, '2017-01-19', 25.00, 94),
(62, 48, '2017-01-17', 25.00, 98),
(63, 48, '2017-01-18', 25.00, 98),
(64, 56, '2017-03-14', 25.00, 114),
(65, 57, '2017-03-28', 25.00, 116),
(66, 57, '2017-03-29', 25.00, 116),
(67, 58, '2017-03-27', 25.00, 118),
(68, 58, '2017-03-28', 25.00, 118),
(69, 59, '2017-03-30', 25.00, 120),
(70, 60, '2017-03-15', 25.00, 122),
(71, 62, '2017-03-30', 25.00, 125),
(72, 63, '2017-03-20', 25.00, 127),
(73, 63, '2017-03-21', 25.00, 127),
(74, 67, '2017-04-05', 25.00, 135),
(75, 67, '2017-04-06', 25.00, 135),
(76, 70, '2017-04-12', 25.00, 141),
(77, 72, '2017-04-17', 10.00, 145),
(78, 72, '2017-04-18', 10.00, 145),
(79, 72, '2017-04-19', 10.00, 145),
(80, 72, '2017-04-20', 10.00, 145),
(81, 78, '2017-04-17', 20.00, 157),
(82, 79, '2017-04-20', 20.00, 159),
(83, 81, '2017-04-06', 25.00, 163),
(86, 86, '2017-05-26', 25.00, 177),
(87, 86, '2017-05-29', 25.00, 177),
(88, 91, '2017-06-13', 25.00, 187),
(89, 91, '2017-06-14', 25.00, 187),
(98, 98, '2017-08-28', 25.00, 201),
(99, 98, '2017-08-29', 25.00, 201),
(100, 102, '2017-08-30', 25.00, 207),
(101, 107, '2017-09-12', 25.00, 217),
(102, 113, '2017-10-25', 25.00, 229),
(103, 114, '2017-10-16', 14.50, 231),
(104, 116, '2017-11-13', 19.95, 235),
(105, 117, '2017-11-23', 20.15, 237),
(106, 121, '2017-12-06', 20.55, 245),
(107, 124, '2017-12-11', 15.55, 251),
(108, 125, '2018-01-29', 15.75, 253),
(109, 128, '2018-01-24', 12.95, 259);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_bancos`
--

DROP TABLE IF EXISTS `vyp_bancos`;
CREATE TABLE `vyp_bancos` (
  `id_banco` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `caracteristicas` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `delimitador` varchar(10) NOT NULL DEFAULT '',
  `archivo` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_bancos`
--

INSERT INTO `vyp_bancos` (`id_banco`, `nombre`, `caracteristicas`, `codigo`, `delimitador`, `archivo`) VALUES
(1, 'Banco Agrícola', '', '127', ';', 'txt'),
(2, 'Banco Cuscatlán', '', '2647', '', ''),
(3, 'Banco Hipotecario', '', '25487', '', ''),
(4, 'Banco Davivienda', '', '7844', '', ''),
(5, 'Banco azul', '', '874', '', ''),
(6, 'Banco Hernandez', '', '54788', '-,', 'txt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_empleado_cuenta_banco`
--

DROP TABLE IF EXISTS `vyp_empleado_cuenta_banco`;
CREATE TABLE `vyp_empleado_cuenta_banco` (
  `id_empleado_banco` int(10) UNSIGNED NOT NULL,
  `nr` varchar(4) NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL,
  `numero_cuenta` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_empleado_cuenta_banco`
--

INSERT INTO `vyp_empleado_cuenta_banco` (`id_empleado_banco`, `nr`, `id_banco`, `numero_cuenta`, `estado`) VALUES
(1, '2588', 1, '7894-457-784-95', 1),
(2, '335C', 2, '0154-488-74-454', 1),
(3, '1462', 3, '0047-7840-0484-764', 1),
(4, '2665', 4, '03457-1819-187-045', 1),
(5, '391C', 5, '8145-417-1575-5', 1),
(6, '2818', 1, '0356-457-4874-457', 1),
(7, '672C', 2, '06464-457-4575-45', 1),
(8, '978C', 3, '034487-545-5454', 1),
(9, '2905', 4, '34541-454-4454-45', 1),
(10, '2788', 5, '21347-54-557-545', 1),
(11, '749C', 1, '06457-487-454-5454', 1),
(12, '2647', 2, '0644-764-545', 1),
(13, '2347', 3, '6564-47451-547-304', 1),
(14, '2781', 4, '9197-1245-5751-456', 1),
(15, '854C', 5, '1867-54518-0848-054', 1),
(16, '772C', 1, '0644-035-5406-045', 1),
(17, '602C', 5, '0514554-457', 1);

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
  `kilometraje` float(5,2) NOT NULL,
  `id_destino` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_empresas_visitadas`
--

INSERT INTO `vyp_empresas_visitadas` (`id_empresas_visitadas`, `id_mision_oficial`, `id_departamento`, `id_municipio`, `nombre_empresa`, `direccion_empresa`, `tipo_destino`, `kilometraje`, `id_destino`) VALUES
(1, 1, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 40.50, '13'),
(2, 2, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 44.00, '14'),
(3, 4, 00001, 00001, 'Garabato SA de CV', 'Calle 9a Av. Luz', 'destino_municipio', 252.00, '1'),
(4, 3, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 58.20, '47'),
(5, 5, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 114.00, '136'),
(6, 6, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 125.00, '78'),
(7, 7, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 38.20, '6'),
(8, 8, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 36.30, '72'),
(9, 9, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 82.90, '140'),
(10, 10, 00006, 00097, 'Empresa en san salvador', 'Pje N1, San Salvador, El Salvador', 'destino_mapa', 63.21, '142'),
(11, 11, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 44.00, '3'),
(12, 12, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 69.80, '93'),
(13, 13, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 80.90, '49'),
(14, 14, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 164.00, '50'),
(15, 16, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 84.80, '65'),
(16, 15, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 48.40, '91'),
(17, 17, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 134.00, '143'),
(18, 18, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 100.00, '42'),
(19, 19, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 58.20, '47'),
(20, 20, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 107.00, '54'),
(21, 21, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 51.50, '102'),
(22, 22, 00001, 00001, 'Centro Escolar en ahuachapán', '12A Calle Oriente, Ahuachapan, El Salvador', 'destino_mapa', 36.12, '145'),
(23, 23, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 128.00, '146'),
(24, 24, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 129.00, '135'),
(25, 25, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 163.00, '88'),
(26, 26, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 131.00, '97'),
(27, 27, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 97.50, '148'),
(28, 28, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 40.50, '12'),
(29, 29, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 125.00, '78'),
(30, 30, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 211.00, '57'),
(31, 31, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 55.20, '77'),
(32, 32, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 161.00, '138'),
(33, 32, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 129.00, '134'),
(34, 34, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 64.30, '36'),
(35, 33, 00004, 00071, 'Empresa en chalatenango', 'Calle Principal, San Miguel de Mercedes, El Salvador', 'destino_mapa', 162.26, '149'),
(36, 35, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 30.40, '17'),
(37, 36, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 37.00, '45'),
(38, 37, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 211.00, '57'),
(39, 38, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 54.60, '18'),
(40, 39, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 100.00, '42'),
(41, 40, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 69.20, '128'),
(42, 41, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 51.50, '102'),
(43, 42, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 200.00, '53'),
(44, 43, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 161.00, '139'),
(45, 44, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 141.00, '95'),
(46, 45, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 120.00, '104'),
(47, 46, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 69.30, '35'),
(48, 47, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 98.30, '81'),
(49, 48, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 161.00, '139'),
(50, 49, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 37.00, '44'),
(51, 50, 00002, 00016, 'Centro de Recreación \'Constitución 1950\', Santa Ana, El Salvador', 'SAN24E, El Salvador', 'destino_mapa', 93.45, '150'),
(52, 51, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 54.60, '18'),
(53, 52, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 36.30, '73'),
(54, 53, 00003, 00041, 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 'destino_oficina', 211.00, '56'),
(55, 54, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 225.00, '108'),
(56, 55, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 38.20, '5'),
(57, 56, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 128.00, '146'),
(58, 57, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 231.00, '83'),
(59, 58, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 64.30, '37'),
(60, 59, 00003, 00041, 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 'destino_oficina', 44.00, '15'),
(61, 60, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 40.50, '12'),
(62, 61, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 98.80, '100'),
(63, 62, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 91.50, '130'),
(64, 63, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 100.00, '42'),
(65, 64, 00003, 00041, 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 'destino_oficina', 63.60, '38'),
(66, 65, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 37.00, '44'),
(67, 66, 00003, 00041, 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 'destino_oficina', 211.00, '56'),
(68, 67, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 138.00, '106'),
(69, 68, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 128.00, '146'),
(70, 69, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 24.20, '125'),
(71, 70, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 55.20, '76'),
(72, 71, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 125.00, '69'),
(73, 72, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 36.30, '72'),
(74, 73, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 82.90, '140'),
(75, 74, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 63.60, '39'),
(76, 75, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 55.20, '77'),
(77, 76, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 134.00, '143'),
(78, 77, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 30.40, '17'),
(79, 78, 00004, 00042, 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Chalatenango', 'destino_oficina', 108.00, '22'),
(80, 79, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 147.00, '66'),
(81, 80, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 36.30, '73'),
(82, 81, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 206.00, '40'),
(83, 82, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 30.40, '17'),
(84, 83, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 134.00, '113'),
(85, 84, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 129.00, '134'),
(86, 85, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 37.00, '45'),
(87, 86, 00003, 00041, 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 'destino_oficina', 44.00, '15'),
(88, 87, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 24.20, '125'),
(89, 88, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 101.00, '60'),
(90, 89, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 44.00, '3'),
(91, 90, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 58.20, '47'),
(92, 91, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 125.00, '79'),
(93, 92, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 175.00, '133'),
(94, 93, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 48.60, '123'),
(95, 94, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 101.00, '61'),
(96, 95, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 37.00, '44'),
(97, 96, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 58.20, '47'),
(98, 97, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 38.20, '5'),
(99, 98, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 85.20, '114'),
(100, 99, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 55.20, '76'),
(101, 100, 00010, 00163, 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 'destino_oficina', 58.20, '46'),
(103, 102, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 44.00, '3'),
(104, 103, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 37.00, '45'),
(105, 104, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 64.30, '37'),
(106, 105, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 145.00, '86'),
(107, 106, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 85.20, '115'),
(108, 107, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 244.00, '70'),
(109, 108, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 174.00, '62'),
(110, 109, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 211.00, '57'),
(111, 110, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 58.20, '47'),
(112, 111, 00001, 00001, 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Ahuachapán', 'destino_oficina', 155.00, '117'),
(113, 112, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 69.30, '35'),
(114, 113, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 231.00, '82'),
(115, 114, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 98.80, '100'),
(116, 115, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 174.00, '63'),
(117, 116, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 206.00, '41'),
(118, 117, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 69.30, '34'),
(119, 118, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 104.00, '75'),
(120, 119, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 161.00, '138'),
(121, 120, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 163.00, '89'),
(122, 121, 00005, 00075, 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 'destino_oficina', 30.40, '17'),
(123, 122, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 107.00, '54'),
(124, 123, 00007, 00116, 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Cuscatlán', 'destino_oficina', 98.80, '100'),
(125, 124, 00013, 00219, 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 'destino_oficina', 114.00, '136'),
(126, 125, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 84.80, '65'),
(127, 126, 00008, 00132, 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 'destino_oficina', 125.00, '68'),
(128, 127, 00014, 00245, 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 'destino_oficina', 145.00, '86'),
(129, 128, 00003, 00041, 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 'destino_oficina', 44.00, '15'),
(130, 129, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 135.00, '67'),
(131, 129, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 200.00, '52'),
(132, 130, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 135.00, '33'),
(133, 131, 00006, 00097, 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 'destino_oficina', 135.00, '67'),
(134, 132, 00012, 00199, 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 'destino_oficina', 135.00, '33'),
(135, 133, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 69.30, '34'),
(136, 134, 00002, 00013, 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 'destino_oficina', 69.30, '34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_empresa_viatico`
--

DROP TABLE IF EXISTS `vyp_empresa_viatico`;
CREATE TABLE `vyp_empresa_viatico` (
  `id_empresa_viatico` int(10) UNSIGNED NOT NULL,
  `id_origen` varchar(5) NOT NULL,
  `id_destino` varchar(5) NOT NULL,
  `nombre_origen` varchar(250) NOT NULL,
  `nombre_destino` varchar(250) NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_llegada` time NOT NULL,
  `pasaje` float(3,2) NOT NULL,
  `viatico` float(5,2) NOT NULL,
  `alojamiento` float(5,2) NOT NULL,
  `horarios_viaticos` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `factura` varchar(45) NOT NULL,
  `kilometraje` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_empresa_viatico`
--

INSERT INTO `vyp_empresa_viatico` (`id_empresa_viatico`, `id_origen`, `id_destino`, `nombre_origen`, `nombre_destino`, `hora_salida`, `hora_llegada`, `pasaje`, `viatico`, `alojamiento`, `horarios_viaticos`, `fecha`, `id_mision`, `factura`, `kilometraje`) VALUES
(1, '00002', '13', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Morazán', '05:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-01-03', 1, '', 40.50),
(2, '13', '00002', 'Oficina Departamental de Morazán', 'Oficina Regional de Oriente (San Miguel)', '15:00:00', '16:00:00', 0.00, 4.00, 0.00, '', '2017-01-03', 1, '', 40.50),
(3, '00005', '14', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-01-04', 2, '', 44.00),
(4, '14', '00005', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Sonsonate', '16:00:00', '17:00:00', 0.00, 4.00, 0.00, '', '2017-01-04', 2, '', 44.00),
(5, '00002', '1', 'Oficina Regional de Oriente (San Miguel)', 'Garabato SA de CV (Ahuachapan/Ahuachapán)', '09:00:00', '11:15:00', 3.00, 0.00, 0.00, '', '2017-01-18', 4, '', 252.00),
(7, '00010', '47', 'Oficina Departamental de San Vicente', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-01-09', 3, '', 58.20),
(8, '47', '00010', 'Oficina Central (San Salvador)', 'Oficina Departamental de San Vicente', '17:00:00', '18:00:00', 0.00, 4.00, 0.00, '', '2017-01-09', 3, '', 58.20),
(9, '00010', '136', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Morazán', '06:00:00', '10:00:00', 0.00, 3.00, 0.00, '', '2017-01-16', 5, '', 114.00),
(10, '1', '00002', 'Garabato SA de CV (Ahuachapan/Ahuachapán)', 'Oficina Regional de Oriente (San Miguel)', '13:00:00', '14:00:00', 3.00, 4.00, 0.00, '', '2017-01-18', 4, '', 252.00),
(11, '136', '00010', 'Oficina Departamental de Morazán', 'Oficina Departamental de San Vicente', '17:00:00', '19:00:00', 0.00, 8.00, 0.00, '', '2017-01-16', 5, '', 114.00),
(12, '00003', '78', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de San Vicente', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2018-03-28', 6, '', 125.00),
(13, '78', '00003', 'Oficina Departamental de San Vicente', 'Oficina Regional de Occidente (Santa Ana)', '17:00:00', '19:00:00', 0.00, 8.00, 0.00, '', '2018-03-28', 6, '', 125.00),
(14, '00004', '6', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de San Vicente', '06:06:00', '07:00:00', 0.35, 3.00, 0.00, '', '2017-01-23', 7, '', 38.20),
(15, '6', '00004', 'Oficina Departamental de San Vicente', 'Oficina Paracentral (La Paz)', '10:00:00', '11:00:00', 0.35, 0.00, 0.00, '', '2017-01-23', 7, '', 38.20),
(16, '00003', '72', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Ahuachapán', '06:00:00', '07:00:00', 0.70, 3.00, 0.00, '', '2017-01-18', 8, '', 36.30),
(17, '72', '00003', 'Oficina Departamental de Ahuachapán', 'Oficina Regional de Occidente (Santa Ana)', '13:00:00', '14:00:00', 0.70, 4.00, 0.00, '', '2017-01-18', 8, '', 36.30),
(18, '00012', '140', 'Oficina Departamental de Morazán', 'Oficina Departamental de la Unión', '06:00:00', '07:00:00', 1.70, 3.00, 0.00, '', '2017-01-26', 9, '', 82.90),
(19, '140', '00012', 'Oficina Departamental de la Unión', 'Oficina Departamental de Morazán', '17:00:00', '19:00:00', 1.70, 8.00, 0.00, '', '2017-01-26', 9, '', 82.90),
(20, '00005', '3', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Ahuachapán', '06:00:00', '07:00:00', 2.00, 3.00, 0.00, '', '2017-01-19', 11, '', 44.00),
(21, '3', '00005', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Sonsonate', '13:00:00', '14:00:00', 2.00, 4.00, 0.00, '', '2017-01-19', 11, '', 44.00),
(22, '00005', '142', 'Oficina Departamental de Sonsonate', 'Empresa en san salvador (San salvador/San salvador)', '05:00:00', '06:30:00', 0.90, 3.00, 0.00, '', '2017-01-03', 10, '', 63.21),
(23, '00009', '93', 'Oficina Departamental de la Libertad', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-01-30', 12, '', 69.80),
(24, '93', '00009', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de la Libertad', '15:00:00', '17:00:00', 7.00, 4.00, 0.00, '', '2017-01-30', 12, '', 69.80),
(25, '00011', '49', 'Oficina Departamental de Chalatenango', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-01-31', 13, '', 80.90),
(26, '49', '00011', 'Oficina Central (San Salvador)', 'Oficina Departamental de Chalatenango', '17:00:00', '20:00:00', 2.00, 8.00, 0.00, '', '2017-01-31', 13, '', 80.90),
(27, '142', '00005', 'Empresa en san salvador (San salvador/San salvador)', 'Oficina Departamental de Sonsonate', '14:00:00', '15:30:00', 0.90, 4.00, 0.00, '', '2017-01-03', 10, '', 63.21),
(28, '00001', '50', 'Oficina Central (San Salvador)', 'Oficina Departamental de Morazán', '05:00:00', '09:00:00', 1.00, 3.00, 0.00, '', '2017-01-16', 14, '', 164.00),
(29, '50', '00001', 'Oficina Departamental de Morazán', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 1.00, 11.00, 25.00, '', '2017-01-17', 14, '0000029.png', 164.00),
(30, '00010', '65', 'Oficina Departamental de San Vicente', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '08:00:00', 1.50, 3.00, 0.00, '', '2017-01-20', 16, '', 84.80),
(31, '00008', '91', 'Oficina Departamental de Cuscatlán', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 0.00, 3.00, 25.00, '', '2017-01-17', 15, '', 48.40),
(32, '00008', '91', 'Oficina Departamental de Cuscatlán', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 1.00, 11.00, 10.00, '', '2017-01-18', 15, '0000032.png', 48.40),
(33, '65', '00010', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de San Vicente', '13:00:00', '15:15:00', 1.50, 4.00, 0.00, '', '2017-01-20', 16, '', 84.80),
(34, '00006', '143', 'Oficina Departamental de la Unión', 'Oficina Departamental de Cuscatlán', '10:00:00', '14:00:00', 3.00, 4.00, 10.00, '', '2017-01-25', 17, '', 134.00),
(35, '143', '00006', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de la Unión', '16:00:00', '18:00:00', 2.00, 0.00, 0.00, '', '2017-01-25', 17, '', 134.00),
(36, '00007', '42', 'Oficina Departamental de Ahuachapán', 'Oficina Central (San Salvador)', '06:00:00', '09:00:00', 0.00, 3.00, 0.00, '', '2017-01-06', 18, '', 100.00),
(37, '42', '00007', 'Oficina Central (San Salvador)', 'Oficina Departamental de Ahuachapán', '13:00:00', '14:00:00', 0.00, 4.00, 0.00, '', '2017-01-06', 18, '', 100.00),
(38, '00010', '47', 'Oficina Departamental de San Vicente', 'Oficina Central (San Salvador)', '08:00:00', '09:30:00', 0.90, 0.00, 0.00, '', '2017-01-12', 19, '', 58.20),
(39, '47', '00010', 'Oficina Central (San Salvador)', 'Oficina Departamental de San Vicente', '12:00:00', '13:30:00', 0.90, 4.00, 0.00, '', '2017-01-12', 19, '', 58.20),
(40, '00002', '54', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Paracentral (La Paz)', '06:00:00', '09:00:00', 3.00, 3.00, 0.00, '', '2017-02-01', 20, '', 107.00),
(41, '54', '00002', 'Oficina Paracentral (La Paz)', 'Oficina Regional de Oriente (San Miguel)', '13:00:00', '15:00:00', 3.00, 4.00, 0.00, '', '2017-02-01', 20, '', 107.00),
(42, '00005', '102', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de la Libertad', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-02-02', 21, '', 51.50),
(43, '102', '00005', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Sonsonate', '17:00:00', '19:00:00', 0.00, 8.00, 0.00, '', '2017-02-02', 21, '', 51.50),
(44, '00003', '145', 'Oficina Regional de Occidente (Santa Ana)', 'Centro Escolar en ahuachapán (Ahuachapan/Ahuachapán)', '06:00:00', '07:00:00', 0.60, 3.00, 0.00, '', '2017-01-25', 22, '', 36.12),
(45, '00010', '146', 'Oficina Departamental de San Vicente', 'Oficina Departamental de la Unión', '06:00:00', '10:00:00', 3.00, 3.00, 0.00, '', '2017-02-06', 23, '', 128.00),
(46, '146', '00010', 'Oficina Departamental de la Unión', 'Oficina Departamental de San Vicente', '06:00:00', '10:00:00', 2.00, 11.00, 25.00, '', '2017-02-07', 23, '0000046.png', 128.00),
(47, '145', '00003', 'Centro Escolar en ahuachapán (Ahuachapan/Ahuachapán)', 'Oficina Regional de Occidente (Santa Ana)', '14:00:00', '15:00:00', 0.60, 4.00, 0.00, '', '2017-01-25', 22, '', 36.12),
(48, '00010', '135', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Chalatenango', '06:00:00', '09:00:00', 4.00, 3.00, 0.00, '', '2017-02-06', 24, '', 129.00),
(49, '135', '00010', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de San Vicente', '06:00:00', '09:00:00', 4.00, 33.00, 75.00, '', '2017-02-09', 24, '0000049.png', 129.00),
(50, '00004', '97', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de Morazán', '06:00:00', '10:00:00', 3.00, 3.00, 0.00, '', '2017-02-09', 26, '', 131.00),
(51, '97', '00004', 'Oficina Departamental de Morazán', 'Oficina Paracentral (La Paz)', '17:00:00', '19:00:00', 3.00, 8.00, 0.00, '', '2017-02-09', 26, '', 131.00),
(52, '00004', '88', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de Ahuachapán', '06:00:00', '07:00:00', 2.35, 3.00, 0.00, '', '2017-01-10', 25, '', 163.00),
(53, '88', '00004', 'Oficina Departamental de Ahuachapán', 'Oficina Paracentral (La Paz)', '15:00:00', '17:00:00', 2.30, 4.00, 0.00, '', '2017-01-10', 25, '', 163.00),
(54, '00003', '148', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Chalatenango', '05:00:00', '09:00:00', 5.00, 3.00, 0.00, '', '2017-02-13', 27, '', 97.50),
(55, '148', '00003', 'Oficina Departamental de Chalatenango', 'Oficina Regional de Occidente (Santa Ana)', '16:00:00', '18:00:00', 4.00, 4.00, 0.00, '', '2017-02-13', 27, '', 97.50),
(56, '00012', '12', 'Oficina Departamental de Morazán', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '08:00:00', 4.00, 3.00, 0.00, '', '2017-02-21', 28, '', 40.50),
(57, '12', '00012', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Morazán', '18:00:00', '19:00:00', 3.00, 8.00, 0.00, '', '2017-02-21', 28, '', 40.50),
(58, '00003', '78', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de San Vicente', '05:00:00', '06:45:00', 1.25, 3.00, 0.00, '', '2017-01-20', 29, '', 125.00),
(59, '00005', '57', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-02-24', 30, '', 211.00),
(60, '57', '00005', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Sonsonate', '05:00:00', '09:00:00', 7.00, 22.00, 50.00, '', '2017-02-28', 30, '0000060.png', 211.00),
(61, '00009', '77', 'Oficina Departamental de la Libertad', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-02-27', 31, '', 55.20),
(62, '00003', '78', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de San Vicente', '16:00:00', '17:15:00', 1.25, 4.00, 0.00, '', '2017-01-20', 29, '', 125.00),
(63, '77', '00009', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de la Libertad', '16:00:00', '18:00:00', 2.00, 4.00, 0.00, '', '2017-02-27', 31, '', 55.20),
(64, '00011', '138', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Morazán', '05:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-02-08', 32, '', 161.00),
(65, '138', '134', 'Oficina Departamental de Morazán', 'Oficina Departamental de San Vicente', '06:00:00', '09:00:00', 5.00, 11.00, 10.00, '', '2017-02-09', 32, '0000065.png', 129.00),
(66, '134', '00011', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Chalatenango', '06:00:00', '09:00:00', 7.00, 11.00, 25.00, '', '2017-02-10', 32, '0000066.png', 129.00),
(67, '00001', '36', 'Oficina Central (San Salvador)', 'Oficina Paracentral (La Paz)', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-02-28', 34, '', 64.30),
(68, '36', '00001', 'Oficina Paracentral (La Paz)', 'Oficina Central (San Salvador)', '17:00:00', '19:00:00', 6.00, 8.00, 0.00, '', '2017-02-28', 34, '', 64.30),
(69, '00012', '149', 'Oficina Departamental de Morazán', 'Empresa en chalatenango (San miguel de mercedes/Chalatenango)', '06:00:00', '08:30:00', 1.75, 3.00, 0.00, '', '2017-01-09', 33, '', 162.26),
(70, '00001', '17', 'Oficina Central (San Salvador)', 'Oficina Departamental de la Libertad', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-01-09', 35, '', 30.40),
(71, '149', '00012', 'Empresa en chalatenango (San miguel de mercedes/Chalatenango)', 'Oficina Departamental de Morazán', '13:10:00', '14:15:00', 1.75, 4.00, 0.00, '', '2017-01-09', 33, '', 162.26),
(72, '17', '00001', 'Oficina Departamental de la Libertad', 'Oficina Central (San Salvador)', '17:00:00', '19:00:00', 7.00, 52.00, 100.00, '', '2017-01-13', 35, '0000072.png', 30.40),
(73, '00008', '45', 'Oficina Departamental de Cuscatlán', 'Oficina Central (San Salvador)', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-01-23', 36, '', 37.00),
(74, '45', '00008', 'Oficina Central (San Salvador)', 'Oficina Departamental de Cuscatlán', '06:00:00', '09:00:00', 7.00, 11.00, 25.00, '', '2017-01-24', 36, '0000074.png', 37.00),
(75, '00006', '18', 'Oficina Departamental de la Unión', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-01-26', 38, '', 54.60),
(76, '00005', '57', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Oriente (San Miguel)', '08:00:00', '10:30:00', 2.33, 0.00, 0.00, '', '2017-01-12', 37, '', 211.00),
(77, '18', '00006', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de la Unión', '14:00:00', '16:00:00', 7.00, 15.00, 25.00, '', '2017-01-27', 38, '0000077.png', 54.60),
(78, '00005', '57', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Oriente (San Miguel)', '15:00:00', '17:30:00', 2.33, 4.00, 0.00, '', '2017-01-12', 37, '', 211.00),
(79, '00007', '42', 'Oficina Departamental de Ahuachapán', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-01-02', 39, '', 100.00),
(80, '42', '00007', 'Oficina Central (San Salvador)', 'Oficina Departamental de Ahuachapán', '17:00:00', '19:00:00', 7.00, 19.00, 25.00, '', '2017-01-03', 39, '0000080.png', 100.00),
(81, '00005', '102', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de la Libertad', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-01-16', 41, '', 51.50),
(82, '102', '00005', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Sonsonate', '06:00:00', '09:00:00', 7.00, 22.00, 50.00, '', '2017-01-18', 41, '0000082.png', 51.50),
(83, '00009', '128', 'Oficina Departamental de la Libertad', 'Oficina Departamental de San Vicente', '06:00:00', '07:30:00', 1.00, 3.00, 0.00, '', '2017-01-10', 40, '', 69.20),
(84, '00003', '53', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-01-23', 42, '', 200.00),
(85, '128', '00009', 'Oficina Departamental de San Vicente', 'Oficina Departamental de la Libertad', '14:00:00', '15:30:00', 1.00, 4.00, 0.00, '', '2017-01-10', 40, '', 69.20),
(86, '53', '00003', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '09:00:00', 7.00, 11.00, 25.00, '', '2017-01-24', 42, '0000086.png', 200.00),
(87, '00012', '139', 'Oficina Departamental de Morazán', 'Oficina Departamental de Chalatenango', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-01-11', 43, '', 161.00),
(88, '139', '00012', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Morazán', '06:00:00', '09:00:00', 7.00, 22.00, 50.00, '', '2017-01-13', 43, '0000088.png', 161.00),
(89, '00011', '95', 'Oficina Departamental de Chalatenango', 'Oficina Paracentral (La Paz)', '05:00:00', '07:30:00', 2.60, 3.00, 0.00, '', '2017-01-18', 44, '', 141.00),
(90, '00005', '104', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de San Vicente', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-01-05', 45, '', 120.00),
(91, '95', '00011', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de Chalatenango', '15:00:00', '17:00:00', 2.60, 4.00, 0.00, '', '2017-01-18', 44, '', 141.00),
(92, '104', '00005', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Sonsonate', '16:00:00', '18:00:00', 7.00, 15.00, 25.00, '', '2017-01-06', 45, '0000092.png', 120.00),
(93, '00003', '35', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-01-17', 46, '', 69.30),
(94, '35', '00003', 'Oficina Central (San Salvador)', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '09:00:00', 7.00, 33.00, 75.00, '', '2017-01-20', 46, '0000094.png', 69.30),
(95, '00011', '81', 'Oficina Departamental de Chalatenango', 'Oficina Regional de Occidente (Santa Ana)', '08:00:00', '10:00:00', 1.65, 0.00, 0.00, '', '2017-01-02', 47, '', 98.30),
(96, '81', '00011', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Chalatenango', '18:00:00', '20:30:00', 0.00, 8.00, 0.00, '', '2017-01-02', 47, '', 98.30),
(97, '00012', '139', 'Oficina Departamental de Morazán', 'Oficina Departamental de Chalatenango', '06:00:00', '09:00:00', 7.00, 3.00, 0.00, '', '2017-01-17', 48, '', 161.00),
(98, '139', '00012', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Morazán', '17:00:00', '19:00:00', 7.00, 30.00, 50.00, '', '2017-01-19', 48, '0000098.png', 161.00),
(99, '00001', '44', 'Oficina Central (San Salvador)', 'Oficina Departamental de Cuscatlán', '06:30:00', '07:15:00', 0.35, 3.00, 0.00, '', '2017-01-25', 49, '', 37.00),
(100, '44', '00001', 'Oficina Departamental de Cuscatlán', 'Oficina Central (San Salvador)', '12:00:00', '13:20:00', 0.35, 4.00, 0.00, '', '2017-01-25', 49, '', 37.00),
(101, '00008', '150', 'Oficina Departamental de Cuscatlán', 'Centro de Recreación \'Constitución 1950\', Santa Ana, El Salvador (Coatepeque/Santa ana)', '06:00:00', '08:30:00', 2.50, 3.00, 0.00, '', '2017-01-06', 50, '', 93.45),
(102, '150', '00008', 'Centro de Recreación \'Constitución 1950\', Santa Ana, El Salvador (Coatepeque/Santa ana)', 'Oficina Departamental de Cuscatlán', '10:00:00', '12:30:00', 2.50, 0.00, 0.00, '', '2017-01-06', 50, '', 93.45),
(103, '00006', '18', 'Oficina Departamental de la Unión', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '08:00:00', 0.75, 3.00, 0.00, '', '2017-01-10', 51, '', 54.60),
(104, '18', '00006', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de la Unión', '14:00:00', '16:00:00', 0.75, 4.00, 0.00, '', '2017-01-10', 51, '', 54.60),
(105, '00007', '73', 'Oficina Departamental de Ahuachapán', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '07:00:00', 0.35, 3.00, 0.00, '', '2017-01-30', 52, '', 36.30),
(106, '73', '00007', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Ahuachapán', '18:00:00', '19:00:00', 0.35, 8.00, 0.00, '', '2017-01-30', 52, '', 36.30),
(107, '00002', '56', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Sonsonate', '06:00:00', '08:00:00', 3.00, 3.00, 0.00, '', '2017-03-06', 53, '', 211.00),
(108, '56', '00002', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Oriente (San Miguel)', '16:00:00', '17:00:00', 3.00, 4.00, 0.00, '', '2017-03-06', 53, '', 211.00),
(109, '00005', '108', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Morazán', '05:00:00', '09:00:00', 4.00, 3.00, 0.00, '', '2017-03-07', 54, '', 225.00),
(110, '108', '00005', 'Oficina Departamental de Morazán', 'Oficina Departamental de Sonsonate', '17:00:00', '20:00:00', 3.00, 8.00, 0.00, '', '2017-03-07', 54, '', 225.00),
(111, '00010', '5', 'Oficina Departamental de San Vicente', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 1.00, 3.00, 0.00, '', '2017-03-08', 55, '', 38.20),
(112, '5', '00010', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de San Vicente', '13:00:00', '14:00:00', 1.00, 4.00, 0.00, '', '2017-03-08', 55, '', 38.20),
(113, '00010', '146', 'Oficina Departamental de San Vicente', 'Oficina Departamental de la Unión', '05:00:00', '08:00:00', 5.00, 3.00, 0.00, '', '2017-03-14', 56, '', 128.00),
(114, '146', '00010', 'Oficina Departamental de la Unión', 'Oficina Departamental de San Vicente', '17:00:00', '20:00:00', 4.00, 19.00, 25.00, '', '2017-03-15', 56, '0000114.png', 128.00),
(115, '00003', '83', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Morazán', '05:00:00', '08:00:00', 6.00, 3.00, 0.00, '', '2017-03-28', 57, '', 231.00),
(116, '83', '00003', 'Oficina Departamental de Morazán', 'Oficina Regional de Occidente (Santa Ana)', '17:00:00', '21:00:00', 4.00, 30.00, 50.00, '', '2017-03-30', 57, '0000116.jpg', 231.00),
(117, '00004', '37', 'Oficina Paracentral (La Paz)', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 5.00, 3.00, 0.00, '', '2017-03-27', 58, '', 64.30),
(118, '37', '00004', 'Oficina Central (San Salvador)', 'Oficina Paracentral (La Paz)', '05:00:00', '08:00:00', 5.00, 22.00, 50.00, '', '2017-03-29', 58, '0000118.jpg', 64.30),
(119, '00003', '15', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Sonsonate', '06:00:00', '08:00:00', 2.00, 3.00, 0.00, '', '2017-03-30', 59, '', 44.00),
(120, '15', '00003', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 3.00, 11.00, 25.00, '', '2017-03-31', 59, '0000120.png', 44.00),
(121, '00012', '12', 'Oficina Departamental de Morazán', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '08:00:00', 4.00, 3.00, 0.00, '', '2017-03-15', 60, '', 40.50),
(122, '12', '00012', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Morazán', '05:00:00', '08:00:00', 5.00, 11.00, 25.00, '', '2017-03-16', 60, '0000122.jpg', 40.50),
(123, '00005', '100', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Cuscatlán', '06:00:00', '08:00:00', 1.00, 3.00, 0.00, '', '2017-03-15', 61, '', 98.80),
(124, '00009', '130', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Chalatenango', '06:00:00', '08:00:00', 4.00, 3.00, 0.00, '', '2017-03-30', 62, '', 91.50),
(125, '130', '00009', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de la Libertad', '06:00:00', '08:00:00', 4.00, 11.00, 25.00, '', '2017-03-31', 62, '0000125.jpg', 91.50),
(126, '00007', '42', 'Oficina Departamental de Ahuachapán', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-03-20', 63, '', 100.00),
(127, '42', '00007', 'Oficina Central (San Salvador)', 'Oficina Departamental de Ahuachapán', '06:00:00', '08:00:00', 7.00, 22.00, 50.00, '', '2017-03-22', 63, '0000127.jpg', 100.00),
(128, '00001', '38', 'Oficina Central (San Salvador)', 'Oficina Departamental de Sonsonate', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-03-31', 64, '', 63.60),
(129, '38', '00001', 'Oficina Departamental de Sonsonate', 'Oficina Central (San Salvador)', '13:00:00', '14:00:00', 0.00, 4.00, 0.00, '', '2017-03-31', 64, '', 63.60),
(130, '00001', '44', 'Oficina Central (San Salvador)', 'Oficina Departamental de Cuscatlán', '06:00:00', '10:00:00', 0.00, 3.00, 0.00, '', '2017-03-24', 65, '', 37.00),
(131, '44', '00001', 'Oficina Departamental de Cuscatlán', 'Oficina Central (San Salvador)', '11:00:00', '12:00:00', 0.00, 0.00, 0.00, '', '2017-03-24', 65, '', 37.00),
(132, '00002', '56', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Sonsonate', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-04-03', 66, '', 211.00),
(133, '56', '00002', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Oriente (San Miguel)', '15:00:00', '17:00:00', 0.00, 4.00, 0.00, '', '2017-04-03', 66, '', 211.00),
(134, '00005', '106', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Chalatenango', '06:00:00', '08:00:00', 5.00, 3.00, 0.00, '', '2017-04-05', 67, '', 138.00),
(135, '106', '00005', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Sonsonate', '06:00:00', '08:00:00', 7.00, 22.00, 50.00, '', '2017-04-07', 67, '0000135.jpg', 138.00),
(136, '00010', '146', 'Oficina Departamental de San Vicente', 'Oficina Departamental de la Unión', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-04-10', 68, '', 128.00),
(137, '146', '00010', 'Oficina Departamental de la Unión', 'Oficina Departamental de San Vicente', '17:00:00', '20:00:00', 7.00, 8.00, 0.00, '', '2017-04-10', 68, '', 128.00),
(138, '00010', '125', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Cuscatlán', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-04-14', 69, '', 24.20),
(139, '125', '00010', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de San Vicente', '17:00:00', '20:00:00', 7.00, 8.00, 0.00, '', '2017-04-14', 69, '', 24.20),
(140, '00003', '76', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de la Libertad', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-04-12', 70, '', 55.20),
(141, '76', '00003', 'Oficina Departamental de la Libertad', 'Oficina Regional de Occidente (Santa Ana)', '17:30:00', '19:00:00', 7.00, 19.00, 25.00, '', '2017-04-13', 70, '0000141.jpg', 55.20),
(142, '00004', '69', 'Oficina Paracentral (La Paz)', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-04-12', 71, '', 125.00),
(143, '69', '00004', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Paracentral (La Paz)', '11:00:00', '12:00:00', 7.00, 0.00, 0.00, '', '2017-04-12', 71, '', 125.00),
(144, '00003', '72', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Ahuachapán', '06:00:00', '08:00:00', 1.00, 3.00, 0.00, '', '2017-04-17', 72, '', 36.30),
(145, '72', '00003', 'Oficina Departamental de Ahuachapán', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 7.00, 44.00, 40.00, '', '2017-04-21', 72, '0000145.jpg', 36.30),
(146, '00012', '140', 'Oficina Departamental de Morazán', 'Oficina Departamental de la Unión', '06:00:00', '07:00:00', 3.00, 3.00, 0.00, '', '2017-04-29', 73, '', 82.90),
(147, '140', '00012', 'Oficina Departamental de la Unión', 'Oficina Departamental de Morazán', '11:00:00', '12:00:00', 3.00, 0.00, 0.00, '', '2017-04-29', 73, '', 82.90),
(148, '00005', '39', 'Oficina Departamental de Sonsonate', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 3.00, 3.00, 0.00, '', '2017-04-24', 74, '', 63.60),
(149, '39', '00005', 'Oficina Central (San Salvador)', 'Oficina Departamental de Sonsonate', '11:00:00', '12:00:00', 0.00, 0.00, 0.00, '', '2017-04-24', 74, '', 63.60),
(150, '00009', '77', 'Oficina Departamental de la Libertad', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-04-13', 75, '', 55.20),
(151, '77', '00009', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de la Libertad', '11:00:00', '12:00:00', 0.00, 0.00, 0.00, '', '2017-04-13', 75, '', 55.20),
(152, '00006', '143', 'Oficina Departamental de la Unión', 'Oficina Departamental de Cuscatlán', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-04-18', 76, '', 134.00),
(153, '143', '00006', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de la Unión', '11:00:00', '12:00:00', 0.00, 0.00, 0.00, '', '2017-04-18', 76, '', 134.00),
(154, '00001', '17', 'Oficina Central (San Salvador)', 'Oficina Departamental de la Libertad', '05:00:00', '07:07:00', 0.00, 3.00, 0.00, '', '2017-04-28', 77, '', 30.40),
(155, '17', '00001', 'Oficina Departamental de la Libertad', 'Oficina Central (San Salvador)', '17:00:00', '19:00:00', 0.00, 8.00, 0.00, '', '2017-04-28', 77, '', 30.40),
(156, '00008', '22', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Chalatenango', '05:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-04-17', 78, '', 108.00),
(157, '22', '00008', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Cuscatlán', '17:00:00', '19:00:00', 3.00, 19.00, 20.00, '', '2017-04-18', 78, '0000157.jpg', 108.00),
(158, '00011', '66', 'Oficina Departamental de Chalatenango', 'Oficina Regional de Oriente (San Miguel)', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-04-20', 79, '', 147.00),
(159, '66', '00011', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Chalatenango', '17:00:00', '19:00:00', 7.00, 19.00, 20.00, '', '2017-04-21', 79, '0000159.jpg', 147.00),
(160, '00007', '73', 'Oficina Departamental de Ahuachapán', 'Oficina Regional de Occidente (Santa Ana)', '07:00:00', '09:00:00', 0.00, 0.00, 0.00, '', '2017-04-21', 80, '', 36.30),
(161, '73', '00007', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Ahuachapán', '17:00:00', '19:00:00', 0.00, 8.00, 0.00, '', '2017-04-21', 80, '', 36.30),
(162, '00001', '40', 'Oficina Central (San Salvador)', 'Oficina Departamental de la Unión', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-04-06', 81, '', 206.00),
(163, '40', '00001', 'Oficina Departamental de la Unión', 'Oficina Central (San Salvador)', '17:00:00', '19:00:00', 7.00, 19.00, 25.00, '', '2017-04-07', 81, '0000163.jpg', 206.00),
(164, '00001', '17', 'Oficina Central (San Salvador)', 'Oficina Departamental de la Libertad', '06:00:00', '08:00:00', 2.00, 3.00, 0.00, '', '2017-05-29', 82, '', 30.40),
(165, '17', '00001', 'Oficina Departamental de la Libertad', 'Oficina Central (San Salvador)', '17:00:00', '18:00:00', 2.00, 4.00, 0.00, '', '2017-05-29', 82, '', 30.40),
(170, '00007', '113', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Cuscatlán', '06:00:00', '08:08:00', 7.00, 3.00, 0.00, '', '2017-05-12', 83, '', 134.00),
(171, '113', '00007', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Ahuachapán', '16:00:00', '18:00:00', 7.00, 4.00, 0.00, '', '2017-05-12', 83, '', 134.00),
(172, '00011', '134', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de San Vicente', '05:00:00', '08:00:00', 2.00, 3.00, 0.00, '', '2017-05-24', 84, '', 129.00),
(173, '134', '00011', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Chalatenango', '17:00:00', '18:00:00', 2.00, 4.00, 0.00, '', '2017-05-24', 84, '', 129.00),
(174, '00008', '45', 'Oficina Departamental de Cuscatlán', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 2.00, 3.00, 0.00, '', '2017-05-20', 85, '', 37.00),
(175, '45', '00008', 'Oficina Central (San Salvador)', 'Oficina Departamental de Cuscatlán', '17:00:00', '19:00:00', 0.00, 8.00, 0.00, '', '2017-05-20', 85, '', 37.00),
(176, '00003', '15', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Sonsonate', '05:00:00', '08:00:00', 4.00, 3.00, 0.00, '', '2017-05-26', 86, '', 44.00),
(177, '00003', '15', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Sonsonate', '05:00:00', '08:00:00', 3.00, 22.00, 50.00, '', '2017-05-30', 86, '0000177.jpg', 44.00),
(178, '00010', '125', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Cuscatlán', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-05-29', 87, '', 24.20),
(179, '125', '00010', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de San Vicente', '17:00:00', '19:00:00', 7.00, 8.00, 0.00, '', '2017-05-29', 87, '', 24.20),
(180, '00002', '60', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Cuscatlán', '06:00:00', '07:00:00', 4.00, 3.00, 0.00, '', '2017-06-29', 88, '', 101.00),
(181, '60', '00002', 'Oficina Departamental de Cuscatlán', 'Oficina Regional de Oriente (San Miguel)', '16:00:00', '18:00:00', 5.00, 4.00, 0.00, '', '2017-06-29', 88, '', 101.00),
(182, '00005', '3', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Ahuachapán', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-06-05', 89, '', 44.00),
(183, '3', '00005', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Sonsonate', '17:00:00', '18:00:00', 4.00, 4.00, 0.00, '', '2017-06-05', 89, '', 44.00),
(184, '00010', '47', 'Oficina Departamental de San Vicente', 'Oficina Central (San Salvador)', '06:00:00', '07:01:00', 7.00, 3.00, 0.00, '', '2017-06-04', 90, '', 58.20),
(185, '47', '00010', 'Oficina Central (San Salvador)', 'Oficina Departamental de San Vicente', '17:00:00', '18:00:00', 7.00, 4.00, 0.00, '', '2017-06-04', 90, '', 58.20),
(186, '00010', '79', 'Oficina Departamental de San Vicente', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-06-13', 91, '', 125.00),
(187, '79', '00010', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de San Vicente', '17:00:00', '18:00:00', 7.00, 26.00, 50.00, '', '2017-06-15', 91, '0000187.jpg', 125.00),
(188, '00012', '133', 'Oficina Departamental de Morazán', 'Oficina Departamental de la Libertad', '06:00:00', '07:00:00', 6.00, 3.00, 0.00, '', '2017-07-03', 92, '', 175.00),
(189, '133', '00012', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Morazán', '16:00:00', '18:00:00', 6.00, 4.00, 0.00, '', '2017-07-03', 92, '', 175.00),
(190, '00009', '123', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Cuscatlán', '06:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-07-05', 93, '', 48.60),
(191, '123', '00009', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de la Libertad', '15:00:00', '17:00:00', 7.00, 4.00, 0.00, '', '2017-07-05', 93, '', 48.60),
(192, '00008', '61', 'Oficina Departamental de Cuscatlán', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '19:00:00', 0.00, 11.00, 0.00, '', '2017-07-26', 94, '', 101.00),
(193, '61', '00008', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Cuscatlán', '18:00:00', '19:00:00', 4.00, 22.00, 40.00, '', '2017-07-28', 94, '0000193.jpg', 101.00),
(194, '00001', '44', 'Oficina Central (San Salvador)', 'Oficina Departamental de Cuscatlán', '06:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-07-18', 95, '', 37.00),
(195, '44', '00001', 'Oficina Departamental de Cuscatlán', 'Oficina Central (San Salvador)', '16:00:00', '17:00:00', 6.00, 4.00, 0.00, '', '2017-07-18', 95, '', 37.00),
(196, '00010', '47', 'Oficina Departamental de San Vicente', 'Oficina Central (San Salvador)', '06:00:00', '07:00:00', 6.00, 3.00, 0.00, '', '2017-08-14', 96, '', 58.20),
(197, '47', '00010', 'Oficina Central (San Salvador)', 'Oficina Departamental de San Vicente', '15:00:00', '17:00:00', 6.00, 4.00, 0.00, '', '2017-08-14', 96, '', 58.20),
(198, '00010', '5', 'Oficina Departamental de San Vicente', 'Oficina Paracentral (La Paz)', '06:00:00', '07:00:00', 2.00, 3.00, 0.00, '', '2017-08-21', 97, '', 38.20),
(199, '5', '00010', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de San Vicente', '16:00:00', '18:00:00', 4.00, 4.00, 0.00, '', '2017-08-21', 97, '', 38.20),
(200, '00009', '114', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Ahuachapán', '05:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-08-28', 98, '', 85.20),
(201, '114', '00009', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de la Libertad', '05:00:00', '07:00:00', 0.00, 22.00, 50.00, '', '2017-08-30', 98, '0000201.jpg', 85.20),
(202, '00003', '76', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de la Libertad', '05:00:00', '07:00:00', 0.00, 3.00, 0.00, '', '2017-08-16', 99, '', 55.20),
(203, '76', '00003', 'Oficina Departamental de la Libertad', 'Oficina Regional de Occidente (Santa Ana)', '16:00:00', '18:00:00', 0.00, 4.00, 0.00, '', '2017-08-16', 99, '', 55.20),
(204, '00001', '46', 'Oficina Central (San Salvador)', 'Oficina Departamental de San Vicente', '05:00:00', '07:00:00', 0.00, 3.00, 0.00, '', '2017-08-24', 100, '', 58.20),
(205, '46', '00001', 'Oficina Departamental de San Vicente', 'Oficina Central (San Salvador)', '16:00:00', '18:00:00', 0.00, 4.00, 0.00, '', '2017-08-24', 100, '', 58.20),
(206, '00005', '3', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Ahuachapán', '05:00:00', '06:00:00', 7.00, 3.00, 0.00, '', '2017-08-30', 102, '', 44.00),
(207, '3', '00005', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de Sonsonate', '05:00:00', '06:00:00', 7.00, 11.00, 25.00, '', '2017-08-31', 102, '0000207.jpg', 44.00),
(208, '00008', '45', 'Oficina Departamental de Cuscatlán', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 6.00, 3.00, 0.00, '', '2017-09-04', 103, '', 37.00),
(209, '45', '00008', 'Oficina Central (San Salvador)', 'Oficina Departamental de Cuscatlán', '16:00:00', '18:00:00', 6.00, 4.00, 0.00, '', '2017-09-04', 103, '', 37.00),
(210, '00004', '37', 'Oficina Paracentral (La Paz)', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-09-12', 104, '', 64.30),
(211, '37', '00004', 'Oficina Central (San Salvador)', 'Oficina Paracentral (La Paz)', '16:00:00', '19:00:00', 7.00, 8.00, 0.00, '', '2017-09-12', 104, '', 64.30),
(212, '00004', '86', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de la Unión', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-09-14', 105, '', 145.00),
(213, '86', '00004', 'Oficina Departamental de la Unión', 'Oficina Paracentral (La Paz)', '16:00:00', '19:00:00', 7.00, 8.00, 0.00, '', '2017-09-14', 105, '', 145.00),
(214, '00007', '115', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de la Libertad', '06:00:00', '08:00:00', 5.00, 3.00, 0.00, '', '2017-09-26', 106, '', 85.20),
(215, '115', '00007', 'Oficina Departamental de la Libertad', 'Oficina Departamental de Ahuachapán', '16:00:00', '19:00:00', 7.00, 8.00, 0.00, '', '2017-09-26', 106, '', 85.20),
(216, '00006', '70', 'Oficina Departamental de la Unión', 'Oficina Regional de Occidente (Santa Ana)', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-09-12', 107, '', 244.00),
(217, '70', '00006', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de la Unión', '05:00:00', '08:00:00', 7.00, 11.00, 25.00, '', '2017-09-13', 107, '0000217.jpg', 244.00),
(218, '00002', '62', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de la Libertad', '06:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-09-30', 108, '', 174.00),
(219, '62', '00002', 'Oficina Departamental de la Libertad', 'Oficina Regional de Oriente (San Miguel)', '17:00:00', '18:00:00', 6.00, 4.00, 0.00, '', '2017-09-30', 108, '', 174.00),
(220, '00005', '57', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Oriente (San Miguel)', '05:00:00', '07:00:00', 7.00, 3.00, 0.00, '', '2017-10-02', 109, '', 211.00),
(221, '57', '00005', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de Sonsonate', '15:00:00', '17:00:00', 6.00, 4.00, 0.00, '', '2017-10-02', 109, '', 211.00),
(222, '00010', '47', 'Oficina Departamental de San Vicente', 'Oficina Central (San Salvador)', '06:00:00', '08:30:00', 0.65, 3.00, 0.00, '', '2017-10-06', 110, '', 58.20),
(223, '47', '00010', 'Oficina Central (San Salvador)', 'Oficina Departamental de San Vicente', '16:00:00', '19:00:00', 0.65, 8.00, 0.00, '', '2017-10-06', 110, '', 58.20),
(224, '00010', '117', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Ahuachapán', '05:00:00', '08:00:00', 3.00, 3.00, 0.00, '', '2017-10-10', 111, '', 155.00),
(225, '117', '00010', 'Oficina Departamental de Ahuachapán', 'Oficina Departamental de San Vicente', '15:00:00', '18:00:00', 3.65, 4.00, 0.00, '', '2017-10-10', 111, '', 155.00),
(226, '00003', '35', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Central (San Salvador)', '06:00:00', '08:03:00', 2.65, 3.00, 0.00, '', '2017-10-17', 112, '', 69.30),
(227, '35', '00003', 'Oficina Central (San Salvador)', 'Oficina Regional de Occidente (Santa Ana)', '17:00:00', '19:00:00', 2.65, 8.00, 0.00, '', '2017-10-17', 112, '', 69.30),
(228, '00012', '82', 'Oficina Departamental de Morazán', 'Oficina Regional de Occidente (Santa Ana)', '05:00:00', '08:00:00', 7.00, 3.00, 0.00, '', '2017-10-25', 113, '', 231.00),
(229, '82', '00012', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Morazán', '05:00:00', '08:00:00', 7.00, 11.00, 25.00, '', '2017-10-26', 113, '0000229.jpg', 231.00),
(230, '00005', '100', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Cuscatlán', '05:00:00', '08:00:00', 4.25, 3.00, 0.00, '', '2017-10-16', 114, '', 98.80),
(231, '100', '00005', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Sonsonate', '05:00:00', '08:00:00', 2.45, 11.00, 14.50, '', '2017-10-17', 114, '0000231.jpg', 98.80),
(232, '00009', '63', 'Oficina Departamental de la Libertad', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '08:00:00', 5.50, 3.00, 0.00, '', '2017-11-06', 115, '', 174.00),
(233, '63', '00009', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de la Libertad', '17:00:00', '19:00:00', 4.35, 8.00, 0.00, '', '2017-11-06', 115, '', 174.00),
(234, '00006', '41', 'Oficina Departamental de la Unión', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 4.85, 3.00, 0.00, '', '2017-11-13', 116, '', 206.00),
(235, '41', '00006', 'Oficina Central (San Salvador)', 'Oficina Departamental de la Unión', '05:00:00', '08:00:00', 5.95, 11.00, 19.95, '', '2017-11-14', 116, '0000235.jpg', 206.00),
(236, '00001', '34', 'Oficina Central (San Salvador)', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 3.85, 3.00, 0.00, '', '2017-11-23', 117, '', 69.30),
(237, '34', '00001', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 5.65, 11.00, 20.15, '', '2017-11-24', 117, '0000237.jpg', 69.30),
(238, '00008', '75', 'Oficina Departamental de Cuscatlán', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-11-27', 118, '', 104.00),
(239, '75', '00008', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Cuscatlán', '16:00:00', '18:00:00', 0.45, 4.00, 0.00, '', '2017-11-27', 118, '', 104.00),
(240, '00011', '138', 'Oficina Departamental de Chalatenango', 'Oficina Departamental de Morazán', '05:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2017-11-29', 119, '', 161.00),
(241, '138', '00011', 'Oficina Departamental de Morazán', 'Oficina Departamental de Chalatenango', '10:00:00', '11:45:00', 0.00, 0.00, 0.00, '', '2017-11-29', 119, '', 161.00),
(242, '00007', '89', 'Oficina Departamental de Ahuachapán', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 6.75, 3.00, 0.00, '', '2017-12-12', 120, '', 163.00),
(243, '89', '00007', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de Ahuachapán', '16:00:00', '18:00:00', 4.95, 4.00, 0.00, '', '2017-12-12', 120, '', 163.00),
(244, '00001', '17', 'Oficina Central (San Salvador)', 'Oficina Departamental de la Libertad', '06:00:00', '08:00:00', 3.35, 3.00, 0.00, '', '2017-12-06', 121, '', 30.40),
(245, '17', '00001', 'Oficina Departamental de la Libertad', 'Oficina Central (San Salvador)', '05:00:00', '08:00:00', 5.65, 11.00, 20.55, '', '2017-12-07', 121, '0000245.jpg', 30.40),
(246, '00002', '54', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 4.85, 3.00, 0.00, '', '2017-12-20', 122, '', 107.00),
(247, '54', '00002', 'Oficina Paracentral (La Paz)', 'Oficina Regional de Oriente (San Miguel)', '15:00:00', '18:00:00', 3.95, 4.00, 0.00, '', '2017-12-20', 122, '', 107.00),
(248, '00005', '100', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Cuscatlán', '05:00:00', '08:00:00', 3.85, 3.00, 0.00, '', '2017-12-14', 123, '', 98.80),
(249, '100', '00005', 'Oficina Departamental de Cuscatlán', 'Oficina Departamental de Sonsonate', '15:00:00', '17:00:00', 4.25, 4.00, 0.00, '', '2017-12-14', 123, '', 98.80),
(250, '00010', '136', 'Oficina Departamental de San Vicente', 'Oficina Departamental de Morazán', '05:00:00', '08:00:00', 3.10, 3.00, 0.00, '', '2017-12-11', 124, '', 114.00),
(251, '136', '00010', 'Oficina Departamental de Morazán', 'Oficina Departamental de San Vicente', '05:00:00', '08:00:00', 4.55, 11.00, 15.55, '', '2017-12-12', 124, '0000251.jpg', 114.00),
(252, '00010', '65', 'Oficina Departamental de San Vicente', 'Oficina Regional de Oriente (San Miguel)', '05:00:00', '08:00:00', 4.35, 3.00, 0.00, '', '2018-01-29', 125, '', 84.80),
(253, '65', '00010', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Departamental de San Vicente', '05:00:00', '08:00:00', 5.50, 11.00, 15.75, '', '2018-01-30', 125, '0000253.jpg', 84.80),
(254, '00003', '68', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Paracentral (La Paz)', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2018-01-15', 126, '', 125.00),
(255, '68', '00003', 'Oficina Paracentral (La Paz)', 'Oficina Regional de Occidente (Santa Ana)', '13:00:00', '16:00:00', 0.00, 4.00, 0.00, '', '2018-01-15', 126, '', 125.00),
(256, '00004', '86', 'Oficina Paracentral (La Paz)', 'Oficina Departamental de la Unión', '06:00:00', '08:00:00', 0.00, 3.00, 0.00, '', '2018-01-23', 127, '', 145.00),
(257, '86', '00004', 'Oficina Departamental de la Unión', 'Oficina Paracentral (La Paz)', '11:00:00', '12:00:00', 0.00, 0.00, 0.00, '', '2018-01-23', 127, '', 145.00),
(258, '00003', '15', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Departamental de Sonsonate', '06:00:00', '08:00:00', 2.35, 3.00, 0.00, '', '2018-01-24', 128, '', 44.00),
(259, '15', '00003', 'Oficina Departamental de Sonsonate', 'Oficina Regional de Occidente (Santa Ana)', '06:00:00', '08:00:00', 2.25, 11.00, 12.95, '', '2018-01-25', 128, '0000259.jpg', 44.00),
(260, '00002', '67', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Central (San Salvador)', '06:00:00', '08:00:00', 1.35, 3.00, 0.00, '', '2018-04-06', 129, '', 135.00),
(261, '67', '52', 'Oficina Central (San Salvador)', 'Oficina Regional de Occidente (Santa Ana)', '11:00:00', '12:50:00', 0.60, 4.00, 0.00, '', '2018-04-06', 129, '', 200.00),
(262, '52', '00002', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Oriente (San Miguel)', '14:00:00', '16:30:00', 1.75, 0.00, 0.00, '', '2018-04-06', 129, '', 200.00),
(263, '00001', '33', 'Oficina Central (San Salvador)', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '09:00:00', 0.00, 3.00, 0.00, '', '2018-04-16', 130, '', 135.00),
(264, '33', '00001', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Central (San Salvador)', '13:00:00', '15:00:00', 0.00, 4.00, 0.00, '', '2018-04-16', 130, '', 135.00),
(265, '00002', '67', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Central (San Salvador)', '06:00:00', '07:00:00', 0.00, 3.00, 0.00, '', '2018-04-17', 131, '', 135.00),
(266, '00001', '33', 'Oficina Central (San Salvador)', 'Oficina Regional de Oriente (San Miguel)', '06:00:00', '07:00:00', 0.00, 3.00, 0.00, '', '2018-04-17', 132, '', 135.00),
(267, '00001', '34', 'Oficina Central (San Salvador)', 'Oficina Regional de Occidente (Santa Ana)', '06:07:00', '07:16:00', 0.00, 3.00, 0.00, '', '2018-04-18', 133, '', 69.30),
(268, '00001', '34', 'Oficina Central (San Salvador)', 'Oficina Regional de Occidente (Santa Ana)', '05:00:00', '08:30:00', 3.00, 3.00, 0.00, '', '2018-04-26', 134, '', 69.30),
(269, '34', '00001', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Central (San Salvador)', '16:00:00', '18:30:00', 0.00, 0.00, 0.00, '', '2018-04-26', 134, '', 69.30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_estado_solicitud`
--

DROP TABLE IF EXISTS `vyp_estado_solicitud`;
CREATE TABLE `vyp_estado_solicitud` (
  `id_estado_solicitud` int(10) UNSIGNED NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_estado_solicitud`
--

INSERT INTO `vyp_estado_solicitud` (`id_estado_solicitud`, `nombre_estado`) VALUES
(0, 'Incompleta'),
(1, 'Revisión jefe inmediato'),
(2, 'Observaciones del jefe inmediato'),
(3, 'Revisión del director o jefe de regional'),
(4, 'Observaciones del director o jefe de regional'),
(5, 'Revisión del Fondo Circulante del Monto Fijo'),
(6, 'Observaciones del Fondo Circulante del Monto Fijo'),
(7, 'Aprobada'),
(8, 'Pagada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_estructura_planilla`
--

DROP TABLE IF EXISTS `vyp_estructura_planilla`;
CREATE TABLE `vyp_estructura_planilla` (
  `id_estructura` int(10) UNSIGNED NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre_campo` varchar(100) NOT NULL DEFAULT '',
  `valor_campo` varchar(45) NOT NULL DEFAULT '',
  `name_campo` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_estructura_planilla`
--

INSERT INTO `vyp_estructura_planilla` (`id_estructura`, `id_banco`, `nombre_campo`, `valor_campo`, `name_campo`, `orden`) VALUES
(14, 4, 'Cuenta bancaria', 'ec.numero_cuenta AS numero_cuenta', '', 0),
(15, 4, 'Código', 'b.codigo AS codigo', '', 0),
(16, 4, 'DUI', 'e.DUI AS DUI', '', 0),
(17, 4, 'Nombre', 'p.nombre_empleado AS nombre_empleado', '', 0),
(18, 4, 'Blanco', '\'\' AS blanco', '', 0),
(19, 4, 'Monto en viáticos', 'SUM(p.total) AS total', '', 0),
(20, 4, 'No Poliza', 'p.no_poliza AS no_poliza', '', 0),
(23, 1, 'Cuenta bancaria (Empleado)', 'ec.numero_cuenta AS numero_cuenta', '', 1),
(27, 1, 'Nombre (Empleado)', 'p.nombre_empleado AS nombre_empleado', '', 2),
(28, 1, 'Espacio blanco (Otros)', '\'\' AS blanco', '', 3),
(29, 1, 'Monto en viáticos (Poliza)', 'SUM(p.total) AS total', '', 4),
(30, 1, 'Correlativo (Otros)', '\'correlativo\' AS correlativo', '', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_generalidades`
--

DROP TABLE IF EXISTS `vyp_generalidades`;
CREATE TABLE `vyp_generalidades` (
  `id_generalidad` int(10) UNSIGNED NOT NULL,
  `pasaje` float(5,2) NOT NULL,
  `alojamiento` float(5,2) NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL,
  `banco` varchar(100) NOT NULL,
  `num_cuenta` varchar(45) NOT NULL,
  `limite_poliza` float(5,2) NOT NULL,
  `codigo_presupuestario` varchar(50) NOT NULL,
  `id_responsable` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_generalidades`
--

INSERT INTO `vyp_generalidades` (`id_generalidad`, `pasaje`, `alojamiento`, `id_banco`, `banco`, `num_cuenta`, `limite_poliza`, `codigo_presupuestario`, `id_responsable`) VALUES
(1, 7.00, 25.00, 1, 'Banco Agrícola', '590-057808-4', 500.00, '2018-3300-3-21-1-VARIOS', '2031');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_horario_viatico`
--

DROP TABLE IF EXISTS `vyp_horario_viatico`;
CREATE TABLE `vyp_horario_viatico` (
  `id_horario_viatico` int(10) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `monto` float(5,2) NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_restriccion` int(10) UNSIGNED NOT NULL,
  `id_viatico_restriccion` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_horario_viatico`
--

INSERT INTO `vyp_horario_viatico` (`id_horario_viatico`, `descripcion`, `hora_inicio`, `hora_fin`, `monto`, `id_tipo`, `estado`, `id_restriccion`, `id_viatico_restriccion`) VALUES
(1, 'Desayuno', '05:00:00', '06:30:00', 3.00, 1, 1, 1, 0),
(2, 'Almuerzo', '11:30:00', '13:10:00', 4.00, 1, 1, 1, 0),
(3, 'Cena', '18:30:00', '23:59:00', 4.00, 1, 1, 1, 0),
(4, 'Restriccion de almuerzo', '11:31:00', '13:09:00', 0.00, 2, 1, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_horario_viatico_solicitud`
--

DROP TABLE IF EXISTS `vyp_horario_viatico_solicitud`;
CREATE TABLE `vyp_horario_viatico_solicitud` (
  `id_horario_solicitud` int(10) UNSIGNED NOT NULL,
  `fecha_ruta` date NOT NULL,
  `id_horario_viatico` int(10) UNSIGNED NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_ruta_visitada` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_horario_viatico_solicitud`
--

INSERT INTO `vyp_horario_viatico_solicitud` (`id_horario_solicitud`, `fecha_ruta`, `id_horario_viatico`, `id_mision`, `estado`, `id_ruta_visitada`) VALUES
(57, '2017-01-03', 1, 1, 1, '1'),
(58, '2017-01-04', 1, 2, 1, '3'),
(60, '2017-01-09', 1, 3, 1, '7'),
(61, '2017-01-09', 2, 3, 1, '8'),
(62, '2017-01-16', 1, 5, 1, '9'),
(63, '2017-01-18', 2, 4, 1, '10'),
(64, '2017-01-16', 2, 5, 1, '11'),
(65, '2017-01-16', 3, 5, 1, '11'),
(66, '2018-03-28', 1, 6, 1, '12'),
(67, '2018-03-28', 2, 6, 1, '13'),
(68, '2018-03-28', 3, 6, 1, '13'),
(69, '2017-01-23', 1, 7, 1, '14'),
(70, '2017-01-18', 1, 8, 1, '16'),
(71, '2017-01-18', 2, 8, 1, '17'),
(72, '2017-01-26', 1, 9, 1, '18'),
(73, '2017-01-26', 2, 9, 1, '19'),
(74, '2017-01-26', 3, 9, 1, '19'),
(75, '2017-01-19', 1, 11, 1, '20'),
(76, '2017-01-19', 2, 11, 1, '21'),
(77, '2017-01-03', 1, 10, 1, '22'),
(78, '2017-01-30', 1, 12, 1, '23'),
(79, '2017-01-30', 2, 12, 1, '24'),
(80, '2017-01-31', 1, 13, 1, '25'),
(81, '2017-01-31', 2, 13, 1, '26'),
(82, '2017-01-31', 3, 13, 1, '26'),
(84, '2017-01-03', 2, 10, 1, '27'),
(86, '2017-01-16', 1, 14, 1, '28'),
(88, '2017-01-16', 2, 14, 1, '29'),
(89, '2017-01-16', 3, 14, 1, '29'),
(90, '2017-01-17', 1, 14, 1, '29'),
(91, '2017-01-20', 1, 16, 1, '30'),
(92, '2017-01-17', 1, 15, 1, '31'),
(93, '2017-01-17', 2, 15, 1, '32'),
(94, '2017-01-17', 3, 15, 1, '32'),
(95, '2017-01-18', 1, 15, 1, '32'),
(96, '2017-01-20', 2, 16, 1, '33'),
(97, '2017-01-25', 2, 17, 1, '34'),
(98, '2017-01-06', 1, 18, 1, '36'),
(99, '2017-01-06', 2, 18, 1, '37'),
(100, '2017-01-12', 2, 19, 1, '39'),
(101, '2017-02-01', 1, 20, 1, '40'),
(102, '2017-02-01', 2, 20, 1, '41'),
(103, '2017-02-02', 1, 21, 1, '42'),
(104, '2017-02-02', 2, 21, 1, '43'),
(105, '2017-02-02', 3, 21, 1, '43'),
(106, '2017-01-25', 1, 22, 1, '44'),
(107, '2017-02-06', 1, 23, 1, '45'),
(108, '2017-02-06', 2, 23, 1, '46'),
(109, '2017-02-06', 3, 23, 1, '46'),
(110, '2017-02-07', 1, 23, 1, '46'),
(111, '2017-01-25', 2, 22, 1, '47'),
(122, '2017-02-06', 1, 24, 1, '48'),
(123, '2017-02-06', 2, 24, 1, '49'),
(124, '2017-02-06', 3, 24, 1, '49'),
(125, '2017-02-07', 1, 24, 1, '49'),
(126, '2017-02-07', 2, 24, 1, '49'),
(127, '2017-02-07', 3, 24, 1, '49'),
(128, '2017-02-08', 1, 24, 1, '49'),
(129, '2017-02-08', 2, 24, 1, '49'),
(130, '2017-02-08', 3, 24, 1, '49'),
(131, '2017-02-09', 1, 24, 1, '49'),
(132, '2017-02-09', 1, 26, 1, '50'),
(133, '2017-02-09', 2, 26, 1, '51'),
(134, '2017-02-09', 3, 26, 1, '51'),
(135, '2017-01-10', 1, 25, 1, '52'),
(136, '2017-01-10', 2, 25, 1, '53'),
(137, '2017-02-13', 1, 27, 1, '54'),
(138, '2017-02-13', 2, 27, 1, '55'),
(139, '2017-02-21', 1, 28, 1, '56'),
(140, '2017-02-21', 2, 28, 1, '57'),
(141, '2017-02-21', 3, 28, 1, '57'),
(142, '2017-01-20', 1, 29, 1, '58'),
(143, '2017-02-24', 1, 30, 1, '59'),
(198, '2017-02-24', 2, 30, 1, '60'),
(199, '2017-02-24', 3, 30, 1, '60'),
(200, '2017-02-27', 1, 30, 1, '60'),
(201, '2017-02-27', 2, 30, 1, '60'),
(202, '2017-02-27', 3, 30, 1, '60'),
(203, '2017-02-28', 1, 30, 1, '60'),
(204, '2017-02-27', 1, 31, 1, '61'),
(205, '2017-01-20', 2, 29, 1, '62'),
(206, '2017-02-27', 2, 31, 1, '63'),
(207, '2017-02-08', 1, 32, 1, '64'),
(208, '2017-02-08', 2, 32, 1, '65'),
(209, '2017-02-08', 3, 32, 1, '65'),
(210, '2017-02-09', 1, 32, 1, '65'),
(211, '2017-02-09', 2, 32, 1, '66'),
(212, '2017-02-09', 3, 32, 1, '66'),
(213, '2017-02-10', 1, 32, 1, '66'),
(214, '2017-02-28', 1, 34, 1, '67'),
(215, '2017-02-28', 2, 34, 1, '68'),
(216, '2017-02-28', 3, 34, 1, '68'),
(217, '2017-01-09', 1, 33, 1, '69'),
(218, '2017-01-09', 1, 35, 1, '70'),
(219, '2017-01-09', 2, 33, 1, '71'),
(220, '2017-01-09', 2, 35, 1, '72'),
(221, '2017-01-09', 3, 35, 1, '72'),
(222, '2017-01-10', 1, 35, 1, '72'),
(223, '2017-01-10', 2, 35, 1, '72'),
(224, '2017-01-10', 3, 35, 1, '72'),
(225, '2017-01-11', 1, 35, 1, '72'),
(226, '2017-01-11', 2, 35, 1, '72'),
(227, '2017-01-11', 3, 35, 1, '72'),
(228, '2017-01-12', 1, 35, 1, '72'),
(229, '2017-01-12', 2, 35, 1, '72'),
(230, '2017-01-12', 3, 35, 1, '72'),
(231, '2017-01-13', 1, 35, 1, '72'),
(232, '2017-01-13', 2, 35, 1, '72'),
(233, '2017-01-13', 3, 35, 1, '72'),
(234, '2017-01-23', 1, 36, 1, '73'),
(235, '2017-01-23', 2, 36, 1, '74'),
(236, '2017-01-23', 3, 36, 1, '74'),
(237, '2017-01-24', 1, 36, 1, '74'),
(238, '2017-01-26', 1, 38, 1, '75'),
(239, '2017-01-26', 2, 38, 1, '77'),
(240, '2017-01-26', 3, 38, 1, '77'),
(241, '2017-01-27', 1, 38, 1, '77'),
(242, '2017-01-27', 2, 38, 1, '77'),
(243, '2017-01-12', 2, 37, 1, '78'),
(244, '2017-01-02', 1, 39, 1, '79'),
(245, '2017-01-02', 2, 39, 1, '80'),
(246, '2017-01-02', 3, 39, 1, '80'),
(247, '2017-01-03', 1, 39, 1, '80'),
(248, '2017-01-03', 2, 39, 1, '80'),
(249, '2017-01-03', 3, 39, 1, '80'),
(250, '2017-01-16', 1, 41, 1, '81'),
(251, '2017-01-16', 2, 41, 1, '82'),
(252, '2017-01-16', 3, 41, 1, '82'),
(253, '2017-01-17', 1, 41, 1, '82'),
(254, '2017-01-17', 2, 41, 1, '82'),
(255, '2017-01-17', 3, 41, 1, '82'),
(256, '2017-01-18', 1, 41, 1, '82'),
(257, '2017-01-10', 1, 40, 1, '83'),
(258, '2017-01-23', 1, 42, 1, '84'),
(259, '2017-01-10', 2, 40, 1, '85'),
(260, '2017-01-23', 2, 42, 1, '86'),
(261, '2017-01-23', 3, 42, 1, '86'),
(262, '2017-01-24', 1, 42, 1, '86'),
(263, '2017-01-11', 1, 43, 1, '87'),
(264, '2017-01-11', 2, 43, 1, '88'),
(265, '2017-01-11', 3, 43, 1, '88'),
(266, '2017-01-12', 1, 43, 1, '88'),
(267, '2017-01-12', 2, 43, 1, '88'),
(268, '2017-01-12', 3, 43, 1, '88'),
(269, '2017-01-13', 1, 43, 1, '88'),
(270, '2017-01-18', 1, 44, 1, '89'),
(271, '2017-01-05', 1, 45, 1, '90'),
(272, '2017-01-18', 2, 44, 1, '91'),
(273, '2017-01-05', 2, 45, 1, '92'),
(274, '2017-01-05', 3, 45, 1, '92'),
(275, '2017-01-06', 1, 45, 1, '92'),
(276, '2017-01-06', 2, 45, 1, '92'),
(277, '2017-01-17', 1, 46, 1, '93'),
(278, '2017-01-17', 2, 46, 1, '94'),
(279, '2017-01-17', 3, 46, 1, '94'),
(280, '2017-01-18', 1, 46, 1, '94'),
(281, '2017-01-18', 2, 46, 1, '94'),
(282, '2017-01-18', 3, 46, 1, '94'),
(283, '2017-01-19', 1, 46, 1, '94'),
(284, '2017-01-19', 2, 46, 1, '94'),
(285, '2017-01-19', 3, 46, 1, '94'),
(286, '2017-01-20', 1, 46, 1, '94'),
(288, '2017-01-02', 2, 47, 1, '96'),
(289, '2017-01-02', 3, 47, 1, '96'),
(290, '2017-01-17', 1, 48, 1, '97'),
(291, '2017-01-17', 2, 48, 1, '98'),
(292, '2017-01-17', 3, 48, 1, '98'),
(293, '2017-01-18', 1, 48, 1, '98'),
(294, '2017-01-18', 2, 48, 1, '98'),
(295, '2017-01-18', 3, 48, 1, '98'),
(296, '2017-01-19', 1, 48, 1, '98'),
(297, '2017-01-19', 2, 48, 1, '98'),
(298, '2017-01-19', 3, 48, 1, '98'),
(299, '2017-01-25', 1, 49, 1, '99'),
(300, '2017-01-25', 2, 49, 1, '100'),
(301, '2017-01-06', 1, 50, 1, '101'),
(302, '2017-01-10', 1, 51, 1, '103'),
(303, '2017-01-10', 2, 51, 1, '104'),
(304, '2017-01-30', 1, 52, 1, '105'),
(305, '2017-01-30', 2, 52, 1, '106'),
(306, '2017-01-30', 3, 52, 1, '106'),
(307, '2017-03-06', 1, 53, 1, '107'),
(308, '2017-03-06', 2, 53, 1, '108'),
(309, '2017-03-07', 1, 54, 1, '109'),
(310, '2017-03-07', 2, 54, 1, '110'),
(311, '2017-03-07', 3, 54, 1, '110'),
(312, '2017-03-08', 1, 55, 1, '111'),
(313, '2017-03-08', 2, 55, 1, '112'),
(314, '2017-03-14', 1, 56, 1, '113'),
(315, '2017-03-14', 2, 56, 1, '114'),
(316, '2017-03-14', 3, 56, 1, '114'),
(317, '2017-03-15', 1, 56, 1, '114'),
(318, '2017-03-15', 2, 56, 1, '114'),
(319, '2017-03-15', 3, 56, 1, '114'),
(320, '2017-03-28', 1, 57, 1, '115'),
(321, '2017-03-28', 2, 57, 1, '116'),
(322, '2017-03-28', 3, 57, 1, '116'),
(323, '2017-03-29', 1, 57, 1, '116'),
(324, '2017-03-29', 2, 57, 1, '116'),
(325, '2017-03-29', 3, 57, 1, '116'),
(326, '2017-03-30', 1, 57, 1, '116'),
(327, '2017-03-30', 2, 57, 1, '116'),
(328, '2017-03-30', 3, 57, 1, '116'),
(329, '2017-03-27', 1, 58, 1, '117'),
(330, '2017-03-27', 2, 58, 1, '118'),
(331, '2017-03-27', 3, 58, 1, '118'),
(332, '2017-03-28', 1, 58, 1, '118'),
(333, '2017-03-28', 2, 58, 1, '118'),
(334, '2017-03-28', 3, 58, 1, '118'),
(335, '2017-03-29', 1, 58, 1, '118'),
(336, '2017-03-30', 1, 59, 1, '119'),
(337, '2017-03-30', 2, 59, 1, '120'),
(338, '2017-03-30', 3, 59, 1, '120'),
(339, '2017-03-31', 1, 59, 1, '120'),
(340, '2017-03-15', 1, 60, 1, '121'),
(341, '2017-03-15', 2, 60, 1, '122'),
(342, '2017-03-15', 3, 60, 1, '122'),
(343, '2017-03-16', 1, 60, 1, '122'),
(344, '2017-03-15', 1, 61, 1, '123'),
(345, '2017-03-30', 1, 62, 1, '124'),
(346, '2017-03-30', 2, 62, 1, '125'),
(347, '2017-03-30', 3, 62, 1, '125'),
(348, '2017-03-31', 1, 62, 1, '125'),
(349, '2017-03-20', 1, 63, 1, '126'),
(350, '2017-03-20', 2, 63, 1, '127'),
(351, '2017-03-20', 3, 63, 1, '127'),
(352, '2017-03-21', 1, 63, 1, '127'),
(353, '2017-03-21', 2, 63, 1, '127'),
(354, '2017-03-21', 3, 63, 1, '127'),
(355, '2017-03-22', 1, 63, 1, '127'),
(356, '2017-03-31', 1, 64, 1, '128'),
(357, '2017-03-31', 2, 64, 1, '129'),
(358, '2017-03-24', 1, 65, 1, '130'),
(359, '2017-04-03', 1, 66, 1, '132'),
(360, '2017-04-03', 2, 66, 1, '133'),
(361, '2017-04-05', 1, 67, 1, '134'),
(362, '2017-04-05', 2, 67, 1, '135'),
(363, '2017-04-05', 3, 67, 1, '135'),
(364, '2017-04-06', 1, 67, 1, '135'),
(365, '2017-04-06', 2, 67, 1, '135'),
(366, '2017-04-06', 3, 67, 1, '135'),
(367, '2017-04-07', 1, 67, 1, '135'),
(368, '2017-04-10', 1, 68, 1, '136'),
(369, '2017-04-10', 2, 68, 1, '137'),
(370, '2017-04-10', 3, 68, 1, '137'),
(371, '2017-04-14', 1, 69, 1, '138'),
(372, '2017-04-14', 2, 69, 1, '139'),
(373, '2017-04-14', 3, 69, 1, '139'),
(374, '2017-04-12', 1, 70, 1, '140'),
(375, '2017-04-12', 2, 70, 1, '141'),
(376, '2017-04-12', 3, 70, 1, '141'),
(377, '2017-04-13', 1, 70, 1, '141'),
(378, '2017-04-13', 2, 70, 1, '141'),
(379, '2017-04-13', 3, 70, 1, '141'),
(380, '2017-04-12', 1, 71, 1, '142'),
(381, '2017-04-17', 1, 72, 1, '144'),
(382, '2017-04-17', 2, 72, 1, '145'),
(383, '2017-04-17', 3, 72, 1, '145'),
(384, '2017-04-18', 1, 72, 1, '145'),
(385, '2017-04-18', 2, 72, 1, '145'),
(386, '2017-04-18', 3, 72, 1, '145'),
(387, '2017-04-19', 1, 72, 1, '145'),
(388, '2017-04-19', 2, 72, 1, '145'),
(389, '2017-04-19', 3, 72, 1, '145'),
(390, '2017-04-20', 1, 72, 1, '145'),
(391, '2017-04-20', 2, 72, 1, '145'),
(392, '2017-04-20', 3, 72, 1, '145'),
(393, '2017-04-21', 1, 72, 1, '145'),
(394, '2017-04-29', 1, 73, 1, '146'),
(395, '2017-04-24', 1, 74, 1, '148'),
(396, '2017-04-13', 1, 75, 1, '150'),
(397, '2017-04-18', 1, 76, 1, '152'),
(401, '2017-04-28', 1, 77, 1, '154'),
(402, '2017-04-28', 2, 77, 1, '155'),
(403, '2017-04-28', 3, 77, 1, '155'),
(404, '2017-04-17', 1, 78, 1, '156'),
(405, '2017-04-17', 2, 78, 1, '157'),
(406, '2017-04-17', 3, 78, 1, '157'),
(407, '2017-04-18', 1, 78, 1, '157'),
(408, '2017-04-18', 2, 78, 1, '157'),
(409, '2017-04-18', 3, 78, 1, '157'),
(410, '2017-04-20', 1, 79, 1, '158'),
(411, '2017-04-20', 2, 79, 1, '159'),
(412, '2017-04-20', 3, 79, 1, '159'),
(413, '2017-04-21', 1, 79, 1, '159'),
(414, '2017-04-21', 2, 79, 1, '159'),
(415, '2017-04-21', 3, 79, 1, '159'),
(416, '2017-04-21', 2, 80, 1, '161'),
(417, '2017-04-21', 3, 80, 1, '161'),
(418, '2017-04-06', 1, 81, 1, '162'),
(419, '2017-04-06', 2, 81, 1, '163'),
(420, '2017-04-06', 3, 81, 1, '163'),
(421, '2017-04-07', 1, 81, 1, '163'),
(422, '2017-04-07', 2, 81, 1, '163'),
(423, '2017-04-07', 3, 81, 1, '163'),
(424, '2017-05-29', 1, 82, 1, '164'),
(425, '2017-05-29', 2, 82, 1, '165'),
(431, '2017-05-12', 1, 83, 1, '170'),
(432, '2017-05-12', 2, 83, 1, '171'),
(433, '2017-05-24', 1, 84, 1, '172'),
(434, '2017-05-24', 2, 84, 1, '173'),
(435, '2017-05-20', 1, 85, 1, '174'),
(436, '2017-05-20', 2, 85, 1, '175'),
(437, '2017-05-20', 3, 85, 1, '175'),
(445, '2017-05-26', 1, 86, 1, '176'),
(446, '2017-05-26', 2, 86, 1, '177'),
(447, '2017-05-26', 3, 86, 1, '177'),
(448, '2017-05-29', 1, 86, 1, '177'),
(449, '2017-05-29', 2, 86, 1, '177'),
(450, '2017-05-29', 3, 86, 1, '177'),
(451, '2017-05-30', 1, 86, 1, '177'),
(452, '2017-05-29', 1, 87, 1, '178'),
(453, '2017-05-29', 2, 87, 1, '179'),
(454, '2017-05-29', 3, 87, 1, '179'),
(455, '2017-06-29', 1, 88, 1, '180'),
(456, '2017-06-29', 2, 88, 1, '181'),
(457, '2017-06-05', 1, 89, 1, '182'),
(458, '2017-06-05', 2, 89, 1, '183'),
(459, '2017-06-04', 1, 90, 1, '184'),
(460, '2017-06-04', 2, 90, 1, '185'),
(461, '2017-06-13', 1, 91, 1, '186'),
(462, '2017-06-13', 2, 91, 1, '187'),
(463, '2017-06-13', 3, 91, 1, '187'),
(464, '2017-06-14', 1, 91, 1, '187'),
(465, '2017-06-14', 2, 91, 1, '187'),
(466, '2017-06-14', 3, 91, 1, '187'),
(467, '2017-06-15', 1, 91, 1, '187'),
(468, '2017-06-15', 2, 91, 1, '187'),
(469, '2017-07-03', 1, 92, 1, '188'),
(470, '2017-07-03', 2, 92, 1, '189'),
(471, '2017-07-05', 1, 93, 1, '190'),
(472, '2017-07-05', 2, 93, 1, '191'),
(473, '2017-07-26', 1, 94, 1, '192'),
(474, '2017-07-26', 2, 94, 1, '192'),
(475, '2017-07-26', 3, 94, 1, '192'),
(500, '2017-07-18', 1, 95, 1, '194'),
(501, '2017-07-18', 2, 95, 1, '195'),
(502, '2017-08-14', 1, 96, 1, '196'),
(503, '2017-08-14', 2, 96, 1, '197'),
(504, '2017-08-21', 1, 97, 1, '198'),
(505, '2017-08-21', 2, 97, 1, '199'),
(506, '2017-08-28', 1, 98, 1, '200'),
(513, '2017-08-28', 2, 98, 1, '201'),
(514, '2017-08-28', 3, 98, 1, '201'),
(515, '2017-08-29', 1, 98, 1, '201'),
(516, '2017-08-29', 2, 98, 1, '201'),
(517, '2017-08-29', 3, 98, 1, '201'),
(518, '2017-08-30', 1, 98, 1, '201'),
(519, '2017-08-16', 1, 99, 1, '202'),
(520, '2017-08-16', 2, 99, 1, '203'),
(521, '2017-08-24', 1, 100, 1, '204'),
(522, '2017-08-24', 2, 100, 1, '205'),
(523, '2017-08-30', 1, 102, 1, '206'),
(524, '2017-08-30', 2, 102, 1, '207'),
(525, '2017-08-30', 3, 102, 1, '207'),
(526, '2017-08-31', 1, 102, 1, '207'),
(527, '2017-09-04', 1, 103, 1, '208'),
(528, '2017-09-04', 2, 103, 1, '209'),
(529, '2017-09-12', 1, 104, 1, '210'),
(530, '2017-09-12', 2, 104, 1, '211'),
(531, '2017-09-12', 3, 104, 1, '211'),
(532, '2017-09-14', 1, 105, 1, '212'),
(533, '2017-09-14', 2, 105, 1, '213'),
(534, '2017-09-14', 3, 105, 1, '213'),
(535, '2017-09-26', 1, 106, 1, '214'),
(536, '2017-09-26', 2, 106, 1, '215'),
(537, '2017-09-26', 3, 106, 1, '215'),
(538, '2017-09-12', 1, 107, 1, '216'),
(539, '2017-09-12', 2, 107, 1, '217'),
(540, '2017-09-12', 3, 107, 1, '217'),
(541, '2017-09-13', 1, 107, 1, '217'),
(542, '2017-09-30', 1, 108, 1, '218'),
(543, '2017-09-30', 2, 108, 1, '219'),
(544, '2017-10-02', 1, 109, 1, '220'),
(545, '2017-10-02', 2, 109, 1, '221'),
(546, '2017-10-06', 1, 110, 1, '222'),
(547, '2017-10-06', 2, 110, 1, '223'),
(548, '2017-10-06', 3, 110, 1, '223'),
(549, '2017-10-10', 1, 111, 1, '224'),
(550, '2017-10-10', 2, 111, 1, '225'),
(551, '2017-10-17', 1, 112, 1, '226'),
(552, '2017-10-17', 2, 112, 1, '227'),
(553, '2017-10-17', 3, 112, 1, '227'),
(554, '2017-10-25', 1, 113, 1, '228'),
(555, '2017-10-25', 2, 113, 1, '229'),
(556, '2017-10-25', 3, 113, 1, '229'),
(557, '2017-10-26', 1, 113, 1, '229'),
(558, '2017-10-16', 1, 114, 1, '230'),
(559, '2017-10-16', 2, 114, 1, '231'),
(560, '2017-10-16', 3, 114, 1, '231'),
(561, '2017-10-17', 1, 114, 1, '231'),
(562, '2017-11-06', 1, 115, 1, '232'),
(563, '2017-11-06', 2, 115, 1, '233'),
(564, '2017-11-06', 3, 115, 1, '233'),
(565, '2017-11-13', 1, 116, 1, '234'),
(566, '2017-11-13', 2, 116, 1, '235'),
(567, '2017-11-13', 3, 116, 1, '235'),
(568, '2017-11-14', 1, 116, 1, '235'),
(569, '2017-11-23', 1, 117, 1, '236'),
(570, '2017-11-23', 2, 117, 1, '237'),
(571, '2017-11-23', 3, 117, 1, '237'),
(572, '2017-11-24', 1, 117, 1, '237'),
(573, '2017-11-27', 1, 118, 1, '238'),
(574, '2017-11-27', 2, 118, 1, '239'),
(575, '2017-11-29', 1, 119, 1, '240'),
(576, '2017-12-12', 1, 120, 1, '242'),
(577, '2017-12-12', 2, 120, 1, '243'),
(578, '2017-12-06', 1, 121, 1, '244'),
(579, '2017-12-06', 2, 121, 1, '245'),
(580, '2017-12-06', 3, 121, 1, '245'),
(581, '2017-12-07', 1, 121, 1, '245'),
(582, '2017-12-20', 1, 122, 1, '246'),
(583, '2017-12-20', 2, 122, 1, '247'),
(584, '2017-12-14', 1, 123, 1, '248'),
(585, '2017-12-14', 2, 123, 1, '249'),
(586, '2017-12-11', 1, 124, 1, '250'),
(587, '2017-12-11', 2, 124, 1, '251'),
(588, '2017-12-11', 3, 124, 1, '251'),
(589, '2017-12-12', 1, 124, 1, '251'),
(590, '2018-01-29', 1, 125, 1, '252'),
(591, '2018-01-29', 2, 125, 1, '253'),
(592, '2018-01-29', 3, 125, 1, '253'),
(593, '2018-01-30', 1, 125, 1, '253'),
(594, '2018-01-15', 1, 126, 1, '254'),
(595, '2018-01-15', 2, 126, 1, '255'),
(596, '2018-01-23', 1, 127, 1, '256'),
(597, '2018-01-24', 1, 128, 1, '258'),
(598, '2018-01-24', 2, 128, 1, '259'),
(599, '2018-01-24', 3, 128, 1, '259'),
(600, '2018-01-25', 1, 128, 1, '259'),
(601, '2018-04-06', 1, 129, 1, '260'),
(602, '2018-04-06', 2, 129, 1, '261'),
(603, '2018-04-16', 1, 130, 1, '263'),
(604, '2018-04-16', 2, 130, 1, '264'),
(605, '2018-04-17', 1, 131, 1, '265'),
(606, '2018-04-17', 1, 132, 1, '266'),
(607, '2018-04-18', 1, 133, 1, '267'),
(608, '2018-04-26', 1, 134, 1, '268'),
(609, '2018-04-26', 1, 134, 1, '269');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_informacion_empleado`
--

DROP TABLE IF EXISTS `vyp_informacion_empleado`;
CREATE TABLE `vyp_informacion_empleado` (
  `id_informacion_empleado` int(10) UNSIGNED NOT NULL,
  `nr` varchar(4) NOT NULL,
  `nr_jefe_inmediato` varchar(4) NOT NULL,
  `id_oficina_departamental` varchar(5) NOT NULL,
  `partida` varchar(45) NOT NULL,
  `sub_numero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_informacion_empleado`
--

INSERT INTO `vyp_informacion_empleado` (`id_informacion_empleado`, `nr`, `nr_jefe_inmediato`, `id_oficina_departamental`, `partida`, `sub_numero`) VALUES
(1, '2588', '988C', '00001', '', ''),
(2, '335C', '988C', '00002', '', ''),
(3, '1462', '988C', '00005', '', ''),
(4, '2665', '988C', '00010', '', ''),
(5, '391C', '988C', '00010', '', ''),
(6, '2818', '988C', '00003', '', ''),
(7, '672C', '988C', '00004', '', ''),
(8, '978C', '988C', '00003', '', ''),
(9, '2905', '988C', '00012', '', ''),
(10, '2788', '988C', '00005', '', ''),
(11, '749C', '988C', '00009', '', ''),
(12, '2647', '988C', '00006', '', ''),
(13, '2347', '988C', '00008', '', ''),
(14, '2781', '988C', '00011', '', ''),
(15, '854C', '988C', '00007', '', ''),
(16, '772C', '988C', '00001', '', ''),
(17, '988C', '997C', '00001', '', ''),
(18, '602C', '988C', '00001', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_justificaciones`
--

DROP TABLE IF EXISTS `vyp_justificaciones`;
CREATE TABLE `vyp_justificaciones` (
  `id_justificacion` int(10) UNSIGNED NOT NULL,
  `ruta` varchar(45) NOT NULL,
  `size` varchar(100) NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `extension` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nombre_real` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_mision_oficial`
--

DROP TABLE IF EXISTS `vyp_mision_oficial`;
CREATE TABLE `vyp_mision_oficial` (
  `id_mision_oficial` int(10) UNSIGNED NOT NULL,
  `nr_empleado` varchar(5) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `fecha_mision_inicio` date NOT NULL,
  `fecha_mision_fin` date NOT NULL DEFAULT '0000-00-00',
  `fecha_solicitud` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_actividad_realizada` int(10) UNSIGNED NOT NULL,
  `detalle_actividad` varchar(500) NOT NULL,
  `nr_jefe_inmediato` varchar(5) NOT NULL,
  `nr_jefe_regional` varchar(5) NOT NULL,
  `aprobado1` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aprobado2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aprobado3` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ruta_justificacion` text NOT NULL,
  `ultima_observacion` datetime NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `pagado_en` varchar(45) NOT NULL,
  `no_cheque` varchar(100) NOT NULL,
  `oficina_solicitante_motorista` int(5) UNSIGNED ZEROFILL NOT NULL DEFAULT '00000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_mision_oficial`
--

INSERT INTO `vyp_mision_oficial` (`id_mision_oficial`, `nr_empleado`, `nombre_completo`, `fecha_mision_inicio`, `fecha_mision_fin`, `fecha_solicitud`, `id_actividad_realizada`, `detalle_actividad`, `nr_jefe_inmediato`, `nr_jefe_regional`, `aprobado1`, `aprobado2`, `aprobado3`, `estado`, `ruta_justificacion`, `ultima_observacion`, `fecha_pago`, `pagado_en`, `no_cheque`, `oficina_solicitante_motorista`) VALUES
(1, '335C', 'ABEL CABRERA ROMAN', '2017-01-03', '2017-01-03', '2017-01-04 11:49:42', 1, 'inspeccion', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(2, '1462', 'ANA CELIA HUEZO CACERES', '2017-01-04', '2017-01-04', '2017-01-05 11:52:49', 3, 'capaitacion', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(3, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-01-09', '2017-01-09', '2017-01-10 13:55:54', 2, 'reinspeccion', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(4, '335C', 'ABEL CABRERA ROMAN', '2017-01-18', '2017-01-18', '2017-01-19 13:26:25', 7, 'Transporte de personal', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(5, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-01-16', '2017-01-16', '2017-01-17 14:05:16', 4, 'proyecto', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(6, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2018-03-28', '2018-03-28', '2018-03-28 14:06:46', 3, 'capacitacion', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(7, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-01-23', '2017-01-23', '2017-01-24 14:10:42', 17, 'soporte tecnico', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(8, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2017-01-18', '2017-01-18', '2017-01-19 14:12:31', 12, 'supervisar', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(9, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-01-26', '2017-01-26', '2017-01-27 14:14:47', 27, 'auditar internamente', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(10, '1462', 'ANA CELIA HUEZO CACERES', '2017-01-03', '2017-01-03', '2017-01-04 14:20:25', 1, 'Inspecciones', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(11, '2788', 'CESAR RAMON LINARES SERRANO', '2017-01-19', '2017-01-19', '2017-01-20 14:16:17', 29, 'entrega de uniformes', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(12, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-01-30', '2017-01-30', '2017-01-31 14:17:45', 32, 'inventariar', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(13, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-01-31', '2017-01-31', '2017-02-01 14:18:50', 15, 'reunion de fin de mes', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(14, '772C', 'JOSE FRANCISCO HUEZO', '2017-01-16', '2017-01-17', '2017-01-18 14:25:47', 12, 'supervision', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(15, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-01-17', '2017-01-18', '2017-01-19 14:28:31', 16, 'turno de vigilancia', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(16, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-01-20', '2017-01-20', '2017-01-23 14:28:54', 9, 'Reparación de computadores', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(17, '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2017-01-25', '2017-01-25', '2017-01-26 14:31:32', 6, 'notificadores', '988C', '845C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(18, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-01-06', '2017-01-06', '2017-01-09 14:32:52', 14, 'retiros de papeleria', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(19, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-01-12', '2017-01-12', '2017-01-13 14:38:59', 6, 'notificaciones', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(20, '335C', 'ABEL CABRERA ROMAN', '2017-02-01', '2017-02-01', '2017-02-02 14:39:30', 10, 'entrega de documentos', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(21, '1462', 'ANA CELIA HUEZO CACERES', '2017-02-02', '2017-02-02', '2017-02-03 14:40:49', 24, 'entrega de jefatura', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(22, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-01-25', '2017-01-25', '2017-01-26 14:43:55', 35, 'charla educativa', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(23, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-02-06', '2017-02-07', '2017-02-08 14:43:08', 26, 'asesorias a oficinas', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(24, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-02-06', '2017-02-09', '2017-02-10 14:47:11', 12, 'se superviso obras', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(25, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-01-10', '2017-01-10', '2017-01-11 14:59:50', 27, 'auditoria sobre seguridad ocupacional', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(26, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-02-09', '2017-02-09', '2017-02-10 14:59:07', 9, 'reparaciones', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(27, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2017-02-13', '2017-02-13', '2017-02-14 15:00:36', 15, 'reuniones', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(28, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-02-21', '2017-02-21', '2017-02-22 15:02:49', 1, 'inspeccion', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(29, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2017-01-20', '2017-01-20', '2017-01-23 15:25:53', 16, 'Vigilancia', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(30, '2788', 'CESAR RAMON LINARES SERRANO', '2017-02-24', '2017-02-28', '2017-03-01 15:24:37', 16, 'turnos de vigilancia', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(31, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-02-27', '2017-02-27', '2017-02-28 15:26:02', 11, 'entrega de insumos', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(32, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-02-08', '2017-02-10', '2017-02-13 15:30:47', 22, 'laboral', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(33, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-01-09', '2017-01-09', '2017-01-10 15:36:13', 35, 'Orientación laboral', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(34, '772C', 'JOSE FRANCISCO HUEZO', '2017-02-28', '2017-02-28', '2017-03-01 15:32:29', 20, 'toma de medidas', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(35, '772C', 'JOSE FRANCISCO HUEZO', '2017-01-09', '2017-01-13', '2017-01-16 15:36:45', 4, 'proyectos', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(36, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-01-23', '2017-01-24', '2017-01-25 15:38:11', 8, 'empleos', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(37, '2788', 'CESAR RAMON LINARES SERRANO', '2017-01-12', '2017-01-12', '2017-01-13 15:39:50', 17, 'soporte tecnico', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(38, '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2017-01-26', '2017-01-27', '2017-01-30 15:39:35', 18, 'recoleccion', '988C', '845C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(39, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-01-02', '2017-01-03', '2017-01-04 15:40:51', 19, 'entrega de oficio', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(40, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-01-10', '2017-01-10', '2017-01-11 15:46:25', 12, 'Supervicion', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(41, '1462', 'ANA CELIA HUEZO CACERES', '2017-01-16', '2017-01-18', '2017-01-19 15:45:28', 3, 'capacitacion', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(42, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-01-23', '2017-01-24', '2017-01-25 15:46:51', 23, 'entrega de acreditaciones', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(43, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-01-11', '2017-01-13', '2017-01-16 15:47:54', 10, 'entrega', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(44, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-01-18', '2017-01-18', '2017-01-19 15:51:08', 2, 'reinspeccion', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(45, '1462', 'ANA CELIA HUEZO CACERES', '2017-01-05', '2017-01-06', '2017-01-09 15:51:15', 5, 'visita tecnica', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(46, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-01-17', '2017-01-20', '2017-01-23 15:52:31', 21, 'seguimiento de comite', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(47, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-01-02', '2017-01-02', '2017-01-03 15:53:59', 9, 'Mantenimiento electrico', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(48, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-01-17', '2017-01-19', '2017-01-20 15:54:18', 25, 'arqueo de caja', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(49, '772C', 'JOSE FRANCISCO HUEZO', '2017-01-25', '2017-01-25', '2017-01-26 15:59:32', 9, 'comunicaciones', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(50, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-01-06', '2017-01-06', '2017-01-09 16:52:34', 11, 'Entrega de insumos', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(51, '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2017-01-10', '2017-01-10', '2017-01-11 16:54:51', 9, 'mantenimiento', '988C', '845C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(52, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-01-30', '2017-01-30', '2017-01-31 16:56:34', 1, 'inspeccion', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(53, '335C', 'ABEL CABRERA ROMAN', '2017-03-06', '2017-03-06', '2017-03-06 13:55:29', 7, 'transportando', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(54, '1462', 'ANA CELIA HUEZO CACERES', '2017-03-07', '2017-03-07', '2017-03-07 13:58:15', 1, 'reinspeccion', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(55, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-03-08', '2017-03-08', '2017-03-08 13:59:43', 17, 'soporte tecnico', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(56, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-03-14', '2017-03-15', '2017-03-16 14:01:34', 29, 'entrega de uniformes', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(57, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-03-28', '2017-03-30', '2017-03-31 14:03:11', 21, 'seguimiento', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(58, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-03-27', '2017-03-29', '2017-03-30 14:20:16', 4, 'proyecto', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(59, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2017-03-30', '2017-03-31', '2017-03-31 14:21:39', 16, 'vigilar', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(60, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-03-15', '2017-03-16', '2017-03-17 14:22:50', 26, 'asesorias', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(61, '2788', 'CESAR RAMON LINARES SERRANO', '2017-03-15', '2017-03-15', '2017-03-16 14:23:53', 17, 'soporte', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(62, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-03-30', '2017-03-31', '2017-03-31 14:24:58', 12, 'supervisor', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(63, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-03-20', '2017-03-22', '2017-03-23 14:27:18', 2, 'reinspeccion', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(64, '772C', 'JOSE FRANCISCO HUEZO', '2017-03-31', '2017-03-31', '2017-03-31 14:28:32', 23, 'entrega de docs', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(65, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2017-03-24', '2017-03-24', '2017-03-27 14:30:29', 17, 'soporte', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(66, '335C', 'ABEL CABRERA ROMAN', '2017-04-03', '2017-04-03', '2017-04-04 14:40:20', 11, 'entrega de insumos', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(67, '1462', 'ANA CELIA HUEZO CACERES', '2017-04-05', '2017-04-07', '2017-04-10 14:43:39', 2, 'reinspeccionar', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(68, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-04-10', '2017-04-10', '2017-04-11 14:45:59', 17, 'soporte', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(69, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-04-14', '2017-04-14', '2017-04-17 14:46:55', 6, 'notificar', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(70, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-04-12', '2017-04-13', '2017-04-14 14:48:40', 3, 'capacitacion', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(71, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-04-12', '2017-04-12', '2017-04-13 14:49:53', 26, 'asesorias', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(72, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2017-04-17', '2017-04-21', '2017-04-24 14:52:00', 16, 'vigilancia', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(73, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-04-29', '2017-04-29', '2017-04-29 14:54:23', 22, 'orientador', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(74, '2788', 'CESAR RAMON LINARES SERRANO', '2017-04-24', '2017-04-24', '2017-04-25 14:55:30', 17, 'soporte', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(75, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-04-13', '2017-04-13', '2017-04-14 14:56:47', 1, 'supervision', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(76, '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2017-04-18', '2017-04-18', '2017-04-19 14:58:16', 17, 'soporte', '988C', '845C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(77, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2017-04-28', '2017-04-28', '2017-05-01 15:01:42', 17, 'soporte', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(78, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-04-17', '2017-04-18', '2017-04-19 15:27:23', 1, 'inspeccion', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(79, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-04-20', '2017-04-21', '2017-04-24 15:28:45', 15, 'reunines', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(80, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-04-21', '2017-04-21', '2017-04-24 15:30:06', 33, 'refuerzo', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(81, '772C', 'JOSE FRANCISCO HUEZO', '2017-04-06', '2017-04-07', '2017-04-10 15:31:24', 36, 'protocolo', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(82, '772C', 'JOSE FRANCISCO HUEZO', '2017-05-29', '2017-05-29', '2017-05-30 15:52:36', 13, 'retiro ', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(83, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-05-12', '2017-05-12', '2017-05-15 16:01:13', 19, 'entrega', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(84, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-05-24', '2017-05-24', '2017-05-25 16:02:24', 31, 'actividad', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(85, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-05-20', '2017-05-20', '2017-05-22 16:06:21', 34, 'censo', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(86, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2017-05-26', '2017-05-30', '2017-05-31 16:07:38', 16, 'vigilar', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(87, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-05-29', '2017-05-29', '2017-05-30 16:10:01', 3, 'capacitar', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(88, '335C', 'ABEL CABRERA ROMAN', '2017-06-29', '2017-06-29', '2017-06-30 21:02:13', 33, 'refuerzo', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(89, '1462', 'ANA CELIA HUEZO CACERES', '2017-06-05', '2017-06-05', '2017-06-06 21:03:49', 25, 'arqueo', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(90, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-06-04', '2017-06-04', '2017-06-05 21:05:30', 35, 'charlas', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(91, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-06-13', '2017-06-15', '2017-06-16 21:07:02', 21, 'seguimiento', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(92, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-07-03', '2017-07-03', '2017-07-04 11:53:58', 10, 'entrega', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(93, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-07-05', '2017-07-05', '2017-07-06 11:55:05', 32, 'inventariar', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(94, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-07-26', '2017-07-28', '2017-07-31 11:57:39', 26, 'asesorias', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(95, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2017-07-18', '2017-07-18', '2017-07-19 12:26:13', 17, 'soporte', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(96, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-08-14', '2017-08-14', '2017-08-15 12:32:14', 6, 'notificar', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(97, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-08-21', '2017-08-21', '2017-08-22 12:33:23', 6, 'notificar', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(98, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-08-28', '2017-08-30', '2017-08-30 12:37:03', 12, 'supervision', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(99, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-08-16', '2017-08-16', '2017-08-17 12:38:48', 24, 'asistencia', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(100, '772C', 'JOSE FRANCISCO HUEZO', '2017-08-24', '2017-08-24', '2017-08-25 12:40:07', 23, 'acreditaciones', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(102, '2788', 'CESAR RAMON LINARES SERRANO', '2017-08-30', '2017-08-31', '2017-09-01 12:46:47', 16, 'vigilar', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(103, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-09-04', '2017-09-04', '2017-09-05 12:52:01', 9, 'reparacion', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(104, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-09-12', '2017-09-12', '2017-09-13 12:55:20', 17, 'soporte', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(105, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2017-09-14', '2017-09-14', '2017-09-15 12:56:03', 17, 'soporte', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(106, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-09-26', '2017-09-26', '2017-09-27 12:57:23', 1, 'inspeccion', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(107, '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2017-09-12', '2017-09-13', '2017-09-14 13:01:38', 4, 'proyecto', '988C', '845C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(108, '335C', 'ABEL CABRERA ROMAN', '2017-09-30', '2017-09-30', '2017-10-02 13:18:01', 2, 'reinspeccion', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(109, '1462', 'ANA CELIA HUEZO CACERES', '2017-10-02', '2017-10-02', '2017-10-03 13:19:17', 15, 'reuniones', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(110, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-10-06', '2017-10-06', '2017-10-09 13:21:58', 12, 'supervision', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(111, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2017-10-10', '2017-10-10', '2017-10-11 13:23:29', 6, 'notificar', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(112, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2017-10-17', '2017-10-18', '2017-10-19 13:24:56', 3, 'capacitacion', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(113, '2905', 'CELIA LUZ TREJO DE CANJURA', '2017-10-25', '2017-10-26', '2017-10-27 13:26:51', 4, 'proyecto', '988C', '827C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(114, '2788', 'CESAR RAMON LINARES SERRANO', '2017-10-16', '2017-10-17', '2017-10-18 13:28:19', 17, 'soporte', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(115, '749C', 'EDGARDO ULISES QUINTANILLA', '2017-11-06', '2017-11-06', '2017-11-07 13:39:02', 5, 'visitas', '988C', '753C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(116, '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2017-11-13', '2017-11-14', '2017-11-15 13:41:10', 24, 'entrega de jefatura', '988C', '845C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(117, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2017-11-23', '2017-11-24', '2017-11-27 13:42:45', 17, 'soporte', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(118, '2347', 'JUAN SANTOS GRACIAS ESCOBAR', '2017-11-27', '2017-11-27', '2017-11-28 13:45:17', 11, 'entrega de insumos', '988C', '802C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(119, '2781', 'JOEL ANTONIO FLORES MARTINEZ', '2017-11-29', '2017-11-29', '2017-11-30 13:46:21', 9, 'reparacion', '988C', '814C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(120, '854C', 'MARVIN ADALI ESCOBAR GUEVARA', '2017-12-12', '2017-12-12', '2017-12-13 13:50:02', 4, 'proyecto', '988C', '851C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(121, '772C', 'JOSE FRANCISCO HUEZO', '2017-12-06', '2017-12-07', '2017-12-08 13:51:21', 16, 'vigilancia', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(122, '335C', 'ABEL CABRERA ROMAN', '2017-12-20', '2017-12-20', '2017-12-21 13:52:28', 1, 'inspeccion', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(123, '1462', 'ANA CELIA HUEZO CACERES', '2017-12-14', '2017-12-14', '2017-12-15 13:53:51', 21, 'seguimiento', '988C', '503C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(124, '2665', 'ANGEL WILLIAN CRUZ GARCIA', '2017-12-11', '2017-12-12', '2017-12-13 13:55:14', 27, 'auditoria interna', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(125, '391C', 'ANTONIO ALBERTO PARRA PANIAGUA', '2018-01-29', '2018-01-30', '2018-01-31 13:57:15', 3, 'capacitacion', '988C', '837C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(126, '2818', 'BRENDA PATRICIA TEOS QUIJADA', '2018-01-15', '2018-01-15', '2018-03-30 13:58:36', 2, 'reinspeccion', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(127, '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2018-01-23', '2018-01-23', '2018-03-30 14:00:14', 34, 'censo', '988C', '862C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(128, '978C', 'CARLOS EDUARDO SALDAÑA AGUILAR', '2018-01-24', '2018-01-25', '2018-03-30 14:01:42', 16, 'vigilar', '988C', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'anVzdGlmaWNhY2lvbg==', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(129, '335C', 'ABEL CABRERA ROMAN', '2018-04-06', '2018-04-06', '2018-04-06 19:03:43', 2, 'sfasf', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(130, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2018-04-16', '2018-04-16', '2018-04-16 22:12:57', 3, 'capacitación', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, '', '0000-00-00 00:00:00', '2018-04-16 00:00:00', 'cheque', '051045454-5454', 00000),
(131, '335C', 'ABEL CABRERA ROMAN', '2018-04-17', '2018-04-17', '2018-04-17 22:41:07', 3, 'kaljskdada', '988C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(132, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2018-04-17', '2018-04-17', '2018-04-17 22:42:06', 4, 'ojdlkasda', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000),
(133, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2018-04-18', '2018-04-19', '2018-04-19 10:12:13', 2, 'Detalle', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, '', '0000-00-00 00:00:00', '2018-04-16 00:00:00', 'efectivo', '', 00000),
(134, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2018-04-26', '2018-04-26', '2018-04-26 09:59:52', 3, '', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '', 00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_observacion_solicitud`
--

DROP TABLE IF EXISTS `vyp_observacion_solicitud`;
CREATE TABLE `vyp_observacion_solicitud` (
  `id_observacion_solicitud` int(10) UNSIGNED NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(150) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `corregido` tinyint(1) NOT NULL,
  `nr_observador` varchar(5) NOT NULL,
  `id_tipo_observador` int(10) UNSIGNED NOT NULL,
  `tipo_observador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_observacion_solicitud`
--

INSERT INTO `vyp_observacion_solicitud` (`id_observacion_solicitud`, `id_mision`, `observacion`, `fecha_hora`, `corregido`, `nr_observador`, `id_tipo_observador`, `tipo_observador`) VALUES
(1, 132, 'dasfsafas', '2018-04-17 22:48:11', 1, '997C', 3, 'Fondo Circulante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_pago_emergencia`
--

DROP TABLE IF EXISTS `vyp_pago_emergencia`;
CREATE TABLE `vyp_pago_emergencia` (
  `id_pago_emergencia` int(10) UNSIGNED NOT NULL,
  `nr` varchar(5) NOT NULL DEFAULT '',
  `fecha_mision_inicio` date NOT NULL DEFAULT '0000-00-00',
  `fecha_mision_fin` date NOT NULL DEFAULT '0000-00-00',
  `id_actividad` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `monto` float(5,2) NOT NULL DEFAULT '0.00',
  `num_cheque` varchar(50) NOT NULL DEFAULT '',
  `fecha_pago` date NOT NULL DEFAULT '0000-00-00',
  `tipo_pago` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_pago_poliza`
--

DROP TABLE IF EXISTS `vyp_pago_poliza`;
CREATE TABLE `vyp_pago_poliza` (
  `id_pago_poliza` int(10) UNSIGNED NOT NULL,
  `sql` text NOT NULL,
  `anio` varchar(4) NOT NULL DEFAULT '',
  `fecha_pago` date NOT NULL DEFAULT '0000-00-00',
  `polizas` varchar(45) NOT NULL DEFAULT '',
  `monto` float(6,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_poliza`
--

DROP TABLE IF EXISTS `vyp_poliza`;
CREATE TABLE `vyp_poliza` (
  `id_poliza` int(10) UNSIGNED NOT NULL,
  `no_doc` int(10) UNSIGNED NOT NULL,
  `no_poliza` int(10) UNSIGNED NOT NULL,
  `mes_poliza` varchar(45) NOT NULL,
  `fecha_elaboracion` date NOT NULL,
  `no_cuenta_cheque` varchar(50) NOT NULL,
  `nr` varchar(5) NOT NULL,
  `fecha_mision` varchar(500) NOT NULL,
  `nombre_empleado` varchar(100) NOT NULL,
  `detalle_mision` varchar(500) NOT NULL,
  `sede` varchar(500) NOT NULL,
  `cargo_funcional` varchar(45) NOT NULL,
  `linea_presup1` varchar(10) NOT NULL,
  `linea_presup2` varchar(10) NOT NULL,
  `viatico` float(10,2) NOT NULL,
  `pasaje` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `mes` varchar(2) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `nombre_banco` varchar(100) NOT NULL,
  `cuenta_bancaria` varchar(50) NOT NULL,
  `fecha_cancelado` date NOT NULL,
  `cod_presupuestario` varchar(45) NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `fecha_elaboracion_poliza` date NOT NULL,
  `nr_elaborador` varchar(5) NOT NULL,
  `estado` int(10) UNSIGNED NOT NULL,
  `compromiso_presupuestario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_alojamientos`
--
ALTER TABLE `vyp_alojamientos`
  ADD PRIMARY KEY (`id_alojamiento`);

--
-- Indices de la tabla `vyp_empleado_cuenta_banco`
--
ALTER TABLE `vyp_empleado_cuenta_banco`
  ADD PRIMARY KEY (`id_empleado_banco`);

--
-- Indices de la tabla `vyp_empresas_visitadas`
--
ALTER TABLE `vyp_empresas_visitadas`
  ADD PRIMARY KEY (`id_empresas_visitadas`);

--
-- Indices de la tabla `vyp_empresa_viatico`
--
ALTER TABLE `vyp_empresa_viatico`
  ADD PRIMARY KEY (`id_empresa_viatico`);

--
-- Indices de la tabla `vyp_estado_solicitud`
--
ALTER TABLE `vyp_estado_solicitud`
  ADD PRIMARY KEY (`id_estado_solicitud`);

--
-- Indices de la tabla `vyp_estructura_planilla`
--
ALTER TABLE `vyp_estructura_planilla`
  ADD PRIMARY KEY (`id_estructura`);

--
-- Indices de la tabla `vyp_generalidades`
--
ALTER TABLE `vyp_generalidades`
  ADD PRIMARY KEY (`id_generalidad`);

--
-- Indices de la tabla `vyp_horario_viatico`
--
ALTER TABLE `vyp_horario_viatico`
  ADD PRIMARY KEY (`id_horario_viatico`);

--
-- Indices de la tabla `vyp_horario_viatico_solicitud`
--
ALTER TABLE `vyp_horario_viatico_solicitud`
  ADD PRIMARY KEY (`id_horario_solicitud`);

--
-- Indices de la tabla `vyp_informacion_empleado`
--
ALTER TABLE `vyp_informacion_empleado`
  ADD PRIMARY KEY (`id_informacion_empleado`);

--
-- Indices de la tabla `vyp_justificaciones`
--
ALTER TABLE `vyp_justificaciones`
  ADD PRIMARY KEY (`id_justificacion`);

--
-- Indices de la tabla `vyp_mision_oficial`
--
ALTER TABLE `vyp_mision_oficial`
  ADD PRIMARY KEY (`id_mision_oficial`);

--
-- Indices de la tabla `vyp_observacion_solicitud`
--
ALTER TABLE `vyp_observacion_solicitud`
  ADD PRIMARY KEY (`id_observacion_solicitud`);

--
-- Indices de la tabla `vyp_pago_emergencia`
--
ALTER TABLE `vyp_pago_emergencia`
  ADD PRIMARY KEY (`id_pago_emergencia`);

--
-- Indices de la tabla `vyp_pago_poliza`
--
ALTER TABLE `vyp_pago_poliza`
  ADD PRIMARY KEY (`id_pago_poliza`);

--
-- Indices de la tabla `vyp_poliza`
--
ALTER TABLE `vyp_poliza`
  ADD PRIMARY KEY (`id_poliza`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_alojamientos`
--
ALTER TABLE `vyp_alojamientos`
  MODIFY `id_alojamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `vyp_empleado_cuenta_banco`
--
ALTER TABLE `vyp_empleado_cuenta_banco`
  MODIFY `id_empleado_banco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `vyp_empresas_visitadas`
--
ALTER TABLE `vyp_empresas_visitadas`
  MODIFY `id_empresas_visitadas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `vyp_estado_solicitud`
--
ALTER TABLE `vyp_estado_solicitud`
  MODIFY `id_estado_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `vyp_estructura_planilla`
--
ALTER TABLE `vyp_estructura_planilla`
  MODIFY `id_estructura` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `vyp_horario_viatico`
--
ALTER TABLE `vyp_horario_viatico`
  MODIFY `id_horario_viatico` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vyp_horario_viatico_solicitud`
--
ALTER TABLE `vyp_horario_viatico_solicitud`
  MODIFY `id_horario_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT de la tabla `vyp_informacion_empleado`
--
ALTER TABLE `vyp_informacion_empleado`
  MODIFY `id_informacion_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `vyp_mision_oficial`
--
ALTER TABLE `vyp_mision_oficial`
  MODIFY `id_mision_oficial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT de la tabla `vyp_observacion_solicitud`
--
ALTER TABLE `vyp_observacion_solicitud`
  MODIFY `id_observacion_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vyp_pago_emergencia`
--
ALTER TABLE `vyp_pago_emergencia`
  MODIFY `id_pago_emergencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vyp_pago_poliza`
--
ALTER TABLE `vyp_pago_poliza`
  MODIFY `id_pago_poliza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vyp_poliza`
--
ALTER TABLE `vyp_poliza`
  MODIFY `id_poliza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=611;
COMMIT;
