--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_empresas_visitadas`
--

DROP TABLE IF EXISTS `vyp_empresas_visitadas`;
CREATE TABLE `vyp_empresas_visitadas` (
  `id_empresas_visitadas` int(10) UNSIGNED NOT NULL,
  `id_mision_oficial` int(10) UNSIGNED NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_municipio` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(200) NOT NULL,
  `tipo_destino` varchar(45) NOT NULL,
  `kilometraje` float NOT NULL,
  `id_destino` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_empresas_visitadas`
--
ALTER TABLE `vyp_empresas_visitadas`
  ADD PRIMARY KEY (`id_empresas_visitadas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_empresas_visitadas`
--
ALTER TABLE `vyp_empresas_visitadas`
  MODIFY `id_empresas_visitadas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

  
--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_empresa_viatico`
--

DROP TABLE IF EXISTS `vyp_empresa_viatico`;
CREATE TABLE `vyp_empresa_viatico` (
  `id_empresa_viatico` int(10) UNSIGNED NOT NULL,
  `id_origen` int(10) UNSIGNED NOT NULL,
  `id_destino` int(10) UNSIGNED NOT NULL,
  `nombre_origen` varchar(250) NOT NULL,
  `nombre_destino` varchar(250) NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_llegada` time NOT NULL,
  `pasaje` float(3,2) NOT NULL,
  `viatico` float(5,2) NOT NULL,
  `alojamiento` float(5,2) NOT NULL,
  `horarios_viaticos` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `factura` varchar(45) NOT NULL,
  `kilometraje` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_empresa_viatico`
--
ALTER TABLE `vyp_empresa_viatico`
  ADD PRIMARY KEY (`id_empresa_viatico`);

  
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


--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_horario_viatico`
--

DROP TABLE IF EXISTS `vyp_horario_viatico`;
CREATE TABLE `vyp_horario_viatico` (
  `id_horario_viatico` int(10) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `monto` float(5,2) NOT NULL,
  `id_tipo` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_restriccion` int(10) UNSIGNED NOT NULL,
  `id_viatico_restriccion` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_horario_viatico`
--

INSERT INTO `vyp_horario_viatico` (`id_horario_viatico`, `descripcion`, `hora_inicio`, `hora_fin`, `monto`, `id_tipo`, `estado`, `id_restriccion`, `id_viatico_restriccion`) VALUES
(1, 'Desayuno', '05:00:00', '06:30:00', 3.00, 1, 1, 1, 0),
(2, 'Almuerzo', '11:30:00', '13:10:00', 4.00, 1, 1, 1, 0),
(3, 'Cena', '18:30:00', '23:59:00', 4.00, 1, 1, 1, 0),
(4, 'Restriccion de almuerzo', '11:31:00', '13:09:00', 0.00, 2, 1, 4, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_horario_viatico`
--
ALTER TABLE `vyp_horario_viatico`
  ADD PRIMARY KEY (`id_horario_viatico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_horario_viatico`
--
ALTER TABLE `vyp_horario_viatico`
  MODIFY `id_horario_viatico` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

  
  
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
  
  
  
--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

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
  `aprobado1` tinyint(1) NOT NULL DEFAULT '0',
  `aprobado2` tinyint(1) NOT NULL DEFAULT '0',
  `aprobado3` tinyint(1) NOT NULL DEFAULT '0',
  `estado` int(10) UNSIGNED NOT NULL DEFAULT '0'
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
