<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_model extends CI_Model {
	
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

	function pagar_solicitud($data){		

		if($this->db->query("UPDATE vyp_mision_oficial SET fecha_pago = '".$data['fecha_pago']."', pagado_en = '".$data['tipo_pago']."', no_cheque = '".$data['num_cheque']."', estado = '8' WHERE id_mision_oficial = '".$data['id_mision']."'") && $this->db->query("UPDATE vyp_pago_emergencia SET estado = '1' WHERE id_pago_emergencia = '".$data['id_pago']."'")){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function cambiar_estado_solicitud($data){
		$query = $this->db->query("SELECT * FROM vyp_mision_oficial mo JOIN vyp_actividades a ON a.id_vyp_actividades = mo.id_actividad_realizada WHERE mo.id_mision_oficial = '".$data['id_mision']."'");
		if($query->num_rows() > 0){
			foreach ($query->result() as $fila) {
				$estado = $fila->estado; 
				$fecha_ultima_observacion = $fila->ultima_observacion;
			}
		}

		$mensaje = ""; $titulo = ""; $titulo2 = "";
		if($data['estado'] == "2"){ //observaciones jefatura inmediata
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD"; $titulo = "SOLICITUD OBSERVADA";
			$cuerpo_mensaje =  "Tiene una nueva observación en su solicitud de viáticos y pasajes por parte de: <b>".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico')))."</b>. Por favor verifique los inconvenientes encontrados.";
			$persona_actualiza = 2; //Actualiza jefatura inmediata
		}else if($data['estado'] == "4"){ //observaciones dirección de área o jefatura regional
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD"; $titulo = "SOLICITUD OBSERVADA";
			$cuerpo_mensaje =  "Tiene una nueva observación en su solicitud de viáticos y pasajes por parte de: <b>".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico')))."</b>. Por favor verifique los inconvenientes encontrados.";
			$persona_actualiza = 3; //Actualiza dirección de área o jefatura regional
		}else if($data['estado'] == "6"){ //observaciones fondo circulante
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "OBSERVÓ LA SOLICITUD"; $titulo = "SOLICITUD OBSERVADA";
			$cuerpo_mensaje =  "Tiene una nueva observación en su solicitud de viáticos y pasajes por parte de: <b>".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico')))."</b>. Por favor verifique los inconvenientes encontrados.";
			$persona_actualiza = 4; //Actualiza jefatura inmediata
		}else if($data['estado'] == "3"){ //aprueba jefatura inmediata
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD"; $titulo = "SOLICITUD APROBADA"; $titulo2 = "SOLICITUD PARA REVISIÓN";
			$cuerpo_mensaje =  "<b>".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico')))."</b>. Aprobó su solicitud de viáticos y pasajes.";
			$cuerpo_mensaje2 =  "Tiene una nueva solicitud de viáticos y pasajes de <b>".ucwords(strtolower($fila->nombre_completo))."</b> para revisión.";
			$persona_actualiza = 2; //Actualiza jefatura inmediata
		}else if($data['estado'] == "5"){ //aprueba dirección de área o jefatura regional
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD"; $titulo = "SOLICITUD APROBADA";
			$cuerpo_mensaje =  "<b>".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico')))."</b>. Aprobó su solicitud de viáticos y pasajes.";
			$persona_actualiza = 3; //Actualiza dirección de área o jefatura regional
		}else if($data['estado'] == "7"){ //aprueba fondo circulante
			$fecha_actualizacion = date("Y-m-d H:m:i");
			$fecha_antigua = $fecha_ultima_observacion;
			$mensaje = "APROBÓ LA SOLICITUD"; $titulo = "SOLICITUD APROBADA";
			$cuerpo_mensaje =  "<b>".ucwords(strtolower($this->session->userdata('nombre_usuario_viatico')))."</b>. Aprobó su solicitud de viáticos y pasajes.";
			$persona_actualiza = 4; //Actualiza fondo circulante
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

		
		$para='usuario';
		//envia correo cuando usuario se envia a revision en estado 2,4,6 y 0
		$url = base_url()."index.php/viaticos/solicitud_viatico";
		$cuerpo = "  
    		<div style='padding: 5px'>
	  			<span style='font-size:16px;font-weight: bold;'> 
	  				 Sistema de Viáticos y Pasajes
	  			</span><br><br><br>
	  			<span style='font-size:14px'> 
	  				 ".$cuerpo_mensaje."<br><br> 
	  				 <b>Fecha de la misión:</b> ".fecha_ESP($fila->fecha_mision_inicio)."			<br>
	  				 <b>Nombre de la actividad:</b> ".$fila->nombre_vyp_actividades."	<br>
	  			</span><br><br>
	  			<a href='".$url."' target='_blank'>Click aqui para ver solicitud</a>
    		</div>
 		";
	 		
		enviar_correo_viatico($titulo,$cuerpo,$fila->nr_empleado);
		if($data['estado'] == "3"){
			$cuerpo2 = "  
	    		<div style='padding: 5px'>
		  			<span style='font-size:16px;font-weight: bold;'> 
		  				 Sistema de Viáticos y Pasajes
		  			</span><br><br><br>
		  			<span style='font-size:14px'> 
		  				 ".$cuerpo_mensaje2."<br><br> 
		  				 <b>Fecha de la misión:</b> ".fecha_ESP($fila->fecha_mision_inicio)."			<br>
		  				 <b>Nombre de la actividad:</b> ".$fila->nombre_vyp_actividades."	<br>
		  			</span><br><br>
		  			<a href='".$url."' target='_blank'>Click aqui para ver solicitud</a>
	    		</div>
	 		";
			enviar_correo_viatico($titulo2,$cuerpo2,$fila->nr_jefe_regional);
		}


		$fecha = date("Y-m-d H:i:s");
		$this->db->where("id_mision_oficial",$data["id_mision"]);
		if($data['estado'] == "2" || $data['estado'] == "4" || $data['estado'] == "6"){ //Si tiene observaciones
			if($this->db->update('vyp_mision_oficial', array('estado' => $data['estado'], 'ultima_observacion' => $fecha)) && $this->db->insert('vyp_bitacora_solicitud_viatico', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{ //sino aprobar
			if($this->db->update('vyp_mision_oficial', array('estado' => $data['estado'], 'ultima_observacion' => $fecha)) && $this->db->insert('vyp_bitacora_solicitud_viatico', $data_insert)){
				return "exito";
			}else{
				return "fracaso";
			}
		}
	}

	function eliminar_observacion($data){
		if($this->db->delete("vyp_observacion_solicitud",array('id_observacion_solicitud' => $data['id_observacion']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function verificar_observaciones($data){
		$query = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$data."' AND corregido = 0");
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