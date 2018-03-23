--
-- Estructura de tabla para la tabla `vyp_generalidades`
--

DROP TABLE IF EXISTS `vyp_generalidades`;
CREATE TABLE `vyp_generalidades` (
  `id_generalidad` int(10) UNSIGNED NOT NULL,
  `pasaje` float(5,2) NOT NULL,
  `alojamiento` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_generalidades`
--
ALTER TABLE `vyp_generalidades`
  ADD PRIMARY KEY (`id_generalidad`);