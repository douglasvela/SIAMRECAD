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
