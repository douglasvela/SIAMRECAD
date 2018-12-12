<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_pasajes_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function otra_observacion($data){
		if($this->db->insert('vyp_observaciones_pasajes', $data)){
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

		$mensaje = "";$titulo ='USUARIO: '.$this->session->userdata('nr_usuario_viatico')." - ".$this->session->userdata('nombre_usuario_viatico');
		if($data['estado'] == "2"){ //observaciones jefatura inmediata
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD";
			$persona_actualiza = 2; //Actualiza jefatura inmediata
			$titulo .= ' ENVIÓ OBSERVACIÓN SOLICITUD DE PASAJES';
		}else if($data['estado'] == "4"){ //observaciones dirección de área o jefatura regional
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD";
			$persona_actualiza = 3; //Actualiza dirección de área o jefatura regional
			$titulo .= ' ENVIÓ OBSERVACIÓN SOLICITUD DE PASAJES';
		}else if($data['estado'] == "6"){ //observaciones fondo circulante
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD";
			$persona_actualiza = 4; //Actualiza jefatura inmediata
			$titulo .= ' ENVIÓ OBSERVACIÓN SOLICITUD DE PASAJES';
		}else if($data['estado'] == "3"){ //aprueba jefatura inmediata
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD";
			$persona_actualiza = 2; //Actualiza jefatura inmediata
			$titulo .= ' APROBÓ SOLICITUD DE PASAJES';
		}else if($data['estado'] == "5"){ //aprueba dirección de área o jefatura regional
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD";
			$persona_actualiza = 3; //Actualiza dirección de área o jefatura regional
			$titulo .= ' APROBÓ SOLICITUD DE PASAJES';
		}else if($data['estado'] == "7"){ //aprueba fondo circulante
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD";
			$persona_actualiza = 4; //Actualiza fondo circulante
			$titulo .= ' APROBÓ SOLICITUD DE PASAJES';
		}
		

		$tiempo_dias = get_days_count(substr($fecha_antigua,0,10), substr($fecha_actualizacion,0,10));
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
				//envia correo al usuario cuando se observa la solicitud se observa en estados 2,4,6
				enviar_correo($titulo,"Hola este es un correo de prueba",'usuario',$data['id_mision'],$fila->nr);
				if( $data['estado'] == "4" ||  $data['estado']=="6"){
					//enviar correo al jefe inmediato cuando la solicitud  se observa en estado 4,6
					enviar_correo($titulo,"Hola este es un correo de prueba",'jefeinmediato',$data['id_mision'],$fila->nr);
				}
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			if($this->db->update('vyp_mision_pasajes', array('estado' => $data['estado'])) && $this->db->insert('vyp_bitacora_solicitud_pasaje', $data_insert)){
				//envia correo cuando se aprueba envia a revision al siguiente jefe
				enviar_correo($titulo,"Hola este es un correo de prueba",'usuario',$data['id_mision'],$fila->nr);
				if($data['estado']=="5"){
					//envia correo cuando solicitud jefe depto aprueba y pasa a estado revision 5.
					//enviar_correo($titulo,"Hola este es un correo de prueba",'fondocirculante',$data['id_mision'],$fila->nr);
				}else if($data['estado'] == "1"){
					//envia correo al jefe inmediato cuando usuario solventa errores y pasa a estado revision 1
					enviar_correo($titulo,"Hola este es un correo de prueba",'jefeinmediato',$data['id_mision'],$fila->nr);
				}else if($data['estado'] == "3"){
					//envia correo al jefe depto cuando jefeinmediato aprueba solicitud y pasa a estado revision 3
					enviar_correo($titulo,"Hola este es un correo de prueba",'jefedepto',$data['id_mision'],$fila->nr);
				} 	
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