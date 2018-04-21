--
-- Estructura de tabla para la tabla `vyp_mision_oficial`
--

DROP TABLE IF EXISTS `vyp_mision_oficial`;
CREATE TABLE `vyp_mision_oficial` (
  `id_mision_oficial` int(10) UNSIGNED NOT NULL,
  `nr_empleado` varchar(5) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `fecha_mision_inicio` date NOT NULL,
  `fecha_mision_fin` date NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `id_actividad_realizada` int(10) UNSIGNED NOT NULL,
  `detalle_actividad` varchar(500) NOT NULL,
  `nr_jefe_inmediato` varchar(5) NOT NULL,
  `nr_jefe_regional` varchar(5) NOT NULL,
  `aprobado1` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aprobado2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aprobado3` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ruta_justificacion` varchar(200) NOT NULL,
  `ultima_observacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_mision_oficial`
--
ALTER TABLE `vyp_mision_oficial`
  ADD PRIMARY KEY (`id_mision_oficial`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_mision_oficial`
--
ALTER TABLE `vyp_mision_oficial`
  MODIFY `id_mision_oficial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
