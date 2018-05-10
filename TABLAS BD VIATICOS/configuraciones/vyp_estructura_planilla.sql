--
-- Estructura de tabla para la tabla `vyp_estructura_planilla`
--

DROP TABLE IF EXISTS `vyp_estructura_planilla`;
CREATE TABLE `vyp_estructura_planilla` (
  `id_estructura` int(10) UNSIGNED NOT NULL,
  `id_banco` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre_campo` varchar(100) NOT NULL DEFAULT '',
  `valor_campo` varchar(45) NOT NULL DEFAULT '',
  `name_campo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_estructura_planilla`
--
ALTER TABLE `vyp_estructura_planilla`
  ADD PRIMARY KEY (`id_estructura`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_estructura_planilla`
--
ALTER TABLE `vyp_estructura_planilla`
  MODIFY `id_estructura` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;