--
-- Base de datos: `mtps`
--

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
  `id_ruta_visitada` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_horario_viatico_solicitud`
--
ALTER TABLE `vyp_horario_viatico_solicitud`
  ADD PRIMARY KEY (`id_horario_solicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_horario_viatico_solicitud`
--
ALTER TABLE `vyp_horario_viatico_solicitud`
  MODIFY `id_horario_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
