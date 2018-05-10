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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_alojamientos`
--
ALTER TABLE `vyp_alojamientos`
  ADD PRIMARY KEY (`id_alojamiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_alojamientos`
--
ALTER TABLE `vyp_alojamientos`
  MODIFY `id_alojamiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
