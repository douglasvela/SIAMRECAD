--
-- Base de datos: `mtps`
--

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_observacion_solicitud`
--
ALTER TABLE `vyp_observacion_solicitud`
  ADD PRIMARY KEY (`id_observacion_solicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_observacion_solicitud`
--
ALTER TABLE `vyp_observacion_solicitud`
  MODIFY `id_observacion_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
