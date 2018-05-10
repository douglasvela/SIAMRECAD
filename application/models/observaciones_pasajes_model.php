<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_pasajes_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	

	function otra_observacion($data){
		$idb = $this->obtener_ultimo_id("vyp_observaciones_pasajes","id_observacion_pasaje");
		$fecha = date("Y-m-d H:i:s");

		if($this->db->insert('vyp_observaciones_pasajes', array('id_observacion_pasaje' => $idb, 'id_mision_pasajes' => $data['id_mision'], 'observacion' => $data['observacion'], 'fecha_hora' => $fecha, 'corregido' => false, 'nr_observador' => $data['nr_observador'], 'id_tipo_observador' => $data['id_tipo_observador'], 'tipo_observador' => $data['tipo_observador']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function cambiar_estado_solicitud($data){
		$fecha = date("Y-m-d H:i:s");
		$this->db->where("id_mision_pasajes",$data["id_mision"]);

		if($data['estado'] == "2" || $data['estado'] == "4" || $data['estado'] == "6"){
			if($this->db->update('vyp_mision_pasajes', array('estado' => $data['estado'], 'ultima_observacion' => $fecha))){
				return "exito";
			}else{
				return "fracaso";
			}
		}else{
			if($this->db->update('vyp_mision_pasajes', array('estado' => $data['estado']))){
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