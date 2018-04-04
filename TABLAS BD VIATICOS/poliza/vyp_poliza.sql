--
-- Estructura de tabla para la tabla `vyp_poliza`
--

DROP TABLE IF EXISTS `vyp_poliza`;
CREATE TABLE `vyp_poliza` (
  `id_poliza` int(10) UNSIGNED NOT NULL,
  `no_doc` int(10) UNSIGNED NOT NULL,
  `no_poliza` int(10) UNSIGNED NOT NULL,
  `mes_poliza` varchar(45) NOT NULL,
  `fecha_elaboracion` date NOT NULL,
  `no_cuenta_cheque` varchar(50) NOT NULL,
  `nr` varchar(5) NOT NULL,
  `fecha_mision` varchar(500) NOT NULL,
  `nombre_empleado` varchar(100) NOT NULL,
  `detalle_mision` varchar(500) NOT NULL,
  `sede` varchar(500) NOT NULL,
  `cargo_funcional` varchar(45) NOT NULL,
  `linea_presup1` varchar(10) NOT NULL,
  `linea_presup2` varchar(10) NOT NULL,
  `viatico` float(10,2) NOT NULL,
  `pasaje` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `mes` varchar(2) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `nombre_banco` varchar(100) NOT NULL,
  `cuenta_bancaria` varchar(50) NOT NULL,
  `fecha_cancelado` date NOT NULL,
  `cod_presupuestario` varchar(45) NOT NULL,
  `id_mision` int(10) UNSIGNED NOT NULL,
  `fecha_elaboracion_poliza` date NOT NULL,
  `nr_elaborador` varchar(5) NOT NULL,
  `estado` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_poliza`
--
ALTER TABLE `vyp_poliza`
  ADD PRIMARY KEY (`id_poliza`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_poliza`
--
ALTER TABLE `vyp_poliza`
  MODIFY `id_poliza` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
