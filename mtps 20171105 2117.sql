-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.16-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema mtps
--

CREATE DATABASE IF NOT EXISTS mtps;
USE mtps;

--
-- Definition of table `org_genero`
--

DROP TABLE IF EXISTS `org_genero`;
CREATE TABLE `org_genero` (
  `id_genero` varchar(5) NOT NULL,
  `genero` varchar(45) NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_genero`
--

/*!40000 ALTER TABLE `org_genero` DISABLE KEYS */;
INSERT INTO `org_genero` (`id_genero`,`genero`) VALUES 
 ('00001','MASCULINO'),
 ('00002','FEMENINO');
/*!40000 ALTER TABLE `org_genero` ENABLE KEYS */;


--
-- Definition of table `org_modulo`
--

DROP TABLE IF EXISTS `org_modulo`;
CREATE TABLE `org_modulo` (
  `id_modulo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_sistema` int(10) unsigned NOT NULL,
  `nombre_modulo` text NOT NULL,
  `descripcion_modulo` text,
  `orden` int(10) unsigned DEFAULT NULL,
  `dependencia` int(10) unsigned DEFAULT NULL,
  `url_modulo` text,
  `img_modulo` text,
  `opciones_modulo` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=319 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_modulo`
--

/*!40000 ALTER TABLE `org_modulo` DISABLE KEYS */;
INSERT INTO `org_modulo` (`id_modulo`,`id_sistema`,`nombre_modulo`,`descripcion_modulo`,`orden`,`dependencia`,`url_modulo`,`img_modulo`,`opciones_modulo`) VALUES 
 (1,1,'FACTURAS','',1,0,'mod=facturas&secc=guardar',NULL,NULL),
 (2,1,'PEDIDOS','',2,0,'mod=pedidos&secc=guardar',NULL,NULL),
 (3,1,'PRODUCTOS','',3,0,'mod=productos&secc=guardar',NULL,NULL),
 (4,1,'PROVEEDORES','',4,0,'mod=proveedores&secc=guardar',NULL,NULL),
 (5,1,'UNIDADES DE PRODUCTOS','',5,0,'mod=unidades de productos&secc=guardar',NULL,NULL),
 (6,1,'REPORTES','',6,0,'mod=reportes',NULL,NULL),
 (7,1,'FUENTES DE FONDO','',7,0,'mod=fuentes de fondo&secc=guardar',NULL,NULL),
 (8,1,'OBJETO ESPECIFICO','',8,0,'mod=objeto especifico&secc=guardar',NULL,NULL),
 (9,1,'PERFIL','',10,0,'mod=perfil',NULL,NULL),
 (10,1,'CORTE','',9,0,'mod=corte&secc=guardar',NULL,NULL),
 (11,2,'SISTEMAS','',1,0,'mod=sistemas&secc=guardar',NULL,NULL),
 (12,2,'MODULOS','',2,0,'mod=modulos&secc=guardar',NULL,NULL),
 (13,2,'ROLES','',3,0,'mod=roles&secc=guardar',NULL,NULL),
 (14,2,'PERMISOS','',4,0,'mod=permisos&secc=guardar',NULL,NULL),
 (15,2,'USUARIOS','',5,0,'mod=usuarios&secc=guardar',NULL,NULL),
 (16,2,'USUARIO ROL','',6,0,'mod=usuario rol&secc=guardar',NULL,NULL),
 (17,2,'SECCIONES','',7,0,'mod=secciones&secc=guardar',NULL,NULL),
 (18,1,'CONTEO FISICO','',11,0,'mod=conteo fisico&secc=guardar',NULL,NULL),
 (19,3,'CATALOGOS',NULL,1,0,NULL,NULL,NULL),
 (20,3,'CUENTAS CONTABLES',NULL,1,19,'mod=cuentas contables&secc=guardar',NULL,NULL),
 (21,3,'CATEGORIAS',NULL,2,19,'mod=categorias&secc=guardar',NULL,NULL),
 (22,3,'SUB CATEGORIAS',NULL,3,19,'mod=sub categorias&secc=seleccionar',NULL,NULL),
 (23,3,'MOVIMIENTOS',NULL,4,19,'mod=movimientos&secc=guardar',NULL,NULL),
 (24,3,'OFICINAS',NULL,5,19,'mod=oficinas&secc=guardar',NULL,NULL),
 (25,3,'ALMACENES',NULL,6,19,'mod=almacenes&secc=guardar',NULL,NULL),
 (26,3,'MARCAS',NULL,7,19,'mod=marcas&secc=guardar',NULL,NULL),
 (27,3,'DOCUMENTOS',NULL,8,19,'mod=documentos&secc=guardar',NULL,NULL),
 (28,3,'CONDICION',NULL,9,19,'mod=condicion&secc=guardar',NULL,NULL),
 (29,3,'PROYECTOS',NULL,10,19,'mod=proyectos&secc=guardar',NULL,NULL),
 (30,3,'REGISTRO',NULL,2,0,NULL,NULL,NULL),
 (31,3,'DATOS COMUNES',NULL,1,30,'mod=datos comunes&secc=guardar',NULL,NULL),
 (32,3,'COD ACTIVOS',NULL,2,30,'mod=cod activos&secc=guardar',NULL,NULL),
 (33,3,'COD TERRENOS Y EDIF',NULL,3,30,'mod=cod terrenos y edif&secc=guardar',NULL,NULL),
 (34,3,'REG MOVIMIENTOS',NULL,5,30,'mod=reg movimientos&secc=guardar',NULL,NULL),
 (35,3,'REPORTES',NULL,3,0,'mod=reportes',NULL,NULL),
 (36,3,'PERFIL',NULL,4,0,'mod=perfil',NULL,NULL),
 (37,3,'COD AUTOMOVILES',NULL,4,30,'mod=cod autos&secc=guardar',NULL,NULL),
 (38,4,'PERSONAL','Registro de información personal',0,0,'mod=personal&secc=guardar&ses=0',NULL,NULL),
 (39,4,'EXPEDIENTES','Registro de información laboral del empleado',1,0,'blank',NULL,NULL),
 (40,4,'CAPACITACION','Menú principal de capacitaciones',2,0,'blank',NULL,NULL),
 (41,4,'CAPACITACIONES','Registro de capacitaciones',3,40,'mod=capacitaciones&secc=guardar',NULL,NULL),
 (42,4,'CAPACITADORES','Registro de personal del MTPS que imparte capacitaciones',4,40,'mod=capacitadores&secc=guardar',NULL,NULL),
 (43,4,'CATALOGOS','Menú principal de catálogos SFERH',5,0,'blank.php',NULL,NULL),
 (44,4,'NIVEL ACADEMICO','Registro de niveles academicos',6,43,'mod=nivel academico&secc=guardar',NULL,NULL),
 (45,4,'DOCUMENTOS','Catalogo de tipos de documentos usados en RRHH',7,43,'mod=documentos&secc=guardar',NULL,NULL),
 (46,4,'LICENCIAS','Catalogo de tipos de licencias usada en RRHH',8,43,'mod=licencias&secc=guardar',NULL,NULL),
 (47,4,'CARGOS FUNCIONALES','Catalogo de cargos funcionales en RRHH',9,43,'mod=cargos funcionales&secc=guardar',NULL,NULL),
 (48,4,'CARGOS NOMINALES','Catalogo de cargos nominales usados en RRHH',10,43,'mod=cargos nominales&secc=guardar',NULL,NULL),
 (49,4,'REPORTES','Listado de reportes que se pueden generar en RRHH',11,0,'mod=reportes',NULL,NULL),
 (50,4,'EXPEDIENTE','Información general del expediente del empleado, se considera a futuro el registro de información del expediente (ubicación física u otros)',12,39,'mod=expediente&secc=lista',NULL,NULL),
 (51,4,'LABORAL','Registro de información laboral del empleado',13,39,'mod=laboral&secc=guardar',NULL,NULL),
 (52,4,'LICENCIA','Registro de las licencias del empleado',14,39,'mod=licencia&secc=guardar',NULL,NULL),
 (53,4,'TITULOS','Registro de títulos del empleado ',15,39,'mod=titulos&secc=guardar',NULL,NULL),
 (54,4,'FAMILIARES','Registro de familiares del empleado',16,39,'mod=familiares&secc=guardar',NULL,NULL),
 (55,4,'RECORD','Registro del record del personal',17,39,'mod=record&secc=lista',NULL,NULL),
 (56,4,'PERFIL','Cambio de credenciales',19,0,'mod=perfil',NULL,NULL),
 (57,3,'PROVEEDORES',NULL,11,19,'mod=proveedores&secc=guardar',NULL,NULL),
 (59,4,'BENEFICIOS','',18,0,'',NULL,NULL),
 (60,4,'ARTICULOS','Vinculación de beneficios',21,59,'mod=articulos&secc=guardar',NULL,NULL),
 (61,4,'BENEFICIOS','Registro de beneficios',20,59,'mod=beneficios&secc=guardar',NULL,NULL),
 (62,4,'ASIGNACION','Registro de benficios a empleados',22,59,'mod=asignacion&secc=guardar',NULL,NULL),
 (63,3,'ACTA DESCARGO','registro de descargos',6,30,'mod=acta descargo&secc=guardar',NULL,NULL),
 (64,5,'Gestión de Transporte','Registro de solicitudes de Misiones Oficiales',1,NULL,'NULL','transporte.png',4),
 (65,5,'Crear solicitud de Misión Oficial','Ingreso de nueva solicitud de prestamo vehicular',1,64,'transporte/solicitud','',4),
 (66,5,'Control de solicitudes','Aprobar/Rechazar solicitudes hechas por los usuarios',2,64,'transporte/control_solicitudes','',3),
 (67,5,'Ver solicitudes','Ver el estado actual de las solicitudes hechas',3,64,'transporte/ver_solicitudes','',4),
 (68,5,'Asignación de vehículo/motorista','Establecer el vehículo y motorista a utilizar en una Misión Oficial',4,64,'transporte/asignar_vehiculo_motorista','',3),
 (69,5,'Ingreso de vales de combustible','Ingreso de vales de combustible',1,76,'vales/ingreso_vales','',2),
 (70,5,'Control de salidas/entradas','Registro del estado inicial y final del vehículo',5,64,'transporte/control_salidas_entradas','',3),
 (71,5,'Reportes y formularios','Consolidado de datos para exportación a hoja electronica/pdf',6,64,'NULL','',4),
 (72,5,'Solicitud de Misión Oficial','Exportación a pdf de una solicitud',1,71,'transporte/reporte_solicitud','',4),
 (73,5,'Control de salidas/entradas','Exportación a hoja electrónica/pdf de los movimientos de los vehículos',2,71,'transporte/reporte_salidas_entradas','',3),
 (74,5,'Bitácora de vehículos','Exportación a hoja electrónica/pdf de los movimientos del historial de viajes por vehículo',3,71,'transporte/bitacora_vehiculos','',3),
 (75,5,'Rediminiento vehicular','Exportación a hoja electrónica/pdf del rendimiento por combustible de los vehículos',4,71,'transporte/reporte_vehicular','',3),
 (76,5,'Vales de Combustible','Registro y Asignación de vales de combustible',2,NULL,'NULL','vales.png',3),
 (77,5,'Cerrar Sesión','Salir del Sistema',6,NULL,'sessiones/cerrar_session','cerrar.png',1),
 (78,5,'Mantenimiento Vehicular','Lo relacionado al mantenimiento de vehiculos',3,NULL,'NULL','mantenimiento.png',2),
 (79,5,'Control de vehículos','Gestión de vehículos ',3,78,'vehiculo/vehiculos',NULL,2),
 (80,5,'Control de presupuestos','Gestión de presupuestos',1,78,'vehiculo/presupuestos',NULL,2),
 (81,5,'Requisición de combustible','Ingreso de solicitud de combustible',2,76,'vales/ingreso_requisicion','',3),
 (82,5,'Comsumo de combustible','Control de consumo diario de combustible',5,76,'vales/ingreso_consumo','',3),
 (83,5,'Usuarios','Control de usuarios y roles',4,NULL,'NULL','user.png',1),
 (84,5,'Control de roles','Creación, modificación y eliminacón de roles',1,83,'usuarios/roles','',1),
 (85,5,'Control de usuarios','Creación, modificación y eliminacón de usuarios',2,83,'usuarios/usuario','',1),
 (86,5,'Autorizar Requisiciones','Muestra las requisiciones con visto bueno',3,76,'vales/autorizacion','',1),
 (87,5,'Entrega de Vales','Muestra las requisiciones autorizadas para que puedan ser entregadas',4,76,'vales/entrega','',1),
 (88,5,'Asignaciones de Vales','Permite modificar, agregar o eliminar las asignaciones de vales ',3,110,'vales/asignaciones','',1),
 (89,5,'Ver requisiciones','Muestra es estado e informacion de la requisicion',4,113,'vales/ver_requisiciones','',3),
 (90,7,'Inicio','Dashboard de información del sistema',1,NULL,NULL,'fa fa-home',3),
 (91,7,'Reportes','Consolidado de datos para exportación a hoja electronica/pdf',6,NULL,NULL,'fa fa-file-text',1),
 (92,7,'Promociones','Reporte de promociones realizadas',1,91,'promocion/promociones','fa fa-caret-right',2),
 (93,7,'Promoción','Ingreso de toda la información relacionada a las empresas',2,NULL,NULL,'fa fa-building-o',2),
 (94,7,'Registrar empleador/a','Ingreso de la información básica de empleador',1,93,'promocion/general','fa fa-caret-right',1),
 (95,7,'Registrar promoción','Ingreso de la visita a lugar de trabajo',6,93,'promocion/ingreso','fa fa-caret-right',3),
 (96,7,'Programar visita','Asignación de visitas a empresas por promotores',4,93,'promocion/programa','fa fa-caret-right',3),
 (97,7,'Capacitación',NULL,3,NULL,NULL,'fa fa-group',2),
 (98,7,'Programar capacitación','Programar capacitación de lugares de trabajo',2,97,'acreditacion/capacitacion','fa fa-caret-right',3),
 (99,7,'Control asistencia','Regsitro de asistencia a capacitaciones',3,97,'acreditacion/asistencia','fa fa-caret-right',3),
 (100,7,'Acreditación',NULL,4,NULL,NULL,'glyphicon glyphicon-check',2),
 (101,7,'Verificación',NULL,5,NULL,NULL,'fa fa-th-list',2),
 (102,7,'Programar visita','Asignación de visitas a lugares de trabajo',2,101,'verificacion/programa','fa fa-caret-right',3),
 (103,7,'Ingreso de control de visita','Verificación de cumpliemiento de capacitación',3,101,'verificacion/ingreso','fa fa-caret-right',3),
 (104,7,'Usuarios','Control de usuarios y roles',6,NULL,NULL,'glyphicon glyphicon-user',1),
 (105,7,'Control de roles','Creación, modificación y eliminacón de roles',1,104,'usuarios/roles','fa fa-caret-right',1),
 (106,7,'Control de usuarios','Creación, modificación y eliminacón de usuarios',2,104,'usuarios/usuario','fa fa-caret-right',1),
 (107,7,'Registrar lugares de trabajo','Ingreso de la información básica de lugares de trabajo',2,93,'promocion/lugares_trabajo','fa fa-caret-right',1),
 (108,7,'Registrar participantes','Ingreso de empleados de lugares de trabajo que asistirán a capacitación',1,97,'acreditacion/participantes','fa fa-caret-right',2),
 (109,7,'Ver asignaciones','Calendarización de visitas a lugares de trabajo',5,93,'promocion/ver_asignaciones','fa fa-caret-right',3),
 (110,5,'Estado y Mantenimiento','Muestra el estado de los vales y requisiciones, asi como tambiem mantenimiento de datos para el sistema',6,76,'NULL','',3),
 (111,5,'Estado de Vales','Muestra la cantidad de vales con los que se cuenta',1,110,'vales/estado','',3),
 (112,5,'Herramientas','Creación, modicación y eliminacion de herramientas que consumen combustible',2,110,'vales/herramientas','',3),
 (113,5,'Informes','Muestra informes del consumo de vales de combustible',6,76,'NULL','',3),
 (114,5,'Consumo de vales y asignacion ','Muestra un informe de consumo de vales en comparación con lo asignado',1,113,'vales/reporte_consumo','',3),
 (115,5,'Consumo por vehiculo','Muestra el consumo por vehiculo',2,113,'vales/reporte_vehiculo','',3),
 (116,5,'Control de Vehículos en Taller Interno','Gestiona el proceso de los vehículos en el taller interno',4,78,'vehiculo/control_taller',NULL,2),
 (117,5,'Bodega','Inventario de los árticulos disponibles en bodega',2,78,'vehiculo/bodega',NULL,1),
 (118,5,'Control de Vehículos en Taller Externo','Gestiona el proceso de los vehículos en taller externo',5,78,'vehiculo/control_taller_ext',NULL,2),
 (119,5,'Fuentes de fondos','Gestionar fuente de fondo',7,110,'vales/fuente_fondos','',1),
 (123,5,'Consumo Historico','Muestra el consumo historico por vehiculo',3,113,'vales/reporte_historico','',3),
 (124,5,'Asignación de vehiculos','Asignación de vehiculos a una sección de consumo',4,110,'vales/asignacion_vehiculo','',1),
 (125,7,'Registrar comité','Registro de conformación de comité',1,100,'acreditacion/registrar_comite','fa fa-caret-right',2),
 (126,7,'Aprobar proceso de acreditaciones','Aprobación del registro de conformación de comité',2,100,'acreditacion/aprobar_comite','fa fa-caret-right',2),
 (127,7,'Imprimir acreditación','Impresión de acreditaciones válidadas ',3,100,'acreditacion/imprimir_acreditacion','fa fa-caret-right',2),
 (128,7,'Capacitaciones','Reporte de capacitaciones ',2,91,'acreditacion/capacitaciones','fa fa-caret-right',2),
 (129,7,'Acreditaciones','Reporte de acreditaciones',3,91,'acreditacion/acreditaciones','fa fa-caret-right',2),
 (130,7,'Verificaciones','Reporte de verificaciones',4,91,'verificacion/verificaciones','fa fa-caret-right',2),
 (131,5,'Asignacion y Entrega ','Reporte de asignación y entrega de vales',4,113,'vales/reporte_asignacion',NULL,1),
 (132,7,'Asignar visita','Asignación de visitas a empresas por promotores',3,93,'promocion/asignacion','fa fa-caret-right',2),
 (133,7,'Asignar visita','Asignación de visitas a empresas por promotores',1,101,'verificacion/asignacion','fa fa-caret-right',2),
 (134,7,'Informe mensual','Resumen del informe mensual de las actividades realizadas',6,91,'inicio/informe_mensual','fa fa-caret-right',2),
 (135,5,'Perfil','Ver informacion de usuario y cambiar clave',5,NULL,'usuarios/perfil','user.png',4),
 (136,5,'Informes','Generar informes del área de mantenimiento vehicular',6,78,'NULL',NULL,2),
 (137,5,'Ver facturas','Administración de facturas',5,110,'vales/ver_facturas',NULL,3),
 (138,5,'Liquidacion de combustible','Ver reporte de liquidacion de combustible mensual',4,113,'vales/reporte_liquidacion',NULL,3),
 (139,8,'NOTICIASOFERTAS',NULL,0,0,NULL,NULL,NULL),
 (140,5,'Gasolineras','Gestionar gasolineras',7,110,'vales/gasolineras','',1),
 (141,5,'Kardex de artículos','Genera un Kardex de los artículos',2,136,'vehiculo/kardex_articulo',NULL,1),
 (142,5,'Mantenimientos','Genera un informe estadístico de los mantenimientos realizados a los vehículo',3,136,'vehiculo/reporte_mantenimientos',NULL,2),
 (143,5,'Hoja de control por vehículo','Genera la hoja de reparación y mantenimiento en Taller Interno',4,136,'vehiculo/hoja_control_vehiculo',NULL,1),
 (144,5,'Hoja de control de encargado de mantenimiento','Generar hoja de control de encargado de mantenimiento por vehículo',1,136,'vehiculo/hoja_mtto_preventivo',NULL,2),
 (145,7,'Incumplimiento de LGPRLT','Reporte de incumplimientos de LGPRLT',5,91,'inicio/incumplimiento_LGPRLT','fa fa-caret-right',2),
 (146,9,'Capacitaciones','Gestionar capacitaciones y programar las mismas',2,NULL,'','fa fa-group icon-sidebar',1),
 (147,9,'Factores','Gestionar factores  a evaluar',3,NULL,'factores','fa fa-flask icon-sidebar',1),
 (148,9,'Perfiles de evaluación','Gestionar criterios de evaluación para una determinada categoría de empleados y empleadas',4,NULL,'factores/perfiles','fa fa-edit icon-sidebar',1),
 (149,9,'Evaluación','Gestionar todo lo relacionado a la evaluacion',5,NULL,'','fa fa-bar-chart-o icon-sidebar',1),
 (150,9,'Asignación','Asignación de personas que evaluarán y empleados correspondientes',2,149,'evaluacion/asignacion','',3),
 (151,9,'Realizar evaluación','Realizar evaluaciones del personal',3,149,'evaluacion/realizar','',3),
 (152,9,'Gestionar capacitaciones','Gestionar capacitaciones sugeridas al final de la  evaluacion',2,146,'capacitacion/lista','',1),
 (153,9,'Programar capacitaciones','Programar las capacitaciones mas solicitadas',3,146,'capacitacion/programacion','',1),
 (154,9,'Inconformidades','Revisión de evaluaciones',4,149,'evaluacion/inconformes','',1),
 (155,9,'Inicio','Información general del sistema',1,NULL,'inicio/','fa fa-dashboard icon-sidebar',3),
 (156,9,'Reportes','Ver reportes del sistema',6,NULL,NULL,'fa fa-file-text icon-sidebar',1),
 (157,9,'Gestionar áreas','Gestionar áreas de capacitaciones',1,146,'capacitacion/areas','',1),
 (158,9,'Ediciones de evaluación','Gestionar ediciones de evaluación y perfiles de evaluacion',1,149,'evaluacion/ediciones','',1),
 (159,5,'Presupuestos','Genera los informes referentes a los presupuestos',5,136,'vehiculo/reporte_presupuesto',NULL,1),
 (166,9,'Capacitaciones','Muestra las capacitaciones solicitadas por oficina',1,156,'reportes/capacitaciones',NULL,1),
 (168,10,'Inicio','Dashboard de información del sistema',1,NULL,NULL,'fa fa-home',3),
 (169,10,'Plan Estratégico Institucional',NULL,2,NULL,NULL,'fa fa-file',1),
 (170,10,'Plan Anual de Trabajo',NULL,3,NULL,NULL,'fa fa-flag',3),
 (171,10,'Monitorieo de Planificación',NULL,4,NULL,NULL,'fa fa-pencil',3),
 (172,10,'Usuarios','Control de usuarios y roles',6,NULL,NULL,'glyphicon glyphicon-user',1),
 (173,10,'Control de roles','Creación, modificación y eliminacón de roles',1,172,'usuarios/roles','fa fa-caret-right',1),
 (174,10,'Informe de Avance','Estado actual del desarrollo de las actividades',1,175,'reportes/avance',NULL,3),
 (175,10,'Reportes','Consolidado de datos para exportación a hoja electrónica/pdf',5,NULL,NULL,'fa fa-file-text',3),
 (176,10,'Configuración PEI','Configuración inicial del PEI',1,169,'pei/documento',NULL,1),
 (177,10,'Configuración PAT','Configuración inicial del PAT',1,170,'pat/configuracion',NULL,1),
 (178,10,'Validación PAT','Revisión y validación de las actividades del PAT',3,170,'pat/validacion',NULL,1),
 (179,10,'Control de cumplimiento PAT','Ingreso de cumplimiento de metas mensuales plasmadas en el PAT',1,171,'monitoreo/pat',NULL,3),
 (180,10,'Control PAT','Mantenimiento del PAT',2,170,'pat/cpat','',3),
 (181,10,'Control PEI','Mantenimiento del PEI',2,169,'pei/objetivos',NULL,1),
 (182,9,'Puntuaciones','Muestra las puntuaciones en diferentes clasificaciones',2,156,'reportes/por_niveles',NULL,1),
 (183,9,'Usuarios','Permite gestionar el acceso al sistema',7,NULL,NULL,'fa fa-user icon-sidebar',1),
 (184,9,'Enviar Contraseñas','Envia las contraseñas a los evaluadores',1,183,'usuarios/enviar_claves',NULL,1),
 (185,9,'Usuarios','Administrar usuarios',1,183,'usuarios/usuarios',NULL,1),
 (186,9,'Roles','Administrar roles',1,183,'usuarios/roles',NULL,1),
 (187,9,'No evaluados','Muestra las razones por la cual no fueron evaluados algunos empleados',3,156,'reportes/razones','',1),
 (188,11,'Usuarios','Control de Usuarios',1,NULL,'usuarios/usuario','usuarios.png',1),
 (189,11,'Roles','Control de Roles',2,NULL,'usuarios/roles','roles.png',1),
 (190,11,'Bitácora','Control la bitácora de los Sistemas',3,NULL,'seguridad/bitacora','bitacora.png',1),
 (191,11,'Base de Datos','Control de Base de Datos',4,NULL,'seguridad/base_datos','base.png',1),
 (192,11,'Cerrar Sesión','Salir del Sistema',5,NULL,'sessiones/cerrar_session','cerrar.png',1),
 (193,3,'CAMBIO DE PROYECTO','módulo para cambio de proyecto en bienes',7,30,'mod=cambio de proyecto&secc=guardar',NULL,NULL),
 (194,5,'Gasolina para vehiculos en taller','Habilita que se pueda depositar combustible a vehículos en taller',5,NULL,NULL,NULL,1),
 (195,13,'Productos','registro de productos',1,0,'','icon-price',1),
 (196,13,'Unidad Medida','registro de unidad medida para Bodega',1,195,'Bodega/Unidadmedidas','icon-unidad',4),
 (197,13,'Producto y Servicios','registro de productos para Bodega',2,195,'Bodega/Productos','icon-price',4),
 (198,13,'Especificos','registro de especificos para Bodega',3,195,'Bodega/Especificos','icon-especifico',4),
 (199,13,'Detalle Producto','registro de detalle Producto para Bodega',0,198,'Bodega/detalleProductos','',4),
 (200,13,'Facturas','registro de facturas',2,0,'','icon-file-text2',1),
 (201,13,'Proveedores','registro de proveedores para Bodega',2,200,'Bodega/Proveedores','icon-proveedores',4),
 (202,13,'Fuente de Fondos','registro de fuente de fondos para Bodega',3,200,'Bodega/Fuentefondos','icon-fuente',4),
 (203,13,'Factura','registro de facturas para Bodega',4,200,'Bodega/Factura','icon-factura',4),
 (204,13,'Detalle Factura','registro de detalle facturas para Bodega',0,203,'Bodega/Detallefactura','',4),
 (205,13,'Bodega','gestionar bodega',3,0,'','icon-database',1),
 (206,13,'Solicitudes','gention de solicitudes para Bodega',1,205,'','icon-solicitud',4),
 (207,13,'1-Solicitud de Bodega','registro de solicitudes para Bodega',1,206,'Bodega/Solicitud','icon-solicitud',4),
 (208,13,'Detalle Solicitud','registro de detalle Solicitud para Bodega',0,207,'Bodega/detalle_solicitud_producto','',4),
 (209,13,'3-Retiro','registro de retiros para Bodega',3,206,'Bodega/Retiro','icon-retiro',4),
 (210,13,'Detalle Retiro','registro de detalle retiro para Bodega',0,209,'Bodega/detalle_retiro','',4),
 (211,13,'2-Control Solicitud','Control Solicitud para Bodega',2,206,'Bodega/Solicitud_control','icon-equalizer2',2),
 (212,13,'Detalle Solicitud Control','registro de detalle Solicitud Control para Bodega',0,211,'Bodega/detalle_solicitud_control','',4),
 (213,13,'Conteo Fisico','registro de conteo conteo fisico para Bodega',2,205,'Bodega/ConteoFisico','icon-pencil',4),
 (214,13,'Detalle Conteo','registro de detalle conteo para Bodega',0,213,'Bodega/DetalleConteo','',4),
 (215,13,'Reportes','registro de reportes para Bodega',3,205,'','icon-reporte',1),
 (216,13,'1-Generación KARDEX','generacion kardex peps para Bodega',1,215,'Bodega/kardex/ReporteKardex','icon-stats-dots',1),
 (217,13,'2-Inventario General','inventario general para Bodega',2,215,'Bodega/Kardex/ReporteGeneral','icon-calculator',1),
 (218,13,'3-Salidas y Saldos por OE ','salidas y saldos para Bodega',3,215,'Bodega/retiro/reporte','icon-upload',1),
 (219,13,'4-Proveedor, Factura y Especifico','Proveedor, Factura y Especifico para Bodega',4,215,'Bodega/Proveedores/Reporte','icon-proveedores',1),
 (220,13,'5-Gasto Global por Sección ','Gasto Global por Sección para Bodega',5,215,'Bodega/detalle_solicitud_producto/reporteGastoSeccion','icon-coin-dollar',1),
 (221,13,'6-Ingreso Global por Sección ','Ingreso Global por Sección para Bodega',6,215,'Bodega/factura/reporteIngresoSeccion','icon-download',1),
 (222,13,'7-Productos con lento movimiento','Productos con lento movimiento para Bodega',7,215,'Bodega/Productos/reporte','icon-hour-glass',1),
 (223,13,'8-Comparación Conteo Físico','comparación conteo físico para Bodega',8,215,'Bodega/ConteoFisico/Reporte','icon-pencil',1),
 (224,13,'9-Kardex Existencias Detallado','inventario general peps para Bodega',9,215,'Bodega/Kardex_Todos/ReporteKardex','icon-sphere',1),
 (225,13,'10-Kardex Resumido','kardex resumido para Bodega',10,215,'Bodega/Kardex_Todos/KardexResumido','icon-paragraph-left',1),
 (226,13,'Compras','gestionar compras',4,0,'','icon-compra',1),
 (227,13,'1-Solicitud de Compras','registro de solicitudes de compras',1,226,'Compras/Solicitud_Compra','icon-solicitud',4),
 (228,13,'Detalle Solicitud Compras','registro de detalle Solicitud de Compras',0,227,'Compras/Solicitud_Compra/Detalle_Solicitud_Compra','',4),
 (229,13,'Estado de solicitud de compras','Estado de solicitud de compras',0,227,'Compras/Estado_solicitud','',4),
 (230,13,'2-Aprobar Solicitud','Aprobar/Denegar solictudes compra',2,226,'Compras/Aprobar_Solicitud','icon-aprobar-compra',2),
 (231,13,'Aprobar Detalle Solicitud Compra ','registro de detalle Solicitud de compra',0,230,'Compras/Aprobar_Solicitud/Detalle_Solicitud_Compra','',4),
 (232,13,'5-Orden de Compras','registro de orden de compras',5,226,'Compras/Orden_Compra','icon-file-text2',4),
 (233,13,'Detalle Orden de Compras','registro de orden de compras',0,232,'Compras/Detalle_orden_compra','',4),
 (234,13,'3-Gestionar Solicitud','gestión de solicitudes por jefe de compras',3,226,'Compras/Gestionar_Solicitud','icon-equalizer2',4),
 (235,13,'Gestion Detalle Solicitud Compra ','registro de detalle Solicitud de compra',0,234,'Compras/Gestionar_Solicitud/Detalle_Solicitud_Compra','',4),
 (236,13,'6-Compromiso Presupuestario','registro de compromiso presupuestario',6,226,'Compras/Compromiso_Presupuestario','icon-compromiso',4),
 (237,13,'4-Solicitud Disponibilidad','registro de solicitud de disponibilidad financiera',4,226,'Compras/Solicitud_Disponibilidad','icon-disponibilidad',4),
 (239,13,'Activos Fijos','gestionar activos fijos',5,0,'','icon-office',1),
 (240,13,'Datos Comunes','gention de datos comunes de los bienes',1,239,'','icon-datos',4),
 (241,13,'Tipos de movimiento','registro de tipos de movimiento',1,240,'ActivoFijo/Tipo_movimiento','icon-cog',4),
 (242,13,'Marcas','registro de marcas',2,240,'ActivoFijo/Marcas','icon-stackoverflow',4),
 (243,13,'Documentos de amparo','registro de documentos de amparo',3,240,'ActivoFijo/Doc_ampara','icon-ampara',4),
 (244,13,'Cuentas Contables','Registro de cuentas contables',4,240,'ActivoFijo/Cuenta_Contable','icon-contable',4),
 (245,13,'Datos comunes','Registro de datos comunes de los bienes',5,240,'ActivoFijo/Datos_comunes','icon-comun',4),
 (246,13,'Codificación de bienes','gention de codificacion de bienes',2,239,'','icon-bien',4),
 (247,13,'Bienes muebles','registro de bienes muebles',1,246,'ActivoFijo/Bienes_muebles','icon-road',4),
 (248,13,'Bienes inmuebles','registro de bienes inmuebles',2,246,'ActivoFijo/Bienes_Inmuebles','icon-muebles',4),
 (249,13,'Categorías','registro de categorías',3,246,'ActivoFijo/Categoria','icon-list-numbered',4),
 (250,13,'Subcategorías','registro de Subcategorías',4,246,'ActivoFijo/Seleccion_categoria','icon-price',4),
 (251,13,'Registro de Subcategorías','registro de Subcategorías',0,250,'ActivoFijo/Subcategoria','',4),
 (252,13,'Condiciones del bien','registro de condiciones del bien',5,246,'ActivoFijo/Condicion_bien','icon-table',4),
 (253,13,'Institucionales','gention de catalogos institucionales',3,239,'','icon-stack',4),
 (254,13,'Oficinas','registro de oficinas',2,253,'ActivoFijo/Oficinas','icon-oficina',4),
 (255,13,'Almacenes','registro de Almacenes',3,253,'ActivoFijo/Almacenes','icon-floppy-disk',4),
 (256,13,'Procesos','gestion de procesos referentes a AF',4,239,'','icon-users',4),
 (257,13,'Movimientos','registro de movimientos',1,256,'ActivoFijo/Movimiento','icon-share',4),
 (258,13,'Detalle Movimiento','registro de detalle de movimiento',0,257,'ActivoFijo/Detalle_Movimiento','',4),
 (259,13,'Reportes','Generar reportes para Activo Fijo',5,239,'','icon-reporte',1),
 (260,13,'1-Bienes por usuario','generacion de reporte bienes por usuario',1,259,'ActivoFijo/Reportes/Bienes_por_usuario/reporte','icon-user',1),
 (261,13,'2-Bienes por Unidad','generacion de reporte bienes por unidad',2,259,'ActivoFijo/Reportes/Bienes_por_unidad/reporte','icon-make-group',1),
 (262,13,'3-Bienes por Proyecto','generacion de reporte bienes por proyecto',3,259,'ActivoFijo/Reportes/Bienes_por_proyecto/reporte','icon-fuente',1),
 (263,13,'4-Datos del bien','generacion de reporte datos del bien',4,259,'ActivoFijo/Reportes/Datos_del_bien/reporte','icon-comun',1),
 (264,13,'Historial de movimientos','Consultar el historial de movimientos del bien',0,263,'ActivoFijo/Reportes/Historial_movimientos','',1),
 (265,13,'5-Reporte General','generacion de reporte general',5,259,'ActivoFijo/Reportes/Reporte_general/reporte','icon-table',1),
 (266,13,'6- Reporte de Movimiento por Oficina','generacion ',6,259,'ActivoFijo/Reportes/Movimientos_por_oficina/Reporte','icon-share',1),
 (267,13,'7- Resumen Cuenta Contable','resumen de las cuentas contables ',7,259,'ActivoFijo/Reportes/Resumen_cuenta_contable/Reporte','icon-file-zip',1),
 (268,13,'Rastreabilidad','Reporte de rastreabilidad de los usuarios',6,0,'Rastreabilidad/reporte','icon-table',1),
 (269,13,'Usuario Rol','Registro de los usuarios con suus respectivos roles de SICBAF',7,0,'Usuario_Rol','icon-user',4),
 (270,13,'Reportes','Generar reportes Compras',7,226,NULL,'icon-reporte',1),
 (271,13,'1-Reporte Orden de Compra','Generar reporte de orden de compra por fechas',1,270,'Compras/Reportes/Reporte_orden_compra/reporte','icon-table',1),
 (272,13,'2-Reporte Disponibilidad Financiera','Generar reporte de solicitudes de disponibilidad finaciera por fechas',2,270,'Compras/Reportes/Reporte_solicitud_disponibilidad/reporteDisponibilidad','icon-coin-dollar',1),
 (273,13,'3-Reporte por linea presupuestaria','Generar reporte por linea presupuestaria',3,270,'Compras/Reportes/Reporte_linea_presupuestaria/reporte','icon-stats-dots',1),
 (275,13,'Equipo Informático','gestión de equipos informaticos',5,239,'','icon-display',4),
 (276,13,'Procesadores','registro de procesadores',1,275,'ActivoFijo/Procesador','icon-cogs',4),
 (277,13,'Discos Duros','registro de discos duros',2,275,'ActivoFijo/Disco_Duro','icon-drawer',4),
 (278,13,'Memorias','registro de memorias',3,275,'ActivoFijo/Memoria','icon-meter',4),
 (279,13,'Sistemas operativos','registro de versiones de sistemas operativos',4,275,'ActivoFijo/Sistema_operativo','icon-terminal',4),
 (280,13,'4-Reporte Solicitudes Denegadas','Generar reporte de solicitudes de compras denegadas por fechas',4,270,'Compras/Reportes/Reporte_solicitudes_denegadas/reporte','icon-cancel-circle',1),
 (281,13,'Office','registro de versiones de office',5,275,'ActivoFijo/Office','icon-files-empty',4),
 (282,13,'4-Solicitud + Retiro','ingresar solicitud, y realizar ell retiro de bodega directamente',4,206,'Bodega/Solicitud_retiro','icon-power',4),
 (283,13,'8- Reporte Depreciacion por Cuenta Contable','Reporte Depreciacion por Cuenta Contable',8,259,'ActivoFijo/Reportes/Depreciacion_cuenta_contable/reporte','icon-sort-amount-desc',1),
 (285,13,'Equipo informático\n','Registro de Equipo Informático',0,247,'ActivoFijo/Equipo_informatico','',4),
 (286,13,'Detalle de productos','registro de detalle Solicitud de disponibilidad financiera',0,237,'Compras/Detalle_Solicitud_Disponibilidad','',4),
 (287,13,'Detalle de montos','registro de detalle Solicitud de disponibilidad financiera',0,237,'Compras/Detalle_disponibilidad_montos','',4),
 (288,13,'Categoría proveedores','registro de categoria de proveedores para Bodega',1,200,'Bodega/Categoria_proveedor','icon-address-book',4),
 (289,13,'9- Reporte de Ingresos de Bienes Adquiridos','Detalle de bienes adquiridos en intervalos de fecha',9,259,'ActivoFijo/Reportes/Reporte_ingreso/reporte','icon-bienadquirido',1),
 (290,13,'10- Reporte Tipo Computadora','Detalle de bienes de categoria equipo informatico por tipo de computadora',10,259,'ActivoFijo/Reportes/Reporte_tipo_computadora/Reporte','icon-display',1),
 (291,13,'11- Reporte por Version de Sistema Operativo','Reporte por Version de Sistema Operativo',11,259,'ActivoFijo/Reportes/Reporte_sistema_operativo/Reporte','icon-terminal',1),
 (292,13,'12- Reporte por versión de office','Reporte por versión de office',12,259,'ActivoFijo/Reportes/Reporte_version_office/Reporte','icon-libreoffice',1),
 (293,13,'Detalle Orden de Compras Resumen','Registro de los productos que serviran como resumen del detalle de la OC',0,232,'Compras/Detalle_orden_resumen','',4),
 (294,13,'Detalle Proveedor','datos de los proveedores',0,201,'Bodega/DetalleProveedor','',4),
 (295,13,'Solicitud de movimientos','Ingreso de solicitud de movimientos',2,256,'ActivoFijo/Solicitud_movimiento','icon-solicitud',4),
 (296,13,'Detalle Solicitud Movimiento','ingreso de detalle solicitud de movimiento',0,295,'ActivoFijo/Detalle_solicitud_movimiento','',4),
 (297,13,'Aprobar movimiento','Aprobacion de solicitudes de movimientos',3,256,'ActivoFijo/Aprobar_movimiento','icon-aprobar-compra',4),
 (298,13,'Detalle Aprobar Movimiento','ingreso de detalle de aprobacion solicitud de movimiento',0,297,'ActivoFijo/Detalle_aprobar_movimiento','',4),
 (299,13,'Gestionar movimiento','Gestion de solicitudes de movimientos',5,256,'ActivoFijo/Gestionar_movimiento','icon-equalizer2',4),
 (300,13,'Detalle Gestionar Movimientos','gestion de  solicitudes de movimientos',0,299,'ActivoFijo/Detalle_gestionar_movimiento','',4),
 (301,13,'14- Reporte por tipo de movimiento','14- Reporte por tipo de movimiento',14,259,'ActivoFijo/Reportes/Reporte_tipo_movimiento/Reporte','icon-share',1),
 (302,13,'13- Reporte estadistico','Reporte para oficina estadistica e informatica laboral',13,259,'ActivoFijo/Reportes/Reporte_estadistico/RecibirDatos','icon-pie-chart',1),
 (303,13,'15-Reporte bienes sin movimientos','Reporte bienes sin movimientos',15,259,'ActivoFijo/Reportes/Reporte_bienes_sin_movimiento/reporte','icon-loop',1),
 (304,13,'Detalle de movimiento','Detalle de movimiento para el reporte',0,301,'ActivoFijo/Reportes/Detalle_movimiento','',1),
 (305,13,'5-Reporte de Total de Solicitudes','Generar reporte de total de solicitudes por nivel',5,270,'Compras/Reportes/Reporte_total_solicitudes/reporte','icon-table',1),
 (307,13,'Aprobar movimiento autorizante','aprobacion de solicitudes de movimientos para direccion administrativa',4,256,'ActivoFijo/Aprobar_movimiento_autorizante','icon-aprobar-compra',4),
 (308,13,'Detalle Aprobar Movimiento Autorizante','registro de detalle de movimiento',0,307,'ActivoFijo/Detalle_aprobar_movimiento_autorizante','',4),
 (309,13,'Empleados enlace','registro de empleados enlace',8,0,'ActivoFijo/Enlace_af','icon-enlace',4),
 (310,13,'Migrar pedidos','modulo para migrar pedidos a solicitudes de productos de bodega',4,205,'Bodega/Migrar_pedidos','icon-database',1),
 (311,13,'Detalle de Solicitudes de Compra','solicitudes asociadas a la OC',0,232,'Compras/Detalle_solicitud_orden','',4),
 (312,14,'Configuracion sistemas','',1,0,'#!','mdi mdi-settings',0),
 (313,14,'Sistemas','',1,312,'/sistemas/sistema','mdi mdi-label',0),
 (314,14,'Modulos','',2,312,'/sistemas/modulo','mdi mdi-label',0),
 (315,14,'Usuarios','',2,0,'#!','mdi mdi-account-multiple',0),
 (316,14,'Usuarios','',1,315,'/usuarios/usuarios','mdi mdi-label',0);
/*!40000 ALTER TABLE `org_modulo` ENABLE KEYS */;


--
-- Definition of table `org_permiso`
--

DROP TABLE IF EXISTS `org_permiso`;
CREATE TABLE `org_permiso` (
  `id_permiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permiso` text NOT NULL,
  PRIMARY KEY (`id_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_permiso`
--

/*!40000 ALTER TABLE `org_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_permiso` ENABLE KEYS */;


--
-- Definition of table `org_rol`
--

DROP TABLE IF EXISTS `org_rol`;
CREATE TABLE `org_rol` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rol` text NOT NULL,
  `descripcion_rol` text NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_rol`
--

/*!40000 ALTER TABLE `org_rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_rol` ENABLE KEYS */;


--
-- Definition of table `org_rol_modulo_permiso`
--

DROP TABLE IF EXISTS `org_rol_modulo_permiso`;
CREATE TABLE `org_rol_modulo_permiso` (
  `id_rol_permiso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_rol` int(10) unsigned NOT NULL,
  `id_modulo` int(10) unsigned NOT NULL,
  `id_permiso` int(10) unsigned NOT NULL,
  `estado` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_rol_permiso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_rol_modulo_permiso`
--

/*!40000 ALTER TABLE `org_rol_modulo_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_rol_modulo_permiso` ENABLE KEYS */;


--
-- Definition of table `org_seccion`
--

DROP TABLE IF EXISTS `org_seccion`;
CREATE TABLE `org_seccion` (
  `id_seccion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_seccion` varchar(200) NOT NULL,
  `depende` int(10) unsigned NOT NULL,
  `nivel` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_seccion`
--

/*!40000 ALTER TABLE `org_seccion` DISABLE KEYS */;
INSERT INTO `org_seccion` (`id_seccion`,`nombre_seccion`,`depende`,`nivel`) VALUES 
 (1,'OFICINA DE ASESORIA JURIDICA',34,1),
 (2,'LIQUIDACION LABORAL',37,2),
 (3,'ARCHIVO GENERAL',36,2),
 (4,'ADMINISTRACION DE PROYECTOS',34,1),
 (5,'CENTRO OBRERO COATEPEQUE',15,2),
 (6,'CENTRO OBRERO CONCHALIO',15,2),
 (8,'CENTRO OBRERO EL TAMARINDO',15,2),
 (9,'CENTRO OBRERO LA PALMA',15,2),
 (10,'CIUDAD MUJER',61,2),
 (11,'CLINICA EMPRESARIAL',36,2),
 (12,'CNR',37,2),
 (13,'CONSEJO NACIONAL DEL SALARIO MINIMO',34,1),
 (14,'CONSEJO SUPERIOR DEL TRABAJO',34,1),
 (15,'DEPARTAMENTO DE CENTROS DE RECREACION A TRABAJADORES',36,2),
 (16,'DEPARTAMENTO DE INSPECCION AGROPECUARIA',37,2),
 (17,'DEPARTAMENTO DE INSPECCION, INDUSTRIA, COMERCIO Y SERVICIO',37,2),
 (18,'DEPARTAMENTO DE INSPECCION AGROPECUARIA_NO USAR',37,2),
 (19,'DEPARTAMENTO DE RECURSOS HUMANOS',36,2),
 (20,'DEPARTAMENTO DE RELACIONES DE TRABAJO',43,2),
 (21,'DEPARTAMENTO DE SERVICIOS GENERALES',36,2),
 (22,'DEPARTAMENTO NACIONAL DE EMPLEO',42,2),
 (23,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO DE APOPA',42,2),
 (24,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO DE ILOPANGO',42,2),
 (25,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO DE MEJICANOS',42,2),
 (26,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO DE NEJAPA',42,2),
 (27,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO DE SAN MARCOS',42,2),
 (28,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO DE SOYAPANGO',42,2),
 (29,'DEPARTAMENTO DE EMPLEO BOLSA DE EMPLEO SAN MARTIN',42,2),
 (30,'DEPARTAMENTO NACIONAL DE ORGANIZACIONES SOCIALES',43,2),
 (31,'DEPARTAMENTO UACI',36,2),
 (32,'DEPTO DE INSPECCION AGRICOLA_NO USAR',37,2),
 (33,'DEPTO. DE SEGURIDAD E HIGIENE OCUPACIONAL',42,2),
 (34,'DESPACHO MINISTERIAL',0,2),
 (35,'DESPACHO VICE MINISTERIAL',34,2),
 (36,'DIRECCION ADMINISTRATIVA',40,2),
 (37,'DIRECCION GENERAL DE INSPECCION',40,2),
 (39,'DIRECCION DE RELACIONES INTERNACIONALES DE TRABAJO',40,2),
 (40,'DIRECCION EJECUTIVA',34,2),
 (41,'117 TRABAJO',0,2),
 (42,'DIRECCION GENERAL DE PREVISION SOCIAL',40,2),
 (43,'DIRECCION GENERAL DE TRABAJO',40,2),
 (44,'INSPECCION SUPERVISORIA 3',37,2),
 (46,'EXTRANJERIA MIGRANTES',42,2),
 (47,'INFRAESTRUCTURA',36,2),
 (48,'INSPECCION AGROPECUARIA_NO USAR',37,2),
 (49,'INSPECCION SUPERVISORIA 2',37,2),
 (51,'MINISTRO',34,2),
 (52,'OFICINA DEPARTAMENTAL DE AHUACHAPAN',35,3),
 (53,'OFICINA DEPARTAMENTAL DE CABANAS',35,3),
 (54,'OFICINA DEPARTAMENTAL DE CHALATENANGO',35,3),
 (55,'OFICINA DEPARTAMENTAL DE CUSCATLAN',35,3),
 (56,'OFICINA DEPARTAMENTAL DE LA LIBERTAD',35,3),
 (57,'OFICINA DEPARTAMENTAL DE LA UNION',35,3),
 (58,'OFICINA DEPARTAMENTAL DE MORAZAN',35,3),
 (59,'OFICINA DEPARTAMENTAL DE SAN VICENTE',35,3),
 (60,'OFICINA DEPARTAMENTAL DE SONSONATE',35,3),
 (61,'OFICINA DEPARTAMENTAL DE USULUTAN',35,3),
 (64,'OFICINA PARACENTRAL DE ZACATECOLUCA',35,3),
 (65,'OFICINA REGIONAL DE SAN MIGUEL',35,3),
 (66,'OFICINA REGIONAL DE SANTA ANA',35,3),
 (67,'PAGADURIA INSTITUCIONAL',34,2),
 (68,'RAC',43,2),
 (69,'SALA CUNA',43,2),
 (72,'SECCION DE BODEGA',36,2),
 (73,'SECCION DE COMPRAS',36,2),
 (74,'SECCION DE CONTABILIDAD',34,2),
 (75,'SECCION DE CORRESPONDENCIA',34,2),
 (76,'SECCION DE HIGIENE OCUPACIONAL',42,2),
 (77,'SECCION DE INTENDENCIA',21,2),
 (78,'SECCION DE MANTENIMIENTO',21,2),
 (79,'SECCION DE MULTAS',37,2),
 (80,'SECCION DE PRESUPUESTO',34,2),
 (81,'SECCION DE PREVENCION DE RIESGOS OCUPACIONALES',42,2),
 (84,'SECCION DE RECREACION PARA TRABAJADORES',36,2),
 (86,'SECCION DE REGLAMENTOS INTERNOS DE TRABAJO',43,2),
 (87,'SECCION DE RELACIONES COLECTIVAS DE TRABAJO',43,2),
 (89,'SECCION DE RELACIONES INDIVIDUALES DE TRABAJO',43,2),
 (90,'SECCION DE SEGURIDAD OCUPACIONAL',42,2),
 (91,'SECCION DE TRABAJADORES MIGRANTES',42,2),
 (92,'SECCION MULTAS',37,2),
 (93,'SECCION NOTIFICADORES DE INSPECCION',37,2),
 (94,'SECCION PRESUPUESTO',34,2),
 (95,'SECRETARIA DE DIRECCION GENERAL DE TRABAJO',43,2),
 (97,'INSPECCION SUPERVISORIA 1',37,2),
 (98,'SUB DIRECCION',36,2),
 (99,'SUB 36',0,2),
 (100,'UNIDAD DE ACCESO A LA INFORMACION PUBLICA',34,1),
 (101,'UNIDAD DE ACTIVO FIJO',36,2),
 (104,'UNIDAD DE ASESORIA LABORAL',37,2),
 (105,'UNIDAD DE ATENCION AL USUARIO',36,2),
 (106,'OFICINA DE AUDITORIA Y CONTROL INTERNO',34,1),
 (107,'OFICINA DE COORDINACION Y DESARROLLO INSTITUCIONAL',40,2),
 (108,'UNIDAD DE DESARROLLO TECNOLOGICO',40,1),
 (109,'OFICINA DE ESTADISTICA E INFORMATICA LABORAL',40,1),
 (111,'UNIDAD DE NOTIFICADORES',43,2),
 (112,'OFICINA DE PRENSA Y RELACIONES PUBLICAS',40,1),
 (113,'UNIDAD ESPECIAL DE GENERO Y PREV. ACTOS',37,2),
 (114,'UNIDAD ESPECIAL DE PREVENCION DE ACTOS LABORALES DISCRIMINATORIOS',37,2),
 (115,'UNIDAD FINANCIERA INSTITUCIONAL',34,1),
 (116,'UNIDAD PARA LA EQUIDAD ENTRE LOS GENEROS',34,1),
 (117,'UNIDAD DE ANALISIS E INVESTIGACION DEL MERCADO LABORAL',42,2),
 (118,'SECCION DE SECTORES VULNERABLES',22,2),
 (119,'SECCION COORDINACION DE EMPLEO JUVENIL',42,2),
 (120,'UNIDAD DE ATENCION A ADOLESCENTES TRABAJADORES',36,2),
 (121,'UNIDAD DE ADQUISICIONES Y CONTRATACIONES INSTITUCIONAL',36,1),
 (122,'INSPECCION SUPERVISORIA 4',37,2),
 (123,'RECEPCION DE SOLICITUD DE INSPECCION',37,2),
 (124,'SITRAMITPS',0,2),
 (125,'APELACIONES',37,2),
 (126,'INSCRIPCION DE ESTABLECIMIENTOS',37,2),
 (127,'COORDINACION DE INDUSTRIA DE COMERCIO',37,2),
 (128,'FERIAS DE EMPLEO',22,2),
 (129,'COORDINACION BOLSA DE EMPLEO LOCAL',22,2),
 (130,'SEMINTRAB',0,2),
 (131,'UNIDAD DE DIALOGO SOCIAL',22,2),
 (132,'SALA DE USOS MULTIPLES E4N2',36,2),
 (133,'SALA DE REUNION CONSEJO SUPERIOR DE TRABAJO',14,2),
 (134,'SALA DE REUNION CLINICA',11,2),
 (135,'SALA DE CAPACITACION RRHH',19,2),
 (136,'OFICINA DE LA PGR',0,2),
 (137,'ARCHIVO INSTITUCIONAL',40,2),
 (138,'SALA DE REUNION USOS MULTIPLES PREVISION DE RIESGOS',42,2),
 (139,'SALA DE REUNION CLINICA',36,2),
 (140,'SECCION GENERAL',0,2),
 (141,'CAFETERIA',36,2),
 (142,'CORTE DE CUENTAS',36,2),
 (143,'SECCION GENERAL',36,2),
 (144,'SECRETARIA DE DIRECCION GENERAL DE INSPECCION TRABAJO',37,2),
 (145,'UNIDAD DE ATENCION A NINOS Y NINAS ADOLESCENTES',42,2),
 (146,'UNIDAD DE APRENDICES',42,2),
 (147,'DESCARGADO Y DESALOJADO',40,2),
 (148,'SUBDIRECCION GENERAL DE INSPECCION',37,2),
 (149,'COMITE DE SEGURIDAD OCUPACIONAL',11,2),
 (150,'COORDINACION NACIONAL DE INSPECCION DE TRABAJO',37,2),
 (151,'SECCION TRANSPORTE',21,2),
 (152,'SUPERVISORIA 1',37,2),
 (153,'SUPERVISORIA 2',37,2),
 (154,'SUPERVISORIA 3',37,2),
 (155,'SUPERVISORIA 4',37,2),
 (156,'MECANICOS',21,2),
 (157,'UNIDAD ENCARGADA DE TRAMITAR CASOS PROVENIENTES DEL DESPACHO Y PROGRAMA CONVERSANDO CON EL PRESIDENTE',34,2),
 (158,'UNIDAD CALL CENTER',36,2),
 (159,'SECCION DE SEGURIDAD',21,2),
 (160,'UBICACION EXTERNA',0,2),
 (161,'MTPS',0,2),
 (162,'OFICINA RECEPTORA DE QUEJAS',37,2),
 (163,'SECCION TALLER',21,2),
 (164,'SECCION VIGILANCIA',36,2),
 (165,'UNIDAD DE MEDIO AMBIENTE',34,2),
 (166,'PLAN DE LA LAGUNA OFICINAS ADMINISTRATIVAS',36,2),
 (167,'SUB DIRECCION ADMINISTRATIVA',36,2),
 (168,'SUB DIRECCION DE PREVISION SOCIAL',42,2),
 (169,'SUB DIRECCION DE TRABAJO',43,2),
 (170,'SECRETARIA DE ACTUACIONES',43,2),
 (171,'SECCION BOLSA DE EMPLEO',22,2),
 (172,'UNIDAD DE EMPLEO JUVENIL Y FERIAS DE EMPLEO',22,2),
 (174,'SECCION DE REGISTRO Y CONTROL DE PERSONAL',19,2),
 (175,'SECCION DE CAPACITACION',19,2),
 (176,'SECCION DE BIENESTAR LABORAL',19,2),
 (177,'UNIDAD DE EMPLEO JUVENIL',22,2),
 (178,'UNIDAD DE FERIAS DE EMPLEO',22,2),
 (179,'FONDO CIRCULANTE',115,1),
 (180,'UNIDAD DE GESTION DOCUMENTAL Y ARCHIVOS',40,2);
/*!40000 ALTER TABLE `org_seccion` ENABLE KEYS */;


--
-- Definition of table `org_sistema`
--

DROP TABLE IF EXISTS `org_sistema`;
CREATE TABLE `org_sistema` (
  `id_sistema` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_sistema` text NOT NULL,
  `base_url` text NOT NULL,
  PRIMARY KEY (`id_sistema`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_sistema`
--

/*!40000 ALTER TABLE `org_sistema` DISABLE KEYS */;
INSERT INTO `org_sistema` (`id_sistema`,`nombre_sistema`,`base_url`) VALUES 
 (1,'SISTEMA INTEGRAL DE BODEGA',''),
 (2,'SISTEMA DE ADMINISTRACION DE ROLES',''),
 (3,'SISTEMA DE ACTIVO FIJO',''),
 (4,'SISTEMA DE REGISTRO DE FICHAS DE EMPLEADOS DE RECURSOS HUMANOS',''),
 (5,'SISTEMA DE TRANSPORTE, COMBUSTIBLE Y MANTENIMIENTO DE VEHICULOS',''),
 (6,'SISTEMA DE CONSULTA DE BIENES SAF',''),
 (7,'SISTEMA DE REGISTRO DE COMITES DE SEGURIDAD Y SALUD OCUPACIONAL ACREDITADOS',''),
 (8,'SISTEMA DE PUBLICACION DE OFERTAS DE EMPLEO',''),
 (9,'SISTEMA DE EVALUACION DE DESEMPEÑO DEL PERSONAL',''),
 (10,'SISTEMA DE PLANIFICACION ANUAL DE TRABAJO',''),
 (11,'SISTEMA DE SEGURIDAD DE SIMTPS',''),
 (12,'SISTEMA DE GESTION DE CONTRATOS INDIVIDUALES DE TRABAJO',''),
 (13,'SISTEMA INTEGRAL DE COMPRAS, BODEGA INSTITUCIONAL Y ACTIVOS FIJOS',''),
 (14,'SISTEMA DE SEGURIDAD','http://localhost/securityplus/');
/*!40000 ALTER TABLE `org_sistema` ENABLE KEYS */;


--
-- Definition of table `org_usuario`
--

DROP TABLE IF EXISTS `org_usuario`;
CREATE TABLE `org_usuario` (
  `id_usuario` int(10) unsigned NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `nr` varchar(5) NOT NULL,
  `sexo` varchar(5) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_seccion` varchar(5) NOT NULL,
  `estado` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_usuario`
--

/*!40000 ALTER TABLE `org_usuario` DISABLE KEYS */;
INSERT INTO `org_usuario` (`id_usuario`,`nombre_completo`,`nr`,`sexo`,`usuario`,`password`,`id_seccion`,`estado`) VALUES 
 (1,'WILLIAN RIVERA','2017','00001','willian.rivera','willian','1',1),
 (2,'DOUGLAS RECINOS','2545','00001','douglas.recinos','1df6b38df5d989e87ed053ddc5a099bf','13',1),
 (3,'PAZ ELISA ALVARADO','1218','00001','paz.alvarado','b9dd7dec8201d01ba274db91fbb5e280','97',1);
/*!40000 ALTER TABLE `org_usuario` ENABLE KEYS */;


--
-- Definition of table `org_usuario_rol`
--

DROP TABLE IF EXISTS `org_usuario_rol`;
CREATE TABLE `org_usuario_rol` (
  `id_usuario_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_usuario_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_usuario_rol`
--

/*!40000 ALTER TABLE `org_usuario_rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `org_usuario_rol` ENABLE KEYS */;


--
-- Definition of table `sir_empleado`
--

DROP TABLE IF EXISTS `sir_empleado`;
CREATE TABLE `sir_empleado` (
  `idempleado` varchar(4) NOT NULL,
  `primer_nombre` text NOT NULL,
  `segundo_nombre` text NOT NULL,
  `tercer_nombre` text NOT NULL,
  `primer_apellido` text NOT NULL,
  `segundo_apellido` text NOT NULL,
  `apellido_casada` text NOT NULL,
  `id_genero` varchar(5) NOT NULL,
  `nr` varchar(4) NOT NULL,
  PRIMARY KEY (`idempleado`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sir_empleado`
--

/*!40000 ALTER TABLE `sir_empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `sir_empleado` ENABLE KEYS */;


--
-- Definition of table `sir_empleado_informacion_laboral`
--

DROP TABLE IF EXISTS `sir_empleado_informacion_laboral`;
CREATE TABLE `sir_empleado_informacion_laboral` (
  `id_empleado_informacion_laboral` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_seccion` int(10) unsigned NOT NULL,
  `id_empleado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_empleado_informacion_laboral`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sir_empleado_informacion_laboral`
--

/*!40000 ALTER TABLE `sir_empleado_informacion_laboral` DISABLE KEYS */;
/*!40000 ALTER TABLE `sir_empleado_informacion_laboral` ENABLE KEYS */;


--
-- Definition of table `vyp_bancos`
--

DROP TABLE IF EXISTS `vyp_bancos`;
CREATE TABLE `vyp_bancos` (
  `id_banco` int(10) unsigned NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `caracteristicas` varchar(40) NOT NULL,
  PRIMARY KEY (`id_banco`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vyp_bancos`
--

/*!40000 ALTER TABLE `vyp_bancos` DISABLE KEYS */;
INSERT INTO `vyp_bancos` (`id_banco`,`nombre`,`caracteristicas`) VALUES 
 (2,'Agricola S.A de C.V','PERTENECE A EL SALVADOR CON PARTE EN COL'),
 (3,'CUSCATLAN','ALGUNOS EMPLEADOS USAN ESTE BANCO'),
 (4,'DAVIVIENDA','FORMA PARTE DE LAS PLANILLAS'),
 (5,'BANCOVI','BANCO PARA EMPLEADOS'),
 (6,'BANCO LA FINCA','BANCO FINCA DE EL SALVADOR');
/*!40000 ALTER TABLE `vyp_bancos` ENABLE KEYS */;


--
-- Definition of table `vyp_bitacora_viatico`
--

DROP TABLE IF EXISTS `vyp_bitacora_viatico`;
CREATE TABLE `vyp_bitacora_viatico` (
  `id_bitacora` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(500) NOT NULL,
  `modulo` varchar(45) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `fecha` datetime NOT NULL,
  `idusuario` varchar(45) NOT NULL,
  PRIMARY KEY (`id_bitacora`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vyp_bitacora_viatico`
--

/*!40000 ALTER TABLE `vyp_bitacora_viatico` DISABLE KEYS */;
/*!40000 ALTER TABLE `vyp_bitacora_viatico` ENABLE KEYS */;


--
-- Definition of table `vyp_horario_viatico`
--

DROP TABLE IF EXISTS `vyp_horario_viatico`;
CREATE TABLE `vyp_horario_viatico` (
  `id_horario_viatico` int(10) unsigned NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `hora_inicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hora_fin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `monto` float NOT NULL,
  PRIMARY KEY (`id_horario_viatico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vyp_horario_viatico`
--

/*!40000 ALTER TABLE `vyp_horario_viatico` DISABLE KEYS */;
INSERT INTO `vyp_horario_viatico` (`id_horario_viatico`,`descripcion`,`hora_inicio`,`hora_fin`,`monto`) VALUES 
 (1,'Desayuno','2017-10-06 06:00:00','2017-10-06 08:00:00',3),
 (2,'Almuerzo','2017-10-06 12:00:00','2017-10-06 13:00:00',4),
 (3,'cena2','2017-10-11 18:00:00','2017-10-11 20:00:00',4);
/*!40000 ALTER TABLE `vyp_horario_viatico` ENABLE KEYS */;


--
-- Definition of table `vyp_oficinas`
--

DROP TABLE IF EXISTS `vyp_oficinas`;
CREATE TABLE `vyp_oficinas` (
  `id_oficina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_oficina` varchar(200) NOT NULL,
  `direccion_oficina` varchar(400) NOT NULL,
  `jefe_oficina` varchar(250) NOT NULL,
  `email_oficina` varchar(250) NOT NULL,
  `latitud_oficina` varchar(50) NOT NULL,
  `longitud_oficina` varchar(50) NOT NULL,
  PRIMARY KEY (`id_oficina`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vyp_oficinas`
--

/*!40000 ALTER TABLE `vyp_oficinas` DISABLE KEYS */;
INSERT INTO `vyp_oficinas` (`id_oficina`,`nombre_oficina`,`direccion_oficina`,`jefe_oficina`,`email_oficina`,`latitud_oficina`,`longitud_oficina`) VALUES 
 (1,'Oficina Central','primera direccion','dsadsad','sdfdf@fdfdf.com','13.705542923582362',' -89.20029401779175'),
 (2,'Oficina Paracentral','segunda direeccion','','','13.641253371576248',' -88.78463745117188'),
 (3,'Oficina regional de occidente','','','','13.995933662977752',' -89.55837965011597'),
 (4,'prueba','ninguna','vili fracnsi','d_Recinos@fdf.com','13.70745038803979',' -89.20013576745987'),
 (5,'prueba dos oficna','san vicente','doc anderson','algo@fmail.com','13.96072323963274',' -88.11900327913463'),
 (6,'preubaz','aklslhjdksa','asaber','akdjas@kashdk.com','13.673176208626606',' -89.13971096277237');
/*!40000 ALTER TABLE `vyp_oficinas` ENABLE KEYS */;


--
-- Definition of table `vyp_oficinas_telefono`
--

DROP TABLE IF EXISTS `vyp_oficinas_telefono`;
CREATE TABLE `vyp_oficinas_telefono` (
  `id_vyp_oficinas_telefono` int(11) NOT NULL AUTO_INCREMENT,
  `telefono_vyp_oficnas_telefono` varchar(9) NOT NULL,
  `id_oficina_vyp_oficnas_telefono` int(11) NOT NULL,
  PRIMARY KEY (`id_vyp_oficinas_telefono`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vyp_oficinas_telefono`
--

/*!40000 ALTER TABLE `vyp_oficinas_telefono` DISABLE KEYS */;
INSERT INTO `vyp_oficinas_telefono` (`id_vyp_oficinas_telefono`,`telefono_vyp_oficnas_telefono`,`id_oficina_vyp_oficnas_telefono`) VALUES 
 (1,'7525-9130',1),
 (2,'4355-3451',1),
 (4,'6545-5255',5),
 (5,'2323-4343',5),
 (9,'7331-1111',3),
 (10,'2222-1113',4),
 (11,'2344-3333',1);
/*!40000 ALTER TABLE `vyp_oficinas_telefono` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
