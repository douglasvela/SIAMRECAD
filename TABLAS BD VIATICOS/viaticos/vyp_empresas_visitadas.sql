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
