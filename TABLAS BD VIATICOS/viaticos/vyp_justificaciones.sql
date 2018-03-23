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
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_justificaciones`
--
ALTER TABLE `vyp_justificaciones`
  ADD PRIMARY KEY (`id_justificacion`);
