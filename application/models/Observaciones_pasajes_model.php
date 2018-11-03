<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_pasajes_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function otra_observacion($data){
		if($this->db->insert('vyp_observacion_solicitud', $data)){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function cambiar_estado_solicitud($data){

		$query = $this->db->query("SELECT * FROM vyp_mision_pasajes WHERE id_mision_pasajes = '".$data['id_mision']."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$estado = $fila->estado; 
				$fecha_ultima_observacion = $fila->ultima_observacion;
			}
		}

		$mensaje = "";
		if($data['estado'] == "2"){ //observaciones jefatura inmediata
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD";
			$persona_actualiza = 2; //Actualiza jefatura inmediata
		}else if($data['estado'] == "4"){ //observaciones dirección de área o jefatura regional
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD";
			$persona_actualiza = 3; //Actualiza dirección de área o jefatura regional
		}else if($data['estado'] == "6"){ //observaciones fondo circulante
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD";
			$persona_actualiza = 4; //Actualiza jefatura inmediata
		}else if($data['estado'] == "3"){ //aprueba jefatura inmediata
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD";
			$persona_actualiza = 2; //Actualiza jefatura inmediata
		}else if($data['estado'] == "5"){ //aprueba dirección de área o jefatura regional
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD";
			$persona_actualiza = 3; //Actualiza dirección de área o jefatura regional
		}else if($data['estado'] == "7"){ //aprueba fondo circulante
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD";
			$persona_actualiza = 4; //Actualiza fondo circulante
		}

		$tiempo_dias = get_days_count(substr($fecha_actualizacion,0,10), substr($fecha_antigua,0,10));
		$data_insert = array(
			'fecha_antigua' => $fecha_antigua,
			'fecha_actualizacion' => $fecha_actualizacion,
			'tiempo_dias' => $tiempo_dias,
			'descripcion' => $mensaje, 
			'persona_actualiza' => $persona_actualiza,
			'id_mision' => $data["id_mision"],
			'nr_persona_actualiza' => $this->session->userdata('nr_usuario_viatico')
		);

		$fecha = date("Y-m-d H:i:s");
		$this->db->where("id_mision_pasajes",$data["id_mision"]);

		if($data['estado'] == "2" || $data['estado'] == "4" || $data['estado'] == "6"){
			if($this->db->update('vyp_mision_pasajes', array('estado' => $data['estado'], 'ultima_observacion' => $fecha)) && $this->db->insert('vyp_bitacora_solicitud_pasaje', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			if($this->db->update('vyp_mision_pasajes', array('estado' => $data['estado'])) && $this->db->insert('vyp_bitacora_solicitud_pasaje', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}
	}

	function eliminar_observacion($data){
		if($this->db->delete("vyp_observaciones_pasajes",array('id_observacion_pasaje' => $data['id_observacion']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}
function verificar_observaciones($data){
		$query = $this->db->query("SELECT * FROM vyp_observaciones_pasajes WHERE id_mision_pasajes = '".$data."' AND corregido = 0");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

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

}