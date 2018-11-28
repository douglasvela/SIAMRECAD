-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2018 a las 03:11:17
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mtps`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_actividades`
--

CREATE TABLE `vyp_actividades` (
  `id_vyp_actividades` int(9) NOT NULL,
  `nombre_vyp_actividades` varchar(125) NOT NULL,
  `depende_vyp_actividades` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_actividades`
--

INSERT INTO `vyp_actividades` (`id_vyp_actividades`, `nombre_vyp_actividades`, `depende_vyp_actividades`) VALUES
(1, 'INSPECCIÓN  PROGRAMADA', 0),
(2, 'REINSPECCIÓN ', 0),
(3, 'CAPACITACIÓN', 0),
(4, 'PROYECTO', 0),
(5, 'VISITAS TÉCNICAS DE HIGIENE OCUPACIONAL', 0),
(6, 'NOTIFICAR', 0),
(7, 'TRANSPORTANDO AL PERSONAL', 0),
(8, 'FERIA DE EMPLEO', 0),
(9, 'MANTENIMIENTO Y REPARACIÓN', 0),
(10, 'ENTREGA DE DOCUMENTACIÓN ', 0),
(11, 'ENTREGA DE INSUMOS CENTROS RECREATIVOS', 0),
(12, 'SUPERVISIÓN DE OBRA', 0),
(13, 'RETIRO DE VALE COMBUSTIBLE', 0),
(14, 'RETIRO DE PAPELERIA', 0),
(15, 'REUNIONES', 0),
(16, 'HACIENDO TURNO DE VIGILANCIA', 0),
(17, 'SOPORTE TÉCNICO', 0),
(18, 'RECOLECCIÓN DE FONDOS A LOS CENTROS RECREATIVOS DE MTPS', 0),
(19, 'ENTREGAR OFICIO DE EMBARGO A LOS JUZGADOS', 0),
(20, 'TOMA MEDIDA DE UNIFORMES DEL PERSONAL  MTPS', 0),
(21, 'SEGUIMIENTO DEL FUNCIONAMIENTO DE COMITÉ Y VERIFICACIÓN DE CUMPLIMIENTO DE ART. 10  DEL   R.G.P.L.T', 0),
(22, 'INTERMEDIACIÓN LABORAL', 0),
(23, 'ENTREGA DE ACREDITACIONES DE COMITÉ DE SEGURIDAD Y SALUD OCUPACIONAL', 0),
(24, 'ASISTENCIA A ENTREGA DE JEFATURA ', 0),
(25, 'ARQUEO DE CAJA CHICA, REVISIÓN DE DOCUMENTACIÓN ANUAL', 0),
(26, 'REALIZANDO ASESORIA  EN LAS OFICINAS DEPARTAMENTALES MTPS', 0),
(27, 'AUDITORIA INTERNA', 0),
(28, 'ENTREGA DE PAQUETE DE MATERNIDAD,CLAUSULA N°56 DEL CONTRATO COLECTIVO MTPS', 0),
(29, 'ENTREGA DE UNIFORMES AL PERSONAL  MTPS', 0),
(30, 'ENTREGA DE CERTIFICADOS DEL SUPERMERCADO, CLAUSULA N°57 DEL CONTRATO  COLECTIVO  MTPS', 0),
(31, 'REPRESENTACIÓN POR FALLECIMIENTO DE LA TRABAJADORA O TRABAJADOR', 0),
(32, 'INVENTARIO ANUAL DE ACTIVO FIJO ', 0),
(33, 'PROGRAMA DE REFUERZO DE CAPACIDADES TÉCNICAS NUEVAS EN LOS FORMATOS ICS-AG', 0),
(34, 'CENSO DE CONTRATACION COLECTIVA DE TRABAJO', 0),
(35, 'CHARLAS INFORMATIVAS SOBRE ENCUESTAS DE ESTABLECIMIENTOS EMPLEOS,HORAS ,SALARIOS', 0),
(36, 'PROTOCOLO  INSTITUCIONALES Y GUBERNAMENTALES', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_mision_pasajes`
--

CREATE TABLE `vyp_mision_pasajes` (
  `id_mision_pasajes` int(11) NOT NULL,
  `nr` varchar(5) NOT NULL,
  `nombre_empleado` varchar(30) NOT NULL,
  `nr_jefe_inmediato` varchar(5) NOT NULL,
  `nr_jefe_regional` varchar(5) NOT NULL,
  `aprobado1` datetime NOT NULL,
  `aprobado2` datetime NOT NULL,
  `aprobado3` datetime NOT NULL,
  `estado` int(10) NOT NULL,
  `ruta_justificacion` varchar(200) NOT NULL,
  `ultima_observacion` date NOT NULL,
  `mes_pasaje` int(2) UNSIGNED ZEROFILL NOT NULL,
  `anio_pasaje` int(4) NOT NULL,
  `fecha_solicitud_pasaje` datetime NOT NULL,
  `fechas_pasajes` varchar(100) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `id_empleado_informacion_laboral` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id_oficina` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_mision_pasajes`
--

INSERT INTO `vyp_mision_pasajes` (`id_mision_pasajes`, `nr`, `nombre_empleado`, `nr_jefe_inmediato`, `nr_jefe_regional`, `aprobado1`, `aprobado2`, `aprobado3`, `estado`, `ruta_justificacion`, `ultima_observacion`, `mes_pasaje`, `anio_pasaje`, `fecha_solicitud_pasaje`, `fechas_pasajes`, `fecha_pago`, `id_empleado_informacion_laboral`, `id_oficina`) VALUES
(5, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA ', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '0000-00-00', 07, 2018, '2018-07-02 00:00:00', '2018-07-02,2018-07-02,', '0000-00-00 00:00:00', 0000000000, 00000),
(6, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA ', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '0000-00-00', 08, 2018, '2018-08-08 00:00:00', '2018-08-08,', '0000-00-00 00:00:00', 0000000000, 00000),
(7, '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA ', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '', '2018-11-13', 11, 2018, '2018-11-12 00:00:00', '2018-11-12,', '0000-00-00 00:00:00', 0000000000, 00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_observaciones_pasajes`
--

CREATE TABLE `vyp_observaciones_pasajes` (
  `id_observacion_pasaje` int(10) UNSIGNED NOT NULL,
  `id_mision_pasajes` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(150) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `corregido` tinyint(1) NOT NULL,
  `nr_observador` varchar(5) NOT NULL,
  `id_tipo_observador` int(10) UNSIGNED NOT NULL,
  `tipo_observador` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_observaciones_pasajes`
--

INSERT INTO `vyp_observaciones_pasajes` (`id_observacion_pasaje`, `id_mision_pasajes`, `observacion`, `fecha_hora`, `corregido`, `nr_observador`, `id_tipo_observador`, `tipo_observador`) VALUES
(4, 5, 'observacionn1', '2018-05-26 14:27:05', 0, '988C', 1, 'Jefe inmediato'),
(5, 1, 'observacionn1s', '2018-05-26 14:29:46', 1, '988C', 1, 'Jefe inmediato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_oficinas`
--

CREATE TABLE `vyp_oficinas` (
  `id_oficina` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nombre_oficina` varchar(200) NOT NULL,
  `direccion_oficina` varchar(400) NOT NULL,
  `jefe_oficina` varchar(250) NOT NULL,
  `email_oficina` varchar(250) NOT NULL,
  `latitud_oficina` varchar(50) NOT NULL,
  `longitud_oficina` varchar(50) NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_municipio` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_zona` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_oficinas`
--

INSERT INTO `vyp_oficinas` (`id_oficina`, `nombre_oficina`, `direccion_oficina`, `jefe_oficina`, `email_oficina`, `latitud_oficina`, `longitud_oficina`, `id_departamento`, `id_municipio`, `id_zona`) VALUES
(00001, 'Oficina Central (San Salvador)', 'Centro de Gobierno, San Salvador, El Salvador', '1000106 ', 'correo@mtps.gob.sv', '13.705537711909635', ' -89.20028865337372', 00006, 00097, 2),
(00002, 'Oficina Regional de Oriente (San Miguel)', 'Av. José Simeón Cañas No.408, Barrio El Calvario, San Miguel', '218 ', 'correo@mtps.gob.sv', '13.478020143745484', ' -88.17572677799063', 00012, 00199, 3),
(00003, 'Oficina Regional de Occidente (Santa Ana)', 'Urbanizacion Pinar, Santa Ana, El Salvador', '1000035 ', 'correo@mtps.gob.sv', '13.995933662977752', ' -89.5583762973547', 00002, 00013, 1),
(00004, 'Oficina Paracentral (La Paz)', 'Zacatecoluca, El Salvador', '472 ', 'correo@mtps.gob.sv', '13.507455381779852', ' -88.86813059449196', 00008, 00132, 2),
(00005, 'Oficina Departamental de Sonsonate', 'Colonia Santa Eugenia, Sonzacate, El Salvador', '197 ', 'correo@mtps.gob.sv', '13.732193904974437', ' -89.7128427028656', 00003, 00041, 1),
(00006, 'Oficina Departamental de la Unión', 'Sector San Antonio, La Union, El Salvador', '761 ', 'correo@mtps.gob.sv', '13.338405970309157', ' -87.85244576632977', 00014, 00245, 3),
(00007, 'Oficina Departamental de Ahuachapán', 'Ahuachapán, El Salvador', '458 ', 'correo@mtps.gob.sv', '13.92127967535732', ' -89.84679724999131', 00001, 00001, 1),
(00008, 'Oficina Departamental de Cuscatlán', 'Cojutepeque, El Salvador', '86 ', 'correo@mtps.gob.sv', '13.721479677884348', ' -88.93028140068054', 00007, 00116, 2),
(00009, 'Oficina Departamental de la Libertad', 'Residencial Vila Camila, Santa Tecla, El Salvador', '236 ', 'correo@mtps.gob.sv', '13.677130422693326', ' -89.28797056844309', 00005, 00075, 2),
(00010, 'Oficina Departamental de San Vicente', 'Colonia dos Puentes, San Vicente, El Salvador', '818 ', 'correo@mtps.gob.sv', '13.647047397980815', ' -88.78603285368712', 00010, 00163, 2),
(00011, 'Oficina Departamental de Chalatenango', 'Chalatenango, El Salvador', '208 ', 'correo@mtps.gob.sv', '14.043248396714018', ' -88.93669141068176', 00004, 00042, 2),
(00012, 'Oficina Departamental de Morazán', 'Barrio El Centro, San Francisco Gotera, El Salvador', '134 ', 'correo@mtps.gob.sv', '13.695739562788676', ' -88.10587495565414', 00013, 00219, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_oficinas_telefono`
--

CREATE TABLE `vyp_oficinas_telefono` (
  `id_vyp_oficinas_telefono` int(11) NOT NULL,
  `telefono_vyp_oficnas_telefono` varchar(9) NOT NULL,
  `id_oficina_vyp_oficnas_telefono` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_pasajes`
--

CREATE TABLE `vyp_pasajes` (
  `id_solicitud_pasaje` int(11) NOT NULL,
  `id_municipio` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_departamento` int(5) UNSIGNED ZEROFILL NOT NULL,
  `fecha_mision` date NOT NULL,
  `no_expediente` varchar(15) NOT NULL,
  `empresa_visitada` varchar(30) NOT NULL,
  `direccion_empresa` varchar(50) NOT NULL,
  `nr` varchar(10) NOT NULL,
  `monto_pasaje` float(10,2) NOT NULL,
  `id_actividad_realizada` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_mision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_pasajes`
--

INSERT INTO `vyp_pasajes` (`id_solicitud_pasaje`, `id_municipio`, `id_departamento`, `fecha_mision`, `no_expediente`, `empresa_visitada`, `direccion_empresa`, `nr`, `monto_pasaje`, `id_actividad_realizada`, `estado`, `id_mision`) VALUES
(2, 00002, 00001, '2018-06-29', '05488', 'Empresa 2', 'Direccion empresa 2', '2588', 0.75, 4, 0, 3),
(3, 00014, 00002, '2018-06-26', '48484', 'Empresa 2', 'Direccion empresa 2', '2588', 0.75, 1, 0, 4),
(4, 00014, 00002, '2018-07-02', '48484', 'Empresa 2', 'Direccion empresa 2', '2588', 0.75, 6, 0, 5),
(5, 00001, 00001, '2018-07-02', '124554', 'siman plaza mundo', 'Cuarta calle Poniente lejos de no se donde es larg', '2588', 0.40, 1, 0, 5),
(6, 00027, 00003, '2018-11-12', 'gfdg', 'jdddgfdgddg', 'gfddggdfgddgdg', '2588', 7.00, 27, 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vyp_rutas`
--

CREATE TABLE `vyp_rutas` (
  `id_vyp_rutas` int(11) NOT NULL,
  `id_oficina_origen_vyp_rutas` int(5) UNSIGNED ZEROFILL NOT NULL,
  `id_oficina_destino_vyp_rutas` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `id_departamento_vyp_rutas` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `id_municipio_vyp_rutas` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `km_vyp_rutas` float(10,2) NOT NULL,
  `descripcion_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `latitud_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `longitud_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `opcionruta_vyp_rutas` varchar(35) NOT NULL,
  `nombre_empresa_vyp_rutas` varchar(200) DEFAULT NULL,
  `direccion_empresa_vyp_rutas` varchar(400) DEFAULT NULL,
  `estado_vyp_rutas` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vyp_rutas`
--

INSERT INTO `vyp_rutas` (`id_vyp_rutas`, `id_oficina_origen_vyp_rutas`, `id_oficina_destino_vyp_rutas`, `id_departamento_vyp_rutas`, `id_municipio_vyp_rutas`, `km_vyp_rutas`, `descripcion_destino_vyp_rutas`, `latitud_destino_vyp_rutas`, `longitud_destino_vyp_rutas`, `opcionruta_vyp_rutas`, `nombre_empresa_vyp_rutas`, `direccion_empresa_vyp_rutas`, `estado_vyp_rutas`) VALUES
(1, 00002, 00000, 00001, 00001, 252.00, 'Oficina Regional de Oriente (San Miguel) - AHUACHAPÁN/AHUACHAPAN', '', '', 'destino_municipio', 'Empresa conducción', 'Dirección de la empresa conducción', 0),
(2, 00002, 00000, 00002, 00013, 235.00, 'Oficina Regional de Oriente (San Miguel) - SANTA ANA/SANTA ANA', '', '', 'destino_municipio', 'Empresa conducción 2', 'Dirección segunda empresa de conducción 2', 0),
(3, 00005, 00007, 00001, 00001, 45.40, 'Oficina Departamental de Sonsonate - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 0),
(4, 00007, 00005, 00003, 00041, 44.00, 'Oficina Departamental de Ahuachapán - Oficina Departamental de Sonsonate', '13.732193904974437', ' -89.7128427028656', 'destino_oficina', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 0),
(5, 00010, 00004, 00008, 00132, 38.20, 'Oficina Departamental de San Vicente - Oficina Paracentral (La Paz)', '13.507455381779852', ' -88.86813059449196', 'destino_oficina', 'Oficina Paracentral (La Paz)', 'Oficina Paracentral (La Paz)', 0),
(6, 00004, 00010, 00010, 00163, 38.20, 'Oficina Paracentral (La Paz) - Oficina Departamental de San Vicente', '13.647047397980815', ' -88.78603285368712', 'destino_oficina', 'Oficina Departamental de San Vicente', 'Oficina Departamental de San Vicente', 0),
(7, 00010, 00000, 00009, 00158, 32.84, 'Oficina Departamental de San Vicente - CABAÑAS/ILOBASCO', '13.834522184855262', '-88.85495385927561', 'destino_mapa', 'Empresa en ilobasco', 'Carretera desconocida, Ilobasco, El Salvador', 0),
(8, 00010, 00000, 00010, 00172, 15.94, 'Oficina Departamental de San Vicente - SAN VICENTE/SANTO DOMINGO', '13.721805268603223', '-88.85241975348868', 'destino_mapa', 'Avicola los teques', 'Carretera desconocida, Santo Domingo, El Salvador', 0),
(9, 00003, 00000, 00002, 00013, 4.21, 'Oficina Regional de Occidente (Santa Ana) - SANTA ANA/SANTA ANA', '13.970743229788164', '-89.57460152450267', 'destino_mapa', 'UES - Santa Ana', 'Calle Universitaria, Santa Ana, El Salvador', 0),
(10, 00003, 00000, 00001, 00001, 39.06, 'Oficina Regional de Occidente (Santa Ana) - AHUACHAPÁN/AHUACHAPAN', '13.925049241350859', '-89.85095500946045', 'destino_mapa', 'Instituto Nacional Alejandro de Humbolt', 'Ahuachapán, El Salvador', 0),
(11, 00003, 00000, 00002, 00013, 21.92, 'Oficina Regional de Occidente (Santa Ana) - SANTA ANA/SANTA ANA', '13.891254887219594', '-89.54903213372955', 'destino_mapa', 'Centro de Recreación \'Constitución 1950\', Santa Ana, El Salvador', 'Centro de Recreación \'Constitución 1950\', Santa Ana, El Salvador', 0),
(12, 00012, 00002, 00012, 00199, 40.50, 'Oficina Departamental de Morazán - Oficina Regional de Oriente (San Miguel)', '13.478020143745484', ' -88.17572677799063', 'destino_oficina', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 0),
(13, 00002, 00012, 00013, 00219, 40.50, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de Morazán', '13.695739562788676', ' -88.10587495565414', 'destino_oficina', 'Oficina Departamental de Morazán', 'Oficina Departamental de Morazán', 0),
(14, 00005, 00003, 00002, 00013, 44.00, 'Oficina Departamental de Sonsonate - Oficina Regional de Occidente (Santa Ana)', '13.995933662977752', ' -89.5583762973547', 'destino_oficina', 'Oficina Regional de Occidente (Santa Ana)', 'Oficina Regional de Occidente (Santa Ana)', 0),
(15, 00003, 00005, 00003, 00041, 44.00, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de Sonsonate', '13.732193904974437', ' -89.7128427028656', 'destino_oficina', 'Oficina Departamental de Sonsonate', 'Oficina Departamental de Sonsonate', 0),
(18, 00006, 00002, 00012, 00199, 54.60, 'Oficina Departamental de la Unión - Oficina Regional de Oriente (San Miguel)', '13.478020143745484', ' -88.17572677799063', 'destino_oficina', 'Oficina Regional de Oriente (San Miguel)', 'Oficina Regional de Oriente (San Miguel)', 0),
(19, 00002, 00006, 00014, 00245, 54.60, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de la Unión', '13.338405970309157', ' -87.85244576632977', 'destino_oficina', 'Oficina Departamental de la Unión', 'Oficina Departamental de la Unión', 0),
(20, 00008, 00000, 00005, 00084, 72.46, 'Oficina Departamental de Cuscatlán - SANTA TECLA/LA LIBERTAD', '13.483360946780984', '-89.33601109748383', 'destino_mapa', 'Centro de Recreación conchalio', 'CA-2, La Libertad, El Salvador', 0),
(21, 00011, 00008, 00007, 00116, 108.00, 'Oficina Departamental de Chalatenango - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 0),
(22, 00008, 00011, 00004, 00042, 108.00, 'Oficina Departamental de Cuscatlán - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 0),
(23, 00002, 00000, 00005, 00084, 5.13, 'Oficina Regional de Oriente (San Miguel) - SANTA TECLA/LA LIBERTAD', '13.507530807345402', '-88.15479998017457', 'destino_mapa', 'Taller en Hato nuevo', 'Ruta Militar, Hato Nuevo, El Salvador', 0),
(24, 00002, 00000, 00012, 00205, 16.31, 'Oficina Regional de Oriente (San Miguel) - SAN MIGUEL/COMACARAN', '13.529504779298957', '-88.0651089938109', 'destino_mapa', 'Empresa en comacaran', 'Calle San Miguel - Comacaran, Comacarán, El Salvador', 0),
(25, 00003, 00000, 00006, 00097, 67.44, 'Oficina Regional de Occidente (Santa Ana) - SAN SALVADOR/SAN SALVADOR', '13.710369107588999', '-89.19902389671711', 'destino_mapa', 'Empresa capacitadora', 'Calle Las Victorias, San Salvador, El Salvador', 0),
(26, 00003, 00000, 00002, 00013, 5.45, 'Oficina Regional de Occidente (Santa Ana) - SANTA ANA/SANTA ANA', '13.99874489392614', '-89.53337111206054', 'destino_mapa', 'probando empresa cercana', 'Carretera desconocida, Santa Ana, El Salvador', 0),
(27, 00001, 00000, 00001, 00001, 32.00, 'Oficina Central (San Salvador) - AHUACHAPÁN/AHUACHAPAN', '', '', 'destino_municipio', 'Empresa de ejemplo', 'fasoijdkajdklsa', 0),
(28, 00001, 00000, 00006, 00097, 10.00, 'Oficina Central (San Salvador) - SAN SALVADOR/SAN SALVADOR', '', '', 'destino_municipio', 'ahi cerca', 'probando', 0),
(29, 00001, 00000, 00012, 00199, 134.04, 'Oficina Central (San Salvador) - SAN MIGUEL/SAN MIGUEL', '13.476731142370154', '-88.18390528546774', 'destino_mapa', 'Black and white hotel', 'CA-1, San Miguel, El Salvador', 0),
(30, 00001, 00000, 00006, 00097, 21.40, 'Oficina Central (San Salvador) - SAN SALVADOR/SAN SALVADOR', '13.737222544123016', '-89.06553447246552', 'destino_mapa', 'no se', 'RN 1E, San Salvador, El Salvador', 0),
(31, 00001, 00000, 00005, 00079, 25.71, 'Oficina Central (San Salvador) - SANTA TECLA/COLON', '13.728217816527504', '-89.33572947978973', 'destino_mapa', 'sasdadada', 'Carretera desconocida, El Salvador', 0),
(32, 00002, 00001, 00006, 00097, 135.00, ' Oficina Regional de Oriente (San Miguel) - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(33, 00001, 00002, 00012, 00199, 135.00, 'Oficina Central (San Salvador) - Oficina Regional de Oriente (San Miguel)', '', '', 'destino_oficina', '', '', 1),
(34, 00001, 00003, 00002, 00013, 69.30, 'Oficina Central (San Salvador) - Oficina Regional de Occidente (Santa Ana)', '', '', 'destino_oficina', '', '', 1),
(35, 00003, 00001, 00006, 00097, 69.30, ' Oficina Regional de Occidente (Santa Ana) - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(36, 00001, 00004, 00008, 00132, 64.30, 'Oficina Central (San Salvador) - Oficina Paracentral (La Paz)', '', '', 'destino_oficina', '', '', 1),
(37, 00004, 00001, 00006, 00097, 64.30, ' Oficina Paracentral (La Paz) - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(38, 00001, 00005, 00003, 00041, 63.60, 'Oficina Central (San Salvador) - Oficina Departamental de Sonsonate', '', '', 'destino_oficina', '', '', 1),
(39, 00005, 00001, 00006, 00097, 63.60, ' Oficina Departamental de Sonsonate - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(40, 00001, 00006, 00014, 00245, 206.00, 'Oficina Central (San Salvador) - Oficina Departamental de la Unión', '', '', 'destino_oficina', '', '', 1),
(41, 00006, 00001, 00006, 00097, 206.00, ' Oficina Departamental de la Unión - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(42, 00007, 00001, 00006, 00097, 100.00, ' Oficina Departamental de Ahuachapán - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(43, 00001, 00007, 00001, 00001, 100.00, 'Oficina Central (San Salvador) - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(44, 00001, 00002, NULL, 00211, 128.00, 'Oficina Central (San Salvador) - (SAN MIGUEL - QUELEPA)', '13.478020143745484', ' -88.17572677799063', '', '', '', 1),
(45, 00008, 00001, 00006, 00097, 37.00, ' Oficina Departamental de Cuscatlán - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(46, 00001, 00010, 00010, 00163, 58.20, 'Oficina Central (San Salvador) - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(47, 00010, 00001, 00006, 00097, 58.20, ' Oficina Departamental de San Vicente - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(48, 00001, 00011, 00004, 00042, 80.90, 'Oficina Central (San Salvador) - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(49, 00011, 00001, 00006, 00097, 80.90, 'Oficina Departamental de Chalatenango - Oficina Central (San Salvador)', '', '', 'destino_oficina', '', '', 1),
(50, 00001, 00012, 00013, 00219, 164.00, 'Oficina Central (San Salvador) - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(51, 00012, 00001, 00006, 00097, 164.00, ' Oficina Departamental de Morazán - Oficina Central (San Salvador) ', '', '', 'destino_oficina', '', '', 1),
(52, 00002, 00003, 00002, 00013, 200.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Regional de Occidente (Santa Ana)', '', '', 'destino_oficina', '', '', 1),
(53, 00003, 00002, 00012, 00199, 200.00, ' Oficina Regional de Occidente (Santa Ana) - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(54, 00002, 00004, 00008, 00132, 107.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Paracentral (La Paz)', '', '', 'destino_oficina', '', '', 1),
(55, 00004, 00002, 00012, 00199, 107.00, ' Oficina Paracentral (La Paz) - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(56, 00002, 00005, 00003, 00041, 211.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de Sonsonate', '', '', 'destino_oficina', '', '', 1),
(57, 00005, 00002, 00012, 00199, 211.00, ' Oficina Departamental de Sonsonate - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(58, 00007, 00002, 00012, 00199, 231.00, ' Oficina Departamental de Ahuachapán - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(59, 00002, 00007, 00001, 00001, 231.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(60, 00002, 00008, 00007, 00116, 101.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 1),
(61, 00008, 00002, 00012, 00199, 101.00, ' Oficina Departamental de Cuscatlán - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(62, 00002, 00009, 00005, 00075, 174.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de la Libertad', '', '', 'destino_oficina', '', '', 1),
(63, 00009, 00002, 00012, 00199, 174.00, ' Oficina Departamental de la Libertad - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(64, 00002, 00010, 00010, 00163, 84.80, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(65, 00010, 00002, 00012, 00199, 84.80, ' Oficina Departamental de San Vicente - Oficina Regional de Oriente (San Miguel) ', '', '', 'destino_oficina', '', '', 1),
(66, 00011, 00002, 00012, 00199, 147.00, 'Oficina Departamental de Chalatenango - Oficina Regional de Oriente (San Miguel)', '', '', 'destino_oficina', '', '', 1),
(67, 00002, 00001, 00006, 00097, 135.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Central (San Salvador)', '', '', 'destino_oficina', '', '', 1),
(68, 00003, 00004, 00008, 00132, 125.00, 'Oficina Regional de Occidente (Santa Ana) - Oficina Paracentral (La Paz)', '', '', 'destino_oficina', '', '', 1),
(69, 00004, 00003, 00002, 00013, 125.00, ' Oficina Paracentral (La Paz) - Oficina Regional de Occidente (Santa Ana) ', '', '', 'destino_oficina', '', '', 1),
(70, 00006, 00003, 00002, 00013, 244.00, 'Oficina Departamental de la Unión - Oficina Regional de Occidente (Santa Ana)', '', '', 'destino_oficina', '', '', 1),
(71, 00003, 00006, 00014, 00245, 266.00, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de la Unión', '', '', 'destino_oficina', '', '', 1),
(72, 00003, 00007, 00001, 00001, 36.30, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(73, 00007, 00003, 00002, 00013, 36.30, ' Oficina Departamental de Ahuachapán - Oficina Regional de Occidente (Santa Ana) ', '', '', 'destino_oficina', '', '', 1),
(74, 00003, 00008, 00007, 00116, 104.00, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 1),
(75, 00008, 00003, 00002, 00013, 104.00, ' Oficina Departamental de Cuscatlán - Oficina Regional de Occidente (Santa Ana) ', '', '', 'destino_oficina', '', '', 1),
(76, 00003, 00009, 00005, 00075, 55.20, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de la Libertad', '', '', 'destino_oficina', '', '', 1),
(77, 00009, 00003, 00002, 00013, 55.20, ' Oficina Departamental de la Libertad - Oficina Regional de Occidente (Santa Ana) ', '', '', 'destino_oficina', '', '', 1),
(78, 00003, 00010, 00010, 00163, 125.00, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(79, 00010, 00003, 00002, 00013, 125.00, ' Oficina Departamental de San Vicente - Oficina Regional de Occidente (Santa Ana) ', '', '', 'destino_oficina', '', '', 1),
(80, 00002, 00011, 00004, 00042, 147.00, 'Oficina Regional de Oriente (San Miguel) - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(81, 00011, 00003, 00002, 00013, 98.30, 'Oficina Departamental de Chalatenango - Oficina Regional de Occidente (Santa Ana)', '', '', 'destino_oficina', '', '', 1),
(82, 00012, 00003, 00002, 00013, 231.00, ' Oficina Departamental de Morazán - Oficina Regional de Occidente (Santa Ana) ', '', '', 'destino_oficina', '', '', 1),
(83, 00003, 00012, 00013, 00219, 231.00, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(84, 00004, 00005, 00003, 00041, 120.00, 'Oficina Paracentral (La Paz) - Oficina Departamental de Sonsonate', '', '', 'destino_oficina', '', '', 1),
(85, 00005, 00004, 00008, 00132, 120.00, ' Oficina Departamental de Sonsonate - Oficina Paracentral (La Paz) ', '', '', 'destino_oficina', '', '', 1),
(86, 00004, 00006, 00014, 00245, 145.00, 'Oficina Paracentral (La Paz) - Oficina Departamental de la Unión', '', '', 'destino_oficina', '', '', 1),
(87, 00006, 00004, 00008, 00132, 145.00, ' Oficina Departamental de la Unión - Oficina Paracentral (La Paz) ', '', '', 'destino_oficina', '', '', 1),
(88, 00004, 00007, 00001, 00001, 163.00, 'Oficina Paracentral (La Paz) - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(89, 00007, 00004, 00008, 00132, 163.00, ' Oficina Departamental de Ahuachapán - Oficina Paracentral (La Paz) ', '', '', 'destino_oficina', '', '', 1),
(90, 00004, 00008, 00007, 00116, 48.40, 'Oficina Paracentral (La Paz) - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 1),
(91, 00008, 00004, 00008, 00132, 48.40, ' Oficina Departamental de Cuscatlán - Oficina Paracentral (La Paz) ', '', '', 'destino_oficina', '', '', 1),
(92, 00004, 00009, 00005, 00075, 69.80, 'Oficina Paracentral (La Paz) - Oficina Departamental de la Libertad', '', '', 'destino_oficina', '', '', 1),
(93, 00009, 00004, 00008, 00132, 69.80, ' Oficina Departamental de la Libertad - Oficina Paracentral (La Paz) ', '', '', 'destino_oficina', '', '', 1),
(94, 00004, 00011, 00004, 00042, 141.00, 'Oficina Paracentral (La Paz) - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(95, 00011, 00004, 00008, 00132, 141.00, 'Oficina Departamental de Chalatenango - Oficina Paracentral (La Paz)', '', '', 'destino_oficina', '', '', 1),
(96, 00012, 00004, 00008, 00132, 131.00, ' Oficina Departamental de Morazán - Oficina Paracentral (La Paz) ', '', '', 'destino_oficina', '', '', 1),
(97, 00004, 00012, 00013, 00219, 131.00, 'Oficina Paracentral (La Paz) - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(98, 00005, 00006, 00014, 00245, 262.00, 'Oficina Departamental de Sonsonate - Oficina Departamental de la Unión', '', '', 'destino_oficina', '', '', 1),
(99, 00006, 00005, 00003, 00041, 262.00, ' Oficina Departamental de la Unión - Oficina Departamental de Sonsonate ', '', '', 'destino_oficina', '', '', 1),
(100, 00005, 00008, 00007, 00116, 98.80, 'Oficina Departamental de Sonsonate - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 1),
(101, 00008, 00005, 00003, 00041, 98.80, ' Oficina Departamental de Cuscatlán - Oficina Departamental de Sonsonate ', '', '', 'destino_oficina', '', '', 1),
(102, 00005, 00009, 00005, 00075, 51.50, 'Oficina Departamental de Sonsonate - Oficina Departamental de la Libertad', '', '', 'destino_oficina', '', '', 1),
(103, 00009, 00005, 00003, 00041, 51.50, ' Oficina Departamental de la Libertad - Oficina Departamental de Sonsonate ', '', '', 'destino_oficina', '', '', 1),
(104, 00005, 00010, 00010, 00163, 120.00, 'Oficina Departamental de Sonsonate - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(105, 00010, 00005, 00003, 00041, 120.00, ' Oficina Departamental de San Vicente - Oficina Departamental de Sonsonate ', '', '', 'destino_oficina', '', '', 1),
(106, 00005, 00011, 00004, 00042, 138.00, 'Oficina Departamental de Sonsonate - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(107, 00011, 00005, 00003, 00041, 138.00, 'Oficina Departamental de Chalatenango - Oficina Departamental de Sonsonate', '', '', 'destino_oficina', '', '', 1),
(108, 00005, 00012, 00013, 00219, 225.00, 'Oficina Departamental de Sonsonate - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(109, 00012, 00005, 00003, 00041, 225.00, ' Oficina Departamental de Morazán - Oficina Departamental de Sonsonate ', '', '', 'destino_oficina', '', '', 1),
(110, 00006, 00007, 00001, 00001, 274.00, 'Oficina Departamental de la Unión - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(111, 00007, 00006, 00014, 00245, 274.00, ' Oficina Departamental de Ahuachapán - Oficina Departamental de la Unión ', '', '', 'destino_oficina', '', '', 1),
(112, 00008, 00007, 00001, 00001, 134.00, ' Oficina Departamental de Cuscatlán - Oficina Departamental de Ahuachapán ', '', '', 'destino_oficina', '', '', 1),
(113, 00007, 00008, 00007, 00116, 134.00, 'Oficina Departamental de Ahuachapán - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 1),
(114, 00009, 00007, 00001, 00001, 85.20, ' Oficina Departamental de la Libertad - Oficina Departamental de Ahuachapán ', '', '', 'destino_oficina', '', '', 1),
(115, 00007, 00009, 00005, 00075, 85.20, 'Oficina Departamental de Ahuachapán - Oficina Departamental de la Libertad', '', '', 'destino_oficina', '', '', 1),
(116, 00007, 00010, 00010, 00163, 155.00, 'Oficina Departamental de Ahuachapán - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(117, 00010, 00007, 00001, 00001, 155.00, ' Oficina Departamental de San Vicente - Oficina Departamental de Ahuachapán ', '', '', 'destino_oficina', '', '', 1),
(118, 00007, 00011, 00004, 00042, 136.00, 'Oficina Departamental de Ahuachapán - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(119, 00011, 00007, 00001, 00001, 136.00, 'Oficina Departamental de Chalatenango - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(120, 00007, 00012, 00013, 00219, 260.00, 'Oficina Departamental de Ahuachapán - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(121, 00012, 00007, 00001, 00001, 260.00, ' Oficina Departamental de Morazán - Oficina Departamental de Ahuachapán ', '', '', 'destino_oficina', '', '', 1),
(122, 00008, 00009, 00005, 00075, 48.60, 'Oficina Departamental de Cuscatlán - Oficina Departamental de la Libertad', '', '', 'destino_oficina', '', '', 1),
(123, 00009, 00008, 00007, 00116, 48.60, ' Oficina Departamental de la Libertad - Oficina Departamental de Cuscatlán ', '', '', 'destino_oficina', '', '', 1),
(124, 00008, 00010, 00010, 00163, 24.20, 'Oficina Departamental de Cuscatlán - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(125, 00010, 00008, 00007, 00116, 24.20, ' Oficina Departamental de San Vicente - Oficina Departamental de Cuscatlán ', '', '', 'destino_oficina', '', '', 1),
(126, 00012, 00008, 00007, 00116, 130.00, ' Oficina Departamental de Morazán - Oficina Departamental de Cuscatlán ', '', '', 'destino_oficina', '', '', 1),
(127, 00008, 00012, 00013, 00219, 130.00, 'Oficina Departamental de Cuscatlán - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(128, 00009, 00010, 00010, 00163, 69.20, 'Oficina Departamental de la Libertad - Oficina Departamental de San Vicente', '', '', 'destino_oficina', '', '', 1),
(129, 00010, 00009, 00005, 00075, 69.20, ' Oficina Departamental de San Vicente - Oficina Departamental de la Libertad ', '', '', 'destino_oficina', '', '', 1),
(130, 00009, 00011, 00004, 00042, 91.50, 'Oficina Departamental de la Libertad - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(131, 00011, 00009, 00005, 00075, 91.50, ' Oficina Departamental de Chalatenango - Oficina Departamental de la Libertad ', '', '', 'destino_oficina', '', '', 1),
(132, 00009, 00012, 00013, 00219, 175.00, 'Oficina Departamental de la Libertad - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(133, 00012, 00009, 00005, 00075, 175.00, ' Oficina Departamental de Morazán - Oficina Departamental de la Libertad ', '', '', 'destino_oficina', '', '', 1),
(134, 00011, 00010, 00010, 00163, 129.00, ' Oficina Departamental de Chalatenango - Oficina Departamental de San Vicente ', '', '', 'destino_oficina', '', '', 1),
(135, 00010, 00011, 00004, 00042, 129.00, 'Oficina Departamental de San Vicente - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(136, 00010, 00012, 00013, 00219, 114.00, 'Oficina Departamental de San Vicente - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(137, 00012, 00010, 00010, 00163, 114.00, ' Oficina Departamental de Morazán - Oficina Departamental de San Vicente ', '', '', 'destino_oficina', '', '', 1),
(138, 00011, 00012, 00013, 00219, 161.00, 'Oficina Departamental de Chalatenango - Oficina Departamental de Morazán', '', '', 'destino_oficina', '', '', 1),
(139, 00012, 00011, 00004, 00042, 161.00, ' Oficina Departamental de Morazán - Oficina Departamental de Chalatenango ', '', '', 'destino_oficina', '', '', 1),
(140, 00012, 00006, 00014, 00245, 82.90, 'Oficina Departamental de Morazán - Oficina Departamental de la Unión', '', '', 'destino_oficina', '', '', 1),
(141, 00006, 00012, 00013, 00219, 82.90, ' Oficina Departamental de la Unión - Oficina Departamental de Morazán ', '', '', 'destino_oficina', '', '', 1),
(142, 00005, 00000, 00006, 00097, 63.21, 'Oficina Departamental de Sonsonate - SAN SALVADOR/SAN SALVADOR', '13.708492760665433', '-89.20216266948239', 'destino_mapa', 'Empresa en san salvador', 'Pje N1, San Salvador, El Salvador', 0),
(143, 00006, 00008, 00007, 00116, 134.00, 'Oficina Departamental de Ahuachapán - Oficina Departamental de Cuscatlán', '', '', 'destino_oficina', '', '', 1),
(144, 00008, 00007, 00001, 00001, 133.00, 'Oficina Departamental de Cuscatlán - Oficina Departamental de Ahuachapán', '', '', 'destino_oficina', '', '', 1),
(145, 00003, 00000, 00001, 00001, 36.12, 'Oficina Regional de Occidente (Santa Ana) - AHUACHAPÁN/AHUACHAPAN', '13.926736264079324', '-89.8464918127197', 'destino_mapa', 'Centro Escolar en ahuachapán', '12A Calle Oriente, Ahuachapan, El Salvador', 0),
(146, 00010, 00006, 00014, 00245, 128.00, 'Oficina Departamental de San Vicente - Oficina Departamental de la Unión', '', '', 'destino_oficina', '', '', 1),
(147, 00006, 00010, 00010, 00163, 128.00, ' Oficina Departamental de la Unión - Oficina Departamental de San Vicente ', '', '', 'destino_oficina', '', '', 1),
(148, 00003, 00011, 00004, 00042, 97.50, 'Oficina Regional de Occidente (Santa Ana) - Oficina Departamental de Chalatenango', '', '', 'destino_oficina', '', '', 1),
(149, 00012, 00000, 00004, 00071, 162.26, 'Oficina Departamental de Morazán - CHALATENANGO/SAN MIGUEL DE MERCEDES', '14.01040876807658', '-88.93396943807602', 'destino_mapa', 'Empresa en chalatenango', 'Calle Principal, San Miguel de Mercedes, El Salvador', 0),
(150, 00008, 00000, 00002, 00016, 93.45, 'Oficina Departamental de Cuscatlán - SANTA ANA/COATEPEQUE', '13.891054652633303', '-89.54846613266352', 'destino_mapa', 'Centro de Recreación \'Constitución 1950\', Santa Ana, El Salvador', 'SAN24E, El Salvador', 0),
(151, 00001, 00000, 00003, 00032, 84.31, 'Oficina Central (San Salvador) - SONSONATE/JUAYUA', '13.841748131974745', '-89.74546032226544', 'destino_mapa', 'Hotel Hostal', '4 Calle Oriente, Juayúa, El Salvador', 0),
(152, 00001, 00000, 00007, 00116, 33.90, 'Oficina Central (San Salvador) - (CUSCATLÁN - COJUTEPEQUE)', '13.723313547753696', ' -88.93682184485806', 'destino_mapa', 'Oficina prueba', 'Direccion prueba', 1),
(153, 00001, 00000, 00006, 00115, 18.66, 'Oficina Central (San Salvador) - SAN SALVADOR/TONACATEPEQUE', '13.742558515761175', '-89.09673781514778', 'destino_mapa', 'Empresa', 'Direccion, El Salvador', 0),
(154, 00001, 00000, 00006, 00112, 19.80, 'Oficina Central (San Salvador) - (SAN SALVADOR - SANTIAGO TEXACUANGOS)', '', '', 'destino_municipio', '', '', 1),
(155, 00001, 00000, 00002, 00013, 67.70, 'Oficina Central (San Salvador) - SANTA ANA/SANTA ANA', '', '', 'destino_municipio', 'dkjhaj', 'jnsksadad', 0),
(156, 00001, 00009, 00005, 00075, 12.91, 'Oficina Central (San Salvador) - Oficina Departamental de la Libertad', '13.677130422693326', ' -89.28797056844309', 'destino_oficina', 'Oficina Departamental de la Libertad', 'Oficina Departamental de la Libertad', 0),
(157, 00009, 00001, 00006, 00097, 12.91, 'Oficina Departamental de la Libertad - Oficina Central (San Salvador)', '13.705537711909635', ' -89.20028865337372', 'destino_oficina', 'Oficina Central (San Salvador)', 'Oficina Central (San Salvador)', 0),
(158, 00001, 00000, 00006, 00114, 9.50, 'Oficina Central (San Salvador) - SAN SALVADOR/SOYAPANGO', '', '', 'destino_municipio', 'SIMAN', 'Soyapango, almacenes simán', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vyp_actividades`
--
ALTER TABLE `vyp_actividades`
  ADD PRIMARY KEY (`id_vyp_actividades`);

--
-- Indices de la tabla `vyp_mision_pasajes`
--
ALTER TABLE `vyp_mision_pasajes`
  ADD PRIMARY KEY (`id_mision_pasajes`);

--
-- Indices de la tabla `vyp_observaciones_pasajes`
--
ALTER TABLE `vyp_observaciones_pasajes`
  ADD PRIMARY KEY (`id_observacion_pasaje`);

--
-- Indices de la tabla `vyp_oficinas`
--
ALTER TABLE `vyp_oficinas`
  ADD PRIMARY KEY (`id_oficina`);

--
-- Indices de la tabla `vyp_oficinas_telefono`
--
ALTER TABLE `vyp_oficinas_telefono`
  ADD PRIMARY KEY (`id_vyp_oficinas_telefono`);

--
-- Indices de la tabla `vyp_pasajes`
--
ALTER TABLE `vyp_pasajes`
  ADD PRIMARY KEY (`id_solicitud_pasaje`);

--
-- Indices de la tabla `vyp_rutas`
--
ALTER TABLE `vyp_rutas`
  ADD PRIMARY KEY (`id_vyp_rutas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vyp_actividades`
--
ALTER TABLE `vyp_actividades`
  MODIFY `id_vyp_actividades` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `vyp_mision_pasajes`
--
ALTER TABLE `vyp_mision_pasajes`
  MODIFY `id_mision_pasajes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `vyp_oficinas`
--
ALTER TABLE `vyp_oficinas`
  MODIFY `id_oficina` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `vyp_oficinas_telefono`
--
ALTER TABLE `vyp_oficinas_telefono`
  MODIFY `id_vyp_oficinas_telefono` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vyp_pasajes`
--
ALTER TABLE `vyp_pasajes`
  MODIFY `id_solicitud_pasaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vyp_rutas`
--
ALTER TABLE `vyp_rutas`
  MODIFY `id_vyp_rutas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
