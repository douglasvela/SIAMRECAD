/*
Navicat MySQL Data Transfer

Source Server         : Local conection
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : mtps

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-01-18 15:20:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `vyp_actividades`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_actividades`;
CREATE TABLE `vyp_actividades` (
  `id_vyp_actividades` int(9) NOT NULL AUTO_INCREMENT,
  `nombre_vyp_actividades` varchar(125) NOT NULL,
  `depende_vyp_actividades` int(9) NOT NULL,
  PRIMARY KEY (`id_vyp_actividades`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_actividades
-- ----------------------------
INSERT INTO `vyp_actividades` VALUES ('1', 'INSPECCIÓN  PROGRAMADA', '0');
INSERT INTO `vyp_actividades` VALUES ('2', 'REINSPECCIÓN ', '0');
INSERT INTO `vyp_actividades` VALUES ('3', 'CAPACITACIÓN', '0');
INSERT INTO `vyp_actividades` VALUES ('4', 'PROYECTO', '0');
INSERT INTO `vyp_actividades` VALUES ('5', 'VISITAS TÉCNICAS DE HIGIENE OCUPACIONAL', '0');
INSERT INTO `vyp_actividades` VALUES ('6', 'NOTIFICAR', '0');
INSERT INTO `vyp_actividades` VALUES ('7', 'TRANSPORTANDO AL PERSONAL', '0');
INSERT INTO `vyp_actividades` VALUES ('8', 'FERIA DE EMPLEO', '0');
INSERT INTO `vyp_actividades` VALUES ('9', 'MANTENIMIENTO Y REPARACIÓN', '0');
INSERT INTO `vyp_actividades` VALUES ('10', 'ENTREGA DE DOCUMENTACIÓN ', '0');
INSERT INTO `vyp_actividades` VALUES ('11', 'ENTREGA DE INSUMOS CENTROS RECREATIVOS', '0');
INSERT INTO `vyp_actividades` VALUES ('12', 'SUPERVISIÓN DE OBRA', '0');
INSERT INTO `vyp_actividades` VALUES ('13', 'RETIRO DE VALE COMBUSTIBLE', '0');
INSERT INTO `vyp_actividades` VALUES ('14', 'RETIRO DE PAPELERIA', '0');
INSERT INTO `vyp_actividades` VALUES ('15', 'REUNIONES', '0');
INSERT INTO `vyp_actividades` VALUES ('16', 'HACIENDO TURNO DE VIGILANCIA', '0');
INSERT INTO `vyp_actividades` VALUES ('17', 'SOPORTE TÉCNICO', '0');
INSERT INTO `vyp_actividades` VALUES ('18', 'RECOLECCIÓN DE FONDOS A LOS CENTROS RECREATIVOS DE MTPS', '0');
INSERT INTO `vyp_actividades` VALUES ('19', 'ENTREGAR OFICIO DE EMBARGO A LOS JUZGADOS', '0');
INSERT INTO `vyp_actividades` VALUES ('20', 'TOMA MEDIDA DE UNIFORMES DEL PERSONAL  MTPS', '0');
INSERT INTO `vyp_actividades` VALUES ('21', 'SEGUIMIENTO DEL FUNCIONAMIENTO DE COMITÉ Y VERIFICACIÓN DE CUMPLIMIENTO DE ART. 10  DEL   R.G.P.L.T', '0');
INSERT INTO `vyp_actividades` VALUES ('22', 'INTERMEDIACIÓN LABORAL', '0');
INSERT INTO `vyp_actividades` VALUES ('23', 'ENTREGA DE ACREDITACIONES DE COMITÉ DE SEGURIDAD Y SALUD OCUPACIONAL', '0');
INSERT INTO `vyp_actividades` VALUES ('24', 'ASISTENCIA A ENTREGA DE JEFATURA ', '0');
INSERT INTO `vyp_actividades` VALUES ('25', 'ARQUEO DE CAJA CHICA, REVISIÓN DE DOCUMENTACIÓN ANUAL', '0');
INSERT INTO `vyp_actividades` VALUES ('26', 'REALIZANDO ASESORIA  EN LAS OFICINAS DEPARTAMENTALES MTPS', '0');
INSERT INTO `vyp_actividades` VALUES ('27', 'AUDITORIA INTERNA', '0');
INSERT INTO `vyp_actividades` VALUES ('28', 'ENTREGA DE PAQUETE DE MATERNIDAD,CLAUSULA N°56 DEL CONTRATO COLECTIVO MTPS', '0');
INSERT INTO `vyp_actividades` VALUES ('29', 'ENTREGA DE UNIFORMES AL PERSONAL  MTPS', '0');
INSERT INTO `vyp_actividades` VALUES ('30', 'ENTREGA DE CERTIFICADOS DEL SUPERMERCADO, CLAUSULA N°57 DEL CONTRATO  COLECTIVO  MTPS', '0');
INSERT INTO `vyp_actividades` VALUES ('31', 'REPRESENTACIÓN POR FALLECIMIENTO DE LA TRABAJADORA O TRABAJADOR', '0');
INSERT INTO `vyp_actividades` VALUES ('32', 'INVENTARIO ANUAL DE ACTIVO FIJO ', '0');
INSERT INTO `vyp_actividades` VALUES ('33', 'PROGRAMA DE REFUERZO DE CAPACIDADES TÉCNICAS NUEVAS EN LOS FORMATOS ICS-AG', '0');
INSERT INTO `vyp_actividades` VALUES ('34', 'CENSO DE CONTRATACION COLECTIVA DE TRABAJO', '0');
INSERT INTO `vyp_actividades` VALUES ('35', 'CHARLAS INFORMATIVAS SOBRE ENCUESTAS DE ESTABLECIMIENTOS EMPLEOS,HORAS ,SALARIOS', '0');
INSERT INTO `vyp_actividades` VALUES ('36', 'PROTOCOLO  INSTITUCIONALES Y GUBERNAMENTALES', '0');
INSERT INTO `vyp_actividades` VALUES ('37', 'VISITAS DE GESTIÓN', '0');
INSERT INTO `vyp_actividades` VALUES ('39', 'INSPECCIÓN ESPECIAL', '0');
INSERT INTO `vyp_actividades` VALUES ('40', 'VISITAS GESTION DE EMPLEO', '0');
INSERT INTO `vyp_actividades` VALUES ('41', 'CUBRIENDO TIEMPO COMPENSATORIO', '0');
INSERT INTO `vyp_actividades` VALUES ('42', 'VISITAS TECNICAS DE PREVENSION DE RIESGO', '0');
INSERT INTO `vyp_actividades` VALUES ('43', 'RENDICION DE CUENTAS', '0');
INSERT INTO `vyp_actividades` VALUES ('44', 'ENCUESTA A EMPRESAS', '0');
INSERT INTO `vyp_actividades` VALUES ('45', 'VISITA TECNICA DE SEGURIDAD OCUPACIONAL PROGRAMADA', '0');
INSERT INTO `vyp_actividades` VALUES ('46', 'VISITA TECNICA DE SEGURIDAD OCUPACIONAL ESPECIAL O A SOLICITUD', '0');

-- ----------------------------
-- Table structure for `vyp_alojamientos`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_alojamientos`;
CREATE TABLE `vyp_alojamientos` (
  `id_alojamiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_mision` int(10) unsigned NOT NULL,
  `fecha_alojamiento` date NOT NULL,
  `monto` float(5,2) NOT NULL,
  `id_ruta_visitada` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_alojamiento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_alojamientos
-- ----------------------------

-- ----------------------------
-- Table structure for `vyp_bancos`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_bancos`;
CREATE TABLE `vyp_bancos` (
  `id_banco` int(10) unsigned NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `caracteristicas` varchar(100) NOT NULL,
  `codigo_a` varchar(25) NOT NULL,
  `codigo_b` varchar(25) NOT NULL,
  `delimitador` varchar(2) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_bancos
-- ----------------------------
INSERT INTO `vyp_bancos` VALUES ('1', 'BANCO AGRÍCOLA', '', '55', 'A', ';');
INSERT INTO `vyp_bancos` VALUES ('2', 'BANCO DAVIVIENDA', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('3', 'BANCO DE FOMENTO AGROPECUARIO', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('4', 'BANCO DE AMERICA CENTRAL', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('5', 'BANCO CUSCATLAN DE EL SALVADOR', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('6', 'BANCO IZALQUEÑO ', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('7', 'BANCO HIPOTECARIO DE EL SALVADOR', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('8', 'BANCO PROMERICA', '', '', '', '');
INSERT INTO `vyp_bancos` VALUES ('9', 'SCOTIABANK', '', '', '', '');

-- ----------------------------
-- Table structure for `vyp_bitacora_solicitud_pasaje`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_bitacora_solicitud_pasaje`;
CREATE TABLE `vyp_bitacora_solicitud_pasaje` (
  `id_bitacora_solicitud_pasaje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_antigua` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_actualizacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tiempo_dias` int(10) unsigned NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `persona_actualiza` int(10) unsigned NOT NULL DEFAULT '0',
  `id_mision` int(10) unsigned NOT NULL DEFAULT '0',
  `nr_persona_actualiza` varchar(5) NOT NULL,
  PRIMARY KEY (`id_bitacora_solicitud_pasaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_bitacora_solicitud_pasaje
-- ----------------------------

-- ----------------------------
-- Table structure for `vyp_bitacora_solicitud_viatico`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_bitacora_solicitud_viatico`;
CREATE TABLE `vyp_bitacora_solicitud_viatico` (
  `id_bitacora_solicitud_viatico` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_antigua` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fecha_actualizacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tiempo_dias` int(10) unsigned NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '',
  `persona_actualiza` int(10) unsigned NOT NULL DEFAULT '0',
  `id_mision` int(10) unsigned NOT NULL DEFAULT '0',
  `nr_persona_actualiza` varchar(5) NOT NULL,
  PRIMARY KEY (`id_bitacora_solicitud_viatico`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_bitacora_solicitud_viatico
-- ----------------------------
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('1', '2019-01-03 11:01:38', '2019-01-03 11:01:38', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '1', '2785');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('2', '2019-01-08 15:01:15', '2019-01-08 15:01:15', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '11', '667C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('3', '2019-01-08 15:01:26', '2019-01-08 15:01:26', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '14', '688C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('4', '2019-01-08 15:15:45', '2019-01-09 09:01:40', '1', 'APROBÓ LA SOLICITUD', '2', '11', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('5', '2019-01-08 15:26:04', '2019-01-09 09:01:46', '1', 'APROBÓ LA SOLICITUD', '2', '14', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('6', '2019-01-09 13:01:24', '2019-01-09 13:01:24', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '24', '2415');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('7', '2019-01-08 09:01:06', '2019-01-10 09:01:06', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '31', '2417');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('8', '2019-01-08 09:01:12', '2019-01-10 09:01:12', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '33', '720C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('9', '2019-01-08 09:01:14', '2019-01-10 09:01:14', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '34', '720C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('10', '2019-01-08 09:01:17', '2019-01-10 09:01:17', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '36', '720C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('11', '2019-01-08 09:01:19', '2019-01-10 09:01:19', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '37', '720C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('12', '2019-01-09 13:24:22', '2019-01-10 09:01:32', '1', 'OBSERVÓ LA SOLICITUD', '2', '24', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('13', '2019-01-08 09:01:55', '2019-01-10 09:01:55', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '41', '2718');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('14', '2019-01-09 09:01:56', '2019-01-10 09:01:56', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '35', '391C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('15', '2019-01-10 09:12:35', '2019-01-10 09:01:58', '0', 'APROBÓ LA SOLICITUD', '2', '33', '988C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('16', '2019-01-10 09:19:28', '2019-01-10 09:01:59', '0', 'APROBÓ LA SOLICITUD', '2', '37', '988C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('17', '2019-01-10 09:17:29', '2019-01-10 10:01:04', '0', 'APROBÓ LA SOLICITUD', '2', '36', '988C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('18', '2019-01-10 09:14:57', '2019-01-10 10:01:46', '0', 'APROBÓ LA SOLICITUD', '2', '34', '988C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('19', '2019-01-10 09:06:16', '2019-01-10 11:01:06', '0', 'APROBÓ LA SOLICITUD', '2', '31', '2820');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('20', '2019-01-10 09:55:29', '2019-01-10 11:01:42', '0', 'APROBÓ LA SOLICITUD', '2', '41', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('21', '2019-01-10 11:43:08', '2019-01-10 11:01:43', '0', 'APROBÓ LA SOLICITUD', '2', '41', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('22', '2019-01-10 09:56:54', '2019-01-10 11:01:43', '0', 'APROBÓ LA SOLICITUD', '2', '35', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('23', '2019-01-09 13:01:47', '2019-01-10 13:01:47', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '49', '700C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('24', '2019-01-08 13:01:50', '2019-01-10 13:01:50', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '48', '700C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('25', '2019-01-10 14:01:30', '2019-01-10 14:01:30', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '52', '620C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('26', '2019-01-10 09:32:33', '2019-01-10 14:01:50', '0', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '24', '2415');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('27', '2019-01-10 14:30:49', '2019-01-10 14:01:58', '0', 'OBSERVÓ LA SOLICITUD', '2', '52', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('28', '2019-01-09 15:01:06', '2019-01-10 15:01:06', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '54', '2729');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('29', '2019-01-10 14:58:34', '2019-01-10 15:01:11', '0', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '52', '620C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('30', '2019-01-10 15:01:19', '2019-01-10 15:01:19', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '62', '620C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('31', '2019-01-10 07:01:59', '2019-01-11 07:01:59', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '60', '688C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('32', '2019-01-08 08:01:13', '2019-01-11 08:01:13', '3', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '65', '812C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('33', '2019-01-11 08:14:48', '2019-01-11 08:01:15', '0', 'OBSERVÓ LA SOLICITUD', '2', '60', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('34', '2019-01-10 15:11:00', '2019-01-11 08:01:16', '1', 'APROBÓ LA SOLICITUD', '2', '52', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('35', '2019-01-10 08:01:25', '2019-01-11 08:01:25', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '66', '734C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('36', '2019-01-11 08:01:31', '2019-01-11 08:01:31', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '67', '667C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('37', '2019-01-10 09:01:05', '2019-01-11 09:01:05', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '61', '2729');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('38', '2019-01-11 08:36:11', '2019-01-11 13:01:55', '0', 'OBSERVÓ LA SOLICITUD', '2', '67', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('39', '2019-01-10 15:15:15', '2019-01-11 13:01:56', '1', 'OBSERVÓ LA SOLICITUD', '2', '24', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('40', '2019-01-10 15:19:49', '2019-01-11 13:01:56', '1', 'APROBÓ LA SOLICITUD', '2', '62', '845C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('41', '2019-01-11 13:55:34', '2019-01-11 14:01:13', '0', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '67', '667C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('42', '2019-01-11 08:16:05', '2019-01-11 14:01:19', '0', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '60', '688C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('43', '2019-01-11 08:25:29', '2019-01-11 14:01:19', '0', 'OBSERVÓ LA SOLICITUD', '2', '66', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('44', '2019-01-11 08:13:14', '2019-01-11 14:01:26', '0', 'OBSERVÓ LA SOLICITUD', '2', '65', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('45', '2019-01-11 13:56:36', '2019-01-11 14:01:30', '0', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '24', '2415');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('46', '2019-01-10 14:01:45', '2019-01-11 14:01:45', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '70', '2415');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('47', '2019-01-11 15:01:01', '2019-01-11 15:01:01', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '73', '2656');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('48', '2019-01-11 14:19:40', '2019-01-11 15:01:06', '0', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '66', '734C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('49', '2019-01-11 15:06:13', '2019-01-11 15:01:07', '0', 'OBSERVÓ LA SOLICITUD', '2', '66', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('50', '2019-01-11 09:01:06', '2019-01-14 09:01:06', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '77', '391C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('51', '2019-01-14 09:06:18', '2019-01-14 09:01:56', '0', 'APROBÓ LA SOLICITUD', '2', '77', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('52', '2019-01-14 09:56:49', '2019-01-14 09:01:56', '0', 'APROBÓ LA SOLICITUD', '2', '77', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('53', '2019-01-14 09:57:08', '2019-01-14 09:01:57', '0', 'APROBÓ LA SOLICITUD', '2', '77', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('54', '2019-01-14 09:57:24', '2019-01-14 09:01:57', '0', 'APROBÓ LA SOLICITUD', '2', '77', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('55', '2019-01-14 09:57:30', '2019-01-14 09:01:57', '0', 'APROBÓ LA SOLICITUD', '2', '77', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('56', '2019-01-11 10:01:16', '2019-01-14 10:01:16', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '68', '2788');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('57', '2019-01-11 14:26:33', '2019-01-14 10:01:22', '1', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '65', '812C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('58', '2019-01-14 10:22:32', '2019-01-14 10:01:24', '0', 'APROBÓ LA SOLICITUD', '2', '65', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('59', '2019-01-14 10:24:32', '2019-01-14 10:01:24', '0', 'APROBÓ LA SOLICITUD', '2', '65', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('60', '2019-01-11 15:07:57', '2019-01-14 10:01:28', '1', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '66', '734C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('61', '2019-01-14 10:28:24', '2019-01-14 10:01:29', '0', 'APROBÓ LA SOLICITUD', '2', '66', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('62', '2019-01-14 10:29:27', '2019-01-14 10:01:29', '0', 'APROBÓ LA SOLICITUD', '2', '66', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('63', '2019-01-11 10:01:56', '2019-01-14 10:01:56', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '80', '734C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('64', '2019-01-14 10:56:47', '2019-01-14 10:01:57', '0', 'APROBÓ LA SOLICITUD', '2', '80', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('65', '2019-01-14 10:57:49', '2019-01-14 10:01:57', '0', 'APROBÓ LA SOLICITUD', '2', '80', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('66', '2019-01-11 12:01:27', '2019-01-14 12:01:27', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '82', '858C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('67', '2019-01-14 12:27:33', '2019-01-14 14:01:55', '0', 'OBSERVÓ LA SOLICITUD', '2', '82', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('68', '2019-01-11 08:01:27', '2019-01-15 08:01:27', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '83', '896C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('69', '2019-01-14 11:01:45', '2019-01-15 11:01:45', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '84', '2586');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('70', '2019-01-11 11:01:58', '2019-01-15 11:01:58', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '85', '2647');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('71', '2019-01-15 09:01:49', '2019-01-16 09:01:49', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '89', '672C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('72', '2019-01-15 10:01:05', '2019-01-16 10:01:05', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '91', '344C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('73', '2019-01-10 13:47:00', '2019-01-16 11:01:07', '4', 'OBSERVÓ LA SOLICITUD', '2', '49', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('74', '2019-01-16 11:07:34', '2019-01-16 11:01:07', '0', 'OBSERVÓ LA SOLICITUD', '2', '49', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('75', '2019-01-10 13:50:46', '2019-01-16 11:01:08', '4', 'APROBÓ LA SOLICITUD', '2', '48', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('76', '2019-01-16 11:08:36', '2019-01-16 11:01:11', '0', 'APROBÓ LA SOLICITUD', '3', '48', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('77', '2019-01-16 11:01:32', '2019-01-16 11:01:32', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '96', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('78', '2019-01-14 10:24:41', '2019-01-16 11:01:36', '2', 'APROBÓ LA SOLICITUD', '3', '65', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('79', '2019-01-14 10:29:34', '2019-01-16 11:01:38', '2', 'OBSERVÓ LA SOLICITUD', '3', '66', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('80', '2019-01-14 10:57:56', '2019-01-16 11:01:40', '2', 'APROBÓ LA SOLICITUD', '3', '80', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('81', '2019-01-16 11:32:21', '2019-01-16 11:01:55', '0', 'APROBÓ LA SOLICITUD', '2', '96', '997C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('82', '2019-01-16 11:39:08', '2019-01-16 12:01:03', '0', 'CORRIGIÓ OBSERVACIONES DE DIRECCIÓN O JEFATURA REGIONAL', '1', '66', '734C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('83', '2019-01-16 09:49:10', '2019-01-16 12:01:07', '0', 'OBSERVÓ LA SOLICITUD', '2', '89', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('84', '2019-01-16 10:05:24', '2019-01-16 12:01:07', '0', 'OBSERVÓ LA SOLICITUD', '2', '91', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('85', '2019-01-16 12:08:06', '2019-01-16 12:01:08', '0', 'OBSERVÓ LA SOLICITUD', '2', '91', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('86', '2019-01-16 12:03:52', '2019-01-16 12:01:14', '0', 'APROBÓ LA SOLICITUD', '2', '66', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('87', '2019-01-15 13:01:56', '2019-01-16 13:01:56', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '86', '740C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('88', '2019-01-16 13:56:40', '2019-01-16 14:01:13', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('89', '2019-01-16 14:13:49', '2019-01-16 14:01:16', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('90', '2019-01-16 14:16:11', '2019-01-16 14:01:16', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('91', '2019-01-16 14:17:01', '2019-01-16 14:01:20', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('92', '2019-01-16 14:21:02', '2019-01-16 14:01:21', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('93', '2019-01-16 14:21:50', '2019-01-16 14:01:22', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('94', '2019-01-16 14:23:12', '2019-01-16 14:01:32', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('95', '2019-01-14 14:01:38', '2019-01-16 14:01:38', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '101', '759C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('96', '2019-01-16 14:32:27', '2019-01-16 14:01:48', '0', 'OBSERVÓ LA SOLICITUD', '2', '86', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('97', '2019-01-16 14:01:58', '2019-01-16 14:01:58', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '103', '2906');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('98', '2019-01-15 15:01:12', '2019-01-16 15:01:12', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '104', '759C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('99', '2019-01-16 15:12:52', '2019-01-16 16:01:21', '0', 'APROBÓ LA SOLICITUD', '2', '104', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('100', '2019-01-16 14:38:08', '2019-01-16 16:01:23', '0', 'OBSERVÓ LA SOLICITUD', '2', '101', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('101', '2019-01-16 16:23:17', '2019-01-16 16:01:23', '0', 'OBSERVÓ LA SOLICITUD', '2', '101', '753C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('102', '2019-01-16 07:01:43', '2019-01-17 07:01:43', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '107', '620C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('103', '2019-01-16 08:01:53', '2019-01-17 08:01:53', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '108', '2877');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('104', '2019-01-17 09:01:06', '2019-01-17 09:01:06', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '110', '734C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('105', '2019-01-17 08:53:00', '2019-01-17 09:01:08', '0', 'APROBÓ LA SOLICITUD', '2', '108', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('106', '2019-01-17 09:06:32', '2019-01-17 09:01:10', '0', 'APROBÓ LA SOLICITUD', '2', '110', '805C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('107', '2019-01-16 14:58:06', '2019-01-17 09:01:28', '1', 'APROBÓ LA SOLICITUD', '2', '103', '2806');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('108', '2019-01-17 09:28:13', '2019-01-17 09:01:29', '0', 'APROBÓ LA SOLICITUD', '2', '103', '2806');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('109', '2019-01-17 09:29:45', '2019-01-17 09:01:30', '0', 'APROBÓ LA SOLICITUD', '2', '103', '2806');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('110', '2019-01-17 09:30:22', '2019-01-17 09:01:31', '0', 'APROBÓ LA SOLICITUD', '2', '103', '2806');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('111', '2019-01-15 10:01:03', '2019-01-17 10:01:03', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '112', '939C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('112', '2019-01-16 10:01:19', '2019-01-17 10:01:19', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '95', '2417');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('113', '2019-01-16 12:18:26', '2019-01-17 10:01:24', '1', 'APROBÓ LA SOLICITUD', '2', '85', '381C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('114', '2019-01-17 10:24:51', '2019-01-17 10:01:24', '0', 'APROBÓ LA SOLICITUD', '2', '85', '381C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('115', '2019-01-15 11:45:10', '2019-01-17 10:01:26', '2', 'APROBÓ LA SOLICITUD', '2', '84', '381C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('116', '2019-01-17 10:19:48', '2019-01-17 11:01:17', '0', 'APROBÓ LA SOLICITUD', '2', '95', '2820');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('117', '2019-01-15 14:01:20', '2019-01-17 14:01:20', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '114', '707C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('118', '2019-01-17 09:31:36', '2019-01-17 14:01:24', '0', 'APROBÓ LA SOLICITUD', '3', '103', '2806');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('119', '2019-01-17 14:24:14', '2019-01-17 14:01:24', '0', 'APROBÓ LA SOLICITUD', '3', '103', '2806');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('120', '2019-01-17 14:01:40', '2019-01-17 14:01:40', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '118', '620C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('121', '2019-01-16 14:01:43', '2019-01-17 14:01:43', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '117', '391C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('122', '2019-01-15 15:01:10', '2019-01-17 15:01:10', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '120', '2600');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('123', '2019-01-17 15:01:24', '2019-01-17 15:01:24', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '122', '939C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('124', '2019-01-16 15:01:24', '2019-01-17 15:01:24', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '123', '688C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('125', '2019-01-16 12:14:33', '2019-01-17 15:01:29', '1', 'APROBÓ LA SOLICITUD', '3', '66', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('126', '2019-01-17 15:29:41', '2019-01-17 15:01:29', '0', 'APROBÓ LA SOLICITUD', '3', '66', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('127', '2019-01-17 09:08:50', '2019-01-17 15:01:31', '0', 'APROBÓ LA SOLICITUD', '3', '108', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('128', '2019-01-17 09:10:40', '2019-01-17 15:01:31', '0', 'APROBÓ LA SOLICITUD', '3', '110', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('129', '2019-01-16 11:07:52', '2019-01-17 15:01:32', '1', 'CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA', '1', '49', '700C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('130', '2019-01-17 15:32:10', '2019-01-17 15:01:32', '0', 'APROBÓ LA SOLICITUD', '2', '49', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('131', '2019-01-17 15:32:32', '2019-01-17 15:01:32', '0', 'APROBÓ LA SOLICITUD', '3', '49', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('132', '2019-01-16 15:01:39', '2019-01-17 15:01:39', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '124', '700C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('133', '2019-01-17 15:39:12', '2019-01-17 15:01:43', '0', 'APROBÓ LA SOLICITUD', '2', '124', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('134', '2019-01-17 15:44:08', '2019-01-17 15:01:44', '0', 'APROBÓ LA SOLICITUD', '3', '124', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('135', '2019-01-17 15:44:27', '2019-01-17 15:01:44', '0', 'APROBÓ LA SOLICITUD', '3', '124', '2879');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('136', '2019-01-18 07:01:42', '2019-01-18 07:01:42', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '126', '688C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('137', '2019-01-17 07:01:46', '2019-01-18 07:01:46', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '128', '667C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('138', '2019-01-17 10:25:17', '2019-01-18 08:01:04', '1', 'APROBÓ LA SOLICITUD', '3', '85', '982C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('139', '2019-01-17 10:26:40', '2019-01-18 08:01:06', '1', 'APROBÓ LA SOLICITUD', '3', '84', '982C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('140', '2019-01-18 08:06:22', '2019-01-18 08:01:06', '0', 'APROBÓ LA SOLICITUD', '3', '84', '982C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('141', '2019-01-18 08:01:19', '2019-01-18 08:01:19', '0', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '133', '2415');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('142', '2019-01-17 14:43:31', '2019-01-18 08:01:28', '1', 'APROBÓ LA SOLICITUD', '2', '117', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('143', '2019-01-18 08:29:08', '2019-01-18 08:01:29', '0', 'APROBÓ LA SOLICITUD', '2', '117', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('144', '2019-01-18 08:29:30', '2019-01-18 08:01:29', '0', 'APROBÓ LA SOLICITUD', '2', '117', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('145', '2019-01-17 15:10:21', '2019-01-18 08:01:29', '1', 'APROBÓ LA SOLICITUD', '2', '120', '532C');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('146', '2019-01-16 09:01:40', '2019-01-18 09:01:40', '2', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '140', '2802');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('147', '2019-01-17 09:01:54', '2019-01-18 09:01:54', '1', 'CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA', '1', '141', '2895');
INSERT INTO `vyp_bitacora_solicitud_viatico` VALUES ('148', '2019-01-18 09:54:15', '2019-01-18 10:01:11', '0', 'OBSERVÓ LA SOLICITUD', '2', '141', '2879');

-- ----------------------------
-- Table structure for `vyp_empleado_cuenta_banco`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_empleado_cuenta_banco`;
CREATE TABLE `vyp_empleado_cuenta_banco` (
  `id_empleado_banco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nr` varchar(4) NOT NULL,
  `id_banco` int(10) unsigned NOT NULL,
  `numero_cuenta` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_empleado_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=888 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_empleado_cuenta_banco
-- ----------------------------
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('57', '523C', '1', '3005835998', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('58', '864C', '1', '3005836006', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('59', '2222', '1', '3005836017', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('60', '2145', '1', '3005834849', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('61', '2772', '1', '3040462764', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('62', '351C', '1', '3005835375', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('63', '782C', '1', '3005834973', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('64', '973C', '1', '3005836072', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('65', '2746', '1', '3005833267', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('66', '2416', '1', '3005836083', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('67', '2697', '1', '3005835386', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('68', '2544', '1', '3005836094', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('69', '677C', '1', '3005834000', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('70', '2498', '1', '3005834011', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('71', '797C', '1', '3005836108', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('72', '2872', '1', '3480553208', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('73', '796C', '1', '3005836130', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('74', '2435', '1', '3005836141', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('75', '2585', '1', '3005836152', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('76', '2433', '1', '3005836163', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('77', '990C', '1', '3010648683', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('78', '633C', '1', '3005836185', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('79', '2887', '1', '3480596925', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('80', '761C', '1', '3005836196', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('81', '2899', '1', '3430505236', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('82', '823C', '1', '3005834022', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('83', '2956', '1', '3480653858', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('84', '745C', '1', '3040456681', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('85', '809C', '1', '3005834860', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('86', '738C', '1', '3005834984', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('87', '2949', '1', '3840090704', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('88', '528C', '1', '3005832741', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('89', '549C', '1', '3005833278', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('90', '565C', '1', '3005834350', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('91', '821C', '1', '3005834361', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('92', '860C', '1', '3005834871', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('93', '435C', '1', '3005836232', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('94', '953C', '1', '3005834962', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('95', '481C', '1', '3005835397', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('96', '2820', '1', '3520387935', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('97', '2796', '1', '3040481565', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('98', '2467', '1', '3005836265', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('99', '2932', '1', '3008542147', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('100', '2774', '1', '3040464985', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('101', '2846', '1', '3720415398', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('102', '2755', '1', '3840064158', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('103', '2696', '1', '3005832752', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('104', '728C', '1', '3005836276', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('105', '2629', '1', '3005836298', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('106', '2583', '1', '3005836301', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('107', '454C', '1', '3005836312', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('108', '2044', '1', '3005834033', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('109', '2333', '1', '3005836323', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('110', '2666', '1', '3005836334', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('111', '621C', '1', '3005833303', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('112', '701C', '1', '3840064409', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('113', '790C', '1', '3005833620', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('114', '2107', '1', '3005836345', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('115', '654C', '1', '3005836356', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('116', '1410', '1', '3005836367', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('117', '785C', '1', '3005833493', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('118', '2041', '1', '3005836389', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('119', '605C', '1', '3005836403', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('120', '2762', '1', '3840064453', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('121', '816C', '1', '3005832763', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('122', '477C', '1', '3005836414', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('123', '620C', '1', '3005834372', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('124', '2860', '1', '3007278371', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('125', '2736', '1', '3005836436', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('126', '2525', '1', '3005836447', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('127', '2841', '1', '3007025070', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('128', '2912', '1', '3840080369', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('129', '2337', '1', '3005836458', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('130', '2849', '1', '3520336661', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('131', '748C', '1', '3005836480', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('132', '969C', '1', '3005835411', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('133', '2677', '1', '3005836491', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('134', '916C', '1', '3005836505', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('135', '680C', '1', '3005835127', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('136', '552C', '1', '3005835138', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('137', '2607', '1', '3005836549', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('138', '2787', '1', '3040475198', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('139', '921C', '1', '3005833507', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('140', '2903', '1', '3080777512', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('141', '774C', '1', '3005836571', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('142', '2812', '1', '3030028127', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('143', '2850', '1', '3007025081', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('144', '2515', '1', '3005836607', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('145', '2564', '1', '3005836629', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('146', '929C', '1', '3005836618', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('147', '2660', '1', '3005833314', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('148', '2907', '1', '3480579937', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('149', '486C', '1', '3005836651', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('150', '2706', '1', '3840064067', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('151', '2430', '1', '3005836662', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('152', '815C', '1', '3005835149', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('153', '987C', '1', '3690669021', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('154', '501C', '1', '3005832774', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('155', '437C', '1', '3005836720', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('156', '335C', '1', '3005836731', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('157', '2007', '1', '3005836753', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('158', '2514', '1', '3005835444', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('159', '563C', '1', '3005836797', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('160', '2542', '1', '3005835466', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('161', '709C', '1', '3005836811', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('162', '509C', '1', '3005836822', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('163', '2961', '1', '3840079417', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('164', '2681', '1', '3005836833', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('165', '2936', '1', '3810559945', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('166', '465C', '1', '3005836844', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('167', '2702', '1', '3005836855', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('168', '402C', '1', '3005832785', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('169', '827C', '1', '3005834736', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('170', '976C', '1', '3005832796', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('171', '2892', '1', '3840073170', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('172', '789C', '1', '3300566697', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('173', '578C', '1', '3005836902', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('174', '2958', '1', '3040136884', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('175', '853C', '1', '3005833879', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('176', '2783', '1', '3040475132', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('177', '553C', '1', '3005835160', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('178', '2880', '1', '3750536890', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('179', '899C', '1', '3005836946', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('180', '2684', '1', '3005836957', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('181', '506C', '1', '3005835477', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('182', '542C', '1', '3005835488', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('183', '2848', '1', '3420243530', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('184', '715C', '1', '3005837009', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('185', '685C', '1', '3005837031', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('186', '2944', '1', '3840080358', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('187', '439C', '1', '3005837042', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('188', '2861', '1', '3760079241', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('189', '791C', '1', '3005837097', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('190', '2548', '1', '3005837111', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('191', '2558', '1', '3005837100', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('192', '1743', '1', '3005837133', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('193', '2415', '1', '3005834394', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('194', '2631', '1', '3005837144', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('195', '882C', '1', '3005837155', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('196', '2760', '1', '3840064442', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('197', '2824', '1', '3850257056', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('198', '2819', '1', '3760356760', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('199', '955C', '1', '3005837166', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('200', '919C', '1', '3005837188', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('201', '900C', '1', '3005837199', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('202', '405C', '1', '3005832810', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('203', '2641', '1', '3005837246', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('204', '2280', '1', '3005835513', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('205', '972C', '1', '3005834408', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('206', '2954', '1', '3420387847', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('207', '457C', '1', '3005837268', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('208', '674C', '1', '3005837279', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('209', '2479', '1', '3005837315', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('210', '2917', '1', '3005774554', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('211', '503C', '1', '3005834055', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('212', '2622', '1', '3005837348', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('213', '2718', '1', '3005837359', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('214', '814C', '1', '3005835003', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('215', '2857', '1', '3006829990', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('216', '383C', '1', '3005837417', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('217', '2910', '1', '3850223291', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('218', '2858', '1', '3006305741', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('219', '732C', '1', '3005837439', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('220', '2898', '1', '3400523294', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('221', '363C', '1', '3005837450', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('222', '2854', '1', '3480533914', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('223', '2655', '1', '3005832832', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('224', '2610', '1', '3300640723', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('225', '2606', '1', '3005837472', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('226', '997C', '1', '3420273291', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('227', '820C', '1', '3005832843', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('228', '2615', '1', '3005835535', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('229', '2454', '1', '3005837494', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('230', '943C', '1', '3005837508', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('231', '2786', '1', '3040475201', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('232', '2963', '1', '3580253085', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('233', '410C', '1', '3005837552', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('234', '2509', '1', '3005837563', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('235', '751C', '1', '3005835546', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('236', '747C', '1', '3005833551', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('237', '2623', '1', '3005837610', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('238', '753C', '1', '3005833562', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('239', '2852', '1', '3006549972', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('240', '2207', '1', '3005835557', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('241', '2761', '1', '3840064420', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('242', '2710', '1', '3005832865', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('243', '1777', '1', '3005837665', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('244', '854C', '1', '3005835568', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('245', '2637', '1', '3005832876', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('246', '967C', '1', '3005837698', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('247', '551C', '1', '3005832887', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('248', '613C', '1', '3005834066', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('249', '1560', '1', '3005834259', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('250', '2913', '1', '3650224664', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('251', '557C', '1', '3005835579', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('252', '344C', '1', '3005833573', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('253', '566C', '1', '3005835171', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('254', '764C', '1', '3005837712', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('255', '630C', '1', '3005837723', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('256', '412C', '1', '3005837734', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('257', '601C', '1', '3005837767', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('258', '2750', '1', '3005833904', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('259', '560C', '1', '3005834419', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('260', '2924', '1', '3800656548', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('261', '752C', '1', '3005833584', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('262', '2886', '1', '3840072746', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('263', '2810', '1', '3040481463', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('264', '951C', '1', '3005832901', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('265', '425C', '1', '3005832912', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('266', '856C', '1', '3005837778', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('267', '868C', '1', '3005834747', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('268', '2902', '1', '3840075846', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('269', '689C', '1', '3005837789', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('270', '635C', '1', '3005837803', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('271', '2401', '1', '3005837814', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('272', '550C', '1', '3005834441', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('273', '2658', '1', '3005835182', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('274', '2834', '1', '3007025048', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('275', '2625', '1', '3005837825', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('276', '2943', '1', '3480657156', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('277', '704C', '1', '3005834452', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('278', '536C', '1', '3005837858', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('279', '2214', '1', '3005837880', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('280', '610C', '1', '3005837891', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('281', '378C', '1', '3005837916', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('282', '2613', '1', '3005837971', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('283', '2717', '1', '3005837927', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('284', '2843', '1', '3007024974', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('285', '950C', '1', '3005835014', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('286', '324C', '1', '3005835590', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('287', '920C', '1', '3005837960', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('288', '2291', '1', '3005838001', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('289', '518C', '1', '3005835604', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('290', '554C', '1', '3005832934', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('291', '2701', '1', '3005838023', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('292', '2676', '1', '3005838045', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('293', '906C', '1', '3005838067', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('294', '984C', '1', '3040455656', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('295', '2845', '1', '3007024941', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('296', '2745', '1', '3005838089', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('297', '2378', '1', '3005838114', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('298', '2477', '1', '3005838125', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('299', '2661', '1', '3005832945', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('300', '507C', '1', '3005832956', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('301', '2377', '1', '3005838136', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('302', '427C', '1', '3005838147', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('303', '2674', '1', '3040455725', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('304', '2347', '1', '3005838158', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('305', '2692', '1', '3005838169', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('306', '781C', '1', '3005835025', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('307', '2803', '1', '3040481430', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('308', '2687', '1', '3005838191', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('309', '485C', '1', '3005838216', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('310', '2215', '1', '3005835615', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('311', '2929', '1', '3590297393', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('312', '2389', '1', '3005838227', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('313', '989C', '1', '3800683303', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('314', '2863', '1', '3580209607', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('315', '2874', '1', '3007422627', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('316', '2918', '1', '3008529025', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('317', '2855', '1', '3006577559', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('318', '2925', '1', '3005782417', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('319', '2921', '1', '3800838669', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('320', '980C', '1', '3005833642', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('321', '945C', '1', '3005838293', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('322', '2765', '1', '3840064566', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('323', '692C', '1', '3005838318', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('324', '404C', '1', '3005835648', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('325', '2588', '1', '3005838329', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('326', '2776', '1', '3040465911', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('327', '2490', '1', '3005838362', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('328', '2590', '1', '3005838373', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('329', '2664', '1', '3005838395', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('330', '667C', '1', '3005834463', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('331', '2797', '1', '3040481394', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('332', '431C', '1', '3005832967', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('333', '1568', '1', '3060167698', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('334', '2830', '1', '3007025059', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('335', '2020', '1', '3005838453', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('336', '1984', '1', '3005838486', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('337', '975C', '1', '3005833653', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('338', '2212', '1', '3005838599', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('339', '2931', '1', '3300599878', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('340', '2012', '1', '3005838511', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('341', '798C', '1', '3005834270', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('342', '2712', '1', '3005838522', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('343', '2693', '1', '3005838533', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('344', '2386', '1', '3005838544', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('345', '2691', '1', '3005835670', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('346', '502C', '1', '3800653845', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('347', '783C', '1', '3005835036', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('348', '2709', '1', '3005838566', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('349', '2266', '1', '3005838577', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('350', '2499', '1', '3005838588', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('351', '428C', '1', '3005835681', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('352', '531C', '1', '3005838602', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('353', '2465', '1', '3005838635', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('354', '2738', '1', '3005833664', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('355', '863C', '1', '3005834281', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('356', '456C', '1', '3005832978', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('357', '705C', '1', '3005838679', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('358', '740C', '1', '3005833675', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('359', '710C', '1', '3005838726', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('360', '2967', '1', '3440439750', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('361', '2804', '1', '3000988619', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('362', '992C', '1', '3430384856', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('363', '889C', '1', '3005838748', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('364', '2596', '1', '3005833358', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('365', '2478', '1', '3005838781', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('366', '2636', '1', '3005838792', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('367', '2758', '1', '3840064169', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('368', '357C', '1', '3005838828', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('369', '734C', '1', '3005834678', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('370', '2611', '1', '3005835692', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('371', '2952', '1', '3840080325', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('372', '2385', '1', '3005838850', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('373', '2457', '1', '3005838872', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('374', '2529', '1', '3005835706', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('375', '2908', '1', '3050350949', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('376', '505C', '1', '3005835717', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('377', '2930', '1', '3720534706', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('378', '695C', '1', '3005838908', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('379', '2370', '1', '3005838930', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('380', '612C', '1', '3005833686', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('381', '2879', '1', '3750536904', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('382', '615C', '1', '3005832989', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('383', '2844', '1', '3009980900', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('384', '2869', '1', '3480547690', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('385', '885C', '1', '3005833697', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('386', '2877', '1', '3750536813', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('387', '1662', '1', '3005833019', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('388', '2735', '1', '3005838974', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('389', '2799', '1', '3040481452', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('390', '1991', '1', '3005838985', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('391', '2253', '1', '3005838996', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('392', '2752', '1', '3040455430', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('393', '2867', '1', '3480547919', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('394', '2801', '1', '3040481576', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('395', '472C', '1', '3005839015', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('396', '2773', '1', '3040464941', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('397', '2496', '1', '3005835728', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('398', '495C', '1', '3005839048', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('399', '400C', '1', '3005839059', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('400', '2630', '1', '3005839070', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('401', '2600', '1', '3005839081', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('402', '2549', '1', '3005839092', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('403', '521C', '1', '3005835207', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('404', '2639', '1', '3005839106', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('405', '2914', '1', '3600714661', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('406', '338C', '1', '3005833030', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('407', '398C', '1', '3005833041', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('408', '720C', '1', '3005839139', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('409', '2480', '1', '3005834474', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('410', '2928', '1', '3700563326', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('411', '2582', '1', '3005834485', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('412', '2935', '1', '3420412649', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('413', '2856', '1', '1022105382', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('414', '851C', '1', '3005833937', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('415', '2579', '1', '3005839194', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('416', '2826', '1', '3007025004', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('417', '2733', '1', '3005839208', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('418', '532C', '1', '3005839219', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('419', '688C', '1', '3005834430', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('420', '2791', '1', '3040479938', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('421', '2426', '1', '3720394232', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('422', '699C', '1', '3005835229', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('423', '2375', '1', '3005833052', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('424', '666C', '1', '3005835240', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('425', '2562', '1', '3005833063', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('426', '947C', '1', '3005833074', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('427', '819C', '1', '3005839285', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('428', '519C', '1', '3005835750', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('429', '476C', '1', '3005839321', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('430', '643C', '1', '3005839343', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('431', '2734', '1', '3005839354', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('432', '2531', '1', '3005835761', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('433', '672C', '1', '3005833722', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('434', '857C', '1', '3005835772', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('435', '698C', '1', '3005835251', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('436', '2875', '1', '3680315780', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('437', '2497', '1', '3005833085', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('438', '2537', '1', '3005839365', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('439', '767C', '1', '3005839183', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('440', '460C', '1', '3005839387', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('441', '2790', '1', '3040479789', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('442', '2689', '1', '3005839398', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('443', '2897', '1', '3750338161', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('444', '463C', '1', '3005839401', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('445', '534C', '1', '3005839412', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('446', '387C', '1', '3005839423', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('447', '2353', '1', '3005839434', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('448', '420C', '1', '3005839445', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('449', '808C', '1', '3005834893', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('450', '949C', '1', '3005839467', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('451', '876C', '1', '3006367771', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('452', '879C', '1', '3005839489', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('453', '986C', '1', '3840064431', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('454', '2821', '1', '3100415573', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('455', '977C', '1', '3005839503', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('456', '2617', '1', '3005839525', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('457', '2878', '1', '3750536824', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('458', '537C', '1', '3005839536', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('459', '381C', '1', '3005839547', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('460', '2466', '1', '3005839558', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('461', '567C', '1', '3005834496', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('462', '2946', '1', '3005244051', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('463', '858C', '1', '3005834703', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('464', '2659', '1', '3005839569', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('465', '927C', '1', '1690020074', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('466', '447C', '1', '3005839580', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('467', '2747', '1', '3005839591', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('468', '555C', '1', '3005835783', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('469', '958C', '1', '3005839605', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('470', '2680', '1', '3005839638', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('471', '1792', '1', '3040455769', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('472', '2927', '1', '3760459413', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('473', '2945', '1', '3070430541', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('474', '576C', '1', '3005839671', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('475', '694C', '1', '3005839682', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('476', '628C', '1', '3005839729', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('477', '2838', '1', '3007025092', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('478', '2926', '1', '3600713669', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('479', '323C', '1', '3005833096', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('480', '2428', '1', '3005835808', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('481', '960C', '1', '3005835819', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('482', '741C', '1', '3005839762', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('483', '417C', '1', '3005839773', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('484', '983C', '1', '3005839784', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('485', '2939', '1', '3008529193', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('486', '2371', '1', '3800653856', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('487', '2614', '1', '3005839820', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('488', '2678', '1', '3005839831', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('489', '2462', '1', '3005833110', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('490', '2705', '1', '3005839886', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('491', '671C', '1', '3005833405', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('492', '838C', '1', '3005834918', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('493', '375C', '1', '3005839922', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('494', '2715', '1', '3005839933', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('495', '2970', '1', '3110303882', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('496', '2560', '1', '3005833755', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('497', '2883', '1', '3470371849', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('498', '391C', '1', '3005839944', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('499', '766C', '1', '3005839955', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('500', '2319', '1', '3005839966', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('501', '801C', '1', '3005834317', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('502', '2894', '1', '3300566937', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('503', '349C', '1', '3005839999', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('504', '2440', '1', '3005840036', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('505', '2699', '1', '3005840047', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('506', '2662', '1', '3005840069', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('507', '2003', '1', '3005833121', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('508', '2779', '1', '3040465922', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('509', '2456', '1', '3005840091', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('510', '2234', '1', '3005840138', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('511', '2488', '1', '3005840160', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('512', '894C', '1', '3005840171', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('513', '2807', '1', '3660351704', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('514', '957C', '1', '3005835273', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('515', '572C', '1', '3005833154', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('516', '325C', '1', '3005833132', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('517', '401C', '1', '3005833143', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('518', '2864', '1', '3480547828', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('519', '631C', '1', '3005840218', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('520', '2851', '1', '3007025037', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('521', '580C', '1', '3005840229', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('522', '2018', '1', '3005833416', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('523', '493C', '1', '3005840240', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('524', '756C', '1', '3005840262', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('525', '749C', '1', '3005835069', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('526', '2729', '1', '3005835309', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('527', '2870', '1', '3220419202', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('528', '2969', '1', '3009949988', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('529', '2276', '1', '3005840309', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('530', '2464', '1', '3005840295', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('531', '922C', '1', '3005840353', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('532', '2731', '1', '3005840364', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('533', '737C', '1', '3005833948', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('534', '2906', '1', '3840077444', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('535', '2505', '1', '3005840320', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('536', '561C', '1', '3005833165', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('537', '2795', '1', '3006325567', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('538', '369C', '1', '3005840386', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('539', '878C', '1', '3005840400', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('540', '2459', '1', '3005833176', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('541', '2311', '1', '3005840422', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('542', '712C', '1', '3005833427', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('543', '757C', '1', '3005840433', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('544', '650C', '1', '3005833198', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('545', '687C', '1', '3005840466', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('546', '832C', '1', '3005834780', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('547', '2884', '1', '3420449966', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('548', '833C', '1', '3005834725', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('549', '546C', '1', '3005840488', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('550', '2651', '1', '3005834543', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('551', '2763', '1', '3840064464', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('552', '2916', '1', '3720236264', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('553', '979C', '1', '3005840502', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('554', '2798', '1', '3040481408', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('555', '735C', '1', '3005834929', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('556', '494C', '1', '3005840524', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('557', '2567', '1', '3005833777', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('558', '2652', '1', '3005835080', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('559', '569C', '1', '3005835320', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('560', '759C', '1', '3005833788', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('561', '2626', '1', '3005840546', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('562', '2768', '1', '3040460929', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('563', '320C', '1', '3005833201', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('564', '971C', '1', '3005834328', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('565', '2517', '1', '3005840557', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('566', '2408', '1', '3005835885', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('567', '455C', '1', '3005840568', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('568', '2811', '1', '3600586583', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('569', '370C', '1', '3005840579', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('570', '458C', '1', '3005840615', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('571', '2839', '1', '3005725242', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('572', '2806', '1', '3220191625', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('573', '2653', '1', '3005833799', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('574', '529C', '1', '3005840637', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('575', '2802', '1', '3040481474', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('576', '2767', '1', '3040460907', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('577', '2403', '1', '3005840659', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('578', '653C', '1', '3005835331', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('579', '911C', '1', '3005840670', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('580', '430C', '1', '3005840681', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('581', '2670', '1', '3005840706', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('582', '2941', '1', '3800833916', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('583', '866C', '1', '3005835091', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('584', '744C', '1', '3005840761', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('585', '2656', '1', '3005834521', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('586', '2427', '1', '3005840772', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('587', '2708', '1', '3005840794', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('588', '886C', '1', '3005833802', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('589', '910C', '1', '3005840808', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('590', '891C', '1', '3005834190', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('591', '626C', '1', '3005835896', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('592', '877C', '1', '3005834816', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('593', '2964', '1', '3840086591', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('594', '755C', '1', '3005833813', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('595', '2580', '1', '3005833824', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('596', '2075', '1', '3005840819', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('597', '778C', '1', '3005835105', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('598', '2938', '1', '3580254328', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('599', '679C', '1', '3040455394', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('600', '2608', '1', '3005833212', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('601', '2076', '1', '3005840830', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('602', '988C', '1', '1220297227', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('603', '500C', '1', '3005833223', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('604', '571C', '1', '3005834554', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('605', '664C', '1', '3005840863', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('606', '2612', '1', '3005833471', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('607', '962C', '1', '3005840874', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('608', '861C', '1', '3005840885', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('609', '930C', '1', '3005840852', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('610', '940C', '1', '3040455634', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('611', '2592', '1', '3005840910', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('612', '892C', '1', '3005835353', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('613', '2814', '1', '3007025026', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('614', '2888', '1', '3800797608', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('615', '760C', '1', '3040455598', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('616', '668C', '1', '3840064351', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('617', '388C', '1', '3005840932', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('618', '2383', '1', '3005840954', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('619', '2737', '1', '3005840976', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('620', '2891', '1', '3840072156', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('621', '2947', '1', '3840080336', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('622', '2429', '1', '3005841006', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('623', '915C', '1', '3005841017', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('624', '800C', '1', '3005834339', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('625', '2552', '1', '3005841039', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('626', '2577', '1', '3840064078', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('627', '700C', '1', '3005833482', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('628', '2571', '1', '3005834565', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('629', '845C', '1', '3005834576', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('630', '426C', '1', '3005833234', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('631', '963C', '1', '3005841119', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('632', '2581', '1', '3005841141', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('633', '2818', '1', '3840089603', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('634', '2618', '1', '3005841163', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('635', '2739', '1', '3005841174', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('636', '2817', '1', '3040484541', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('637', '2642', '1', '3005841185', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('638', '2704', '1', '3005835364', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('639', '2871', '1', '3480553219', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('640', '2905', '1', '3040454813', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('641', '662C', '1', '3005841210', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('642', '619C', '1', '3005834587', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('643', '598C', '1', '3005841232', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('644', '2535', '1', '3005841243', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('645', '362C', '1', '3005835910', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('646', '2959', '1', '3005776174', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('647', '558C', '1', '3005834940', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('648', '2442', '1', '3005841254', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('649', '445C', '1', '3005841265', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('650', '2594', '1', '3005834237', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('651', '968C', '1', '3005834248', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('652', '2800', '1', '3430444459', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('653', '590C', '1', '3005841301', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('654', '589C', '1', '3005841312', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('655', '2574', '1', '3005835921', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('656', '564C', '1', '3005834598', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('657', '2784', '1', '3040475187', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('658', '2482', '1', '3600552650', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('659', '2962', '1', '3670156410', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('660', '2516', '1', '3005835943', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('661', '651C', '1', '3005833970', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('662', '583C', '1', '3005841356', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('663', '352C', '1', '3005835954', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('664', '852C', '1', '3005833981', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('665', '2942', '1', '3840080347', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('666', '1798', '1', '3005841389', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('667', '1968', '1', '3005841403', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('668', '2707', '1', '3005835965', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('669', '828C', '1', '3005834838', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('670', '928C', '1', '3005841414', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('671', '661C', '1', '3005841425', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('672', '837C', '1', '3005834951', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('673', '2086', '1', '3040455791', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('674', '2645', '1', '3005833846', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('675', '424C', '1', '3005835976', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('676', '2751', '1', '3005841469', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('677', '2304', '1', '3005841480', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('678', '841C', '1', '3005833256', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('679', '2087', '1', '3005841491', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('680', '2922', '1', '3800838625', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('681', '2960', '1', '3010736510', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('682', '2965', '1', '1740034749', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('683', '2473', '1', '3005841505', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('684', '825C', '1', '3005833992', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('685', '2210', '4', '111064960', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('686', '2904', '4', '109279554', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('687', '2933', '4', '111180170', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('688', '2951', '4', '110327103', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('689', '839C', '3', '2003109817216', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('690', '788C', '5', '140401000960991', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('691', '770C', '5', '173401000051077', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('692', '2923', '2', '22540356270', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('693', '812C', '2', '26540303129', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('694', '2955', '2', '61540028754', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('695', '2586', '2', '25540249890', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('696', '805C', '2', '76540226087', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('697', '2593', '2', '25540260860', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('698', '1690', '2', '25540187012', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('699', '802C', '2', '26540302939', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('700', '822C', '2', '10540431808', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('701', '719C', '2', '25540218333', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('702', '2968', '2', '47540283737', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('703', '511C', '2', '25540218848', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('704', '724C', '2', '64540229922', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('705', '365C', '2', '6540619979', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('706', '2380', '2', '3540278435', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('707', '389C', '2', '43540465660', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('708', '2443', '2', '25540246604', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('709', '2417', '2', '25540236170', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('710', '2445', '2', '25540234428', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('711', '2646', '2', '25540234029', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('712', '2782', '2', '43540337078', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('713', '2296', '2', '25540196895', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('714', '944C', '2', '25540232603', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('715', '792C', '2', '44540274514', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('716', '686C', '2', '69540304120', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('717', '2090', '2', '25540263452', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('718', '2827', '2', '64540236228', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('719', '763C', '2', '25540174492', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('720', '707C', '2', '6540615396', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('721', '2895', '2', '26540384455', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('722', '2638', '2', '25540215008', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('723', '2476', '2', '46540068150', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('724', '2793', '2', '25540232980', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('725', '2665', '2', '68540226170', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('726', '2723', '2', '25540229084', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('727', '432C', '2', '25540216349', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('728', '982C', '2', '69540261766', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('729', '907C', '2', '69540251337', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('730', '896C', '2', '64540229256', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('731', '609C', '2', '64540235990', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('732', '2526', '2', '42540195205', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('733', '2828', '2', '18540701349', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('734', '2781', '2', '25540185702', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('735', '416C', '2', '39540402012', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('736', '1599', '2', '25540237273', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('737', '419C', '2', '15540921320', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('738', '2575', '2', '25540246752', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('739', '2957', '2', '80540238410', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('740', '2716', '2', '25540218384', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('741', '2719', '2', '25540263010', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('742', '765C', '2', '25540209199', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('743', '768C', '2', '25540249506', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('744', '2785', '2', '95540343100', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('745', '596C', '2', '68540237210', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('746', '869C', '2', '2540851894', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('747', '2769', '2', '16540364774', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('748', '2669', '2', '1540627772', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('749', '2876', '2', '76540226620', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('750', '2609', '2', '25540199258', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('751', '2816', '2', '2540870960', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('752', '2387', '2', '25540237125', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('753', '2468', '2', '25540215733', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('754', '640C', '2', '64540231935', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('755', '884C', '2', '25540197263', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('756', '480C', '2', '6540629036', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('757', '2031', '2', '2540865143', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('758', '2633', '2', '25540200396', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('759', '804C', '2', '76540258035', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('760', '996C', '2', '75540221505', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('761', '663C', '2', '44540298880', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('762', '396C', '2', '25540193330', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('763', '624C', '2', '95540316782', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('764', '478C', '2', '1540668533', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('765', '696C', '2', '64540226729', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('766', '2788', '2', '25540244600', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('767', '2893', '2', '95540328070', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('768', '535C', '2', '25540214974', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('769', '831C', '2', '14540341225', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('770', '909C', '2', '69540297582', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('771', '2453', '2', '69540290804', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('772', '875C', '2', '25540253317', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('773', '2545', '2', '25540185400', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('774', '657C', '2', '2540394400', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('775', '479C', '2', '6540620063', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('776', '2840', '2', '95540328098', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('777', '623C', '2', '25540207080', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('778', '527C', '2', '25540262456', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('779', '2101', '2', '25540191575', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('780', '2749', '2', '25540209288', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('781', '2771', '2', '25540192570', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('782', '849C', '2', '47540233100', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('783', '2881', '2', '69540313413', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('784', '2354', '2', '25540237257', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('785', '925C', '2', '25540210197', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('786', '510C', '2', '18540701357', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('787', '2757', '2', '69540284006', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('788', '332C', '2', '25540217094', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('789', '2808', '2', '25540198626', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('790', '703C', '2', '64540237984', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('791', '2388', '2', '64540235027', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('792', '678C', '2', '69540280949', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('793', '2713', '2', '25540191680', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('794', '581C', '2', '69540261227', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('795', '617C', '2', '25540217930', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('796', '466C', '2', '6540570694', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('797', '937C', '2', '47540252220', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('798', '2471', '2', '43540480326', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('799', '777C', '2', '44540278160', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('800', '2632', '2', '69540312778', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('801', '644C', '2', '25540192938', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('802', '2911', '2', '101180566101', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('803', '2530', '2', '25540265986', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('804', '787C', '2', '2540863230', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('805', '2822', '2', '25540228797', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('806', '923C', '2', '25540232620', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('807', '517C', '2', '6540654880', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('808', '956C', '2', '25540233405', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('809', '880C', '2', '25540233936', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('810', '881C', '2', '43540502222', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('811', '614C', '2', '11540625573', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('812', '844C', '2', '11540630224', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('813', '2847', '2', '68540220848', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('814', '873C', '2', '25540240290', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('815', '2873', '2', '25540253236', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('816', '2320', '2', '25540186547', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('817', '824C', '2', '43540462620', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('818', '336C', '2', '15540917918', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('819', '2813', '2', '16540415042', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('820', '670C', '2', '47540201950', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('821', '2668', '2', '25540252914', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('822', '2448', '2', '41540368672', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('823', '611C', '2', '25540232514', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('824', '2603', '2', '69540307375', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('825', '2698', '2', '95540329213', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('826', '660C', '2', '47540204179', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('827', '2683', '2', '25540191907', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('828', '2682', '2', '47540237433', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('829', '926C', '2', '25540190692', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('830', '2829', '2', '68540034440', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('831', '829C', '2', '14540326030', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('832', '978C', '2', '25540258483', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('833', '840C', '2', '39540337750', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('834', '2650', '2', '91540379489', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('835', '826C', '2', '14540326188', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('836', '2647', '2', '25540175707', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('837', '1806', '2', '25540217027', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('838', '2563', '2', '25540227014', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('839', '2675', '2', '6540564910', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('840', '2463', '2', '45540526042', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('841', '2728', '2', '25540217360', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('842', '847C', '2', '47540232792', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('843', '711C', '2', '25540233820', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('844', '2485', '2', '15540951120', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('845', '941C', '2', '1540603539', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('846', '985C', '2', '25540194892', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('847', '2547', '2', '25540214214', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('848', '607C', '2', '19540389826', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('849', '850C', '2', '8540509750', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('850', '2778', '2', '69540300850', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('851', '2414', '2', '25540175936', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('852', '2825', '2', '69540304660', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('853', '746C', '2', '15540869000', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('854', '2815', '2', '69540300834', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('855', '2672', '2', '69540300796', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('856', '871C', '7', '1540040687', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('857', '807C', '7', '1540040601', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('858', '793C', '6', '730000230714', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('859', '965C', '6', '730200208438', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('860', '2882', '6', '730100237940', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('861', '2770', '6', '730100214489', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('862', '912C', '6', '730200233548', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('863', '665C', '6', '730200198978', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('864', '939C', '6', '730200208426', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('865', '2591', '6', '730200199986', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('866', '2789', '6', '730200208440', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('867', '966C', '6', '730200210837', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('868', '2673', '6', '730100214268', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('869', '2740', '6', '730200239988', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('870', '959C', '6', '730100225314', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('871', '2720', '6', '730200233745', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('872', '524C', '6', '730100201287', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('873', '2714', '6', '730000183716', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('874', '2657', '6', '730200182612', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('875', '961C', '6', '730100214477', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('876', '954C', '6', '730100215922', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('877', '520C', '6', '730200202791', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('878', '706C', '6', '730100238031', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('879', '638C', '6', '730200227561', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('880', '602C', '6', '730100218435', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('881', '998', '8', '20000015007948', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('882', '2777', '9', '3140406', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('883', '374C', '9', '69124249', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('884', '2940', '9', '28393762', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('885', '2722', '9', '7760544', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('886', '2889', '9', '17716987', '1');
INSERT INTO `vyp_empleado_cuenta_banco` VALUES ('887', '795C', '9', '3138193', '1');

-- ----------------------------
-- Table structure for `vyp_empresa_viatico`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_empresa_viatico`;
CREATE TABLE `vyp_empresa_viatico` (
  `id_empresa_viatico` int(11) NOT NULL AUTO_INCREMENT,
  `id_origen` varchar(5) NOT NULL,
  `id_destino` varchar(5) NOT NULL,
  `nombre_origen` varchar(250) NOT NULL,
  `nombre_destino` varchar(250) NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_llegada` time NOT NULL,
  `pasaje` float(3,2) NOT NULL,
  `viatico` float(5,2) NOT NULL,
  `alojamiento` float(5,2) NOT NULL,
  `horarios_viaticos` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `id_mision` int(10) unsigned NOT NULL,
  `factura` varchar(45) NOT NULL,
  `kilometraje` float(5,2) NOT NULL,
  PRIMARY KEY (`id_empresa_viatico`)
) ENGINE=InnoDB AUTO_INCREMENT=381 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_empresa_viatico
-- ----------------------------
INSERT INTO `vyp_empresa_viatico` VALUES ('1', '00031', '1', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'OFICINA CENTRAL', '06:00:00', '09:30:00', '0.00', '3.00', '0.00', '', '2019-01-03', '1', '', '57.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('3', '1', '00031', 'OFICINA CENTRAL', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', '15:30:00', '18:00:00', '3.00', '4.00', '0.00', '', '2019-01-03', '1', '', '57.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('5', '00020', '5', 'OFICINA DEPARTAMENTAL DE LA UNION', 'HOTEL  EL TEJANO (Santa rosa de lima/La unión)', '08:15:00', '09:02:00', '0.00', '0.00', '0.00', '', '2019-01-08', '11', '', '46.94');
INSERT INTO `vyp_empresa_viatico` VALUES ('6', '00020', '6', 'OFICINA DEPARTAMENTAL DE LA UNION', 'TIENDA EMILY  (Santa rosa de lima/La unión)', '09:55:00', '10:10:00', '0.00', '0.00', '0.00', '', '2019-01-08', '11', '', '46.94');
INSERT INTO `vyp_empresa_viatico` VALUES ('12', '00020', '7', 'OFICINA DEPARTAMENTAL DE LA UNION', 'TIENDA CARLITOS (Santa rosa de lima/La unión)', '11:01:00', '11:45:00', '0.00', '4.00', '0.00', '', '2019-01-08', '11', '', '46.94');
INSERT INTO `vyp_empresa_viatico` VALUES ('15', '7', '9', 'TIENDA CARLITOS (Santa rosa de lima/La unión)', 'ARACELY SALON (Santa rosa de lima/La unión)', '12:01:00', '12:20:00', '0.00', '0.00', '0.00', '', '2019-01-08', '11', '', '46.94');
INSERT INTO `vyp_empresa_viatico` VALUES ('16', '9', '00020', 'ARACELY SALON (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:10:00', '14:20:00', '0.00', '0.00', '0.00', '', '2019-01-08', '11', '', '46.94');
INSERT INTO `vyp_empresa_viatico` VALUES ('17', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'CLINICA SAN ATONIO (Santa rosa de lima/La unión)', '08:15:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '14', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('19', '00020', '10', 'OFICINA DEPARTAMENTAL DE LA UNION', 'GUAPOLLON #2 LA MARQUEZA (Santa rosa de lima/La unión)', '10:45:00', '11:30:00', '0.00', '4.00', '0.00', '', '2019-01-08', '14', '', '47.99');
INSERT INTO `vyp_empresa_viatico` VALUES ('20', '00020', '11', 'OFICINA DEPARTAMENTAL DE LA UNION', 'BOUTIQUE \"ANABELLA\" (Santa rosa de lima/La unión)', '12:30:00', '13:20:00', '0.00', '0.00', '0.00', '', '2019-01-08', '14', '', '47.99');
INSERT INTO `vyp_empresa_viatico` VALUES ('21', '11', '00020', 'BOUTIQUE \"ANABELLA\" (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:25:00', '14:20:00', '0.00', '0.00', '0.00', '', '2019-01-08', '14', '', '47.99');
INSERT INTO `vyp_empresa_viatico` VALUES ('39', '00022', '25', 'OFICINA CENTRAL', 'CENTRO ESCOLAR CELSA PALACIOS (Aguilares/San salvador)', '08:00:00', '09:05:00', '0.00', '0.00', '0.00', '', '2019-01-08', '31', '', '35.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('40', '25', '23', 'CENTRO ESCOLAR CELSA PALACIOS (Aguilares/San salvador)', 'INTRADESA (Santa ana/Santa ana)', '09:35:00', '10:40:00', '0.00', '0.00', '0.00', '', '2019-01-08', '31', '', '72.71');
INSERT INTO `vyp_empresa_viatico` VALUES ('41', '23', '24', 'INTRADESA (Santa ana/Santa ana)', 'LENOR (Santa ana/Santa ana)', '11:25:00', '11:30:00', '0.00', '4.00', '0.00', '', '2019-01-08', '31', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('42', '24', '00022', 'LENOR (Santa ana/Santa ana)', 'OFICINA CENTRAL', '14:00:00', '15:55:00', '0.00', '0.00', '0.00', '', '2019-01-08', '31', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('43', '00022', '26', 'OFICINA CENTRAL', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', '08:30:00', '10:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '33', '', '82.95');
INSERT INTO `vyp_empresa_viatico` VALUES ('44', '26', '00022', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'OFICINA CENTRAL', '11:50:00', '13:55:00', '0.00', '4.00', '0.00', '', '2019-01-08', '33', '', '82.95');
INSERT INTO `vyp_empresa_viatico` VALUES ('45', '00022', '26', 'OFICINA CENTRAL', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', '08:30:00', '10:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '34', '', '82.95');
INSERT INTO `vyp_empresa_viatico` VALUES ('46', '26', '00022', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'OFICINA CENTRAL', '11:50:00', '13:55:00', '0.00', '4.00', '0.00', '', '2019-01-08', '34', '', '82.95');
INSERT INTO `vyp_empresa_viatico` VALUES ('47', '00022', '28', 'OFICINA CENTRAL', 'OFICINA PARACENTRAL, LA PAZ', '09:00:00', '10:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '36', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('48', '28', '00022', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA CENTRAL', '15:05:00', '16:15:00', '0.00', '4.00', '0.00', '', '2019-01-08', '36', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('49', '00022', '28', 'OFICINA CENTRAL', 'OFICINA PARACENTRAL, LA PAZ', '09:00:00', '10:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '37', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('50', '28', '00022', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA CENTRAL', '15:05:00', '16:15:00', '0.00', '4.00', '0.00', '', '2019-01-08', '37', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('51', '00022', '30', 'OFICINA CENTRAL', 'CENTRO ESCOLAR PROFESOR JUSTO CARDOZA (San vicente/San vicente)', '11:15:00', '13:30:00', '0.00', '4.00', '0.00', '', '2019-01-09', '35', '', '59.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('52', '00022', '31', 'OFICINA CENTRAL', 'SANTIAGO ABERLARDO PORTILLO ORTIZ (San salvador/San salvador)', '08:35:00', '08:50:00', '0.00', '0.00', '0.00', '', '2019-01-08', '41', '', '3.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('53', '31', '31', 'SANTIAGO ABERLARDO PORTILLO ORTIZ (San salvador/San salvador)', 'ANGEL HUMBERTO RIVERA ARGUETA (San salvador/San salvador)', '09:00:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '41', '', '3.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('54', '31', '31', 'ANGEL HUMBERTO RIVERA ARGUETA (San salvador/San salvador)', 'TACO EL SALVADOR, S.A. DE C.V. (San salvador/San salvador)', '09:25:00', '09:35:00', '0.00', '0.00', '0.00', '', '2019-01-08', '41', '', '3.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('55', '31', '31', 'TACO EL SALVADOR, S.A. DE C.V. (San salvador/San salvador)', 'SEGURIDAD PRIVADA SALVADOREÑA, S.A. DE C.V. (San salvador/San salvador)', '09:50:00', '11:05:00', '0.00', '0.00', '0.00', '', '2019-01-08', '41', '', '3.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('57', '31', '32', 'SEGURIDAD PRIVADA SALVADOREÑA, S.A. DE C.V. (San salvador/San salvador)', 'ZETA GAS DE EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', '11:15:00', '14:25:00', '0.00', '4.00', '0.00', '', '2019-01-08', '41', '', '34.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('58', '32', '00022', 'ZETA GAS DE EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', 'OFICINA CENTRAL', '14:35:00', '15:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '41', '', '34.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('59', '30', '00022', 'CENTRO ESCOLAR PROFESOR JUSTO CARDOZA (San vicente/San vicente)', 'OFICINA CENTRAL', '14:40:00', '15:15:00', '0.00', '0.00', '0.00', '', '2019-01-09', '35', '', '59.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('65', '00016', '34', 'OFICINA PARACENTRAL, LA PAZ', 'CEPA (San luis talpa/La paz)', '09:00:00', '09:50:00', '0.00', '0.00', '0.00', '', '2019-01-09', '49', '', '32.00');
INSERT INTO `vyp_empresa_viatico` VALUES ('66', '34', '00016', 'CEPA (San luis talpa/La paz)', 'OFICINA PARACENTRAL, LA PAZ', '12:50:00', '13:35:00', '0.00', '4.00', '0.00', '', '2019-01-09', '49', '', '32.00');
INSERT INTO `vyp_empresa_viatico` VALUES ('67', '00016', '34', 'OFICINA PARACENTRAL, LA PAZ', 'HIDALGO E HIDALGO (San luis talpa/La paz)', '09:15:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-08', '48', '', '32.00');
INSERT INTO `vyp_empresa_viatico` VALUES ('68', '34', '00016', 'HIDALGO E HIDALGO (San luis talpa/La paz)', 'OFICINA PARACENTRAL, LA PAZ', '13:30:00', '14:50:00', '0.00', '4.00', '0.00', '', '2019-01-08', '48', '', '32.00');
INSERT INTO `vyp_empresa_viatico` VALUES ('74', '00020', '39', 'OFICINA DEPARTAMENTAL DE LA UNION', 'RUTA DE BUSES 421 B (San alejo/La unión)', '08:15:00', '09:00:00', '0.00', '0.00', '0.00', '', '2019-01-09', '52', '', '35.18');
INSERT INTO `vyp_empresa_viatico` VALUES ('76', '39', '41', 'RUTA DE BUSES 421 B (San alejo/La unión)', 'MOTO MAQUINARIA (Santa rosa de lima/La unión)', '10:30:00', '11:15:00', '0.00', '0.00', '0.00', '', '2019-01-09', '52', '', '35.18');
INSERT INTO `vyp_empresa_viatico` VALUES ('78', '41', '00020', 'MOTO MAQUINARIA (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:20:00', '14:10:00', '0.00', '4.00', '0.00', '', '2019-01-09', '52', '', '35.18');
INSERT INTO `vyp_empresa_viatico` VALUES ('87', '00032', '42', 'OFICINA DEPARTAMENTAL DE USULUTAN', 'OFICINA CENTRAL', '08:30:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-09', '54', '', '117.01');
INSERT INTO `vyp_empresa_viatico` VALUES ('89', '42', '00032', 'OFICINA CENTRAL', 'OFICINA DEPARTAMENTAL DE USULUTAN', '12:00:00', '14:30:00', '0.00', '4.00', '0.00', '', '2019-01-09', '54', '', '117.01');
INSERT INTO `vyp_empresa_viatico` VALUES ('100', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'AGROFERRETERIA SANTA CLARA (Santa rosa de lima/La unión)', '08:15:00', '10:25:00', '0.00', '0.00', '0.00', '', '2019-01-10', '62', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('103', '8', '8', 'AGROFERRETERIA SANTA CLARA (Santa rosa de lima/La unión)', 'PISOS Y AZULEJOS FLORES (Santa rosa de lima/La unión)', '10:29:00', '11:50:00', '0.00', '4.00', '0.00', '', '2019-01-10', '62', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('107', '8', '8', 'PISOS Y AZULEJOS FLORES (Santa rosa de lima/La unión)', 'COMERCIAL ZONA LIBRE (Santa rosa de lima/La unión)', '11:55:00', '13:20:00', '0.00', '0.00', '0.00', '', '2019-01-10', '62', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('109', '8', '00020', 'COMERCIAL ZONA LIBRE (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:25:00', '14:20:00', '0.00', '0.00', '0.00', '', '2019-01-10', '62', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('111', '00021', '44', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'INVERSIONES PEÑATE PORTILLO S.A DE C.V. (Jutiapa/Cabañas)', '09:10:00', '10:40:00', '0.00', '0.00', '0.00', '', '2019-01-08', '65', '', '40.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('117', '00021', '3', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'OFICINA CENTRAL', '08:00:00', '09:45:00', '0.00', '0.00', '0.00', '', '2019-01-10', '66', '', '83.11');
INSERT INTO `vyp_empresa_viatico` VALUES ('124', '44', '44', 'INVERSIONES PEÑATE PORTILLO S.A DE C.V. (Jutiapa/Cabañas)', 'O & M MANTENIMIENTO Y SERVIO S.A DE C.V. (Jutiapa/Cabañas)', '11:30:00', '14:35:00', '0.00', '4.00', '0.00', '', '2019-01-08', '65', '', '40.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('127', '44', '00021', 'O & M MANTENIMIENTO Y SERVIO S.A DE C.V. (Jutiapa/Cabañas)', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '14:40:00', '15:45:00', '0.00', '0.00', '0.00', '', '2019-01-08', '65', '', '40.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('128', '3', '00021', 'OFICINA CENTRAL', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '11:00:00', '14:00:00', '0.00', '4.00', '0.00', '', '2019-01-10', '66', '', '83.11');
INSERT INTO `vyp_empresa_viatico` VALUES ('134', '00020', '47', 'OFICINA DEPARTAMENTAL DE LA UNION', 'AGROFERRETERIA SANTA CLARA (Santa rosa de lima/La unión)', '08:15:00', '09:12:00', '0.00', '0.00', '0.00', '', '2019-01-10', '67', '', '43.62');
INSERT INTO `vyp_empresa_viatico` VALUES ('138', '00032', '45', 'OFICINA DEPARTAMENTAL DE USULUTAN', 'FERRETERIA SAN JOSE (El triunfo/Usulután)', '08:30:00', '09:30:00', '0.00', '0.00', '0.00', '', '2019-01-10', '61', '', '35.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('139', '45', '45', 'FERRETERIA SAN JOSE (El triunfo/Usulután)', 'AUTO HOTEL MUNDANI (El triunfo/Usulután)', '10:00:00', '10:05:00', '0.00', '0.00', '0.00', '', '2019-01-10', '61', '', '35.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('140', '45', '46', 'AUTO HOTEL MUNDANI (El triunfo/Usulután)', 'HOSTAL ENTREPIEDRAS (Alegria/Usulután)', '11:00:00', '11:30:00', '0.00', '4.00', '0.00', '', '2019-01-10', '61', '', '29.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('141', '46', '00032', 'HOSTAL ENTREPIEDRAS (Alegria/Usulután)', 'OFICINA DEPARTAMENTAL DE USULUTAN', '12:30:00', '14:00:00', '0.00', '0.00', '0.00', '', '2019-01-10', '61', '', '29.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('146', '47', '48', 'AGROFERRETERIA SANTA CLARA (Santa rosa de lima/La unión)', 'GALVANISSA (Santa rosa de lima/La unión)', '09:55:00', '10:12:00', '0.00', '0.00', '0.00', '', '2019-01-10', '67', '', '43.62');
INSERT INTO `vyp_empresa_viatico` VALUES ('149', '48', '49', 'GALVANISSA (Santa rosa de lima/La unión)', 'TIENDA FLOR DE MARIA (Santa rosa de lima/La unión)', '11:20:00', '12:09:00', '0.00', '4.00', '0.00', '', '2019-01-10', '67', '', '48.46');
INSERT INTO `vyp_empresa_viatico` VALUES ('150', '49', '00020', 'TIENDA FLOR DE MARIA (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:20:00', '14:20:00', '0.00', '0.00', '0.00', '', '2019-01-10', '67', '', '48.46');
INSERT INTO `vyp_empresa_viatico` VALUES ('151', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'DON POLLO NUMERO 114, SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', '08:15:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-10', '60', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('152', '8', '8', 'DON POLLO NUMERO 114, SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', 'FARMACIA SANTA MARIA #2, SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', '10:40:00', '11:20:00', '0.00', '0.00', '0.00', '', '2019-01-10', '60', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('153', '8', '8', 'FARMACIA SANTA MARIA #2, SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', 'NIEVE ESMERALDA SALON (Santa rosa de lima/La unión)', '11:30:00', '12:20:00', '0.00', '4.00', '0.00', '', '2019-01-10', '60', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('154', '8', '00020', 'NIEVE ESMERALDA SALON (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:20:00', '14:20:00', '0.00', '0.00', '0.00', '', '2019-01-10', '60', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('156', '00020', '14', 'OFICINA DEPARTAMENTAL DE LA UNION', 'LABORATORIO CLÍNICO DELMER (Santa rosa de lima/La unión)', '08:15:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-08', '24', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('157', '14', '15', 'LABORATORIO CLÍNICO DELMER (Santa rosa de lima/La unión)', 'LIBRERIA Y VARIEDADES SANDRA (Santa rosa de lima/La unión)', '11:00:00', '11:10:00', '0.00', '0.00', '0.00', '', '2019-01-08', '24', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('158', '15', '00020', 'LIBRERIA Y VARIEDADES SANDRA (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:15:00', '14:15:00', '0.00', '4.00', '0.00', '', '2019-01-08', '24', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('159', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'TIENDA EL PROGRESO (Santa rosa de lima/La unión)', '08:15:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-10', '70', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('160', '8', '8', 'TIENDA EL PROGRESO (Santa rosa de lima/La unión)', 'DISTRIBUIDORA LILIAMS (Santa rosa de lima/La unión)', '09:30:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-10', '70', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('161', '8', '00020', 'DISTRIBUIDORA LILIAMS (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:15:00', '14:15:00', '0.00', '4.00', '0.00', '', '2019-01-10', '70', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('164', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'PNC SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', '08:30:00', '09:30:00', '0.00', '0.00', '0.00', '', '2019-01-11', '73', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('165', '8', '00020', 'PNC SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:10:00', '14:15:00', '0.00', '4.00', '0.00', '', '2019-01-11', '73', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('166', '00016', '34', 'OFICINA PARACENTRAL, LA PAZ', 'FOMILENIO II (San luis talpa/La paz)', '09:00:00', '14:00:00', '0.00', '4.00', '0.00', '', '2019-01-11', '75', '', '32.00');
INSERT INTO `vyp_empresa_viatico` VALUES ('167', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'PADECOMSM SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', '08:00:00', '09:05:00', '0.00', '0.00', '0.00', '', '2019-01-11', '74', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('168', '8', '8', 'PADECOMSM SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', 'FARMACIA SAN REY (Santa rosa de lima/La unión)', '09:50:00', '10:00:00', '0.00', '0.00', '0.00', '', '2019-01-11', '74', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('169', '8', '8', 'FARMACIA SAN REY (Santa rosa de lima/La unión)', 'CELULAR BOUTIQUE (Santa rosa de lima/La unión)', '10:20:00', '10:25:00', '0.00', '0.00', '0.00', '', '2019-01-11', '74', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('170', '8', '00020', 'CELULAR BOUTIQUE (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '10:40:00', '12:40:00', '0.00', '0.00', '0.00', '', '2019-01-11', '74', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('171', '00022', '32', 'OFICINA CENTRAL', 'PAPELERA INTERNACIONAL, S.A. (San juan opico/La libertad)', '11:00:00', '13:30:00', '0.00', '4.00', '0.00', '', '2019-01-11', '77', '', '34.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('172', '32', '00022', 'PAPELERA INTERNACIONAL, S.A. (San juan opico/La libertad)', 'OFICINA CENTRAL', '14:00:00', '14:30:00', '0.00', '0.00', '0.00', '', '2019-01-11', '77', '', '34.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('176', '00022', '53', 'OFICINA CENTRAL', 'BOLSA DE EMPLEO (Ilobasco/Cabañas)', '09:20:00', '11:10:00', '0.00', '0.00', '0.00', '', '2019-01-11', '68', '', '54.80');
INSERT INTO `vyp_empresa_viatico` VALUES ('177', '53', '4', 'BOLSA DE EMPLEO (Ilobasco/Cabañas)', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '11:34:00', '12:40:00', '0.00', '4.00', '0.00', '', '2019-01-11', '68', '', '83.11');
INSERT INTO `vyp_empresa_viatico` VALUES ('178', '4', '00022', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'OFICINA CENTRAL', '14:40:00', '16:42:00', '0.00', '0.00', '0.00', '', '2019-01-11', '68', '', '83.11');
INSERT INTO `vyp_empresa_viatico` VALUES ('184', '00021', '55', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'INSTITUTO NACIONAL DE ILOBASCO (Ilobasco/Cabañas)', '09:40:00', '10:15:00', '0.00', '0.00', '0.00', '', '2019-01-11', '80', '', '31.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('185', '55', '00021', 'INSTITUTO NACIONAL DE ILOBASCO (Ilobasco/Cabañas)', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '10:20:00', '13:45:00', '0.00', '4.00', '0.00', '', '2019-01-11', '80', '', '31.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('193', '00024', '16', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'ISSS PUERTO DE LA LIBERTAD (La libertad/La libertad)', '08:30:00', '09:40:00', '0.00', '0.00', '0.00', '', '2019-01-11', '82', '', '28.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('195', '00024', '54', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'HOTEL PURO SURF (Chiltiupan/La libertad)', '10:10:00', '10:46:00', '0.00', '0.00', '0.00', '', '2019-01-11', '82', '', '39.00');
INSERT INTO `vyp_empresa_viatico` VALUES ('197', '54', '00024', 'HOTEL PURO SURF (Chiltiupan/La libertad)', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', '13:30:00', '14:47:00', '0.00', '4.00', '0.00', '', '2019-01-11', '82', '', '28.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('198', '00022', '53', 'OFICINA CENTRAL', 'PLAN INTERNACIONAL  (Ilobasco/Cabañas)', '09:20:00', '11:10:00', '0.00', '0.00', '0.00', '', '2019-01-11', '83', '', '54.80');
INSERT INTO `vyp_empresa_viatico` VALUES ('200', '53', '50', 'PLAN INTERNACIONAL  (Ilobasco/Cabañas)', 'MTPS SENSUNTEPEQUE (Sensuntepeque/Cabañas)', '11:50:00', '12:45:00', '0.00', '4.00', '0.00', '', '2019-01-11', '83', '', '81.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('201', '50', '00022', 'MTPS SENSUNTEPEQUE (Sensuntepeque/Cabañas)', 'OFICINA CENTRAL', '15:45:00', '16:42:00', '0.00', '0.00', '0.00', '', '2019-01-11', '83', '', '81.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('202', '00022', '56', 'OFICINA CENTRAL', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', '10:23:00', '11:25:00', '0.00', '0.00', '0.00', '', '2019-01-14', '84', '', '36.80');
INSERT INTO `vyp_empresa_viatico` VALUES ('203', '56', '00022', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', 'OFICINA CENTRAL', '13:00:00', '14:15:00', '0.00', '4.00', '0.00', '', '2019-01-14', '84', '', '36.80');
INSERT INTO `vyp_empresa_viatico` VALUES ('204', '00022', '2', 'OFICINA CENTRAL', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', '08:45:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-11', '85', '', '57.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('205', '2', '00022', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'OFICINA CENTRAL', '11:45:00', '14:00:00', '0.00', '4.00', '0.00', '', '2019-01-11', '85', '', '57.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('217', '00024', '60', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'HANESBRANDS EL SALVADOR, LIMITADA DE C.V. (San juan opico/La libertad)', '08:17:00', '08:50:00', '0.00', '0.00', '0.00', '', '2019-01-15', '89', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('218', '60', '60', 'HANESBRANDS EL SALVADOR, LIMITADA DE C.V. (San juan opico/La libertad)', 'PASTELES DE EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', '12:20:00', '13:20:00', '0.00', '4.00', '0.00', '', '2019-01-15', '89', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('219', '60', '00024', 'PASTELES DE EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', '15:00:00', '15:24:00', '0.00', '0.00', '0.00', '', '2019-01-15', '89', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('220', '00024', '60', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'HANESBRANDS EL SALVADOR, LTDA. DE C.V. (San juan opico/La libertad)', '08:17:00', '08:50:00', '0.00', '0.00', '0.00', '', '2019-01-15', '91', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('221', '60', '60', 'HANESBRANDS EL SALVADOR, LTDA. DE C.V. (San juan opico/La libertad)', 'PASTELES DE EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', '12:20:00', '13:20:00', '0.00', '4.00', '0.00', '', '2019-01-15', '91', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('222', '60', '00024', 'PASTELES DE EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', '15:00:00', '15:24:00', '0.00', '0.00', '0.00', '', '2019-01-15', '91', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('231', '00016', '29', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA CENTRAL', '08:30:00', '09:30:00', '0.00', '0.00', '0.00', '', '2019-01-16', '96', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('232', '29', '00016', 'OFICINA CENTRAL', 'OFICINA PARACENTRAL, LA PAZ', '15:00:00', '17:00:00', '0.00', '4.00', '0.00', '', '2019-01-16', '96', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('234', '00032', '64', 'OFICINA DEPARTAMENTAL DE USULUTAN', 'ALCALDIA MUNICIPAL DE JIQUILISCO (Jiquilisco/Usulután)', '09:00:00', '09:30:00', '0.00', '0.00', '0.00', '', '2019-01-15', '97', '', '18.60');
INSERT INTO `vyp_empresa_viatico` VALUES ('235', '64', '00032', 'ALCALDIA MUNICIPAL DE JIQUILISCO (Jiquilisco/Usulután)', 'OFICINA DEPARTAMENTAL DE USULUTAN', '13:15:00', '13:45:00', '0.00', '4.00', '0.00', '', '2019-01-15', '97', '', '18.60');
INSERT INTO `vyp_empresa_viatico` VALUES ('236', '00022', '2', 'OFICINA CENTRAL', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', '08:45:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-15', '85', '', '57.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('238', '65', '65', 'ACMASA (San pedro perulapan/Cuscatlán)', 'ACMASA (PLANTA 1) (San pedro perulapan/Cuscatlán)', '10:10:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-15', '98', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('239', '65', '65', 'ACMASA (San pedro perulapan/Cuscatlán)', 'ACMASA (PLANTA 2) (San pedro perulapan/Cuscatlán)', '10:45:00', '11:15:00', '0.00', '0.00', '0.00', '', '2019-01-15', '98', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('240', '00024', '60', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'HANES BRAND EL SALVADOR LTDA DE CV (San juan opico/La libertad)', '08:17:00', '08:50:00', '0.00', '0.00', '0.00', '', '2019-01-15', '86', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('241', '60', '60', 'HANES BRAND EL SALVADOR LTDA DE CV (San juan opico/La libertad)', 'PASTELES DE EL SALVADOR SA DE CV (San juan opico/La libertad)', '12:20:00', '13:20:00', '0.00', '4.00', '0.00', '', '2019-01-15', '86', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('242', '60', '00024', 'PASTELES DE EL SALVADOR SA DE CV (San juan opico/La libertad)', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', '15:00:00', '15:24:00', '0.00', '0.00', '0.00', '', '2019-01-15', '86', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('244', '00024', '61', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'SALCHEM (Quezaltepeque/La libertad)', '09:20:00', '10:18:00', '0.00', '0.00', '0.00', '', '2019-01-14', '101', '', '23.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('245', '61', '00024', 'SALCHEM (Quezaltepeque/La libertad)', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', '14:20:00', '15:06:00', '0.00', '4.00', '0.00', '', '2019-01-14', '101', '', '23.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('246', '00015', '66', 'OFICINA REGIONAL DE OCCIDENTE', 'OFICINA CENTRAL', '06:30:00', '07:30:00', '0.00', '3.00', '0.00', '', '2019-01-16', '103', '', '67.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('247', '66', '00015', 'OFICINA CENTRAL', 'OFICINA REGIONAL DE OCCIDENTE', '13:00:00', '15:00:00', '0.00', '4.00', '0.00', '', '2019-01-16', '103', '', '67.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('255', '00024', '60', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'SIL (San juan opico/La libertad)', '10:50:00', '13:20:00', '0.00', '4.00', '0.00', '', '2019-01-15', '104', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('256', '60', '00024', 'SIL (San juan opico/La libertad)', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', '13:25:00', '15:00:00', '0.00', '0.00', '0.00', '', '2019-01-15', '104', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('262', '00022', '24', 'OFICINA CENTRAL', 'LEONOR INDUSTRIES, S.A DE C.V (Santa ana/Santa ana)', '07:10:00', '14:50:00', '0.00', '4.00', '0.00', '', '2019-01-17', '106', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('263', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'AUTO REPUESTOS VILLATORO REYES (Santa rosa de lima/La unión)', '08:15:00', '09:20:00', '0.00', '0.00', '0.00', '', '2019-01-16', '107', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('264', '8', '8', 'AUTO REPUESTOS VILLATORO REYES (Santa rosa de lima/La unión)', 'FARMACIA BUENA SALUD  (Santa rosa de lima/La unión)', '12:30:00', '14:00:00', '0.00', '4.00', '0.00', '', '2019-01-16', '107', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('265', '8', '00020', 'FARMACIA BUENA SALUD  (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '14:01:00', '15:00:00', '0.00', '0.00', '0.00', '', '2019-01-16', '107', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('274', '00023', '65', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', 'ACMASA (San pedro perulapan/Cuscatlán)', '08:30:00', '09:14:00', '0.00', '0.00', '0.00', '', '2019-01-15', '109', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('275', '00023', '65', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', 'ACMASA PLANTA 1 (San pedro perulapan/Cuscatlán)', '10:10:00', '10:30:00', '0.00', '0.00', '0.00', '', '2019-01-15', '109', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('276', '00023', '65', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', 'ACMASA PLANTA 2 (San pedro perulapan/Cuscatlán)', '10:40:00', '11:25:00', '0.00', '0.00', '0.00', '', '2019-01-15', '109', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('277', '00023', '65', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', 'ACMASA OFICINA ADMNISTRATIVA (San pedro perulapan/Cuscatlán)', '11:45:00', '12:00:00', '0.00', '0.00', '0.00', '', '2019-01-15', '109', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('280', '00023', '65', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', 'ACOSAMA (San pedro perulapan/Cuscatlán)', '12:30:00', '13:25:00', '0.00', '0.00', '0.00', '', '2019-01-15', '109', '', '17.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('281', '00023', '69', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', 'MINISTERIO DE TRABAJO  (Cojutepeque/Cuscatlán)', '15:15:00', '15:32:00', '0.00', '0.00', '0.00', '', '2019-01-15', '109', '', '0.50');
INSERT INTO `vyp_empresa_viatico` VALUES ('284', '00021', '55', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'GRANJA DE REHABILITACIÓN PARA JÓVENES EN CONFLICTO CON LA LEY PENAL JUVENIL (Ilobasco/Cabañas)', '09:00:00', '10:00:00', '0.00', '0.00', '0.00', '', '2019-01-16', '108', '', '31.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('288', '55', '00021', 'UNIVERSIDAD CATOLICA DE EL SALVADOR (Ilobasco/Cabañas)', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '14:00:00', '14:40:00', '0.00', '4.00', '0.00', '', '2019-01-16', '108', '', '31.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('289', '00021', '55', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'GRANJA DE REHABILITACIÓN PARA JÓVENES EN CONFLICTO CON LA LEY PENAL JUVENIL (Ilobasco/Cabañas)', '09:00:00', '10:05:00', '0.00', '0.00', '0.00', '', '2019-01-17', '110', '', '31.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('290', '55', '00021', 'UNIVERSIDAD CATÓLICA DE EL SALVADOR (Ilobasco/Cabañas)', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '14:00:00', '14:40:00', '0.00', '4.00', '0.00', '', '2019-01-17', '110', '', '31.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('292', '00015', '70', 'OFICINA REGIONAL DE OCCIDENTE', 'INGENIO LA MAGDALENA (Chalchuapa/Santa ana)', '09:15:00', '09:45:00', '0.00', '0.00', '0.00', '', '2019-01-15', '112', '', '15.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('293', '70', '70', 'INGENIO LA MAGDALENA (Chalchuapa/Santa ana)', 'CONAL (Chalchuapa/Santa ana)', '10:30:00', '10:45:00', '0.00', '0.00', '0.00', '', '2019-01-15', '112', '', '15.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('294', '70', '70', 'CONAL (Chalchuapa/Santa ana)', 'SUPERTEX (Chalchuapa/Santa ana)', '10:50:00', '10:55:00', '0.00', '0.00', '0.00', '', '2019-01-15', '112', '', '15.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('295', '70', '70', 'SUPERTEX (Chalchuapa/Santa ana)', 'PARQUE JOSÉ MATÍAS DELGADO (Chalchuapa/Santa ana)', '11:30:00', '11:40:00', '0.00', '4.00', '0.00', '', '2019-01-15', '112', '', '15.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('296', '70', '00015', 'PARQUE JOSÉ MATÍAS DELGADO (Chalchuapa/Santa ana)', 'OFICINA REGIONAL DE OCCIDENTE', '12:45:00', '13:30:00', '0.00', '0.00', '0.00', '', '2019-01-15', '112', '', '15.20');
INSERT INTO `vyp_empresa_viatico` VALUES ('297', '00022', '24', 'OFICINA CENTRAL', 'LENOR INDUSTRIES, S. A. DE C. V. (Santa ana/Santa ana)', '07:10:00', '09:31:00', '0.00', '0.00', '0.00', '', '2019-01-16', '95', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('298', '24', '24', 'LENOR INDUSTRIES, S. A. DE C. V. (Santa ana/Santa ana)', 'HOSPITAL NACIONAL SAN JUAN DE DIOS (Santa ana/Santa ana)', '10:00:00', '10:15:00', '0.00', '0.00', '0.00', '', '2019-01-16', '95', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('299', '24', '24', 'HOSPITAL NACIONAL SAN JUAN DE DIOS (Santa ana/Santa ana)', 'HOSPITAL SAN ANTONIO (Santa ana/Santa ana)', '11:40:00', '12:05:00', '0.00', '4.00', '0.00', '', '2019-01-16', '95', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('300', '24', '00022', 'HOSPITAL SAN ANTONIO (Santa ana/Santa ana)', 'OFICINA CENTRAL', '13:50:00', '14:50:00', '0.00', '0.00', '0.00', '', '2019-01-16', '95', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('305', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'ACOPALIN (Santa rosa de lima/La unión)', '08:00:00', '09:00:00', '0.00', '0.00', '0.00', '', '2019-01-17', '118', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('306', '8', '8', 'ACOPALIN (Santa rosa de lima/La unión)', 'SUBWAY (Santa rosa de lima/La unión)', '10:50:00', '10:55:00', '0.00', '0.00', '0.00', '', '2019-01-17', '118', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('307', '8', '8', 'SUBWAY (Santa rosa de lima/La unión)', 'MARMOLERIA MARQUEZ MONGE (Santa rosa de lima/La unión)', '12:30:00', '13:40:00', '0.00', '4.00', '0.00', '', '2019-01-17', '118', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('308', '8', '00020', 'MARMOLERIA MARQUEZ MONGE (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:41:00', '14:15:00', '0.00', '0.00', '0.00', '', '2019-01-17', '118', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('309', '00022', '68', 'OFICINA CENTRAL', 'OFICINA DE LA RUTA 106 (Tepecoyo/La libertad)', '11:00:00', '13:20:00', '0.00', '4.00', '0.00', '', '2019-01-16', '117', '', '38.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('310', '68', '00022', 'OFICINA DE LA RUTA 106 (Tepecoyo/La libertad)', 'OFICINA CENTRAL', '13:30:00', '14:35:00', '0.00', '0.00', '0.00', '', '2019-01-16', '117', '', '38.30');
INSERT INTO `vyp_empresa_viatico` VALUES ('313', '00015', '73', 'OFICINA REGIONAL DE OCCIDENTE', 'OFICINA DEPARTAMENTAL DE SONSONATE', '08:00:00', '09:00:00', '0.00', '0.00', '0.00', '', '2019-01-15', '114', '', '43.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('314', '31', '24', 'GESEL, S.A. DE C.V. (San salvador/San salvador)', 'SALA DE LO CONTENCIOSO ADMINISTRATIVO DE SANTA ANA (Santa ana/Santa ana)', '10:20:00', '11:50:00', '0.00', '0.00', '0.00', '', '2019-01-14', '119', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('315', '73', '00015', 'OFICINA DEPARTAMENTAL DE SONSONATE', 'OFICINA REGIONAL DE OCCIDENTE', '14:00:00', '15:00:00', '0.00', '4.00', '0.00', '', '2019-01-15', '114', '', '43.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('316', '24', '00022', 'SALA DE LO CONTENCIOSO ADMINISTRATIVO DE SANTA ANA (Santa ana/Santa ana)', 'OFICINA CENTRAL', '12:00:00', '14:10:00', '0.00', '0.00', '0.00', '', '2019-01-14', '119', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('317', '00022', '76', 'OFICINA CENTRAL', 'TAQUERIA MEXICANA TA QUE PICA (Apopa/San salvador)', '07:30:00', '08:10:00', '0.00', '0.00', '0.00', '', '2019-01-15', '120', '', '15.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('318', '76', '77', 'TAQUERIA MEXICANA TA QUE PICA (Apopa/San salvador)', 'TIENDA BELEN (Nueva concepcion/Chalatenango)', '08:20:00', '10:50:00', '0.00', '0.00', '0.00', '', '2019-01-15', '120', '', '70.60');
INSERT INTO `vyp_empresa_viatico` VALUES ('319', '77', '00022', 'TIENDA BELEN (Nueva concepcion/Chalatenango)', 'OFICINA CENTRAL', '12:30:00', '14:00:00', '0.00', '4.00', '0.00', '', '2019-01-15', '120', '', '70.60');
INSERT INTO `vyp_empresa_viatico` VALUES ('326', '00015', '66', 'OFICINA REGIONAL DE OCCIDENTE', 'OFICINA CENTRAL', '08:05:00', '09:30:00', '0.00', '0.00', '0.00', '', '2019-01-17', '122', '', '67.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('327', '00020', '78', 'OFICINA DEPARTAMENTAL DE LA UNION', 'PIZZERIA & RESTAURANTE THREE FLAG´S (La union/La unión)', '08:15:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-16', '123', '', '60.19');
INSERT INTO `vyp_empresa_viatico` VALUES ('328', '78', '79', 'PIZZERIA & RESTAURANTE THREE FLAG´S (La union/La unión)', 'RANCHO EL TOROGOZ (Anamoros/La unión)', '10:40:00', '11:30:00', '0.00', '4.00', '0.00', '', '2019-01-16', '123', '', '60.19');
INSERT INTO `vyp_empresa_viatico` VALUES ('329', '66', '00015', 'OFICINA CENTRAL', 'OFICINA REGIONAL DE OCCIDENTE', '12:00:00', '13:30:00', '0.00', '4.00', '0.00', '', '2019-01-17', '122', '', '67.21');
INSERT INTO `vyp_empresa_viatico` VALUES ('330', '79', '00020', 'RANCHO EL TOROGOZ (Anamoros/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '11:40:00', '13:30:00', '0.00', '0.00', '0.00', '', '2019-01-16', '123', '', '60.19');
INSERT INTO `vyp_empresa_viatico` VALUES ('335', '00016', '29', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA CENTRAL', '08:20:00', '10:00:00', '0.00', '0.00', '0.00', '', '2019-01-16', '124', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('336', '29', '00016', 'OFICINA CENTRAL', 'OFICINA PARACENTRAL, LA PAZ', '15:40:00', '17:30:00', '0.00', '4.00', '0.00', '', '2019-01-16', '124', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('337', '00020', '81', 'OFICINA DEPARTAMENTAL DE LA UNION', 'BANCO AZTECA AGENCIA SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', '08:00:00', '09:00:00', '0.00', '0.00', '0.00', '', '2019-01-18', '126', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('338', '81', '82', 'BANCO AZTECA AGENCIA SANTA ROSA DE LIMA (Santa rosa de lima/La unión)', 'CELULAR BOUTIQUE SANTA ROSA #2 (Santa rosa de lima/La unión)', '11:20:00', '11:30:00', '0.00', '4.00', '0.00', '', '2019-01-18', '126', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('339', '82', '83', 'CELULAR BOUTIQUE SANTA ROSA #2 (Santa rosa de lima/La unión)', 'FARMACIAS BRASIL #19 (Santa rosa de lima/La unión)', '12:20:00', '13:30:00', '0.00', '0.00', '0.00', '', '2019-01-18', '126', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('340', '83', '00020', 'FARMACIAS BRASIL #19 (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:40:00', '14:15:00', '0.00', '0.00', '0.00', '', '2019-01-18', '126', '', '45.31');
INSERT INTO `vyp_empresa_viatico` VALUES ('341', '00020', '84', 'OFICINA DEPARTAMENTAL DE LA UNION', 'ACOPALIN (Santa rosa de lima/La unión)', '08:00:00', '09:20:00', '0.00', '0.00', '0.00', '', '2019-01-17', '128', '', '46.22');
INSERT INTO `vyp_empresa_viatico` VALUES ('342', '84', '85', 'ACOPALIN (Santa rosa de lima/La unión)', 'ESTACIÓN DE SERVICIO PETROIN (Santa rosa de lima/La unión)', '10:25:00', '11:50:00', '0.00', '4.00', '0.00', '', '2019-01-17', '128', '', '46.22');
INSERT INTO `vyp_empresa_viatico` VALUES ('343', '85', '86', 'ESTACIÓN DE SERVICIO PETROIN (Santa rosa de lima/La unión)', 'MARMOLERIA MARQUEZ MONGE (Santa rosa de lima/La unión)', '12:12:00', '13:01:00', '0.00', '0.00', '0.00', '', '2019-01-17', '128', '', '46.22');
INSERT INTO `vyp_empresa_viatico` VALUES ('344', '86', '00020', 'MARMOLERIA MARQUEZ MONGE (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:20:00', '14:20:00', '0.00', '0.00', '0.00', '', '2019-01-17', '128', '', '46.22');
INSERT INTO `vyp_empresa_viatico` VALUES ('345', '00024', '58', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'PUBLI ARTE SA DE CV  (Santa tecla/La libertad)', '09:35:00', '09:50:00', '0.00', '0.00', '0.00', '', '2019-01-17', '129', '', '1.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('346', '58', '87', 'PUBLI ARTE SA DE CV  (Santa tecla/La libertad)', 'UNIFI CENTRAL AMERICA LTDA DE CV  (Ciudad arce/La libertad)', '10:20:00', '10:55:00', '0.00', '0.00', '0.00', '', '2019-01-17', '129', '', '41.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('347', '87', '87', 'UNIFI CENTRAL AMERICA LTDA DE CV  (Ciudad arce/La libertad)', 'PAM TRADING CORPORATION EL SALVADOR LTDA DE CV (Ciudad arce/La libertad)', '11:20:00', '11:30:00', '0.00', '0.00', '0.00', '', '2019-01-17', '129', '', '41.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('348', '00020', '8', 'OFICINA DEPARTAMENTAL DE LA UNION', 'SALEM IDEAS Y SOLUCIONES (Santa rosa de lima/La unión)', '08:00:00', '09:00:00', '0.00', '0.00', '0.00', '', '2019-01-15', '133', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('349', '8', '8', 'SALEM IDEAS Y SOLUCIONES (Santa rosa de lima/La unión)', 'LABORATORIO CLINICO DIAGNOSTICO ORIENTAL  (Santa rosa de lima/La unión)', '10:00:00', '11:50:00', '0.00', '4.00', '0.00', '', '2019-01-15', '133', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('350', '8', '00020', 'LABORATORIO CLINICO DIAGNOSTICO ORIENTAL  (Santa rosa de lima/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:10:00', '14:10:00', '0.00', '0.00', '0.00', '', '2019-01-15', '133', '', '46.90');
INSERT INTO `vyp_empresa_viatico` VALUES ('351', '00020', '88', 'OFICINA DEPARTAMENTAL DE LA UNION', 'ESPECIAL PIZZA (Anamoros/La unión)', '08:15:00', '09:15:00', '0.00', '0.00', '0.00', '', '2019-01-16', '136', '', '55.40');
INSERT INTO `vyp_empresa_viatico` VALUES ('352', '88', '88', 'ESPECIAL PIZZA (Anamoros/La unión)', 'AGENCIA DE VIAJES SANTA MARIA (Anamoros/La unión)', '10:50:00', '11:20:00', '0.00', '0.00', '0.00', '', '2019-01-16', '136', '', '55.40');
INSERT INTO `vyp_empresa_viatico` VALUES ('353', '88', '88', 'AGENCIA DE VIAJES SANTA MARIA (Anamoros/La unión)', 'FOTO ESTUDIO ALVAREZ (Anamoros/La unión)', '11:25:00', '11:30:00', '0.00', '4.00', '0.00', '', '2019-01-16', '136', '', '55.40');
INSERT INTO `vyp_empresa_viatico` VALUES ('354', '00024', '60', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'INDUSTRIAS TALPA, S.A. DE C.V. (San juan opico/La libertad)', '09:35:00', '10:51:00', '0.00', '0.00', '0.00', '', '2019-01-17', '135', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('355', '88', '00020', 'FOTO ESTUDIO ALVAREZ (Anamoros/La unión)', 'OFICINA DEPARTAMENTAL DE LA UNION', '13:50:00', '15:00:00', '0.00', '0.00', '0.00', '', '2019-01-16', '136', '', '55.40');
INSERT INTO `vyp_empresa_viatico` VALUES ('356', '60', '60', 'INDUSTRIAS TALPA, S.A. DE C.V. (San juan opico/La libertad)', 'UNIQUE, S.A. DE C.V. (San juan opico/La libertad)', '11:37:00', '12:10:00', '0.00', '0.00', '0.00', '', '2019-01-17', '135', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('367', '00022', '31', 'OFICINA CENTRAL', 'PEOPLE S.A. DE C.V. (San salvador/San salvador)', '10:00:00', '10:10:00', '0.00', '0.00', '0.00', '', '2019-01-16', '140', '', '3.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('368', '31', '31', 'PEOPLE S.A. DE C.V. (San salvador/San salvador)', 'FUNERARIA LA MEDITACIÓN (San salvador/San salvador)', '10:25:00', '10:35:00', '0.00', '0.00', '0.00', '', '2019-01-16', '140', '', '3.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('369', '31', '24', 'FUNERARIA LA MEDITACIÓN (San salvador/San salvador)', 'TUDO S.A. DE C.V. (Santa ana/Santa ana)', '10:45:00', '11:45:00', '0.00', '4.00', '0.00', '', '2019-01-16', '140', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('370', '24', '00022', 'TUDO S.A. DE C.V. (Santa ana/Santa ana)', 'OFICINA CENTRAL', '12:45:00', '15:25:00', '0.00', '0.00', '0.00', '', '2019-01-16', '140', '', '67.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('374', '00016', '29', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA CENTRAL', '09:00:00', '11:00:00', '2.00', '0.00', '0.00', '', '2019-01-17', '141', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('375', '29', '00016', 'OFICINA CENTRAL', 'OFICINA PARACENTRAL, LA PAZ', '13:00:00', '15:00:00', '0.00', '4.00', '0.00', '', '2019-01-17', '141', '', '65.10');
INSERT INTO `vyp_empresa_viatico` VALUES ('376', '60', '60', 'UNIQUE, S.A. DE C.V. (San juan opico/La libertad)', 'SWISSTEX EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', '12:30:00', '12:36:00', '0.00', '0.00', '0.00', '', '2019-01-17', '135', '', '40.70');
INSERT INTO `vyp_empresa_viatico` VALUES ('380', '60', '60', 'SWISSTEX EL SALVADOR, S.A. DE C.V. (San juan opico/La libertad)', 'YOBEL, S.A. DE C.V. (San juan opico/La libertad)', '13:10:00', '13:40:00', '0.00', '4.00', '0.00', '', '2019-01-17', '135', '', '40.70');

-- ----------------------------
-- Table structure for `vyp_empresas_visitadas`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_empresas_visitadas`;
CREATE TABLE `vyp_empresas_visitadas` (
  `id_empresas_visitadas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_mision_oficial` int(10) unsigned NOT NULL,
  `id_departamento` int(5) unsigned zerofill NOT NULL,
  `id_municipio` int(5) unsigned zerofill NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(200) NOT NULL,
  `tipo_destino` varchar(45) NOT NULL,
  `kilometraje` float(5,2) NOT NULL,
  `id_destino` varchar(5) NOT NULL,
  PRIMARY KEY (`id_empresas_visitadas`)
) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_empresas_visitadas
-- ----------------------------
INSERT INTO `vyp_empresas_visitadas` VALUES ('1', '1', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '57.21', '1');
INSERT INTO `vyp_empresas_visitadas` VALUES ('4', '11', '00014', '00260', 'HOTEL  EL TEJANO', 'BARRIO EL RECREO CALLE GIRON, UNA CUADRA AL ORIENTE DE  AGENCIA CLARO, SANTA ROSA DE LIMA, EL SALVADOR', 'destino_mapa', '46.94', '5');
INSERT INTO `vyp_empresas_visitadas` VALUES ('5', '11', '00014', '00260', 'TIENDA EMILY ', 'FINAL OCTAVA AVENIDA SUR,  SALIDA A PASAQUINA, SANTA ROSA DE LIMA, EL SALVADOR', 'destino_mapa', '46.94', '6');
INSERT INTO `vyp_empresas_visitadas` VALUES ('6', '11', '00014', '00260', 'TIENDA CARLITOS', 'OCTAVA AV. SUR,BARRIO EL RECREO, FRENTE A FARMACIA BERAKAH, SANTA ROSA DE LIMA, EL SALVADOR', 'destino_mapa', '46.94', '7');
INSERT INTO `vyp_empresas_visitadas` VALUES ('8', '11', '00014', '00260', 'ARACELY SALON', 'OCTAVA AVENIDA SUR,CONTIGUO A AGROSERVICIO LA FINCA, SANTA ROSA DE LIMA, EL SALVADOR', 'destino_mapa', '46.94', '9');
INSERT INTO `vyp_empresas_visitadas` VALUES ('9', '14', '00014', '00260', 'CLINICA SAN ATONIO', 'CALLE J. CLOROS NUMERO 20, BARRIO EL CALVARIO ', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('10', '14', '00014', '00260', 'GUAPOLLON #2 LA MARQUEZA', 'CALLE GIRON, B° EL CALVARIO, LA MARQUEZA,SANTA ROSA DE LIMA, LA UNION  EL SALVADOR', 'destino_mapa', '47.99', '10');
INSERT INTO `vyp_empresas_visitadas` VALUES ('11', '14', '00014', '00260', 'BOUTIQUE \"ANABELLA\"', '3ERA AV. SUR, Y CALLE GENERAL GIRON, B° EL CALVARIO, SANTA ROSA DE LIMA LA UNION.', 'destino_mapa', '47.99', '11');
INSERT INTO `vyp_empresas_visitadas` VALUES ('14', '24', '00014', '00260', ' LABORATORIO CLÍNICO DELMER', 'C°J CLAROS, N°20, B° EL CALVARIO, SANTA ROSA DE LIMA, EL SALVADOR', 'destino_mapa', '45.31', '14');
INSERT INTO `vyp_empresas_visitadas` VALUES ('15', '24', '00014', '00260', 'LIBRERIA Y VARIEDADES SANDRA', 'CALLE GENERAL GIRON, BARRIO EL CALVARIO', 'destino_mapa', '45.31', '15');
INSERT INTO `vyp_empresas_visitadas` VALUES ('26', '31', '00002', '00013', 'INTRADESA', 'CA 12N, SANTA ANA, EL SALVADOR', 'destino_mapa', '72.71', '23');
INSERT INTO `vyp_empresas_visitadas` VALUES ('27', '31', '00002', '00013', 'LENOR', 'ZONA FRANCA SANTA ANA CARRETERA A METAPAN', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('28', '31', '00006', '00098', 'CENTRO ESCOLAR CELSA PALACIOS', 'URBANIZACION CELSA PALACIOS KM 32 CARRETERA TRONCAL DEL NORTE', 'destino_municipio', '35.90', '25');
INSERT INTO `vyp_empresas_visitadas` VALUES ('29', '33', '00004', '00054', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'destino_oficina', '82.95', '26');
INSERT INTO `vyp_empresas_visitadas` VALUES ('30', '34', '00004', '00054', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'destino_oficina', '82.95', '26');
INSERT INTO `vyp_empresas_visitadas` VALUES ('31', '36', '00008', '00132', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA PARACENTRAL, LA PAZ', 'destino_oficina', '65.10', '28');
INSERT INTO `vyp_empresas_visitadas` VALUES ('32', '37', '00008', '00132', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA PARACENTRAL, LA PAZ', 'destino_oficina', '65.10', '28');
INSERT INTO `vyp_empresas_visitadas` VALUES ('33', '35', '00010', '00163', 'CENTRO ESCOLAR PROFESOR JUSTO CARDOZA', 'FINAL 15 AV. SUR. PENITENCIARIA ORIENTAL, CIUDAD Y DEPTO. SAN VICENTE', 'destino_municipio', '59.20', '30');
INSERT INTO `vyp_empresas_visitadas` VALUES ('35', '41', '00006', '00097', 'SANTIAGO ABERLARDO PORTILLO ORTIZ', 'COLONIA FLOR BLANCA, 37 AVENIDA SUR, # 519', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('36', '41', '00006', '00097', 'ANGEL HUMBERTO RIVERA ARGUETA', 'RESIDENCIAL TAZUMAL, AVENIDA LOS BAMBUES, POLIGONO # 1, # 11', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('37', '41', '00006', '00097', 'TACO EL SALVADOR, S.A. DE C.V.', 'RESIDENCIAL SAN FRANCISCO, CALLE LOS ABETOS, PASAJE # 1, # 38', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('38', '41', '00006', '00097', 'SEGURIDAD PRIVADA SALVADOREÑA, S.A. DE C.V.', 'COLONIA MONSERRAT, BLOCK \"P\", ENTRE PASAJE # 13 Y # 15, # 311', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('39', '41', '00005', '00087', 'ZETA GAS DE EL SALVADOR, S.A. DE C.V.', 'KILOMETRO 35 ½ DESVIO A QUEZALTEPEQUE, CANTON SITIO DEL NIÑO', 'destino_municipio', '34.30', '32');
INSERT INTO `vyp_empresas_visitadas` VALUES ('44', '49', '00008', '00147', 'CEPA', 'AEROPUERTO INTERNACIONAL MONSEÑOR OSCAR ARNULFO ROMERO, SAN LUIS TALPA, LA PAZ', 'destino_municipio', '32.00', '34');
INSERT INTO `vyp_empresas_visitadas` VALUES ('45', '48', '00008', '00147', 'HIDALGO E HIDALGO', 'CARRETERA AL AEROPUERTO SAN LUIS TALPA', 'destino_municipio', '32.00', '34');
INSERT INTO `vyp_empresas_visitadas` VALUES ('51', '52', '00014', '00258', 'RUTA DE BUSES 421 B', 'CANTON SANTA CRUCITA, SAN ALEJO, EL SALVADOR', 'destino_mapa', '35.18', '39');
INSERT INTO `vyp_empresas_visitadas` VALUES ('53', '52', '00014', '00260', 'MOTO MAQUINARIA', 'CARRETERA RUTA MILITAR, COLONIA ALTOS DEL ESTADIO # 1 SANTA ROSA DE LIMA, LA UNIÓN', 'destino_mapa', '35.18', '41');
INSERT INTO `vyp_empresas_visitadas` VALUES ('59', '54', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '117.01', '42');
INSERT INTO `vyp_empresas_visitadas` VALUES ('62', '62', '00014', '00260', 'AGROFERRETERIA SANTA CLARA', 'CARRETERA RUTA MILITAR, LOTE NUMERO DOS, LOTIFICACION UNIVERSAL, FRENTE AL MAG, SANTA ROSA DE LIMA', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('63', '61', '00011', '00181', 'AUTO HOTEL MUNDANI', 'CARRETERA PANAMERICANA KM 105, EL TRIUNFO, USULUTAN', 'destino_municipio', '35.90', '45');
INSERT INTO `vyp_empresas_visitadas` VALUES ('65', '62', '00014', '00260', 'PISOS Y AZULEJOS FLORES', 'CARRETERA RUTA MILITAR, COLONIA UNIVERSAL NUMERO UNO, SANTA ROSA DE LIMA, LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('66', '61', '00011', '00181', 'FERRETERIA SAN JOSE', 'CARRETERA PANAMERICANA EL TRIUNFO, USULUTAN', 'destino_municipio', '35.90', '45');
INSERT INTO `vyp_empresas_visitadas` VALUES ('68', '62', '00014', '00260', 'COMERCIAL ZONA LIBRE', 'CALLE RUTA MILITAR, COLONIA MAG, ENTRADA PRINCIPAL A LA CANCHA SANTA ROSA DE LIMA, LA UNIÓN.', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('69', '61', '00011', '00177', 'HOSTAL ENTREPIEDRAS', 'CALLE EL CENTRO, ALEGRIA, USULUTAN', 'destino_municipio', '29.90', '46');
INSERT INTO `vyp_empresas_visitadas` VALUES ('70', '65', '00009', '00159', 'INVERSIONES PEÑATE PORTILLO S.A DE C.V.', ' CASERÍO CERRON GRANDE, CANTÓN SAN SEBASTIAN, JUTIAPA, CABAÑAS.', 'destino_municipio', '40.10', '44');
INSERT INTO `vyp_empresas_visitadas` VALUES ('71', '65', '00009', '00159', 'O & M MANTENIMIENTO Y SERVIO S.A DE C.V.', ' CASERÍO CERRON GRANDE, CANTÓN SAN SEBASTIAN, JUTIAPA, CABAÑAS.', 'destino_municipio', '40.10', '44');
INSERT INTO `vyp_empresas_visitadas` VALUES ('72', '66', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '83.11', '3');
INSERT INTO `vyp_empresas_visitadas` VALUES ('73', '67', '00014', '00260', 'AGROFERRETERIA SANTA CLARA', 'CARRETERA RUTA MILITAR, LOTE N°2, LOTIFICACION UNIVERSAL,FRENTE A MAG, SANTA ROSA DE LIMA EL SALVADOR', 'destino_mapa', '43.62', '47');
INSERT INTO `vyp_empresas_visitadas` VALUES ('74', '67', '00014', '00260', 'GALVANISSA', 'CARRETERA RUTA MILITAR, KM182 Y1/2,SANTA ROSA DE LIMA, LA UNION', 'destino_mapa', '43.62', '48');
INSERT INTO `vyp_empresas_visitadas` VALUES ('75', '67', '00014', '00260', 'TIENDA FLOR DE MARIA', 'CALL RUTA MILITAR, COLONIA EL MAG, SANTA ROSA DE LIMA LA UNION, EL SALVADOR', 'destino_mapa', '48.46', '49');
INSERT INTO `vyp_empresas_visitadas` VALUES ('76', '60', '00014', '00260', 'DON POLLO NUMERO 114, SANTA ROSA DE LIMA', 'CALLE GENERAL GIRON CASA #13, BARRIO EL CALVARIO, SANTA ROSA DE LIMA, LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('77', '60', '00014', '00260', 'FARMACIA SANTA MARIA #2, SANTA ROSA DE LIMA', 'CALLE GENERAL GIRON #1, SANTA ROSA DE LIMA,LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('78', '60', '00014', '00260', 'NIEVE ESMERALDA SALON', 'CALLE GENERAL GIRON L-2, BARRIO EL CALVARIO SANTA ROSA DE LIMA, LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('82', '70', '00014', '00260', 'TIENDA EL PROGRESO', 'CALLE GENERAL GIRÓN BARRIO EL CALVARIO, SANTA ROSA DE LIMA, LA UNIÓN', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('83', '70', '00014', '00260', 'DISTRIBUIDORA LILIAMS', 'TERCERA AVENIDA NORTE Y CALLE GENERAL GIRÓN, BARRIO EL CALVARIO, SANTA ROSA DE LIMA, LA UNIÓN', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('86', '73', '00014', '00260', 'PNC SANTA ROSA DE LIMA', 'COLONIA ALTOS DEL ESTADIO, CALLE RUTA MILITAR', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('89', '75', '00008', '00147', 'FOMILENIO II', 'DESVIO AL AEROPUERTO, AUTOPISTA A COMALAPA, SAN LUIS TALPA LA PAZ', 'destino_municipio', '32.00', '34');
INSERT INTO `vyp_empresas_visitadas` VALUES ('91', '74', '00014', '00260', 'PADECOMSM SANTA ROSA DE LIMA', 'BARRIO EL CENTRO FRENTE AL PARQUE MUNICIPAL SANTA ROSA', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('92', '74', '00014', '00260', 'FARMACIA SAN REY', 'CALLE GENERAL GIRON BARRIO EL CALVARIO', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('93', '74', '00014', '00260', 'CELULAR BOUTIQUE', 'BARRIO EL CALVARIO CALLE GIRON', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('94', '74', '00014', '00260', 'DISTRIBUIDORA DE POLLOS AMILCAR', 'BARRIO EL CALVARIO, CALLE GIRON SANTA ROSA DE LIMA', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('96', '77', '00005', '00087', 'PAPELERA INTERNACIONAL, S.A.', 'CARRETERA A SANTA ANA, KM. 28.5 PARQUE INDUSTRIAL EL RINCONCITO', 'destino_municipio', '34.30', '32');
INSERT INTO `vyp_empresas_visitadas` VALUES ('100', '68', '00009', '00158', 'BOLSA DE EMPLEO', '1RA CALLE ORIENTE, ILOBASCO', 'destino_municipio', '54.80', '53');
INSERT INTO `vyp_empresas_visitadas` VALUES ('101', '68', '00009', '00154', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'destino_oficina', '83.11', '4');
INSERT INTO `vyp_empresas_visitadas` VALUES ('105', '80', '00009', '00158', 'INSTITUTO NACIONAL DE ILOBASCO', 'SALIDA A PRESA CINCO DE NOVIEMBRE, BARRIO SAN SEBASTIAN, ILOBASCO, CABAÑAS', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('109', '82', '00005', '00084', 'ISSS PUERTO DE LA LIBERTAD', 'PLAYA LA PAZ, PUERTO DE LA LIBERTAD, LA LIBERTAD', 'destino_municipio', '28.30', '16');
INSERT INTO `vyp_empresas_visitadas` VALUES ('110', '82', '00005', '00077', 'HOTEL PURO SURF', 'PLAYA EL ZONTE, CHILTIUPAN, LA LIBERTAD', 'destino_municipio', '39.00', '54');
INSERT INTO `vyp_empresas_visitadas` VALUES ('111', '82', '00005', '00077', 'RANCHO LOKOO RESORT', 'PLAYA EL ZONTE, CHILTIUPAN, LA LIBERTAD', 'destino_municipio', '39.00', '54');
INSERT INTO `vyp_empresas_visitadas` VALUES ('112', '83', '00009', '00158', 'PLAN INTERNACIONAL ', 'CALLE AL CENTRO PLAN INTERNACIONAL ', 'destino_municipio', '54.80', '53');
INSERT INTO `vyp_empresas_visitadas` VALUES ('113', '83', '00009', '00154', 'MTPS SENSUNTEPEQUE', '  5A AV. SUR, CENTRO DE GOBIERNO, BARRIO EL CALVARIO, SENSUNTEPEQUE, CABAÑAS.', 'destino_municipio', '81.70', '50');
INSERT INTO `vyp_empresas_visitadas` VALUES ('114', '84', '00005', '00084', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', 'destino_oficina', '36.80', '56');
INSERT INTO `vyp_empresas_visitadas` VALUES ('115', '85', '00002', '00017', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'destino_oficina', '57.21', '2');
INSERT INTO `vyp_empresas_visitadas` VALUES ('126', '89', '00005', '00087', 'HANESBRANDS EL SALVADOR, LIMITADA DE C.V.', 'SAN JUAN OPICO, LA LIBERTAD', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('127', '89', '00005', '00087', 'PASTELES DE EL SALVADOR, S.A. DE C.V.', 'CANTÓN SITIO DEL NIÑO, SAN JUAN OPICO', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('128', '91', '00005', '00087', 'HANESBRANDS EL SALVADOR, LTDA. DE C.V.', 'KILOMETRO 34, CARRETERA A SAN JUAN OPICO, LA LIBERTAD', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('129', '91', '00005', '00087', 'PASTELES DE EL SALVADOR, S.A. DE C.V.', 'KILÓMETRO 28 ½, CARRETERA A SANTA ANA, SAN JUAN OPICO, LA LIBERTAD', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('130', '92', '00005', '00088', 'ISSS ATEOS', 'KM 31 CARRETERA A SONSONATE', 'destino_municipio', '26.30', '13');
INSERT INTO `vyp_empresas_visitadas` VALUES ('131', '92', '00005', '00079', 'EXPORT SALVA', 'KM 24 CARR. A SANTA ANA', 'destino_municipio', '11.20', '59');
INSERT INTO `vyp_empresas_visitadas` VALUES ('132', '95', '00002', '00013', 'LENOR INDUSTRIES, S. A. DE C. V.', 'KM 69 CARRETERA A METAPAN, CANTON CUTUMAYCAMONES, ZONA FRANCA SANTA ANA, SANTA ANA, SANTA ANA.', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('133', '95', '00002', '00013', 'HOSPITAL NACIONAL SAN JUAN DE DIOS', 'FINAL 13 AVENIDA NORTE, BARRIO SAN RAFAEL, NO. 1, SANTA ANA, SANTA ANA.', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('134', '95', '00002', '00013', 'HOSPITAL SAN ANTONIO', 'CALLE ALDEA, SANTA ANA, SANTA ANA.', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('135', '96', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '65.10', '29');
INSERT INTO `vyp_empresas_visitadas` VALUES ('137', '97', '00011', '00184', 'ALCALDIA MUNICIPAL DE JIQUILISCO', 'CALLE FABIO GUERRERO N°1, JIQUILISCO USULUTÁN', 'destino_mapa', '18.60', '64');
INSERT INTO `vyp_empresas_visitadas` VALUES ('138', '85', '00002', '00017', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'destino_oficina', '57.21', '2');
INSERT INTO `vyp_empresas_visitadas` VALUES ('139', '85', '00002', '00017', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'destino_oficina', '57.21', '2');
INSERT INTO `vyp_empresas_visitadas` VALUES ('162', '86', '00005', '00087', 'HANES BRAND EL SALVADOR LTDA DE CV', 'KM. 34 CARR. A SAN JUAN OPICO', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('163', '86', '00005', '00087', 'PASTELES DE EL SALVADOR SA DE CV', 'KM. 28.5 CARR. A SANTA ANA', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('166', '101', '00005', '00086', 'SALCHEM', 'CENTRO COMERCIAL METRO MILA QUEZALTEPEQUE', 'destino_municipio', '23.70', '61');
INSERT INTO `vyp_empresas_visitadas` VALUES ('171', '103', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '67.21', '66');
INSERT INTO `vyp_empresas_visitadas` VALUES ('173', '104', '00005', '00075', 'SEÑORA CLAUDIA RODRIGUEZ', 'RES.  SAN RAFAEL SENDA 5 SUR #21-K SANTA TECLA', 'destino_municipio', '1.90', '58');
INSERT INTO `vyp_empresas_visitadas` VALUES ('174', '104', '00005', '00086', 'SALCHEM', 'CENTRO COMERCIAL METRO MILA QUEZALTEPEQUE', 'destino_municipio', '23.70', '61');
INSERT INTO `vyp_empresas_visitadas` VALUES ('176', '104', '00005', '00087', 'SIL', 'KM. 26 CARRETERA A SANTA ANA SAN JUAN OPICO', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('177', '106', '00002', '00013', 'LEONOR INDUSTRIES, S.A DE C.V', 'KM 69 CARRETERA A METAPAN, ZONA FRANCA SANTA ANA.', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('178', '106', '00002', '00013', 'HOSPITAL NACIONAL DE SANTA ANA', 'TERCERA AVENIDA SUR NUMERO 1 BARRIO SAN RAFAEL, SANTA ANA', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('179', '106', '00002', '00013', 'HOSPITAL SAN ANTONIO', 'CALLE LA ALDEA CARRETERA HACIA CHALCHUAPA', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('180', '107', '00014', '00260', 'AUTO REPUESTOS VILLATORO REYES', 'BARRIO NUEVO CALLE PRINCIPAL, SALIDA A SANTA ROSA DE LIMA, ANAMOROS, LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('181', '107', '00014', '00260', 'FARMACIA BUENA SALUD ', 'BARRIO NUEVO FRENTE A UNIDAD DE SALUD, ANAMOROS, LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('182', '108', '00009', '00158', 'GRANJA DE REHABILITACIÓN PARA JÓVENES EN CONFLICTO CON LA LEY PENAL JUVENIL', 'CANTÓN SITIO VIEJO, CALLE A REPRESA HIDROELÉCTRICA CERRÓN GRANDE', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('183', '108', '00009', '00158', 'FARMACIA JORAM', '4ª CALLE PONIENTE B° EL CALVARIO, ILOBASCO', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('184', '108', '00009', '00158', 'AGROSERVICIO EL SOMBRERO', '2ª CALLE PONIENTE Y 5ª AV. SUR, B° EL CALVARIO, ILOBASCO', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('185', '108', '00009', '00158', 'VENTA DE ACCESORIOS PARA VEHÍCULOS “LA ESQUINA”', '3ª AV. SUR Y 4ª CALLE ORIENTE, B° EL CALVARIO, ILOBASCO.', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('187', '109', '00007', '00125', 'ACMASA', 'CASERIO EL LLANO. CANTON TECOLUCO.', 'destino_municipio', '17.50', '65');
INSERT INTO `vyp_empresas_visitadas` VALUES ('188', '109', '00007', '00125', 'ACMASA PLANTA 1', 'CANTON EL RODEO, CALLE A SUCHITOTO', 'destino_municipio', '17.50', '65');
INSERT INTO `vyp_empresas_visitadas` VALUES ('189', '109', '00007', '00125', 'ACMASA PLANTA 2', 'CANTON EL RODEO, CASERIO EL PARAISO.', 'destino_municipio', '17.50', '65');
INSERT INTO `vyp_empresas_visitadas` VALUES ('190', '109', '00007', '00125', 'ACMASA OFICINA ADMNISTRATIVA', 'CASERIO EL LLANO. CANTON TECOLUCO', 'destino_municipio', '17.50', '65');
INSERT INTO `vyp_empresas_visitadas` VALUES ('191', '109', '00007', '00125', 'ACOSAMA', 'KILOMETRO VEINTE, CALLE A SAN PEDRO PERULAPAN, LOTIFICACION EL BALSAMO, NUMERO DOCE, CANTON LA CRUZ.', 'destino_municipio', '17.50', '65');
INSERT INTO `vyp_empresas_visitadas` VALUES ('192', '109', '00007', '00116', 'MINISTERIO DE TRABAJO ', 'CALLE FRANCISCO LIOPEZ #16.', 'destino_municipio', '0.50', '69');
INSERT INTO `vyp_empresas_visitadas` VALUES ('193', '108', '00009', '00158', 'UNIVERSIDAD CATOLICA DE EL SALVADOR', 'CARRETERA A ILOBASCO, CANTON AGUA ZARCA, ILOBASCO', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('194', '110', '00009', '00158', 'GRANJA DE REHABILITACIÓN PARA JÓVENES EN CONFLICTO CON LA LEY PENAL JUVENIL', 'CANTÓN SITIO VIEJO, CALLE A REPRESA HIDROELÉCTRICA CERRÓN GRANDE, ILOBASCO', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('195', '110', '00009', '00158', 'UNIVERSIDAD CATÓLICA DE EL SALVADOR', 'CARRETERA DE SAN SALVADOR A ILOBASCO, CANTÓN AGUA ZARCA, ILOBASCO', 'destino_municipio', '31.10', '55');
INSERT INTO `vyp_empresas_visitadas` VALUES ('197', '112', '00002', '00015', 'INGENIO LA MAGDALENA', 'CANTÓN EL COCO, CHALCHUAPA', 'destino_municipio', '15.20', '70');
INSERT INTO `vyp_empresas_visitadas` VALUES ('198', '112', '00002', '00015', 'SUPERTEX', 'BYPASS, CHALCHUAPA', 'destino_municipio', '15.20', '70');
INSERT INTO `vyp_empresas_visitadas` VALUES ('199', '112', '00002', '00015', 'CONAL', 'BYPASS, CHALCHUAPA', 'destino_municipio', '15.20', '70');
INSERT INTO `vyp_empresas_visitadas` VALUES ('200', '112', '00002', '00015', 'PARQUE JOSÉ MATÍAS DELGADO', '2 CALLE PONIENTE Y 4 AVENIDA NORTE', 'destino_municipio', '15.20', '70');
INSERT INTO `vyp_empresas_visitadas` VALUES ('204', '117', '00005', '00095', 'OFICINA DE LA RUTA 106', 'CALLE PRINCIPAL, BARRIO CONCEPCIÓN, FRENTE A LA PNC', 'destino_municipio', '38.30', '68');
INSERT INTO `vyp_empresas_visitadas` VALUES ('205', '118', '00014', '00260', 'ACOPALIN', 'CALLE RUTA MILITAR, BARRIO LA ESPERANZA, SALIDA A SANTA ROSA DE LIMA, LA UNIÓN.', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('206', '118', '00014', '00260', 'MARMOLERIA MARQUEZ MONGE', 'KILÓMETRO 179, CALLE RUTA MILITAR, COSTADO PONIENTE DEL ESTADIO, SANTA ROSA DE LIMA, LA UNIÓN.', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('207', '118', '00014', '00260', 'SUBWAY', 'BARRIO LA ESPERANZA, RUTA MILITAR, ENTRADA A SANTA ROSA DE LIMA, SANTA ROSA DE LIMA, LA UNIÓN. ', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('209', '119', '00006', '00097', 'GRUPO LOS SEIS, S.A. DE C.V.', 'CUMBRES DE LA ESCALON, AVENIDA MASFERRER NORTE Y CALLE LA MONTAÑA, # M1', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('210', '119', '00006', '00097', 'GRUPO ISE, S.A. DE C.V.', 'COLONIA SAN FRANCISCO, AVENIDA LAS BUGAMBILIAS, # M7', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('211', '119', '00006', '00097', 'MAGNUM SECURITY AND RESEARCH, S.A. DE C.V.', 'COLONIA ESCALON, CALLE ARTURO AMBROJI, # 124', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('212', '119', '00006', '00097', 'GESEL, S.A. DE C.V.', 'COLONIA ESCALON, PASEO GENERAL ESCALON, CENTRO COMERCIAL VILLAS ESPAÑOLAS, LOCAL # A-9', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('213', '119', '00002', '00013', 'SALA DE LO CONTENCIOSO ADMINISTRATIVO DE SANTA ANA', 'BARRIO SAN SEBASTIAN, CALLE LIBERTAD PONIETE, # 31', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('214', '114', '00003', '00026', 'OFICINA DEPARTAMENTAL DE SONSONATE', 'OFICINA DEPARTAMENTAL DE SONSONATE', 'destino_oficina', '43.21', '73');
INSERT INTO `vyp_empresas_visitadas` VALUES ('216', '120', '00006', '00099', 'TAQUERIA MEXICANA TA QUE PICA', '1ª AVENIDA NORTE', 'destino_municipio', '15.70', '76');
INSERT INTO `vyp_empresas_visitadas` VALUES ('217', '120', '00004', '00059', 'TIENDA BELEN', 'BARRIO EL ROSARIO, 1ª AVENIDA NORTE', 'destino_municipio', '70.60', '77');
INSERT INTO `vyp_empresas_visitadas` VALUES ('218', '122', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '67.21', '66');
INSERT INTO `vyp_empresas_visitadas` VALUES ('219', '123', '00014', '00245', 'PIZZERIA & RESTAURANTE THREE FLAG´S', 'EDIFICIO SUR CENTRO, BARRIO NUEVO CONTIGUO A INSTITUTO NACIONAL, ANAMOROS', 'destino_mapa', '60.19', '78');
INSERT INTO `vyp_empresas_visitadas` VALUES ('221', '123', '00014', '00246', 'RANCHO EL TOROGOZ', 'COLONIA NUEVA FRENTE A CENTRO ESCOLAR ANAMOROS, ANAMOROS, LA UNION', 'destino_mapa', '60.19', '79');
INSERT INTO `vyp_empresas_visitadas` VALUES ('222', '122', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '67.21', '66');
INSERT INTO `vyp_empresas_visitadas` VALUES ('223', '124', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '65.10', '29');
INSERT INTO `vyp_empresas_visitadas` VALUES ('224', '124', '00006', '00097', 'OFICINA CENTRAL', 'OFICINA CENTRAL', 'destino_oficina', '65.10', '29');
INSERT INTO `vyp_empresas_visitadas` VALUES ('226', '126', '00014', '00260', 'BANCO AZTECA AGENCIA SANTA ROSA DE LIMA', 'CALLE GIRON BARRIO EL CALVARIO SANTA ROSA DE LIMA, LA UNION', 'destino_mapa', '45.31', '81');
INSERT INTO `vyp_empresas_visitadas` VALUES ('227', '126', '00014', '00260', 'CELULAR BOUTIQUE SANTA ROSA #2', 'CALLE GENERAL GIRON NUMERO 8, BARRIO EL CALVARIO SANTA ROSA DE LIMA, LA UNION', 'destino_mapa', '45.31', '82');
INSERT INTO `vyp_empresas_visitadas` VALUES ('228', '126', '00014', '00260', 'FARMACIAS BRASIL #19', 'CALLE GIRON Y PRIMERA AVENIDA NORTE LOCAL #8, BARRIO EL CALVARIO SANTA ROSA DE LIMA', 'destino_mapa', '45.31', '83');
INSERT INTO `vyp_empresas_visitadas` VALUES ('230', '128', '00014', '00260', 'ACOPALIN', 'CALLE RUTA MILITAR, BARRIO LA ESPERANZA, SALIDA A SAN MIGUEL, RN 18E, SANTA ROSA DE LIMA, EL SALVADOR', 'destino_mapa', '46.22', '84');
INSERT INTO `vyp_empresas_visitadas` VALUES ('231', '128', '00014', '00260', 'ESTACIÓN DE SERVICIO PETROIN', 'CALLE RUTA MILITAR,SALIDA A SAN MIGUEL, SANTA ROSA DE LIMA LA UNION', 'destino_mapa', '46.22', '85');
INSERT INTO `vyp_empresas_visitadas` VALUES ('232', '128', '00014', '00260', 'MARMOLERIA MARQUEZ MONGE', 'KILOMETRO 179,CALLE RUTA MILITAR, COSTADO SUR, PONIENTE DEL ESTADIO, SANTA ROSA DE LIMA LA UNIION', 'destino_mapa', '46.22', '86');
INSERT INTO `vyp_empresas_visitadas` VALUES ('239', '133', '00014', '00260', 'SALEM IDEAS Y SOLUCIONES', 'CALLE RUTA MILITAR, COLONIA SINAI, SANTA ROSA DE LIMA, LA UNION', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('240', '129', '00005', '00075', 'PUBLI ARTE SA DE CV ', '14 AVE. NORTE SANTA TECLA ', 'destino_municipio', '1.90', '58');
INSERT INTO `vyp_empresas_visitadas` VALUES ('241', '129', '00005', '00078', 'UNIFI CENTRAL AMERICA LTDA DE CV ', 'KM 36 1/2 CARRETERA A SANTA ANA ', 'destino_municipio', '41.70', '87');
INSERT INTO `vyp_empresas_visitadas` VALUES ('242', '133', '00014', '00260', 'LABORATORIO CLINICO DIAGNOSTICO ORIENTAL ', 'CALLE GENERAL GIRÓN, BARRIO EL CALVARIO, SANTA ROSA DE LIMA, LA UNIÓN ', 'destino_municipio', '46.90', '8');
INSERT INTO `vyp_empresas_visitadas` VALUES ('243', '129', '00005', '00078', 'PAM TRADING CORPORATION EL SALVADOR LTDA DE CV', 'KM 36 1/2 CARRETERA A SANTA ANA ', 'destino_municipio', '41.70', '87');
INSERT INTO `vyp_empresas_visitadas` VALUES ('244', '135', '00005', '00087', 'INDUSTRIAS TALPA, S.A. DE C.V.', 'COMPLEJO INTERCOMPLEX, KM. 26 1/2 CARRETERA A SANTA ANA ', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('245', '136', '00014', '00246', 'ESPECIAL PIZZA', 'CALLE PRINCIPAL, FRENTE A MONUMENTO MONSEÑOR ROMERO, ANAMORÓS, LA UNIÓN', 'destino_municipio', '55.40', '88');
INSERT INTO `vyp_empresas_visitadas` VALUES ('246', '135', '00005', '00087', 'UNIQUE, S.A. DE C.V.', 'ZONA INDUSTRIAL INTERCOMPLEX, KM. 26 1/2 CARRETERA A SANTA ANA', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('247', '136', '00014', '00246', 'AGENCIA DE VIAJES SANTA MARIA', 'BARRIO LAS FLORES SALIDA A SANTA ROSA DE LIMA, ANAMORÓS, LA UNIOM', 'destino_municipio', '55.40', '88');
INSERT INTO `vyp_empresas_visitadas` VALUES ('248', '135', '00005', '00087', 'SWISSTEX EL SALVADOR, S.A. DE C.V.', 'ZONA INDUSTRIAL INTERCOMPLEX, KM. 26 1/2 CARRETERA A SANTA ANA', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('249', '136', '00014', '00246', 'FOTO ESTUDIO ALVAREZ', 'CALLE PRINCIAPL TERCERA AVENIDA SUR, BARRIO EL CENTRO, ANAMORÓS, LA UNIÓN', 'destino_municipio', '55.40', '88');
INSERT INTO `vyp_empresas_visitadas` VALUES ('250', '135', '00005', '00087', 'YOBEL, S.A. DE C.V.', 'ZONA INDUSTRIAL INTERCOMPLEX, KM. 26 1/2 CARRETERA A SANTA ANA', 'destino_municipio', '40.70', '60');
INSERT INTO `vyp_empresas_visitadas` VALUES ('252', '138', '00002', '00013', 'TUDO, S.A. DE C.V.', 'ANTIGUA CARRETERA PANAMERICANA CANTON PORTEZUELO', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('253', '140', '00002', '00013', 'TUDO S.A. DE C.V.', 'ANTIGUA CARRETERA PANAMERICANA, CANTON EL PORTEZUELO, SANTA ANA', 'destino_municipio', '67.70', '24');
INSERT INTO `vyp_empresas_visitadas` VALUES ('254', '140', '00006', '00097', 'PEOPLE S.A. DE C.V.', 'CALLE SAN ANTONIO ABAD, EDIFICIO ELECTROLAB MEDIC', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('255', '140', '00006', '00097', 'FUNERARIA LA MEDITACIÓN', 'CALLE BERNAL, BLOCK G #4, SAN SALVADOR', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('256', '138', '00006', '00097', 'PEOPLE, S.A. DE C.V.', 'CALLE  SAN ANTONIO ABAD', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('257', '138', '00006', '00097', 'LA MEDITACION', 'CALLE BERNAL BLOCK G', 'destino_municipio', '3.70', '31');
INSERT INTO `vyp_empresas_visitadas` VALUES ('258', '138', '00002', '00013', 'TUDO S..A C.V.', 'CARRETERA ANTIGUA PANAMERICANA CANTON PORTEZUELO', 'destino_municipio', '67.70', '24');

-- ----------------------------
-- Table structure for `vyp_estado_solicitud`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_estado_solicitud`;
CREATE TABLE `vyp_estado_solicitud` (
  `id_estado_solicitud` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(100) NOT NULL,
  PRIMARY KEY (`id_estado_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_estado_solicitud
-- ----------------------------
INSERT INTO `vyp_estado_solicitud` VALUES ('1', 'Revisión jefe inmediato');
INSERT INTO `vyp_estado_solicitud` VALUES ('2', 'Observaciones del jefe inmediato');
INSERT INTO `vyp_estado_solicitud` VALUES ('3', 'Revisión del director o jefe de regional');
INSERT INTO `vyp_estado_solicitud` VALUES ('4', 'Observaciones del director o jefe de regional');
INSERT INTO `vyp_estado_solicitud` VALUES ('5', 'Revisión del Fondo Circulante del Monto Fijo');
INSERT INTO `vyp_estado_solicitud` VALUES ('6', 'Observaciones del Fondo Circulante del Monto Fijo');
INSERT INTO `vyp_estado_solicitud` VALUES ('7', 'Aprobada');
INSERT INTO `vyp_estado_solicitud` VALUES ('8', 'Pagada');
INSERT INTO `vyp_estado_solicitud` VALUES ('9', 'Incompleta');

-- ----------------------------
-- Table structure for `vyp_estructura_planilla`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_estructura_planilla`;
CREATE TABLE `vyp_estructura_planilla` (
  `id_estructura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_banco` int(10) unsigned NOT NULL DEFAULT '0',
  `nombre_campo` varchar(100) NOT NULL DEFAULT '',
  `valor_campo` varchar(45) NOT NULL DEFAULT '',
  `name_campo` varchar(100) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id_estructura`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_estructura_planilla
-- ----------------------------
INSERT INTO `vyp_estructura_planilla` VALUES ('1', '2', '[Elija un campo para agregar]', '', '', '1');
INSERT INTO `vyp_estructura_planilla` VALUES ('2', '1', '[Elija un campo para agregar]', '', '', '1');

-- ----------------------------
-- Table structure for `vyp_generalidades`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_generalidades`;
CREATE TABLE `vyp_generalidades` (
  `id_generalidad` int(10) unsigned NOT NULL,
  `pasaje` float(5,2) NOT NULL,
  `alojamiento` float(5,2) NOT NULL,
  `id_banco` int(10) unsigned NOT NULL,
  `banco` varchar(100) NOT NULL,
  `num_cuenta` varchar(45) NOT NULL,
  `limite_poliza` float(5,2) NOT NULL,
  `codigo_presupuestario` varchar(50) NOT NULL,
  `id_responsable` varchar(50) NOT NULL,
  PRIMARY KEY (`id_generalidad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_generalidades
-- ----------------------------
INSERT INTO `vyp_generalidades` VALUES ('1', '7.00', '25.00', '1', 'Banco Agrícola', '25478-98', '500.00', '12345', '2031');

-- ----------------------------
-- Table structure for `vyp_horario_viatico`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_horario_viatico`;
CREATE TABLE `vyp_horario_viatico` (
  `id_horario_viatico` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `hora_inicio` time NOT NULL DEFAULT '00:00:00',
  `hora_fin` time NOT NULL DEFAULT '00:00:00',
  `monto` float(5,2) NOT NULL,
  `id_tipo` int(10) unsigned NOT NULL DEFAULT '1',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `id_restriccion` int(10) unsigned NOT NULL,
  `id_viatico_restriccion` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_horario_viatico`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_horario_viatico
-- ----------------------------
INSERT INTO `vyp_horario_viatico` VALUES ('1', 'Desayuno', '05:00:00', '06:30:00', '3.00', '1', '1', '1', '0');
INSERT INTO `vyp_horario_viatico` VALUES ('2', 'Almuerzo', '11:30:00', '13:10:00', '4.00', '1', '1', '1', '0');
INSERT INTO `vyp_horario_viatico` VALUES ('3', 'Cena', '18:30:00', '23:59:00', '4.00', '1', '1', '1', '0');
INSERT INTO `vyp_horario_viatico` VALUES ('4', 'Restriccion de almuerzo', '11:31:00', '13:09:00', '0.00', '2', '1', '4', '2');

-- ----------------------------
-- Table structure for `vyp_horario_viatico_solicitud`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_horario_viatico_solicitud`;
CREATE TABLE `vyp_horario_viatico_solicitud` (
  `id_horario_solicitud` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_ruta` date NOT NULL,
  `id_horario_viatico` int(10) unsigned NOT NULL,
  `id_mision` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_ruta_visitada` varchar(5) NOT NULL,
  PRIMARY KEY (`id_horario_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_horario_viatico_solicitud
-- ----------------------------
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('1', '2019-01-03', '1', '1', '1', '1');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('3', '2019-01-03', '2', '1', '1', '3');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('5', '2019-01-08', '2', '11', '1', '12');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('7', '2019-01-08', '2', '14', '1', '19');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('11', '2019-01-08', '2', '31', '1', '41');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('12', '2019-01-08', '2', '33', '1', '44');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('13', '2019-01-08', '2', '34', '1', '46');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('14', '2019-01-08', '2', '34', '1', '47');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('15', '2019-01-08', '2', '36', '1', '48');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('16', '2019-01-08', '2', '37', '1', '50');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('17', '2019-01-09', '2', '35', '1', '51');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('18', '2019-01-08', '2', '41', '1', '57');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('19', '2019-01-08', '2', '41', '1', '58');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('20', '2019-01-09', '2', '49', '1', '66');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('21', '2019-01-08', '2', '48', '1', '68');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('23', '2019-01-09', '2', '52', '1', '78');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('26', '2019-01-09', '2', '54', '1', '89');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('31', '2019-01-10', '2', '62', '1', '103');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('35', '2019-01-08', '2', '65', '1', '124');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('36', '2019-01-10', '2', '66', '1', '128');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('40', '2019-01-11', '2', '67', '1', '134');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('42', '2019-01-10', '2', '61', '1', '140');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('44', '2019-01-10', '2', '67', '1', '149');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('45', '2019-01-10', '2', '67', '1', '150');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('46', '2019-01-10', '2', '60', '1', '153');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('47', '2019-01-08', '2', '24', '1', '158');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('48', '2019-01-10', '2', '70', '1', '161');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('49', '2019-01-11', '2', '73', '1', '165');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('50', '2019-01-11', '2', '75', '1', '166');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('51', '2019-01-11', '2', '77', '1', '171');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('52', '2019-01-11', '2', '68', '1', '177');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('58', '2019-01-11', '2', '80', '1', '185');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('59', '2019-01-11', '2', '82', '1', '197');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('60', '2019-01-11', '2', '83', '1', '200');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('61', '2019-01-14', '2', '84', '1', '203');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('62', '2019-01-11', '2', '85', '1', '205');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('63', '2019-01-15', '2', '89', '1', '218');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('64', '2019-01-15', '2', '91', '1', '221');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('67', '2019-01-16', '2', '96', '1', '232');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('69', '2019-01-15', '2', '97', '1', '235');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('70', '2019-01-15', '2', '86', '1', '241');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('72', '2019-01-14', '2', '101', '1', '245');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('73', '2019-01-16', '1', '103', '1', '246');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('74', '2019-01-16', '2', '103', '1', '247');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('77', '2019-01-15', '2', '104', '1', '255');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('78', '2019-01-15', '2', '104', '1', '256');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('79', '2019-01-17', '2', '106', '1', '262');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('80', '2019-01-16', '2', '107', '1', '264');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('81', '2019-01-16', '2', '107', '1', '265');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('82', '2019-01-16', '2', '108', '1', '288');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('83', '2019-01-17', '2', '110', '1', '290');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('84', '2019-01-15', '2', '112', '1', '295');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('85', '2019-01-16', '2', '95', '1', '299');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('90', '2019-01-17', '2', '118', '1', '307');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('91', '2019-01-17', '2', '118', '1', '308');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('92', '2019-01-16', '2', '117', '1', '309');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('93', '2019-01-16', '2', '117', '1', '310');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('94', '2019-01-15', '2', '114', '1', '315');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('95', '2019-01-15', '2', '120', '1', '319');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('98', '2019-01-16', '2', '123', '1', '328');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('99', '2019-01-17', '2', '122', '1', '329');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('100', '2019-01-16', '2', '124', '1', '336');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('101', '2019-01-18', '2', '126', '1', '338');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('102', '2019-01-17', '2', '128', '1', '342');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('103', '2019-01-17', '2', '128', '1', '343');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('104', '2019-01-17', '2', '128', '1', '344');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('105', '2019-01-15', '2', '133', '1', '349');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('106', '2019-01-16', '2', '136', '1', '353');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('107', '2019-01-16', '2', '140', '1', '369');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('108', '2019-01-17', '2', '141', '1', '375');
INSERT INTO `vyp_horario_viatico_solicitud` VALUES ('112', '2019-01-17', '2', '135', '1', '380');

-- ----------------------------
-- Table structure for `vyp_informacion_empleado`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_informacion_empleado`;
CREATE TABLE `vyp_informacion_empleado` (
  `id_informacion_empleado` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nr` varchar(4) NOT NULL,
  `nr_jefe_inmediato` varchar(4) NOT NULL,
  `nr_jefe_departamento` varchar(4) NOT NULL,
  `id_oficina_departamental` varchar(5) NOT NULL,
  `partida` varchar(45) NOT NULL,
  `sub_numero` varchar(45) NOT NULL,
  PRIMARY KEY (`id_informacion_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=670 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_informacion_empleado
-- ----------------------------
INSERT INTO `vyp_informacion_empleado` VALUES ('19', '2603', '907C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('20', '1991', '907C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('21', '2705', '907C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('22', '2776', '907C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('23', '2614', '907C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('24', '2588', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('25', '2883', '2253', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('26', '2906', '2031', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('27', '2629', '2031', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('28', '2337', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('29', '437C', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('30', '335C', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('31', '2702', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('32', '2558', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('33', '2638', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('34', '2641', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('35', '2723', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('36', '2886', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('37', '710C', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('38', '2636', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('39', '2639', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('40', '2733', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('41', '2699', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('42', '997C', '2874', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('43', '2622', '2854', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('44', '2745', '2854', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('45', '2592', '2854', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('46', '719C', '2563', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('47', '643C', '2563', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('48', '628C', '2563', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('49', '2918', '2456', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('50', '1984', '2456', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('51', '2087', '2456', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('52', '2718', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('53', '2600', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('54', '2646', '457C', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('55', '2855', '457C', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('56', '2854', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('57', '907C', '871C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('58', '2563', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('59', '2456', '791C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('60', '532C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('61', '457C', '463C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('62', '2443', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('63', '2793', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('64', '807C', '2874', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('65', '2031', '871C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('66', '2630', '871C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('67', '2253', '871C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('68', '982C', '2874', '2874', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('69', '2208', '2854', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('70', '879C', '871C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('71', '2389', '2456', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('72', '761C', '2563', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('73', '2763', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('74', '961C', '2793', '', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('75', '841C', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('76', '2847', '2630', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('77', '576C', '2854', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('78', '2871', '2854', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('79', '871C', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('80', '2631', '2253', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('81', '945 ', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('82', '2485', '945C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('83', '2586', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('84', '2774', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('85', '2755', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('86', '2781', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('87', '2291', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('88', '2468', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('89', '2712', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('90', '940C', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('91', '941C', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('92', '2414', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('93', '880C', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('94', '2642', '2443', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('95', '701C', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('96', '2466', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('97', '2666', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('98', '2665', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('99', '896C', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('100', '2788', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('101', '720C', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('102', '2791', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('103', '332C', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('104', '2662', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('105', '2864', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('106', '687C', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('107', '911C', '988C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('108', '988C', '997C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('109', '635C', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('110', '2771', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('111', '2713', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('112', '2731', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('113', '2076', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('114', '2606', '2499', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('115', '2709', '2499', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('116', '2499', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('117', '2689', '2499', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('118', '2416', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('119', '2007', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('120', '2020', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('121', '2386', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('122', '2633', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('123', '703C', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('124', '878C', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('125', '2889', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('126', '2728', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('127', '2547', '703C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('128', '2333', '2793', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('129', '2706', '2793', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('130', '2101', '2793', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('131', '460C', '2793', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('132', '2659', '2793', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('133', '2467', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('134', '2841', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('135', '732C', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('136', '943C', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('137', '2673', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('138', '2844', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('139', '925C', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('140', '2319', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('141', '430C', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('142', '1806', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('143', '2825', '430C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('144', '2509', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('145', '2417', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('146', '391C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('147', '363C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('148', '929C', '2874', '2874', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('149', '417C', '2563', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('150', '602C', '2563', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('151', '2943', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('152', '2843', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('153', '695C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('154', '2370', '996C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('155', '375C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('156', '2488', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('157', '2947', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('158', '583C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('159', '589C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('160', '2944', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('161', '2967', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('162', '601C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('163', '578C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('164', '2296', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('165', '899C', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('166', '610C', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('167', '2803', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('168', '485C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('169', '2797', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('170', '400C', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('171', '657C', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('172', '2911', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('173', '757C', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('174', '2798', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('175', '2670', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('176', '2800', '578C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('177', '2772', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('178', '955C', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('179', '2207', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('180', '2785', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('181', '2408', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('182', '978C', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('183', '2650', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('184', '968C', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('185', '2960', '945C', '982C', '00031', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('186', '2762', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('187', '2787', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('188', '2761', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('189', '2929', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('190', '947C', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('191', '983C', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('192', '2652', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('193', '971C', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('194', '985C', '945C', '982C', '00027', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('195', '1599', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('196', '984C', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('197', '975C', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('198', '959C', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('199', '2354', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('200', '2560', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('201', '2653', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('202', '2959', '945C', '982C', '00029', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('203', '549C', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('204', '2879', '997C', '997C', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('205', '2596', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('206', '2746', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('207', '953C', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('208', '621C', '549C', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('209', '2660', '841C', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('210', '2895', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('211', '884C', '2596', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('212', '2693', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('213', '839C', '841C', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('214', '827C', '820C', '997C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('215', '2878', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('216', '671C', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('217', '2018', '549C', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('218', '712C', '549C', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('219', '2612', '2596', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('220', '700C', '2879', '2879', '00016', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('221', '845C', '820C', '997C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('222', '565C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('223', '821C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('224', '620C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('225', '2415', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('226', '2824', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('227', '2910', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('228', '560C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('229', '550C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('230', '704C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('231', '667C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('232', '688C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('233', '567C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('234', '2651', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('235', '2941', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('236', '2656', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('237', '619C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('238', '564C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('239', '2923', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('240', '2963', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('241', '868C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('242', '989C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('243', '2863', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('244', '831C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('245', '832C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('246', '2767', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('247', '829C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('248', '877C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('249', '2938', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('250', '826C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('251', '945C', '982C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('252', '2970', '2630', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('253', '753C', '997C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('254', '2899', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('255', '2932', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('256', '785C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('257', '789C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('258', '792C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('259', '2917', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('260', '2610', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('261', '747C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('262', '2913', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('263', '2401', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('264', '790C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('265', '869C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('266', '2925', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('267', '980C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('268', '2931', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('269', '2738', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('270', '740C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('271', '612C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('272', '885C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('273', '788C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('274', '672C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('275', '858C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('276', '777C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('277', '787C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('278', '2567', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('279', '759C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('280', '2580', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('281', '850C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('282', '2645', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('283', '805C', '2879', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('284', '812C', '805C', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('285', '2876', '805C', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('286', '804C', '805C', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('287', '734C', '805C', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('288', '2877', '805C', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('289', '833C', '805C', '2879', '00021', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('290', '814C', '997C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('291', '782C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('292', '738C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('293', '779C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('294', '748C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('295', '950C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('296', '781C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('297', '783C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('298', '876C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('299', '750C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('300', '749C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('301', '866C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('302', '778C', '814C', '997C', '00026', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('303', '802C', '2879', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('304', '796C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('305', '2880', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('306', '2898', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('307', '967C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('308', '798C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('309', '2222', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('310', '863C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('311', '875C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('312', '2935', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('313', '801C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('314', '800C', '802C', '2879', '00023', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('315', '2737', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('316', '2820', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('317', '2821', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('318', '509C', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('319', '685C', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('320', '2834', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('321', '2378', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('322', '640C', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('323', '2012', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('324', '2680', '2821', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('325', '728C', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('326', '2736', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('327', '2453', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('328', '1798', '2820', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('329', '820C', '997C', '997C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('330', '2806', '997C', '997C', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('331', '837C', '2879', '997C', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('332', '2145', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('333', '809C', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('334', '860C', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('335', '976C', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('336', '808C', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('337', '455C', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('338', '735C', '837C', '2879', '00033', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('339', '840C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('340', '2497', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('341', '320C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('342', '402C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('343', '528C', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('344', '2696', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('345', '605C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('346', '816C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('347', '2860', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('348', '501C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('349', '2936', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('350', '405C', '402C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('351', '2858', '320C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('352', '2655', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('353', '2710', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('354', '2637', '320C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('355', '551C', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('356', '425C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('357', '554C', '402C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('358', '507C', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('359', '2921', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('360', '431C', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('361', '502C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('362', '456C', '402C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('363', '615C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('364', '1662', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('365', '338C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('366', '398C', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('367', '2375', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('368', '666C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('369', '2562', '402C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('370', '323C', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('371', '2371', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('372', '2462', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('373', '2003', '320C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('374', '572C', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('375', '325C', '320C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('376', '401C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('377', '561C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('378', '2459', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('379', '650C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('380', '2608', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('381', '500C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('382', '2888', '820C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('383', '426C', '840C', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('384', '2922', '2497', '820C', '00014', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('385', '844C', '820C', '997C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('386', '680C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('387', '552C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('388', '815C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('389', '553C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('390', '566C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('391', '2924', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('392', '2658', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('393', '2904', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('394', '521C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('395', '699C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('396', '698C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('397', '958C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('398', '2939', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('399', '2950', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('400', '614C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('401', '2729', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('402', '569C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('403', '653C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('404', '892C', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('405', '2704', '844C', '820C', '00032', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('406', '571C', '845C', '820C', '00020', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('407', '856C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('408', '828C', '827C', '820C', '00025', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('409', '851C', '2806', '997C', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('410', '2750', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('411', '793C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('412', '965C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('413', '822C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('414', '853C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('415', '912C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('416', '854C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('417', '2789', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('418', '2930', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('419', '2426', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('420', '737C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('421', '651C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('422', '852C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('423', '825C', '851C', '2806', '00034', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('424', '626C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('425', '558C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('426', '351C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('427', '2697', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('428', '481C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('429', '365C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('430', '389C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('431', '2514', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('432', '563C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('433', '2542', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('434', '506C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('435', '542C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('436', '2861', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('437', '707C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('438', '2819', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('439', '2280', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('440', '939C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('441', '2615', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('442', '751C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('443', '557C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('444', '324C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('445', '518C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('446', '427C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('447', '2215', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('448', '404C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('449', '480C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('450', '2691', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('451', '428C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('452', '2611', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('453', '2529', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('454', '505C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('455', '2496', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('456', '2914', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('457', '479C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('458', '519C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('459', '2531', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('460', '857C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('461', '555C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('462', '2808', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('463', '2927', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('464', '466C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('465', '2926', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('466', '2428', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('467', '2471', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('468', '517C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('469', '881C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('470', '520C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('471', '979C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('472', '2916', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('473', '2814', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('474', '2675', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('475', '362C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('476', '2574', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('477', '2482', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('478', '2516', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('479', '352C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('480', '424C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('481', '795C', '2806', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('482', '677C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('483', '2498', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('484', '2585', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('485', '823C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('486', '2044', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('487', '665C', '503C', '2806', '00015', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('488', '613C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('489', '2591', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('490', '2722', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('491', '2385', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('492', '2928', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('493', '849C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('494', '937C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('495', '960C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('496', '2657', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('497', '2714', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('498', '660C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('499', '2682', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('500', '891C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('501', '847C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('502', '638C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('503', '2594', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('504', '670C', '503C', '2806', '00019', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('505', '686C', '2417', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('506', '2828', '2417', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('507', '768C', '2417', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('508', '510C', '2417', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('509', '2822', '2417', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('510', '2548', '2417', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('511', '973C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('512', '990C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('513', '2887', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('514', '987C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('515', '966C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('516', '949C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('517', '977C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('518', '956C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('519', '957C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('520', '954C', '961C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('521', '2955', '791C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('522', '2903', '791C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('523', '2954', '791C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('524', '2815', '791C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('525', '791C', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('526', '2777', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('527', '2816', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('528', '2908', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('529', '2752', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('530', '2778', '807C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('531', '2681', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('532', '2740', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('533', '2720', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('534', '2668', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('535', '2811', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('536', '1690', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('537', '2544', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('538', '2473', '635C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('539', '2478', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('540', '435C', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('541', '2907', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('542', '709C', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('543', '2353', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('544', '2383', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('545', '2818', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('546', '2817', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('547', '661C', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('548', '2751', '2737', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('549', '969C', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('550', '972C', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('551', '2758', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('552', '2480', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('553', '2582', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('554', '986C', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('555', '2448', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('556', '2571', '945C', '982C', '00030', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('557', '2912', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('558', '486C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('559', '2804', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('560', '357C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('561', '2799', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('562', '2801', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('563', '2647', '381C', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('564', '381C', '2793', '982C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('565', '344C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('566', '2940', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('567', '886C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('568', '755C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('569', '2463', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('570', '598C', '753C', '997C', '00024', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('571', '2946', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('572', '2945', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('573', '2802', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('574', '2942', '996C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('575', '1410', '457C', '463C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('576', '2575', '457C', '463C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('577', '369C', '457C', '463C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('578', '679C', '457C', '463C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('579', '2535', '457C', '463C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('580', '2765', '2893', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('581', '2664', '2893', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('582', '2893', '997C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('583', '2838', '2893', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('584', '2669', '2590', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('585', '2590', '997C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('586', '2715', '2590', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('587', '2210', '457C', '463C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('588', '2090', '791C', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('589', '2830', '2090', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('590', '678C', '2090', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('591', '2234', '2090', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('592', '2429', '2090', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('593', '765C', '2090', '807C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('594', '996C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('595', '774C', '997C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('596', '2525', '774C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('597', '2380', '774C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('598', '2454', '774C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('599', '2632', '774C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('600', '2894', '774C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('601', '2613', '997C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('602', '2530', '2613', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('603', '529C', '2613', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('604', '2848', '463C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('605', '2773', '463C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('606', '463C', '997C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('607', '2304', '463C', '997C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('608', '2796', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('609', '2810', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('610', '2537', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('611', '370C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('612', '1968', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('613', '2770', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('614', '944C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('615', '962C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('616', '2698', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('617', '861C', '996C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('618', '2490', '996C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('619', '607C', '996C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('620', '2674', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('621', '454C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('622', '2687', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('623', '692C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('624', '495C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('625', '694C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('626', '2440', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('627', '2807', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('628', '458C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('629', '760C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('630', '668C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('631', '915C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('632', '746C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('633', '2435', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('634', '633C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('635', '674C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('636', '1568', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('637', '624C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('638', '909C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('639', '2464', '477C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('640', '524C', '477C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('641', '336C', '477C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('642', '2618', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('643', '590C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('644', '2716', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('645', '596C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('646', '2266', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('647', '527C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('648', '631C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('649', '706C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('650', '630C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('651', '745C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('652', '1743', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('653', '764C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('654', '378C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('655', '2465', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('656', '2617', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('657', '617C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('658', '493C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('659', '756C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('660', '2388', '477C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('661', '477C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('662', '1777', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('663', '659C', '532C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('664', '2477', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('665', '2840', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('666', '546C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('667', '494C', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('668', '2075', '929C', '929C', '00022', '', '');
INSERT INTO `vyp_informacion_empleado` VALUES ('669', '2676', '532C', '929C', '00022', '', '');

-- ----------------------------
-- Table structure for `vyp_justificaciones`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_justificaciones`;
CREATE TABLE `vyp_justificaciones` (
  `id_justificacion` int(10) unsigned NOT NULL,
  `ruta` varchar(45) NOT NULL,
  `size` varchar(100) NOT NULL,
  `id_mision` int(10) unsigned NOT NULL,
  `extension` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nombre_real` varchar(200) NOT NULL,
  PRIMARY KEY (`id_justificacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_justificaciones
-- ----------------------------
INSERT INTO `vyp_justificaciones` VALUES ('3', 'assets/viaticos/justificaciones/0000003.pdf', '515.36 KB', '65', 'pdf', '0000003.pdf', 'Scan.pdf');
INSERT INTO `vyp_justificaciones` VALUES ('4', 'assets/viaticos/justificaciones/0000004.pdf', '668.23 KB', '87', 'pdf', '0000004.pdf', 'informe de visita-TUDO SA de CV.pdf');
INSERT INTO `vyp_justificaciones` VALUES ('5', 'assets/viaticos/justificaciones/0000005.pdf', '668.23 KB', '87', 'pdf', '0000005.pdf', 'informe de visita-TUDO SA de CV.pdf');
INSERT INTO `vyp_justificaciones` VALUES ('6', 'assets/viaticos/justificaciones/0000006.pdf', '668.23 KB', '87', 'pdf', '0000006.pdf', 'informe de visita-TUDO SA de CV.pdf');
INSERT INTO `vyp_justificaciones` VALUES ('7', 'assets/viaticos/justificaciones/0000007.pdf', '668.23 KB', '87', 'pdf', '0000007.pdf', 'informe de visita-TUDO SA de CV.pdf');
INSERT INTO `vyp_justificaciones` VALUES ('8', 'assets/viaticos/justificaciones/0000008.pdf', '668.23 KB', '87', 'pdf', '0000008.pdf', 'informe de visita-TUDO SA de CV.pdf');
INSERT INTO `vyp_justificaciones` VALUES ('9', 'assets/viaticos/justificaciones/0000009.pdf', '1.36 MB', '108', 'pdf', '0000009.pdf', 'viatico160119.pdf');

-- ----------------------------
-- Table structure for `vyp_mision_oficial`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_mision_oficial`;
CREATE TABLE `vyp_mision_oficial` (
  `id_mision_oficial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nr_empleado` varchar(5) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `fecha_mision_inicio` date NOT NULL,
  `fecha_mision_fin` date NOT NULL DEFAULT '0000-00-00',
  `fecha_solicitud` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id_actividad_realizada` int(10) unsigned NOT NULL,
  `detalle_actividad` varchar(500) NOT NULL,
  `nr_jefe_inmediato` varchar(5) NOT NULL,
  `nr_jefe_regional` varchar(5) NOT NULL,
  `aprobado1` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aprobado2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aprobado3` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` int(10) unsigned NOT NULL DEFAULT '0',
  `ruta_justificacion` text NOT NULL,
  `ultima_observacion` datetime NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `pagado_en` varchar(45) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `no_cheque` varchar(100) NOT NULL,
  `oficina_solicitante_motorista` varchar(5) NOT NULL DEFAULT '',
  `id_seccion` int(11) NOT NULL,
  `id_oficina` int(5) unsigned zerofill NOT NULL,
  `observaciones` varchar(300) NOT NULL,
  `id_empleado_informacion_laboral` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id_mision_oficial`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_mision_oficial
-- ----------------------------
INSERT INTO `vyp_mision_oficial` VALUES ('1', '2785', 'MARTA AMERICA GRIJALBA GARCIA', '2019-01-03', '2019-01-03', '2019-01-03 11:38:40', '15', 'LIQUIDACION COMBUSTIBLE', '945C', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-03 11:38:40', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00031', '', '0000001643');
INSERT INTO `vyp_mision_oficial` VALUES ('4', '2658', 'EDWIN ANTONIO GAITAN FUNES', '2019-01-04', '2019-01-04', '0000-00-00 00:00:00', '7', 'TRANSPORTAR PERSONAL DEL DEPARTAMENTO DE INSPECCIÓN DE TRABAJO', '844C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '61', '0', '00032', '', '0000001604');
INSERT INTO `vyp_mision_oficial` VALUES ('8', '863C', 'LUZ DE MARIA HERRERA LOPEZ', '2019-01-07', '2019-01-07', '0000-00-00 00:00:00', '21', 'VISITA TECNICA SOBRE CUMPLIMIENTO DEL ARTICULO 10 DE L REGLAMENTO DE GESTION,SOBRE LAS 48 HORAS,VISITA TECNICA SOBRE CUMPLIMIENTO DE LA LEY GENERAL DE PREVENCION DE RIESGOS EN LOS LUGARES DE TRABAJO,PLAN ESPECIAL A LAS INSTITUCIONES PUBLICAS.', '802C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00023', '', '0000000409');
INSERT INTO `vyp_mision_oficial` VALUES ('9', '610C', 'ZULMA JUDITH GARCIA AMAYA', '2019-01-08', '2019-01-08', '0000-00-00 00:00:00', '25', '', '578C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001610');
INSERT INTO `vyp_mision_oficial` VALUES ('11', '667C', 'ILEANA GABRIELA HERNANDEZ BENITEZ', '2019-01-08', '2019-01-08', '2019-01-08 15:15:45', '1', 'VERIFICACION DE AGUINALDO EN SANTA ROSA DE LIMA', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-09 09:40:47', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001671');
INSERT INTO `vyp_mision_oficial` VALUES ('14', '688C', 'GABINO ULISES MEDINA FLORES', '2019-01-08', '2019-01-08', '2019-01-08 15:26:04', '1', 'REALICE INSPECIONES DE VERIFICACION DEL AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-09 09:46:43', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000496');
INSERT INTO `vyp_mision_oficial` VALUES ('24', '2415', 'DAVID CHAVEZ GUANDIQUE', '2019-01-08', '2019-01-08', '2019-01-09 13:24:22', '1', 'REALIZACIÓN DE INSPECCIONES PROGRAMADAS PARA LA VERIFICACIÓN DEL PAGO DE AGUINALDO 2018', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-11 14:30:50', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001505');
INSERT INTO `vyp_mision_oficial` VALUES ('31', '2417', 'CLARA JANET CABRERA GONZALEZ', '2019-01-08', '2019-01-08', '2019-01-10 09:06:16', '45', 'POR GENERADORES DE VAPOR Y EQUIPOS SUJETOS APRESION', '2820', '807C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 11:06:52', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', 'VERIFICACION DE REGLAMENTO', '0000001455');
INSERT INTO `vyp_mision_oficial` VALUES ('33', '911C', 'VERONICA RAQUEL ROJAS ALFARO DE ESCAMILLA', '2019-01-08', '2019-01-08', '2019-01-10 09:12:35', '17', 'ACTUALIZACIÓN DE NAVEGADORES PARA MEJORAR ACCESO A SNIT', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 09:58:44', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001779');
INSERT INTO `vyp_mision_oficial` VALUES ('34', '720C', 'CARLOS ENRIQUE MARTINEZ CRIOLLO', '2019-01-08', '2019-01-08', '2019-01-10 09:14:57', '17', 'ACTUALIZACIÓN DE NAVEGADORES PARA MEJORAR ACCESO A SNIT', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 10:46:43', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001774');
INSERT INTO `vyp_mision_oficial` VALUES ('35', '391C', 'ANTONIO ALBERTO PARRA', '2019-01-09', '2019-01-09', '2019-01-10 09:56:54', '6', 'NOTIFICACIÓN DE RESOLUCIÓN POR LA QUE SE MULTA AL CENTRO ESCOLAR PROFESOR JUSTO CARDOZA', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 11:43:41', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000000610');
INSERT INTO `vyp_mision_oficial` VALUES ('36', '2788', 'CESAR RAMON LINARES SERRANO', '2019-01-08', '2019-01-08', '2019-01-10 09:17:29', '17', 'INSTALACIÓN DE IMPRESORAS', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 10:04:39', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001773');
INSERT INTO `vyp_mision_oficial` VALUES ('37', '896C', 'NAPOLEON ERNESTO ESCALANTE RAMOS', '2019-01-08', '2019-01-08', '2019-01-10 09:19:28', '17', 'SOPORTE TECNICO A PLANTA TELEFONICA', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 09:59:35', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001567');
INSERT INTO `vyp_mision_oficial` VALUES ('39', '612C', 'NANCY LISSETH LOPEZ CASTRO DE RODRIGUEZ', '2019-01-10', '2019-01-10', '0000-00-00 00:00:00', '39', '', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000000444');
INSERT INTO `vyp_mision_oficial` VALUES ('41', '2718', 'JOSE ALBERTO CORVERA', '2019-01-08', '2019-01-08', '2019-01-10 09:55:29', '6', 'ENTREGA DE NOTIFICACIONES DE EXPEDIENTES EN TRAMITE SANCIONATORIO', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-10 11:43:16', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001532');
INSERT INTO `vyp_mision_oficial` VALUES ('43', '2580', 'ANA CAROLINA SALDAÑA MORAN', '2019-01-10', '2019-01-10', '0000-00-00 00:00:00', '39', '', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000001258');
INSERT INTO `vyp_mision_oficial` VALUES ('44', '2401', 'EMILIA YANIRA FUNES DE BELTRAN', '2019-01-10', '2019-01-10', '0000-00-00 00:00:00', '1', 'VISITA', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000001335');
INSERT INTO `vyp_mision_oficial` VALUES ('48', '700C', 'ROMEO ISAAC SORIANO HERNANDEZ', '2019-01-08', '2019-01-08', '2019-01-10 13:50:46', '7', 'TRASLADO DE INSPECTORES A EMPRESA HIDALGO E HIDALGO (FOMILENIO), CARRETERA AL AEROPUERTO, SAN LUIS TALPA, LA PAZ', '2879', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-16 11:11:44', '0000-00-00 00:00:00', 'banco', '0', '', '17', '0', '00016', '', '0000000798');
INSERT INTO `vyp_mision_oficial` VALUES ('49', '700C', 'ROMEO ISAAC SORIANO HERNANDEZ', '2019-01-09', '2019-01-09', '2019-01-10 13:47:00', '7', 'TRASLADO DE PERSONAL DE INSPECCION DE TRABAJO', '2879', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-17 15:32:51', '0000-00-00 00:00:00', 'banco', '0', '', '37', '0', '00016', '', '0000000798');
INSERT INTO `vyp_mision_oficial` VALUES ('52', '620C', 'SANDRA MILAGRO AYALA ALFARO', '2019-01-09', '2019-01-09', '2019-01-10 14:30:49', '39', 'VERIFICACION DE VACACIONES Y AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-11 08:16:57', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000078');
INSERT INTO `vyp_mision_oficial` VALUES ('54', '2729', 'MARIO ALEXANDER QUINTEROS', '2019-01-09', '2019-01-09', '2019-01-10 15:06:10', '7', 'TRANSPORTAR PERSONAL A FIRMA DE EVALUACIÓN', '844C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-10 15:06:10', '0000-00-00 00:00:00', 'banco', '0', '', '175', '0', '00032', '', '0000000662');
INSERT INTO `vyp_mision_oficial` VALUES ('60', '688C', 'GABINO ULISES MEDINA FLORES', '2019-01-10', '2019-01-10', '2019-01-11 07:59:13', '1', 'VERIFICACION DEL PAGO DEL AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-11 14:19:36', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000496');
INSERT INTO `vyp_mision_oficial` VALUES ('61', '2729', 'MARIO ALEXANDER QUINTEROS', '2019-01-10', '2019-01-10', '2019-01-11 09:05:07', '7', 'TRANSPORTAR PERSONAL DEL DEPARTAMENTO DE INSPECCIÓN DE TRABAJO A REALIZAR REINSPECCIONES', '844C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-11 09:05:07', '0000-00-00 00:00:00', 'banco', '0', '', '61', '0', '00032', '', '0000000662');
INSERT INTO `vyp_mision_oficial` VALUES ('62', '620C', 'SANDRA MILAGRO AYALA ALFARO', '2019-01-10', '2019-01-10', '2019-01-10 15:19:49', '39', 'VERIFICACION DE VACACION ANUAL', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-11 13:56:56', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000078');
INSERT INTO `vyp_mision_oficial` VALUES ('65', '812C', 'KAREN LISSETH ALAS HERRERA', '2019-01-08', '2019-01-08', '2019-01-11 08:13:14', '1', 'SE REALIZARON INSPECCIONES EN LAS INSTALACIONES DE LA CENTRAL HIDROELÉCTRICA DEL CERRON GRANDE', '805C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', 'justificacion', '2019-01-16 11:36:38', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00021', 'SE DEJARON SOLICITUD DE DOCUMENTOS POR NO CONTAR CON LA DOCUMENTACIÓN EN EL LUGAR DE TRABAJO ', '0000001723');
INSERT INTO `vyp_mision_oficial` VALUES ('66', '734C', 'MANUEL ANTONIO LAINEZ', '2019-01-10', '2019-01-10', '2019-01-11 08:25:29', '10', 'ENTREGA DE TARJETA DE CIRCULACION DEL VEHICULO N7556 PARA REFRENDA', '805C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-17 15:30:12', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00021', '', '0000001727');
INSERT INTO `vyp_mision_oficial` VALUES ('67', '667C', 'ILEANA GABRIELA HERNANDEZ BENITEZ', '2019-01-10', '2019-01-10', '2019-01-11 08:31:31', '1', 'REALICE INSPECCION PROGRAMADA DE AGUINALDO ', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-11 14:13:09', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001671');
INSERT INTO `vyp_mision_oficial` VALUES ('68', '2788', 'CESAR RAMON LINARES SERRANO', '2019-01-11', '2019-01-11', '2019-01-14 10:16:44', '17', 'INSTALACIÓN DE SOFTWARE   DE NAVEGACIÓN', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-18 08:21:13', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001773');
INSERT INTO `vyp_mision_oficial` VALUES ('70', '2415', 'DAVID CHAVEZ GUANDIQUE', '2019-01-10', '2019-01-10', '2019-01-11 14:45:57', '1', 'VERIFICACIÓN DE PAGO DE AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-11 14:45:57', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001505');
INSERT INTO `vyp_mision_oficial` VALUES ('73', '2656', 'CARLOS FRANCISCO ROSALES MOLINA', '2019-01-11', '2019-01-11', '2019-01-11 15:01:12', '7', 'TRASLADO DE PERSONAL A MISIÓN OFICIAL A SANTA ROSA DE LIMA', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-11 15:01:12', '0000-00-00 00:00:00', 'banco', '0', '', '57', '0', '00020', '', '0000001009');
INSERT INTO `vyp_mision_oficial` VALUES ('74', '821C', 'EVER SALVADOR ALVAREZ PARADA', '2019-01-11', '2019-01-11', '0000-00-00 00:00:00', '40', 'ATENCIÓN EN LA BOLSA DE EMPLEO LOCAL SANTA ROSA DE LIMA', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000042');
INSERT INTO `vyp_mision_oficial` VALUES ('75', '621C', 'LUCIA ISOLINA ARGUETA DE ORELLANA', '2019-01-11', '2019-01-11', '0000-00-00 00:00:00', '1', 'REALIZAR INSPECCION PROGRAMADA EN EL LUGAR DE TRABAJO DENOMINADO HIDALGO &HIDALGO, SAN LUIS TALPA LA PAZ', '549C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00016', '', '0000000066');
INSERT INTO `vyp_mision_oficial` VALUES ('77', '391C', 'ANTONIO ALBERTO PARRA', '2019-01-11', '2019-01-11', '2019-01-14 09:06:18', '6', 'NOTIFICACIÓN DE AUDIENCIA DE MANDAR A OIR', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-14 09:57:40', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', 'ETAPA DE TRÁMITE SANCIONADOR', '0000000610');
INSERT INTO `vyp_mision_oficial` VALUES ('80', '734C', 'MANUEL ANTONIO LAINEZ', '2019-01-11', '2019-01-11', '2019-01-14 10:56:47', '7', 'TRASLADO DE INSPECTORA DE TRABAJO AL MUNICIPIO DE ILOBASCO', '805C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-16 11:40:30', '0000-00-00 00:00:00', 'banco', '0', '', '53', '0', '00021', '', '0000001727');
INSERT INTO `vyp_mision_oficial` VALUES ('81', '738C', 'DAGOBERTO REYES ALVARENGA ALAS', '2019-01-10', '2019-01-14', '0000-00-00 00:00:00', '7', 'TRANSPORTANDO PERSONAL AL MUNICIPIO DE SAN IGNACIO ', '814C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '54', '0', '00026', 'NINGUNA', '0000000037');
INSERT INTO `vyp_mision_oficial` VALUES ('82', '858C', 'NURY RUBIDIA MORALES SALAZAR', '2019-01-11', '2019-01-11', '2019-01-14 12:27:33', '42', 'REALIZANDO VISITAS TÉCNICAS PROGRAMADAS DE SEGURIDAD OCUPACIONAL', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', '2019-01-14 14:55:42', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000000553');
INSERT INTO `vyp_mision_oficial` VALUES ('83', '896C', 'NAPOLEON ERNESTO ESCALANTE RAMOS', '2019-01-11', '2019-01-11', '2019-01-15 08:27:31', '17', 'SE CONFIGURARON DOS IMPRESORAS A UNA PC.DE ESCRITORIO PLAN INTERNACIONAL ILOBASCO. CONFIGURACIÓN DE IMPRESORA HP , CORRECCIÓN DE USUARIO Y CONFIGURACIÓN DE CORREO OUTLOOK.', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-15 08:27:31', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001567');
INSERT INTO `vyp_mision_oficial` VALUES ('84', '2586', 'EDWIN BENJAMIN ANDRADE CAMPOS', '2019-01-14', '2019-01-14', '2019-01-15 11:45:10', '9', 'REVISION DE SISTEMA ELECTRICO EN CRT, PLAYA CONCHALIO, LA LIBERTAD', '381C', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-18 08:06:54', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000000050');
INSERT INTO `vyp_mision_oficial` VALUES ('85', '2647', 'KENNETH VLADIMIR SERRANO ROSALES', '2019-01-15', '2019-01-15', '2019-01-15 11:58:57', '7', 'TRASLADO  DE MALLA CICLÓN PARA ELABORACIÓN DE BODEGA DE EMPLEO', '381C', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-18 08:04:47', '0000-00-00 00:00:00', 'banco', '0', '', '5', '0', '00022', '', '0000001827');
INSERT INTO `vyp_mision_oficial` VALUES ('86', '740C', 'ELISEO HUEZO RIVAS', '2019-01-15', '2019-01-15', '2019-01-16 13:56:40', '7', 'TRANSPORTANDO PERSONAL', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', '2019-01-16 14:48:15', '0000-00-00 00:00:00', 'banco', '0', '', '56', '0', '00024', '', '0000000413');
INSERT INTO `vyp_mision_oficial` VALUES ('87', '2799', 'EILEEN LIZZIE LOZANO GRANADOS', '2019-01-09', '2019-01-16', '0000-00-00 00:00:00', '1', 'DILIGENCIAS DE INSPECCIÓN: ENTREVISTAS Y SE SOLICITÓ DOCUMENTACIÓN.', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', 'NO SE LOGRÓ INGRESAR EL PRESENTE VIATICO EN LOS DOS DÍAS HÁBILES QUE SE TIENEN POR PROBLEMAS CON EL SISTEMA DE VIÁTICOS. PRESENTABA UN ERROR CON LOS DATOS DE LAS JEFATURAS ', '0000001314');
INSERT INTO `vyp_mision_oficial` VALUES ('89', '672C', 'CARLOS ALBERTO MENDEZ CASTRO', '2019-01-15', '2019-01-15', '2019-01-16 09:49:10', '45', 'VISITAS TECNICAS DE VERIFICACION DE CUMPLIMIENTO', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', '2019-01-16 12:07:23', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000000522');
INSERT INTO `vyp_mision_oficial` VALUES ('90', '2580', 'ANA CAROLINA SALDAÑA MORAN', '2019-01-14', '2019-01-14', '0000-00-00 00:00:00', '39', 'REALIZACION DE INSPECCIONES ESPECIALES', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000001258');
INSERT INTO `vyp_mision_oficial` VALUES ('91', '344C', 'DANIA MABEL FABIAN MENA', '2019-01-15', '2019-01-15', '2019-01-16 10:05:24', '45', 'VISITA TÉCNICA PROGRAMADA POR ACCIDENTE DE TRABAJO Y VERIFICACIÓN DE CUMPLIMIENTO', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', '2019-01-16 12:08:25', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000001578');
INSERT INTO `vyp_mision_oficial` VALUES ('92', '869C', 'JESUS ANTONIO GUARDADO SERRANO', '2019-01-16', '2019-01-16', '0000-00-00 00:00:00', '2', 'REALIZAR REINSPECCIONES', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000001649');
INSERT INTO `vyp_mision_oficial` VALUES ('95', '2417', 'CLARA JANET CABRERA GONZALEZ', '2019-01-16', '2019-01-16', '2019-01-17 10:19:48', '45', 'POR GENERADORES DE VAPOR Y EQUIPOS SUJETOS A PRESION', '2820', '807C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-17 11:17:33', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001455');
INSERT INTO `vyp_mision_oficial` VALUES ('96', '2879', 'MARIA DINORA LOPEZ DE VENTURA DE VENTURA', '2019-01-16', '2019-01-16', '2019-01-16 11:32:21', '3', 'CAPACITACION DE SISTEMA DE VIATICOS, REUNION CON RECURSOS HUMANOS, REUNION CON LA UACI, REUNION CON UDT', '997C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-16 11:55:55', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00016', '', '0000001282');
INSERT INTO `vyp_mision_oficial` VALUES ('97', '2729', 'MARIO ALEXANDER QUINTEROS', '2019-01-15', '2019-01-15', '0000-00-00 00:00:00', '7', 'TRANSPORTAR COORDINADOR DEL DEPTO. DE EMPLEO A REUNIÓN.-', '844C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '61', '0', '00032', '', '0000000662');
INSERT INTO `vyp_mision_oficial` VALUES ('98', '875C', 'FATIMA MERCEDES MARTINEZ DE MENDEZ', '2019-01-15', '2019-01-15', '0000-00-00 00:00:00', '1', 'INSPECCIONES PROGRAMADAS ACOSAMA Y ACMASA', '802C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00023', 'ME DESPLACE HACIA DONDE SE ENCONTRABAN LOS TRABAJADORES EN LA PLANTA 1  Y PLANTA 2 DE LA EMPRESA ACMASA, DESPUES NOS REGRESAMOS A LA OFICINA ADMINISTRATIVA DE LA EMPRESA ACMASA.', '0000001947');
INSERT INTO `vyp_mision_oficial` VALUES ('101', '759C', 'HAROLD ERNESTO RIVERA PLEITEZ', '2019-01-14', '2019-01-14', '2019-01-16 14:38:08', '2', 'REINSPECCION', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', '2019-01-16 16:23:27', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000000707');
INSERT INTO `vyp_mision_oficial` VALUES ('103', '2496', 'MOISES ROLANDO MAGAÑA MENENDEZ', '2019-01-16', '2019-01-16', '2019-01-16 14:58:06', '3', 'CAPACITACION EN SAN SALVADOR', '2806', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-17 14:24:21', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00015', '', '0000000462');
INSERT INTO `vyp_mision_oficial` VALUES ('104', '759C', 'HAROLD ERNESTO RIVERA PLEITEZ', '2019-01-15', '2019-01-15', '2019-01-16 15:12:52', '1', 'INSPECCION PROGRAMADA', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-16 16:21:55', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000000707');
INSERT INTO `vyp_mision_oficial` VALUES ('106', '2822', 'MADIS ELISA PEREZ DE PAREDES', '2019-01-17', '2019-01-17', '0000-00-00 00:00:00', '45', 'VISITAS TÉCNICAS DE SEGURIDAD OCUPACIONAL POR GENERADORES DE VAPOR', '2417', '807C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000000941');
INSERT INTO `vyp_mision_oficial` VALUES ('107', '620C', 'SANDRA MILAGRO AYALA ALFARO', '2019-01-16', '2019-01-16', '2019-01-17 07:43:24', '1', 'VERIFICACIÓN DE PAGO DE AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-17 07:43:24', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000078');
INSERT INTO `vyp_mision_oficial` VALUES ('108', '2877', 'URI ESAU LOPEZ RIVAS', '2019-01-16', '2019-01-16', '2019-01-17 08:53:00', '21', 'VISITA DE SEGUIMIENTO AL CSSO, VISITA DE PROMOCIÓN DE LA LGPRLT Y VERIFICACIÓN DE CUMPLIMIENTO DEL ART 10 DEL RGPRLT.', '805C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', 'justificacion', '2019-01-17 15:31:29', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00021', '', '0000001728');
INSERT INTO `vyp_mision_oficial` VALUES ('109', '875C', 'FATIMA MERCEDES MARTINEZ DE MENDEZ', '2019-01-15', '2019-01-15', '0000-00-00 00:00:00', '1', 'INSPECCIONES PROGRAMADAS, EN LA NORMATIVA LABORAL Y DE LA LGPRLT. ACMASA Y ACOSAMA', '802C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00023', 'EN EL CASO DE ACMASA, SE VISITO EN DOS PLANTAS DE AGUA Y POSTERIORMENTE TUVIMOS QUE REGRESAR A LAS INSTALACIONES DE LA EMPRESA ACMASA.', '0000001947');
INSERT INTO `vyp_mision_oficial` VALUES ('110', '734C', 'MANUEL ANTONIO LAINEZ', '2019-01-17', '2019-01-17', '2019-01-17 09:06:32', '7', 'TRASLADE AL ENCARGADO DEL ÁREA DE SEGURIDAD Y SALUD OCUPACIONAL Y A LA INSPECTORA DEL ÁREA DE DERECHO LABORAL, HACIA ILOBASCO Y DE REGRESO A LA OFICINA EN SENSUNTEPEQUE.', '805C', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-17 15:32:05', '0000-00-00 00:00:00', 'banco', '0', '', '53', '0', '00021', '', '0000001727');
INSERT INTO `vyp_mision_oficial` VALUES ('112', '939C', 'JUAN CARLOS CORTEZ TOBIAS', '2019-01-15', '2019-01-15', '2019-01-17 10:03:38', '7', 'TRANSPORTANDO AL INSPECTOR SALVADOR DUARTE AL INGENIO LA MAGDALENA Y MAQUILAS DE CHALCHUAPA', '2806', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-17 10:03:38', '0000-00-00 00:00:00', 'banco', '0', '', '66', '0', '00015', '', '0000001530');
INSERT INTO `vyp_mision_oficial` VALUES ('113', '876C', 'DOUGLAS ALCIDES MONGE HERNANDEZ', '2019-01-16', '2019-01-16', '0000-00-00 00:00:00', '1', 'VISITA DE INSPECCION PROGRAMADA AL CENTRO DE TRABAJO VENTA DE ROPA USADA, Y RE INSPECCION AL CENTRO DE TRABAJO DISTRIBUIDORA EL TRIGAL , UBICADA EN EL MUNICIPIO DE LA TEJUTLA.-  ', '814C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00026', '', '0000001731');
INSERT INTO `vyp_mision_oficial` VALUES ('114', '707C', 'CARLOS FRANCISCO CHAVEZ ORTIZ', '2019-01-15', '2019-01-15', '2019-01-17 14:20:10', '17', 'NO HABIA INTERNET EN LA OFICINA DE SONSONATE EL DIA 15/01/2019 Y TUVE QUE TASLADARME PARA DIAGNOSTICAR EL PROBLEMA Y DARLE UNA SOLUCION. ', '2806', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-17 14:20:10', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00015', 'EL DIA DE AYER INTENTE INGRESAR EL VIATICO PERO SALIA UN MENSAJE QUE NO PODIA PORQUE ME FALTABAN DATOS POR LO CUAL HABLE AHORA EN LA MAÑANA CON ROBERTO DE DESARROLLO TECNOLOGICO Y ME MANIFESTO QUE TENIA QUE HABLAR CON ALGUIEN DE FONDO CIRCULANTE PERO AHORA INTENTE NUEVAMENTE Y YA PUDE.', '0000001508');
INSERT INTO `vyp_mision_oficial` VALUES ('115', '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA', '2019-01-15', '2019-01-15', '0000-00-00 00:00:00', '25', '', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001662');
INSERT INTO `vyp_mision_oficial` VALUES ('117', '391C', 'ANTONIO ALBERTO PARRA', '2019-01-16', '2019-01-16', '2019-01-17 14:43:31', '6', 'NOTIFICACIÓN DE RESOLUCIONES DE IMPOSICIÓN DE MULTA DEL DIIC, NOTIFICACIÓN DE ADMISIÓN DE RECURSO DE APELACIÓN Y NOTIFICACIÓN DE RESOLUCIONES QUE RESUELVEN EL RECURSO DE APELACIÓN', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-18 08:29:42', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', 'NOTIFICACIÓN DE RESOLUCIONES DE IMPOSIÓN DE MULTA DEL DIIC, NOTIFICACIÓN DE ADMISIÓN DEL RECURSO DE APELACIÓN Y NOTIFICACIÓN DE RESOLUCIONES QUE RESUELVEN RECURSO DE APELACIÓN', '0000000610');
INSERT INTO `vyp_mision_oficial` VALUES ('118', '620C', 'SANDRA MILAGRO AYALA ALFARO', '2019-01-17', '2019-01-17', '2019-01-17 14:40:24', '1', 'VERIFICACION DE PAGOS DE AGUINALDOS', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-17 14:40:24', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000078');
INSERT INTO `vyp_mision_oficial` VALUES ('119', '2718', 'JOSE ALBERTO CORVERA', '2019-01-14', '2019-01-17', '0000-00-00 00:00:00', '6', 'NOTIFICACION DE EXPEDIENTES EN TRAMITE SANCIONATORIO Y ESCRITO SALA DE LO CONTENCIOSO', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001532');
INSERT INTO `vyp_mision_oficial` VALUES ('120', '2600', 'JOSE AGUSTIN MARINERO MERINO', '2019-01-15', '2019-01-15', '2019-01-17 15:10:21', '6', 'ENTREGA DE NOTIFICACIONES DE EXPEDIENTES EN TRAMITE SANCIONATORIO', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '3', '', '2019-01-18 08:30:15', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001240');
INSERT INTO `vyp_mision_oficial` VALUES ('122', '939C', 'JUAN CARLOS CORTEZ TOBIAS', '2019-01-17', '2019-01-17', '2019-01-17 15:24:00', '7', 'TRANSPORTE DE VERENA LEÒN A OFICINAS CENTRALES A REVISAR DOCUMENTACION AL AREA DE APELACIONES.', '2806', '2806', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-17 15:24:00', '0000-00-00 00:00:00', 'banco', '0', '', '66', '0', '00015', '', '0000001530');
INSERT INTO `vyp_mision_oficial` VALUES ('123', '688C', 'GABINO ULISES MEDINA FLORES', '2019-01-16', '2019-01-16', '2019-01-17 15:24:28', '1', 'VERIFICACION DE PAGO DEL AGUINALDO ', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-17 15:24:28', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000496');
INSERT INTO `vyp_mision_oficial` VALUES ('124', '700C', 'ROMEO ISAAC SORIANO HERNANDEZ', '2019-01-16', '2019-01-16', '2019-01-17 15:39:12', '7', 'TRASLADO DE JEFATURA REGIONAL A OFICINA CENTRAL MTPS SAN SALVADOR', '2879', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', '', '2019-01-17 15:44:46', '0000-00-00 00:00:00', 'banco', '0', '', '64', '0', '00016', '', '0000000798');
INSERT INTO `vyp_mision_oficial` VALUES ('126', '688C', 'GABINO ULISES MEDINA FLORES', '2019-01-18', '2019-01-18', '2019-01-18 07:42:25', '1', 'VERIFICACION DEL PAGO DEL AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-18 07:42:25', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000000496');
INSERT INTO `vyp_mision_oficial` VALUES ('128', '667C', 'ILEANA GABRIELA HERNANDEZ BENITEZ', '2019-01-17', '2019-01-17', '2019-01-18 07:46:52', '1', 'VERIFICACIÓN DE PAGO DE AGUINALDOS Y RE-INSPECCIONES DE VACACION ANUAL  EN SANTA ROSA DE LIMA ', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-18 07:46:52', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001671');
INSERT INTO `vyp_mision_oficial` VALUES ('129', '598C', 'RAFAEL ERNESTO ULLOA GOMEZ', '2019-01-17', '2019-01-17', '0000-00-00 00:00:00', '1', 'REALIZANDO INSPECCIONES PROGRAMADAS ', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000001228');
INSERT INTO `vyp_mision_oficial` VALUES ('133', '2415', 'DAVID CHAVEZ GUANDIQUE', '2019-01-15', '2019-01-18', '2019-01-18 08:19:26', '2', 'VERIFICACION DE CUMPLIMIENTO DE INFRACCIONES PUNTUALIZADAS EN INSPECCION PROGRAMADAS', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-18 08:19:26', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001505');
INSERT INTO `vyp_mision_oficial` VALUES ('134', '720C', 'CARLOS ENRIQUE MARTINEZ CRIOLLO', '2019-01-18', '2019-01-18', '0000-00-00 00:00:00', '25', '', '988C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001774');
INSERT INTO `vyp_mision_oficial` VALUES ('135', '759C', 'HAROLD ERNESTO RIVERA PLEITEZ', '2019-01-17', '2019-01-17', '0000-00-00 00:00:00', '1', 'REALIZANDO DILIGENCIAS DE INSPECCIÓN PROGRAMADA', '753C', '997C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00024', '', '0000000707');
INSERT INTO `vyp_mision_oficial` VALUES ('136', '2415', 'DAVID CHAVEZ GUANDIQUE', '2019-01-16', '2019-01-16', '0000-00-00 00:00:00', '1', 'VERIFICACIÓN DEL PAGO DE AGUINALDO', '845C', '820C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00020', '', '0000001505');
INSERT INTO `vyp_mision_oficial` VALUES ('138', '2804', 'MIGUEL ARMANDO IRAHETA CERROS', '2019-01-16', '2019-01-16', '0000-00-00 00:00:00', '1', 'SE CONDUZCO VEHICULO INSTITUCIONAL AL NO ASIGNAR MOTORISTA POR PARTE DEL DEPTO DE TRANSPORTE', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001316');
INSERT INTO `vyp_mision_oficial` VALUES ('140', '2802', 'ANA ROCIO RODRIGUEZ FLORES', '2019-01-16', '2019-01-16', '2019-01-18 09:40:08', '1', 'SE SOLICITÓ DOCUMENTACIÓN A LA REPRESENTACIÓN PATRONAL SE DEJO CONSTANCIA EN INFORME DE VISITA.', '532C', '929C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '2019-01-18 09:40:08', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000001315');
INSERT INTO `vyp_mision_oficial` VALUES ('141', '2895', 'TALIA IVETTE CHICAS SANCHEZ', '2019-01-17', '2019-01-17', '2019-01-18 09:54:15', '10', 'ENTREGA DE DOCUMENTACION A OFICINA CENTRAL MTPS', '2879', '2879', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '', '2019-01-18 10:11:03', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00016', '', '0000001511');
INSERT INTO `vyp_mision_oficial` VALUES ('143', '945C', 'DIANA MARICELA HENRIQUEZ AGUIRRE', '2019-01-17', '2019-01-17', '0000-00-00 00:00:00', '11', 'SE ENTREGÓ INSUMOS Y SE REALIZÓ SUPERVISIÓN EN GENERAL', '982C', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'banco', '0', '', '', '0', '00022', '', '0000000362');

-- ----------------------------
-- Table structure for `vyp_mision_pasajes`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_mision_pasajes`;
CREATE TABLE `vyp_mision_pasajes` (
  `id_mision_pasajes` int(11) NOT NULL AUTO_INCREMENT,
  `nr` varchar(5) NOT NULL,
  `nombre_empleado` varchar(30) NOT NULL,
  `nr_jefe_inmediato` varchar(5) NOT NULL,
  `nr_jefe_regional` varchar(5) NOT NULL,
  `aprobado1` datetime NOT NULL,
  `aprobado2` datetime NOT NULL,
  `aprobado3` datetime NOT NULL,
  `estado` int(10) NOT NULL,
  `ruta_justificacion` varchar(200) NOT NULL,
  `ultima_observacion` datetime NOT NULL,
  `mes_pasaje` int(2) unsigned zerofill NOT NULL,
  `anio_pasaje` int(4) NOT NULL,
  `fecha_solicitud_pasaje` datetime NOT NULL,
  `fechas_pasajes` varchar(100) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `id_oficina` int(11) DEFAULT NULL,
  `id_banco` int(11) NOT NULL,
  PRIMARY KEY (`id_mision_pasajes`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_mision_pasajes
-- ----------------------------
INSERT INTO `vyp_mision_pasajes` VALUES ('1', '2478', 'HUGO ALBERTO JIMENEZ FUENTES ', '2737', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '01', '2019', '2019-01-04 00:00:00', '2019-01-04,2019-01-04,', '0000-00-00 00:00:00', null, '0');
INSERT INTO `vyp_mision_pasajes` VALUES ('2', '2087', 'OVIDIO ZELAYA QUINTANILLA ', '2456', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '01', '2019', '2019-01-09 00:00:00', '2019-01-03,2019-01-03,2019-01-03,2019-01-03,2019-01-03,2019-01-03,2019-01-03,2019-01-04,2019-01-04,2', '0000-00-00 00:00:00', null, '0');
INSERT INTO `vyp_mision_pasajes` VALUES ('5', '2588', 'JOSE ROBERTO HENRIQUEZ GARCIA ', '988C', '982C', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '', '0000-00-00 00:00:00', '01', '2019', '2019-01-17 00:00:00', '', '0000-00-00 00:00:00', null, '0');

-- ----------------------------
-- Table structure for `vyp_observacion_solicitud`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_observacion_solicitud`;
CREATE TABLE `vyp_observacion_solicitud` (
  `id_observacion_solicitud` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_mision` int(10) unsigned NOT NULL,
  `observacion` varchar(150) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `corregido` tinyint(1) NOT NULL,
  `nr_observador` varchar(5) NOT NULL,
  `id_tipo_observador` int(10) unsigned NOT NULL,
  `tipo_observador` varchar(45) NOT NULL,
  `paso` int(11) NOT NULL,
  `id_observado` int(11) NOT NULL,
  PRIMARY KEY (`id_observacion_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_observacion_solicitud
-- ----------------------------
INSERT INTO `vyp_observacion_solicitud` VALUES ('1', '24', 'NO HA PRESENTADO LA BITÁCORA PARA PAGO DE VIÁTICOS Y PASAJES.  ', '2019-01-10 09:31:58', '1', '845C', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('2', '52', 'LAS FECHAS NO COINCIDEN.', '2019-01-10 14:58:14', '1', '845C', '1', 'Jefatura inmediato', '1', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('3', '60', 'NO COINCIDEN LAS HORAS', '2019-01-11 08:15:45', '1', '845C', '1', 'Jefatura inmediato', '1', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('4', '67', 'LOS LUGARES VISITADOS NO COINCIDEN', '2019-01-11 13:55:16', '1', '845C', '1', 'Jefatura inmediato', '2', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('5', '24', 'NO HA PRESENTADO LA BITÁCORA PARA PAGO DE VIÁTICOS Y PASAJES.  ', '2019-01-11 13:56:16', '1', '845C', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('6', '66', 'ENTREGA DE DOCUMENTOS DE REQUISICION Y REQUISISCION DE VALES DE COMBUSTIBLE.', '2019-01-11 14:18:54', '1', '805C', '1', 'Jefatura inmediato', '3', '117');
INSERT INTO `vyp_observacion_solicitud` VALUES ('7', '66', 'ENTREGA DE DOCUMENTOS DE REQUISICION Y REQUISISCION DE VALES DE COMBUSTIBLE.', '2019-01-11 14:19:29', '1', '805C', '1', 'Jefatura inmediato', '3', '128');
INSERT INTO `vyp_observacion_solicitud` VALUES ('9', '65', 'INSPECCIONES DE TRABAJO', '2019-01-11 14:25:55', '1', '805C', '1', 'Jefatura inmediato', '2', '70');
INSERT INTO `vyp_observacion_solicitud` VALUES ('10', '65', 'INSPECCIONES DE TRABAJO', '2019-01-11 14:26:11', '1', '805C', '1', 'Jefatura inmediato', '2', '71');
INSERT INTO `vyp_observacion_solicitud` VALUES ('11', '66', 'ENTREGA DE DOCUMENTOS DE REQUISICION Y REQUISISCION DE VALES DE COMBUSTIBLE.', '2019-01-11 15:07:21', '1', '805C', '1', 'Jefatura inmediato', '2', '72');
INSERT INTO `vyp_observacion_solicitud` VALUES ('12', '82', 'VERIFICAR Y ENMENDAR YA QUE LA SALIDA CORRESPONDERIA AL ISSS PUERTO DE LA LIBERTAD', '2019-01-14 14:54:57', '0', '753C', '1', 'Jefatura inmediato', '3', '195');
INSERT INTO `vyp_observacion_solicitud` VALUES ('13', '49', 'NO ENTREGO VITACORAS ', '2019-01-16 11:05:49', '1', '2879', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('14', '49', 'NO COINCIDE CON LO INGRESADO ', '2019-01-16 11:06:20', '1', '2879', '1', 'Jefatura inmediato', '2', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('15', '66', 'FAVOR VERIFICAR FECHA DE CUMPLIMIENTO DE LA MISION ', '2019-01-16 11:38:34', '1', '2879', '2', 'Dirección o Jefatura regional', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('16', '89', 'NO APARECE REFLEJADA FIRMA DIGITAL Y TAMPOCO SALARIO', '2019-01-16 12:07:07', '0', '753C', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('17', '91', 'NO APARECE REFLEJADA FIRMA DIGITAL Y TAMPOCO SALARIO', '2019-01-16 12:07:46', '0', '753C', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('18', '86', 'NO APARECE REFLEJADA FIRMA DIGITAL Y TAMPOCO SALARIO', '2019-01-16 14:13:25', '0', '753C', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('19', '101', 'NO APARECE REFLEJADA FIRMA DIGITAL Y TAMPOCO SALARIO', '2019-01-16 16:22:59', '0', '753C', '1', 'Jefatura inmediato', '0', '0');
INSERT INTO `vyp_observacion_solicitud` VALUES ('20', '141', 'NO POSEE VITACORA ', '2019-01-18 10:10:50', '0', '2879', '1', 'Jefatura inmediato', '0', '0');

-- ----------------------------
-- Table structure for `vyp_observaciones_pasajes`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_observaciones_pasajes`;
CREATE TABLE `vyp_observaciones_pasajes` (
  `id_observacion_pasaje` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_mision_pasajes` int(10) unsigned NOT NULL,
  `observacion` varchar(150) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `corregido` tinyint(1) NOT NULL,
  `nr_observador` varchar(5) NOT NULL,
  `id_tipo_observador` int(10) unsigned NOT NULL,
  `tipo_observador` varchar(45) NOT NULL,
  PRIMARY KEY (`id_observacion_pasaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_observaciones_pasajes
-- ----------------------------

-- ----------------------------
-- Table structure for `vyp_oficina_autorizador`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_oficina_autorizador`;
CREATE TABLE `vyp_oficina_autorizador` (
  `id_oficina_autorizador` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_oficina` int(5) unsigned zerofill NOT NULL DEFAULT '00000',
  `nr_autorizador` varchar(5) NOT NULL DEFAULT '',
  `id_sistema` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_oficina_autorizador`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_oficina_autorizador
-- ----------------------------
INSERT INTO `vyp_oficina_autorizador` VALUES ('1', '00022', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('2', '00022', '982C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('3', '00016', '2879 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('4', '00021', '2879 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('5', '00022', '929C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('7', '00022', '807C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('8', '00022', '2879 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('9', '00022', '2874 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('10', '00027', '982C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('12', '00029', '982C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('13', '00030', '982C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('14', '00031', '982C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('15', '00016', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('16', '00020', '820C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('17', '00020', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('18', '00025', '820C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('19', '00025', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('20', '00014', '820C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('21', '00014', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('22', '00032', '820C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('23', '00032', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('24', '00026', '814C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('25', '00026', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('26', '00024', '753C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('27', '00024', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('28', '00015', '2806 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('29', '00015', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('31', '00019', '2806 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('32', '00023', '2879 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('33', '00033', '2879 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('34', '00033', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('35', '00034', '2806 ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('36', '00034', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('37', '00019', '997C ', '15');
INSERT INTO `vyp_oficina_autorizador` VALUES ('38', '00022', '463C ', '15');

-- ----------------------------
-- Table structure for `vyp_oficinas`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_oficinas`;
CREATE TABLE `vyp_oficinas` (
  `id_oficina` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombre_oficina` varchar(200) NOT NULL,
  `direccion_oficina` varchar(400) NOT NULL,
  `jefe_oficina` varchar(250) NOT NULL,
  `email_oficina` varchar(250) NOT NULL,
  `latitud_oficina` varchar(50) NOT NULL,
  `longitud_oficina` varchar(50) NOT NULL,
  `id_departamento` int(5) unsigned zerofill NOT NULL,
  `id_municipio` int(5) unsigned zerofill NOT NULL,
  `id_zona` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_oficina`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_oficinas
-- ----------------------------
INSERT INTO `vyp_oficinas` VALUES ('00014', 'OFICINA REGIONAL DE ORIENTE', 'San Miguel, El Salvador', '218 ', 'hdepaz@mtps.gob.sv', '13.478022085521037', ' -88.17572772502899', '00012', '00199', '3');
INSERT INTO `vyp_oficinas` VALUES ('00015', 'OFICINA REGIONAL DE OCCIDENTE', '2a Calle Pte, Santa Ana, El Salvador', '1000035 ', 'ruth.rodriguez@mtps.gob.sv', '13.995904771596313', ' -89.5583595714698', '00002', '00013', '1');
INSERT INTO `vyp_oficinas` VALUES ('00016', 'OFICINA PARACENTRAL, LA PAZ', 'Zacatecoluca, El Salvador', '1000088 ', 'maria.lopez@mtps.gob.sv', '13.50745798979771', ' -88.86813461780548', '00008', '00132', '2');
INSERT INTO `vyp_oficinas` VALUES ('00019', 'OFICINA DEPARTAMENTAL DE SONSONATE', 'Residencial Santa Isabel, Sonsonate Department, El Salvador', '197 ', 'jose.cortez@mtps.gob.sv', '13.727994917510898', ' -89.71651872230689', '00003', '00026', '1');
INSERT INTO `vyp_oficinas` VALUES ('00020', 'OFICINA DEPARTAMENTAL DE LA UNION', '1a. CALLE PTE. Y 7a. AV. NTE. FRENTE A PASTELERIA SAN JUAN,BARRIO EL CENTRO, LA UNION', '761 ', 'francisco.sorto@mtps.gob.sv', '13.338452977384526', ' -87.85250869663571', '00014', '00245', '3');
INSERT INTO `vyp_oficinas` VALUES ('00021', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'Unnamed Road, Sensuntepeque, El Salvador', '57 ', 'miguel.arevalo@mtps.gob.sv', '13.874632280768296', ' -88.63067706110564', '00009', '00154', '2');
INSERT INTO `vyp_oficinas` VALUES ('00022', 'OFICINA CENTRAL', 'Centro de Gobierno, San Salvador, El Salvador', '231 ', 'yolanda.duenas@mtps.gob.sv', '13.705537711909635', ' -89.20028731226921', '00006', '00097', '2');
INSERT INTO `vyp_oficinas` VALUES ('00023', 'OFICINA DEPARTAMENTAL DE CUSCATLAN', '2A Calle Oriente 11, Cojutepeque, El Salvador', '86 ', 'gloria.barrera@mtps.gob.sv', '13.72165733387169', ' -88.93311939707064', '00007', '00116', '2');
INSERT INTO `vyp_oficinas` VALUES ('00024', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD', 'Avenida Dr. Manuel Gallardo, Santa Tecla, El Salvador', '236 ', 'silvia.elizondo@mtps.gob.sv', '13.691957003142875', ' -89.28748860955238', '00005', '00075', '2');
INSERT INTO `vyp_oficinas` VALUES ('00025', 'OFICINA DEPARTAMENTAL DE MORAZAN', 'Barrio El Calvario, San Francisco Gotera, El Salvador', '134 ', 'rufino.canales@mtps.gob.sv', '13.694911169843877', ' -88.1019218216573', '00013', '00219', '3');
INSERT INTO `vyp_oficinas` VALUES ('00026', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', '4ª Avenida, Chalatenango, El Salvador', '208 ', 'lucio.cruz@mtps.gob.sv', '14.04324869190322', ' -88.93664497243185', '00004', '00042', '2');
INSERT INTO `vyp_oficinas` VALUES ('00027', 'CENTRO DE RECREACION DR. MARIO ZAMORA RIVAS,LA PALMA', 'Unnamed Road, El Salvador', '341 ', 'diana.henriquez@mtps.gob.sv', '14.2919778382226', ' -89.15987849235535', '00004', '00054', '2');
INSERT INTO `vyp_oficinas` VALUES ('00029', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', 'CA-2 39, La Libertad, El Salvador', '341 ', 'diana.henriquez@mtps.gob.sv', '13.483820353583399', ' -89.33640271425247', '00005', '00084', '2');
INSERT INTO `vyp_oficinas` VALUES ('00030', 'CENTRO DE RECREACION DR. MIGUEL FELIX CHARLAIX,LA UNION', 'El Tamarindo, El Salvador', '341 ', 'diana.henriquez@mtps.gob.sv', '13.1870530801164', ' -87.91701793670654', '00014', '00249', '3');
INSERT INTO `vyp_oficinas` VALUES ('00031', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'CASERIO VUELTA DE ORO LAGO DE COATEPEQUE,MUNICIPIO EL CONGO,SANTA ANA', '341 ', 'diana.henriquez@mtps.gob.sv', '13.891681883737938', ' -89.54912066459656', '00002', '00017', '1');
INSERT INTO `vyp_oficinas` VALUES ('00032', 'OFICINA DEPARTAMENTAL DE USULUTAN', 'Usulutan, El Salvador', '616 ', 'aportillo@mtps.gob.sv', '13.342817232157875', ' -88.43724436614099', '00011', '00176', '3');
INSERT INTO `vyp_oficinas` VALUES ('00033', 'OFICINA DEPARTAMENTAL DE SAN VICENTE', '3a. Nte. y 5a. CALLE. PTE. BARRIO EL CALVARIO,SAN VICENTE', '818 ', 'lisseth.villalta@mtps.gob.sv', '', '', '00010', '00163', '2');
INSERT INTO `vyp_oficinas` VALUES ('00034', 'OFICINA DEPARTAMENTAL DE AHUACHAPAN', '4a. CALLE OTE., ENTRE AV. FRANCISCO MENENDEZ Y 1a. AV. NORTE. FRENTE A MASESA, AHUACHAPAN', '458 ', 'elsy.martinez@mtps.gob.sv', '', '', '00001', '00001', '1');

-- ----------------------------
-- Table structure for `vyp_oficinas_telefono`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_oficinas_telefono`;
CREATE TABLE `vyp_oficinas_telefono` (
  `id_vyp_oficinas_telefono` int(11) NOT NULL AUTO_INCREMENT,
  `telefono_vyp_oficnas_telefono` varchar(9) NOT NULL,
  `id_oficina_vyp_oficnas_telefono` int(11) NOT NULL,
  PRIMARY KEY (`id_vyp_oficinas_telefono`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_oficinas_telefono
-- ----------------------------
INSERT INTO `vyp_oficinas_telefono` VALUES ('3', '2661-4261', '14');
INSERT INTO `vyp_oficinas_telefono` VALUES ('4', '2661-4265', '14');
INSERT INTO `vyp_oficinas_telefono` VALUES ('5', '2441-2472', '15');
INSERT INTO `vyp_oficinas_telefono` VALUES ('6', '2441-2478', '15');
INSERT INTO `vyp_oficinas_telefono` VALUES ('7', '2334-1375', '16');
INSERT INTO `vyp_oficinas_telefono` VALUES ('8', '2334-1378', '16');
INSERT INTO `vyp_oficinas_telefono` VALUES ('9', '2382-1905', '21');
INSERT INTO `vyp_oficinas_telefono` VALUES ('10', '2382-1007', '21');
INSERT INTO `vyp_oficinas_telefono` VALUES ('11', '2372-3318', '23');
INSERT INTO `vyp_oficinas_telefono` VALUES ('12', '2372-2950', '23');
INSERT INTO `vyp_oficinas_telefono` VALUES ('13', '2228-1723', '24');
INSERT INTO `vyp_oficinas_telefono` VALUES ('14', '2228-2242', '24');
INSERT INTO `vyp_oficinas_telefono` VALUES ('15', '2654-1262', '25');
INSERT INTO `vyp_oficinas_telefono` VALUES ('16', '2654-1258', '25');
INSERT INTO `vyp_oficinas_telefono` VALUES ('17', '2301-1458', '26');
INSERT INTO `vyp_oficinas_telefono` VALUES ('18', '2301-1506', '26');

-- ----------------------------
-- Table structure for `vyp_pago_emergencia`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_pago_emergencia`;
CREATE TABLE `vyp_pago_emergencia` (
  `id_pago_emergencia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nr` varchar(5) NOT NULL DEFAULT '',
  `fecha_mision_inicio` date NOT NULL DEFAULT '0000-00-00',
  `fecha_mision_fin` date NOT NULL DEFAULT '0000-00-00',
  `id_actividad` int(10) unsigned NOT NULL DEFAULT '0',
  `monto` float(5,2) NOT NULL DEFAULT '0.00',
  `num_cheque` varchar(50) NOT NULL DEFAULT '',
  `fecha_pago` date NOT NULL DEFAULT '0000-00-00',
  `tipo_pago` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pago_emergencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_pago_emergencia
-- ----------------------------

-- ----------------------------
-- Table structure for `vyp_pago_poliza`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_pago_poliza`;
CREATE TABLE `vyp_pago_poliza` (
  `id_pago_poliza` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sql` text NOT NULL,
  `anio` varchar(4) NOT NULL DEFAULT '',
  `fecha_pago` date NOT NULL DEFAULT '0000-00-00',
  `polizas` varchar(45) NOT NULL DEFAULT '',
  `monto` float(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_pago_poliza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_pago_poliza
-- ----------------------------

-- ----------------------------
-- Table structure for `vyp_pasajes`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_pasajes`;
CREATE TABLE `vyp_pasajes` (
  `id_solicitud_pasaje` int(11) NOT NULL AUTO_INCREMENT,
  `id_municipio` int(5) unsigned zerofill NOT NULL,
  `id_departamento` int(5) unsigned zerofill NOT NULL,
  `fecha_mision` date NOT NULL,
  `no_expediente` varchar(30) NOT NULL,
  `empresa_visitada` varchar(30) NOT NULL,
  `direccion_empresa` varchar(50) NOT NULL,
  `nr` varchar(10) NOT NULL,
  `monto_pasaje` float(10,2) NOT NULL,
  `id_actividad_realizada` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `id_mision` int(11) NOT NULL,
  PRIMARY KEY (`id_solicitud_pasaje`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_pasajes
-- ----------------------------
INSERT INTO `vyp_pasajes` VALUES ('1', '00097', '00006', '2019-01-04', '1505-2012', 'PAPELERA SANREY SA DE CV - CAS', '3° CALLE PONIENTE Y 7° AVENIDA NORTE # 500, S.S. 	', '2478', '0.20', '42', '0', '1');
INSERT INTO `vyp_pasajes` VALUES ('2', '00097', '00006', '2019-01-04', '770-2012', 'FREUND SA DE CV - FERRETERIA F', '3° CALLE ORIENTE # 129, S.S. 		', '2478', '0.20', '42', '0', '1');
INSERT INTO `vyp_pasajes` VALUES ('4', '00097', '00006', '2019-01-03', '', 'Libreria don Quijote', 'Calle Arce', '2087', '0.40', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('5', '00097', '00006', '2019-01-03', '', 'Optica Integral', '11a Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('6', '00097', '00006', '2019-01-03', '', 'Tunig Car', '11a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('7', '00097', '00006', '2019-01-03', '', 'R.Herramientas', '11a.Avenida Norte', '2087', '0.00', '40', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('8', '00097', '00006', '2019-01-03', '', 'Fragancias y Ecencias', '11a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('9', '00097', '00006', '2019-01-03', '', 'Optica La Princesa', '11a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('10', '00097', '00006', '2019-01-03', '', 'Optica Markiño', '11a.Avenida Norte', '2087', '0.00', '40', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('11', '00097', '00006', '2019-01-04', '', 'Acacfos', '4a.Avenida Norte', '2087', '0.40', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('12', '00097', '00006', '2019-01-04', '', 'Libreria Abc', '4a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('13', '00097', '00006', '2019-01-04', '', 'LIbreria Roxy', '4a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('14', '00097', '00006', '2019-01-04', '', 'Papelera Shadai', '4a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('15', '00097', '00006', '2019-01-04', '', 'Sellos Genesis', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('16', '00097', '00006', '2019-01-09', '', 'Granada', 'Alameda Juan Pablo II', '2087', '0.40', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('17', '00097', '00006', '2019-01-09', '', 'Grahic', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('18', '00097', '00006', '2019-01-09', '', 'Optime Impresores', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('19', '00097', '00006', '2019-01-09', '', 'Impresiones Laser Digital', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('20', '00097', '00006', '2019-01-09', '', 'Ideas Print', '8a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('21', '00097', '00006', '2019-01-09', '', 'Torna', 'Alameda Juan Pablo II', '2087', '0.00', '40', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('22', '00097', '00006', '2019-01-09', '', 'Stamp', 'Alameda Juan Pablo II', '2087', '0.00', '40', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('23', '00097', '00006', '2019-01-10', '', 'Tica Bus', 'Calle Concepcion', '2087', '0.40', '40', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('25', '00097', '00006', '2019-01-10', '', 'Venta de Madera Y Ferreteria E', 'Calle Concepcion', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('26', '00097', '00006', '2019-01-10', '', 'Hotel San Carlos', 'Calle Concepcion', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('27', '00097', '00006', '2019-01-10', '', 'Print Shop', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('28', '00097', '00006', '2019-01-10', '', 'Maqui Repuestos', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('29', '00097', '00006', '2019-01-10', '', 'Venta de Madera Oriental', 'Alameda Juan Pablo II', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('30', '00097', '00006', '2019-01-10', '', 'Dipol', 'Calle Cocepcion', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('31', '00097', '00006', '2019-01-14', '', 'Flexsal', '15 Avenida Norte', '2087', '0.40', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('32', '00097', '00006', '2019-01-14', '', 'Muebles Sandra', '3a.Calle Poniente', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('33', '00097', '00006', '2019-01-14', '', 'Omni Music', '7a.Avenida Norte', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('34', '00097', '00006', '2019-01-14', '', 'Westerhausen', '3a Calle Poniente', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('35', '00097', '00006', '2019-01-14', '', 'Pro-Avance', '3a.Calle Poniente', '2087', '0.00', '40', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('36', '00097', '00006', '2019-01-14', '', 'Foto Flores', '3a Calle Poniente', '2087', '0.00', '37', '0', '2');
INSERT INTO `vyp_pasajes` VALUES ('37', '00097', '00006', '2019-01-14', '', 'Impresos Culturales', '5a.Avenida Norte', '2087', '0.00', '40', '0', '2');

-- ----------------------------
-- Table structure for `vyp_poliza`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_poliza`;
CREATE TABLE `vyp_poliza` (
  `id_poliza` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_doc` int(10) unsigned NOT NULL,
  `no_poliza` int(10) unsigned NOT NULL,
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
  `id_mision` int(10) unsigned NOT NULL,
  `fecha_elaboracion_poliza` date NOT NULL,
  `nr_elaborador` varchar(5) NOT NULL,
  `estado` int(10) unsigned NOT NULL,
  `compromiso_presupuestario` varchar(200) NOT NULL,
  `tipo_solicitud` varchar(10) NOT NULL,
  PRIMARY KEY (`id_poliza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_poliza
-- ----------------------------

-- ----------------------------
-- Table structure for `vyp_rutas`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_rutas`;
CREATE TABLE `vyp_rutas` (
  `id_vyp_rutas` int(11) NOT NULL AUTO_INCREMENT,
  `id_oficina_origen_vyp_rutas` int(5) unsigned zerofill NOT NULL,
  `id_oficina_destino_vyp_rutas` int(5) unsigned zerofill DEFAULT NULL,
  `id_departamento_vyp_rutas` int(5) unsigned zerofill DEFAULT NULL,
  `id_municipio_vyp_rutas` int(5) unsigned zerofill DEFAULT NULL,
  `km_vyp_rutas` float(10,2) NOT NULL,
  `descripcion_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `latitud_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `longitud_destino_vyp_rutas` varchar(200) DEFAULT NULL,
  `opcionruta_vyp_rutas` varchar(35) NOT NULL,
  `nombre_empresa_vyp_rutas` varchar(200) DEFAULT NULL,
  `direccion_empresa_vyp_rutas` varchar(400) DEFAULT NULL,
  `estado_vyp_rutas` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_vyp_rutas`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_rutas
-- ----------------------------
INSERT INTO `vyp_rutas` VALUES ('1', '00031', '00022', '00006', '00097', '57.21', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('2', '00022', '00031', '00002', '00017', '57.21', 'OFICINA CENTRAL - CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', '13.891681883737938', ' -89.54912066459656', 'destino_oficina', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', 'CENTRO DE RECREACION CONSTITUCION 1950,SANTA ANA', '0');
INSERT INTO `vyp_rutas` VALUES ('3', '00021', '00022', '00006', '00097', '83.11', 'OFICINA DEPARTAMENTAL DE CABAÑAS - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('4', '00022', '00021', '00009', '00154', '83.11', 'OFICINA CENTRAL - OFICINA DEPARTAMENTAL DE CABAÑAS', '13.874590863949763', ' -88.63032077663439', 'destino_oficina', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '0');
INSERT INTO `vyp_rutas` VALUES ('5', '00020', '00000', '00014', '00260', '46.94', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.622047488758223', '-87.90096763576662', 'destino_mapa', 'HOTEL  EL TEJANO', 'BARRIO EL RECREO A DOS CUADRAS DE AGENCIA CLARO, SANTA ROSA DE LIMA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('6', '00020', '00000', '00014', '00260', '46.94', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.622047488758223', '-87.90096763576662', 'destino_mapa', 'TIENDA EMILY ', 'FINAL OCTAVA AVENIDA SUR,  SANTA ROSA DE LIMA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('7', '00020', '00000', '00014', '00260', '46.94', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.622047488758223', '-87.90096763576662', 'destino_mapa', 'TIENDA CARLITOS', 'OCTAVA AV. SUR,FRENTE A FARMACIA BERAKAH, SANTA ROSA DE LIMA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('8', '00020', '00000', '00014', '00260', '46.90', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '', '', 'destino_municipio', 'LABORATORIO CLÍNICO DELMER', 'CALLE J CLAROS NÚMERO 20, BARRIO EL CALVARIO', '0');
INSERT INTO `vyp_rutas` VALUES ('9', '00020', '00000', '00014', '00260', '46.94', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.622047488758223', '-87.90096763576662', 'destino_mapa', 'ARACELY SALON', 'OCTAVA AVENIDA SUR,CONTIGUO A AGROSERVICIO LA FINCA, SANTA ROSA DE LIMA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('10', '00020', '00000', '00014', '00260', '47.99', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.60953471134451', '-87.8854751964966', 'destino_mapa', 'GUAPOLLON #2 LA MARQUEZA', 'CALLE GIRON, B° EL CALVARIO, LA MARQUEZA,SANTA ROSA DE LIMA, LA UNION  EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('11', '00020', '00000', '00014', '00260', '47.99', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.60953471134451', '-87.8854751964966', 'destino_mapa', 'BOUTIQUE \"ANABELLA\"', '3ERA AV. SUR, Y CALLE GENERAL GIRON, B° EL CALVARIO, SANTA ROSA DE LIMA LA UNION.', '0');
INSERT INTO `vyp_rutas` VALUES ('12', '00024', '00000', '00005', '00084', '38.96', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/LA LIBERTAD', '13.596823875370442', '-89.46603722290041', 'destino_mapa', 'AGENCIA DE EXTENCION CENTA MAG', 'KM.36 CARRETERA LITORAL LA LIBERTAD', '0');
INSERT INTO `vyp_rutas` VALUES ('13', '00024', '00000', '00005', '00088', '26.30', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/SACACOYO', '', '', 'destino_municipio', 'ISSS ATEOS', 'KM. 31 CACACACCAA', '0');
INSERT INTO `vyp_rutas` VALUES ('14', '00020', '00000', '00014', '00260', '45.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.62553009402688', '-87.89099518264925', 'destino_mapa', ' LABORATORIO CLÍNICO DELMER', 'C°J CLAROS, N°20, B° EL CALVARIO, SANTA ROSA DE LIMA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('15', '00020', '00000', '00014', '00260', '45.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.62553009402688', '-87.89099518264925', 'destino_mapa', 'LIBRERIA Y VARIEDADES SANDRA', 'CALLE GENERAL GIRON, BARRIO EL CALVARIO', '0');
INSERT INTO `vyp_rutas` VALUES ('16', '00024', '00000', '00005', '00084', '28.30', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/LA LIBERTAD', '', '', 'destino_municipio', 'AGENCIA DE EXTENCION MAG', 'KM, 36 CARR. EL LITORAL', '0');
INSERT INTO `vyp_rutas` VALUES ('17', '00020', '00000', '00014', '00258', '37.68', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SAN ALEJO', '', '', 'destino_municipio', 'RUTA DE BUS 421, TRANSPORTE SANTA CRUZ', 'CANTON SANTA CRUCITA, ', '0');
INSERT INTO `vyp_rutas` VALUES ('18', '00020', '00000', '00014', '00258', '21.23', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SAN ALEJO', '13.431494035127976', '-87.95996247287746', 'destino_mapa', 'RUTA DE BUS 421 TRANSPORTE SANTA CRUZ', 'CANTON SANTA CRUCITA, ', '0');
INSERT INTO `vyp_rutas` VALUES ('19', '00020', '00000', '00014', '00260', '21.23', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.431494035127976', '-87.95996247287746', 'destino_mapa', 'MOTO MAQUINARIA', 'CARRETERA RUTA MILITAR COLONIA ALTOS DEL ESTADIO NUMERO 1 ', '0');
INSERT INTO `vyp_rutas` VALUES ('20', '00020', '00000', '00014', '00258', '15.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SAN ALEJO', '13.39924448728051', '-87.93404785068844', 'destino_mapa', 'RUTA 421B TRANSPORTES SANTA CRUZ', 'CANTON SANTA CRUCITA,SAN ALEJO, LA UNION,  EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('21', '00020', '00000', '00014', '00258', '15.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SAN ALEJO', '13.39924448728051', '-87.93404785068844', 'destino_mapa', 'RUTA 421B TRANSPORTE SANTA  CRUZ', 'CANTON SANTA CRUCITA SAN ALEJO LA UNION, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('22', '00020', '00000', '00014', '00260', '15.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.39924448728051', '-87.93404785068844', 'destino_mapa', 'MOTO MAQUINARIA', 'CARRETERA RUTA MILIATAR, COLONIA ALTOS DEL ESTADIO #1,SANTA ROSA DE LIMA , EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('23', '00022', '00000', '00002', '00013', '72.71', 'OFICINA CENTRAL - SANTA ANA/SANTA ANA', '14.0156369663512', '-89.53872308135033', 'destino_mapa', 'INTRADESA', 'CA 12N, SANTA ANA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('24', '00022', '00000', '00002', '00013', '67.70', 'OFICINA CENTRAL - SANTA ANA/SANTA ANA', '', '', 'destino_municipio', 'LENOR', 'ZONA FRANCA SANTA ANA CARRETERA A METAPAN', '0');
INSERT INTO `vyp_rutas` VALUES ('25', '00022', '00000', '00006', '00098', '35.90', 'OFICINA CENTRAL - SAN SALVADOR/AGUILARES', '', '', 'destino_municipio', 'CENTRO ESCOLAR CELSA PALACIOS', 'URBANIZACION CELSA PALACIOS KM 32 CARRETERA TRONCAL DEL NORTE', '0');
INSERT INTO `vyp_rutas` VALUES ('26', '00022', '00027', '00004', '00054', '82.95', 'OFICINA CENTRAL - OFICINA DEPARTAMENTAL DE CHALATENANGO', '14.2919778382226', ' -89.15987849235535', 'destino_oficina', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', 'OFICINA DEPARTAMENTAL DE CHALATENANGO', '0');
INSERT INTO `vyp_rutas` VALUES ('27', '00027', '00022', '00006', '00097', '82.95', 'OFICINA DEPARTAMENTAL DE CHALATENANGO - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('28', '00022', '00016', '00008', '00132', '65.10', 'OFICINA CENTRAL - OFICINA PARACENTRAL, LA PAZ', '13.50745798979771', ' -88.86813461780548', 'destino_oficina', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA PARACENTRAL, LA PAZ', '0');
INSERT INTO `vyp_rutas` VALUES ('29', '00016', '00022', '00006', '00097', '65.10', 'OFICINA PARACENTRAL, LA PAZ - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('30', '00022', '00000', '00010', '00163', '59.20', 'OFICINA CENTRAL - SAN VICENTE/SAN VICENTE', '', '', 'destino_municipio', 'CENTRO ESCOLAR PROFESOR JUSTO CARDOZA', 'FINAL 15 AV. SUR. PENITENCIARIA ORIENTAL, CIUDAD Y DEPTO. SAN VICENTE', '0');
INSERT INTO `vyp_rutas` VALUES ('31', '00022', '00000', '00006', '00097', '3.70', 'OFICINA CENTRAL - SAN SALVADOR/SAN SALVADOR', '', '', 'destino_municipio', 'SANTIAGO ABERLARDO PORTILLO ORTIZ', 'COLONIA FLOR BLANCA, 37 AVENIDA SUR, # 519', '0');
INSERT INTO `vyp_rutas` VALUES ('32', '00022', '00000', '00005', '00087', '34.30', 'OFICINA CENTRAL - LA LIBERTAD/SAN JUAN OPICO', '', '', 'destino_municipio', 'ZETA GAS DE EL SALVADOR, S.A. DE C.V.', 'KILOMETRO 35 ½ DESVIO A QUEZALTEPEQUE, CANTON SITIO DEL NIÑO', '0');
INSERT INTO `vyp_rutas` VALUES ('33', '00024', '00000', '00005', '00084', '27.65', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/LA LIBERTAD', '13.48595437190116', '-89.3129999696003', 'destino_mapa', 'MAG CENTA', 'CONCHALIO LA LIBERTAD', '0');
INSERT INTO `vyp_rutas` VALUES ('34', '00016', '00000', '00008', '00147', '32.00', 'OFICINA PARACENTRAL, LA PAZ - LA PAZ/SAN LUIS TALPA', '', '', 'destino_municipio', 'HIDALGO E HIDALGO', 'CARRETERA AL AEROPUERTO, SAN LUIS TALPA', '0');
INSERT INTO `vyp_rutas` VALUES ('35', '00020', '00000', '00014', '00258', '0.80', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SAN ALEJO', '13.33377607297217', '-87.85783019932126', 'destino_mapa', 'RUTA 121 B', 'CANTON SANTA CRUCITA, SAN ALEJO', '0');
INSERT INTO `vyp_rutas` VALUES ('36', '00020', '00000', '00014', '00260', '33.73', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.43013336593926', '-87.96267986429444', 'destino_mapa', 'MOTO MAQUINARIA', 'CARRETERRA  RUTA MILITAR, COLONIA ALTOS DEL ESTADIO, N° 1, SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('37', '00020', '00000', '00014', '00260', '39.05', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.589017340080963', '-87.83769442835421', 'destino_mapa', 'DON POLLO NUMERO 114 SANTA ROSA DE LIMA', 'CALLE GENRAL GIRON CASA #13, BARRIO EL CALVARIO, SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('38', '00020', '00000', '00014', '00260', '39.05', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.589017340080963', '-87.83769442835421', 'destino_mapa', 'FARMACIA SANTA MARIA #2 SANTA ROSA DE LIMA', 'CALLE GENRAL GIRON #1 SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('39', '00020', '00000', '00014', '00258', '35.18', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SAN ALEJO', '13.437312843856242', '-87.97246456278077', 'destino_mapa', 'RUTA DE BUSES 421 B', 'CANTON SANTA CRUCITA, SAN ALEJO, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('40', '00020', '00000', '00014', '00260', '39.05', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.589017340080963', '-87.83769442835421', 'destino_mapa', 'NIEVE ESMERALDA SALON', 'CALLE GENERAL GIRON L-2, BARRIO EL CALVARIO SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('41', '00020', '00000', '00014', '00260', '35.18', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.437312843856242', '-87.97246456278077', 'destino_mapa', 'MOTO MAQUINARIA', 'CARRETERA RUTA MILITAR, COLONIA ALTOS DEL ESTADIO # 1 SANTA ROSA DE LIMA, LA UNIÓN', '0');
INSERT INTO `vyp_rutas` VALUES ('42', '00032', '00022', '00006', '00097', '117.01', 'OFICINA DEPARTAMENTAL DE USULUTAN - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('43', '00022', '00032', '00011', '00176', '117.01', 'OFICINA CENTRAL - OFICINA DEPARTAMENTAL DE USULUTAN', '13.342817232157875', ' -88.43724436614099', 'destino_oficina', 'OFICINA DEPARTAMENTAL DE USULUTAN', 'OFICINA DEPARTAMENTAL DE USULUTAN', '0');
INSERT INTO `vyp_rutas` VALUES ('44', '00021', '00000', '00009', '00159', '40.10', 'OFICINA DEPARTAMENTAL DE CABAÑAS - CABAÑAS/JUTIAPA', '', '', 'destino_municipio', 'INVERSIONES PEÑATE PORTILLO S.A DE C.V.', ' CASERÍO CERRON GRANDE, CANTÓN SAN SEBASTIAN, JUTIAPA, CABAÑAS.', '0');
INSERT INTO `vyp_rutas` VALUES ('45', '00032', '00000', '00011', '00181', '35.90', 'OFICINA DEPARTAMENTAL DE USULUTAN - USULUTÁN/EL TRIUNFO', '', '', 'destino_municipio', 'AUTO HOTEL MUNDANI', 'CARRETERA PANAMERICANA KM 105, EL TRIUNFO, USULUTAN', '0');
INSERT INTO `vyp_rutas` VALUES ('46', '00032', '00000', '00011', '00177', '29.90', 'OFICINA DEPARTAMENTAL DE USULUTAN - USULUTÁN/ALEGRIA', '', '', 'destino_municipio', 'HOSTAL ENTREPIEDRAS', 'CALLE EL CENTRO, ALEGRIA, USULUTAN', '0');
INSERT INTO `vyp_rutas` VALUES ('47', '00020', '00000', '00014', '00260', '43.62', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.628112456364123', '-87.87734884765024', 'destino_mapa', 'AGROFERRETERIA SANTA CLARA', 'CARRETERA RUTA MILITAR, LOTE N°2, LOTIFICACION UNIVERSAL,FRENTE A MAG, SANTA ROSA DE LIMA EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('48', '00020', '00000', '00014', '00260', '43.62', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.628112456364123', '-87.87734884765024', 'destino_mapa', 'GALVANISSA', 'CARRETERA RUTA MILITAR, KM182 Y1/2,SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('49', '00020', '00000', '00014', '00260', '48.46', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.61821509465913', '-87.88701436523439', 'destino_mapa', 'TIENDA FLOR DE MARIA', 'CALL RUTA MILITAR, COLONIA EL MAG, SANTA ROSA DE LIMA LA UNION, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('50', '00022', '00000', '00009', '00154', '81.70', 'OFICINA CENTRAL - CABAÑAS/SENSUNTEPEQUE', '', '', 'destino_municipio', 'OFICINA CENTRAL EN SAN SALVADOR', '5TA AVENIDA NORTE, CENTRO DE GOBIERNO, SENSUNTEPEQUE', '0');
INSERT INTO `vyp_rutas` VALUES ('51', '00022', '00014', '00012', '00199', '135.01', 'OFICINA CENTRAL - OFICINA REGIONAL DE ORIENTE', '13.478022085521037', ' -88.17572772502899', 'destino_oficina', 'OFICINA REGIONAL DE ORIENTE', 'OFICINA REGIONAL DE ORIENTE', '0');
INSERT INTO `vyp_rutas` VALUES ('52', '00014', '00022', '00006', '00097', '135.01', 'OFICINA REGIONAL DE ORIENTE - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('53', '00022', '00000', '00009', '00158', '54.80', 'OFICINA CENTRAL - CABAÑAS/ILOBASCO', '', '', 'destino_municipio', 'BOLSA DE EMPLEO', '1RA CALLE ORIENTE, ILOBASCO', '0');
INSERT INTO `vyp_rutas` VALUES ('54', '00024', '00000', '00005', '00077', '39.00', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/CHILTIUPAN', '', '', 'destino_municipio', 'HOTEL PURO SURF', 'PLAYA EL ZONTE, CHILTUIPAN', '0');
INSERT INTO `vyp_rutas` VALUES ('55', '00021', '00000', '00009', '00158', '31.10', 'OFICINA DEPARTAMENTAL DE CABAÑAS - CABAÑAS/ILOBASCO', '', '', 'destino_municipio', 'INSTITUTO NACIONAL DE ILOBASCO', 'SALIDA A PRESA CINCO DE NOVIEMBRE, BARRIO SAN SEBASTIAN, ILOBASCO, CABAÑAS', '0');
INSERT INTO `vyp_rutas` VALUES ('56', '00022', '00029', '00005', '00084', '36.80', 'OFICINA CENTRAL - CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', '13.483820353583399', ' -89.33640271425247', 'destino_oficina', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD', '0');
INSERT INTO `vyp_rutas` VALUES ('57', '00029', '00022', '00006', '00097', '36.80', 'CENTRO DE RECREACION DR. HUMBERTO ROMERO,LA LIBERTAD - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('58', '00024', '00000', '00005', '00075', '1.90', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/SANTA TECLA', '', '', 'destino_municipio', 'CASA PARTICULAR', 'RESIDENCIAL SAN RAFAEL', '0');
INSERT INTO `vyp_rutas` VALUES ('59', '00024', '00000', '00005', '00079', '11.20', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/COLON', '', '', 'destino_municipio', 'SIL', 'KM.24 CARRETERA A SONSONATE', '0');
INSERT INTO `vyp_rutas` VALUES ('60', '00024', '00000', '00005', '00087', '40.70', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/SAN JUAN OPICO', '', '', 'destino_municipio', 'INDUSTRIAS TALPA', 'ZONA INDUSTRIAL INTERCOMPLEX, KM.26Y1/2 CARRETERA A SANTA ANA', '0');
INSERT INTO `vyp_rutas` VALUES ('61', '00024', '00000', '00005', '00086', '23.70', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/QUEZALTEPEQUE', '', '', 'destino_municipio', 'SALCHEM', 'QUEZALTEPEQUE, ', '0');
INSERT INTO `vyp_rutas` VALUES ('62', '00016', '00021', '00009', '00154', '84.97', 'OFICINA PARACENTRAL, LA PAZ - OFICINA DEPARTAMENTAL DE CABAÑAS', '13.874632280768296', ' -88.63067706110564', 'destino_oficina', 'OFICINA DEPARTAMENTAL DE CABAÑAS', 'OFICINA DEPARTAMENTAL DE CABAÑAS', '0');
INSERT INTO `vyp_rutas` VALUES ('63', '00021', '00016', '00008', '00132', '84.97', 'OFICINA DEPARTAMENTAL DE CABAÑAS - OFICINA PARACENTRAL, LA PAZ', '13.50745798979771', ' -88.86813461780548', 'destino_oficina', 'OFICINA PARACENTRAL, LA PAZ', 'OFICINA PARACENTRAL, LA PAZ', '0');
INSERT INTO `vyp_rutas` VALUES ('64', '00032', '00000', '00011', '00184', '18.60', 'OFICINA DEPARTAMENTAL DE USULUTAN - USULUTÁN/JIQUILISCO', '13.360448688060501', '-88.58082269886063', 'destino_mapa', 'ALCALDIA MUNICIPAL DE JIQUILISCO', 'CALLE FABIO GUERRERO N°1, JIQUILISCO USULUTÁN', '0');
INSERT INTO `vyp_rutas` VALUES ('65', '00023', '00000', '00007', '00125', '17.50', 'OFICINA DEPARTAMENTAL DE CUSCATLAN - CUSCATLÁN/SAN PEDRO PERULAPAN', '', '', 'destino_municipio', 'ACMASA', 'CASERIO EL LLANO. CANTON TECOLUCO.', '0');
INSERT INTO `vyp_rutas` VALUES ('66', '00015', '00022', '00006', '00097', '67.21', 'OFICINA REGIONAL DE OCCIDENTE - OFICINA CENTRAL', '13.705537711909635', ' -89.20028731226921', 'destino_oficina', 'OFICINA CENTRAL', 'OFICINA CENTRAL', '0');
INSERT INTO `vyp_rutas` VALUES ('67', '00022', '00015', '00002', '00013', '67.21', 'OFICINA CENTRAL - OFICINA REGIONAL DE OCCIDENTE', '13.995904771596313', ' -89.5583595714698', 'destino_oficina', 'OFICINA REGIONAL DE OCCIDENTE', 'OFICINA REGIONAL DE OCCIDENTE', '0');
INSERT INTO `vyp_rutas` VALUES ('68', '00022', '00000', '00005', '00095', '38.30', 'OFICINA CENTRAL - LA LIBERTAD/TEPECOYO', '', '', 'destino_municipio', 'RUTA 106 ( OFICINA ) ', 'CALLE PRINCIPAL, BARRIO CONCEPCIÓN, FRENTE A LA PNC', '0');
INSERT INTO `vyp_rutas` VALUES ('69', '00023', '00000', '00007', '00116', '0.50', 'OFICINA DEPARTAMENTAL DE CUSCATLAN - CUSCATLÁN/COJUTEPEQUE', '', '', 'destino_municipio', 'MINISTERIO DE TRABAJO ', 'CALLE FRANCISCO LIOPEZ #16.', '0');
INSERT INTO `vyp_rutas` VALUES ('70', '00015', '00000', '00002', '00015', '15.20', 'OFICINA REGIONAL DE OCCIDENTE - SANTA ANA/CHALCHUAPA', '', '', 'destino_municipio', 'INGENIO LA MAGDALENA', 'CANTÓN EL COCO, CHALCHUAPA', '0');
INSERT INTO `vyp_rutas` VALUES ('71', '00015', '00032', '00011', '00176', '177.01', 'OFICINA REGIONAL DE OCCIDENTE - OFICINA DEPARTAMENTAL DE SONSONATE', '13.342817232157875', ' -88.43724436614099', 'destino_oficina', 'OFICINA DEPARTAMENTAL DE SONSONATE', 'OFICINA DEPARTAMENTAL DE SONSONATE', '0');
INSERT INTO `vyp_rutas` VALUES ('72', '00032', '00015', '00002', '00013', '177.01', 'OFICINA DEPARTAMENTAL DE SONSONATE - OFICINA REGIONAL DE OCCIDENTE', '13.995904771596313', ' -89.5583595714698', 'destino_oficina', 'OFICINA REGIONAL DE OCCIDENTE', 'OFICINA REGIONAL DE OCCIDENTE', '0');
INSERT INTO `vyp_rutas` VALUES ('73', '00015', '00019', '00003', '00026', '43.21', 'OFICINA REGIONAL DE OCCIDENTE - OFICINA DEPARTAMENTAL DE SONSONATE', '13.727994917510898', ' -89.71651872230689', 'destino_oficina', 'OFICINA DEPARTAMENTAL DE SONSONATE', 'OFICINA DEPARTAMENTAL DE SONSONATE', '0');
INSERT INTO `vyp_rutas` VALUES ('74', '00019', '00015', '00002', '00013', '43.21', 'OFICINA DEPARTAMENTAL DE SONSONATE - OFICINA REGIONAL DE OCCIDENTE', '13.995904771596313', ' -89.5583595714698', 'destino_oficina', 'OFICINA REGIONAL DE OCCIDENTE', 'OFICINA REGIONAL DE OCCIDENTE', '0');
INSERT INTO `vyp_rutas` VALUES ('75', '00022', '00000', '00004', '00042', '86.00', 'OFICINA CENTRAL - CHALATENANGO/CHALATENANGO', '', '', 'destino_municipio', 'HOTEL LA POSADA DEL JEFE', 'BARRIO EL CALVARIO, FINAL CALLE MORAZAN', '0');
INSERT INTO `vyp_rutas` VALUES ('76', '00022', '00000', '00006', '00099', '15.70', 'OFICINA CENTRAL - SAN SALVADOR/APOPA', '', '', 'destino_municipio', 'TAQUERIA MEXICANA TA QUE PICA', '1ª AVENIDA NORTE', '0');
INSERT INTO `vyp_rutas` VALUES ('77', '00022', '00000', '00004', '00059', '70.60', 'OFICINA CENTRAL - CHALATENANGO/NUEVA CONCEPCION', '', '', 'destino_municipio', 'TIENDA BELEN', 'BARRIO EL ROSARIO, 1ª AVENIDA NORTE', '0');
INSERT INTO `vyp_rutas` VALUES ('78', '00020', '00000', '00014', '00245', '60.19', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/LA UNION', '13.72634698272508', '-87.8565287345337', 'destino_mapa', 'PIZZERIA & RESTAURANTE THREE FLAG´S', 'EDIFICIO SUR CENTRO, BARRIO NUEVO CONTIGUO A INSTITUTO NACIONAL, ANAMOROS', '0');
INSERT INTO `vyp_rutas` VALUES ('79', '00020', '00000', '00014', '00246', '60.19', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/ANAMOROS', '13.72634698272508', '-87.8565287345337', 'destino_mapa', 'RANCHO EL TOROGOZ', 'COLONIA NUEVA FRENTE A CENTRO ESCOLAR ANAMOROS, ANAMOROS, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('80', '00020', '00000', '00014', '00260', '45.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.61445648276308', '-87.87809375728762', 'destino_mapa', 'BANCO AZTECA AGENCIA SANTA ROSA DE LIMA', 'CARRETERA DESCONOCIDA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('81', '00020', '00000', '00014', '00260', '45.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.61445648276308', '-87.87809375728762', 'destino_mapa', 'BANCO AZTECA AGENCIA SANTA ROSA DE LIMA', 'CALLE GIRON BARRIO EL CALVARIO SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('82', '00020', '00000', '00014', '00260', '45.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.61445648276308', '-87.87809375728762', 'destino_mapa', 'CELULAR BOUTIQUE SANTA ROSA #2', 'CALLE GENERAL GIRON NUMERO 8, BARRIO EL CALVARIO SANTA ROSA DE LIMA, LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('83', '00020', '00000', '00014', '00260', '45.31', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.61445648276308', '-87.87809375728762', 'destino_mapa', 'FARMACIAS BRASIL #19', 'CALLE GIRON Y PRIMERA AVENIDA NORTE LOCAL #8, BARRIO EL CALVARIO SANTA ROSA DE LIMA', '0');
INSERT INTO `vyp_rutas` VALUES ('84', '00020', '00000', '00014', '00260', '46.22', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.6230311428987', '-87.89467892128778', 'destino_mapa', 'ACOPALIN', 'CALLE RUTA MILITAR, BARRIO LA ESPERANZA, SALIDA A SAN MIGUEL, RN 18E, SANTA ROSA DE LIMA, EL SALVADOR', '0');
INSERT INTO `vyp_rutas` VALUES ('85', '00020', '00000', '00014', '00260', '46.22', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.6230311428987', '-87.89467892128778', 'destino_mapa', 'ESTACIÓN DE SERVICIO PETROIN', 'CALLE RUTA MILITAR,SALIDA A SAN MIGUEL, SANTA ROSA DE LIMA LA UNION', '0');
INSERT INTO `vyp_rutas` VALUES ('86', '00020', '00000', '00014', '00260', '46.22', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/SANTA ROSA DE LIMA', '13.6230311428987', '-87.89467892128778', 'destino_mapa', 'MARMOLERIA MARQUEZ MONGE', 'KILOMETRO 179,CALLE RUTA MILITAR, COSTADO SUR, PONIENTE DEL ESTADIO, SANTA ROSA DE LIMA LA UNIION', '0');
INSERT INTO `vyp_rutas` VALUES ('87', '00024', '00000', '00005', '00078', '41.70', 'OFICINA DEPARTAMENTAL DE LA LIBERTAD - LA LIBERTAD/CIUDAD ARCE', '', '', 'destino_municipio', 'UNIFI CENTRAL AMERICA LTDA DE CV ', 'KM 36 1/2 CARRETERA A SANTA ANA', '0');
INSERT INTO `vyp_rutas` VALUES ('88', '00020', '00000', '00014', '00246', '55.40', 'OFICINA DEPARTAMENTAL DE LA UNION - LA UNIÓN/ANAMOROS', '', '', 'destino_municipio', 'ESPECIAL PIZZA', 'CALLE PRINCIPAL, FRENTE A MONUMENTO MONSEÑOR ROMERO, ANAMORÓS, LA UNIÓN', '0');

-- ----------------------------
-- Table structure for `vyp_viatico_empresa_horario`
-- ----------------------------
DROP TABLE IF EXISTS `vyp_viatico_empresa_horario`;
CREATE TABLE `vyp_viatico_empresa_horario` (
  `id_viatico_empresa_horario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_empresa` int(10) unsigned NOT NULL,
  `id_horario` int(10) unsigned NOT NULL,
  `id_mision` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_viatico_empresa_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of vyp_viatico_empresa_horario
-- ----------------------------
INSERT INTO `vyp_viatico_empresa_horario` VALUES ('10', '1', '1', '1');
INSERT INTO `vyp_viatico_empresa_horario` VALUES ('11', '2', '2', '1');
INSERT INTO `vyp_viatico_empresa_horario` VALUES ('16', '4', '1', '2');
