--
-- Estructura de tabla para la tabla `vyp_bancos`
--

DROP TABLE IF EXISTS `vyp_bancos`;
CREATE TABLE `vyp_bancos` (
  `id_banco` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `caracteristicas` varchar(100) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `delimitador` varchar(10) NOT NULL DEFAULT '',
  `archivo` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_bancos`
--

INSERT INTO `vyp_bancos` (`id_banco`, `nombre`, `caracteristicas`, `codigo`, `delimitador`, `archivo`) VALUES
(1, 'Banco Agrícola', '', '127', ';', 'txt'),
(2, 'Banco Cuscatlán', '', '2647', '', ''),
(3, 'Banco Hipotecario', '', '25487', '', ''),
(4, 'Banco Davivienda', '', '7844', '', ''),
(5, 'Banco azul', '', '874', '', ''),
(6, 'Banco Hernandez', '', '54788', '-,', 'txt');
COMMIT;