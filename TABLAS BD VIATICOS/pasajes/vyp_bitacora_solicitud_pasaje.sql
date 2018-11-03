--
-- Estructura de tabla para la tabla `vyp_bitacora_solicitud_pasaje`
--

CREATE TABLE `vyp_bitacora_solicitud_pasaje` (
  `id_bitacora_solicitud_pasaje` int(10) UNSIGNED NOT NULL,
  `fecha_antigua` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_actualizacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tiempo_dias` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `persona_actualiza` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_mision` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nr_persona_actualiza` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `vyp_bitacora_solicitud_pasaje`
  ADD PRIMARY KEY (`id_bitacora_solicitud_pasaje`);
  
ALTER TABLE `vyp_bitacora_solicitud_pasaje`
  MODIFY `id_bitacora_solicitud_pasaje` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
