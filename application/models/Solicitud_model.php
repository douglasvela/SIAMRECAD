<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function insertar_mision($data){
		if($this->db->insert('vyp_mision_oficial', array('nr_empleado' => $data['nr'], 'nombre_completo' => $data['nombre_completo'], 'fecha_mision_inicio' => $data['fecha_mision_inicio'], 'fecha_mision_fin' => $data['fecha_mision_fin'],'id_actividad_realizada' => $data['id_actividad_realizada'], 'detalle_actividad' => $data['detalle_actividad'], 'nr_jefe_inmediato' => $data['nr_jefe_inmediato'], 'nr_jefe_regional' => $data['nr_jefe_regional'], 'id_oficina' => $data['id_oficina'], 'id_empleado_informacion_laboral' => $data['id_empleado_informacion_laboral'], 'ruta_justificacion' => $data['ruta_justificacion'], 'pagado_en' => 'banco', 'oficina_solicitante_motorista' => $data['oficina_solicitante'], 'observaciones' => $data['observacion_mision']))){
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}else{
			return "fracaso";
		}
	}

	function editar_justificacion($data){
		$this->db->where("id_mision_oficial",$data["id_mision"]);
		if($this->db->update('vyp_mision_oficial', array('ruta_justificacion' => $data['ruta_justificacion']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function editar_empresa_visitada($data){
		$this->db->where("id_empresas_visitadas",$data["id_empresas_visitadas"]);
		if($this->db->update('vyp_empresas_visitadas', $data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}


	function insertar_justificacion($data){
		if($this->db->insert('vyp_justificaciones', array('id_justificacion' => $data["id_justificacion"], 'ruta' => $data['ruta'], 'size' => $data['size'], 'id_mision' => $data['id_mision'], 'extension' => $data['extension'], 'nombre' => $data['nombre'], 'nombre_real' => $data['nombre_real']))){
			return true;
		}else{
			return false;
		}
	}


	function insertar_destino($data){
		if($this->db->insert('vyp_empresas_visitadas', array('id_mision_oficial' => $data['id_mision'], 'id_departamento' => $data['departamento'], 'id_municipio' => $data['municipio'], 'nombre_empresa' => $data['nombre_empresa'], 'direccion_empresa' => $data['direccion_empresa'], 'kilometraje' => $data['distancia'], 'tipo_destino' => $data['tipo'], 'id_destino' => $data['id_destino']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_viaticos($data){
		if($this->db->insert('vyp_empresa_viatico', array('id_mision' => $data['id_mision'], 'id_origen' => $data['id_origen'], 'id_destino' => $data['id_destino'], 'nombre_origen' => $data['nombre_origen'], 'nombre_destino' => $data['nombre_destino'], 'hora_salida' => $data['hora_salida'], 'hora_llegada' => $data['hora_llegada'], 'pasaje' => $data['pasaje'], 'alojamiento' => $data['alojamiento'], 'viatico' => $data['viatico'], 'fecha' => $data['fecha'], 'factura' => $data['factura'], 'kilometraje' => $data['kilometraje'], 'horarios_viaticos' => $data['horarios']))){
			$insert_id = $this->db->insert_id();
			return "exito,".$insert_id;
		}else{
			return "fracaso";
		}
	}

	function insertar_viaticos_ruta($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "duplicado";
		}
	}

	function insertar_alojamiento($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function insertar_ruta($data){
		if($data["tipo"] == "destino_oficina"){
			$query = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_departamento = '".$data['departamento']."' AND id_municipio = '".$data['municipio']."'");
			if($query->num_rows() > 0){
				foreach ($query->result() as $fila) {
					$data['id_oficina_destino'] = $fila->id_oficina;
					$data['latitud_destino'] = $fila->latitud_oficina;
					$data['longitud_destino'] = $fila->longitud_oficina;
				}
			}

			$query2 = $this->db->query("SELECT * FROM vyp_oficinas WHERE id_oficina = '".$data['id_oficina_origen']."'");
			if($query2->num_rows() > 0){
				foreach ($query2->result() as $fila2) {
					$departamento = $fila2->id_departamento;
					$municipio = $fila2->id_municipio;
					$datos = explode("-", $data['descripcion_destino']);
					$descripcion = trim($datos[1])." - ".trim($datos[0]);
					$latitud = $fila2->latitud_oficina;
					$longitud = $fila2->longitud_oficina;
					$nombre_oficina = $fila2->nombre_oficina;
				}
			}
		}else{
			$data['id_oficina_destino'] = "0";
		}

		if($data["tipo"] == "destino_oficina"){
		
			if( $this->db->insert('vyp_rutas', array(
													'id_oficina_origen_vyp_rutas' => $data['id_oficina_origen'], 
													'id_oficina_destino_vyp_rutas' => $data['id_oficina_destino'], 
													'id_departamento_vyp_rutas' => $data['departamento'], 
													'id_municipio_vyp_rutas' => $data['municipio'],
													'km_vyp_rutas' => $data['distancia'], 
													'descripcion_destino_vyp_rutas' => $data['descripcion_destino'],
													'latitud_destino_vyp_rutas' => $data['latitud_destino'], 
													'longitud_destino_vyp_rutas' => $data['longitud_destino'],
													'opcionruta_vyp_rutas' => $data['tipo'], 
													'nombre_empresa_vyp_rutas' => $data['nombre_empresa'],
													'direccion_empresa_vyp_rutas' => $data['direccion_empresa'],
													'estado_vyp_rutas' => false)) 
			){
				$data['id_destino'] = $this->db->insert_id();
				if( $this->db->insert('vyp_rutas', array(
													'id_oficina_origen_vyp_rutas' => $data['id_oficina_destino'], 
													'id_oficina_destino_vyp_rutas' => $data['id_oficina_origen'],
													'id_departamento_vyp_rutas' => $departamento, 
													'id_municipio_vyp_rutas' => $municipio,
													'km_vyp_rutas' => $data['distancia'],
													'descripcion_destino_vyp_rutas' => $descripcion,
													'latitud_destino_vyp_rutas' => $latitud, 
													'longitud_destino_vyp_rutas' => $longitud,
													'opcionruta_vyp_rutas' => $data['tipo'],
													'nombre_empresa_vyp_rutas' => $nombre_oficina,
													'direccion_empresa_vyp_rutas' => $nombre_oficina,
													'estado_vyp_rutas' => false)) 
				){
					return $this->solicitud_model->insertar_destino($data);
				}else{
					return "fracaso";
				}
			}else{
				return "fracaso";
			}
		}else{
			if( $this->db->insert('vyp_rutas', array(
													'id_oficina_origen_vyp_rutas' => $data['id_oficina_origen'], 
													'id_oficina_destino_vyp_rutas' => $data['id_oficina_destino'], 
													'id_departamento_vyp_rutas' => $data['departamento'], 
													'id_municipio_vyp_rutas' => $data['municipio'],
													'km_vyp_rutas' => $data['distancia'], 
													'descripcion_destino_vyp_rutas' => $data['descripcion_destino'],
													'latitud_destino_vyp_rutas' => $data['latitud_destino'], 
													'longitud_destino_vyp_rutas' => $data['longitud_destino'],
													'opcionruta_vyp_rutas' => $data['tipo'], 
													'nombre_empresa_vyp_rutas' => $data['nombre_empresa'],
													'direccion_empresa_vyp_rutas' => $data['direccion_empresa'],
													'estado_vyp_rutas' => false)) 
			){
				$data['id_destino'] = $this->db->insert_id();
				return $this->solicitud_model->insertar_destino($data);
			}else{
				return "fracaso";
			}
		}
	}

	function editar_viaticos($data){
		$this->db->where("id_empresa_viatico",$data["id_empresa_viatico"]);
		if($this->db->update('vyp_empresa_viatico', array('id_origen' => $data['id_origen'], 'id_destino' => $data['id_destino'], 'nombre_origen' => $data['nombre_origen'], 'nombre_destino' => $data['nombre_destino'], 'hora_salida' => $data['hora_salida'], 'hora_llegada' => $data['hora_llegada'], 'pasaje' => $data['pasaje'], 'alojamiento' => $data['alojamiento'], 'viatico' => $data['viatico'], 'fecha' => $data['fecha'], 'factura' => $data['factura'], 'kilometraje' => $data['kilometraje'], 'horarios_viaticos' => $data['horarios']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function editar_viaticos2($data){
		$this->db->where("id_empresa_viatico",$data["id_empresa_viatico"]);
		if($this->db->update('vyp_empresa_viatico', array('id_origen' => $data['id_origen'], 'id_destino' => $data['id_destino'], 'nombre_origen' => $data['nombre_origen'], 'nombre_destino' => $data['nombre_destino'], 'hora_salida' => $data['hora_salida'], 'hora_llegada' => $data['hora_llegada'], 'pasaje' => $data['pasaje'], 'alojamiento' => $data['alojamiento'], 'viatico' => $data['viatico'], 'fecha' => $data['fecha'], 'kilometraje' => $data['kilometraje'], 'horarios_viaticos' => $data['horarios']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function editar_mision($data){
		$this->db->where("id_mision_oficial",$data["id_mision"]);
		if($this->db->update('vyp_mision_oficial', array('nr_empleado' => $data['nr'], 'nombre_completo' => $data['nombre_completo'], 'fecha_mision_inicio' => $data['fecha_mision_inicio'], 'fecha_mision_fin' => $data['fecha_mision_fin'],'id_actividad_realizada' => $data['id_actividad_realizada'], 'detalle_actividad' => $data['detalle_actividad'], 'nr_jefe_inmediato' => $data['nr_jefe_inmediato'], 'nr_jefe_regional' => $data['nr_jefe_regional'], 'id_oficina' => $data['id_oficina'], 'id_empleado_informacion_laboral' => $data['id_empleado_informacion_laboral'], 'ruta_justificacion' => $data['ruta_justificacion'], 'oficina_solicitante_motorista' => $data['oficina_solicitante'], 'observaciones' => $data['observacion_mision']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function fecha_repetida($sql){
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function cambiar_estado_revision($data){
		$query = $this->db->query("SELECT * FROM vyp_mision_oficial WHERE id_mision_oficial = '".$data."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$estado = $fila->estado; 
				$fecha_mision_fin = $fila->fecha_mision_fin;
				$fecha_ultima_observacion = $fila->ultima_observacion;
			}
		}

		$newestado = 1;
		$mensaje = "";
		if($estado == 0){ //si esta incompleta
			$newestado = 1;	//cambiar a revision 1
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_mision_fin.date(" H:m:i");
			$mensaje = "CREÓ LA SOLICITUD Y LA ENVIÓ A JEFATURA INMEDIATA";
			$persona_actualiza = 1; //Actualiza el solicitante
		}else if($estado == 1){ //si esta en revisión 1
			$newestado = 1;	//permanecer en revisión 1
		}else if($estado == 2){ //si está en observación 1
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$persona_actualiza = 1; //Actualiza el solicitante
			$mensaje = "CORRIGIÓ OBSERVACIONES DE JEFATURA INMEDIATA";
			$newestado = 1;	//cambiar a revisión 1
		}else if($estado == 3){	//si está en revisión 2
			$newestado = 3; //permanecer en revisión 2
		}else if($estado == 4){ //si está en observación 2
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$persona_actualiza = 1; //Actualiza el solicitante
			$mensaje = "CORRIGIÓ OBSERVACIONES DE DIRECCIÓN O JEFATURA REGIONAL";
			$newestado = 1;	//cambiar a revision 1
		}else if($estado == 5){//si está en revisión 3
			$newestado = 5;
		}else if($estado == 6){ //si está en observacion 3
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$persona_actualiza = 1; //Actualiza el solicitante
			$mensaje = "CORRIGIÓ OBSERVACIONES DE FONDO CIRCULANTE";
			$newestado = 1;
		}

		$tiempo_dias = get_days_count(substr($fecha_antigua,0,10), substr($fecha_actualizacion,0,10));
		$data_insert = array(
			'fecha_antigua' => $fecha_antigua,
			'fecha_actualizacion' => $fecha_actualizacion,
			'tiempo_dias' => $tiempo_dias,
			'descripcion' => $mensaje, 
			'persona_actualiza' => $persona_actualiza,
			'id_mision' => $data,
			'nr_persona_actualiza' => $this->session->userdata('nr_usuario_viatico')
		);

		if($estado == 0){
			$this->db->where("id_mision_oficial",$data);
			$fecha = date("Y-m-d H:i:s");
			if($this->db->update('vyp_mision_oficial', array('fecha_solicitud' => $fecha, 'ultima_observacion' => $fecha, 'estado' => $newestado)) && $this->db->insert('vyp_bitacora_solicitud_viatico', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			$this->db->where("id_mision_oficial",$data);
			$fecha = date("Y-m-d H:i:s");
			if($this->db->update('vyp_mision_oficial', array('estado' => $newestado, 'ultima_observacion' => $fecha)) && $this->db->query("UPDATE vyp_observacion_solicitud SET corregido = 1 WHERE id_mision = '".$data."'") && $this->db->insert('vyp_bitacora_solicitud_viatico', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}
	}

	function eliminar_mision($data){
		if($this->db->delete("vyp_mision_oficial",array('id_mision_oficial' => $data['id_mision'])) && $this->db->delete("vyp_justificaciones",array('id_mision' => $data['id_mision']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_observaciones($data){
		if($this->db->delete("vyp_observacion_solicitud",array('id_mision' => $data))){
			return true;
		}else{
			return false;
		}
	}

	function eliminar_archivo_justificacion($data){
		if($this->db->delete("vyp_justificaciones",array('id_justificacion' => $data["id_justificacion"]))){
			if (file_exists($data["ruta"])){
				unlink($data["ruta"]);
			}
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_viaticos($data){
		if($this->db->delete("vyp_empresa_viatico",array('id_empresa_viatico' => $data['id_empresa_viatico'])) && $this->db->delete("vyp_horario_viatico_solicitud",array('id_ruta_visitada' => $data['id_empresa_viatico'])) && $this->db->delete("vyp_alojamientos",array('id_ruta_visitada' => $data['id_empresa_viatico']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_empresas_visitadas($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_empresas_viaticos($data){
		if($this->db->delete("vyp_empresa_viatico",array('id_mision' => $data)) && $this->db->delete("vyp_horario_viatico_solicitud",array('id_mision' => $data))){
			return true;
		}else{
			return false;
		}
	}

	/*

	function ordenar_empresas_visitadas($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function guardar_registros_viaticos($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function completar_tabla_viatico($data){
		if($this->db->query($data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}*/

	function editar_destino($data){
		if($this->db->query("UPDATE vyp_empresas_visitadas SET kilometraje = '".$data['distancia']."' WHERE id_mision_oficial = '".$data['id_mision']."' AND id_destino = '".$data['id_destino']."'")){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function verficar_cumpla_kilometros($data){
		$query = $this->db->query("SELECT * FROM vyp_empresa_viatico WHERE id_mision = '".$data."' AND kilometraje >= 15");
		if($query->num_rows() > 0){
			return true; 
		}else{
			return false;
		}
	}

	/*function verficar_oficina_destino($data){
		$query = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$data['id_mision']."' AND tipo_destino = 'destino_oficina' AND id_municipio = '".$data['municipio']."' AND id_departamento = '".$data['departamento']."'");
		if($query->num_rows() > 0){
			return $this->editar_destino($data); 
		}else{
			return $this->insertar_destino($data);
		}
	}

	*/

	function obtener_ultimo_id($tabla,$nombreid){
		$this->db->order_by($nombreid, "asc");
		$query = $this->db->get($tabla);
		$ultimoid = 0;
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->$nombreid; 
			}
			$ultimoid++;
		}else{
			$ultimoid = 1;
		}
		return $ultimoid;
	}

	function obtener_ultima_mision($tabla,$nombreid,$nr){
		$query = $this->db->query("SELECT ".$nombreid." FROM ".$tabla." WHERE nr_empleado = '".$nr."' ORDER BY ".$nombreid." ASC");
		$ultimoid = 0;
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->$nombreid; 
			}
		}else{
			$ultimoid = 1;
		}
		return $ultimoid;
	}

	function obtener_ultima_ruta($tabla,$nombreid,$nr){
		$query = $this->db->query("SELECT ".$nombreid." FROM ".$tabla." WHERE id_mision = '".$nr."' ORDER BY ".$nombreid." ASC");
		$ultimoid = 0;
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->$nombreid; 
			}
		}else{
			$ultimoid = 1;
		}
		return $ultimoid;
	}

	function obtener_id_municipio($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_municipio; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}

	function obtener_id_departamento($municipio){
		$query = $this->db->query("SELECT * FROM org_municipio WHERE id_municipio = '".$municipio."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$ultimoid = $fila->id_departamento_pais; 
			}
		}else{
			$ultimoid = "fracaso";
		}
		return $ultimoid;
	}
}