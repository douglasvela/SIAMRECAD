DELETE FROM vyp_actividades;
DELETE FROM vyp_alojamientos;
DELETE FROM vyp_bancos;
DELETE FROM vyp_bitacora_solicitud_pasaje;
DELETE FROM vyp_bitacora_solicitud_viatico;
DELETE FROM vyp_empleado_cuenta_banco;
DELETE FROM vyp_empresa_viatico;
DELETE FROM vyp_empresas_visitadas;
DELETE FROM vyp_estado_solicitud;
DELETE FROM vyp_estructura_planilla;
DELETE FROM vyp_generalidades;
DELETE FROM vyp_horario_viatico;
DELETE FROM vyp_horario_viatico_solicitud;
DELETE FROM vyp_informacion_empleado;
DELETE FROM vyp_justificaciones;
DELETE FROM vyp_mision_oficial;
DELETE FROM vyp_mision_pasajes;
DELETE FROM vyp_observacion_solicitud;
DELETE FROM vyp_observaciones_pasajes;
DELETE FROM vyp_oficina_autorizador;
DELETE FROM vyp_oficinas;
DELETE FROM vyp_oficinas_telefono;
DELETE FROM vyp_pago_emergencia;
DELETE FROM vyp_pago_poliza;
DELETE FROM vyp_pasajes;
DELETE FROM vyp_poliza;
DELETE FROM vyp_rutas;

-- CLEAN TABLES SCRIPT
/*

ALTER TABLE `vyp_mision_oficial` ADD `id_banco` INT NOT NULL AFTER `pagado_en`;
ALTER TABLE `vyp_mision_pasajes` ADD `id_banco` INT NOT NULL AFTER `id_oficina`;

ALTER TABLE `vyp_mision_oficial` ADD `observaciones` VARCHAR(300) NOT NULL AFTER `id_oficina`;

ALTER TABLE vyp_empresa_viatico MODIFY id_empresa_viatico INTEGER NOT NULL AUTO_INCREMENT;

DELETE FROM vyp_alojamientos;
DELETE FROM vyp_bitacora_solicitud_pasaje;
DELETE FROM vyp_bitacora_solicitud_viatico;
DELETE FROM vyp_empresa_viatico;
DELETE FROM vyp_empresas_visitadas;
DELETE FROM vyp_horario_viatico_solicitud;
DELETE FROM vyp_justificaciones;
DELETE FROM vyp_mision_oficial;
DELETE FROM vyp_mision_pasajes;
DELETE FROM vyp_observacion_solicitud;
DELETE FROM vyp_observaciones_pasajes;
DELETE FROM vyp_pago_emergencia;
DELETE FROM vyp_pago_poliza;
DELETE FROM vyp_pasajes;
DELETE FROM vyp_poliza;
DELETE FROM vyp_rutas;

ALTER TABLE vyp_alojamientos AUTO_INCREMENT = 1;
ALTER TABLE vyp_bitacora_solicitud_pasaje AUTO_INCREMENT = 1;
ALTER TABLE vyp_bitacora_solicitud_viatico AUTO_INCREMENT = 1;
ALTER TABLE vyp_empresa_viatico AUTO_INCREMENT = 1;
ALTER TABLE vyp_empresas_visitadas AUTO_INCREMENT = 1;
ALTER TABLE vyp_horario_viatico_solicitud AUTO_INCREMENT = 1;
ALTER TABLE vyp_justificaciones AUTO_INCREMENT = 1;
ALTER TABLE vyp_mision_oficial AUTO_INCREMENT = 1;
ALTER TABLE vyp_mision_pasajes AUTO_INCREMENT = 1;
ALTER TABLE vyp_observacion_solicitud AUTO_INCREMENT = 1;
ALTER TABLE vyp_observaciones_pasajes AUTO_INCREMENT = 1;
ALTER TABLE vyp_pago_emergencia AUTO_INCREMENT = 1;
ALTER TABLE vyp_pago_poliza AUTO_INCREMENT = 1;
ALTER TABLE vyp_pasajes AUTO_INCREMENT = 1;
ALTER TABLE vyp_poliza AUTO_INCREMENT = 1;
ALTER TABLE vyp_rutas AUTO_INCREMENT = 1;*/