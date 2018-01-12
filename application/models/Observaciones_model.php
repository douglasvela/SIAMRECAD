<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observaciones_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	function otra_observacion($data){
		$idb = $this->obtener_ultimo_id("vyp_observacion_solicitud","id_observacion_solicitud");
		$fecha = date("Y-m-d H:i:s");
		if($this->db->insert('vyp_observacion_solicitud', array('id_observacion_solicitud' => $idb, 'id_mision' => $data['id_mision'], 'observacion' => $data['observacion'], 'fecha_hora' => $fecha, 'corregido' => false))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function cambiar_estado_solicitud($data){
		$this->db->where("id_mision_oficial",$data["id_mision"]);
		if($this->db->update('vyp_mision_oficial', array('estado' => $data['estado']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function observar_empresa($data){
		$this->db->where("id_empresas_visitadas",$data["id_empresa"]);
		if($this->db->update('vyp_empresas_visitadas', array('observacion' => $data['observacion']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function eliminar_observacion($data){
		if($this->db->delete("vyp_observacion_solicitud",array('id_observacion_solicitud' => $data['id_observacion']))){
			return "exito";
		}else{
			return "fracaso";
		}
	}

	function verificar_observaciones_empresa($data){
		$query = $this->db->query("SELECT * FROM vyp_empresas_visitadas WHERE id_mision_oficial = '".$data."' AND observacion <> '' AND observacion IS NOT NULL");
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function verificar_observaciones($data){
		$query = $this->db->query("SELECT * FROM vyp_observacion_solicitud WHERE id_mision = '".$data."'");
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