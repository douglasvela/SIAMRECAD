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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_generalidades`
--
ALTER TABLE `vyp_generalidades`
  ADD PRIMARY KEY (`id_generalidad`);
COMMIT;