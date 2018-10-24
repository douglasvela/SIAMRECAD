
CREATE TABLE `vyp_bitacora_solicitud_viatico` (
  `id_bitacora_solicitud_viatico` int(10) UNSIGNED NOT NULL,
  `fecha_antigua` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_actualizacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tiempo_dias` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `persona_actualiza` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_mision` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_bitacora_solicitud_viatico`
--
ALTER TABLE `vyp_bitacora_solicitud_viatico`
  ADD PRIMARY KEY (`id_bitacora_solicitud_viatico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_bitacora_solicitud_viatico`
--
ALTER TABLE `vyp_bitacora_solicitud_viatico`
  MODIFY `id_bitacora_solicitud_viatico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;
