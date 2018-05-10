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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_pago_emergencia`
--
ALTER TABLE `vyp_pago_emergencia`
  ADD PRIMARY KEY (`id_pago_emergencia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_pago_emergencia`
--
ALTER TABLE `vyp_pago_emergencia`
  MODIFY `id_pago_emergencia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;