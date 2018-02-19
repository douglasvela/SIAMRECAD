--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_estado_solicitud`
--

DROP TABLE IF EXISTS `vyp_estado_solicitud`;
CREATE TABLE `vyp_estado_solicitud` (
  `id_estado_solicitud` int(10) UNSIGNED NOT NULL,
  `nombre_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_estado_solicitud`
--
ALTER TABLE `vyp_estado_solicitud`
  ADD PRIMARY KEY (`id_estado_solicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_estado_solicitud`
--
ALTER TABLE `vyp_estado_solicitud`
  MODIFY `id_estado_solicitud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
