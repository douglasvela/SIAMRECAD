--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_empleado_cuenta_banco`
--

DROP TABLE IF EXISTS `vyp_empleado_cuenta_banco`;
CREATE TABLE `vyp_empleado_cuenta_banco` (
  `id_empleado_banco` int(10) UNSIGNED NOT NULL,
  `nr` varchar(4) NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL,
  `numero_cuenta` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_empleado_cuenta_banco`
--

INSERT INTO `vyp_empleado_cuenta_banco` (`id_empleado_banco`, `nr`, `id_banco`, `numero_cuenta`, `estado`) VALUES
(1, '2588', 1, '0001-3245-124-100', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_empleado_cuenta_banco`
--
ALTER TABLE `vyp_empleado_cuenta_banco`
  ADD PRIMARY KEY (`id_empleado_banco`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_empleado_cuenta_banco`
--
ALTER TABLE `vyp_empleado_cuenta_banco`
  MODIFY `id_empleado_banco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
