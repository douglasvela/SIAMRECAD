--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_informacion_empleado`
--

DROP TABLE IF EXISTS `vyp_informacion_empleado`;
CREATE TABLE `vyp_informacion_empleado` (
  `id_informacion_empleado` int(10) UNSIGNED NOT NULL,
  `nr` varchar(4) NOT NULL,
  `nr_jefe_inmediato` varchar(4) NOT NULL,
  `id_oficina_departamental` varchar(5) NOT NULL,
  `partida` varchar(45) NOT NULL,
  `sub_numero` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_informacion_empleado`
--

INSERT INTO `vyp_informacion_empleado` (`id_informacion_empleado`, `nr`, `nr_jefe_inmediato`, `id_oficina_departamental`, `partida`, `sub_numero`) VALUES
(1, '2588', '988C', '1', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_informacion_empleado`
--
ALTER TABLE `vyp_informacion_empleado`
  ADD PRIMARY KEY (`id_informacion_empleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_informacion_empleado`
--
ALTER TABLE `vyp_informacion_empleado`
  MODIFY `id_informacion_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;